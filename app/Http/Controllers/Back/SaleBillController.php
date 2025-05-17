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

class SaleBillController extends Controller
{
    public function index()
    {             
        $pageNameAr = 'فواتير المبيعات';
        $pageNameEn = 'sales';

        return view('back.sales.index' , compact('pageNameAr' , 'pageNameEn'));
    }

    public function create()
    {                               
        $pageNameAr = 'فاتورة مبيعات # ';
        $pageNameEn = 'sales_create';
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
                                    
        $lastBillNum = DB::table('sale_bills')->max('id');                                

        return view('back.sales.create' , compact('pageNameAr' , 'pageNameEn', 'suppliers', 'treasuries', 'lastBillNum'));
    }

    public function store(Request $request)
    {
        if (request()->ajax()){
            //$this->validate($request, [
            //    'client_id' => 'required|integer|exists:clients_and_suppliers,id',
            //    'financial_treasuries' => 'nullable|integer|exists:financial_treasuries,id',
            //    'custom_bill_num' => 'nullable|string',
            //    'custom_date' => 'nullable|date',
            //    'static_discount_bill' => 'nullable|numeric|min:0',
            //    'tax_bill' => 'nullable|numeric|min:0',
            
            //    'sale_quantity' => 'array',
            //    'sale_quantity.*' => 'integer|min:1',
            
            //    'purchasePrice' => 'array',
            //    'purchasePrice.*' => 'numeric|min:1',
            
            //    'sellPrice' => 'array',
            //    'sellPrice.*' => 'numeric|min:1',
            
            //    'prod_tax' => 'array',
            //    'prod_tax.*' => 'nullable|numeric|min:0',
            
            //    'prod_discount' => 'array',
            //    'prod_discount.*' => 'nullable|numeric|min:0',
            
            //    ], [
            //    'required' => 'يجب تعبئة حقل :attribute، لا يمكن تركه فارغًا.',
            //    'string' => 'يجب أن يكون حقل :attribute عبارة عن نص.',
            //    'unique' => 'حقل :attribute مُستخدم مسبقًا، الرجاء اختيار قيمة مختلفة.',
            //    'integer' => 'يجب أن يكون حقل :attribute رقمًا صحيحًا (بدون كسور).',
            //    'numeric' => 'يجب أن يحتوي حقل :attribute على رقم صحيح أو عشري.',
            //    'min' => 'يجب ألا تكون قيمة :attribute أقل من :min.',
            //    'exists' => 'القيمة المحددة في حقل :attribute غير موجودة في السجلات.',
            //    'array' => 'يجب أن يكون حقل :attribute عبارة عن مجموعة عناصر.',
            //    ], [
            //    'client_id' => 'اسم العميل',
            //    'financial_treasuries' => 'اسم الخزينة المالية',
            //    'custom_bill_num' => 'رقم الفاتورة المخصص',
            //    'custom_date' => 'تاريخ الفاتورة',
            //    'static_discount_bill' => 'الخصم العام على الفاتورة',
            //    'tax_bill' => 'ضريبة الفاتورة',
            //    'sale_quantity' => 'كميات المنتجات',
            //    'sale_quantity.*' => 'الكمية لكل منتج',
            //    'purchasePrice' => 'أسعار الشراء',
            //    'purchasePrice.*' => 'سعر الشراء لكل منتج',
            //    'sellPrice' => 'أسعار البيع',
            //    'sellPrice.*' => 'سعر البيع لكل منتج',
            //    'prod_tax' => 'ضرائب المنتجات',
            //    'prod_tax.*' => 'نسبة الضريبة على المنتج',
            //    'prod_discount' => 'خصومات المنتجات',
            //    'prod_discount.*' => 'قيمة الخصم على المنتج',
            //]);            


            // بداية حساب نوع الخصم قيمه ام نسبة ام غير موجود وتوزيع الخصم بالتساوي علي اصناف الفاتوره
                //$totalBillBeforeDiscount = 0;
                //$percentageDiscountRequest = request('discount_bill');
                //$staticDiscountRequest = request('static_discount_bill');
                
                //foreach( request('prod_name')  as $index => $product_id ){
                //    $sale_quantity = (float) request('sale_quantity')[$index];
                //    $purchasePrice = (float) request('purchasePrice')[$index];
                    
                //    $totalBillBeforeDiscount += ($sale_quantity * $purchasePrice);                
                //}


                //$percentageDiscountValue = $totalBillBeforeDiscount * ($percentageDiscountRequest / 100);
                
                //if($percentageDiscountRequest > 0 && $staticDiscountRequest > 0){
                //    $totalBillAfterDiscount = $totalBillBeforeDiscount - $percentageDiscountValue;
                    
                //}else if($percentageDiscountRequest > 0){
                //    $totalBillAfterDiscount = $totalBillBeforeDiscount - $percentageDiscountValue;
                    
                //}else if($staticDiscountRequest > 0){
                //    $totalBillAfterDiscount = $totalBillBeforeDiscount - $staticDiscountRequest;
                    
                //}else{
                //    $totalBillAfterDiscount = $totalBillBeforeDiscount;
                    
                //}
            // نهاية حساب نوع الخصم قيمه ام نسبة ام غير موجود وتوزيع الخصم بالتساوي علي اصناف الفاتوره








            
            
            // start new sum totalBillBefore And After
                $calcTotalProductsBefore = 0; // مخصص لتجميع سعر كل منتج قبل الخصم والضريبه ودمج كل الاسعار في سعر واحد 
                $calcTotalProductsAfter = 0; // مخصص لتجميع سعر كل منتج بعد الخصم والضريبه ودمجكل الاسعار في سعر واحد 
                
                foreach( request('prod_name')  as $index => $product_id ){
                    $lastProductQuantity = DB::table('store_dets')
                                ->where('product_id', $product_id)
                                ->orderBy('id', 'desc')
                                ->value('quantity_small_unit');
                                
                    $lastProductInfo = DB::table('store_dets')
                                ->where('product_id', $product_id)
                                ->orderBy('id', 'desc')
                                ->first();
                                
                    $sale_quantity = (float) request('sale_quantity')[$index];
                    //$purchasePrice = (float) request('purchasePrice')[$index];
                    $sellPrice = (float) request('sellPrice')[$index];
                    $discount = (float) request('prod_discount')[$index];
                    $tax = (float) request('prod_tax')[$index];                    

                    
                    // بدايه معرفه لو وحده المنتج المختاره في الفاتوره كبري ام صغري /////////////////////////////////////////////////////////////////
                    $productInfo = DB::table('products')->where('id', $product_id)->first();
                    $unit = (float) request('prod_units')[$index]; // مخصص لمعرفة نوع الوحده المستخدمه لكل صنف في عملية الشراء
                    
                    if ($unit == $productInfo->smallUnit && $sale_quantity <= $lastProductQuantity) { // التاكد من ان الكميه المباعه اقل من او تساوي الموجوده في المخزن
                        $totalQuantity = $lastProductQuantity - $sale_quantity; // بقوم انقاص الكميه المباعه من رصيد المخزن
                        $onlyQuantityThisBill = $sale_quantity;

                        $calcTotalProductsBefore += $onlyQuantityThisBill * $sellPrice; // مخصص لتجميع  المنتجات كلها قبل تطبيق اي خصومات او ضرائب

                        $sell_price_small_unit = $sellPrice; // سعر البيع الي جاي من فاتوره البيع 
                        $last_cost_price_small_unit = $lastProductInfo->last_cost_price_small_unit; // جلب اخر سعر تكلفه من المنتج من اخر صف له 
                        $avg_cost_price_small_unit = $lastProductInfo->avg_cost_price_small_unit; // جلب اخر متوسط تكلفه من المنتج من اخر صف له 
                        
                        $product_total = ( $onlyQuantityThisBill * $sellPrice );    //  اجمالي الصنف قبل كسعر بيع
                        $after_discount = $product_total - ( $product_total * $discount / 100 );    // اجمالي الصنف بعد الخصم نسبه
                        $after_tax = $after_discount + ( $after_discount * $tax / 100 );    // اجمالي الصنف بعد الخصم والضريبه نسبة
                        
                        $calcTotalProductsAfter += $after_discount + ( $after_discount * $tax / 100 );    // اجمالي سعر المنتجات بعد الخصم والضريبة
                                                        
                    } else { // لو وحده المنتج المختاره في الفاتوره كبري
                                                
                        $product_total = ( $sale_quantity * $purchasePrice );    // اجمالي الصنف قبل سعر تكلفه
                        $product_total_sell_price = ( $sale_quantity * $sellPrice );    // اجمالي الصنف قبل سعر بيعه

                        $onlyQuantityThisBill = $sale_quantity * $productInfo->small_unit_numbers;
                        
                        $calcTotalProductsBefore += $onlyQuantityThisBill * $sellPrice; // مخصص لتجميع  المنتجات كلها قبل تطبيق اي خصومات او ضرائب

                        $last_cost_price_small_unit = ( $product_total / $onlyQuantityThisBill );
                        $sell_price_small_unit = ( $product_total_sell_price / $onlyQuantityThisBill );
                        
                        $totalQuantity = $lastProductQuantity + $onlyQuantityThisBill;

                        $after_discount = $product_total - ( $product_total * $discount / 100 );    // اجمالي الصنف بعد الخصم نسبه
                        $after_tax = $after_discount + ( $after_discount * $tax / 100 );    // اجمالي الصنف بعد الخصم والضريبه نسبة

                        $calcTotalProductsAfter += $after_discount + ( $after_discount * $tax / 100 );    // اجمالي سعر المنتجات بعد الخصم والضريبة

                    }
                    // نهاية معرفه لو وحده المنتج المختاره في الفاتوره كبري ام صغري
                }
                
                $getClientTypePayment = DB::table('clients_and_suppliers')->where('id', request('client_id'))->first();
                
                //dd($getClientTypePayment->type_payment);
                
                // بدايه التاكد من ان حاله العميل كاش او اجل
                if($getClientTypePayment->type_payment == 'كاش')   // لو العميل كاش
                {
                    if(!request('amount_paid') || request('amount_paid') < $calcTotalProductsAfter || request('amount_paid') > $calcTotalProductsAfter){
                        return response()->json(['errorClientPayment' => ' هذا العميل غير مصرح لة بالشراء الآجل. يجب أن يكون المبلغ المدفوع مساوي للرقم المستحق دفعة في الفاتورة']);
                    }else{
                        DB::transaction(function() use($calcTotalProductsAfter, $calcTotalProductsBefore){
                            $lastNumId = DB::table('store_dets')->where('type', 'اضافة فاتورة مبيعات')->max('num_order');
            
                            $saleBillId = DB::table('sale_bills')->insertGetId([
                                'custom_bill_num' => request('custom_bill_num'),
                                'client_id' => request('client_id'),
                                'treasury_id' => request('treasury_id'),
                                'bill_tax' => request('bill_tax'),
                                'bill_discount' => request('static_discount_bill'),
                                'count_items' => count(request('prod_name')),
                                'total_bill_before' => $calcTotalProductsBefore,
                                'total_bill_after' => $calcTotalProductsAfter,
                                'custom_date' => request('custom_date'),
                                'user_id' => auth()->user()->id,
                                'year_id' => $this->currentFinancialYear(),
                                'notes' => request('notes'),
                                'created_at' => now()
                            ]);
                            
            
                            //$calcTotalProductsAfter = 0; // مخصص لتجميع سعر كل منتج بعد الخصم والضريبه ودمجكل الاسعار في سعر واحد 
                            foreach( request('prod_name')  as $index => $product_id ){
                                $lastProductQuantity = DB::table('store_dets')
                                            ->where('product_id', $product_id)
                                            ->orderBy('id', 'desc')
                                            ->value('quantity_small_unit');
                                            
                                $lastProductInfo = DB::table('store_dets')
                                            ->where('product_id', $product_id)
                                            ->orderBy('id', 'desc')
                                            ->first();
                                            
                                $sale_quantity = (float) request('sale_quantity')[$index];
                                ////$purchasePrice = (float) request('purchasePrice')[$index];
                                $sellPrice = (float) request('sellPrice')[$index];
                                $discount = (float) request('prod_discount')[$index];
                                $tax = (float) request('prod_tax')[$index];                    
            
                                
                                //// بدايه معرفه لو وحده المنتج المختاره في الفاتوره كبري ام صغري /////////////////////////////////////////////////////////////////
                                $productInfo = DB::table('products')->where('id', $product_id)->first();
                                $unit = (float) request('prod_units')[$index]; // مخصص لمعرفة نوع الوحده المستخدمه لكل صنف في عملية الشراء
                                
                                if ($unit == $productInfo->smallUnit && $sale_quantity <= $lastProductQuantity) { // التاكد من ان الكميه المباعه اقل من او تساوي الموجوده في المخزن
                                    $totalQuantity = $lastProductQuantity - $sale_quantity; // بقوم انقاص الكميه المباعه من رصيد المخزن
                                    $onlyQuantityThisBill = $sale_quantity;
            
                                    $sell_price_small_unit = $sellPrice; // سعر البيع الي جاي من فاتوره البيع 
                                    $last_cost_price_small_unit = $lastProductInfo->last_cost_price_small_unit; // جلب اخر سعر تكلفه من المنتج من اخر صف له 
                                    $avg_cost_price_small_unit = $lastProductInfo->avg_cost_price_small_unit; // جلب اخر متوسط تكلفه من المنتج من اخر صف له 
                                    
                                    $product_total = ( $onlyQuantityThisBill * $sellPrice );    //  اجمالي الصنف قبل كسعر بيع
                                    $after_discount = $product_total - ( $product_total * $discount / 100 );    // اجمالي الصنف بعد الخصم نسبه
                                    $after_tax = $after_discount + ( $after_discount * $tax / 100 );    // اجمالي الصنف بعد الخصم والضريبه نسبة
                                                  
                                } else { // لو وحده المنتج المختاره في الفاتوره كبري
                                                            
                                    $product_total = ( $sale_quantity * $purchasePrice );    // اجمالي الصنف قبل سعر تكلفه
                                    $product_total_sell_price = ( $sale_quantity * $sellPrice );    // اجمالي الصنف قبل سعر بيعه
            
                                    $onlyQuantityThisBill = $sale_quantity * $productInfo->small_unit_numbers;
                                    
                                    $last_cost_price_small_unit = ( $product_total / $onlyQuantityThisBill );
                                    $sell_price_small_unit = ( $product_total_sell_price / $onlyQuantityThisBill );
                                    
                                    $totalQuantity = $lastProductQuantity + $onlyQuantityThisBill;
            
                                    $after_discount = $product_total - ( $product_total * $discount / 100 );    // اجمالي الصنف بعد الخصم نسبه
                                    $after_tax = $after_discount + ( $after_discount * $tax / 100 );    // اجمالي الصنف بعد الخصم والضريبه نسبة
                                }
                                //// نهاية معرفه لو وحده المنتج المختاره في الفاتوره كبري ام صغري
            
            
                                DB::table('store_dets')->insert([
                                    'num_order' => ($lastNumId + 1),
                                    'type' => 'اضافة فاتورة مبيعات',
                                    'year_id' => $this->currentFinancialYear(),
                                    'bill_id' => $saleBillId,
                                    'product_id' => $product_id,
                                    'sell_price_small_unit' => $sell_price_small_unit,                                            
                                    'last_cost_price_small_unit' => $last_cost_price_small_unit,
                                    'avg_cost_price_small_unit' => $avg_cost_price_small_unit, 
                                    'product_bill_quantity' => $onlyQuantityThisBill,
                                    'quantity_small_unit' => $totalQuantity,
                                    'tax' => request('prod_tax')[$index],
                                    'discount' => request('prod_discount')[$index],
                                    'total_before' => $product_total,
                                    'total_after' => $after_tax,
                                    'return_quantity' => 0,
                                    'transfer_from' => null,
                                    'transfer_to' => null,
                                    'transfer_quantity' => 0,
                                    'date' => request('custom_date'),
                                    'created_at' => now()
                                ]);
                                
                            } // End foreach to request('prod_name')         
            
                            // لو العميل الاجل دفع فلوس واختار خزنة 
                                if( request('treasury_id') && request('amount_paid')){
                                    $lastAmountOfTreasury = DB::table('treasury_bill_dets')
                                                    ->where('treasury_id', request('treasury_id'))
                                                    ->orderBy('id', 'desc')
                                                    ->value('treasury_money_after');
            
                                    $amount_paid = (float) request('amount_paid');
                                
                                    $lastNumIdTreasuryDets = DB::table('treasury_bill_dets')->where('treasury_type', 'اذن توريد نقدية')->max('num_order');
                                    
                                    $lastRecordClient = DB::table('treasury_bill_dets')
                                                            ->where('client_supplier_id', request('client_id'))
                                                            ->orderBy('id', 'desc')
                                                            ->first();
                                                    
                                    if($lastRecordClient->remaining_money >= 0){
                                        $minusTotalBillAfterFromAmountPaid = $calcTotalProductsAfter - $amount_paid;
                                        $userValue = $minusTotalBillAfterFromAmountPaid;                                    
                                    }else{
                                        $minusTotalBillAfterFromAmountPaid = $calcTotalProductsAfter - $amount_paid;                                    
                                        $userValue = ( $lastRecordClient->remaining_money + $minusTotalBillAfterFromAmountPaid );
                                    }
                                                                            
                                    DB::table('treasury_bill_dets')->insert([
                                        'num_order' => ($lastNumIdTreasuryDets+1), 
                                        'date' => Carbon::now(),
                                        'treasury_id' => request('treasury_id'), 
                                        'treasury_type' => 'اذن توريد نقدية', 
                                        'bill_id' => $saleBillId, 
                                        'bill_type' => 'اضافة فاتورة مبيعات', 
                                        'client_supplier_id' => request('client_id'), 
                                        'treasury_money_after' => ($lastAmountOfTreasury + $amount_paid), 
                                        'amount_money' => 0, 
                                        'remaining_money' => $userValue, 
                                        'transaction_from' => null, 
                                        'transaction_to' => null, 
                                        'notes' => request('notes'), 
                                        'user_id' => auth()->user()->id, 
                                        'year_id' => $this->currentFinancialYear(),
                                        'created_at' => now()
                                    ]);
                                    
                                }elseif(!request('treasury_id') && !request('amount_paid')){ //  لو العميل اجل مدفعش فلوس ول يقم باختيار خزينة 
                                    $lastNumIdTreasuryDets = DB::table('treasury_bill_dets')->where('treasury_type', 'اضافة فاتورة مبيعات')->max('num_order'); 
                                    $lastRecordClient = DB::table('treasury_bill_dets')
                                                            ->where('client_supplier_id', request('client_id'))
                                                            ->orderBy('id', 'desc')
                                                            ->first();
                                                    
                                    if($lastRecordClient->remaining_money >= 0){
                                        $userValue = $calcTotalProductsAfter + $lastRecordClient->remaining_money;                                    
                                    }else{                                   
                                        $userValue = ( $lastRecordClient->remaining_money + $calcTotalProductsAfter );
                                    }
                                                                            
                                    DB::table('treasury_bill_dets')->insert([
                                        'num_order' => ($lastNumIdTreasuryDets+1), 
                                        'date' => Carbon::now(),
                                        'treasury_id' => 0, 
                                        'treasury_type' => 'اضافة فاتورة مبيعات', 
                                        'bill_id' => $saleBillId, 
                                        'bill_type' => 'اضافة فاتورة مبيعات', 
                                        'client_supplier_id' => request('client_id'), 
                                        'remaining_money' => $userValue, 
                                        'notes' => request('notes'), 
                                        'user_id' => auth()->user()->id, 
                                        'year_id' => $this->currentFinancialYear(),
                                        'created_at' => now()
                                    ]);
                                }
                            // end check if paied money of this bill or not لو دفعت فلوس للعميل هخصمها 
                        });
                    }
                    
                    ///////////////////////////////////////////////////////////////////////////////  لو العميل اجل
                    ///////////////////////////////////////////////////////////////////////////////  لو العميل اجل
                }elseif($getClientTypePayment->type_payment == 'آجل'){  // لو العميل اجل
                    
                    DB::transaction(function() use($calcTotalProductsAfter, $calcTotalProductsBefore){
                        $lastNumId = DB::table('store_dets')->where('type', 'اضافة فاتورة مبيعات')->max('num_order');
        
                        $saleBillId = DB::table('sale_bills')->insertGetId([
                            'custom_bill_num' => request('custom_bill_num'),
                            'client_id' => request('client_id'),
                            'treasury_id' => request('treasury_id'),
                            'bill_tax' => request('bill_tax'),
                            'bill_discount' => request('static_discount_bill'),
                            'count_items' => count(request('prod_name')),
                            'total_bill_before' => $calcTotalProductsBefore,
                            'total_bill_after' => $calcTotalProductsAfter,
                            'custom_date' => request('custom_date'),
                            'user_id' => auth()->user()->id,
                            'year_id' => $this->currentFinancialYear(),
                            'notes' => request('notes'),
                            'created_at' => now()
                        ]);
                        
        
                        //$calcTotalProductsAfter = 0; // مخصص لتجميع سعر كل منتج بعد الخصم والضريبه ودمجكل الاسعار في سعر واحد 
                        foreach( request('prod_name')  as $index => $product_id ){
                            $lastProductQuantity = DB::table('store_dets')
                                        ->where('product_id', $product_id)
                                        ->orderBy('id', 'desc')
                                        ->value('quantity_small_unit');
                                        
                            $lastProductInfo = DB::table('store_dets')
                                        ->where('product_id', $product_id)
                                        ->orderBy('id', 'desc')
                                        ->first();
                                        
                            $sale_quantity = (float) request('sale_quantity')[$index];
                            ////$purchasePrice = (float) request('purchasePrice')[$index];
                            $sellPrice = (float) request('sellPrice')[$index];
                            $discount = (float) request('prod_discount')[$index];
                            $tax = (float) request('prod_tax')[$index];                    
        
                            
                            //// بدايه معرفه لو وحده المنتج المختاره في الفاتوره كبري ام صغري /////////////////////////////////////////////////////////////////
                            $productInfo = DB::table('products')->where('id', $product_id)->first();
                            $unit = (float) request('prod_units')[$index]; // مخصص لمعرفة نوع الوحده المستخدمه لكل صنف في عملية الشراء
                            
                            if ($unit == $productInfo->smallUnit && $sale_quantity <= $lastProductQuantity) { // التاكد من ان الكميه المباعه اقل من او تساوي الموجوده في المخزن
                                $totalQuantity = $lastProductQuantity - $sale_quantity; // بقوم انقاص الكميه المباعه من رصيد المخزن
                                $onlyQuantityThisBill = $sale_quantity;
        
                                $sell_price_small_unit = $sellPrice; // سعر البيع الي جاي من فاتوره البيع 
                                $last_cost_price_small_unit = $lastProductInfo->last_cost_price_small_unit; // جلب اخر سعر تكلفه من المنتج من اخر صف له 
                                $avg_cost_price_small_unit = $lastProductInfo->avg_cost_price_small_unit; // جلب اخر متوسط تكلفه من المنتج من اخر صف له 
                                
                                $product_total = ( $onlyQuantityThisBill * $sellPrice );    //  اجمالي الصنف قبل كسعر بيع
                                $after_discount = $product_total - ( $product_total * $discount / 100 );    // اجمالي الصنف بعد الخصم نسبه
                                $after_tax = $after_discount + ( $after_discount * $tax / 100 );    // اجمالي الصنف بعد الخصم والضريبه نسبة
                                              
                            } else { // لو وحده المنتج المختاره في الفاتوره كبري
                                                        
                                $product_total = ( $sale_quantity * $purchasePrice );    // اجمالي الصنف قبل سعر تكلفه
                                $product_total_sell_price = ( $sale_quantity * $sellPrice );    // اجمالي الصنف قبل سعر بيعه
        
                                $onlyQuantityThisBill = $sale_quantity * $productInfo->small_unit_numbers;
                                
                                $last_cost_price_small_unit = ( $product_total / $onlyQuantityThisBill );
                                $sell_price_small_unit = ( $product_total_sell_price / $onlyQuantityThisBill );
                                
                                $totalQuantity = $lastProductQuantity + $onlyQuantityThisBill;
        
                                $after_discount = $product_total - ( $product_total * $discount / 100 );    // اجمالي الصنف بعد الخصم نسبه
                                $after_tax = $after_discount + ( $after_discount * $tax / 100 );    // اجمالي الصنف بعد الخصم والضريبه نسبة
                            }
                            //// نهاية معرفه لو وحده المنتج المختاره في الفاتوره كبري ام صغري
        
        
                            DB::table('store_dets')->insert([
                                'num_order' => ($lastNumId + 1),
                                'type' => 'اضافة فاتورة مبيعات',
                                'year_id' => $this->currentFinancialYear(),
                                'bill_id' => $saleBillId,
                                'product_id' => $product_id,
                                'sell_price_small_unit' => $sell_price_small_unit,                                            
                                'last_cost_price_small_unit' => $last_cost_price_small_unit,
                                'avg_cost_price_small_unit' => $avg_cost_price_small_unit, 
                                'product_bill_quantity' => $onlyQuantityThisBill,
                                'quantity_small_unit' => $totalQuantity,
                                'tax' => request('prod_tax')[$index],
                                'discount' => request('prod_discount')[$index],
                                'total_before' => $product_total,
                                'total_after' => $after_tax,
                                'return_quantity' => 0,
                                'transfer_from' => null,
                                'transfer_to' => null,
                                'transfer_quantity' => 0,
                                'date' => request('custom_date'),
                                'created_at' => now()
                            ]);
                            
                        } // End foreach to request('prod_name')         
        
                        // لو العميل الاجل دفع فلوس واختار خزنة 
                            if( request('treasury_id') && request('amount_paid')){
                                $lastAmountOfTreasury = DB::table('treasury_bill_dets')
                                                ->where('treasury_id', request('treasury_id'))
                                                ->orderBy('id', 'desc')
                                                ->value('treasury_money_after');
        
                                $amount_paid = (float) request('amount_paid');
                            
                                $lastNumIdTreasuryDets = DB::table('treasury_bill_dets')->where('treasury_type', 'اذن توريد نقدية')->max('num_order');
                                
                                $lastRecordClient = DB::table('treasury_bill_dets')
                                                        ->where('client_supplier_id', request('client_id'))
                                                        ->orderBy('id', 'desc')
                                                        ->first();
                                                
                                if($lastRecordClient->remaining_money >= 0){
                                    $sumTotalBillAfterWithRemainingMoney = $calcTotalProductsAfter + $lastRecordClient->remaining_money;
                                    $userValue = $sumTotalBillAfterWithRemainingMoney - $amount_paid;                                    
                                }else{
                                    $sumTotalBillAfterWithRemainingMoney = $calcTotalProductsAfter + $lastRecordClient->remaining_money;
                                    $userValue = $sumTotalBillAfterWithRemainingMoney - $amount_paid;                                    
                                }
                                                                        
                                DB::table('treasury_bill_dets')->insert([
                                    'num_order' => ($lastNumIdTreasuryDets+1), 
                                    'date' => Carbon::now(),
                                    'treasury_id' => request('treasury_id'), 
                                    'treasury_type' => 'اذن توريد نقدية', 
                                    'bill_id' => $saleBillId, 
                                    'bill_type' => 'اضافة فاتورة مبيعات', 
                                    'client_supplier_id' => request('client_id'), 
                                    'treasury_money_after' => ($lastAmountOfTreasury + $amount_paid), 
                                    'amount_money' => 0, 
                                    'remaining_money' => $userValue, 
                                    'transaction_from' => null, 
                                    'transaction_to' => null, 
                                    'notes' => request('notes'), 
                                    'user_id' => auth()->user()->id, 
                                    'year_id' => $this->currentFinancialYear(),
                                    'created_at' => now()
                                ]);
                                
                            }elseif(!request('treasury_id') && !request('amount_paid')){ //  لو العميل اجل مدفعش فلوس ول يقم باختيار خزينة 
                                $lastNumIdTreasuryDets = DB::table('treasury_bill_dets')->where('treasury_type', 'اضافة فاتورة مبيعات')->max('num_order'); 
                                $lastRecordClient = DB::table('treasury_bill_dets')
                                                        ->where('client_supplier_id', request('client_id'))
                                                        ->orderBy('id', 'desc')
                                                        ->first();
                                                
                                if($lastRecordClient->remaining_money >= 0){
                                    $userValue = $calcTotalProductsAfter + $lastRecordClient->remaining_money;                                    
                                }else{                                   
                                    $userValue = ( $lastRecordClient->remaining_money + $calcTotalProductsAfter );
                                }
                                                                        
                                DB::table('treasury_bill_dets')->insert([
                                    'num_order' => ($lastNumIdTreasuryDets+1), 
                                    'date' => Carbon::now(),
                                    'treasury_id' => 0, 
                                    'treasury_type' => 'اضافة فاتورة مبيعات', 
                                    'bill_id' => $saleBillId, 
                                    'bill_type' => 'اضافة فاتورة مبيعات', 
                                    'client_supplier_id' => request('client_id'), 
                                    'remaining_money' => $userValue, 
                                    'notes' => request('notes'), 
                                    'user_id' => auth()->user()->id, 
                                    'year_id' => $this->currentFinancialYear(),
                                    'created_at' => now()
                                ]);
                            }
                        // end check if paied money of this bill or not لو دفعت فلوس للعميل هخصمها 
                    });
                }      
            // end new sum totalBillBefore And After         
        }
    }


    public function show($id){
        $find = DB::table('sale_bills')
                    ->leftJoin('store_dets', 'store_dets.bill_id', 'sale_bills.id')
                    ->leftJoin('treasury_bill_dets', 'treasury_bill_dets.bill_id', 'sale_bills.id')
                    ->leftJoin('products', 'products.id', 'store_dets.product_id')
                    ->leftJoin('units as small_unit', 'small_unit.id', 'products.smallUnit')
                    ->leftJoin('units as big_unit', 'big_unit.id', 'products.bigUnit')
                    ->leftJoin('financial_treasuries', 'financial_treasuries.id', 'sale_bills.treasury_id')
                    ->leftJoin('clients_and_suppliers', 'clients_and_suppliers.id', 'sale_bills.client_id')
                    ->leftJoin('financial_years', 'financial_years.id', 'sale_bills.year_id')
                    ->leftJoin('users', 'users.id', 'sale_bills.user_id')
                    ->where('sale_bills.id', $id)
                    ->where('store_dets.type', 'اضافة فاتورة مبيعات')
                    ->where('treasury_bill_dets.bill_type', 'اضافة فاتورة مبيعات')
                    ->select(
                        'sale_bills.*',
                        
                        'store_dets.product_id',
                        'store_dets.sell_price_small_unit',
                        'store_dets.last_cost_price_small_unit',
                        'store_dets.avg_cost_price_small_unit',
                        'store_dets.product_bill_quantity',
                        'store_dets.tax',
                        'store_dets.discount',
                        'store_dets.bonus',
                        'store_dets.total_before',
                        'store_dets.total_after',
                        'store_dets.return_quantity',

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
                            
        return response()->json($find);
    }




    
    public function edit($id)
    {
        if(request()->ajax()){
            $find = PurchaseBill::where('id', $id)->first();
            return response()->json($find);
        }
        return view('back.welcome');
    }

    public function update(Request $request, $id)
    {
        if (request()->ajax()){
            $find = PurchaseBill::where('id', $id)->first();

            $this->validate($request , [
                'name' => 'required|string|unique:purchases,name,'.$id,
            ],[
                'name.required' => 'إسم الوحدة مطلوب',
                'name.string' => 'حقل إسم الوحدة يجب ان يكون من نوع نص',
                'name.unique' => 'إسم الوحدة مستخدم من قبل',                
            ]);

            $find->update($request->all());
        }   
    }


    public function datatable()
    {
        $all = DB::table('sale_bills')
                    ->leftJoin('treasury_bill_dets', 'treasury_bill_dets.bill_id', 'sale_bills.id')
                    ->leftJoin('financial_treasuries', 'financial_treasuries.id', 'sale_bills.treasury_id')
                    ->leftJoin('clients_and_suppliers', 'clients_and_suppliers.id', 'sale_bills.client_id')
                    ->leftJoin('financial_years', 'financial_years.id', 'sale_bills.year_id')
                    ->leftJoin('users', 'users.id', 'sale_bills.user_id')
                    ->where('treasury_bill_dets.bill_type', 'اضافة فاتورة مبيعات')
                    ->select(
                        'sale_bills.*',
                        'clients_and_suppliers.name as supplierName',
                        'financial_treasuries.name as treasuryName',
                        'financial_years.name as financialName',
                        'users.name as userName',
                    )
                    ->get();

        return DataTables::of($all)
            ->addColumn('id', function($res){
                $id = $res->id; 
                        
                if($res->custom_bill_num &&  $res->custom_bill_num != $res->id ){
                    $id .= "<div>اخر ( $res->custom_bill_num )</div>"; 
                }
                
                return $id;
            })
            ->addColumn('supplierName', function($res){
                return $res->supplierName;
            })
            ->addColumn('treasuryName', function($res){
                return $res->treasuryName;
            })
            ->addColumn('count_items', function($res){
                return display_number($res->count_items);
            })
            ->addColumn('date', function($res){
                $dates = Carbon::parse($res->created_at)->format('d-m-Y')
                        .' <span style="font-weight: bold;margin: 0 7px;">'.Carbon::parse($res->created_at)->format('h:i:s a').'</span> <br/>';
                if($res->custom_date){
                    $dates.= 'تاريخ اخر '.Carbon::parse($res->custom_date)->format('Y-m-d');
                }

                return $dates;
            })
            ->addColumn('financialName', function($res){
                return $res->financialName;
            })
            ->addColumn('userName', function($res){
                return $res->userName;
            })
            ->addColumn('notes', function($res){
                return '<span data-bs-toggle="popover" data-bs-placement="bottom" title="'.$res->notes.'">
                            '.Str::limit($res->notes, 20).'
                        </span>';
            })
            ->addColumn('action', function($res){
                return '
                        <button type="button" class="btn btn-sm btn-success show" data-effect="effect-scale" data-toggle="modal" href="#showProductsModal" data-placement="top" data-toggle="tooltip" title="عرض الفاتورة" res_id="'.$res->id.'">
                            <i class="fas fa-eye"></i>
                        </button>
                        
                        <button type="button" class="btn btn-sm btn-primary print" data-effect="effect-scale" data-toggle="modal" href="#exampleModalCenter" data-placement="top" data-toggle="tooltip" title="طباعة الفاتورة" res_id="'.$res->id.'">
                            <i class="fas fa-print"></i>
                        </button>
                        
                        <button type="button" class="btn btn-sm btn-danger return_bill" data-effect="effect-scale" data-placement="top" data-toggle="tooltip" title="إرجاع الفاتورة" res_id="'.$res->id.'">
                            <i class="fas fa-reply"></i>
                        </button>
                ';
            })
            ->rawColumns(['id', 'supplierName', 'treasuryName', 'count_items', 'date', 'notes', 'userName', 'financialName', 'action'])
            ->toJson();
    }





    // start print /////////////////////////////
    public function print_receipt($id)
    {
        //$settings = Setting::first();
        $pageNameAr = 'تفاصيل فاتورة بيع رقم: ';
        $pageNameEn = 'sales';
        //$SalesHeader = SalesHeader::where('id', $id)
        //                            ->with('SalesHeaderRelSalesContent', 'BranchRelSalesHeader', 'ClientRelSalesHeader')
        //                            ->first();

        //$SalesContent = SalesContent::where('id', $id)->first();
        //$SalesContentGet = SalesContent::where('sales_bill_id', $id)->get();
        //$SalesContentCount = SalesContent::where('sales_bill_id', $id)->count();

        //$TotalVatBefore = 0;
        //$TotalBefore = 0;
        //$TotalVatAfter = 0;
        //$TotalAfter = 0;

        //foreach ($SalesContentGet as $row) {
        //    $TotalVatBefore += ( ($row->quantity * $row->sales_price * $row->vat) / 100 );
        //    $TotalBefore += $row->quantity * $row->sales_price;

        //    $TotalVatAfter += ( ($row->quantity * $row->price_after * $row->vat) / 100 );
        //    $TotalAfter += $row->quantity * $row->price_after;

        //}


        // , 'SalesHeader', 'SalesContent', 'SalesContentCount', 'TotalBefore', 'TotalAfter', 'TotalVatBefore', 'TotalVatAfter'
        return view('back.sales.print_receipt', compact('pageNameAr', 'pageNameEn'));

    }
    // end print /////////////////////////////
}