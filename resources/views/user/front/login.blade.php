@extends('layouts.user.front.app')

@section('css')
<!-- Front-design-login -->
<link rel="stylesheet" href="{{ asset('front/assets/css/login.css') }}">
@endsection

@section('content')
<div class="maxwidth460 sp_maxwidth">
	<section class="sec Login" id="Login">
		<form method="POST" action="{{ route('user.login') }}">
			@csrf
			<div class="Login-main">
				<div class="Login-main__inner">
					<!-- メールアドレス -->
					<dl class="Login-main-block Login-main-top--email">
						<dt class="Login-main-block__title">{{ __('Email Address') }}</dt>
						<dd class="Login-main-block__body">
							<div class="Login-main-block__field">
								<input type="email" id="email" name="email" class="@error('email') is-invalid @enderror"
									value="{{ old('email') }}" required autocomplete="email" autofocus>
								@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</dd>
					</dl>
					<!-- パスワード -->
					<dl class="Login-main-block Login-main-top--password">
						<dt class="Login-main-block__title">{{ __('Password') }}</dt>
						<dd class="Login-main-block__body">
							<div class="Login-main-block__field">
								<input type="password" id="password" name="password" class="@error('password') is-invalid @enderror"
									required autocomplete="current-password">
								@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</dd>
					</dl>
				</div>

				<!-- ログイン状態を保持する -->
				<div class="Login-main-keep">
					<div class="Login-main-keep__checkbox">
						<label class="Login-main-keep__checkbox__item">
							<input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
							<span class="Login-main-keep__checkbox__text">{{ __('Remember Me') }}</span>
						</label>
					</div>
				</div>

				<!-- ログイン -->
				<button type="submit" class="Button">
					<span>{{ __('Login') }}</span>
				</button>
				
				@if (app()->environment('local'))
				<!-- 開発中ログイン -->
				<div class="dev-btn-block">
					<a href="{{ route('user_dev_login') }}" class="dev-btn">
						開発中ログイン
					</a>
				</div>
				@endif

				@if (Route::has('user.password.request'))
				<p class="Login-main__loss">パスワードを忘れた方は、<br class="sp"><a 	href="#">パスワードの再設定</a>をしてください。</p>
				@endif

			</div>
			<div class="Login-entry">
				<div class="Login-entry__inner">
					<dl class="Login-entry-block">
						<dt class="Login-entry-block__title">はじめてご利用の方</dt>
						<dd class="Login-entry-block__body"><a href="#"><span>メールアドレスで登録</span></a></dd>
					</dl>
					<p class="Login-entry__text">登録またはログインすることで、<a href="https://hoshinomai.jp/terms-of-use/" target="_blank" rel="noopener noreferrer">利用規約</a>と<br class="sp"><a
							href="https://hoshinomai.jp/privacy" target="_blank" rel="noopener noreferrer">プライバシーポリシー</a>に同意したものとみなされます。</p>
				</div>
			</div>
		</form>
	</section>
</div>
@endsection

@section('script')
<script src="{{ asset('front/assets/js/personal-appraisal-form.js') }}"></script>
@endsection