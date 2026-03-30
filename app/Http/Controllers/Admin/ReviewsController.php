<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthorizedRequest;
use App\Models\Review;
class ReviewsController extends Controller
{
    public function index(AuthorizedRequest $request)
    {
        $reviews = Review::all();
        $widgets = [];
        $widgets['Reviews Count'] = Review::count();
        if ($request->expectsJson()) {
            return response($reviews);
        }
        return view('admin.reviews', ['reviews' => $reviews, 'widgets' => $widgets]);
    }
    public function store(AuthorizedRequest $request)
    {
        $fields = $request->all();
        $review = Review::updateOrCreate(['id' => isset($fields['id']) ? $fields['id'] : 0], $fields);
        if ($request->expectsJson()) {
            return response($review);
        }
        return redirect()->back();
    }
    public function review(AuthorizedRequest $request, Review $review)
    {
        if ($request->expectsJson()) {
            return response($review);
        }
        return view('admin.reviews.review', ['review' => $review]);
    }
    public function delete(AuthorizedRequest $request, ?Review $review = null)
    {
        $review->delete();
        if ($request->expectsJson()) {
            return response('ok');
        }
        return redirect()->back();
    }
    public function restore(AuthorizedRequest $request, int $id)
    {
        $review = Review::where('id', $id)->first();
        if ($review) {
            $review->restore();
            if ($request->expectsJson()) {
                return response('ok');
            }
        }
        return redirect()->back();
    }
    public function erease(AuthorizedRequest $request, int $id)
    {
        $review = Review::where('id', $id)->first();
        if ($review) {
            $review->forceDelete();
            if ($request->expectsJson()) {
                return response('ok');
            }
        }
        return redirect()->back();
    }
}