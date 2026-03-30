<x-admin>
    <x-slot:title>Payments</x-slot>
    <div style="padding: 2vw 2vw;">
        <div class="d-flex align-items-stretch justify-content-start" style="margin-bottom: 1vw;">
            <div class="card" style="margin-right: 1vw; max-width: 30vw; min-width: 15vw;">
                <div class="card-body d-flex flex-column">
                    <p style="font-size: 2rem; font-weight: bold; text-align: center; color: #2563EB">Payments Count</p>
                    <div class="d-flex flex-column justify-content-center align-items-center" style="flex: 1">
                        @if ($widgets['Payments Count'] > 1000)
                            <p
                                style=" margin: 0; margin-top: -1vw; font-size: 1.5rem; font-weight: bold; text-align: center; color: #0E2A5A">
                                ({{ $widgets['Payments Count'] }})</p>
                        @else
                            <p
                                style="margin: 0; font-size: 5rem; font-weight: bold; text-align: center; color: #0E2A5A">
                                {{ $widgets['Payments Count'] }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <b style="font-size: 2rem;">Payments</b>
                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#payment-modal">
                    <svg style="width: 20px; height: 20px; fill: currentcolor;">
                        <use href="{{ url('/') . '/storage/sprites/solid.svg#plus' }}"></use>
                    </svg>
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="payments-table" class="table table-striped data-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Order Id</th>
                                <th>Amount</th>
                                <th>Currency</th>
                                <th>Method</th>
                                <th>Status</th>
                                <th>Transaction Id</th>
                                <th>Gateway Response</th>
                                <th>Captured At</th>
                                <th>Refunded At</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th style="text-align: right;" class="admin-action-buttons-column"
                                    data-sortable="false">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                                <tr>
                                    <td style="vertical-align: middle;">{{ $payment->id }}</td>
                                    <td style="vertical-align: middle;">{{ $payment->order_id }}</td>
                                    <td style="vertical-align: middle;">{{ $payment->amount }}</td>
                                    <td style="vertical-align: middle;">{{ $payment->currency }}</td>
                                    <td style="vertical-align: middle;">{{ $payment->method }}</td>
                                    <td style="vertical-align: middle;">{{ $payment->status }}</td>
                                    <td style="vertical-align: middle;">{{ $payment->transaction_id }}</td>
                                    <td style="vertical-align: middle;">{{ $payment->gateway_response }}</td>
                                    <td style="vertical-align: middle;">{{ $payment->captured_at }}</td>
                                    <td style="vertical-align: middle;">{{ $payment->refunded_at }}</td>
                                    <td style="vertical-align: middle;">{{ $payment->created_at }}</td>
                                    <td style="vertical-align: middle;">{{ $payment->updated_at }}</td>
                                    <td class="admin-action-buttons-column" style="vertical-align: middle;">
                                        <div
                                            class="d-flex align-items-center justify-content-end admin-table-action-buttons">
                                            @hasanyrole('SuperAdmin|Manager|Editor')
                                                <button type="button" data-bs-toggle="modal"
                                                    data-bs-target="#payment-modal" data-id="{{ $payment->id }}"
                                                    class="btn btn-sm btn-outline-warning" style="margin-left:0.5vw;">
                                                    <svg
                                                        style="width: 20px; height: 20px; fill: currentcolor; pointer-events: none;">
                                                        <use href="{{ url('/') . '/storage/sprites/solid.svg#pencil' }}">
                                                        </use>
                                                    </svg>
                                                </button>
                                            @endhasanyrole
                                            <a role="button"
                                                href="{{ route('admin.payments.payment', $payment->id) }}"
                                                class="btn btn-sm btn-outline-primary" style="margin-left:0.5vw;">
                                                <svg
                                                    style="width: 20px; height: 20px; fill: currentcolor; pointer-events: none;">
                                                    <use href="{{ url('/') . '/storage/sprites/solid.svg#eye' }}"></use>
                                                </svg>
                                            </a>
                                            @hasanyrole('SuperAdmin|Manager')
                                                <form action="{{ route('admin.payments.delete', $payment->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                                        data-modal="form" data-type="danger" data-title="Delete Payment"
                                                        data-body="Are you sure you want to delete the user with id {{ $payment->id }}?"
                                                        data-confirm="Delete" style="margin-left:0.5vw;">
                                                        <svg
                                                            style="width: 20px; height: 20px; fill: currentcolor; pointer-events: none;">
                                                            <use href="{{ url('/') . '/storage/sprites/solid.svg#trash' }}">
                                                            </use>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endhasanyrole
                                            @if ($payment->trashed())
                                                @hasanyrole('SuperAdmin|Manager')
                                                    <form action="{{ route('admin.payments.restore', $payment->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="button" class="btn btn-sm btn-outline-success"
                                                            data-modal="form" data-type="success"
                                                            data-title="Restore Payment"
                                                            data-body="Are you sure you want to delete the user with id {{ $payment->id }}?"
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
                                                    <form action="{{ route('admin.payments.erease', $payment->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                                            data-modal="form" data-type="danger" data-title="Erease Payment"
                                                            data-body="Are you sure you want to delete the user with id {{ $payment->id }}?"
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
        @include('admin.modals.payment')
    @endpush


    @push('js')
    @endpush

</x-admin>
