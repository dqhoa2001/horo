@extends('layouts.default')
@section('content')
    @php
        use App\Enums\PlanetEnum;
        use App\Enums\Zodiac;
    @endphp

    <div style="width: 960px;height:1800px; margin: 0 auto;text-align:center">
        <img src="data:image/png;base64, {{ $image }}" alt="horoscope">
        <div class="table-sabian" style="display: flex;gap:100px">
            <table>
                @foreach ($table['planets'] as $item)
                    <tr>
                        <td>
                            {{ $item['planet_name'] }}
                        </td>
                        <td>
                            {{ $item['zodiac_name'] }} {{ $item['dms'] }}
                        </td>
                    </tr>
                @endforeach

            </table>

            <table>
                @foreach ($table['houses'] as $item)
                    <tr>
                        <td>
                            {{ $item['house_num'] }}
                        </td>
                        <td>
                            {{ $item['zodiac_name'] }} {{ $item['dms'] }}
                        </td>
                    </tr>
                @endforeach

            </table>
        </div>
    </div>
@endsection
