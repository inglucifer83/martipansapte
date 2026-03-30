<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
class CheckLocale
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
        $locale = session('locale', null);
        if (!$locale) {
            $locale = app()->getLocale();
            session(['locale' => $locale]);
        } else {
            app()->setLocale($locale);
        }
        URL::defaults(['locale' => $locale]);
        return $next($request);
    }
}