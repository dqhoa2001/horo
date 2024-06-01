<div class="C-appraisal-banner-block">
    <div class="C-appraisal-banner__image">
        <img src="{{ asset('images/mypage/banner-top-logo.svg') }}" alt="">
    </div>
    <div class="C-solar-appraisal-banner__price-appraisal">
        <p class="C-appraisal-banner_sub-title">［ 家族割引価格 ］</p>
        <p class="C-appraisal-banner__price">
            {{ number_format($solar_appraisal->family_price) }}円<span>(税込)</span>
        </p>
    </div>
    <p class="C-solar-appraisal-banner__book-price">
        [ 製本オプション + {{ $bookbinding->price_formatted
    }}円<span class="book-price">(税込)</span>]<span class="book-price">　<br class="sp">※製本オプションは2024年2月リリース</span>
    </p>
    <div class="C-solar-appraisal-banner__box">
        <p class="C-solar-form__message C-appraisal-banner__book-text">
            海部舞がすべて書き下ろした鑑定文で、あなただけの唯一無二の内容</p>
        <p class="C-solar-form__message C-appraisal-banner__book-text">A4サイズで約40ページのボリューム</p>
        <p class="C-solar-form__message C-appraisal-banner__book-text">ひとつの天体だけで3ページ以上のボリューム</p>
        <p class="C-solar-form__message-line4 C-appraisal-banner__book-text">星々の特性が更に具体的になる！<br>
            「サビアンシンボル」と「アスペクト」も掲載！</p>
    </div>
    <div class="C-solar-appraisal-banner__sub-box">
        <div class="C-appraisal-banner__sub-flex">
            <div>
                <div class="C-solar-appraisal-banner__sub-box-image">
                    <img src="{{ asset('images/mypage/solar-sample-text.svg') }}" alt="">
                </div>
                <p class="C-appraisal-banner__sub-sample-text">鑑定内容のサンプル画面をご確認いただけます。</p>
            </div>
            <div class="C-appraisal-banner__sub-sample-image">
                <div class="solar-sample-btn-block">
                    <a href="{{ route('user.appraisals.download_sample_pdf') }}">
                        <!-- @if(str_contains(Request::url(), 'family_appraisals'))
                            <img src="{{ asset('images/common/sample-btn-family.svg') }}" alt="">
                        @else
                            <img src="{{ asset('images/common/solar-sample-btn.svg') }}" alt="">
                        @endif -->
                        <!-- <img src="{{ asset('images/common/solar-sample-btn.svg') }}" alt=""> -->
                        <picture>
                            <source srcset="{{ asset('images/common/small-solar-sample-btn.svg') }}"
                                media="(max-width: 500px)">
                            <img src="{{ asset('images/common/solar-sample-btn.svg') }}" alt="">
                        </picture>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <p class="C-solar-appraisal-banner__under-text">出生時間に関する<br class="sp">よくある質問と注意事項は<a class="solar-small_link" href="https://hoshinomai.jp/faq" target="_blank" rel="noopener noreferrer">こちら</a></p>
    <div class="C-solar-appraisal-banner__under-btn">
        <!-- <a href="{{ route('user.appraisals.create', ['target_type' => str_contains(Request::url(), 'family_appraisals') ? '2' : '']) }}"> -->
        <a href="{{route('user.check_payment_solar.create')}}">
        <span class="solar-button">
                お申し込みはこちら
            </span>
        </a>
    </div>
</div>
