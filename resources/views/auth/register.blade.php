<x-html lang="{{ app()->getLocale() }}">
    <x-slot:head>
    </x-slot>
    <div style="height: 100vh" class="d-flex flex-column align-items-center justify-content-center">
        <div class="mb-1">
            <picture>
                <source srcset="{{ iasset('storage/logo_dark.webp') }}" media="(prefers-color-scheme: dark)">
                <source srcset="{{ iasset('storage/logo.png') }}">
                <source srcset="{{ iasset('storage/logo_dark.png') }}" media="(prefers-color-scheme: dark)">
                <img src="{{ iasset('storage/logo.webp') }}" style="width: 25vw; height: 25vw; object-fit: contain"
                    alt="Logo">
            </picture>
        </div>
        <div style="border-radius: 1rem; box-shadow: 0 0 10px var(--bs-gray); padding: 1vw; min-width: 30vw"
            class="login-card">
            <form id="form-0" action="{{ route('signup') }}" method="POST" style="display: none;">
                @csrf</form>
            <div class="mb-3">
                <label for="name" class="form-label">
                    {{ __('labels.NAME') }}
                </label>
                <input value="{{ old('name') }}" form="form-0" type="text" class="form-control" id="name"
                    name="name" required>
                @error('name')
                    <ul class="text-danger fs-6">
                        @foreach ($errors->get('name') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">
                    {{ __('labels.EMAIL_ADDRESS') }}
                </label>
                <input value="{{ old('email') }}" form="form-0" type="email" class="form-control" id="email"
                    name="email" required>
                @error('email')
                    <ul class="text-danger fs-6">
                        @foreach ($errors->get('email') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">
                    {{ __('auth.PASSWORD') }}
                </label>
                <input value="{{ old('password') }}" form="form-0" type="password" class="form-control" id="password"
                    name="password" required>
                @error('password')
                    <ul class="text-danger fs-6">
                        @foreach ($errors->get('password') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">
                    {{ __('auth.CONFIRM_PASSWORD') }}
                </label>
                <input value="{{ old('password_confirmation') }}" form="form-0" type="password" class="form-control"
                    id="password_confirmation" name="password_confirmation" required
                    placeholder="{{ __('auth.CONFIRM_PASSWORD') }}">
                @error('password_confirmation')
                    <ul class="text-danger fs-6">
                        @foreach ($errors->get('password_confirmation') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @enderror
            </div>
            <div class="d-flex justify-content-end">
                <button form="form-0" type="submit" class="btn btn-ht-primary">
                    {{ __('labels.REGISTER') }}
                </button>
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-center mt-3">
            <span style="margin: 0">
                {{ __('auth.ALREADY_REGISTERED?') }}
            </span>
            <a id="a-0" href="{{ route('login') }}" style="margin-left: 0.5vw"
                class="font-weight-bold text-decoration-none">
                {{ __('auth.LOGIN_HERE') }}
            </a>
        </div>
    </div>


</x-html>
