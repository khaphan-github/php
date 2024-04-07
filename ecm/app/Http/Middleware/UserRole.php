<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserRole
{
    public function handle(Request $request, Closure $next)
    {
        Log::info(Auth::user());

        if (!Auth::user() || Auth::user()->about_me != 'USER') {
            Log::info("UserRole check - current user is not an USER -> ");
            return redirect()->route('u.login');
        }
        return $next($request);
    }

}
