@extends('layouts.user.front.app')
{{-- @extends('layouts.user.horoscope.app') --}}

@section('css')
<!-- Front-design-login -->
<link rel="stylesheet" href="{{ asset('front/assets/css/login.css') }}">
@endsection

@section('content')


{{-- 旧ログイン --}}
<div class="maxwidth460 sp_maxwidth">
	<section class="sec Login" id="Login">
		<form method="POST" action="{{ route('user.login') }}">
			@csrf
			<div class="Login-main">
				@include('components.parts.original_flash_message')
				<div class="Login-main__inner">

					<div class="top-logo">
						<a href="https://hoshinomai.jp/" target="_blank" rel="noopener noreferrer">
							<img src="{{ asset('images/common/top-logo.svg') }}" alt="" width="200" >
						</a>
					</div>
					
					<!-- メールアドレス -->
					<dl class="Login-main-block Login-main-top--email">
						<dt class="Login-main-block__title">{{ __('Email Address') }}</dt>
						<dd class="Login-main-block__body">
							<div class="Login-main-block__field">
								<input type="email" id="email" name="email" class="@error('email') is-invalid @enderror"
									value="{{ old('email') }}" required autocomplete="email" autofocus>
								@error('email')
								<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</dd>
					</dl>
					<!-- パスワード -->
					<dl class="Login-main-block Login-main-top--password">
						<dt class="Login-main-block__title">{{ __('Password') }}</dt>
						<dd class="Login-main-block__body">
							<div class="Login-main-block__field">
								<input type="password" id="password" name="password" class="@error('password') is-invalid @enderror"
									required autocomplete="current-password">
								@error('password')
								<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</dd>
					</dl>
				</div>

				<!-- ログイン状態を保持する -->
				<div class="Login-main-keep">
					<div class="Login-main-keep__checkbox">
						<label class="Login-main-keep__checkbox__item">
							<input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
							<span class="Login-main-keep__checkbox__text">{{ __('Remember Me') }}</span>
						</label>
					</div>
				</div>

				<!-- ログイン -->
				<button type="submit" class="Button">
					<span>{{ __('Login') }}</span>
				</button>

				@if (app()->environment('local'))
				<!-- 開発中ログイン -->
				<div class="dev-btn-block">
					<a href="{{ route('user_dev_login') }}" class="dev-btn dev">
						開発中ログイン
					</a>
				</div>
				@endif

				@if (Route::has('user.password.request'))
				<p class="Login-main__loss">パスワードを忘れた方は、<br class="sp"><a
						href="{{ route('user.password.request') }}">パスワードの再設定</a>をしてください。</p>
				@endif

			</div>
			<div class="Login-entry">
				<div class="Login-entry__inner">
					<dl class="Login-entry-block">
						<dt class="Login-entry-block__title">はじめてご利用の方</dt>
						<dd class="Login-entry-block__body"><a href="{{ route('user.register') }}"><span>メールアドレスで登録</span></a></dd>
					</dl>
					<p class="Login-entry__text">登録またはログインすることで、<a href="https://hoshinomai.jp/terms-of-use/" target="_blank" rel="noopener noreferrer">利用規約</a>と<br class="sp"><a
						href="https://hoshinomai.jp/privacy" target="_blank" rel="noopener noreferrer">プライバシーポリシー</a>に同意したものとみなされます。</p>
				</div>
			</div>
			<div class="Login-entry">
				<div class="Login-entry__inner">

					@if(config('app.env') !== 'production')
					<dl class="Login-entry-block">
						<dt class="Login-entry-block__title">【個人鑑定】</dt>
						<dd>
							<div class="dev-btn-block">
								<a href="{{ route('user.offer_appraisals.create') }}" class="dev-btn offer-appraisal">
									個人鑑定する
								</a>
							</div>
							<p class="Login-entry__text">
								※上記のリンクは今後サイト外に設置する予定です。
							</p>
						</dd>
					</dl>
					@endif

					@if(config('app.env') !== 'production')
					<dl class="Login-entry-block" style="margin-top:30px">
						<dt class="Login-entry-block__title">【会員登録しない場合のホロスコープ】</dt>
						<dd>
							<div class="Button Button--lightblue2">
								<a href="{{ route('user.horoscopes.create') }}">
									会員登録しないホロスコープ
								</a>
							</div>
							<p class="Login-entry__text">
								※上記のリンクは今後サイト外に設置する予定です。
							</p>
						</dd>
					</dl>
					@endif

				</div>
			</div>
		</form>
	</section>
</div>




{{-- 新ログイン --}}
{{-- <div class="fixBg"></div>
<div id="container">
	<div class="loading"></div>

	<div id="gHeader">
		<div class="menuBg on">
			<div class="menu"><span class="line"></span><span class="line"></span><span class="txt01">MENU</span><span
					class="txt02">CLOSE</span></div>
		</div>
		<div class="fixLinkBg on">
			<ul>
				<li><a href="https://hoshinomai.jp/stellar-blueprint"><img
							src="https://hoshinomai.jp/wp2/wp-content/themes/hoshi/img/common/fix_link01.png" alt=""></a></li>
				<li><a href="https://hoshinomai.jp/seminar"><img
							src="https://hoshinomai.jp/wp2/wp-content/themes/hoshi/img/common/fix_link02.png" alt=""></a></li>
				<li><a href="https://hoshinomai.jp/books"><img
							src="https://hoshinomai.jp/wp2/wp-content/themes/hoshi/img/common/fix_link03.png" alt=""></a></li>
			</ul>
		</div>
	</div>

	<div class="menuBox">
		<div class="menuInfo flexB">
			<div class="menuLeft">
				<div class="listBox flexB">
					<ul class="menuList">
						<li data-num="1"><a href="https://hoshinomai.jp">TOP</a></li>
						<li data-num="2"><a href="https://hoshinomai.jp/about/">星の舞について</a><span class="sp arrow"></span>
							<ul>
								<li><a href="https://hoshinomai.jp/about/message/">海部舞のメッセージ</a></li>
								<li><a href="https://hoshinomai.jp/about/history/">これまでの歩み</a></li>
							</ul>
						</li>
						<li data-num="3"><a href="https://hoshinomai.jp/column/">星の舞コラム</a></li>
					</ul>
					<ul class="menuList">
						<li data-num="4"><a href="https://hoshinomai.jp/seminar/">セミナー</a></li>
						<li data-num="5"><a href="#">書籍一覧</a><span class="sp arrow"></span>
							<ul>
								<li><a href="https://hoshinomai.jp/books/">書籍</a></li>
								<li><a href="https://hoshinomai.jp/diary/">時刻表・手帳</a></li>
								<li><a href="https://hoshinomai.jp/cyclopedia/">事典</a></li>
							</ul>
						</li>
						<li data-num="6"><a href="https://hoshinomai.jp/horoscope/">ホロスコープ算出</a></li>
					</ul>
				</div>
				<ul class="menuUl flex" data-num="7">
					<li><a href="https://hoshinomai.jp/member/">星の舞会員について</a></li>
					<li><a href="https://hoshinomai.jp/contact/">お問い合わせ</a></li>
				</ul>
			</div>
			<div class="menuRight">
				<ul class="menuBtn">
					<li data-num="8"><a href="https://hoshinomai.jp/stellar-blueprint/"><img
								src="https://hoshinomai.jp/wp2/wp-content/themes/hoshi/img/common/menu_btn_img01.png"
								alt="インターネット個人鑑定ステラブループリント" class="pc"><img
								src="https://hoshinomai.jp/wp2/wp-content/themes/hoshi/img/common/menu_btn_img01_sp.png"
								alt="インターネット個人鑑定ステラブループリント" class="sp"></a></li>
					<li class="link" data-num="8"><a href="#">個人鑑定 BOOKサービス</a></li>
					<li data-num="9"><a href="https://hoshinomai.jp/study-map/"><img
								src="https://hoshinomai.jp/wp2/wp-content/themes/hoshi/img/common/menu_btn_img02.png"
								alt="どの順番で学べばいいの？星の舞式 占星術学習マップ" class="pc"><img
								src="https://hoshinomai.jp/wp2/wp-content/themes/hoshi/img/common/menu_btn_img02_sp.png"
								alt="どの順番で学べばいいの？星の舞式 占星術学習マップ" class="sp"></a></li>
				</ul>
			</div>
			<ul class="menuSns sp" data-num="10">
				<li><a href="https://line.me/R/ti/p/%40529qxkex" target="_blank"><img
							src="https://hoshinomai.jp/wp2/wp-content/themes/hoshi/img/common/menu_sns01.png" alt=""></a></li>
				<li><a href="https://www.youtube.com/channel/UC3zJ1uFmGtWvUQKDrHeBC9g" target="_blank"><img
							src="https://hoshinomai.jp/wp2/wp-content/themes/hoshi/img/common/menu_sns02.png" alt=""></a></li>
				<li><a href="https://www.instagram.com/mai.kaibe/?hl=ja" target="_blank"><img
							src="https://hoshinomai.jp/wp2/wp-content/themes/hoshi/img/common/menu_sns03.png" alt=""></a></li>
				<li><a href="https://twitter.com/kaibemai" target="_blank"><img
							src="https://hoshinomai.jp/wp2/wp-content/themes/hoshi/img/common/menu_sns04.png" alt=""></a></li>
				<li><a href="https://www.facebook.com/my.mai.universe/?fref=ts" target="_blank"><img
							src="https://hoshinomai.jp/wp2/wp-content/themes/hoshi/img/common/menu_sns05.png" alt=""></a></li>
				<li><a href="https://note.com/hoshinomai" target="_blank"><img
							src="https://hoshinomai.jp/wp2/wp-content/themes/hoshi/img/common/menu_sns06.png" alt=""></a></li>
			</ul>
		</div>
	</div>

	<main id="main">
		<section id="horoscope">
			<h1 class="logo">
				<a href="../">
					<img src="{{ asset('horoscope/images/horoscope/h1_img.png') }}" alt="HOROSCOPE ホロスコープ" class="pc">
					<img src="{{ asset('horoscope/images/horoscope/h1_img_sp.png') }}" alt="HOROSCOPE ホロスコープ" class="sp">
				</a>
			</h1>
			<div class="content">

				<div class="maxwidth460 sp_maxwidth">
					<section class="sec Login" id="Login">
						<form method="POST" action="{{ route('user.login') }}">
							@csrf
							<div class="Login-main">
								@include('components.parts.original_flash_message')
								<div class="Login-main__inner">
									<!-- メールアドレス -->
									<dl class="Login-main-block Login-main-top--email">
										<dt class="Login-main-block__title">{{ __('Email Address') }}</dt>
										<dd class="Login-main-block__body">
											<div class="Login-main-block__field">
												<input type="email" id="email" name="email" class="@error('email') is-invalid @enderror"
													value="{{ old('email') }}" required autocomplete="email" autofocus>
												@error('email')
												<span class="invalid-feedback text-danger" role="alert">
													<strong>{{ $message }}</strong>
												</span>
												@enderror
											</div>
										</dd>
									</dl>
									<!-- パスワード -->
									<dl class="Login-main-block Login-main-top--password">
										<dt class="Login-main-block__title">{{ __('Password') }}</dt>
										<dd class="Login-main-block__body">
											<div class="Login-main-block__field">
												<input type="password" id="password" name="password" class="@error('password') is-invalid @enderror"
													required autocomplete="current-password">
												@error('password')
												<span class="invalid-feedback text-danger" role="alert">
													<strong>{{ $message }}</strong>
												</span>
												@enderror
											</div>
										</dd>
									</dl>
								</div>
				
								<!-- ログイン状態を保持する -->
								<div class="Login-main-keep">
									<div class="Login-main-keep__checkbox">
										<label class="Login-main-keep__checkbox__item">
											<input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
											<span class="Login-main-keep__checkbox__text">{{ __('Remember Me') }}</span>
										</label>
									</div>
								</div>
				
								<!-- ログイン -->
								<button type="submit" class="Button">
									<span>{{ __('Login') }}</span>
								</button>
				
								@if (app()->environment('local'))
								<!-- 開発中ログイン -->
								<div class="dev-btn-block">
									<a href="{{ route('user_dev_login') }}" class="dev-btn dev">
										開発中ログイン
									</a>
								</div>
								@endif
				
								@if (Route::has('user.password.request'))
								<p class="Login-main__loss">パスワードを忘れた方は、<br class="sp"><a
										href="{{ route('user.password.request') }}">パスワードの再設定</a>をしてください。</p>
								@endif
				
							</div>
							<div class="Login-entry">
								<div class="Login-entry__inner">
									<dl class="Login-entry-block">
										<dt class="Login-entry-block__title">はじめてご利用の方</dt>
										<dd class="Login-entry-block__body"><a href="{{ route('user.register') }}"><span>メールアドレスで登録</span></a></dd>
									</dl>
									<p class="Login-entry__text">登録またはログインすることで、<a href="https://hoshinomai.jp/terms-of-use/">利用規約</a>と<br class="sp"><a
											href="https://hoshinomai.jp/privacy" target="_blank" rel="noopener noreferrer">プライバシーポリシー</a>に同意したものとみなされます。</p>
								</div>
							</div>
							<div class="Login-entry">
								<div class="Login-entry__inner">
									<dl class="Login-entry-block">
										<dt class="Login-entry-block__title">【個人鑑定】</dt>
										<dd>
											<div class="dev-btn-block">
												<a href="{{ route('user.offer_appraisals.create') }}" class="dev-btn offer-appraisal">
													個人鑑定する
												</a>
											</div>
											<p class="Login-entry__text">
												※上記のリンクは今後サイト外に設置する予定です。
											</p>
										</dd>
									</dl>
									<dl class="Login-entry-block" style="margin-top:30px">
										<dt class="Login-entry-block__title">【会員登録しない場合のホロスコープ】</dt>
										<dd>
											<div class="Button Button--lightblue2">
												<a href="{{ route('user.horoscopes.create') }}">
													会員登録しないホロスコープ
												</a>
											</div>
											<p class="Login-entry__text">
												※上記のリンクは今後サイト外に設置する予定です。
											</p>
										</dd>
									</dl>
								</div>
							</div>
						</form>
					</section>
				</div>

				
			</div>
		</section>
	</main>

	<footer id="gFooter">

		<section class="other animation">
			<div class="content fade">
				<h2 class="headLine02"><span class="en">OTHER</span>その他コンテンツ</h2>
				<div class="otherBox flexB">
					<div class="fBtn"><a href="https://hoshinomai.jp/horoscope/"><img
								src="https://hoshinomai.jp/wp2/wp-content/themes/hoshi/img/common/f_btn.png"
								alt="FREE HOROSCORP 無料ホロスコープ算出 生年月日・出生時間・産まれた場所を入力するだけで、あなたのホロスコープチャートを無料で作成することができます。" class="pc"><img
								src="https://hoshinomai.jp/wp2/wp-content/themes/hoshi/img/common/f_btn_sp.png"
								alt="FREE HOROSCORP 無料ホロスコープ算出 生年月日・出生時間・産まれた場所を入力するだけで、あなたのホロスコープチャートを無料で作成することができます。" class="sp"></a>
					</div>
					<div class="line"><a href="https://line.me/R/ti/p/%40529qxkex" target="_blank"><img
								src="https://hoshinomai.jp/wp2/wp-content/themes/hoshi/img/common/f_link_img.png" alt="LINE 公式アカウント"
								class="pc"><img src="https://hoshinomai.jp/wp2/wp-content/themes/hoshi/img/common/f_link_img_sp.png"
								alt="LINE 公式アカウント" class="sp"></a><span>星読みの更新や、書籍・セミナーの情報まで、友達追加しておけばいつでもお知らせを受け取れます。</span></div>
					<div class="ins">
						<h3 class="trajanpro">Instagram</h3>
						<ul class="flexB">
							<li><a href="#"><img src="https://hoshinomai.jp/wp2/wp-content/themes/hoshi/img/common/ins_photo01.jpg"
										alt=""></a></li>
							<li><a href="#"><img src="https://hoshinomai.jp/wp2/wp-content/themes/hoshi/img/common/ins_photo01.jpg"
										alt=""></a></li>
							<li><a href="#"><img src="https://hoshinomai.jp/wp2/wp-content/themes/hoshi/img/common/ins_photo01.jpg"
										alt=""></a></li>
							<li><a href="#"><img src="https://hoshinomai.jp/wp2/wp-content/themes/hoshi/img/common/ins_photo01.jpg"
										alt=""></a></li>
							<li><a href="#"><img src="https://hoshinomai.jp/wp2/wp-content/themes/hoshi/img/common/ins_photo01.jpg"
										alt=""></a></li>
							<li><a href="#"><img src="https://hoshinomai.jp/wp2/wp-content/themes/hoshi/img/common/ins_photo01.jpg"
										alt=""></a></li>
						</ul>
						<div class="comLink more"><a href="https://www.instagram.com/mai.kaibe/?hl=ja" target="_blank">MORE</a>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<div class="fBox flexB">
			<div class="fLogo"><a href="https://hoshinomai.jp"><img
						src="https://hoshinomai.jp/wp2/wp-content/themes/hoshi/img/common/f_logo.png" alt="星の舞 HOSHI NO MAI"
						class="pc"><img src="https://hoshinomai.jp/wp2/wp-content/themes/hoshi/img/common/f_logo_sp.png"
						alt="星の舞 HOSHI NO MAI" class="sp"></a></div>
			<ul class="fSns flex">
				<li><a href="https://www.youtube.com/channel/UC3zJ1uFmGtWvUQKDrHeBC9g" target="_blank"><img
							src="https://hoshinomai.jp/wp2/wp-content/themes/hoshi/img/common/f_sns_img01.png" alt=""></a></li>
				<li><a href="https://twitter.com/kaibemai" target="_blank"><img
							src="https://hoshinomai.jp/wp2/wp-content/themes/hoshi/img/common/f_sns_img02.png" alt=""></a></li>
				<li><a href="https://www.facebook.com/my.mai.universe/?fref=ts" target="_blank"><img
							src="https://hoshinomai.jp/wp2/wp-content/themes/hoshi/img/common/f_sns_img03.png" alt=""></a></li>
				<li><a href="https://note.com/hoshinomai" target="_blank"><img
							src="https://hoshinomai.jp/wp2/wp-content/themes/hoshi/img/common/f_sns_img04.png" alt=""></a></li>
			</ul>
			<div class="fInfo">
				<ul class="fNavi">
					<li><a href="https://hoshinomai.jp/terms-of-use/" target="_blank" rel="noopener noreferrer">利用規約</a><span class="pc">／</span></li>
					<li><a href="https://hoshinomai.jp/terms/" target="_blank" rel="noopener noreferrer">特定商取引に関する表記</a><span class="pc">／</span></li>
					<li><a href="https://hoshinomai.jp/privacy/" target="_blank" rel="noopener noreferrer">プライバシーポリシー</a></li>
				</ul>
				<address>Copyright &copy; HOSHI NO MAI. All rights reserved.</address>
			</div>
		</div>
	</footer>

</div> --}}
@endsection

@section('script')
<script src="{{ asset('front/assets/js/personal-appraisal-form.js') }}"></script>
@endsection
