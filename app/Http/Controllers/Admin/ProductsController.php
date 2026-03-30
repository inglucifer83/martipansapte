<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthorizedRequest;
use App\Models\Product;
class ProductsController extends Controller
{
    public function index(AuthorizedRequest $request)
    {
        $products = Product::all();
        $widgets = [];
        $widgets['Products Count'] = Product::count();
        if ($request->expectsJson()) {
            return response($products);
        }
        return view('admin.products', ['products' => $products, 'widgets' => $widgets]);
    }
    public function store(AuthorizedRequest $request)
    {
        $fields = $request->storeFiles(['featured_image' => ['path' => 'products', 'disk' => 'media', 'name' => 'featured']]);
        $product = Product::updateOrCreate(['id' => isset($fields['id']) ? $fields['id'] : 0], $fields);
        if ($request->expectsJson()) {
            return response($product);
        }
        return redirect()->back();
    }
    public function product(AuthorizedRequest $request, Product $product)
    {
        if ($request->expectsJson()) {
            return response($product);
        }
        return view('admin.products.product', ['product' => $product]);
    }
    public function delete(AuthorizedRequest $request, ?Product $product = null)
    {
        $product->delete();
        if ($request->expectsJson()) {
            return response('ok');
        }
        return redirect()->back();
    }
    public function restore(AuthorizedRequest $request, int $id)
    {
        $product = Product::where('id', $id)->first();
        if ($product) {
            $product->restore();
            if ($request->expectsJson()) {
                return response('ok');
            }
        }
        return redirect()->back();
    }
    public function erease(AuthorizedRequest $request, int $id)
    {
        $product = Product::where('id', $id)->first();
        if ($product) {
            $product->forceDelete();
            if ($request->expectsJson()) {
                return response('ok');
            }
        }
        return redirect()->back();
    }
}