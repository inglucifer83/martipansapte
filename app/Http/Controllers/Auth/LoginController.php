<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthRequest;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function create(AuthRequest $request)
    {
        $view = 'auth.login';
        if ($request->guard == 'admin') {
            $view = 'auth.admin.login';
        }
        return view($view);
    }
    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();
        if ($request->expectsJson()) {
            $token = $request->user()->createToken($request->token_name);
            return response(['token' => $token->plainTextToken]);
        } else {
            $request->session()->regenerate();
            $redirect = route('home');
            if ($request->guard == 'admin') {
                $redirect = route('admin.dashboard');
            }
            return redirect()->intended($redirect);
        }
    }
    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(AuthRequest $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $redirect = 'login';
        if ($request->guard == 'admin') {
            $redirect = 'login';
        }
        return redirect()->route($redirect);
    }
}