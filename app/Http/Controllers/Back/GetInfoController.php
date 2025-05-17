<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetInfoController extends Controller
{
    public function supplierInfo($id){
        $supplierInfo = DB::table('treasury_bill_dets')
                                    ->where('client_supplier_id', $id)
                                    ->orderBy('id', 'desc')
                                    ->value('remaining_money');
                    //dd($supplierInfo);
    
        return response()->json($supplierInfo);
    }
    
    public function clientInfo($id){
        $clientInfo = DB::table('treasury_bill_dets')
                                    ->where('client_supplier_id', $id)
                                    ->orderBy('id', 'desc')
                                    ->value('remaining_money');
                    //dd($clientInfo);
        
        return response()->json($clientInfo);
    }
    
    public function treasury($id){
        
        $treasuryInfo = DB::table('treasury_bill_dets')->where('treasury_id', $id)->orderBy('id', 'desc')->first();        
        return response()->json($treasuryInfo);
    }
}