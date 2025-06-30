<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\FinancialTreasury;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReportsTreasuryBills extends Controller
{
    public function index()
    {                  
        if((userPermissions()->treasury_bills_report_view)){
            $pageNameAr = 'تقرير عن حركة الخزائن المالية';        
            $treasuries = FinancialTreasury::where('status', 1)->orderBy('name', 'asc')->get();        
            //$treasuries = FinancialTreasury::where('status', 1)
            //                                ->leftJoin('treasury_bill_dets', function ($join) {
            //                                    $join->on('treasury_bill_dets.treasury_id', '=', 'financial_treasuries.id')
            //                                        ->whereRaw('treasury_bill_dets.id = (select max(id) from treasury_bill_dets where treasury_bill_dets.treasury_id = financial_treasuries.id)');
            //                                })
            //                                ->select('financial_treasuries.*', 'treasury_bill_dets.money')
            //                                ->get();        
    
    
            //return $treasuries;
            return view('back.reports.treasury_bills.index' , compact('pageNameAr', 'treasuries'));	
        }else{
            return redirect('/')->with(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        }  
         
    }
    
    
    public function result(Request $request)
    {                   
        $pageNameAr = 'تقرير عن حركة الخزائن المالية';      

        $treasury_id = request('treasury_id');
        $treasury_type = request('treasury_type');
        $from = $request->from ? date('Y-m-d H:i:s', strtotime($request->from)) : null;
        $to = $request->to ? date('Y-m-d H:i:s', strtotime($request->to)) : null;

        $query = DB::table('treasury_bill_dets')
                    ->leftJoin('financial_treasuries', 'financial_treasuries.id', 'treasury_bill_dets.treasury_id')
                    ->leftJoin('clients_and_suppliers', 'clients_and_suppliers.id', 'treasury_bill_dets.client_supplier_id')
                    ->leftJoin('users', 'users.id', 'treasury_bill_dets.user_id')
                    ->leftJoin('financial_years', 'financial_years.id', 'treasury_bill_dets.year_id')
                    ->leftJoin('expenses', 'expenses.id', 'treasury_bill_dets.bill_id')
                    ->select(
                        'treasury_bill_dets.*', 
                        'financial_treasuries.name as treasury_name',
                        'clients_and_suppliers.name as clients_or_supplier_name',
                        'users.name as user_name',
                        'financial_years.name as financial_years',
                        'expenses.title as expensesTitle',
                    );
                    //->orderBy('treasury_bill_dets.id', 'desc');

        if($treasury_id){
            $query->where('treasury_bill_dets.treasury_id', $treasury_id);
        }
        
        if($treasury_type){
            $query->where('treasury_bill_dets.treasury_type', $treasury_type);
        }

        if ($from && $to) {
            $query->whereBetween('treasury_bill_dets.created_at', [$from, $to]);
        } elseif ($from) {
            $query->where('treasury_bill_dets.created_at', '>=', $from);
        } elseif ($to) {
            $query->where('treasury_bill_dets.created_at', '<=', $to);
        }

        $results = $query->paginate(50);       

        if($results->total() == 0){
            return redirect()->back()->with('notFound', 'لايوجد حركات تمت بناءا علي بحثك');
        }else{
            return view('back.reports.treasury_bills.result' , compact('pageNameAr', 'results', 'treasury_id', 'treasury_type', 'from', 'to'));
        }
    }
    
    public function result_pdf(Request $request)
    {                   
        $pageNameAr = 'تقرير عن حركة الخزائن المالية';      

        $treasury_id = request('treasury_id');
        $treasury_type = request('treasury_type');
        $from = $request->from ? date('Y-m-d H:i:s', strtotime($request->from)) : null;
        $to = $request->to ? date('Y-m-d H:i:s', strtotime($request->to)) : null;

        $query = DB::table('treasury_bill_dets')
                    ->leftJoin('financial_treasuries', 'financial_treasuries.id', 'treasury_bill_dets.treasury_id')
                    ->leftJoin('clients_and_suppliers', 'clients_and_suppliers.id', 'treasury_bill_dets.client_supplier_id')
                    ->leftJoin('users', 'users.id', 'treasury_bill_dets.user_id')
                    ->leftJoin('financial_years', 'financial_years.id', 'treasury_bill_dets.year_id')
                    ->leftJoin('expenses', 'expenses.id', 'treasury_bill_dets.bill_id')
                    ->select(
                        'treasury_bill_dets.*', 
                        'financial_treasuries.name as treasury_name',
                        'clients_and_suppliers.name as clients_or_supplier_name',
                        'users.name as user_name',
                        'financial_years.name as financial_years',
                        'expenses.title as expensesTitle',
                    )
                    ->orderBy('treasury_bill_dets.id', 'asc');

        if($treasury_id){
            $query->where('treasury_bill_dets.treasury_id', $treasury_id);
        }
        
        if($treasury_type){
            $query->where('treasury_bill_dets.treasury_type', $treasury_type);
        }

        if ($from && $to) {
            $query->whereBetween('treasury_bill_dets.created_at', [$from, $to]);
        } elseif ($from) {
            $query->where('treasury_bill_dets.created_at', '>=', $from);
        } elseif ($to) {
            $query->where('treasury_bill_dets.created_at', '<=', $to);
        }

        $results = $query->get();

        //return $results;

        if(count($results) == 0){
            return redirect()->back()->with('notFound', 'لايوجد حركات تمت بناءا علي بحثك');
        }else{
            return view('back.reports.treasury_bills.pdf' , compact('pageNameAr', 'results', 'treasury_id', 'treasury_type', 'from', 'to'));
        }
    }
}
