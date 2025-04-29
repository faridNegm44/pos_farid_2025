<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\ClientsAndSuppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReportsClientsController extends Controller
{
    public function index()
    {                   
        $pageNameAr = 'تقرير عن حركة عميل';        
        $clients = ClientsAndSuppliers::where('client_supplier_type', 3)
                                        ->orWhere('client_supplier_type', 4)
                                        ->orderBy('name', 'asc')
                                        ->get();   
        
                                        //return $clients;
        return view('back.reports.clients.index' , compact('pageNameAr', 'clients'));
    }

    public function result(Request $request)
    {                   
        $pageNameAr = 'تقرير عن حركة عميل'; 

        $client_id = request('client_id');
        $treasury_type = request('treasury_type');
        $from = request('from');
        $to = request('to');

        $query = DB::table('treasury_bill_dets')
                        ->leftJoin('financial_treasuries', 'financial_treasuries.id', 'treasury_bill_dets.treasury_id')
                        ->join('clients_and_suppliers', 'clients_and_suppliers.id', 'treasury_bill_dets.client_supplier_id')
                        ->leftJoin('financial_years', 'financial_years.id', 'treasury_bill_dets.year_id')
                        ->leftJoin('users', 'users.id', 'treasury_bill_dets.user_id')
                        ->select(
                            'treasury_bill_dets.*', 
                            'financial_treasuries.name as treasury_name',
                            'clients_and_suppliers.name as clientName', 'clients_and_suppliers.client_supplier_type',
                            'users.name as userName',
                            'financial_years.name as financialYearName',
                        )
                        ->whereIn('clients_and_suppliers.client_supplier_type', [3, 4])
                        ->orderBy('treasury_bill_dets.created_at', 'ASC');

        if ($from && $to) {
            $query->whereBetween('treasury_bill_dets.created_at', [$from, $to]);
        } elseif ($from) {
            $query->where('treasury_bill_dets.created_at', '>=', $from);
        } elseif ($to) {
            $query->where('treasury_bill_dets.created_at', '<=', $to);
        }
        
        if($client_id){
            $query->where('treasury_bill_dets.client_supplier_id', $client_id);
        }
        
        if($treasury_type){
            $query->where('treasury_bill_dets.treasury_type', $treasury_type);
        }

        $results = $query->get();       

        if(count($results) == 0){
            return redirect()->back()->with('notFound', 'لايوجد حركات تمت بناءا علي بحثك');
        }else{
            return view('back.reports.clients.result' , compact('pageNameAr', 'results', 'treasury_type', 'client_id', 'from', 'to'));
        }
    }
    
    public function result_pdf(Request $request)
    {                   
        $pageNameAr = 'تقرير عن حركة عميل'; 

        $client_id = request('client_id');
        $treasury_type = request('treasury_type');
        $from = request('from');
        $to = request('to');

        $query = DB::table('treasury_bill_dets')
                        ->leftJoin('financial_treasuries', 'financial_treasuries.id', 'treasury_bill_dets.treasury_id')
                        ->join('clients_and_suppliers', 'clients_and_suppliers.id', 'treasury_bill_dets.client_supplier_id')
                        ->leftJoin('financial_years', 'financial_years.id', 'treasury_bill_dets.year_id')
                        ->leftJoin('users', 'users.id', 'treasury_bill_dets.user_id')
                        ->select(
                            'treasury_bill_dets.*', 
                            'financial_treasuries.name as treasury_name',
                            'clients_and_suppliers.name as clientName', 'clients_and_suppliers.client_supplier_type',
                            'users.name as userName',
                            'financial_years.name as financialYearName',
                        )
                        ->whereIn('clients_and_suppliers.client_supplier_type', [3, 4])
                        ->orderBy('treasury_bill_dets.created_at', 'ASC');

        if ($from && $to) {
            $query->whereBetween('treasury_bill_dets.created_at', [$from, $to]);
        } elseif ($from) {
            $query->where('treasury_bill_dets.created_at', '>=', $from);
        } elseif ($to) {
            $query->where('treasury_bill_dets.created_at', '<=', $to);
        }
        
        if($client_id){
            $query->where('treasury_bill_dets.client_supplier_id', $client_id);
        }
        
        if($treasury_type){
            $query->where('treasury_bill_dets.treasury_type', $treasury_type);
        }

        $results = $query->get();       

        if(count($results) == 0){
            return redirect()->back()->with('notFound', 'لايوجد حركات تمت بناءا علي بحثك');
        }else{
            return view('back.reports.clients.pdf' , compact('pageNameAr', 'results', 'treasury_type', 'client_id', 'from', 'to'));
        }
    }
    
}