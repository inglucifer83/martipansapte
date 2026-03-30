<x-admin>
    <x-slot:back>{{ route('admin.categories') }}</x-slot>
    <x-slot:title>Category</x-slot>

    <div class="d-flex justify-content-start align-items-stretch" style="flex: 1;">
        <div class="d-flex flex-column justify-content-start align-items-start" style="flex: 1;"><input type="text"
                class="form-control detail-input" id="category-id" name="id"
                value="{{ isset($category) && $category ? $category->id : '' }}" readonly>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Name</span>
                <input type="text" name="name" placeholder="Name" class="form-control detail-input"
                    id="category-name" placeholder="Name"
                    value="{{ isset($category) && $category ? $category->name : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Slug</span>
                <input type="text" name="slug" placeholder="Slug" class="form-control detail-input"
                    id="category-slug" placeholder="Slug"
                    value="{{ isset($category) && $category ? $category->slug : '' }}">
            </div>
            <div class="form-floating mb-3" style="align-self: stretch;">
                <textarea class="form-control detail-input" placeholder="Description" id="category-description" name="description"
                    style="height: 100px;">{{ isset($category) && $category ? $category->description : '' }}</textarea>
                <label for="category-description">Description</label>
            </div>

            <div class="d-flex flex-column justify-content-start align-items-start">
                <img src="{{ Str::startsWith($category->image, 'http') ? $category->image : asset('storage/' . $category->image) }}"
                    width="60" height="60" id="category-image-preview" />

                <div class="input-group mb-3" style="margin-top: 0.5vw; width: initial;"><span
                        class="input-group-text">Image</span><input name="image" id="category-image" type="file"
                        class="form-control" accept=".png,.jpg,.gif,.jpeg,.webp" /></div>
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Sort Order</span>
                <input type="number" name="sort_order" placeholder="Sort Order" class="form-control detail-input"
                    id="category-sort_order" placeholder="Sort Order"
                    value="{{ isset($category) && $category ? $category->sort_order : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Seo Title</span>
                <input type="text" name="seo_title" placeholder="Seo Title" class="form-control detail-input"
                    id="category-seo_title" placeholder="Seo Title"
                    value="{{ isset($category) && $category ? $category->seo_title : '' }}">
            </div>
            <div class="form-floating mb-3" style="align-self: stretch;">
                <textarea class="form-control detail-input" placeholder="Seo Description" id="category-seo_description"
                    name="seo_description" style="height: 100px;">{{ isset($category) && $category ? $category->seo_description : '' }}</textarea>
                <label for="category-seo_description">Seo Description</label>
            </div>
            <div class="form-check form-switch mb-3">
                <input class="form-check-input" name="is_active" value="1" @checked(isset($category) && $category ? $category->is_active : false)
                    type="checkbox" role="switch" id="category-is_active">
                <label class="form-check-label" for="category-is_active">Is Active</label>
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Created At</span>
                <input type="datetime-local" name="created_at" placeholder="Created At"
                    class="form-control detail-input" id="category-created_at" placeholder="Created At"
                    value="{{ isset($category) && $category ? $category->created_at : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Updated At</span>
                <input type="datetime-local" name="updated_at" placeholder="Updated At"
                    class="form-control detail-input" id="category-updated_at" placeholder="Updated At"
                    value="{{ isset($category) && $category ? $category->updated_at : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Deleted At</span>
                <input type="datetime-local" name="deleted_at" placeholder="Deleted At"
                    class="form-control detail-input" id="category-deleted_at" placeholder="Deleted At"
                    value="{{ isset($category) && $category ? $category->deleted_at : '' }}">
            </div>

        </div>
    </div>
</x-admin>
