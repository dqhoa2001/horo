/*----- タブレット表記 */
$(window).on('load resize', function () {
	if (navigator.userAgent.indexOf('iPhone') > 0 || navigator.userAgent.indexOf('Android') > 0 && navigator.userAgent.indexOf('Mobile') > 0) {
		$('html').removeClass('useragent-tab');
	}
	else if (navigator.userAgent.indexOf('iPad') > 0 || navigator.userAgent.indexOf('Android') > 0) {
		$('html').addClass('useragent-tab');
	}
	else {
		$('html').removeClass('useragent-tab');
	}
});

/*----- 表示 */
$(window).on('load', function () {
	$("body").stop().animate({ "opacity": 1 });
});

document.addEventListener('contextmenu', function (e) {
	if (e.target.tagName === 'IMG') {
		e.preventDefault();
	}
});
document.addEventListener('dragstart', function (e) {
	if (e.target.tagName === 'IMG') {
		e.preventDefault();
	}
});



/*------ ページ内スクロール -----*/
$('a[href^="#"]').on('click', function () {
	var speed = 500;
	var href = $(this).attr("href");
	var target = $(href == "#" || href == "" ? 'html' : href);
	var position = target.offset().top;
	$("html, body").animate({ scrollTop: position }, speed, "swing");
	return false;

});

// if ( navigator.userAgent.indexOf('iPhone') > 0 ){
// 	$('.C-top').on('click',function(){
// 		$('.Pageframe-main').animate({'scrollTop':0},'swing');
// 	});
// }
// else
// {
// 	$('.C-top').on('click',function(){
// 		$('#mCSB_1_container').animate({'top':0},'swing');
// 	});
// }

if (navigator.userAgent.match(/iPhone|Android.+Mobile/)) {
	$('.C-top').on('click',function(){
		$('.Pageframe-main').animate({'scrollTop':0},'swing');
	});
}
else{
	$('.C-top').on('click',function(){
		$('#mCSB_1_container').animate({'top':0},'swing');
	});
}

/*----- スクロールアニメーション -----*/
$(window).on('load scroll', function () {
	$('.view').each(function () {
		var elemPos = $(this).offset().top;
		var scroll = $(window).scrollTop();
		var windowHeight = $(window).height();
		if (scroll > elemPos - windowHeight + 100) {
			$(this).addClass('scrollin');
		}
	});
	$('.view2').each(function () {
		var elemPos = $(this).offset().top;
		var scroll = $(window).scrollTop();
		var windowHeight = $(window).height();
		if (scroll > elemPos - windowHeight + 100) {
			$(this).addClass('scrollin2');
		}
	});
});



/*----- ナビ開閉 -----*/
$(window).on('load', function () {
	$(window).on('resize', function () {
		hvHeight = $('.header-nav').outerHeight(true);
		//console.log(hvHeight);
		$('.header-nav').css({ 'bottom': "-" + hvHeight + "px" });
	}).trigger('resize'); // 初期ロード時にも実行するためのトリガー
});
$(".header-nav-button").on('click', function () {
	if ($('.header-nav').hasClass('on')) {
		$('.header-nav').removeClass('on');
		$('.header-nav-button').removeClass('on');
		$('.header-nav-button').css({ 'bottom': "0px" });
	}
	else {
		hvHeight = $('.header-nav').outerHeight(true);
		$('.header-nav-button').css({ 'bottom': + (hvHeight - 1) + "px" });
		$('.header-nav').addClass('on');
		$('.header-nav-button').addClass('on');
	}
});

$('.Pageframe-main-header__user').on('click', function () {
	$('.Pageframe-main-header__user-child').toggleClass('on');
});


/*----- オブジェクトfit */
$(window).on('load', function () {
	objectFitImages('.obj-img img');
});



/*----- ヘッダーclass付与 */
var $header = $('.header');
$(window).on('scroll', function () {
	$(window).scroll(function () {
		if ($(window).scrollTop() > 0) {
			$header.addClass('fixed');
		} else {
			$header.removeClass('fixed');
		}
	});
});



/*----- カスタムスクロールバー */
$(window).on('load', function () {
	//if( $(window).width() > 768 )
	//{
	const ua = navigator.userAgent;
	if (ua.indexOf('iPhone') > -1 || (ua.indexOf('Android') > -1 && ua.indexOf('Mobile') > -1)) {
		// スマートフォン
	} else if (ua.indexOf('iPad') > -1 || ua.indexOf('Android') > -1) {
		// タブレット
	} else {
		// PC
		$(".Pageframe-main__scroll").mCustomScrollbar({
			//scrollInertia: 300,
			scrollEasing: 'linear',
			callbacks: {
				onScrollStart: function () {
					$('.header').addClass('on');
				},
				onTotalScrollBack: function () {
					$('.header').removeClass('on');
				}
			}
		});
	}
});



/*----- ナビのcurrentマーク */
$(document).ready(function () {
	const setPositionForMarker = (item) => {
		const rect = item.getBoundingClientRect();
		const navRect = $('.header-nav')[0].getBoundingClientRect();
		$('.header-nav__current-marker').css('top', `${rect.top - navRect.top + (rect.height - $('.header-nav__current-marker').height()) / 2}px`);
	};

	const navItems = $('.header-nav__item');
	const currentItem = $('.header-nav__item--current');
	let lastHoveredItem; // 最後にマウスが乗ったアイテムを記録する変数

	if (currentItem.length) {
		setPositionForMarker(currentItem[0]);
	} else {
		// .header-nav__item--currentが存在しない場合、最初のナビゲーションアイテムの位置にマーカーを配置し、非表示にする
		const firstNavItem = navItems.first();
		setPositionForMarker(firstNavItem[0]);
		$('.header-nav__current-marker').hide();
	}

	$('.header-nav__item').on('mouseover', function () {
		setPositionForMarker(this);
		$('.header-nav__current-marker').show();
		lastHoveredItem = this; // マウスが乗ったアイテムを記録
	});

	// ナビゲーションコンテナからマウスが離れた場合にのみ動作する
	$('.header-nav').on('mouseleave', function () {
		if (currentItem.length) {
			setPositionForMarker(currentItem[0]);
		} else if (lastHoveredItem) {
			// .header-nav__item--currentもなく、最後にマウスが乗ったアイテムがある場合、そのアイテムの位置にマーカーを配置し、非表示にする
			setPositionForMarker(lastHoveredItem);
			$('.header-nav__current-marker').hide();
		}
	});
});



/*----- ポップアップ */
$('.C-popup-close, .C-popup-add-line').on('click', function () {
	$('.C-popup').stop().fadeOut();
});
$('.C-popup-lineadd').on('click', function () {
	$('.C-popup').stop().fadeOut();
});
$('.C-user-list__change').on('click', function () {
	$('.C-popup--horoscope').stop().fadeIn();
});
$('.C-popup--horoscope .Button--cancel').on('click', function () {
	$('.C-popup--horoscope').stop().fadeOut();
});
$('.C-user-list__delete').on('click', function () {
	$('.C-popup--horoscope-delete').stop().fadeIn();
});
$('.C-popup--horoscope-delete .Button--cancel').on('click', function () {
	$('.C-popup--horoscope-delete').stop().fadeOut();
});

/*----- タブ切り替え */
$('.C-appraisal-tab__item').on('click', function () {

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


/*----- タブレットの高さ */
/* $(window).on('load resize',function(){
	var min_height = $('.Pageframe-main .Pageframe-main__scroll').height();
	var content_height = $('.Pageframe-main #mCSB_1_container').height();
	if( min_height > content_height )
	{
		$('.Pageframe-main #mCSB_1_container').addClass('on');
	}
}); */