@extends('layouts.user.mypage.app')

@section('css')
<link rel="stylesheet" href="{{ asset('mypage/assets/plugins/swiper/swiper-bundle.min.css') }}">
<link rel="stylesheet" href="{{ asset('mypage/assets/css/index.css') }}">

@endsection

@section('content')
<!-- ***** ポップアップ ***** -->
@if(auth()->guard('user')->user()->is_line_popup)
<section class="C-popup">
	<div class="C-popup__inner">
		<div class="C-popup-content">
			<div class="C-popup-content__inner">
				<h2 class="C-popup__title"><img src="{{ asset('mypage/assets/images/common/img_popup-title.svg') }}"
						alt="星の舞会員の皆さまへ"></h2>
				<figure class="C-popup__image"><img src=""
						srcset="{{ asset('mypage/assets/images/common/img_popup-line.png 1x') }}, {{ asset('mypage/assets/images/common/img_popup-line@2x.png 2x') }}"
						alt="LINE"></figure>
				<p class="C-popup__text">星の舞公式LINEにぜひご登録ください。<br>海部舞による星読みや、<br>{{ auth()->guard('user')->user()->full_name
					}}さんが占星術を学ぶにあたって大切な情報をお届けします。</p>
				<div class="C-popup-linebutton"><a href="https://lin.ee/9SizOpS" target="_blank">LINEの友達を追加する</a>
				</div>
				<div id="line_popup" class="C-popup-add-line">
					<p class="C-popup-lineadd" @click="stopLinePopup">LINEの追加をしました</p>
				</div>
				<div class="C-popup-bottom">
					<p class="C-popup-bottom__text">「LINEを追加しました」のボタンを押すと、次回から公式LINEの表示は出なくなります。</p>
				</div>
			</div>
			<div class="C-popup-close"></div>
		</div>
	</div>
</section>
@endif
<!-- ***** ポップアップ ***** -->
<div class="Pageframe">

	@include('components.parts.side_header')


	<main class="Pageframe-main">

		@include('components.parts.top_header')

		<div class="Pageframe-main__scroll">
			<header class="Pageframe-main-header">
				<div class="Pageframe-main-header__first"><a href="{{ route('user.popup') }}">マイページ</a></div>
				<h2 class="Pageframe-main-header__pagename">マイページ</h2>
			</header>
				<div class="Pageframe-main__inner">
					<div class="Pageframe-main-content">
						<section class="sec Index" id="Index">
							<h2 class="Pageframe-main__title"><img src="{{ asset('mypage/assets/images/index/img_title.svg') }}"
									alt="MYPAGE"></h2>
							<p class="Index__text">新着・おすすめコンテンツ</p>
							<div class="Index-banner-wrap">
								<div class="Index-banner swiper">
									<div class="Index-banner__inner swiper-wrapper">
                                        <figure class="Index-banner__item swiper-slide"> <a href="https://hoshinomai.jp/book-service" target="_blank" rel="noopener noreferrer"><img
											src="{{ asset('images/mypage/solarreturn01.png') }}" alt=""></a></figure>
                                        <figure class="Index-banner__item swiper-slide"> <a href="{{ route('user.solar_appraisals.index') }}" rel="noopener noreferrer"><img
											src="{{ asset('images/mypage/solarreturn02.png') }}" alt=""></a></figure>
										<figure class="Index-banner__item swiper-slide"> <a href="https://hoshinomai.jp/book-service" target="_blank" rel="noopener noreferrer"><img
											src="{{ asset('images/mypage/my-page_banner.png') }}" alt=""></a></figure>
										<figure class="Index-banner__item swiper-slide"><a href="{{ route('user.appraisals.index') }}"><img
													src="{{ asset('images/mypage/mypage1.png') }}" alt=""></a></figure>
										<figure class="Index-banner__item swiper-slide">@if (auth()->guard('user')->user()->isHasMyHoroscope())
											<a href="{{ route('user.my_horoscopes.edit') }}">
									@else
											<a href="{{ route('user.my_horoscopes.create') }}">
									@endif<img
													src="{{ asset('images/mypage/mypage2.png') }}" alt=""></a></figure>
										<figure class="Index-banner__item swiper-slide"><a href="{{ route('user.family_appraisals.index') }}"><img
													src="{{ asset('images/mypage/mypage3.png') }}" alt=""></a></figure>
										<figure class="Index-banner__item swiper-slide"><a href="{{ route('user.coupon') }}"><img
													src="{{ asset('images/mypage/mypage4.png') }}" alt=""></a></figure>

									</div>
									<div class="swiper-pagination"></div>
									<div class="swiper-button-prev"></div>
									<div class="swiper-button-next"></div>
								</div>
							</div>
						</section>
					</div>
				</div>
			@include('components.parts.footer')


	</main>

</div>
@endsection

@section('script')
<script src="{{ asset('mypage/assets/js/coupon.js') }}"></script>
<script src="{{ asset('mypage/assets/plugins/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('mypage/assets/js/index.js') }}"></script>

<script>
	Vue.createApp({
		methods: {
			stopLinePopup() {
				axios.post('stop_line_popup')
				.then((response)=>{
					console.log(response);
				})
			},
		}
	}).mount('#line_popup')
</script>
@endsection
