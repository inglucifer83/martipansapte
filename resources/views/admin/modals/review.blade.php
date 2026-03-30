<div class="modal fade" id="review-modal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="reviewModalLabel">Review</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.reviews.store') }}" id="review-form" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="modal-input" name="id" id="review-id" />
                    <div class="d-flex justify-content-start align-items-stretch" style="flex: 1;">
                        <div class="d-flex flex-column justify-content-start align-items-start" style="flex: 1;"><input
                                type="text" class="form-control modal-input" id="review-id" name="id"
                                value="{{ isset($review) && $review ? $review->id : '' }}" readonly>
                            <div class="input-group mb-3" style="width: initial">
                                <span class="input-group-text">User Id</span>
                                <select class="form-select" name="user_id" aria-label="user_id">
                                    @foreach (App\Models\User::all() as $user)
                                        <option value="{{ $user->id }}" @selected(isset($review) && $review->user_id == $user->id)>
                                            {{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group mb-3" style="width: initial">
                                <span class="input-group-text">Product Id</span>
                                <select class="form-select" name="product_id" aria-label="product_id">
                                    @foreach (App\Models\Product::all() as $product)
                                        <option value="{{ $product->id }}" @selected(isset($review) && $review->product_id == $product->id)>
                                            {{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Rating</span>
                                <input type="number" name="rating" placeholder="Rating"
                                    class="form-control modal-input" id="review-rating" placeholder="Rating"
                                    value="{{ isset($review) && $review ? $review->rating : '' }}">
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Title</span>
                                <input type="text" name="title" placeholder="Title"
                                    class="form-control modal-input" id="review-title" placeholder="Title"
                                    value="{{ isset($review) && $review ? $review->title : '' }}">
                            </div>
                            <div class="form-floating mb-3" style="align-self: stretch;">
                                <textarea class="form-control modal-input" placeholder="Body" id="review-body" name="body" style="height: 100px;">{{ isset($review) && $review ? $review->body : '' }}</textarea>
                                <label for="review-body">Body</label>
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" name="approved" value="1"
                                    @checked(isset($review) && $review ? $review->approved : false) type="checkbox" role="switch" id="review-approved">
                                <label class="form-check-label" for="review-approved">Approved</label>
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Helpful Count</span>
                                <input type="number" name="helpful_count" placeholder="Helpful Count"
                                    class="form-control modal-input" id="review-helpful_count"
                                    placeholder="Helpful Count"
                                    value="{{ isset($review) && $review ? $review->helpful_count : '' }}">
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Created At</span>
                                <input type="datetime-local" name="created_at" placeholder="Created At"
                                    class="form-control modal-input" id="review-created_at" placeholder="Created At"
                                    value="{{ isset($review) && $review ? $review->created_at : '' }}">
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Updated At</span>
                                <input type="datetime-local" name="updated_at" placeholder="Updated At"
                                    class="form-control modal-input" id="review-updated_at" placeholder="Updated At"
                                    value="{{ isset($review) && $review ? $review->updated_at : '' }}">
                            </div>
                            <div class="input-group mb-3" style="width: initial;">
                                <span class="input-group-text">Deleted At</span>
                                <input type="datetime-local" name="deleted_at" placeholder="Deleted At"
                                    class="form-control modal-input" id="review-deleted_at" placeholder="Deleted At"
                                    value="{{ isset($review) && $review ? $review->deleted_at : '' }}">
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="review-form" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script nonce="@nonce">
        let reviews = null;

        fetch(location.href, {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        }).then(response => response.json().then(json => reviews = json));

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

        const modalElement = document.getElementById('review-modal');
        modalElement.addEventListener('show.bs.modal', function(e) {
            const button = e.relatedTarget;
            const reviewId = button.dataset.id;

            const title = document.getElementById('reviewModalLabel');
            title.innerHTML = "New Review";

            if (reviewId) {
                title.innerHTML = "Edit Review";

                const review = reviews.find(review => review.id == reviewId);

                if (review) {
                    for (const field in review) {
                        const element = document.getElementById(`review-${field}`);
                        if (element) {
                            if (!element.matches('[type="file"]') && !element.matches('[type="checkbox"]') && !
                                element.matches('[type="radio"]')) {
                                element.value = review[field];
                            } else if (element.matches('[type="checkbox"]')) {
                                element.checked = review[field];
                            } else if (element.matches('[type="radio"]')) {
                                element.checked = review[field] == element.value;
                            }

                            const preview = document.getElementById(`review-${field}-preview`);
                            if (preview && preview.matches('img')) {
                                preview.src = review[field].startsWith('http') ? review[field] :
                                    `{{ asset('storage/') }}/${review[field]}`;
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
