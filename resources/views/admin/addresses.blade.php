<x-admin>
    <x-slot:title>Addresses</x-slot>
    <div style="padding: 2vw 2vw;">
        <div class="d-flex align-items-stretch justify-content-start" style="margin-bottom: 1vw;">
            <div class="card" style="margin-right: 1vw; max-width: 30vw; min-width: 15vw;">
                <div class="card-body d-flex flex-column">
                    <p style="font-size: 2rem; font-weight: bold; text-align: center; color: #2563EB">Addresses Count</p>
                    <div class="d-flex flex-column justify-content-center align-items-center" style="flex: 1">
                        @if ($widgets['Addresses Count'] > 1000)
                            <p
                                style=" margin: 0; margin-top: -1vw; font-size: 1.5rem; font-weight: bold; text-align: center; color: #0E2A5A">
                                ({{ $widgets['Addresses Count'] }})</p>
                        @else
                            <p
                                style="margin: 0; font-size: 5rem; font-weight: bold; text-align: center; color: #0E2A5A">
                                {{ $widgets['Addresses Count'] }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <b style="font-size: 2rem;">Addresses</b>
                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#address-modal">
                    <svg style="width: 20px; height: 20px; fill: currentcolor;">
                        <use href="{{ url('/') . '/storage/sprites/solid.svg#plus' }}"></use>
                    </svg>
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="addresses-table" class="table table-striped data-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>User Id</th>
                                <th>Label</th>
                                <th>Full Name</th>
                                <th>Company</th>
                                <th>Street</th>
                                <th>City</th>
                                <th>Region</th>
                                <th>Postal Code</th>
                                <th>Country</th>
                                <th>Phone</th>
                                <th>Is Default Shipping</th>
                                <th>Is Default Billing</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th style="text-align: right;" class="admin-action-buttons-column"
                                    data-sortable="false">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($addresses as $address)
                                <tr>
                                    <td style="vertical-align: middle;">{{ $address->id }}</td>
                                    <td style="vertical-align: middle;">{{ $address->user_id }}</td>
                                    <td style="vertical-align: middle;">{{ $address->label }}</td>
                                    <td style="vertical-align: middle;">{{ $address->full_name }}</td>
                                    <td style="vertical-align: middle;">{{ $address->company }}</td>
                                    <td style="vertical-align: middle;">{{ $address->street }}</td>
                                    <td style="vertical-align: middle;">{{ $address->city }}</td>
                                    <td style="vertical-align: middle;">{{ $address->region }}</td>
                                    <td style="vertical-align: middle;">{{ $address->postal_code }}</td>
                                    <td style="vertical-align: middle;">{{ $address->country }}</td>
                                    <td style="vertical-align: middle;">{{ $address->phone }}</td>
                                    <td style="vertical-align: middle;">{{ $address->is_default_shipping }}</td>
                                    <td style="vertical-align: middle;">{{ $address->is_default_billing }}</td>
                                    <td style="vertical-align: middle;">{{ $address->created_at }}</td>
                                    <td style="vertical-align: middle;">{{ $address->updated_at }}</td>
                                    <td class="admin-action-buttons-column" style="vertical-align: middle;">
                                        <div
                                            class="d-flex align-items-center justify-content-end admin-table-action-buttons">
                                            @hasanyrole('SuperAdmin|Manager|Editor')
                                                <button type="button" data-bs-toggle="modal"
                                                    data-bs-target="#address-modal" data-id="{{ $address->id }}"
                                                    class="btn btn-sm btn-outline-warning" style="margin-left:0.5vw;">
                                                    <svg
                                                        style="width: 20px; height: 20px; fill: currentcolor; pointer-events: none;">
                                                        <use href="{{ url('/') . '/storage/sprites/solid.svg#pencil' }}">
                                                        </use>
                                                    </svg>
                                                </button>
                                            @endhasanyrole
                                            <a role="button"
                                                href="{{ route('admin.addresses.address', $address->id) }}"
                                                class="btn btn-sm btn-outline-primary" style="margin-left:0.5vw;">
                                                <svg
                                                    style="width: 20px; height: 20px; fill: currentcolor; pointer-events: none;">
                                                    <use href="{{ url('/') . '/storage/sprites/solid.svg#eye' }}"></use>
                                                </svg>
                                            </a>
                                            @hasanyrole('SuperAdmin|Manager')
                                                <form action="{{ route('admin.addresses.delete', $address->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                                        data-modal="form" data-type="danger" data-title="Delete Address"
                                                        data-body="Are you sure you want to delete the user with id {{ $address->id }}?"
                                                        data-confirm="Delete" style="margin-left:0.5vw;">
                                                        <svg
                                                            style="width: 20px; height: 20px; fill: currentcolor; pointer-events: none;">
                                                            <use href="{{ url('/') . '/storage/sprites/solid.svg#trash' }}">
                                                            </use>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endhasanyrole
                                            @if ($address->trashed())
                                                @hasanyrole('SuperAdmin|Manager')
                                                    <form action="{{ route('admin.addresses.restore', $address->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="button" class="btn btn-sm btn-outline-success"
                                                            data-modal="form" data-type="success"
                                                            data-title="Restore Address"
                                                            data-body="Are you sure you want to delete the user with id {{ $address->id }}?"
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
                                                    <form action="{{ route('admin.addresses.erease', $address->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                                            data-modal="form" data-type="danger" data-title="Erease Address"
                                                            data-body="Are you sure you want to delete the user with id {{ $address->id }}?"
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
        @include('admin.modals.address')
    @endpush


    @push('js')
    @endpush

</x-admin>
