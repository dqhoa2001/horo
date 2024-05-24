@extends('layouts.user.horoscope.app')

@section('google-tag-manager')
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-NW33V4RS');</script>
	<!-- End Google Tag Manager -->
@endsection

@section('content')
<div class="fixBg"></div>
<div id="container">
	@include('components.parts.horoscope_header')

	<main id="main">
		<section id="horoscope">
			<h1 class="logo">
				<a href="https://hoshinomai.jp/" target="_blank" rel="noopener noreferrer">
					<img src="{{ asset('horoscope/images/horoscope/h1_img.png') }}" alt="HOROSCOPE ホロスコープ" class="pc">
					<img src="{{ asset('horoscope/images/horoscope/h1_img_sp.png') }}" alt="HOROSCOPE ホロスコープ" class="sp">
				</a>
			</h1>
			<div class="content">
				<section class="topBox">
					<h2 class="headLine01">あなたの生まれた時の<br>星の配置図
						<br class="wpTag">ホロスコープを<br class="sp">作成しよう</h2>
					<p class="wpTag">生年月日・出生時間・<br class="sp">産まれた場所を入力するだけで、<br class="wpTag">あなたのホロスコープチャートを無料で<br
							class="sp">作成することができます。<br class="wpTag">ホロスコープの見方は、<br class="wpTag">書籍<a
							href="https://amzn.asia/d/amBKIvX" target="_blank" rel="noopener noreferrer">『星を使って、思い通りのわたしを生きる!』</a><br class="sp">に説明されております。<br class="pc">併せてご覧ください。</p>
				</section>
				<section class="create" id="free-horoscope">
					<h2>CREATE <br class="sp">HOROSCOPE</h2>
					<p class="topText">下記を入力して、ホロスコープを作成してください。</p>
					<div class="mailForm">
						<form action="{{ route('user.horoscopes.predict') }}" method="get">
							@csrf
							<table>
								<tr>
									<th>お名前</th>
									<td>
										<ul class="inputUl flexB">
											<li>
												@include('components.form.text', [
													'name' => 'name1',
													'required' => true,
													'placeholder' => '姓',
													])
											</li>
											<li>
												@include('components.form.text', [
													'name' => 'name2',
													'required' => true,
													'placeholder' => '名',
													])
											</li>
											@include('components.form.error', ['name' => 'name1', 'class' => 'text-danger'])
											@include('components.form.error', ['name' => 'name2', 'class' => 'text-danger'])
										</ul>
									</td>
								</tr>
								<tr class="wid01 widYear">
									<th>生年月日</th>
									<td class="C-horoscope-form-block__body" style="display: flex; {{ $errors->has('birth_day') ? ' padding-bottom: 0;' : '' }}">
											<div class="C-horoscope-form-field">
													<select class="year_input" id="select_year" name="birth_year" @change="setDay">
															<option value="">年</option>
													</select>
											</div>
											<div class="C-horoscope-form-field">
													<select class="year_input" id="select_month" name="birth_month" @change="setDay">
															<option value="">月</option>
													</select>
											</div>
											<div class="C-horoscope-form-field">
													<select class="year_input" id="select_day" name="birth_day">
															{{-- デフォルト値はjsで実装 --}}
													</select>
											</div>
									</td>
									@if($errors->has('birth_day'))
									<td>
										{{ $errors->first('birth_day') }}
									</td>
									@endif
								</tr>
								<tr class="wid01 widYear">
									<th>時刻</th>
									<td>
										<ul class="inputUl flexB">
											<li>
												@include('components.form.time', [
													'name' => 'birthday_time',
													'required' => true,
													'placeholder' => '00 : 00',
													])
												@include('components.form.error', ['name' => 'birthday_time', 'class' => 'text-danger'])
											</li>
										</ul>
									</td>
								</tr>
								<tr class="wid01 widYear">
									<th>生まれた場所</th>
									<td>
										<ul class="inputUl flexB">
											<li>
												@include('components.form.text', [
													'name' => 'birthday_prefectures',
													'required' => true,
													'placeholder' => '都道府県市区町村',
													'vInput' => 'handleInputChange',
													'value' => $request->birthday_prefectures ?? '',
												])
												@include('components.form.error', ['name' => 'birthday_prefectures', 'class' => 'text-danger'])
											</li>
										</ul>
									</td>
								</tr>
								<tr>
									<th></th>
									<td>
										<div id="map" style="height: 250px; width:100%"></div>
									</td>
								</tr>
								<tr>
									<th>経度</th>
									<td>
										<ul class="inputUl flexB">
											<li>
												<input id="map-longitude" disabled type="text" value={{ old('longitude', '138.252924') }} style="color:#a1a1a6;">
												<input id="lng" name="longitude" type="hidden" value={{ old('longitude', '138.252924') }}>
											</li>
											@error('longitude')
												<span style="color: red" class="text-danger">{{ $message }}</span>
											@enderror
										</ul>
									</td>
								</tr>
								<tr>
									<th>緯度</th>
									<td>
										<ul class="inputUl flexB">
											<li>
												<input id="map-latitude" disabled type="text"
												value={{ old('latitude', '36.204824') }} style="color:#a1a1a6;">
												<input id="lat" hidden name="latitude" type="text"
												value={{ old('latitude', '36.204824') }}>
											</li>
											@error('latitude')
												<span style="color: red" class="text-danger">{{ $message }}</span>
											@enderror
										</ul>
									</td>
								</tr>
								<tr>
									<th>タイムゾーン</th>
									<td>
										<ul class="selectUl flexB">
											<li>
												<select name="timezone">
													@foreach (Modules\Horoscope\Enums\Time::Time as $item)
													<option value='{{ $item['value'] }}' @if (old('timezone') !== null) {{ old('timezone') == $item['value'] ? 'selected' : '' }} @else {{ array_key_exists('selected', $item) ? 'selected' : '' }} @endif>
															{{ $item['label'] }}
														</option>
													@endforeach
												</select>
												<p>日本標準時がデフォルトです。出生地が海外の場合に選択してください。</p>
											</li>
											@error('timezone')
												<span style="color: red" class="text-danger">{{ $message }}</span>
											@enderror
										</ul>
									</td>
								</tr>
								<tr>
									<th class="big">ホロスコープのデザイン</th>
									<td>
										<ul class="radioUl flexB">
											<li>
												<label><input type="radio" id="normal" name="background" value="normal" {{ old('background') !== 'background' ? 'checked' : ''  }}><span
														class="wpTag">すっきりシンプルなホロスコープ</span></label>
											</li>
											<li>
												<label><input type="radio" id="background" name="background" value="background" {{ old('background') === 'background' ? 'checked' : '' }}><span
														class="wpTag">星空のイメージのホロスコープ</span></label>
											</li>
										</ul>
									</td>
								</tr>
							</table>
							<ul class="submit">
								<li>
									<input type="submit" value="ホロスコープを作成する" name="__send__">
								</li>
							</ul>
						</form>

					</div>
				</section>
			</div>
		</section>
	</main>
	@include('components.parts.horoscope_footer')

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
				let address = birthplace1;
				this.updateMapAndMarker(address);
			},
			updateMapAndMarker(address) {
				this.geocoder.geocode({ 'address': address }, (results, status) => {
					if (status === 'OK') {
						if (!this.map) {
							this.map = new google.maps.Map(document.getElementById('map'), {
								center: results[0].geometry.location,
								zoom: 9,
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
			let initialAddress = @json(old('birthday_prefectures', '東京都杉並区'));

			this.updateMapAndMarker(initialAddress);

			// 年月日を設定
			let oldYear = @json(old('birth_year'));
			let oldMonth = @json(old('birth_month'));
			let oldDay = @json(old('birth_day'));
			this.setYear(oldYear);
			this.setMonth(oldMonth);
			this.setDay(oldDay);
		},
}).mount('#free-horoscope');
</script>
@endsection
