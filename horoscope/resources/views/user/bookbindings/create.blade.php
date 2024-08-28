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
<link rel="stylesheet" href="{{ asset('mypage/assets/css/bookmaking.css') }}">
@endsection

@section('content')
<div class="Pageframe">

	@include('components.parts.side_header')


	<main class="Pageframe-main">

		@include('components.parts.top_header')

		<div id="Bookbinding-appraisal" class="Pageframe-main__scroll">

			<header class="Pageframe-main-header">
				<div class="Pageframe-main-header__first"><a href="{{ route('user.popup') }}">マイページ</a></div>
				<h2 class="Pageframe-main-header__pagename">製本 申込フォーム</h2>
			</header>

			<div class="Pageframe-main__inner">
				<div id="Bookbinding" class="Pageframe-main-content">
					<!-- ***** セクション名 ***** -->
					<section class="sec Bookmaking C-form" id="Bookmaking">
						{{-- <h2 class="Pageframe-main__title"><img src="{{ asset('mypage/assets/images/bookmaking/img_title.svg') }}"
								alt="BOOK MAKING"></h2> --}}
                        <h1 class="brand-title">STELLAR BLUEPRINT</h1>
                        <h2 class="small-pagetitle">製本化サービス 申込</h2>
						@if ($personalAppraisal !== null || $familyAppraisals->isNotEmpty())
							<p class="C-form__message">下記フォームの<span class="C-form__message__req">必須項目</span>をご記入の上、ご購入ください。</p>
							@if (Session::has('flash_alert'))
								<p style="color: red; font-size: larger;">{{ Session::get('flash_alert') }}</p>
							@endif

							@if(session('priceError'))
							<p style="color: red; font-size: 14px; margin-bottom:20px;">
								購入金額が０円です。<br>
								購入金額に誤りがないかご確認願います。<br>
								もし誤りの場合は、お手数をおかけしますが、再度製本したい方を選択しなおしてください。<br>
								下部の「注文内容」の金額が正しいかご確認ください。
							@endif

							<dl class="C-form-block C-form-block--hope">
								<dt class="C-form-block__title C-form-block__title--req">表紙のデザイン</dt>
								<dd class="C-form-block__body">
									<div style="display:flex; justify-content: space-between;">
										@foreach(App\Models\AppraisalApply::PDF_TYPE as $k => $v)
											<div style="width: calc((100% - 1.4rem) / 3); display:flex; flex-direction: column; align-items: center; border: 1px solid rgba(204,206,213,.35); border-radius: 0.6rem;">
												<img class="C-form-block__show-pdf-title{{ $loop->iteration }}" src="{{ asset('images/common/pdf-title') }}{{ $loop->iteration }}.svg" alt="">
												<img style="width: 120px; height: 160px;" src="{{ asset('images/common/pdf') }}{{ $loop->iteration }}.svg" alt="">
											</div>
										@endforeach
									</div>
									<p class="Personal-appraisal__notice-text"><a href="https://hoshinomai.jp/book-service" target="_blank" rel="noopener noreferrer">製本の詳細はこちら</a></p>
								</dd>
							</dl>

							@include('components.form.error', ['name' => 'pdf_types','class' => 'text-danger'])
							@include('components.form.error', ['name' => 'bookbinding_names','class' => 'text-danger'])

							<form id="payment-form" method="POST" action="{{ route('user.bookbindings.confirm') }}">
								@csrf
								<div class="C-form-block__wrap">

									<!-- お名前 -->
									<dl class="C-form-block C-form-block--name">
										<dt class="C-form-block__title">お名前</dt>
										<dd class="C-form-block__body">
											<p class="C-form-block--name__text">
												<span>{{ auth()->guard('user')->user()->full_name }}</span>さん<br>
												{{-- <span style="font-size: 1.4rem;">製本したい方を選択してください</span> --}}
											</p>
										</dd>
									</dl>

									<!-- 製本する個人鑑定 -->
									<dl class="C-form-block C-form-block--appraisal Bookmaking-appraisal">
										<dt class="C-form-block__title C-form-block__title--req">製本する個人鑑定</dt>
										<dd class="C-form-block__body">
											{{-- <p class="Bookmaking-appraisal__title">{{ auth()->guard('user')->user()->full_name }}さんの個人鑑定</p> --}}
											<p class="Bookmaking-appraisal__middle-title mt">製本したい人を選択してください</p>

											<hr>
											{{-- 全員 --}}
											<div class="C-form-block__checkbox original_checkbox" style="margin-bottom: 20px">
												<label class="C-form-block__checkbox__item" for="masterCheckbox">
													<input type="checkbox"
															name="master_checkbox"
															id="masterCheckbox"
															v-model="masterCheckbox">
													<span class="C-form-block__checkbox__text">
														すべて製本する
													</span>
												</label>
											</div>
											@include('components.form.error', ['name' => 'appraisal_apply_ids', 'class' => 'text-danger margin-top'])
											<hr>

											<!--製本する個人鑑定の選択-->
											<div class="original_checkbox-block">
												{{-- ----------------------個人--------------↓ --}}
												@if ($personalAppraisal !== null)
													<div class="C-form-block__checkbox original_checkbox" style="margin-bottom: 20px">
														<label class="C-form-block__checkbox__item" for="checkbox{{ $personalAppraisal->id }}">
															<input type="checkbox"
																	name="appraisal_apply_ids[]"
																	value="{{ $personalAppraisal->id }}"
																	id="checkbox{{ $personalAppraisal->id }}"
																	v-model="selectedAppraisals"
																	>
															<span class="C-form-block__checkbox__text">
																名前：{{ $personalAppraisal->reference->full_name }}
																@if ($personalBookbindingUserAppliesCount > 0)
																	<span style="color: #0069bf; margin-left: 10px;">製本注文済み</span>
																@endif
																<br>
																出生地：{{ $personalAppraisal->reference->birthday_prefectures }}<br>
																生年月日：{{ $personalAppraisal->reference->birthday->format('Y年m月d日') }}<br>
																出生時間：{{ $personalAppraisal->reference->birthday_time->format('H:i') }}<br>
															</span>
														</label>
													</div>
													<!-- ご希望の表紙デザイン -->
													<dl class="C-form-block C-form-block--cash"
														style="display: none;"
														id="pdf_dom-{{ $personalAppraisal->id }}">
														<dt class="C-form-block__title C-form-block__title--req">表紙デザイン</dt>
														<div style="display: flex; align-items:center;">
															@foreach(App\Models\AppraisalApply::PDF_TYPE as $k => $v)
															<label for="pdf_type-{{ $v }}-{{ $personalAppraisal->id }}" class="@error('pdf_types') is-invalid @enderror" style="display: flex; margin-right:10px;">
																<input type="radio"
																	name="pdf_type-{{ $personalAppraisal->id }}"
																	id="pdf_type-{{ $v }}-{{ $personalAppraisal->id }}"
																	value="{{ $k }}"
																>
																<span>{{ $v }}</span>
															</label>
															@endforeach
														</div>
													</dl>
													<!-- 製本に表示するお名前 -->
													<dl class="C-form-block C-form-block--name" style="display: none;" id="bookbinding_name_dom-{{ $personalAppraisal->id }}">
														<dt class="C-form-block__title C-form-block__title--req">表紙に表示したいお名前をご記入ください</dt>
														<div style="display: flex;">
															<p class="C-form-block--password__text" style="width: 170px;">例：Mai Kaibe　/　山田 太郎</p>
															<p class="Personal-appraisal__notice-text">
																<a href="{{ route('user.download_images.download_sample_pdf') }}" style="position: relative; top: 0.9rem;font-size: 1.2rem;">
																	表紙イメージはこちら
																</a>
															</p>
														</div>
														<dd class="C-form-block__body">
															<div class="C-form-block__field" style="display: flex;">
																<label for="bookbinding_names1[{{ $personalAppraisal->id }}]" style="width: 50px;">左側</label>
																@include('components.form.text', [
																'name' => "bookbinding_names1[$personalAppraisal->id]",
																'placeholder' => 'Mai　/　山田',
																'value' => $data['bookbinding_names1'][$personalAppraisal->id] ?? ''
																])
															</div>
															@include('components.form.error', ['name' => 'bookbinding_name1','class' => 'text-danger'])
														</dd>
														<dd class="C-form-block__body">
															<div class="C-form-block__field" style="display: flex;">
																<label for="bookbinding_names2[{{ $personalAppraisal->id }}]" style="width: 50px;">右側</label>
																@include('components.form.text', [
																'name' => "bookbinding_names2[$personalAppraisal->id]",
																'placeholder' => 'Kaibe　/　太郎',
																'value' => $data['bookbinding_names2'][$personalAppraisal->id] ?? ''
																])
															</div>
															@include('components.form.error', ['name' => 'bookbinding_name2','class' => 'text-danger'])
														</dd>
													</dl>
													<hr>
												@endif
												{{-- ----------------------個人--------------↑ --}}
												{{-- ----------------------家族--------------↓ --}}
												@if ($familyAppraisals->isNotEmpty())
													@foreach ($familyAppraisals as $familyAppraisal)
													<div class="C-form-block__checkbox original_checkbox" style="margin-bottom: 20px">
														<label class="C-form-block__checkbox__item" for="checkbox{{ $familyAppraisal->id }}">
															<input type="checkbox"
																	name="appraisal_apply_ids[]"
																	value="{{ $familyAppraisal->id }}"
																	id="checkbox{{ $familyAppraisal->id }}"
																	v-model="selectedAppraisals"
																	>
															<span class="C-form-block__checkbox__text">
																名前：{{ $familyAppraisal->reference->full_name }}
																@if ($familyBookbindingUserAppliesCount[$familyAppraisal->reference->id] > 0)
																	<span style="color: #0069bf; margin-left: 10px;">製本注文済み</span>
																@endif
																<br>
																続柄：{{ $familyAppraisal->reference->relationship }}<br>
																出生地：{{ $familyAppraisal->reference->birthday_prefectures }}<br>
																生年月日：{{ $familyAppraisal->reference->birthday->format('Y年m月d日') }}<br>
																出生時間：{{ $familyAppraisal->reference->birthday_time->format('H:i') }}<br>
															</span>
														</label>
													</div>
													<!-- ご希望の表紙デザイン -->
													<dl class="C-form-block C-form-block--cash" style="display: none;" id="pdf_dom-{{ $familyAppraisal->id }}">
														<dt class="C-form-block__title C-form-block__title--req">表紙デザイン</dt>
														<div style="display: flex; align-items:center;">
															@foreach(App\Models\AppraisalApply::PDF_TYPE as $k => $v)
															<label for="pdf_type-{{ $v }}-{{ $familyAppraisal->id }}" class="@error('pdf_types') is-invalid @enderror" style="display: flex; margin-right:10px;">
																<input type="radio"
																	name="pdf_type-{{ $familyAppraisal->id }}"
																	id="pdf_type-{{ $v }}-{{ $familyAppraisal->id }}"
																	value="{{ $k }}"
																>
																<span>{{ $v }}</span>
															</label>
															@endforeach
														</div>
													</dl>
													<!-- 製本に表示するお名前 -->
													<dl class="C-form-block C-form-block--name" style="display: none;" id="bookbinding_name_dom-{{ $familyAppraisal->id }}">
														<dt class="C-form-block__title C-form-block__title--req">表紙に表示したいお名前をご記入ください</dt>
														<div style="display: flex;">
															<p class="C-form-block--password__text" style="width: 170px;">例：Mai Kaibe　/　山田 太郎</p>
															<p class="Personal-appraisal__notice-text">
																<a href="{{ route('user.download_images.download_sample_pdf') }}" style="position: relative; top: 0.9rem;font-size: 1.2rem;">
																	表紙イメージはこちら
																</a>
															</p>
														</div>
														<dd class="C-form-block__body">
															<div class="C-form-block__field" style="display: flex;">
																<label for="bookbinding_names1[{{ $familyAppraisal->id }}]" style="width: 50px;">左側</label>
																@include('components.form.text', [
																'name' => "bookbinding_names1[$familyAppraisal->id]",
																'placeholder' => 'Mai　/　山田',
																// 'value' => $data['bookbinding_names1'] ?? ''
																])
															</div>
															@include('components.form.error', ['name' => 'bookbinding_name1','class' => 'text-danger'])
														</dd>
														<dd class="C-form-block__body">
															<div class="C-form-block__field" style="display: flex;">
																<label for="bookbinding_names2[{{ $familyAppraisal->id }}]" style="width: 50px;">右側</label>
																@include('components.form.text', [
																'name' => "bookbinding_names2[$familyAppraisal->id]",
																'placeholder' => 'Kaibe　/　太郎',
																// 'value' => $data['bookbinding_names2'] ?? ''
																])
															</div>
															@include('components.form.error', ['name' => 'bookbinding_name2','class' => 'text-danger'])
														</dd>
													</dl>
													<hr>
													@endforeach
												@endif
												{{-- ----------------------家族--------------↑ --}}

											</div>
										</dd>
									</dl>

									<!-- 送付先 -->
									<dl class="C-form-block C-form-block--sending">
										<dt class="C-form-block__title C-form-block__title--req">送付先</dt>
										<dd class="C-form-block__body">
											<dl class="C-form-block-child C-form-block--hasbutton C-form-block--zip">
												<dt class="C-form-block__title">郵便番号</dt>
												<p class="C-form-block--password__text">※数字のみを入力してください</p>
												<dd class="C-form-block__body">
													<div class="C-form-block__field">
														@include('components.form.text', [
														'name' => 'zip',
														'placeholder' => '0123456',
														'onKeyUp' => 'AjaxZip3.zip2addr(this,\'\',\'address\',\'address\');',
														'value' => $data['zip'] ?? '',
														'hyphenCheck' => true,
														])
													</div>
													@include('components.form.error', ['name' => 'zip','class' => 'text-danger'])
												</dd>
											</dl>
											<dl class="C-form-block-child C-form-block--address">
												<dt class="C-form-block__title">住所</dt>
												<dd class="C-form-block__body">
													<div class="C-form-block__field">
														@include('components.form.text', [
														'name' => 'address',
														'placeholder' => '長野県飯田市◯◯◯◯◯◯',
														'value' => $data['address'] ?? ''
														])
													</div>
													@include('components.form.error', ['name' => 'address','class' => 'text-danger'])
												</dd>
											</dl>
											<dl class="C-form-block-child C-form-block--building">
												<dt class="C-form-block__title">建物・マンション名</dt>
												<dd class="C-form-block__body">
													<div class="C-form-block__field">
														@include('components.form.text', [
														'name' => 'building',
														'placeholder' => '建物名 ◯◯号室',
														'value' => $data['building'] ?? ''
														])
													</div>
													@include('components.form.error', ['name' => 'building','class' => 'text-danger'])
												</dd>
											</dl>
											<dl class="C-form-block-child C-form-block--name">
												<dt class="C-form-block__title">お名前</dt>
												<dd class="C-form-block__body">
													<div class="C-form-block__field">
														@include('components.form.text', [
														'name' => 'building_name',
														'placeholder' => '受け取り者様のお名前を入力してください',
														'value' => $data['building_name'] ?? '',
														'autocomplete' => 'given-name'
														])
													</div>
													@include('components.form.error', ['name' => 'building_name','class' => 'text-danger'])
												</dd>
											</dl>
											<dl class="C-form-block-child C-form-block--tel">
												<dt class="C-form-block__title">電話番号</dt>
												<p class="C-form-block--password__text">※数字のみを入力してください</p>

												<dd class="C-form-block__body">
													<div class="C-form-block__field">
														@include('components.form.text', [
														'name' => 'tel',
														'placeholder' => '01234567890',
														'value' => $data['tel'] ?? '',
														'hyphenCheck' => true,
														])
													</div>
													@include('components.form.error', ['name' => 'tel','class' => 'text-danger'])
												</dd>
											</dl>
											<p class="Personal-appraisal__notice-text">
												<a href="https://hoshinomai.jp/book-service" target="_blank">製本の詳細はこちら</a>
											</p>
										</dd>
									</dl>

									<!-- お支払い方法 -->
									<dl class="C-form-block C-form-block--cash">
										<dt class="C-form-block__title C-form-block__title--req">お支払い方法</dt>
										<dd class="C-form-block__body">
											<div class="C-form-block__radio">
												@include('components.form.original_radio', [
												'name' => 'payment_type',
												'class' => 'C-form-block__radio__text',
												'data' => App\Models\AppraisalClaim::PAYMENT_TYPE,
												'vModel' => 'paymentType',
												])
											</div>
										</dd>
									</dl>
									{{-- 決済フォーム。v-ifだとフォームを再描画しないといけないのでv-showにした --}}
									<dl class="C-form-block C-form-block--cash" v-show="paymentType == '1'">
										<dt class="C-form-block__title C-form-block__title--req">クレジットカード情報</dt>
										<dd class="C-form-block__body">
											<div class="fieldset">
												<label for="image" class="ms-5">カード番号</label>
												<div id="card-number" style="border: 1px solid #ccc; padding: 10px; margin-bottom: 20px; width: 225px;"></div>
												<label for="image">有効期限</label>
												<div id="card-expiry" style="border: 1px solid #ccc; padding: 10px; margin-bottom: 20px; width: 90px;"></div>
												<label for="image">セキュリティコード</label>
												<div id="card-cvc" style="border: 1px solid #ccc; padding: 10px; margin-bottom: 20px; width: 180px;"></div>
											</div>
										</dd>
									</dl>

									<!-- クーポンの選択 -->
									<dl class="C-form-block C-form-block--coupon-wrap">
										<dd class="C-form-block__body">
											<dl class="C-form-block-child C-form-block--coupon">
												<dt class="C-form-block__title">クーポンのご利用</dt>
												<dd class="C-form-block__body">
													<div class="C-form-block__radio">
														@include('components.form.original_radio', [
															'name'     => 'coupon_type',
															'class'    => 'C-form-block__radio__text',
															'data'     => ['1' => 'ご紹介ポイントを使用', '2' => 'クーポンコードを使用', '3' => 'クーポンを使用しない'],
															'vModel'   => 'couponType',
															'onChange' => 'couponTypeChange',
														])
													</div>
												</dd>
											</dl>
											<dl class="C-form-block-child C-form-block--hasbutton C-form-block--couponno on" v-if="couponType == '1'">
												<dt class="C-form-block__title">ご紹介ポイントを使用</dt>
												<dd class="C-form-block__body">
													<div class="C-form-block__field">
														<input type="number" name="discount_price" placeholder="0000" v-model="discountPrice" onkeypress="return event.charCode >= 48 && event.charCode <= 57"><span
															class="C-form-block--couponno__tag">円</span>
													</div>
													{{-- <div class="C-form-block__button">適用する</div> --}}
													<p class="C-form-block--couponno__text"><span>あなたの現在使用可能なポイント ： <strong>{{
																number_format(auth()->guard('user')->user()->point_sum) }}円</strong></span></p>
												</dd>
											</dl>
											<dl class="C-form-block-child C-form-block--hasbutton C-form-block--couponcode on" v-else-if="couponType == '2'">
												<dt class="C-form-block__title">クーポンコードを使用</dt>
												<dd class="C-form-block__body">
													<div class="C-form-block__field">
														@include('components.form.text', [
															'name'        => 'coupon_code',
															'placeholder' => 'クーポンコード',
															'vModel'      => 'couponCode',
														])
														@include('components.form.error', ['name' => 'coupon_code','class' => 'text-danger'])
													</div>
													<div class="C-form-block__button" @click="dicountTotalPlace">適用する</div>
													<ul class="C-form-block--couponcode-list list-dot">
														<li class="C-form-block--couponcode-list__item">お友達の紹介クーポンコードをご存知の方は入力してください。</li>
														<li class="C-form-block--couponcode-list__item">一度に使用できるのは1つのみです。</li>
													</ul>
												</dd>
											</dl>
											<dl class="C-form-block-child C-form-block--hasbutton C-form-block--couponno on" v-else>
												<input type="hidden" name="discount_price" placeholder="0000" v-model="discountPrice" onkeypress="return event.charCode >= 48 && event.charCode <= 57"><span
													class="C-form-block--couponno__tag">円</span>
											</dl>
										</dd>
									</dl>

									<!-- 注文内容 -->
									<dl class="C-price">
										<dt class="C-price__title">注文内容</dt>
										<dd class="C-price__body">
											<div class="C-price-block__wrap">
												<dl class="C-price-block">
													<dt class="C-price-block__title">製本金額 ：</dt>
													<dd class="C-price-block__text">{{ number_format($bookbinding->price) }}円</dd>
												</dl>
												<dl class="C-price-block">
													<dt class="C-price-block__title">製本数 ：</dt>
													<dd class="C-price-block__text">@{{ selectedAppraisals.length }}件</dd>
												</dl>
												{{-- <dl class="C-price-block">
													<dt class="C-price-block__title">送料 ：</dt>
													<dd class="C-price-block__text">{{ number_format(\App\Models\AppraisalClaim::SHIPPING_FEE) }}円
													</dd>
												</dl> --}}
												<dl class="C-price-block C-price-block--minus">
													<dt class="C-price-block__title">ご紹介クーポン ：</dt>
													<dd class="C-price-block__text">- @{{ discountPrice.toLocaleString() }}円</dd>
												</dl>
											</div>
											<dl class="C-price-last">
												<dt class="C-price-last__title">合計</dt>
												<dd class="C-price-last__text">
													<span v-if="isCalculating">計算中...</span>
													<span v-else>@{{ totalAmount.toLocaleString() }}</span>円
												</dd>
											</dl>
											<input type="hidden" name="total_amount" v-model="totalAmount">
											<input type="hidden" name="discount_price" v-model="discountPrice">
										</dd>
									</dl>
								</div>

								<dl class="C-form-notice C-form-line C-form-line--last">
									<dt class="C-form-notice__title">購入時の注意事項</dt>
									<dd class="C-form-notice__inner">
										<div class="C-form-notice-content">
											<ul class="C-form-notice-content-list">
												<li class="C-form-notice-list__item">システムによるエラーや乱丁・落丁はお取替えいたしますが、お客様の出生情報入力ミスによるものは修正・返品ができません。別途製本費用をお支払いいただき作り直しになりますので、あらかじめご了承ください。</li>
											</ul>
										</div>
										<div class="C-form-policy">
										<div class="C-form-policy__inner">
											<div class="C-form-policy-block">
												<div class="C-form-block__checkbox">
													<label class="C-form-block__checkbox__item">
														<input type="checkbox" name="consent" value="購入時の注意事項を確認しました。">
														<span class="C-form-block__checkbox__text">購入時の注意事項を確認しました。</span>
													</label>
													<div style="text-align: left">
														@include('components.form.error', ['name' => 'consent'])
													</div>
												</div>
											</div>
										</div>
										</div>
									</dd>
								</dl>

								<div class="C-form-policy">
									<div class="C-form-policy__inner">
										<div class="C-form-policy-block">
											<div class="C-form-block__checkbox">
												<label class="C-form-block__checkbox__item">
													<input type="checkbox" required>
													<span class="C-form-block__checkbox__text"><a href="https://hoshinomai.jp/terms-of-use/" target="_blank">利用規約</a>を確認しました。</span>
												</label>
											</div>
										</div>
										<div class="C-form-policy-block">
											<div class="C-form-block__checkbox">
												<label class="C-form-block__checkbox__item">
													<input type="checkbox" required>
													<span class="C-form-block__checkbox__text"><a href="https://hoshinomai.jp/privacy"
															target="_blank">個人情報保護方針</a>を確認しました。</span>
												</label>
											</div>
										</div>
									</div>
								</div>

								<button type="submit" class="Button Button--lightblue">
									<span>申し込み内容を確認する</span>
								</button>
							</form>
						@else
							<p class="C-form__message">個人または家族の鑑定がまだ登録されていません。</p>
						@endif
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
<script src="https://ajaxzip3.github.io/ajaxzip3.js"></script>
<script src="{{ asset('mypage/assets/js/bookmaiking.js') }}"></script>
<script>
Vue.createApp({
	data() {
		return {
            paymentType: @json(old('payment_type', $request->payment_type ?? App\Models\AppraisalClaim::CREDIT)),
            isCalculating: false,
						masterCheckbox: false,
						personalAppraisal: @json($personalAppraisal),
						familyAppraisals: @json($familyAppraisals->values()->all()),
						bookbindingPrice: @json($bookbinding->price),
						selectedAppraisals: @json(old('appraisal_apply_ids', $request->appraisal_apply_ids ?? [])),
            // shippingFee: @json(\App\Models\AppraisalClaim::SHIPPING_FEE),
            // totalAmount : @json(intval(old('total_amount', $request->total_amount ?? $bookbinding->price + \App\Models\AppraisalClaim::SHIPPING_FEE))),
            totalAmount : @json(intval(old('total_amount', $request->total_amount ?? 0))),
            discountPrice: @json(intval(old('discount_price', $request->discount_price ?? 0))),
            previouesDiscountPrice: '',
            point: @json(auth()->guard('user')->user()->point_sum),
            families: @json(auth()->guard('user')->user()->families()->get()),
            couponType: @json(old('coupon_type', $request->coupon_type ?? App\Enums\CouponType::BACK_COUPON->value)),
            couponCode: @json(old('coupon_code', $request->coupon_code ?? '')),
		}
	},
	methods: {
		dicountTotalPlace(){
				this.discountPrice = 0;
				if(this.couponCode === ''){
						alert('クーポンコードを入力してください。');
						return;
				}
				this.isCalculating = true;

				//すでに値引きがあれば、2重値引きしないように値引きを戻す
				if (this.couponCode !== '' && this.discountPrice !== '') {
						this.totalAmount = this.totalAmount + this.discountPrice;
				}

				//クーポンコードから、値引額を取得する
				axios.post('/api/coupon/get_discount_price', {
						params: {
								coupon_code: this.couponCode,
			request_type: 'bookbinding',
			user_id: '{{ auth()->guard('user')->user()->id }}',
						}
				})
				.then((response) => {
						if(response.data.discount_price){
								this.discountPrice = response.data.discount_price;
						}
						else{
								alert(response.data.message)
						}
				})
				.catch((error) => {
						console.log(error);
				});

				setTimeout(() => {
						this.isCalculating = false;
				}, 1000);
		},
		//クーポンの種類が変更されたら、値引き額やクーポンコードをリセットする
		couponTypeChange(){
				this.discountPrice = 0;
				this.couponCode = '';
		},
		// すべてのチェックボックスのIDを取得する
		getAllAppraisalIds() {
			const allAppraisalIds = [];
			// 個人のチェックボックス
			if (this.personalAppraisal !== null) {
				allAppraisalIds.push(this.personalAppraisal.id);
                console.log(this.personalAppraisal.id);
			}
			// 家族のチェックボックス
			if (this.familyAppraisals.length > 0) {
				allAppraisalIds.push(...this.familyAppraisals.map(appraisal => appraisal.id));
			}

			return allAppraisalIds;
		},
	},
	// 合計金額計算監視
	watch: {
        //discountPriceの監視新しい値が入力されたら古い値との差分を計算する
        discountPrice: function (newVal, oldVal) {
            // newValを数値に変換し、失敗した場合はNaNが返される
            const numericNewVal = Number(newVal);
            // newValが数値ではない、0以下、またはpointより大きい場合はバリデーションに引っかかる
            if (isNaN(numericNewVal) || numericNewVal < 0 || numericNewVal > this.point && this.couponType == '1') {
                if (isNaN(numericNewVal)) {
                    alert('数値を入力してください');
                } else if (numericNewVal < 0) {
                    alert('0以上の数値を入力してください');
                } else if (numericNewVal > this.point) {
                    alert('使用可能なクーポン額を超えています');
                }

                // バリデーションに引っかかった場合は、totalAmountを元に戻す
                this.totalAmount += oldVal - this.discountPrice;
                // discountPriceをリセットする
                this.$nextTick(() => {
                    this.discountPrice = 0;
                });
                return;
            }
            // ここで計算を実施
			this.totalAmount = this.totalAmount - numericNewVal + Number(oldVal);

            // 文字が入力された場合の対応
            if (isNaN(this.totalAmount) ) {
                if(this.bookbindingClick == '1'){
                    this.totalAmount = this.appraisalPrice + this.bookbindingPrice + this.shippingFee;
                }
                else{
                    this.totalAmount = this.appraisalPrice;
                }
            }
        },
		selectedAppraisals: function (newVal, oldVal) {
			if (this.selectedAppraisals.length === 0) {
				this.masterCheckbox = false;
			}

			// selectedAppraisalsの中にあるものはdisplay: blockにする
			this.selectedAppraisals.forEach(id => {
				let pdfDom = document.getElementById(`pdf_dom-${id}`);
				let bookbindingNameDom = document.getElementById(`bookbinding_name_dom-${id}`);
				pdfDom.style.display = 'block';
				bookbindingNameDom.style.display = 'block';
			});
			// totalAmountを計算する
			this.totalAmount = this.bookbindingPrice * this.selectedAppraisals.length - this.discountPrice;
			// クーポンなどは一度リセットする
			this.discountPrice = '';

			// selectedAppraisalsの中にないものはdisplay: noneにする
			let allAppraisalIds = this.getAllAppraisalIds();
			let notSelectedAppraisals = [];
			allAppraisalIds.forEach(id => {
				if (!this.selectedAppraisals.map(Number).includes(id)) {
					notSelectedAppraisals.push(id);
				}
			});
			notSelectedAppraisals.forEach(id => {
				let pdfDom = document.getElementById(`pdf_dom-${id}`);
				let bookbindingNameDom = document.getElementById(`bookbinding_name_dom-${id}`);
				pdfDom.style.display = 'none';
				bookbindingNameDom.style.display = 'none';
			});
		},
		masterCheckbox(newVal) {
			// マスターチェックボックスが変更されたら、他のチェックボックスも同じ状態にする
			if (newVal) {
				this.selectedAppraisals = this.getAllAppraisalIds();

				// 全てdisplay: blockにする
				this.getAllAppraisalIds().forEach(id => {
					let pdfDom = document.getElementById(`pdf_dom-${id}`);
					let bookbindingNameDom = document.getElementById(`bookbinding_name_dom-${id}`);
					pdfDom.style.display = 'block';
					bookbindingNameDom.style.display = 'block';
				});
			} else {
				this.selectedAppraisals = [];
				this.totalAmount = 0;

				// 全てdisplay: noneにする
				this.getAllAppraisalIds().forEach(id => {
					let pdfDom = document.getElementById(`pdf_dom-${id}`);
					let bookbindingNameDom = document.getElementById(`bookbinding_name_dom-${id}`);
					pdfDom.style.display = 'none';
					bookbindingNameDom.style.display = 'none';
				});
			}
		},
		couponCode: function (val) {
			if (val === '') {
				this.discountPrice = '';
			}
		},
    },
	mounted() {
		// selectedAppraisalsの中にあるものはdisplay: blockにする
		this.selectedAppraisals.forEach(id => {
			let pdfDom = document.getElementById(`pdf_dom-${id}`);
			let bookbindingNameDom = document.getElementById(`bookbinding_name_dom-${id}`);
			pdfDom.style.display = 'block';
			bookbindingNameDom.style.display = 'block';
		});
	}
}).mount('#Bookbinding-appraisal');
</script>


<script>
	const stripe = Stripe('{{ config('services.stripe.public') }}');

			const elements = stripe.elements();

			var elementStyles = {
					base: {
							color: 'black',
							fontWeight: 600,
							fontFamily: 'Quicksand, Open Sans, Segoe UI, sans-serif',
							fontSize: '16px',
							fontSmoothing: 'antialiased',

							':focus': {
									color: '#424770',
							},

							'::placeholder': {
									color: '#9BACC8',
							},

							':focus::placeholder': {
									color: '#CFD7DF',
							},
					},
					invalid: {
							color: '#FA755A',
							':focus': {
									color: '#FA755A',
							},
							'::placeholder': {
									color: '#FFCCA5',
							},
					},
			};

			var elementClasses = {
					focus: 'focus',
					empty: 'empty',
					invalid: 'invalid',
			};

			var cardNumber = elements.create('cardNumber', {
					style: elementStyles,
					classes: elementClasses,
			});
			cardNumber.mount('#card-number');

			var cardExpiry = elements.create('cardExpiry', {
					style: elementStyles,
					classes: elementClasses,
			});
			cardExpiry.mount('#card-expiry');

			var cardCvc = elements.create('cardCvc', {
					style: elementStyles,
					classes: elementClasses,
			});
			cardCvc.mount('#card-cvc');

			document.getElementById('payment-form').addEventListener('submit', function(event) {

					//クレジットカード決済の場合のみ実施
					if(document.querySelector('input[name="payment_type"]:checked').value == 1){
							event.preventDefault();
							console.log('クレジットカード決済');
							stripe.createToken(cardNumber).then(function(result) {
									if (result.error) {
											// エラーハンドリング
											alert(result.error.message);
									} else {
											// トークンを隠しフィールドとしてフォームに追加
											var form = document.getElementById('payment-form');

											// トークンを隠しフィールドとしてフォームに追加
											appendHiddenInput(form, 'stripeToken', result.token.id);

											// カードブランドと下4桁も隠しフィールドとして追加
											appendHiddenInput(form, 'cardBrand', result.token.card.brand);
											appendHiddenInput(form, 'last4', result.token.card.last4);

											// 申し込み内容確認画面へリダイレクト
											form.submit();
									}
							});
					}
			});

			function appendHiddenInput(form, name, value) {
					var hiddenInput = document.createElement('input');
					hiddenInput.setAttribute('type', 'hidden');
					hiddenInput.setAttribute('name', name);
					hiddenInput.setAttribute('value', value);
					form.appendChild(hiddenInput);
			}
</script>

@endsection
