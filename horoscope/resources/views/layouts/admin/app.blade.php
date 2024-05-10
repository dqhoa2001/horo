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
    
    <meta name="keywords" content>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/8513c1d129.js" crossorigin="anonymous"></script>
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('images/common/favicon.ico') }}" type="image/x-icon">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @if( ! app()->environment('production'))
        {{-- 本番環境以外では必ずnoindexを付与 --}}
        <meta name="robots" content="noindex">
    @endif
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('common/css/common.css') }}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss'])
</head>
<body class="@yield('body_class')">
    <div class="@yield('wrapper_class')" id="app">
        {{-- フラッシュメッセージ --}}
        @include('components.parts.flash_message')

        @include('components.parts.admin_header')

        @if (auth()->guard('admin')->user())
            <div class="row">
                <div class="col-md-3">
                    @include('components.parts.admin.sidebar')
                </div>
                <div class="col-md-9">
                    {{-- 各ブレード読み込み --}}
                    <div id="main" class="mt-5">
                        @yield('content')
                    </div>
                </div>
            </div>
        @else
            @yield('content')
        @endif
    </div>
    @yield('modal_area')

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/vue@3"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    @yield('script')
</body>
</html>