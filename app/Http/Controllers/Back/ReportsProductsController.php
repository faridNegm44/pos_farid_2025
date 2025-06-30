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
        if((userPermissions()->products_report_view)){
            $pageNameAr = 'تقرير عن حركة سلعة/خدمة';        
            $stores = DB::table('stores')->orderBy('name', 'asc')->get();        
    
            return view('back.reports.products.index' , compact('pageNameAr', 'stores'));
	
        }else{
            return redirect('/')->with(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        }  
        
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
        $pageNameAr = 'تقرير عن حركة سلعة/خدمة';      

        $product = request('products');
        $from = $request->from ? date('Y-m-d H:i:s', strtotime($request->from)) : null;
        $to = $request->to ? date('Y-m-d H:i:s', strtotime($request->to)) : null;
        $type = request('type');
        
        $query = DB::table('store_dets')
                    ->leftJoin('products', 'products.id', 'store_dets.product_id')
                    ->leftJoin('taswea_products', 'taswea_products.id', 'store_dets.bill_id')
                    ->leftJoin('users', 'users.id', 'taswea_products.user_id')
                    //->where('store_dets.type', 'رصيد اول مدة للسلعة/خدمة')
                    //->orWhere('store_dets.type', 'تسوية سلعة/خدمة')
                    //->orWhere('store_dets.type', 'تعديل سعر تكلفة او سعر بيع او خصم او ضريبة للسلعة/للخدمة')
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

        $results = $query->paginate(50);       

        //return $results;

        if($results->total() == 0){
            return redirect()->back()->with('notFound', 'لايوجد حركات تمت بناءا علي بحثك');
        }else{
            return view('back.reports.products.result' , compact('pageNameAr', 'results', 'product', 'type', 'from', 'to'));
        }
    }
    
    public function result_pdf(Request $request)
    {                   
        $pageNameAr = 'تقرير عن حركة سلعة/خدمة';      

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