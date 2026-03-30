<x-admin>
    <x-slot:back>{{ route('admin.payments') }}</x-slot>
    <x-slot:title>Payment</x-slot>

    <div class="d-flex justify-content-start align-items-stretch" style="flex: 1;">
        <div class="d-flex flex-column justify-content-start align-items-start" style="flex: 1;"><input type="text"
                class="form-control detail-input" id="payment-id" name="id"
                value="{{ isset($payment) && $payment ? $payment->id : '' }}" readonly>
            <div class="input-group mb-3" style="width: initial">
                <span class="input-group-text">Order Id</span>
                <select class="form-select" name="order_id" aria-label="order_id">
                    @foreach (App\Models\Order::all() as $order)
                        <option value="{{ $order->id }}" @selected(isset($payment) && $payment->order_id == $order->id)>{{ $order->order_number }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Amount</span>
                <input type="number" name="amount" placeholder="Amount" class="form-control detail-input"
                    id="payment-amount" placeholder="Amount"
                    value="{{ isset($payment) && $payment ? $payment->amount : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Currency</span>
                <input type="text" name="currency" placeholder="Currency" class="form-control detail-input"
                    id="payment-currency" placeholder="Currency"
                    value="{{ isset($payment) && $payment ? $payment->currency : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial">
                <span class="input-group-text">Method</span>
                <select class="form-select" name="method" aria-label="Default select example">
                    <option value="card" @selected($payment && $payment->method == 'card')>card</option>
                    <option value="paypal" @selected($payment && $payment->method == 'paypal')>paypal</option>
                    <option value="bank_transfer" @selected($payment && $payment->method == 'bank_transfer')>bank_transfer</option>
                    <option value="cod" @selected($payment && $payment->method == 'cod')>cod</option>
                </select>
            </div>
            <div class="input-group mb-3" style="width: initial">
                <span class="input-group-text">Status</span>
                <select class="form-select" name="status" aria-label="Default select example">
                    <option value="pending" @selected($payment && $payment->status == 'pending')>pending</option>
                    <option value="completed" @selected($payment && $payment->status == 'completed')>completed</option>
                    <option value="failed" @selected($payment && $payment->status == 'failed')>failed</option>
                    <option value="refunded" @selected($payment && $payment->status == 'refunded')>refunded</option>
                </select>
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Transaction Id</span>
                <input type="text" name="transaction_id" placeholder="Transaction Id"
                    class="form-control detail-input" id="payment-transaction_id" placeholder="Transaction Id"
                    value="{{ isset($payment) && $payment ? $payment->transaction_id : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Gateway Response</span>
                <input type="text" name="gateway_response" placeholder="Gateway Response"
                    class="form-control detail-input" id="payment-gateway_response" placeholder="Gateway Response"
                    value="{{ isset($payment) && $payment ? $payment->gateway_response : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Captured At</span>
                <input type="datetime-local" name="captured_at" placeholder="Captured At"
                    class="form-control detail-input" id="payment-captured_at" placeholder="Captured At"
                    value="{{ isset($payment) && $payment ? $payment->captured_at : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Refunded At</span>
                <input type="datetime-local" name="refunded_at" placeholder="Refunded At"
                    class="form-control detail-input" id="payment-refunded_at" placeholder="Refunded At"
                    value="{{ isset($payment) && $payment ? $payment->refunded_at : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Created At</span>
                <input type="datetime-local" name="created_at" placeholder="Created At"
                    class="form-control detail-input" id="payment-created_at" placeholder="Created At"
                    value="{{ isset($payment) && $payment ? $payment->created_at : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Updated At</span>
                <input type="datetime-local" name="updated_at" placeholder="Updated At"
                    class="form-control detail-input" id="payment-updated_at" placeholder="Updated At"
                    value="{{ isset($payment) && $payment ? $payment->updated_at : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Deleted At</span>
                <input type="datetime-local" name="deleted_at" placeholder="Deleted At"
                    class="form-control detail-input" id="payment-deleted_at" placeholder="Deleted At"
                    value="{{ isset($payment) && $payment ? $payment->deleted_at : '' }}">
            </div>

        </div>
    </div>
</x-admin>
