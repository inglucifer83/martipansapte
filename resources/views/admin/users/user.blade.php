<x-admin>
    <x-slot:back>{{ route('admin.users') }}</x-slot>
    <x-slot:title>User</x-slot>

    <div class="d-flex justify-content-start align-items-stretch" style="flex: 1;">
<div class="accordion mb-3" id="collpase-container-0-0" style="flex: 1;">
            <div class=\accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collpase-0-0"
                        aria-expanded="true" aria-controls="collapse-0-0">

                    </button>
                </h2>
                <div id="collapse-0-0" class="accordion-collapse collapse show"
                    data-bs-parent="#collpase-container-0-0">
                    <div class="accordion-body flex-column justify-content-start align-items-start"><input
                            type="text" class="form-control detail-input" id="user-id" name="id"
                            value="{{ isset($user) && $user ? $user->id : '' }}" readonly>
                        <div class="input-group mb-3" style="width: initial;">
                            <span class="input-group-text">Name</span>
                            <input type="text" name="name" placeholder="Name" class="form-control detail-input"
                                id="user-name" placeholder="Name"
                                value="{{ isset($user) && $user ? $user->name : '' }}">
                        </div>
                        <div class="input-group mb-3" style="width: initial;">
                            <span class="input-group-text">Email</span>
                            <input type="text" name="email" placeholder="Email" class="form-control detail-input"
                                id="user-email" placeholder="Email"
                                value="{{ isset($user) && $user ? $user->email : '' }}">
                        </div>

                        <div class="d-flex flex-column justify-content-start align-items-start">
                            <img src="{{ Str::startsWith($user->avatar, 'http') ? $user->avatar : asset('storage/' . $user->avatar) }}"
                                width="60" height="60" id="user-avatar-preview" />

                            <div class="input-group mb-3" style="margin-top: 0.5vw; width: initial;"><span
                                    class="input-group-text">Avatar</span><input name="avatar" id="user-avatar"
                                    type="file" class="form-control" accept=".png,.jpg,.gif,.jpeg,.webp" /></div>
                        </div>
                        <div class="input-group mb-3" style="width: initial;">
                            <span class="input-group-text">Display Name</span>
                            <input type="text" name="display_name" placeholder="Display Name"
                                class="form-control detail-input" id="user-display_name" placeholder="Display Name"
                                value="{{ isset($user) && $user ? $user->display_name : '' }}">
                        </div>
                        <div class="input-group mb-3" style="width: initial;">
                            <span class="input-group-text">Phone</span>
                            <input type="tel" name="phone" placeholder="Phone" class="form-control detail-input"
                                id="user-phone" placeholder="Phone"
                                value="{{ isset($user) && $user ? $user->phone : '' }}">
                        </div>
                        <div class="input-group mb-3" style="width: initial;">
                            <span class="input-group-text">Email Verified At</span>
                            <input type="datetime-local" name="email_verified_at" placeholder="Email Verified At"
                                class="form-control detail-input" id="user-email_verified_at"
                                placeholder="Email Verified At"
                                value="{{ isset($user) && $user ? $user->email_verified_at : '' }}">
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" name="marketing_opt_in" value="1"
                                @checked(isset($user) && $user ? $user->marketing_opt_in : false) type="checkbox" role="switch" id="user-marketing_opt_in">
                            <label class="form-check-label" for="user-marketing_opt_in">Marketing Opt In</label>
                        </div>
                        <div class="input-group mb-3" style="width: initial;">
                            <span class="input-group-text">Last Login At</span>
                            <input type="datetime-local" name="last_login_at" placeholder="Last Login At"
                                class="form-control detail-input" id="user-last_login_at" placeholder="Last Login At"
                                value="{{ isset($user) && $user ? $user->last_login_at : '' }}">
                        </div>
                        <div class="input-group mb-3" style="width: initial;">
                            <span class="input-group-text">Role</span>
                            <input type="text" name="role" placeholder="Role"
                                class="form-control detail-input" id="user-role" placeholder="Role"
                                value="{{ isset($user) && $user ? $user->role : '' }}">
                        </div>
                        <div class="input-group mb-3" style="width: initial;">
                            <span class="input-group-text">Created At</span>
                            <input type="datetime-local" name="created_at" placeholder="Created At"
                                class="form-control detail-input" id="user-created_at" placeholder="Created At"
                                value="{{ isset($user) && $user ? $user->created_at : '' }}">
                        </div>
                        <div class="input-group mb-3" style="width: initial;">
                            <span class="input-group-text">Updated At</span>
                            <input type="datetime-local" name="updated_at" placeholder="Updated At"
                                class="form-control detail-input" id="user-updated_at" placeholder="Updated At"
                                value="{{ isset($user) && $user ? $user->updated_at : '' }}">
                        </div>
                        <div class="input-group mb-3" style="width: initial;">
                            <span class="input-group-text">Deleted At</span>
                            <input type="datetime-local" name="deleted_at" placeholder="Deleted At"
                                class="form-control detail-input" id="user-deleted_at" placeholder="Deleted At"
                                value="{{ isset($user) && $user ? $user->deleted_at : '' }}">
                        </div>

                    </div>

                </div>
</x-admin>
