@extends('layouts.user.mypage.app')

@section('css')
<link rel="stylesheet" href="{{ asset('mypage/assets/css/familyappraisal.css') }}">
@endsection

@section('content')
	<div class="Pageframe">

		@include('components.parts.side_header')


		<main class="Pageframe-main">

			@include('components.parts.top_header')


			<div class="Pageframe-main__scroll">

				<header class="Pageframe-main-header">
					<div class="Pageframe-main-header__first"><a href="{{ route('user.popup') }}">マイページ</a></div>
					<h2 class="Pageframe-main-header__pagename">家族の個人鑑定</h2>
				</header>

				<div class="Pageframe-main__inner">
					<div class="Pageframe-main-content">
						<!-- ***** セクション名 ***** -->
						<section class="sec Familyappraisal--list" id="Familyappraisal--list">
							<h2 class="Pageframe-main__title"><img src="{{ asset('mypage/assets/images/familyappraisal/img_title.svg') }}" alt="PERSONAL FAMILY APPRAISAL" class="pc"><img src="{{ asset('mypage/assets/images/familyappraisal/sp_img_title.svg') }}" alt="PERSONAL FAMILY APPRAISAL" class="sp"></h2>
							<p class="Pageframe-main__firstmessage">真奈美さんの家族の個人鑑定結果です。<br>大切なご家族について、より深く理解することができます。</p>
							<div class="Pageframe-main__body">
								<div class="C-user-list">
									<div class="C-user-list-block">
										<a href="#" class="C-user-list-block__inner C-user-list-block__hasimage">
											<figure class="C-user-list-block__image"><img src="{{ asset('mypage/assets/images/familyappraisal/img_thumbnail.svg') }}" alt="画像"></figure>
											<div class="C-user-list-block__hasimage__inner">
												<h3 class="C-user-list-block__title" data-tag="Name"><span>川端 百合子</span>さん</h3>
												<div class="C-user-list-block__content">
													<p class="C-user-list-block__item" data-tag="Relationship">実母</p>
													<p class="C-user-list-block__item" data-tag="Birthday">1960 / 4 / 10</p>
													<p class="C-user-list-block__item" data-tag="Birth Time">2 : 50</p>
													<p class="C-user-list-block__item" data-tag="Location">岐阜県 笠松町</p>
												</div>
											</div>
										</a>
									</div>
									<div class="C-user-list-block">
										<a href="#" class="C-user-list-block__inner C-user-list-block__hasimage">
											<figure class="C-user-list-block__image"><img src="{{ asset('mypage/assets/images/familyappraisal/img_thumbnail.svg') }}" alt="画像"></figure>
											<div class="C-user-list-block__hasimage__inner">
												<h3 class="C-user-list-block__title" data-tag="Name"><span>川端 百合子</span>さん</h3>
												<div class="C-user-list-block__content">
													<p class="C-user-list-block__item" data-tag="Relationship">実母</p>
													<p class="C-user-list-block__item" data-tag="Birthday">1960 / 4 / 10</p>
													<p class="C-user-list-block__item" data-tag="Birth Time">2 : 50</p>
													<p class="C-user-list-block__item" data-tag="Location">岐阜県 笠松町</p>
												</div>
											</div>
										</a>
									</div>
								</div>
								<div class="C-appraisal-item">
									<div class="C-appraisal-item__body">
	作成前
									</div>
									<div class="C-appraisal-item-entry">
										<p class="C-appraisal-item-entry__price" data-en="Price"><span class="C-appraisal-item-entry__discount">家族割引価格</span>8,800円<span class="C-appraisal-item-entry__price__tax">(税込)</span></p>
										<p class="C-appraisal-item-entry__text">支払い方法：クレジットカード</p>
										<div class="Button Button--lightblue2"><a href="#">家族の個人鑑定を申し込む</a></div>
									</div>
								</div>
								<figure class="C-appraisal-banner"><a href="#"><img src="{{ asset('mypage/assets/images/family/img_bookbanner.png') }}" srcset="{{ asset('mypage/assets/images/family/img_bookbanner.png 1x') }}, {{ asset('mypage/assets/images/family/img_bookbanner@2x.png 2x') }}" alt="製本" class="pc"><img src="{{ asset('mypage/assets/images/family/sp_img_bookbanner.png') }}" srcset="{{ asset('mypage/assets/images/family/sp_img_bookbanner.png 1x') }}, {{ asset('mypage/assets/images/family/sp_img_bookbanner@2x.png 2x') }}" alt="製本" class="sp"></a></figure>
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