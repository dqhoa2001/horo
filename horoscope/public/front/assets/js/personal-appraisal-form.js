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


// $('.C-form-block--coupon-wrap input[type="radio"]').on('change',function(){
//     if( $(this).val() == 'ご紹介ポイントを使用' )
//     {
//         $('.C-form-block--couponno').addClass('on');
//         $('.C-form-block--couponcode').removeClass('on');
//     }
//     else if( $(this).val() == 'クーポンコードを使用' )
//     {
//         $('.C-form-block--couponcode').addClass('on');
//         $('.C-form-block--couponno').removeClass('on');
//     }
// });
