<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
class ContentSecurity
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
        $nonce = Str::random(24);
        session(['nonce' => $nonce]);
        $response = $next($request);
        if (config('app.debug', false)) {
            session()->forget('nonce');
            return $response;
        }
        if (method_exists($response, 'header')) {
            $contentSecurityString = Cache::rememberForever('csp-header-value', function () {
                $csp = json_decode(file_get_contents(resource_path('defaults/csp.json')), true);
                return collect($csp)->map(function ($values, $directive) {
                    return $directive . " " . implode(' ', $values);
                })->join('; ');
            });
            $contentSecurityString = str_replace('{NONCE}', $nonce, $contentSecurityString);
            $response->header('Content-Security-Policy', $contentSecurityString);
        }
        session()->forget('nonce');
        return $response;
    }
}