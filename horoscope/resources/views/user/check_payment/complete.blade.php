@extends('layouts.user.mypage.app')

@section('css')
<link rel="stylesheet" href="{{ asset('mypage/assets/css/personal-appraisal-form.css') }}">
@endsection

@section('content')
<div class="Pageframe">
    @include('components.parts.side_header')
    <main class="Pageframe-main">
        @include('components.parts.top_header')
        <div class="Pageframe-main">
            <div class="Pageframe-main__inner">
                <div class="Pageframe-main-content">
                    <section class="sec Offer C-form" id="Offer">
                        <p class="C-form__message C-form-line C-form-line--first">
                            <span class="C-form__message__req">{{ \App\Models\AppraisalApply::COMPLETE_TARGET_TYPE[(int)$target_type] }}鑑定申し込み完了</span>
                        </p>
                        <p class="C-form-block--text">
                            会員登録と{{ \App\Models\AppraisalApply::COMPLETE_TARGET_TYPE[(int)$target_type] }}鑑定申し込みが完了いたしました。<br>
                            申し込みありがとうございました。
                        </p>

                        <!--クレジットの場合-->
                        @if((int)$appraisalApply->appraisalClaim->payment_type === \App\Models\AppraisalClaim::CREDIT)
                            <!--家族の場合-->
                            @if((int)$target_type === \App\Enums\TargetType::FAMILY->value)
                                <div class="Button Button--lightblue btn-block-mt">
                                    <a href="{{ route('user.family_appraisals.show', $appraisalApply->id) }}">
                                        家族の個人鑑定結果はこちら
                                    </a>
                                </div>
                            @else
                                <!--個人の場合-->
                                <div class="Button Button--lightblue btn-block-mt">
                                    <a href="{{ route('user.appraisals.show', $appraisalApply->id) }}">
                                        個人鑑定結果はこちら
                                    </a>
                                </div>
                            @endif
                        @else
                        <!--銀行振り込みの場合-->
                            <p class="C-form-block--text">
                                銀行振込を選択した会員様は、振り込みが完了出来次第<br>鑑定結果が閲覧できます
                            </p>
                            <br>
                            <p class="C-form-block--text">
                                会員様のメールアドレスへ振込先のご案内をお送りしておりますのでご確認ください。
                            </p>
                            <div class="Button Button--lightblue btn-block-mt">
                                <a href="{{ route('user.popup') }}">
                                    マイページへ戻る
                                </a>
                            </div>
                        @endif
                    </section>
                </div>
            </div>
        </div>
        @include('components.parts.footer')
    </main>
</div>

@endsection
