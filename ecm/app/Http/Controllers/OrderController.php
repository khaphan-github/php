<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartService;

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

        // Chuẩn bị biến để truyền sang view
        $templateVariables = [
            'totalHeader' => $totalHeader
        ];

        // Trả về view kèm theo dữ liệu sản phẩm và danh mục
        return view('client.pages.checkout', $templateVariables);
    }
}
