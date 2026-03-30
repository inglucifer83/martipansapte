<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
class AddVariables
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
        if ($request->getMethod() == 'GET') {
            View::share('authenticated', Auth::check());
            View::share('user', Auth::check() ? Auth::user() : null);
            View::share('locales', ['en_US', 'it_IT']);
        }
        return $next($request);
    }
}