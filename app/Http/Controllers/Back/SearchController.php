<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\Product;
use Illuminate\Http\Request;
use DB;

class SearchController extends Controller
{
    public function search_products($data){
        $products = Product::where('nameAr', 'like', '%' . $data . '%')->orWhere('nameEn', 'like', '%' . $data . '%')->get();
        return response()->json($products);
    }

    
    public function search_products_by_selectize(Request $request)
    {
        $query = $request->get('data_input_search');

        $items = Product::where('nameAr', 'like', "%$query%")
                        ->orWhere('nameEn', 'like', "%$query%")
                        ->orWhere('shortCode', 'like', "%$query%")
                        ->orWhere('natCode', 'like', "%$query%")
                        ->leftJoin('store_dets', 'store_dets.product_id', 'products.id')
                        ->leftJoin('units as smallUnit', 'smallUnit.id', 'products.smallUnit')
                        ->leftJoin('units as bigUnit', 'bigUnit.id', 'products.bigUnit')
                        ->orderBy('nameAr', 'asc')
                        //->where('store_dets.type', 'اضافة فاتورة مشتريات')
                        ->orderBy('store_dets.id', 'desc')
                        ->limit(50)
                        ->get([
                            'products.id', 
                            'products.shortCode', 
                            'products.nameAr', 
                            'products.nameEn', 
                            'products.bigUnit', 
                            'products.smallUnit', 
                            'products.small_unit_numbers', 
                            'products.max_sale_quantity', 
                            'products.status', 
                            
                            'store_dets.id as store_dets_id',
                            'store_dets.sell_price_small_unit',
                            'store_dets.last_cost_price_small_unit',
                            'store_dets.avg_cost_price_small_unit',
                            'store_dets.quantity_small_unit',
                            
                            'smallUnit.name as smallUnitName',
                            'bigUnit.name as bigUnitName',
                        ]);


                        //return $items;
        return response()->json(['items' => $items]);        
    
    }
    
    
    public function search_clients_by_selectize(Request $request)
    {
        $query = $request->get('data_input_search');

        $clients = DB::table('clients_and_suppliers')
                    ->leftJoin('treasury_bill_dets', function ($join) {
                        $join->on('treasury_bill_dets.client_supplier_id', '=', 'clients_and_suppliers.id')
                            ->whereRaw('treasury_bill_dets.id = (
                                SELECT MAX(id) FROM treasury_bill_dets 
                                WHERE client_supplier_id = clients_and_suppliers.id
                            )');
                    })
                    ->where(function ($q) use ($query) {
                        $q->where('clients_and_suppliers.name', 'like', "%$query%")
                        ->orWhere('clients_and_suppliers.phone', 'like', "%$query%")
                        ->orWhere('clients_and_suppliers.address', 'like', "%$query%");
                    })
                    ->whereIn('clients_and_suppliers.client_supplier_type', [3, 4])
                    ->orderBy('clients_and_suppliers.name', 'asc')
                    ->limit(50)
                    ->get([
                        'clients_and_suppliers.id',
                        'clients_and_suppliers.name',
                        'clients_and_suppliers.phone',
                        'clients_and_suppliers.address',
                        'clients_and_suppliers.type_payment',
                        'treasury_bill_dets.remaining_money',
                    ]);

                    //dd($clients);
        return response()->json(['clients' => $clients]);        
    
    }

}