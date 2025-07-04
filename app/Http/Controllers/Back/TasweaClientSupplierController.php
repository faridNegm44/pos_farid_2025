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

class TasweaClientSupplierController extends Controller
{
    public function index()
    {          
        if((userPermissions()->taswea_client_supplier_view)){
            $pageNameAr = 'تسوية رصيد عميل / مورد';
            $pageNameEn = 'taswea_client_supplier';
            $taswea_reasons = DB::table('taswea_reasons_to_client_supplier')->get();
    
            return view('back.taswea_client_supplier.index' , compact('pageNameAr' , 'pageNameEn', 'taswea_reasons'));
        }else{
            return redirect('/')->with(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        }      
    }

    public function store(Request $request)
    {
        if((userPermissions()->taswea_client_supplier_create)){
            if (request()->ajax()){
                $this->validate($request , [
                    'client_supplier_id' => 'required|integer|exists:clients_and_suppliers,id',
                    'reason_id' => 'required|integer|exists:taswea_reasons_to_client_supplier,id',
                    'new_remaining_money' => 'required|numeric',
                ],[
                    'required' => 'حقل :attribute إلزامي.',
                    'exists' => 'حقل :attribute غير موجود.',
                    'integer' => 'حقل :attribute يجب ان يكون من نوع رقم.',
                    'numeric' => 'حقل :attribute يجب ان يكون من نوع رقم.',
                    'min' => 'حقل :attribute أقل قيمة له هي 0.',
                ],[
                    'client_supplier_id' => 'اختيار الجهة',                
                    'reason_id' => 'سبب التسوية',                
                    'new_remaining_money' => 'رصيد الجهة الجديد',                
                ]);
    
                $find = DB::table('treasury_bill_dets')->where('client_supplier_id', request('client_supplier_id'))->orderBy('id', 'desc')->first();
                $lastNumId = DB::table('treasury_bill_dets')->where('treasury_type', 'تسوية رصيد للجهة')->max('num_order');
    
                // start db::transaction
                DB::transaction(function() use($find, $lastNumId){
    
                    $insertGetId = DB::table('taswea_client_supplier')->insertGetId([
                        'client_supplier_id' => request('client_supplier_id'),
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
                        'client_supplier_id' => request('client_supplier_id'), 
                        'remaining_money' => request('new_remaining_money'),
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

    public function getCurrentRemainingMoney($clientOrSupplier)
    {
        if(request()->ajax()){
            if($clientOrSupplier == 'عميل'){
                $find = DB::table('clients_and_suppliers')
                            ->whereIn('clients_and_suppliers.client_supplier_type', [3, 4])
                            ->leftJoin('treasury_bill_dets', function ($join) {
                                $join->on('treasury_bill_dets.client_supplier_id', '=', 'clients_and_suppliers.id')
                                    ->whereRaw('treasury_bill_dets.id = (select max(id) from treasury_bill_dets where treasury_bill_dets.client_supplier_id = clients_and_suppliers.id)');
                            })
                            ->select(
                                'clients_and_suppliers.id', 'clients_and_suppliers.name', 
                                'treasury_bill_dets.remaining_money', 
                            )
                            ->orderBy('treasury_bill_dets.id', 'desc')
                            ->get();

                return response()->json($find);

            }elseif($clientOrSupplier == 'مورد'){
                $find = DB::table('clients_and_suppliers')
                            ->whereIn('clients_and_suppliers.client_supplier_type', [1, 2])
                            ->leftJoin('treasury_bill_dets', function ($join) {
                                $join->on('treasury_bill_dets.client_supplier_id', '=', 'clients_and_suppliers.id')
                                    ->whereRaw('treasury_bill_dets.id = (select max(id) from treasury_bill_dets where treasury_bill_dets.client_supplier_id = clients_and_suppliers.id)');
                            })
                            ->select(
                                'clients_and_suppliers.id', 'clients_and_suppliers.name', 
                                'treasury_bill_dets.remaining_money', 
                            )
                            ->orderBy('treasury_bill_dets.id', 'desc')
                            ->get();

                return response()->json($find);
            }
        }
        return view('back.welcome');
    }
    
    public function datatable()
    {
        $all = DB::table('taswea_client_supplier')
                            //->leftJoin('treasury_bill_dets', 'treasury_bill_dets.bill_id', 'taswea_client_supplier.id')
                            //->where('treasury_bill_dets.bill_type', 'تسوية رصيد للجهة')
                            ->leftJoin('clients_and_suppliers', 'clients_and_suppliers.id', 'taswea_client_supplier.client_supplier_id')
                            ->leftJoin('clients_and_suppliers_types', 'clients_and_suppliers_types.id', 'clients_and_suppliers.client_supplier_type')
                            ->leftJoin('taswea_reasons_to_client_supplier', 'taswea_reasons_to_client_supplier.id', 'taswea_client_supplier.reason_id')
                            ->leftJoin('users', 'users.id', 'taswea_client_supplier.user_id')
                            ->leftJoin('financial_years', 'financial_years.id', 'taswea_client_supplier.year_id')
                            ->select(
                                'taswea_client_supplier.*',
                                'clients_and_suppliers.name as clientSupplierName',
                                'users.name as userName',                                
                                'taswea_reasons_to_client_supplier.name as reasonName',
                                'clients_and_suppliers_types.name as clientSupplierStatus',
                                'financial_years.name as financialName',
                            )
                            ->orderBy('taswea_client_supplier.id', 'desc')
                            ->get();

        return DataTables::of($all)
            ->addColumn('clientSupplierName', function($res){
                return $res->clientSupplierName;
            })
            ->addColumn('clientSupplierStatus', function($res){
                return $res->clientSupplierStatus;
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