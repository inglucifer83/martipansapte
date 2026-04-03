<div class="modal fade" id="image-modal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="imageModalLabel">Image</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.images.store') }}" id="image-form" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="modal-input" name="id" id="image-id" />
                    <div class="d-flex justify-content-start align-items-stretch" style="flex: 1;">
                        <div class="d-flex flex-column justify-content-start align-items-start" style="flex: 1;"><input
                                type="text" class="form-control modal-input" id="image-id" name="id"
                                value="{{ isset($image) && $image ? $image->id : '' }}" readonly>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Url</span>
                                <input type="text" name="url" placeholder="Url" class="form-control modal-input"
                                    id="image-url" placeholder="Url"
                                    value="{{ isset($image) && $image ? $image->url : '' }}">
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Alt Text</span>
                                <input type="text" name="alt_text" placeholder="Alt Text"
                                    class="form-control modal-input" id="image-alt_text" placeholder="Alt Text"
                                    value="{{ isset($image) && $image ? $image->alt_text : '' }}">
                            </div>
                            <div class="form-floating mb-3" style="align-self: stretch;">
                                <textarea class="form-control modal-input" placeholder="Caption" id="image-caption" name="caption"
                                    style="height: 100px;">{{ isset($image) && $image ? $image->caption : '' }}</textarea>
                                <label for="image-caption">Caption</label>
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Position</span>
                                <input type="number" name="position" placeholder="Position"
                                    class="form-control modal-input" id="image-position" placeholder="Position"
                                    value="{{ isset($image) && $image ? $image->position : '' }}">
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" name="is_primary" value="1"
                                    @checked(isset($image) && $image ? $image->is_primary : false) type="checkbox" role="switch" id="image-is_primary">
                                <label class="form-check-label" for="image-is_primary">Is Primary</label>
                            </div>
                            <div class="input-group mb-3" style="width: initial">
                                <span class="input-group-text">Product Id</span>
                                <select class="form-select" name="product_id" aria-label="product_id">
                                    @foreach (App\Models\Product::all() as $product)
                                        <option value="{{ $product->id }}" @selected(isset($image) && $image->product_id == $product->id)>
                                            {{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Created At</span>
                                <input type="datetime-local" name="created_at" placeholder="Created At"
                                    class="form-control modal-input" id="image-created_at" placeholder="Created At"
                                    value="{{ isset($image) && $image ? $image->created_at : '' }}">
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Updated At</span>
                                <input type="datetime-local" name="updated_at" placeholder="Updated At"
                                    class="form-control modal-input" id="image-updated_at" placeholder="Updated At"
                                    value="{{ isset($image) && $image ? $image->updated_at : '' }}">
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Deleted At</span>
                                <input type="datetime-local" name="deleted_at" placeholder="Deleted At"
                                    class="form-control modal-input" id="image-deleted_at" placeholder="Deleted At"
                                    value="{{ isset($image) && $image ? $image->deleted_at : '' }}">
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="image-form" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script nonce="@nonce">
        let images = null;

        fetch(location.href, {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        }).then(response => response.json().then(json => images = json));

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

        const modalElement = document.getElementById('image-modal');
        modalElement.addEventListener('show.bs.modal', function(e) {
            const button = e.relatedTarget;
            const imageId = button.dataset.id;

            const title = document.getElementById('imageModalLabel');
            title.innerHTML = "New Image";

            if (imageId) {
                title.innerHTML = "Edit Image";

                const image = images.find(image => image.id == imageId);

                if (image) {
                    for (const field in image) {
                        const element = document.getElementById(`image-${field}`);
                        if (element) {
                            if (!element.matches('[type="file"]') && !element.matches('[type="checkbox"]') && !
                                element.matches('[type="radio"]')) {
                                element.value = image[field];
                            } else if (element.matches('[type="checkbox"]')) {
                                element.checked = image[field];
                            } else if (element.matches('[type="radio"]')) {
                                element.checked = image[field] == element.value;
                            }

                            const preview = document.getElementById(`image-${field}-preview`);
                            if (preview && preview.matches('img')) {
                                preview.src = image[field].startsWith('http') ? image[field] :
                                    `{{ asset('storage/') }}/${image[field]}`;
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
