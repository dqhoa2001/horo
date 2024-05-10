@extends('layouts.user.mypage.app')

@section('css')
<link rel="stylesheet" href="{{ asset('mypage/assets/css/personal-appraisal-form.css') }}">
<link rel="stylesheet" href="{{ asset('mypage/assets/css/personal-appraisal-form.css') }}">
@endsection

@section('content')
	<div class="Pageframe">

		@include('components.parts.side_header')

	
		<main class="Pageframe-main">
	
			@include('components.parts.top_header')

	
			<div class="Pageframe-main__scroll">
	
				<header class="Pageframe-main-header">
					<div class="Pageframe-main-header__first"><a href="{{ route('user.popup') }}">マイページ</a></div>
					<h2 class="Pageframe-main-header__pagename">個人鑑定 申込フォーム</h2>
				</header>
				
				<div class="Pageframe-main__inner">
					<div class="Pageframe-main-content">
						<!-- ***** セクション名 ***** -->
						<section class="sec Personal-appraisal C-form" id="Personal-appraisal">
							<h2 class="Pageframe-main__title"><img src="{{ asset('mypage/assets/images/myhoroscope/img_title.svg') }}" alt="CREATE HOROSCOPE" class="pc"><img src="{{ asset('mypage/assets/images/myhoroscope/sp_img_title.svg') }}" alt="CREATE HOROSCOPE" class="sp"></h2>
							<p class="C-form__message">下記フォームの<span class="C-form__message__req">必須項目</span>をご記入の上、ご購入ください。</p>
							<form>
								<div class="C-form-block__wrap">
									<dl class="C-form-block C-form-block--name">
										<dt class="C-form-block__title">お名前</dt>
										<dd class="C-form-block__body">
											<p class="C-form-block--name__text"><span>川端 真奈美</span>さん</p>
										</dd>
									</dl>
									<dl class="C-form-block C-form-block--target">
										<dt class="C-form-block__title C-form-block__title--req">個人鑑定の対象者</dt>
										<dd class="C-form-block__body">
											<div class="C-form-block__radio">
												<label class="C-form-block__radio__item">
													<input type="radio" name="target" value="自分" checked>
													<span class="C-form-block__radio__text">自分</span>
												</label>
												<label class="C-form-block__radio__item">
													<input type="radio" name="target" value="家族">
													<span class="C-form-block__radio__text">家族</span>
												</label>
											</div>
											<div class="Personal-appraisal-family">
												<dl class="C-form-block-child C-form-block--family">
													<dt class="C-form-block__title">登録済みのご家族</dt>
													<dd class="C-form-block__body C-form-block__body--half">
														<div class="C-form-block__select">
															<select name="family">
																<option value="">選択してください</option>
																<option value="1">1</option>
																<option value="2">2</option>
															</select>
														</div>
													</dd>
												</dl>
												<dl class="C-form-block-child C-form-block--relationship">
													<dt class="C-form-block__title">対象者との続柄</dt>
													<dd class="C-form-block__body C-form-block__body--half">
														<div class="C-form-block__field"><input type="text" name="relationship" placeholder="あなたとの関係"></div>
													</dd>
												</dl>
												<dl class="C-form-block-child C-form-block--name">
													<dt class="C-form-block__title">対象者のお名前</dt>
													<dd class="C-form-block__body C-form-block__body--two">
														<div class="C-form-block__field"><input type="text" name="name1" placeholder="姓"></div>
														<div class="C-form-block__field"><input type="text" name="name2" placeholder="名"></div>
													</dd>
												</dl>
											</div>
										</dd>
									</dl>
									<dl class="C-form-block C-form-block--birthdata">
										<dt class="C-form-block__title C-form-block__title--req">出生情報</dt>
										<dd class="C-form-block__body">
											<dl class="C-form-block-child C-form-block--birth">
												<dt class="C-form-block__title">生年月日</dt>
												<dd class="C-form-block__body C-form-block__body--half">
													<div class="C-form-block__field"><input type="text" name="birth" placeholder="0000 / 00 / 00" maxlength="10" inputmode="numeric"></div>
												</dd>
											</dl>
											<dl class="C-form-block-child C-form-block--time">
												<dt class="C-form-block__title">時刻</dt>
												<dd class="C-form-block__body C-form-block__body--half">
													<div class="C-form-block__field"><input type="text" name="time" placeholder="00 : 00" maxlength="5" inputmode="numeric"></div>
												</dd>
											</dl>
											<dl class="C-form-block-child C-form-block--birthplace">
												<dt class="C-form-block__title">生まれた場所</dt>
												<dd class="C-form-block__body C-form-block__body--two">
													<div class="C-form-block__field"><input type="text" name="birthplace1" placeholder="都道府県"></div>
													<div class="C-form-block__field"><input type="text" name="birthplace2" placeholder="市区町村"></div>
												</dd>
											</dl>
											<p class="C-form-block--birthdata__text">あなたの生まれた瞬間のホロスコープを出すためには<br>生まれた時間を「分」まで、場所を「市」まで正しく入力してください。</p>
										</dd>
									</dl>
									<dl class="C-form-block C-form-block--hope">
										<dt class="C-form-block__title C-form-block__title--req">製本の希望</dt>
										<dd class="C-form-block__body">
											<div class="C-form-block__radio">
												<label class="C-form-block__radio__item">
													<input type="radio" name="hope" value="希望する (0,000円)">
													<span class="C-form-block__radio__text">希望する (0,000円)</span>
												</label>
												<label class="C-form-block__radio__item">
													<input type="radio" name="hope" value="希望しない">
													<span class="C-form-block__radio__text">希望しない</span>
												</label>
											</div>
											<p class="Personal-appraisal__notice-text"><a href="#">製本の詳細と注意事項はこちら</a></p>
										</dd>
									</dl>
									<dl class="C-form-block C-form-block--sending">
										<dt class="Personal-appraisal-sending__title">送付先を入力してください。</dt>
										<dd class="C-form-block__body">
											<dl class="C-form-block-child C-form-block--hasbutton C-form-block--zip">
												<dt class="C-form-block__title">郵便番号</dt>
												<dd class="C-form-block__body">
													<div class="C-form-block__field"><input type="text" name="zip" placeholder="000-0000"></div>
													<div class="C-form-block__button">住所自動入力</div>
												</dd>
											</dl>
											<dl class="C-form-block-child C-form-block--address">
												<dt class="C-form-block__title">住所</dt>
												<dd class="C-form-block__body">
													<div class="C-form-block__field"><input type="text" name="address" placeholder="長野県飯田市◯◯◯◯◯◯"></div>
												</dd>
											</dl>
											<dl class="C-form-block-child C-form-block--building">
												<dt class="C-form-block__title">建物・マンション名</dt>
												<dd class="C-form-block__body">
													<div class="C-form-block__field"><input type="text" name="building" placeholder="建物名 ◯◯号室"></div>
												</dd>
											</dl>
											<dl class="C-form-block-child C-form-block--name">
												<dt class="C-form-block__title">お名前</dt>
												<dd class="C-form-block__body">
													<div class="C-form-block__field"><input type="text" name="building" placeholder="受け取り者様のお名前を入力してください"></div>
												</dd>
											</dl>
											<dl class="C-form-block-child C-form-block--tel">
												<dt class="C-form-block__title">電話番号</dt>
												<p class="C-form-block--password__text">※数字のみを入力してください</p>

												<dd class="C-form-block__body">
													<div class="C-form-block__field"><input type="text" name="tel" placeholder="000-0000-0000"></div>
												</dd>
											</dl>
										</dd>
									</dl>
									<dl class="C-form-block C-form-block--cash">
										<dt class="C-form-block__title C-form-block__title--req">お支払い方法</dt>
										<dd class="C-form-block__body">
											<div class="C-form-block__radio">
												<label class="C-form-block__radio__item">
													<input type="radio" name="cash" value="クレジットカード">
													<span class="C-form-block__radio__text">クレジットカード</span>
												</label>
												<label class="C-form-block__radio__item">
													<input type="radio" name="cash" value="コンビニ決済">
													<span class="C-form-block__radio__text">コンビニ決済</span>
												</label>
											</div>
										</dd>
									</dl>
									<dl class="C-form-block C-form-block--coupon-wrap">
										<dd class="C-form-block__body">
											<dl class="C-form-block-child C-form-block--coupon">
												<dt class="C-form-block__title">クーポンのご利用</dt>
												<dd class="C-form-block__body">
													<div class="C-form-block__radio">
														<label class="C-form-block__radio__item">
															<input type="radio" name="coupon" value="ご紹介ポイントを使用" checked>
															<span class="C-form-block__radio__text">ご紹介ポイントを使用</span>
														</label>
														<label class="C-form-block__radio__item">
															<input type="radio" name="coupon" value="クーポンコードを使用">
															<span class="C-form-block__radio__text">クーポンコードを使用</span>
														</label>
													</div>
												</dd>
											</dl>
											<dl class="C-form-block-child C-form-block--hasbutton C-form-block--couponno on">
												<dt class="C-form-block__title">使用するクーポン</dt>
												<dd class="C-form-block__body">
													<div class="C-form-block__field"><input type="text" name="couponno" placeholder="0000"><span class="C-form-block--couponno__tag">円</span></div>
													<div class="C-form-block__button">適用する</div>
													<p class="C-form-block--couponno__text"><span>あなたの現在使用可能なクーポン ： <strong>10,000円</strong></span></p>
												</dd>
											</dl>
											<dl class="C-form-block-child C-form-block--hasbutton C-form-block--couponcode">
												<dt class="C-form-block__title">使用するクーポン</dt>
												<dd class="C-form-block__body">
													<div class="C-form-block__field"><input type="text" name="couponcode" placeholder="クーポンコード"></div>
													<div class="C-form-block__button">適用する</div>
													<ul class="C-form-block--couponcode-list list-dot">
														<li class="C-form-block--couponcode-list__item">お友達の紹介クーポンコードをご存知の方は入力してください。</li>
														<li class="C-form-block--couponcode-list__item">一度に使用できるのは1つのみです。</li>
													</ul>
												</dd>
											</dl>
										</dd>
									</dl>
									<dl class="C-price">
										<dt class="C-price__title">注文内容</dt>
										<dd class="C-price__body">
											<div class="C-price-block__wrap">
												<dl class="C-price-block">
													<dt class="C-price-block__title">個人鑑定金額 ：</dt>
													<dd class="C-price-block__text">8,800円</dd>
												</dl>
												<dl class="C-price-block">
													<dt class="C-price-block__title">製本金額 ：</dt>
													<dd class="C-price-block__text">3,300円</dd>
												</dl>
												<dl class="C-price-block">
													<dt class="C-price-block__title">送料 ：</dt>
													<dd class="C-price-block__text">1,200円</dd>
												</dl>
												<dl class="C-price-block C-price-block--minus">
													<dt class="C-price-block__title">ご紹介クーポン ：</dt>
													<dd class="C-price-block__text">- 1,000円</dd>
												</dl>
											</div>
											<dl class="C-price-last">
												<dt class="C-price-last__title">合計</dt>
												<dd class="C-price-last__text"><span>12,300</span>円</dd>
											</dl>
										</dd>
									</dl>
								</div>
								<div class="C-form-policy">
									<div class="C-form-policy__inner">
										<div class="C-form-policy-block">
											<div class="C-form-block__checkbox">
												<label class="C-form-block__checkbox__item">
													<input type="checkbox" name="rule" value="利用規約を確認しました。">
													<span class="C-form-block__checkbox__text"><a href="https://hoshinomai.jp/terms-of-use/" target="_blank">利用規約</a>を確認しました。</span>
												</label>
											</div>
										</div>
										<div class="C-form-policy-block">
											<div class="C-form-block__checkbox">
												<label class="C-form-block__checkbox__item">
													<input type="checkbox" name="rule" value="個人情報保護方針を確認しました。">
													<span class="C-form-block__checkbox__text"><a href="https://hoshinomai.jp/privacy" target="_blank">個人情報保護方針</a>を確認しました。</span>
												</label>
											</div>
										</div>
									</div>
								</div>
								<button type="button" class="Button Button--lightblue"><span>申し込み内容を確認する</span></button>
							</form>
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
<script src="{{ asset('mypage/assets/js/personal-appraisal-form.js') }}"></script>
@endsection

