@extends('layouts.user.mypage.app')
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
<link rel="stylesheet" href="{{ asset('mypage/assets/css/personal-solar-appraisal-form.css') }}">
@endsection

@section('content')
<div class="Pageframe">
	@include('components.parts.side_header')
	<main class="Pageframe-main">
		@include('components.parts.top_header')
		<div class="Pageframe-main__scroll">
			<header class="Pageframe-main-header">
				<div class="Pageframe-main-header__first"><a href="{{ route('user.popup') }}">マイページ</a></div>
				<h2 class="Pageframe-main-header__pagename">製本の申し込み 確認画面</h2>
			</header>
			<div class="Pageframe-main__inner">
				<div class="Pageframe-main-content">
					<section class="sec Personal-appraisal C-form" id="bookbindings-confirm">
						{{-- ローディングの表示 --}}
						@include('components.parts.user.loading')
						<p class="C-form-block--text">内容をご確認の上、申し込みボタンを押して進めてください。</p>

						<dl class="C-form-block C-form-block--hope">
							<dt class="C-form-block__title C-form-block__title--req">表紙のデザイン</dt>
							<dd class="C-form-block__body">
								<div style="display:flex; justify-content: space-between;">
									@foreach(App\Models\AppraisalApply::PDF_TYPE_SOLAR as $k => $v)
										<div style="width: calc((100% - 1.4rem) / 3); display:flex; flex-direction: column; align-items: center; border: 1px solid rgba(204,206,213,.35); border-radius: 0.6rem;">
											<!-- <img class="C-form-block__show-pdf-title{{ '4' }}" src="{{ asset('images/common/pdf-title') }}{{ '4' }}.svg" alt=""> -->
                                            <img style="width: 120px; height: 160px;" src="{{ asset('images/common/solarreturn.png') }}" alt="">
										</div>
									@endforeach
								</div>
								<p class="Personal-appraisal__notice-text"><a href="https://hoshinomai.jp/book-service" target="_blank" rel="noopener noreferrer">製本の詳細はこちら</a></p>
							</dd>
						</dl>

						<form method="POST" action="{{ route('user.solar_bookbindings.apply') }}" id="bookbindings-confirm-form">
							@csrf

							@foreach($data['select_appraisal_applies_id'] as $solar_appraisal_apply_id)
								<input type="hidden" name="select_appraisal_applies_id[]" value="{{ $solar_appraisal_apply_id }}">
							@endforeach
							@foreach($data['pdf_types'] as $appraisalId => $pdfType)
								<input type="hidden" name="pdf_types[{{ $appraisalId }}]" value="{{ $pdfType }}">
							@endforeach
							@foreach($data['bookbinding_names1'] as $personId => $bookbindingName1)
								<input type="hidden" name="bookbinding_names1[{{ $personId }}]" value="{{ $bookbindingName1 }}">
							@endforeach
							@foreach($data['bookbinding_names2'] as $personId => $bookbindingName2)
								<input type="hidden" name="bookbinding_names2[{{ $personId }}]" value="{{ $bookbindingName2 }}">
							@endforeach

							{{-- <input type="hidden" name="bookbinding_name1" value="{{ $data['bookbinding_name1'] }}">
							<input type="hidden" name="bookbinding_name2" value="{{ $data['bookbinding_name2'] }}"> --}}
							<input type="hidden" name="zip" value="{{ $data['zip'] }}">
							<input type="hidden" name="address" value="{{ $data['address'] }}">
							<input type="hidden" name="building" value="{{ $data['building'] }}">
							<input type="hidden" name="building_name" value="{{ $data['building_name'] }}">
							<input type="hidden" name="tel" value="{{ $data['tel'] }}">
							{{-- <input type="hidden" name="is_design" value="{{ $data['is_design'] }}"> --}}
							<input type="hidden" name="payment_type" value="{{ $data['payment_type'] }}">
							@if((int)$data['payment_type'] === \App\Models\AppraisalClaim::CREDIT)
								<input type="hidden" name="stripeToken" value="{{ $data['stripeToken'] }}">
							@endif
                            <input type="hidden" name="coupon_type" value="{{ $data['coupon_type'] }}">
							@if((int)$data['coupon_type'] === \App\Enums\CouponType::INTRODUCTION_COUPON->value)
                                <input type="hidden" name="coupon_code" value="{{ $data['coupon_code'] }}">
							@endif
							<input type="hidden" name="discount_price" value="{{ $data['discount_price'] ?? 0 }} ">
							<input type="hidden" name="total_amount" value="{{ $data['total_amount'] }}">
							@foreach($data['person_ids'] as $key => $personId)
								<input type="hidden" name="person_ids[]" value="{{ $personId }}">
							@endforeach

							<div class="C-form-block__wrap">
								<dl class="C-form-block C-form-block--name">
									<dt class="C-form-block__title C-form-block__title--req">製本する個人鑑定の内容</dt>
									<dd class="">
										@foreach($data['select_appraisal_applies'] as $appraisalApply)
										<p class="C-form-block__body">
											名前：{{ $appraisalApply->reference->full_name }}
										</p>
										<p class="C-form-block__body">
											出生地：{{ $appraisalApply->reference->birthday_prefectures }}<br>
										</p>
										<p class="C-form-block__body">
											生年月日：{{ $appraisalApply->reference->birthday->format('Y年m月d日') }}　出生時間：{{ $appraisalApply->reference->birthday_time->format('H:i') }}
										</p>
										<p class="C-form-block__body">
											製本の表紙：{{ App\Models\AppraisalApply::PDF_TYPE_SOLAR[$data["pdf_types"][$appraisalApply->id]] }}
										</p>
										<p class="C-form-block__body">
											製本に表示するお名前：{{$data["bookbinding_names1"][$appraisalApply->reference->id]}} {{$data["bookbinding_names2"][$appraisalApply->reference->id]}}
										</p>
										<p class="Personal-appraisal__notice-text">
										@php
											$design = $data["pdf_types"][$appraisalApply->id];
											$name1 = $data["bookbinding_names1"][$appraisalApply->reference->id];
											$name2 = $data["bookbinding_names2"][$appraisalApply->reference->id];
										@endphp
											<a href="{{ route('user.download_images.download_solar_cover_pdf', ['design' => $design, 'name1' => $name1, 'name2' => $name2]) }}" style="font-size: 1.2rem;">
												表紙イメージはこちら
											</a>
										</p>
										<hr>
										@endforeach
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

								<dl class="C-form-block C-form-block--cash">
									<dt class="C-form-block__title C-form-block__title--req">お支払い方法</dt>
									<dd class="C-form-block__body">
										{{\App\Models\AppraisalClaim::PAYMENT_TYPE[(int)$data['payment_type']]}}
									</dd>
								</dl>

								<!-- カードブランドとカードの最後の4桁表示 -->
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

								<!-- @if((int)$data['coupon_type'] === \App\Enums\CouponType::INTRODUCTION_COUPON->value)
									<dl class="C-form-block C-form-block--coupon-wrap">
										<dd class="C-form-block__body">
											<dl class="C-form-block-child C-form-block--hasbutton C-form-block--couponcode on">
												<dt class="C-form-block__title">使用するクーポンコード</dt>
												<dd class="C-form-block__body">
													{{ $data['coupon_code'] }}
												</dd>
											</dl>
										</dd>
									</dl>
								@else
									<dl class="C-form-block C-form-block--coupon-wrap">
										<dd class="C-form-block__body">
											<dl class="C-form-block-child C-form-block--hasbutton C-form-block--couponcode on">
												<dt class="C-form-block__title">使用するクーポン</dt>
												<dd class="C-form-block__body">
														{{ number_format($data['discount_price']) }}円
												</dd>
											</dl>
										</dd>
									</dl>
								@endif -->

								@switch((int)$data['coupon_type'])
                                    @case(\App\Enums\CouponType::INTRODUCTION_COUPON->value) 
                                        <dl class="C-form-block C-form-block--coupon-wrap">
                                            <dd class="C-form-block__body">
                                                <dl class="C-form-block-child C-form-block--hasbutton C-form-block--couponcode on">
                                                    <dt class="C-form-block__title">使用するクーポンコード</dt>
                                                    <dd class="C-form-block__body">
                                                        {{ $data['coupon_code'] }}
                                                    </dd>
                                                </dl>
                                            </dd>
                                        </dl>
                                        @break
                                    @case(\App\Enums\CouponType::NONE->value)
                                        <dl class="C-form-block C-form-block--coupon-wrap">
                                            <dd class="C-form-block__body">
                                                <dl class="C-form-block-child C-form-block--hasbutton C-form-block--couponcode on">
                                                    <dt class="C-form-block__title">使用するクーポン</dt>
                                                    <dd class="C-form-block__body">
                                                        使用しない
                                                    </dd>
                                                </dl>
                                            </dd>
                                        </dl>
                                        @break
                                    @default
                                        <dl class="C-form-block C-form-block--coupon-wrap">
                                            <dd class="C-form-block__body">
                                                <dl class="C-form-block-child C-form-block--hasbutton C-form-block--couponcode on">
                                                    <dt class="C-form-block__title">使用するクーポン</dt>
                                                    <dd class="C-form-block__body">
                                                        {{ number_format($data['discount_price']) }}円
                                                    </dd>
                                                </dl>
                                            </dd>
                                        </dl>
                                @endswitch

								<dl class="C-price">
									<dt class="C-price__title">注文内容</dt>
									<dd class="C-price__body">
										<div class="C-price-block__wrap">
											<dl class="C-price-block">
												<dt class="C-price-block__title">製本金額 ：</dt>
												<dd class="C-price-block__text">
													{{ number_format($bookbinding->price) }}円
												</dd>
											</dl>
											<dl class="C-price-block">
												<dt class="C-price-block__title">鑑定数 ：</dt>
												<dd class="C-price-block__text">
													{{ $data['select_appraisal_applies']->count() }}件
												</dd>
											</dl>
											@if($data['discount_price'])
											<dl class="C-price-block C-price-block--minus">
												<dt class="C-price-block__title">クーポン ：</dt>
												<dd class="C-price-block__text">- {{
													number_format($data['discount_price']) }}円</dd>
											</dl>
											@endif
										</div>
										<dl class="C-price-last">
											<dt class="C-price-last__title">合計</dt>
											<dd class="C-price-last__text">
												<span>{{ number_format($data['total_amount']) }}</span>円
											</dd>
										</dl>
									</dd>
								</dl>
							</div>
							{{-- <button type="submit" formaction="{{ route('user.bookbindings.apply') }}" formmethod="POST" class="Button Button--lightblue">
								<span>製本申し込み</span>
							</button> --}}
							<button type="button" @click="submitForm" :disabled="isLoading" class="Button Button--lightblue"><span>製本申し込み</span></button>
							<button type="submit" formaction="{{ route('user.solar_bookbindings.back') }}" formmethod="POST" class="previous-btn">
								<span>入力内容を修正する</span>
							</button>
						</form>

					</section>

				</div>
			</div>
		</div>
	</main>
</div>
@endsection
@section('script')
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
                document.getElementById('bookbindings-confirm-form').submit()
            }
        }
    }).mount('#bookbindings-confirm')
</script>
@endsection
