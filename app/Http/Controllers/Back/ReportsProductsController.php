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

        $product = request('products');
        
        $query = DB::table('store_dets')
                    ->leftJoin('products', 'products.id', 'store_dets.product_id')
                    ->leftJoin('taswea_products', 'taswea_products.id', 'store_dets.bill_head_id')
                    ->leftJoin('users', 'users.id', 'taswea_products.user_id')
                    ->select(
                        'store_dets.*', 
                        'products.nameAr',
                        'taswea_products.notes as tasweaNotes',
                        'users.name as userName'
                    )
                    ->orderBy('store_dets.id', 'asc');

        if($product){
            $query->where('store_dets.product_id', $product);
        }

        $results = $query->get();
        //return $results;
        
        return view('back.reports.products.result' , compact('pageNameAr', 'results', 'product'));
    }
    
    public function result_pdf(Request $request)
    {                
        dd(request('products'));   
        $pageNameAr = 'تقرير عن حركة صنف';      
        $query = DB::table('store_dets')
                    ->leftJoin('products', 'products.id', 'store_dets.product_id')
                    ->leftJoin('taswea_products', 'taswea_products.id', 'store_dets.bill_head_id')
                    ->leftJoin('users', 'users.id', 'taswea_products.user_id')
                    ->select(
                        'store_dets.*', 
                        'products.nameAr',
                        'taswea_products.notes as tasweaNotes',
                        'users.name as userName'
                    )
                    ->orderBy('store_dets.id', 'asc');

        $product = request('products');

        if($product){
            $query->where('store_dets.product_id', $product);
        }

        $results = $query->get();
        //return request('products');
        
        return view('back.reports.products.pdf' , compact('pageNameAr', 'results', 'product'));
    }
}