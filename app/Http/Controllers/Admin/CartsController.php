<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthorizedRequest;
use App\Models\Cart;
class CartsController extends Controller
{
    public function index(AuthorizedRequest $request)
    {
        $carts = Cart::all();
        $widgets = [];
        $widgets['Carts Count'] = Cart::count();
        if ($request->expectsJson()) {
            return response($carts);
        }
        return view('admin.carts', ['carts' => $carts, 'widgets' => $widgets]);
    }
    public function store(AuthorizedRequest $request)
    {
        $fields = $request->all();
        $cart = Cart::updateOrCreate(['id' => isset($fields['id']) ? $fields['id'] : 0], $fields);
        if ($request->expectsJson()) {
            return response($cart);
        }
        return redirect()->back();
    }
    public function cart(AuthorizedRequest $request, Cart $cart)
    {
        if ($request->expectsJson()) {
            return response($cart);
        }
        return view('admin.carts.cart', ['cart' => $cart]);
    }
    public function delete(AuthorizedRequest $request, ?Cart $cart = null)
    {
        $cart->delete();
        if ($request->expectsJson()) {
            return response('ok');
        }
        return redirect()->back();
    }
}