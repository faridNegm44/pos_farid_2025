<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\ClientsAndSuppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReportsSuppliersDeptController extends Controller
{
    public function index()
    {         
        //if((userPermissions()->clients_report_view)){
            $pageNameAr = 'تقرير مديونية الموردين';        
            $suppliers = ClientsAndSuppliers::where('client_supplier_type', 1)
                                            ->orWhere('client_supplier_type', 2)
                                            ->orderBy('name', 'asc')
                                            ->get();   
            
                                            //return $suppliers;
            return view('back.reports.suppliers_debt.index' , compact('pageNameAr', 'suppliers'));
	
        //}else{
        //    return redirect('/')->with(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        //}  
                  
    }

    public function result(Request $request)
    {                   
        $pageNameAr = 'تقرير مديونية الموردين'; 

        $balance_type = request('balance_type');
        $from = $request->from ? date('Y-m-d H:i:s', strtotime($request->from)) : null;
        $to = $request->to ? date('Y-m-d H:i:s', strtotime($request->to)) : null;

        $query = DB::table('treasury_bill_dets as t1')
                        ->join('clients_and_suppliers', 'clients_and_suppliers.id', 't1.client_supplier_id')
                        ->select(
                            't1.*', 
                            'clients_and_suppliers.code as supplierCode', 
                            'clients_and_suppliers.name as supplierName', 
                            'clients_and_suppliers.phone as supplierPhone', 
                            'clients_and_suppliers.client_supplier_type',
                        )
                        ->whereIn('clients_and_suppliers.client_supplier_type', [1, 2])
                        ->whereRaw('t1.id = (SELECT MAX(id) FROM treasury_bill_dets WHERE client_supplier_id = t1.client_supplier_id)')
                        ->orderBy('t1.id', 'asc');

        if ($from && $to) {
            $query->whereBetween('t1.created_at', [$from, $to]);
        } elseif ($from) {
            $query->where('t1.created_at', '>=', $from);
        } elseif ($to) {
            $query->where('t1.created_at', '<=', $to);
        }
        
        if($balance_type == 'debtor'){ // علي المورد
            $query->where('t1.remaining_money', '>', 0);
        }else if($balance_type == 'creditor'){ // للمورد
            $query->where('t1.remaining_money', '<', 0);
        }else{
            return false;
        }

        $results = $query->get();       

        if(count($results) == 0){
            return redirect()->back()->with('notFound', '💡 لا توجد مديونيات مطابقة للبحث الحالي 🙏');
        }else{
            return view('back.reports.suppliers_debt.result' , compact('pageNameAr', 'results', 'balance_type', 'from', 'to'));
        }
    }
    
    public function result_pdf(Request $request)
    {                   
        $pageNameAr = 'تقرير مديونية الموردين'; 

        $client_id = request('client_id');
        $treasury_type = request('treasury_type');
        $from = $request->from ? date('Y-m-d H:i:s', strtotime($request->from)) : null;
        $to = $request->to ? date('Y-m-d H:i:s', strtotime($request->to)) : null;

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
                        ->orderBy('treasury_bill_dets.id', 'ASC');

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
            return view('back.reports.suppliers_debt.pdf' , compact('pageNameAr', 'results', 'treasury_type', 'client_id', 'from', 'to'));
        }
    }
}