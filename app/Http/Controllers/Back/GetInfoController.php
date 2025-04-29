<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetInfoController extends Controller
{
    public function client_or_supplier($id){
        
        $clientOrSupplierInfo = DB::table('treasury_bill_dets')
                    ->leftJoin('clients_and_suppliers', 'clients_and_suppliers.id', 'treasury_bill_dets.client_supplier_id')
                    ->where('treasury_bill_dets.client_supplier_id', $id)
                    ->select(
                        'clients_and_suppliers.name as clientOrSupplierName', 
                        'treasury_bill_dets.*', 
                    )
                    ->orderBy('treasury_bill_dets.id', 'desc')
                    ->first();

                    //dd($clientOrSupplierInfo);
        
        return response()->json($clientOrSupplierInfo);
    }
    
    public function treasury($id){
        
        $treasuryInfo = DB::table('treasury_bill_dets')->where('treasury_id', $id)->orderBy('id', 'desc')->first();        
        return response()->json($treasuryInfo);
    }
}
