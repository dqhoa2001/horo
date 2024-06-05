@extends('layouts.user.mypage.app')

@section('css')
<link rel="stylesheet" href="{{ asset('mypage/assets/css/solar-return.css') }}">
<link rel="stylesheet" href="{{ asset('mypage/assets/css/myhoroscope.css') }}">
@endsection

@section('content')
<div class="Pageframe">

    @include('components.parts.side_header')


    <main class="Pageframe-main">
        @include('components.parts.top_header')
        <div class="Pageframe-main__scroll">
            <header class="Pageframe-main-header">
                <div class="Pageframe-main-header__first"><a href="{{ route('user.popup') }}">マイページ</a></div>
                <h2 class="Pageframe-main-header__pagename">太陽回帰</h2>
            </header>

            <div class="Pageframe-main__inner">
                <div class="Pageframe-main-content">
                    <!-- ***** セクション名 ***** -->
                    <section class="sec Myhoroscope--detail" id="Myhoroscope--detail">
                        <h2 class="Pageframe-main__title">MY SOLAR
                            <img src="{{ asset('mypage/assets/images/myhoroscope/img_title-detail.svg') }}" alt="My HOROSCOPE" class="pc">
                            <img src="{{ asset('mypage/assets/images/myhoroscope/sp_img_title-detail.svg') }}" alt="My HOROSCOPE" class="sp"></h2>
                          <!-- count if exits solar appraisal  -->
                        <!-- @if(auth()->guard('user')->user()->appraisalApplies->count() != 0)
                            <button class="Button Button--lightblue" onclick="window.location.href='{{ route('user.my_horoscopes.edit') }}'"><span>My Horoscope</span></button>
                        @else
                            <button class="Button Button--lightblue" onclick="window.location.href='{{ route('user.check_payment.create') }}'"><span>My Horoscope</span></button>
                        @endif -->
                        <br>
                        <br>
                        <div class="Pageframe-main__body">
                            <div class="C-user-list">
                                <div class="C-user-list-block">
                                    <span class="C-user-list-block__inner">
                                        <h3 class="C-user-list-block__title" data-tag="Name"><span>{{ auth()->guard('user')->user()->name1 }}　{{ auth()->guard('user')->user()->name2 }}</span>さん</h3>
                                        <div class="C-user-list-block__content">
                                            <p class="C-user-list-block__item" data-tag="Solar Year">{{ $solarDate }}</p>
                                            <p class="C-user-list-block__item" data-tag="Location">{{ auth()->guard('user')->user()->birthday_prefectures }}</p>
                                        </div>
                                        @include('components.parts.error')
                                        @if (Session::has('flash_alert'))
                                            <p style="color: red" >{{ Session::get('flash_alert') }}</p>
                                        @endif
                                    </span>

                                    <br>
                                    <!-- <dl class="C-form-block C-form-block--birthdata">
                                        <dd class="C-form-block__body">
                                            <dl class="C-form-block-child C-form-block--birth">
                                                <div id="popup-horoscope">
                                                <dl class="C-form-block C-form-block--birthdata">
                                                    <dd class="C-form-block__body">
                                                        <dl class="C-form-block-child C-form-block--birth">
                                                        <dl class="C-form-block C-form-block--birthdata">
                                                            <dd class="C-form-block__body">
                                                                <dl class="C-form-block-child C-form-block--birth">
                                                                    <div>
                                                                        <div class="div_right">
                                                                            <dd class="C-form-block__button2">
                                                                                <button onclick="window.location.href='{{ route('user.my_horoscopes.edit') }}'">Return My Horoscope</button>
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
                                </div>
                                <!-- <p class="C-user-list__change"><span>Update Solar Year</span></p> -->
                            </div>
                            <br>
                            <!-- <button class="Button Button--lightblue" onclick="window.location.href='{{ route('user.my_horoscopes.edit') }}'"><span>Return My Horoscope</span></button> -->
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
                            <div class="C-back"><a href="{{ route('user.my_horoscopes.edit') }}"><span>MYホロスコープに戻る</span></a></div>
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
            setYear (oldYear) {
                let selectYear = document.getElementById('select_year');
                const year = new Date().getFullYear();
                for (let i = year; i >= 1900; i--) {
                    const option = document.createElement('option');
                    option.value = i;
                    option.text = i + '年';
                    if (i == oldYear) {
                        option.selected = true;
                    }
                    selectYear.appendChild(option);
                }
            },
        },
        mounted() {
            // 年月日を設定
            this.setYear(oldYear);
        }
    }).mount('#popup-horoscope');
</script>
@endsection
