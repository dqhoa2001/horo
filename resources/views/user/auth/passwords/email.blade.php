@extends('layouts.user.front.app')

@section('css')
<!-- Front-design-login -->
<link rel="stylesheet" href="{{ asset('front/assets/css/login.css') }}">
@endsection

@section('content')
<div class="maxwidth460 sp_maxwidth">
	<section class="sec Login" id="Login">
		{{-- フラッシュメッセージ --}}
		<form method="POST" action="{{ route('user.password.email') }}">
			@csrf
			<div class="Login-main">
				@include('components.parts.original_flash_message')
				<h2>パスワード再設定</h2>
				<div class="Login-main__inner">
					<!-- パスワード -->
					<dl class="Login-main-block Login-main-top--email">
						<dt class="Login-main-block__title">{{ __('Email Address') }}</dt>
						<dd class="Login-main-block__body">
							<div class="Login-main-block__field">
								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
									value="{{ old('email') }}" required autocomplete="email" autofocus>

								@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</dd>
					</dl>

				</div>
				<!-- パスワード再設定URL送信ボタン -->
				<button type="submit" class="Button">
					<span>パスワード再設定URLを送信</span>
				</button>
			</div>


		</form>
	</section>
</div>
@endsection

@section('script')
<script src="{{ asset('front/assets/js/personal-appraisal-form.js') }}"></script>
@endsection