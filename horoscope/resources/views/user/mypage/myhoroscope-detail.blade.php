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
						<section class="sec Myhoroscope--detail" id="Myhoroscope--detail">
							<h2 class="Pageframe-main__title"><img src="{{ asset('mypage/assets/images/myhoroscope/img_title.svg') }}" alt="CREATE HOROSCOPE" class="pc"><img src="{{ asset('mypage/assets/images/myhoroscope/sp_img_title.svg') }}" alt="CREATE HOROSCOPE" class="sp"></h2>
							<div class="Pageframe-main__body">
								<div class="C-user-list">
									<div class="C-user-list-block">
										<span class="C-user-list-block__inner">
											<h3 class="C-user-list-block__title" data-tag="Name"><span>川端 百合子</span>さん</h3>
											<div class="C-user-list-block__content">
												<p class="C-user-list-block__item" data-tag="Birthday">1960 / 4 / 10</p>
												<p class="C-user-list-block__item" data-tag="Birth Time">2 : 50</p>
												<p class="C-user-list-block__item" data-tag="Location">岐阜県 笠松町</p>
											</div>
										</span>
									</div>
									<p class="C-user-list__change"><span>出生情報を訂正する</span></p>
								</div>
								<div class="C-horoscope-detail">
									<div class="C-horoscope-detail-header">
										<!--<p class="C-horoscope-detail__title font">Horoscope Chart</p>-->
										<div class="C-horoscope-detail-horoscope"><img src="{{ asset('mypage/assets/images/dummy/dummy_horoscope-my.svg') }}" alt="ホロスコープ"></div>
									</div>
									<div class="C-horoscope-detail__inner">
										<div class="C-horoscope-detail__position">
											<p class="C-horoscope-detail__title font">Position</p>
											<div class="C-horoscope-detail__body">
												<div class="C-horoscope-detail__position__item">
													<p class="C-horoscope-detail__position__title C-horoscope-detail__position__title--taiyo"><span>太陽</span></p>
													<p class="C-horoscope-detail__position__text C-horoscope-detail__position__text--otome on"><span>乙女座  13° 15’58”</span></p>
												</div>
												<div class="C-horoscope-detail__position__item">
													<p class="C-horoscope-detail__position__title C-horoscope-detail__position__title--tsuski"><span>月</span></p>
													<p class="C-horoscope-detail__position__text C-horoscope-detail__position__text--oushi on"><span>牡牛座  25° 50’13”</span></p>
												</div>
												<div class="C-horoscope-detail__position__item">
													<p class="C-horoscope-detail__position__title C-horoscope-detail__position__title--suisei"><span>水星</span></p>
													<p class="C-horoscope-detail__position__text C-horoscope-detail__position__text--kani on"><span>蟹　座  28° 26’49”</span></p>
												</div>
												<div class="C-horoscope-detail__position__item">
													<p class="C-horoscope-detail__position__title C-horoscope-detail__position__title--kinsei"><span>金星</span></p>
													<p class="C-horoscope-detail__position__text C-horoscope-detail__position__text--ohitsuji on"><span>牡羊座  10° 26’17”</span></p>
												</div>
												<div class="C-horoscope-detail__position__item">
													<p class="C-horoscope-detail__position__title C-horoscope-detail__position__title--kasei"><span>火星</span></p>
													<p class="C-horoscope-detail__position__text C-horoscope-detail__position__text--shishi on"><span>獅子座  27° 22’03”</span></p>
												</div>
												<div class="C-horoscope-detail__position__item">
													<p class="C-horoscope-detail__position__title C-horoscope-detail__position__title--mokusei"><span>木星</span></p>
													<p class="C-horoscope-detail__position__text C-horoscope-detail__position__text--mizugame on"><span>水瓶座  08° 19’16”</span></p>
												</div>
												<div class="C-horoscope-detail__position__item">
													<p class="C-horoscope-detail__position__title C-horoscope-detail__position__title--dosei"><span>土星</span></p>
													<p class="C-horoscope-detail__position__text C-horoscope-detail__position__text--sasori on"><span>蠍　座  22° 51’53”</span></p>
												</div>
												<div class="C-horoscope-detail__position__item">
													<p class="C-horoscope-detail__position__title C-horoscope-detail__position__title--tennousei"><span>天王星</span></p>
													<p class="C-horoscope-detail__position__text C-horoscope-detail__position__text--ite on"><span>射手座  14° 02’41”</span></p>
												</div>
												<div class="C-horoscope-detail__position__item">
													<p class="C-horoscope-detail__position__title C-horoscope-detail__position__title--kaiousei"><span>海王星</span></p>
													<p class="C-horoscope-detail__position__text C-horoscope-detail__position__text--yagi on"><span>山羊座  00° 51’30”</span></p>
												</div>
												<div class="C-horoscope-detail__position__item">
													<p class="C-horoscope-detail__position__title C-horoscope-detail__position__title--meiousei"><span>冥王星</span></p>
													<p class="C-horoscope-detail__position__text C-horoscope-detail__position__text--tenbin on"><span>天秤座  02° 46’18”</span></p>
												</div>
												<div class="C-horoscope-detail__position__item">
													<p class="C-horoscope-detail__position__title C-horoscope-detail__position__title--dragonhead"><span>ドラゴンヘッド</span></p>
													<p class="C-horoscope-detail__position__text C-horoscope-detail__position__text--oushi on"><span>牡牛座  10° 48’01”</span></p>
												</div>
												<div class="C-horoscope-detail__position__item">
													<p class="C-horoscope-detail__position__title C-horoscope-detail__position__title--kiron"><span>キロン</span></p>
													<p class="C-horoscope-detail__position__text C-horoscope-detail__position__text--hutago on"><span>双子座  14° 31’36”</span></p>
												</div>
												<div class="C-horoscope-detail__position__item">
													<p class="C-horoscope-detail__position__title C-horoscope-detail__position__title--ririsu"><span>リリス</span></p>
													<p class="C-horoscope-detail__position__text C-horoscope-detail__position__text--uo on"><span>魚　座  10° 39’01”</span></p>
												</div>
											</div>
										</div>
										<div class="C-horoscope-detail__boundarie">
											<p class="C-horoscope-detail__title font">Boundarie</p>
											<div class="C-horoscope-detail__body">
												<p class="C-horoscope-detail__boundarie__text C-horoscope-detail__boundarie--ac" data-tag="AC"><span>天秤座  01° 28’12”</span></p>
												<p class="C-horoscope-detail__boundarie__text C-horoscope-detail__boundarie--2" data-tag="2ハウス"><span>天秤座  28° 31’22”</span></p>
												<p class="C-horoscope-detail__boundarie__text C-horoscope-detail__boundarie--3" data-tag="3ハウス"><span>蠍　座  29° 00’39”</span></p>
												<p class="C-horoscope-detail__boundarie__text C-horoscope-detail__boundarie--4" data-tag="4ハウス"><span>山羊座  01° 37’06”</span></p>
												<p class="C-horoscope-detail__boundarie__text C-horoscope-detail__boundarie--5" data-tag="5ハウス"><span>水瓶座  04° 12’26”</span></p>
												<p class="C-horoscope-detail__boundarie__text C-horoscope-detail__boundarie--6" data-tag="6ハウス"><span>魚座  04° 36’35”</span></p>
												<p class="C-horoscope-detail__boundarie__text C-horoscope-detail__boundarie--7" data-tag="7ハウス"><span>牡羊座  01° 28’12”</span></p>
												<p class="C-horoscope-detail__boundarie__text C-horoscope-detail__boundarie--8" data-tag="8ハウス"><span>牡羊座  28° 31’22”</span></p>
												<p class="C-horoscope-detail__boundarie__text C-horoscope-detail__boundarie--9" data-tag="9ハウス"><span>牡牛座  29° 00’39”</span></p>
												<p class="C-horoscope-detail__boundarie__text C-horoscope-detail__boundarie--mc" data-tag="MC"><span>蟹座  01° 37’06”</span></p>
												<p class="C-horoscope-detail__boundarie__text C-horoscope-detail__boundarie--11" data-tag="11ハウス"><span>獅子座  04° 12’26”</span></p>
												<p class="C-horoscope-detail__boundarie__text C-horoscope-detail__boundarie--12" data-tag="12ハウス"><span>乙女座  04° 36’35”</span></p>
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
							<div class="C-popup-content__inner">
								<div class="C-horoscope-form">
									<form>
										<p class="C-popup--horoscope__title">出生情報の訂正</p>
										<div class="C-horoscope-form__inner">
											<dl class="C-horoscope-form-block C-horoscope-form-block--name">
												<dt class="C-horoscope-form-block__title">お名前</dt>
												<dd class="C-horoscope-form-block__body">
													<div class="C-horoscope-form-field">川端 真奈美</div>
												</dd>
											</dl>
											<div class="C-horoscope-form-block-wrap C-horoscope-form-block-wrap--birth">
												<dl class="C-horoscope-form-block C-horoscope-form-block--birth">
													<dt class="C-horoscope-form-block__title">生年月日</dt>
													<dd class="C-horoscope-form-block__body">
														<div class="C-horoscope-form-field"><input type="text" name="birth" placeholder="0000/00/00" maxlength=10 inputmode="numeric"></div>
													</dd>
												</dl>
												<dl class="C-horoscope-form-block C-horoscope-form-block--time">
													<dt class="C-horoscope-form-block__title">時刻</dt>
													<dd class="C-horoscope-form-block__body">
														<div class="C-horoscope-form-field"><input type="text" name="time" placeholder="00:00" maxlength=5 inputmode="numeric"></div>
													</dd>
												</dl>
											</div>
											<dl class="C-horoscope-form-block C-horoscope-form-block--half C-horoscope-form-block--pref">
												<dt class="C-horoscope-form-block__title">生まれた場所</dt>
												<dd class="C-horoscope-form-block__body">
													<div class="C-horoscope-form-field"><input type="text" name="pref" placeholder="都道府県"></div>
													<div class="C-horoscope-form-field"><input type="text" name="address" placeholder="市区町村"></div>
												</dd>
											</dl>
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