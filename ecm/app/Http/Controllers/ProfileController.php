<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function profile(Request $request)
    {
        $cartService = new CartService();
        $totalHeader = $cartService->calculateTotal();

        // Chuẩn bị biến để truyền sang view
        $templateVariables = [
            'totalHeader' => $totalHeader,
            'orders' =>  DB::table('order')
            ->where('user_id', Auth::user()->id)
            ->get(),
        ];
        
        return view('client.pages.profile', $templateVariables);
    }

    public function detailOrder(Request $request)
    {

        $cartService = new CartService();
        $totalHeader = $cartService->calculateTotal();

        $templateVariables = [
        'totalHeader' => $totalHeader,
        'orders' => DB::table('order_detail')
            ->select('order_detail.*', 'product.*')
            ->leftJoin('product', 'order_detail.product_id', '=', 'product.id')
            ->where('order_detail.order_id', '=', $request->id)
            ->get()
        ];
       

        return view('client.pages.detail-order', $templateVariables);
    }

}
