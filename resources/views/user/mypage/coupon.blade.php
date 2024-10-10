@extends('layouts.user.mypage.app')

@section('css')
<link rel="stylesheet" href="{{ asset('mypage/assets/css/coupon.css') }}">
@endsection

@section('content')
<div class="Pageframe">

	@include('components.parts.side_header')


	<main class="Pageframe-main">

		@include('components.parts.top_header')


		<div class="Pageframe-main__scroll">

			<header class="Pageframe-main-header">
				<div class="Pageframe-main-header__first"><a href="{{ route('user.popup') }}">マイページ</a></div>
				<h2 class="Pageframe-main-header__pagename">ご紹介クーポン</h2>
			</header>

			<div class="Pageframe-main__inner">
				<div class="Pageframe-main-content">
					<!-- ***** セクション名 ***** -->
					<section class="sec Coupon" id="Coupon">
						<div class="Pageframe-main__body">
							<div class="Coupon__title-wrap">
								<h2 class="Coupon__title">あなたもお友達も<br><span class="Coupon__title__price"><span
											class="Coupon__title__marker">お得な割引をゲット！!</span></span></h2>
							</div>
							<p class="Coupon__text">
								以下のクーポンコードで<br class="sp">{{ $user->full_name }}さんのお友達を紹介いただくと、<br>お友達は{{ number_format($registerCoupon->coupon_price)
								}}円引き、{{ $user->full_name }}さんには{{ number_format($registerCoupon->back_point) }}ポイント（１ポイント1円）がプレゼントとなります！<br>紹介コードを、ぜひお友達に伝えてください♪
							</p>
							<div class="Coupon-main">
								<figure class="Coupon-main__image"><img
										src="{{ asset('mypage/assets/images/coupon/img_illustration.svg') }}" alt="イラスト" class="pc"><img
										src="{{ asset('mypage/assets/images/coupon/sp_img_illustration.svg') }}" alt="イラスト" class="sp">
								</figure>
								<p class="Coupon-main__name">
									<span class="Coupon-main__name__inner">{{ $user->full_name }}さんの紹介コード</span>
									<span class="Coupon-main__name__line Coupon-main__name__line--left"></span>
									<span class="Coupon-main__name__line Coupon-main__name__line--right"></span>
								</p>
								<div class="Coupon-main-code">
									<p class="Coupon-main-code__data">
										<span class="Coupon-main-code__data__number">
											{{ $user->welcome_code }}
										</span>
										<span class="Coupon-main-code__data__copy">コピーする</span>
										<textarea class="Coupon-main-code__textarea" readOnly></textarea>
									</p>
									<div class="Button Button--green"><span class="a" id="Coupon-main-code__share">紹介コードを共有する</span></div>
									<div class="Coupon-main-code-sns no">
										<div class="Coupon-main-code-sns__item Coupon-main-code-sns__item--line"><a href="#"
												target="_blank"></a></div>
										<div class="Coupon-main-code-sns__item Coupon-main-code-sns__item--x"><a href="#"
												target="_blank"></a></div>
										<div class="Coupon-main-code-sns__item Coupon-main-code-sns__item--facebook"><a href="#"
												target="_blank"></a></div>
										<span class="Coupon-main-code-sns__copy">紹介コードを共有</span>
									</div>
								</div>
							</div>
							<div class="Coupon-bottom">
								<dl class="Coupon-bottom-block Coupon-bottom-block--friend">
									<dt class="Coupon-bottom-block__title"><span>紹介クーポンを使用されたお友達</span></dt>
									<dd class="Coupon-bottom-block__body">
										<span class="Coupon-bottom-block__tag font">Friends</span>
										<p class="Coupon-bottom-block__number" data-tag="人">{{ $usedCouponClaims->count() }}</p>
									</dd>
								</dl>
								<dl class="Coupon-bottom-block Coupon-bottom-block--coupon">
									<dt class="Coupon-bottom-block__title"><span>あなたのご紹介ポイント</span></dt>
									<dd class="Coupon-bottom-block__body">
										<span class="Coupon-bottom-block__tag font">Coupons</span>
										<p class="Coupon-bottom-block__number" data-tag="円">{{ number_format($user->point_sum) }}</p>
									</dd>
									<dd class="Coupon-history-button">紹介クーポン使用履歴</dd>
								</dl>
							</div>
							<dl class="Coupon-bottom-notice">
								<dt class="Coupon-bottom-notice__title">ポイントのご利用について</dt>
								<dd class="Coupon-bottom-notice__body">
									<ul class="Coupon-bottom-notice-list list-dot">
										<li class="Coupon-bottom-notice-list__item">個人鑑定のサービス(自分も家族も)をご購入の際、当ウェブサイト でご利用いただけます。</li>
										<li class="Coupon-bottom-notice-list__item">製本のサービスをご購入の際、当ウェブサイト でご利用いただけます。</li>
										<li class="Coupon-bottom-notice-list__item">2024年以降リリースする恒星鑑定、未来予測鑑定、相性鑑定でもご利用可能です。</li>
										<li class="Coupon-bottom-notice-list__item">今後、セミナー受講時にもポイントが使えるようになります！!</li>
									</ul>
								</dd>
							</dl>
						</div>
					</section>
					<!-- ***** セクション名 ***** -->
				</div>
			</div>

			@include('components.parts.footer')

			<section class="C-popup Coupon-history">
				<div class="C-popup__inner">
					<div class="C-popup-content">
						<h2 class="Coupon-history__title">紹介クーポン使用履歴</h2>
						<div class="C-popup-content__inner">
							@if($usedCouponClaims->isEmpty())
							<p>まだクーポンは使用されていません</p>
							@else
							<div class="Coupon-history-header">
								<p class="Coupon-history-header__title font">Day</p>
								<p class="Coupon-history-header__title font">Name</p>
							</div>
							<div class="Coupon-history__scroll {{ $usedCouponClaims->count() <=9 ? 'end' : '' }}">
								@foreach($usedCouponClaims as $appraisalClaim)
								<dl class="Coupon-history-block">
									<dt class="Coupon-history-block__title">{{ $appraisalClaim->purchase_date->format('Y/m/d') }}</dt>
									<dd class="Coupon-history-block__text">{{ $appraisalClaim->user->full_name }}</dd>
								</dl>
								@endforeach
							</div>
							@endif
						</div>
						<div class="C-popup-close"></div>
					</div>
				</div>
			</section>
			<div class="Coupon-copycomplate"><span class="Coupon-copycomplate__message">コピーしました</span></div>


		</div>

	</main>

</div>
@endsection

@section('script')

<script src="{{ asset('mypage/assets/js/coupon.js') }}"></script>
@endsection