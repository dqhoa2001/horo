@extends('layouts.user.mypage.app')

@section('css')
<link rel="stylesheet" href="{{ asset('mypage/assets/css/mysolarappraisals.css') }}">
<link rel="stylesheet" href="{{ asset('mypage/assets/css/solar-return.css') }}">
@endsection

@section('content')
<div class="Pageframe">

	@include('components.parts.side_header')


	<main class="Pageframe-main">

		@include('components.parts.top_header')


		<div class="Pageframe-main__scroll">

			<header class="Pageframe-main-header">
				<div class="Pageframe-main-header__first"><a href="{{ route('user.popup') }}">マイページ</a></div>
				<h2 class="Pageframe-main-header__pagename">個人鑑定</h2>
			</header>

			<div class="Pageframe-main__inner">
				<div class="Pageframe-main-content">
					<!-- ***** セクション名 ***** -->
					<section class="sec Familyappraisal" id="Familyappraisal">
						<h2 class="Pageframe-main__title">
							<!-- <img src="{{ asset('mypage/assets/images/myappraisal/solar_img_title.svg') }}" alt="PERSONAL APPRAISAL"> -->
                            <picture>
                                <source srcset="{{ asset('mypage/assets/images/solarappraisal/small_solar_img_title.svg') }}"
                                    media="(max-width: 600px)">
                                <img src="{{ asset('mypage/assets/images/solarappraisal/solar_img_title_3.svg') }}" alt="PERSONAL APPRAISAL">
                            </picture>
                        </h2>
						<p class="Pageframe-main__firstmessage">{{ auth()->user()->full_name }}さんの個人鑑定をします。<br>1 年間に絞って鑑定をすることで、より詳細な運勢を読むことができます。</p>
						<div class="Pageframe-main__body">
                        <div class="C-user-list">
                                <!-- @foreach ($SolarAppraisals as $SolarAppraisal)
                                <div class="C-user-list-block">
                                    <a href="{{ route('user.solar_appraisals.show', $SolarAppraisal) }}"
                                        class="C-user-list-block__inner C-user-list-block__hasimage">
                                        <figure class="C-user-list-block__image"><img
                                            src="{{ asset('mypage/assets/images/solar-return/img_thumbnail.svg') }}" alt="画像"></figure>
                                        <div class="C-user-list-block__hasimage__inner">
                                            <h3 class="C-user-list-block__title" data-tag="Solar Return Year"><span>{{
                                                    $SolarAppraisal->solar_date }}
                                        </div>
                                    </a>
                                </div>
                                @endforeach -->
                            </div>
                            {{--SolarDate Combobox--}}
                            @include('components.parts.user.solar_return_combobox')
							<!-- 鑑定バナー -->
							@include('components.parts.user.solar_appraisal_apply_baner')

							{{-- 製本バナー --}}
							@include('components.parts.user.solar_appraisal_apply_common_baner')
						</div>
					</section>
					<!-- ***** セクション名 ***** -->
				</div>
			</div>

			@include('components.parts.footer')


		</div>

	</main>

</div>
@endsection
