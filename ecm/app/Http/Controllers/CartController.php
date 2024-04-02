<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Services\CartService;
use RealRashid\SweetAlert\Facades\Alert;



class CartController extends Controller
{
    // Hiển thị trang giỏ hàng với sản phẩm đã thêm
    public function cart(Request $request)
    {
        $cartService = new CartService();
        $totalHeader = $cartService->calculateTotal();

        // Lấy danh sách sản phẩm trong giỏ hàng từ cơ sở dữ liệu
        $cart = DB::table('cart')->get();

        // Khởi tạo biến tổng cộng và tổng tiền
        $total = 0;


        if (!$cart) {
            // Duyệt qua từng sản phẩm trong giỏ hàng để tính toán tổng cộng và tổng số tiền
            foreach ($cart as $item) {
                $product = DB::table('product')->where('id', $item->product_id)->first();
                // Tính tổng cộng cho mỗi sản phẩm
                $total += $product->sell_price * $item->number_of_item;
            }
        }

        // Chuẩn bị biến để truyền sang view
        $templateVariables = [
            'total' => $total,
            'totalHeader' => $totalHeader,
            'cart' => $cart
        ];

        return view('client.pages.shop-cart', $templateVariables);
    }

    public function addToCart(Request $request)
    {
        // Lấy ID sản phẩm từ request
        $id = $request->input('productId');

        // Tìm sản phẩm dựa trên ID
        $product = DB::table('product')->where('id', $id)->first();
        
        if (!$product) {
            return response()->json(['error' => 'Product not found!'], 404);
        }

        // Kiểm tra sản phẩm đã tồn tại trong giỏ hàng chưa
        $existingCartItem = DB::table('cart')->where('product_id', $id)->first();

        if ($existingCartItem) {
            // Nếu có, tăng số lượng trong cơ sở dữ liệu và cập nhật thời gian cập nhật
            DB::table('cart')
                ->updateOrInsert(
                    ['product_id' => $id],
                    ['number_of_item' => DB::raw('number_of_item + 1'), 'updated_at' => now()]
                );

            // Lấy thông tin về thời gian tạo và thời gian cập nhật từ cơ sở dữ liệu
            $created_at = $existingCartItem->created_at;
            $updated_at = now();


        } else {
            // Nếu chưa, thêm mới sản phẩm vào giỏ hàng với số lượng là 1 trong cơ sở dữ liệu
            DB::table('cart')->insert([
                'product_id' => $id,
                'number_of_item' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Lấy thông tin về thời gian tạo và thời gian cập nhật từ cơ sở dữ liệu
            $created_at = now();
            $updated_at = now();
           
        }
        // Trả về response thành công
        return response()->json(['product_id' => $id,
                                'name' => $product->name,
                                'number_of_item' => $existingCartItem ? $existingCartItem->number_of_item + 1 : 1,
                                'sell_price' => $product->sell_price,
                                'thumbnail_url' => $product->thumbnail_url,
                                'created_at' => $created_at,
                                'updated_at' => $updated_at,
                                'success'=> true]);
    }


    public function removeFromCart(Request $request)
    {
        $id = $request->id;
        // Xóa sản phẩm khỏi giỏ hàng trong cơ sở dữ liệu
        DB::table('cart')->where('product_id', $id)->delete();

        return back()->with('success', 'Product removed from cart successfully!');
    }
    public function updateCart(Request $request)
    {
        $id = $request->id;
        $number_of_item = $request->number_of_item;

        // Cập nhật số lượng sản phẩm trong giỏ hàng trong cơ sở dữ liệu
        DB::table('cart')->where('product_id', $id)->update(['number_of_item' => $number_of_item]);

        return response()->json(['name' => $product->name,
                                'number_of_item' => $number_of_item,
                                'sell_price' => $product->sell_price,
                                 'thumbnail_url' => $product->thumbnail_url,
                                 'message' => 'Product updated from cart successfully!']);
    }
    
}
