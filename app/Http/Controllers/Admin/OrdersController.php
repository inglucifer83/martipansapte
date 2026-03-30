<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthorizedRequest;
use App\Models\Order;
class OrdersController extends Controller
{
    public function index(AuthorizedRequest $request)
    {
        $orders = Order::all();
        $widgets = [];
        $widgets['Orders Count'] = Order::count();
        if ($request->expectsJson()) {
            return response($orders);
        }
        return view('admin.orders', ['orders' => $orders, 'widgets' => $widgets]);
    }
    public function store(AuthorizedRequest $request)
    {
        $fields = $request->all();
        $order = Order::updateOrCreate(['id' => isset($fields['id']) ? $fields['id'] : 0], $fields);
        if ($request->expectsJson()) {
            return response($order);
        }
        return redirect()->back();
    }
    public function order(AuthorizedRequest $request, Order $order)
    {
        if ($request->expectsJson()) {
            return response($order);
        }
        return view('admin.orders.order', ['order' => $order]);
    }
    public function delete(AuthorizedRequest $request, ?Order $order = null)
    {
        $order->delete();
        if ($request->expectsJson()) {
            return response('ok');
        }
        return redirect()->back();
    }
    public function restore(AuthorizedRequest $request, int $id)
    {
        $order = Order::where('id', $id)->first();
        if ($order) {
            $order->restore();
            if ($request->expectsJson()) {
                return response('ok');
            }
        }
        return redirect()->back();
    }
    public function erease(AuthorizedRequest $request, int $id)
    {
        $order = Order::where('id', $id)->first();
        if ($order) {
            $order->forceDelete();
            if ($request->expectsJson()) {
                return response('ok');
            }
        }
        return redirect()->back();
    }
}