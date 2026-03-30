<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthorizedRequest;
use App\Models\OrderItem;
class OrderItemsController extends Controller
{
    public function index(AuthorizedRequest $request)
    {
        $order_items = OrderItem::all();
        $widgets = [];
        $widgets['Order Items Count'] = OrderItem::count();
        if ($request->expectsJson()) {
            return response($order_items);
        }
        return view('admin.order_items', ['order_items' => $order_items, 'widgets' => $widgets]);
    }
    public function store(AuthorizedRequest $request)
    {
        $fields = $request->all();
        $orderitem = OrderItem::updateOrCreate(['id' => isset($fields['id']) ? $fields['id'] : 0], $fields);
        if ($request->expectsJson()) {
            return response($orderitem);
        }
        return redirect()->back();
    }
    public function orderitem(AuthorizedRequest $request, OrderItem $orderitem)
    {
        if ($request->expectsJson()) {
            return response($orderitem);
        }
        return view('admin.order_items.orderitem', ['orderitem' => $orderitem]);
    }
    public function delete(AuthorizedRequest $request, ?OrderItem $orderitem = null)
    {
        $orderitem->delete();
        if ($request->expectsJson()) {
            return response('ok');
        }
        return redirect()->back();
    }
}