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

class PurchaseReturnBillController extends Controller
{
    public function index()
    {             
        $pageNameAr = 'فواتير مرتجع المشتريات';
        $pageNameEn = 'purchases_return';

        return view('back.purchases_return.index' , compact('pageNameAr' , 'pageNameEn'));
    }

    public function create($id)
    {                               
        $pageNameAr = ' مرتجع فاتورة مشتريات # ';
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
                    ->select(
                        'purchase_bills.*',
                        
                        'store_dets.product_id',
                        'store_dets.sell_price_small_unit',
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
                        'clients_and_suppliers.name as supplierName',
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
            return view('back.purchases_return.create' , compact('pageNameAr' , 'pageNameEn', 'suppliers', 'treasuries', 'find', 'userInfo'));
        }

    }

    public function store(Request $request, $id)
    {
        if (request()->ajax()){
            //$this->validate($request, [
            //    'supplier_id' => 'required|integer|exists:clients_and_suppliers,id',
            //    'financial_treasuries' => 'nullable|integer|exists:financial_treasuries,id',
            //    'custom_bill_num' => 'nullable|string',
                
            //    'custom_date' => 'nullable|date',
            //    'discount_bill' => 'nullable|numeric|min:0',
            //    'extra_money' => 'nullable|numeric|min:0',
            //    'tax_bill' => 'nullable|numeric|min:0',

            //    'product_new_qty' => 'array',
            //    'product_new_qty.*' => 'integer|min:1',
                
            //    'purchasePrice' => 'array',
            //    'purchasePrice.*' => 'numeric|min:1',
                
            //    'sellPrice' => 'array',
            //    'sellPrice.*' => 'numeric|min:1',
                
            //    'prod_tax' => 'array',
            //    'prod_tax.*' => 'nullable|numeric|min:0',
                
            //    'prod_discount' => 'array',
            //    'prod_discount.*' => 'nullable|numeric|min:0',
                
            //    //'prod_bonus' => 'array',
            //    //'prod_bonus.*' => 'nullable|numeric|min:0',
            //], [
            //    'required' => 'يجب تعبئة حقل :attribute، لا يمكن تركه فارغًا.',
            //    'string' => 'يجب أن يكون حقل :attribute عبارة عن نص.',
            //    'unique' => 'حقل :attribute مُستخدم مسبقًا، الرجاء اختيار قيمة مختلفة.',
            //    'integer' => 'يجب أن يكون حقل :attribute رقمًا صحيحًا (بدون كسور).',
            //    'numeric' => 'يجب أن يحتوي حقل :attribute على رقم صحيح أو عشري.',
            //    'min' => 'يجب ألا تكون قيمة :attribute أقل من :min.',
            //    'exists' => 'القيمة المحددة في حقل :attribute غير موجودة في السجلات.',
            //    'array' => 'يجب أن يكون حقل :attribute عبارة عن مجموعة عناصر.',
            //], [
            //    'supplier_id' => 'المورد',
            //    'financial_treasuries' => 'الخزينة المالية',
            //    'custom_bill_num' => 'رقم الفاتورة المخصص',
            //    'custom_date' => 'تاريخ الفاتورة',
            //    'discount_bill' => 'الخصم العام على الفاتورة',
            //    'extra_money' => 'مصاريف إضافية',
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
            //    //'prod_bonus.*' => 'بونص المنتج',
            //]);






            $purchaseBillInfo = DB::table('purchase_bills')->where('id', $id)->first();
            $purchaseBillDetsInfo = DB::table('store_dets')->where('bill_id', $id)->where('type', 'اضافة فاتورة مشتريات')->get();
            $treasuryBillDetsInfo = DB::table('treasury_bill_dets')->where('client_supplier_id', $purchaseBillInfo->supplier_id)->orderBy('id', 'DESC')->first();














            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            // بدايه العمليات الحسابيه الخاصه بكل منتج سواء سعر بيعه او عدد البيع او الضريبه وكذاله اجمالي سعر المنتجات كلها قبل وبعد الخصم
            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

            $calcTotalProductsBefore = 0; // مخصص لتجميع سعر كل منتج قبل الخصم والضريبه ودمج كل الاسعار في سعر واحد 
            $calcTotalProductsAfterBeforeFinal = 0; // مخصص لتجميع سعر كل منتج بعد الخصم والضريبه ودمجكل الاسعار في سعر واحد قبل خصم الفاتوره ومصاريف اضافيه للفاتوره وضريبه الفاتورة
            $calcTotalProductsAfter = 0; // مخصص لتجميع سعر كل منتج بعد الخصم والضريبه ودمجكل الاسعار في سعر واحد 
            
            $discount_bill = request('discount_bill'); // مخصص لخصم قيمه علي الفاتوره كلها
            $tax_bill = request('tax_bill'); // مخصص لضريبه القيمه المضافه علي الفاتوره كلها
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
                            
                $quantity = (float) request('product_new_qty')[$index];
                $purchasePrice = (float) request('purchasePrice')[$index];
                $sellPrice = (float) request('sellPrice')[$index];
                $discount = (float) request('prod_discount')[$index];
                $tax = (float) request('prod_tax')[$index];                    

                $calcTotalProductsBefore += $quantity * $purchasePrice; // مخصص لتجميع  المنتجات كلها قبل تطبيق اي خصومات او ضرائب
                
                $product_total = ( $quantity * $purchasePrice );    //  اجمالي الصنف قبل كسعر بيع
                $after_discount = $product_total - ( $product_total * $discount / 100 );    // اجمالي الصنف بعد الخصم نسبه
                $after_tax = $after_discount + ( $after_discount * $tax / 100 );    // اجمالي الصنف بعد الخصم والضريبه نسبة

                
                $calcTotalProductsAfterBeforeFinal += $after_discount + ( $after_discount * $tax / 100 );    // اجمالي سعر المنتجات بعد الخصم والضريبة
                
                $afterMinusStaticDiscount = $calcTotalProductsAfterBeforeFinal - $discount_bill ;
                $afterPlusExtraMoney = $afterMinusStaticDiscount + $extra_money ;
                $afterPlusTaxBill = $afterPlusExtraMoney + ($afterPlusExtraMoney * $tax_bill / 100) ;
                $calcTotalProductsAfter = $afterPlusTaxBill;    //  اجمالي سعر المنتجات بعد الخصم والضريبة لكل منتج + خصم ومصاريف اضافيه وضريبه الفاتوره كامله
            }

            dd($calcTotalProductsAfter);
            //dd($treasuryBillDetsInfo);

            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            // نهاية العمليات الحسابيه الخاصه بكل منتج سواء سعر بيعه او عدد البيع او الضريبه وكذاله اجمالي سعر المنتجات كلها قبل وبعد الخصم
            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




            


            DB::transaction(function() use ($calcTotalProductsBefore, $calcTotalProductsAfter){
                $lastNumId = DB::table('store_dets')->where('type', 'اضافة فاتورة مشتريات')->max('num_order');
                $purchaseBillId = DB::table('purchase_bills')->insertGetId([
                    'custom_bill_num' => request('custom_bill_num'),
                    'supplier_id' => request('supplier_id'),
                    'treasury_id' => request('treasury_id'),
                    'bill_tax' => request('tax_bill'),
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
                                
                    $quantity = (float) request('product_new_qty')[$index];
                    $purchasePrice = (float) request('purchasePrice')[$index];
                    $sellPrice = (float) request('sellPrice')[$index];
                    $discount = (float) request('prod_discount')[$index];
                    $tax = (float) request('prod_tax')[$index];
                    //$bonus = (float) request('prod_bonus')[$index];
                    
                                        
                    $totalQuantity = $lastProductQuantity + $quantity;
                    
                    $last_cost_price_small_unit = $purchasePrice;
                    $sell_price_small_unit = $sellPrice;
                    
                    $product_total = (  $quantity * $purchasePrice );    // اجمالي الصنف قبل
                    $after_discount = $product_total - ( $product_total * $discount / 100 );    // اجمالي الصنف بعد الخصم نسبه
                    $after_tax = $after_discount + ( $after_discount * $tax / 100 );    // اجمالي الصنف بعد الخصم والضريبه نسبة
                                        
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
                                                        ->orWhere('type', 'رصيد اول مدة للصنف')
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
                    ->where('treasury_bill_dets.bill_type', 'اضافة فاتورة مشتريات')
                    ->select(
                        'purchase_bills.*',
                        
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

     
    public function destroy($id)
    {
        
    }


    public function datatable()
    {
        $all = DB::table('purchase_bills')
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
}