<x-admin>
    <x-slot:back>{{ route('admin.order_items') }}</x-slot>
    <x-slot:title>OrderItem</x-slot>

    <div class="d-flex justify-content-start align-items-stretch" style="flex: 1;">
        <div class="d-flex flex-column justify-content-start align-items-start" style="flex: 1;"><input type="text"
                class="form-control detail-input" id="orderitem-id" name="id"
                value="{{ isset($orderitem) && $orderitem ? $orderitem->id : '' }}" readonly>
            <div class="input-group mb-3" style="width: initial">
                <span class="input-group-text">Order Id</span>
                <select class="form-select" name="order_id" aria-label="order_id">
                    @foreach (App\Models\Order::all() as $order)
                        <option value="{{ $order->id }}" @selected(isset($orderitem) && $orderitem->order_id == $order->id)>{{ $order->order_number }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Name Snapshot</span>
                <input type="text" name="name_snapshot" placeholder="Name Snapshot" class="form-control detail-input"
                    id="orderitem-name_snapshot" placeholder="Name Snapshot"
                    value="{{ isset($orderitem) && $orderitem ? $orderitem->name_snapshot : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Sku Snapshot</span>
                <input type="text" name="sku_snapshot" placeholder="Sku Snapshot" class="form-control detail-input"
                    id="orderitem-sku_snapshot" placeholder="Sku Snapshot"
                    value="{{ isset($orderitem) && $orderitem ? $orderitem->sku_snapshot : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Unit Price</span>
                <input type="number" name="unit_price" placeholder="Unit Price" class="form-control detail-input"
                    id="orderitem-unit_price" placeholder="Unit Price"
                    value="{{ isset($orderitem) && $orderitem ? $orderitem->unit_price : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Quantity</span>
                <input type="number" name="quantity" placeholder="Quantity" class="form-control detail-input"
                    id="orderitem-quantity" placeholder="Quantity"
                    value="{{ isset($orderitem) && $orderitem ? $orderitem->quantity : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Total Price</span>
                <input type="number" name="total_price" placeholder="Total Price" class="form-control detail-input"
                    id="orderitem-total_price" placeholder="Total Price"
                    value="{{ isset($orderitem) && $orderitem ? $orderitem->total_price : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Tax Amount</span>
                <input type="number" name="tax_amount" placeholder="Tax Amount" class="form-control detail-input"
                    id="orderitem-tax_amount" placeholder="Tax Amount"
                    value="{{ isset($orderitem) && $orderitem ? $orderitem->tax_amount : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Created At</span>
                <input type="datetime-local" name="created_at" placeholder="Created At"
                    class="form-control detail-input" id="orderitem-created_at" placeholder="Created At"
                    value="{{ isset($orderitem) && $orderitem ? $orderitem->created_at : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Updated At</span>
                <input type="datetime-local" name="updated_at" placeholder="Updated At"
                    class="form-control detail-input" id="orderitem-updated_at" placeholder="Updated At"
                    value="{{ isset($orderitem) && $orderitem ? $orderitem->updated_at : '' }}">
            </div>

        </div>
    </div>
</x-admin>
