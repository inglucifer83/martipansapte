<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthorizedRequest;
use App\Models\Tag;
class TagsController extends Controller
{
    public function index(AuthorizedRequest $request)
    {
        $tags = Tag::all();
        $widgets = [];
        $widgets['Tags Count'] = Tag::count();
        if ($request->expectsJson()) {
            return response($tags);
        }
        return view('admin.tags', ['tags' => $tags, 'widgets' => $widgets]);
    }
    public function store(AuthorizedRequest $request)
    {
        $fields = $request->all();
        $tag = Tag::updateOrCreate(['id' => isset($fields['id']) ? $fields['id'] : 0], $fields);
        if ($request->expectsJson()) {
            return response($tag);
        }
        return redirect()->back();
    }
    public function tag(AuthorizedRequest $request, Tag $tag)
    {
        if ($request->expectsJson()) {
            return response($tag);
        }
        return view('admin.tags.tag', ['tag' => $tag]);
    }
    public function delete(AuthorizedRequest $request, ?Tag $tag = null)
    {
        $tag->delete();
        if ($request->expectsJson()) {
            return response('ok');
        }
        return redirect()->back();
    }
    public function restore(AuthorizedRequest $request, int $id)
    {
        $tag = Tag::where('id', $id)->first();
        if ($tag) {
            $tag->restore();
            if ($request->expectsJson()) {
                return response('ok');
            }
        }
        return redirect()->back();
    }
    public function erease(AuthorizedRequest $request, int $id)
    {
        $tag = Tag::where('id', $id)->first();
        if ($tag) {
            $tag->forceDelete();
            if ($request->expectsJson()) {
                return response('ok');
            }
        }
        return redirect()->back();
    }
}