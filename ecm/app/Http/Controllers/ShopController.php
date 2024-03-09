<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Services\CartService;


class ShopController extends Controller
{
    /**
     * Display the specified resource in home page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function shop(Request $request)
    {
        $cartService = new CartService();
        $totalHeader = $cartService->calculateTotal();

        // Lấy danh sách danh mục từ database
        $categories = DB::table('category')->get();

        $orderBy = $request->input('orderBy', 'id');
        $sort = $request->input('sort', 'asc'); // Giả sử giá trị mặc định là 'asc'

        // Khởi tạo query để lấy sản phẩm
        // Thực thi truy vấn và lấy kết quả
        $products = DB::table('product')->orderBy($orderBy, $sort)->paginate(10); 

        $totalProducts = $products->count();


        // Chuẩn bị biến để truyền sang view
        $templateVariables = [
            'product' => $products,
            'category_categories' => $categories,
            'categoryId' => null,
            'orderBy' => $orderBy,
            'page' => 1,
            'size' => 10,
            'total' => $totalProducts,
            'searchString' => null,
            'products' => $products,
             'totalHeader' => $totalHeader
        ];

        // Trả về view kèm theo dữ liệu sản phẩm và danh mục
        return view('client.pages.shop', $templateVariables);
    }

    public function filterProduct(Request $request)
    {
        // Retrieve input parameters
        $category = $request->input('categoryId');
        $orderby = $request->input('orderby', 'id'); // You can set a default order column here
        $page = $request->input('page', 1);
        $size = $request->input('size', 10); // Default size as 10, you can change it as per your requirement
        $searchString = $request->input('search_string');

        // Query products based on the input parameters
        $query = DB::table('product');

        if ($category !== null) {
            $query->where('category_id', $category);
        }

        if ($searchString) {
            $query->where('name', 'like', '%' . $searchString . '%');
        }

        // Apply order by condition based on the request
        switch ($orderby) {
            case 'price_asc':
                $query->orderBy('sell_price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('sell_price', 'desc');
                break;
            default:
                // Mặc định sắp xếp theo cột được chỉ định trong $orderby, hoặc bạn có thể đặt một cột cụ thể ở đây
                $query->orderBy($orderby);
                break;
        }

        $totalProducts = $query->count();

        $products = $query
            ->skip(($page - 1) * $size)
            ->take($size)
            ->get();

        // You can return the products in JSON format along with pagination information
        return response()->json([
            'products' => $products,
            'total' => $totalProducts,
            'page' => $page,
            'size' => $size,
            'categoryId' => $category,
            'orderBy' => $orderby,
            'searchString' => $searchString
        ]);
    }
}
