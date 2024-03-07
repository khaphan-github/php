<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\table;

class ProductController extends Controller
{
    /**
     * Display the specified resource in home page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function home(Request $request)
    {
        // Lấy danh sách danh mục từ database
        $categories = DB::table('category')->get(); 
        
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
            'category' => $categories
        ];
        
        // Trả về view kèm theo dữ liệu sản phẩm và danh mục
        return view('client.pages.home', $templateVariables);
    }

    public function getProductCategoryId(Request $request){
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

    
}
