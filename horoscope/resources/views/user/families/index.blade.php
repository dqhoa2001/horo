@extends('layouts.user.mypage.app')

@section('css')
<link rel="stylesheet" href="{{ asset('mypage/assets/css/familyhoroscope.css') }}">
@endsection

@section('content')
<div class="Pageframe">
    @include('components.parts.side_header')
    <main class="Pageframe-main">
        @include('components.parts.top_header')

        <div class="Pageframe-main__scroll">
            <header class="Pageframe-main-header">
                <div class="Pageframe-main-header__first"><a href="{{ route('user.coupon') }}">マイページ</a></div>
                <h2 class="Pageframe-main-header__pagename">家族のホロスコープ</h2>
            </header>

            <div class="Pageframe-main__inner">
                <div class="Pageframe-main-content">
                    <!-- ***** セクション名 ***** -->
                    <section class="sec Familyhoroscope--list" id="Familyhoroscope--list">
                        <h2 class="Pageframe-main__title"><img src="{{ asset('mypage/assets/images/familyhoroscope/img_title.svg') }}" alt="FAMILY HOROSCOPE" class="pc"><img src="{{ asset('mypage/assets/images/familyhoroscope/sp_img_title.svg') }}" alt="FAMILY HOROSCOPE" class="sp"></h2>
                        <p class="Pageframe-main__firstmessage">作成した家族のホロスコープチャートをいつでも確認できます。<br>最大20名までのホロスコープが保存可能です。</p>
                        <div class="Pageframe-main__body">
                            <div class="C-user-list">
                                <div class="C-user-list-block">
                                    @foreach ($families as $family)
                                        <a href="{{ route('user.families.edit', $family) }}" class="C-user-list-block__inner">
                                            <h3 class="C-user-list-block__title" data-tag="Name"><span>{{ $family->name1 }} {{ $family->name2 }}</span>さん</h3>
                                            <div class="C-user-list-block__content">
                                                <p class="C-user-list-block__item" data-tag="Relationship">{{ $family->relationship }}</p>
                                                <p class="C-user-list-block__item" data-tag="Birthday">{{ $family->birthday->format('Y / m / d') }}</p>
                                                <p class="C-user-list-block__item" data-tag="Birth Time">{{ $family->birthday_time->format('H : i') }}</p>
                                                <p class="C-user-list-block__item" data-tag="Location">{{ $family->birthday_prefectures }}</p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="C-horoscope-create flexSB">
                                <div class="Button Button--lightblue"><a href="{{ route('user.families.create') }}">家族のホロスコープを作成する</a></div>
                                <p class="C-horoscope-create__text">ご家族の生まれた瞬間のホロスコープを出すためには<br>生まれた時間を「分」まで、<br>場所を「市」まで正しく入力してください。</p>
                            </div>
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
