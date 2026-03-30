<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidatedRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Variant;
class CartController extends Controller
{
    /**
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function show(ValidatedRequest $request)
    {
        // Load current active cart
        $cart = Cart::where('is_active', 1)->first();
        // Items in the active cart
        $cartItems = $cart ? $cart->cartItems : collect();
        $data = ['cart' => $cart, 'cartItems' => $cartItems, 'request' => $request];
        if ($request->expectsJson()) {
            return response($data);
        } else {
            return view('cart', $data);
        }
    }
    /**
     * @param Product $product
     * @param int $quantity
     * @param Variant $variant
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function storeItem(ValidatedRequest $request, Product $product, int $quantity, Variant $variant)
    {
        // Retrieve all request fields
        $fields = $request->all();
        // Update or create an existing or a new CartItem instance
        $cart_item = CartItem::updateOrCreate($fields);
        return redirect()->back();
    }
    /**
     * @param CartItem $cart_item
     * @param int $quantity
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function updateItem(ValidatedRequest $request, CartItem $cart_item, int $quantity)
    {
        // Retrieve all request fields
        $fields = $request->all();
        // Update or create an existing or a new CartItem instance
        $cart_item = CartItem::updateOrCreate($fields);
        return redirect()->back();
    }
    /**
     * @param CartItem $cart_item
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function destroyItem(ValidatedRequest $request, CartItem $cart_item)
    {
        // Delete the cart_item instance
        $cart_item->delete();
        return redirect()->back();
    }
}