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
						<section class="sec Familyhoroscope Familyhoroscope--create" id="Familyhoroscope--create">
							<h2 class="Pageframe-main__title"><img src="{{ asset('mypage/assets/images/familyhoroscope/img_title.svg') }}" alt="FAMILY HOROSCOPE" class="pc"><img src="{{ asset('mypage/assets/images/familyhoroscope/sp_img_title.svg') }}" alt="FAMILY HOROSCOPE" class="sp"></h2>
							<p class="Pageframe-main__firstmessage">真奈美さんの家族のホロスコープチャートを作成します。<br>大切な人のホロスコープを最大20名までの保存することができます。</p>
							<div class="Pageframe-main__body">
								<div class="C-horoscope-form">
									<form>
										<div class="C-horoscope-form__inner">
											<dl class="C-horoscope-form-block C-horoscope-form-block--name">
												<dt class="C-horoscope-form-block__title">お名前</dt>
												<dd class="C-horoscope-form-block__body">
													<div class="C-horoscope-form-field"><input type="text" name="name" placeholder="山田 花子"></div>
												</dd>
											</dl>
											<dl class="C-horoscope-form-block C-horoscope-form-block--zokugara">
												<dt class="C-horoscope-form-block__title">続柄</dt>
												<dd class="C-horoscope-form-block__body">
													<div class="C-horoscope-form-field"><input type="text" name="zokugara" placeholder="あなたとの関係"></div>
												</dd>
											</dl>
											<div class="C-horoscope-form-block-wrap C-horoscope-form-block-wrap--birth">
												<dl class="C-horoscope-form-block C-horoscope-form-block--birth">
													<dt class="C-horoscope-form-block__title">生年月日</dt>
													<dd class="C-horoscope-form-block__body">
														<div class="C-horoscope-form-field"><input type="text" name="birth" placeholder="0000/00/00"  maxlength=10 inputmode="numeric"></div>
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
											<button type="submit" class="Button Button--lightblue"><span>家族のホロスコープを作成する</span></button>
											<p class="C-horoscope-create__text">ご家族の生まれた瞬間のホロスコープを出すためには<br class="pc">生まれた時間を「分」まで、<br>場所を「市」まで正しく入力してください。</p>
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