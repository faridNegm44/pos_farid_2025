<?php
use App\Models\Back\Setting;
use Illuminate\Support\Facades\DB;

// start get GeneralSettingsInfo
    if (!function_exists('GeneralSettingsInfo')) {
        function GeneralSettingsInfo(){
            return Setting::first();
        }
    }
// end get GeneralSettingsInfo`


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