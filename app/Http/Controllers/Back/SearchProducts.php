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
                        ->orWhere('nameEn', 'like', "%$query%")
                        ->orderBy('nameAr', 'asc')
                        ->limit(50)
                        ->get(['id', 'nameAr', 'nameEn', 'sellPrice', 'purchasePrice']);

        return response()->json(['items' => $items]);        
    
    }

}
