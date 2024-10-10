<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Module Horoscope</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+SC&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Alex+Brush&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Beau+Rivage&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Old+Standard+TT:ital@1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Zeyada&display=swap" rel="stylesheet">
    {{-- {{ module_vite('build-horoscope', 'Resources/views/assets/css/mydowload.css') }} --}}

    {{-- <link rel="stylesheet" href="{{ asset('/assets/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/class.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/pdf.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/pdf1.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/a4print.css') }}"> --}}

    <link rel="stylesheet" href="{{ public_path('/assets/css/reset.css') }}">
    <link rel="stylesheet" href="{{ public_path('/assets/css/class.css') }}">
    <link rel="stylesheet" href="{{ public_path('/assets/css/pdf.css') }}">
    <link rel="stylesheet" href="{{ public_path('/assets/css/pdf1.css') }}">
    <link rel="stylesheet" href="{{ public_path('/assets/css/a4print.css') }}">

</head>

<body>
    <div class="basewidth">
        @php
            $page = 1;
        @endphp
        <div class="page page0">
			<div class="page__inner">
				<div class="page0-header">
					<p class="page0-header__logo">
                        <img src="{{ public_path('/assets/images/logo1.svg') }}" alt="HOSI NO MAI">
                    </p>
					<p class="page0-header__name">HOSHI NO MAI</p>
					<p class="page0-header__name"></p>
					<p class="page0-header__catchcopy handfont1">
                        {{-- <img src="{{ public_path('/assets/images/cathcopy1.svg') }}" alt="Know the universe , Live your life"> --}}
                        <img src="{{ public_path('/assets/images/Know〜.png') }}" alt="Know the universe , Live your life">
                    </p>
				</div>
				<div class="page0-pdftitle">
                    <img src="{{ public_path('/assets/images/logo_text1.svg') }}" alt="STELLAR BLUEPRINT">
                </div>
				<div class="page0-footer">
					<p class="page0-footer__text">Blueprint of</p>
					{{-- <p class="page0-footer__text"></p> --}}
                    <p class="page0-footer__name">{{ $formData['bookbinding_name'] }}</p>
				</div>
			</div>
		</div>
    </div>

</body>

</html>
