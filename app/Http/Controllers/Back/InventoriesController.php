<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Carbon\Carbon;

class InventoriesController extends Controller
{
    public function index()
    {         
        //if((userPermissions()->inventories_view)){
            $pageNameAr = 'إدارة الجرد';
            $pageNameEn = 'inventories';
            $users = DB::table('users')->where('status', 1)->orderBy('name', 'asc')->get();

            return view('back.inventories.index' , compact('pageNameAr' , 'pageNameEn', 'users'));
        //}else{
        //    return redirect('/')->with(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        //}  
                           
    }

    public function store(Request $request)
    {
        //if((userPermissions()->inventories_create)){
            if (request()->ajax()){
                $this->validate($request, [
                    'date' => 'nullable|date',
                    'supervisor_1' => 'required|integer|exists:users,id',
                    'supervisor_2' => 'nullable|integer|exists:users,id',
                    'supervisor_3' => 'nullable|integer|exists:users,id',
                    'notes' => 'nullable|string',
                ], [
                    'required' => 'حقل :attribute إلزامي.',
                    'integer' => 'حقل :attribute يجب أن يكون رقماً صحيحاً.',
                    'date' => 'حقل :attribute يجب أن يكون تاريخاً صالحاً.',
                    'in' => 'قيمة :attribute غير صالحة.',
                    'exists' => 'حقل :attribute غير موجود في قاعدة البيانات.',
                ], [
                    'date' => 'تاريخ الجرد',
                    'supervisor_1' => 'المشرف الأول',
                    'supervisor_2' => 'المشرف الثاني',
                    'supervisor_3' => 'المشرف الثالث',
                    'status' => 'الحالة',
                    'notes' => 'الملاحظات',
                ]);
            
                DB::table('inventories')->insert([
                    'date' => $request->date,
                    'supervisor_1' => $request->supervisor_1,
                    'supervisor_2' => $request->supervisor_2,
                    'supervisor_3' => $request->supervisor_3,
                    'status' => 'جاري الجرد',
                    'notes' => $request->notes,
                    'user_id' => auth()->id(),
                    'year_id' => $this->currentFinancialYear(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

        //}else{
        //    return response()->json(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        //}  
    }

    public function edit($id)
    {
        //if((userPermissions()->inventories_update)){
            if(request()->ajax()){
                $find = DB::table('inventories')->where('id', $id)->first();
                return response()->json($find);
            }
            return view('back.welcome');

        //}else{
        //    return response()->json(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        //}  
    }

    public function update_inventory(Request $request, $id)
    {
        if (request()->ajax()){
            $this->validate($request, [
                'date' => 'nullable|date',
                'supervisor_1' => 'required|integer|exists:users,id',
                'supervisor_2' => 'nullable|integer|exists:users,id',
                'supervisor_3' => 'nullable|integer|exists:users,id',
                'notes' => 'nullable|string',
            ], [
                'required' => 'حقل :attribute إلزامي.',
                'integer' => 'حقل :attribute يجب أن يكون رقماً صحيحاً.',
                'date' => 'حقل :attribute يجب أن يكون تاريخاً صالحاً.',
                'in' => 'قيمة :attribute غير صالحة.',
                'exists' => 'حقل :attribute غير موجود في قاعدة البيانات.',
            ], [
                'date' => 'تاريخ الجرد',
                'supervisor_1' => 'المشرف الأول',
                'supervisor_2' => 'المشرف الثاني',
                'supervisor_3' => 'المشرف الثالث',
                'status' => 'الحالة',
                'notes' => 'الملاحظات',
            ]);

            DB::table('inventories')->where('id', $id)->update([
                'date' => $request->date,
                'supervisor_1' => $request->supervisor_1,
                'supervisor_2' => $request->supervisor_2,
                'supervisor_3' => $request->supervisor_3,
                'status' => 'جاري الجرد',
                'notes' => $request->notes,
                'user_id' => auth()->id(),
                'year_id' => $this->currentFinancialYear(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }   
    }

    public function update(Request $request, $id)
    {
        if (request()->ajax()){
            $this->validate(request(), [
                'product_id.*' => 'exists:products,id',
                'current_quantity.*' => 'nullable|numeric'
            ]);

            DB::transaction(function() use($id, $request){
                $lastNumId = DB::table('store_dets')->where('type', 'تسوية جردية')->max('num_order');

                foreach( request('current_quantity') as $key => $value ){
                    $productRow = request('product_id')[$key];

                    $product = DB::table('store_dets')
                                    ->where('product_id', $productRow)
                                    ->orderBy('id', 'desc')
                                    ->first();
                                    
                    $lastProductInPurchaseBill = DB::table('store_dets')
                                                    ->where('product_id', $productRow)
                                                    ->where('type', 'اضافة فاتورة مشتريات')
                                                    ->orWhere('type', 'رصيد اول مدة للسلعة/خدمة')
                                                    ->orderBy('id', 'desc')
                                                    ->first();

                    if($value != '' || $value != null){
                        DB::table('store_dets')->insert([
                            'num_order' => ($lastNumId + 1),
                            'type' => 'تسوية جردية',
                            'year_id' => $this->currentFinancialYear(),
                            'bill_id' => $id,
                            'product_id' => $productRow,
                            'current_sell_price_in_sale_bill' => 0,                                            
                            'sell_price_small_unit' => $product->sell_price_small_unit,                                            
                            'last_cost_price_small_unit' => $product->last_cost_price_small_unit,
                            'avg_cost_price_small_unit' => $product->avg_cost_price_small_unit, 
                            'product_bill_quantity' => $product->quantity_small_unit,
                            'quantity_small_unit' => $value ?? 0,
                            'tax' => $lastProductInPurchaseBill->tax,
                            'discount' => $lastProductInPurchaseBill->discount,
                            'total_before' => 0,
                            'total_after' => 0,
                            'user_id' => auth()->user()->id,
                            'notes' => request('notes')[$key],
                            'created_at' => now()
                        ]);
                    }

                }
            });
        }   
    }

     
    public function close($id){
        //if((userPermissions()->inventories_delete)){
           
            DB::table('inventories')->where('id', $id)->update([
                'status' => 'تم الاعتماد',
                'close_date' => Carbon::now(),
            ]);

        //}else{
        //    return response()->json(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        //}  
    }
   
   
    public function destroy($id){
        //if((userPermissions()->inventories_delete)){
            
            $inventoryInStoreDets = DB::table('store_dets')->where('type' , 'تسوية جردية')->where('bill_id', $id)->first();
    
            if ($inventoryInStoreDets) {
                return response()->json(['cannot_delete' => 'cannot_delete']);
            }
    
            if (!$inventoryInStoreDets) {
                DB::table('inventories')->where('id', $id)->delete();
                return response()->json(['success_delete' => 'success_delete']);
            }

        //}else{
        //    return response()->json(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        //}  
    }


    public function datatable()
    {
        $all = DB::table('inventories')
                    ->leftJoin('users as s1', 's1.id', '=', 'inventories.supervisor_1')
                    ->leftJoin('users as s2', 's2.id', '=', 'inventories.supervisor_2')
                    ->leftJoin('users as s3', 's3.id', '=', 'inventories.supervisor_3')
                    ->leftJoin('users as u', 'u.id', '=', 'inventories.user_id')
                    ->leftJoin('financial_years', 'financial_years.id', '=', 'inventories.year_id')
                    ->select(
                        'inventories.*',

                        's1.name as supervisor_1Name',
                        's2.name as supervisor_2Name',
                        's3.name as supervisor_3Name',

                        'u.name as userName',
                        'financial_years.name as financialName'
                    )
                    ->get();

        return DataTables::of($all)
            ->addColumn('supervisor_1Name', fn($res) => $res->supervisor_1Name)
            ->addColumn('supervisor_2Name', fn($res) => $res->supervisor_2Name)
            ->addColumn('supervisor_3Name', fn($res) => $res->supervisor_3Name)
            ->addColumn('notes', function($res){
                return '<span data-bs-toggle="popover" data-bs-placement="bottom" title="'.$res->notes.'">
                            '.Str::limit($res->notes, 20).'
                        </span>';
            })
            ->addColumn('created_at', function($res){
                return Carbon::parse($res->created_at)->format('d-m-Y')
                        .' <span class="badge badge-dark text-white" style="margin: 0 7px;font-size: 100% !important;">'.Carbon::parse($res->created_at)->format('h:i:s a').'</span>';
            })
            ->addColumn('date', function($res){
                if($res->date){
                    return Carbon::parse($res->date)->format('d-m-Y');
                }else{
                    return '';
                }
            })
            ->addColumn('status', function($res){
                if($res->status == 'جاري الجرد'){
                    return '<span class="badge badge-warning text-white" style="font-size: 110%;">جاري الجرد</span>';

                }else if($res->status == 'تم الاعتماد'){
                    return '<span class="badge badge-success text-white" style="font-size: 110%;">تم الاعتماد</span>';
                    
                }
            })
            ->addColumn('action', function($res){
                $checkButtons = '';
                if($res->status == 'جاري الجرد'){
                    $checkButtons .= '                                    
                        <button class="btn btn-sm btn-danger delete" data-placement="top" data-toggle="tooltip" title="إلغاء الجرد" res_id="'.$res->id.'" >
                            <i class="fas fa-ban"></i>
                        </button>                                    
                        
                        <button type="button" class="btn btn-sm btn-warning close_inventory" data-effect="effect-scale" data-toggle="modal" href="#takeMoneyModal" data-placement="top" data-toggle="tooltip" title="اعتماد الجرد وإغلاقه" res_id="'.$res->id.'">
                            <i class="fas fa-lock"></i>
                        </button>
                        
                        <button type="button" class="btn btn-sm btn-primary edit" data-effect="effect-scale" data-toggle="modal" href="#exampleModalCenter" data-placement="top" data-toggle="tooltip" title="تعديل" res_id="'.$res->id.'">
                            <i class="fas fa-marker"></i>
                        </button>       

                        <a href="'.url('inventories/open/'.$res->id).'" class="btn btn-sm btn-success edit" data-placement="top" data-toggle="tooltip" title="بدء الجرد" res_id="'.$res->id.'">
                            <i class="fas fa-clipboard-list"></i>
                        </a>   
                        
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-purple dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 10px !important;">
                                <i class="fas fa-print"></i> طباعة / تقارير
                            </button>

                            <div class="dropdown-menu" style="background: #e7e4e4ff;">
                                <a href="'.url('inventories/print-count-only/'.$res->id).'" class="dropdown-item print" style="padding: 4px 6px !important;font-size: 10px;" res_id="'.$res->id.'">
                                    <i class="fas fa-print text-secondary"></i> ورقة العد (بدون أرصدة)
                                </a>

                                <a href="'.url('inventories/print-count-with-balance/'.$res->id).'" class="dropdown-item print" style="padding: 4px 6px !important;font-size: 10px;" res_id="'.$res->id.'">
                                    <i class="fas fa-file-alt text-purple"></i> ورقة العد (بالأرصدة الدفترية)
                                </a>
                            </div>
                        </div>
                    ';
                }else{
                    $checkButtons .= '
                        <a href="'.url('inventories/final-differences-report/'.$res->id).'" class="btn btn-sm btn-success print" data-placement="top" data-toggle="tooltip" title="تقرير الفروقات النهائي" res_id="'.$res->id.'" style="padding: 3px 10px;">
                            <i class="fas fa-chart-bar"></i> <span style="font-size: 10px !important;"> تقرير الفروقات النهائي</span>
                        </a>
                    ';

                }

                
                return $checkButtons;
            })
            ->rawColumns(['status', 'action', 'notes', 'created_at', 'date', 'supervisor_1Name', 'supervisor_2Name', 'supervisor_3Name'])
            ->toJson();
    }



    //#################### start طباعه اصناف الجرد + تقرير الفروقات النهائي ####################
    public function print_count_only($id)
    {                   

        $inventory_info = DB::table('inventories')
                            ->where('inventories.id', $id)
                            ->leftJoin('financial_years', 'financial_years.id', 'inventories.year_id')
                            ->leftJoin('users', 'users.id', 'inventories.user_id')
                            ->select(
                                'inventories.*', 
                                'financial_years.name as financialName',
                                'users.name as userName',
                            )
                            ->first();

        if(!$inventory_info){
            return redirect('/');

        }else{
            $pageNameAr = 'كشف جرد الأصناف – كشف العد الفعلي ( بدون أرصدة دفترية )';      
    
             $results = DB::table('products')
                            ->leftJoin('units as big_units', 'big_units.id', 'products.bigUnit')
                            ->leftJoin('units as small_units', 'small_units.id', 'products.smallUnit')
                            ->leftJoin('store_dets', function($join) {
                                $join->on('store_dets.product_id', '=', 'products.id')
                                    ->whereRaw('store_dets.id = (
                                        SELECT MAX(id) FROM store_dets WHERE store_dets.product_id = products.id
                                    )');
                            })
                            ->leftJoin('product_categoys', 'product_categoys.id', 'products.category')
                            ->leftJoin('product_sub_categories', 'product_sub_categories.id', 'products.sub_category')
                            ->leftJoin('stores', 'stores.id', 'products.store')
                            ->select(
                                'store_dets.sell_price_small_unit',
                                'store_dets.last_cost_price_small_unit',
                                'store_dets.avg_cost_price_small_unit',
                                'store_dets.quantity_small_unit',
                                
                                'products.id as productId',
                                'products.nameAr as productNameAr',
                                'products.status as productStatus',
    
                                'big_units.name as big_unit_name',
                                'small_units.name as small_unit_name',
                                
                                'product_categoys.name as category_name',                    
                                'product_sub_categories.name_sub_category',
                                
                                'stores.name as store_name'
                            )
                            ->where('products.status', 1)
                            ->orderBy('products.id', 'asc')
                            ->get();

                //dd($inventory_info);
    
            
            return view('back.inventories.print_count_only' , compact('pageNameAr', 'results', 'inventory_info'));
        }
    }
    
    
    public function print_count_with_balance($id)
    {                   
        $inventory_info = DB::table('inventories')
                            ->where('inventories.id', $id)
                            ->leftJoin('financial_years', 'financial_years.id', 'inventories.year_id')
                            ->leftJoin('users', 'users.id', 'inventories.user_id')
                            ->select(
                                'inventories.*', 
                                'financial_years.name as financialName',
                                'users.name as userName',
                            )
                            ->first();

        if(!$inventory_info){
            return redirect('/');

        }else{
            $pageNameAr = 'كشف جرد الأصناف – كشف العد الفعلي ( بالأرصدة الدفترية )';      
    
             $results = DB::table('products')
                            ->leftJoin('units as big_units', 'big_units.id', 'products.bigUnit')
                            ->leftJoin('units as small_units', 'small_units.id', 'products.smallUnit')
                            ->leftJoin('store_dets', function($join) {
                                $join->on('store_dets.product_id', '=', 'products.id')
                                    ->whereRaw('store_dets.id = (
                                        SELECT MAX(id) FROM store_dets WHERE store_dets.product_id = products.id
                                    )');
                            })
                            ->leftJoin('product_categoys', 'product_categoys.id', 'products.category')
                            ->leftJoin('product_sub_categories', 'product_sub_categories.id', 'products.sub_category')
                            ->leftJoin('stores', 'stores.id', 'products.store')
                            ->select(
                                'store_dets.sell_price_small_unit',
                                'store_dets.last_cost_price_small_unit',
                                'store_dets.avg_cost_price_small_unit',
                                'store_dets.quantity_small_unit',
                                
                                'products.id as productId',
                                'products.nameAr as productNameAr',
                                'products.status as productStatus',
    
                                'big_units.name as big_unit_name',
                                'small_units.name as small_unit_name',
                                
                                'product_categoys.name as category_name',                    
                                'product_sub_categories.name_sub_category',
                                
                                'stores.name as store_name'
                            )
                            ->where('products.status', 1)
                            ->orderBy('products.id', 'asc')
                            ->get();

                //return $results;
    
            
            return view('back.inventories.print_count_with_balance' , compact('pageNameAr', 'results', 'inventory_info'));
        }

    }
    
    
    public function final_differences_report($id)
    {               
        $inventory_info = DB::table('inventories')
                            ->where('inventories.id', $id)
                            ->leftJoin('financial_years', 'financial_years.id', 'inventories.year_id')
                            ->leftJoin('users', 'users.id', 'inventories.user_id')
                            ->select(
                                'inventories.*', 
                                'financial_years.name as financialName',
                                'users.name as userName',
                            )
                            ->first();

        if(!$inventory_info){
            return redirect('/');

        }else{
            $pageNameAr = 'تقرير الفروقات النهائي للجرد رقم';      
    
             $results = DB::table('products')
                            ->leftJoin('units as big_units', 'big_units.id', 'products.bigUnit')
                            ->leftJoin('units as small_units', 'small_units.id', 'products.smallUnit')
                            ->leftJoin('store_dets', function($join) {
                                $join->on('store_dets.product_id', '=', 'products.id')
                                    ->whereRaw('store_dets.id = (
                                        SELECT MAX(id) FROM store_dets WHERE store_dets.product_id = products.id
                                    )');
                            })
                            ->leftJoin('product_categoys', 'product_categoys.id', 'products.category')
                            ->leftJoin('product_sub_categories', 'product_sub_categories.id', 'products.sub_category')
                            ->leftJoin('stores', 'stores.id', 'products.store')
                            ->leftJoin('users', 'users.id', 'store_dets.user_id')
                            ->select(
                                'store_dets.sell_price_small_unit',
                                'store_dets.last_cost_price_small_unit',
                                'store_dets.avg_cost_price_small_unit',
                                'store_dets.quantity_small_unit',
                                'store_dets.product_bill_quantity',
                                'store_dets.notes',
                                
                                'products.id as productId',
                                'products.nameAr as productNameAr',
                                'products.status as productStatus',
    
                                'big_units.name as big_unit_name',
                                'small_units.name as small_unit_name',
                                
                                'product_categoys.name as category_name',                    
                                'product_sub_categories.name_sub_category',
                                
                                'stores.name as store_name',
                                'users.name as userName',
                            )
                            ->where('products.status', 1)
                            ->orderBy('products.id', 'asc')
                            ->get();

                //return $results;
    
            
            return view('back.inventories.final_differences_report' , compact('pageNameAr', 'results', 'inventory_info'));
        }

    }
    //#################### end طباعه اصناف الجرد + تقرير الفروقات النهائي ####################
    


    
    //#################### start بدء الجرد ####################
    public function open($id)
    {         
        $inventory_info = DB::table('inventories')
                            ->where('inventories.id', $id)
                            ->leftJoin('financial_years', 'financial_years.id', 'inventories.year_id')
                            ->leftJoin('users', 'users.id', 'inventories.user_id')
                            ->select(
                                'inventories.*', 
                                'financial_years.name as financialName',
                                'users.name as userName',
                            )
                            ->first();

        if(!$inventory_info){
            return redirect('/');
            
        }else{
            
            $pageNameAr = '🗂️ بداية عملية الجرد';      
            $pageNameEn = 'inventories/open';      
    
             $results = DB::table('products')
                            ->leftJoin('units as big_units', 'big_units.id', 'products.bigUnit')
                            ->leftJoin('units as small_units', 'small_units.id', 'products.smallUnit')
                            ->leftJoin('store_dets', function($join) {
                                $join->on('store_dets.product_id', '=', 'products.id')
                                    ->whereRaw('store_dets.id = (
                                        SELECT MAX(id) FROM store_dets WHERE store_dets.product_id = products.id
                                    )');
                            })
                            ->leftJoin('product_categoys', 'product_categoys.id', 'products.category')
                            ->leftJoin('product_sub_categories', 'product_sub_categories.id', 'products.sub_category')
                            ->leftJoin('stores', 'stores.id', 'products.store')
                            ->select(
                                'store_dets.sell_price_small_unit',
                                'store_dets.last_cost_price_small_unit',
                                'store_dets.avg_cost_price_small_unit',
                                'store_dets.product_bill_quantity',
                                'store_dets.quantity_small_unit',
                                
                                'products.id as productId',
                                'products.nameAr as productNameAr',
                                'products.status as productStatus',
    
                                'big_units.name as big_unit_name',
                                'small_units.name as small_unit_name',
                                
                                'product_categoys.name as category_name',                    
                                'product_sub_categories.name_sub_category',
                                
                                'stores.name as store_name'
                            )
                            ->where('products.status', 1)
                            ->orderBy('products.nameAr', 'asc')
                            ->get();



            $checkInventorybefore = DB::table('store_dets')
                                        ->where('type', 'تسوية جردية')
                                        ->where('bill_id', $id)
                                        ->select('product_id')
                                        ->get();

                            //return $checkInventorybefore;


            return view('back.inventories.open' , compact('pageNameAr' , 'pageNameEn', 'results', 'inventory_info', 'checkInventorybefore'));

        }

                           
    }
    //#################### end بدء الجرد ####################
}