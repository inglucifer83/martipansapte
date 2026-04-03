<div class="modal fade" id="cart-modal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="cartModalLabel">Cart</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.carts.store') }}" id="cart-form" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="modal-input" name="id" id="cart-id" />
                    <div class="d-flex justify-content-start align-items-stretch" style="flex: 1;">
                        <div class="d-flex flex-column justify-content-start align-items-start" style="flex: 1;"><input
                                type="text" class="form-control modal-input" id="cart-id" name="id"
                                value="{{ isset($cart) && $cart ? $cart->id : '' }}" readonly>
                            <div class="input-group mb-3" style="width: initial">
                                <span class="input-group-text">User Id</span>
                                <select class="form-select" name="user_id" aria-label="user_id">
                                    @foreach (App\Models\User::all() as $user)
                                        <option value="{{ $user->id }}" @selected(isset($cart) && $cart->user_id == $user->id)>
                                            {{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Currency</span>
                                <input type="text" name="currency" placeholder="Currency"
                                    class="form-control modal-input" id="cart-currency" placeholder="Currency"
                                    value="{{ isset($cart) && $cart ? $cart->currency : '' }}">
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Total Amount</span>
                                <input type="number" name="total_amount" placeholder="Total Amount"
                                    class="form-control modal-input" id="cart-total_amount" placeholder="Total Amount"
                                    value="{{ isset($cart) && $cart ? $cart->total_amount : '' }}">
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Expires At</span>
                                <input type="datetime-local" name="expires_at" placeholder="Expires At"
                                    class="form-control modal-input" id="cart-expires_at" placeholder="Expires At"
                                    value="{{ isset($cart) && $cart ? $cart->expires_at : '' }}">
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" name="is_active" value="1"
                                    @checked(isset($cart) && $cart ? $cart->is_active : false) type="checkbox" role="switch" id="cart-is_active">
                                <label class="form-check-label" for="cart-is_active">Is Active</label>
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Created At</span>
                                <input type="datetime-local" name="created_at" placeholder="Created At"
                                    class="form-control modal-input" id="cart-created_at" placeholder="Created At"
                                    value="{{ isset($cart) && $cart ? $cart->created_at : '' }}">
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Updated At</span>
                                <input type="datetime-local" name="updated_at" placeholder="Updated At"
                                    class="form-control modal-input" id="cart-updated_at" placeholder="Updated At"
                                    value="{{ isset($cart) && $cart ? $cart->updated_at : '' }}">
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="cart-form" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script nonce="@nonce">
        let carts = null;

        fetch(location.href, {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        }).then(response => response.json().then(json => carts = json));

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

        const modalElement = document.getElementById('cart-modal');
        modalElement.addEventListener('show.bs.modal', function(e) {
            const button = e.relatedTarget;
            const cartId = button.dataset.id;

            const title = document.getElementById('cartModalLabel');
            title.innerHTML = "New Cart";

            if (cartId) {
                title.innerHTML = "Edit Cart";

                const cart = carts.find(cart => cart.id == cartId);

                if (cart) {
                    for (const field in cart) {
                        const element = document.getElementById(`cart-${field}`);
                        if (element) {
                            if (!element.matches('[type="file"]') && !element.matches('[type="checkbox"]') && !
                                element.matches('[type="radio"]')) {
                                element.value = cart[field];
                            } else if (element.matches('[type="checkbox"]')) {
                                element.checked = cart[field];
                            } else if (element.matches('[type="radio"]')) {
                                element.checked = cart[field] == element.value;
                            }

                            const preview = document.getElementById(`cart-${field}-preview`);
                            if (preview && preview.matches('img')) {
                                preview.src = cart[field].startsWith('http') ? cart[field] :
                                    `{{ asset('storage/') }}/${cart[field]}`;
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
