<x-admin>
    <x-slot:back>{{ route('admin.addresses') }}</x-slot>
    <x-slot:title>Address</x-slot>

    <div class="d-flex justify-content-start align-items-stretch" style="flex: 1;">
        <div class="d-flex flex-column justify-content-start align-items-start" style="flex: 1;"><input type="text"
                class="form-control detail-input" id="address-id" name="id"
                value="{{ isset($address) && $address ? $address->id : '' }}" readonly>
            <div class="input-group mb-3" style="width: initial">
                <span class="input-group-text">User Id</span>
                <select class="form-select" name="user_id" aria-label="user_id">
                    @foreach (App\Models\User::all() as $user)
                        <option value="{{ $user->id }}" @selected(isset($address) && $address->user_id == $user->id)>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Label</span>
                <input type="text" name="label" placeholder="Label" class="form-control detail-input"
                    id="address-label" placeholder="Label"
                    value="{{ isset($address) && $address ? $address->label : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Full Name</span>
                <input type="text" name="full_name" placeholder="Full Name" class="form-control detail-input"
                    id="address-full_name" placeholder="Full Name"
                    value="{{ isset($address) && $address ? $address->full_name : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Company</span>
                <input type="text" name="company" placeholder="Company" class="form-control detail-input"
                    id="address-company" placeholder="Company"
                    value="{{ isset($address) && $address ? $address->company : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Street</span>
                <input type="text" name="street" placeholder="Street" class="form-control detail-input"
                    id="address-street" placeholder="Street"
                    value="{{ isset($address) && $address ? $address->street : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">City</span>
                <input type="text" name="city" placeholder="City" class="form-control detail-input"
                    id="address-city" placeholder="City"
                    value="{{ isset($address) && $address ? $address->city : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Region</span>
                <input type="text" name="region" placeholder="Region" class="form-control detail-input"
                    id="address-region" placeholder="Region"
                    value="{{ isset($address) && $address ? $address->region : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Postal Code</span>
                <input type="text" name="postal_code" placeholder="Postal Code" class="form-control detail-input"
                    id="address-postal_code" placeholder="Postal Code"
                    value="{{ isset($address) && $address ? $address->postal_code : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Country</span>
                <input type="text" name="country" placeholder="Country" class="form-control detail-input"
                    id="address-country" placeholder="Country"
                    value="{{ isset($address) && $address ? $address->country : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Phone</span>
                <input type="tel" name="phone" placeholder="Phone" class="form-control detail-input"
                    id="address-phone" placeholder="Phone"
                    value="{{ isset($address) && $address ? $address->phone : '' }}">
            </div>
            <div class="form-check form-switch mb-3">
                <input class="form-check-input" name="is_default_shipping" value="1"
                    @checked(isset($address) && $address ? $address->is_default_shipping : false) type="checkbox" role="switch" id="address-is_default_shipping">
                <label class="form-check-label" for="address-is_default_shipping">Is Default Shipping</label>
            </div>
            <div class="form-check form-switch mb-3">
                <input class="form-check-input" name="is_default_billing" value="1" @checked(isset($address) && $address ? $address->is_default_billing : false)
                    type="checkbox" role="switch" id="address-is_default_billing">
                <label class="form-check-label" for="address-is_default_billing">Is Default Billing</label>
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Created At</span>
                <input type="datetime-local" name="created_at" placeholder="Created At"
                    class="form-control detail-input" id="address-created_at" placeholder="Created At"
                    value="{{ isset($address) && $address ? $address->created_at : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Updated At</span>
                <input type="datetime-local" name="updated_at" placeholder="Updated At"
                    class="form-control detail-input" id="address-updated_at" placeholder="Updated At"
                    value="{{ isset($address) && $address ? $address->updated_at : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Deleted At</span>
                <input type="datetime-local" name="deleted_at" placeholder="Deleted At"
                    class="form-control detail-input" id="address-deleted_at" placeholder="Deleted At"
                    value="{{ isset($address) && $address ? $address->deleted_at : '' }}">
            </div>

        </div>
    </div>
</x-admin>
