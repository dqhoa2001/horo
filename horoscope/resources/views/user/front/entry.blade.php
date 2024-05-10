@extends('layouts.user.front.app')

@section('css')
<!-- Front-design-entry -->
<link rel="stylesheet" href="{{ asset('front/assets/css/form.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/entry.css') }}">
@endsection

@section('content')
<div class="maxwidth sp_maxwidth">
	<section class="sec Offer C-form" id="Offer">
		<p class="C-form__message C-form-line C-form-line--first">下記フォームの<span
				class="C-form__message__req">必須項目</span>をご記入の上、会員登録をしてください。</p>
		<form>
			<div class="C-form-block__wrap">
				<dl class="C-form-block C-form-block--name">
					<dt class="C-form-block__title C-form-block__title--req">お名前</dt>
					<dd class="C-form-block__body C-form-block__body--two">
						<div class="C-form-block__field"><input type="text" name="name1" placeholder="姓"></div>
						<div class="C-form-block__field"><input type="text" name="name2" placeholder="名"></div>
					</dd>
				</dl>
				<dl class="C-form-block C-form-block--kana">
					<dt class="C-form-block__title C-form-block__title--req">フリガナ</dt>
					<dd class="C-form-block__body C-form-block__body--two">
						<div class="C-form-block__field"><input type="text" name="kana1" placeholder="セイ"></div>
						<div class="C-form-block__field"><input type="text" name="kana2" placeholder="メイ"></div>
					</dd>
				</dl>
				<dl class="C-form-block C-form-block--email">
					<dt class="C-form-block__title C-form-block__title--req">メールアドレス</dt>
					<dd class="C-form-block__body C-form-block__body--two">
						<div class="C-form-block__field"><input type="text" name="email1" placeholder="example"></div>
						<div class="C-form-block__field"><input type="text" name="email2" placeholder="hoshinomai.com"></div>
					</dd>
				</dl>
				<dl class="C-form-block C-form-block--birth">
					<dt class="C-form-block__title C-form-block__title--req">生年月日</dt>
					<dd class="C-form-block__body C-form-block__body--half">
						<div class="C-form-block__field"><input type="text" name="birth" placeholder="0000 / 00 / 00"></div>
					</dd>
				</dl>
				<dl class="C-form-block C-form-block--password">
					<dt class="C-form-block__title C-form-block__title--req">パスワード</dt>
					<dd class="C-form-block__body C-form-block__body--half">
						<div class="C-form-block__field"><input type="password" name="password" placeholder="＊＊＊＊＊＊＊＊"></div>
						<p class="C-form-block--password__text">※半角英字と数字を組み合わせて8桁以上12桁以内で入力してください。</p>
						<div class="C-form-block--password-tab">
							<div class="C-form-block--password-tab__item C-form-block--password-tab__item--big">大文字</div>
							<div class="C-form-block--password-tab__item C-form-block--password-tab__item--small">小文字</div>
							<div class="C-form-block--password-tab__item C-form-block--password-tab__item--number">数字</div>
							<div class="C-form-block--password-tab__item C-form-block--password-tab__item--count">桁数</div>
						</div>
					</dd>
				</dl>
			</div>
			<div class="C-form-policy C-form-line C-form-line--last">
				<div class="C-form-policy__inner">
					<div class="C-form-policy-block">
						<div class="C-form-block__checkbox">
							<label class="C-form-block__checkbox__item">
								<input type="checkbox" name="rule" value="利用規約を確認しました。">
								<span class="C-form-block__checkbox__text"><a href="https://hoshinomai.jp/terms-of-use/" target="_blank">利用規約</a>を確認しました。</span>
							</label>
						</div>
					</div>
					<div class="C-form-policy-block">
						<div class="C-form-block__checkbox">
							<label class="C-form-block__checkbox__item">
								<input type="checkbox" name="rule" value="個人情報保護方針を確認しました。">
								<span class="C-form-block__checkbox__text"><a href="https://hoshinomai.jp/privacy" target="_blank">個人情報保護方針</a>を確認しました。</span>
							</label>
						</div>
					</div>
				</div>
			</div>
			<button type="button" class="Button"><span>入力内容を確認する</span></button>
		</form>
	</section>
</div>
@endsection

@section('script')
<script src="{{ asset('front/assets/js/jquery.autoKana.js') }}"></script>
<script src="{{ asset('front/assets/js/form.js') }}"></script>
@endsection