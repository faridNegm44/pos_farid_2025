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
        if((userPermissions()->clients_report_view)){
            $pageNameAr = 'تقرير عن حركة عميل';        
            $clients = ClientsAndSuppliers::where('client_supplier_type', 3)
                                            ->orWhere('client_supplier_type', 4)
                                            ->orderBy('name', 'asc')
                                            ->get();   
            
                                            //return $clients;
            return view('back.reports.clients.index' , compact('pageNameAr', 'clients'));
	
        }else{
            return redirect('/')->with(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        }  
                  
    }

    public function result(Request $request)
    {                   
        $pageNameAr = 'تقرير عن حركة عميل'; 

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
                            'clients_and_suppliers.code as clientCode', 'clients_and_suppliers.name as clientName', 'clients_and_suppliers.client_supplier_type',
                            'users.name as userName',
                            'financial_years.name as financialYearName',
                        )
                        ->whereIn('clients_and_suppliers.client_supplier_type', [3, 4])
                        ->orderBy('treasury_bill_dets.id', 'asc');

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

        $results = $query->paginate(50);       

        if($results->total() == 0){
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
            return view('back.reports.clients.pdf' , compact('pageNameAr', 'results', 'treasury_type', 'client_id', 'from', 'to'));
        }
    }


    ////////////////////////////////////////////////////////////  كشف حساب  ////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////  كشف حساب  ////////////////////////////////////////////////////////////


    // start index account_statement
    public function account_statement()
    {                   
        if((userPermissions()->clients_account_statement_view)){
            $pageNameAr = 'كشف حساب للعملاء';        
            $clients = ClientsAndSuppliers::where('client_supplier_type', 3)
                                            ->orWhere('client_supplier_type', 4)
                                            ->orderBy('name', 'asc')
                                            ->get();   
            
                                            //return $clients;
            return view('back.reports.clients.account_statement' , compact('pageNameAr', 'clients'));
	
        }else{
            return redirect('/')->with(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        }  
        
    }

    public function account_statement_pdf(Request $request)
    {                   
        $pageNameAr = 'كشف حساب لعميل';
        $client_id = request('client_id');
        $treasury_type = request('treasury_type');
        $from = $request->from ? date('Y-m-d H:i:s', strtotime($request->from)) : null;
        $to = $request->to ? date('Y-m-d H:i:s', strtotime($request->to)) : null;

        $query = DB::table('treasury_bill_dets')
                        ->where('treasury_bill_dets.client_supplier_id', $client_id)
                        ->leftJoin('financial_treasuries', 'financial_treasuries.id', 'treasury_bill_dets.treasury_id')
                        ->leftJoin('clients_and_suppliers', 'clients_and_suppliers.id', 'treasury_bill_dets.client_supplier_id')
                        ->leftJoin('sale_bills', 'sale_bills.id', 'treasury_bill_dets.bill_id')
                        ->leftJoin('financial_years', 'financial_years.id', 'treasury_bill_dets.year_id')
                        ->leftJoin('users', 'users.id', 'treasury_bill_dets.user_id')
                        //->where('treasury_bill_dets.bill_type', 'اضافة فاتورة مبيعات')
                        //->orWhere('treasury_bill_dets.bill_type', 'اذن توريد نقدية')
                        ->select(
                            'treasury_bill_dets.*', 
                            
                            'financial_treasuries.name as treasury_name',
                            
                            'clients_and_suppliers.name as clientName', 
                            'clients_and_suppliers.phone as clientPhone', 
                            'clients_and_suppliers.address as clientAddress', 
                            'clients_and_suppliers.client_supplier_type',
                            
                            'sale_bills.id as saleBillId',
                            'sale_bills.bill_discount',
                            'sale_bills.extra_money',
                            'sale_bills.count_items',
                            'sale_bills.total_bill_before',
                            'sale_bills.total_bill_after',
                            'sale_bills.custom_date',
                            'sale_bills.notes as saleBillNotes',

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
        
        if($treasury_type){
            $query->where('treasury_bill_dets.treasury_type', $treasury_type);
        }

        $results = $query->get();

        //return $results;
        
        foreach($results as $bill){
            if($bill->bill_type == 'اضافة فاتورة مبيعات'){
                $bill->products = DB::table('store_dets')
                                    ->where('store_dets.bill_id', $bill->saleBillId)
                                    ->join('products', 'products.id', 'store_dets.product_id')
                                    ->where('store_dets.type', 'اضافة فاتورة مبيعات')
                                    ->select(
                                        'store_dets.product_id',
                                        'store_dets.sell_price_small_unit',
                                        'store_dets.last_cost_price_small_unit',
                                        'store_dets.avg_cost_price_small_unit',
                                        'store_dets.product_bill_quantity',
                                        'store_dets.quantity_small_unit',
                                        'store_dets.tax',
                                        'store_dets.discount',
                                        'store_dets.total_before',
                                        'store_dets.total_after',
                                        'products.nameAr',            
                                    )
                                    ->get();
                
            }else{
                $bill->products = [];
            }
        }
        //return $results;        

        if(count($results) == 0){
            return redirect()->back()->with('notFound', 'لايوجد حركات تمت بناءا علي بحثك');
        }else{
            return view('back.reports.clients.account_statement_pdf' , compact('pageNameAr', 'from', 'to', 'results'));
        }
    }
}