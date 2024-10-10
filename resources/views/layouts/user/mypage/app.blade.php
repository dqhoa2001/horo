<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	@yield('google-tag-manager')
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="{{ asset('images/common/favicon.ico') }}" type="image/x-icon">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<meta name="keywords" content>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="format-detection" content="telephone=no">
	<link rel="shortcut icon" href="{{ asset('images/common/favicon.ico') }}" type="image/x-icon">
	<link rel="apple-touch-icon" href="https://hoshinomai.jp/wp2/apple-touch-icon.png" sizes="180x180">
	<meta property="og:image" content="https://hoshinomai.jp/wp2/wp-content/themes/hoshi/img/common/ogp.jpg">
	<style>
		@font-face {
			font-family: 'zodiac';
			src: url("/fonts/AstroDotBasic.ttf");
			font-weight: normal;
		}

		.planet {
			font-family: 'zodiac';
			font-size: 25px;
			align-items: center;
		}
	</style>
	<!-- title -->
	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- description -->
	@hasSection('description')
	<meta name="description" content="@yield('description')">
	@else
	<meta name="description" content="ディスクリプション">
	@endif

	@if( ! app()->environment('production'))
	{{-- 本番環境以外では必ずnoindexを付与 --}}
	<meta name="robots" content="noindex">
	@endif

	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

	<!-- Styles -->
	<link rel="stylesheet" href="{{ asset('common/css/common.css') }}">

	<!-- MapScripts -->
	<script
	src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_map_api_key') }}&language=ja&callback=initMap"></script>
	<!-- Mypage-design-common -->
	<link rel="stylesheet" href="{{ asset('mypage/assets/css/reset.css') }}">
	<link rel="stylesheet" href="{{ asset('mypage/assets/css/class.css') }}">
	<link rel="stylesheet" href="{{ asset('mypage/assets/css/common.css') }}">
	<link rel="stylesheet" href="{{ asset('mypage/assets/plugins/lity/lity.min.css') }}">
	<link rel="stylesheet" href="{{ asset('mypage/assets/plugins/slick/slick.css') }}">
	<link rel="stylesheet" href="{{ asset('mypage/assets/plugins/slick/slick-theme.css') }}">
	<link rel="stylesheet" href="{{ asset('mypage/assets/plugins/mCustomScrollbar/jquery.mCustomScrollbar.min.css') }}">
	<link rel="stylesheet" href="{{ asset('mypage/assets/css/form.css') }}">
	<link rel="stylesheet" href="{{ asset('mypage/assets/css/loading.css') }}">
	<!-- Mypage-design -->
	@yield('css')

	<!-- Scripts -->
	@vite(['resources/js/app.js'])
</head>

<body>

    @yield('content')

	<script src="https://js.stripe.com/v3/"></script>
	<script src="https://ajaxzip3.github.io/ajaxzip3.js"></script>
	<script src="https://unpkg.com/vue@3"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('mypage/assets/js/ofi.min.js') }}"></script>
    <script src="{{ asset('mypage/assets/plugins/lity/lity.min.js') }}"></script>
    <script src="{{ asset('mypage/assets/plugins/slick/slick.min.js') }}"></script>
    <script src="{{ asset('mypage/assets/plugins/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ asset('mypage/assets/js/common.js') }}"></script>
    {{-- <script src="{{ asset('mypage/assets/js/form.js') }}"></script> --}}
	@yield('script')

</body>

</html>
