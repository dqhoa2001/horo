@foreach (config('language.allows') as $lang)
    <a href="{{ session('locale') == $lang ? '#' : route('change-language', ['locale' => $lang]) }}"><button
            type="text">{{ $lang }}</button></a>
@endforeach
