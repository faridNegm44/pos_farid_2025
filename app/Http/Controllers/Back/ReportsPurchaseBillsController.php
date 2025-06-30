<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReportsPurchaseBillsController extends Controller
{
    public function index()
    {                   
        $pageNameAr = 'تقرير عن فواتير مشتريات';        
        $treasuries = DB::table('financial_treasuries')->orderBy('name', 'asc')->get();        

        //return $query;
        return view('back.reports.expenses.index' , compact('pageNameAr', 'treasuries'));
    }

    public function result(Request $request)
    {                   
        $pageNameAr = 'تقرير عن فواتير مشتريات';      

        $treasury = request('treasury');
        $from = $request->from ? date('Y-m-d H:i:s', strtotime($request->from)) : null;
        $to = $request->to ? date('Y-m-d H:i:s', strtotime($request->to)) : null;

        $query = Expense::orderBy('id', 'desc')
                        ->leftJoin('treasury_bill_dets', 'treasury_bill_dets.bill_id', 'expenses.id')
                        ->leftJoin('financial_treasuries', 'financial_treasuries.id', 'treasury_bill_dets.treasury_id')
                        ->leftJoin('users', 'users.id', 'treasury_bill_dets.user_id')
                        ->select(
                            'treasury_bill_dets.*', 
                            'expenses.id as expenses_id',
                            'expenses.title',
                            'financial_treasuries.name as treasury_name',
                            'users.name as userName',
                        )
                        ->orderBy('treasury_bill_dets.bill_id', 'ASC')
                        ->where('treasury_type', 'مصروف');

        if ($from && $to) {
            $query->whereBetween('treasury_bill_dets.created_at', [$from, $to]);
        } elseif ($from) {
            $query->where('treasury_bill_dets.created_at', '>=', $from);
        } elseif ($to) {
            $query->where('treasury_bill_dets.created_at', '<=', $to);
        }
        
        if($treasury){
            $query->where('treasury_bill_dets.treasury_id', $treasury);
        }

        $results = $query->paginate(50);       

        if($results->total() == 0){
            return redirect()->back()->with('notFound', 'لايوجد حركات تمت بناءا علي بحثك');
        }else{
            return view('back.reports.expenses.result' , compact('pageNameAr', 'results', 'treasury', 'from', 'to'));
        }
    }
    
    public function result_pdf_internal(Request $request, $id)
    {           
        $pageNameAr = 'فاتورة مشتريات رقم: ';      

        $find = DB::table('purchase_bills')
                    ->leftJoin('store_dets', 'store_dets.bill_id', 'purchase_bills.id')
                    ->leftJoin('treasury_bill_dets', 'treasury_bill_dets.bill_id', 'purchase_bills.id')
                    ->leftJoin('products', 'products.id', 'store_dets.product_id')
                    ->leftJoin('units as small_unit', 'small_unit.id', 'products.smallUnit')
                    ->leftJoin('units as big_unit', 'big_unit.id', 'products.bigUnit')
                    ->leftJoin('financial_treasuries', 'financial_treasuries.id', 'purchase_bills.treasury_id')
                    ->leftJoin('clients_and_suppliers', 'clients_and_suppliers.id', 'purchase_bills.supplier_id')
                    ->leftJoin('financial_years', 'financial_years.id', 'purchase_bills.year_id')
                    ->leftJoin('users', 'users.id', 'purchase_bills.user_id')
                    ->where('purchase_bills.id', $id)
                    ->where('store_dets.type', 'اضافة فاتورة مشتريات')
                    ->where('treasury_bill_dets.bill_type', 'اضافة فاتورة مشتريات')
                    ->select(
                        'purchase_bills.*',
                        
                        'store_dets.product_id',
                        'store_dets.sell_price_small_unit',
                        'store_dets.last_cost_price_small_unit',
                        'store_dets.avg_cost_price_small_unit',
                        'store_dets.product_bill_quantity',
                        'store_dets.tax',
                        'store_dets.discount',
                        'store_dets.bonus',
                        'store_dets.total_before',
                        'store_dets.total_after',

                        'treasury_bill_dets.treasury_type',
                        'treasury_bill_dets.bill_type',
                        'treasury_bill_dets.treasury_money_after',
                        'treasury_bill_dets.amount_money',
                        'treasury_bill_dets.remaining_money',
                        
                        'products.nameAr as productNameAr',
                        'products.small_unit_numbers',
                        'small_unit.name as smallUnitName',
                        'big_unit.name as bigUnitName',
                        'clients_and_suppliers.name as supplierName',
                        'financial_treasuries.name as treasuryName',
                        'financial_years.name as financialName',
                        'users.name as userName',
                    )
                    ->get();

//dd($find);
        if(count($find) == 0){
            return redirect('/');
        }else{
            return view('back.reports.purchase_bills.pdf_internal' , compact('pageNameAr', 'find'));
        }

    }
    
}