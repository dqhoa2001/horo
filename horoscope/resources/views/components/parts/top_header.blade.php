<header class="Pageframe-main-header">
  <div class="Pageframe-main-header__first"><a href="{{ route('user.popup') }}">マイページ</a></div>
  <h2 class="Pageframe-main-header__pagename">
    {{-- @if ((int)\Request::get('target_type') !== \App\Models\AppraisalApply::FAMILY) --}}
    @if((int)Request::get('target_type') === \App\Models\AppraisalApply::FAMILY)
      家族の
    @endif
    @switch(Request::url())
      @case(str_contains(Request::url(), 'popup'))
      マイページ
      @break
      @case(str_contains(Request::url(), 'horoscope'))
      MYホロスコープチャート
      @break
      @case(str_contains(Request::url(), 'user/appraisals'))
      個人鑑定
      @break
      @case(str_contains(Request::url(), 'user/families'))
      家族のホロスコープ
      @break
      @case(str_contains(Request::url(), 'user/family_appraisals'))
      家族の個人鑑定
      @break
      @case(str_contains(Request::url(), 'bookbinding'))
      製本の申し込み
      @break
      @case(str_contains(Request::url(), 'coupon'))
      ご紹介クーポン
      @break
      @case(str_contains(Request::url(), 'contact'))
      お問い合わせ
      @break
      @case(str_contains(Request::url(), 'settings'))
      ユーザー設定
      @break
    @endswitch
  </h2>
  <div class="Pageframe-main-header-right">
    {{-- <div class="Pageframe-main-header-language">
      <select class="Pageframe-main-header-language__inner" name="">
        <option class="Pageframe-main-header-language__text" selected>日本語</option>
        <option class="Pageframe-main-header-language__text">英語</option>
      </select>
    </div> --}}

    <p class="Pageframe-main-header__user">
      <span>
        <a onclick="event.preventDefault();" href="">
          {{ auth()->guard('user')->user()->full_name }}
        </a>
      </span>
    </p>

  </div>
</header>
<ul class="Pageframe-main-header__user-child">
  <li class="Pageframe-main-header__user-child__item Pageframe-main-header__user-child__item--user">
    <a href="{{ route('user.settings.edit') }}">ユーザー設定</a>
  </li>
  <li class="Pageframe-main-header__user-child__item Pageframe-main-header__user-child__item--logout">
    <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{
      __('Logout') }}</a>
    <form id="logout-form" action="{{ route('user.logout') }}" method="post">@csrf</form>
  </li>
</ul>
