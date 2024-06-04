@extends('layouts.user.mypage.app')

@section('css')
<link rel="stylesheet" href="{{ asset('mypage/assets/css/solar-return.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('mypage/assets/css/appraisal_common.css') }}"> --}}
<!-- <link rel="stylesheet" href="{{ asset('mypage/assets/css/myhoroscope.css') }}"> -->
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
                            <!-- <img src="{{ asset('mypage/assets/images/solar-return/solar-return-appraisal.svg') }}" alt="PERSONAL APPRAISAL"> -->
                            <picture>
                                <source srcset="{{ asset('mypage/assets/images/solar-return/small-solar-return-appraisal.svg') }}"
                                    media="(max-width: 600px)">
                                <img src="{{ asset('mypage/assets/images/solar-return/solar-return-appraisal.svg') }}" alt="PERSONAL APPRAISAL">
                            </picture>
                        </h2>
						{{-- <h2 class="Pageframe-main__title appraisal"></h2> --}}
                        <div class="Pageframe-main__body">

                            {{-- ユーザーに関する基本情報 --}}
                            @include('components.parts.user.solar_appraisal_apply_common_info')
                            <!-- <p class="C-user-list__change"><span>Update Solar Year</span></p> -->
                            <br>
                            <!-- <dl class="C-form-block C-form-block--birthdata">
                                <dd class="C-form-block__body">
                                    <dl class="C-form-block-child C-form-block--birth">
                                        <dt class="C-solar-form__message">太陽回帰 鑑定年</dt>
                                        <div id="popup-horoscope">
                                        <dl class="C-form-block C-form-block--birthdata">
                                            <dd class="C-form-block__body">
                                                <dl class="C-form-block-child C-form-block--birth">
                                                <dl class="C-form-block C-form-block--birthdata">
                                                    <dd class="C-form-block__body">
                                                        <dl class="C-form-block-child C-form-block--birth">
                                                            <div>
                                                                <div style="display: flex">
                                                                    <dd class="C-form-block__select01">
                                                                        <form id="solarDateForm" action="{{ route('user.solar_appraisals.show', $solarApply->id) }}" method="GET">
                                                                            <select name="solar_date" id="solar_date" onchange="document.getElementById('solarDateForm').submit()">
                                                                                @php
                                                                                    $solarDates = $solarDates->sortByDesc(function ($yearSolarDate) use ($userBirthYear) {
                                                                                        return $yearSolarDate - $userBirthYear;
                                                                                    });
                                                                                @endphp
                                                                                @foreach ($solarDates as $yearSolarDate)
                                                                                    @php
                                                                                        $age = $yearSolarDate - $userBirthYear;
                                                                                    @endphp
                                                                                    <option value="{{ $yearSolarDate }}" {{ $solarApply->solar_date == $yearSolarDate ? 'selected' : '' }}>
                                                                                        {{ $age }} 歳 {{ $yearSolarDate }} -- {{ $yearSolarDate + 1 }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </form>
                                                                    </dd>
                                                                </div>
                                                            </div>
                                                        </dl>
                                                    </dd>
                                                </dl>
                                                </dl>
                                            </dd>
                                        </dl>
                                    </dl>
                                </dd>
                            </dl> -->
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
           <section class="C-popup C-popup--horoscope">
            <div class="C-popup__inner">
                <div class="C-popup-content">
                    <div class="C-popup-content__inner C-popup-content__scroll-inner">
                        <div class="C-horoscope-form">
                            <form action="{{ route('user.my_solar_horoscopes.update') }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <p class="C-popup--horoscope__title">Solar Year</p>
                                <div id="popup-horoscope">
                                    <div class="C-horoscope-form__inner">
                                        <dl class="C-horoscope-form-block" style="margin-bottom: 30px;">
                                            <dt class="C-horoscope-form-block__title">Solar Year</dt>
                                            <dd class="C-horoscope-form-block__body" style="display: flex;">
                                                <div class="C-horoscope-form-field" style="width: calc((100% - 1rem) / 3);">
                                                    <select id="select_year" name="solar_date">
                                                        <option value="">年</option>
                                                    </select>
                                                </div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="C-horoscope-create">
                                    <button type="submit" class="Button Button--blue"><span>保存する</span></button>
                                    <div class="Button Button--cancel"><span>キャンセル</span></div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="C-popup-close"></div>
                </div>
            </div>
        </section>
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

<script>
    Vue.createApp({
        methods: {
            data() {
                return {
                    userBirthYear: @json($userBirthYear), // Năm sinh của người dùng
                    selectedSolarDate: null // Solardate được chọn
                };
            },
        },
        mounted() {
            // 年月日を設定
            this.selectedSolarDate = @json($solarDate);
        }
    }).mount('#popup-horoscope');
</script>
@endsection


