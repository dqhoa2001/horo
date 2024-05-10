/*----- 表示 */
$(window).on('load',function(){
	$("body").stop().animate({"opacity":1});
});

document.addEventListener('contextmenu', function(e) {
    if (e.target.tagName === 'IMG') {
        e.preventDefault();
    }
});
document.addEventListener('dragstart', function(e) {
    if (e.target.tagName === 'IMG') {
        e.preventDefault();
    }
});



/*------ ページ内スクロール -----*/
$('a[href^="#"]').on('click',function(){
	var speed = 500;
	var href= $(this).attr("href");
	var target = $(href == "#" || href == "" ? 'html' : href);
	var position = target.offset().top;
	$("html, body").animate({scrollTop:position}, speed, "swing");
	return false;
});



/*----- スクロールアニメーション -----*/
$(window).on('load scroll',function(){
	$('.view').each(function(){
		var elemPos = $(this).offset().top;
		var scroll = $(window).scrollTop();
		var windowHeight = $(window).height();
		if (scroll > elemPos - windowHeight + 100){
			$(this).addClass('scrollin');
		}
	});
	$('.view2').each(function(){
		var elemPos = $(this).offset().top;
		var scroll = $(window).scrollTop();
		var windowHeight = $(window).height();
		if (scroll > elemPos - windowHeight + 100){
			$(this).addClass('scrollin2');
		}
	});
});



/*----- ナビ開閉 -----*/
var hvHeight = $('.header-nav').outerHeight(true);
$('.header-nav').css({'bottom':"-" + hvHeight + "px"});
$(".header-nav-button").on('click',function(){
	if( $('.header-nav').hasClass('on') )
	{
		$('.header-nav').removeClass('on');
		$('.header-nav-button').removeClass('on');
		$('.header-nav-button').css({'bottom': "0px"});
	}
	else
	{
		$('.header-nav-button').css({'bottom': + hvHeight + "px"});
		$('.header-nav').addClass('on');
		$('.header-nav-button').addClass('on');
	}
});



/*----- オブジェクトfit */
$(window).on('load',function(){
	objectFitImages('.obj-img img');
});



/*----- ヘッダーclass付与 */
var $header = $('.header');
$(window).on('scroll',function(){
	$(window).scroll(function() {
		if($(window).scrollTop() > 0){
			$header.addClass('fixed');
		}else{
			$header.removeClass('fixed');
		}
	});
});



/*----- ポップアップ */
$('.C-popup-close').on('click',function(){
	$('.C-popup').stop().fadeOut();
});
$('.C-popup-lineadd').on('click',function(){
	$('.C-popup').stop().fadeOut();
});

/*----- タブ切り替え */
$('.C-appraisal-tab__item').on('click',function(){
	
	var ind = $('.C-appraisal-tab__item').index(this);
	$('.C-appraisal-tab__item--current').removeClass('C-appraisal-tab__item--current');
	$(this).addClass('C-appraisal-tab__item--current');

	$('.C-appraisal-content').removeClass('C-appraisal-content--current');
	$('.C-appraisal-content').eq(ind).addClass('C-appraisal-content--current');
});


/*----- 郵便番号自動入力 */
// $('.C-form-block--zip .C-form-block__button').on('click',function(){
// 	AjaxZip3.zip2addr('zip', '', 'address', 'address');
// });