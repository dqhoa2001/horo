@extends('layouts.user.front.app')
@section('google-tag-manager')
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-NW33V4RS');</script>
	<!-- End Google Tag Manager -->
@endsection

@section('css')
<!-- Front-design-offer -->
<link rel="stylesheet" href="{{ asset('front/assets/css/form.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/offer.css') }}">
@endsection

@section('content')
<div class="maxwidth sp_maxwidth">
	<section class="sec Offer C-form" id="offer-appraisal-apply">
		{{-- ローディングの表示 --}}
		@include('components.parts.user.loading')
		<p class="C-form__message C-form-line C-form-line--first">
			<span class="C-form__message__req">申し込み確認</span>
		</p>
		<p class="C-form-block--text">内容をご確認の上、申し込みボタンを押して進めてください。</p>

		<form method="POST" action="{{ route('user.check_payment.apply') }}" id="offer-appraisal-apply-form">
			@csrf

			<input type="hidden" name="target_type" value="{{ $data['target_type'] }}">

			{{-- 家族の場合 --}}
			@if((int)$data['target_type'] === \App\Enums\TargetType::FAMILY->value)
			<input type="hidden" name="relationship" value="{{ $data['relationship'] }}">
			<input type="hidden" name="family_name1" value="{{ $data['family_name1'] }}">
			<input type="hidden" name="family_name2" value="{{ $data['family_name2'] }}">
			@endif

			<input type="hidden" name="is_bookbinding" value="{{ $data['is_bookbinding'] }}">

			{{-- 製本 --}}
			@if((int)$data['is_bookbinding'] === \App\Models\AppraisalApply::BOOK_ENABLED)
			<input type="hidden" name="zip" value="{{ $data['zip'] }}">
			<input type="hidden" name="address" value="{{ $data['address'] }}">
			<input type="hidden" name="building" value="{{ $data['building'] }}">
			<input type="hidden" name="building_name" value="{{ $data['building_name'] }}">
			<input type="hidden" name="bookbinding_name1" value="{{ $data['bookbinding_name1'] }}">
			<input type="hidden" name="bookbinding_name2" value="{{ $data['bookbinding_name2'] }}">
			<input type="hidden" name="tel" value="{{ $data['tel'] }}">
			<input type="hidden" name="is_design" value="{{ $data['is_design'] }}">
			@endif
			<input type="hidden" name="payment_type" value="{{ $data['payment_type'] }}">
			@if($data['coupon_code'])
			<input type="hidden" name="coupon_code" value="{{ $data['coupon_code'] }}">
			@endif
			@if((int)$data['payment_type'] === \App\Models\AppraisalClaim::CREDIT)
			<input type="hidden" name="stripeToken" value="{{ $data['stripeToken'] }}">
			@endif

			<input type="hidden" name="discount_price" value="{{ $data['discount_price'] }}">
			<input type="hidden" name="total_amount" value="{{ $data['total_amount'] }}">

			<div class="C-form-block__wrap">

				<dl class="C-form-block">
					<dt class="C-form-block__title C-form-block__title--req">個人鑑定の対象者</dt>
					<dd class="C-form-block__body C-form-block-child">
						{{(int)$data['target_type'] === \App\Models\AppraisalApply::USER ? '自分' : '家族'}}
					</dd>
					@if((int)$data['target_type'] === \App\Enums\TargetType::FAMILY->value)
					<dd class="C-form-block__body">
						<dl class="C-form-block-child C-form-block--birth">
							<dt class="C-form-block__title">対象者との続柄</dt>
							<dd class="C-form-block__body C-form-block__body--half">
								{{ $data['relationship'] }}
							</dd>
						</dl>
						<dl class="C-form-block-child C-form-block--time">
							<dt class="C-form-block__title">対象者のお名前</dt>
							<dd class="C-form-block__body C-form-block__body--half">
								{{ $data['family_name1'] }}{{ $data['family_name2'] }}
							</dd>
						</dl>
					</dd>
					@endif
				</dl>

				<dl class="C-form-block C-form-block--hope">
					<dt class="C-form-block__title C-form-block__title--req">製本の希望</dt>
					<dd class="C-form-block__body">
						{{ \App\Models\AppraisalApply::getBookbindingType()[$data['is_bookbinding']] }}
					</dd>
				</dl>
				@if((int)$data['is_bookbinding'] === \App\Models\AppraisalApply::BOOK_ENABLED)
				<dl class="C-form-block C-form-block--cash">
					<dt class="C-form-block__title C-form-block__title--req">表紙のデザイン</dt>
					<dd class="C-form-block__body">
						{{ \App\Models\AppraisalApply::PDF_TYPE[$data['is_design']] }}
					</dd>
				</dl>
				<dl class="C-form-block C-form-block--cash">
					<dt class="C-form-block__title C-form-block__title--req">製本に表示するお名前</dt>
					<dd class="C-form-block__body">
						{{$data['bookbinding_name1']}} {{$data['bookbinding_name2']}}
						<p class="Personal-appraisal__notice-text">
						@php
							$design = $data["is_design"];
							$name1 = $data["bookbinding_name1"];
							$name2 = $data["bookbinding_name2"];
						@endphp
							<a href="{{ route('user.download_images.download_cover_pdf', ['design' => $design, 'name1' => $name1, 'name2' => $name2]) }}" style="font-size: 1.2rem;">
								表紙イメージはこちら
							</a>
						</p>
					</dd>
				</dl>
				<dl class="C-form-block C-form-block--sending">
					<dt class="C-form-block__title C-form-block__title--req">送付先情報</dt>
					<dd class="C-form-block__body">
						<dl class="C-form-block-child C-form-block--hasbutton C-form-block--zip">
							<dt class="C-form-block__title">郵便番号</dt>
							<dd class="C-form-block__body">
								{{ $data['zip'] }}
							</dd>
						</dl>
						<dl class="C-form-block-child C-form-block--address">
							<dt class="C-form-block__title">住所</dt>
							<dd class="C-form-block__body">
								{{ $data['address'] }}{{ $data['building'] }}
							</dd>
						</dl>
						<dl class="C-form-block-child C-form-block--name">
							<dt class="C-form-block__title">お名前</dt>
							<dd class="C-form-block__body">
								{{ $data['building_name'] }}
							</dd>
						</dl>
						<dl class="C-form-block-child C-form-block--tel">
							<dt class="C-form-block__title">電話番号</dt>
							<dd class="C-form-block__body">
								{{ $data['tel'] }}
							</dd>
						</dl>
					</dd>
				</dl>
				@endif
				<dl class="C-form-block C-form-block--cash">
					<dt class="C-form-block__title C-form-block__title--req">お支払い方法</dt>
					<dd class="C-form-block__body">
						{{\App\Models\AppraisalClaim::PAYMENT_TYPE[(int)$data['payment_type']]}}
					</dd>
				</dl>
				{{-- カードブランドとカードの最後の4桁表示 --}}
				@if((int)$data['payment_type'] === \App\Models\AppraisalClaim::CREDIT)
				<dl class="C-form-block C-form-block--card">
					<dt class="C-form-block__title C-form-block__title--req">カード情報</dt>
					<dd class="C-form-block__body">
						<dl class="C-form-block-child C-form-block--cardnumber">
							<dt class="C-form-block__title">カード番号</dt>
							<dd class="C-form-block__body">
								{{ $data['cardBrand'] }}
							</dd>
							<dd class="C-form-block__body">
								************{{ $data['last4'] }}
							</dd>
						</dl>
					</dd>
				</dl>
				@endif

				@if($data['coupon_code'])
				<dl class="C-form-block C-form-block--coupon-wrap">
					<dd class="C-form-block__body">
						<dl class="C-form-block-child C-form-block--hasbutton C-form-block--couponcode on">
							<dt class="C-form-block__title">使用するクーポン</dt>
							<dd class="C-form-block__body">
								{{ isset($data['coupon_code']) && $data['coupon_code'] ? $data['coupon_code'] : '-' }}
							</dd>
						</dl>
					</dd>
				</dl>
				@endif

				<dl class="C-price">
					<dt class="C-price__title">注文内容</dt>
					<dd class="C-price__body">
						<div class="C-price-block__wrap">
							@if ((int)$data['target_type'] === \App\Models\AppraisalApply::USER)
								<dl class="C-price-block">
									<dt class="C-price-block__title">個人鑑定</dt>
									<dd class="C-price-block__text">{{ number_format($appraisal->price) }}円</dd>
								</dl>
							@elseif ((int)$data['target_type'] === \App\Models\AppraisalApply::FAMILY)
								<dl class="C-price-block">
									<dt class="C-price-block__title">家族の個人鑑定</dt>
									<dd class="C-price-block__text">{{ number_format($appraisal->family_price) }}円</dd>
								</dl>
							@endif
							@if((int)$data['is_bookbinding'] === \App\Models\AppraisalApply::BOOK_ENABLED)
							<dl class="C-price-block">
								<dt class="C-price-block__title">製本金額 ：</dt>
								<dd class="C-price-block__text">{{ number_format($bookbinding->price) }}円</dd>
							</dl>
							{{-- <dl class="C-price-block">
								<dt class="C-price-block__title">送料 ：</dt>
								<dd class="C-price-block__text">{{ number_format(\App\Models\AppraisalClaim::SHIPPING_FEE) }}円</dd>
							</dl> --}}
							@endif
							@if($data['coupon_code'])
							<dl class="C-price-block C-price-block--minus">
								<dt class="C-price-block__title">ご紹介クーポン ：</dt>
								<dd class="C-price-block__text">- {{ number_format($data['discount_price']) }}円</dd>
							</dl>
							@endif
						</div>
						<dl class="C-price-last">
							<dt class="C-price-last__title">合計</dt>
							<dd class="C-price-last__text"><span>{{ number_format($data['total_amount']) }}</span>円</dd>
						</dl>
					</dd>
				</dl>
			</div>
			<button type="button" @click="submitForm" :disabled="isLoading" class="Button Button--lightblue"><span>申し込み</span></button>
			<button type="submit" formaction="{{ route('user.offer_appraisals.back') }}" formmethod="POST" class="previous-btn previous-btn-center">
				<span>入力内容を修正する</span>
			</button>
		</form>
	</section>
</div>

@endsection

@section('script')
<script src="{{ asset('js/map.js') }}"></script>
<script src="{{ asset('front/assets/js/jquery.autoKana.js') }}"></script>
<script src="{{ asset('front/assets/js/form.js') }}"></script>
<script>
    Vue.createApp({
        data() {
            return {
                isLoading: false
            }
        },
        methods: {
            submitForm() {
                this.isLoading = true
                document.getElementById('offer-appraisal-apply-form').submit()
            }
        }
    }).mount('#offer-appraisal-apply')
</script>
@endsection
