<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;


class AdminAuth
{
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if(!Auth::guard('admin')->check()){
            return redirect('/admin/login');
        }
        return $next($request);
    }
}
