<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex">
    <title>{{ isset($title) ? $title : '' }}</title>

    <link rel="icon" href="{{ asset('storage/favicon.png') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('storage/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('storage/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="194x194" href="{{ asset('storage/favicon/favicon-194x194.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"
        href="{{ asset('storage/favicon/android-chrome-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('storage/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('storage/favicon/manifest.json') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    <style>
        .admin-sidebar {
            box-shadow: 10px 0px 10px #2563EB;
        }

        .admin-header {
            box-shadow: 3px 10px 10px #2563EB;
        }

        .admin-canvas {
            padding-left: 5%;
            padding-top: 5%;
        }

        .card {
            box-shadow: 5px 5px 5px rgba(37, 99, 235, 0.51);
            border-radius: 1px;
            border: 1px solid #14B8A6;
            border-radius: 1rem;
            padding: 0rem 0rem;
        }

        .card-header {
            background-color: transparent;
            border-bottom: 0px none transparent;
        }

        .header-back-button {
            width: calc(60px + 10px + 2px);
            padding-left: calc(10px + 2px);
        }

        .header-right-slot {
            width: calc(60px + 10px + 2px);
        }

        .inner-content {
            padding: 2vw 2vw;
            height: calc(84vh - 10px - 2px);
            margin-top: calc(10px + 2px);
            overflow-y: scroll
        }

        .admin-table-action-buttons * {
            display: none;
        }

        tr:hover .admin-table-action-buttons * {
            display: initial;
        }

        .admin-action-buttons-column {
            width: 180px;
            text-align: right;
        }

        tr {
            height: 60px;
        }

        tbody td {
            vertical-align: middle;
        }

        .sidebar-ul {
            list-style-type: none;
            margin: 0;
            font-size: 1.2rem;
            cursor: pointer;
            padding-right: 0;
            margin-top: 0.5vw;
        }

        .sidebar .list-group-item {
            background-color: transparent;
            color: #14B8A6;
            border-color: transparent;
        }

        .sidebar .list-group-item:not(ul) {
            height: 3vw;
        }

        .sidebar .list-group-item.selected {
background-color: #F59E0B;
            color: #F59E0B;
            border-radius: 0rem 0rem 0rem 0rem;
        }

        .sidebar ul.list-group-item {
            transition: max-height 0.5s ease-out;
            max-height: 300vh;
        }

        .sidebar ul.list-group-item:not(.open) {
            max-height: 3vw;
            overflow: hidden;
        }

        .sidebar ul.list-group-item li {
            transition: opacity 0.75s ease-out;
        }

        .sidebar ul.list-group-item:not(.open) li {
            opacity: 0;
        }

        .sidebar ul.list-group-item.open li {
            opacity: 1;
        }

        .sidebar ul.list-group-item .sidebar-ul-chevron {
            transition: transform 0.4s ease-out
        }

        .sidebar ul.list-group-item.open .sidebar-ul-chevron {
            transform: rotate(0deg)
        }

        .sidebar ul.list-group-item:not(.open) .sidebar-ul-chevron {
            transform: rotate(-90deg)
        }

        .datatable-container {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .lang-dropdown {
            border: var(--bs-border-width) solid var(--bs-border-color);
        }

        .lang-dropdown:after {
            display: none;
        }

        .lang-dropdown:hover {
            background-color: var(--bs-tertiary-bg);
            border: var(--bs-border-width) solid var(--bs-border-color);
        }

        .lang-menu .dropdown-item {
            cursor: pointer;
        }

        .lang-menu .dropdown-item.active {
            background-color: transparent;
            color: initial;
        }

        .lang-tab .detail-input {
            border-top-left-radius: 0px;
            border-bottom-left-radius: 0px;
        }
    </style>
    @stack('css')

</head>

<body style="background-color: #F4F6F8;">
    <div class="d-flex">
        <x-admin-sidebar />
        <div class="d-flex flex-column align-items-stretch" style="height: 100vh; width: 85vw;">
            <x-admin-header title="{{ isset($title) ? $title : '' }}" back="{{ isset($back) ? $back : '' }}"
                subtitle="{{ isset($subtitle) ? $subtitle : '' }}" />
            <div class="inner-content">
                {{ $slot }}
            </div>
        </div>
    </div>
    <x-admin-modal />
    @stack('modals')
    <script nonce="@nonce" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script nonce="@nonce" src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
    <script nonce="@nonce">
        (function() {
            const tables = document.querySelectorAll('.data-table');
            if (tables.length > 0) {
                new simpleDatatables.DataTable('.data-table');

                const inputs = document.querySelectorAll('.datatable-input');
                for (let i = 0; i < inputs.length; i += 1) {
                    const input = inputs[i];
                    input.classList.add('form-control');
                }

                const selects = document.querySelectorAll('.datatable-selector');
                for (let i = 0; i < selects.length; i += 1) {
                    const selectBox = selects[i];
                    selectBox.classList.add('form-select');
                }
            }
        })();

        document.addEventListener('change', function(e) {
            const previewElement = document.getElementById(`${e.target.id}-preview`);
            if (e.target.type === 'file' && previewElement) {
                const [file] = e.target.files;
                if (file) {
                    previewElement.src = URL.createObjectURL(file);
                }
            }
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('dropdown-item') && e.target.id.startsWith('pills-') && e.target.id
                .endsWith('-tab')) {
                e.target.parentElement.parentElement.previousElementSibling.innerHTML = e.target.children[0]
                    .innerHTML;
            }
        });
    </script>
    <script nonce="@nonce" src="{{ asset('/js/admin/modal.js') }}"></script>
    @stack('js')
</body>

</html>
