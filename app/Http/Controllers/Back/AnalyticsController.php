<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AnalyticsController extends Controller
{

    /////////////////////////////////////////////////////////////////////////////////////// 
    ////////////////////////// Start Analytics ( Top Products ) ////////////////////////// 
    ////////////////////////////////////////////////////////////////////////////////////// 
    public function index_top_products()
    {            
        $pageNameAr = 'المنتجات الأكثر والأقل مبيعاً ';
        $pageNameEn = 'analytics/datatable_top_products';

        return view('back.analytics.top_products' , compact('pageNameAr' , 'pageNameEn'));                           
    }

    public function datatable_top_products()
    {
        $all = DB::table('sale_bills')
                    ->leftJoin('store_dets', 'store_dets.bill_id', 'sale_bills.id')
                    ->leftJoin('products', 'products.id', 'store_dets.product_id')
                    ->groupBy('store_dets.product_id')
                    ->where('store_dets.type', 'اضافة فاتورة مبيعات')
                    ->select(
                        DB::raw('SUM(store_dets.product_bill_quantity) as total_product'),
                        'products.nameAr as productNameAr',
                        'products.id as productId',
                    )
                    //->orderBy('total_product', 'desc')
                    ->get();

        return DataTables::of($all)
            ->addColumn('productNameAr', function($res){
                return '<strong>'.$res->productNameAr.'</strong>';
            })
            ->addColumn('total_product', function($res){
                return '<strong>'.display_number($res->total_product).'</strong>';
            })
            ->rawColumns(['productNameAr', 'total_product'])
            ->toJson();
    }
    /////////////////////////////////////////////////////////////////////////////////////// 
    ////////////////////////// End Analytics ( Top Products ) ////////////////////////// 
    ////////////////////////////////////////////////////////////////////////////////////// 





    /////////////////////////////////////////////////////////////////////////////////////// 
    ////////////////////////// Start Analytics ( Top Clients ) ///////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////// 
    public function index_top_clients()
    {            
        $pageNameAr = 'العملاء الأكثر والأقل شراءً ';
        $pageNameEn = 'analytics/datatable_top_clients';

        return view('back.analytics.top_clients' , compact('pageNameAr' , 'pageNameEn'));                           
    }

    public function datatable_top_clients()
    {
        $all = DB::table('sale_bills')
                    ->leftJoin('clients_and_suppliers', 'clients_and_suppliers.id', 'sale_bills.client_id')
                    ->groupBy('sale_bills.client_id')
                    ->select(
                        'client_id', 
                        DB::raw('SUM(total_bill_after) as client_total'),
                        'clients_and_suppliers.name'
                    )
                    ->get();

        return DataTables::of($all)
            ->addColumn('name', function($res){
                return '<strong>'.$res->name.'</strong>';
            })
            ->addColumn('client_total', function($res){
                return '<strong>'.round($res->client_total, 2).'</strong>';
            })
            ->rawColumns(['name', 'client_total'])
            ->toJson();
    }
    /////////////////////////////////////////////////////////////////////////////////////// 
    ////////////////////////// End Analytics ( Top Clients ) /////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////// 

}