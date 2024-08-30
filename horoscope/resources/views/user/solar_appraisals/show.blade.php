@extends('layouts.user.mypage.app')

@section('css')
{{-- <link rel="stylesheet" href="{{ asset('mypage/assets/css/contact.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('mypage/assets/css/solar-return.css') }}">
<link rel="stylesheet" href="{{ asset('mypage/assets/css/myappraisal.css') }}">
@endsection

@section('content')
<div class="Pageframe">
    @include('components.parts.side_header')
    <main class="Pageframe-main">
        @include('components.parts.top_header')
        <div class="Pageframe-main__scroll">
            <header class="Pageframe-main-header">
                <div class="Pageframe-main-header__first"><a href="{{ route('user.popup') }}">マイページ</a></div>
                <h2 class="Pageframe-main-header__pagename">
                    @if(isset($solarApply))
                        @if($solarApply->reference_type === "App\Models\Family")
                            家族の太陽回帰鑑定 結果
                        @else
                            SOLAR RETURN鑑定結果
                        @endif
                    @endif
                </h2>
            </header>

            <div class="Pageframe-main__inner">
                <div class="Pageframe-main-content">
                    <!-- ***** セクション名 ***** -->
                    <section class="sec Myappraisal--detail" id="Myappraisal--detail">
                        {{-- <h2 class="Pageframe-main__title"><img src="{{ asset('mypage/assets/images/myappraisal/img_title.svg') }}"
                                alt="PERSONAL APPRAISAL"></h2> --}}
                        {{-- <h2 class="Pageframe-main__title result"><img src="{{ asset('mypage/assets/images/myappraisal/pc-result-appraisal.svg') }}"
                                alt="PERSONAL APPRAISAL"></h2> --}}
                        <h2 class="Pageframe-main__title result logo-banner">
                            <!-- <img src="{{ asset('mypage/assets/images/solar-return/solar-return-appraisal.svg') }}" alt="PERSONAL APPRAISAL"> -->
                            <picture>
                                <source srcset="{{ asset('mypage/assets/images/solar-return/small-solar-return-appraisal.png') }}"
                                    media="(max-width: 600px)">
                                <img class="banner" src="{{ asset('mypage/assets/images/solar-return/solar-return-appraisal.png') }}" alt="SOLAR RETURN">
                            </picture>
                        </h2>
						{{-- <h2 class="Pageframe-main__title appraisal"></h2> --}}
                        <div class="Pageframe-main__body">

                            {{-- ユーザーに関する基本情報 --}}
                            @include('components.parts.user.solar_appraisal_apply_common_info')
                            <br>
                            {{--SolarDate Combobox--}}
                            @include('components.parts.user.solar_return_combobox')
                            {{-- Solar 鑑定結果 --}}
                            @include('components.parts.user.solar_appraisal_apply_common_appraisal')

                            <div class="C-top">
                                <span class="top-span">
                                    一番上に戻る
                                </span>
                            </div>

                            {{-- 製本バナー --}}
                            @include('components.parts.user.solar_return_apply_common_baner')

                            <div class="Button Button--orange2 Button--blue-review">
                                <a href="https://hoshinomai.jp/review" target="_blank" rel="noopener noreferrer" class="btn-review">レビューを投稿する</a>
                            </div>

                            {{-- お問い合わせ --}}
                            @include('components.parts.user.solar_appraisal_apply_common_contact')

                        </div>
                    </section>
                    <!-- ***** セクション名 ***** -->
                </div>
            </div>
            @include('components.parts.footer')
        <!-- ***** ポップアップ ***** -->
        </div>
    </main>
</div>
@endsection

@section('script')
<script src="{{ asset('mypage/assets/plugins/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script>
    $(window).on('load',function(){
        console.log('a');
        $(".C-popup-content__inner").mCustomScrollbar({
            callbacks:{
                onTotalScroll:function(){
                $(this).addClass('end');
            },
            onScroll:function(){
                $(this).removeClass('end');
            }
        }
    });
});
</script>
@endsection


