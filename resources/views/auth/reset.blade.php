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
        <div style="border-radius: 1rem; box-shadow: 0 0 10px var(--bs-gray); padding: 1vw; min-width: 20vw"
            class="login-card">
            <form id="form-0" action="{{ route('password.update') }}" method="POST" style="display: none;">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
            </form>
            <p class="mb-3 text-start">
                {{ __('auth.RESET_0') }}
            </p>
            <div class="mb-3">
                <label for="email" class="form-label">
                    {{ __('labels.EMAIL_ADDRESS') }}
                </label>
                <input value="{{ old('email') }}" type="email" class="form-control" id="email" name="email"
                    readonly form="form-0">
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
                <input value="{{ old('password') }}" type="password" class="form-control" id="password"
                    name="password" form="form-0" required>
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
                <input value="{{ old('password_confirmation') }}" type="password" class="form-control"
                    id="password_confirmation" name="password_confirmation" required form="form-0">
                @error('password_confirmation')
                    <ul class="text-danger fs-6">
                        @foreach ($errors->get('password_confirmation') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @enderror
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-ht-primary" form="form-0">
                    {{ __('auth.RESET_PASSWORD') }}
                </button>
            </div>
        </div>
    </div>


</x-html>
