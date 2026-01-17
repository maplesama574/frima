<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckFirstLogin
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if ($user->first_login_completed) {
            return redirect('/home');
        }
        
        return $next($request);
    }
}
