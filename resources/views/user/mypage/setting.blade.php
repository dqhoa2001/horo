@extends('layouts.user.mypage.app')

@section('css')
<link rel="stylesheet" href="{{ asset('mypage/assets/css/setting.css') }}">
@endsection

@section('content')
<div class="Pageframe">

	@include('components.parts.side_header')

	<main class="Pageframe-main">

		@include('components.parts.top_header')

		<div class="Pageframe-main__scroll">
			<header class="Pageframe-main-header">
				<div class="Pageframe-main-header__first"><a href="{{ route('user.popup') }}">マイページ</a></div>
				<h2 class="Pageframe-main-header__pagename">ユーザー設定</h2>
			</header>
			
			<div class="Pageframe-main__scroll Pageframe-main__inner">
				<div class="Pageframe-main-content">
					@include('components.parts.original_flash_message')
					<!-- ***** セクション名 ***** -->
					<section class="sec Setting" id="Setting">
						<h2 class="Pageframe-main__title">
							<img src="{{ asset('mypage/assets/images/setting/img_title.svg') }} " alt="MY ACCOUNT" class="pc">
							<img src="{{ asset('mypage/assets/images/setting/sp_img_title.svg') }}" alt="FAMILY HOROSCOPE" class="sp">
						</h2>
						<div class="Pageframe-main__body">
							<div class="Setting-form">
								<form method="POST" action="{{ route('user.settings.update') }}">
									@csrf
									<h3 class="Setting-form__title">基本情報</h3>
									<div class="Setting-form__inner">
										<dl class="Setting-form-block Setting-form-block--half Setting-form-block--name">
											<dt class="Setting-form-block__title">お名前</dt>
											<dd class="Setting-form-block__body">
												<div class="Setting-form-field">
													@include('components.form.text',[
													'name' => 'name1',
													'required' => true,
													'value' => auth()->guard('user')->user()->name1,
													])
												</div>
												<div class="Setting-form-field">
													@include('components.form.text',[
													'name' => 'name2',
													'required' => true,
													'value' => auth()->guard('user')->user()->name2,
													])
												</div>
											</dd>
											@include('components.form.error', ['name' => 'name1', 'class' => 'text-danger'])<br>
											@include('components.form.error', ['name' => 'name2', 'class' => 'text-danger'])
										</dl>
										<dl class="Setting-form-block Setting-form-block--half Setting-form-block--kana">
											<dt class="Setting-form-block__title">フリガナ</dt>
											<dd class="Setting-form-block__body">
												<div class="Setting-form-field">
													@include('components.form.text',[
													'name' => 'kana1',
													'required' => true,
													'value' => auth()->guard('user')->user()->kana1,
													])
												</div>
												<div class="Setting-form-field">
													@include('components.form.text',[
													'name' => 'kana2',
													'required' => true,
													'value' => auth()->guard('user')->user()->kana2,
													])
												</div>
											</dd>
											@include('components.form.error', ['name' => 'kana1', 'class' => 'text-danger'])<br>
											@include('components.form.error', ['name' => 'kana2', 'class' => 'text-danger'])
										</dl>
										<dl class="Setting-form-block Setting-form-block Setting-form-block--mail">
											<dt class="Setting-form-block__title">現在のメールアドレス</dt>
											<dd class="Setting-form-block__body">
												<div class="Setting-form-field">
													@include('components.form.text',[
													'name' => 'email-now',
													'disabled' => true,
													'value' => auth()->guard('user')->user()->email,
													])
												</div>
											</dd>
										</dl>
										<dl class="Setting-form-block Setting-form-block Setting-form-block--mail">
											<dt class="Setting-form-block__title">新しいメールアドレス</dt>
											<dd class="Setting-form-block__body">
												<div class="Setting-form-field">
													@include('components.form.text',[
													'name' => 'email',
													'required' => true,
													])
												</div>
											</dd>
											@include('components.form.error', ['name' => 'email', 'class' => 'text-danger'])
										</dl>
										<dl class="Setting-form-block Setting-form-block Setting-form-block--mail">
											<dt class="Setting-form-block__title">メールアドレス確認</dt>
											<dd class="Setting-form-block__body">
												<div class="Setting-form-field">
													@include('components.form.text',[
													'name' => 'email_confirmation',
													'required' => true,
													])
												</div>
											</dd>
											@include('components.form.error', ['name' => 'email_confirmation', 'class' => 'text-danger'])
										</dl>
									</div>
									<div class="Setting-create flexCB">
										<button type="submit" class="Button Button--lightblue"><span>変更を保存する</span></button>
										<!-- <p class="Setting-create__text"><a href=""
												onclick="event.preventDefault(); if(confirm('本当に退会しますか？\n退会した場合はログインができなくなり、鑑定結果が閲覧できなくなります。')){document.getElementById('withdraw').submit();}">星の舞会員から退会する</a>
										</p> -->
										<p class="Setting-create__text">
											<a href="" onclick="event.preventDefault();" class="C-user-list__change">星の舞会員から退会する</a>
										</p>
									</div>
								</form>

							</div>
						</div>
					</section>
					<div class="btn-block-mt">

						<!-- パスワードの変更 -->
						@if(Route::has('user.password.request'))
						<div class="C-form__message">
							<a href="{{ route('user.passwords.edit') }}">
								パスワードの変更
							</a>
						</div>
						@endif

						<!-- 退会 -->
						<form action="{{ route('user.withdraw') }}" method="post" id="withdraw">@csrf</form>

					</div>
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
								<form action="{{ route('user.withdraw') }}" method="POST">
									@csrf

									<div>
										<img src="{{ asset('mypage/assets/images/setting/withdraw_icon.svg') }}" alt="" width="100"
											height="100">
									</div>
									<p class="C-popup-content_delete-title">退会手続きの前にご確認ください</p>
									<p class="C-popup-content_delete-text">会員を退会された場合には、保存されているホロスコープ図と、<br>
										購入された鑑定結果の内容が<span class="C-popup-content_delete">全て削除</span>されます。<br>
										また、あなたの紹介コードは無効となり、<br>
										使用可能なクーポンもご利用できなくなります。<br>
										同意の上、以下の退会ボタンから退会してください。</p>
									<hr>
									<div class="C-form-policy-block">
										<div class="C-form-block__checkbox">
											<label class="C-form-block__checkbox__item">
												<input type="checkbox" name="withdraw" required required autocomplete="withdraw" autofocus>
												<span class="C-form-block__checkbox__text">
													上記すべてに同意しました。
												</span>
											</label>
										</div>
										@include('components.form.error', ['name' => 'withdraw', 'class' => 'text-danger'])<br>
									</div>
									<div class="C-popup-content_btn-block">
										<button type="submit" class="Button Button--dark"><span>会員退会手続きを完了する</span></button>
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

@section('script')
<script src="{{ asset('mypage/assets/js/setting.js') }}"></script>
<script src="{{ asset('mypage/assets/js/input.js') }}"></script>

@endsection