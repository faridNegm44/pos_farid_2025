<?php

use App\Models\Back\FinancialYears;
use App\Models\Back\Setting;
use App\Models\Back\User;
use Illuminate\Support\Facades\DB;



// start get curren financial year where status 1
    function getFinancialYear(){
        return FinancialYears::where('status', 1)->first();
    }
// end get curren financial year where status 1

// start get GeneralSettingsInfo
    if (!function_exists('GeneralSettingsInfo')) {
        function GeneralSettingsInfo(){
            return Setting::first();
        }
    }
// end get GeneralSettingsInfo`

// start get authUserInfo
    if (!function_exists('authUserInfo')) {
        function authUserInfo(){
            return User::where('id', auth()->user()->id)->first();
        }
    }
// end get authUserInfo`


// start show الارقام العشريه
if (!function_exists('display_number')) {
    function display_number($number) {
        if (strpos($number, '.') !== false) {
            // فقط إذا كانت .00 أو أصفار بعد الفاصلة
            if (preg_match('/\.0+$/', $number)) {
                return (int)$number;
            }
            return rtrim(rtrim($number, '0'), '.');
        }
        return $number;
    }
}
// end show الارقام العشريه




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

//// start function role_permissions
//function userPermissions(){
//    $permissions = DB::table('users')
//            ->where('users.id', auth()->user()->id)
//            ->leftJoin('roles_permissions', 'roles_permissions.id', '=', 'users.user_role')
//            ->select(
//                'users.*',
//                'roles_permissions.*',
//                'roles_permissions.id as role_permission_id',
//                'users.id as user_id' 
//            )
//            ->first();
        
//    return $permissions;
//}
//// end function role_permissions