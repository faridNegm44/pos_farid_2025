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
                    ->orderBy('total_product', 'desc')
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

}