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
                <h2 class="Pageframe-main-header__pagename">お問い合わせ確認</h2>
            </header>

            <div class="Pageframe-main__inner">
                <div class="Pageframe-main-content">
                    <!-- ***** セクション名 ***** -->
                    <section class="sec Contact C-form" id="Contact">
                        <h2 class="Pageframe-main__title"><img src="{{ asset('mypage/assets/images/contact/img_title.svg') }}" alt="CONTACT"></h2>
                        <p class="C-form__message">内容をご確認の上、問い合わせ送信ボタンを押してください。</p>
                        <form action="{{ route('user.contacts.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="inquiry_type_id" value="{{ $inquiryType->id }}">
                            <input type="hidden" name="content" value="{{ $params['content'] }}">
                            <div class="C-form-block__wrap">
                                <dl class="C-form-block C-form-block--type">
                                    <dt class="C-form-block__title">お問い合わせ種別</dt>
                                    <dd class="C-form-block__body">{{ $inquiryType->name }}</dd>
                                </dl>
                                <dl class="C-form-block C-form-block--comment">
                                    <dt class="C-form-block__title">お問い合わせ内容</dt>
                                    <dd class="C-form-block__body">{!! nl2br(e($params['content'])) !!}</dd>
                                </dl>
                            </div>
                            <button type="submit" class="Button Button--lightblue"><span>問い合わせ送信</span></button>
                        </form>
                        <form action="{{ route('user.contacts.back') }}" name="back" method="POST">
                            @csrf
                            <input type="hidden" name="inquiry_type_id" value="{{ $inquiryType->id }}">
                            <input type="hidden" name="content" value="{{ $params['content'] }}">
                            <button type="submit" class="previous-btn">入力画面へ戻る</button>
                        </form>
                    </section>
                    <!-- ***** セクション名 ***** -->
                </div>
            </div>
            @include('components.parts.footer')
        </div>
    </main>
</div>
@endsection
