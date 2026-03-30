<x-admin>
    <x-slot:back>{{ route('admin.tags') }}</x-slot>
    <x-slot:title>Tag</x-slot>

    <div class="d-flex justify-content-start align-items-stretch" style="flex: 1;">
        <div class="d-flex flex-column justify-content-start align-items-start" style="flex: 1;"><input type="text"
                class="form-control detail-input" id="tag-id" name="id"
                value="{{ isset($tag) && $tag ? $tag->id : '' }}" readonly>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Name</span>
                <input type="text" name="name" placeholder="Name" class="form-control detail-input" id="tag-name"
                    placeholder="Name" value="{{ isset($tag) && $tag ? $tag->name : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Slug</span>
                <input type="text" name="slug" placeholder="Slug" class="form-control detail-input" id="tag-slug"
                    placeholder="Slug" value="{{ isset($tag) && $tag ? $tag->slug : '' }}">
            </div>
            <div class="form-floating mb-3" style="align-self: stretch;">
                <textarea class="form-control detail-input" placeholder="Description" id="tag-description" name="description"
                    style="height: 100px;">{{ isset($tag) && $tag ? $tag->description : '' }}</textarea>
                <label for="tag-description">Description</label>
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Color</span>
                <input type="text" name="color" placeholder="Color" class="form-control detail-input"
                    id="tag-color" placeholder="Color" value="{{ isset($tag) && $tag ? $tag->color : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Priority</span>
                <input type="number" name="priority" placeholder="Priority" class="form-control detail-input"
                    id="tag-priority" placeholder="Priority" value="{{ isset($tag) && $tag ? $tag->priority : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Created At</span>
                <input type="datetime-local" name="created_at" placeholder="Created At"
                    class="form-control detail-input" id="tag-created_at" placeholder="Created At"
                    value="{{ isset($tag) && $tag ? $tag->created_at : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Updated At</span>
                <input type="datetime-local" name="updated_at" placeholder="Updated At"
                    class="form-control detail-input" id="tag-updated_at" placeholder="Updated At"
                    value="{{ isset($tag) && $tag ? $tag->updated_at : '' }}">
            </div>
            <div class="input-group mb-3" style="width: initial;">
                <span class="input-group-text">Deleted At</span>
                <input type="datetime-local" name="deleted_at" placeholder="Deleted At"
                    class="form-control detail-input" id="tag-deleted_at" placeholder="Deleted At"
                    value="{{ isset($tag) && $tag ? $tag->deleted_at : '' }}">
            </div>

        </div>
    </div>
</x-admin>
