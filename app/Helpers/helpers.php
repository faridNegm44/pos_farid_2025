<?php

use App\Models\Back\FinancialYears;
use App\Models\Back\Setting;
use App\Models\Back\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

// start convertAmountToArabicWords
//if (!function_exists('convertAmountToArabicWords')) {
//    function convertAmountToArabicWords($amount)
//    {
//        require_once base_path('vendor/ar-php/arabic/Arabic.php');

//        $Arabic = new Arabic('Numbers');

//        $whole = floor($amount);
//        $fraction = round(($amount - $whole) * 100);

//        $text = $Arabic->int2str($whole) . ' جنيهاً';

//        if ($fraction > 0) {
//            $text .= ' و' . $Arabic->int2str($fraction) . ' قرشاً';
//        }

//        return 'مبلغ وقدره فقط: ' . $text;
//    }
//}
// end convertAmountToArabicWords


// start get curren financial year where status 1 => السنوات المالية
    function getFinancialYear(){
        return FinancialYears::where('status', 1)->first();
    }
// end get curren financial year where status 1 => السنوات المالية


// start get GeneralSettingsInfo
    if (!function_exists('GeneralSettingsInfo')) {
        function GeneralSettingsInfo(){
            return Setting::first();
        }
    }
// end get GeneralSettingsInfo


// start get authUserInfo
    if (!function_exists('authUserInfo')) {
        function authUserInfo(){
            return User::where('users.id', auth()->user()->id)
                        ->leftJoin('roles_permissions', 'roles_permissions.id', '=', 'users.role')
                        ->select(
                            'users.*',
                            'roles_permissions.role_name'
                        )
                        ->first();
        }
    }
// end get authUserInfo


// start show الارقام العشريه
if (!function_exists('display_number')) {
    function display_number($number) {
        // تأكد أنه رقم
        if (!is_numeric($number)) {
            return $number;
        }

        if (strpos($number, '.') !== false) {
            // إذا كانت فقط .00 أو أصفار بعد الفاصلة
            if (preg_match('/\.0+$/', $number)) {
                return number_format((int)$number);
            }

            // إزالة الأصفار الزائدة بعد الفاصلة بدون تقريب
            $trimmed = rtrim(rtrim($number, '0'), '.');
            return number_format($trimmed, strlen(substr(strrchr($trimmed, '.'), 1)), '.', ',');
        }

        // رقم صحيح بدون فاصل عشري
        return number_format($number);
    }
}
// end show الارقام العشريه


// start get type of cost price from settings  
function getCostPrice(){
    return DB::table('settings')->first(); 
}
// end get type of cost price from settings  


// start function role_permissions
function userPermissions(){
    $permissions = DB::table('users')
            ->where('users.id', auth()->user()->id)
            ->leftJoin('roles_permissions', 'roles_permissions.id', '=', 'users.role')
            ->select('roles_permissions.*')
            ->first();
        
    return $permissions;
}
// end function role_permissions


///////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////// بداية احصائيات الصفحة الرئيسية /////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////

// start get last 5 sale bill
function getLastSaleBills(){
    $getLastSaleBills = DB::table('sale_bills')
                                ->leftJoin('store_dets', 'store_dets.bill_id', 'sale_bills.id')
                                ->leftJoin('clients_and_suppliers', 'clients_and_suppliers.id', 'sale_bills.client_id')
                                ->where('store_dets.type', 'اضافة فاتورة مبيعات')
                                ->groupBy('store_dets.num_order')
                                ->orderBy('sale_bills.id', 'desc')
                                ->select(
                                    'sale_bills.*',
                                    'clients_and_suppliers.name as clientName',
                                )
                                ->take(5)
                                ->get();
                                
    return $getLastSaleBills;
}
// end get last 5 sale bill


// start get last 5 purchase bill
function getLastPurchaseBills(){
    $getLastPurchaseBills = DB::table('purchase_bills')
                                ->leftJoin('store_dets', 'store_dets.bill_id', 'purchase_bills.id')
                                ->leftJoin('clients_and_suppliers', 'clients_and_suppliers.id', 'purchase_bills.supplier_id')
                                ->where('store_dets.type', 'اضافة فاتورة مشتريات')
                                ->groupBy('store_dets.num_order')
                                ->orderBy('purchase_bills.id', 'desc')
                                ->select(
                                    'purchase_bills.*',
                                    'clients_and_suppliers.name as supplierName',
                                )
                                ->take(5)
                                ->get();
                                
    return $getLastPurchaseBills;
}
// end get last 5 purchase bill


// start get last 5 products top sales => الأصناف الأكثر مبيعا
function topProductsInSales(){
    $topProducts = DB::table('sale_bills')
                    ->leftJoin('store_dets', 'store_dets.bill_id', 'sale_bills.id')
                    ->leftJoin('products', 'products.id', 'store_dets.product_id')
                    ->groupBy('store_dets.product_id')
                    ->where('store_dets.type', 'اضافة فاتورة مبيعات')
                    ->select(
                        DB::raw('SUM(store_dets.product_bill_quantity) as total_product'),
                        'products.nameAr as productNameAr',
                        'products.id as productId',
                    )
                    ->orderBy('total_product', 'desc')
                    ->limit(5)
                    ->get();

    return $topProducts;
}
// end get last 5 products top sales => الأصناف الأكثر مبيعا


// start get last 5 clients top purchases => العملاء الأكثر شراءا
function topClientsPurchases(){
    $topClients = DB::table('sale_bills')
                    ->leftJoin('clients_and_suppliers', 'clients_and_suppliers.id', 'sale_bills.client_id')
                    ->select(
                        'client_id', 
                        DB::raw('SUM(total_bill_after) as client_total'),
                        'clients_and_suppliers.name'
                    )
                    ->groupBy('client_id')
                    ->orderBy('client_total', 'desc')
                    ->limit(5)
                    ->get();

                    //dd($topClients);
    return $topClients;
}
// end get last 5 clients top purchases => العملاء الأكثر شراءا



// start count total expenses today => مصروفات اليوم
function totalExpensesToday(){
    $totalExpenses = DB::table('expenses')->whereDate('created_at', Carbon::today())->where('status', 'اضافة')->sum('amount'); 
    return $totalExpenses;
}
// end count total expenses today => مصروفات اليوم



// start count total sales today => اجمالي مبيعات اليوم 
function totalSalesToday(){
    $totalSales = DB::table('sale_bills')->whereDate('created_at', Carbon::today())->sum('total_bill_after'); 
    return $totalSales;
}
// end count total sales today => اجمالي مبيعات اليوم 


// start => حساب الربحيه اليوم
function totalProfitToday(){
    $totalProductsSellPriceToday = DB::table('store_dets')->where('type', 'اضافة فاتورة مبيعات')->whereDate('created_at', Carbon::today())->sum('total_after'); 
    
    $totalProductsCostPriceToday = DB::table('store_dets')
                    ->where('type', 'اضافة فاتورة مبيعات')
                    ->whereDate('created_at', Carbon::today())
                    ->get()
                    ->sum(function ($row) {
                        return ( ( getCostPrice()->cost_price == 1 ? $row->last_cost_price_small_unit : $row->avg_cost_price_small_unit ) * $row->product_bill_quantity)
                            + $row->tax
                            //+ $row->extra_money
                            - $row->discount;
                    });
    
    $profit = ($totalProductsSellPriceToday - $totalProductsCostPriceToday) - totalExpensesToday();
    
    return [
        'totalProductsSellPriceToday' => $totalProductsSellPriceToday,
        'totalProductsCostPriceToday' => $totalProductsCostPriceToday,
        'profit' => $profit
    ];
}
// end => حساب الربحيه اليوم



// start stock_alert => أصناف وصلت للحد الأدنى
function stockAlert(){
    $stockAlert = DB::table('store_dets')
                    ->leftJoin('products', 'products.id', 'store_dets.product_id')
                    ->leftJoin('product_categoys', 'product_categoys.id', 'products.category')
                    ->leftJoin('stores', 'stores.id', 'products.store')

                    ->whereIn('store_dets.id', function($query){
                        $query->select(DB::raw('MAX(id)'))
                            ->from('store_dets')
                            ->groupBy('store_dets.product_id');
                    })

                    ->whereColumn('products.stockAlert', '>=', 'store_dets.quantity_small_unit')
                    ->orderBy('products.nameAr', 'asc')
                    ->count();

    return $stockAlert;
}
// end stock_alert => أصناف وصلت للحد الأدنى



// start count total financial_treasury => حساب اجمالي الفلوس في جميع الخزائن
function totalFinancialTreasury(){
    $latestBalances = DB::table('treasury_bill_dets as t1')
                        ->select('t1.treasury_id', 't1.treasury_money_after')
                        ->where('t1.treasury_id', '!=', 0)
                        ->whereRaw(
                            't1.id = (SELECT MAX(t2.id) FROM treasury_bill_dets t2 WHERE t2.treasury_id = t1.treasury_id)'
                        )
                        ->sum('treasury_money_after');

    return $latestBalances;
}
// end count total financial_treasury => حساب اجمالي الفلوس في جميع الخزائن

///////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////// نهاية احصائيات الصفحة الرئيسية /////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////