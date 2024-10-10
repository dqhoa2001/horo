$('.C-form-block--coupon-wrap input[type="radio"]').on('change',function(){
    if( $(this).val() == '0' )
    {
        $('.C-form-block--couponno').addClass('on');
        $('.C-form-block--couponcode').removeClass('on');
    }
    else if( $(this).val() == '1' )
    {
        $('.C-form-block--couponcode').addClass('on');
        $('.C-form-block--couponno').removeClass('on');
    }
});