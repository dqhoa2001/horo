@extends('layouts.user.mypage.app')

@section('css')
<link rel="stylesheet" href="{{ asset('mypage/assets/css/myappraisal.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('mypage/assets/css/appraisal_common.css') }}"> --}}
@endsection

@section('content')
<div class="Pageframe">
    @include('components.parts.side_header')
    <main class="Pageframe-main">
        @include('components.parts.top_header')
        <div class="Pageframe-main__scroll">
            <header class="Pageframe-main-header">
                <div class="Pageframe-main-header__first"><a href="{{ route('user.popup') }}">マイページ</a></div>
                <h2 class="Pageframe-main-header__pagename">個人鑑定</h2>
            </header>

            <div class="Pageframe-main__inner">
                <div class="Pageframe-main-content">
                    <!-- ***** セクション名 ***** -->
                    <section class="sec Myappraisal--detail" id="Myappraisal--detail">
                        {{-- <h2 class="Pageframe-main__title"><img src="{{ asset('mypage/assets/images/myappraisal/img_title.svg') }}"
                                alt="PERSONAL APPRAISAL"></h2> --}}
                        {{-- <h2 class="Pageframe-main__title result"><img src="{{ asset('mypage/assets/images/myappraisal/pc-result-appraisal.svg') }}"
                                alt="PERSONAL APPRAISAL"></h2> --}}
                        <h2 class="Pageframe-main__title result">
                            <img src="{{ asset('mypage/assets/images/familyappraisal/pc-result-appraisal.svg') }}"
                                alt="PERSONAL APPRAISAL"></h2>
						{{-- <h2 class="Pageframe-main__title appraisal"></h2> --}}
                        <div class="Pageframe-main__body">

                            {{-- 家族基本情報 --}}
                            @include('components.parts.user.appraisal_apply_common_info')

                            {{-- 鑑定結果 --}}
                            @include('components.parts.user.appraisal_apply_common_appraisal')

                            <div class="C-top">
                                <span class="top-span">
                                    一番上に戻る
                                </span>
                            </div>

                            {{-- 製本バナー --}}
                            @include('components.parts.user.appraisal_apply_common_baner')

                            <div class="Button Button--blue2 Button--blue-review">
                                <a href="https://hoshinomai.jp/review" target="_blank" rel="noopener noreferrer" class="btn-review">レビューを投稿する</a>
                            </div>

                            {{-- お問い合わせ --}}
                            @include('components.parts.user.appraisal_apply_common_contact')

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
