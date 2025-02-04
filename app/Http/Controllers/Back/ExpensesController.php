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
                                        ->select('financial_treasuries.*', 'treasury_bill_dets.money')
                                        ->get();
                                        
                                        //dd($treasuries);

        return view('back.expenses.index' , compact('pageNameAr' , 'pageNameEn', 'treasuries'));
    }

    public function store(Request $request)
    {
        if (request()->ajax()){
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


            $lastAmountOfTreasury = DB::table('treasury_bill_dets')
                                        ->where('treasury_id', request('treasury'))
                                        ->orderBy('id', 'desc')
                                        ->value('money');            
            
            $amount = request('amount');

            if($amount > $lastAmountOfTreasury){
                return response()->json(['error' => 'مبلغ المصروف اكبر من المبلغ الموجود بالخزينة']);
            }else{
                
                DB::transaction(function() use($lastAmountOfTreasury){                   
                    $getId = Expense::create(request()->all());

                    $lastNumId = DB::table('treasury_bill_dets')->where('treasury_type', 'مصروف')->max('num_order');
                    

                                                //dd($lastAmountOfTreasury);

                    DB::table('treasury_bill_dets')->insert([
                        'num_order' => ($lastNumId+1), 
                        'date' => Carbon::now(),
                        'treasury_id' => request('treasury'), 
                        'treasury_type' => 'مصروف', 
                        'bill_id' => $getId->id, 
                        'bill_type' => 'بدون', 
                        'client_supplier_id' => 0, 
                        'money' => ($lastAmountOfTreasury - request('amount')), 
                        'value' => request('amount'), 
                        'transaction_from' => null, 
                        'transaction_to' => null, 
                        'notes' => request('notes'), 
                        'user_id' => 1, 
                        'year_id' => $this->currentFinancialYear(),
                        'created_at' => now()
                    ]);

                });


            }



            //DB::transaction(function () {
            //    $getId = Expense::create(request()->all());  
                
            //    DB::table('clients_and_suppliers_dets')->insert([
            //        'treasury_id' => 0,
            //        'bill_type' => 'رصيد اول خزنة',
            //        'bill_id' => 0,
            //        'treasury_bill_head_id' => 0,
            //        'treasury_bill_body_id' => 0,
            //        'client_supplier_id' => $getId->id,
            //        'money' => request('moneyFirstDuration'),
            //        'year_id' => $this->currentFinancialYear(),
            //        'notes' => request('note'),
            //        'created_at' => now()
            //    ]);

            //});


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
                        ->select(
                            'treasury_bill_dets.*', 
                            'expenses.id as expenses_id',
                            'expenses.title',
                            'financial_treasuries.name as treasuryName',
                        )
                        ->orderBy('treasury_bill_dets.bill_id', 'ASC')
                        ->where('treasury_type', 'مصروف')
                        ->get();

        return DataTables::of($all)
            ->addColumn('treasury', function($res){
                return '<strong class="text-primary">'.$res->treasuryName.'</strong>';
            })
            ->addColumn('title', function($res){
                return '<span data-bs-toggle="popover" data-bs-placement="bottom" title="'.$res->title.'">
                            '.Str::limit($res->title, 30).'
                        </span>';
            })
            ->addColumn('money', function($res){
                return number_format($res->money);
            })
            ->addColumn('value', function($res){
                return '<strong style="color: red;font-size: 13px;">'.number_format($res->value).'</strong>';
            })
            ->addColumn('created_at', function($res){
                if($res->created_at){
                    return Carbon::parse($res->created_at)->format('Y-m-d')
                            .' <span style="font-weight: bold;margin: 0 7px;color: red;">'.Carbon::parse($res->created_at)->format('h:i:s a').'</span>';
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
            ->rawColumns(['user', 'treasury', 'title', 'money', 'value', 'created_at', 'notes', 'action'])
            ->toJson();
    }
}