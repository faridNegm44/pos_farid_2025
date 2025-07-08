<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Back\ExtraExpense;

class ExtraExpensesController extends Controller
{
    public function index()
    {        
        //if((userPermissions()->extra_expenses_view)){
            $pageNameAr = 'المصاريف الإضافية علي الفواتير';
            $pageNameEn = 'extra_expenses';
            return view('back.extra_expenses.index' , compact('pageNameAr' , 'pageNameEn'));	
        //}else{
        //    return redirect('/')->with(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        //}  
                               
    }

    public function store(Request $request)
    {
        //if((userPermissions()->extra_expenses_create)){
            if (request()->ajax()){
                $this->validate($request , [
                    'expense_type' => 'required|string|unique:extra_expenses,expense_type',
                    'amount' => 'nullable|numeric',
                    'desc' => 'nullable|string|max:255',
                ],[
                    'required' => 'حقل :attribute إلزامي.',
                    'string' => 'حقل :attribute يجب ان يكون من نوع نص.',
                    'unique' => 'حقل :attribute مستخدم من قبل.',
                    'numeric' => 'حقل :attribute يجب ان يكون من نوع رقم.',
                    'max' => 'حقل :attribute يجب أن يكون أقل من أو يساوي :max.',
    
                ],[
                    'expense_type' => 'نوع المصروف',                
                    'amount' => 'سعر المصروف',                
                    'desc' => 'ملاحظات',                
                ]);
    
                ExtraExpense::create($request->all());
            }
        //}else{
        //    return response()->json(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        //}
    }

    public function edit($id)
    {
        //if((userPermissions()->extra_expenses_update)){
            if(request()->ajax()){
                $find = DB::table('extra_expenses')->where('id', $id)->first();
                return response()->json($find);
            }
            return view('back.welcome');
        //}else{
        //    return response()->json(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        //}
    }

    public function update(Request $request, $id)
    {
        if (request()->ajax()){
            $this->validate($request , [
                'expense_type' => 'required|string|unique:extra_expenses,expense_type,'.$id,
                'amount' => 'nullable|numeric',
                'desc' => 'nullable|string|max:255',
            ],[
                'required' => 'حقل :attribute إلزامي.',
                'string' => 'حقل :attribute يجب ان يكون من نوع نص.',
                'unique' => 'حقل :attribute مستخدم من قبل.',
                'numeric' => 'حقل :attribute يجب ان يكون من نوع رقم.',
                'max' => 'حقل :attribute يجب أن يكون أقل من أو يساوي :max.',

            ],[
                'expense_type' => 'نوع المصروف',                
                'amount' => 'سعر المصروف',                
                'desc' => 'ملاحظات',                
            ]);

            ExtraExpense::where('id', $id)->update($request->except(['_token']));
        }   
    }

    public function destroy($id){
        //if((userPermissions()->extra_expenses_delete)){
            //$store = DB::table('products')->where('store', $id)->first();
    
            //if ($store) {
            //    return response()->json(['cannot_delete' => 'cannot_delete']);
            //}
    
            //if (!$store) {
            //}
            DB::table('extra_expenses')->where('id', $id)->delete();
            return response()->json(['success_delete' => 'success_delete']);
        //}else{
        //    return response()->json(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        //}
    }
    
    public function datatable()
    {
        $all = DB::table('extra_expenses')->orderBy('id', 'DESC')->get();
        return DataTables::of($all)
        ->addColumn('amount', function($res){
            return '<span class="" style="font-size: 12px;">'.display_number($res->amount).'</span>';
        })
        ->addColumn('action', function($res){
            return '
                    <button type="button" class="btn btn-sm btn-outline-primary edit" data-effect="effect-scale" data-toggle="modal" href="#exampleModalCenter" data-placement="top" data-toggle="tooltip" title="تعديل" res_id="'.$res->id.'">
                        <i class="fas fa-marker"></i>
                    </button>

                    <button class="btn btn-sm btn-outline-danger delete" data-placement="top" data-toggle="tooltip" title="حذف" res_id="'.$res->id.'"  expense_type="'.$res->expense_type.'">
                        <i class="fa fa-trash"></i>
                    </button>
                ';
        })
        ->rawColumns(['amount', 'action'])
        ->toJson();
    }
}