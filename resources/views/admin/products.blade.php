<x-admin>
    <x-slot:title>Products</x-slot>
    <div style="padding: 2vw 2vw;">
        <div class="d-flex align-items-stretch justify-content-start" style="margin-bottom: 1vw;">
            <div class="card" style="margin-right: 1vw; max-width: 30vw; min-width: 15vw;">
                <div class="card-body d-flex flex-column">
                    <p style="font-size: 2rem; font-weight: bold; text-align: center; color: #2563EB">Products Count</p>
                    <div class="d-flex flex-column justify-content-center align-items-center" style="flex: 1">
                        @if ($widgets['Products Count'] > 1000)
                            <p
                                style=" margin: 0; margin-top: -1vw; font-size: 1.5rem; font-weight: bold; text-align: center; color: #0E2A5A">
                                ({{ $widgets['Products Count'] }})</p>
                        @else
                            <p
                                style="margin: 0; font-size: 5rem; font-weight: bold; text-align: center; color: #0E2A5A">
                                {{ $widgets['Products Count'] }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <b style="font-size: 2rem;">Products</b>
                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#product-modal">
                    <svg style="width: 20px; height: 20px; fill: currentcolor;">
                        <use href="{{ url('/') . '/storage/sprites/solid.svg#plus' }}"></use>
                    </svg>
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="products-table" class="table table-striped data-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category Id</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Short Description</th>
                                <th>Long Description</th>
                                <th>Sku</th>
                                <th>Price</th>
                                <th>Sale Price</th>
                                <th>Inventory Quantity</th>
                                <th>Featured Image</th>
                                <th>Seo Title</th>
                                <th>Seo Description</th>
                                <th>Weight</th>
                                <th>Dimensions</th>
                                <th>Shipping Class</th>
                                <th>Featured Flag</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th style="text-align: right;" class="admin-action-buttons-column"
                                    data-sortable="false">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td style="vertical-align: middle;">{{ $product->id }}</td>
                                    <td style="vertical-align: middle;">{{ $product->category_id }}</td>
                                    <td style="vertical-align: middle;">{{ $product->name }}</td>
                                    <td style="vertical-align: middle;">{{ $product->slug }}</td>
                                    <td style="vertical-align: middle;">{{ $product->short_description }}</td>
                                    <td style="vertical-align: middle;">{{ $product->long_description }}</td>
                                    <td style="vertical-align: middle;">{{ $product->sku }}</td>
                                    <td style="vertical-align: middle;">{{ $product->price }}</td>
                                    <td style="vertical-align: middle;">{{ $product->sale_price }}</td>
                                    <td style="vertical-align: middle;">{{ $product->inventory_quantity }}</td>
                                    <td style="vertical-align: middle;"><img
                                            src="{{ Str::startsWith($product->featured_image, 'http') ? $product->featured_image : asset('storage/' . $product->featured_image) }}"
                                            width="60" height="60" style="border-radius: 0%;" /></td>
                                    <td style="vertical-align: middle;">{{ $product->seo_title }}</td>
                                    <td style="vertical-align: middle;">{{ $product->seo_description }}</td>
                                    <td style="vertical-align: middle;">{{ $product->weight }}</td>
                                    <td style="vertical-align: middle;">{{ $product->dimensions }}</td>
                                    <td style="vertical-align: middle;">{{ $product->shipping_class }}</td>
                                    <td style="vertical-align: middle;">{{ $product->featured_flag }}</td>
                                    <td style="vertical-align: middle;">{{ $product->status }}</td>
                                    <td style="vertical-align: middle;">{{ $product->created_at }}</td>
                                    <td style="vertical-align: middle;">{{ $product->updated_at }}</td>
                                    <td class="admin-action-buttons-column" style="vertical-align: middle;">
                                        <div
                                            class="d-flex align-items-center justify-content-end admin-table-action-buttons">
                                            @hasanyrole('SuperAdmin|Manager|Editor')
                                                <button type="button" data-bs-toggle="modal"
                                                    data-bs-target="#product-modal" data-id="{{ $product->id }}"
                                                    class="btn btn-sm btn-outline-warning" style="margin-left:0.5vw;">
                                                    <svg
                                                        style="width: 20px; height: 20px; fill: currentcolor; pointer-events: none;">
                                                        <use href="{{ url('/') . '/storage/sprites/solid.svg#pencil' }}">
                                                        </use>
                                                    </svg>
                                                </button>
                                            @endhasanyrole
                                            <a role="button"
                                                href="{{ route('admin.products.product', $product->id) }}"
                                                class="btn btn-sm btn-outline-primary" style="margin-left:0.5vw;">
                                                <svg
                                                    style="width: 20px; height: 20px; fill: currentcolor; pointer-events: none;">
                                                    <use href="{{ url('/') . '/storage/sprites/solid.svg#eye' }}"></use>
                                                </svg>
                                            </a>
                                            @hasanyrole('SuperAdmin|Manager')
                                                <form action="{{ route('admin.products.delete', $product->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                                        data-modal="form" data-type="danger" data-title="Delete Product"
                                                        data-body="Are you sure you want to delete the user with id {{ $product->id }}?"
                                                        data-confirm="Delete" style="margin-left:0.5vw;">
                                                        <svg
                                                            style="width: 20px; height: 20px; fill: currentcolor; pointer-events: none;">
                                                            <use href="{{ url('/') . '/storage/sprites/solid.svg#trash' }}">
                                                            </use>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endhasanyrole
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
        @include('admin.modals.product')
    @endpush


    @push('js')
    @endpush

</x-admin>
