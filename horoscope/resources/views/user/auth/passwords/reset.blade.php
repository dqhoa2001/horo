@extends('layouts.user.front.app')

@section('css')
<!-- Front-design-login -->
<link rel="stylesheet" href="{{ asset('front/assets/css/login.css') }}">
@endsection

@section('content')
<div class="maxwidth460 sp_maxwidth">
	<section class="sec Login" id="Login">
		<form method="POST" action="{{ route('user.password.update') }}">
			@csrf
			<input type="hidden" name="token" value="{{ $token }}">
			<div class="Login-main">
				<h2>パスワード再設定</h2>
				<div class="Login-main__inner" style="margin-top:30px;">
					<!-- メールアドレス -->
					<dl class="Login-main-block Login-main-top--email">
						<dt class="Login-main-block__title">メールアドレス</dt>
						<dd class="Login-main-block__body">
							<div class="Login-main-block__field">
								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
									value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
								@error('email')
								<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</dd>
					</dl>
					<!-- パスワード -->
					<dl class="Login-main-block Login-main-top--email">
						<dt class="Login-main-block__title">パスワード</dt>
						<dd class="Login-main-block__body">
							<div class="Login-main-block__field">
								<input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
									name="password" required autocomplete="new-password">
								@error('password')
								<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</dd>
					</dl>
					<!-- パスワード(確認用) -->
					<dl class="Login-main-block Login-main-top--email">
						<dt class="Login-main-block__title">パスワード(確認用)</dt>
						<dd class="Login-main-block__body">
							<div class="Login-main-block__field">
								<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
									autocomplete="new-password">
							</div>
						</dd>
					</dl>

				</div>
				<!-- パスワード再設定 -->
				<button type="submit" class="Button">
					<span>パスワード再設定</span>
				</button>
			</div>


		</form>
	</section>
</div>
@endsection

@section('script')
<script src="{{ asset('front/assets/js/personal-appraisal-form.js') }}"></script>
@endsection