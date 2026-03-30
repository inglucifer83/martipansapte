<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidatedRequest;
use App\Models\Address;
use App\Models\Order;
use App\Models\User;
class AccountController extends Controller
{
    /**
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function show(ValidatedRequest $request)
    {
        // User addresses for account dashboard
        $addresses = auth()->check() ? auth()->user()->addresses : collect();
        // Recent orders for quick access
        $orders = auth()->check() ? auth()->user()->orders : collect();
        $data = ['addresses' => $addresses];
        if ($request->expectsJson()) {
            return response($data);
        } else {
            return view('account', $data);
        }
    }
    /**
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function edit(ValidatedRequest $request)
    {
        // Addresses available for editing in account edit form
        $addresses = auth()->check() ? auth()->user()->addresses : collect();
        $data = ['addresses' => $addresses, 'request' => $request];
        if ($request->expectsJson()) {
            return response($data);
        } else {
            return view('account-edit', $data);
        }
    }
    /**
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function update(ValidatedRequest $request)
    {
        // Retrieve all request fields
        $fields = $request->all();
        // Check if the request has a file field named like the avatar model property
        if ($request->hasFile('avatar')) {
            // Update the avatar $fields attribute with the path of the stored file from the request
            $fields['avatar'] = $request->file()->store();
        }
        // Update or create an existing or a new User instance
        $user = User::updateOrCreate($fields);
        return redirect()->back();
    }
    /**
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function destroy(ValidatedRequest $request)
    {
        return redirect()->back();
    }
}
