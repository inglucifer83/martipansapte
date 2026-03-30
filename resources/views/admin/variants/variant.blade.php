<x-admin>
    <x-slot:back>{{ route('admin.variants') }}</x-slot>
    <x-slot:title>Variant</x-slot>

    <div class="d-flex justify-content-start align-items-stretch" style="flex: 1;">
        <div class="d-flex flex-column justify-content-start align-items-start" style="flex: 1;"><input type="text"
                class="form-control detail-input" id="variant-id" name="id"
                value="{{ isset($variant) && $variant ? $variant->id : '' }}" readonly>
            <div class="input-group mb-3" style="width: initial">
                <span class="input-group-text">Product Id</span>
                <select class="form-select" name="product_id" aria-label="product_id">
                    @foreach (App\Models\Product::all() as $product)
                        <option value="{{ $product->id }}" @selected(isset($variant) && $variant->product_id == $product->id)>{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Sku</span>
                <input type="text" name="sku" placeholder="Sku" class="form-control detail-input"
                    id="variant-sku" placeholder="Sku" value="{{ isset($variant) && $variant ? $variant->sku : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Price</span>
                <input type="number" name="price" placeholder="Price" class="form-control detail-input"
                    id="variant-price" placeholder="Price"
                    value="{{ isset($variant) && $variant ? $variant->price : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Compare At Price</span>
                <input type="number" name="compare_at_price" placeholder="Compare At Price"
                    class="form-control detail-input" id="variant-compare_at_price" placeholder="Compare At Price"
                    value="{{ isset($variant) && $variant ? $variant->compare_at_price : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Inventory Quantity</span>
                <input type="number" name="inventory_quantity" placeholder="Inventory Quantity"
                    class="form-control detail-input" id="variant-inventory_quantity" placeholder="Inventory Quantity"
                    value="{{ isset($variant) && $variant ? $variant->inventory_quantity : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Attributes</span>
                <input type="text" name="attributes" placeholder="Attributes" class="form-control detail-input"
                    id="variant-attributes" placeholder="Attributes"
                    value="{{ isset($variant) && $variant ? $variant->attributes : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Weight</span>
                <input type="number" name="weight" placeholder="Weight" class="form-control detail-input"
                    id="variant-weight" placeholder="Weight"
                    value="{{ isset($variant) && $variant ? $variant->weight : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Created At</span>
                <input type="datetime-local" name="created_at" placeholder="Created At"
                    class="form-control detail-input" id="variant-created_at" placeholder="Created At"
                    value="{{ isset($variant) && $variant ? $variant->created_at : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Updated At</span>
                <input type="datetime-local" name="updated_at" placeholder="Updated At"
                    class="form-control detail-input" id="variant-updated_at" placeholder="Updated At"
                    value="{{ isset($variant) && $variant ? $variant->updated_at : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Deleted At</span>
                <input type="datetime-local" name="deleted_at" placeholder="Deleted At"
                    class="form-control detail-input" id="variant-deleted_at" placeholder="Deleted At"
                    value="{{ isset($variant) && $variant ? $variant->deleted_at : '' }}">
            </div>

        </div>
    </div>
</x-admin>
