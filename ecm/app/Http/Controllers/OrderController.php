<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartService;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display the specified resource in home page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function checkout(Request $request)
    {
        $cartService = new CartService();
        $totalHeader = $cartService->calculateTotal();

         // Lấy danh sách sản phẩm trong giỏ hàng từ cơ sở dữ liệu
        $cart = DB::table('cart')->get();

        // Khởi tạo biến tổng cộng và tổng tiền
        $total = 0;

        // Duyệt qua từng sản phẩm trong giỏ hàng để tính toán tổng cộng và tổng số tiền
        foreach ($cart as $item) {
            $product = DB::table('product')->where('id', $item->product_id)->first();
            // Tính tổng cộng cho mỗi sản phẩm
            $total += $product->sell_price * $item->number_of_item;
        }


        // Chuẩn bị biến để truyền sang view
        $templateVariables = [
            'totalHeader' => $totalHeader,
            'cart' => $cart,
            'total' => $total
        ];

        // Trả về view kèm theo dữ liệu sản phẩm và danh mục
        return view('client.pages.checkout', $templateVariables);
    }
}
