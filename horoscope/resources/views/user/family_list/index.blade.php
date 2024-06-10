@extends('layouts.user.mypage.app')

@section('css')
<link rel="stylesheet" href="{{ asset('mypage/assets/css/familylist.css') }}">

@endsection

@section('content')
<div class="Pageframe">
    @include('components.parts.side_header')
    <main class="Pageframe-main">
        @include('components.parts.top_header')
        <div class="Pageframe-main__scroll">
            <header class="Pageframe-main-header">
                <div class="Pageframe-main-header__first"><a href="{{ route('user.popup') }}">マイページ</a></div>
                <h2 class="Pageframe-main-header__pagename">家族一覧</h2>
            </header>

            <div class="Pageframe-main__inner">
                <div class="Pageframe-main-content">
                    <!-- ***** セクション名 ***** -->
                    <section class="sec Familyappraisal--list" id="Familyappraisal--list">
                        <h2 class="Pageframe-main__title"><img src="{{ asset('mypage/assets/images/familylist/img_title.svg') }}" alt="PERSONAL FAMILY APPRAISAL" class="pc"><img src="{{ asset('mypage/assets/images/familylist/sp_img_title.svg') }}" alt="PERSONAL FAMILY APPRAISAL" class="sp"></h2>
                        {{-- <h2 class="Pageframe-main__title result"><img
                                src="{{ asset('mypage/assets/images/familyappraisal/pc-result-family-appraisal.svg') }}"
                        alt="PERSONAL FAMILY APPRAISAL" class="pc"><img src="{{ asset('mypage/assets/images/familyappraisal/sp-result-family-appraisal.svg') }}" alt="PERSONAL FAMILY APPRAISAL" class="sp"></h2> --}}
                        <p class="Pageframe-main__firstmessage">作成した家族のホロスコープチャート·鑑定結果をいつでも確認できます。<br>最大 20名までのホロスコープと鑑定結果が保存可能です。</p>
                        <div class="Pageframe-main__body">
                            <div class="C-user-list">
                                @foreach ($families as $family)
                                    <div class="C-user-list-block">
                                        <div class="C-user-list-block__inner C-user-list-block__hasimage">
                                            <div class="C-user-list-block__hasimage__inner">
                                                <h3 class="C-user-list-block__title" data-tag="Name"><span>{{
                                                            $family->name1 }} {{
                                                            $family->name2 }}</span>さん</h3>
                                                <div class="C-user-list-block__content">
                                                    <p class="C-user-list-block__item" data-tag="Relationship">{{
                                                            $family->relationship }}</p>
                                                    <p class="C-user-list-block__item" data-tag="Birthday">{{
                                                            $family->birthday->format('Y / m / d') }}</p>
                                                    <p class="C-user-list-block__item" data-tag="Birth Time">{{
                                                            $family->birthday_time->format('H : i') }}</p>
                                                    <p class="C-user-list-block__item" data-tag="Location">{{
                                                            $family->birthday_prefectures }} {{
                                                            $family->birthday_city }}</p>
                                                </div>
                                            </div>
                                            <div>
                                                @if ($family->appraisalApplies()->where('solar_return','!=',0)->whereHas('appraisalClaim')->exists())
                                                <a href="{{ route('user.solar_appraisals.show', $family->appraisalApplies()->where('solar_return','!=',0)->latest()->first()) }}" class="button solar-return">
                                                    <img src="{{ asset('mypage/assets/images/familylist/title_button_solar.png') }}" alt="">
                                                </a>
                                                @endif
                                                @if ($family->appraisalApplies()->where('solar_return',0)->whereHas('appraisalClaim')->exists())
                                                <a href="{{ route('user.family_appraisals.show', $family->appraisalApplies()->first()) }}" class="button stellar-blueprint">
                                                    <img src="{{ asset('mypage/assets/images/familylist/title_button_stellar.png') }}" alt="">
                                                </a>
                                                @endif
                                                <a href="{{ route('user.families.edit', $family) }}" class="button horoscope">
                                                    <p>ホロスコープを見る</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="C-horoscope-create flexSB m-20">
                                    <div class="Button Button--lightblue top-14"><a href="{{ route('user.families.create') }}">家族のホロスコープを作成する</a></div>
                                    <p class="C-horoscope-create__text">ご家族の生まれた瞬間のホロスコープを出すためには<br>生まれた時間を「分」まで、<br>場所を「市」まで正しく入力してください。</p>
                                </div>
                                <div class="C-horoscope-create flexSB m-20">
                                    <div class="Button btn-stellar"><a href="{{ route('user.appraisals.create', ['target_type' => str_contains(Request::url(), 'family_list') ? '2' : '']) }}" class="text-end">家族の個人鑑定をする</a></div>
                                    <p class="C-horoscope-create__text">魂の青写真であるStellar Blueprintは、<br>より深い自分への理解を得ることができます。</p>
                                </div>
                                <div class="C-horoscope-create flexSB m-20">
                                    <div class="btn-offer-solar">
                                        <a href="{{ route('user.family_appraisals.offer_solar') }}">
                                            <picture>
                                                <source srcset="{{ asset('mypage/assets/images/familylist/small-solar-return-offer-button.png') }}"media="(max-width: 500px)">
                                                <img src="{{ asset('mypage/assets/images/familylist/solar-return-offer-button.png') }}" alt="">
                                            </picture>
                                        </a>
                                    </div>
                                    <p class="C-horoscope-create__text">1年間の期間で星を読むことで、<br>より詳細な運勢を見ることができます。</p>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            @include('components.parts.footer')
        </div>
    </main>
</div>
@endsection
