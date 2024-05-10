@php
$sidebarTitle = App\Enums\SidebarEnum::SidebarTitle;
$menu = App\Enums\SidebarEnum::Menu;
@endphp
<div class="sidebar-wrapper shadow p-3 mb-5 active">
    <div class="sidebar-header position-relative">
        <div class="d-flex justify-content-center align-items-center">
            <div class="logo">
                <a href="/admin/top"><img
                        src="{{ asset('images/common/top-logo.svg') }}" alt="Logo"
                        srcset="" /></a>
            </div>
            <div class="sidebar-toggler x">
                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
        </div>
    </div>
    <div class="sidebar-menu">
        <ul class="menu">
            <li class="sidebar-title">@lang($sidebarTitle)</li>
            @foreach ($menu as $index => $item)
            @if (Route::has($item['route_name']))
            <li class="sidebar-item has-sub {{ Route::current()->getPrefix() == $item['prefix'] ? 'active' : '' }}">
                <a href="#" class="sidebar-link submenu-link">
                    <i class="bi bi-{{ $item['icon'] }}"></i>
                    <span>@lang($item['title'])</span>
                </a>
                @if (array_key_exists('sub_menu', $item) && !empty($item['sub_menu']))
                <ul class="submenu {{ str_contains(request()->path(), $item['prefix']) ? 'submenu-open' : '' }}">
                    @foreach ($item['sub_menu'] as $submenu)
                    @if (Route::has($submenu['route_name']))
                    <li class="submenu-item {{ Route::currentRouteName() == $submenu['route_name'] ? 'active' : '' }}">
                        <a href="{{ route($submenu['route_name']) }}" class="submenu-link">@lang($submenu['title'])</a>
                    </li>
                    @endif
                    @endforeach
                </ul>
                @endif
            </li>
            @endif
            @endforeach
            <li class="sidebar-item has-sub">
                <a href="" class="sidebar-link submenu-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-gear-fill"></i>
                    <span>ログアウト</span>
                </a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="post">@csrf</form>
            </li>
        </ul>
    </div>
    <footer>
        @include('Includes.admin.footer')
    </footer>
</div>
