<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthorizedRequest;
use App\Models\CartItem;
class CartItemsController extends Controller
{
    public function index(AuthorizedRequest $request)
    {
        $cart_items = CartItem::all();
        $widgets = [];
        $widgets['Cart Items Count'] = CartItem::count();
        if ($request->expectsJson()) {
            return response($cart_items);
        }
        return view('admin.cart_items', ['cart_items' => $cart_items, 'widgets' => $widgets]);
    }
    public function store(AuthorizedRequest $request)
    {
        $fields = $request->all();
        $cartitem = CartItem::updateOrCreate(['id' => isset($fields['id']) ? $fields['id'] : 0], $fields);
        if ($request->expectsJson()) {
            return response($cartitem);
        }
        return redirect()->back();
    }
    public function cartitem(AuthorizedRequest $request, CartItem $cartitem)
    {
        if ($request->expectsJson()) {
            return response($cartitem);
        }
        return view('admin.cart_items.cartitem', ['cartitem' => $cartitem]);
    }
    public function delete(AuthorizedRequest $request, ?CartItem $cartitem = null)
    {
        $cartitem->delete();
        if ($request->expectsJson()) {
            return response('ok');
        }
        return redirect()->back();
    }
}