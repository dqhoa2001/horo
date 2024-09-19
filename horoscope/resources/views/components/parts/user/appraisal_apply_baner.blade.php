<div class="C-appraisal-banner-block">
    <div class="C-appraisal-banner__image">
        <img src="{{ asset('images/mypage/banner-top-logo.svg') }}" alt="">
    </div>
    @if(str_contains(Request::url(), 'family_appraisals'))
        <p class="C-appraisal-banner_sub-title C-appraisal-banner__price-family">［ 家族割引価格 ］</p>
        <p class="C-appraisal-banner__price C-appraisal-banner__price-family">
            {{ number_format($appraisal->family_price) }}円<span class="C-appraisal-banner__price-family">(税込)</span>
        </p>
    @else
        <p class="C-appraisal-banner__price C-appraisal-banner__price--mt C-appraisal-banner__price-appraisal">    
            {{ number_format($appraisal->price) }}円<span>(税込)</span>
        </p>
    @endif
    <p class="C-appraisal-banner__book-price">
        [ 製本オプション + {{ $bookbinding->price_formatted
        }}円<span>(税込)</span>]<span>　<br class="sp">※製本オプションは2024年2月リリース</span>
    </p>
    <div class="C-appraisal-banner__box">
        <p class="C-form__message C-appraisal-banner__book-text">
            海部舞がすべて書き下ろした鑑定文で、あなただけの唯一無二の内容</p>
        <p class="C-form__message C-appraisal-banner__book-text">A4サイズで約40ページのボリューム</p>
        <p class="C-form__message C-appraisal-banner__book-text">ひとつの天体だけで3ページ以上のボリューム</p>
        <p class="C-form__message C-appraisal-banner__book-text">星々の特性が更に具体的になる！<br>
            「サビアンシンボル」と「アスペクト」も掲載！</p>
    </div>
    <div class="C-appraisal-banner__sub-box">
        <div class="C-appraisal-banner__sub-flex">
            <div>
                <div class="C-appraisal-banner__sub-box-image">
                    @if(str_contains(Request::url(), 'family_appraisals'))
                        <img src="{{ asset('images/mypage/sample-text-family.svg') }}" alt="">
                    @else
                        <img src="{{ asset('images/mypage/sample-text.svg') }}" alt="">
                    @endif
                </div>
                <p class="C-appraisal-banner__sub-sample-text">鑑定内容のサンプル画面をご確認いただけます。</p>
            </div>
            <div class="C-appraisal-banner__sub-sample-image">
                <div class="sample-btn-block">
                    <a href="{{ route('user.appraisals.download_sample_pdf') }}">
                        @if(str_contains(Request::url(), 'family_appraisals'))
                            <img src="{{ asset('images/common/sample-btn-family.svg') }}" alt="">
                        @else
                            <img src="{{ asset('images/common/sample-btn.svg') }}" alt="">
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </div>
    <p class="C-appraisal-banner__under-text">出生時間に関する<br class="sp">よくある質問と注意事項は<a class="small_link" href="https://hoshinomai.jp/faq" target="_blank" rel="noopener noreferrer">こちら</a></p>
    <div class="C-appraisal-banner__under-btn">
        <a href="{{ route('user.appraisals.create', ['target_type' => str_contains(Request::url(), 'family_appraisals') ? '2' : '']) }}">
        <span class="original-button">
                お申し込みはこちら
            </span>
        </a>
    </div>
</div>