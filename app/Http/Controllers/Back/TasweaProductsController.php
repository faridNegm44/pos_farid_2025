<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\Product;
use App\Models\Back\TasweaProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Carbon\Carbon;

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
                'product_id' => 'required|integer|exists:products,id',
                'reason_id' => 'required|integer|exists:taswea_reasons,id',
                'quantity' => 'required|numeric|min:1',
            ],[
                'required' => 'حقل :attribute إلزامي.',
                'exists' => 'حقل :attribute غير موجود.',
                'integer' => 'حقل :attribute يجب ان يكون من نوع رقم.',
                'numeric' => 'حقل :attribute يجب ان يكون من نوع رقم.',
                'min' => 'حقل :attribute أقل قيمة له هي 1.',
            ],[
                'product_id' => 'الصنف',                
                'quantity' => 'الكمية',                
                'reason_id' => 'سبب التسوية',                
            ]);

            TasweaProducts::create([
                'product_id' => request('product_id'),
                'quantity' => request('quantity'),
                'reason_id' => request('reason_id'),
                'notes' => request('notes'),
            ]);
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
        $all = TasweaProducts::leftJoin('products', 'products.id', 'taswea_products.product_id')
                            ->leftJoin('taswea_reasons', 'taswea_reasons.id', 'taswea_products.reason_id')
                            ->leftJoin('store_dets', 'store_dets.product_id', 'taswea_products.product_id')
                            ->select(
                                'products.id as productId', 'products.nameAr as productName',
                                'taswea_products.quantity as quantityAfterEdit', 'taswea_products.notes as tasweaNotes', 'taswea_products.created_at as tasweaCreatedAt',
                                'taswea_reasons.name as reasonName',
                                'store_dets.quantity_all as quantityBefore',
                            )
                            ->get();

        return DataTables::of($all)
            ->addColumn('productId', function($res){
                return $res->productId;
            })
            ->addColumn('productName', function($res){
                return $res->productName;
            })
            ->addColumn('quantityBefore', function($res){
                return $res->quantityBefore;
            })
            ->addColumn('quantityAfterEdit', function($res){
                return $res->quantityAfterEdit;
            })
            ->addColumn('quantityAfter', function($res){
                if($res->quantityAfterEdit  > $res->quantityBefore){
                    return $res->quantityAfterEdit + $res->quantityBefore;
                }else{
                    return $res->quantityBefore - $res->quantityAfterEdit;
                }
            })
            ->addColumn('reasonName', function($res){
                return $res->reasonName;
            })
            ->addColumn('tasweaCreatedAt', function($res){
                return Carbon::parse($res->tasweaCreatedAt)->format('Y-m-d')
                            .' <span style="font-weight: bold;margin: 0 7px;color: red;">'.Carbon::parse($res->tasweaCreatedAt)->format('h:i:s a').'</span>';
            })
            ->addColumn('status', function($res){
                if($res->quantityAfterEdit  > $res->quantityBefore){
                    return '<span class="badge badge-success">
                        <i class="fa fa-plus"></i>
                    </span>';
                }else{
                    return '<span class="badge badge-danger">
                        <i class="fa fa-minus"></i>
                    </span>';
                }
            })
            ->addColumn('tasweaNotes', function($res){
                return '<span data-bs-toggle="popover" data-bs-placement="bottom" title="'.$res->tasweaNotes.'">
                            '.Str::limit($res->tasweaNotes, 20).'
                        </span>';
            })
            ->rawColumns(['productId', 'productName', 'quantityBefore', 'quantityAfterEdit', 'quantityAfter', 'reasonName', 'status', 'tasweaCreatedAt', 'tasweaNotes'])
            ->toJson();
    }
}