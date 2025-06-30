<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\ProductCategoy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


class ProductCategoyController extends Controller
{
    public function index()
    {       
        if((userPermissions()->productsCategories_view)){
            $pageNameAr = 'الأقسام الرئيسية للأصناف';
            $pageNameEn = 'productsCategories';
            return view('back.productsCategories.index' , compact('pageNameAr' , 'pageNameEn'));
        }else{
            return redirect('/')->with(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        }                         
    }

    public function store(Request $request)
    {
        if((userPermissions()->productsCategories_create)){
            if (request()->ajax()){
                $this->validate($request , [
                    'name' => 'required|string|unique:product_categoys,name',
                ],[
                    'required' => 'حقل :attribute إلزامي.',
                    'string' => 'حقل :attribute يجب ان يكون من نوع نص.',
                    'unique' => 'حقل :attribute مستخدم من قبل.',
    
                ],[
                    'name' => 'إسم القسم',                
                ]);
    
                ProductCategoy::create($request->all());
            }

        }else{
            return response()->json(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        }
    }

    public function edit($id)
    {
        if((userPermissions()->productsCategories_update)){
            if(request()->ajax()){
                $find = ProductCategoy::where('id', $id)->first();
                return response()->json($find);
            }
            return view('back.welcome');

        }else{
            return response()->json(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        }
    }

    public function update(Request $request, $id)
    {
        if (request()->ajax()){
            $find = ProductCategoy::where('id', $id)->first();

            $this->validate($request , [
                'name' => 'required|string|unique:product_categoys,name,'.$id,
            ],[
                'required' => 'حقل :attribute إلزامي.',
                'string' => 'حقل :attribute يجب ان يكون من نوع نص.',
                'unique' => 'حقل :attribute مستخدم من قبل.',

            ],[
                'name' => 'إسم القسم',                
            ]);

            $find->update($request->all());
        }   
    }

     
    public function destroy($id){
        if((userPermissions()->productsCategories_delete)){
            $category = DB::table('products')->where('category', $id)->first();
    
            if ($category) {
                return response()->json(['cannot_delete' => 'cannot_delete']);
            }
    
            if (!$category) {
                DB::table('product_categoys')->where('id', $id)->delete();
                DB::table('product_sub_categories')->where('main_category', $id)->delete();
                return response()->json(['success_delete' => 'success_delete']);
            }
            
        }else{
            return response()->json(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        }
    }


    public function datatable()
    {
        $all = ProductCategoy::all();

        return DataTables::of($all)
            ->addColumn('name', function($res){
                return '<strong>'.$res->name.'</strong>';
            })
            ->addColumn('action', function($res){
                return '
                        <button type="button" class="btn btn-sm btn-outline-primary edit" data-effect="effect-scale" data-toggle="modal" href="#exampleModalCenter" data-placement="top" data-toggle="tooltip" title="تعديل" res_id="'.$res->id.'">
                            <i class="fas fa-marker"></i>
                        </button>

                        <button class="btn btn-sm btn-outline-danger delete" data-placement="top" data-toggle="tooltip" title="حذف" res_id="'.$res->id.'" category_name="'.$res->name.'">
                            <i class="fa fa-trash"></i>
                        </button>
                    ';
            })
            ->rawColumns(['name', 'action'])
            ->toJson();
    }
}