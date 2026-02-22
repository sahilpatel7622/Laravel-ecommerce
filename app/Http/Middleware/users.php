<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;

class users
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(($request->path() == "login" || $request->path() == "register" || $request->is('/')) && Auth::check()){
            return redirect('/dashboard');
        }
        // Redirect if not logged in and trying to access protected pages (like dashboard)
        // if(!Auth::check() && $request->path() != "login" && $request->path() != "register" && !$request->is('/')){
        //     return redirect('/login')->with('error', 'Please login to access the dashboard.');
        // }

        return $next($request);
    }
}
