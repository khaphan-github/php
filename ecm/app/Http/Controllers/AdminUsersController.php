<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Chuas casc logic crud category
class AdminUsersController extends Controller
{

    public function filterPage(Request $request)
    {
        $page = $request->query('page', 1);
        $size = $request->query('size', 10);

        $search = $request->query('s');

        $query = DB::table('users');

        if (!empty($search)) {

            $query

                ->orWhere('name', 'like', '%' . $search . '%')

                ->orWhere('email', 'like', '%' . $search . '%')

                ->orWhere('password', 'like', '%' . $search . '%')

                ->orWhere('phone', 'like', '%' . $search . '%')

                ->orWhere('location', 'like', '%' . $search . '%')

                ->orWhere('about_me', 'like', '%' . $search . '%')

                ->orWhere('remember_token', 'like', '%' . $search . '%')

                ->orWhere('updated_at', 'like', '%' . $search . '%')

                ->orWhere('created_at', 'like', '%' . $search . '%');
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

        return view('admin/users/table', $templateVariables);
    }

    public function createFunction(Request $request, User $user)
    {
        $request->validate([

            'name' => 'nullable|string|max:255',

            'email' => 'nullable|string|max:255',

            'password' => 'nullable|string|max:255',

            'phone' => 'nullable|string|max:255',

            'location' => 'nullable|string|max:255',

            'about_me' => 'nullable|string|max:255',
        ]);

        // Check if ID is present
        if ($request->has('id')) {
            // Update existing record
            $category = DB::table('users')->where('id', $request->id)->first();
            if ($category) {
                $data = [

                    'name' => $request->name,

                    'email' => $request->email,

                    'password' => bcrypt($request->password),

                    'phone' => $request->phone,

                    'location' => $request->location,

                    'about_me' => $request->about_me,

                    'remember_token' => $request->remember_token,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                DB::table('users')->where('id', $request->id)->update($data);
            } else {
                // Handle error: Category not found with the given ID
                return back()->withErrors(['id' => 'Category not found with the given ID']);
            }
        } else {
            // Create new record
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'phone' => $request->phone,
                'location' => $request->location,
                'about_me' => $request->about_me,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $success = DB::table('users')->insert($data);
        }

        return back();
    }


    public function deleteFunction($id)
    {
        $deletedRows = DB::table('users')->delete((int)$id);
        return back();
    }
}
