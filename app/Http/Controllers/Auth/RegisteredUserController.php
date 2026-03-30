<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create(AuthRequest $request)
    {
        $view = 'auth.register';
        return view($view);
    }
    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(AuthRequest $request)
    {
        $request->validate(['name' => ['required', 'string', 'max:255'], 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'], 'password' => ['required', 'confirmed', Rules\Password::defaults()]]);
        $model = User::class;
        $user = $model::create(['name' => $request->name, 'email' => $request->email, 'password' => Hash::make($request->password)]);
        event(new Registered($user));
        if ($request->expectsJson()) {
            $token = $user->createToken($request->token_name);
            return response(['token' => $token->plainTextToken]);
        } else {
            Auth::guard($request->guard)->login($user);
            $redirect = route('home');
            return redirect($redirect);
        }
    }
}