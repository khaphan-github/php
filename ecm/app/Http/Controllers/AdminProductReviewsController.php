<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Chuas casc logic crud category
class AdminProductReviewsController extends Controller
{

    public function filterPage(Request $request)
    {
        $page = $request->query('page', 1);
        $size = $request->query('size', 10);

        $search = $request->query('s');

        $query = DB::table('product_review');

        if (!empty($search)) {
            $query->where(function ($query) use ($search) {
                $query->where('user_id', 'like', '%' . $search . '%')
                    ->orWhere('rating', 'like', '%' . $search . '%')
                    ->orWhere('comment', 'like', '%' . $search . '%')
                    ->orWhere('image_url', 'like', '%' . $search . '%')
                    ->orWhere('like_number', 'like', '%' . $search . '%')
                    ->orWhere('title', 'like', '%' . $search . '%')
                    ->orWhere('updated_at', 'like', '%' . $search . '%')
                    ->orWhere('created_at', 'like', '%' . $search . '%');
            });
        }

        if ($request->has('product_id')) {
            $query->where('product_id', $request->query('product_id'));
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

        return view('admin/product_review/table', $templateVariables);
    }
    public function createFunction(Request $request)
    {
        $request->validate([

            'product_id' => 'nullable|string|max:255',

            'user_id' => 'nullable|string|max:255',

            'rating' => 'nullable|string|max:255',

            'comment' => 'nullable|string|max:255',

            'image_url' => 'nullable|string|max:255',

            'like_number' => 'nullable|string|max:255',

            'title' => 'nullable|string|max:255',

            'updated_at' => 'nullable|string|max:255',

            'created_at' => 'nullable|string|max:255',

        ]);

        // Check if ID is present
        if ($request->has('id')) {
            // Update existing record
            $category = DB::table('product_review')->where('id', $request->id)->first();
            if ($category) {
                $data = [

                    'product_id' => $request->product_id,

                    'user_id' => $request->user_id,

                    'rating' => $request->rating,

                    'comment' => $request->comment,

                    'image_url' => $request->image_url,

                    'like_number' => $request->like_number,

                    'title' => $request->title,

                    'updated_at' => $request->updated_at,

                    'created_at' => $request->created_at,

                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                DB::table('product_review')->where('id', $request->id)->update($data);
            } else {
                // Handle error: Category not found with the given ID
                return back()->withErrors(['id' => 'Category not found with the given ID']);
            }
        } else {
            // Create new record
            $data = [

                'product_id' => $request->product_id,

                'user_id' => $request->user_id,

                'rating' => $request->rating,

                'comment' => $request->comment,

                'image_url' => $request->image_url,

                'like_number' => $request->like_number,

                'title' => $request->title,

                'updated_at' => $request->updated_at,

                'created_at' => $request->created_at,

                'created_at' => now(),
                'updated_at' => now(),
            ];

            $success = DB::table('product_review')->insert($data);
        }

        return back();
    }


    public function deleteFunction($id)
    {
        $deletedRows = DB::table('product_review')->delete((int)$id);
        return back();
    }
}
