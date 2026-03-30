<!DOCTYPE html>
<html {{ $attributes->merge(['lang' => str_replace('_', '-', app()->getLocale())]) }}>
<x-head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if (isset($head) && $head)
        {{ $head }}
    @else
        <title>
            @isset($title)
                {{ $title }}@else{{ config('app.name', 'Laravel') }}
            @endisset
        </title>
    @endif
    <link rel="icon" href="{{ asset('storage/favicon.png') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('storage/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('storage/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="194x194" href="{{ asset('storage/favicon/favicon-194x194.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"
        href="{{ asset('storage/favicon/android-chrome-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('storage/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('storage/favicon/manifest.json') }}">
    @unlesssubdomain()
    <meta name="robots" content="noindex">
@endunless
</x-head>

<body>
{{ $slot }}
<script nonce="@nonce" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
<script nonce="@nonce">
    const getStoredTheme = () => localStorage.getItem('theme')
    const setStoredTheme = theme => localStorage.setItem('theme', theme)

    const getPreferredTheme = () => {
        const storedTheme = getStoredTheme()
        if (storedTheme) {
            return storedTheme;
        }

        return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    }

    const setTheme = theme => {
        if (theme === 'auto') {
            document.documentElement.setAttribute('data-bs-theme', (window.matchMedia(
                '(prefers-color-scheme: dark)').matches ? 'dark' : 'light'));
        } else {
            document.documentElement.setAttribute('data-bs-theme', theme);
        }
    }

    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
        const storedTheme = getStoredTheme()
        if (storedTheme !== 'light' && storedTheme !== 'dark') {
            setTheme(getPreferredTheme());
        }
    });

    (function() {
        setTheme(getPreferredTheme());
    })();
</script>
</body>

</html>
