<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }

    public function store(Request $request)
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $current_user = DB::table('users')->where('email', $request->email)->first();

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            session()->regenerate();
            if ($current_user->about_me == 'ADMIN') {
                return redirect('dashboard')->with(['success' => 'You are logged in.']);
            } else {
                return redirect('shop')->with(['success' => 'You are logged in.']);
            }
        } else {
            return back()->withErrors(['email' => 'Email or password invalid.']);
        }
    }

    public function destroy(Request $request)
    {
        // Access specific form fields
        $current_user = DB::table('users')->where('email', $request->email)->first();
        Auth::logout();

        if ($current_user->about_me == 'ADMIN') {
                return redirect('admin/login')->with(['success' => 'You\'ve been logged out.']);

            } else {
                return redirect('u/login')->with(['success' => 'You\'ve been logged out.']);
            }
    }
}
