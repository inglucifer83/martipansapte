<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthorizedRequest;
use App\Models\Variant;
class VariantsController extends Controller
{
    public function index(AuthorizedRequest $request)
    {
        $variants = Variant::all();
        $widgets = [];
        $widgets['Variants Count'] = Variant::count();
        if ($request->expectsJson()) {
            return response($variants);
        }
        return view('admin.variants', ['variants' => $variants, 'widgets' => $widgets]);
    }
    public function store(AuthorizedRequest $request)
    {
        $fields = $request->all();
        $variant = Variant::updateOrCreate(['id' => isset($fields['id']) ? $fields['id'] : 0], $fields);
        if ($request->expectsJson()) {
            return response($variant);
        }
        return redirect()->back();
    }
    public function variant(AuthorizedRequest $request, Variant $variant)
    {
        if ($request->expectsJson()) {
            return response($variant);
        }
        return view('admin.variants.variant', ['variant' => $variant]);
    }
    public function delete(AuthorizedRequest $request, ?Variant $variant = null)
    {
        $variant->delete();
        if ($request->expectsJson()) {
            return response('ok');
        }
        return redirect()->back();
    }
    public function restore(AuthorizedRequest $request, int $id)
    {
        $variant = Variant::where('id', $id)->first();
        if ($variant) {
            $variant->restore();
            if ($request->expectsJson()) {
                return response('ok');
            }
        }
        return redirect()->back();
    }
    public function erease(AuthorizedRequest $request, int $id)
    {
        $variant = Variant::where('id', $id)->first();
        if ($variant) {
            $variant->forceDelete();
            if ($request->expectsJson()) {
                return response('ok');
            }
        }
        return redirect()->back();
    }
}