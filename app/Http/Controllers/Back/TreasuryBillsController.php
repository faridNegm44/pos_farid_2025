<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\ClientsAndSuppliers;
use App\Models\Back\FinancialTreasury;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TreasuryBillsController extends Controller
{
    public function index()
    {                   
        $pageNameAr = 'أجراء معاملة في الخزينة المالية';
        $pageNameEn = 'treasury_bills';
        
        return view('back.treasury_bills.index' , compact('pageNameAr' , 'pageNameEn'));
    }

    public function create()
    {                               
        $pageNameAr = 'أجراء معاملة في الخزينة المالية';
        $pageNameEn = 'treasury_bills';
        $treasuries = FinancialTreasury::where('status', 1)
                                        ->leftJoin('treasury_bill_dets', function ($join) {
                                            $join->on('treasury_bill_dets.treasury_id', '=', 'financial_treasuries.id')
                                                ->whereRaw('treasury_bill_dets.id = (select max(id) from treasury_bill_dets where treasury_bill_dets.treasury_id = financial_treasuries.id)');
                                        })
                                        ->select('financial_treasuries.*', 'treasury_bill_dets.money')
                                        ->get();

        $clients = DB::table('clients_and_suppliers')
                        ->where('client_supplier_type', 3)
                        ->orWhere('client_supplier_type', 4)
                        ->where('status', 1)
                        ->orderBy('name', 'asc')
                        ->get();

        $suppliers = DB::table('clients_and_suppliers')
                        ->where('client_supplier_type', 1)
                        ->orWhere('client_supplier_type', 2)
                        ->where('status', 1)
                        ->orderBy('name', 'asc')
                        ->get();


        return view('back.treasury_bills.create' , compact('pageNameAr' , 'pageNameEn', 'treasuries', 'clients', 'suppliers'));
    }


}
