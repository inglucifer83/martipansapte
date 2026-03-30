<x-admin>
    <x-slot:back>{{ route('admin.carts') }}</x-slot>
    <x-slot:title>Cart</x-slot>

    <div class="d-flex justify-content-start align-items-stretch" style="flex: 1;">
        <div class="d-flex flex-column justify-content-start align-items-start" style="flex: 1;"><input type="text"
                class="form-control detail-input" id="cart-id" name="id"
                value="{{ isset($cart) && $cart ? $cart->id : '' }}" readonly>
            <div class="input-group mb-3" style="width: initial">
                <span class="input-group-text">User Id</span>
                <select class="form-select" name="user_id" aria-label="user_id">
                    @foreach (App\Models\User::all() as $user)
                        <option value="{{ $user->id }}" @selected(isset($cart) && $cart->user_id == $user->id)>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Currency</span>
                <input type="text" name="currency" placeholder="Currency" class="form-control detail-input"
                    id="cart-currency" placeholder="Currency"
                    value="{{ isset($cart) && $cart ? $cart->currency : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Total Amount</span>
                <input type="number" name="total_amount" placeholder="Total Amount" class="form-control detail-input"
                    id="cart-total_amount" placeholder="Total Amount"
                    value="{{ isset($cart) && $cart ? $cart->total_amount : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Expires At</span>
                <input type="datetime-local" name="expires_at" placeholder="Expires At"
                    class="form-control detail-input" id="cart-expires_at" placeholder="Expires At"
                    value="{{ isset($cart) && $cart ? $cart->expires_at : '' }}">
            </div>
            <div class="form-check form-switch mb-3">
                <input class="form-check-input" name="is_active" value="1" @checked(isset($cart) && $cart ? $cart->is_active : false)
                    type="checkbox" role="switch" id="cart-is_active">
                <label class="form-check-label" for="cart-is_active">Is Active</label>
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Created At</span>
                <input type="datetime-local" name="created_at" placeholder="Created At"
                    class="form-control detail-input" id="cart-created_at" placeholder="Created At"
                    value="{{ isset($cart) && $cart ? $cart->created_at : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Updated At</span>
                <input type="datetime-local" name="updated_at" placeholder="Updated At"
                    class="form-control detail-input" id="cart-updated_at" placeholder="Updated At"
                    value="{{ isset($cart) && $cart ? $cart->updated_at : '' }}">
            </div>

        </div>
    </div>
</x-admin>
