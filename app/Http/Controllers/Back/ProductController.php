<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\Product;
use App\Models\Back\Units;
use App\Models\Back\Company;
use App\Models\Back\ProductCategoy;
use App\Models\Back\StoreDets;
use App\Models\Back\Store;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use App\Helpers\GetFinancialYearHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {                      
        $pageNameAr = 'الأصناف';
        $pageNameEn = 'products';

        $stores = Store::all();
        $units = Units::all();
        $companys = Company::all();
        $productCategoys = ProductCategoy::all();

        return view('back.products.index' , compact('pageNameAr' , 'pageNameEn', 'stores', 'units', 'companys', 'productCategoys'));
    }

    public function store(Request $request)
    {
        if (request()->ajax()){
            $this->validate($request , [
                'shortCode' => 'nullable|unique:products,shortCode',
                'natCode' => 'nullable|unique:products,natCode',
                'nameAr' => 'required|string|unique:products,nameAr|max:255',
                'nameEn' => 'nullable|string|unique:products,nameEn',
                'stockAlert' => 'nullable|min:0|numeric',
                'discountPercentage' => 'nullable|min:0|numeric',
                'tax' => 'nullable|min:0|numeric',
                'firstPeriodCount' => 'nullable|min:0|numeric',
                'store' => 'required|integer|exists:stores,id',
                'category' => 'nullable|integer|exists:product_categoys,id',
                'company' => 'nullable|integer|exists:companies,id',
                'bigUnit' => 'nullable|integer|exists:units,id',
                'smallUnit' => 'required|integer|exists:units,id',
                'small_unit_numbers' => 'required|min:1|numeric',
                'last_cost_price_small_unit' => 'nullable|min:0|numeric',
                'sell_price_small_unit' => 'nullable|min:0|numeric',
                'max_sale_quantity' => 'nullable|min:0|numeric',
                'offerDiscountPercentage' => 'nullable|min:0|numeric',
                'offerStart' => 'nullable|date|before:offerEnd',
                'offerEnd' => 'nullable|date|after:offerStart',
                'image' => 'mimes:jpeg,png,jpg,gif|max:1500',
                'desc' => 'nullable|string|max:255',
            ],[
                'required' => 'حقل :attribute إلزامي.',
                'string' => 'حقل :attribute يجب ان يكون من نوع نص.',
                'numeric' => 'حقل :attribute يجب ان يكون من نوع رقم.',
                'integer' => 'حقل :attribute يجب ان يكون من نوع رقم.',
                'unique' => 'حقل :attribute مستخدم من قبل.',
                'min' => 'حقل :attribute يجب أن يكون أكبر من أو يساوي :min.',
                'max' => 'حقل :attribute يجب أن يكون أقل من أو يساوي :max.',
                'date' => 'حقل :attribute يجب ان يكون من نوع تاريخ.',
                'mimes' => 'حقل :attribute الصيغ (jpeg, png, jpg, gif) المخصصة لها هي.',
                'before' => 'حقل :attribute يجب ان يسبق تاريخ نهاية العرض.',
                'after' => 'حقل :attribute يجب ان ياتي بعد تاريخ بداية العرض.',
                'exists' => 'حقل :attribute غير موجود في قاعدة البيانات.',

            ],[
                'shortCode' => 'الكود المختصر',                
                'natCode' => 'الكود الدولي', 
                'nameAr' => 'إسم الصنف بالعربية',                
                'nameEn' => 'إسم الصنف بالإنجليزية',                
                'stockAlert' => 'الحد الأدني للطلب',
                'discountPercentage' => 'خصم نسبة',                
                'tax' => 'الضريبة',                
                'firstPeriodCount' => 'رصيد أول مدة',                
                'store' => 'المخزن',                
                'category' => 'قسم الصنف',                
                'company' => 'الشركة المصنعة',                
                'small_unit_numbers' => 'عدد وحدات الصغري',                
                'bigUnit' => 'الوحدة الكبري',                
                'smallUnit' => 'الوحدة الصغري',                
                'last_cost_price_small_unit' => 'س الشراء',                
                'sell_price_small_unit' => 'سعر البيع',       
                'max_sale_quantity' => 'أقصي كمية بيع',       
                'offerDiscountPercentage' => 'خصم نسبة العرض الترويجي',                
                'offerStart' => 'تاريخ بداية العرض الترويجي',                
                'offerEnd' => 'تاريخ نهاية العرض الترويجي',                
                'image' => 'صورة الصنف',                
                'desc' => 'وصف الصنف',                
            ]);


            // start db transaction to store 
            DB::transaction(function(){
                if(request('image') == ""){
                    $name = "df_image.png";
                }else{
                    $file = request('image');
                    $name = time() . '.' .$file->getClientOriginalExtension();
                    $path = public_path('back/images/products');
                    $file->move($path , $name);
                }

                $lastNumId = DB::table('store_dets')->where('type', 'رصيد اول مدة للصنف')->max('num_order');
                
                $getProductId = DB::table('products')->insertGetId([
                    'shortCode' => request('shortCode'),
                    'natCode' => request('natCode'),
                    'nameAr' => request('nameAr'),
                    'nameEn' => request('nameEn'),
                    'status' => request('status') ?? 1,
                    'store' => request('store'),
                    'category' => request('category'),
                    'company' => request('company'),
                    'firstPeriodCount' => request('firstPeriodCount') ?? 0,
                    'stockAlert' => request('stockAlert') == null ? 0 : request('stockAlert'),
                    'desc' => request('desc'),
                    'bigUnit' => $this->ifNullToZero('bigUnit'),
                    'smallUnit' => request('smallUnit'),
                    'small_unit_numbers' => request('small_unit_numbers'),
                    'tax' => $this->ifNullToZero('tax'),
                    'discountPercentage' => $this->ifNullToZero('discountPercentage'),
                    'max_sale_quantity' => $this->ifNullToZero('max_sale_quantity'),
                    'image' => $name,
                    'offerDiscountStatus' => 0,
                    'offerDiscountPercentage' => null,
                    //'offerStart' => request('offerStart') === null ? date('Y-m-d') : request('offerStart'),
                    //'offerEnd' => request('offerEnd') === null ? date('Y-m-d', strtotime(date('Y-m-d'). ' + 1 days')) : request('offerEnd'),
                ]);
                    
                StoreDets::insert([
                    'num_order' => ($lastNumId+1), 
                    'type' => 'رصيد اول مدة للصنف',
                    'year_id' => $this->currentFinancialYear(),
                    'bill_head_id' => 0,
                    'bill_body_id' => 0,
                    'product_id' => $getProductId,
                    'sell_price_small_unit' => request('sell_price_small_unit'),
                    'last_cost_price_small_unit' => request('last_cost_price_small_unit'),
                    'avg_cost_price_small_unit' => request('last_cost_price_small_unit'),
                    'current_qty_small_unit' => request('firstPeriodCount') ?? 0,
                    'transfer_from' => null,
                    'transfer_to' => null,
                    'transfer_quantity' => null,
                    'date' => request('date') === null ? date('Y-m-d') : request('date'),
                    'created_at' => now()
                ]);                
            });
            // end db transaction to store 
            
        } // end check request()->ajax()
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $product = Product::leftJoin('store_dets', 'store_dets.product_id', 'products.id')
                            ->where('products.id', $id)
                            ->select(
                                'products.*',
                                'store_dets.*', 
                                'store_dets.id as storeDetsId'
                            )
                            ->orderBy('store_dets.id', 'desc')
                            ->first();

            if (!$product) {
                return response()->json(['error' => 'الصنف غير موجود'], 404);
            }

            $countRowsToProduct = DB::table('store_dets')->where('product_id', $id)->count();

            if ($countRowsToProduct > 1) {
                return response()->json([
                    'countBigThanOne' => true,
                    'message' => 'لا يمكن تعديل عدد وحدات الصنف الصغري أو رصيد أول المدة للصنف بسبب وجود حركات سابقة تمت علي الصنف',
                    'product' => $product
                ]);
            } else {
                return response()->json(['product' => $product]);
            }
        }

        return view('back.welcome');
    }

    public function update(Request $request, $id)
    {
        if (request()->ajax()){
            $find = Product::where('id', $id)->first();

            $this->validate($request , [
                'shortCode' => 'nullable|unique:products,shortCode,'.$id,
                'natCode' => 'nullable|unique:products,natCode,'.$id,
                'nameAr' => 'required|string|max:255|unique:products,nameAr,'.$id,
                'nameEn' => 'nullable|string|unique:products,nameEn,'.$id,
                'stockAlert' => 'nullable|min:0|numeric',
                'discountPercentage' => 'nullable|min:0|numeric',
                'tax' => 'nullable|min:0|numeric',
                'firstPeriodCount' => 'nullable|min:0|numeric',
                'store' => 'required|integer|exists:stores,id',
                'category' => 'nullable|integer|exists:product_categoys,id',
                'company' => 'nullable|integer|exists:companies,id',
                'bigUnit' => 'nullable|integer|exists:units,id',
                'smallUnit' => 'required|integer|exists:units,id',
                'small_unit_numbers' => 'required|min:1|numeric',
                'last_cost_price_small_unit' => 'nullable|min:0|numeric',
                'sell_price_small_unit' => 'nullable|min:0|numeric',
                'max_sale_quantity' => 'nullable|min:0|numeric',
                'offerDiscountPercentage' => 'nullable|min:0|numeric',
                'offerStart' => 'nullable|date|before:offerEnd',
                'offerEnd' => 'nullable|date|after:offerStart',
                'image' => 'mimes:jpeg,png,jpg,gif|max:1500',
                'desc' => 'nullable|string|max:255',
            ],[
                'required' => 'حقل :attribute إلزامي.',
                'string' => 'حقل :attribute يجب ان يكون من نوع نص.',
                'numeric' => 'حقل :attribute يجب ان يكون من نوع رقم.',
                'integer' => 'حقل :attribute يجب ان يكون من نوع رقم.',
                'unique' => 'حقل :attribute مستخدم من قبل.',
                'min' => 'حقل :attribute يجب أن يكون أكبر من أو يساوي :min.',
                'max' => 'حقل :attribute يجب أن يكون أقل من أو يساوي :max.',
                'date' => 'حقل :attribute يجب ان يكون من نوع تاريخ.',
                'mimes' => 'حقل :attribute الصيغ (jpeg, png, jpg, gif) المخصصة لها هي.',
                'before' => 'حقل :attribute يجب ان يسبق تاريخ نهاية العرض.',
                'after' => 'حقل :attribute يجب ان ياتي بعد تاريخ بداية العرض.',
                'exists' => 'حقل :attribute غير موجود في قاعدة البيانات.',

            ],[
                'shortCode' => 'الكود المختصر',                
                'natCode' => 'الكود الدولي', 
                'nameAr' => 'إسم الصنف بالعربية',                
                'nameEn' => 'إسم الصنف بالإنجليزية',                
                'stockAlert' => 'الحد الأدني للطلب',
                'discountPercentage' => 'خصم نسبة',                
                'tax' => 'الضريبة',                
                'firstPeriodCount' => 'رصيد أول مدة',                
                'store' => 'المخزن',                
                'category' => 'قسم الصنف',                
                'company' => 'الشركة المصنعة',                
                'small_unit_numbers' => 'عدد وحدات الصغري',                
                'bigUnit' => 'الوحدة الكبري',                
                'smallUnit' => 'الوحدة الصغري',                
                'last_cost_price_small_unit' => 'س الشراء',                
                'sell_price_small_unit' => 'سعر البيع',       
                'max_sale_quantity' => 'أقصي كمية بيع',       
                'offerDiscountPercentage' => 'خصم نسبة العرض الترويجي',                
                'offerStart' => 'تاريخ بداية العرض الترويجي',                
                'offerEnd' => 'تاريخ نهاية العرض الترويجي',                
                'image' => 'صورة الصنف',                
                'desc' => 'وصف الصنف',                
            ]);

            // start db transaction to store 
            DB::transaction(function() use($find, $id) {
                if(request('image') == ""){
                    $name = $find['image'];
                }else{
                    $file = request('image');
                    $name = time() . '.' .$file->getClientOriginalExtension();
                    $path = public_path('back/images/products');
                    $file->move($path , $name);

                    if(request("image_hidden") != "df_image.png"){
                        File::delete(public_path('back/images/products/'.$find['image']));
                    }
                }

                $product = Product::leftJoin('store_dets', 'store_dets.product_id', 'products.id')
                            ->where('products.id', $id)
                            ->select(
                                'products.*',
                                'store_dets.*', 
                                'store_dets.id as storeDetsId'
                            )
                            ->orderBy('store_dets.id', 'desc')
                            ->first();
                            
                if (!$product) {
                    return response()->json(['error' => 'الصنف غير موجود'], 404);
                }

                $countRowsToProduct = DB::table('store_dets')->where('product_id', $id)->count();

                if ($countRowsToProduct > 1) {
                    Product::where('id', $id)->update([
                        'shortCode' => request('shortCode'),
                        'natCode' => request('natCode'),
                        'nameAr' => request('nameAr'),
                        'nameEn' => request('nameEn'),
                        'status' => request('status') ?? 1,
                        'store' => request('store'),
                        'category' => request('category'),
                        'company' => request('company'),
                        'stockAlert' => request('stockAlert') == null ? 0 : request('stockAlert'),
                        'desc' => request('desc'),
                        'bigUnit' => $this->ifNullToZero('bigUnit'),
                        'smallUnit' => request('smallUnit'),
                        'tax' => $this->ifNullToZero('tax'),
                        'discountPercentage' => $this->ifNullToZero('discountPercentage'),
                        'max_sale_quantity' => $this->ifNullToZero('max_sale_quantity'),
                        'image' => $name,
                        'offerDiscountStatus' => 0,
                        'offerDiscountPercentage' => null,
                        'updated_at' => now(),
                        //'offerStart' => request('offerStart') === null ? date('Y-m-d') : request('offerStart'),
                        //'offerEnd' => request('offerEnd') === null ? date('Y-m-d', strtotime(date('Y-m-d'). ' + 1 days')) : request('offerEnd'),
                    ]);

                } else {
                    Product::where('id', $id)->update([
                        'shortCode' => request('shortCode'),
                        'natCode' => request('natCode'),
                        'nameAr' => request('nameAr'),
                        'nameEn' => request('nameEn'),
                        'status' => request('status') ?? 1,
                        'store' => request('store'),
                        'category' => request('category'),
                        'company' => request('company'),
                        'firstPeriodCount' => request('firstPeriodCount') ?? 0,
                        'stockAlert' => request('stockAlert') == null ? 0 : request('stockAlert'),
                        'desc' => request('desc'),
                        'bigUnit' => $this->ifNullToZero('bigUnit'),
                        'smallUnit' => request('smallUnit'),
                        'small_unit_numbers' => request('small_unit_numbers'),
                        'tax' => $this->ifNullToZero('tax'),
                        'discountPercentage' => $this->ifNullToZero('discountPercentage'),
                        'max_sale_quantity' => $this->ifNullToZero('max_sale_quantity'),
                        'image' => $name,
                        'offerDiscountStatus' => 0,
                        'offerDiscountPercentage' => null,
                        'updated_at' => now(),
                        //'offerStart' => request('offerStart') === null ? date('Y-m-d') : request('offerStart'),
                        //'offerEnd' => request('offerEnd') === null ? date('Y-m-d', strtotime(date('Y-m-d'). ' + 1 days')) : request('offerEnd'),
                    ]);

                    StoreDets::where('product_id', $find->id)->update([
                        'sell_price_small_unit' => request('sell_price_small_unit'),
                        'last_cost_price_small_unit' => request('last_cost_price_small_unit'),
                        'avg_cost_price_small_unit' => request('last_cost_price_small_unit'),
                        'current_qty_small_unit' => request('firstPeriodCount') ?? 0,
                        'transfer_quantity' => null,
                        'date' => request('date') === null ? date('Y-m-d') : request('date'),
                        'updated_at' => now()
                    ]);  
                }
            });
            // end db transaction to store 
            
        }   
    }


    public function datatable()
    {
        $all = Product::leftJoin('units as big_units', 'big_units.id', 'products.bigUnit')
                ->leftJoin('store_dets', function($join) {
                    $join->on('store_dets.product_id', '=', 'products.id')
                         ->whereRaw('store_dets.id = (
                             SELECT MAX(id) FROM store_dets WHERE store_dets.product_id = products.id
                         )');
                })
                ->leftJoin('units as small_units', 'small_units.id', 'products.smallUnit')
                ->leftJoin('product_categoys', 'product_categoys.id', 'products.category')
                ->leftJoin('stores', 'stores.id', 'products.store')
                ->select(
                    'products.*', 'products.id as productId',
                    'store_dets.*', 'store_dets.id as storeDetsId',
                    'big_units.name as big_unit_name',
                    'small_units.name as small_unit_name',
                    'product_categoys.name as category_name',
                    'stores.name as store_name'
                )
                ->get();

        return DataTables::of($all)
            ->addColumn('id', function($res){
                return '<strong>#'.$res->productId.'</strong>';
            })
            ->addColumn('name', function($res){
                $names = "<div>
                            <span>الإسم عربي: </span>
                            <span style='margin: 0px 5px;'>"
                                .$res->nameAr.
                            "</span>
                        </div>"; 
                        
                if($res->nameEn){
                    $names .= "<div>
                                <span>الإسم انجليزي: </span>
                                <span style='margin: 0px 5px;'>"
                                    .$res->nameEn.
                                "</span>
                            </div>"; 
                }        
                
                return $names;
            })
            ->addColumn('sell_price_small_unit', function($res){
                return '<strong style="font-size: 14px;">'.display_number($res->sell_price_small_unit).'</strong>';
            })
            ->addColumn('last_cost_price_small_unit', function($res){
                return display_number($res->last_cost_price_small_unit);
            })
            ->addColumn('units', function($res){
                $units = "<div>
                            <span>ص: </span>
                            <span style='margin: 0px 5px;'>"
                                .$res->small_unit_name. ' [ ' .display_number($res->small_unit_numbers). ' ]'.
                            "</span>
                        </div>"; 
                        
                if($res->big_unit_name){
                    $units .= "<div>
                                <span>ك: </span>
                                <span style='margin: 0px 5px;'>"
                                    .$res->big_unit_name.
                                "</span>
                            </div>"; 
                }        
                
                return $units;
            })
            ->addColumn('category', function($res){
                return $res->category_name;
            })
            ->addColumn('current_qty_small_unit', function($res){
                return '<strong>'.display_number($res->current_qty_small_unit).'</strong>';
            })
            ->addColumn('image', function($res){
                return '
                    <a class="spotlight" title="'.$res->nameAr.'" href="'.url('back/images/products/'.$res->image).'">
                        <img src="'.url('back/images/products/'.$res->image).'" alt="'.$res->nameAr.'" style="width: 25px;height: 25px;border-radius: 5px;margin: 0px auto;display: block;">
                    </a>
                ';
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
                        <button type="button" class="btn btn-sm btn-outline-primary edit" data-effect="effect-scale" data-toggle="modal" href="#exampleModalCenter" data-placement="top" data-toggle="tooltip" title="تعديل" res_id="'.$res->productId.'">
                            <i class="fas fa-marker"></i>
                        </button>
                    ';
                    //<button class="btn btn-sm btn-outline-danger delete" data-placement="top" data-toggle="tooltip" title="حذف" res_id="'.$res->productId.'">
                    //    <i class="fa fa-trash"></i>
                    //</button>
            })
            ->rawColumns(['id', 'name', 'sell_price_small_unit', 'last_cost_price_small_unit', 'units', 'category', 'current_qty_small_unit', 'image', 'status', 'action'])
            ->toJson();
    }
}