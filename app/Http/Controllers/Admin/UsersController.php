<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthorizedRequest;
use App\Models\User;
use Carbon\Carbon;
class UsersController extends Controller
{
    public function index(AuthorizedRequest $request)
    {
        $users = User::all();
        $widgets = [];
        $widgets['Users Count'] = User::count();
        $part = User::whereDate('created_at', '<', Carbon::today())->count();
        $total = User::where('id', '>')->count();
        $widgets['Progress'] = round($part / ($total > 0 ? $total : 1) * 100, 0);
        $widgets['Unverified users'] = User::where('email_verified_at', '=')->count();
        if ($request->expectsJson()) {
            return response($users);
        }
        return view('admin.users', ['users' => $users, 'widgets' => $widgets]);
    }
    public function store(AuthorizedRequest $request)
    {
        $fields = $request->all();
        $user = User::updateOrCreate(['id' => isset($fields['id']) ? $fields['id'] : 0], $fields);
        if ($request->expectsJson()) {
            return response($user);
        }
        return redirect()->back();
    }
    public function user(AuthorizedRequest $request, User $user)
    {
        if ($request->expectsJson()) {
            return response($user);
        }
        return view('admin.users.user', ['user' => $user]);
    }
    public function delete(AuthorizedRequest $request, ?User $user = null)
    {
        $user->delete();
        if ($request->expectsJson()) {
            return response('ok');
        }
        return redirect()->back();
    }
    public function restore(AuthorizedRequest $request, int $id)
    {
        $user = User::where('id', $id)->first();
        if ($user) {
            $user->restore();
            if ($request->expectsJson()) {
                return response('ok');
            }
        }
        return redirect()->back();
    }
    public function erease(AuthorizedRequest $request, int $id)
    {
        $user = User::where('id', $id)->first();
        if ($user) {
            $user->forceDelete();
            if ($request->expectsJson()) {
                return response('ok');
            }
        }
        return redirect()->back();
    }
}