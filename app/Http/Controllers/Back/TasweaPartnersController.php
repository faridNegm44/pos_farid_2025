<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\Product;
use App\Models\Back\StoreDets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TasweaPartnersController extends Controller
{
    public function index()
    {     
        if((userPermissions()->taswea_partners_view)){
            $pageNameAr = 'تسوية رصيد شريك';
            $pageNameEn = 'taswea_partners';
            $taswea_reasons = DB::table('taswea_reasons_to_client_supplier')->get();
    
            $partners = DB::table('partners')
                            ->leftJoin('treasury_bill_dets', function ($join) {
                                $join->on('treasury_bill_dets.partner_id', '=', 'partners.id')
                                    ->whereRaw('treasury_bill_dets.id = (
                                        SELECT MAX(id) FROM treasury_bill_dets 
                                        WHERE partner_id = partners.id
                                    )');
                            })
                            ->select(
                                'partners.*',
                                'treasury_bill_dets.remaining_money', 
                            )
                            ->get();
    
            return view('back.taswea_partners.index' , compact('pageNameAr' , 'pageNameEn', 'taswea_reasons', 'partners'));
	
        }else{
            return redirect('/')->with(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        }            
    }

    public function store(Request $request)
    {
        if((userPermissions()->taswea_partners_create)){
            if (request()->ajax()){
                $this->validate($request , [
                    'partner_id' => 'required|integer|exists:partners,id',
                    'reason_id' => 'required|integer|exists:taswea_reasons_to_client_supplier,id',
                    'new_remaining_money' => 'required|numeric',
                ],[
                    'required' => 'حقل :attribute إلزامي.',
                    'exists' => 'حقل :attribute غير موجود.',
                    'integer' => 'حقل :attribute يجب ان يكون من نوع رقم.',
                    'numeric' => 'حقل :attribute يجب ان يكون من نوع رقم.',
                    'min' => 'حقل :attribute أقل قيمة له هي 0.',
                ],[
                    'partner_id' => 'اختيار الشريك',                
                    'reason_id' => 'سبب التسوية',                
                    'new_remaining_money' => 'رصيد الشريك الجديد',                
                ]);
    
                $find = DB::table('treasury_bill_dets')->where('partner_id', request('partner_id'))->orderBy('id', 'desc')->first();
                $lastNumId = DB::table('treasury_bill_dets')->where('treasury_type', 'تسوية رصيد للجهة')->max('num_order');
    
                // start db::transaction
                DB::transaction(function() use($find, $lastNumId){
    
                    $insertGetId = DB::table('taswea_partners')->insertGetId([
                        'partner_id' => request('partner_id'),
                        'old_money' => $find->remaining_money,
                        'new_money' => request('new_remaining_money'),
                        'reason_id' => request('reason_id'),
                        'user_id' => auth()->user()->id,
                        'notes' => request('notes'),
                        'year_id' => $this->currentFinancialYear(),
                        'created_at' => now(),
                    ]);
    
                    DB::table('treasury_bill_dets')->insert([
                        'num_order' => ($lastNumId+1), 
                        'date' => Carbon::now(),
                        'treasury_id' => 0, 
                        'treasury_type' => 'تسوية رصيد للجهة', 
                        'bill_id' => $insertGetId, 
                        'bill_type' => 'تسوية رصيد للجهة',
                        'partner_id' => request('partner_id'), 
                        'remaining_money' => request('new_remaining_money'),
                        'commission_percentage' => $find->commission_percentage,
                        'notes' => request('notes'), 
                        'user_id' => auth()->user()->id, 
                        'year_id' => $this->currentFinancialYear(),
                        'created_at' => now()
                    ]);
                }); // end db::transaction 
            }
        }else{
            return response()->json(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        } 
    }

    public function datatable()
    {
        $all = DB::table('taswea_partners')
                            ->leftJoin('partners', 'partners.id', 'taswea_partners.partner_id')
                            ->leftJoin('taswea_reasons_to_client_supplier', 'taswea_reasons_to_client_supplier.id', 'taswea_partners.reason_id')
                            ->leftJoin('users', 'users.id', 'taswea_partners.user_id')
                            ->leftJoin('financial_years', 'financial_years.id', 'taswea_partners.year_id')
                            ->select(
                                'taswea_partners.*',
                                'partners.name as partnerName',
                                'users.name as userName',                                
                                'taswea_reasons_to_client_supplier.name as reasonName',
                                'financial_years.name as financialName',
                            )
                            ->orderBy('taswea_partners.id', 'desc')
                            ->get();

        return DataTables::of($all)
            ->addColumn('partnerName', function($res){
                return $res->partnerName;
            })
            ->addColumn('old_money', function($res){
                return "<strong style='font-size: 12px !important;'>" .
                            ($res->old_money > 0 ? 'علية ' . display_number($res->old_money) : 'له ' . display_number($res->old_money)) .
                        "</strong>";

            })
            ->addColumn('new_money', function($res){
                return "<strong style='font-size: 12px !important;'>" .
                            ($res->new_money > 0 ? 'علية ' . display_number($res->new_money) : 'له ' . display_number($res->new_money)) .
                        "</strong>";
            })
            ->addColumn('reasonName', function($res){
                return $res->reasonName;
            })
            ->addColumn('tasweaCreatedAt', function($res){
                return Carbon::parse($res->created_at)->format('d-m-Y')
                            .' <span style="margin: 0 7px;color: red;">'.Carbon::parse($res->created_at)->format('h:i:s a').'</span>';
            })
            //->addColumn('status', function($res){
            //    if($res->new_money  > $res->old_money){
            //        return '<span style="font-size: 15px !important;width: 60px;">'.$res->new_money - $res->old_money.'</span>';
            //    }else{
            //        return '<span style="font-size: 15px !important;width: 60px;">'.$res->old_money - $res->new_money.'</span>';
            //    }
            //})
            ->addColumn('tasweaNotes', function($res){
                return '<span data-bs-toggle="popover" data-bs-placement="bottom" title="'.$res->notes.'">
                            '.Str::limit($res->notes, 20).'
                        </span>';
            })
            ->addColumn('financialName', function($res){
                return $res->financialName;
            })
            ->addColumn('userName', function($res){
                return $res->userName;
            })
            ->rawColumns(['productName', 'old_money', 'new_money', 'reasonName', 'status', 'tasweaCreatedAt', 'userName', 'tasweaNotes', 'financialName'])
            ->toJson();
    }
}