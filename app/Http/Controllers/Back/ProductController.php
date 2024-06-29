<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\Product;
use App\Models\Back\Units;
use App\Models\Back\Company;
use App\Models\Back\ProductCategoy;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {                               
        $pageNameAr = 'الأصناف';
        $pageNameEn = 'products';

        $units = Units::all();
        $companys = Company::all();
        $productCategoys = ProductCategoy::all();
        return view('back.products.index' , compact('pageNameAr' , 'pageNameEn', 'units', 'companys', 'productCategoys'));
    }

    public function store(Request $request)
    {
        if (request()->ajax()){
            
            $this->validate($request , [
                'name' => 'required|string|unique:financial_years,name',
                'start' => 'required|date',
                'end' => 'required|date',
                'notes' => 'nullable|string|max:255',
            ],[
                'required' => 'حقل :attribute إلزامي.',
                'string' => 'حقل :attribute يجب ان يكون من نوع نص.',
                'unique' => 'حقل :attribute مستخدم من قبل.',
                'max' => 'حقل :attribute أقصي قيمة له هي 255 حرف.',
                'date' => 'حقل :attribute يجب ان يكون من نوع تاريخ.',

            ],[
                'name' => 'إسم السنة المالية',                
                'start' => 'تاريخ بداية السنة المالية',                
                'end' => 'تاريخ نهاية السنة المالية',                
                'notes' => 'الملاحظات',                
            ]);

            Product::create($request->all());



        } // end check request()->ajax()
    }

    public function edit($id)
    {
        if(request()->ajax()){
            $find = Product::where('id', $id)->first();
            return response()->json($find);
        }
        return view('back.welcome');
    }

    public function update(Request $request, $id)
    {
        if (request()->ajax()){
            $find = Product::where('id', $id)->first();

            $this->validate($request , [
                'name' => 'required|string|unique:Product,name,'.$id,
            ],[
                'required' => 'حقل :attribute إلزامي.',
                'string' => 'حقل :attribute يجب ان يكون من نوع نص.',
                'unique' => 'حقل :attribute مستخدم من قبل.',

            ],[
                'name' => 'إسم الشركة',                
            ]);

            $find->update($request->all());
        }   
    }

     
    public function destroy($id)
    {
        
    }


    public function datatable()
    {
        $all = Product::orderBy('id', 'DESC')->get();

        return DataTables::of($all)
            ->addColumn('name', function($res){
                return '<strong>'.$res->name.'</strong>';
            })
            ->addColumn('start', function($res){
                return '<strong>'.Carbon::parse($res->start)->format('Y-m-d').'</strong>';
            })
            ->addColumn('end', function($res){
                return '<strong>'.Carbon::parse($res->end)->format('Y-m-d').'</strong>';
            })
            ->addColumn('notes', function($res){
                return '<strong data-bs-toggle="tooltip" data-bs-placement="top" title="'.$res->notes.'">'.Str::words($res->notes, 10, ' ....').'</strong>';
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

                    <button class="btn btn-sm btn-outline-danger delete" data-placement="top" data-toggle="tooltip" title="حذف" res_id="'.$res->id.'">
                        <i class="fa fa-trash"></i>
                    </button>
                ';
            })
            ->rawColumns(['name', 'start', 'end', 'notes', 'status', 'action'])
            ->toJson();
    }
}