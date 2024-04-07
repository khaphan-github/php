<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminRole
{
    public function handle(Request $request, Closure $next)
    {
        Log::info(Auth::user());

        if (!Auth::user() || Auth::user()->about_me != 'ADMIN') {
            Log::info("Admin role check - current user is not an admin -> ");
            return redirect()->route('u.login');
        }
        return $next($request);
    }
}
