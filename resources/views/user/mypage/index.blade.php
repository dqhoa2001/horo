@extends('layouts.user.mypage.app')

@section('css')
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
					<h2 class="Pageframe-main-header__pagename">MYホロスコープチャート</h2>
				</header>
				
				<div class="Pageframe-main__inner">
					<div class="Pageframe-main-content">
					</div>
				</div>

				@include('components.parts.footer')

				
			</div>

		</main>

	</div>
@endsection