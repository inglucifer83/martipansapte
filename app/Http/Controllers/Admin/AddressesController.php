<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthorizedRequest;
use App\Models\Address;
class AddressesController extends Controller
{
    public function index(AuthorizedRequest $request)
    {
        $addresses = Address::all();
        $widgets = [];
        $widgets['Addresses Count'] = Address::count();
        if ($request->expectsJson()) {
            return response($addresses);
        }
        return view('admin.addresses', ['addresses' => $addresses, 'widgets' => $widgets]);
    }
    public function store(AuthorizedRequest $request)
    {
        $fields = $request->all();
        $address = Address::updateOrCreate(['id' => isset($fields['id']) ? $fields['id'] : 0], $fields);
        if ($request->expectsJson()) {
            return response($address);
        }
        return redirect()->back();
    }
    public function address(AuthorizedRequest $request, Address $address)
    {
        if ($request->expectsJson()) {
            return response($address);
        }
        return view('admin.addresses.address', ['address' => $address]);
    }
    public function delete(AuthorizedRequest $request, ?Address $address = null)
    {
        $address->delete();
        if ($request->expectsJson()) {
            return response('ok');
        }
        return redirect()->back();
    }
    public function restore(AuthorizedRequest $request, int $id)
    {
        $address = Address::where('id', $id)->first();
        if ($address) {
            $address->restore();
            if ($request->expectsJson()) {
                return response('ok');
            }
        }
        return redirect()->back();
    }
    public function erease(AuthorizedRequest $request, int $id)
    {
        $address = Address::where('id', $id)->first();
        if ($address) {
            $address->forceDelete();
            if ($request->expectsJson()) {
                return response('ok');
            }
        }
        return redirect()->back();
    }
}