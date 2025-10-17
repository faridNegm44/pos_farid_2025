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
        if((userPermissions()->profit_view)){
            $pageNameAr = 'تقرير الربحية';        

            return view('back.reports.profits.index' , compact('pageNameAr'));	
        }else{
            return redirect('/')->with(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        }  
         
    }
    
    
    public function result_pdf(Request $request)
    {      
        if((userPermissions()->profit_view)){

            $pageNameAr = 'تقرير الربحية';      

            $from = $request->from ? date('Y-m-d H:i:s', strtotime($request->from)) : null;
            $to = $request->to ? date('Y-m-d H:i:s', strtotime($request->to)) : null;

            $totalSales = DB::table('store_dets')
                            ->join('sale_bills', 'sale_bills.id', '=', 'store_dets.bill_id')
                            ->where('store_dets.type', 'اضافة فاتورة مبيعات')
                            ->whereIn('store_dets.status', ['نشط', 'تم تعديله'])
                            ->whereIn('sale_bills.status', ['فاتورة نشطة', 'فاتورة معدلة'])
                            ->whereBetween('store_dets.created_at', [$from, $to])
                            ->select(
                                'sale_bills.total_bill_after',
                                'sale_bills.extra_money',
                            )
                            ->groupBy('store_dets.bill_id')
                            ->get()
                            ->sum(function ($row) {
                                return $row->total_bill_after + $row->extra_money;
                            });

            $totalCost = DB::table('store_dets')
                            ->join('sale_bills', 'sale_bills.id', 'store_dets.bill_id')
                            ->where('store_dets.type', 'اضافة فاتورة مبيعات')
                            ->whereIn('store_dets.status', ['نشط', 'تم تعديله'])
                            ->whereIn('sale_bills.status', ['فاتورة نشطة', 'فاتورة معدلة'])
                            ->whereBetween('store_dets.created_at', [$from, $to])
                            ->select('store_dets.last_cost_price_small_unit', 'store_dets.avg_cost_price_small_unit', 'store_dets.product_bill_quantity')
                            ->get()
                            ->sum(function ($row) {
                                return (
                                            (   getCostPrice()->cost_price == 1 ? 
                                                    $row->last_cost_price_small_unit : 
                                                    $row->avg_cost_price_small_unit
                                            ) * $row->product_bill_quantity

                                        );
                            });

            //return $totalSales - $totalCost;
                            
            $totalExpenses = DB::table('expenses')
                                ->whereBetween('created_at', [$from, $to])
                                ->where('status', 'اضافة')
                                ->sum('amount');
            

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

            return view('back.reports.profits.pdf' , compact('pageNameAr', 'from', 'to', 'netSales', 'netProfit', 'profitPercent', 'totalSales', 'netSales', 'totalCost', 'totalExpenses'));
            
        }else{
            return redirect('/')->with(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        }  
    }
}