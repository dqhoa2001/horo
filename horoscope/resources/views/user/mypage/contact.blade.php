@extends('layouts.user.mypage.app')

@section('css')
<link rel="stylesheet" href="{{ asset('mypage/assets/css/contact.css') }}">
@endsection

@section('content')
	<div class="Pageframe">

		@include('components.parts.side_header')

		<main class="Pageframe-main">

			@include('components.parts.top_header')


			<div class="Pageframe-main__scroll">

				<header class="Pageframe-main-header">
					<div class="Pageframe-main-header__first"><a href="{{ route('user.popup') }}">マイページ</a></div>
					<h2 class="Pageframe-main-header__pagename">お問い合わせ</h2>
				</header>

				<div class="Pageframe-main__inner">
					<div class="Pageframe-main-content">
						<!-- ***** セクション名 ***** -->
						<section class="sec Contact C-form" id="Contact">
							<h2 class="Pageframe-main__title"><img src="{{ asset('mypage/assets/images/contact/img_title.svg') }}" alt="CONTACT"></h2>
							<p class="C-form__message">下記フォームの<span class="C-form__message__req">必須項目</span>をご記入の上、お問い合わせください。</p>
							<form>
								<div class="C-form-block__wrap">
									<dl class="C-form-block C-form-block--type">
										<dt class="C-form-block__title C-form-block__title--req">お問い合わせ種別</dt>
										<dd class="C-form-block__body">
											<div class="C-form-block__radio">
												<label class="C-form-block__radio__item">
													<input type="radio" name="type" value="鑑定について">
													<span class="C-form-block__radio__text">鑑定について</span>
												</label>
												<label class="C-form-block__radio__item">
													<input type="radio" name="type" value="製本について">
													<span class="C-form-block__radio__text">製本について</span>
												</label>
												<label class="C-form-block__radio__item">
													<input type="radio" name="type" value="メールアドレスを忘れた">
													<span class="C-form-block__radio__text">メールアドレスを忘れた</span>
												</label>
												<label class="C-form-block__radio__item">
													<input type="radio" name="type" value="サービスに関するお問い合せ">
													<span class="C-form-block__radio__text">サービスに関するお問い合せ</span>
												</label>
												<label class="C-form-block__radio__item">
													<input type="radio" name="type" value="取材など広報に関するお問い合せ">
													<span class="C-form-block__radio__text">取材など広報に関するお問い合せ</span>
												</label>
												<label class="C-form-block__radio__item">
													<input type="radio" name="type" value="その他">
													<span class="C-form-block__radio__text">その他</span>
												</label>
											</div>
										</dd>
									</dl>
									<dl class="C-form-block C-form-block--comment">
										<dt class="C-form-block__title C-form-block__title--req">お問い合わせ内容</dt>
										<dd class="C-form-block__body">
											<div class="C-form-block__textarea">
												<textarea name="comment" placeholder="お問い合わせの内容をご記入ください。"></textarea>
											</div>
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
								<button type="button" class="Button Button--lightblue"><span>入力内容を確認する</span></button>
							</form>
						</section>
						<!-- ***** セクション名 ***** -->
					</div>
				</div>

				<!-- ***** フッター ***** -->
				<footer class="footer sp">
					<div class="footer-name"><a href="./"><img src="{{ asset('mypage/assets/images/common/sitename.svg') }}" alt="HOSHI NO MAI"></a></div>
					<figure class="footer-logo"><img src="{{ asset('mypage/assets/images/common/logo.svg') }}"></figure>
					<p class="footer-copyright">© 2023 HOSHI NO MAI.</p>
				</footer>
				<!-- ***** フッター ***** -->
				
			</div>

		</main>

	</div>
@endsection