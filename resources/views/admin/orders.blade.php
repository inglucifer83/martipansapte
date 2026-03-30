<x-admin>
    <x-slot:title>Orders</x-slot>
    <div style="padding: 2vw 2vw;">
        <div class="d-flex align-items-stretch justify-content-start" style="margin-bottom: 1vw;">
            <div class="card" style="margin-right: 1vw; max-width: 30vw; min-width: 15vw;">
                <div class="card-body d-flex flex-column">
                    <p style="font-size: 2rem; font-weight: bold; text-align: center; color: #2563EB">Orders Count</p>
                    <div class="d-flex flex-column justify-content-center align-items-center" style="flex: 1">
                        @if ($widgets['Orders Count'] > 1000)
                            <p
                                style=" margin: 0; margin-top: -1vw; font-size: 1.5rem; font-weight: bold; text-align: center; color: #0E2A5A">
                                ({{ $widgets['Orders Count'] }})</p>
                        @else
                            <p
                                style="margin: 0; font-size: 5rem; font-weight: bold; text-align: center; color: #0E2A5A">
                                {{ $widgets['Orders Count'] }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <b style="font-size: 2rem;">Orders</b>
                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#order-modal">
                    <svg style="width: 20px; height: 20px; fill: currentcolor;">
                        <use href="{{ url('/') . '/storage/sprites/solid.svg#plus' }}"></use>
                    </svg>
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="orders-table" class="table table-striped data-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>User Id</th>
                                <th>Order Number</th>
                                <th>Status</th>
                                <th>Subtotal</th>
                                <th>Shipping Cost</th>
                                <th>Tax Total</th>
                                <th>Total</th>
                                <th>Currency</th>
                                <th>Billing Address Id</th>
                                <th>Shipping Address Id</th>
                                <th>Placed At</th>
                                <th>Fulfilled At</th>
                                <th>Tracking Number</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th style="text-align: right;" class="admin-action-buttons-column"
                                    data-sortable="false">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td style="vertical-align: middle;">{{ $order->id }}</td>
                                    <td style="vertical-align: middle;">{{ $order->user_id }}</td>
                                    <td style="vertical-align: middle;">{{ $order->order_number }}</td>
                                    <td style="vertical-align: middle;">{{ $order->status }}</td>
                                    <td style="vertical-align: middle;">{{ $order->subtotal }}</td>
                                    <td style="vertical-align: middle;">{{ $order->shipping_cost }}</td>
                                    <td style="vertical-align: middle;">{{ $order->tax_total }}</td>
                                    <td style="vertical-align: middle;">{{ $order->total }}</td>
                                    <td style="vertical-align: middle;">{{ $order->currency }}</td>
                                    <td style="vertical-align: middle;">{{ $order->billing_address_id }}</td>
                                    <td style="vertical-align: middle;">{{ $order->shipping_address_id }}</td>
                                    <td style="vertical-align: middle;">{{ $order->placed_at }}</td>
                                    <td style="vertical-align: middle;">{{ $order->fulfilled_at }}</td>
                                    <td style="vertical-align: middle;">{{ $order->tracking_number }}</td>
                                    <td style="vertical-align: middle;">{{ $order->created_at }}</td>
                                    <td style="vertical-align: middle;">{{ $order->updated_at }}</td>
                                    <td class="admin-action-buttons-column" style="vertical-align: middle;">
                                        <div
                                            class="d-flex align-items-center justify-content-end admin-table-action-buttons">
                                            @hasanyrole('SuperAdmin|Manager|Editor')
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#order-modal"
                                                    data-id="{{ $order->id }}" class="btn btn-sm btn-outline-warning"
                                                    style="margin-left:0.5vw;">
                                                    <svg
                                                        style="width: 20px; height: 20px; fill: currentcolor; pointer-events: none;">
                                                        <use href="{{ url('/') . '/storage/sprites/solid.svg#pencil' }}">
                                                        </use>
                                                    </svg>
                                                </button>
                                            @endhasanyrole
                                            <a role="button" href="{{ route('admin.orders.order', $order->id) }}"
                                                class="btn btn-sm btn-outline-primary" style="margin-left:0.5vw;">
                                                <svg
                                                    style="width: 20px; height: 20px; fill: currentcolor; pointer-events: none;">
                                                    <use href="{{ url('/') . '/storage/sprites/solid.svg#eye' }}"></use>
                                                </svg>
                                            </a>
                                            @hasanyrole('SuperAdmin|Manager')
                                                <form action="{{ route('admin.orders.delete', $order->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                                        data-modal="form" data-type="danger" data-title="Delete Order"
                                                        data-body="Are you sure you want to delete the user with id {{ $order->id }}?"
                                                        data-confirm="Delete" style="margin-left:0.5vw;">
                                                        <svg
                                                            style="width: 20px; height: 20px; fill: currentcolor; pointer-events: none;">
                                                            <use href="{{ url('/') . '/storage/sprites/solid.svg#trash' }}">
                                                            </use>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endhasanyrole
                                            @if ($order->trashed())
                                                @hasanyrole('SuperAdmin|Manager')
                                                    <form action="{{ route('admin.orders.restore', $order->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="button" class="btn btn-sm btn-outline-success"
                                                            data-modal="form" data-type="success" data-title="Restore Order"
                                                            data-body="Are you sure you want to delete the user with id {{ $order->id }}?"
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
                                                    <form action="{{ route('admin.orders.erease', $order->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                                            data-modal="form" data-type="danger" data-title="Erease Order"
                                                            data-body="Are you sure you want to delete the user with id {{ $order->id }}?"
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
        @include('admin.modals.order')
    @endpush


    @push('js')
    @endpush

</x-admin>
