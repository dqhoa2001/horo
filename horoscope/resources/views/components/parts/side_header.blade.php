<!-- ***** ヘッダー ***** -->
<header class="header">
    <div class="header-top flexCB">
        <h1 class="header-name">
            <a href="https://hoshinomai.jp/" target="_blank">
                <img src="{{ asset('mypage/assets/images/common/sitename.svg') }}
                " alt="HOSHI NO MAI">
            </a>
        </h1>
        <div class="Pageframe-main-header-right">
            {{-- <div class="Pageframe-main-header-language">
                <select class="Pageframe-main-header-language__inner" name="">
                    <option class="Pageframe-main-header-language__text" selected>日本語</option>
                    <option class="Pageframe-main-header-language__text">英語</option>
                </select>
            </div> --}}
            <a class="Pageframe-main-header__user" href="" onclick="event.preventDefault();">
                {{ (new \App\Presenters\UserPresenter(auth()->guard('user')->user()))->displayName() }}
            </a>
        </div>
        <div class="header-logo pc"><img src="{{ asset('mypage/assets/images/common/logo.svg') }}" alt="HOSHI NO MAI"></div>
        <!-- ***** グローバルナビ *****-->
        <nav class="header-nav">
            <ul class="header-nav__inner">
                <li class="header-nav__item header-nav__item--myhoroscope">
                    @if (auth()->guard('user')->user()->isHasMyHoroscope())
                        <a href="{{ route('user.my_horoscopes.edit') }}">
                    @else
                        <a href="{{ route('user.my_horoscopes.create') }}">
                    @endif
                    <span>MYホロスコープ<br class="sp">チャート</span></a>
                </li>
                <li class="header-nav__item header-nav__item--appraisal"><a href="{{ route('user.appraisals.index') }}"><span>個人鑑定</span></a></li>
                <li class="header-nav__item header-nav__item--familyhoroscope"><a href="{{ route('user.families.index') }}"><span>家族の<br class="sp">ホロスコープ</span></a></li>
                <li class="header-nav__item header-nav__item--familyappraisal"><a href="{{ route('user.family_appraisals.index') }}"><span>家族の<br class="sp">個人鑑定</span></a></li>
                {{-- <li class="header-nav__item header-nav__item--familyappraisal"><a href="{{ route('user.bookbindings.create') }}"><span>製本のお申し込み</span></a></li> --}}
                <li class="header-nav__item header-nav__item--coupon"><a href="{{ route('user.coupon') }}"><span>ご紹介クーポン</span></a></li>
                <li class="header-nav__item header-nav__item--contact"><a href="{{ route('user.contacts.create') }}"><span>お問い合わせ</span></a></li>
            </ul>
        <div class="header-nav__current-marker"></div>
        </nav>
        <div class="header-nav-button sp">
            <img src="{{ asset('mypage/assets/images/common/img_menu-button_open.png') }}"
            srcset="{{ asset('mypage/assets/images/common/img_menu-button_open.png 1x') }}, {{ asset('mypage/assets/images/common/img_menu-button_open@2x.png 2x') }}" alt="MENU" class="header-nav-button__open">

            <img src="{{ asset('mypage/assets/images/common/img_menu-button_close.png') }}"
            srcset="{{ asset('mypage/assets/images/common/img_menu-button_close.png 1x') }}, {{ asset('mypage/assets/images/common/img_menu-button_close@2x.png 2x') }}" alt="MENU" class="header-nav-button__close">
        </div>
        <!-- ***** グローバルナビ *****-->
    </div>
    <figure class="header-mark pc"><img src="{{ asset('mypage/assets/images/common/img_header-mark.svg') }}"></figure>
</header>
<!-- ***** ヘッダー ***** -->
