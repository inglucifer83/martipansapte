<x-admin>
    <x-slot:title>Users</x-slot>
    <div style="padding: 2vw 2vw;">
        <div class="d-flex align-items-stretch justify-content-start" style="margin-bottom: 1vw;">
            <div class="card" style="margin-right: 1vw; max-width: 30vw; min-width: 15vw;">
                <div class="card-body d-flex flex-column">
                    <p style="font-size: 2rem; font-weight: bold; text-align: center; color: #2563EB">Users Count</p>
                    <div class="d-flex flex-column justify-content-center align-items-center" style="flex: 1">
                        @if ($widgets['Users Count'] > 1000)
                            <p
                                style=" margin: 0; margin-top: -1vw; font-size: 1.5rem; font-weight: bold; text-align: center; color: #0E2A5A">
                                ({{ $widgets['Users Count'] }})</p>
                        @else
                            <p
                                style="margin: 0; font-size: 5rem; font-weight: bold; text-align: center; color: #0E2A5A">
                                {{ $widgets['Users Count'] }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card" style="margin-right: 1vw; max-width: 30vw; min-width: 15vw;">
                <div class="card-body d-flex flex-column">
                    <p style="font-size: 2rem; font-weight: bold; text-align: center;">Progress</p>
                    <div class="d-flex align-items-center" style="flex: 1;">
                        <div class="progress" role="progressbar" aria-label="Progress"
                            aria-valuenow="{{ $widgets['Progress'] }}" aria-valuemin="0" aria-valuemax="100"
                            style="width: 100%; height: 30px;">
                            <div class="progress-bar progress-bar-striped"
                                style="font-weight: bold; font-size: 1.2rem; color: #ffffffff; background-color: #7fffd4ff; width: {{ $widgets['Progress'] }}%">
                                {{ $widgets['Progress'] }}%</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" style="margin-right: 1vw; max-width: 30vw; min-width: 15vw;">
                <div class="card-body d-flex flex-column">
                    <p style="font-size: 2rem; font-weight: bold; text-align: center; color: black">Unverified users</p>

                    <th style="text-align: left;">Id</th>
                    <th style="text-align: center;">Pic</th>
                    <th style="text-align: left;">Email</th>
                    <th style="text-align: left;">Name</th>
                    <th style="text-align: left;">Created At</th>

                    <td style="vertical-align: middle; text-align: left;">{{ $user->id }}</td>
                    <td style="vertical-align: middle; text-align: center;"><img
                            src="{{ Str::startsWith($user->avatar, 'http') ? $user->avatar : asset('storage/' . $user->avatar) }}"
                            width="60" height="60" style="border-radius: 0%;" /></td>
                    <td style="vertical-align: middle; text-align: left;"><a
                            href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                    <td style="vertical-align: middle; text-align: left;">{{ $user->name }}</td>
                    <td style="vertical-align: middle; text-align: left;">{{ $user->created_at }}</td>

                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <b style="font-size: 2rem;">Users</b>
                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#user-modal">
                    <svg style="width: 20px; height: 20px; fill: currentcolor;">
                        <use href="{{ url('/') . '/storage/sprites/solid.svg#plus' }}"></use>
                    </svg>
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="users-table" class="table table-striped data-table">
                        <thead>
                            <tr>
                                <th style="text-align: left;">Id</th>
                                <th style="text-align: left;">Name</th>
                                <th style="text-align: center;">Email</th>
                                <th style="text-align: left;">Picture</th>
                                <th style="text-align: left;">Display Name</th>
                                <th style="text-align: left;">Phone</th>
                                <th style="text-align: left;">Email Verified At</th>
                                <th style="text-align: left;">Marketing Opt In</th>
                                <th style="text-align: left;">Last Login At</th>
                                <th style="text-align: left;">Role</th>
                                <th style="text-align: left;">Created At</th>
                                <th style="text-align: left;">Updated At</th>
                                <th style="text-align: right;" class="admin-action-buttons-column"
                                    data-sortable="false">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td style="vertical-align: middle; text-align: left;">{{ $user->id }}</td>
                                    <td style="vertical-align: middle; text-align: left;">{{ $user->name }}</td>
                                    <td style="vertical-align: middle; text-align: center;"><a
                                            href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                    <td style="vertical-align: middle; text-align: left;"><img
                                            src="{{ Str::startsWith($user->avatar, 'http') ? $user->avatar : asset('storage/' . $user->avatar) }}"
                                            width="60" height="60" style="border-radius: 30%;" /></td>
                                    <td style="vertical-align: middle; text-align: left;">{{ $user->display_name }}
                                    </td>
                                    <td style="vertical-align: middle; text-align: left;">{{ $user->phone }}</td>
                                    <td style="vertical-align: middle; text-align: left;">
                                        {{ $user->email_verified_at }}</td>
                                    <td style="vertical-align: middle; text-align: left;">{{ $user->marketing_opt_in }}
                                    </td>
                                    <td style="vertical-align: middle; text-align: left;">{{ $user->last_login_at }}
                                    </td>
                                    <td style="vertical-align: middle; text-align: left;">{{ $user->role }}</td>
                                    <td style="vertical-align: middle; text-align: left;">{{ $user->created_at }}</td>
                                    <td style="vertical-align: middle; text-align: left;">{{ $user->updated_at }}</td>
                                    <td class="admin-action-buttons-column" style="vertical-align: middle;">
                                        <div
                                            class="d-flex align-items-center justify-content-end admin-table-action-buttons">
                                            @hasanyrole('SuperAdmin|Manager|Editor')
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#user-modal"
                                                    data-id="{{ $user->id }}" class="btn btn-sm btn-outline-warning"
                                                    style="margin-left:0.5vw;">
                                                    <svg
                                                        style="width: 20px; height: 20px; fill: currentcolor; pointer-events: none;">
                                                        <use href="{{ url('/') . '/storage/sprites/solid.svg#pencil' }}">
                                                        </use>
                                                    </svg>
                                                </button>
                                            @endhasanyrole
                                            <a role="button" href="{{ route('admin.users.user', $user->id) }}"
                                                class="btn btn-sm btn-outline-primary" style="margin-left:0.5vw;">
                                                <svg
                                                    style="width: 20px; height: 20px; fill: currentcolor; pointer-events: none;">
                                                    <use href="{{ url('/') . '/storage/sprites/solid.svg#eye' }}">
                                                    </use>
                                                </svg>
                                            </a>
                                            @hasanyrole('SuperAdmin|Manager')
                                                <form action="{{ route('admin.users.delete', $user->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                                        data-modal="form" data-type="danger" data-title="Delete User"
                                                        data-body="Are you sure you want to delete the user with id {{ $user->id }}?"
                                                        data-confirm="Delete" style="margin-left:0.5vw;">
                                                        <svg
                                                            style="width: 20px; height: 20px; fill: currentcolor; pointer-events: none;">
                                                            <use
                                                                href="{{ url('/') . '/storage/sprites/solid.svg#trash' }}">
                                                            </use>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endhasanyrole
                                            @if ($user->trashed())
                                                @hasanyrole('SuperAdmin|Manager')
                                                    <form action="{{ route('admin.users.restore', $user->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="button" class="btn btn-sm btn-outline-success"
                                                            data-modal="form" data-type="success"
                                                            data-title="Restore User"
                                                            data-body="Are you sure you want to delete the user with id {{ $user->id }}?"
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
                                                    <form action="{{ route('admin.users.erease', $user->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                                            data-modal="form" data-type="danger" data-title="Erease User"
                                                            data-body="Are you sure you want to delete the user with id {{ $user->id }}?"
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
        @include('admin.modals.user')
    @endpush


    @push('js')
    @endpush

</x-admin>
