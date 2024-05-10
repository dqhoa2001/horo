@extends('layouts.user.mypage.app')

@section('css')
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
						<section class="sec Myhoroscope Myhoroscope--create" id="myhoroscope--create">
							<h2 class="Pageframe-main__title"><img src="{{ asset('mypage/assets/images/myhoroscope/img_title.svg') }}" alt="CREATE HOROSCOPE" class="pc"><img src="{{ asset('mypage/assets/images/myhoroscope/sp_img_title.svg') }}" alt="CREATE HOROSCOPE" class="sp"></h2>
							<p class="Pageframe-main__firstmessage">{{ auth()->guard('user')->user()->name2 }}さんのホロスコープチャートを作成します。<br class="pc">{{ auth()->guard('user')->user()->name2 }}さんの出生情報を入力してください。</p>
							@include('components.parts.error')
							@if (Session::has('flash_alert'))
								<p style="color: red" >{{ Session::get('flash_alert') }}</p>
							@endif
							<div class="Pageframe-main__body">
								<div class="C-horoscope-form">
									<form action="{{ route('user.my_horoscopes.store') }}" method="POST">
										@csrf
                                        {{-- <div class="C-horoscope-form__inner">
											<dl class="C-form-block">
												<dd class="C-form-block__body">
													<div style="font-size: 12px; text-align:left;">生年月日に関して、スマートフォンをご利用の方はカレンダー左上の「年」をタップ頂ければ、生まれ年をご選択頂けます</div>
												</dd>
											</dl>
                                        </div> --}}
						
										<div class="C-horoscope-form__inner">
											<dl class="C-horoscope-form-block C-horoscope-form-block--name">
												<dt class="C-horoscope-form-block__title">お名前</dt>
												<dd class="C-horoscope-form-block__body">
													<div class="C-horoscope-form-field">{{ auth()->guard('user')->user()->name1 }} {{ auth()->guard('user')->user()->name2 }}</div>
												</dd>
											</dl>
                                            {{-- <div class="C-horoscope-form-block-wrap C-horoscope-form-block-wrap--birth">
												<dl class="C-horoscope-form-block C-horoscope-form-block--birth">
													<dt class="C-horoscope-form-block__title">生年月日</dt>
													<dd class="C-horoscope-form-block__body">
														<div class="C-horoscope-form-field">
                                                            <input type="date" name="birthday" value="{{ old('birthday') }}" required>
														</div>
													</dd>
												</dl>
												<dl class="C-horoscope-form-block C-horoscope-form-block--time">
													<dt class="C-horoscope-form-block__title">時刻</dt>
													<dd class="C-horoscope-form-block__body">
														<div class="C-horoscope-form-field">
                                                            <input type="time" name="time" value="{{ old('time') }}" required>
														</div>
													</dd>
												</dl>
											</div>
											<dl class="C-horoscope-form-block C-horoscope-form-block--half C-horoscope-form-block--pref">
												<dt class="C-horoscope-form-block__title">生まれた場所</dt>
												<dd class="C-horoscope-form-block__body">
													<div class="C-horoscope-form-field"><input type="text" id="birthday_prefectures" name="birthday_prefectures" placeholder="都道府県市区町村" value="{{ old('birthday_prefectures') }}" required @input="handleInputChange"></div>
												</dd>
											</dl> --}}
										</div>
										<div class="C-horoscope-form__inner">
                                            {{-- <dl class="C-form-block">
												<dd class="C-form-block__body C-form-block__body--half">
													<div id="map" style="height: 250px; width:250px"></div>
												</dd>
											</dl>
											<dl class="C-horoscope-form-block">
												<dd class="C-horoscope-form-block__body">
													<dt class="C-horoscope-form-block__title">経度</dt>
													<div class="C-form-block__field"><input id="map-longitude" disabled type="text" value={{ old('longitude', session('longitude')) ?? '138.252924' }}>
														<input id="lng" hidden name="longitude" type="text"
														value={{ old('longitude', session('longitude')) ?? '138.252924' }}></div>
													@error('longitude')
														<span style="color: red" class="text-danger">{{ $message }}</span>
													@enderror
													<br>
													<dt class="C-horoscope-form-block__title">緯度</dt>
													<div class="C-form-block__field"> <input id="map-latitude" disabled type="text"
														value={{ old('latitude', session('latitude')) ?? '36.204824' }}>
                                                        <input id="lat" hidden name="latitude" type="text"
														value={{ old('latitude', session('latitude')) ?? '36.204824' }}></div>
													<input id="map-city" hidden name="map-city" type="text" value="">
													@error('latitude')
														<span style="color: red" class="text-danger">{{ $message }}</span>
													@enderror    
													<br>
													<dt class="C-horoscope-form-block__title">タイムゾーン</dt>
													<div class="C-form-block__field">
														<select name="timezone"> --}}
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
                                                    <div class="C-horoscope-form-field">
                                                        <input type="time" name="time" value="{{ old('time') }}" required>
                                                    </div>
                                                </dd>
                                            </dl>
                                        </div>
                                        <div class="C-horoscope-form__inner">
                                            <dl class="C-horoscope-form-block">
                                                <dt class="C-horoscope-form-block__title">生まれた場所</dt>
                                                <dd class="C-horoscope-form-block__body">
                                                    <div class="C-horoscope-form-field">
                                                        <input type="text" id="birthday_prefectures" name="birthday_prefectures" placeholder="都道府県市区町村" value="{{ old('birthday_prefectures') }}" required @input="handleInputChange">
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
														value={{ old('longitude', session('longitude')) ?? '138.252924' }}></div>
                                                    @error('longitude')
                                                        <span style="color: red" class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <br>
                                                    <dt class="C-horoscope-form-block__title">緯度</dt>
                                                    <div class="C-form-block__field"> <input id="map-latitude" disabled type="text"
														value={{ old('latitude', session('latitude')) ?? '36.204824' }}>
                                                        <input id="lat" hidden name="latitude" type="text"
														value={{ old('latitude', session('latitude')) ?? '36.204824' }}></div>
                                                    <input id="map-city" hidden name="map-city" type="text" value="">
                                                    @error('latitude')
                                                        <span style="color: red" class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <br>
                                                    <dt class="C-horoscope-form-block__title">タイムゾーン</dt>
                                                    <div class="C-form-block__field">
                                                        <select name="timezone">
                                                            @foreach (Modules\Horoscope\Enums\Time::Time as $item)
                                                                <option value='{{ $item['value'] }}' @if (old('timezone') !== null) {{ old('timezone') == $item['value'] ? 'selected' : '' }} @else {{ array_key_exists('selected', $item) ? 'selected' : '' }} @endif>
																	{{ $item['label'] }}
																</option>
															@endforeach
                                                        {{-- </select>
													</div>
													@error('timezone')
														<span style="color: red" class="text-danger">{{ $message }}</span>
													@enderror
													<p>日本標準時がデフォルトです。出生地が海外の場合に選択してください。</p>
												</dd>
											</dl>
										</div> --}}
                                                        </select>
                                                    </div>
                                                    @error('timezone')
                                                        <span style="color: red" class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </dd>
                                            </dl>
                                        </div>
                                        <div class="C-horoscope-create flexSB">
											<button type="submit" class="Button Button--blue"><span>ホロスコープを作成する</span></button>
											<p class="C-horoscope-create__text">あなたの生まれた瞬間のホロスコープを出すためには<br class="pc">生まれた時間を「分」まで、<br>場所を「市」まで正しく入力してください。</p>
										</div>
									</form>
								</div>
							</div>
						</section>
						<!-- ***** セクション名 ***** -->
					</div>
				</div>

				@include('components.parts.footer')


			</div>

		</main>

	</div>
@endsection
@section('script')
<script>
    Vue.createApp({
        data() {
            return {
                marker: null,
                map: null,
                geocoder: new google.maps.Geocoder(),
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
                // let birthplace2 = document.getElementById('birthday_city').value;
                // let address = birthplace1 + ', ' + birthplace2;
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
            let initialAddress = '東京都杉並区';
            this.updateMapAndMarker(initialAddress);

            // 年月日を設定
            let oldYear = @json(old('birth_year', $defaultBirthDay->format('Y')));
            let oldMonth = @json(old('birth_month', $defaultBirthDay->format('m')));
            let oldDay = @json(old('birth_day', $defaultBirthDay->format('d')));
            this.setYear(oldYear);
            this.setMonth(oldMonth);
            this.setDay(oldDay);
        }
    }).mount('#myhoroscope--create');
</script>
@endsection