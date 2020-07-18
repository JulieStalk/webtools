<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guest()) {
            return redirect(route('login'));
        }
        //admin users only access    - user roles are admin and employee 
        if (Auth::user()->role != "admin") {
            return redirect(route('home'))->with('message','Access denied.');
        }
        return $next($request);
    }
}
