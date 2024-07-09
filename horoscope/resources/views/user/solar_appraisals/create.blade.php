@extends('layouts.user.mypage.app')

@section('css')
<link rel="stylesheet" href="{{ asset('mypage/assets/css/personal-appraisal-form.css') }}">
<link rel="stylesheet" href="{{ asset('mypage/assets/plugins/mCustomScrollbar/jquery.mCustomScrollbar.min.css') }}">

@endsection

@section('content')
    <div class="Pageframe">
        @include('components.parts.side_header')
        <main class="Pageframe-main">
            @include('components.parts.top_header')
            <div class="Pageframe-main__scroll">

                <header class="Pageframe-main-header">
                    <div class="Pageframe-main-header__first"><a href="{{ route('user.popup') }}">マイページ</a></div>
                    <h2 class="Pageframe-main-header__pagename">個人鑑定 申込フォーム</h2>
                </header>

                <div class="Pageframe-main__inner">
                    <div class="Pageframe-main-content">
                        <!-- ***** セクション名 ***** -->
                        <section class="sec Personal-appraisal C-form" id="Personal-appraisal">
                        <h2 class="Solar-Pageframe-main__title logo-banner"><img src="{{ asset('mypage/assets/images/solar-bookmaking/solar-return-bookmaking-title.png') }}"
                        alt="BOOK MAKING">
                        </h2>                            <p class="C-form__message">下記フォームの<span class="C-form__message__req">必須項目</span>をご記入の上、ご購入ください。</p>
                            @if (Session::has('flash_alert'))
                                <p style="color: red; font-size: larger;" >{{ Session::get('flash_alert') }}</p>
                            @endif

                            <form id="payment-form" method="POST" action="{{ route('user.solar_appraisals.confirm') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="C-form-block__wrap">
                                    @if ((int)\Request::get('target_type') !== \App\Models\AppraisalApply::FAMILY)
                                        <dl class="C-form-block C-form-block--name">
                                            <dt class="C-form-block__title">お名前</dt>
                                            <dd class="C-form-block__body">
                                                <p class="C-form-block--name__text"><span>{{ auth()->guard('user')->user()->name1 }} {{ auth()->guard('user')->user()->name2 }}</span>さん</p>
                                            </dd>
                                        </dl>
                                    @endif
                                    <dl class="C-form-block C-form-block--target">
                                        <dt class="C-form-block__title C-form-block__title--req">個人鑑定の対象者</dt>
                                        <dd class="C-form-block__body">

                                            <div class="C-form-block__radio">
                                                {{-- @dd((int)\Request::get('target_type')) --}}
                                                @if ((int)\Request::get('target_type') !== \App\Models\AppraisalApply::FAMILY)
                                                    @include('components.form.original_radio', [
                                                        'name'    => 'target_type',
                                                        'class'   => 'C-form-block__radio__text',
                                                        'data'    => [1 => '自分'],
                                                        'checked' => $request->target_type ?? 1,
                                                        'vModel'  => 'personalClick',
                                                        'onChange' => 'setSelfInfo',
                                                    ])
                                                @else
                                                    @include('components.form.original_radio', [
                                                        'name'    => 'target_type',
                                                        'class'   => 'C-form-block__radio__text',
                                                        'data'    => [2 => '家族'],
                                                        'checked' => $request->target_type ?? 1,
                                                        'vModel'  => 'personalClick',
                                                        'onChange' => 'setSelfInfo',
                                                    ])
                                                @endif
                                            </div>
                                            <div v-if="personalClick == '2'" class="Personal-appraisal-family on">
                                                <dl class="C-form-block-child C-form-block--family">
                                                    <dt class="C-form-block__title">登録済みのご家族</dt>
                                                    <dd class="C-form-block__body C-form-block__body--half">
                                                        <div class="C-form-block__select">
                                                            <select name="family_id" @change="setFamilyInfo">
                                                                <option value="" {{ old('family_id', $request->family_id ?? '') == '' ? 'selected' : '' }}>
                                                                    選択してください
                                                                </option>
                                                                @foreach ( auth()->guard('user')->user()->families()->get() as $family)
                                                                    <option value="{{ $family->id }}" {{ old('family_id', $request->family_id ?? '') == $family->id ? 'selected' : '' }}>
                                                                        {{ $family->name1 }} {{ $family->name2 }}（{{ $family->relationship }})
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @include('components.form.error', ['name' => 'family_id', 'class' => 'text-danger'])
                                                    </dd>
                                                    @if($errors->has('family_id'))
                                                        <span class="invalid-feedback text-danger" role="alert" style="text-align: left; display:block;">
                                                            <strong>
                                                                家族を選択ください
                                                                <br>もし「家族のホロスコープ」を作成されていない場合は
                                                                <br class="sp-none">先に「 <a href="{{ route('user.families.index') }}" class="underline">家族のホロスコープ</a> 」を作成ください
                                                            </strong>
                                                        </span>
                                                    @else
                                                        <p>
                                                            ※「家族のホロスコープ」を作成されていない場合は<br class="sp-none">先に「<a href="{{ route('user.families.index') }}" class="underline">家族のホロスコープ</a> 」を作成ください
                                                        </p>
                                                    @endif
                                                </dl>
                                                <dl class="C-form-block-child C-form-block--relationship">
                                                    <dt class="C-form-block__title">対象者との続柄</dt>
                                                    <dd class="C-form-block__body C-form-block__body--half">
                                                        <div class="C-form-block__field">
                                                            @include('components.form.text', [
                                                                'name'        => 'relationship',
                                                                'placeholder' => 'あなたとの関係',
                                                                'refs'        => 'relationship',
                                                                'value'       => $request->relationship ?? '',
                                                            ])
                                                        </div>
                                                    </dd>
                                                </dl>
                                                @include('components.form.error', ['name' => 'relationship', 'class' => 'text-danger'])
                                                <dl class="C-form-block-child C-form-block--name">
                                                    <dt class="C-form-block__title">対象者のお名前</dt>
                                                    <dd class="C-form-block__body C-form-block__body--two">
                                                        <div class="C-form-block__field">
                                                            @include('components.form.text', [
                                                                'name'        => 'name1',
                                                                'placeholder' => '姓',
                                                                'refs'        => 'name1',
                                                                'value'       => $request->name1 ?? '',
                                                            ])
                                                        </div>
                                                        <div class="C-form-block__field">
                                                            @include('components.form.text', [
                                                                'name'        => 'name2',
                                                                'placeholder' => '名',
                                                                'refs'        => 'name2',
                                                                'value'       => $request->name2 ?? '',
                                                                ])
                                                        </div>
                                                    </dd>
                                                    @include('components.form.error', ['name' => 'name1', 'class' => 'text-danger'])
                                                    @include('components.form.error', ['name' => 'name2', 'class' => 'text-danger'])
                                                </dl>
                                            </div>
                                        </dd>
                                    </dl>
                                    <dl class="C-form-block C-form-block--birthdata">
                                        <dt class="C-form-block__title C-form-block__title--req">出生情報</dt>
                                        <dd class="C-form-block__body">
                                            <dl class="C-form-block-child C-form-block--birth">
                                                <dt class="C-form-block__title">生年月日</dt>
                                                {{-- <dd class="C-form-block__body C-form-block__body--half">
                                                    <div class="C-form-block__field">
                                                        @include('components.form.date', [
                                                            'name'        => 'birthday',
                                                            'required'    => true,
                                                            'placeholder' => '0000/00/00',
                                                            'refs'        => 'birthday',
                                                            'value'       => $request->birthday ??  $defaultBirthday?->format('Y-m-d'),
                                                        ])
                                                    </div>
                                                    @include('components.form.error', ['name' => 'birthday', 'class' => 'text-danger']) --}}
                                                <div>
                                                    <div style="display: flex">
                                                        <dd class="C-form-block__select">
                                                            <select id="select_year" name="birth_year" @change="setDay">
                                                                <option value="">年</option>
                                                            </select>
                                                        </dd>
                                                        <dd class="C-form-block__select">
                                                            <select id="select_month" name="birth_month" @change="setDay">
                                                                <option value="">月</option>
                                                            </select>
                                                        </dd>
                                                        <dd class="C-form-block__select">
                                                            <select id="select_day" name="birth_day" @change="changeDate">
                                                                {{-- デフォルト値はjsで実装 --}}
                                                            </select>
                                                        </dd>
                                                    </div>
                                                    <p>
                                                        @include('components.form.error', ['name' => 'birth_day', 'class' => 'text-danger'])
                                                        @include('components.form.error', ['name' => 'select_month', 'class' => 'text-danger'])
                                                        @include('components.form.error', ['name' => 'select_year', 'class' => 'text-danger'])
                                                    </p>
                                                </div>
                                                {{-- <p class="C-form-block--password__text">スマートフォンをご利用の方は、カレンダー左上の「年」をタップ頂ければ、生まれ年をご選択頂けます</p> --}}
                                            </dl>
                                            <dl class="C-form-block-child C-form-block--time">
                                                <dt class="C-form-block__title">時刻</dt>
                                                <dd class="C-form-block__body C-form-block__body--half">
                                                    <div class="C-form-block__field">
                                                        @include('components.form.time', [
                                                            'name'        => 'birthday_time',
                                                            'required'    => false,
                                                            'value'       => $request->birthday_time ?? $defaultBirthdayTime?->format('H:i'),
                                                            'placeholder' => '00 : 00',
                                                            'inputmode'   => 'numeric',
                                                            'refs'        => 'birthday_time',
                                                        ])
                                                        @include('components.form.error', ['name' => 'birthday_time', 'class' => 'text-danger'])
                                                    </div>
                                                </dd>
                                            </dl>
                                            <dl class="C-form-block-child C-form-block--birthplace">
                                                <dt class="C-form-block__title">生まれた場所</dt>
                                                <dd class="C-form-block__body C-form-block__body">
                                                    <div class="C-form-block__field">
                                                        @include('components.form.text', [
                                                            'name'        => 'birthday_prefectures',
                                                            'required'    => false,
                                                            'placeholder' => '都道府県市区町村',
                                                            'refs'        => 'birthday_prefectures',
                                                            'value'       => $request->birthday_prefectures ?? $defaultBirthdayPrefectures,
                                                            'vInput'       => 'handleInputChange',
                                                        ])
                                                    </div>
                                                    @include('components.form.error', ['name' => 'birthday_prefectures', 'class' => 'text-danger'])
                                                </dd>
                                            </dl>
                                            {{-- <div style="display: none"> --}}
                                                <dl class="C-form-block-child">
                                                    <dd class="C-form-block__body">
                                                        <div id="map" style="height: 250px; width:100%"></div>
                                                    </dd>
                                                </dl>
                                                <dl class="C-form-block-child">
                                                    <dd class="C-form-block__body">
                                                        <dt class="C-form-block__title">経度</dt>
                                                        <div class="C-form-block__field"><input id="map-longitude" disabled type="text" value="{{ old('longitude', session('longitude')) ?? auth()->guard('user')->user()->longitude }}" style="color:#a1a1a6;">
                                                            <input id="lng" hidden name="longitude" type="text"
                                                            value="{{ old('longitude', session('longitude')) ?? auth()->guard('user')->user()->longitude }}"></div>
                                                        @error('longitude')
                                                            <span style="color: red" class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        <br>
                                                        <dt class="C-form-block__title">緯度</dt>
                                                        <div class="C-form-block__field"> <input id="map-latitude" disabled type="text"
                                                            value="{{ old('latitude', session('latitude')) ?? auth()->guard('user')->user()->latitude }}" style="color:#a1a1a6;">
                                                            <input id="lat" hidden name="latitude" type="text"
                                                            value="{{ old('latitude', session('latitude')) ?? auth()->guard('user')->user()->latitude }}"></div>
                                                        <input id="map-city" hidden name="map-city" type="text" value="">
                                                        @error('latitude')
                                                            <span style="color: red" class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </dd>
                                                </dl>
                                                {{-- <div style="display: none"> --}}
                                                    <dl class="C-form-block-child">
                                                        <dd class="C-form-block__body">
                                                            <dt class="C-form-block__title">タイムゾーン</dt>
                                                            <dd class="C-form-block__select">
                                                                <select name="timezone" ref="timezone">
                                                                    @foreach (Modules\Horoscope\Enums\Time::Time as $item)
                                                                        <option value='{{ $item['value'] }}'
                                                                        @if (auth()->guard('user')->user()->timezome)
                                                                            @if (auth()->guard('user')->user()->timezome == $item['value'])
                                                                                selected
                                                                            @endif
                                                                        @else
                                                                            @if (array_key_exists('selected', $item) && $item['selected'])
                                                                                selected
                                                                            @endif
                                                                        @endif>
                                                                            {{ $item['label'] }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </dd>
                                                            @error('timezone')
                                                                <span style="color: red" class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </dd>
                                                        <p>日本標準時がデフォルトです。出生地が海外の場合に選択してください。</p>
                                                    </dl>
                                                    <p class="C-form-block--birthdata__text">あなたの生まれた瞬間のホロスコープを出すためには<br>生まれた時間を「分」まで、場所を「市」まで正しく入力してください。</p>
                                                {{-- </div> --}}
                                            {{-- </div> --}}
                                            <dl class="C-form-block-child">
                                                <dt class="C-form-block__title C-form-block__title--req">鑑定年</dt>
                                                <dd class="C-form-block__body">
                                                    <div class="C-form-block__radio unsetFlex">
                                                        @include('components.form.original_solar_radio', [
                                                            'name'    => 'solar_return',
                                                            'data'    => [0 , 1],
                                                        ])
                                                    </div>
                                                </dd>
                                            </dl>
                                        </dd>
                                    </dl>

                                    <!-- 製本パーツ -->
                                    @include('components.parts.user.appraisal_apply_common_bookbinding')

                                    <input type="hidden" name="is_bookbinding" value="0" v-model="bookbindingClick">
                                    <dl class="C-form-block C-form-block--cash">
                                        <dt class="C-form-block__title C-form-block__title--req">お支払い方法</dt>
                                        <dd class="C-form-block__body">
                                            <div class="C-form-block__radio">
                                                @include('components.form.original_radio', [
                                                    'name'    => 'payment_type',
                                                    'class'   => 'C-form-block__radio__text',
                                                    'data'    => App\Models\AppraisalClaim::PAYMENT_TYPE,
                                                    'vModel'  => 'paymentType',
                                                ])
                                            </div>
                                        </dd>
                                    </dl>

                                    <dl class="C-form-block C-form-block--cash" v-show="paymentType == '1'">
                                        <dt class="C-form-block__title C-form-block__title--req">クレジットカード情報</dt>
                                        <dd class="C-form-block__body">
                                            <div class="fieldset">
                                                <label for="image" class="ms-5">カード番号</label>
                                                <div id="card-number" style="border: 1px solid #ccc; padding: 10px; margin-bottom: 20px; width: 225px;"></div>
                                                <label for="image">有効期限</label>
                                                <div id="card-expiry" style="border: 1px solid #ccc; padding: 10px; margin-bottom: 20px; width: 90px;"></div>
                                                <label for="image">セキュリティコード</label>
                                                <div id="card-cvc" style="border: 1px solid #ccc; padding: 10px; margin-bottom: 20px; width: 180px;"></div>
                                            </div>
                                        </dd>
                                    </dl>

                                    <!-- クーポンの選択 -->
                                    <dl class="C-form-block C-form-block--coupon-wrap">
                                        <dd class="C-form-block__body">
                                            <dl class="C-form-block-child C-form-block--coupon">
                                                <dt class="C-form-block__title">クーポンのご利用</dt>
                                                <dd class="C-form-block__body">
                                                    <div class="C-form-block__radio">
                                                        @include('components.form.original_radio', [
                                                            'name'     => 'coupon_type',
                                                            'class'    => 'C-form-block__radio__text',
                                                            'data'     => ['1' => 'ご紹介ポイントを使用', '2' => 'クーポンコードを使用', '3' => 'クーポンを使用しない'],
                                                            'vModel'   => 'couponType',
                                                            'onChange' => 'couponTypeChange',
                                                        ])
                                                    </div>
                                                </dd>
                                            </dl>
                                            <dl class="C-form-block-child C-form-block--hasbutton C-form-block--couponno on" v-if="couponType == '1'">
                                                <dt class="C-form-block__title">ご紹介ポイントを使用</dt>
                                                <dd class="C-form-block__body">
                                                    <div class="C-form-block__field">
                                                        <input type="number" name="discount_price" placeholder="0000" v-model="discountPrice" onkeypress="return event.charCode >= 48 && event.charCode <= 57"><span
                                                            class="C-form-block--couponno__tag">円</span>
                                                    </div>
                                                    {{-- <div class="C-form-block__button">適用する</div> --}}
                                                    <p class="C-form-block--couponno__text"><span>あなたの現在使用可能なポイント ： <strong>{{
                                                                number_format(auth()->guard('user')->user()->point_sum) }}円</strong></span></p>
                                                </dd>
                                            </dl>
                                            <dl class="C-form-block-child C-form-block--hasbutton C-form-block--couponcode on" v-else-if="couponType == '2'">
                                                <dt class="C-form-block__title">クーポンコードを使用</dt>
                                                <dd class="C-form-block__body">
                                                    <div class="C-form-block__field">
                                                        @include('components.form.text', [
                                                            'name'        => 'coupon_code',
                                                            'placeholder' => 'クーポンコード',
                                                            'vModel'      => 'couponCode',
                                                        ])
                                                        @include('components.form.error', ['name' => 'coupon_code','class' => 'text-danger'])
                                                    </div>
                                                    <div class="C-form-block__button" @click="dicountTotalPlace">適用する</div>
                                                    <ul class="C-form-block--couponcode-list list-dot">
                                                        <li class="C-form-block--couponcode-list__item">お友達の紹介クーポンコードをご存知の方は入力してください。</li>
                                                        <li class="C-form-block--couponcode-list__item">一度に使用できるのは1つのみです。</li>
                                                    </ul>
                                                </dd>
                                            </dl>
                                            <dl class="C-form-block-child C-form-block--hasbutton C-form-block--couponno on" v-else>
                                                <input type="hidden" name="discount_price" placeholder="0000" v-model="discountPrice" onkeypress="return event.charCode >= 48 && event.charCode <= 57"><span
                                                    class="C-form-block--couponno__tag">円</span>
                                            </dl>
                                        </dd>
                                    </dl>

                                    <dl class="C-price">
                                        <dt class="C-price__title">注文内容</dt>
                                        <dd class="C-price__body">
                                            <div class="C-price-block__wrap">
                                                <dl class="C-price-block" v-if="personalClick == '1'">
                                                    <dt class="C-price-block__title">個人鑑定金額 ：</dt>
                                                    <dd class="C-price-block__text">{{ number_format($appraisalPrice) }}円</dd>
                                                </dl>
                                                <dl class="C-price-block" v-if="personalClick == '2'">
                                                    <dt class="C-price-block__title">家族の個人鑑定金額 ：</dt>
                                                    <dd class="C-price-block__text">{{ number_format($appraisalPrice) }}円</dd>
                                                </dl>
                                                <dl class="C-price-block" v-if="bookbindingClick == '1'">
                                                    <dt class="C-price-block__title">製本金額 ：</dt>
                                                    <dd class="C-price-block__text">{{ number_format($bookbinding->price) }}円</dd>
                                                </dl>
                                                {{-- <dl class="C-price-block" v-if="bookbindingClick == '1'">
                                                    <dt class="C-price-block__title">送料 ：</dt>
                                                    <dd class="C-price-block__text">{{ number_format(\App\Models\AppraisalClaim::SHIPPING_FEE) }}円</dd>
                                                </dl> --}}
                                                <dl class="C-price-block C-price-block--minus">
                                                    <dt class="C-price-block__title">ご紹介クーポン ：</dt>
                                                    <dd class="C-price-block__text">- @{{ discountPrice.toLocaleString() }}円</dd>
                                                </dl>
                                            </div>
                                            <dl class="C-price-last">
                                                <dt class="C-price-last__title">合計</dt>
                                                <dd class="C-price-last__text">
                                                    <span v-if="isCalculating">計算中...</span>
                                                    <span v-else>@{{ totalAmount.toLocaleString() }}</span>円
                                                </dd>
                                            </dl>
                                            <input type="hidden" name="total_amount" v-model="totalAmount">
                                            <input type="hidden" name="discount_price" v-model="discountPrice">
                                        </dd>
                                    </dl>
                                </div>

                                <dl class="C-form-notice C-form-line C-form-line--last">
                                    <dt class="C-form-notice__title">購入時の注意事項</dt>
                                    <dd class="C-form-notice__inner">
                                        <div class="C-form-notice-content">
                                            <ul class="C-form-notice-content-list">
                                                <li class="C-form-notice-list__item">鑑定結果に対する個別の質問はお受けいたしかねます。</li>
                                                <li class="C-form-notice-list__item">このStellar Blueprintは、あくまでも制作者海部舞による、皆様の出生図の解釈の一つです。鑑定内容に関係なく、人生の責任を負うのも、その決定権があるのも皆様自身であることをご理解ください。</li>
                                                <li class="C-form-notice-list__item">これは皆様の人生のテーマを明らかにし、より可能性を広げるための情報を提供することを目的としています。個人の私利私欲、恋愛や結婚の成就のお役に立つかは保障いたしかねます。</li>
                                                <li class="C-form-notice-list__item">製本をお申込みお客様へ：システムによるエラーや乱丁・落丁はお取替えいたしますが、お客様の出生情報入力ミスによるものは修正・返品ができません。別途製本費用をお支払いいただき作り直しになりますので、あらかじめご了承ください。</li>
                                            </ul>
                                        </div>
                                        <div class="C-form-policy">
                                        <div class="C-form-policy__inner">
                                            <div class="C-form-policy-block">
                                                <div class="C-form-block__checkbox">
                                                    <label class="C-form-block__checkbox__item">
                                                        <input type="checkbox" name="consent" value="購入時の注意事項を確認しました。">
                                                        <span class="C-form-block__checkbox__text">購入時の注意事項を確認しました。</span>
                                                    </label>
                                                    <div style="text-align: left">
                                                        @include('components.form.error', ['name' => 'consent'])
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </dd>
                                </dl>

                                <div class="C-form-policy C-form-line C-form-line--last">
                                    <div class="C-form-policy__inner">
                                        <div class="C-form-policy-block">
                                            <div class="C-form-block__checkbox">
                                                    <label class="C-form-block__checkbox__item">
                                                            <input type="checkbox" name="terms_of_service">
                                                            <span class="C-form-block__checkbox__text">
                                                                    <a href="https://hoshinomai.jp/terms-of-use/" target="_blank">利用規約</a>を確認しました。
                                                            </span>
                                                    </label>
                                            </div>
                                            @include('components.form.error', ['name' => 'terms_of_service'])
                                    </div>
                                    <div class="C-form-policy-block">
                                            <div class="C-form-block__checkbox">
                                                    <label class="C-form-block__checkbox__item">
                                                            <input type="checkbox" name="personal_information">
                                                            <span class="C-form-block__checkbox__text">
                                                                    <a href="https://hoshinomai.jp/privacy" target="_blank">個人情報保護方針</a>を確認しました。
                                                            </span>
                                                    </label>
                                            </div>
                                            @include('components.form.error', ['name' => 'personal_information'])
                                    </div>
                                    </div>
                                    </div>

                                <button type="submit" class="Button Button--lightblue"><span>申し込み内容を確認する</span></button>
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

@section('script')
<script src="{{ asset('mypage/assets/js/personal-appraisal-form.js') }}"></script>
<script src="{{ asset('mypage/assets/plugins/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script>
Vue.createApp({
    data() {
        return {
            bookbindingClick:  @json(old('is_bookbinding', $request->is_bookbinding ?? '0')),
            personalClick: @json(old('target_type', $request->target_type ?? 1)),
            paymentType: @json(old('payment_type', $request->payment_type ?? App\Models\AppraisalClaim::CREDIT)),
            isCalculating: false,
            appraisalPrice: @json($appraisalPrice),
            bookbindingPrice: @json($bookbinding->price),
            // shippingFee: @json(\App\Models\AppraisalClaim::SHIPPING_FEE),
            // totalAmount : @json(intval(old('total_amount', $request->total_amount ?? $appraisalPrice))),
            // totalAmount : @json(intval(old('total_amount', $request->total_amount ?? $appraisalPrice + $bookbinding->price + \App\Models\AppraisalClaim::SHIPPING_FEE))),
            totalAmount : @json(intval(old('total_amount', $request->total_amount ?? $appraisalPrice))),
            discountPrice: @json(intval(old('discount_price', $request->discount_price ?? 0))),
            point: @json(auth()->guard('user')->user()->point_sum),
            families: @json(auth()->guard('user')->user()->families()->get()),
            couponType: @json(old('coupon_type', $request->coupon_type ?? App\Enums\CouponType::BACK_COUPON->value)),
            couponCode: @json(old('coupon_code', $request->coupon_code ?? '')),
			marker: null,
			map: null,
			geocoder: new google.maps.Geocoder(),
        }
    },
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
		setMonth (oldMonth) {
			let selectMonth = document.getElementById('select_month');
			for (let i = 1; i <= 12; i++) {
				const option = document.createElement('option');
				option.value = i;
				option.text = i + '月';
				if (i == oldMonth) {
					option.selected = true;
				}
				selectMonth.appendChild(option);
			}
		},
		setDay (oldDay) {
			let selectYear = document.getElementById('select_year');
			let selectMonth = document.getElementById('select_month');
			let selectDay = document.getElementById('select_day');
			//日の選択肢を空にする
			let children = selectDay.children
			while(children.length){
				children[0].remove()
			}
			// 最初にplaceholderを追加
			let op = document.createElement('option');
			op.value = '';
			op.text = '日';
			selectDay.appendChild(op);
			// 日を生成(動的に変える)
			if(selectYear.value !== '' &&  selectMonth.value !== ''){
				const lastDay = new Date(selectYear.value,selectMonth.value,0).getDate()
				for (i = 1; i <= lastDay; i++) {
					let op = document.createElement('option');
					op.value = i;
					op.text = i + '日';
					if (i == oldDay) {
						op.selected = true;
					}
					selectDay.appendChild(op);
				}
			}
		},
        //入力されたクーポンから値引きを行う
        //「製本する」をクリックした時に製本の金額を加算する、もしくは減算する
        toggleCaluculateBookking(){
            if(this.bookbindingClick === '1'){
                this.totalAmount = this.totalAmount + this.bookbindingPrice;
            }
            else{
                this.totalAmount = this.totalAmount - this.bookbindingPrice;
            }
        },
        changeDate(){
            let selectYear = document.getElementById('select_year');
			let selectMonth = document.getElementById('select_month');
			let selectDay = document.getElementById('select_day');
            if(selectYear.value !== '' &&  selectMonth.value !== '' &&  selectDay.value !== ''){
                let year = parseInt(selectYear.value);
                let month = parseInt(selectMonth.value) - 1;
                let day = parseInt(selectDay.value);
                let birthday = new Date(year, month, day);
                this.setAge(birthday);
            }
        },
        //家族を選択したらその家族の情報をセットする
        setAge(birthday){
            let currentDate = new Date();

            let age = currentDate.getFullYear() - birthday.getFullYear();
            let currentYear = currentDate.getFullYear();
            if (currentDate.getMonth() < birthday.getMonth() || (currentDate.getMonth() === birthday.getMonth() && currentDate.getDate() < birthday.getDate())) {
                age--;
                currentYear--;
            }

            let formattedCurrentDate = `${currentYear}年${(birthday.getMonth()+1).toString().padStart(2, '0')}月${(birthday.getDate()).toString().padStart(2, '0')}日`;
            let formattedNextDate = `${currentYear+1}年${(birthday.getMonth()+1).toString().padStart(2, '0')}月${(birthday.getDate()).toString().padStart(2, '0')}日`;
            let formattedCurrentDate1 = `${currentYear+1}年${(birthday.getMonth()+1).toString().padStart(2, '0')}月${(birthday.getDate()).toString().padStart(2, '0')}日`;
            let formattedNextDate1 = `${currentYear+2}年${(birthday.getMonth()+1).toString().padStart(2, '0')}月${(birthday.getDate()).toString().padStart(2, '0')}日`;

            const currentAge = document.querySelector('span.C-form-block__radio__text[for="solar_return1"]');
            const nextAge = document.querySelector('span.C-form-block__radio__text[for="solar_return2"]');
            const solarReturn1 = document.getElementById('solar_return1');
            const solarReturn2 = document.getElementById('solar_return2');
            currentAge.textContent = `${age}歳(${formattedCurrentDate}-${formattedNextDate})`;
            nextAge.textContent = `${age+1}歳(${formattedCurrentDate1}-${formattedNextDate1})`;
            solarReturn1.value = currentYear;
            solarReturn2.value = currentYear+1;
        },
        setFamilyInfo(){
            const family = this.families.find(family => family.id == event.target.value);
            if(family){
                this.$nextTick(() => {
                    this.$refs.relationship.value = family.relationship;
                    this.$refs.name1.value = family.name1;
                    this.$refs.name2.value = family.name2;
                    this.$refs.birthday_prefectures.value = family.birthday_prefectures;

                    let timezoneSelect = this.$refs.timezone;
                    // 一度選択されているものをリセット
                    for (let i = 0; i < timezoneSelect.options.length; i++) {
                        if (timezoneSelect.options[i].selected) {
                            timezoneSelect.options[i].selected = false;
                        }
                    }
                    // DBのカラムのスペルがtimezomeになっているので注意！！（timezoneじゃなくてtimezome）
                    let familyTimezone = family.timezome;
                    // タイムゾーンを選択
                    for (let i = 0; i < timezoneSelect.options.length; i++) {
                        if (timezoneSelect.options[i].value == familyTimezone) {
                            timezoneSelect.options[i].selected = true;
                        }
                    }

                    // 日付をUTCからJSTに変換
                    const timezoneOffset = 9 * 60; // JSTはUTCより9時間進んでいます
                    let birthday = new Date(family.birthday);
                    birthday.setMinutes(birthday.getMinutes() + timezoneOffset);
                    this.setAge(birthday);
                    // 年月日を設定
                    let oldYear = birthday.getFullYear();
                    let oldMonth = birthday.getMonth() + 1; // getMonth()メソッドが月を0から11の範囲で返してくるため、1を足す
                    let oldDay = birthday.getDate();

                    // 一度セレクトボックスをリセット
                    document.getElementById('select_year').innerHTML = '';
                    document.getElementById('select_month').innerHTML = '';
                    document.getElementById('select_day').innerHTML = '';

                    this.setYear(oldYear);
                    this.setMonth(oldMonth);
                    this.setDay(oldDay);

                    // 時間をUTCからJSTに変換
                    let birthdayTime = new Date(family.birthday_time);
                    birthdayTime = new Date(birthdayTime.getTime() + (9 * 60 * 60 * 1000)); // UTCからJSTへの変換

                    // 時間をHH:mmフォーマットに変換（秒を削除）
                    this.$refs.birthday_time.value = birthdayTime.toISOString().split('T')[1].split(':')[0] + ':' + birthdayTime.toISOString().split('T')[1].split(':')[1];

                    // googlemapの再描画
                    let address = `${family.birthday_prefectures}`;
                    // console.log(family.birthday_prefectures);
                    this.updateMapAndMarker(family.birthday_prefectures);
                });
            } else {
                this.$nextTick(() => {
                    this.$refs.relationship.value = '';
                    this.$refs.name1.value = '';
                    this.$refs.name2.value = '';
                    this.$refs.birthday_prefectures.value = '';
                    // this.$refs.birthday_city.value = '';
                    this.$refs.birthday.value = '';
                    this.$refs.birthday_time.value = '';
                    this.birthday = '';
                });
            }
        },
        //自分を選択したら自分の情報をセットする
        setSelfInfo(){
            if(event.target.value == '1'){
                this.$nextTick(() => {
                    this.$refs.birthday_prefectures.value = '{{ auth()->guard('user')->user()->birthday_prefectures }}';
                    this.$refs.birthday.value ='{{ auth()->guard('user')->user()->birthday?->format('Y-m-d') }}';
                    this.$refs.birthday_time.value = '{{ auth()->guard('user')->user()->birthday_time?->format('H:i') }}';
                });
            }
        },
        dicountTotalPlace(){
            this.discountPrice = 0;
            if(this.couponCode === ''){
                alert('クーポンコードを入力してください。');
                return;
            }
            this.isCalculating = true;

            //すでに値引きがあれば、2重値引きしないように値引きを戻す
            if (this.couponCode !== '' && this.discountPrice !== '') {
                this.totalAmount = this.totalAmount + this.discountPrice;
            }

            //クーポンコードから、値引額を取得する
            axios.post('/api/coupon/get_discount_price', {
                params: {
                    coupon_code: this.couponCode,
                    request_type: this.personalClick == '1' ? 'personal' : 'family',
                    user_id: '{{ auth()->guard('user')->user()->id }}',
                }
            })
            .then((response) => {
                if(response.data.discount_price){
                    this.discountPrice = response.data.discount_price;
                }
                else{
                    alert(response.data.message)
                }
            })
            .catch((error) => {
                console.log(error);
            });

            setTimeout(() => {
                this.isCalculating = false;
            }, 1000);
        },
        //クーポンの種類が変更されたら、値引き額やクーポンコードをリセットする
        couponTypeChange(){
            this.discountPrice = 0;
            this.couponCode = '';
        },
		handleInputChange() {
			let birthplace1 = document.getElementById('birthday_prefectures').value;
			let address = birthplace1;
			this.updateMapAndMarker(address);
		},
        updateMapAndMarker(address) {
			this.geocoder.geocode({ 'address': address }, (results, status) => {
				if (status === 'OK') {
					if (!this.map) {
						this.map = new google.maps.Map(document.getElementById('map'), {
							center: results[0].geometry.location,
							zoom: 9,
							mapTypeId: google.maps.MapTypeId.ROADMAP,
							scrollwheel: false,
							disableDoubleClickZoom: true,
							draggable: false,
						});
					} else {
						this.map.setCenter(results[0].geometry.location);
					}

					if (!this.marker) {
						this.marker = new google.maps.Marker({
							position: results[0].geometry.location,
							map: this.map,
							title: 'here',
						});
					} else {
						this.marker.setPosition(results[0].geometry.location);
					}

					const changeLng = results[0].geometry.location.lng();
					const changeLat = results[0].geometry.location.lat();
					document.getElementById('map-longitude').value = changeLng;
					document.getElementById('map-latitude').value = changeLat;
					document.getElementById('lng').value = changeLng;
					document.getElementById('lat').value = changeLat;
				} else {
					console.error('Geocode was not successful for the following reason: ' + status);
                    console.log("Status:",status)
				}
			});
		},
    },
    // 合計金額計算監視
    watch: {
        //discountPriceの監視新しい値が入力されたら古い値との差分を計算する
        discountPrice: function (newVal, oldVal) {
            // newValを数値に変換し、失敗した場合はNaNが返される
            const numericNewVal = Number(newVal);

            // newValが数値ではない、0以下、またはpointより大きい場合はバリデーションに引っかかる
            if (isNaN(numericNewVal) || numericNewVal < 0 || numericNewVal > this.point && this.couponType == '1') {
                if (isNaN(numericNewVal)) {
                    alert('数値を入力してください');
                } else if (numericNewVal < 0) {
                    alert('0以上の数値を入力してください');
                } else if (numericNewVal > this.point) {
                    alert('使用可能なクーポン額を超えています');
                }

                // バリデーションに引っかかった場合は、totalAmountを元に戻す
                this.totalAmount += oldVal - this.discountPrice;
                // discountPriceをリセットする
                this.$nextTick(() => {
                    this.discountPrice = 0;
                });
                return;
            }
            // ここで計算を実施
            this.totalAmount = this.totalAmount - numericNewVal + Number(oldVal);

            // 文字が入力された場合の対応
            if (isNaN(this.totalAmount) ) {
                if(this.bookbindingClick == '1'){
                    this.totalAmount = this.appraisalPrice + this.bookbindingPrice + this.shippingFee;
                }
                else{
                    this.totalAmount = this.appraisalPrice;
                }
            }
        },
        couponCode: function (val) {
			if (val === '') {
				this.discountPrice = '';
			}
		},
    },
    mounted() {
		// 初期住所をサーバーサイドで設定
		let initialAddress = @json(old('birthday_prefectures', $request->birthday_prefectures ?? $defaultAddress));
		this.updateMapAndMarker(initialAddress);

        // 年月日を設定
		let oldYear = @json(old('birth_year', $request->birth_year ?? ($defaultBirthday ? $defaultBirthday->format('Y') : '')));
		let oldMonth = @json(old('birth_month', $request->birth_monty ?? ($defaultBirthday ? $defaultBirthday->format('m') : '')));
		let oldDay = @json(old('birth_day', $request->birth_day ?? ($defaultBirthday ? $defaultBirthday->format('d') : '')));
        let birthday = @json(old('birthday',$request->birthday ?? $defaultBirthday));
		this.setYear(oldYear);
		this.setMonth(oldMonth);
		this.setDay(oldDay);
        if (!(birthday instanceof Date)) {
            birthday = new Date(birthday);
        }
        // 日付をUTCからJSTに変換
        let timezoneOffset = 9 * 60; // JSTはUTCより9時間進んでいます
        birthday.setMinutes(birthday.getMinutes() + timezoneOffset);
        this.setAge(birthday);
    }
}).mount('#Personal-appraisal');
</script>
<script>
    const stripe = Stripe('{{ config('services.stripe.public') }}');

    const elements = stripe.elements();

    var elementStyles = {
        base: {
            color: 'black',
            fontWeight: 600,
            fontFamily: 'Quicksand, Open Sans, Segoe UI, sans-serif',
            fontSize: '16px',
            fontSmoothing: 'antialiased',

            ':focus': {
                color: '#424770',
            },

            '::placeholder': {
                color: '#9BACC8',
            },

            ':focus::placeholder': {
                color: '#CFD7DF',
            },
        },
        invalid: {
            color: '#FA755A',
            ':focus': {
                color: '#FA755A',
            },
            '::placeholder': {
                color: '#FFCCA5',
            },
        },
    };

    var elementClasses = {
        focus: 'focus',
        empty: 'empty',
        invalid: 'invalid',
    };

    var cardNumber = elements.create('cardNumber', {
        style: elementStyles,
        classes: elementClasses,
    });
    cardNumber.mount('#card-number');

    var cardExpiry = elements.create('cardExpiry', {
        style: elementStyles,
        classes: elementClasses,
    });
    cardExpiry.mount('#card-expiry');

    var cardCvc = elements.create('cardCvc', {
        style: elementStyles,
        classes: elementClasses,
    });
    cardCvc.mount('#card-cvc');

    document.getElementById('payment-form').addEventListener('submit', function(event) {

        //クレジットカード決済の場合のみ実施
        if(document.querySelector('input[name="payment_type"]:checked').value == 1){
            event.preventDefault();
            console.log('クレジットカード決済');
            stripe.createToken(cardNumber).then(function(result) {
                if (result.error) {
                    // エラーハンドリング
                    alert(result.error.message);
                } else {
                    // トークンを隠しフィールドとしてフォームに追加
                    var form = document.getElementById('payment-form');

                    // トークンを隠しフィールドとしてフォームに追加
                    appendHiddenInput(form, 'stripeToken', result.token.id);

                    // カードブランドと下4桁も隠しフィールドとして追加
                    appendHiddenInput(form, 'cardBrand', result.token.card.brand);
                    appendHiddenInput(form, 'last4', result.token.card.last4);

                    // 申し込み内容確認画面へリダイレクト
                    form.submit();
                }
            });
        }
    });

    function appendHiddenInput(form, name, value) {
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', name);
        hiddenInput.setAttribute('value', value);
        form.appendChild(hiddenInput);
    }
</script>

@endsection
