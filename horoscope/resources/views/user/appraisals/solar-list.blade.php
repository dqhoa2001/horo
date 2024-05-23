@extends('layouts.user.mypage.app')

@section('css')
<link rel="stylesheet" href="{{ asset('mypage/assets/css/familyhoroscope.css') }}">
@endsection

@section('content')
	<div class="Pageframe">

		@include('components.parts.side_header')


		<main class="Pageframe-main">

			@include('components.parts.top_header')


			<div class="Pageframe-main__scroll">

				<header class="Pageframe-main-header">
					<div class="Pageframe-main-header__first"><a href="{{ route('user.popup') }}">マイページ</a></div>
					<h2 class="Pageframe-main-header__pagename">家族のホロスコープ</h2>
				</header>

				<div class="Pageframe-main__inner">
					<div class="Pageframe-main-content">
						<!-- ***** セクション名 ***** -->
						<section class="sec Familyhoroscope--list" id="Familyhoroscope--list">
							<!-- <h2 class="Pageframe-main__title"><img src="{{ asset('mypage/assets/images/familyhoroscope/img_title.svg') }}" alt="FAMILY HOROSCOPE" class="pc"><img src="{{ asset('mypage/assets/images/familyhoroscope/sp_img_title.svg') }}" alt="FAMILY HOROSCOPE" class="sp"></h2> -->
							<h1 class="Pageframe-main__title">Danh sách năm mặt trời hồi quy</h1>
                            <!-- <p class="Pageframe-main__firstmessage">作成した家族のホロスコープチャートをいつでも確認できます。<br>最大20名までのホロスコープが保存可能です。</p> -->
							<div class="Pageframe-main__body">
								<div class="C-user-list">
									<div class="C-user-list-block">
										<a href="./familyhoroscope-detail.html" class="C-user-list-block__inner">
											<h3 class="C-user-list-block__title" data-tag="Name"><span>川端 百合子</span>さん</h3>
											<div class="C-user-list-block__content">
												<p class="C-user-list-block__item" data-tag="Relationship">実母</p>
												<p class="C-user-list-block__item" data-tag="Birthday">1960 / 4 / 10</p>
												<p class="C-user-list-block__item" data-tag="Birth Time">2 : 50</p>
												<p class="C-user-list-block__item" data-tag="Location">岐阜県 笠松町</p>
											</div>
										</a>
									</div>
									<div class="C-user-list-block">
										<a href="./familyhoroscope-detail.html" class="C-user-list-block__inner">
											<h3 class="C-user-list-block__title" data-tag="Name"><span>川端 百合子</span>さん</h3>
											<div class="C-user-list-block__content">
												<p class="C-user-list-block__item" data-tag="Relationship">実母</p>
												<p class="C-user-list-block__item" data-tag="Birthday">1960 / 4 / 10</p>
												<p class="C-user-list-block__item" data-tag="Birth Time">2 : 50</p>
												<p class="C-user-list-block__item" data-tag="Location">岐阜県 笠松町</p>
											</div>
										</a>
									</div>
									<div class="C-user-list-block">
										<a href="./familyhoroscope-detail.html" class="C-user-list-block__inner">
											<h3 class="C-user-list-block__title" data-tag="Name"><span>川端 百合子</span>さん</h3>
											<div class="C-user-list-block__content">
												<p class="C-user-list-block__item" data-tag="Relationship">実母</p>
												<p class="C-user-list-block__item" data-tag="Birthday">1960 / 4 / 10</p>
												<p class="C-user-list-block__item" data-tag="Birth Time">2 : 50</p>
												<p class="C-user-list-block__item" data-tag="Location">岐阜県 笠松町</p>
											</div>
										</a>
									</div>
									<div class="C-user-list-block">
										<a href="./familyhoroscope-detail.html" class="C-user-list-block__inner">
											<h3 class="C-user-list-block__title" data-tag="Name"><span>川端 百合子</span>さん</h3>
											<div class="C-user-list-block__content">
												<p class="C-user-list-block__item" data-tag="Relationship">実母</p>
												<p class="C-user-list-block__item" data-tag="Birthday">1960 / 4 / 10</p>
												<p class="C-user-list-block__item" data-tag="Birth Time">2 : 50</p>
												<p class="C-user-list-block__item" data-tag="Location">岐阜県 笠松町</p>
											</div>
										</a>
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
