<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;

class InfoUserController extends Controller
{

    public function create()
    {
        return view('laravel-examples/user-profile');
    }

    public function store(Request $request)
    {

        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'phone'     => ['max:50'],
            'location' => ['max:70'],
            'about_me'    => ['max:150'],
        ]);

        User::where('id', Auth::user()->id)
            ->update([
                'name'    => $attributes['name'],
               //  'email' => $attribute['email'],
                'phone'     => $attributes['phone'],
                'location' => $attributes['location'],
                // 'about_me'    => $attributes["about_me"],
            ]);

        return back()->with('success', 'Profile updated successfully');
    }

    public function getOrders() {

    }

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
