<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidatedRequest;
use App\Models\Order;
use App\Models\OrderItem;
class OrdersController extends Controller
{
    /**
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function index(ValidatedRequest $request)
    {
        // Authenticated user's orders
        $orders = Order::where('user_id', Auth::id())->get();
        $data = ['orders' => $orders, 'request' => $request];
        if ($request->expectsJson()) {
            return response($data);
        } else {
            return view('orders', $data);
        }
    }
    /**
     * @param Order $order
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function show(ValidatedRequest $request, Order $order)
    {
        // Load a specific order
        $order = Order::where('id', $order->id)->first();
        // Items belonging to the displayed order
        $orderItems = $order ? $order->orderItems : collect();
        $data = ['order' => $order, 'orderItems' => $orderItems, 'request' => $request];
        if ($request->expectsJson()) {
            return response($data);
        } else {
            return view('order', $data);
        }
    }
    /**
     * @param Order $order
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function destroy(ValidatedRequest $request, Order $order)
    {
        // Delete the order instance
        $order->delete();
        return redirect()->back();
    }
}