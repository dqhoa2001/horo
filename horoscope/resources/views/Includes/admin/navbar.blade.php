<header>
    <nav class="navbar navbar-expand navbar-light navbar-top">
        <div class="container-fluid">
            @auth('admin')
                <a href="#" class="burger-btn d-block">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            @endauth

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <div class="language" style="margin-right: 40px">
                    <a href="{{ route('admin.change-language', config('app.locale') == 'ja' ? 'en' : 'ja') }}">
                        <img width="15" height="15" class="admin_icon" src="{{ asset('images/common/admin_icon.svg') }}" alt="">
                        <span class="admin-color" style="color:#39395C;">{{ config('app.available_locales.' . config('app.locale')) }}
                        </span>
                    </a>
                </div>
                <div >
                    <!-- Horoscopeは不要なためコメントアウト -->
                    {{-- <a href="{{ route('admin.login') }}" class="btn btn-primary">Login</a> --}}
                    {{-- <a class="nav-link active" href="{{ route('admin.login') }}" style="color: white">
                        <div class="user-menu d-flex">
                            <div class="user-name text-end me-3">
                                <h6 class="mb-0 text-gray-600">Horoscope</h6>
                                <p class="mb-0 text-sm text-gray-600">
                                    {{ auth()->user()->is_admin ? 'Administrators' : 'Member' }}</p>
                            </div>
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-md">
                                    <img src="https://zuramai.github.io/mazer/demo/assets/compiled/jpg/1.jpg">
                                </div>
                            </div>
                        </div>
                    </a> --}}
                    {{-- <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton"
                        style="min-width: 11rem;">
                        <li>
                            <h6 class="dropdown-header">Hello, Admin{{ auth()->user()->name }}</h6>
                        </li>
                        <li><a class="dropdown-item"
                                href={{ Route::has('admin.profile') ? route('admin.profile', auth()->user()->id) : '#' }}><i
                                    class="icon-mid bi bi-person me-2"></i>
                                My Profile</a></li>
                        <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                                    class="icon-mid bi bi-box-arrow-left me-2"></i>
                                @lang('Logout')</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul> --}}
                </div>
            </div>
        </div>
    </nav>
</header>
