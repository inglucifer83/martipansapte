<x-admin>
    <x-slot:title>Reviews</x-slot>
    <div style="padding: 2vw 2vw;">
        <div class="d-flex align-items-stretch justify-content-start" style="margin-bottom: 1vw;">
            <div class="card" style="margin-right: 1vw; max-width: 30vw; min-width: 15vw;">
                <div class="card-body d-flex flex-column">
                    <p style="font-size: 2rem; font-weight: bold; text-align: center; color: #2563EB">Reviews Count</p>
                    <div class="d-flex flex-column justify-content-center align-items-center" style="flex: 1">
                        @if ($widgets['Reviews Count'] > 1000)
                            <p
                                style=" margin: 0; margin-top: -1vw; font-size: 1.5rem; font-weight: bold; text-align: center; color: #0E2A5A">
                                ({{ $widgets['Reviews Count'] }})</p>
                        @else
                            <p
                                style="margin: 0; font-size: 5rem; font-weight: bold; text-align: center; color: #0E2A5A">
                                {{ $widgets['Reviews Count'] }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <b style="font-size: 2rem;">Reviews</b>
                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#review-modal">
                    <svg style="width: 20px; height: 20px; fill: currentcolor;">
                        <use href="{{ url('/') . '/storage/sprites/solid.svg#plus' }}"></use>
                    </svg>
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="reviews-table" class="table table-striped data-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>User Id</th>
                                <th>Product Id</th>
                                <th>Rating</th>
                                <th>Title</th>
                                <th>Body</th>
                                <th>Approved</th>
                                <th>Helpful Count</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th style="text-align: right;" class="admin-action-buttons-column"
                                    data-sortable="false">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reviews as $review)
                                <tr>
                                    <td style="vertical-align: middle;">{{ $review->id }}</td>
                                    <td style="vertical-align: middle;">{{ $review->user_id }}</td>
                                    <td style="vertical-align: middle;">{{ $review->product_id }}</td>
                                    <td style="vertical-align: middle;">{{ $review->rating }}</td>
                                    <td style="vertical-align: middle;">{{ $review->title }}</td>
                                    <td style="vertical-align: middle;">{{ $review->body }}</td>
                                    <td style="vertical-align: middle;">{{ $review->approved }}</td>
                                    <td style="vertical-align: middle;">{{ $review->helpful_count }}</td>
                                    <td style="vertical-align: middle;">{{ $review->created_at }}</td>
                                    <td style="vertical-align: middle;">{{ $review->updated_at }}</td>
                                    <td class="admin-action-buttons-column" style="vertical-align: middle;">
                                        <div
                                            class="d-flex align-items-center justify-content-end admin-table-action-buttons">
                                            @hasanyrole('SuperAdmin|Manager|Editor')
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#review-modal"
                                                    data-id="{{ $review->id }}" class="btn btn-sm btn-outline-warning"
                                                    style="margin-left:0.5vw;">
                                                    <svg
                                                        style="width: 20px; height: 20px; fill: currentcolor; pointer-events: none;">
                                                        <use href="{{ url('/') . '/storage/sprites/solid.svg#pencil' }}">
                                                        </use>
                                                    </svg>
                                                </button>
                                            @endhasanyrole
                                            <a role="button" href="{{ route('admin.reviews.review', $review->id) }}"
                                                class="btn btn-sm btn-outline-primary" style="margin-left:0.5vw;">
                                                <svg
                                                    style="width: 20px; height: 20px; fill: currentcolor; pointer-events: none;">
                                                    <use href="{{ url('/') . '/storage/sprites/solid.svg#eye' }}"></use>
                                                </svg>
                                            </a>
                                            @hasanyrole('SuperAdmin|Manager')
                                                <form action="{{ route('admin.reviews.delete', $review->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                                        data-modal="form" data-type="danger" data-title="Delete Review"
                                                        data-body="Are you sure you want to delete the user with id {{ $review->id }}?"
                                                        data-confirm="Delete" style="margin-left:0.5vw;">
                                                        <svg
                                                            style="width: 20px; height: 20px; fill: currentcolor; pointer-events: none;">
                                                            <use href="{{ url('/') . '/storage/sprites/solid.svg#trash' }}">
                                                            </use>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endhasanyrole
                                            @if ($review->trashed())
                                                @hasanyrole('SuperAdmin|Manager')
                                                    <form action="{{ route('admin.reviews.restore', $review->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="button" class="btn btn-sm btn-outline-success"
                                                            data-modal="form" data-type="success"
                                                            data-title="Restore Review"
                                                            data-body="Are you sure you want to delete the user with id {{ $review->id }}?"
                                                            data-confirm="Restore" style="margin-left:0.5vw;">
                                                            <svg
                                                                style="width: 20px; height: 20px; fill: currentcolor; pointer-events: none;">
                                                                <use
                                                                    href="{{ url('/') . '/storage/sprites/solid.svg#rotate-left' }}">
                                                                </use>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endhasanyrole
                                                @role('SuperAdmin')
                                                    <form action="{{ route('admin.reviews.erease', $review->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                                            data-modal="form" data-type="danger" data-title="Erease Review"
                                                            data-body="Are you sure you want to delete the user with id {{ $review->id }}?"
                                                            data-confirm="Erease" style="margin-left:0.5vw;">
                                                            <svg
                                                                style="width: 20px; height: 20px; fill: currentcolor; pointer-events: none;">
                                                                <use
                                                                    href="{{ url('/') . '/storage/sprites/solid.svg#ban' }}">
                                                                </use>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endrole
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('modals')
        @include('admin.modals.review')
    @endpush


    @push('js')
    @endpush

</x-admin>
