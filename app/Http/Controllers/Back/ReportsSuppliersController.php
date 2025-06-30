<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\ClientsAndSuppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReportsSuppliersController extends Controller
{
    public function index()
    {                
        if((userPermissions()->suppliers_report_view)){
            $pageNameAr = 'تقرير عن حركة مورد';        
            $suppliers = ClientsAndSuppliers::where('client_supplier_type', 1)
                                            ->orWhere('client_supplier_type', 2)
                                            ->orderBy('name', 'asc')
                                            ->get();   
            
            return view('back.reports.suppliers.index' , compact('pageNameAr', 'suppliers'));
        }else{
            return redirect('/')->with(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        }  
    }

    public function result(Request $request)
    {                   
        $pageNameAr = 'تقرير عن حركة مورد'; 

        $supplier_id = request('supplier_id');
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
                            'clients_and_suppliers.code as supplierCode', 'clients_and_suppliers.name as supplierName', 'clients_and_suppliers.client_supplier_type',
                            'users.name as userName',
                            'financial_years.name as financialYearName',
                        )
                        ->whereIn('clients_and_suppliers.client_supplier_type', [1, 2]);
                        //->orderBy('treasury_bill_dets.id', 'asc');

        if ($from && $to) {
            $query->whereBetween('treasury_bill_dets.created_at', [$from, $to]);
        } elseif ($from) {
            $query->where('treasury_bill_dets.created_at', '>=', $from);
        } elseif ($to) {
            $query->where('treasury_bill_dets.created_at', '<=', $to);
        }
        
        if($supplier_id){
            $query->where('treasury_bill_dets.client_supplier_id', $supplier_id);
        }
        
        if($treasury_type){
            $query->where('treasury_bill_dets.treasury_type', $treasury_type);
        }

        $results = $query->paginate(50);       

        if($results->total() == 0){
            return redirect()->back()->with('notFound', 'لايوجد حركات تمت بناءا علي بحثك');
        }else{
            return view('back.reports.suppliers.result' , compact('pageNameAr', 'results', 'treasury_type', 'supplier_id', 'from', 'to'));
        }
    }
    
    public function result_pdf(Request $request)
    {                   
        $pageNameAr = 'تقرير عن حركة مورد'; 

        $supplier_id = request('supplier_id');
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
                            'clients_and_suppliers.name as supplierName', 'clients_and_suppliers.client_supplier_type',
                            'users.name as userName',
                            'financial_years.name as financialYearName',
                        )
                        ->whereIn('clients_and_suppliers.client_supplier_type', [1, 2])
                        ->orderBy('treasury_bill_dets.id', 'ASC');

        if ($from && $to) {
            $query->whereBetween('treasury_bill_dets.created_at', [$from, $to]);
        } elseif ($from) {
            $query->where('treasury_bill_dets.created_at', '>=', $from);
        } elseif ($to) {
            $query->where('treasury_bill_dets.created_at', '<=', $to);
        }
        
        if($supplier_id){
            $query->where('treasury_bill_dets.client_supplier_id', $supplier_id);
        }
        
        if($treasury_type){
            $query->where('treasury_bill_dets.treasury_type', $treasury_type);
        }

        $results = $query->get();       

        if(count($results) == 0){
            return redirect()->back()->with('notFound', 'لايوجد حركات تمت بناءا علي بحثك');
        }else{
            return view('back.reports.suppliers.pdf' , compact('pageNameAr', 'results', 'treasury_type', 'supplier_id', 'from', 'to'));
        }
    }
    

    ////////////////////////////////////////////////////////////  كشف حساب  ////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////  كشف حساب  ////////////////////////////////////////////////////////////


    // start index account_statement
    public function account_statement()
    {                   
        if((userPermissions()->suppliers_account_statement_view)){
            $pageNameAr = 'كشف حساب للموردين';        
            $suppliers = ClientsAndSuppliers::where('client_supplier_type', 1)
                                            ->orWhere('client_supplier_type', 2)
                                            ->orderBy('name', 'asc')
                                            ->get();   
            
                                            //return $clients;
            return view('back.reports.suppliers.account_statement' , compact('pageNameAr', 'suppliers'));
        }else{
            return redirect('/')->with(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        }  
    }

    public function account_statement_pdf(Request $request)
    {                   
        $pageNameAr = 'كشف حساب لمورد';

        $supplier_id = request('supplier_id');
        $treasury_type = request('treasury_type');
        $from = $request->from ? date('Y-m-d H:i:s', strtotime($request->from)) : null;
        $to = $request->to ? date('Y-m-d H:i:s', strtotime($request->to)) : null;

        $query = DB::table('treasury_bill_dets')
                        ->where('treasury_bill_dets.client_supplier_id', $supplier_id)
                        ->leftJoin('financial_treasuries', 'financial_treasuries.id', 'treasury_bill_dets.treasury_id')
                        ->leftJoin('clients_and_suppliers', 'clients_and_suppliers.id', 'treasury_bill_dets.client_supplier_id')
                        ->leftJoin('purchase_bills', 'purchase_bills.id', 'treasury_bill_dets.bill_id')
                        ->leftJoin('financial_years', 'financial_years.id', 'treasury_bill_dets.year_id')
                        ->leftJoin('users', 'users.id', 'treasury_bill_dets.user_id')
                        //->where('treasury_bill_dets.bill_type', 'اضافة فاتورة مشتريات')
                        //->orWhere('treasury_bill_dets.bill_type', 'اذن توريد نقدية')
                        ->select(
                            'treasury_bill_dets.*', 
                            
                            'financial_treasuries.name as treasury_name',
                            
                            'clients_and_suppliers.name as supplierName', 
                            'clients_and_suppliers.phone as supplierPhone', 
                            'clients_and_suppliers.address as supplierAddress', 
                            'clients_and_suppliers.client_supplier_type',
                            
                            'purchase_bills.id as purchaseBillId',
                            'purchase_bills.bill_discount',
                            'purchase_bills.count_items',
                            'purchase_bills.total_bill_before',
                            'purchase_bills.total_bill_after',
                            'purchase_bills.custom_date',
                            'purchase_bills.notes as purchaseBillNotes',

                            'users.name as userName',
                            
                            'financial_years.name as financialYearName',
                        )
                        ->whereIn('clients_and_suppliers.client_supplier_type', [1, 2])
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
            if($bill->bill_type == 'اضافة فاتورة مشتريات'){
                $bill->products = DB::table('store_dets')
                                    ->where('store_dets.bill_id', $bill->purchaseBillId)
                                    ->join('products', 'products.id', 'store_dets.product_id')
                                    ->where('store_dets.type', 'اضافة فاتورة مشتريات')
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
            }elseif($bill->bill_type == 'مرتجع / تعديل فاتورة مشتريات'){
                $bill->products = DB::table('store_dets')
                                    ->where('store_dets.bill_id', $bill->purchaseBillId)
                                    ->join('products', 'products.id', 'store_dets.product_id')
                                    ->where('store_dets.type', 'مرتجع / تعديل فاتورة مشتريات')
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
            return view('back.reports.suppliers.account_statement_pdf' , compact('pageNameAr', 'from', 'to', 'results'));
        }
    }
    
}