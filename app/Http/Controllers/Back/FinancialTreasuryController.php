<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\FinancialTreasury;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class FinancialTreasuryController extends Controller
{
    public function index()
    {                               
        $pageNameAr = 'الخزائن المالية';
        $pageNameEn = 'financial_treasury';
        return view('back.financial_treasury.index' , compact('pageNameAr' , 'pageNameEn'));
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        if (request()->ajax()){
            $this->validate($request , [
                'name' => 'required|string|unique:financial_treasuries,name',
                'moneyFirstDuration' => 'min:0|numeric',
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

            FinancialTreasury::create($request->all());
        }
    }

    public function edit($id)
    {
        if(request()->ajax()){
            $find = FinancialTreasury::where('id', $id)->first();
            return response()->json($find);
        }
        return view('back.welcome');
    }

    public function update(Request $request, $id)
    {
        if (request()->ajax()){
            $find = FinancialTreasury::where('id', $id)->first();

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

     
    public function destroy($id)
    {
        $find = FinancialTreasury::where('id', $id)->get();
        $find_relation = DB::table('treasury_bills_head')->where('financial_treasury_id', $id)->get();

        if(count($find_relation) > 0){
            return response()->json('');
        }else{
            DB::transaction(function($find, $find_relation){
                $find->delete();
                $find_relation->delete();
            });
        }
    }


    public function datatable()
    {
        $all = FinancialTreasury::orderBy('id', 'desc')->get();

        return DataTables::of($all)
            ->addColumn('name', function($res){
                return '<strong>'.$res->name.'</strong>';
            })
            ->addColumn('moneyFirstDuration', function($res){
                return '<strong style="font-size: 14px;">'.number_format($res->moneyFirstDuration).'</strong>';
            })
            ->addColumn('status', function($res){
                if($res->status == 1){
                    return '<span class="label text-success" style="position: relative;"><div class="dot-label bg-success ml-1" style="position: absolute;right: -17px;top: 7px;"></div>نشط</span>';
                }
                else{
                    return '<span class="label text-danger" style="position: relative;"><div class="dot-label bg-danger ml-1" style="position: absolute;right: -15px;top: 7px;"></div>معطل</span>';
                }
            })
            ->addColumn('action', function($res){
                return '
                        <button type="button" class="btn btn-sm btn-outline-primary edit" data-effect="effect-scale" data-toggle="modal" href="#exampleModalCenter" data-placement="top" data-toggle="tooltip" title="تعديل" res_id="'.$res->id.'">
                            <i class="fas fa-marker"></i>
                        </button>
                    ';
                    
                    //<button class="btn btn-sm btn-outline-danger delete" data-placement="top" data-toggle="tooltip" title="حذف" res_id="'.$res->id.'" res_title="'.$res->name.'">
                    //    <i class="fa fa-trash"></i>
                    //</button>
            })
            ->rawColumns(['name', 'moneyFirstDuration', 'status', 'action'])
            ->toJson();
    }
}