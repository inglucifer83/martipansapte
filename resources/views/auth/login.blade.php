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
            <form id="form-0" action="{{ route('authenticate') }}" method="POST" style="display: none;">
                @csrf</form>
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
            <div class="mb-1">
                <label for="password" class="form-label">
                    {{ __('auth.PASSWORD') }}
                </label>
                <input value="{{ old('password') }}" form="form-0" type="password" class="form-control" id="password"
                    name="password" required placeholder="{{ __('auth.PASSWORD') }}">
                @error('password')
                    <ul class="text-danger fs-6">
                        @foreach ($errors->get('password') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @enderror
            </div>
            <div class="mb-3 text-start">
                <a id="a-0" href="{{ route('password.request') }}" class="text-decoration-none text-muted small">
                    {{ __('auth.FORGOT_PASSWORD?') }}
                </a>
            </div>
            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label form="form-0" class="form-check-label" for="remember">
                    {{ __('auth.REMEMBER_ME') }}
                </label>
            </div>
            <div class="d-flex justify-content-end">
                <button form="form-0" type="submit" class="btn btn-ht-primary">
                    {{ __('labels.LOGIN') }}
                </button>
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-center mt-3">
            <span style="margin: 0">
                {{ __('auth.LOGIN_0') }}
            </span>
            <a id="a-1" href="{{ route('register') }}" style="margin-left: 0.5vw"
                class="font-weight-bold text-decoration-none">
                {{ __('auth.REGISTER_HERE') }}
            </a>
        </div>
    </div>


</x-html>
