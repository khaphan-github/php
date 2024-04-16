<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;

// Chuas casc logic crud category
class AdminCategoryController extends Controller
{


    public function filterPage(Request $request)
    {
        $page = $request->query('page', 1);
        $size = $request->query('size', 10);

        $search = $request->query('s');

        $query = DB::table('category');

        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%');
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

        return view('admin/category/table', $templateVariables);
    }

    public function createFunction(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'parent_category_id' => 'nullable|exists:category,id',
        ]);

        // Check if ID is present
        if ($request->has('id')) {
            // Update existing record
            $category = DB::table('category')->where('id', $request->id)->first();
            if ($category) {
                $data = [
                    'name' => $request->name,
                    'icon' => $request->icon,
                    'parent_category_id' => $request->parent_category_id,
                    'updated_at' => now(),
                ];

                DB::table('category')->where('id', $request->id)->update($data);
            } else {
                // Handle error: Category not found with the given ID
                return back()->withErrors(['id' => 'Category not found with the given ID']);
            }
        } else {
            // Create new record
            $data = [
                'name' => $request->name,
                'icon' => $request->icon,
                'parent_category_id' => $request->parent_category_id,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            DB::table('category')->insert($data);
        }

        return back();
    }

    public function deleteFunction($id)
    {
        $deletedRows = DB::table('category')->delete((int)$id);
        return back();
    }
}
