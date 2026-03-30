<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthorizedRequest;
use App\Models\Payment;
class PaymentsController extends Controller
{
    public function index(AuthorizedRequest $request)
    {
        $payments = Payment::all();
        $widgets = [];
        $widgets['Payments Count'] = Payment::count();
        if ($request->expectsJson()) {
            return response($payments);
        }
        return view('admin.payments', ['payments' => $payments, 'widgets' => $widgets]);
    }
    public function store(AuthorizedRequest $request)
    {
        $fields = $request->all();
        $payment = Payment::updateOrCreate(['id' => isset($fields['id']) ? $fields['id'] : 0], $fields);
        if ($request->expectsJson()) {
            return response($payment);
        }
        return redirect()->back();
    }
    public function payment(AuthorizedRequest $request, Payment $payment)
    {
        if ($request->expectsJson()) {
            return response($payment);
        }
        return view('admin.payments.payment', ['payment' => $payment]);
    }
    public function delete(AuthorizedRequest $request, ?Payment $payment = null)
    {
        $payment->delete();
        if ($request->expectsJson()) {
            return response('ok');
        }
        return redirect()->back();
    }
    public function restore(AuthorizedRequest $request, int $id)
    {
        $payment = Payment::where('id', $id)->first();
        if ($payment) {
            $payment->restore();
            if ($request->expectsJson()) {
                return response('ok');
            }
        }
        return redirect()->back();
    }
    public function erease(AuthorizedRequest $request, int $id)
    {
        $payment = Payment::where('id', $id)->first();
        if ($payment) {
            $payment->forceDelete();
            if ($request->expectsJson()) {
                return response('ok');
            }
        }
        return redirect()->back();
    }
}