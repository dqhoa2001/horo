@extends('horoscope::layouts.master')

@section('content')
    <div class="predict-result">
        <h1>鑑定結果</h1>
        <div class="text-center">
            <img src="data:image/png;base64, {{ $imgBase64 }}" alt="horoscope">
        </div>
        <div class="d-flex justify-content-center my-3">
            <form action={{ route('horoscope-pdf-review') }} method="post">
                @csrf
                <input type="hidden" name="name" value="{{ $formData['name'] }}">
                <input type="hidden" name="year" value={{ $formData['year'] }}>
                <input type="hidden" name="month" value={{ $formData['month'] }}>
                <input type="hidden" name="day" value={{ $formData['day'] }}>
                <input type="hidden" name="hour" value={{ $formData['hour'] }}>
                <input type="hidden" name="minute" value={{ $formData['minute'] }}>
                <input type="hidden" name="longitude" value={{ $formData['longitude'] }}>
                <input type="hidden" name="latitude" value={{ $formData['latitude'] }}>
                <input type="hidden" name="map-city" value="{{ $formData['map-city'] }}">
                <input type="hidden" name="timezone" value={{ $formData['timezone'] }}>
                <input type="hidden" name="background" value={{ $formData['background'] }}>
                <button type="submit" class="btn btn-primary mx-3">プレビュー</button>
            </form>
            <form action={{ route('horoscope-pdf-download') }} method="post">
                @csrf
                <input type="hidden" name="name" value="{{ $formData['name'] }}">
                <input type="hidden" name="year" value={{ $formData['year'] }}>
                <input type="hidden" name="month" value={{ $formData['month'] }}>
                <input type="hidden" name="day" value={{ $formData['day'] }}>
                <input type="hidden" name="hour" value={{ $formData['hour'] }}>
                <input type="hidden" name="minute" value={{ $formData['minute'] }}>
                <input type="hidden" name="longitude" value={{ $formData['longitude'] }}>
                <input type="hidden" name="latitude" value={{ $formData['latitude'] }}>
                <input type="hidden" name="map-city" value="{{ $formData['map-city'] }}">
                <input type="hidden" name="timezone" value={{ $formData['timezone'] }}>
                <input type="hidden" name="background" value={{ $formData['background'] }}>
                <button type="submit" class="btn btn-primary mx-3">ダウンロード</button>
            </form>
        </div>

        <div class="explain-table d-flex justify-content-center">
            <table class="planet-explain border border-4 w-25">
                @foreach ($degreeData->get('planets') as $planet)
                    <tr class="border border-2 h-auto">
                        <td>
                            <p class="planet m-0 text-center">{{ $planet->get('annotation') }}</p>
                        </td>
                        <td>
                            <p class="m-0">
                                {{ $planets->where('id', $planet->get('planet_num'))->pluck('name')->first() }}</p>
                        </td>
                        <td>
                            <p class="zodiac m-0 text-center">
                                {{ $zodiacs->where('id', $planet->get('zodiac_num'))->pluck('symbol')->first() }}
                            </p>
                        </td>
                        <td>
                            <p class="m-0">
                                {{ $zodiacs->where('id', $planet->get('zodiac_num'))->pluck('name')->first() }}</p>
                        </td>
                        <td>
                            <p class="m-0 text-center">
                                {{ $planet->get('sabian_degrees_dms')->get('degrees') . '°' . $planet->get('sabian_degrees_dms')->get('minnute') . "'" . $planet->get('sabian_degrees_dms')->get('second') . '"' }}
                            </p>
                        </td>
                    </tr>
                @endforeach

            </table>
            <table class="house-explain border border-4 mx-3 my-0 " style="width: 250px">
                @foreach ($degreeData->get('houses') as $house)
                    <tr class="border border-2 h-auto">
                        <td>
                            <p class="m-0 text-center">
                                {{ $houses->where('id', $house->get('number'))->pluck('name')->first() }}
                            </p>
                        </td>
                        <td>
                            <p class="m-0 text-center">
                                {{ $zodiacs->where('id', $house->get('zodiac_num'))->pluck('name')->first() }}</p>
                        </td>
                        <td>
                            <p class="m-0 text-center">
                                {{ $house->get('sabian_degrees_dms')->get('degrees') . '°' . $house->get('sabian_degrees_dms')->get('minnute') . "'" . $house->get('sabian_degrees_dms')->get('second') . '"' }}
                            </p>
                        </td>
                    </tr>
                @endforeach
            </table>
            <table class="aspect-explain border border-4" style="width: 250px">
                @foreach ($degreeData->get('aspect_line') as $fromAspect => $aspect)
                    <tr class="border border-2 h-auto">
                        <td class="border" rowspan={{ $aspect->get('to')->count() + 1 }}>
                            <p class="m-0 text-center">
                                {{ $planets->where('id',$aspect->get('from')->first()->get('planet_num'))->pluck('name')->first() }}
                            </p>
                        </td>
                    </tr>
                    @foreach ($aspect->get('to') as $aspectTo)
                        <tr class="border border-2">
                            <td>
                                <p class="m-0 text-center">
                                    {{ $planets->where('id', $aspectTo->get('planet_num'))->pluck('name')->first() }}
                                </p>
                            </td>
                            <td>
                                <p class="m-0 text-center">
                                    {{ $aspectTo->get('case') }}
                                </p>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </table>
        </div>
    </div>
@endsection
