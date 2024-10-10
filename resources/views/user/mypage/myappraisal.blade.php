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
						<h2 class="Pageframe-main__title"><img src="{{ asset('mypage/assets/images/myappraisal/img_title.svg') }}"
								alt="PERSONAL APPRAISAL"></h2>
						<p class="Pageframe-main__firstmessage">真奈美さんの個人鑑定をします。<br>個人鑑定をすることで、自分の星をより深く理解することができます。</p>
						<div class="Pageframe-main__body">
							<div class="C-appraisal-item">
								<div class="C-appraisal-item__body">
									作成前
								</div>
								<div class="C-appraisal-item-entry">
									<p class="C-appraisal-item-entry__price" data-en="Price">8,800円<span
											class="C-appraisal-item-entry__price__tax">(税込)</span></p>
									<p class="C-appraisal-item-entry__text">支払い方法：クレジットカード</p>
									<div class="Button Button--blue2"><a href="#">個人鑑定に申し込む</a></div>
								</div>
							</div>
							<figure class="C-appraisal-banner">
								<a href="#">
									<img src="{{ asset('mypage/assets/images/my/img_bookbanner.png') }}"
										srcset="{{ asset('mypage/assets/images/my/img_bookbanner.png 1x') }}, {{ asset('mypage/assets/images/my/img_bookbanner@2x.png 2x') }}"
										alt="製本" class="pc"><img src="{{ asset('mypage/assets/images/my/sp_img_bookbanner.png') }}"
										srcset="{{ asset('mypage/assets/images/my/sp_img_bookbanner.png 1x') }}, {{ asset('mypage/assets/images/my/sp_img_bookbanner@2x.png 2x') }}"
										alt="製本" class="sp">
								</a>
							</figure>
							{{-- 個人鑑定履歴 --}}
							<div class="C-appraisal-history">
								<h3 class="C-appraisal-history__title"><span>個人鑑定履歴</span></h3>
								<div class="C-appraisal-history__inner">
									@foreach ($allAppraisalApplies as $appraisalApply)
									<div class="C-appraisal-history-block">
										<a href="{{ route('user.appraisals.showPersonalAppraisal', $appraisalApply) }}">
											<time class="C-appraisal-history-block__time" datetime="{{ auth()->user()->birthday }}">{{
												auth()->user()->birthday }}</time>
											<p class="C-appraisal-history-block__title">
												{{ auth()->user()->full_name }}さんの個人鑑定
											</p>
										</a>
									</div>
									@endforeach
								</div>
							</div>
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