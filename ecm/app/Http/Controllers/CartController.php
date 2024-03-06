<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        // Lấy ID sản phẩm từ request
        $id = $request->input('productId');

        // Tìm sản phẩm dựa trên ID
        $product = DB::table('product')->where('id', $id)->first();
        
        if (!$product) {
            return response()->json(['error' => 'Product not found!'], 404);
        }

        // Lấy giỏ hàng hiện tại từ session hoặc khởi tạo nếu chưa có
        $cart = Session::get('cart', []);

        // Kiểm tra sản phẩm đã tồn tại trong giỏ hàng chưa
        if (isset($cart[$id])) {
            // Nếu có, tăng số lượng
            $cart[$id]['number_of_item']++;
        } else {
            // Nếu chưa, thêm mới sản phẩm vào giỏ hàng với số lượng là 1
            $cart[$id] = [
                "name" => $product->name,
                "number_of_item" => 1,
                "sell_price" => $product->sell_price,
                "thumbnail_url" => $product->thumbnail_url
            ];
        }
        
        // Cập nhật giỏ hàng trong session
        Session::put('cart', $cart);

        // Trả về response thành công
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
            $cart[$request->id]['number_of_item'] = $request->number_of_item;
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
