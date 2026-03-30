<div class="modal fade" id="cartitem-modal" tabindex="-1" aria-labelledby="cartitemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="cartitemModalLabel">CartItem</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.cart_items.store') }}" id="cartitem-form" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="modal-input" name="id" id="cartitem-id" />
                    <div class="d-flex justify-content-start align-items-stretch" style="flex: 1;">
                        <div class="d-flex flex-column justify-content-start align-items-start" style="flex: 1;"><input
                                type="text" class="form-control modal-input" id="cartitem-id" name="id"
                                value="{{ isset($cartitem) && $cartitem ? $cartitem->id : '' }}" readonly>
                            <div class="input-group mb-3" style="width: initial">
                                <span class="input-group-text">Cart Id</span>
                                <select class="form-select" name="cart_id" aria-label="cart_id">
                                    @foreach (App\Models\Cart::all() as $cart)
                                        <option value="{{ $cart->id }}" @selected(isset($cartitem) && $cartitem->cart_id == $cart->id)>
                                            {{ $cart->token }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Price At Time</span>
                                <input type="number" name="price_at_time" placeholder="Price At Time"
                                    class="form-control modal-input" id="cartitem-price_at_time"
                                    placeholder="Price At Time"
                                    value="{{ isset($cartitem) && $cartitem ? $cartitem->price_at_time : '' }}">
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Quantity</span>
                                <input type="number" name="quantity" placeholder="Quantity"
                                    class="form-control modal-input" id="cartitem-quantity" placeholder="Quantity"
                                    value="{{ isset($cartitem) && $cartitem ? $cartitem->quantity : '' }}">
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Metadata</span>
                                <input type="text" name="metadata" placeholder="Metadata"
                                    class="form-control modal-input" id="cartitem-metadata" placeholder="Metadata"
                                    value="{{ isset($cartitem) && $cartitem ? $cartitem->metadata : '' }}">
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" name="saved_for_later" value="1"
                                    @checked(isset($cartitem) && $cartitem ? $cartitem->saved_for_later : false) type="checkbox" role="switch"
                                    id="cartitem-saved_for_later">
                                <label class="form-check-label" for="cartitem-saved_for_later">Saved For Later</label>
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Created At</span>
                                <input type="datetime-local" name="created_at" placeholder="Created At"
                                    class="form-control modal-input" id="cartitem-created_at" placeholder="Created At"
                                    value="{{ isset($cartitem) && $cartitem ? $cartitem->created_at : '' }}">
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Updated At</span>
                                <input type="datetime-local" name="updated_at" placeholder="Updated At"
                                    class="form-control modal-input" id="cartitem-updated_at" placeholder="Updated At"
                                    value="{{ isset($cartitem) && $cartitem ? $cartitem->updated_at : '' }}">
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="cartitem-form" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script nonce="@nonce">
        let cart_items = null;

        fetch(location.href, {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        }).then(response => response.json().then(json => cart_items = json));

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

        const modalElement = document.getElementById('cartitem-modal');
        modalElement.addEventListener('show.bs.modal', function(e) {
            const button = e.relatedTarget;
            const cartitemId = button.dataset.id;

            const title = document.getElementById('cartitemModalLabel');
            title.innerHTML = "New CartItem";

            if (cartitemId) {
                title.innerHTML = "Edit CartItem";

                const cartitem = cart_items.find(cartitem => cartitem.id == cartitemId);

                if (cartitem) {
                    for (const field in cartitem) {
                        const element = document.getElementById(`cartitem-${field}`);
                        if (element) {
                            if (!element.matches('[type="file"]') && !element.matches('[type="checkbox"]') && !
                                element.matches('[type="radio"]')) {
                                element.value = cartitem[field];
                            } else if (element.matches('[type="checkbox"]')) {
                                element.checked = cartitem[field];
                            } else if (element.matches('[type="radio"]')) {
                                element.checked = cartitem[field] == element.value;
                            }

                            const preview = document.getElementById(`cartitem-${field}-preview`);
                            if (preview && preview.matches('img')) {
                                preview.src = cartitem[field].startsWith('http') ? cartitem[field] :
                                    `{{ asset('storage/') }}/${cartitem[field]}`;
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
