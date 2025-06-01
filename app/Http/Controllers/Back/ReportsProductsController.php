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
        if($store == 'all'){
            $products = DB::table('products')->orderBy('nameAr', 'asc')->get();
        }else{
            $products = DB::table('products')->where('store', $store)->orderBy('nameAr', 'asc')->get();
        }

        return response()->json($products);
    }

    
    public function result(Request $request)
    {                   
        $pageNameAr = 'تقرير عن حركة صنف';      

        $product = request('products');
        $from = $request->from ? date('Y-m-d H:i:s', strtotime($request->from)) : null;
        $to = $request->to ? date('Y-m-d H:i:s', strtotime($request->to)) : null;
        $type = request('type');
        
        $query = DB::table('store_dets')
                    ->leftJoin('products', 'products.id', 'store_dets.product_id')
                    ->leftJoin('taswea_products', 'taswea_products.id', 'store_dets.bill_id')
                    ->leftJoin('users', 'users.id', 'taswea_products.user_id')
                    ->select(
                        'store_dets.*', 
                        'products.nameAr',
                        'taswea_products.notes as tasweaNotes',
                        'users.name as userName'
                    )
                    ->orderBy('store_dets.id', 'asc');

        if ($from && $to) {
            $query->whereBetween('store_dets.created_at', [$from, $to]);
        } elseif ($from) {
            $query->where('store_dets.created_at', '>=', $from);
        } elseif ($to) {
            $query->where('store_dets.created_at', '<=', $to);
        }
        
        if($product){
            $query->where('store_dets.product_id', $product);
        }
        
        if($type){
            $query->where('store_dets.type', $type);
        }

        $results = $query->get();
        //return $results;
        

        if(count($results) == 0){
            return redirect()->back()->with('notFound', 'لايوجد حركات تمت بناءا علي بحثك');
        }else{
            return view('back.reports.products.result' , compact('pageNameAr', 'results', 'product', 'type', 'from', 'to'));
        }
    }
    
    public function result_pdf(Request $request)
    {                   
        $pageNameAr = 'تقرير عن حركة صنف';      

        $product = request('products');
        $from = $request->from ? date('Y-m-d H:i:s', strtotime($request->from)) : null;
        $to = $request->to ? date('Y-m-d H:i:s', strtotime($request->to)) : null;
        $type = request('type');

        $query = DB::table('store_dets')
                    ->leftJoin('products', 'products.id', 'store_dets.product_id')
                    ->leftJoin('taswea_products', 'taswea_products.id', 'store_dets.bill_id')
                    ->leftJoin('users', 'users.id', 'taswea_products.user_id')
                    ->select(
                        'store_dets.*', 
                        'products.nameAr',
                        'taswea_products.notes as tasweaNotes',
                        'users.name as userName'
                    )
                    ->orderBy('store_dets.id', 'asc');

        if ($from && $to) {
            $query->whereBetween('store_dets.created_at', [$from, $to]);
        } elseif ($from) {
            $query->where('store_dets.created_at', '>=', $from);
        } elseif ($to) {
            $query->where('store_dets.created_at', '<=', $to);
        }
        
        if($product){
            $query->where('store_dets.product_id', $product);
        }

        if($type){
            $query->where('store_dets.type', $type);
        }
        
        $results = $query->get();
        //return $results;
        

        if(count($results) == 0){
            return redirect()->back()->with('notFound', 'لايوجد حركات تمت بناءا علي بحثك');
        }else{
            return view('back.reports.products.pdf' , compact('pageNameAr', 'results', 'product', 'type', 'from', 'to'));
        }
    }
    
}