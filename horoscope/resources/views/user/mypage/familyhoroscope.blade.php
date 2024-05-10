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
						<section class="sec Familyhoroscope" id="Familyhoroscope">
							<h2 class="Pageframe-main__title"><img src="{{ asset('mypage/assets/images/familyappraisal/img_title.svg') }}" alt="PERSONAL FAMILY APPRAISAL" class="pc"><img src="{{ asset('mypage/assets/images/familyappraisal/sp_img_title.svg') }}" alt="PERSONAL FAMILY APPRAISAL" class="sp"></h2>
							<p class="Pageframe-main__firstmessage">真奈美さんの家族のホロスコープチャートを作成します。<br>大切な人のホロスコープを最大20名までの保存することができます。</p>
							<div class="Pageframe-main__body">
								<div class="C-horoscope-create flexSB">
									<div class="Button Button--lightblue"><a href="./familyhoroscope-create.html">家族のホロスコープを作成する</a></div>
									<p class="C-horoscope-create__text">ご家族の生まれた瞬間のホロスコープを出すためには<br class="pc">生まれた時間を「分」まで、<br>場所を「市」まで正しく入力してください。</p>
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