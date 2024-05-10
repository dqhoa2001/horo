@extends('layouts.user.mypage.app')

@section('css')
<link rel="stylesheet" href="{{ asset('mypage/assets/css/contact.css') }}">
@endsection

@section('content')
<div class="Pageframe">
    @include('components.parts.side_header')
    <main class="Pageframe-main">
        @include('components.parts.top_header')
        <div class="Pageframe-main__scroll">
            <header class="Pageframe-main-header">
                <div class="Pageframe-main-header__first"><a href="{{ route('user.coupon') }}">マイページ</a></div>
                <h2 class="Pageframe-main-header__pagename">お問い合わせ完了</h2>
            </header>

            <div class="Pageframe-main__inner">
                <div class="Pageframe-main-content">
                    <!-- ***** セクション名 ***** -->
                    <section class="sec Contact C-form" id="Contact">
                        <p class="C-form__message">問い合わせを受け付けました</p>
                        <div class="C-form-block__wrap">
                            <dl class="C-form-block C-form-block--type">
                                <dd class="C-form-block__body">
                                    お問い合わせありがとうございます。<br>
                                    内容を確認の上、担当者よりご連絡させていただきますので、しばらくお待ちください。<br>
                                    <br>
                                    ※鑑定結果に対する個別の質問はお受けいたしかねます。<br>
                                    ※内容によっては返信できない場合もございますので予めご了承ください。</dd>
                            </dl>
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
