<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthorizedRequest;
use App\Models\Image;
class ImagesController extends Controller
{
    public function index(AuthorizedRequest $request)
    {
        $images = Image::all();
        $widgets = [];
        $widgets['Images Count'] = Image::count();
        if ($request->expectsJson()) {
            return response($images);
        }
        return view('admin.images', ['images' => $images, 'widgets' => $widgets]);
    }
    public function store(AuthorizedRequest $request)
    {
        $fields = $request->all();
        $image = Image::updateOrCreate(['id' => isset($fields['id']) ? $fields['id'] : 0], $fields);
        if ($request->expectsJson()) {
            return response($image);
        }
        return redirect()->back();
    }
    public function image(AuthorizedRequest $request, Image $image)
    {
        if ($request->expectsJson()) {
            return response($image);
        }
        return view('admin.images.image', ['image' => $image]);
    }
    public function delete(AuthorizedRequest $request, ?Image $image = null)
    {
        $image->delete();
        if ($request->expectsJson()) {
            return response('ok');
        }
        return redirect()->back();
    }
    public function restore(AuthorizedRequest $request, int $id)
    {
        $image = Image::where('id', $id)->first();
        if ($image) {
            $image->restore();
            if ($request->expectsJson()) {
                return response('ok');
            }
        }
        return redirect()->back();
    }
    public function erease(AuthorizedRequest $request, int $id)
    {
        $image = Image::where('id', $id)->first();
        if ($image) {
            $image->forceDelete();
            if ($request->expectsJson()) {
                return response('ok');
            }
        }
        return redirect()->back();
    }
}