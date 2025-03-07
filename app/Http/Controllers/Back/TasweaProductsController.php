<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\Product;
use App\Models\Back\TasweaProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


class TasweaProductsController extends Controller
{
    public function index()
    {                               
        $pageNameAr = 'تسوية كميات الأصناف';
        $pageNameEn = 'taswea_products';
        $products = Product::all();
        $taswea_reasons = DB::table('taswea_reasons')->get();

        return view('back.taswea_products.index' , compact('pageNameAr' , 'pageNameEn', 'products', 'taswea_reasons'));
    }

    public function store(Request $request)
    {
        if (request()->ajax()){
            $this->validate($request , [
                'name' => 'required|string|unique:taswea_products,name',
            ],[
                'required' => 'حقل :attribute إلزامي.',
                'string' => 'حقل :attribute يجب ان يكون من نوع نص.',
                'unique' => 'حقل :attribute مستخدم من قبل.',

            ],[
                'name' => 'إسم القسم',                
            ]);

            TasweaProducts::create($request->all());
        }
    }

    public function getCurrentProductQuantity($id)
    {
        if(request()->ajax()){
            $find = DB::table('store_dets')->where('product_id', $id)->select('quantity_all')->orderBy('id', 'desc')->first();
            //dd($find->quantity_all);
            return response()->json($find);
        }
        return view('back.welcome');
    }
    
    public function edit($id)
    {
        if(request()->ajax()){
            $find = TasweaProducts::where('id', $id)->first();
            return response()->json($find);
        }
        return view('back.welcome');
    }

    public function update(Request $request, $id)
    {
        if (request()->ajax()){
            $find = TasweaProducts::where('id', $id)->first();

            $this->validate($request , [
                'name' => 'required|string|unique:taswea_products,name,'.$id,
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

    public function datatable()
    {
        $all = TasweaProducts::all();

        return DataTables::of($all)
            ->addColumn('name', function($res){
                return '<strong>'.$res->name.'</strong>';
            })
            ->addColumn('action', function($res){
                return '
                        <button type="button" class="btn btn-sm btn-outline-primary edit" data-effect="effect-scale" data-toggle="modal" href="#exampleModalCenter" data-placement="top" data-toggle="tooltip" title="تعديل" res_id="'.$res->id.'">
                            <i class="fas fa-marker"></i>
                        </button>
                    ';
                    //<button class="btn btn-sm btn-outline-danger delete" data-placement="top" data-toggle="tooltip" title="حذف" res_id="'.$res->id.'">
                    //    <i class="fa fa-trash"></i>
                    //</button>
            })
            ->rawColumns(['name', 'action'])
            ->toJson();
    }
}