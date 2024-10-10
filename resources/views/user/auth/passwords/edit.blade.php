@extends('layouts.user.mypage.app')

@section('css')
<link rel="stylesheet" href="{{ asset('mypage/assets/css/contact.css') }}">
@endsection

@section('content')

<div class="Pageframe">

    @include('components.parts.side_header')

    <main class="Pageframe-main">

        @include('components.parts.top_header')
        
        <div class="Pageframe-main__scroll">
            
            <header class="Pageframe-main-header">
                <div class="Pageframe-main-header__first"><a href="{{ route('user.popup') }}">マイページ</a></div>
                <h2 class="Pageframe-main-header__pagename">お問い合わせ</h2>
            </header>
            
            <div class="Pageframe-main__inner">
                {{-- フラッシュメッセージ --}}
                <div class="Pageframe-main-content">
                    @include('components.parts.original_flash_message')
                    <!-- ***** セクション名 ***** -->
                    <section class="sec Contact C-form">
                        <h2 class="Pageframe-main__title">パスワードの変更</h2>
                        <form method="POST" action="{{ route('user.passwords.update') }}">
                            @csrf
                            @method('PATCH')
                            <div class="C-form-block__wrap">
                                <dl class="C-form-block">
                                    <dt class="C-form-block__title C-form-block__title--req">現在のパスワード</dt>
                                    <dd class="C-form-block__body">
                                        <div class="C-form-block__field">
                                            @include('components.form.password', ['name' => 'now_password', 'required'
                                            => true])
                                        </div>
                                    </dd>
                                    @include('components.form.error', ['name' => 'now_password'])
                                </dl>
                            </div>
                            <div class="C-form-block__wrap">
                                <dl class="C-form-block">
                                    <dt class="C-form-block__title C-form-block__title--req">新しいパスワード</dt>
                                    <dd class="C-form-block__body">
                                        <div class="C-form-block__field">
                                            @include('components.form.password', ['name' => 'new_password', 'required'
                                            => true])
                                        </div>
                                    </dd>
                                    @include('components.form.error', ['name' => 'new_password',
                                    'class' => 'text-danger'])
                                </dl>
                            </div>
                            <div class="C-form-block__wrap">
                                <dl class="C-form-block">
                                    <dt class="C-form-block__title C-form-block__title--req">新しいパスワード（確認）</dt>
                                    <dd class="C-form-block__body">
                                        <div class="C-form-block__field">
                                            @include('components.form.password', ['name' => 'new_password_confirmation',
                                            'required' => true])
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                            
                            <button type="submit" class="Button Button--lightblue"><span>パスワード変更</span></button>
                        </form>
                    </section>
                    <!-- ***** セクション名 ***** -->
                </div>
            </div>

            <!-- ***** フッター ***** -->
            <footer class="footer sp">
                <div class="footer-name"><a href="./"><img src="{{ asset('mypage/assets/images/common/sitename.svg') }}"
                            alt="HOSHI NO MAI"></a></div>
                <figure class="footer-logo"><img src="{{ asset('mypage/assets/images/common/logo.svg') }}"></figure>
                <p class="footer-copyright">© 2023 HOSHI NO MAI.</p>
            </footer>
            <!-- ***** フッター ***** -->

        </div>

    </main>

</div>
@endsection