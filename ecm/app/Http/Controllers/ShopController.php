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
        $products = $query->paginate(10); 
        
        // Chuẩn bị biến để truyền sang view
        $templateVariables = [
            'product' => $products,
            'category' => $categories
        ];
        
        // Trả về view kèm theo dữ liệu sản phẩm và danh mục
        return view('client.pages.shop', $templateVariables);
    }
}
