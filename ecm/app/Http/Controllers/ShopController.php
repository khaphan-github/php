<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        // Lấy danh sách danh mục từ database
        $categories = DB::table('category')->get();

        // Khởi tạo query để lấy sản phẩm
        // Thực thi truy vấn và lấy kết quả
        $products =
            DB::table('product')->select('*')->limit((10));

        // Chuẩn bị biến để truyền sang view
        $templateVariables = [
            'product' => $products,
            'category_categories' => $categories,
            'category' => $categories,
            'categoryId' => null,
            'orderBy' => null,
            'page' => 1,
            'size' => 10,
            'searchString' => null,
            'products' => $products,
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

        $totalProducts = $query->count();

        $products = $query
            ->orderBy($orderby)
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
