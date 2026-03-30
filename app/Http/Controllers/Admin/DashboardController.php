<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthorizedRequest;
use App\Models\Address;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Image;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Review;
use App\Models\Tag;
use App\Models\User;
use App\Models\Variant;
class DashboardController extends Controller
{
    public function index(AuthorizedRequest $request)
    {
        $widgets = [];
        $widgets['Users'] = User::count();
        $widgets['Products'] = Product::count();
        $widgets['Categories'] = Category::count();
        $widgets['Tags'] = Tag::count();
        $widgets['Images'] = Image::count();
        $widgets['Variants'] = Variant::count();
        $widgets['Carts'] = Cart::count();
        $widgets['Cart Items'] = CartItem::count();
        $widgets['Orders'] = Order::count();
        $widgets['Order Items'] = OrderItem::count();
        $widgets['Payments'] = Payment::count();
        $widgets['Reviews'] = Review::count();
        $widgets['Addresses'] = Address::count();
        if ($request->expectsJson()) {
            return response($widgets);
        }
        return view('admin.dashboard', ['widgets' => $widgets]);
    }
}