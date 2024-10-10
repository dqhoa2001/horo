@extends('layouts.user.mypage.app')

@section('css')
<link rel="stylesheet" href="{{ asset('mypage/assets/css/myhoroscope.css') }}">
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
						<!-- ***** セクション名 ***** -->
						<section class="sec Myhoroscope Myhoroscope--create" id="Myhoroscope--create">
							<h2 class="Pageframe-main__title"><img src="{{ asset('mypage/assets/images/myhoroscope/img_title.svg') }}" alt="CREATE HOROSCOPE" class="pc"><img src="{{ asset('mypage/assets/images/myhoroscope/sp_img_title.svg') }}" alt="CREATE HOROSCOPE" class="sp"></h2>
							<p class="Pageframe-main__firstmessage">真奈美さんのホロスコープチャートを作成します。<br class="pc">真奈美さんの出生情報を入力してください。</p>
							<div class="Pageframe-main__body">
								<div class="C-horoscope-form">
									<form>
										<div class="C-horoscope-form__inner">
											<dl class="C-horoscope-form-block C-horoscope-form-block--name">
												<dt class="C-horoscope-form-block__title">お名前</dt>
												<dd class="C-horoscope-form-block__body">
													<div class="C-horoscope-form-field">川端 真奈美</div>
												</dd>
											</dl>
											<div class="C-horoscope-form-block-wrap C-horoscope-form-block-wrap--birth">
												<dl class="C-horoscope-form-block C-horoscope-form-block--birth">
													<dt class="C-horoscope-form-block__title">生年月日</dt>
													<dd class="C-horoscope-form-block__body">
														<div class="C-horoscope-form-field"><input type="text" name="birth" placeholder="0000/00/00" maxlength=10 inputmode="numeric"></div>
													</dd>
												</dl>
												<dl class="C-horoscope-form-block C-horoscope-form-block--time">
													<dt class="C-horoscope-form-block__title">時刻</dt>
													<dd class="C-horoscope-form-block__body">
														<div class="C-horoscope-form-field"><input type="text" name="time" placeholder="00:00" maxlength=5 inputmode="numeric"></div>
													</dd>
												</dl>
											</div>
											<dl class="C-horoscope-form-block C-horoscope-form-block--half C-horoscope-form-block--pref">
												<dt class="C-horoscope-form-block__title">生まれた場所</dt>
												<dd class="C-horoscope-form-block__body">
													<div class="C-horoscope-form-field"><input type="text" name="pref" placeholder="都道府県"></div>
													<div class="C-horoscope-form-field"><input type="text" name="address" placeholder="市区町村"></div>
												</dd>
											</dl>
										</div>
										<div class="C-horoscope-create flexSB">
											<button type="submit" class="Button Button--blue"><span>ホロスコープを作成する</span></button>
											<p class="C-horoscope-create__text">あなたの生まれた瞬間のホロスコープを出すためには<br class="pc">生まれた時間を「分」まで、<br>場所を「市」まで正しく入力してください。</p>
										</div>
									</form>
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