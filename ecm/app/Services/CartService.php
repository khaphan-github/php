<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class CartService
{
    public function calculateTotal()
    {
        // Logic tính tổng tiền từ giỏ hàng
        $cartItems = DB::table('cart')->get();
        $totalHeader = 0;

        foreach ($cartItems as $item) {
            $product = DB::table('product')->where('id', $item->product_id)->first();
            $totalHeader += $product->sell_price * $item->number_of_item;
        }

        return $totalHeader;
    }
}
