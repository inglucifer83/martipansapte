<x-admin>
    <x-slot:back>{{ route('admin.images') }}</x-slot>
    <x-slot:title>Image</x-slot>

    <div class="d-flex justify-content-start align-items-stretch" style="flex: 1;">
        <div class="d-flex flex-column justify-content-start align-items-start" style="flex: 1;"><input type="text"
                class="form-control detail-input" id="image-id" name="id"
                value="{{ isset($image) && $image ? $image->id : '' }}" readonly>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Url</span>
                <input type="text" name="url" placeholder="Url" class="form-control detail-input" id="image-url"
                    placeholder="Url" value="{{ isset($image) && $image ? $image->url : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Alt Text</span>
                <input type="text" name="alt_text" placeholder="Alt Text" class="form-control detail-input"
                    id="image-alt_text" placeholder="Alt Text"
                    value="{{ isset($image) && $image ? $image->alt_text : '' }}">
            </div>
            <div class="form-floating mb-3" style="align-self: stretch;">
                <textarea class="form-control detail-input" placeholder="Caption" id="image-caption" name="caption"
                    style="height: 100px;">{{ isset($image) && $image ? $image->caption : '' }}</textarea>
                <label for="image-caption">Caption</label>
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Position</span>
                <input type="number" name="position" placeholder="Position" class="form-control detail-input"
                    id="image-position" placeholder="Position"
                    value="{{ isset($image) && $image ? $image->position : '' }}">
            </div>
            <div class="form-check form-switch mb-3">
                <input class="form-check-input" name="is_primary" value="1" @checked(isset($image) && $image ? $image->is_primary : false)
                    type="checkbox" role="switch" id="image-is_primary">
                <label class="form-check-label" for="image-is_primary">Is Primary</label>
            </div>
            <div class="input-group mb-3" style="width: initial">
                <span class="input-group-text">Product Id</span>
                <select class="form-select" name="product_id" aria-label="product_id">
                    @foreach (App\Models\Product::all() as $product)
                        <option value="{{ $product->id }}" @selected(isset($image) && $image->product_id == $product->id)>{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Created At</span>
                <input type="datetime-local" name="created_at" placeholder="Created At"
                    class="form-control detail-input" id="image-created_at" placeholder="Created At"
                    value="{{ isset($image) && $image ? $image->created_at : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Updated At</span>
                <input type="datetime-local" name="updated_at" placeholder="Updated At"
                    class="form-control detail-input" id="image-updated_at" placeholder="Updated At"
                    value="{{ isset($image) && $image ? $image->updated_at : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Deleted At</span>
                <input type="datetime-local" name="deleted_at" placeholder="Deleted At"
                    class="form-control detail-input" id="image-deleted_at" placeholder="Deleted At"
                    value="{{ isset($image) && $image ? $image->deleted_at : '' }}">
            </div>

        </div>
    </div>
</x-admin>
