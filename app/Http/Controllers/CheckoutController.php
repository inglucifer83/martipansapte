<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidatedRequest;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
class CheckoutController extends Controller
{
    /**
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function show(ValidatedRequest $request)
    {
        // Active cart for checkout
        $cart = Cart::where('is_active', 1)->first();
        // User saved addresses for shipping/billing
        $addresses = auth()->check() ? auth()->user()->addresses : collect();
        $data = ['cart' => $cart, 'addresses' => $addresses, 'request' => $request];
        if ($request->expectsJson()) {
            return response($data);
        } else {
            return view('checkout', $data);
        }
    }
    /**
     * @param Cart $cart
     * @param Address $address
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function store(ValidatedRequest $request, Cart $cart, Address $address)
    {
        // Retrieve all request fields
        $fields = $request->all();
        // Update or create an existing or a new Order instance
        $order = Order::updateOrCreate($fields);
        return redirect()->back();
    }
}