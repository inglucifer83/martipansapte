<head>
    {{ $slot }}
    @stack('links')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root[data-bs-theme="light"] {
            --background: #F4F6F8;
            --brand: #2563EB;
            --primary: #0E2A5A;
            --secondary: #14B8A6;
            --cta: #F59E0B;
        }

        [data-bs-theme="light"] .btn-ht-primary {
            --bs-btn-font-weight: 600 !important;
            --bs-btn-color: #F4F6F8 !important;
            --bs-btn-bg: #F59E0B !important;
            --bs-btn-border-color: #F59E0B !important;
            --bs-btn-hover-color: #F4F6F8 !important;
            --bs-btn-hover-bg: #F59E0BBF !important;
            --bs-btn-hover-border-color: #F59E0BBF !important;
            --bs-btn-focus-shadow-rgb: #F59E0BBF !important;
            --bs-btn-active-color: #F4F6F8 !important;
            --bs-btn-active-bg: #F59E0BBF !important;
            --bs-btn-active-border-color: #F59E0BBF !important;
        }

        :root[data-bs-theme="dark"] {
            --background: #111111;
            --brand: #1D4ED8;
            --primary: #0A1F3D;
            --secondary: #0F766E;
            --cta: #B45309;
        }

        [data-bs-theme="dark"] .btn-ht-primary {
            --bs-btn-font-weight: 600 !important;
            --bs-btn-color: #111111 !important;
            --bs-btn-bg: #B45309 !important;
            --bs-btn-border-color: #B45309 !important;
            --bs-btn-hover-color: #111111 !important;
            --bs-btn-hover-bg: #B45309BF !important;
            --bs-btn-hover-border-color: #B45309BF !important;
            --bs-btn-focus-shadow-rgb: #B45309BF !important;
            --bs-btn-active-color: #111111 !important;
            --bs-btn-active-bg: #B45309BF !important;
            --bs-btn-active-border-color: #B45309BF !important;
        }
    </style>
    @stack('css')
</head>
