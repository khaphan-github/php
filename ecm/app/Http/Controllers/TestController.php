<?php

namespace App\Http\Controllers;

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
        // Delate variable from db
        $users = DB::table('users')->get();

        $templateVariables = ['users' => $users];

        // view(templateName, variables);
        return view('test', $templateVariables); 
    }
}

