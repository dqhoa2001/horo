@extends('layouts.user.mypage.app')

@section('css')
<link rel="stylesheet" href="{{ asset('mypage/assets/css/bookmaking.css') }}">
@endsection

@section('content')
	<div class="Pageframe">

	@include('components.parts.side_header')


	<main class="Pageframe-main">

		@include('components.parts.top_header')


		<div class="Pageframe-main__scroll">


			<div class="Pageframe-main__inner">
				<div class="Pageframe-main-content">
					<!-- ***** セクション名 ***** -->
					<h2 style="font-size:30px; margin-bottom:50px;">ユーザー設定</h2>
					<h3 style="font-size:20px; margin-bottom:50px;">名前：{{ Auth::user()->getFullNameAttribute() }}さん</h3>
					<section class="sec Bookmaking C-form" id="Bookmaking">
						<div class="C-form__message"><a href="{{ route('user.emails.form') }}">メールアドレスの変更</a></div>
						@if(Route::has('user.password.request'))
						<div class="C-form__message"><a href="{{ route('user.passwords.edit') }}">パスワードの変更</a></div>
						@endif
						<div class="C-form__message"><a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a></div>
						<form id="logout-form" action="{{ route('user.logout') }}" method="post">@csrf</form>
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
@endsection