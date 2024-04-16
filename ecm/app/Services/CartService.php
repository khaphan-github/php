<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartService
{
    public function calculateTotal()
    {
        // Logic tính tổng tiền từ giỏ hàng
        // $cartItems = DB::table('cart')->where('owner_id', Auth::user()->id)->get();
        $cartItems = 0;
        $totalHeader = 0;

        // if ($cartItems !== null) {
           //  foreach ($cartItems as $item) {
             //   $product = DB::table('product')->where('id', $item->product_id)->first();
               //  $totalHeader += $product->sell_price * $item->number_of_item;
           //  }
        // }

        return $totalHeader;
    }
}
