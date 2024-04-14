<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class APIController extends Controller
{
    public function store(Request $request)
    {
        $product = $request->all();
        
        $now = now();
        $product['created_at'] = $now;
        $product['updated_at'] = $now;

        $productId = DB::table('product')->insertGetId($product);
        return response()->json(['id' => $productId], 201);
    }

    // Get all products
    public function index()
    {
        $products = DB::table('product')->get();

        return response()->json($products);
    }

    // Get a single product by ID
    public function show($id)
    {
        $product = DB::table('product')->find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product);
    }

    // Update a product
    public function update(Request $request, $id)
    {
        $product = $request->all();
        $product['updated_at'] = now();
        $affected = DB::table('product')
            ->where('id', $id)
            ->update($product);

        if ($affected) {
            return response()->json(['message' => 'Product updated successfully']);
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }

    public function destroy($id)
    {
        $deleted = DB::table('product')->where('id', $id)->delete();
        if ($deleted) {
            return response()->json(null, 204);
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }
}
