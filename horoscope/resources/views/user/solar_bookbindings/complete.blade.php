@extends('layouts.user.mypage.app')
@section('google-tag-manager')
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-NW33V4RS');</script>
	<!-- End Google Tag Manager -->
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('mypage/assets/css/personal-solar-appraisal-form.css') }}">
@endsection

@section('content')
<div class="Pageframe">
	@include('components.parts.side_header')
	<main class="Pageframe-main">
		@include('components.parts.top_header')
		<div class="Pageframe-main">
			<div class="Pageframe-main-complete__inner">
				<div class="Pageframe-main-content">
					<section class="sec Offer C-form" id="Offer">
						<p class="C-form__message C-form-line C-form-line--first">
							<span class="C-form__message__req">製本申し込み完了</span>
						</p>
						<p class="C-form-block--text">
							{{-- 製本申し込みが完了いたしました。<br>
							申し込みありがとうございました。 --}}
							製本のお申し込みが完了しました。<br>
							ありがとうございました。<br>
							ご登録のメールアドレスに、発送のご案内をお送りいたしますのでご確認下さい。
						</p>
						@if((int)$payment_type === \App\Models\AppraisalClaim::BANK)
                        <!--銀行振り込みの場合-->
                            <p class="C-form-block--text">
                                銀行振込の方は、会員様のメールアドレスへ振込先のご案内を<br>
								お送りしておりますのでご確認ください。<br>
								お振込み確認後、発送作業に入らせて頂きます。
                            </p>
                        @endif
						<div class="Button Button--lightblue btn-block-mt">
							<a href="{{ route('user.popup') }}">
								マイページへ戻る
							</a>
						</div>
					</section>

				</div>
			</div>
		</div>
        @include('components.parts.footer')
	</main>
</div>
@endsection
