<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\Product;
use App\Models\Back\Units;
use App\Models\Back\Company;
use App\Models\Back\ProductCategoy;
use App\Models\Back\Store;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use App\Helpers\GetFinancialYearHelper;

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

                'stockAlert' => 'min:0|numeric',
                
                'sellPrice' => 'required|min:0|numeric',
                'avgPrice' => 'required|min:0|numeric',
                'purchasePrice' => 'required|min:0|numeric',
                'discountPercentage' => 'nullable|min:0|numeric',
                'tax' => 'nullable|min:0|numeric',
                'quantity' => 'nullable|min:0|numeric',
                'firstPeriodCount' => 'nullable|min:0|numeric',

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
                'stockAlert' => 'إسم الصنف بالإنجليزية',                
                
                'sellPrice' => 'سعر البيع',                
                'avgPrice' => 'متوسط سعر البيع',                
                'purchasePrice' => 'سعر الشراء',                
                'discountPercentage' => 'خصم نسبة',                
                'tax' => 'الضريبة',                
                'quantity' => 'الكمية',                
                'firstPeriodCount' => 'رصيد أول مدة',                
                'smallUnit' => 'الوحدة الصغري',                
                'smallUnitPrice' => 'سعر الوحدة الصغري',                
                'offerDiscountPercentage' => 'خصم نسبة العرض الترويجي',                
                'offerStart' => 'تاريخ بداية العرض الترويجي',                
                'offerEnd' => 'تاريخ نهاية العرض الترويجي',                
                'desc' => 'وصف الصنف',                
                'desc' => 'صورة الصنف',                
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