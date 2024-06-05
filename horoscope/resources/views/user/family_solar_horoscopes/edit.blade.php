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
                <div class="Pageframe-main-header__first"><a href="{{ route('user.popup') }}">マイページ</a></div>
                <h2 class="Pageframe-main-header__pagename">家族のホロスコープ</h2>
            </header>

            <div class="Pageframe-main__inner">
                <div class="Pageframe-main-content">
                    <!-- ***** セクション名 ***** -->
                    <section class="sec Familyhoroscope--detail" id="Familyhoroscope-detail">
                        <h2 class="Pageframe-main__title">Family Solar return
                            <img src="{{ asset('mypage/assets/images/familyhoroscope/img_title.svg') }}" alt="FAMILY HOROSCOPE" class="pc">
                            <img src="{{ asset('mypage/assets/images/familyhoroscope/sp_img_title.svg') }}" alt="FAMILY HOROSCOPE" class="sp"></h2>
                        <div class="Pageframe-main__body">
                            <div class="C-user-list">
                                <div class="C-user-list-block">
                                    <span class="C-user-list-block__inner">
                                        <h3 class="C-user-list-block__title" data-tag="Name">{{ $family->name1 }} {{ $family->name2 }}</h3>
                                        <div class="C-user-list-block__content">
                                            <p class="C-user-list-block__item" data-tag="Relationship">{{ $family->relationship }}</p>
                                            <p class="C-user-list-block__item" data-tag="Birthday">{{ $family->birthday->format('Y / m / d') }}</p>
                                            <p class="C-user-list-block__item" data-tag="Birth Time">{{ $family->birthday_time->format('H : i') }}</p>
                                            <p class="C-user-list-block__item" data-tag="Location">{{ $family->birthday_prefectures }}</p>
                                        </div>
                                        @include('components.parts.error')
                                        @if (Session::has('flash_alert'))
                                            <p style="color: red" >{{ Session::get('flash_alert') }}</p>
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="C-horoscope-detail">
                                <div class="C-horoscope-detail-header">
                                    <!--<p class="C-horoscope-detail__title font">Horoscope Chart</p>-->
                                    <div class="C-horoscope-detail-horoscope">
                                        <img src="data:image/png;base64, {{ $imgBase64 }}" alt="ホロスコープ">
                                    </div>
                                </div>
                                <div class="C-horoscope-detail__inner">
                                    <div class="C-horoscope-detail__position">
                                        <p class="C-horoscope-detail__title font">Position</p>
                                        <div class="C-horoscope-detail__body">
                                            @foreach ($degreeData->get('planets') as $planet)
                                                <div class="C-horoscope-detail__position__item">
                                                    <p
                                                        class="C-horoscope-detail__position__title C-horoscope-detail__position__title--{{ $planets->where('id', $planet->get('planet_num'))->pluck('class_name')->first() }}">
                                                        <span>{{ $planets->where('id', $planet->get('planet_num'))->pluck('name')->first() }}</span></p>
                                                    <p
                                                        class="C-horoscope-detail__position__text C-horoscope-detail__position__text--{{ $zodiacs->where('id', $planet->get('zodiac_num'))->pluck('class_name')->first() }} on">
                                                        <span>{{ $zodiacs->where('id', $planet->get('zodiac_num'))->pluck('name')->first() }} {{ $planet->get('sabian_degrees_dms')->get('degrees') . '°' . $planet->get('sabian_degrees_dms')->get('minnute') . "'" . $planet->get('sabian_degrees_dms')->get('second') . '"' }}</span></p>
                                                </div>
                                            @endforeach
                                            @foreach ($degreeData->get('houses') as $house)
                                                @if ($house->get('number') == 1 or $house->get('number') == 10)
                                                    <div class="C-horoscope-detail__position__item">
                                                        <p
                                                            class="C-horoscope-detail__position__title">
                                                            <span>{{$house->get('name') }}</span></p>
                                                        <p
                                                            class="C-horoscope-detail__position__text C-horoscope-detail__position__text--{{ $zodiacs->where('id', $house->get('zodiac_num'))->pluck('class_name')->first() }} on">
                                                            <span>{{ $zodiacs->where('id', $house->get('zodiac_num'))->pluck('name')->first() }} {{ $house->get('sabian_degrees_dms')->get('degrees') . '°' . $house->get('sabian_degrees_dms')->get('minnute') . "'" . $house->get('sabian_degrees_dms')->get('second') . '"' }}</span></p>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="C-horoscope-detail__boundarie">
                                        <p class="C-horoscope-detail__title font">Boundarie</p>
                                        <div class="C-horoscope-detail__body">
                                            @foreach ($degreeData->get('houses') as $house)
                                                <div class="C-horoscope-detail__position__item">
                                                    <p class="C-horoscope-detail__boundarie__text C-horoscope-detail__boundarie--{{ $houses->where('id', $house->get('number'))->pluck('class_name')->first() }}" data-tag="{{ $houses->where('id', $house->get('number'))->pluck('name')->first() }}">
                                                        <span>{{ $zodiacs->where('id', $house->get('zodiac_num'))->pluck('name')->first() }} {{ $house->get('sabian_degrees_dms')->get('degrees') . '°' . $house->get('sabian_degrees_dms')->get('minnute') . "'" . $house->get('sabian_degrees_dms')->get('second') . '"' }}</span>
                                                    </p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="C-back"><a href="{{ route('user.family_list.index') }}"><span>家族のホロスコープ一覧へ戻る</span></a></div>
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
