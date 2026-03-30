<x-admin>
    <x-slot:back>{{ route('admin.orders') }}</x-slot>
    <x-slot:title>Order</x-slot>

    <div class="d-flex justify-content-start align-items-stretch" style="flex: 1;">
        <div class="d-flex flex-column justify-content-start align-items-start" style="flex: 1;"><input type="text"
                class="form-control detail-input" id="order-id" name="id"
                value="{{ isset($order) && $order ? $order->id : '' }}" readonly>
            <div class="input-group mb-3" style="width: initial">
                <span class="input-group-text">User Id</span>
                <select class="form-select" name="user_id" aria-label="user_id">
                    @foreach (App\Models\User::all() as $user)
                        <option value="{{ $user->id }}" @selected(isset($order) && $order->user_id == $user->id)>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Order Number</span>
                <input type="text" name="order_number" placeholder="Order Number" class="form-control detail-input"
                    id="order-order_number" placeholder="Order Number"
                    value="{{ isset($order) && $order ? $order->order_number : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial">
                <span class="input-group-text">Status</span>
                <select class="form-select" name="status" aria-label="Default select example">
                    <option value="pending" @selected($order && $order->status == 'pending')>pending</option>
                    <option value="processing" @selected($order && $order->status == 'processing')>processing</option>
                    <option value="completed" @selected($order && $order->status == 'completed')>completed</option>
                    <option value="cancelled" @selected($order && $order->status == 'cancelled')>cancelled</option>
                    <option value="failed" @selected($order && $order->status == 'failed')>failed</option>
                </select>
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Subtotal</span>
                <input type="number" name="subtotal" placeholder="Subtotal" class="form-control detail-input"
                    id="order-subtotal" placeholder="Subtotal"
                    value="{{ isset($order) && $order ? $order->subtotal : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Shipping Cost</span>
                <input type="number" name="shipping_cost" placeholder="Shipping Cost" class="form-control detail-input"
                    id="order-shipping_cost" placeholder="Shipping Cost"
                    value="{{ isset($order) && $order ? $order->shipping_cost : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Tax Total</span>
                <input type="number" name="tax_total" placeholder="Tax Total" class="form-control detail-input"
                    id="order-tax_total" placeholder="Tax Total"
                    value="{{ isset($order) && $order ? $order->tax_total : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Total</span>
                <input type="number" name="total" placeholder="Total" class="form-control detail-input"
                    id="order-total" placeholder="Total" value="{{ isset($order) && $order ? $order->total : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Currency</span>
                <input type="text" name="currency" placeholder="Currency" class="form-control detail-input"
                    id="order-currency" placeholder="Currency"
                    value="{{ isset($order) && $order ? $order->currency : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Placed At</span>
                <input type="datetime-local" name="placed_at" placeholder="Placed At" class="form-control detail-input"
                    id="order-placed_at" placeholder="Placed At"
                    value="{{ isset($order) && $order ? $order->placed_at : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Fulfilled At</span>
                <input type="datetime-local" name="fulfilled_at" placeholder="Fulfilled At"
                    class="form-control detail-input" id="order-fulfilled_at" placeholder="Fulfilled At"
                    value="{{ isset($order) && $order ? $order->fulfilled_at : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Tracking Number</span>
                <input type="text" name="tracking_number" placeholder="Tracking Number"
                    class="form-control detail-input" id="order-tracking_number" placeholder="Tracking Number"
                    value="{{ isset($order) && $order ? $order->tracking_number : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Created At</span>
                <input type="datetime-local" name="created_at" placeholder="Created At"
                    class="form-control detail-input" id="order-created_at" placeholder="Created At"
                    value="{{ isset($order) && $order ? $order->created_at : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Updated At</span>
                <input type="datetime-local" name="updated_at" placeholder="Updated At"
                    class="form-control detail-input" id="order-updated_at" placeholder="Updated At"
                    value="{{ isset($order) && $order ? $order->updated_at : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Deleted At</span>
                <input type="datetime-local" name="deleted_at" placeholder="Deleted At"
                    class="form-control detail-input" id="order-deleted_at" placeholder="Deleted At"
                    value="{{ isset($order) && $order ? $order->deleted_at : '' }}">
            </div>

        </div>
    </div>
</x-admin>
