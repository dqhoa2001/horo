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
                <h2 class="Pageframe-main-header__pagename">お問い合わせ</h2>
            </header>

            <div class="Pageframe-main__inner">
                <div class="Pageframe-main-content">
                    <!-- ***** セクション名 ***** -->
                    <section class="sec Contact C-form" id="Contact">
                        <h2 class="Pageframe-main__title"><img
                                src="{{ asset('mypage/assets/images/contact/img_title.svg') }}" alt="CONTACT"></h2>
                        <p class="C-form__message C-form__contact-title">下記フォームの<span
                                class="C-form__message__req">必須項目</span>をご記入の上、お問い合わせください。<br>なお、鑑定結果に関する個別のご相談にはお答えいたしかねますので<br>あらかじめご承知おきください。</p>
                        <form action="{{ route('user.contacts.confirm') }}" method="POST">
                            @csrf
                            <div class="C-form-block__wrap">
                                <dl class="C-form-block C-form-block--type">
                                    <dt class="C-form-block__title C-form-block__title--req">お問い合わせ種別</dt>
                                    <dd class="C-form-block__body">
                                        <div class="C-form-block__radio">
                                            @foreach ($inquiryTypes as $inquiryType)
                                            <label class="C-form-block__radio__item">
                                                <input type="radio" name="inquiry_type_id"
                                                    id="inquiry_type_id{{ $inquiryType->id }}"
                                                    value="{{ $inquiryType->id }}" {{ old('inquiry_type_id',
                                                    $request->inquiry_type_id ?? '') == $inquiryType->id ? 'checked' :
                                                '' }}>
                                                <span class="C-form-block__radio__text">{{ $inquiryType->name }}</span>
                                            </label>
                                            @endforeach
                                        </div>
                                    </dd>
                                </dl>
                                <dl class="C-form-block C-form-block--comment">
                                    <dt class="C-form-block__title C-form-block__title--req">お問い合わせ内容</dt>
                                    <dd class="C-form-block__body">
                                        <div class="C-form-block__textarea">
                                            <textarea name="content" placeholder="お問い合わせの内容をご記入ください。"
                                                required>{{ old('content', $request->content ?? '') }}</textarea>
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                            <div class="C-form-policy">
                                <div class="C-form-policy__inner">
                                    <div class="C-form-policy-block">
                                        <div class="C-form-block__checkbox">
                                            <label class="C-form-block__checkbox__item">
                                                <input type="checkbox" name="terms_of_service" value="利用規約を確認しました。">
                                                <span class="C-form-block__checkbox__text"><a href="https://hoshinomai.jp/terms-of-use/"
                                                        target="_blank">利用規約</a>を確認しました。</span>
                                            </label>
                                            @include('components.form.error', ['name' => 'terms_of_service'])
                                        </div>
                                    </div>
                                    <div class="C-form-policy-block">
                                        <div class="C-form-block__checkbox">
                                            <label class="C-form-block__checkbox__item">
                                                <input type="checkbox" name="personal_information" value="個人情報保護方針を確認しました。">
                                                <span class="C-form-block__checkbox__text"><a href="https://hoshinomai.jp/privacy"
                                                        target="_blank">個人情報保護方針</a>を確認しました。</span>
                                            </label>
                                            {{-- @error('rule')
                                            <p class="C-form-block__error text-danger"> {{ $message }}</p>
                                            @enderror --}}
                                            @include('components.form.error', ['name' => 'personal_information'])
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="Button Button--lightblue"><span>入力内容を確認する</span></button>
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