<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReportsExpensesController extends Controller
{
    public function index()
    {                   
        $pageNameAr = 'تقرير عن المصروفات';        
        $treasuries = DB::table('financial_treasuries')->orderBy('name', 'asc')->get();        

        //return $query;
        return view('back.reports.expenses.index' , compact('pageNameAr', 'treasuries'));
    }

    public function result(Request $request)
    {                   
        $pageNameAr = 'تقرير عن المصروفات';      

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

        $results = $query->get();
        //return $results;
        

        if(count($results) == 0){
            return redirect()->back()->with('notFound', 'لايوجد حركات تمت بناءا علي بحثك');
        }else{
            return view('back.reports.expenses.result' , compact('pageNameAr', 'results', 'treasury', 'from', 'to'));
        }
    }
    
    public function result_pdf(Request $request)
    {                   
        $pageNameAr = 'تقرير عن المصروفات';      

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

        $results = $query->get();
        //return $results;
        

        if(count($results) == 0){
            return redirect()->back()->with('notFound', 'لايوجد حركات تمت بناءا علي بحثك');
        }else{
            return view('back.reports.expenses.pdf' , compact('pageNameAr', 'results', 'treasury', 'from', 'to'));
        }
    }
    
}