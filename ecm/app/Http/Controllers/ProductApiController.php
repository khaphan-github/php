<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductApiController extends Controller
{
    public function getProductByCategoryId(Request $request)
    {
        // vALDIATE
        $request->validate([
            'category_id' => 'required|integer',
        ]);

        // fetch(`/api/product-by-category-id?category_id=23`)
        $category_id = $request->query('category_id');

        $products = DB::table('product')->where('category_id', $category_id)->get();
        
        if ($products->isEmpty()) {
            return response()->json(['message' => 'No products found for the given category'], 404);
        }
        // [{ ID: 1231, NAME: }]
        return response()->json($products);
    }
}
