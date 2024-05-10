@extends('layouts.user.front.app')

@section('css')
<!-- Front-design-entry -->
<link rel="stylesheet" href="{{ asset('front/assets/css/form.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/entry.css') }}">
@endsection

@section('content')
<div class="top-logo">
    <a href="https://hoshinomai.jp/" target="_blank" rel="noopener noreferrer">
        <img src="{{ asset('images/common/top-logo.svg') }}" alt="" width="200" >
    </a>
    <br>
    <div class="top-register">
        <img src="{{ asset('images/common/top-register-text.svg') }}" width="150" alt="">
    </div>
</div>
<div class="maxwidth sp_maxwidth">
    <section class="sec Offer C-form" id="register">
        <p class="C-form__message C-form-line C-form-line--first">
            下記フォームの
            <span class="C-form__message__req">必須項目</span>
            をご記入の上、会員登録をしてください。
        </p>
        <form method="POST" action="{{ route('user.register') }}">
            @csrf
            <div class="C-form-block__wrap">
                <dl class="C-form-block C-form-block--name">
                    <dt class="C-form-block__title C-form-block__title--req">お名前</dt>
                    <dd class="C-form-block__body C-form-block__body--two">
                        <div class="C-form-block__field">
                            @include('components.form.text',[
                            'name' => 'name1',
                            'required' => true,
                            'placeholder' => '姓',
                            ])
                        @include('components.form.error', ['name' => 'name1'])
                        </div>
                        <div class="C-form-block__field">
                            @include('components.form.text',[
                            'name' => 'name2',
                            'required' => true,
                            'placeholder' => '名',
                            ])
                        @include('components.form.error', ['name' => 'name2'])
                        </div>
                    </dd>
                </dl>
                <dl class="C-form-block C-form-block--kana">
                    <dt class="C-form-block__title C-form-block__title--req">フリガナ</dt>
                    <dd class="C-form-block__body C-form-block__body--two">
                        <div class="C-form-block__field">
                            @include('components.form.text',[
                            'name' => 'kana1',
                            'required' => true,
                            'placeholder' => 'セイ',
                            ])
                        @include('components.form.error', ['name' => 'kana1'])
                        </div>
                        <div class="C-form-block__field">
                            @include('components.form.text',[
                            'name' => 'kana2',
                            'required' => true,
                            'placeholder' => 'メイ',
                            ])
                        @include('components.form.error', ['name' => 'kana2'])
                        </div>
                    </dd>
                </dl>
                <dl class="C-form-block">
					<dt class="C-form-block__title C-form-block__title--req">メールアドレス</dt>
					<dd class="C-form-block__body C-form-block__body--half">
						<div class="C-form-block__field">
							@include('components.form.text', [
							'name' => 'email',
							'required' => true,
							'placeholder' => 'example@example.com',
							'value' => $request->email ?? '',
							])
						</div>
						@include('components.form.error', ['name' => 'email', 'class' => 'text-danger'])
					</dd>
				</dl>
				<dl class="C-form-block">
					<dt class="C-form-block__title C-form-block__title--req">メールアドレス確認</dt>
					<dd class="C-form-block__body C-form-block__body--half">
						<div class="C-form-block__field">
							@include('components.form.text', [
							'name' => 'email_confirmation',
							'required' => true,
							'placeholder' => 'example@example.com',
							])
						</div>
						@include('components.form.error', ['name' => 'email_confirmation', 'class' => 'text-danger'])
					</dd>
				</dl>
                {{-- <dl class="C-form-block C-form-block--birth">
                    <dt class="C-form-block__title C-form-block__title--req">生年月日</dt>
                    <dd class="C-form-block__body C-form-block__body--half">
                        <div class="C-form-block__field">
                            @include('components.form.date',[
                            'name' => 'birthday',
                            'required' => true,
                            'placeholder' => '0000 / 00 / 00',
                            ])
                        </div>
                        @include('components.form.error', ['name' => 'birthday']) --}}
                <dl class="C-form-block-child C-form-block--birth">
                    <dt class="C-form-block__title">生年月日</dt>
                    <div style="display: flex">
                        <dd class="C-form-block__select">
                            <select id="select_year" name="birth_year" @change="setDay">
                                <option value="">年</option>
                            </select>
                            @include('components.form.error', ['name' => 'birth_year', 'class' => 'text-danger'])
                        </dd>
                        <dd class="C-form-block__select">
                            <select id="select_month" name="birth_month" @change="setDay">
                                <option value="">月</option>
                            </select>
                            @include('components.form.error', ['name' => 'birth_month', 'class' => 'text-danger'])
                        </dd>
                        <dd class="C-form-block__select">
                            <select id="select_day" name="birth_day">
                                デフォルト値はjsで実装
                            </select>
                            @include('components.form.error', ['name' => 'birth_day', 'class' => 'text-danger'])
                        </dd>
                    </div>
                    <p class="C-form-block--password__text">スマートフォンをご利用の方は、カレンダー左上の「年」をタップ頂ければ、生まれ年をご選択頂けます</p>
                </dl>
                <dl class="C-form-block C-form-block--password">
                    <dt class="C-form-block__title C-form-block__title--req">パスワード</dt>
                    <dd class="C-form-block__body C-form-block__body--half">
                        <div class="C-form-block__field">
                            @include('components.form.password', [
                            'name' => 'password',
                            'required' => true,
                            ])
                        </div>
                        @include('components.form.error', ['name' => 'password','class' => 'text-danger'])
                        <p class="C-form-block--password__text">パスワードは半角英字（大文字と小文字）と数字を組み合わせて8桁以上12桁以内で入力してください。</p>
                        <div class="C-form-block--password-tab">
                            <div class="C-form-block--password-tab__item C-form-block--password-tab__item--big">大文字
                            </div>
                            <div class="C-form-block--password-tab__item C-form-block--password-tab__item--small">小文字
                            </div>
                            <div class="C-form-block--password-tab__item C-form-block--password-tab__item--number">数字
                            </div>
                            <div class="C-form-block--password-tab__item C-form-block--password-tab__item--count">桁数
                            </div>
                        </div>
                    </dd>
                </dl>
                <dl class="C-form-block C-form-block--password-confirm">
                    <dt class="C-form-block__title C-form-block__title--req">パスワード確認</dt>
                    <dd class="C-form-block__body C-form-block__body--half">
                        <div class="C-form-block__field">
                            @include('components.form.password', [
                            'name' => 'password_confirmation',
                            'required' => true,
                            ])
                        </div>
                        @include('components.form.error', ['name' => 'password', 'class' => 'text-danger'])
                        <p class="C-form-block--password__text">パスワードは半角英字（大文字と小文字）と数字を組み合わせて8桁以上12桁以内で入力してください。</p>
                        <div class="C-form-block--password-tab">
                            <div class="C-form-block--password-tab__item C-form-block--password-tab__item--big-confirm">大文字
                            </div>
                            <div class="C-form-block--password-tab__item C-form-block--password-tab__item--small-confirm">小文字
                            </div>
                            <div class="C-form-block--password-tab__item C-form-block--password-tab__item--number-confirm">数字
                            </div>
                            <div class="C-form-block--password-tab__item C-form-block--password-tab__item--count-confirm">桁数
                            </div>
                        </div>
                    </dd>
                </dl>
            </div>
            <div class="C-form-policy C-form-line C-form-line--last">
                <div class="C-form-policy__inner">
                    <div class="C-form-policy-block">
                        <div class="C-form-block__checkbox">
                            <label class="C-form-block__checkbox__item">
                                <input type="checkbox" required name="termsOfUse">
                                <span class="C-form-block__checkbox__text">
                                    <a href="https://hoshinomai.jp/terms-of-use/" target="_blank">利用規約</a>を確認しました。
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="C-form-policy-block">
                        <div class="C-form-block__checkbox">
                            <label class="C-form-block__checkbox__item">
                                <input type="checkbox" required name="privacy">
                                <span class="C-form-block__checkbox__text">
                                    <a href="https://hoshinomai.jp/privacy" target="_blank">個人情報保護方針</a>を確認しました。
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="Button">
                <span>新規会員登録する</span>
            </button>
        </form>
    </section>
</div>
@endsection

@section('script')
<script src="{{ asset('front/assets/js/jquery.autoKana.js') }}"></script>
<script src="{{ asset('front/assets/js/form.js') }}"></script>
<script src="{{ asset('mypage/assets/js/input.js') }}"></script>
<script>
	Vue.createApp({
    data() {
        return {
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
    },
	mounted() {
		// 年月日を設定
		let oldYear = @json(old('birth_year', $request->birth_year ?? ''));
		let oldMonth = @json(old('birth_month', $request->birth_month ?? ''));
		let oldDay = @json(old('birth_day', $request->birth_day ?? ''));
		this.setYear(oldYear);
		this.setMonth(oldMonth);
		this.setDay(oldDay);
    }
}).mount('#register');
</script>

@endsection