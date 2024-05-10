$('.C-form-block--target input[type="radio"]').on('change',function(){
    if( $(this).val() == '家族' )
    {
        $('.Personal-appraisal-family').addClass('on');
    }
    else
    {
        $('.Personal-appraisal-family').removeClass('on');
    }
});


/* $('.C-form-block--coupon-wrap input[type="radio"]').on('change',function(){
    if( $(this).val() == 'ご紹介ポイントを使用' )
    {
        $('.C-form-block--couponno').addClass('on');
        $('.C-form-block--couponcode').removeClass('on');
    }
    else if( $(this).val() == 'クーポンコードを使用' )
    {
        $('.C-form-block--couponcode').addClass('on');
        $('.C-form-block--couponno').removeClass('on');
    }
}); */

$(function(){

	$('.C-form-block--password input[type="password"]').on('keyup',function(){
		passval = $(this).val();

		// 大文字チェック
		if( /[A-Z]/.test(passval) )
		{
			$('.C-form-block--password-tab__item--big').addClass('ok');
		}
		else
		{
			$('.C-form-block--password-tab__item--big').removeClass('ok');
		}

		// 小文字チェック
		if( /[a-z]/.test(passval) )
		{
			$('.C-form-block--password-tab__item--small').addClass('ok');
		}
		else
		{
			$('.C-form-block--password-tab__item--small').removeClass('ok');
		}

		// 半角数字チェック
		if( /[0-9]/.test(passval) )
		{
			$('.C-form-block--password-tab__item--number').addClass('ok');
		}
		else
		{
			$('.C-form-block--password-tab__item--number').removeClass('ok');
		}

		// 半角数字チェック
		if( /^.{8,12}$/.test(passval) )
		{
			$('.C-form-block--password-tab__item--count').addClass('ok');
		}
		else
		{
			$('.C-form-block--password-tab__item--count').removeClass('ok');
		}
	});

	$('.C-form-block--password-confirm input[type="password"]').on('keyup',function(){
		passval = $(this).val();

		// 大文字チェック
		if( /[A-Z]/.test(passval) )
		{
			$('.C-form-block--password-tab__item--big-confirm').addClass('ok');
		}
		else
		{
			$('.C-form-block--password-tab__item--big-confirm').removeClass('ok');
		}

		// 小文字チェック
		if( /[a-z]/.test(passval) )
		{
			$('.C-form-block--password-tab__item--small-confirm').addClass('ok');
		}
		else
		{
			$('.C-form-block--password-tab__item--small-confirm').removeClass('ok');
		}

		// 半角数字チェック
		if( /[0-9]/.test(passval) )
		{
			$('.C-form-block--password-tab__item--number-confirm').addClass('ok');
		}
		else
		{
			$('.C-form-block--password-tab__item--number-confirm').removeClass('ok');
		}

		// 半角数字チェック
		if( /^.{8,12}$/.test(passval) )
		{
			$('.C-form-block--password-tab__item--count-confirm').addClass('ok');
		}
		else
		{
			$('.C-form-block--password-tab__item--count-confirm').removeClass('ok');
		}
	});
});


$(function(){
    $.fn.autoKana('input[name="name1"]', 'input[name="kana1"]', {
        katakana: true  // trueにするとカタカナになります
    });
});


$(function(){
    $.fn.autoKana('input[name="name2"]', 'input[name="kana2"]', {
        katakana: true  // trueにするとカタカナになります
    });
});


$(document).ready(function() {
    $('input[name="birth"]').on('input', function() {
        var birth_val = $(this).val().replace(/\D/g, ''); // 非数字を削除

        if (birth_val.length > 8) {
            birth_val = birth_val.substring(0, 8); // 8桁を超えた入力をトリム
        }

        if (birth_val.length > 6) {
            birth_val = birth_val.substring(0, 4) + '/' + birth_val.substring(4, 6) + '/' + birth_val.substring(6, 8);
        } else if (birth_val.length > 4) {
            birth_val = birth_val.substring(0, 4) + '/' + birth_val.substring(4, 6);
        }

        $(this).val(birth_val);
    });
});

$(document).ready(function() {
    $('input[name="time"]').on('input', function() {
        var time_val = $(this).val().replace(/\D/g, ''); // 非数字を削除

        if (time_val.length > 4) {
            time_val = time_val.substring(0, 4); // 4桁を超えた入力をトリム
        }

        if (time_val.length > 2) {
            time_val = time_val.substring(0, 2) + ':' + time_val.substring(2, 4);
        }

        $(this).val(time_val);
    });
});