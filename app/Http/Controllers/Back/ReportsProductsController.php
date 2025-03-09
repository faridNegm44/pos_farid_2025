<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\FinancialTreasury;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReportsProductsController extends Controller
{
    public function index()
    {                   
        $pageNameAr = 'تقرير عن حركة صنف';        
        $stores = DB::table('stores')->orderBy('name', 'asc')->get();        

        //return $query;
        return view('back.reports.products.index' , compact('pageNameAr', 'stores'));
    }


    public function getProductsByStore($store){
        $products = DB::table('products')->where('store', $store)->get();
        return response()->json($products);
    }

    
    public function result(Request $request)
    {                   
        $pageNameAr = 'تقرير عن حركة صنف';      

        $query = DB::table('store_dets')->leftJoin('products', 'products.id', 'store_dets.product_id')
                    ->select(
                        'store_dets.*', 
                        'products.nameAr',
                    )
                    ->orderBy('store_dets.id', 'asc');

        $product = request('products');

        if($product){
            $query->where('store_dets.product_id', $product);
        }

        $results = $query->get();
        //return $results;
        return view('back.reports.products.result' , compact('pageNameAr', 'results', 'product'));
    }
    
    public function result_pdf(Request $request)
    {                   
        $pageNameAr = 'تقرير عن حركة الخزائن المالية';      

        $treasury_id = request('treasury_id');
        $treasury_type = request('treasury_type');
        $from = request('from');
        $to = request('to');

        $query = DB::table('treasury_bill_dets')
                    ->leftJoin('financial_treasuries', 'financial_treasuries.id', 'treasury_bill_dets.treasury_id')
                    ->leftJoin('clients_and_suppliers', 'clients_and_suppliers.id', 'treasury_bill_dets.client_supplier_id')
                    ->leftJoin('users', 'users.id', 'treasury_bill_dets.user_id')
                    ->leftJoin('financial_years', 'financial_years.id', 'treasury_bill_dets.year_id')
                    ->select(
                'treasury_bill_dets.*', 
                        'financial_treasuries.name as treasury_name',
                        'clients_and_suppliers.name as clients_or_supplier_name',
                        'users.name as user_name',
                        'financial_years.name as financial_years',
                    )
                    ->orderBy('treasury_bill_dets.id', 'asc');

        if($treasury_id){
            $query->where('treasury_id', $treasury_id);
        }
        
        if($treasury_type){
            $query->where('treasury_type', $treasury_type);
        }

        if ($from && $to) {
            $query->whereBetween('created_at', [$from, $to]);
        } elseif ($from) {
            $query->where('created_at', '>=', $from);
        } elseif ($to) {
            $query->where('created_at', '<=', $to);
        }

        $results = $query->get();


        //return $results;


        return view('back.reports.products.pdf', compact('pageNameAr', 'results'));


        //return view('back.reports.products.result' , compact('pageNameAr', 'results'));
    }
}
