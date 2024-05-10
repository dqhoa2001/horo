<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Module Horoscope</title>

    {{-- Laravel Vite - CSS File --}}
    {{ module_vite('build-horoscope', 'Resources/assets/sass/app.scss') }}
    {{ module_vite('build-horoscope', 'Resources/assets/js/app.js') }}
    <link rel="stylesheet" href="{{ asset('predict.scss') }}">
    <!-- Scripts -->
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8uqcA4bO2DQO2IRfqi8PCc__dtt4tnEA&language=ja&callback=initMap"
        async defer></script>

    <style>
        #map {
            height: 500px;
            width: 500px;
        }

        @font-face {
            font-family: 'Zodiac S';
            src: url("https://db.onlinewebfonts.com/t/d0a56f97c72c0d999b89827c5bfe2264.woff")format("woff");
        }

        @font-face {
            font-family: 'astrodotbasicmedium';
            src: url('fonts/astrodotbasic-webfont.woff2') format('woff2'),
                url('fonts/astrodotbasic-webfont.woff') format('woff');
            font-weight: normal;
            font-style: normal;

        }

        @font-face {
            font-family: 'planet';
            src: url("https://db.onlinewebfonts.com/t/f49b03e1cd95150f726af35c7d3b5250.woff")format("woff");
            font-weight: normal;
            font-style: normal;
        }

        .explain-table {
            margin-bottom: 1rem;
        }

        .explain-table p {
            font-family: 'NotoSansCJKjpRegular';
            font-size: 14px;
        }

        .explain-table p.planet {
            font-family: 'planet', sans-serif;
            font-size: 25px;
            font-weight: 600;
        }

        .explain-table p.zodiac {
            font-family: "Zodiac S";
            font-size: 20px;
        }
    </style>
</head>

<body>
    @yield('content')
</body>

</html>
