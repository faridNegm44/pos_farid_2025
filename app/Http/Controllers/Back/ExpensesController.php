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
    }

    public function store(Request $request)
    {
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
    }

    public function edit($id)
    {
        if(request()->ajax()){
            $find = Expense::where('id', $id)->first();
            return response()->json($find);
        }
        return view('back.welcome');
    }

    public function update(Request $request, $id)
    {
        if (request()->ajax()){
            $find = Expense::where('id', $id)->first();

            $this->validate($request , [
                'name' => 'required|string|unique:financial_treasuries,name,'.$id,
                //'moneyFirstDuration' => 'min:0|numeric',
                'notes' => 'nullable|string|max:255',
            ],[
                'required' => 'حقل :attribute إلزامي.',
                'string' => 'حقل :attribute يجب ان يكون من نوع نص.',
                'unique' => 'حقل :attribute مستخدم من قبل.',
                'min' => 'حقل :attribute أقل قيمة له هي 0 حرف.',
                'max' => 'حقل :attribute أقصي قيمة له هي 255 حرف.',
                'numeric' => 'حقل :attribute يجب ان يكون من نوع رقم.',
            ],[
                'name' => 'إسم الخزنة',                
                'moneyFirstDuration' => 'رصيد أول المدة',                
                'notes' => 'ملاحظات',                
            ]);

            $data = $request->all();
            unset($data['moneyFirstDuration']);

            $find->update($data);
        }   
    }

     
    //public function destroy($id)
    //{
    //    $find = Expense::where('id', $id)->get();
    //    $find_relation = DB::table('treasury_bills_head')->where('expenses_id', $id)->get();

    //    if(count($find_relation) > 0){
    //        return response()->json('');
    //    }else{
    //        DB::transaction(function($find, $find_relation){
    //            $find->delete();
    //            $find_relation->delete();
    //        });
    //    }
    //}


    public function datatable()
    {
        $all = Expense::orderBy('id', 'desc')
                        ->leftJoin('treasury_bill_dets', 'treasury_bill_dets.bill_id', 'expenses.id')
                        ->leftJoin('financial_treasuries', 'financial_treasuries.id', 'treasury_bill_dets.treasury_id')
                        ->leftJoin('users', 'users.id', 'treasury_bill_dets.user_id')
                        ->select(
                            'treasury_bill_dets.*', 
                            'expenses.id as expenses_id',
                            'expenses.title',
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
                return $res->amount_money;
            })
            ->addColumn('treasury_money_after', function($res){
                return '<strong style="color: red;font-size: 15px;">'.$res->treasury_money_after.'</strong>';
            })
            ->addColumn('created_at', function($res){
                if($res->created_at){
                    return Carbon::parse($res->created_at)->format('d-m-Y')
                            .' <p style="font-weight: bold;margin: 0 7px;">'.Carbon::parse($res->created_at)->format('h:i:s a').'</p>';
                }
            })
            ->addColumn('notes', function($res){
                return '<span data-bs-toggle="popover" data-bs-placement="bottom" title="'.$res->notes.'">
                            '.Str::limit($res->notes, 20).'
                        </span>';
            })
            ->addColumn('action', function($res){
                return '
                        <button type="button" class="btn btn-sm btn-outline-primary edit" data-effect="effect-scale" data-toggle="modal" href="#exampleModalCenter" data-placement="top" data-toggle="tooltip" title="تعديل" res_id="'.$res->id.'">
                            <i class="fas fa-marker"></i>
                        </button>
                    ';
            })
            ->rawColumns(['user', 'treasury', 'title', 'amount_money', 'treasury_money_after', 'created_at', 'notes', 'action'])
            ->toJson();
    }
}