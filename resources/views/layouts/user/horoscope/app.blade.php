<!doctype html>
<html lang="ja">
<head>
	@yield('google-tag-manager')
	<meta charset="utf-8">
	<meta name="format-detection" content="telephone=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<link rel="shortcut icon" href="{{ asset('images/common/favicon.ico') }}" type="image/x-icon">
	<link rel="apple-touch-icon" href="https://hoshinomai.jp/wp2/apple-touch-icon.png" sizes="180x180">
	<meta property="og:image" content="https://hoshinomai.jp/wp2/wp-content/themes/hoshi/img/common/ogp.jpg">
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

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

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;600;700&display=swap" rel="stylesheet">

	<!-- Styles -->
	<link rel="stylesheet" href="{{ asset('horoscope/style.css') }}">
	@yield('css')
	<!-- MapScripts -->
	<script
	src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_map_api_key') }}&language=ja&callback=initMap"></script>
	<script>
		(function(d) {
			var config = {
					kitId: 'cwo6uiq',
					scriptTimeout: 3000,
					async: true
				},
				h = d.documentElement,
				t = setTimeout(function() {
					h.className = h.className.replace(/\bwf-loading\b/g, "") + " wf-inactive";
				}, config.scriptTimeout),
				tk = d.createElement("script"),
				f = false,
				s = d.getElementsByTagName("script")[0],
				a;
			h.className += " wf-loading";
			tk.src = 'https://use.typekit.net/' + config.kitId + '.js';
			tk.async = true;
			tk.onload = tk.onreadystatechange = function() {
				a = this.readyState;
				if (f || a && a != "complete" && a != "loaded") return;
				f = true;
				clearTimeout(t);
				try {
					Typekit.load(config)
				} catch (e) {}
			};
			s.parentNode.insertBefore(tk, s)
		})(document);
	</script>
</head>
<body class="fixed">

	@yield('content')

	<script src="https://unpkg.com/vue@3"></script>
	<script src="{{ asset('horoscope/js/jquery.min.js') }}"></script>
	<script src="{{ asset('horoscope/js/common.js') }}"></script>
	@yield('script')
</body>
</html>