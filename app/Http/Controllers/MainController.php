<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidatedRequest;
use App\Models\Category;
use App\Models\Product;
class MainController extends Controller
{
    /**
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function lang(ValidatedRequest $request, string $lang)
    {
        if ($lang) {
            session(['locale' => $lang]);
        }
        return redirect()->back();
    }
    /**
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function home(ValidatedRequest $request)
    {
        // Fetch featured products for homepage carousel
        $featuredProducts = Product::where('featured_flag', 1)->limit(12)->get();
        // Load highlighted categories for quick navigation
        $categories = Category::limit(6)->get();
        $data = ['featuredProducts' => $featuredProducts, 'categories' => $categories, 'request' => $request];
        if ($request->expectsJson()) {
            return response($data);
        } else {
            return view('home', $data);
        }
    }
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function terms(ValidatedRequest $request)
    {
        return view('terms');
    }
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function privacy(ValidatedRequest $request)
    {
        return view('privacy');
    }
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function cookies(ValidatedRequest $request)
    {
        return view('cookies');
    }
    /**
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function about(ValidatedRequest $request)
    {
        $data = ['request' => $request];
        if ($request->expectsJson()) {
            return response($data);
        } else {
            return view('about', $data);
        }
    }
    /**
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function contactMe(ValidatedRequest $request)
    {
        $data = ['request' => $request];
        if ($request->expectsJson()) {
            return response($data);
        } else {
            return view('contact', $data);
        }
    }
}