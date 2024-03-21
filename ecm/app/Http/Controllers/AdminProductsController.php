<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Chuas casc logic crud category
class AdminProductsController extends Controller
{

    public function filterPage(Request $request)
    {
        $page = $request->query('page', 1);
        $size = $request->query('size', 10);

        $search = $request->query('s');

        $query = DB::table('product');

        if (!empty($search)) {

            $query

                ->orWhere('name', 'like', '%' . $search . '%')

                ->orWhere('description', 'like', '%' . $search . '%')

                ->orWhere('sell_price', 'like', '%' . $search . '%')

                ->orWhere('stock_quentity', 'like', '%' . $search . '%')

                ->orWhere('category_id', 'like', '%' . $search . '%')

                ->orWhere('original_price', 'like', '%' . $search . '%')

                ->orWhere('discount_price', 'like', '%' . $search . '%')

                ->orWhere('thumbnail_url', 'like', '%' . $search . '%')

                ->orWhere('detail_info', 'like', '%' . $search . '%')

                ->orWhere('created_at', 'like', '%' . $search . '%')

                ->orWhere('updated_at', 'like', '%' . $search . '%');
        }

        $listItem = $query->paginate($size, ['*'], 'page', $page);

        $totalPages = ceil($listItem->total() / $size);

        $templateVariables = [
            'listItem' => $listItem,
            'searchQuery' => $search,
            'perPage' => $size,
            'page' => $page,
            'totalPages' => $totalPages
        ];

        return view('admin/product/table', $templateVariables);
    }

    public function createFunction(Request $request)
    {
        $request->validate([

            'name' => 'nullable|string|max:255',

            'description' => 'nullable|string|max:255',

            'sell_price' => 'nullable|string|max:255',

            'stock_quentity' => 'nullable|string|max:255',

            'category_id' => 'nullable|string|max:255',

            'original_price' => 'nullable|string|max:255',

            'discount_price' => 'nullable|string|max:255',

            'thumbnail_url' => 'nullable|string|max:255',

            'detail_info' => 'nullable|string|max:255',

            'created_at' => 'nullable|string|max:255',

            'updated_at' => 'nullable|string|max:255',

        ]);

        // Check if ID is present
        if ($request->has('id')) {
            // Update existing record
            $category = DB::table('product')->where('id', $request->id)->first();
            if ($category) {
                $data = [

                    'name' => $request->name,

                    'description' => $request->description,

                    'sell_price' => $request->sell_price,

                    'stock_quentity' => $request->stock_quentity,

                    'category_id' => $request->category_id,

                    'original_price' => $request->original_price,

                    'discount_price' => $request->discount_price,

                    'thumbnail_url' => $request->thumbnail_url,

                    'detail_info' => $request->detail_info,

                    'created_at' => $request->created_at,

                    'updated_at' => $request->updated_at,

                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                DB::table('product')->where('id', $request->id)->update($data);
            } else {
                // Handle error: Category not found with the given ID
                return back()->withErrors(['id' => 'Category not found with the given ID']);
            }
        } else {
            // Create new record
            $data = [

                'name' => $request->name,

                'description' => $request->description,

                'sell_price' => $request->sell_price,

                'stock_quentity' => $request->stock_quentity,

                'category_id' => $request->category_id,

                'original_price' => $request->original_price,

                'discount_price' => $request->discount_price,

                'thumbnail_url' => $request->thumbnail_url,

                'detail_info' => $request->detail_info,

                'created_at' => $request->created_at,

                'updated_at' => $request->updated_at,

                'created_at' => now(),
                'updated_at' => now(),
            ];

            $success = DB::table('product')->insert($data);
        }

        return back();
    }


    public function deleteFunction($id)
    {
        $deletedRows = DB::table('product')->delete((int)$id);
        return back();
    }
}
