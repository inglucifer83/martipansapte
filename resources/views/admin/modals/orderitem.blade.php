<div class="modal fade" id="orderitem-modal" tabindex="-1" aria-labelledby="orderitemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="orderitemModalLabel">OrderItem</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.order_items.store') }}" id="orderitem-form" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="modal-input" name="id" id="orderitem-id" />
                    <div class="d-flex justify-content-start align-items-stretch" style="flex: 1;">
                        <div class="d-flex flex-column justify-content-start align-items-start" style="flex: 1;"><input
                                type="text" class="form-control modal-input" id="orderitem-id" name="id"
                                value="{{ isset($orderitem) && $orderitem ? $orderitem->id : '' }}" readonly>
                            <div class="input-group mb-3" style="width: initial">
                                <span class="input-group-text">Order Id</span>
                                <select class="form-select" name="order_id" aria-label="order_id">
                                    @foreach (App\Models\Order::all() as $order)
                                        <option value="{{ $order->id }}" @selected(isset($orderitem) && $orderitem->order_id == $order->id)>
                                            {{ $order->order_number }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Name Snapshot</span>
                                <input type="text" name="name_snapshot" placeholder="Name Snapshot"
                                    class="form-control modal-input" id="orderitem-name_snapshot"
                                    placeholder="Name Snapshot"
                                    value="{{ isset($orderitem) && $orderitem ? $orderitem->name_snapshot : '' }}">
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Sku Snapshot</span>
                                <input type="text" name="sku_snapshot" placeholder="Sku Snapshot"
                                    class="form-control modal-input" id="orderitem-sku_snapshot"
                                    placeholder="Sku Snapshot"
                                    value="{{ isset($orderitem) && $orderitem ? $orderitem->sku_snapshot : '' }}">
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Unit Price</span>
                                <input type="number" name="unit_price" placeholder="Unit Price"
                                    class="form-control modal-input" id="orderitem-unit_price" placeholder="Unit Price"
                                    value="{{ isset($orderitem) && $orderitem ? $orderitem->unit_price : '' }}">
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Quantity</span>
                                <input type="number" name="quantity" placeholder="Quantity"
                                    class="form-control modal-input" id="orderitem-quantity" placeholder="Quantity"
                                    value="{{ isset($orderitem) && $orderitem ? $orderitem->quantity : '' }}">
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Total Price</span>
                                <input type="number" name="total_price" placeholder="Total Price"
                                    class="form-control modal-input" id="orderitem-total_price"
                                    placeholder="Total Price"
                                    value="{{ isset($orderitem) && $orderitem ? $orderitem->total_price : '' }}">
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Tax Amount</span>
                                <input type="number" name="tax_amount" placeholder="Tax Amount"
                                    class="form-control modal-input" id="orderitem-tax_amount" placeholder="Tax Amount"
                                    value="{{ isset($orderitem) && $orderitem ? $orderitem->tax_amount : '' }}">
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Created At</span>
                                <input type="datetime-local" name="created_at" placeholder="Created At"
                                    class="form-control modal-input" id="orderitem-created_at"
                                    placeholder="Created At"
                                    value="{{ isset($orderitem) && $orderitem ? $orderitem->created_at : '' }}">
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Updated At</span>
                                <input type="datetime-local" name="updated_at" placeholder="Updated At"
                                    class="form-control modal-input" id="orderitem-updated_at"
                                    placeholder="Updated At"
                                    value="{{ isset($orderitem) && $orderitem ? $orderitem->updated_at : '' }}">
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="orderitem-form" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script nonce="@nonce">
        let order_items = null;

        fetch(location.href, {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        }).then(response => response.json().then(json => order_items = json));

        const clearInputs = () => {
            const elements = document.querySelectorAll('.modal-input');
            for (let i = 0; i < elements.length; i += 1) {
                const input = elements[i];
                input.value = '';
            }
            const previews = document.querySelectorAll('[id$="-preview"]');
            for (let i = 0; i < previews.length; i += 1) {
                const preview = previews[i];
                preview.src = '';
            }
        }

        const modalElement = document.getElementById('orderitem-modal');
        modalElement.addEventListener('show.bs.modal', function(e) {
            const button = e.relatedTarget;
            const orderitemId = button.dataset.id;

            const title = document.getElementById('orderitemModalLabel');
            title.innerHTML = "New OrderItem";

            if (orderitemId) {
                title.innerHTML = "Edit OrderItem";

                const orderitem = order_items.find(orderitem => orderitem.id == orderitemId);

                if (orderitem) {
                    for (const field in orderitem) {
                        const element = document.getElementById(`orderitem-${field}`);
                        if (element) {
                            if (!element.matches('[type="file"]') && !element.matches('[type="checkbox"]') && !
                                element.matches('[type="radio"]')) {
                                element.value = orderitem[field];
                            } else if (element.matches('[type="checkbox"]')) {
                                element.checked = orderitem[field];
                            } else if (element.matches('[type="radio"]')) {
                                element.checked = orderitem[field] == element.value;
                            }

                            const preview = document.getElementById(`orderitem-${field}-preview`);
                            if (preview && preview.matches('img')) {
                                preview.src = orderitem[field].startsWith('http') ? orderitem[field] :
                                    `{{ asset('storage/') }}/${orderitem[field]}`;
                            }
                        }
                    }
                } else {
                    clearInputs();
                }
            } else {
                clearInputs();
            }
        });
    </script>
@endpush
