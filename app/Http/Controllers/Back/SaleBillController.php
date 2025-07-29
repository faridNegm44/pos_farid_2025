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
        $extra_expenses = DB::table('extra_expenses')->orderBy('expense_type', 'asc')->get();                                

        return view('back.sales.create' , compact('pageNameAr' , 'pageNameEn', 'suppliers', 'treasuries', 'lastBillNum', 'extra_expenses'));
    }

    public function store(Request $request)
    {
        if (request()->ajax()){
            $this->validate($request, [
                'client_id' => 'required|integer|exists:clients_and_suppliers,id',
                'financial_treasuries' => 'nullable|integer|exists:financial_treasuries,id',
                'custom_bill_num' => 'nullable|string',
                'custom_date' => 'nullable|date',
                'bill_discount' => 'nullable|numeric|min:0',
                'extra_money' => 'nullable|numeric|min:0',
            
                'sale_quantity' => 'array',
                'sale_quantity.*' => 'integer|min:1',
            
                'purchasePrice' => 'array',
                'purchasePrice.*' => 'numeric|min:1',
            
                'sellPrice' => 'array',
                'sellPrice.*' => 'numeric|min:1',
            
                'prod_tax' => 'array',
                'prod_tax.*' => 'nullable|numeric|min:0',
            
                'prod_discount' => 'array',
                'prod_discount.*' => 'nullable|numeric|min:0',
            
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
                'client_id' => 'العميل',
                'financial_treasuries' => 'الخزينة المالية',
                'custom_bill_num' => 'رقم الفاتورة المخصص',
                'custom_date' => 'تاريخ الفاتورة',
                'bill_discount' => 'الخصم العام على الفاتورة',
                'extra_money' => 'مصاريف إضافية',
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
            ]);            


            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            // بدايه العمليات الحسابيه الخاصه بكل منتج سواء سعر بيعه او عدد البيع او الضريبه وكذاله اجمالي سعر المنتجات كلها قبل وبعد الخصم
            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

            $calcTotalProductsBefore = 0; // مخصص لتجميع سعر كل منتج قبل الخصم والضريبه ودمج كل الاسعار في سعر واحد 
            $calcTotalProductsAfterBeforeFinal = 0; // مخصص لتجميع سعر كل منتج بعد الخصم والضريبه ودمجكل الاسعار في سعر واحد قبل خصم الفاتوره ومصاريف اضافيه للفاتوره وضريبه الفاتورة
            $calcTotalProductsAfter = 0; // مخصص لتجميع سعر كل منتج بعد الخصم والضريبه ودمجكل الاسعار في سعر واحد 
            
            $bill_discount = request('bill_discount'); // مخصص لخصم قيمه علي الفاتوره كلها
            $extra_money = request('extra_money'); // مخصص للمصاريف الإضافيه
            
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
                $sellPrice = (float) request('sellPrice')[$index];
                $discount = (float) request('prod_discount')[$index] ;
                $tax = (float) request('prod_tax')[$index];                    

                
                $productInfo = DB::table('products')->where('id', $product_id)->first();
                if ($sale_quantity <= $lastProductQuantity) { // التاكد من ان الكميه المباعه اقل من او تساوي الموجوده في المخزن
                    $totalQuantity = $lastProductQuantity - $sale_quantity; // بقوم انقاص الكميه المباعه من رصيد المخزن
                    $onlyQuantityThisBill = $sale_quantity;

                    $calcTotalProductsBefore += $onlyQuantityThisBill * $sellPrice; // مخصص لتجميع  المنتجات كلها قبل تطبيق اي خصومات او ضرائب

                    $sell_price_small_unit = $sellPrice; // سعر البيع الي جاي من فاتوره البيع 
                    $last_cost_price_small_unit = $lastProductInfo->last_cost_price_small_unit; // جلب اخر سعر تكلفه من المنتج من اخر صف له 
                    $avg_cost_price_small_unit = $lastProductInfo->avg_cost_price_small_unit; // جلب اخر متوسط تكلفه من المنتج من اخر صف له 
                    
                    $product_total = ( $onlyQuantityThisBill * $sellPrice );    //  اجمالي السلعة/الخدمة قبل كسعر بيع
                    $after_discount = $product_total - ( $product_total * $discount / 100 );    // اجمالي السلعة/الخدمة بعد الخصم نسبه
                    $after_tax = $after_discount + ( $after_discount * $tax / 100 );    // اجمالي السلعة/الخدمة بعد الخصم والضريبه نسبة

                    
                    $calcTotalProductsAfterBeforeFinal += $after_discount + ( $after_discount * $tax / 100 );    // اجمالي سعر المنتجات بعد الخصم والضريبة
                    
                    $afterMinusStaticDiscount = $calcTotalProductsAfterBeforeFinal - $bill_discount ;
                    $afterPlusExtraMoney = $afterMinusStaticDiscount + $extra_money ;
                    $calcTotalProductsAfter = $afterPlusExtraMoney;    //  اجمالي سعر المنتجات بعد الخصم والضريبة لكل منتج + خصم ومصاريف اضافيه وضريبه الفاتوره كامله
                                                    
                }elseif($sale_quantity > $lastProductQuantity){
                    $sale_quantity_big_than_stock = sprintf(
                        '(%s) كمية المنتج المباعة أكبر من الكمية المتوفرة في المخزن كميه المخزن (%s) بينما الكمية المباعة (%s)',
                        $productInfo->nameAr,
                        display_number($lastProductQuantity),
                        $sale_quantity
                    );
                    return response()->json(['sale_quantity_big_than_stock' => $sale_quantity_big_than_stock]);
                }

            }
            //dd($calcTotalProductsAfter);
            //dd(floatval(request('amount_paid')));

            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            // نهاية العمليات الحسابيه الخاصه بكل منتج سواء سعر بيعه او عدد البيع او الضريبه وكذاله اجمالي سعر المنتجات كلها قبل وبعد الخصم
            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


            



            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            // بدايه التاكد من ان حاله العميل كاش او اجل
            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            $getClientTypePayment = DB::table('clients_and_suppliers')->where('id', request('client_id'))->first();                
            if($getClientTypePayment->type_payment == 'كاش'){
                ///////////////////////////////////////////////////////////////////////////////  لو العميل كاش
                ///////////////////////////////////////////////////////////////////////////////  لو العميل كاش

                if(request('amount_paid') === null || floatval(request('amount_paid')) !== $calcTotalProductsAfter){
                    return response()->json(['errorClientPayment' => '⚠️ عذرًا، هذا العميل غير مصرح له بالشراء الآجل.
                💵 يجب أن يكون المبلغ المدفوع مساويًا لقيمة الفاتورة المستحقة بالكامل.']);
                }else{
                    $response = DB::transaction(function() use($calcTotalProductsAfter, $calcTotalProductsBefore){
                        $lastNumId = DB::table('store_dets')->where('type', 'اضافة فاتورة مبيعات')->max('num_order');
                        
                        $saleBillId = DB::table('sale_bills')->insertGetId([
                            'custom_bill_num' => request('custom_bill_num'),
                            'client_id' => request('client_id'),
                            'treasury_id' => request('treasury_id'),
                            'bill_discount' => request('bill_discount'),
                            'extra_money' => request('extra_money'),
                            'extra_money_type' => request('extra_money_type'),
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
                                        
                            $lastProductInfo = DB::table('store_dets')
                                                ->where('product_id', $product_id)
                                                //->where('type', 'اضافة فاتورة مشتريات')
                                                ->orderBy('id', 'desc')
                                                ->first();                                        
                                        
                            $sale_quantity = (float) request('sale_quantity')[$index];
                            $sellPrice = (float) request('sellPrice')[$index];
                            $discount = (float) request('prod_discount')[$index];
                            $tax = (float) request('prod_tax')[$index];                    
        
                            // بدايه حساب اجمالي سعر كل منتج لوحده بعد الضرايب والخصم
                                $totalQuantity = $lastProductQuantity - $sale_quantity; // بقوم انقاص الكميه المباعه من رصيد المخزن
                                $onlyQuantityThisBill = $sale_quantity;
                                    
                                $last_cost_price_small_unit = $lastProductInfo->last_cost_price_small_unit; // جلب اخر سعر تكلفه من المنتج من اخر صف له 
                                $avg_cost_price_small_unit = $lastProductInfo->avg_cost_price_small_unit; // جلب اخر متوسط تكلفه من المنتج من اخر صف له 
                                
                                $product_total = ( $onlyQuantityThisBill * $sellPrice );    //  اجمالي السلعة/الخدمة قبل كسعر بيع
                                $after_discount = $product_total - ( $product_total * $discount / 100 );    // اجمالي السلعة/الخدمة بعد الخصم نسبه
                                $after_tax = $after_discount + ( $after_discount * $tax / 100 );    // اجمالي السلعة/الخدمة بعد الخصم والضريبه نسبة

                                // بدايه التاكد لو تم التغير ف سعر البيع للمنتج 
                                if($sellPrice == display_number($lastProductInfo->sell_price_small_unit)){
                                    $sell_price_small_unit = $sellPrice; 
                                    $current_sell_price_in_sale_bill = $sellPrice; 
                                }else{
                                    $sell_price_small_unit = $lastProductInfo->sell_price_small_unit; 
                                    $current_sell_price_in_sale_bill = $sellPrice; 
                                }
                                // نهايه التاكد لو تم التغير ف سعر البيع للمنتج 
                                
                            // نهاية حساب اجمالي سعر كل منتج لوحده بعد الضرايب والخصم
                            
                            DB::table('store_dets')->insert([
                                'num_order' => ($lastNumId + 1),
                                'type' => 'اضافة فاتورة مبيعات',
                                'year_id' => $this->currentFinancialYear(),
                                'bill_id' => $saleBillId,
                                'product_id' => $product_id,
                                'current_sell_price_in_sale_bill' => $current_sell_price_in_sale_bill,                                            
                                'sell_price_small_unit' => $sell_price_small_unit,                                            
                                'last_cost_price_small_unit' => $last_cost_price_small_unit,
                                'avg_cost_price_small_unit' => $avg_cost_price_small_unit, 
                                'product_bill_quantity' => $onlyQuantityThisBill,
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
                            
                        } // End foreach to request('prod_name')    
                    
        
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
                                                                
                        // عمل اذن توريد نقدية للعميل الكاش
                        DB::table('treasury_bill_dets')->insert([
                            'num_order' => ($lastNumIdTreasuryDets+1), 
                            'date' => Carbon::now(),
                            'treasury_id' => request('treasury_id'), 
                            'treasury_type' => 'اذن توريد نقدية', 
                            'bill_id' => $saleBillId, 
                            'bill_type' => 'اضافة فاتورة مبيعات', 
                            'client_supplier_id' => request('client_id'), 
                            'treasury_money_after' => ($lastAmountOfTreasury + $amount_paid), 
                            'amount_money' => $amount_paid, 
                            'remaining_money' => $calcTotalProductsAfter - $amount_paid, 
                            'transaction_from' => null, 
                            'transaction_to' => null, 
                            'notes' => request('notes'), 
                            'user_id' => auth()->user()->id, 
                            'year_id' => $this->currentFinancialYear(),
                            'created_at' => now()
                        ]);
                        
                        return response()->json(['bill_id' => $saleBillId]);
                    });

                    return $response;
                }
                

            }elseif($getClientTypePayment->type_payment == 'آجل'){
                ///////////////////////////////////////////////////////////////////////////////  لو العميل اجل
                ///////////////////////////////////////////////////////////////////////////////  لو العميل اجل
                
                $response = DB::transaction(function() use($calcTotalProductsAfter, $calcTotalProductsBefore){
                    $lastNumId = DB::table('store_dets')->where('type', 'اضافة فاتورة مبيعات')->max('num_order');
                
                    $saleBillId = DB::table('sale_bills')->insertGetId([
                        'custom_bill_num' => request('custom_bill_num'),
                        'client_id' => request('client_id'),
                        'treasury_id' => request('treasury_id'),
                        'bill_discount' => request('bill_discount'),
                        'extra_money' => request('extra_money'),
                        'extra_money_type' => request('extra_money_type'),
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
                                    
                        $lastProductInfo = DB::table('store_dets')
                                    ->where('product_id', $product_id)
                                    //->where('type', 'اضافة فاتورة مشتريات')
                                    ->orderBy('id', 'desc')
                                    ->first();
                                    
                        $sale_quantity = (float) request('sale_quantity')[$index];
                        $sellPrice = (float) request('sellPrice')[$index];
                        $discount = (float) request('prod_discount')[$index];
                        $tax = (float) request('prod_tax')[$index];                    
    
                        // بدايه حساب اجمالي سعر كل منتج لوحده بعد الضرايب والخصم
                            $totalQuantity = $lastProductQuantity - $sale_quantity; // بقوم انقاص الكميه المباعه من رصيد المخزن
                            $onlyQuantityThisBill = $sale_quantity;

                            $last_cost_price_small_unit = $lastProductInfo->last_cost_price_small_unit; // جلب اخر سعر تكلفه من المنتج من اخر صف له 
                            $avg_cost_price_small_unit = $lastProductInfo->avg_cost_price_small_unit; // جلب اخر متوسط تكلفه من المنتج من اخر صف له 
                            
                            $product_total = ( $onlyQuantityThisBill * $sellPrice );    //  اجمالي السلعة/الخدمة قبل كسعر بيع
                            $after_discount = $product_total - ( $product_total * $discount / 100 );    // اجمالي السلعة/الخدمة بعد الخصم نسبه
                            $after_tax = $after_discount + ( $after_discount * $tax / 100 );    // اجمالي السلعة/الخدمة بعد الخصم والضريبه نسبة

                            // بدايه التاكد لو تم التغير ف سعر البيع للمنتج 
                                if($sellPrice == display_number($lastProductInfo->sell_price_small_unit)){
                                    $sell_price_small_unit = $sellPrice; 
                                    $current_sell_price_in_sale_bill = $sellPrice; 
                                }else{
                                    $sell_price_small_unit = $lastProductInfo->sell_price_small_unit; 
                                    $current_sell_price_in_sale_bill = $sellPrice; 
                                }
                            // نهايه التاكد لو تم التغير ف سعر البيع للمنتج 
                            
                        // نهاية حساب اجمالي سعر كل منتج لوحده بعد الضرايب والخصم

                        
                        DB::table('store_dets')->insert([
                            'num_order' => ($lastNumId + 1),
                            'type' => 'اضافة فاتورة مبيعات',
                            'year_id' => $this->currentFinancialYear(),
                            'bill_id' => $saleBillId,
                            'product_id' => $product_id,
                            'current_sell_price_in_sale_bill' => $current_sell_price_in_sale_bill,                                            
                            'sell_price_small_unit' => $sell_price_small_unit,                                            
                            'last_cost_price_small_unit' => $last_cost_price_small_unit,
                            'avg_cost_price_small_unit' => $avg_cost_price_small_unit, 
                            'product_bill_quantity' => $onlyQuantityThisBill,
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
                        
                    } // End foreach to request('prod_name')         
    
                    // لو العميل الاجل دفع فلوس واختار خزنة 
                        if( request('treasury_id') && request('amount_paid')){
                            $lastAmountOfTreasury = DB::table('treasury_bill_dets')->where('treasury_id', request('treasury_id'))->orderBy('id', 'desc')->value('treasury_money_after');
    
                            $amount_paid = (float) request('amount_paid');
                            $lastNumIdTreasuryDets = DB::table('treasury_bill_dets')->where('treasury_type', 'اذن توريد نقدية')->max('num_order');
                            $lastRecordClient = DB::table('treasury_bill_dets')->where('client_supplier_id', request('client_id'))->orderBy('id', 'desc')->first();
                                            
                            $sumTotalBillAfterWithRemainingMoney = $calcTotalProductsAfter + $lastRecordClient->remaining_money;
                            $userValue = $sumTotalBillAfterWithRemainingMoney - $amount_paid;                                    
                                      
                            DB::table('treasury_bill_dets')->insert([
                                'num_order' => ($lastNumIdTreasuryDets+1), 
                                'date' => Carbon::now(),
                                'treasury_id' => request('treasury_id'), 
                                'treasury_type' => 'اذن توريد نقدية', 
                                'bill_id' => $saleBillId, 
                                'bill_type' => 'اضافة فاتورة مبيعات', 
                                'client_supplier_id' => request('client_id'), 
                                'treasury_money_after' => ($lastAmountOfTreasury + $amount_paid), 
                                'amount_money' => $amount_paid, 
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
                            $lastRecordClient = DB::table('treasury_bill_dets')->where('client_supplier_id', request('client_id'))->orderBy('id', 'desc')->first();
                                            
                            $userValue = $calcTotalProductsAfter + $lastRecordClient->remaining_money;                                    
                                                                        
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

                    return response()->json(['bill_id' => $saleBillId]);
                });

                return $response;
            }    
            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            // نهاية التاكد من ان حاله العميل كاش او اجل
            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
                    ->whereIn('store_dets.status', ['فاتورة ملغاة', 'نشط', 'تم تعديله', 'تم حذفه'])
                    ->whereIn('treasury_bill_dets.bill_type', ['اضافة فاتورة مبيعات', 'اذن توريد نقدية'])
                    ->select(
                        'sale_bills.*',
                        
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
                        'clients_and_suppliers.name as clientName',
                        'financial_treasuries.name as treasuryName',
                        'financial_years.name as financialName',
                        'users.name as userName',
                    )
                    ->get();

                    //dd(count($find));
                            
        return response()->json($find);
    }


    
    public function edit($id)
    {                                       
        $pageNameAr = ' تعديل فاتورة مبيعات رقم # ';
        $pageNameEn = 'edit';
        $clients = ClientsAndSuppliers::where('client_supplier_type', 3)
                                    ->orWhere('client_supplier_type', 4)
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
                    ->where('store_dets.status', 'نشط')
                    ->select(
                        'sale_bills.*',
                        
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
                                        ->where('client_supplier_id', $find[0]->client_id)
                                        ->orderBy('id', 'desc')
                                        ->value('remaining_money');

            return view('back.sales.edit' , compact('pageNameAr' , 'pageNameEn', 'clients', 'treasuries', 'extra_expenses', 'find', 'userInfo'));
        }

    }




    //////////////////////////////////////////////  حذف فاتورة مبيعات كامله  //////////////////////////////////////////////
    //////////////////////////////////////////////  حذف فاتورة مبيعات كامله  //////////////////////////////////////////////
    public function destroy_bill($id)
    {
        if(request()->ajax()){
            $rows = DB::table('store_dets')
                        ->join('sale_bills', 'sale_bills.id', 'store_dets.bill_id')
                        ->join('clients_and_suppliers', 'clients_and_suppliers.id', 'sale_bills.client_id')
                        ->select(
                            'store_dets.*', 

                            'clients_and_suppliers.id as client_id', 
                            'clients_and_suppliers.name as client_name', 
                            'clients_and_suppliers.type_payment', 

                            'sale_bills.total_bill_after', 
                        )
                        ->where('store_dets.bill_id', $id)
                        ->where('store_dets.type', 'اضافة فاتورة مبيعات')
                        ->get();


                        //dd($rows[0]->last_cost_price_small_unit);


            DB::transaction(function() use($rows, $id) {
                DB::table('sale_bills')->where('id', $id)->update([
                    'status' => 'فاتورة ملغاة',
                    'total_bill_before' => 0 ,
                    'count_items' => 0,
                    'bill_discount' => 0,
                    'extra_money' => 0,
                    'extra_money_type' => 0,
                    'total_bill_after' => 0,
                    'treasury_id' => null,
                ]);     

                foreach($rows as $row){
                    DB::table('store_dets')->where('id', $row->id)->update(['status' => 'فاتورة ملغاة']);                  

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
                    $last_cost_price_small_unit_saled = $row->last_cost_price_small_unit;
                    $product_bill_quantity = $row->product_bill_quantity;
                    $totalSaledQuantity = ($last_cost_price_small_unit_saled * $product_bill_quantity);             
                    
                    $avg_cost_price_small_unit = ($totalRemainingQuantity + $totalSaledQuantity) / ($quantity_small_unit + $product_bill_quantity);


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
                        'product_bill_quantity' => $row->product_bill_quantity,
                        'quantity_small_unit' => ( $lastRowInfoToProduct->quantity_small_unit + $row->product_bill_quantity),
                        'tax' => $row->tax,
                        'discount' => $row->discount,
                        'bonus' => $row->bonus,
                        'total_before' => $row->total_before,
                        'total_after' => $row->total_after,
                        'status' => 'ناتج عن حذف',
                        'transfer_from' => $row->transfer_from,
                        'transfer_to' => $row->transfer_to,
                        'transfer_quantity' => $row->transfer_quantity,
                        'date' => now(),
                        'created_at' => now(),
                    ]);
                }
        
                // ارجاع اجمالي الفاتوره الي حساب العميل مره اخري                                        
                $lastRecordClient = DB::table('treasury_bill_dets')->where('client_supplier_id', $rows[0]->client_id)->orderBy('id', 'desc')->first();
                $lastNumId = DB::table('treasury_bill_dets')->where('treasury_type', 'اذن مرتجع نقدية لعميل')->max('num_order');
            
                DB::table('treasury_bill_dets')->insert([
                    'num_order' => ($lastNumId+1), 
                    'date' => Carbon::now(),
                    'treasury_id' => 0, 
                    'treasury_type' => 'اذن مرتجع نقدية لعميل', 
                    'bill_id' => $id,
                    'bill_type' => 'اذن مرتجع نقدية لعميل', 
                    'client_supplier_id' => $rows[0]->client_id,
                    'partner_id' => null, 
                    'treasury_money_after' => 0, 
                    'amount_money' => $rows[0]->total_bill_after, 
                    'remaining_money' => ( $lastRecordClient->remaining_money - $rows[0]->total_bill_after ), 
                    'commission_percentage' => 0, 
                    'transaction_from' => null, 
                    'transaction_to' => null, 
                    'notes' => 'استرجاع إجمالي قيمة فاتورة بيع ملغاة لعميل '.$rows[0]->client_name,
                    'user_id' => auth()->user()->id, 
                    'year_id' => $this->currentFinancialYear(),
                    'created_at' => now()
                ]);           
                
            });
            return response()->json(['success_delete' => 'تم حذف الفاتورة بنجاح وإعادة الكميات للمخزن وتحديث متوسطات الأسعار']);

        }else{
            return view('back.welcome');
        }
    }
    
    
    
    
    //////////////////////////////////////////////  تعديل صنف واحد من فاتوره مبيعات  //////////////////////////////////////////////
    //////////////////////////////////////////////  تعديل صنف واحد من فاتوره مبيعات  //////////////////////////////////////////////
    public function update_product_from_bill(Request $request, $id)
    {
        if(request()->ajax()){
            $row = DB::table('store_dets')
                        ->join('sale_bills', 'sale_bills.id', 'store_dets.bill_id')
                        ->join('products', 'products.id', 'store_dets.product_id')
                        ->join('clients_and_suppliers', 'clients_and_suppliers.id', 'sale_bills.client_id')
                        ->select(
                            'store_dets.*', 

                            'clients_and_suppliers.id as client_id', 
                            'clients_and_suppliers.name as client_name', 
                            'clients_and_suppliers.type_payment', 
                            
                            'products.nameAr as productNameAr', 

                            //'sale_bills.bill_discount', 
                            //'sale_bills.extra_money', 
                            //'sale_bills.extra_money_type', 
                            'sale_bills.total_bill_before', 
                            'sale_bills.total_bill_after', 
                        )
                        ->where('store_dets.id', $id)
                        ->where('store_dets.type', 'اضافة فاتورة مبيعات')
                        ->first();


                        //dd($row);


            $originalSalePrice = (float) $row->current_sell_price_in_sale_bill; 
            $originalDiscount = (float) $row->discount; 
            $originalTax = (float) $row->tax; 
            $originalBefore = (float) $row->total_before; 
            $originalAfter = (float) $row->total_after; 
            
            $requestSalePrice = (float) request('rowSellPrice'); 
            $requestDiscount = (float) request('rowProdDiscount'); 
            $requestTax = (float) request('rowProdTax'); 

            if($requestSalePrice != $originalSalePrice || $requestDiscount != $originalDiscount || $requestTax != $originalTax){

                DB::transaction(function() use($row, $id, $requestSalePrice, $requestDiscount, $requestTax, $originalBefore, $originalAfter, $originalSalePrice, $originalDiscount ,$originalTax) {                                                     
                    // حساب اجمالي الفاتوره مره اخري بعد التعديل
                    $quantity = $row->product_bill_quantity;
                    $unitPrice = $requestSalePrice;
                    $discountPercentage = $requestDiscount;
                    $taxPercentage = $requestTax;

                    $totalBefore = $unitPrice * $quantity;
                    $discountAmount = $totalBefore * ($discountPercentage / 100);
                    $priceAfterDiscount = $totalBefore - $discountAmount;
                    $taxAmount = $priceAfterDiscount * ($taxPercentage / 100);
                    $totalAfterTax = $priceAfterDiscount + $taxAmount;

                    $calcDiffBefore = $totalBefore - $originalBefore;
                    $calcDiffAfter = $totalAfterTax - $originalAfter;



                    $finalAmountDiscountFromBillBefore = ( $requestSalePrice - $originalSalePrice ) * $quantity;
                    $finalAmountDiscountFromBillAfter = ( $totalAfterTax - $originalAfter );



                    dd([
                        
                        'originalSalePrice' => $originalSalePrice,
                        'originalDiscount' => $originalDiscount,
                        'originalTax' => $originalTax,
                        'originalBefore' => $originalBefore,
                        'originalAfter' => $originalAfter,
                        
                        'requestSalePrice' => $requestSalePrice,
                        'requestDiscount' => $requestDiscount,
                        'requestTax' => $requestTax,
                        
                        'calcDiffBefore' =>$calcDiffBefore, 
                        'calcDiffAfter' => $calcDiffAfter,
                        
                        'totalBefore' => $totalBefore,
                        'totalAfterTax' => $totalAfterTax,
                        
                        'finalAmountDiscountFromBillBefore' => $finalAmountDiscountFromBillBefore,
                        'finalAmountDiscountFromBillAfter' => $finalAmountDiscountFromBillAfter,
                        
                    ]);

                    // تحديث جدول store_dets العناصر المعدلة
                    DB::table('store_dets')->where('id', $id)->update([
                        'current_sell_price_in_sale_bill' => $requestSalePrice,
                        'discount' => $requestDiscount,
                        'tax' => $requestTax,
                        'total_before' => $totalBefore,
                        'total_after' => $totalAfterTax,
                        'status' => 'تم تعديله',
                        'updated_at' => now()
                    ]);


                    // تحديث جدول sale_bills ب اجمالي الفاتوره بعد التعديل
                    DB::table('sale_bills')->where('id', $row->bill_id)->update([
                        'status' => 'فاتورة معدلة',
                        'total_bill_before' => $calcDiffBefore >= 0 ? $row->total_bill_after + $calcDiffBefore : $row->total_bill_after - $calcDiffBefore,
                        'total_bill_after' => $calcDiffAfter >= 0 ? $row->total_bill_after + $calcDiffAfter : $row->total_bill_after - $calcDiffAfter,                    
                    ]);
                        
                    // ارجاع اجمالي الفاتوره الي حساب العميل مره اخري                                        
                    $lastRecordClient = DB::table('treasury_bill_dets')->where('client_supplier_id', $row->client_id)->orderBy('id', 'desc')->first();
                    $lastNumId = DB::table('treasury_bill_dets')->where('treasury_type', 'اذن مرتجع نقدية لعميل')->max('num_order');


                    $remaining_money = 0;
                    if($calcDiffAfter >= 0){
                        $remaining_money = $lastRecordClient->remaining_money + $calcDiffAfter;
                    }else{
                        $remaining_money = $lastRecordClient->remaining_money - $calcDiffAfter;
                    }
                
                    DB::table('treasury_bill_dets')->insert([
                        'num_order' => ($lastNumId+1), 
                        'date' => Carbon::now(),
                        'treasury_id' => 0, 
                        'treasury_type' => 'اذن مرتجع نقدية لعميل', 
                        'bill_id' => $id,
                        'bill_type' => 'اذن مرتجع نقدية لعميل', 
                        'client_supplier_id' => $row->client_id,
                        'partner_id' => null, 
                        'treasury_money_after' => 0, 
                        'amount_money' => $calcDiffAfter, 
                        'remaining_money' => $remaining_money, 
                        'commission_percentage' => 0, 
                        'transaction_from' => null, 
                        'transaction_to' => null, 
                        'notes' => 'تم تعديل سعر أو خصم أو ضريبة أحد الأصناف في فاتورة العميل ' . $row->client_name . '، وتم احتساب الفارق على حسابه.',
                        'user_id' => auth()->user()->id, 
                        'year_id' => $this->currentFinancialYear(),
                        'created_at' => now()
                    ]);           
                });

                return response()->json(['success_edit' => 'تم تعديل بيانات الصنف بنجاح وإعادة حساب إجمالي الفاتورة.']);                        

            }else{
                return response()->json([
                    'no_edits' => "ℹ️ لم يتم إجراء أي تغييرات على <span class='text-danger' style='font-size: 110%;'>{$row->productNameAr}</span> 
                        <p style='margin-top: 10px;'>البيانات الحالية مطابقة تمامًا لما تم إدخاله</p>
                    "
                ]);
            } 
        }else{
            return view('back.welcome');
        }
    }
    
    
    
    
    //////////////////////////////////////////////  حذف صنف واحد من فاتوره مبيعات  //////////////////////////////////////////////
    //////////////////////////////////////////////  حذف صنف واحد من فاتوره مبيعات  //////////////////////////////////////////////
    public function destroy_product_from_bill($id)
    {
        if(request()->ajax()){
            $row = DB::table('store_dets')
                        ->join('sale_bills', 'sale_bills.id', 'store_dets.bill_id')
                        ->join('clients_and_suppliers', 'clients_and_suppliers.id', 'sale_bills.client_id')
                        ->select(
                            'store_dets.*', 

                            'clients_and_suppliers.id as client_id', 
                            'clients_and_suppliers.name as client_name', 
                            'clients_and_suppliers.type_payment', 

                            'sale_bills.bill_discount',
                            'sale_bills.count_items',
                            'sale_bills.bill_discount',
                            'sale_bills.extra_money',
                            'sale_bills.extra_money_type',
                            'sale_bills.total_bill_before',
                            'sale_bills.total_bill_after',
                        )
                        ->where('store_dets.id', $id)
                        ->where('store_dets.type', 'اضافة فاتورة مبيعات')
                        ->first();


                        //dd($row);


            DB::transaction(function() use($row, $id) {
                ////////////////////////////////////////////////////////// بدايه العمل علي جدول store_dets
                    DB::table('store_dets')->where('id', $id)->update(['status' => 'تم حذفه']);

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
                        $last_cost_price_small_unit_saled = $row->last_cost_price_small_unit;
                        $product_bill_quantity = $row->product_bill_quantity;
                        $totalSaledQuantity = ($last_cost_price_small_unit_saled * $product_bill_quantity);             
                        
                        $avg_cost_price_small_unit = ($totalRemainingQuantity + $totalSaledQuantity) / ($quantity_small_unit + $product_bill_quantity);
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
                            'product_bill_quantity' => $row->product_bill_quantity,
                            'quantity_small_unit' => ( $lastRowInfoToProduct->quantity_small_unit + $row->product_bill_quantity),
                            'tax' => $row->tax,
                            'discount' => $row->discount,
                            'bonus' => $row->bonus,
                            'total_before' => $row->total_before,
                            'total_after' => $row->total_after,
                            'status' => 'ناتج عن حذف',
                            'transfer_from' => $row->transfer_from,
                            'transfer_to' => $row->transfer_to,
                            'transfer_quantity' => $row->transfer_quantity,
                            'date' => now(),
                            'created_at' => now(),
                        ]);
                    // إضافة صف جديد بنفس البيانات مع إعادة الكمية للمخزن وحالة "نشط"
                ////////////////////////////////////////////////////////// نهايه العمل علي جدول store_dets

                

                ////////////////////////////////////////////////////////// بدايه العمل علي جدول sale_bills
                    $checkCountItems = ($row->count_items - 1) == 0 ;
                    DB::table('sale_bills')->where('id', $row->bill_id)->update([
                        'status' => $checkCountItems ? 'فاتورة ملغاة' : 'فاتورة معدلة',
                        'total_bill_before' => $checkCountItems ? 0 : ($row->total_bill_before - $row->total_before),
                        'count_items' => ($row->count_items - 1),
                        'bill_discount' => $checkCountItems ? 0 : $row->bill_discount,
                        'extra_money' => $checkCountItems ? 0 : $row->extra_money,
                        'extra_money_type' => $checkCountItems ? 0 : $row->extra_money_type,
                        'total_bill_after' => $checkCountItems ? 0 : ($row->total_bill_after - $row->total_after),                    
                    ]);
                ////////////////////////////////////////////////////////// نهاية العمل علي جدول sale_bills

        
                ////////////////////////////////////////////////////////// بدايه العمل علي جدول treasury_bill_dets                                     
                    $lastRecordClient = DB::table('treasury_bill_dets')->where('client_supplier_id', $row->client_id)->orderBy('id', 'desc')->first();
                    $lastNumId = DB::table('treasury_bill_dets')->where('treasury_type', 'اذن مرتجع نقدية لعميل')->max('num_order');                
                    
                    //$finalAmountDiscountBefore = ($row->total_bill_before - $row->total_before);
                    //$finalAmountDiscountAfter = ($row->total_bill_after - $row->total_after);

                    //dd([
                    //    'finalAmountDiscountBefore' => $finalAmountDiscountBefore,
                    //    'finalAmountDiscountAfter' => $finalAmountDiscountAfter,
                    //]);



                    DB::table('treasury_bill_dets')->insert([
                        'num_order' => ($lastNumId+1), 
                        'date' => Carbon::now(),
                        'treasury_id' => 0, 
                        'treasury_type' => 'اذن مرتجع نقدية لعميل', 
                        'bill_id' => $id,
                        'bill_type' => 'اذن مرتجع نقدية لعميل', 
                        'client_supplier_id' => $row->client_id,
                        'partner_id' => null, 
                        'treasury_money_after' => 0, 
                        'amount_money' => $row->total_after, 
                        'remaining_money' => ( $lastRecordClient->remaining_money - $row->total_after ), 
                        'commission_percentage' => 0, 
                        'transaction_from' => null, 
                        'transaction_to' => null, 
                        'notes' => 'استرجاع إجمالي قيمة صنف تم حذفة من فاتورة مبيعات '.$row->client_name,
                        'user_id' => auth()->user()->id, 
                        'year_id' => $this->currentFinancialYear(),
                        'created_at' => now()
                    ]);           
                ////////////////////////////////////////////////////////// نهاية العمل علي جدول treasury_bill_dets                                     





                // بدايه توزيع خصم الفاتوره ع الاصناف => تخصم من اجمالي الصنف بعد ان وجدت
                    //$totalProductafter = $row->total_before;
                    //$totalProductAfter = $row->total_after;
                    //$totalBillBefore = $row->total_bill_before;
                    //$totalBillAfter = $row->total_bill_after;
                    //$billDiscount = $row->bill_discount;
                    //$extraMoney = $row->extra_money;
                    //$calcRatio = $totalProductAfter / $totalBillAfter;

                    //$calcDiffDiscountRatio = $calcRatio * $billDiscount; // نسبه الخصم التي تخصم من الصنف عند حذقه موزعه بالتساوي علي اجمالي الفاتوره                
                    ////$calcDiffExtraMoneyRatio = $calcRatio * $extraMoney; // نسبه المصاريف الاضافيه التي تخصم علي كل منتج عند حذفه موزعه بالتساوي علي اجمالي الفاتوره    

                    //$totalProductBeforeDiscountAndExtraMoney = ($totalBillBefore - $totalProductBefore) - ($calcDiffDiscountRatio);
                    //$totalProductAfterDiscountAndExtraMoney = ($totalBillAfter - $totalProductAfter) - ($calcDiffDiscountRatio);

                    //dd($totalProductBeforeDiscountAndExtraMoney, $totalProductAfterDiscountAndExtraMoney);
                // نهاية توزيع خصم الفاتوره ع الاصناف => تخصم من اجمالي الصنف بعد ان وجدت
            });
            return response()->json(['success_delete' => 'تم حذف الصنف من الفاتورة بنجاح']);

        }else{
            return view('back.welcome');
        }
    }




    //////////////////////////////////////////////  datatable  //////////////////////////////////////////////
    //////////////////////////////////////////////  datatable  //////////////////////////////////////////////
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
                    'clients_and_suppliers.name as clientName',
                    'clients_and_suppliers.phone as clientPhone',
                    'financial_treasuries.name as treasuryName',
                    'financial_years.name as financialName',
                    'users.name as userName',
                )
                ->get();

        return DataTables::of($all)
            ->addColumn('id', function($res){
                $id = '<span class="badge badge-warning" style="font-size: 110% !important;font-weight: bold;">#'.$res->id.'</span>';

                if($res->custom_bill_num &&  $res->custom_bill_num != $res->id ){
                    $id .= "<div style='font-size:90%;color:#888;'>اخر <span class='badge badge-warning'>$res->custom_bill_num</span></div>";
                }

                return $id;
            })
            ->addColumn('clientName', function($res){
                return '<span class="badge badge-secondary"><i class="fas fa-user"></i></span> <span style="font-weight:bold;">'.$res->clientName.'</span>';
            })
            ->addColumn('clientPhone', function($res){
                return '<span class="badge badge-light"><i class="fas fa-phone"></i></span> <span>'.$res->clientPhone.'</span>';
            })
            ->addColumn('treasuryName', function($res){
                return '<span class="badge badge-light"><i class="fas fa-university"></i></span> <span style="color:#007bff;font-weight:bold;">'.$res->treasuryName.'</span>';
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
            ->addColumn('count_items', function($res){
                return '<span class="badge badge-dark"> '.number_format($res->count_items).'</span>';
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
                            .'<a type="button" href="'.url('sales_return/'.$res->id).'" class="btn btn-sm btn-danger return_bill" data-effect="effect-scale" data-placement="top" data-toggle="tooltip" title="إرجاع الفاتورة" res_id="'.$res->id.'">
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

                            .'<a type="button" href="'.url('sales/edit/'.$res->id).'" class="btn btn-sm btn-outline-dark edit" data-effect="effect-scale" data-placement="top" data-toggle="tooltip" title="تعديل الفاتورة" res_id="'.$res->id.'">
                                <i class="fas fa-edit"></i> <span style="font-size:90%;font-weight:bold;">تعديل</span>
                            </a>'
                        .'</div>';
            })
            ->rawColumns(['id', 'clientName', 'clientPhone', 'treasuryName', 'count_items', 'total_bill', 'date', 'notes', 'userName', 'financialName', 'action'])
            ->toJson();
    }





    // start print /////////////////////////////
    public function print_receipt($id)
    {
        //$settings = Setting::first();
        $pageNameAr = 'بيان بيع ';
        $pageNameEn = 'sales';
        
        $saleBill = DB::table('sale_bills')
                    ->where('sale_bills.id', $id)
                    ->leftJoin('store_dets', 'store_dets.bill_id', 'sale_bills.id')
                    ->leftJoin('treasury_bill_dets', 'treasury_bill_dets.bill_id', 'sale_bills.id')
                    ->leftJoin('products', 'products.id', 'store_dets.product_id')
                    ->leftJoin('units', 'units.id', 'products.smallUnit')
                    ->leftJoin('financial_treasuries', 'financial_treasuries.id', 'sale_bills.treasury_id')
                    ->leftJoin('clients_and_suppliers', 'clients_and_suppliers.id', 'sale_bills.client_id')
                    ->leftJoin('financial_years', 'financial_years.id', 'sale_bills.year_id')
                    ->leftJoin('extra_expenses', 'extra_expenses.id', 'sale_bills.extra_money_type')
                    ->leftJoin('users', 'users.id', 'sale_bills.user_id')                    
                    ->select(
                        'sale_bills.*',
                        
                        'store_dets.product_id', 
                        'store_dets.status as store_det_status', 
                        'store_dets.current_sell_price_in_sale_bill', 
                        'store_dets.sell_price_small_unit', 
                        'store_dets.discount', 
                        'store_dets.tax', 
                        'store_dets.product_bill_quantity', 
                        'store_dets.total_before as productTotalBefore', 
                        'store_dets.total_after as productTotalAfter', 

                        'treasury_bill_dets.treasury_type',
                        'treasury_bill_dets.bill_type',
                        'treasury_bill_dets.treasury_money_after',
                        'treasury_bill_dets.amount_money',
                        'treasury_bill_dets.remaining_money',

                        'products.nameAr as productName',
                        'products.small_unit_numbers',
                        
                        'clients_and_suppliers.name as clientName', 
                        'clients_and_suppliers.address as clientAddress', 
                        'clients_and_suppliers.phone as clientPhone', 
                        
                        'financial_treasuries.name as treasuryName',
                        'financial_years.name as financialName',

                        'units.name as unitName', 
                        'extra_expenses.expense_type as extraExpensesName', 

                        'users.name as userName',
                    )
                    ->where('store_dets.type', 'اضافة فاتورة مبيعات')
                    ->where('store_dets.status', 'نشط')
                    ->where('treasury_bill_dets.bill_type', 'اضافة فاتورة مبيعات')
                    ->orWhere('treasury_bill_dets.bill_type', 'اذن توريد نقدية')
                    ->get();

                    // return count($saleBill);

        if(count($saleBill) > 0){
            return view('back.sales.print_receipt', compact('pageNameAr', 'pageNameEn', 'saleBill'));
        }else{
            return redirect('/');
        }

    }
    // end print /////////////////////////////
}