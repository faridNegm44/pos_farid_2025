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

class ExpensesController extends Controller
{
    public function index()
    {   
        if((userPermissions()->expenses_view)){
            $pageNameAr = 'المصروفات';
            $pageNameEn = 'expenses';
            $treasuries = FinancialTreasury::where('status', 1)
                                            ->leftJoin('treasury_bill_dets', function ($join) {
                                                $join->on('treasury_bill_dets.treasury_id', '=', 'financial_treasuries.id')
                                                    ->whereRaw('treasury_bill_dets.id = (select max(id) from treasury_bill_dets where treasury_bill_dets.treasury_id = financial_treasuries.id)');
                                            })
                                            ->select('financial_treasuries.*', 'treasury_bill_dets.treasury_money_after')
                                            ->get();
                                            
                                            //dd($treasuries);
    
            return view('back.expenses.index' , compact('pageNameAr' , 'pageNameEn', 'treasuries'));
	
        }else{
            return redirect('/')->with(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        }  
    }

    public function store(Request $request)
    {
        if((userPermissions()->expenses_create)){
            if (request()->ajax()){
                $lastAmountOfTreasury = DB::table('treasury_bill_dets')
                                            ->where('treasury_id', request('treasury'))
                                            ->orderBy('id', 'desc')
                                            ->value('treasury_money_after');            
                
                $amount = request('amount');
    
                if($amount > $lastAmountOfTreasury){
                    return response()->json(['error' => 'مبلغ المصروف اكبر من المبلغ الموجود بالخزينة']);
                
                }else{
                    $this->validate($request , [
                        'treasury' => 'required|integer|exists:financial_treasuries,id',
                        'title' => 'required||string|max:255',
                        'amount' => 'required|numeric|min:1',
                        'notes' => 'nullable|string|max:255',
                    ],[
                        'exists' => 'حقل :attribute غير موجود.',
                        'required' => 'حقل :attribute إلزامي.',
                        'string' => 'حقل :attribute يجب ان يكون من نوع نص.',
                        'min' => 'حقل :attribute أقل قيمة له هي 1 حرف.',
                        'max' => 'حقل :attribute أقصي قيمة له هي 255 حرف.',
                        'numeric' => 'حقل :attribute يجب ان يكون من نوع رقم.',
                        'integer' => 'حقل :attribute يجب ان يكون من نوع رقم.',
                    ],[
                        'treasury' => 'الخزينة',                
                        'title' => 'وصف المصروف',                
                        'amount' => 'مبلغ المصروف',                
                        'notes' => 'ملاحظات',                
                    ]);
                        
                    DB::transaction(function() use($lastAmountOfTreasury){                   
                        $getId = Expense::create(request()->all());
    
                        $lastNumId = DB::table('treasury_bill_dets')->where('treasury_type', 'مصروف')->max('num_order');
                        DB::table('treasury_bill_dets')->insert([
                            'num_order' => ($lastNumId+1), 
                            'date' => Carbon::now(),
                            'treasury_id' => request('treasury'), 
                            'treasury_type' => 'مصروف', 
                            'bill_id' => $getId->id, 
                            'bill_type' => 0, 
                            'client_supplier_id' => 0, 
                            'treasury_money_after' => ($lastAmountOfTreasury - request('amount')), 
                            'amount_money' => request('amount'), 
                            'remaining_money' => ($lastAmountOfTreasury - request('amount')), 
                            'transaction_from' => null, 
                            'transaction_to' => null, 
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

     
    public function destroy($id)
    {
        if((userPermissions()->expenses_delete)){
            $findExpenseTreasuryBillDets = DB::table('treasury_bill_dets')
                                            ->where('treasury_type', 'مصروف')
                                            ->where('bill_id', $id)
                                            ->first();
    
            $lastMoneyOfTreasury = Db::table('treasury_bill_dets')
                                    ->where('treasury_id', $findExpenseTreasuryBillDets->treasury_id)
                                    ->orderBy('id', 'desc')
                                    ->value('treasury_money_after');
    
            $lastNumId = DB::table('treasury_bill_dets')
                            ->where('treasury_type', 'مرتجع مصروف')
                            ->max('num_order');
    
            //dd($lastMoneyOfTreasury);
    
            DB::transaction(function() use($id, $findExpenseTreasuryBillDets, $lastNumId, $lastMoneyOfTreasury){
                // start make new row in treasury_bill_dets باسم مريجع مصروف 
                    DB::table('treasury_bill_dets')->insert([
                        'num_order' => ($lastNumId+1), 
                        'date' => Carbon::now(),
                        'treasury_id' => $findExpenseTreasuryBillDets->treasury_id, 
                        'treasury_type' => 'مرتجع مصروف', 
                        'bill_id' => $findExpenseTreasuryBillDets->bill_id, 
                        'bill_type' => 0,
                        'client_supplier_id' => 0,
                        'treasury_money_after' => ($lastMoneyOfTreasury + $findExpenseTreasuryBillDets->amount_money), 
                        'amount_money' => $findExpenseTreasuryBillDets->amount_money, 
                        'remaining_money' => ($lastMoneyOfTreasury + $findExpenseTreasuryBillDets->amount_money), 
                        'transaction_from' => null, 
                        'transaction_to' => null, 
                        'notes' => 'مرتجع مصروف من فاتورة رقم '.$findExpenseTreasuryBillDets->bill_id.'', 
                        'user_id' => auth()->user()->id, 
                        'year_id' => $this->currentFinancialYear(),
                        'created_at' => now()
                    ]);
                // end make new row in treasury_bill_dets باسم مريجع مصروف 
    
    
                // start remove data in old row of treasury_bill_dets
                    DB::table('treasury_bill_dets')->where('treasury_type', 'مصروف')->where('bill_id', $id)->update([
                        'amount_money' => 0, 
                        'remaining_money' => 0, 
                    ]);
                // end remove data in old row of treasury_bill_dets
    
    
                // start change status in expenses table from اضافه to مرتجع
                    DB::table('expenses')->where('id', $id)->update([
                        'status' => 'حذف', 
                    ]);
                // end change status in expenses table from اضافه to مرتجع
            });

        }else{
            return response()->json(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        }  
    }


    public function datatable()
    {
        $all = Expense::orderBy('id', 'desc')
                        ->leftJoin('treasury_bill_dets', 'treasury_bill_dets.bill_id', 'expenses.id')
                        ->leftJoin('financial_treasuries', 'financial_treasuries.id', 'treasury_bill_dets.treasury_id')
                        ->leftJoin('users', 'users.id', 'treasury_bill_dets.user_id')
                        ->select(
                            'treasury_bill_dets.*', 
                            'expenses.id as expenses_id',
                            'expenses.status as expenses_status',
                            'expenses.title',
                            'expenses.amount',
                            'financial_treasuries.name as treasuryName',
                            'users.name as userName',
                        )
                        ->orderBy('treasury_bill_dets.bill_id', 'ASC')
                        ->where('treasury_type', 'مصروف')
                        ->get();

        return DataTables::of($all)
            ->addColumn('id', function($res){
                return $res->num_order;
            })
            ->addColumn('user', function($res){
                return $res->userName;
            })
            ->addColumn('treasury', function($res){
                return '<strong class="text-primary">'.$res->treasuryName.'</strong>';
            })
            ->addColumn('title', function($res){
                return '<span data-bs-toggle="popover" data-bs-placement="bottom" title="'.$res->title.'">
                            '.Str::limit($res->title, 30).'
                        </span>';
            })
            ->addColumn('amount_money', function($res){
                if($res->expenses_status == 'اضافة'){
                    return '<span class="" style="font-size: 12px;">'.display_number($res->amount_money).'</span>';
                }else{
                    return '
                                <span class="text-danger" style="margin: 3px;font-size: 12px;">قبل: '.display_number($res->amount).'</span>
                                <span style="margin: 3px;font-size: 12px;">بعد: 0</span>
                            ';
                }
            })
            ->addColumn('treasury_money_after', function($res){
                return '<strong style="color: red;font-size: 15px;">'.$res->treasury_money_after.'</strong>';
            })
            ->addColumn('created_at', function($res){
                if($res->created_at){
                    return Carbon::parse($res->created_at)->format('d-m-Y')
                            .' <span style="margin: 0 7px;color: red;">'.Carbon::parse($res->created_at)->format('h:i:s a').'</span>';
                }
            })
            ->addColumn('notes', function($res){
                return '<span data-bs-toggle="popover" data-bs-placement="bottom" title="'.$res->notes.'">
                            '.Str::limit($res->notes, 20).'
                        </span>';
            })
            ->addColumn('status', function($res){
                if($res->expenses_status == 'اضافة'){
                    return '<span class="badge badge-success" style="width: 40px;">اضافة</span>';
                }
                else{
                    return '<span class="badge badge-danger" style="width: 40px;">حذف</span>';
                }
            })
            ->addColumn('action', function($res){
                if($res->expenses_status == 'اضافة'){
                    return '
                                <button class="btn btn-sm btn-outline-danger delete" data-placement="top" data-toggle="tooltip" title="حذف" res_id="'.$res->expenses_id.'" res_title="'.$res->title.'">
                                    <i class="fa fa-trash"></i>
                                </button>
                            ';
                }else{
                    return '';
                }
            })
            ->rawColumns(['user', 'treasury', 'title', 'amount_money', 'treasury_money_after', 'status', 'created_at', 'notes', 'action'])
            ->toJson();
    }
}