<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\ClientsAndSuppliers;
use App\Models\Back\FinancialTreasury;
use App\Models\Back\PurchaseBill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PurchaseBillController extends Controller
{
    public function index()
    {             
        $pageNameAr = 'فواتير المشتريات';
        $pageNameEn = 'purchases';

        return view('back.purchases.index' , compact('pageNameAr' , 'pageNameEn'));
    }

    public function create()
    {                               
        $pageNameAr = 'فاتورة مشتريات # ';
        $pageNameEn = 'purchases_create';
        $suppliers = ClientsAndSuppliers::where('client_supplier_type', 1)
                                    ->orWhere('client_supplier_type', 2)
                                    ->orderBy('name', 'asc')
                                    ->get();

        $treasuries = FinancialTreasury::where('status', 1)
                                    ->leftJoin('treasury_bill_dets', function ($join) {
                                        $join->on('treasury_bill_dets.treasury_id', '=', 'financial_treasuries.id')
                                            ->whereRaw('treasury_bill_dets.id = (select max(id) from treasury_bill_dets where treasury_bill_dets.treasury_id = financial_treasuries.id)');
                                    })
                                    ->select('financial_treasuries.*', 'treasury_bill_dets.treasury_money_after')
                                    ->get();
        $lastBillNum = DB::table('purchase_bills')->max('id');
    
        return view('back.purchases.create' , compact('pageNameAr' , 'pageNameEn', 'suppliers', 'treasuries', 'lastBillNum'));
    }

    public function store(Request $request)
    {
        if (request()->ajax()){

            //dd( request()->all() );
            $this->validate($request, [
                'supplier_id' => 'required|integer|exists:clients_and_suppliers,id',
                'financial_treasuries' => 'nullable|integer|exists:financial_treasuries,id',
                'custom_bill_num' => 'nullable|string',
                
                'custom_date' => 'nullable|date',
                'discount_bill' => 'nullable|numeric|min:0',

                'product_new_qty' => 'array',
                'product_new_qty.*' => 'integer|min:1',
                
                'purchasePrice' => 'array',
                'purchasePrice.*' => 'numeric|min:1',
                
                'sellPrice' => 'array',
                'sellPrice.*' => 'numeric|min:1',
                
                'prod_tax' => 'array',
                'prod_tax.*' => 'nullable|numeric|min:0',
                
                'prod_discount' => 'array',
                'prod_discount.*' => 'nullable|numeric|min:0',
                
                //'prod_bonus' => 'array',
                //'prod_bonus.*' => 'nullable|numeric|min:0',
            ], [
                'required' => 'يجب تعبئة حقل :attribute، لا يمكن تركه فارغًا.',
                'string' => 'يجب أن يكون حقل :attribute عبارة عن نص.',
                'unique' => 'حقل :attribute مُستخدم مسبقًا، الرجاء اختيار قيمة مختلفة.',
                'integer' => 'يجب أن يكون حقل :attribute رقمًا صحيحًا (بدون كسور).',
                'numeric' => 'يجب أن يحتوي حقل :attribute على رقم صحيح أو عشري.',
                'min' => 'يجب ألا تكون قيمة :attribute أقل من :min.',
                'exists' => 'القيمة المحددة في حقل :attribute غير موجودة في السجلات.',
                'array' => 'يجب أن يكون حقل :attribute عبارة عن مجموعة عناصر.',
            ], [
                'supplier_id' => 'المورد',
                'financial_treasuries' => 'الخزينة المالية',
                'custom_bill_num' => 'رقم الفاتورة المخصص',
                'custom_date' => 'تاريخ الفاتورة',
                'discount_bill' => 'الخصم العام على الفاتورة',
                'sale_quantity' => 'كميات المنتجات',
                'sale_quantity.*' => 'الكمية لكل منتج',
                'purchasePrice' => 'أسعار الشراء',
                'purchasePrice.*' => 'سعر الشراء لكل منتج',
                'sellPrice' => 'أسعار البيع',
                'sellPrice.*' => 'سعر البيع لكل منتج',
                'prod_tax' => 'ضرائب المنتجات',
                'prod_tax.*' => 'نسبة الضريبة على المنتج',
                'prod_discount' => 'خصومات المنتجات',
                'prod_discount.*' => 'قيمة الخصم على المنتج',
                //'prod_bonus.*' => 'بونص المنتج',
            ]);



            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            // بدايه العمليات الحسابيه الخاصه بكل منتج سواء سعر بيعه او عدد البيع او الضريبه وكذاله اجمالي سعر المنتجات كلها قبل وبعد الخصم
            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

            $calcTotalProductsBefore = 0; // مخصص لتجميع سعر كل منتج قبل الخصم والضريبه ودمج كل الاسعار في سعر واحد 
            $calcTotalProductsAfterBeforeFinal = 0; // مخصص لتجميع سعر كل منتج بعد الخصم والضريبه ودمجكل الاسعار في سعر واحد قبل خصم الفاتوره ومصاريف اضافيه للفاتوره وضريبه الفاتورة
            $calcTotalProductsAfter = 0; // مخصص لتجميع سعر كل منتج بعد الخصم والضريبه ودمجكل الاسعار في سعر واحد 
        
            $discount_bill = request('discount_bill'); // مخصص لخصم قيمه علي الفاتوره كلها

            foreach( request('prod_name')  as $index => $product_id ){
                $lastProductQuantity = DB::table('store_dets')
                            ->where('product_id', $product_id)
                            ->orderBy('id', 'desc')
                            ->value('quantity_small_unit');
                            
                $lastProductInfo = DB::table('store_dets')
                            ->where('product_id', $product_id)
                            ->orderBy('id', 'desc')
                            ->first();
                            
                $quantity = (float) request('product_new_qty')[$index];
                $purchasePrice = (float) request('purchasePrice')[$index];
                $sellPrice = (float) request('sellPrice')[$index];
                $discount = (float) request('prod_discount')[$index];
                $tax = (float) request('prod_tax')[$index];                    

                $calcTotalProductsBefore += $quantity * $purchasePrice; // مخصص لتجميع  المنتجات كلها قبل تطبيق اي خصومات او ضرائب
                
                $product_total = ( $quantity * $purchasePrice );    //  اجمالي السلعة/الخدمة قبل كسعر بيع
                $after_discount = $product_total - ( $product_total * $discount / 100 );    // اجمالي السلعة/الخدمة بعد الخصم نسبه
                $after_tax = $after_discount + ( $after_discount * $tax / 100 );    // اجمالي السلعة/الخدمة بعد الخصم والضريبه نسبة

                
                $calcTotalProductsAfterBeforeFinal += $after_discount + ( $after_discount * $tax / 100 );    // اجمالي سعر المنتجات بعد الخصم والضريبة
                
                $calcTotalProductsAfter = $calcTotalProductsAfterBeforeFinal - $discount_bill ;
            }

            //dd($calcTotalProductsAfter);

            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            // نهاية العمليات الحسابيه الخاصه بكل منتج سواء سعر بيعه او عدد البيع او الضريبه وكذاله اجمالي سعر المنتجات كلها قبل وبعد الخصم
            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            


            DB::transaction(function() use ($calcTotalProductsBefore, $calcTotalProductsAfter){
                $lastNumId = DB::table('store_dets')->where('type', 'اضافة فاتورة مشتريات')->max('num_order');
                $purchaseBillId = DB::table('purchase_bills')->insertGetId([
                    'custom_bill_num' => request('custom_bill_num'),
                    'supplier_id' => request('supplier_id'),
                    'treasury_id' => request('treasury_id'),
                    'bill_discount' => request('discount_bill'),
                    'count_items' => count(request('prod_name')),
                    'total_bill_before' => $calcTotalProductsBefore,
                    'total_bill_after' => $calcTotalProductsAfter,
                    'custom_date' => request('custom_date'),
                    'user_id' => auth()->user()->id,
                    'year_id' => $this->currentFinancialYear(),
                    'notes' => request('notes'),
                    'created_at' => now()
                ]);
                
                foreach( request('prod_name')  as $index => $product_id ){
                    $lastProductQuantity = DB::table('store_dets')
                                ->where('product_id', $product_id)
                                ->orderBy('id', 'desc')
                                ->value('quantity_small_unit');
                                
                    $quantity = (float) request('product_new_qty')[$index];
                    $purchasePrice = (float) request('purchasePrice')[$index];
                    $sellPrice = (float) request('sellPrice')[$index];
                    $discount = (float) request('prod_discount')[$index];
                    $tax = (float) request('prod_tax')[$index];
                    //$bonus = (float) request('prod_bonus')[$index];
                    
                                        
                    $totalQuantity = $lastProductQuantity + $quantity;
                    
                    $last_cost_price_small_unit = $purchasePrice;
                    $sell_price_small_unit = $sellPrice;
                    
                    $product_total = (  $quantity * $purchasePrice );    // اجمالي السلعة/الخدمة قبل
                    $after_discount = $product_total - ( $product_total * $discount / 100 );    // اجمالي السلعة/الخدمة بعد الخصم نسبه
                    $after_tax = $after_discount + ( $after_discount * $tax / 100 );    // اجمالي السلعة/الخدمة بعد الخصم والضريبه نسبة
                                        
                    // حساب متوسط التكلفه ///////////////////////////////////////////////////////////////////////////
                        //✅ الإجمالي الحالي في المخزون:
                        //    من (2) الدفعة الأولى بسعر 100 = 2 × 100 = 200
                        //    من (7) الدفعة الثانية بسعر 120 = 7 × 120 = 840
                        //    المجموع الكلي = 200 + 840 = 1040 جنيه
                        //    إجمالي الكمية = 2 + 7 = 9 قطع

                        //    ✅ المتوسط المرجح:
                        //    متوسط التكلفة
                        //    =
                        //    إجمالي تكلفةالبضاعةالمتبقية
                        //      ___________________
                        //    إجمالي الكمية
                        //    =
                        //    1040
                        //     ______
                        //    9
                        //    ≈
                        //    115.56
                    
                        $getLatestPriceFromStoreDets = DB::table('store_dets')
                                                        ->where('type', 'اضافة فاتورة مشتريات')
                                                        ->orWhere('type', 'رصيد اول مدة للسلعة/خدمة')
                                                        ->where('product_id', $product_id)
                                                        ->orderBy('id', 'desc')
                                                        ->first();
                        
                        $getLatestRowToProduct = DB::table('store_dets')
                                                        ->where('product_id', $product_id)
                                                        ->orderBy('id', 'desc')
                                                        ->first();
                        
                        $firstCalcOfAvg =   (
                                                ($getLatestPriceFromStoreDets->avg_cost_price_small_unit ?? $purchasePrice) * 
                                                $getLatestRowToProduct->quantity_small_unit
                                            ); // اجمالي تكلفة البضاعة المتبقية
                                                                                        
                        $secondCalcOfAvg =   $after_tax; // اجمالي تكلفة البضاعة الجديدة
                                                                                
                        $clacAvgCostPrice = ($firstCalcOfAvg + $secondCalcOfAvg) / ($getLatestRowToProduct->quantity_small_unit +  $quantity); // المتوسط المرجح

                    //  حساب متوسط التكلفه ////////////////////////////////////////////////////////
                

                    DB::table('store_dets')->insert([
                        'num_order' => ($lastNumId + 1),
                        'type' => 'اضافة فاتورة مشتريات',
                        'year_id' => $this->currentFinancialYear(),
                        'bill_id' => $purchaseBillId,
                        'product_id' => $product_id,
                        'sell_price_small_unit' => $sell_price_small_unit,                                            
                        'last_cost_price_small_unit' => $last_cost_price_small_unit,
                        'avg_cost_price_small_unit' => $clacAvgCostPrice, 
                        'product_bill_quantity' =>  $quantity,
                        'quantity_small_unit' => $totalQuantity,
                        'tax' => request('prod_tax')[$index],
                        'discount' => request('prod_discount')[$index],
                        'total_before' => $product_total,
                        'total_after' => $after_tax,
                        'transfer_from' => null,
                        'transfer_to' => null,
                        'transfer_quantity' => 0,
                        'date' => request('custom_date'),
                        'created_at' => now()
                    ]);
                }


                // start check if paied money of this bill or not لو دفعت فلوس للمورد هخصمها 
                    if( request('treasury_id') && request('amount_paid') > 0 ){
                        $lastAmountOfTreasury = DB::table('treasury_bill_dets')
                                        ->where('treasury_id', request('treasury_id'))
                                        ->orderBy('id', 'desc')
                                        ->value('treasury_money_after');

                        $amount_paid = (float) request('amount_paid');
                    
                        if( $amount_paid > $lastAmountOfTreasury ){
                            return response()->json(['notAvailableMoney' => 'مبلغ الخزينة أقل من المبلغ المطلوب صرفة']);
                            
                        }else{
                            $lastNumIdTreasuryDets = DB::table('treasury_bill_dets')->where('treasury_type', 'اذن صرف نقدية')->max('num_order');
                            
                            $lastRecordSupplier = DB::table('treasury_bill_dets')
                                                    ->where('client_supplier_id', request('supplier_id'))
                                                    ->orderBy('id', 'desc')
                                                    ->first();
                                                
                            $userValueBefore = ( $lastRecordSupplier->remaining_money - $calcTotalProductsAfter );
                            $userValueAfter = ( $userValueBefore + $amount_paid );
                                                                    
                            DB::table('treasury_bill_dets')->insert([
                                'num_order' => ($lastNumIdTreasuryDets+1), 
                                'date' => Carbon::now(),
                                'treasury_id' => request('treasury_id'), 
                                'treasury_type' => 'اذن صرف نقدية', 
                                'bill_id' => $purchaseBillId, 
                                'bill_type' => 'اضافة فاتورة مشتريات', 
                                'client_supplier_id' => request('supplier_id'), 
                                'treasury_money_after' => ($lastAmountOfTreasury - $amount_paid), 
                                'amount_money' => $amount_paid, 
                                'remaining_money' => $userValueAfter, 
                                'transaction_from' => null, 
                                'transaction_to' => null, 
                                'notes' => request('notes'), 
                                'user_id' => auth()->user()->id, 
                                'year_id' => $this->currentFinancialYear(),
                                'created_at' => now()
                            ]);
                        }
                        
                    }else{ // لو مدفعتش فلوووس للمورد
                        $lastNumIdTreasuryDets = DB::table('treasury_bill_dets')->where('treasury_type', 'اضافة فاتورة مشتريات')->max('num_order'); 
                        $lastRecordSupplier = DB::table('treasury_bill_dets')
                                                ->where('client_supplier_id', request('supplier_id'))
                                                ->orderBy('id', 'desc')
                                                ->first();
                                            
                        $userValue = ( $lastRecordSupplier->remaining_money - $calcTotalProductsAfter );
                                        
                        DB::table('treasury_bill_dets')->insert([
                            'num_order' => ($lastNumIdTreasuryDets+1), 
                            'date' => now(),
                            'treasury_id' => 0, 
                            'treasury_type' => 'اضافة فاتورة مشتريات', 
                            'bill_id' => $purchaseBillId, 
                            'bill_type' => 'اضافة فاتورة مشتريات', 
                            'client_supplier_id' => request('supplier_id'), 
                            'remaining_money' => $userValue, 
                            'notes' => request('notes'), 
                            'user_id' => auth()->user()->id, 
                            'year_id' => $this->currentFinancialYear(),
                            'created_at' => now()
                        ]);
                    }
                // end check if paied money of this bill or not لو دفعت فلوس للمورد هخصمها 
            });
        }
    }


    public function show($id){
        $find = DB::table('purchase_bills')
                    ->leftJoin('store_dets', 'store_dets.bill_id', 'purchase_bills.id')
                    ->leftJoin('treasury_bill_dets', 'treasury_bill_dets.bill_id', 'purchase_bills.id')
                    ->leftJoin('products', 'products.id', 'store_dets.product_id')
                    ->leftJoin('units as small_unit', 'small_unit.id', 'products.smallUnit')
                    ->leftJoin('units as big_unit', 'big_unit.id', 'products.bigUnit')
                    ->leftJoin('financial_treasuries', 'financial_treasuries.id', 'purchase_bills.treasury_id')
                    ->leftJoin('clients_and_suppliers', 'clients_and_suppliers.id', 'purchase_bills.supplier_id')
                    ->leftJoin('financial_years', 'financial_years.id', 'purchase_bills.year_id')
                    ->leftJoin('users', 'users.id', 'purchase_bills.user_id')

                    ->where('purchase_bills.id', $id)
                    ->where('store_dets.type', 'اضافة فاتورة مشتريات')
                    ->whereIn('store_dets.status', ['فاتورة ملغاة', 'نشط', 'تم تعديله', 'تم حذفه', 'مرتجع مشتريات'])
                    ->whereIn('treasury_bill_dets.bill_type', ['اضافة فاتورة مشتريات', 'اذن صرف نقدية', 'اذن مرتجع نقدية لمورد'])
                    
                    ->select(
                        'purchase_bills.*',
                        
                        'store_dets.product_id',
                        'store_dets.status as store_det_status',
                        'store_dets.sell_price_small_unit',
                        'store_dets.current_sell_price_in_sale_bill',
                        'store_dets.last_cost_price_small_unit',
                        'store_dets.avg_cost_price_small_unit',
                        'store_dets.product_bill_quantity',
                        'store_dets.tax',
                        'store_dets.discount',
                        'store_dets.bonus',
                        'store_dets.total_before',
                        'store_dets.total_after',

                        'treasury_bill_dets.treasury_type',
                        'treasury_bill_dets.bill_type',
                        'treasury_bill_dets.treasury_money_after',
                        'treasury_bill_dets.amount_money',
                        'treasury_bill_dets.remaining_money',
                        
                        'products.nameAr as productNameAr',
                        'products.small_unit_numbers',
                        'small_unit.name as smallUnitName',
                        'big_unit.name as bigUnitName',
                        'clients_and_suppliers.name as supplierName',
                        'financial_treasuries.name as treasuryName',
                        'financial_years.name as financialName',
                        'users.name as userName',
                    )
                    ->get();

            //dd($find);
                            
        return response()->json($find);
    }




    public function edit($id)
    {                                      
        $pageNameAr = ' تعديل فاتورة مشتريات رقم # ';
        $pageNameEn = 'edit';
        $clients = ClientsAndSuppliers::where('client_supplier_type', 1)
                                    ->orWhere('client_supplier_type', 2)
                                    ->orderBy('name', 'asc')
                                    ->get();

        $treasuries = FinancialTreasury::where('status', 1)
                                    ->leftJoin('treasury_bill_dets', function ($join) {
                                        $join->on('treasury_bill_dets.treasury_id', '=', 'financial_treasuries.id')
                                            ->whereRaw('treasury_bill_dets.id = (select max(id) from treasury_bill_dets where treasury_bill_dets.treasury_id = financial_treasuries.id)');
                                    })
                                    ->select('financial_treasuries.*', 'treasury_bill_dets.treasury_money_after')
                                    ->get();    
                                    
        $extra_expenses = DB::table('extra_expenses')->orderBy('expense_type', 'asc')->get();
        
        $find = DB::table('purchase_bills')
                    ->leftJoin('store_dets', 'store_dets.bill_id', 'purchase_bills.id')
                    ->leftJoin('treasury_bill_dets', 'treasury_bill_dets.bill_id', 'purchase_bills.id')
                    ->leftJoin('products', 'products.id', 'store_dets.product_id')
                    ->leftJoin('units as small_unit', 'small_unit.id', 'products.smallUnit')
                    ->leftJoin('units as big_unit', 'big_unit.id', 'products.bigUnit')
                    ->leftJoin('financial_treasuries', 'financial_treasuries.id', 'purchase_bills.treasury_id')
                    ->leftJoin('clients_and_suppliers', 'clients_and_suppliers.id', 'purchase_bills.supplier_id')
                    ->leftJoin('financial_years', 'financial_years.id', 'purchase_bills.year_id')
                    ->leftJoin('users', 'users.id', 'purchase_bills.user_id')
                    ->where('purchase_bills.id', $id)
                    ->where('store_dets.type', 'اضافة فاتورة مشتريات')
                    ->where('treasury_bill_dets.bill_type', 'اضافة فاتورة مشتريات')
                    ->whereIn('store_dets.status', ['نشط', 'مرتجع مشتريات'])
                    ->select(
                        'purchase_bills.*',
                        
                        'store_dets.id as store_det_id',
                        'store_dets.product_id',
                        'store_dets.sell_price_small_unit',
                        'store_dets.current_sell_price_in_sale_bill',
                        'store_dets.last_cost_price_small_unit',
                        'store_dets.avg_cost_price_small_unit',
                        'store_dets.product_bill_quantity',
                        'store_dets.quantity_small_unit',
                        'store_dets.tax',
                        'store_dets.discount',
                        'store_dets.bonus',
                        'store_dets.total_before',
                        'store_dets.total_after',

                        'treasury_bill_dets.treasury_type',
                        'treasury_bill_dets.bill_type',
                        'treasury_bill_dets.treasury_money_after',
                        'treasury_bill_dets.amount_money',
                        'treasury_bill_dets.remaining_money',
                        
                        'products.nameAr as productNameAr',
                        'products.small_unit_numbers',
                        'small_unit.name as smallUnitName',
                        'big_unit.name as bigUnitName',
                        
                        'clients_and_suppliers.name as clientName',
                        'clients_and_suppliers.type_payment',
                        
                        'financial_treasuries.name as treasuryName',
                        'financial_years.name as financialName',
                        'users.name as userName',
                    )
                    ->get();


        //return $find;
                        
        if(count($find) == 0){
            return redirect('/');
        }else{
            $userInfo = DB::table('treasury_bill_dets')
                                        ->where('client_supplier_id', $find[0]->supplier_id)
                                        ->orderBy('id', 'desc')
                                        ->value('remaining_money');
                                        
            if (request()->is('purchases/edit/*')) {
                
                if((userPermissions()->purchase_bill_edited_view)){
                    $pageNameAr = ' تعديل فاتورة مشتريات رقم # ';
                    $pageNameEn = 'edit';
                    return view('back.purchases.edit' , compact('pageNameAr' , 'pageNameEn', 'clients', 'treasuries', 'extra_expenses', 'find', 'userInfo'));

                }else{
                    return redirect('/')->with(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
                }   

            }

            if (request()->is('purchases/return/*')) {
                if((userPermissions()->purchase_bill_return_view)){
                    $pageNameAr = ' مرتجع فاتورة مشتريات رقم # ';
                    $pageNameEn = 'return';
                    return view('back.purchases.return' , compact('pageNameAr' , 'pageNameEn', 'clients', 'treasuries', 'extra_expenses', 'find', 'userInfo'));

                }else{
                    return redirect('/')->with(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
                }   
            }

        }

    }
    

    //////////////////////////////////////////////  ارجاع صنف واحد من فاتوره مشتريات  //////////////////////////////////////////////
    //////////////////////////////////////////////  ارجاع صنف واحد من فاتوره مشتريات  //////////////////////////////////////////////
    public function return_product_from_bill(Request $request, $id)
    {
        if(request()->ajax()){
            $row = DB::table('store_dets')
                        ->join('sale_bills', 'sale_bills.id', 'store_dets.bill_id')
                        ->join('products', 'products.id', 'store_dets.product_id')
                        ->join('clients_and_suppliers', 'clients_and_suppliers.id', 'sale_bills.supplier_id')
                        ->select(
                            'store_dets.*', 

                            'clients_and_suppliers.id as supplier_id', 
                            'clients_and_suppliers.name as client_name', 
                            'clients_and_suppliers.type_payment', 
                            'products.nameAr as productNameAr', 

                            'sale_bills.extra_money', 
                            'sale_bills.extra_money_type', 
                            'sale_bills.count_items', 
                            'sale_bills.bill_discount', 
                            'sale_bills.total_bill_before', 
                            'sale_bills.total_bill_after', 
                        )
                        ->where('store_dets.id', $id)
                        ->where('store_dets.type', 'اضافة فاتورة مشتريات')
                        ->first();


                        //dd($row);


            $originalProductBillQuantity = (float) $row->product_bill_quantity; 
            $originalTotalProductBefore = (float) $row->total_before; 
            $originalTotalProductAfter = (float) $row->total_after; 
            $requestProductBillQuantity = (float) request('rowProductBillQuantity'); 


            if($requestProductBillQuantity > $originalProductBillQuantity){
                return response()->json(['error_quantity' => 'ℹ️ الكمية المرتجعة أكبر من الكمية المباعة في الفاتورة.']);
            
            }elseif($requestProductBillQuantity <= 0){
                return response()->json(['error_quantity_zero' => "⚠️ يجب أن تكون الكمية المرتجعة للصنف ( {$row->productNameAr} ) أكبر من صفر."]);
                
            }else{
                DB::transaction(function() use($row, $id, $requestProductBillQuantity, $originalTotalProductBefore, $originalTotalProductAfter, $originalProductBillQuantity) {                                                     
                    // حساب اجمالي الفاتوره مره اخري بعد المرتجع
                    $priceOneUnitBefore = ( $originalTotalProductBefore / $originalProductBillQuantity ); // الاجمالي قبل للصنف علي عدد القطع المباعه
                    $priceOneUnitAfter = ( $originalTotalProductAfter / $originalProductBillQuantity ); // الاجمالي بعد للصنف علي عدد القطع المباعه
                    $diffOriginalAndRequestQuantity = ( $originalProductBillQuantity - $requestProductBillQuantity );                

                    ////////////////////////////////////////////////////////// بدايه العمل علي جدول store_dets
                        DB::table('store_dets')->where('id', $id)->update([
                            'total_before' => ( $priceOneUnitBefore * $diffOriginalAndRequestQuantity ),
                            'total_after' => ( $priceOneUnitAfter * $diffOriginalAndRequestQuantity ),
                            'product_bill_quantity' => $diffOriginalAndRequestQuantity,
                            'status' => 'مرتجع مشتريات',
                            'updated_at' => now()
                        ]);
                        
        
                        // إعادة حساب متوسط التكلفة وآخر سعر تكلفة للمنتج بعد الحذف
                            $lastRowInfoToProduct = DB::table('store_dets')
                                                        ->where('product_id', $row->product_id)
                                                        ->orderBy('id', 'desc')
                                                        ->first();
                                                        
                            // تفاصيل اخر سعر تكلفة للمنتج                                
                            $last_cost_price_small_unit = $lastRowInfoToProduct->last_cost_price_small_unit;
                            $quantity_small_unit = $lastRowInfoToProduct->quantity_small_unit;
                            $totalRemainingQuantity = ($last_cost_price_small_unit * $quantity_small_unit);             

                            // تفاصيل الكميه المباعه
                            $last_cost_price_small_unit_returned = $row->last_cost_price_small_unit;
                            $product_bill_quantity = $requestProductBillQuantity;
                            $totalReturnedQuantity = ($last_cost_price_small_unit_returned * $product_bill_quantity);             
                            
                            $avg_cost_price_small_unit = ($totalRemainingQuantity + $totalReturnedQuantity) / ($quantity_small_unit + $product_bill_quantity);
                        // إعادة حساب متوسط التكلفة وآخر سعر تكلفة للمنتج بعد الحذف
                        
                        // إضافة صف جديد بنفس البيانات مع إعادة الكمية للمخزن وحالة "نشط"
                            DB::table('store_dets')->insert([
                                'num_order' => $row->num_order,
                                'type' => $row->type,
                                'year_id' => $row->year_id,
                                'bill_id' => $row->bill_id,
                                'product_id' => $row->product_id,
                                'current_sell_price_in_sale_bill' => $row->current_sell_price_in_sale_bill,
                                'sell_price_small_unit' => $row->sell_price_small_unit,
                                'last_cost_price_small_unit' => $row->last_cost_price_small_unit,
                                'avg_cost_price_small_unit' => $avg_cost_price_small_unit,

                                'product_bill_quantity' => $requestProductBillQuantity,
                                'quantity_small_unit' => ( $lastRowInfoToProduct->quantity_small_unit + $requestProductBillQuantity),
                                'tax' => $row->tax,
                                'discount' => $row->discount,
                                'bonus' => $row->bonus,
                                'total_before' => ($priceOneUnitBefore * $requestProductBillQuantity),
                                'total_after' => ($priceOneUnitAfter * $requestProductBillQuantity),
                                'status' => 'ناتج عن مرتجع مشتريات',
                                'transfer_from' => $row->transfer_from,
                                'transfer_to' => $row->transfer_to,
                                'transfer_quantity' => $row->transfer_quantity,
                                'date' => now(),
                                'created_at' => now(),
                            ]);
                        // إضافة صف جديد بنفس البيانات مع إعادة الكمية للمخزن وحالة "نشط"
                    ////////////////////////////////////////////////////////// نهايه العمل علي جدول store_dets


                    ////////////////////////////////////////////////////////// بدايه توزيع خصم الفاتوره ع الاصناف => تخصم من اجمالي الصنف بعد 
                        // يكون عباره عن مجموع سعر الصنف بعد / مجموع الفاتوره بعد * الخصم
                        //$calcDiffDiscountRatio = ( ($priceOneUnitAfter * $requestProductBillQuantity) / $row->total_bill_after ) * $row->bill_discount; // نسبه الخصم التي تخصم من الصنف عند حذفه موزعه بالتساوي علي اجمالي الفاتوره



                        $getRowInfo = DB::table('store_dets')->where('id', $id)->first();

                        dd($row->total_after, $getRowInfo->total_after, $priceOneUnitAfter);



                        $calcDiffDiscountRatio = ($row->total_after / $row->total_bill_after) * $row->bill_discount; // نسبه الخصم التي تخصم من الصنف عند حذفه موزعه بالتساوي علي اجمالي الفاتوره
                        dd( $calcDiffDiscountRatio );

                        
                    ////////////////////////////////////////////////////////// نهاية توزيع خصم الفاتوره ع الاصناف => تخصم من اجمالي الصنف بعد 


                    ////////////////////////////////////////////////////////// بدايه العمل علي جدول sale_bills
                    $checkCountProducts = ($row->product_bill_quantity - $requestProductBillQuantity) == 0 ;
                            
                    DB::table('sale_bills')->where('id', $row->bill_id)->update([
                        'status' => 'فاتورة معدلة',
                        'bill_discount' => ($row->bill_discount - $calcDiffDiscountRatio),
                        'extra_money' => $row->extra_money,
                        'extra_money_type' => $row->extra_money_type,
                        'count_items' => $checkCountProducts ? ($row->count_items -1) : $row->count_items,
                        'total_bill_before' => ( $row->total_bill_before - ($priceOneUnitBefore * $requestProductBillQuantity) ),
                        'total_bill_after' => ( ($row->total_bill_after - ($priceOneUnitAfter * $requestProductBillQuantity)) - $calcDiffDiscountRatio ),                    
                    ]);

                    $getRowInfo = DB::table('sale_bills')->where('id', $row->bill_id)->first();
                    if($getRowInfo->count_items == 0){
                        DB::table('sale_bills')->where('id', $row->bill_id)->update([
                            'status' => 'فاتورة ملغاة',
                            'bill_discount' => 0,
                            'extra_money' => 0,
                            'extra_money_type' =>null,
                            'count_items' => 0,
                            'total_bill_before' => 0,
                            'total_bill_after' => 0,                    
                        ]);
                    }
                    ////////////////////////////////////////////////////////// نهاية العمل علي جدول sale_bills

                        


                    ////////////////////////////////////////////////////////// بدايه العمل علي جدول treasury_bill_dets
                        $lastRecordClient = DB::table('treasury_bill_dets')->where('client_supplier_id', $row->supplier_id)->orderBy('id', 'desc')->first();
                        $lastNumId = DB::table('treasury_bill_dets')->where('treasury_type', 'اذن مرتجع نقدية لعميل')->max('num_order');

                        DB::table('treasury_bill_dets')->insert([
                            'num_order' => ($lastNumId+1), 
                            'date' => Carbon::now(),
                            'treasury_id' => 0, 
                            'treasury_type' => 'اذن مرتجع نقدية لعميل', 
                            'bill_id' => $id,
                            'bill_type' => 'اذن مرتجع نقدية لعميل', 
                            'client_supplier_id' => $row->supplier_id,
                            'partner_id' => null, 
                            'treasury_money_after' => 0, 
                            'amount_money' => ($priceOneUnitAfter * $requestProductBillQuantity), 
                            'remaining_money' => ( $lastRecordClient->remaining_money - ($priceOneUnitAfter * $requestProductBillQuantity) ),
                            'commission_percentage' => 0, 
                            'transaction_from' => null, 
                            'transaction_to' => null, 
                            'notes' => 'تم تعديل سعر أو خصم أو ضريبة أحد الأصناف في فاتورة العميل ' . $row->client_name . '، وتم احتساب الفارق على حسابه.',
                            'user_id' => auth()->user()->id, 
                            'year_id' => $this->currentFinancialYear(),
                            'created_at' => now()
                        ]);           
                    ////////////////////////////////////////////////////////// نهاية العمل علي جدول treasury_bill_dets
                });

                return response()->json(['success_edit' => 'تم ارجاع بيانات الصنف بنجاح وإعادة حساب إجمالي الفاتورة.']);                        
            }
        }else{
            return view('back.welcome');
        }
    }
    
     
    //////////////////////////////////////////////  حذف فاتورة مشتريات كامله  //////////////////////////////////////////////
    //////////////////////////////////////////////  حذف فاتورة مشتريات كامله  //////////////////////////////////////////////
    public function destroy_bill($id)
    {
        if((userPermissions()->purchase_bill_deleted_view)){
            if(request()->ajax()){
                $rows = DB::table('store_dets')
                            ->join('purchase_bills', 'purchase_bills.id', 'store_dets.bill_id')
                            ->join('clients_and_suppliers', 'clients_and_suppliers.id', 'purchase_bills.supplier_id')
                            ->select(
                                'store_dets.*', 
    
                                'clients_and_suppliers.id as supplier_id', 
                                'clients_and_suppliers.name as supplier_name', 
                                'clients_and_suppliers.type_payment', 
    
                                'purchase_bills.total_bill_after', 
                            )
                            ->where('store_dets.bill_id', $id)
                            ->where('store_dets.type', 'اضافة فاتورة مشتريات')
                            ->get();
    
                            //dd($rows);
        
                DB::transaction(function() use($rows, $id) {
                    DB::table('purchase_bills')->where('id', $id)->update([
                        'status' => 'فاتورة ملغاة',
                        'count_items' => 0,
                        'bill_discount' => 0,
                        //'extra_money' => 0,
                        //'extra_money_type' => 0,
                        'total_bill_before' => 0,
                        'total_bill_after' => 0,
                        'treasury_id' => null,
                        'user_id' => auth()->user()->id
                    ]);     
    
                    foreach($rows as $row){
                        DB::table('store_dets')->where('id', $row->id)->update(['status' => 'فاتورة ملغاة']);                  
    
                        $lastRowInfoToProduct = DB::table('store_dets')
                                                    ->where('product_id', $row->product_id)
                                                    ->orderBy('id', 'desc')
                                                    ->skip(1) // الصف الي قبل الاخير وليس الأخير
                                                    ->first();
                        $lastNumId = DB::table('store_dets')->where('treasury_type', 'حذف كلي فاتورة مشتريات')->max('num_order');
                        
                        // إضافة صف جديد بنفس البيانات مع ظبط الكمية كميات للمخزن وحالة "نشط"
                        DB::table('store_dets')->insert([
                            'num_order' => ($lastNumId+1),
                            'type' => 'حذف كلي فاتورة مشتريات',
                            'year_id' => $row->year_id,
                            'bill_id' => $row->bill_id,
                            'product_id' => $row->product_id,
                            'current_sell_price_in_sale_bill' => null,
                            'sell_price_small_unit' => $lastRowInfoToProduct->sell_price_small_unit,
                            'last_cost_price_small_unit' => $lastRowInfoToProduct->last_cost_price_small_unit,
                            'avg_cost_price_small_unit' => $lastRowInfoToProduct->avg_cost_price_small_unit,
                            'product_bill_quantity' => $row->product_bill_quantity,
                            'quantity_small_unit' => $lastRowInfoToProduct->quantity_small_unit,
                            'tax' => $row->tax,
                            'discount' => $row->discount,
                            'bonus' => $row->bonus,
                            'total_before' => $row->total_before,
                            'total_after' => $row->total_after,
                            'status' => 'ناتج عن حذف مشتريات',
                            'transfer_from' => $row->transfer_from,
                            'transfer_to' => $row->transfer_to,
                            'transfer_quantity' => $row->transfer_quantity,
                            'date' => now(),
                            'created_at' => now(),
                        ]);
                    }
            
                    // ارجاع اجمالي الفاتوره الي حساب المورد مره اخري                                        
                    $lastRecordSupplier = DB::table('treasury_bill_dets')->where('client_supplier_id', $rows[0]->supplier_id)->orderBy('id', 'desc')->first();
                    $lastNumId = DB::table('treasury_bill_dets')->where('treasury_type', 'اذن مرتجع نقدية لمورد')->max('num_order');
                
                    DB::table('treasury_bill_dets')->insert([
                        'num_order' => ($lastNumId+1), 
                        'date' => Carbon::now(),
                        'treasury_id' => 0, 
                        'treasury_type' => 'اذن مرتجع نقدية لمورد', 
                        'bill_id' => $id,
                        'bill_type' => 'اذن مرتجع نقدية لمورد', 
                        'client_supplier_id' => $rows[0]->supplier_id,
                        'partner_id' => null, 
                        'treasury_money_after' => 0, 
                        'amount_money' => $rows[0]->total_bill_after, 
                        'remaining_money' => ( $lastRecordSupplier->remaining_money + $rows[0]->total_bill_after ), 
                        'commission_percentage' => 0, 
                        'transaction_from' => null, 
                        'transaction_to' => null, 
                        'notes' => 'استرجاع إجمالي قيمة فاتورة مشتريات ملغاة لمورد '.$rows[0]->supplier_name,
                        'user_id' => auth()->user()->id, 
                        'year_id' => $this->currentFinancialYear(),
                        'created_at' => now()
                    ]);           
                    
                });
                return response()->json(['success_delete' => 'تم حذف الفاتورة بنجاح وإعادة الكميات وخصم الكميات من المخزن وتحديث متوسطات الأسعار']);
    
            }else{
                return view('back.welcome');
            }

        }else{
            return response()->json(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        }   
    }



    public function datatable()
    {
        $financial_year = request('financial_year');
        $from = request('from') ? date('Y-m-d H:i:s', strtotime(request('from'))) : null;
        $to = request('to') ? date('Y-m-d H:i:s', strtotime(request('to'))) : null;
        
        $query = DB::table('purchase_bills')
                    ->leftJoin('treasury_bill_dets', 'treasury_bill_dets.bill_id', 'purchase_bills.id')
                    ->leftJoin('financial_treasuries', 'financial_treasuries.id', 'purchase_bills.treasury_id')
                    ->leftJoin('clients_and_suppliers', 'clients_and_suppliers.id', 'purchase_bills.supplier_id')
                    ->leftJoin('financial_years', 'financial_years.id', 'purchase_bills.year_id')
                    ->leftJoin('users', 'users.id', 'purchase_bills.user_id')
                    ->where('treasury_bill_dets.bill_type', 'اضافة فاتورة مشتريات')
                    ->select(
                        'purchase_bills.*',
                        'clients_and_suppliers.name as supplierName',
                        'financial_treasuries.name as treasuryName',
                        'financial_years.name as financialName',
                        'users.name as userName',
                    );

        if ($from && $to) {
            $query->whereBetween('purchase_bills.created_at', [$from, $to]);
        } elseif ($from) {
            $query->where('purchase_bills.created_at', '>=', $from);
        } elseif ($to) {
            $query->where('purchase_bills.created_at', '<=', $to);
        }
        
        if($financial_year){
            $query->where('purchase_bills.year_id', $financial_year);
        }

        $all = $query->get();

        return DataTables::of($all)
            ->addColumn('id', function($res){
                $id = '<span class="badge badge-warning" style="font-size: 110% !important;font-weight: bold;">#'.$res->id.'</span>';

                if($res->custom_bill_num &&  $res->custom_bill_num != $res->id ){
                    $id .= "<div style='font-size:90%;color:#888;'>اخر <span class='badge badge-warning'>$res->custom_bill_num</span></div>";
                }

                return $id;
            })
            ->addColumn('supplierName', function($res){
                return $res->supplierName;
            })
            ->addColumn('treasuryName', function($res){
                return '<span class="badge badge-light"><i class="fas fa-university"></i></span> <span style="color:#007bff;font-weight:bold;">'.$res->treasuryName.'</span>';
            })
            ->addColumn('count_items', function($res){
                return '<span class="badge badge-primary" style="font-size: 110%;"> '.number_format($res->count_items).'</span>';
            })
            
            ->addColumn('date', function($res){
                $dates = '<div style="display:flex;align-items:center;gap:10px;justify-content:center;">';
                    $dates .= '<span class="badge badge-dark text-white" style="font-size: 100% !important;"><i class="fas fa-calendar-alt"></i> '.Carbon::parse($res->created_at)->format('d-m-Y').'</span>';
                    $dates .= '<span class="badge badge-secondary text-white" style="font-size: 90% !important;"><i class="fas fa-clock"></i> '.Carbon::parse($res->created_at)->format('h:i:s a').'</span>';
                $dates .= '</div>';

                if($res->custom_date){
                    $dates .= '<div class="badge badge-light">تاريخ آخر: '.Carbon::parse($res->custom_date)->format('Y-m-d').'</div>';
                }
                return $dates;
            })
            ->addColumn('financialName', function($res){
                return '<span class="badge badge-light"><i class="fas fa-coins"></i></span> '.$res->financialName;
            })
            ->addColumn('bill_discount', function($res){
                return $res->bill_discount ? display_number($res->bill_discount) : 0;
            })
            ->addColumn('total_bill', function($res){
                $total_bill = '';
                if($res->total_bill_before != $res->total_bill_after){
                    $total_bill .= '<div style="display:flex;align-items:center;gap:7px;justify-content:center;">';
                    $total_bill .= '<span class="badge badge-danger text-white" style="font-size: 110% !important;padding:7px 12px;"><i class="fas fa-arrow-down"></i> قبل: '.display_number($res->total_bill_before).'</span>';
                    $total_bill .= '<span style="font-size:18px;color:#888;">→</span>';
                    $total_bill .= '<span class="badge badge-success text-white" style="font-size: 110% !important;padding:7px 12px;"><i class="fas fa-arrow-up"></i> بعد: '.display_number($res->total_bill_after).'</span>';
                    $total_bill .= '</div>';
                }else{
                    $total_bill .= '<span class="badge badge-success text-white" style="font-size: 110% !important;padding:7px 12px;"><i class="fas fa-receipt"></i> '.display_number($res->total_bill_after).'</span>';
                }
                // شريط حالة للمبلغ المدفوع مقابل الإجمالي (لو متاح)
                if(isset($res->amount_paid) && $res->total_bill_after > 0){
                    $percent = min(100, round(($res->amount_paid/$res->total_bill_after)*100));
                    $total_bill .= '<div class="progress" style="height:7px;margin-top:3px;background:#eee;">
                        <div class="progress-bar bg-info" role="progressbar" style="width:'.$percent.'%"></div>
                    </div>';
                }
                return $total_bill;
            })
            ->addColumn('userName', function($res){
                return '<span class="badge badge-light"><i class="fas fa-user-tie"></i></span> '.$res->userName;
            })
            ->addColumn('notes', function($res){
                return '<span data-bs-toggle="popover" data-bs-placement="bottom" title="'.e($res->notes).'" style="cursor:pointer;color:#007bff;" onclick="alert(\''.e($res->notes).'\')">
                    <i class="fas fa-sticky-note"></i> '.Str::limit($res->notes, 20).'
                </span>';
            })
            ->addColumn('action', function($res){
                if($res->status == 'فاتورة ملغاة'){
                    return '<div style="display:flex;gap:5px;flex-wrap:wrap;justify-content:center;align-items:center;">
                                <button type="button" class="btn btn-sm text-white" disabled style="opacity:0.7;cursor:not-allowed;background: red !important;">ملغاة</button>

                                <button type="button" class="btn btn-sm btn-primary print" data-effect="effect-scale" data-toggle="modal" href="#exampleModalCenter" data-placement="top" data-toggle="tooltip" title="طباعة الفاتورة" res_id="'.$res->id.'">
                                    <i class="fas fa-print"></i>
                                </button>

                                <button type="button" class="btn btn-sm btn-success show" data-effect="effect-scale" data-toggle="modal" href="#showProductsModal" data-placement="top" data-toggle="tooltip" title="عرض الفاتورة" res_id="'.$res->id.'">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>';
                }
                return '<div style="display:flex;gap:5px;flex-wrap:wrap;justify-content:center;align-items:center;">'
                            .'<a type="button" href="'.url('purchases/return/'.$res->id).'" class="btn btn-sm btn-danger return_bill" data-effect="effect-scale" data-placement="top" data-toggle="tooltip" title="إرجاع الفاتورة" res_id="'.$res->id.'">
                                <i class="fas fa-reply"></i>
                            </a>'

                            .'<button type="button" class="btn btn-sm btn-primary print" data-effect="effect-scale" data-toggle="modal" href="#exampleModalCenter" data-placement="top" data-toggle="tooltip" title="طباعة الفاتورة" res_id="'.$res->id.'">
                                <i class="fas fa-print"></i>
                            </button>'

                            .'<button type="button" class="btn btn-sm btn-success show" data-effect="effect-scale" data-toggle="modal" href="#showProductsModal" data-placement="top" data-toggle="tooltip" title="عرض الفاتورة" res_id="'.$res->id.'">
                                <i class="fas fa-eye"></i>
                            </button>'

                            .'<button type="button" class="btn btn-sm btn-outline-danger delete delete_bill" data-effect="effect-scale" data-toggle="tooltip" title="حذف الفاتورة نهائياً" res_id="'.$res->id.'">
                                <i class="fas fa-trash-alt"></i> <span style="font-size:90%;font-weight:bold;">حذف</span>
                            </button>'

                            .'<a type="button" href="'.url('purchases/edit/'.$res->id).'" class="btn btn-sm btn-outline-dark edit" data-effect="effect-scale" data-placement="top" data-toggle="tooltip" title="تعديل الفاتورة" res_id="'.$res->id.'">
                                <i class="fas fa-edit"></i> <span style="font-size:90%;font-weight:bold;">تعديل</span>
                            </a>'
                        .'</div>';
            })
            ->rawColumns(['id', 'supplierName', 'treasuryName', 'total_bill', 'bill_discount', 'count_items', 'date', 'notes', 'userName', 'financialName', 'action'])
            ->toJson();
    }
}