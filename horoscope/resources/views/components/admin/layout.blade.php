<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <!-- title -->
    @hasSection('title')
        <title>@yield('title') | サービス名</title>
    @else
        <title>管理画面（{{ config('app.env') }}）</title>
    @endif
    <!-- description -->
    @hasSection('description')
        <meta name="description" content="@yield('description')">
    @else
        <meta name="description" content="ディスクリプション">
    @endif
    <link rel="shortcut icon" href="{{ asset('images/common/favicon.ico') }}" type="image/x-icon">

    <meta name="keywords" content>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/8513c1d129.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('common/css/admin_common.css') }}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <!-- MapScripts -->
	<script src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_map_api_key') }}&language=ja&callback=initMap"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('mypage/assets/css/loading.css') }}">
    <style>
        .dataTables_wrapper .dataTables_filter {
            display: none;
        }
    </style>
</head>

<body>
    <div id="app">
        {{-- フラッシュメッセージ --}}
        @include('components.parts.flash_message')
        @auth('admin')
            <div id="sidebar">
                @include('Includes.admin.sidebar')
            </div>
            <div id="main" class="layout-navbar navbar-fixed">
                @include('Includes.admin.navbar')
                <div id="main-content">
                    {{ $slot }}
                </div>
            </div>
        @else
            <div class="layout-navbar navbar-fixed">
                @include('Includes.admin.navbar')
                <div id="main-content">
                    {{ $slot }}
                </div>
            </div>
        @endauth
    </div>

@yield('modal_area')

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://unpkg.com/vue@3"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
@yield('script')
<script>
    $(document).ready(function () {
        var table = $('#myTable').DataTable({
            "responsive": true,
            "autoWidth": false,
            "searching": false,
            "paging": false,
            "info": false,
            "ordering": false,
        });
    });
</script>
</body>

</html>
