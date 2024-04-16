<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartService;


class ContactController extends Controller
{
    public function contact(Request $request)
    {
        $cartService = new CartService();
        $totalHeader = $cartService->calculateTotal();

        // Chuẩn bị biến để truyền sang view
        $templateVariables = [
            'totalHeader' => $totalHeader,
        ];
        
        return view('client.pages.contact', $templateVariables);
    }
}
