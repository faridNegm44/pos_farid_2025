<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\Product;
use Illuminate\Http\Request;

class SearchProducts extends Controller
{
    public function search_products($data){
        $products = Product::where('nameAr', 'like', '%' . $data . '%')->orWhere('nameEn', 'like', '%' . $data . '%')->get();
        return response()->json($products);
    }



    public function search_products_by_selectize(Request $request)
    {
        $query = $request->get('q');

        $items = Product::where('nameAr', 'like', "%$query%")
                        ->leftJoin('store_dets', 'store_dets.product_id', 'products.id')
                        //->select('products.id', 'products.nameAr', 'products.nameEn', 'products.sellPrice', 'products.purchasePrice', 'store_dets.quantity_all')
                        ->orWhere('nameEn', 'like', "%$query%")
                        ->orderBy('nameAr', 'asc')
                        ->limit(50)
                        ->get(['products.id', 'products.nameAr', 'products.nameEn', 'products.sellPrice', 'products.purchasePrice', 'store_dets.quantity_all']); // ['id', 'nameAr', 'nameEn', 'sellPrice', 'purchasePrice', 'quantity_all']

        return response()->json(['items' => $items]);        
    
    }

}
