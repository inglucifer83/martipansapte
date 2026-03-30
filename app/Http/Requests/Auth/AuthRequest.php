<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
class AuthRequest extends FormRequest
{
    public $guard;
    public function __construct()
    {
        $routeParts = explode('.', Route::getCurrentRoute()->getName());
        $isApi = $routeParts[0] == 'api';
        if ($isApi) {
            $this->guard = 'api';
        } else {
            $guards = ['users', 'admin'];
            $this->guard = count($guards) > 0 ? $guards[0] : config('auth.defaults.guard');
            if (in_array($routeParts[0], $guards)) {
                $this->guard = $routeParts[0];
            }
        }
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}