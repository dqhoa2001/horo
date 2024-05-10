@extends('layouts.user.mypage.app')

@section('css')
<link rel="stylesheet" href="{{ asset('mypage/assets/css/familyappraisal.css') }}">
@endsection

@section('content')
<div class="Pageframe">
    @include('components.parts.side_header')
    <main class="Pageframe-main">
        @include('components.parts.top_header')
        <div class="Pageframe-main__scroll">
            <header class="Pageframe-main-header">
                <div class="Pageframe-main-header__first"><a href="{{ route('user.popup') }}">マイページ</a></div>
                <h2 class="Pageframe-main-header__pagename">家族の個人鑑定</h2>
            </header>

            <div class="Pageframe-main__inner">
                <div class="Pageframe-main-content">
                    <!-- ***** セクション名 ***** -->
                    <section class="sec Familyappraisal--list" id="Familyappraisal--list">
                        <h2 class="Pageframe-main__title"><img
                                src="{{ asset('mypage/assets/images/familyappraisal/img_title.svg') }}"
                                alt="PERSONAL FAMILY APPRAISAL" class="pc"><img
                                src="{{ asset('mypage/assets/images/familyappraisal/sp_img_title.svg') }}"
                                alt="PERSONAL FAMILY APPRAISAL" class="sp"></h2>
                        {{-- <h2 class="Pageframe-main__title result"><img
                                src="{{ asset('mypage/assets/images/familyappraisal/pc-result-family-appraisal.svg') }}"
                                alt="PERSONAL FAMILY APPRAISAL" class="pc"><img
                                src="{{ asset('mypage/assets/images/familyappraisal/sp-result-family-appraisal.svg') }}"
                                alt="PERSONAL FAMILY APPRAISAL" class="sp"></h2> --}}
                        <p class="Pageframe-main__firstmessage">{{ auth()->guard('user')->user()->name2
                            }}さんの家族の個人鑑定結果です。<br>大切なご家族について、より深く理解することができます。</p>
                        <div class="Pageframe-main__body">
                            <div class="C-user-list">
                                @foreach ($familyAppraisals as $familyAppraisal)
                                <div class="C-user-list-block">
                                    <a href="{{ route('user.family_appraisals.show', $familyAppraisal) }}"
                                        class="C-user-list-block__inner C-user-list-block__hasimage">
                                        <figure class="C-user-list-block__image"><img
                                                src="{{ asset('mypage/assets/images/familyappraisal/img_thumbnail.svg') }}"
                                                alt="画像"></figure>
                                        <div class="C-user-list-block__hasimage__inner">
                                            <h3 class="C-user-list-block__title" data-tag="Name"><span>{{
                                                    $familyAppraisal->reference->name1 }} {{
                                                    $familyAppraisal->reference->name2 }}</span>さん</h3>
                                            <div class="C-user-list-block__content">
                                                <p class="C-user-list-block__item" data-tag="Relationship">{{
                                                    $familyAppraisal->reference->relationship }}</p>
                                                <p class="C-user-list-block__item" data-tag="Birthday">{{
                                                    $familyAppraisal->birthday->format('Y / m / d') }}</p>
                                                <p class="C-user-list-block__item" data-tag="Birth Time">{{
                                                    $familyAppraisal->birthday_time->format('H : i') }}</p>
                                                <p class="C-user-list-block__item" data-tag="Location">{{
                                                    $familyAppraisal->birthday_prefectures }} {{
                                                    $familyAppraisal->birthday_city }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                @endforeach
                            </div>

                            {{-- <div class="C-appraisal-item">
                                <div class="C-appraisal-item__body">作成前</div>
                                <div class="C-appraisal-item-entry">
                                    <p class="C-appraisal-item-entry__price" data-en="Price">
                                        8,800円
                                        <!-- <span class="C-appraisal-item-entry__discount">家族割引価格</span>8,800円 -->
                                        <span class="C-appraisal-item-entry__price__tax">(税込)</span>
                                    </p>
                                    <p class="C-appraisal-item-entry__text">支払い方法：クレジットカード、銀行振込</p>
                                    <div class="Button Button--lightblue2"><a
                                            href="{{ route('user.appraisals.create', ['target_type' => 2]) }}">家族の個人鑑定を申し込む</a>
                                    </div>
                                </div>
                            </div> --}}

                            <!-- 鑑定バナー -->
                            @include('components.parts.user.appraisal_apply_baner')

                            <!-- 製本バナー -->
                            @include('components.parts.user.appraisal_apply_common_baner')

                        </div>
                    </section>
                </div>
            </div>
            @include('components.parts.footer')
        </div>
    </main>
</div>
@endsection