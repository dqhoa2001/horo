<div class="border-card justify-content-center">
    <div class="title-card mt-2">
        <p class="planet">{{ $planetExplain->get('planet')->symbol }}</p>
        <p class="bold"> {{ $planetExplain->get('planet')->name }}―{{ $planetExplain->get('planet')->name_en }}
            幼児期から変わらない、素のあなた。 [0~7 歳]</p>
    </div>
    <div class="content-card">
        <div class="zodiac">
            <div class="zodiac-title">
                @if (config('app.locale') == 'ja')
                    <p class="bold my-0">&nbsp;&nbsp;●&nbsp; {{ $planetExplain->get('zodiac_pattern')->zodiac->name }}
                    </p>
                @else
                    <p class="bold my-0">&nbsp;&nbsp;●&nbsp; {{ $planetExplain->get('zodiac_pattern')->zodiac->name_en }}
                    </p>
                @endif

            </div>
            <div class="zodiac-content">
                @if (config('app.locale') == 'ja')
                    <p class="zodiac-content ms-2">
                        &nbsp;&nbsp;{!! nl2br ($planetExplain->get('zodiac_pattern')->content) !!}</p>
                @else
                    <p class="zodiac-content ms-2">
                        &nbsp;&nbsp;{{ $planetExplain->get('zodiac_pattern')->content_en }}</p>
                @endif
            </div>
        </div>

        <div class="house">
            <div class="house-title">
                @if (config('app.locale') == 'ja')
                    <p class="bold my-0">&nbsp;&nbsp;●&nbsp;
                        {{ $planetExplain->get('house_pattern')->house->name }}
                    </p>
                @else
                    <p class="bold my-0">&nbsp;&nbsp;●&nbsp; {{ $planetExplain->get('house_pattern')->house->name_en }}
                    </p>
                @endif

            </div>
            <div class="house-content">
                @if (config('app.locale') == 'ja')
                    <p class="house-content ms-2">
                        &nbsp;&nbsp;&nbsp;{!! nl2br ($planetExplain->get('house_pattern')->content )!!}
                    </p>
                @else
                    <p class="house-content ms-2">
                        &nbsp;&nbsp;&nbsp;{{ $planetExplain->get('house_pattern')->content_en }}
                    </p>
                @endif

            </div>
        </div>

        <div class="sabian">
            <div class="sabian-title">
                @if (config('app.locale') == 'ja')
                    <p class="bold my-0">&nbsp;&nbsp;●&nbsp;
                        {{ $planetExplain->get('planet')->name }}のサビアンシンボル―無意識的だが本質的に持っている能力や特性</p>
                @else
                    <p class="bold my-0">&nbsp;&nbsp;●&nbsp;
                        {{ $planetExplain->get('planet')->name_en }}のサビアンシンボル―無意識的だが本質的に持っている能力や特性</p>
                @endif

            </div>
            <div class="sabian-degrees-title ms-2">
                @if (config('app.locale') == 'ja')
                    <p>&nbsp;&nbsp;<ins>{{ $planetExplain->get('sabian_pattern')->zodiac->name }}
                            {{ $planetExplain->get('sabian_pattern')->sabian_degrees }}
                            {{ __('horoscope::pdf.degrees') }}「{{ $planetExplain->get('sabian_pattern')->title }}」</ins>
                    </p>
                @else
                    <p>&nbsp;&nbsp;<ins>{{ $planetExplain->get('sabian_pattern')->zodiac->name_en }}
                            {{ $planetExplain->get('sabian_pattern')->sabian_degrees }}
                            {{ __('horoscope::pdf.degrees') }}「{{ $planetExplain->get('sabian_pattern')->title_en }}」</ins>
                    </p>
                @endif

            </div>
            <div class="sabian-content">
                @if (config('app.locale') == 'ja')
                    <p class="sabian-content ms-2">
                        &nbsp;&nbsp;{!! nl2br ($planetExplain->get('sabian_pattern')->content )!!}</p>
                @else
                    <p class="sabian-content ms-2">&nbsp;&nbsp;{{ $planetExplain->get('sabian_pattern')->content_en }}
                    </p>
                @endif
            </div>
        </div>

        <div class="aspect">
            <div class="aspect-title">
                <p class="bold my-0">&nbsp;&nbsp;●他の天体との関わり</p>
            </div>
            @foreach ($planetExplain->get('aspect_pattern') as $item)
                <div class="sabian-degrees-title ms-2">
                    <p class="planet">{{ $item->fromPlanet->symbol }} {{ $item->aspect->symbol }} {{ $item->toPlanet->symbol }}</p>
                </div>
                <div class="sabian-content">
                    <p class="sabian-content ms-2">&nbsp;&nbsp;{!! nl2br  ($item->content) !!}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>
