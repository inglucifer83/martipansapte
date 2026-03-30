<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidatedRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\Tag;
class ProductsController extends Controller
{
    /**
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function index(ValidatedRequest $request)
    {
        // Paginate products for the listing page
        $products = Product::paginate(12);
        // Load categories for filters
        $categories = Category::all();
        // Load tags for facet filtering
        $tags = Tag::all();
        $data = ['products' => $products, 'categories' => $categories, 'tags' => $tags, 'request' => $request];
        if ($request->expectsJson()) {
            return response($data);
        } else {
            return view('products', $data);
        }
    }
    /**
     * @param Product $product
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function show(ValidatedRequest $request, Product $product)
    {
        // Load the product by id (route-bound model)
        $product = Product::where('id', $product->id)->first();
        // Fetch up to three reviews for the product
        $reviews = $product->reviews()->limit(3)->get();
        $data = ['product' => $product, 'reviews' => $reviews, 'request' => $request];
        if ($request->expectsJson()) {
            return response($data);
        } else {
            return view('product', $data);
        }
    }
    /**
     * @param string $query
     * @param Category $category
     * @param Tag $tag
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function search(ValidatedRequest $request, string $query, Category $category, Tag $tag)
    {
        // Search products by name
        $products = Product::where('name', 'like', '%' . $query . '%')->paginate(12);
        // Preserve optional category filter (model-bound)
        $category = $category;
        // Preserve optional tag filter (model-bound)
        $tag = $tag;
        $data = ['products' => $products, 'category' => $category, 'tag' => $tag, 'request' => $request];
        if ($request->expectsJson()) {
            return response($data);
        } else {
            return view('search', $data);
        }
    }
    /**
     * @param Product $product
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function storeReview(ValidatedRequest $request, Product $product)
    {
        // Retrieve all request fields
        $fields = $request->all();
        // Update or create an existing or a new Review instance
        $review = Review::updateOrCreate($fields);
        return redirect()->back();
    }
}