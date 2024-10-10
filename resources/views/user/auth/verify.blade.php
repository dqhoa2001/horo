@extends('layouts.user.front.app')

@section('css')
<link rel="stylesheet" href="{{ asset('front/assets/css/form.css') }}">
@endsection

@section('content')
<div class="maxwidth sp_maxwidth">
    <section class="sec Offer C-form" id="Offer">
        <div class="card-body">
            @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
            @endif
            <p class="C-form__message C-form-line C-form-line--first">
                <span class="C-form__message__req">会員登録頂き、誠にありがとうございました。</span>
            </p>
            <p class="C-form__message C-form-line C-form-line--first">
                ご記入いただいたメールアドレスに確認リンクを送信しました。<br>
                メールをご確認頂き、確認リンクを必ずクリックしてください。<br>
                メールが受信できなかった場合、下記のボタンをクリックしてください。
            </p>



            <form class="d-inline" method="POST" action="{{ route('user.verification.resend') }}">
                @csrf
                <button type="submit" class="Button"><span>確認リンクを再送信</span></button>
            </form>
            <form class="d-inline" method="POST" action="{{ route('user.reset-session') }}" style="margin-top:20px;">
                @csrf
                <button type="submit" class="Button"><span>ログイン画面へ</span></button>
            </form>


        </div>

    </section>
</div>
@endsection
