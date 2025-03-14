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
        $lastId = $this->getNextId('products');

        return view('back.products.index' , compact('pageNameAr' , 'pageNameEn', 'stores', 'units', 'companys', 'productCategoys', 'lastId'));
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
                'sellPrice' => 'required|min:0|numeric',
                'purchasePrice' => 'required|min:0|numeric',
                'discountPercentage' => 'nullable|min:0|numeric',
                'tax' => 'nullable|min:0|numeric',
                'quantity' => 'nullable|min:0|numeric',
                'firstPeriodCount' => 'nullable|min:0|numeric',
                'store' => 'required|integer',
                'smallUnit' => 'required|integer',
                'smallUnitPrice' => 'required|min:0|numeric',
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
                'min' => 'حقل :attribute أقل قيمة له هي 0 حرف.',
                'max' => 'حقل :attribute أقصي قيمة له هي 255 حرف.',
                'date' => 'حقل :attribute يجب ان يكون من نوع تاريخ.',
                'mimes' => 'حقل :attribute الصيغ (jpeg, png, jpg, gif) المخصصة لها هي.',
                'before' => 'حقل :attribute يجب ان يسبق تاريخ نهاية العرض.',
                'after' => 'حقل :attribute يجب ان ياتي بعد تاريخ بداية العرض.',

            ],[
                'shortCode' => 'الكود المختصر',                
                'natCode' => 'الكود الدولي', 
                'nameAr' => 'إسم الصنف بالعربية',                
                'nameEn' => 'إسم الصنف بالإنجليزية',                
                'stockAlert' => 'الحد الأدني للطلب',
                'sellPrice' => 'سعر البيع',                
                'avgPrice' => 'متوسط سعر البيع',                
                'purchasePrice' => 'سعر الشراء',                
                'discountPercentage' => 'خصم نسبة',                
                'store' => 'المخزن',                
                'tax' => 'الضريبة',                
                'quantity' => 'الكمية',                
                'firstPeriodCount' => 'رصيد أول مدة',                
                'smallUnit' => 'الوحدة الصغري',                
                'smallUnitPrice' => 'سعر الوحدة الصغري',                
                'offerDiscountPercentage' => 'خصم نسبة العرض الترويجي',                
                'offerStart' => 'تاريخ بداية العرض الترويجي',                
                'offerEnd' => 'تاريخ نهاية العرض الترويجي',                
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

                $getProductId = Product::create([
                    'shortCode' => request('shortCode'),
                    'natCode' => request('natCode'),
                    'nameAr' => request('nameAr'),
                    'nameEn' => request('nameEn'),
                    'store' => request('store'),
                    'company' => request('company'),
                    'category' => request('category'),
                    'stockAlert' => request('stockAlert') == null ? 0 : request('stockAlert'),
                    'divisible' => $this->ifNullToZero('divisible'),
                    'sellPrice' => $this->ifNullToZero('sellPrice'),
                    'purchasePrice' => $this->ifNullToZero('purchasePrice'),
                    'discountPercentage' => $this->ifNullToZero('discountPercentage'),
                    'tax' => $this->ifNullToZero('tax'),
                    'firstPeriodCount' => $this->ifNullToZero('firstPeriodCount'),
                    'bigUnit' => $this->ifNullToZero('bigUnit'),
                    'smallUnit' => request('smallUnit'),
                    'smallUnitPrice' => request('smallUnitPrice'),
                    'smallUnitNumbers' => request('smallUnitNumbers'),
                    'max_sale_quantity' => $this->ifNullToZero('max_sale_quantity'),
                    'status' => request('status'),
                    'image' => $name,
                    'desc' => request('desc'),
                    'offerDiscountStatus' => '0',
                    'offerDiscountPercentage' => '',
                    //'offerStart' => request('offerStart') === null ? date('Y-m-d') : request('offerStart'),
                    //'offerEnd' => request('offerEnd') === null ? date('Y-m-d', strtotime(date('Y-m-d'). ' + 1 days')) : request('offerEnd'),
                ]);
                    
                StoreDets::insert([
                    'type' => 'رصيد اول',
                    'year_id' => $this->currentFinancialYear(),
                    'bill_head_id' => 0,
                    'bill_body_id' => 0,
                    'product_id' => $getProductId->id,
                    'product_num_unit' => 0,
                    'quantity' => $this->ifNullToZero('firstPeriodCount'),
                    'quantity_all' => $this->ifNullToZero('firstPeriodCount'),
                    'product_sellPrice' => $this->ifNullToZero('sellPrice'),
                    'product_purchasePrice' => $this->ifNullToZero('purchasePrice'),
                    'product_avg' => 0,
                    //'transfer_from' => '',
                    //'transfer_to' => '',
                    //'transfer_quantity' => '',
                    'date' => request('date') === null ? date('Y-m-d') : request('date'),
                    'created_at' => now()
                ]);                
            });
            // end db transaction to store 

            $lastId = $this->getNextId('products');            
            return response()->json(['lastId' => $lastId]);
            
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
                'shortCode' => 'nullable|unique:products,shortCode,'.$id,
                'natCode' => 'nullable|unique:products,natCode,'.$id,
                'nameAr' => 'required|string|unique:products,nameAr|max:255,'.$id,
                'nameEn' => 'nullable|string|unique:products,nameEn,'.$id,
                'stockAlert' => 'nullable|min:0|numeric',
                'sellPrice' => 'required|min:0|numeric',
                'purchasePrice' => 'required|min:0|numeric',
                'discountPercentage' => 'nullable|min:0|numeric',
                'tax' => 'nullable|min:0|numeric',
                'quantity' => 'nullable|min:0|numeric',
                'firstPeriodCount' => 'nullable|min:0|numeric',
                'store' => 'required|integer',
                'smallUnit' => 'required|integer',
                'smallUnitPrice' => 'required|min:0|numeric',
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
                'min' => 'حقل :attribute أقل قيمة له هي 0 حرف.',
                'max' => 'حقل :attribute أقصي قيمة له هي 255 حرف.',
                'date' => 'حقل :attribute يجب ان يكون من نوع تاريخ.',
                'mimes' => 'حقل :attribute الصيغ (jpeg, png, jpg, gif) المخصصة لها هي.',
                'before' => 'حقل :attribute يجب ان يسبق تاريخ نهاية العرض.',
                'after' => 'حقل :attribute يجب ان ياتي بعد تاريخ بداية العرض.',

            ],[
                'shortCode' => 'الكود المختصر',                
                'natCode' => 'الكود الدولي', 
                'nameAr' => 'إسم الصنف بالعربية',                
                'nameEn' => 'إسم الصنف بالإنجليزية',                
                'stockAlert' => 'الحد الأدني للطلب',
                'sellPrice' => 'سعر البيع',                
                'avgPrice' => 'متوسط سعر البيع',                
                'purchasePrice' => 'سعر الشراء',                
                'discountPercentage' => 'خصم نسبة',                
                'store' => 'المخزن',                
                'tax' => 'الضريبة',                
                'quantity' => 'الكمية',                
                'firstPeriodCount' => 'رصيد أول مدة',                
                'smallUnit' => 'الوحدة الصغري',                
                'smallUnitPrice' => 'سعر الوحدة الصغري',                
                'offerDiscountPercentage' => 'خصم نسبة العرض الترويجي',                
                'offerStart' => 'تاريخ بداية العرض الترويجي',                
                'offerEnd' => 'تاريخ نهاية العرض الترويجي',                
                'desc' => 'وصف الصنف',                
            ]);


            // start db transaction to store 
            DB::transaction(function() use($find) {
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

                $find->update([
                    'shortCode' => request('shortCode'),
                    'natCode' => request('natCode'),
                    'nameAr' => request('nameAr'),
                    'nameEn' => request('nameEn'),
                    'store' => request('store'),
                    'company' => request('company'),
                    'category' => request('category'),
                    'stockAlert' => request('stockAlert') == null ? 0 : request('stockAlert'),
                    'divisible' => $this->ifNullToZero('divisible'),
                    'sellPrice' => $this->ifNullToZero('sellPrice'),
                    'purchasePrice' => $this->ifNullToZero('purchasePrice'),
                    'discountPercentage' => $this->ifNullToZero('discountPercentage'),
                    'tax' => $this->ifNullToZero('tax'),
                    'firstPeriodCount' => $this->ifNullToZero('firstPeriodCount'),
                    'bigUnit' => $this->ifNullToZero('bigUnit'),
                    'smallUnit' => request('smallUnit'),
                    'smallUnitPrice' => request('smallUnitPrice'),
                    'smallUnitNumbers' => request('smallUnitNumbers'),
                    'max_sale_quantity' => $this->ifNullToZero('max_sale_quantity'),
                    'status' => request('status'),
                    'image' => $name,
                    'desc' => request('desc'),
                    'offerDiscountStatus' => '0',
                    'offerDiscountPercentage' => '',
                    //'offerStart' => request('offerStart') === null ? date('Y-m-d') : request('offerStart'),
                    //'offerEnd' => request('offerEnd') === null ? date('Y-m-d', strtotime(date('Y-m-d'). ' + 1 days')) : request('offerEnd'),
                ]);
                    
                //StoreDets::insert([
                //    'type' => 'رصيد اول',
                //    'year_id' => $this->currentFinancialYear(),
                //    'bill_head_id' => 0,
                //    'bill_body_id' => 0,
                //    'product_id' => $getProductId->id,
                //    'product_num_unit' => 0,
                //    'quantity' => $this->ifNullToZero('firstPeriodCount'),
                //    'quantity_all' => $this->ifNullToZero('firstPeriodCount'),
                //    'product_sellPrice' => $this->ifNullToZero('sellPrice'),
                //    'product_purchasePrice' => $this->ifNullToZero('purchasePrice'),
                //    'product_avg' => 0,
                //    //'transfer_from' => '',
                //    //'transfer_to' => '',
                //    //'transfer_quantity' => '',
                //    'date' => request('date') === null ? date('Y-m-d') : request('date'),
                //    'created_at' => now()
                //]);                
            });
            // end db transaction to store 

            $lastId = $this->getNextId('products');            
            return response()->json(['lastId' => $lastId]);

            
        }   
    }

     
    public function destroy($id)
    {
        
    }


    public function datatable()
    {
        $all = Product::leftJoin('units as big_units', 'big_units.id', 'products.bigUnit')
                ->leftJoin('units as small_units', 'small_units.id', 'products.smallUnit')
                ->leftJoin('product_categoys', 'product_categoys.id', 'products.category')
                ->leftJoin('stores', 'stores.id', 'products.store')
                ->select(
                    'products.*',
                    'big_units.name as big_unit_name',
                    'small_units.name as small_unit_name',
                    'product_categoys.name as category_name',
                    'stores.name as store_name'
                )
                ->get();

        return DataTables::of($all)
            ->addColumn('id', function($res){
                return '<strong>#'.$res->id.'</strong>';
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
            ->addColumn('sellPrice', function($res){
                return '<strong style="font-size: 14px;">'.number_format($res->sellPrice, 0, '', '.').'</strong>';
            })
            ->addColumn('purchasePrice', function($res){
                return number_format($res->purchasePrice, 0, '', '.');
            })
            ->addColumn('bigUnit', function($res){
                return $res->big_unit_name;
            })
            ->addColumn('smallUnit', function($res){
                return $res->small_unit_name;
            })
            ->addColumn('category', function($res){
                return $res->category_name;
            })
            ->addColumn('quantity', function($res){
                return '<strong>101</strong>';
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
                        <button type="button" class="btn btn-sm btn-outline-primary edit" data-effect="effect-scale" data-toggle="modal" href="#exampleModalCenter" data-placement="top" data-toggle="tooltip" title="تعديل" res_id="'.$res->id.'">
                            <i class="fas fa-marker"></i>
                        </button>
                    ';
                    //<button class="btn btn-sm btn-outline-danger delete" data-placement="top" data-toggle="tooltip" title="حذف" res_id="'.$res->id.'">
                    //    <i class="fa fa-trash"></i>
                    //</button>
            })
            ->rawColumns(['id', 'name', 'sellPrice', 'purchasePrice', 'bigUnit', 'smallUnit', 'category', 'quantity', 'image', 'status', 'action'])
            ->toJson();
    }
}