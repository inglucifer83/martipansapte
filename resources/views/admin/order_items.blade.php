<x-admin>
    <x-slot:title>OrderItems</x-slot>
    <div style="padding: 2vw 2vw;">
        <div class="d-flex align-items-stretch justify-content-start" style="margin-bottom: 1vw;">
            <div class="card" style="margin-right: 1vw; max-width: 30vw; min-width: 15vw;">
                <div class="card-body d-flex flex-column">
                    <p style="font-size: 2rem; font-weight: bold; text-align: center; color: #2563EB">Order Items Count
                    </p>
                    <div class="d-flex flex-column justify-content-center align-items-center" style="flex: 1">
                        @if ($widgets['Order Items Count'] > 1000)
                            <p
                                style=" margin: 0; margin-top: -1vw; font-size: 1.5rem; font-weight: bold; text-align: center; color: #0E2A5A">
                                ({{ $widgets['Order Items Count'] }})</p>
                        @else
                            <p
                                style="margin: 0; font-size: 5rem; font-weight: bold; text-align: center; color: #0E2A5A">
                                {{ $widgets['Order Items Count'] }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <b style="font-size: 2rem;">Order Items</b>
                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#orderitem-modal">
                    <svg style="width: 20px; height: 20px; fill: currentcolor;">
                        <use href="{{ url('/') . '/storage/sprites/solid.svg#plus' }}"></use>
                    </svg>
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="order_items-table" class="table table-striped data-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Order Id</th>
                                <th>Product Id</th>
                                <th>Variant Id</th>
                                <th>Name Snapshot</th>
                                <th>Sku Snapshot</th>
                                <th>Unit Price</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Tax Amount</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th style="text-align: right;" class="admin-action-buttons-column"
                                    data-sortable="false">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order_items as $orderitem)
                                <tr>
                                    <td style="vertical-align: middle;">{{ $orderitem->id }}</td>
                                    <td style="vertical-align: middle;">{{ $orderitem->order_id }}</td>
                                    <td style="vertical-align: middle;">{{ $orderitem->product_id }}</td>
                                    <td style="vertical-align: middle;">{{ $orderitem->variant_id }}</td>
                                    <td style="vertical-align: middle;">{{ $orderitem->name_snapshot }}</td>
                                    <td style="vertical-align: middle;">{{ $orderitem->sku_snapshot }}</td>
                                    <td style="vertical-align: middle;">{{ $orderitem->unit_price }}</td>
                                    <td style="vertical-align: middle;">{{ $orderitem->quantity }}</td>
                                    <td style="vertical-align: middle;">{{ $orderitem->total_price }}</td>
                                    <td style="vertical-align: middle;">{{ $orderitem->tax_amount }}</td>
                                    <td style="vertical-align: middle;">{{ $orderitem->created_at }}</td>
                                    <td style="vertical-align: middle;">{{ $orderitem->updated_at }}</td>
                                    <td class="admin-action-buttons-column" style="vertical-align: middle;">
                                        <div
                                            class="d-flex align-items-center justify-content-end admin-table-action-buttons">
                                            @hasanyrole('SuperAdmin|Manager|Editor')
                                                <button type="button" data-bs-toggle="modal"
                                                    data-bs-target="#orderitem-modal" data-id="{{ $orderitem->id }}"
                                                    class="btn btn-sm btn-outline-warning" style="margin-left:0.5vw;">
                                                    <svg
                                                        style="width: 20px; height: 20px; fill: currentcolor; pointer-events: none;">
                                                        <use href="{{ url('/') . '/storage/sprites/solid.svg#pencil' }}">
                                                        </use>
                                                    </svg>
                                                </button>
                                            @endhasanyrole
                                            <a role="button"
                                                href="{{ route('admin.order_items.orderitem', $orderitem->id) }}"
                                                class="btn btn-sm btn-outline-primary" style="margin-left:0.5vw;">
                                                <svg
                                                    style="width: 20px; height: 20px; fill: currentcolor; pointer-events: none;">
                                                    <use href="{{ url('/') . '/storage/sprites/solid.svg#eye' }}"></use>
                                                </svg>
                                            </a>
                                            @hasanyrole('SuperAdmin|Manager')
                                                <form action="{{ route('admin.order_items.delete', $orderitem->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                                        data-modal="form" data-type="danger" data-title="Delete OrderItem"
                                                        data-body="Are you sure you want to delete the user with id {{ $orderitem->id }}?"
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
        @include('admin.modals.orderitem')
    @endpush


    @push('js')
    @endpush

</x-admin>
