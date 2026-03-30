<div class="modal fade" id="category-modal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="categoryModalLabel">Category</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.categories.store') }}" id="category-form" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="modal-input" name="id" id="category-id" />
                    <div class="d-flex justify-content-start align-items-stretch" style="flex: 1;">
                        <div class="d-flex flex-column justify-content-start align-items-start" style="flex: 1;"><input
                                type="text" class="form-control modal-input" id="category-id" name="id"
                                value="{{ isset($category) && $category ? $category->id : '' }}" readonly>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Name</span>
                                <input type="text" name="name" placeholder="Name" class="form-control modal-input"
                                    id="category-name" placeholder="Name"
                                    value="{{ isset($category) && $category ? $category->name : '' }}">
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Slug</span>
                                <input type="text" name="slug" placeholder="Slug" class="form-control modal-input"
                                    id="category-slug" placeholder="Slug"
                                    value="{{ isset($category) && $category ? $category->slug : '' }}">
                            </div>
                            <div class="form-floating mb-3" style="align-self: stretch;">
                                <textarea class="form-control modal-input" placeholder="Description" id="category-description" name="description"
                                    style="height: 100px;">{{ isset($category) && $category ? $category->description : '' }}</textarea>
                                <label for="category-description">Description</label>
                            </div>

                            <div class="d-flex flex-column justify-content-start align-items-start">
                                <img src="" width="60" height="60" id="category-image-preview" />

                                <div class="input-group mb-3" style="margin-top: 0.5vw; width: initial;"><span
                                        class="input-group-text">Image</span><input name="image" id="category-image"
                                        type="file" class="form-control" accept=".png,.jpg,.gif,.jpeg,.webp" /></div>
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Sort Order</span>
                                <input type="number" name="sort_order" placeholder="Sort Order"
                                    class="form-control modal-input" id="category-sort_order" placeholder="Sort Order"
                                    value="{{ isset($category) && $category ? $category->sort_order : '' }}">
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Seo Title</span>
                                <input type="text" name="seo_title" placeholder="Seo Title"
                                    class="form-control modal-input" id="category-seo_title" placeholder="Seo Title"
                                    value="{{ isset($category) && $category ? $category->seo_title : '' }}">
                            </div>
                            <div class="form-floating mb-3" style="align-self: stretch;">
                                <textarea class="form-control modal-input" placeholder="Seo Description" id="category-seo_description"
                                    name="seo_description" style="height: 100px;">{{ isset($category) && $category ? $category->seo_description : '' }}</textarea>
                                <label for="category-seo_description">Seo Description</label>
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" name="is_active" value="1"
                                    @checked(isset($category) && $category ? $category->is_active : false) type="checkbox" role="switch"
                                    id="category-is_active">
                                <label class="form-check-label" for="category-is_active">Is Active</label>
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Created At</span>
                                <input type="datetime-local" name="created_at" placeholder="Created At"
                                    class="form-control modal-input" id="category-created_at"
                                    placeholder="Created At"
                                    value="{{ isset($category) && $category ? $category->created_at : '' }}">
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Updated At</span>
                                <input type="datetime-local" name="updated_at" placeholder="Updated At"
                                    class="form-control modal-input" id="category-updated_at"
                                    placeholder="Updated At"
                                    value="{{ isset($category) && $category ? $category->updated_at : '' }}">
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Deleted At</span>
                                <input type="datetime-local" name="deleted_at" placeholder="Deleted At"
                                    class="form-control modal-input" id="category-deleted_at"
                                    placeholder="Deleted At"
                                    value="{{ isset($category) && $category ? $category->deleted_at : '' }}">
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="category-form" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        let categories = null;

        fetch(location.href, {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        }).then(response => response.json().then(json => categories = json));

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

        const modalElement = document.getElementById('category-modal');
        modalElement.addEventListener('show.bs.modal', function(e) {
            const button = e.relatedTarget;
            const categoryId = button.dataset.id;

            const title = document.getElementById('categoryModalLabel');
            title.innerHTML = "New Category";

            if (categoryId) {
                title.innerHTML = "Edit Category";

                const category = categories.find(category => category.id == categoryId);

                if (category) {
                    for (const field in category) {
                        const element = document.getElementById(`category-${field}`);
                        if (element) {
                            if (!element.matches('[type="file"]') && !element.matches('[type="checkbox"]') && !
                                element.matches('[type="radio"]')) {
                                element.value = category[field];
                            } else if (element.matches('[type="checkbox"]')) {
                                element.checked = category[field];
                            } else if (element.matches('[type="radio"]')) {
                                element.checked = category[field] == element.value;
                            }

                            const preview = document.getElementById(`category-${field}-preview`);
                            if (preview && preview.matches('img')) {
                                preview.src = category[field].startsWith('http') ? category[field] :
                                    `{{ asset('storage/') }}/${category[field]}`;
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
