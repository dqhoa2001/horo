<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" type="text/css" href="node_modules/datatables.net-dt/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="node_modules/datatables.net/js/jquery.dataTables.js"></script>
    <style>
        .dataTables_wrapper .dataTables_filter {
            display: none;
        }
    </style>
</head>

<body>
    <div id="app">
        {{-- @if (!empty(auth()->user())) --}}
        <div id="sidebar">
            @include('includes.sidebar')
        </div>
        <div id="main" class="layout-navbar navbar-fixed">
            @include('includes.navbar')
            <div id="main-content">
                {{ $slot }}
            </div>
        </div>
        {{-- @else
            <div>
                <div id="main-content">
                    {{ $slot }}
                </div>
            </div>
        @endif --}}
    </div>
<script>
    $(document).ready(function () {
        $(document).ready(function () {
            var table = $('#myTable').DataTable({
                "autoWidth": false,
                "responsive": true,
                "language": {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/ja.json',
                },
            });
            $('#customSearchButton').on('click', function () {
                var searchTerm = $('#customSearchInput').val();
                table.search(searchTerm).draw();
            });
        });
    });
</script>
</body>

</html>
