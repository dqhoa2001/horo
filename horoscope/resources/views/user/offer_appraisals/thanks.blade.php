@extends('layouts.user.front.app')
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
<link rel="stylesheet" href="{{ asset('front/assets/css/form.css') }}">
@endsection

@section('content')
<div class="maxwidth sp_maxwidth">
    <section class="sec Offer C-form" id="Offer">
        <div class="card-body">
            <div class="alert alert-success" role="alert">
                会員登録が完了致しました。 
            </div>
            <p class="C-form__message C-form-line C-form-line--first">
                <span class="C-form__message__req">このたびは、会員登録をして頂き誠にありがとうございます。</span>
            </p>
            <p class="C-form__message C-form-line C-form-line--first">
                ご記入頂いたメールアドレスへ、購入完了メールをお送りしております。 <br>
                しばらく経ってもメールが届かない場合は、入力頂いたメールアドレスが間違っているか、迷惑メールフォルダに振り分けられている可能性がございます。<br>
                ご確認お願いします。
            </p>
            <p class="C-form__message C-form-line C-form-line--first">
                <span class="C-form__message__req"> ▼ログインはこちら</span><br>
                <a href="{{ route('user.login') }}">{{ route('user.login') }}</a><br>
                ※ログインメールアドレス、パスワードは申し込み時にご記入頂いた内容でログインできます。
            </p>
        </div>

    </section>
</div>
@endsection
