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
                $discount = (float) request('prod_discount')[$index];
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
                    DB::transaction(function() use($calcTotalProductsAfter, $calcTotalProductsBefore){
                        $lastNumId = DB::table('store_dets')->where('type', 'اضافة فاتورة مبيعات')->max('num_order');
                        $saleBillId = DB::table('sale_bills')->insertGetId([
                            'custom_bill_num' => request('custom_bill_num'),
                            'client_id' => request('client_id'),
                            'treasury_id' => request('treasury_id'),
                            'bill_discount' => request('bill_discount'),
                            'extra_money' => request('extra_money'),
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
                        
                    });
                }
                

            }elseif($getClientTypePayment->type_payment == 'آجل'){
                ///////////////////////////////////////////////////////////////////////////////  لو العميل اجل
                ///////////////////////////////////////////////////////////////////////////////  لو العميل اجل
                
                DB::transaction(function() use($calcTotalProductsAfter, $calcTotalProductsBefore){
                    $lastNumId = DB::table('store_dets')->where('type', 'اضافة فاتورة مبيعات')->max('num_order');
                
                    $saleBillId = DB::table('sale_bills')->insertGetId([
                        'custom_bill_num' => request('custom_bill_num'),
                        'client_id' => request('client_id'),
                        'treasury_id' => request('treasury_id'),
                        'bill_discount' => request('bill_discount'),
                        'extra_money' => request('extra_money'),
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
                });
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
                    ->where('treasury_bill_dets.bill_type', 'اضافة فاتورة مبيعات')
                    ->orWhere('treasury_bill_dets.bill_type', 'اذن توريد نقدية')
                    ->select(
                        'sale_bills.*',
                        
                        'store_dets.product_id',
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

                    //dd($find);
                            
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
                        'clients_and_suppliers.name as clientName',
                        'clients_and_suppliers.phone as clientPhone',
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
            ->addColumn('clientName', function($res){
                return $res->clientName;
            })
            ->addColumn('clientPhone', function($res){
                return $res->clientPhone;
            })
            ->addColumn('treasuryName', function($res){
                return $res->treasuryName;
            })
            ->addColumn('total_bill', function($res){
                $total_bill = '';
                
                if($res->total_bill_before != $res->total_bill_after){
                    $total_bill.= "
                        <span class='badge badge-danger text-white' style='font-size: 100% !important;'>قبل  ".display_number($res->total_bill_before)."</span>
                    ";

                    $total_bill .=  "<span style='font-size: 15px !important;'>بعد ".display_number($res->total_bill_after)."</span>";
                }else{
                    $total_bill .=  "<span style='font-size: 15px !important;'>".display_number($res->total_bill_after)."</span>";
                }
                
                
                return $total_bill;
            })
            ->addColumn('count_items', function($res){
                return display_number($res->count_items);
            })
            ->addColumn('date', function($res){
                $dates = Carbon::parse($res->created_at)->format('d-m-Y')
                        .' <span class="badge badge-dark text-white" style="margin: 0 7px;font-size: 100% !important;">'.Carbon::parse($res->created_at)->format('h:i:s a').'</span> <br/>';
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
                        <a type="button" href="'.url('sales_return/'.$res->id).'" class="btn btn-sm btn-danger return_bill" data-effect="effect-scale" data-placement="top" data-toggle="tooltip" title="إرجاع الفاتورة" res_id="'.$res->id.'">
                            <i class="fas fa-reply"></i>
                        </a>
                        
                        <button type="button" class="btn btn-sm btn-primary print" data-effect="effect-scale" data-toggle="modal" href="#exampleModalCenter" data-placement="top" data-toggle="tooltip" title="طباعة الفاتورة" res_id="'.$res->id.'">
                        <i class="fas fa-print"></i>
                        </button>
                        
                        <button type="button" class="btn btn-sm btn-success show" data-effect="effect-scale" data-toggle="modal" href="#showProductsModal" data-placement="top" data-toggle="tooltip" title="عرض الفاتورة" res_id="'.$res->id.'">
                            <i class="fas fa-eye"></i>
                        </button>
                ';

                //<button type="button" class="btn btn-sm btn-dark upload" data-effect="effect-scale" data-placement="top" data-toggle="tooltip" title="تحميل الفاتورة على المنصة الإلكترونية" res_id="'.$res->id.'">
                //    <i class="fas fa-file-upload"></i>
                //</button>
            })
            ->rawColumns(['id', 'clientName', 'treasuryName', 'count_items', 'total_bill', 'date', 'notes', 'userName', 'financialName', 'action'])
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
                    ->leftJoin('users', 'users.id', 'sale_bills.user_id')
                    ->where('store_dets.type', 'اضافة فاتورة مبيعات')
                    ->where('treasury_bill_dets.bill_type', 'اضافة فاتورة مبيعات')
                    ->orWhere('treasury_bill_dets.bill_type', 'اذن توريد نقدية')
                    ->select(
                        'sale_bills.*',
                        
                        'store_dets.product_id', 
                        'store_dets.current_sell_price_in_sale_bill', 
                        'store_dets.sell_price_small_unit', 
                        'store_dets.product_bill_quantity', 
                        'store_dets.total_before as productTotalBefore', 
                        'store_dets.total_after as productTotalAfter', 
                        'store_dets.product_id', 
                        'store_dets.product_id',  

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

                        'users.name as userName',
                    )
                    ->get();

                    // return $saleBill;

        if(count($saleBill) > 0){
            return view('back.sales.print_receipt', compact('pageNameAr', 'pageNameEn', 'saleBill'));
        }else{
            return redirect('/');
        }

    }
    // end print /////////////////////////////
}