<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetInfoController extends Controller
{
    public function client_or_supplier($id, $type){
        if($type == 'عميل' || $type == 'مورد'){
            $userInfo = DB::table('treasury_bill_dets')
                                        ->where('client_supplier_id', $id)
                                        ->orderBy('id', 'desc')
                                        ->value('remaining_money');

            return response()->json($userInfo);

            dd($userInfo);
            
        }elseif($type == 'شريك'){
            $userInfo = DB::table('treasury_bill_dets')
                                        ->where('partner_id', $id)
                                        ->orderBy('id', 'desc')
                                        ->value('remaining_money');

            return response()->json($userInfo);

        }

                                    //dd($userInfo);                                        
    }
    
    //public function clientInfo($id){
    //    $clientInfo = DB::table('treasury_bill_dets')
    //                                ->where('client_supplier_id', $id)
    //                                ->orderBy('id', 'desc')
    //                                ->value('remaining_money');
    //                //dd($clientInfo);
        
    //    return response()->json($clientInfo);
    //}
    
    public function treasury($id){
        
        $treasuryInfo = DB::table('treasury_bill_dets')->where('treasury_id', $id)->orderBy('id', 'desc')->first();        
        return response()->json($treasuryInfo);
    }
    
    
    public function extra_expenses($id){
        $extra_expense = DB::table('extra_expenses')->where('id', $id)->first();        
        return response()->json($extra_expense);
    }
}