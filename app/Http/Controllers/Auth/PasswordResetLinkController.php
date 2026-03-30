<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthRequest;
use Illuminate\Support\Facades\Password;
class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     *
     * @return \Illuminate\View\View
     */
    public function create(AuthRequest $request)
    {
        $view = 'auth.forgot';
        return view($view);
    }
    /**
     * Handle an incoming password reset link request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(AuthRequest $request)
    {
        $request->validate(['email' => ['required', 'email']]);
        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::broker($request->guard)->sendResetLink($request->only('email'));
        $route = 'login';
        if ($request->expectsJson()) {
            return response($status == Password::PASSWORD_RESET ? ['status' => __($status)] : ['error' => ['email' => __($status)]]);
        }
        return $status == Password::RESET_LINK_SENT ? redirect()->route($route)->with('status', __($status)) : back()->withInput($request->only('email'))->withErrors(['email' => __($status)]);
    }
}