<div class="modal fade" id="tag-modal" tabindex="-1" aria-labelledby="tagModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tagModalLabel">Tag</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.tags.store') }}" id="tag-form" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="modal-input" name="id" id="tag-id" />
                    <div class="d-flex justify-content-start align-items-stretch" style="flex: 1;">
                        <div class="d-flex flex-column justify-content-start align-items-start" style="flex: 1;"><input
                                type="text" class="form-control modal-input" id="tag-id" name="id"
                                value="{{ isset($tag) && $tag ? $tag->id : '' }}" readonly>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Name</span>
                                <input type="text" name="name" placeholder="Name" class="form-control modal-input"
                                    id="tag-name" placeholder="Name"
                                    value="{{ isset($tag) && $tag ? $tag->name : '' }}">
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Slug</span>
                                <input type="text" name="slug" placeholder="Slug" class="form-control modal-input"
                                    id="tag-slug" placeholder="Slug"
                                    value="{{ isset($tag) && $tag ? $tag->slug : '' }}">
                            </div>
                            <div class="form-floating mb-3" style="align-self: stretch;">
                                <textarea class="form-control modal-input" placeholder="Description" id="tag-description" name="description"
                                    style="height: 100px;">{{ isset($tag) && $tag ? $tag->description : '' }}</textarea>
                                <label for="tag-description">Description</label>
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Color</span>
                                <input type="text" name="color" placeholder="Color"
                                    class="form-control modal-input" id="tag-color" placeholder="Color"
                                    value="{{ isset($tag) && $tag ? $tag->color : '' }}">
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Priority</span>
                                <input type="number" name="priority" placeholder="Priority"
                                    class="form-control modal-input" id="tag-priority" placeholder="Priority"
                                    value="{{ isset($tag) && $tag ? $tag->priority : '' }}">
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Created At</span>
                                <input type="datetime-local" name="created_at" placeholder="Created At"
                                    class="form-control modal-input" id="tag-created_at" placeholder="Created At"
                                    value="{{ isset($tag) && $tag ? $tag->created_at : '' }}">
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Updated At</span>
                                <input type="datetime-local" name="updated_at" placeholder="Updated At"
                                    class="form-control modal-input" id="tag-updated_at" placeholder="Updated At"
                                    value="{{ isset($tag) && $tag ? $tag->updated_at : '' }}">
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Deleted At</span>
                                <input type="datetime-local" name="deleted_at" placeholder="Deleted At"
                                    class="form-control modal-input" id="tag-deleted_at" placeholder="Deleted At"
                                    value="{{ isset($tag) && $tag ? $tag->deleted_at : '' }}">
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="tag-form" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        let tags = null;

        fetch(location.href, {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        }).then(response => response.json().then(json => tags = json));

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

        const modalElement = document.getElementById('tag-modal');
        modalElement.addEventListener('show.bs.modal', function(e) {
            const button = e.relatedTarget;
            const tagId = button.dataset.id;

            const title = document.getElementById('tagModalLabel');
            title.innerHTML = "New Tag";

            if (tagId) {
                title.innerHTML = "Edit Tag";

                const tag = tags.find(tag => tag.id == tagId);

                if (tag) {
                    for (const field in tag) {
                        const element = document.getElementById(`tag-${field}`);
                        if (element) {
                            if (!element.matches('[type="file"]') && !element.matches('[type="checkbox"]') && !
                                element.matches('[type="radio"]')) {
                                element.value = tag[field];
                            } else if (element.matches('[type="checkbox"]')) {
                                element.checked = tag[field];
                            } else if (element.matches('[type="radio"]')) {
                                element.checked = tag[field] == element.value;
                            }

                            const preview = document.getElementById(`tag-${field}-preview`);
                            if (preview && preview.matches('img')) {
                                preview.src = tag[field].startsWith('http') ? tag[field] :
                                    `{{ asset('storage/') }}/${tag[field]}`;
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
