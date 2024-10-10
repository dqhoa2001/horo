@extends('layouts.user.horoscope.app')

@section('content')
	<div class="fixBg"></div>
	<div id="container">

		@include('components.parts.horoscope_header')


		<main id="main">
			<section id="horoscope-result">
				<h1 class="logo">
					<a href="https://hoshinomai.jp/" target="_blank" rel="noopener noreferrer">
						<img src="{{ asset('horoscope/images/horoscope/h1_img.png') }}" alt="HOROSCOPE ホロスコープ" class="pc">
						<img src="{{ asset('horoscope/images/horoscope/h1_img_sp.png') }}" alt="HOROSCOPE ホロスコープ" class="sp">
					</a>
				</h1>
				<div class="content">
					<h2 class="tk-ta-miyabi">{{ $formData['name'] }}さんの<br class="sp">出生図</h2>
					<p class="topText">{{ $formData['year'] }} 年{{ $formData['month'] }} 月{{ $formData['day'] }} 日 {{ $formData['hour'] }} 時 {{ $formData['minute'] }} 分 のホロスコープ<br class="wpTag">
						生まれた日時と場所から求めた、<br class="sp">
						その時の星の配置図です<span class="wpTag">出生地 : {{ $formData['birthday_prefectures'] }}<br class="wpTag">
						@if ($formData['longitude'] > 0)
							東経
						@else
							西経
						@endif : {{ $location->get('longitude_degree') }} 度 {{ $location->get('longitude_minute') }} 分 <br />
					   
						@if ($formData['latitude'] > 0)
							北緯
						@else
							南緯
						@endif : {{ $location->get('latitude_degree') }} 度 {{ $location->get('latitude_min') }} 分 <br />
					</p>
					<div class="whiteBg">
						<div class="phoBox">
							<h3>Horoscope</h3>
							<div class="pho" style="text-align: center"><img src="data:image/png;base64, {{ $imgBase64 }}" alt="イメージ" style="width: 100%"></div>
						</div>
						<div class="textBox flexB">
							<section class="lBox">
								<h3>Position</h3>
								<ul>
									@foreach ($degreeData->get('planets') as $planet)
										<li>
											<span class="title">
												@if ($planets->where('id', $planet->get('planet_num'))->pluck('name')->first() === '太陽')
													<img src="{{ asset('horoscope/images/horoscope/horoscope-result/title_icon01.png') }}" alt="">
												@elseif ($planets->where('id', $planet->get('planet_num'))->pluck('name')->first() === '月')
													<img src="{{ asset('horoscope/images/horoscope/horoscope-result/title_icon02.png') }}" alt="">
												@elseif ($planets->where('id', $planet->get('planet_num'))->pluck('name')->first() === '水星')
													<img src="{{ asset('horoscope/images/horoscope/horoscope-result/title_icon03.png') }}" alt="">
												@elseif ($planets->where('id', $planet->get('planet_num'))->pluck('name')->first() === '金星')
													<img src="{{ asset('horoscope/images/horoscope/horoscope-result/title_icon04.png') }}" alt="">
												@elseif ($planets->where('id', $planet->get('planet_num'))->pluck('name')->first() === '火星')
													<img src="{{ asset('horoscope/images/horoscope/horoscope-result/title_icon05.png') }}" alt="">
												@elseif ($planets->where('id', $planet->get('planet_num'))->pluck('name')->first() === '木星')
													<img src="{{ asset('horoscope/images/horoscope/horoscope-result/title_icon06.png') }}" alt="">
												@elseif ($planets->where('id', $planet->get('planet_num'))->pluck('name')->first() === '土星')
													<img src="{{ asset('horoscope/images/horoscope/horoscope-result/title_icon07.png') }}" alt="">
												@elseif ($planets->where('id', $planet->get('planet_num'))->pluck('name')->first() === '天王星')
													<img src="{{ asset('horoscope/images/horoscope/horoscope-result/icon_tennousei.svg') }}" alt="" class="title-tentai">
												@elseif ($planets->where('id', $planet->get('planet_num'))->pluck('name')->first() === '海王星')
													<img src="{{ asset('horoscope/images/horoscope/horoscope-result/title_icon09.png') }}" alt="">
												@elseif ($planets->where('id', $planet->get('planet_num'))->pluck('name')->first() === '冥王星')
													<img src="{{ asset('horoscope/images/horoscope/horoscope-result/icon_meiousei.svg') }}" alt="" class="title-tentai">
												@elseif ($planets->where('id', $planet->get('planet_num'))->pluck('name')->first() === 'ドラゴンヘッド')
													<img src="{{ asset('horoscope/images/horoscope/horoscope-result/title_icon11.png') }}" alt="">
												@elseif ($planets->where('id', $planet->get('planet_num'))->pluck('name')->first() === 'キロン')
													<img src="{{ asset('horoscope/images/horoscope/horoscope-result/title_icon12.png') }}" alt="">
												@elseif ($planets->where('id', $planet->get('planet_num'))->pluck('name')->first() === 'リリス')
													<img src="{{ asset('horoscope/images/horoscope/horoscope-result/title_icon13.png') }}" alt="">
												@endif
												{{ $planets->where('id', $planet->get('planet_num'))->pluck('name')->first() }}
											</span>
											<span class="txt">
												@if ($zodiacs->where('id', $planet->get('zodiac_num'))->pluck('class_name')->first() === 'otome')
													<img src="{{ asset('mypage/assets/images/common/icon_otome_color.svg') }}" alt="">
												@elseif ($zodiacs->where('id', $planet->get('zodiac_num'))->pluck('class_name')->first() === 'hutago')
													<img src="{{ asset('mypage/assets/images/common/icon_hutago_color.svg') }}" alt="">
												@elseif ($zodiacs->where('id', $planet->get('zodiac_num'))->pluck('class_name')->first() === 'ite')
													<img src="{{ asset('mypage/assets/images/common/icon_ite_color.svg') }}" alt="" class="ite-img">
												@elseif ($zodiacs->where('id', $planet->get('zodiac_num'))->pluck('class_name')->first() === 'mizugame')
													<img src="{{ asset('mypage/assets/images/common/icon_mizugame_color.svg') }}" alt="">
												@elseif ($zodiacs->where('id', $planet->get('zodiac_num'))->pluck('class_name')->first() === 'oushi')
													<img src="{{ asset('mypage/assets/images/common/icon_oushi_color.svg') }}" alt="">
												@elseif ($zodiacs->where('id', $planet->get('zodiac_num'))->pluck('class_name')->first() === 'sasori')
													<img src="{{ asset('mypage/assets/images/common/icon_sasori_color.svg') }}" alt="">
												@elseif ($zodiacs->where('id', $planet->get('zodiac_num'))->pluck('class_name')->first() === 'shishi')
													<img src="{{ asset('mypage/assets/images/common/icon_shishi_color.svg') }}" alt="">
												@elseif ($zodiacs->where('id', $planet->get('zodiac_num'))->pluck('class_name')->first() === 'yagi')
													<img src="{{ asset('mypage/assets/images/common/icon_yagi_color.svg') }}" alt="">
												@elseif ($zodiacs->where('id', $planet->get('zodiac_num'))->pluck('class_name')->first() === 'kani')
													<img src="{{ asset('mypage/assets/images/common/icon_kani_color.svg') }}" alt="">
												@elseif ($zodiacs->where('id', $planet->get('zodiac_num'))->pluck('class_name')->first() === 'uo')
													<img src="{{ asset('mypage/assets/images/common/icon_uo_color.svg') }}" alt="">
												@elseif ($zodiacs->where('id', $planet->get('zodiac_num'))->pluck('class_name')->first() === 'ohitsuji')
													<img src="{{ asset('mypage/assets/images/common/icon_ohitsuji_color.svg') }}" alt="">
												@elseif ($zodiacs->where('id', $planet->get('zodiac_num'))->pluck('class_name')->first() === 'tenbin')
													<img src="{{ asset('mypage/assets/images/common/icon_tenbin_color.svg') }}" alt="">
												@endif

												{{ $zodiacs->where('id', $planet->get('zodiac_num'))->pluck('name')->first() }} {{ $planet->get('sabian_degrees_dms')->get('degrees') . '°' . $planet->get('sabian_degrees_dms')->get('minnute') . "'" . $planet->get('sabian_degrees_dms')->get('second') . '"' }}
											</span>
										</li>
									@endforeach
									@foreach ($degreeData->get('houses') as $house)
										@if ($house->get('number') == 1 or $house->get('number') == 10)
											<li>
												<span class="title">
													{{$house->get('name') }}
												</span>
												<span class="txt">
													@if ($zodiacs->where('id', $house->get('zodiac_num'))->pluck('class_name')->first() === 'otome')
														<img src="{{ asset('mypage/assets/images/common/icon_otome_color.svg') }}" alt="">
													@elseif ($zodiacs->where('id', $house->get('zodiac_num'))->pluck('class_name')->first() === 'hutago')
														<img src="{{ asset('mypage/assets/images/common/icon_hutago_color.svg') }}" alt="">
													@elseif ($zodiacs->where('id', $house->get('zodiac_num'))->pluck('class_name')->first() === 'ite')
														<img src="{{ asset('mypage/assets/images/common/icon_ite_color.svg') }}" alt="">
													@elseif ($zodiacs->where('id', $house->get('zodiac_num'))->pluck('class_name')->first() === 'mizugame')
														<img src="{{ asset('mypage/assets/images/common/icon_mizugame_color.svg') }}" alt="">
													@elseif ($zodiacs->where('id', $house->get('zodiac_num'))->pluck('class_name')->first() === 'oushi')
														<img src="{{ asset('mypage/assets/images/common/icon_oushi_color.svg') }}" alt="">
													@elseif ($zodiacs->where('id', $house->get('zodiac_num'))->pluck('class_name')->first() === 'sasori')
														<img src="{{ asset('mypage/assets/images/common/icon_sasori_color.svg') }}" alt="">
													@elseif ($zodiacs->where('id', $house->get('zodiac_num'))->pluck('class_name')->first() === 'shishi')
														<img src="{{ asset('mypage/assets/images/common/icon_shishi_color.svg') }}" alt="">
													@elseif ($zodiacs->where('id', $house->get('zodiac_num'))->pluck('class_name')->first() === 'yagi')
														<img src="{{ asset('mypage/assets/images/common/icon_yagi_color.svg') }}" alt="">
													@elseif ($zodiacs->where('id', $house->get('zodiac_num'))->pluck('class_name')->first() === 'kani')
														<img src="{{ asset('mypage/assets/images/common/icon_kani_color.svg') }}" alt="">
													@elseif ($zodiacs->where('id', $house->get('zodiac_num'))->pluck('class_name')->first() === 'uo')
														<img src="{{ asset('mypage/assets/images/common/icon_uo_color.svg') }}" alt="">
													@elseif ($zodiacs->where('id', $house->get('zodiac_num'))->pluck('class_name')->first() === 'ohitsuji')
														<img src="{{ asset('mypage/assets/images/common/icon_ohitsuji_color.svg') }}" alt="">
													@elseif ($zodiacs->where('id', $house->get('zodiac_num'))->pluck('class_name')->first() === 'tenbin')
														<img src="{{ asset('mypage/assets/images/common/icon_tenbin_color.svg') }}" alt="">
													@endif

													{{ $zodiacs->where('id', $house->get('zodiac_num'))->pluck('name')->first() }} {{ $house->get('sabian_degrees_dms')->get('degrees') . '°' . $house->get('sabian_degrees_dms')->get('minnute') . "'" . $house->get('sabian_degrees_dms')->get('second') . '"' }}
												</span>
											</li>
										@endif
									@endforeach

								</ul>
							</section>
							<section class="rBox">
								<h3>Boundarie</h3>
								<ul>
									@foreach ($degreeData->get('houses') as $house)
										<li><span class="ttl">{{ $houses->where('id', $house->get('number'))->pluck('name')->first() }}</span><span class="text">{{ $zodiacs->where('id', $house->get('zodiac_num'))->pluck('name')->first() }} {{ $house->get('sabian_degrees_dms')->get('degrees') . '°' . $house->get('sabian_degrees_dms')->get('minnute') . "'" . $house->get('sabian_degrees_dms')->get('second') . '"' }}</span></li>
									@endforeach
								</ul>
							</section>
						</div>
					</div>
					<ul class="textUl">
						<li>※ハウスシステムはプラシーダスシステムを採用しています。</li>
						<li>※ノードの計算設定は「平均位置」を採用しています。</li>
						<li>※他のホロスコープ算出サイトとのズレがある場合は、こういった計算設定の違いによるものです。</li>
					</ul>

					<div class="mailForm mailFormBack">
						<ul class="submit">
							<li>
								<form action="{{ route('user.horoscopes.back') }}" method="POST">
									@csrf
									<input type="hidden" name="name1" value="{{ $formData['name1'] }}">
									<input type="hidden" name="name2" value="{{ $formData['name2'] }}">
									<input type="hidden" name="birth_year" value="{{ $formData['year'] }}">
									<input type="hidden" name="birth_month" value="{{ $formData['month'] }}">
									<input type="hidden" name="birth_day" value="{{ $formData['day'] }}">
									<input type="hidden" name="latitude" value="{{ $formData['latitude'] }}">
									<input type="hidden" name="longitude" value="{{ $formData['longitude'] }}">
									<input type="hidden" name="timezone" value="{{ $formData['timezone'] }}">
									<input type="hidden" name="birthday_time" value="{{ $formData['hour'] }}:{{ $formData['minute'] }}">
									<input type="hidden" name="birthday_prefectures" value="{{ $formData['birthday_prefectures'] }}">
									<input type="hidden" name="background" value="{{ $formData['background'] }}">
									<button type="submit" class="back">ホロスコープ作成へ戻る</button>
								</form>
							</li>
						</ul>
					</div>

				</div>
			</section>
		</main>
		@include('components.parts.horoscope_footer')
		
	</div>
	@endsection
