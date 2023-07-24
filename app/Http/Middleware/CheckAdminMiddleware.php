<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $role = Auth::user()->role;
        if ($role != 1) {
            return redirect()->route("home");
        }
        return $next($request);
    }
}
