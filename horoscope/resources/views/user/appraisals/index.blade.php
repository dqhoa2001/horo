@extends('layouts.user.mypage.app')

@section('css')
<link rel="stylesheet" href="{{ asset('mypage/assets/css/myappraisal.css') }}">
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
                        <p class="Pageframe-main__firstmessage fcolor3">太陽回帰をご購入ご希望のお客様には、先 <br>に個人鑑定の購入をお願いしております。</p>
						<h2 class="Pageframe-main__title">
                            <picture>
                                <source srcset="{{ asset('mypage/assets/images/myappraisal/img_title_sp.svg') }}"
                                    media="(max-width: 600px)">
                                <img src="{{ asset('mypage/assets/images/myappraisal/img_title_pc.svg') }}" alt="PERSONAL APPRAISAL">
                            </picture>
						</h2>
						<p class="Pageframe-main__firstmessage">{{ auth()->user()->full_name }}さんの個人鑑定をします。<br>個人鑑定をすることで、自分の星をより深く理解することができます。</p>
						<div class="Pageframe-main__body">
							{{-- <div class="C-appraisal-item">
								<div class="C-appraisal-item__body">
									作成前
								</div>
								<div class="C-appraisal-item-entry">
									<p class="C-appraisal-item-entry__price" data-en="Price">{{ number_format($appraisal->price) }}円<span
											class="C-appraisal-item-entry__price__tax">(税込)</span></p>
									<p class="C-appraisal-item-entry__text">支払い方法：クレジットカード、銀行振込</p>
									<div class="Button Button--blue2"><a
											href="{{ route('user.appraisals.create') }}">個人鑑定に申し込む</a></div>
								</div>
							</div> --}}

							<!-- 鑑定バナー -->
							@include('components.parts.user.appraisal_apply_baner')

							{{-- 製本バナー --}}
							@include('components.parts.user.appraisal_apply_common_baner')
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
