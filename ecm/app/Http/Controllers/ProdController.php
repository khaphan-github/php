<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CartService;
use Illuminate\Support\Facades\DB;

class ProdController extends Controller
{
    /**
     * Display the specified resource in home page.
     * 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function home(Request $request)
    {

        $cartService = new CartService();
        $totalHeader = $cartService->calculateTotal();

        // Khởi tạo query để lấy sản phẩm
        $query = DB::table('product')->select('*');

        // Áp dụng bộ lọc theo tên sản phẩm nếu có
        if ($request->filled('productName')) {
            $query->where('name', 'like', '%' . $request->productName . '%');
        }

        // Áp dụng bộ lọc theo danh mục sản phẩm nếu có
        if ($request->filled('categoryId')) {
            $query->where('id', '=', $request->categoryId);
        }

        // Thực thi truy vấn và lấy kết quả
        $products = $query->get(); // Lấy tất cả sản phẩm phù hợp với bộ lọc

        // Chuẩn bị biến để truyền sang view
        $templateVariables = [
            'product' => $products,
            'totalHeader' => $totalHeader
        ];

        // Trả về view kèm theo dữ liệu sản phẩm và danh mục
        return view('client.pages.home', $templateVariables);
    }

    public function getProductCategoryId(Request $request)
    {
        // Validate the request to ensure 'categoryId' is provided
        $request->validate([
            'categoryId' => 'required|integer|exists:categories,id',
        ]);

        // Fetch the category with its products
        // Assuming you're using route model binding or passing the category ID directly
        $categoryId = $request->input('categoryId');
        $category = DB::table('product')->find($categoryId);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        // Prepare the response data
        $products = $category->products;

        // Return the products as JSON
        return response()->json(['products' => $products]);
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
        return response()->json([
            'product_id' => $id,
            'name' => $product->name,
            'number_of_item' => $existingCartItem ? $existingCartItem->number_of_item + 1 : 1,
            'sell_price' => $product->sell_price,
            'thumbnail_url' => $product->thumbnail_url,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
            'success' => true
        ]);
    }

    public function updateCart(Request $request)
    {
        $id = $request->id;
        $number_of_item = $request->number_of_item;

        // Cập nhật số lượng sản phẩm trong giỏ hàng trong cơ sở dữ liệu
        DB::table('cart')->where('product_id', $id)->update(['number_of_item' => $number_of_item]);

        return response()->json([
            'name' => $product->name,
            'number_of_item' => $number_of_item,
            'sell_price' => $product->sell_price,
            'thumbnail_url' => $product->thumbnail_url,
            'message' => 'Product updated from cart successfully!'
        ]);
    }

    public function productDetails($id)
    {

        $cartService = new CartService();
        $totalHeader = $cartService->calculateTotal();

        $cart = DB::table('cart')->get();
        $product = DB::table('product')->where('id', $id)->first();
        $product_reviews = DB::table('product_review')->where('product_id', $id)->get();
        $rproducts = DB::table('product')->where('id', '!=', $id)->inRandomOrder()->take(4)->get();

        // Chuẩn bị biến để truyền sang view
        $templateVariables = [
            'product' => $product,
            'product_reviews' => $product_reviews,
            'totalHeader' => $totalHeader,
            'cart' => $cart,
            'rproducts' => $rproducts
        ];

        return view('client.pages.shop-details', $templateVariables);
    }
}
