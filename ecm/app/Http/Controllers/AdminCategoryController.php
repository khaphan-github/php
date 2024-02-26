<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;

// Chuas casc logic crud category
class AdminCategoryController extends Controller
{

     
    public function createPage(Request $request)    {
        // Delate variable from db
        $users = DB::table('users')->get();

        $templateVariables = ['users' => $users];

        // view(templateName, variables);
        return view('test', $templateVariables); 
    }

    public function createFunction(Request $request)    {
        // $attributes = request()->validate([
        //     'email'=>'required|email',
        //     'password'=>'required' 
        // ]);

        // Delate variable from db
        $users = DB::table('users')->get();

        $templateVariables = ['users' => $users];

        // view(templateName, variables);
        return view('test', $templateVariables); 
    }

    public function filterPage(Request $request)    {
        // Delate variable from db
        $listItem = DB::table('category')->get();
        $templateVariables = ['listItem' => $listItem];
        // view(templateName, variables);
        return view('test', $templateVariables); 
    }

    public function updatePage(Request $request)    {
        // Delate variable from db
        $users = DB::table('users')->get();

        $templateVariables = ['users' => $users];

        // view(templateName, variables);
        return view('test', $templateVariables); 
    }

    public function updateFunction(Request $request)    {
        // Delate variable from db
        $users = DB::table('users')->get();

        $templateVariables = ['users' => $users];

        // view(templateName, variables);
        return view('test', $templateVariables); 
    }
    
    public function deleteFunction(Request $request)    {
        // Delate variable from db
        $users = DB::table('users')->get();

        $templateVariables = ['users' => $users];

        // view(templateName, variables);
        return view('test', $templateVariables); 
    }

    public function deletePage(Request $request)    {
        // Delate variable from db
        $users = DB::table('users')->get();

        $templateVariables = ['users' => $users];

        // view(templateName, variables);
        return view('test', $templateVariables); 
    }
}

