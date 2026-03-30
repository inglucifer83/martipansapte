<x-admin>
    <x-slot:back>{{ route('admin.cart_items') }}</x-slot>
    <x-slot:title>CartItem</x-slot>

    <div class="d-flex justify-content-start align-items-stretch" style="flex: 1;">
        <div class="d-flex flex-column justify-content-start align-items-start" style="flex: 1;"><input type="text"
                class="form-control detail-input" id="cartitem-id" name="id"
                value="{{ isset($cartitem) && $cartitem ? $cartitem->id : '' }}" readonly>
            <div class="input-group mb-3" style="width: initial">
                <span class="input-group-text">Cart Id</span>
                <select class="form-select" name="cart_id" aria-label="cart_id">
                    @foreach (App\Models\Cart::all() as $cart)
                        <option value="{{ $cart->id }}" @selected(isset($cartitem) && $cartitem->cart_id == $cart->id)>{{ $cart->token }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Price At Time</span>
                <input type="number" name="price_at_time" placeholder="Price At Time" class="form-control detail-input"
                    id="cartitem-price_at_time" placeholder="Price At Time"
                    value="{{ isset($cartitem) && $cartitem ? $cartitem->price_at_time : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Quantity</span>
                <input type="number" name="quantity" placeholder="Quantity" class="form-control detail-input"
                    id="cartitem-quantity" placeholder="Quantity"
                    value="{{ isset($cartitem) && $cartitem ? $cartitem->quantity : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Metadata</span>
                <input type="text" name="metadata" placeholder="Metadata" class="form-control detail-input"
                    id="cartitem-metadata" placeholder="Metadata"
                    value="{{ isset($cartitem) && $cartitem ? $cartitem->metadata : '' }}">
            </div>
            <div class="form-check form-switch mb-3">
                <input class="form-check-input" name="saved_for_later" value="1" @checked(isset($cartitem) && $cartitem ? $cartitem->saved_for_later : false)
                    type="checkbox" role="switch" id="cartitem-saved_for_later">
                <label class="form-check-label" for="cartitem-saved_for_later">Saved For Later</label>
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Created At</span>
                <input type="datetime-local" name="created_at" placeholder="Created At"
                    class="form-control detail-input" id="cartitem-created_at" placeholder="Created At"
                    value="{{ isset($cartitem) && $cartitem ? $cartitem->created_at : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Updated At</span>
                <input type="datetime-local" name="updated_at" placeholder="Updated At"
                    class="form-control detail-input" id="cartitem-updated_at" placeholder="Updated At"
                    value="{{ isset($cartitem) && $cartitem ? $cartitem->updated_at : '' }}">
            </div>

        </div>
    </div>
</x-admin>
