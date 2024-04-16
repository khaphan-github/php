<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Chuas casc logic crud category
class AdminOrdersController extends Controller
{

    public function filterPage(Request $request)
    {
        $page = $request->query('page', 1);
        $size = $request->query('size', 10);

        $search = $request->query('s');

        $query = DB::table('order');

        if (!empty($search)) {

            $query
                ->orWhere('status', 'like', '%' . $search . '%')

                ->orWhere('payment_method', 'like', '%' . $search . '%')

                ->orWhere('user_id', 'like', '%' . $search . '%')

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

        return view('admin/order/table', $templateVariables);
    }

    public function createFunction(Request $request)
    {
        $request->validate([
            'status' => 'nullable|string|max:255',
            'payment_method' => 'nullable|string|max:255',
            'user_id' => 'nullable|string|max:255',
            'created_at' => 'nullable|string|max:255',
            'updated_at' => 'nullable|string|max:255',
        ]);

        // Check if ID is present
        if ($request->has('id')) {
            // Update existing record
            $category = DB::table('order')->where('id', $request->id)->first();
            if ($category) {
                $data = [
                    'status' => $request->status,
                    'payment_method' => $request->payment_method,
                    'user_id' => $request->user_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                DB::table('order')->where('id', $request->id)->update($data);
            } else {
                // Handle error: Category not found with the given ID
                return back()->withErrors(['id' => 'Category not found with the given ID']);
            }
        } else {
            // Create new record
            $data = [
                'status' => $request->status,
                'payment_method' => $request->payment_method,
                'user_id' => $request->user_id,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $success = DB::table('order')->insert($data);
        }

        return back();
    }


    public function deleteFunction($id)
    {
        $deletedRows = DB::table('order')->delete((int) $id);
        return back();
    }

    public function getOrderDetail($id) {
        $listItem = DB::table('order_detail')
            ->select('order_detail.*', 'product.*')
            ->leftJoin('product', 'order_detail.product_id', '=', 'product.id')
            ->where('order_detail.order_id', '=', $id)
            ->get();
        $templateVariables = [
            'listItem' => $listItem,
        ];
        return view('admin/order-details/table', $templateVariables);
    }
}
