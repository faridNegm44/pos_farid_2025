<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\FinancialTreasury;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReportsProfitsController extends Controller
{
    public function index()
    {                  
        $pageNameAr = 'تقرير الربحية';        
        $financial_years = DB::table('financial_years')->orderBy('id', 'asc')->get();        

        return view('back.reports.profits.index' , compact('pageNameAr', 'financial_years'));	
        //if((userPermissions()->treasury_bills_report_view)){
        //}else{
        //    return redirect('/')->with(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        //}  
         
    }
    
    
    public function result_pdf(Request $request)
    {                   
        $pageNameAr = 'تقرير الربحية';      

        $financial_year = request('financial_year');
        $from = $request->from ? date('Y-m-d H:i:s', strtotime($request->from)) : null;
        $to = $request->to ? date('Y-m-d H:i:s', strtotime($request->to)) : null;

        //$totalProductsSellPrice = DB::table('store_dets')->where('type', 'اضافة فاتورة مبيعات'); 
        //$totalProductsCostPrice = DB::table('store_dets')->where('type', 'اضافة فاتورة مبيعات');
        //$totalExpenses = DB::table('expenses')->where('status', 'اضافة');
        
        //if ($from && $to) {
        //    $totalProductsSellPrice->whereBetween('store_dets.created_at', [$from, $to]);
        //    $totalProductsCostPrice->whereBetween('store_dets.created_at', [$from, $to]);
        //    $totalExpenses->whereBetween('created_at', [$from, $to]);
            
        //} elseif ($from) {
        //    $totalProductsSellPrice->where('store_dets.created_at', '>=', $from);
        //    $totalProductsCostPrice->where('store_dets.created_at', '>=', $from);
        //    $totalExpenses->where('created_at', '>=', $from);
            
        //} elseif ($to) {
        //    $totalProductsSellPrice->where('store_dets.created_at', '<=', $to);
        //    $totalProductsCostPrice->where('store_dets.created_at', '<=', $to);
        //    $totalExpenses->where('created_at', '<=', $to);
        //}

        //$resultTotalProductsSellPrice = $totalProductsSellPrice->sum('total_after');
        //$resultTotalProductsCostPrice = $totalProductsCostPrice->get()
        //                                                        ->sum(function ($row) {
        //                                                            return (( getCostPrice()->cost_price == 1 ? $row->last_cost_price_small_unit : $row->avg_cost_price_small_unit ) * $row->product_bill_quantity)
        //                                                                + $row->tax
        //                                                                //+ $row->extra_money
        //                                                                - $row->discount;
        //                                                        });
        //$resultTotalExpenses = $totalExpenses->sum('amount');
        
        //$profit = ($resultTotalProductsSellPrice - $resultTotalProductsCostPrice) - $resultTotalExpenses;

        //dd($resultTotalProductsSellPrice);



        $totalSales = DB::table('store_dets')->where('type', 'اضافة فاتورة مبيعات')->sum('total_after');
        $totalCost = DB::table('store_dets')->where('type', 'اضافة فاتورة مبيعات')->get()
                        ->sum(function ($row) {
                            return (
                                (getCostPrice()->cost_price == 1 ? $row->last_cost_price_small_unit : $row->avg_cost_price_small_unit) * $row->product_bill_quantity
                            ) + $row->tax - $row->discount;
                        });
                        
        $totalExpenses = DB::table('expenses')->where('status', 'اضافة')->sum('amount');
        //$totalReturns = DB::table('store_dets')->where('type', 'مرتجع مبيعات')->sum('total_after');

        if ($from && $to) {
            $totalSales = DB::table('store_dets')->where('type', 'اضافة فاتورة مبيعات')->whereBetween('created_at', [$from, $to])->sum('total_after');
            $totalCost = DB::table('store_dets')->where('type', 'اضافة فاتورة مبيعات')->whereBetween('created_at', [$from, $to])->get()
                            ->sum(function ($row) {
                                return (
                                    (getCostPrice()->cost_price == 1 ? $row->last_cost_price_small_unit : $row->avg_cost_price_small_unit) * $row->product_bill_quantity
                                ) + $row->tax - $row->discount;
                            });
                            
            $totalExpenses = DB::table('expenses')->whereBetween('created_at', [$from, $to])->where('status', 'اضافة')->sum('amount');
            //$totalReturns = DB::table('store_dets')->where('type', 'مرتجع مبيعات')->whereBetween('created_at', [$from, $to])->sum('total_after');
            
        } elseif ($from) {
            $totalSales = DB::table('store_dets')->where('type', 'اضافة فاتورة مبيعات')->where('store_dets.created_at', '>=', $from)->sum('total_after');
            $totalCost = DB::table('store_dets')->where('type', 'اضافة فاتورة مبيعات')->where('store_dets.created_at', '>=', $from)->get()
                            ->sum(function ($row) {
                                return (
                                    (getCostPrice()->cost_price == 1 ? $row->last_cost_price_small_unit : $row->avg_cost_price_small_unit) * $row->product_bill_quantity
                                ) + $row->tax - $row->discount;
                            });
                            
            $totalExpenses = DB::table('expenses')->where('store_dets.created_at', '>=', $from)->where('status', 'اضافة')->sum('amount');
            //$totalReturns = DB::table('store_dets')->where('type', 'مرتجع مبيعات')->where('store_dets.created_at', '>=', $from)->sum('total_after');   
            
        } elseif ($to) {
            $totalSales = DB::table('store_dets')->where('type', 'اضافة فاتورة مبيعات')->where('store_dets.created_at', '<=', $to)->sum('total_after');
            $totalCost = DB::table('store_dets')->where('type', 'اضافة فاتورة مبيعات')->where('store_dets.created_at', '<=', $to)->get()
                            ->sum(function ($row) {
                                return (
                                    (getCostPrice()->cost_price == 1 ? $row->last_cost_price_small_unit : $row->avg_cost_price_small_unit) * $row->product_bill_quantity
                                ) + $row->tax - $row->discount;
                            });
                            
            $totalExpenses = DB::table('expenses')->where('store_dets.created_at', '<=', $to)->where('status', 'اضافة')->sum('amount');
            //$totalReturns = DB::table('store_dets')->where('type', 'مرتجع مبيعات')->where('store_dets.created_at', '<=', $to)->sum('total_after');   
            
        }

        $netSales = $totalSales;
        $netProfit = ($netSales - $totalCost) - $totalExpenses;
        $profitPercent = $netSales > 0 ? round(($netProfit / $netSales) * 100, 2) : 0;






        
        //return [
        //    'from' => $from,
        //    'to' => $to,
        //    'totalSales' => $totalSales,
        //    //'totalReturns' => $totalReturns,
        //    'netSales' => $netSales,
        //    'totalCost' => $totalCost,
        //    'totalExpenses' => $totalExpenses,
        //    'netProfit' => $netProfit,
        //    'profitPercent' => $netSales > 0 ? round(($netProfit / $netSales) * 100, 2) : 0
        //];




        //return $profit;

        
        //if(count($results) == 0){
        //    return redirect()->back()->with('notFound', 'لايوجد حركات تمت بناءا علي بحثك');
        //}else{
        //}
        return view('back.reports.profits.pdf' , compact('pageNameAr', 'from', 'to', 'netSales', 'netProfit', 'profitPercent', 'totalSales', 'netSales', 'totalCost', 'totalExpenses'));
    }
}