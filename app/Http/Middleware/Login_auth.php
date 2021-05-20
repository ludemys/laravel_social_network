<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Login_auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('user')) {
            return redirect()->route('home.login')->withErrors(['not_logged', 'Please log in to get in this page']);
        }

        return $next($request);
    }
}
