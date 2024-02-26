<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;

class TestController extends Controller
{

    // function to get data from db then return view;
    public function get()    {
        // Delate variable from
        $listItem = DB::table('category')->get();

        $templateVariables = ['listItem' => $listItem];

        // view(templateName, variables);
        return view('test', $templateVariables); 
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'icon' => 'required|url',
            'parent_category_id' => 'nullable|numeric',
            'created_at' => 'nullable|date',
            'updated_at' => 'nullable|date',
        ]);


        DB::table('category')->insert([$validatedData]);

        // Redirect back or wherever you want
        return back()->with('success', 'Category created successfully!');
    }
}

