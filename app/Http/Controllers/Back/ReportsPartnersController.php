<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\ClientsAndSuppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReportsPartnersController extends Controller
{
    public function index()
    {                   
        if((userPermissions()->partners_report_view)){
            $pageNameAr = 'تقرير عن حركة شريك';        
            $partners = DB::table('partners')->get();
            
            return view('back.reports.partners.index' , compact('pageNameAr', 'partners'));
	
        }else{
            return redirect('/')->with(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        }  
        
    }

    public function result(Request $request)
    {                   
        $pageNameAr = 'تقرير عن حركة شريك'; 

        $partner_id = request('partner_id');
        $treasury_type = request('treasury_type');
        $from = $request->from ? date('Y-m-d H:i:s', strtotime($request->from)) : null;
        $to = $request->to ? date('Y-m-d H:i:s', strtotime($request->to)) : null;

        $query = DB::table('treasury_bill_dets')
                        ->leftJoin('financial_treasuries', 'financial_treasuries.id', 'treasury_bill_dets.treasury_id')
                        ->join('partners', 'partners.id', 'treasury_bill_dets.partner_id')
                        ->leftJoin('financial_years', 'financial_years.id', 'treasury_bill_dets.year_id')
                        ->leftJoin('users', 'users.id', 'treasury_bill_dets.user_id')
                        ->select(
                            'treasury_bill_dets.*', 
                            'financial_treasuries.name as treasury_name',
                            'partners.name as partnerName',
                            'users.name as userName',
                            'financial_years.name as financialYearName',
                        )
                        ->orderBy('treasury_bill_dets.id', 'asc');

        if ($from && $to) {
            $query->whereBetween('treasury_bill_dets.created_at', [$from, $to]);
        } elseif ($from) {
            $query->where('treasury_bill_dets.created_at', '>=', $from);
        } elseif ($to) {
            $query->where('treasury_bill_dets.created_at', '<=', $to);
        }
        
        if($partner_id){
            $query->where('treasury_bill_dets.partner_id', $partner_id);
        }
        
        if($treasury_type){
            $query->where('treasury_bill_dets.treasury_type', $treasury_type);
        }

        $results = $query->paginate(50);       

        //dd($results);

        if($results->total() == 0){
            return redirect()->back()->with('notFound', 'لايوجد حركات تمت بناءا علي بحثك');
        }else{
            return view('back.reports.partners.result' , compact('pageNameAr', 'results', 'treasury_type', 'partner_id', 'from', 'to'));
        }
    }
    
    public function result_pdf(Request $request)
    {                   
        $pageNameAr = 'تقرير عن حركة شريك'; 

        $partner_id = request('partner_id');
        $treasury_type = request('treasury_type');
        $from = $request->from ? date('Y-m-d H:i:s', strtotime($request->from)) : null;
        $to = $request->to ? date('Y-m-d H:i:s', strtotime($request->to)) : null;

        $query = DB::table('treasury_bill_dets')
                        ->leftJoin('financial_treasuries', 'financial_treasuries.id', 'treasury_bill_dets.treasury_id')
                        ->join('partners', 'partners.id', 'treasury_bill_dets.partner_id')
                        ->leftJoin('financial_years', 'financial_years.id', 'treasury_bill_dets.year_id')
                        ->leftJoin('users', 'users.id', 'treasury_bill_dets.user_id')
                        ->select(
                            'treasury_bill_dets.*', 
                            'financial_treasuries.name as treasury_name',
                            'partners.name as partnerName',
                            'users.name as userName',
                            'financial_years.name as financialYearName',
                        )
                        ->orderBy('treasury_bill_dets.id', 'asc');

        if ($from && $to) {
            $query->whereBetween('treasury_bill_dets.created_at', [$from, $to]);
        } elseif ($from) {
            $query->where('treasury_bill_dets.created_at', '>=', $from);
        } elseif ($to) {
            $query->where('treasury_bill_dets.created_at', '<=', $to);
        }
        
        if($partner_id){
            $query->where('treasury_bill_dets.partner_id', $partner_id);
        }
        
        if($treasury_type){
            $query->where('treasury_bill_dets.treasury_type', $treasury_type);
        }

        $results = $query->get();       

        if(count($results) == 0){
            return redirect()->back()->with('notFound', 'لايوجد حركات تمت بناءا علي بحثك');
        }else{
            return view('back.reports.partners.pdf' , compact('pageNameAr', 'results', 'treasury_type', 'partner_id', 'from', 'to'));
        }
    }






    // start index account_statement
    public function account_statement()
    {                   
        if((userPermissions()->partners_account_statement_view)){
            $pageNameAr = 'كشف حساب للشركاء';        
            $partners = DB::table('partners')->get();
            
            return view('back.reports.partners.account_statement' , compact('pageNameAr', 'partners'));
	
        }else{
            return redirect('/')->with(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        }  
        
    }

    public function account_statement_pdf(Request $request)
    {                   
        $pageNameAr = 'كشف حساب لشريك';
        
        $partner_id = request('partner_id');
        $treasury_type = request('treasury_type');
        $from = $request->from ? date('Y-m-d H:i:s', strtotime($request->from)) : null;
        $to = $request->to ? date('Y-m-d H:i:s', strtotime($request->to)) : null;

        $query = DB::table('treasury_bill_dets')
                        ->leftJoin('financial_treasuries', 'financial_treasuries.id', 'treasury_bill_dets.treasury_id')
                        ->join('partners', 'partners.id', 'treasury_bill_dets.partner_id')
                        ->leftJoin('financial_years', 'financial_years.id', 'treasury_bill_dets.year_id')
                        ->leftJoin('users', 'users.id', 'treasury_bill_dets.user_id')
                        ->select(
                            'treasury_bill_dets.*', 
                            'financial_treasuries.name as treasury_name',
                            
                            'partners.name as partnerName',
                            'partners.phone as partnerPhone',
                            'partners.address as partnerAddress',

                            'users.name as userName',
                            'financial_years.name as financialYearName',
                        )
                        ->orderBy('treasury_bill_dets.id', 'asc');

        if ($from && $to) {
            $query->whereBetween('treasury_bill_dets.created_at', [$from, $to]);
        } elseif ($from) {
            $query->where('treasury_bill_dets.created_at', '>=', $from);
        } elseif ($to) {
            $query->where('treasury_bill_dets.created_at', '<=', $to);
        }
        
        if($partner_id){
            $query->where('treasury_bill_dets.partner_id', $partner_id);
        }
        
        if($treasury_type){
            $query->where('treasury_bill_dets.treasury_type', $treasury_type);
        }

        $results = $query->get();
        
        //return $results;
    

        if(count($results) == 0){
            return redirect()->back()->with('notFound', 'لايوجد حركات تمت بناءا علي بحثك');
        }else{
            return view('back.reports.partners.account_statement_pdf' , compact('pageNameAr', 'from', 'to', 'results'));
        }
    }
}