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
<link rel="stylesheet" href="{{ asset('front/assets/plugins/mCustomScrollbar/jquery.mCustomScrollbar.min.css') }}">
@endsection

@section('content')
<div class="top-logo">
	<a href="https://hoshinomai.jp/" target="_blank" rel="noopener noreferrer">
		<img src="{{ asset('images/common/top-logo.svg') }}" alt="" width="200" >
	</a>
	<div class="top-register">
		<img src="{{ asset('images/common/top-appraisal-apply.svg') }}" alt="">
	</div>
	<p>インターネット個人鑑定にお申し込みの方は、<br>
		以下フォームに入力ください。</p>
</div>
<div class="maxwidth sp_maxwidth">
	<div class="C-form-line C-form-line--first C-form-line-block">
		<div class="C-form-line-sub-block">
			<h2>あなたの出生情報が必要です。</h2>
			<p>生年月日・・・生まれた時間まで</p>
			<p>生まれた場所・・・市町村単位まで</p>
			<p>出生情報について、<a href="https://hoshinomai.jp/faq" target="_blank" rel="noopener noreferrer">よくあるご質問はこちら ></a></p>
		</div>
		<div class="C-form-line-sub-block">
			<h2>Stellar Blueprintのお支払い方法について</h2>
			<p>クレジットカード／銀行振込からお選びいただけます。</p>
		</div>
		<div class="C-form-line-sub-block">
			<h2>ご購入時の会員登録について</h2>
			<p>Stellar Blueprint 購入と同時に、星の舞会員に登録されます。<br>
				鑑定結果は、マイページに表示されます。 (製本は、別途オプションの申し込みが必要です)</p>
		</div>
		<div class="C-form-line-sub-block">
			<h2>家族の鑑定を申し込まれる方へ</h2>
			<p>ご自身の鑑定の前に、ご家族の鑑定をお求めの方は、まず <a href="{{ route('user.register') }}">こちら</a> から会員登録をいただき、<br>
				マイページ内から家族鑑定をお求めください</p>
		</div>
	</div>
</div>
<div class="maxwidth sp_maxwidth">
	<section class="sec Offer C-form" id="Offer">
		<p class="C-form__message C-form-line C-form-line--first">下記フォームの<span
				class="C-form__message__req">必須項目</span>をご記入の上、ご購入ください。</p>
		@if (Session::has('flash_alert'))
		<p style="color: red; font-size: larger;">{{ Session::get('flash_alert') }}</p>
		@endif
		<form id="payment-form" method="POST" action="{{ route('user.offer_appraisals.confirm') }}"
			enctype="multipart/form-data">
			@csrf
			<div class="C-form-block__wrap">
				{{-- お名前 --}}
				<dl class="C-form-block C-form-block--name">
					<dt class="C-form-block__title C-form-block__title--req">お名前</dt>
					<dd class="C-form-block__body C-form-block__body--two">
						<div class="C-form-block__field">
							@include('components.form.text', [
							'name' => 'name1',
							'required' => true,
							'placeholder' => '姓',
							'value' => $request->name1 ?? ''
							])
						</div>
						<div class="C-form-block__field">
							@include('components.form.text', [
							'name' => 'name2',
							'required' => true,
							'placeholder' => '名',
							'value' => $request->name2 ?? ''
							])
						</div>
					</dd>
					@include('components.form.error', ['name' => 'name1', 'class' => 'text-danger'])
					@include('components.form.error', ['name' => 'name2', 'class' => 'text-danger'])
				</dl>
				{{-- フリガナ --}}
				<dl class="C-form-block C-form-block--kana">
					<dt class="C-form-block__title C-form-block__title--req">フリガナ</dt>
					<dd class="C-form-block__body C-form-block__body--two">
						<div class="C-form-block__field">
							@include('components.form.text', [
							'name' => 'kana1',
							'required' => true,
							'placeholder' => 'セイ',
							'value' => $request->kana1 ?? ''
							])
						</div>
						@include('components.form.error', ['name' => 'kana1', 'class' => 'text-danger'])
						<div class="C-form-block__field">
							@include('components.form.text', [
							'name' => 'kana2',
							'required' => true,
							'placeholder' => 'メイ',
							'value' => $request->kana2 ?? ''
							])
						</div>
						@include('components.form.error', ['name' => 'kana2', 'class' => 'text-danger'])
					</dd>
				</dl>
				{{-- メールアドレス --}}
				<dl class="C-form-block">
					<dt class="C-form-block__title C-form-block__title--req">メールアドレス</dt>
					<dd class="C-form-block__body C-form-block__body--half">
						<div class="C-form-block__field">
							@include('components.form.text', [
							'name' => 'email',
							'required' => true,
							'placeholder' => 'example@example.com',
							'value' => $request->email ?? '',
							])
						</div>
						@include('components.form.error', ['name' => 'email', 'class' => 'text-danger'])
					</dd>
				</dl>
				<dl class="C-form-block">
					<dt class="C-form-block__title C-form-block__title--req">メールアドレス確認</dt>
					<dd class="C-form-block__body C-form-block__body--half">
						<div class="C-form-block__field">
							@include('components.form.text', [
							'name' => 'email_confirmation',
							'required' => true,
							'placeholder' => 'example@example.com',
							])
						</div>
						@include('components.form.error', ['name' => 'email_confirmation', 'class' => 'text-danger'])
					</dd>
				</dl>

				{{-- パスワード --}}
				<dl class="C-form-block C-form-block--password">
					<dt class="C-form-block__title C-form-block__title--req">パスワード</dt>
					<dd class="C-form-block__body C-form-block__body--half">
						<div class="C-form-block__field">
							@include('components.form.original_password', [
							'name' => 'password',
							'required' => true,
							'placeholder' => '＊＊＊＊＊＊＊＊',
							])
						</div>
						@include('components.form.error', ['name' => 'password', 'class' => 'text-danger'])
						<p class="C-form-block--password__text">パスワードは半角英字（大文字と小文字）と数字を組み合わせて8桁以上12桁以内で入力してください。</p>
						<div class="C-form-block--password-tab">
							<div class="C-form-block--password-tab__item C-form-block--password-tab__item--big">大文字</div>
							<div class="C-form-block--password-tab__item C-form-block--password-tab__item--small">小文字</div>
							<div class="C-form-block--password-tab__item C-form-block--password-tab__item--number">数字</div>
							<div class="C-form-block--password-tab__item C-form-block--password-tab__item--count">桁数</div>
						</div>
					</dd>
				</dl>
				<dl class="C-form-block C-form-block--password-confirm">
					<dt class="C-form-block__title C-form-block__title--req">パスワード確認</dt>
					<dd class="C-form-block__body C-form-block__body--half">
						<div class="C-form-block__field">
							@include('components.form.password', [
							'name' => 'password_confirmation',
							'required' => true,
							'placeholder' => '＊＊＊＊＊＊＊＊',
							])
						</div>
						@include('components.form.error', ['name' => 'password', 'class' => 'text-danger'])
						<p class="C-form-block--password__text">パスワードは半角英字（大文字と小文字）と数字を組み合わせて8桁以上12桁以内で入力してください。</p>
						<div class="C-form-block--password-tab">
							<div class="C-form-block--password-tab__item C-form-block--password-tab__item--big-confirm">大文字
							</div>
							<div class="C-form-block--password-tab__item C-form-block--password-tab__item--small-confirm">小文字
							</div>
							<div class="C-form-block--password-tab__item C-form-block--password-tab__item--number-confirm">数字
							</div>
							<div class="C-form-block--password-tab__item C-form-block--password-tab__item--count-confirm">桁数
							</div>
						</div>
					</dd>
				</dl>
				{{-- 個人鑑定の対象者 --}}
				<dl class="C-form-block C-form-block--target">
					<dt class="C-form-block__title C-form-block__title--req">個人鑑定の対象者</dt>
					<dd class="C-form-block__body">
						<div class="C-form-block__radio">
							@include('components.form.original_radio', [
							'name' => 'target_type',
							'class' => 'C-form-block__radio__text',
							'data' => [1 => '自分'],
							// 'data' => [1 => '自分', 2 => '家族'],
							'checked' => $request->target_type ?? 1,
							'vModel' => 'personalClick',
							'onChange' => 'togglePersonal',
							])
						</div>
						<div v-if="personalClick == '2'" class="Personal-appraisal-family">
							<dl class="C-form-block-child C-form-block--relationship">
								<dt class="C-form-block__title">対象者との続柄</dt>
								<dd class="C-form-block__body C-form-block__body--half">
									<div class="C-form-block__field">
										@include('components.form.text', [
										'name' => 'relationship',
										'placeholder' => 'あなたとの関係',
										'value' => $request->relationship ?? ''
										])
									</div>
									@include('components.form.error', ['name' => 'relationship', 'class' => 'text-danger'])
								</dd>
							</dl>
							<dl class="C-form-block-child C-form-block--name">
								<dt class="C-form-block__title">対象者のお名前</dt>
								<dd class="C-form-block__body C-form-block__body--two">
									<div class="C-form-block__field">
										@include('components.form.text', [
										'name' => 'family_name1',
										'placeholder' => '姓',
										'value' => $request->family_name1 ?? ''
										])
										@include('components.form.error', ['name' => 'family_name1', 'class' => 'text-danger'])
									</div>
									<div class="C-form-block__field">
										@include('components.form.text', [
										'name' => 'family_name2',
										'placeholder' => '名',
										'value' => $request->family_name2 ?? ''
										])
										@include('components.form.error', ['name' => 'family_name2', 'class' => 'text-danger'])
									</div>
								</dd>
							</dl>
						</div>
					</dd>
				</dl>
				{{-- 出生情報 --}}
				<dl class="C-form-block C-form-block--birthdata">
					<dt class="C-form-block__title C-form-block__title--req">出生情報</dt>
					<dd class="C-form-block__body">
						<dl class="C-form-block-child C-form-block--birth">
							<dt class="C-form-block__title">生年月日</dt>
							<div>
								<div style="display: flex">
									<dd class="C-form-block__select">
										<select id="select_year" name="birth_year" @change="setDay">
											<option value="">年</option>
										</select>
										{{-- @include('components.form.error', ['name' => 'birth_year', 'class' => 'text-danger']) --}}
									</dd>
									<dd class="C-form-block__select">
										<select id="select_month" name="birth_month" @change="setDay">
											<option value="">月</option>
										</select>
										{{-- @include('components.form.error', ['name' => 'birth_month', 'class' => 'text-danger']) --}}
									</dd>
									<dd class="C-form-block__select">
										<select id="select_day" name="birth_day">
											{{-- デフォルト値はjsで実装 --}}
										</select>
									</dd>
								</div>
								<p>
									@include('components.form.error', ['name' => 'birth_day', 'class' => 'text-danger'])
								</p>
							</div>
						</dl>
						{{-- 時刻 --}}
						<dl class="C-form-block-child C-form-block--time">
							<dt class="C-form-block__title">時刻</dt>
							<dd class="C-form-block__body C-form-block__body--half">
								<div class="C-form-block__field">
									@include('components.form.time', [
									'name' => 'birthday_time',
									'required' => true,
									'value' => $request->birthday_time ?? '',
									'placeholder' => '00 : 00',
									'inputmode' => 'numeric',

									])
									@include('components.form.error', ['name' => 'birthday_time', 'class' => 'text-danger'])
								</div>
							</dd>
						</dl>
						<dl class="C-form-block-child C-form-block--birthplace">
							<dt class="C-form-block__title">生まれた場所</dt>
							<dd class="C-form-block__body C-form-block__body--half">
								<div class="C-form-block__field">
									@include('components.form.text', [
									'name' => 'birthday_prefectures',
									'required' => true,
									'placeholder' => '都道府県市区町村',
									'value' => $request->birthday_prefectures ?? '',
									'vInput' => 'handleInputChange',
									])
								</div>
								@include('components.form.error', ['name' => 'birthday_prefectures', 'class' => 'text-danger'])
							</dd>
						</dl>
						<dl class="C-form-block-child">
							<dd class="C-form-block__body">
								<div id="map" style="height: 250px; width:100%"></div>
							</dd>
						</dl>
						<dl class="C-form-block-child">
							<dd class="C-form-block__body">
								<dt class="C-form-block__title">経度</dt>
								<div class="C-form-block__field"><input id="map-longitude" disabled type="text" value={{ old('longitude', session('longitude')) ?? '138.252924' }} style="color:#a1a1a6;">
									<input id="lng" hidden name="longitude" type="text"
									value={{ old('longitude', session('longitude')) ?? '138.252924' }}></div>
								@error('longitude')
									<span style="color: red" class="text-danger">{{ $message }}</span>
								@enderror
								<br>
								<dt class="C-form-block__title">緯度</dt>
								<div class="C-form-block__field"> <input id="map-latitude" disabled type="text"
									value={{ old('latitude', session('latitude')) ?? '36.204824' }} style="color:#a1a1a6;">
									<input id="lat" hidden name="latitude" type="text"
									value={{ old('latitude', session('latitude')) ?? '36.204824' }}></div>
								<input id="map-city" hidden name="map-city" type="text" value="">
								@error('latitude')
									<span style="color: red" class="text-danger">{{ $message }}</span>
								@enderror
							</dd>
						</dl>
						<dl class="C-form-block-child">
							<dd class="C-form-block__body">
								<dt class="C-form-block__title">タイムゾーン</dt>
								<dd class="C-form-block__select">
									<select name="timezone">
										@foreach (Modules\Horoscope\Enums\Time::Time as $item)
											<option value='{{ $item['value'] }}' @if (old('timezone') !== null) {{ old('timezone') == $item['value'] ? 'selected' : '' }} @else {{ array_key_exists('selected', $item) ? 'selected' : '' }} @endif>
												{{ $item['label'] }}
											</option>
										@endforeach
									</select>
								</dd>
								@error('timezone')
									<span style="color: red" class="text-danger">{{ $message }}</span>
								@enderror
							</dd>
							<p>日本標準時がデフォルトです。出生地が海外の場合に選択してください。</p>
						</dl>
						<p class="C-form-block--birthdata__text">あなたの生まれた瞬間のホロスコープを出すためには<br>生まれた時間を「分」まで、場所を「市」まで正しく入力してください。</p>
					</dd>
				</dl>

				<!-- 製本パーツ -->
				@include('components.parts.user.appraisal_apply_common_bookbinding')

				<input type="hidden" name="is_bookbinding" value="0" v-model="bookbindingClick">
				{{-- お支払い方法 --}}
				<dl class="C-form-block C-form-block--cash">
					<dt class="C-form-block__title C-form-block__title--req">お支払い方法</dt>
					<dd class="C-form-block__body">
						<div class="C-form-block__radio">
							@include('components.form.original_offer_radio', [
							'name' => 'payment_type',
							'class' => 'C-form-block__radio__text',
							'data' => App\Models\AppraisalClaim::PAYMENT_TYPE,
							'vModel' => 'paymentType',
							])
						</div>
					</dd>
				</dl>

				<dl class="C-form-block C-form-block--cash">
					<p class="C-form-text-position">Stellar Blueprint 購入と同時に、自動で会員登録となります。
						<br>購入時に入力したメールアドレスとパスワードで、マイページ
						<br class="C-form-br">にログインが可能です。
					</p>
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
				{{-- 使用するクーポン --}}
				<dl class="C-form-block C-form-block--coupon-wrap">
					<dd class="C-form-block__body">
						<dl class="C-form-block-child C-form-block--hasbutton C-form-block--couponcode on">
							<dt class="C-form-block__title">使用するクーポン</dt>
							<dd class="C-form-block__body">
								<div class="C-form-block__field">
									@include('components.form.text', [
									'name' => 'coupon_code',
									'placeholder' => 'クーポンコード',
									'vModel' => 'couponCode',
									])
									@include('components.form.error', ['name' => 'coupon_code','class' => 'text-danger'])
								</div>
								<div class="C-form-block__button" @click="dicountTotalPlace">適用する</div>
								<ul class="C-form-block--couponcode-list list-ast">
									<li class="C-form-block--couponcode-list__item">お友達の紹介クーポンコードをご存知の方は入力してください。</li>
									<li class="C-form-block--couponcode-list__item">一度に使用できるのは1つのみです。</li>
								</ul>
							</dd>
						</dl>
					</dd>
				</dl>

				{{-- 注文内容 --}}
				<dl class="C-price">
					<dt class="C-price__title">注文内容</dt>
					<dd class="C-price__body">
						<div class="C-price-block__wrap">
							<dl class="C-price-block" v-if="personalClick == '1'">
								<dt class="C-price-block__title">個人鑑定金額</dt>
								<dd class="C-price-block__text">{{ number_format($appraisal->price) }}円</dd>
							</dl>
							<dl class="C-price-block" v-if="personalClick == '2'">
								<dt class="C-price-block__title">家族の個人鑑定金額</dt>
								<dd class="C-price-block__text">{{ number_format($appraisal->family_price) }}円</dd>
							</dl>

							<dl class="C-price-block" v-if="bookbindingClick == '1'">
								<dt class="C-price-block__title">製本金額 ：</dt>
								<dd class="C-price-block__text">{{ number_format($bookbinding->price) }}円</dd>
							</dl>
							{{-- <dl class="C-price-block" v-if="bookbindingClick == '1'">
								<dt class="C-price-block__title">送料 ：</dt>
								<dd class="C-price-block__text">{{ number_format(\App\Models\AppraisalClaim::SHIPPING_FEE) }}円</dd>
							</dl> --}}
							<dl class="C-price-block C-price-block--minus" v-if="couponCode !== '' && discountPrice !== ''">
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
							<li class="C-form-notice-list__item">鑑定結果に対する個別の質問はお受けいたしかねます。</li>
							<li class="C-form-notice-list__item">このStellar Blueprintは、あくまでも制作者海部舞による、皆様の出生図の解釈の一つです。鑑定内容に関係なく、人生の責任を負うのも、その決定権があるのも皆様自身であることをご理解ください。</li>
							<li class="C-form-notice-list__item">これは皆様の人生のテーマを明らかにし、より可能性を広げるための情報を提供することを目的としています。個人の私利私欲、恋愛や結婚の成就のお役に立つかは保障いたしかねます。</li>
							<li class="C-form-notice-list__item">製本をお申込みお客様へ：システムによるエラーや乱丁・落丁はお取替えいたしますが、お客様の出生情報入力ミスによるものは修正・返品ができません。別途製本費用をお支払いいただき作り直しになりますので、あらかじめご了承ください。</li>
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

			<div class="C-form-policy C-form-line C-form-line--last">
				<div class="C-form-policy__inner">
					<div class="C-form-policy-block">
						<div class="C-form-block__checkbox">
								<label class="C-form-block__checkbox__item">
										<input type="checkbox" name="terms_of_service">
										<span class="C-form-block__checkbox__text">
												<a href="https://hoshinomai.jp/terms-of-use/" target="_blank">利用規約</a>を確認しました。
										</span>
								</label>
						</div>
						@include('components.form.error', ['name' => 'terms_of_service'])
				</div>
				<div class="C-form-policy-block">
						<div class="C-form-block__checkbox">
								<label class="C-form-block__checkbox__item">
										<input type="checkbox" name="personal_information">
										<span class="C-form-block__checkbox__text">
												<a href="https://hoshinomai.jp/privacy" target="_blank">個人情報保護方針</a>を確認しました。
										</span>
								</label>
						</div>
						@include('components.form.error', ['name' => 'personal_information'])
				</div>
				</div>
				</div>

			<button type="submit" class="Button">
				<span>申し込み内容を確認する</span>
			</button>
		</form>
	</section>
</div>

@endsection

@section('script')
<script src="{{ asset('front/assets/js/jquery.autoKana.js') }}"></script>
<script src="{{ asset('front/assets/plugins/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>

<script src="{{ asset('front/assets/js/form.js') }}"></script>
<script src="{{ asset('mypage/assets/js/input.js') }}"></script>
<script src="{{ asset('front/assets/js/offer.js') }}"></script>

<script>
	Vue.createApp({
    data() {
        return {
            bookbindingClick:  @json(old('is_bookbinding', $request->is_bookbinding ?? '0')),
            personalClick: @json(old('target_type', $request->target_type ?? 1)),
            paymentType: @json(old('payment_type', $request->payment_type ?? App\Models\AppraisalClaim::CREDIT)),
            isCalculating: false,
            appraisalPrice: @json($appraisal->price),
            bookbindingPrice: @json($bookbinding->price),
            // shippingFee: @json(\App\Models\AppraisalClaim::SHIPPING_FEE),
            // totalAmount : @json(intval(old('total_amount', $request->total_amount ?? $appraisal->price))),
            // totalAmount : @json(intval(old('total_amount', $request->total_amount ?? $appraisal->price + $bookbinding->price + \App\Models\AppraisalClaim::SHIPPING_FEE))),
            totalAmount : @json(intval(old('total_amount', $request->total_amount ?? $appraisal->price))),
            discountPrice: @json(intval(old('discount_price', $request->discount_price ?? 0))),
            couponType: @json(old('coupon_type', $request->coupon_type ?? App\Enums\CouponType::BACK_COUPON->value)),
            couponCode: @json(old('coupon_code', $request->coupon_code ?? '')),
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
		// 対象者を切り替えた時に金額を変更する。（クーポンコードはリセットする）
		togglePersonal() {
			if (this.personalClick == '1') {
				this.totalAmount = @json($appraisal->price);
				this.couponCode = '';
				this.discountPrice = '';
			} else {
				this.totalAmount = @json($appraisal->family_price);
				this.couponCode = '';
				this.discountPrice = '';
			}
		},
        //非同期でクーポンコードを取得し、クーポンコードがあればクーポンコードで設定された値引きを行う
        dicountTotalPlace(){
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
					request_type: 'offer',
                }
            })
            .then((response) => {
                if(response.data.discount_price){
                    this.discountPrice = response.data.discount_price;
                    this.totalAmount = this.totalAmount - response.data.discount_price;
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
        //「製本する」をクリックした時に製本の金額を加算する、もしくは減算する
        toggleCaluculateBookking(){
            if(this.bookbindingClick === '1'){
                this.totalAmount = this.totalAmount + this.bookbindingPrice;
            }
            else{
                this.totalAmount = this.totalAmount - this.bookbindingPrice;
            }
        },
    },
	watch: {
		couponCode: function (val) {
			if (val === '') {
				this.totalAmount = this.totalAmount + this.discountPrice;
				this.discountPrice = '';
			}
		},
	},
	mounted() {
		// 初期住所をサーバーサイドで設定
		let initialAddress = @json(old('birthday_prefectures', $request->birthday_prefectures ?? '東京都杉並区'));
		this.updateMapAndMarker(initialAddress);

		// 年月日を設定
		let oldYear = @json(old('birth_year', $request->birth_year ?? ''));
		let oldMonth = @json(old('birth_month', $request->birth_month ?? ''));
		let oldDay = @json(old('birth_day', $request->birth_day ?? ''));
		this.setYear(oldYear);
		this.setMonth(oldMonth);
		this.setDay(oldDay);
    }

}).mount('#Offer');
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
			border: '1px solid #DADADA',

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
