<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $id = $request->input('id');
        $product = Product::find($request->id);
        $cart = Session::get('cart', []);

        if(isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }
        
        Session::put('cart', $cart);
        return response()->json(['success' => 'Product added to cart successfully!']);
    }

    public function removeFromCart(Request $request)
    {
        $cart = Session::get('cart', []);
        if(isset($cart[$request->id])) {
            unset($cart[$request->id]);
            Session::put('cart', $cart);
        }
        return back()->with('success', 'Product removed from cart successfully!');
    }

    public function updateCart(Request $request)
    {
        $cart = Session::get('cart', []);
        if(isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] = $request->quantity;
            Session::put('cart', $cart);
        }
        return back()->with('success', 'Cart updated successfully!');
    }

    // Hiển thị trang giỏ hàng với sản phẩm đã thêm
    public function showCart()
    {
        $cart = Session::get('cart', []);
        return view('client.pages.cart', ['cart' => $cart]);
    }
}
