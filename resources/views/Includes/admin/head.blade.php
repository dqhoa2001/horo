<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="horoscope app">
<title>Horoscope - APP</title>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
{{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}" /> --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_API_key', '') }} &callback=initMap" async defer>
</script>
@stack('css-bulma')
@stack('css-field-custom')
@stack('other-css')

@vite(['resources/css/app.css', 'resources/sass/app.scss', 'resources/js/app.js'])
