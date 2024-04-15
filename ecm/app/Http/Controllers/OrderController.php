<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

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

    public function paypal(Request $request){

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('success'),
                "cancel_url" => route('cancel')
            ],
            "purchase_units" => [
                [
                    "amount" => [
                    "currency_code" => "USD",
                    "value" => $request->input('total')
                    ]
                ]
            ]
        ]);
        if(isset($response['id']) && $response['id'] != null){
            foreach($response['links'] as $link){
                if($link['rel'] == 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        } else {
            return redirect()->route('cancel');
        }
    }

    public function success(Request $request){

        $cartService = new CartService();
        $totalHeader = $cartService->calculateTotal();

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);
        if(isset($response['status']) && $response['status'] == 'COMPLETED'){
            
            // Lấy thông tin về đơn hàng từ bảng 'cart'
            $cartItems = DB::table('cart')->get();

            // INSERT dữ liệu vào bảng 'order'
            $status = 'COMPLETED';
            $payment_method = 'paypal';
            $created_at = now();

            $orderId = DB::table('order')->insertGetId([
                'status' => $status,
                'payment_method' => $payment_method,
                'created_at' => $created_at,
                'updated_at' => $created_at,
                'user_id' => Auth::user()->id,
            ]);


            // INSERT dữ liệu vào bảng 'order_detail' cho mỗi sản phẩm trong giỏ hàng
            foreach ($cartItems as $item) {
                $productId = $item->product_id;
                $product = DB::table('product')->where('id', $productId)->first();
                $priceAtPurchase = $product->sell_price * $item->number_of_item;

                DB::table('order_detail')->insert([
                    'order_id' => $orderId,
                    'product_id' => $productId,
                    'price_at_purchase' => $priceAtPurchase,
                    'number_of_items'=> $item->number_of_item,
                    'created_at' => $created_at,
                    'updated_at' => $created_at,
                ]);
            }

            // Xóa thông tin giỏ hàng sau khi đã xử lý đơn hàng thành công
            DB::table('cart')->delete();

            // Chuẩn bị biến để truyền sang view
            $templateVariables = [
                'totalHeader' => $totalHeader,
                'orderId' => $orderId
            ];
            return view('client.pages.Succeed', $templateVariables);
        }else{
            return redirect()->route('cancel');
        }
    }

    public function cancel(){

        $cartService = new CartService();
        $totalHeader = $cartService->calculateTotal();

        // Tạo một ID mới cho đơn hàng bị hủy
        $newOrderId = DB::table('order')->insertGetId([
            'status' => 'Failed',
            'payment_method' => 'paypal',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $templateVariables = [
            'totalHeader' => $totalHeader,
            'newOrderId' => $newOrderId
        ];

        return view('client.pages.Failed', $templateVariables);
    }

}
