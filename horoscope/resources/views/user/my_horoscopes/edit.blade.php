@extends('layouts.user.mypage.app')

@section('css')
<link rel="stylesheet" href="{{ asset('mypage/assets/css/solar-return.css') }}">
<link rel="stylesheet" href="{{ asset('mypage/assets/css/myhoroscope.css') }}">
@endsection

@section('content')
<div class="Pageframe">

    @include('components.parts.side_header')


    <main class="Pageframe-main">
        @include('components.parts.top_header')
        <div class="Pageframe-main__scroll">
            <header class="Pageframe-main-header">
                <div class="Pageframe-main-header__first"><a href="{{ route('user.popup') }}">マイページ</a></div>
                <h2 class="Pageframe-main-header__pagename">MYホロスコープチャート</h2>
            </header>

            <div class="Pageframe-main__inner">
                <div class="Pageframe-main-content">
                    <!-- ***** セクション名 ***** -->
                    <section class="sec Myhoroscope--detail" id="Myhoroscope--detail">
                        <h2 class="Pageframe-main__title">
                            <img src="{{ asset('mypage/assets/images/myhoroscope/img_title-detail.svg') }}" alt="My HOROSCOPE" class="pc">
                            <img src="{{ asset('mypage/assets/images/myhoroscope/sp_img_title-detail.svg') }}" alt="My HOROSCOPE" class="sp"></h2>
                            <br>
                            <br>
                            <div class="Pageframe-main__body">
                            <div class="C-user-list">
                                <div class="C-user-list-block">
                                    <span class="C-user-list-block__inner">
                                        <h3 class="C-user-list-block__title" data-tag="Name"><span>{{ auth()->guard('user')->user()->name1 }}　{{ auth()->guard('user')->user()->name2 }}</span>さん</h3>
                                        <div class="C-user-list-block__content">
                                            <p class="C-user-list-block__item" data-tag="Birthday">{{ auth()->guard('user')->user()->birthday->format('Y / m / d') }}</p>
                                            <p class="C-user-list-block__item" data-tag="Birth Time">{{ auth()->guard('user')->user()->birthday_time->format('H : i') }}</p>
                                            <p class="C-user-list-block__item" data-tag="Location">{{ auth()->guard('user')->user()->birthday_prefectures }}</p>
                                        </div>
                                        @include('components.parts.error')
                                        @if (Session::has('flash_alert'))
                                            <p style="color: red" >{{ Session::get('flash_alert') }}</p>
                                        @endif
                                    </span>
                                </div>
                                <p class="C-user-list__change"><span>出生情報を訂正する</span></p>
                            </div>
                            {{--SolarDate Combobox--}}
                            {{-- <div id="popup-horoscope"> --}}
                                <dl class="C-form-block C-form-block--birthdata">
                                    <dd class="C-form-block__body">
                                        <dl class="C-form-block-child C-form-block--birth">
                                            {{-- <div id="popup-horoscope"> --}}
                                            <dl class="C-form-block C-form-block--birthdata">
                                                <dd class="C-form-block__body">
                                                    <dl class="C-form-block-child C-form-block--birth">
                                                    <dl class="C-form-block C-form-block--birthdata">
                                                        <dd class="C-form-block__body">
                                                            <dl class="C-form-block-child C-form-block--birth">
                                                                    <div class="div_right">
                                                                        <a href="{{route('user.my_horoscopes.edit')}}">
                                                                            <dd @if (str_contains(Request::url(), 'my_horoscopes/edit')) class="C-form-block__button active_MyHoro" @else class="C-form-block__button" @endif>
                                                                                出生図
                                                                            </dd>
                                                                        </a>
                                                                    </div>
                                                                    @include('components.parts.user.solar_return_combobox')
                                                            </dl>
                                                        </dd>
                                                    </dl>
                                                    </dl>
                                                </dd>
                                            </dl>
                                        </dl>
                                    </dd>
                                </dl>                              
                            {{-- </div> --}}
                            {{--Date information--}}
                            @if (!str_contains(Request::url(), 'my_horoscopes/edit'))
                                <div class="date-info">
                                    <p>
                                        {{$formattedAge}}
                                    </p>
                                </div>
                            @endif
                            <br>
                            <div class="C-horoscope-detail">
                                <div class="C-horoscope-detail-header">
                                    <!--<p class="C-horoscope-detail__title font">Horoscope Chart</p>-->
                                    <div class="C-horoscope-detail-horoscope">
                                        <img src="data:image/png;base64, {{ $imgBase64 }}" alt="ホロスコープ">
                                    </div>
                                </div>
                                <div class="C-horoscope-detail__inner">
                                    <div class="C-horoscope-detail__position">
                                        <p class="C-horoscope-detail__title font">Position</p>
                                        <div class="C-horoscope-detail__body">
                                            @foreach ($degreeData->get('planets') as $planet)
                                                <div class="C-horoscope-detail__position__item">
                                                    <p
                                                        class="C-horoscope-detail__position__title C-horoscope-detail__position__title--{{ $planets->where('id', $planet->get('planet_num'))->pluck('class_name')->first() }}">
                                                        <span>{{ $planets->where('id', $planet->get('planet_num'))->pluck('name')->first() }}</span></p>
                                                    <p
                                                        class="C-horoscope-detail__position__text C-horoscope-detail__position__text--{{ $zodiacs->where('id', $planet->get('zodiac_num'))->pluck('class_name')->first() }} on">
                                                        <span>{{ $zodiacs->where('id', $planet->get('zodiac_num'))->pluck('name')->first() }} {{ $planet->get('sabian_degrees_dms')->get('degrees') . '°' . $planet->get('sabian_degrees_dms')->get('minnute') . "'" . $planet->get('sabian_degrees_dms')->get('second') . '"' }}</span></p>
                                                </div>
                                            @endforeach
                                            @foreach ($degreeData->get('houses') as $house)
                                                @if ($house->get('number') == 1 or $house->get('number') == 10)
                                                    <div class="C-horoscope-detail__position__item">
                                                        <p
                                                            class="C-horoscope-detail__position__title">
                                                            <span>{{$house->get('name') }}</span></p>
                                                        <p
                                                            class="C-horoscope-detail__position__text C-horoscope-detail__position__text--{{ $zodiacs->where('id', $house->get('zodiac_num'))->pluck('class_name')->first() }} on">
                                                            <span>{{ $zodiacs->where('id', $house->get('zodiac_num'))->pluck('name')->first() }} {{ $house->get('sabian_degrees_dms')->get('degrees') . '°' . $house->get('sabian_degrees_dms')->get('minnute') . "'" . $house->get('sabian_degrees_dms')->get('second') . '"' }}</span></p>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="C-horoscope-detail__boundarie">
                                        <p class="C-horoscope-detail__title font">Boundarie</p>
                                        <div class="C-horoscope-detail__body">
                                            @foreach ($degreeData->get('houses') as $house)
                                                <div class="C-horoscope-detail__position__item">
                                                    <p class="C-horoscope-detail__boundarie__text C-horoscope-detail__boundarie--{{ $houses->where('id', $house->get('number'))->pluck('class_name')->first() }}" data-tag="{{ $houses->where('id', $house->get('number'))->pluck('name')->first() }}">
                                                        <span>{{ $zodiacs->where('id', $house->get('zodiac_num'))->pluck('name')->first() }} {{ $house->get('sabian_degrees_dms')->get('degrees') . '°' . $house->get('sabian_degrees_dms')->get('minnute') . "'" . $house->get('sabian_degrees_dms')->get('second') . '"' }}</span>
                                                    </p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- ***** セクション名 ***** -->
                </div>
            </div>

            @include('components.parts.footer')


            <!-- ***** ポップアップ ***** -->
            <section class="C-popup C-popup--horoscope">
                <div class="C-popup__inner">
                    <div class="C-popup-content">
                        <div class="C-popup-content__inner C-popup-content__scroll-inner">
                            <div class="C-horoscope-form">
                                <form action="{{ route('user.my_horoscopes.update') }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <p class="C-popup--horoscope__title">出生情報の訂正</p>
                                    <div id="popup-horoscope">
                                        <div class="C-horoscope-form__inner">
                                            {{-- <dl class="C-form-block">
                                                <dd class="C-form-block__body">
                                                    <div style="font-size: 12px; text-align:left;">生年月日に関して、スマートフォンをご利用の方はカレンダー左上の「年」をタップ頂ければ、生まれ年をご選択頂けます</div> --}}
                                            <dl class="C-horoscope-form-block C-horoscope-form-block">
                                                <dt class="C-horoscope-form-block__title">お名前</dt>
                                                <dd class="C-horoscope-form-block__body">
                                                    <div class="C-horoscope-form-field">{{ auth()->guard('user')->user()->name1 }} {{ auth()->guard('user')->user()->name2 }}</div>
                                                </dd>
                                            </dl>
                                        </div>
                                        <div class="C-horoscope-form__inner">
                                            {{-- <dl class="C-horoscope-form-block C-horoscope-form-block--name">
                                                <dt class="C-horoscope-form-block__title">お名前</dt> --}}
                                            <dl class="C-horoscope-form-block" style="margin-bottom: 30px;">
                                                <dt class="C-horoscope-form-block__title">生年月日</dt>
                                                <dd class="C-horoscope-form-block__body" style="display: flex;">
                                                    <div class="C-horoscope-form-field" style="width: calc((100% - 1rem) / 3);">
                                                        <select id="select_year" name="birth_year" @change="setDay">
                                                            <option value="">年</option>
                                                        </select>
                                                    </div>
                                                    <div class="C-horoscope-form-field" style="width: calc((100% - 1rem) / 3);">
                                                        <select id="select_month" name="birth_month" @change="setDay">
                                                            <option value="">月</option>
                                                        </select>
                                                    </div>
                                                    <div class="C-horoscope-form-field" style="width: calc((100% - 1rem) / 3);">
                                                        <select id="select_day" name="birth_day">
                                                            {{-- デフォルト値はjsで実装 --}}
                                                        </select>
                                                    </div>
                                                </dd>
                                            </dl>
                                            <dl class="C-horoscope-form-block">
                                                <dt class="C-horoscope-form-block__title">時刻</dt>
                                                <dd class="C-horoscope-form-block__body">
                                                    {{-- <div class="C-horoscope-form-field">{{ auth()->guard('user')->user()->name1 }} {{ auth()->guard('user')->user()->name2 }}</div> --}}
                                                    <div class="C-horoscope-form-field">
                                                        <input type="time" name="time" value="{{ old('time', auth()->guard('user')->user()->birthday_time->format('H:i')) }}" required>
                                                    </div>
                                                </dd>
                                            </dl>
                                            {{-- <div class="C-horoscope-form-block-wrap C-horoscope-form-block-wrap--birth">
                                                <dl class="C-horoscope-form-block C-horoscope-form-block--birth">
                                                    <dt class="C-horoscope-form-block__title">生年月日</dt>
                                                    <dd class="C-horoscope-form-block__body">
                                                        <div class="C-horoscope-form-field">
                                                            <input type="date" name="birthday" value="{{ old('birthday', auth()->guard('user')->user()->birthday->format('Y-m-d')) }}" required max="9999-12-31">
                                                        </div>
                                                    </dd>
                                                </dl>
                                                <dl class="C-horoscope-form-block C-horoscope-form-block--time">
                                                    <dt class="C-horoscope-form-block__title">時刻</dt>
                                                    <dd class="C-horoscope-form-block__body">
                                                        <div class="C-horoscope-form-field">
                                                            <input type="time" name="time" value="{{ old('time', auth()->guard('user')->user()->birthday_time->format('H:i')) }}" required>
                                                        </div>
                                                    </dd>
                                                </dl>
                                            </div>
                                            <dl class="C-horoscope-form-block C-horoscope-form-block--half C-horoscope-form-block--pref"> --}}
                                            </div>
                                            <div class="C-horoscope-form__inner">
                                                <dl class="C-horoscope-form-block">
                                                <dt class="C-horoscope-form-block__title">生まれた場所</dt>
                                                <dd class="C-horoscope-form-block__body">
                                                    <div class="C-horoscope-form-field">
                                                        <input type="text" id="birthday_prefectures" name="birthday_prefectures" placeholder="都道府県市区町村" value="{{ old('birthday_prefectures', auth()->guard('user')->user()->birthday_prefectures) }}" required @input="handleInputChange">
                                                    </div>
                                                </dd>
                                            </dl>
                                        </div>
                                        <div class="C-horoscope-form__inner">
                                            <dl class="C-form-block">
                                                <dd class="C-form-block__body C-form-block__body--half">
                                                    <div id="map" style="height: 250px; width:250px"></div>
                                                </dd>
                                            </dl>
                                            <dl class="C-horoscope-form-block">
                                                <dd class="C-horoscope-form-block__body">
                                                    <dt class="C-horoscope-form-block__title">経度</dt>
                                                    <div class="C-form-block__field"><input id="map-longitude" disabled type="text" value={{ old('longitude', session('longitude')) ?? auth()->guard('user')->user()->longitude }} style="color:#a1a1a6;">
                                                        <input id="lng" hidden name="longitude" type="text"
                                                        value={{ old('longitude', session('longitude')) ?? auth()->guard('user')->user()->longitude }}></div>
                                                    @error('longitude')
                                                        <span style="color: red" class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <br>
                                                    <dt class="C-horoscope-form-block__title">緯度</dt>
                                                    <div class="C-form-block__field"> <input id="map-latitude" disabled type="text"
                                                        value={{ old('latitude', session('latitude')) ?? auth()->guard('user')->user()->latitude }} style="color:#a1a1a6;">
                                                        <input id="lat" hidden name="latitude" type="text"
                                                        value={{ old('latitude', session('latitude')) ?? auth()->guard('user')->user()->latitude }}></div>
                                                    <input id="map-city" hidden name="map-city" type="text" value="">
                                                    @error('latitude')
                                                        <span style="color: red" class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <br>
                                                    <dt class="C-horoscope-form-block__title">タイムゾーン</dt>
                                                    <div class="C-form-block__field">
                                                        <select name="timezone">
                                                            @foreach (Modules\Horoscope\Enums\Time::Time as $item)
                                                                <option value='{{ $item['value'] }}'
                                                                @if (auth()->guard('user')->user()->timezome == $item['value'])
                                                                    selected
                                                                @endif>
                                                                    {{ $item['label'] }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @error('timezone')
                                                        <span style="color: red" class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                    <div class="C-horoscope-create">
                                        <button type="submit" class="Button Button--blue"><span>保存する</span></button>
                                        <div class="Button Button--cancel"><span>キャンセル</span></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="C-popup-close"></div>
                    </div>
                </div>
            </section>
            <!-- ***** ポップアップ ***** -->

        </div>

    </main>

</div>
@endsection
@section('script')
<script src="{{ asset('mypage/assets/plugins/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script>
    $(window).on('load',function(){
        console.log('a');
        $(".C-popup-content__inner").mCustomScrollbar({
            callbacks:{
                onTotalScroll:function(){
                $(this).addClass('end');
            },
            onScroll:function(){
                $(this).removeClass('end');
            }
        }
    });
});
</script>

<script>
    Vue.createApp({
        data() {
            return {
                marker: null,
                map: null,
                geocoder: new google.maps.Geocoder(),
                selectedSolarDate: null,
                isButtonHighlighted: true,
                isSelectBoxHighlighted: false,
                isSelectBoxDisabled: true
            }
        },
        methods: {
            setYear (oldYear) {
                let selectYear = document.getElementById('select_year');
                const year = new Date().getFullYear();
                for (let i = year; i >= 1900; i--) {
                    const option = document.createElement('option');
                    option.value = i;
                    option.text = i + '年';
                    if (i == oldYear) {
                        option.selected = true;
                    }
                    selectYear.appendChild(option);
                }
            },
            setMonth (oldMonth) {
                let selectMonth = document.getElementById('select_month');
                for (let i = 1; i <= 12; i++) {
                    const option = document.createElement('option');
                    option.value = i;
                    option.text = i + '月';
                    if (i == oldMonth) {
                        option.selected = true;
                    }
                    selectMonth.appendChild(option);
                }
            },
            setDay (oldDay) {
                let selectYear = document.getElementById('select_year');
                let selectMonth = document.getElementById('select_month');
                let selectDay = document.getElementById('select_day');
                //日の選択肢を空にする
                let children = selectDay.children
                while(children.length){
                    children[0].remove()
                }
                // 最初にplaceholderを追加
                let op = document.createElement('option');
                op.value = '';
                op.text = '日';
                selectDay.appendChild(op);

                console.log(selectYear.value);
                console.log(selectMonth.value);

                // 日を生成(動的に変える)
                if(selectYear.value !== '' &&  selectMonth.value !== ''){
                    const lastDay = new Date(selectYear.value,selectMonth.value,0).getDate()
                    for (i = 1; i <= lastDay; i++) {
                        let op = document.createElement('option');
                        op.value = i;
                        op.text = i + '日';
                        if (i == oldDay) {
                            op.selected = true;
                        }
                        selectDay.appendChild(op);
                    }
                }
            },
            handleInputChange() {
                let birthplace1 = document.getElementById('birthday_prefectures').value;
                let address = birthplace1;
                this.updateMapAndMarker(address);
            },
            updateMapAndMarker(address) {
                this.geocoder.geocode({ 'address': address }, (results, status) => {
                    if (status === 'OK') {
                        if (!this.map) {
                            this.map = new google.maps.Map(document.getElementById('map'), {
                                center: results[0].geometry.location,
                                zoom: 6,
                                mapTypeId: google.maps.MapTypeId.ROADMAP,
                                scrollwheel: false,
                                disableDoubleClickZoom: true,
                                draggable: false,
                            });
                        } else {
                            this.map.setCenter(results[0].geometry.location);
                        }

                        if (!this.marker) {
                            this.marker = new google.maps.Marker({
                                position: results[0].geometry.location,
                                map: this.map,
                                title: 'here',
                            });
                        } else {
                            this.marker.setPosition(results[0].geometry.location);
                        }

                        const changeLng = results[0].geometry.location.lng();
                        const changeLat = results[0].geometry.location.lat();
                        document.getElementById('map-longitude').value = changeLng;
                        document.getElementById('map-latitude').value = changeLat;
                        document.getElementById('lng').value = changeLng;
                        document.getElementById('lat').value = changeLat;
                    } else {
                        console.error('Geocode was not successful for the following reason: ' + status);
                    }
                });
            },
        },
        mounted() {
            // 初期住所をサーバーサイドで設定
            let initialAddress = @json($defaultAddress);
            this.updateMapAndMarker(initialAddress);

            // 年月日を設定
            let oldYear = @json(old('birth_year', $defaultBirthDay->format('Y') ?? ''));
            let oldMonth = @json(old('birth_month', $defaultBirthDay->format('m') ?? ''));
            let oldDay = @json(old('birth_day', $defaultBirthDay->format('d') ?? ''));
            this.setYear(oldYear);
            this.setMonth(oldMonth);
            this.setDay(oldDay);

            const input = document.getElementById('birthday_prefectures');
            input.addEventListener('input', this.handleInputChange);
        }
    }).mount('#popup-horoscope');
</script>
@endsection
