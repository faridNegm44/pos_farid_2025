<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\ProductCategoy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


class ProductSubCategoyController extends Controller
{
    public function index()
    {                               
        $pageNameAr = 'الأقسام الفرعية للأصناف';
        $pageNameEn = 'products_sub_category';
        $main_categories = DB::table('product_categoys')->get();

        return view('back.products_sub_category.index' , compact('pageNameAr' , 'pageNameEn', 'main_categories'));
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        if (request()->ajax()){
            $this->validate($request , [
                'main_category' => 'required|integer|exists:product_categoys,id',
                'name_sub_category' => 'required|string|unique:product_sub_categories,name_sub_category',
            ],[
                'required' => 'حقل :attribute إلزامي.',
                'string' => 'حقل :attribute يجب ان يكون من نوع نص.',
                'unique' => 'حقل :attribute مستخدم من قبل.',
                'exists' => 'القيمة المحددة في حقل :attribute غير موجودة في السجلات.',

            ],[
                'main_category' => 'القسم الرئيسي للصنف',                
                'name_sub_category' => 'إسم القسم الفرعي',                
            ]);

            DB::table('product_sub_categories')->insert([
                'main_category' => request('main_category'),
                'name_sub_category' => request('name_sub_category'),
            ]);
        }
    }

    public function edit($id){
        if(request()->ajax()){
            $find = DB::table('product_sub_categories')->where('id', $id)->first();
            return response()->json($find);
        }
        return view('back.welcome');
    }

    public function update(Request $request, $id){
        if (request()->ajax()){
            $this->validate($request , [
                'main_category' => 'required|integer|exists:product_categoys,id',
                'name_sub_category' => 'required|string|unique:product_sub_categories,name_sub_category,'.$id,
            ],[
                'required' => 'حقل :attribute إلزامي.',
                'string' => 'حقل :attribute يجب ان يكون من نوع نص.',
                'unique' => 'حقل :attribute مستخدم من قبل.',
                'exists' => 'القيمة المحددة في حقل :attribute غير موجودة في السجلات.',

            ],[
                'main_category' => 'القسم الرئيسي للصنف',                
                'name_sub_category' => 'إسم القسم الفرعي',          
            ]);

            DB::table('product_sub_categories')->where('id', $id)->update([
                'main_category' => request('main_category'),
                'name_sub_category' => request('name_sub_category'),
            ]);
        }   
    }

     
    public function destroy($id){
        $category = DB::table('products')->where('sub_category', $id)->first();

        if ($category) {
            return response()->json(['cannot_delete' => 'cannot_delete']);
        }

        if (!$category) {
            DB::table('product_sub_categories')->where('id', $id)->delete();
            return response()->json(['success_delete' => 'success_delete']);
        }
    }


    public function datatable()
    {
        $all = DB::table('product_sub_categories')
                ->leftJoin('product_categoys', 'product_categoys.id', 'product_sub_categories.main_category')
                ->select(
                    'product_sub_categories.*',
                    'product_categoys.name as main_category_name'
                )
                ->get();

        return DataTables::of($all)
            ->addColumn('main_category_name', function($res){
                return '<strong>'.$res->main_category_name.'</strong>';
            })
            ->addColumn('name_sub_category', function($res){
                return '<strong>'.$res->name_sub_category.'</strong>';
            })
            ->addColumn('action', function($res){
                return '
                        <button type="button" class="btn btn-sm btn-outline-primary edit" data-effect="effect-scale" data-toggle="modal" href="#exampleModalCenter" data-placement="top" data-toggle="tooltip" title="تعديل" res_id="'.$res->id.'">
                            <i class="fas fa-marker"></i>
                        </button>

                        <button class="btn btn-sm btn-outline-danger delete" data-placement="top" data-toggle="tooltip" title="حذف" res_id="'.$res->id.'" category_name="'.$res->name_sub_category.'">
                            <i class="fa fa-trash"></i>
                        </button>
                    ';
            })
            ->rawColumns(['name_sub_category', 'main_category_name', 'action'])
            ->toJson();
    }
}