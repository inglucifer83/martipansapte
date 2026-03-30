<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthorizedRequest;
use App\Models\Category;
class CategoriesController extends Controller
{
    public function index(AuthorizedRequest $request)
    {
        $categories = Category::all();
        $widgets = [];
        $widgets['Categories Count'] = Category::count();
        if ($request->expectsJson()) {
            return response($categories);
        }
        return view('admin.categories', ['categories' => $categories, 'widgets' => $widgets]);
    }
    public function store(AuthorizedRequest $request)
    {
        $fields = $request->all();
        $category = Category::updateOrCreate(['id' => isset($fields['id']) ? $fields['id'] : 0], $fields);
        if ($request->expectsJson()) {
            return response($category);
        }
        return redirect()->back();
    }
    public function category(AuthorizedRequest $request, Category $category)
    {
        if ($request->expectsJson()) {
            return response($category);
        }
        return view('admin.categories.category', ['category' => $category]);
    }
    public function delete(AuthorizedRequest $request, ?Category $category = null)
    {
        $category->delete();
        if ($request->expectsJson()) {
            return response('ok');
        }
        return redirect()->back();
    }
    public function restore(AuthorizedRequest $request, int $id)
    {
        $category = Category::where('id', $id)->first();
        if ($category) {
            $category->restore();
            if ($request->expectsJson()) {
                return response('ok');
            }
        }
        return redirect()->back();
    }
    public function erease(AuthorizedRequest $request, int $id)
    {
        $category = Category::where('id', $id)->first();
        if ($category) {
            $category->forceDelete();
            if ($request->expectsJson()) {
                return response('ok');
            }
        }
        return redirect()->back();
    }
}