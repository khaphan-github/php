<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        return view('session.register');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:100', 'min:10'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:20'],
        ]);
        $attributes['password'] = bcrypt($attributes['password'] );
        $attributes['about_me']  = 'USER';
        $user = User::create($attributes);
        session()->flash('success', 'Your account has been created.');
        return redirect('/login');
    }
}
