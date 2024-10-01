@extends('layouts.user.mypage.app')

@section('css')
<link rel="stylesheet" href="{{ asset('mypage/assets/css/personal-appraisal-form.css') }}">
@endsection

@section('content')
<div class="Pageframe">
    @include('components.parts.side_header')
    <main class="Pageframe-main">
        @include('components.parts.top_header')
        <div class="Pageframe-main__scroll">
            <header class="Pageframe-main-header">
                <div class="Pageframe-main-header__first"><a href="{{ route('user.popup') }}">マイページ</a></div>
                <h2 class="Pageframe-main-header__pagename">個人鑑定 確認画面</h2>
            </header>
            <div class="Pageframe-main__inner">
                <div class="Pageframe-main-content">
                    <section class="sec Personal-appraisal C-form" id="Personal-appraisal">
                        {{-- ローディングの表示 --}}
                        @include('components.parts.user.loading')
                        <p class="C-form__message C-form-line C-form-line--first">
                            <span class="C-form__message__req">申し込み確認</span>
                        </p>
                        <p class="C-form-block--text">内容をご確認の上、申し込みボタンを押して進めてください。</p>

                        <form method="POST" action="{{ route('user.solar_appraisals.apply') }}" id="Personal-appraisal-form">
                            @csrf
                            <input type="hidden" name="target_type" value="{{ $data['target_type'] }}">
                            <input type="hidden" name="name1" value="{{ $data['name1'] }}">
                            <input type="hidden" name="name2" value="{{ $data['name2'] }}">

                            <input type="hidden" name="birth_year" value="{{ $data['birth_year'] }}">
                            <input type="hidden" name="birth_month" value="{{ $data['birth_month'] }}">
                            <input type="hidden" name="birth_day" value="{{ $data['birth_day'] }}">
                            @php
                                $birthday = $data['birth_year'] . '-' . str_pad($data['birth_month'], 2, '0', STR_PAD_LEFT) . '-' . str_pad($data['birth_day'], 2, '0', STR_PAD_LEFT);
                            @endphp
                            <input type="hidden" name="birthday" value="{{ $birthday }}">
                            <input type="hidden" name="birthday_time" value="{{ $data['birthday_time'] }}">
                            <input type="hidden" name="birthday_prefectures" value="{{ $data['birthday_prefectures'] }}">
                            <input type="hidden" name="longitude" value="{{ $data['longitude'] }}">
                            <input type="hidden" name="latitude" value="{{ $data['latitude'] }}">
                            <input type="hidden" name="timezone" value="{{ $data['timezone'] }}">
                            <input type="hidden" name="map-city" value="{{ $data['map-city'] }}">
                            <input type="hidden" name="solar_return" value="{{ $data['solar_return'] }}">
                            @if((int)$data['target_type'] === \App\Enums\TargetType::FAMILY->value)
                                <input type="hidden" name="family_id" value="{{ $data['family_id'] }}">
                                <input type="hidden" name="relationship" value="{{ $data['relationship'] }}">
                            @endif
                            <input type="hidden" name="is_bookbinding" value="{{ $data['is_bookbinding'] }}">

                            {{-- 製本 --}}
                            @if((int)$data['is_bookbinding'] === \App\Models\AppraisalApply::BOOK_ENABLED)
                            <input type="hidden" name="zip" value="{{ $data['zip'] }}">
                            <input type="hidden" name="address" value="{{ $data['address'] }}">
                            <input type="hidden" name="building" value="{{ $data['building'] }}">
                            <input type="hidden" name="building_name" value="{{ $data['building_name'] }}">
                            <input type="hidden" name="bookbinding_name1" value="{{ $data['bookbinding_name1'] }}">
                            <input type="hidden" name="bookbinding_name2" value="{{ $data['bookbinding_name2'] }}">
                            <input type="hidden" name="tel" value="{{ $data['tel'] }}">
                            <input type="hidden" name="is_design" value="{{ $data['is_design'] }}">
                            @endif
                            <input type="hidden" name="payment_type" value="{{ $data['payment_type'] }}">
                            @if(isset($data['coupon_code']))
                            <input type="hidden" name="coupon_code" value="{{ $data['coupon_code'] }}">
                            @endif
                            @if((int)$data['payment_type'] === \App\Models\AppraisalClaim::CREDIT)
                            <input type="hidden" name="stripeToken" value="{{ $data['stripeToken'] }}">
                            @endif

                            <input type="hidden" name="discount_price" value="{{ $data['discount_price'] }}">
                            <input type="hidden" name="total_amount" value="{{ $data['total_amount'] }}">

                            <div class="C-form-block__wrap">

                                <!-- <dl class="C-form-block C-form-block--hope">
                                    <dt class="C-form-block__title C-form-block__title--req">製本の希望</dt>
                                    <dd class="C-form-block__body">
                                        {{ \App\Models\AppraisalApply::getSolarBookbindingType()[$data['is_bookbinding']] }}
                                    </dd>
                                </dl> -->
                                @if ((int)$data['target_type'] === \App\Models\AppraisalApply::USER)
                                    <dl class="C-form-block C-form-block--name">
                                        <dt class="C-form-block__title C-form-block__title--req">お名前</dt>
                                        <dd class="C-form-block__body C-form-block__body--two">
                                            {{ auth()->guard('user')->user()->name1 }} {{ auth()->guard('user')->user()->name2 }}
                                        </dd>
                                    </dl>
                                @endif
                                <dl class="C-form-block">
                                    <dt class="C-form-block__title C-form-block__title--req">個人鑑定の対象者</dt>
                                    <dd class="C-form-block__body C-form-block-child">
                                        {{(int)$data['target_type'] === \App\Models\AppraisalApply::USER ? '自分' : '家族'}}
                                    </dd>
                                    @if((int)$data['target_type'] === \App\Enums\TargetType::FAMILY->value)
                                    <dd class="C-form-block__body">
                                        <dl class="C-form-block-child C-form-block--birth">
                                            <dt class="C-form-block__title">対象者との続柄</dt>
                                            <dd class="C-form-block__body C-form-block__body--half">
                                                {{ $data['relationship'] }}
                                            </dd>
                                        </dl>
                                        <dl class="C-form-block-child C-form-block--time">
                                            <dt class="C-form-block__title">対象者のお名前</dt>
                                            <dd class="C-form-block__body C-form-block__body--half">
                                                {{ $data['name1'] }}{{ $data['name2'] }}
                                            </dd>
                                        </dl>
                                    </dd>
                                    @endif
                                </dl>

                                <dl class="C-form-block C-form-block--birthdata">
                                    <dt class="C-form-block__title C-form-block__title--req">出生情報</dt>
                                    <dd class="C-form-block__body">
                                        <dl class="C-form-block__notes">
                                            <dd class="C-form-block__notes__body">
                                            お客様の出生情報入力ミスによるものは修正・返品ができません。<br>
                                            @if((int)$data['is_bookbinding'] === \App\Models\AppraisalApply::BOOK_ENABLED)
                                                別途製本費用をお支払いいただき作り直しになりますので、出生情報はよくご確認ください。
                                            @endif
                                            </dd>
                                        </dl>
                                        <dl class="C-form-block-child C-form-block--birth">
                                            <dt class="C-form-block__title">生年月日</dt>
                                            <dd class="C-form-block__body C-form-block__body--half">
                                                {{-- {{ $data['birthday'] }} --}}
                                                {{ $birthday }}
                                            </dd>
                                        </dl>
                                        <dl class="C-form-block-child C-form-block--time">
                                            <dt class="C-form-block__title">時刻</dt>
                                            <dd class="C-form-block__body C-form-block__body--half">
                                                {{ $data['birthday_time'] }}
                                            </dd>
                                        </dl>
                                        <dl class="C-form-block-child C-form-block--birthplace">
                                            <dt class="C-form-block__title">生まれた場所</dt>
                                            <dd class="C-form-block__body C-form-block__body--two">
                                                {{ $data['birthday_prefectures'] }}
                                            </dd>
                                        </dl>
                                        {{-- 経度 --}}
                                        <dl class="C-form-block-child">
                                            <dt class="C-form-block__title">経度</dt>
                                            <dd class="C-form-block__body C-form-block__body--half">
                                                {{ $data['longitude'] }}
                                            </dd>
                                        </dl>
                                        {{-- 緯度 --}}
                                        <dl class="C-form-block-child">
                                            <dt class="C-form-block__title">緯度</dt>
                                            <dd class="C-form-block__body C-form-block__body--half">
                                                {{ $data['latitude'] }}
                                            </dd>
                                        </dl>
                                        {{-- timezone --}}
                                        <dl class="C-form-block-child">
                                            <dt class="C-form-block__title">タイムゾーン</dt>
                                            <dd class="C-form-block__body C-form-block__body--half">
                                                @foreach (Modules\Horoscope\Enums\Time::Time as $item)
                                                    @if($item['value'] === $data['timezone'])
                                                        {{ $item['label'] }}
                                                    @endif
                                                @endforeach
                                            </dd>
                                        </dl>
                                    </dd>
                                </dl>

                                <dl class="C-form-block C-form-block--birthdata">
                                    <dt class="C-form-block__title C-form-block__title--req">SOLAR RETURN情報</dt>
                                    <dd class="C-form-block__body">
                                        <dl class="C-form-block__notes">
                                            <dd class="C-form-block__notes__body">
                                            お客様がSOLAR RETURNを購入された年に関する情報
                                            </dd>
                                        </dl>
                                        <dl class="C-form-block-child C-form-block--birth">
                                            <dt class="C-form-block__title">鑑定年</dt>
                                            <dd class="C-form-block__body C-form-block__body--half">
                                                {{$data['solar_return-text']}}
                                            </dd>
                                        </dl>
                                    </dd>
                                </dl>
                                <dl class="C-form-block C-form-block--hope">
                                    <dt class="C-form-block__title C-form-block__title--req">製本の希望</dt>
                                    <dd class="C-form-block__body">
                                        {{ \App\Models\AppraisalApply::getBookbindingType()[$data['is_bookbinding']] }}
                                    </dd>
                                </dl>
                                @if((int)$data['is_bookbinding'] === \App\Models\AppraisalApply::BOOK_ENABLED)
                                <dl class="C-form-block C-form-block--cash">
                                    <dt class="C-form-block__title C-form-block__title--req">表紙のデザイン</dt>
                                    <dd class="C-form-block__body">
                                        {{ \App\Models\AppraisalApply::PDF_TYPE_SOLAR[$data['is_design']] }}
                                    </dd>
                                </dl>
                                <dl class="C-form-block C-form-block--cash">
                                    <dt class="C-form-block__title C-form-block__title--req">製本に表示するお名前</dt>
                                    <dd class="C-form-block__body">
                                        {{$data['bookbinding_name1']}} {{$data['bookbinding_name2']}}
                                        <p class="Personal-appraisal__notice-text">
                                        @php
                                            $design = $data["is_design"];
                                            $name1 = $data["bookbinding_name1"];
                                            $name2 = $data["bookbinding_name2"];
                                        @endphp
                                            <a href="{{ route('user.download_images.download_cover_pdf', ['design' => $design, 'name1' => $name1, 'name2' => $name2]) }}" style="font-size: 1.2rem;">
                                                表紙イメージはこちら
                                            </a>
                                        </p>
                                    </dd>
                                </dl>
                                <dl class="C-form-block C-form-block--sending">
                                    <dt class="C-form-block__title C-form-block__title--req">送付先情報</dt>
                                    <dd class="C-form-block__body">
                                        <dl class="C-form-block-child C-form-block--hasbutton C-form-block--zip">
                                            <dt class="C-form-block__title">郵便番号</dt>
                                            <dd class="C-form-block__body">
                                                {{ $data['zip'] }}
                                            </dd>
                                        </dl>
                                        <dl class="C-form-block-child C-form-block--address">
                                            <dt class="C-form-block__title">住所</dt>
                                            <dd class="C-form-block__body">
                                                {{ $data['address'] }}{{ $data['building'] }}
                                            </dd>
                                        </dl>
                                        <dl class="C-form-block-child C-form-block--name">
                                            <dt class="C-form-block__title">お名前</dt>
                                            <dd class="C-form-block__body">
                                                {{ $data['building_name'] }}
                                            </dd>
                                        </dl>
                                        <dl class="C-form-block-child C-form-block--tel">
                                            <dt class="C-form-block__title">電話番号</dt>
                                            <dd class="C-form-block__body">
                                                {{ $data['tel'] }}
                                            </dd>
                                        </dl>
                                    </dd>
                                </dl>
                                @endif
                                <dl class="C-form-block C-form-block--cash">
                                    <dt class="C-form-block__title C-form-block__title--req">お支払い方法</dt>
                                    <dd class="C-form-block__body">
                                        {{\App\Models\AppraisalClaim::PAYMENT_TYPE[(int)$data['payment_type']]}}
                                    </dd>
                                </dl>

                                {{-- カードブランドとカードの最後の4桁表示 --}}
                                @if((int)$data['payment_type'] === \App\Models\AppraisalClaim::CREDIT)
                                <dl class="C-form-block C-form-block--card">
                                    <dt class="C-form-block__title C-form-block__title--req">カード情報</dt>
                                    <dd class="C-form-block__body">
                                        <dl class="C-form-block-child C-form-block--cardnumber">
                                            <dt class="C-form-block__title">カード番号</dt>
                                            <dd class="C-form-block__body">
                                                {{ $data['cardBrand'] }}
                                            </dd>
                                            <dd class="C-form-block__body">
                                                ************{{ $data['last4'] }}
                                            </dd>
                                        </dl>
                                    </dd>
                                </dl>
                                @endif

                                @if(isset($data['coupon_code']))
                                    <dl class="C-form-block C-form-block--coupon-wrap">
                                        <div class="C-form-block__body">
                                            <dl class="C-form-block-child C-form-block--hasbutton C-form-block--couponcode on">
                                                <dt class="C-form-block__title">使用するクーポン</dt>
                                                <dd class="C-form-block__body">
                                                    {{ isset($data['coupon_code']) && $data['coupon_code'] ? $data['coupon_code'] : '-' }}
                                                </dd>
                                            </dl>
                                        </div>
                                    </dl>
                                @endif

                                <dl class="C-price">
                                    <dt class="C-price__title">注文内容</dt>
                                    <dd class="C-price__body">
                                        <div class="C-price-block__wrap">
                                            @if ((int)$data['target_type'] === \App\Models\AppraisalApply::USER)
                                                <dl class="C-price-block">
                                                    <dt class="C-price-block__title">個人鑑定</dt>
                                                    <dd class="C-price-block__text">{{ number_format($solar->price) }}円</dd>
                                                </dl>
                                            @elseif ((int)$data['target_type'] === \App\Models\AppraisalApply::FAMILY)
                                                <dl class="C-price-block">
                                                    <dt class="C-price-block__title">家族の個人鑑定</dt>
                                                    <dd class="C-price-block__text">{{ number_format($solar->family_price) }}円</dd>
                                                </dl>
                                            @endif
                                            @if((int)$data['is_bookbinding'] === \App\Models\AppraisalApply::BOOK_ENABLED)
                                            <dl class="C-price-block">
                                                <dt class="C-price-block__title">製本金額 ：</dt>
                                                <dd class="C-price-block__text">{{ number_format($bookbinding->price) }}円</dd>
                                            </dl>
                                            {{-- <dl class="C-price-block">
                                                <dt class="C-price-block__title">送料 ：</dt>
                                                <dd class="C-price-block__text">{{ number_format(\App\Models\AppraisalClaim::SHIPPING_FEE) }}円</dd>
                                            </dl> --}}
                                            @endif
                                            @if($data['discount_price'])
                                                <dl class="C-price-block C-price-block--minus">
                                                    <dt class="C-price-block__title">クーポン ：</dt>
                                                    <dd class="C-price-block__text">- {{ number_format($data['discount_price']) }}円</dd>
                                                </dl>
                                            @endif
                                        </div>
                                        <dl class="C-price-last">
                                            <dt class="C-price-last__title">合計</dt>
                                            <dd class="C-price-last__text"><span>{{ number_format($data['total_amount']) }}</span>円</dd>
                                        </dl>
                                    </dd>
                                </dl>
                            </div>
                            <button type="button" @click="submitForm" :disabled="isLoading" class="Button Button--lightblue"><span>申し込み</span></button>
                            <button type="button" class="previous-btn previous-btn-left" onclick="window.history.back();">
                                <span>入力内容を修正する</span>
                            </button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
@section('script')
<script>
    Vue.createApp({
        data() {
            return {
                isLoading: false
            }
        },
        methods: {
            submitForm() {
                this.isLoading = true
                document.getElementById('Personal-appraisal-form').submit()
            }
        }
    }).mount('#Personal-appraisal');
</script>
@endsection
