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

class ReportsProductsStockAlertController extends Controller
{
    public function index()
    {                   
        if((userPermissions()->products_stock_alert_view)){
            $pageNameAr = 'كشكول النواقص';        
            $stores = DB::table('stores')->orderBy('name', 'asc')->get();        
            $product_categoys = DB::table('product_categoys')->orderBy('name', 'asc')->get();        
    
            return view('back.reports.products_stock_alert.index' , compact('pageNameAr', 'stores', 'product_categoys'));
	
        }else{
            return redirect('/')->with(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        }  
    }
    
    public function result(Request $request)
    {                   
        $pageNameAr = 'كشكول النواقص';      
        $store_id = request('store_id');
        $product_categoys = request('product_categoys');
    
        $main_results = DB::table('store_dets')
                    ->leftJoin('products', 'products.id', 'store_dets.product_id')
                    ->leftJoin('product_categoys', 'product_categoys.id', 'products.category')
                    ->leftJoin('stores', 'stores.id', 'products.store')

                    ->whereIn('store_dets.id', function($query){
                        $query->select(DB::raw('MAX(id)'))
                            ->from('store_dets')
                            ->groupBy('store_dets.product_id');
                    })

                    ->select(
                        'products.id as productId', 'products.nameAr', 'products.stockAlert',
                        'store_dets.quantity_small_unit',
                        'product_categoys.name as categoryName',
                        'stores.name as storeName'
                    )

                    ->whereColumn('products.stockAlert', '>=', 'store_dets.quantity_small_unit')
                    ->orderBy('products.nameAr', 'asc');
                
        if($store_id){
            $main_results->where('products.store', $store_id);
        }
        
        if($product_categoys){
            $main_results->where('products.category', $product_categoys);
        }
        
        $supp_results = $main_results->paginate(50);

        //return $supp_results;

        if($supp_results->total() == 0){
            return redirect()->back()->with('notFound', 'لايوجد أصناف في كشكول النواقص بناءا علي بحثك');
        }else{
            return view('back.reports.products_stock_alert.result' , compact('pageNameAr', 'supp_results'));
        }
    }
    
    public function result_pdf(Request $request)
    {                   
        $pageNameAr = 'كشكول النواقص';      
        $store_id = request('store_id');
        $product_categoys = request('product_categoys');
    
        $main_results = DB::table('store_dets')
                    ->leftJoin('products', 'products.id', 'store_dets.product_id')
                    ->leftJoin('product_categoys', 'product_categoys.id', 'products.category')
                    ->leftJoin('stores', 'stores.id', 'products.store')

                    ->whereIn('store_dets.id', function($query){
                        $query->select(DB::raw('MAX(id)'))
                            ->from('store_dets')
                            ->groupBy('store_dets.product_id');
                    })

                    ->select(
                        'products.id as productId', 'products.nameAr', 'products.stockAlert',
                        'store_dets.quantity_small_unit',
                        'product_categoys.name as categoryName',
                        'stores.name as storeName'
                    )

                    ->whereColumn('products.stockAlert', '>=', 'store_dets.quantity_small_unit')
                    ->orderBy('products.nameAr', 'asc');
                
        if($store_id){
            $main_results->where('products.store', $store_id);
        }
        
        if($product_categoys){
            $main_results->where('products.category', $product_categoys);
        }
        
        $supp_results = $main_results->get();

        //return $supp_results;

        if(count($supp_results) == 0){
            return redirect()->back()->with('notFound', 'لايوجد أصناف في كشكول النواقص بناءا علي بحثك');
        }else{
            return view('back.reports.products_stock_alert.pdf' , compact('pageNameAr', 'supp_results'));
        }
    }
    
}