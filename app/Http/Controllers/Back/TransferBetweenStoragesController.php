<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\FinancialTreasury;
use App\Models\Back\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Str;

class TransferBetweenStoragesController extends Controller
{
    public function index()
    {                        
        if((userPermissions()->transfer_between_storages_view)){
            $pageNameAr = 'التحويل من خزنة لأخري';
            $pageNameEn = 'transfer_between_storages';
            $treasuries = FinancialTreasury::where('status', 1)
                                            ->leftJoin('treasury_bill_dets', function ($join) {
                                                $join->on('treasury_bill_dets.treasury_id', '=', 'financial_treasuries.id')
                                                    ->whereRaw('treasury_bill_dets.id = (select max(id) from treasury_bill_dets where treasury_bill_dets.treasury_id = financial_treasuries.id)');
                                            })
                                            ->select('financial_treasuries.*', 'treasury_bill_dets.treasury_money_after')
                                            ->get();
                                            
            return view('back.transfer_between_storages.index' , compact('pageNameAr' , 'pageNameEn', 'treasuries'));	
        }else{
            return redirect('/')->with(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        }  
    }

    public function get_last_money_on_treasury($transaction_from, $transaction_to)
    {
        if(request()->ajax()){
            $transaction_from = DB::table('treasury_bill_dets')
                                    ->whereRaw('id = (select max(id) from treasury_bill_dets where treasury_id = '.$transaction_from.')')                              
                                    ->value('treasury_money_after');


            $transaction_to = DB::table('treasury_bill_dets')
                                    ->whereRaw('id = (select max(id) from treasury_bill_dets where treasury_id = '.$transaction_to.')')                              
                                    ->value('treasury_money_after');

            return response()->json([
                'transaction_from' => floatval($transaction_from),
                'transaction_to' => floatval($transaction_to)
            ]);            
        }
        return view('back.welcome');
    }
    
    public function store(Request $request)
    {
        if((userPermissions()->transfer_between_storages_create)){
            if (request()->ajax()){
                $this->validate($request , [
                    'transaction_from' => 'required|integer|exists:financial_treasuries,id',
                    'transaction_to' => 'required|integer|exists:financial_treasuries,id',
                    'value' => 'required|numeric|min:1',
                    'notes' => 'nullable|string|max:255',
                ],[
                    'exists' => 'حقل :attribute غير موجود.',
                    'required' => 'حقل :attribute إلزامي.',
                    'string' => 'حقل :attribute يجب ان يكون من نوع نص.',
                    'min' => 'حقل :attribute أقل قيمة له هي رقم 1.',
                    'max' => 'حقل :attribute أقصي قيمة له هي 255 حرف.',
                    'numeric' => 'حقل :attribute يجب ان يكون من نوع رقم.',
                    'integer' => 'حقل :attribute يجب ان يكون من نوع رقم.',
                ],[
                    'transaction_from' => 'الخزينة المحول منها',                
                    'transaction_to' => 'الخزينة المحول اليها',                
                    'value' => 'مبلغ التحويل',                
                    'notes' => 'ملاحظات',                
                ]);
    
                $transaction_from_last_money = DB::table('treasury_bill_dets')
                                        ->whereRaw('id = (select max(id) from treasury_bill_dets where treasury_id = '.request('transaction_from').')')                              
                                        ->value('treasury_money_after');
    
    
                $transaction_to_last_money = DB::table('treasury_bill_dets')
                                        ->whereRaw('id = (select max(id) from treasury_bill_dets where treasury_id = '.request('transaction_to').')')                              
                                        ->value('treasury_money_after');
    
                $value = request('value');
                $req_from = request('transaction_from');
                $req_to = request('transaction_to');
    
                $lastNumId = DB::table('treasury_bill_dets')->where('treasury_type', 'تحويل بين خزنتين')->max('num_order');
    
                
                if($value > $transaction_from_last_money){
                    return response()->json(['error' => 'مبلغ التحويل اكبر من المبلغ الموجود بالخزينة']);
                }else{
    
                    DB::transaction(function() use($transaction_from_last_money, $transaction_to_last_money, $lastNumId, $value, $req_from, $req_to){
    
                        // start transaction from الخزنه المحول منها
                        DB::table('treasury_bill_dets')->insert([
                            'num_order' => ($lastNumId+1), 
                            'date' => Carbon::now(),
                            'treasury_id' => $req_from, 
                            'treasury_type' => 'تحويل بين خزنتين', 
                            'bill_id' => 0, 
                            'bill_type' => 0, 
                            'client_supplier_id' => 0, 
                            'treasury_money_after' => ($transaction_from_last_money - $value), 
                            'amount_money' => $value, 
                            'remaining_money' => ($transaction_from_last_money - $value), 
                            'transaction_from' => $req_from, 
                            'transaction_to' => $req_to, 
                            'notes' => request('notes'), 
                            'user_id' => auth()->user()->id, 
                            'year_id' => $this->currentFinancialYear(),
                            'created_at' => now()
                        ]);
    
                        // start transaction to الخزنه المحول اليها
                        DB::table('treasury_bill_dets')->insert([
                            'num_order' => ($lastNumId+1), 
                            'date' => Carbon::now(),
                            'treasury_id' => $req_to, 
                            'treasury_type' => 'تحويل بين خزنتين', 
                            'bill_id' => 0, 
                            'bill_type' => 0, 
                            'client_supplier_id' => 0, 
                            'treasury_money_after' => ($transaction_to_last_money + $value), 
                            'amount_money' => $value, 
                            'remaining_money' => ($transaction_to_last_money + $value), 
                            'transaction_from' => $req_from, 
                            'transaction_to' => $req_to, 
                            'notes' => request('notes'), 
                            'user_id' => auth()->user()->id, 
                            'year_id' => $this->currentFinancialYear(),
                            'created_at' => now()
                        ]);
                    });
                }
            }
        }else{
            return response()->json(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        }  
    }   
    
    public function show($id)
    {
        if(request()->ajax()){
            $find = DB::table('treasury_bill_dets')
                        ->where('num_order', $id)
                        ->where('treasury_type', 'تحويل بين خزنتين')
                        ->leftJoin('financial_treasuries as transaction_from_name', 'transaction_from_name.id', 'treasury_bill_dets.treasury_id')
                        ->leftJoin('financial_treasuries as transaction_to_name', 'transaction_to_name.id', 'treasury_bill_dets.treasury_id')
                        ->leftJoin('users', 'users.id', 'treasury_bill_dets.user_id')
                        ->select(
                            'treasury_bill_dets.*', 
                            'transaction_from_name.name as transaction_from_name',
                            'transaction_to_name.name as transaction_to_name',
                            'users.name as userName',
                        )
                        ->get();

            $created_at = Carbon::parse($find[0]->created_at)->format('d-m-Y h:i:s a');

            //dd($created_at);

            return response()->json([
                'find' => $find,
                'created_at' => $created_at
            ]);
        }
        return view('back.welcome');
    }


    public function datatable()
    {
        $all = DB::table('treasury_bill_dets')->orderBy('num_order', 'asc')
                        ->leftJoin('financial_treasuries as transaction_from_name', 'transaction_from_name.id', 'treasury_bill_dets.treasury_id')
                        ->leftJoin('financial_treasuries as transaction_to_name', 'transaction_to_name.id', 'treasury_bill_dets.treasury_id')
                        ->leftJoin('users', 'users.id', 'treasury_bill_dets.user_id')
                        ->select(
                            'treasury_bill_dets.*', 
                            'transaction_from_name.name as transaction_from_name',
                            'transaction_to_name.name as transaction_to_name',
                            'users.name as userName',
                        )
                        ->orderBy('treasury_bill_dets.bill_id', 'ASC')
                        ->groupBy('treasury_bill_dets.num_order')
                        ->where('treasury_type', 'تحويل بين خزنتين')
                        ->get();


        return DataTables::of($all)
            ->addColumn('num_order', function($res){
                return $res->num_order;
            })
            ->addColumn('created_at', function($res){
                if($res->created_at){
                    return Carbon::parse($res->created_at)->format('d-m-Y')
                            .' <span style="margin: 0 7px;color: red;">'.Carbon::parse($res->created_at)->format('h:i:s a').'</span>';
                }
            })
            ->addColumn('value', function($res){
                return "<strong style='font-size: 13px;'>".display_number($res->amount_money)."</strong>";
            })
            ->addColumn('user', function($res){
                return $res->userName;
            })
            ->addColumn('notes', function($res){
                return '<span data-bs-toggle="popover" data-bs-placement="bottom" title="'.$res->notes.'">
                            '.Str::limit($res->notes, 20).'
                        </span>';
            })
            ->addColumn('action', function($res){
                return '
                        <button type="button" class="btn btn-sm btn-outline-success show" data-effect="effect-scale" data-toggle="modal" href="#exampleModalCenterShow" data-placement="top" data-toggle="tooltip" title="عرض التحويل" res_id="'.$res->num_order.'">
                            <i class="fas fa-eye"></i>
                        </button>
                    ';
            })
            ->rawColumns(['num_order', 'created_at', 'user', 'transaction_from', 'transaction_to', 'value', 'notes', 'action'])
            ->toJson();
    }
}