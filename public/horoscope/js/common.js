$(function(){
	$('a[href*=\\#]:not([href=\\#],.pop)').on('click',function() {
	if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var $target = $(this.hash);
			$target = $target.length && $target || $('[name=' + this.hash.slice(1) +']');
			if ($target.length) {
				if($(this).parents('.menuBox').length){
					setTimeout(function(){
						var targetOffset = $target.offset().top;
						$('html,body').animate({scrollTop: targetOffset}, 1000);
					},100);
				}else{
					var targetOffset = $target.offset().top;
					$('html,body').animate({scrollTop: targetOffset}, 1000);
				}
				return false;
			}
		}
	});

	var state = false;
	var scrollpos;
	$('.menu').on('click', function(){
		if(state == false) {
			scrollpos = $(window).scrollTop();
			$('body').addClass('fixed').css({'top': -scrollpos});
			$(this).addClass('on');
			$('.menuBox').addClass('on');
			state = true;
		}else{
			$('body').removeClass('fixed').css({'top': 0});
			window.scrollTo( 0 , scrollpos );
			$(this).removeClass('on');
			$('.menuBox').removeClass('on');
			state = false;
		}
		return false;
	});

	$('.menuBox li a:not(.accordion)').on('click',function(){
		if(window.innerWidth < 897){
			$('body').removeClass('fixed').css({'top': 0});
			window.scrollTo( 0 , scrollpos );
			$('.menu').removeClass('on');
			$('.menuBox').removeClass('on');
			state = false;
		}
	});

	$('.menuBox .menuList .arrow').on('click', function() {
		$(this).toggleClass('on');
		$(this).next().stop().slideToggle();
		return false;
	});

	$(window).on('scroll',function(){
		if(state == false) {
			if($(window).scrollTop() > $(window).height()){
				$('.scrollHeader #gHeader .menuBg,.scrollHeader #gHeader .fixLinkBg').removeClass('on');
			}else {
				$('.scrollHeader #gHeader .menuBg,.scrollHeader #gHeader .fixLinkBg').addClass('on');
			}
		}
	}).trigger('scroll');

	if($('.comBtmList').length){
		$('.comBtmList p span').matchHeight();
	}

	var img=$("img");
	img.on("contextmenu",function(){return false;});
	img.on("dragstart",function(){return false;});

	$('.fadeTxt').each(function(){
		$(this).children().addBack().contents().each(function() {
			if (this.nodeType == 3) {
				$(this).replaceWith($(this).text().replace(/(\S)/g, '<span class="fadeSpan">$1</span>'));
			}
		});
		
		$(this).find('.fadeSpan').each(function(i){
			$(this).css('transition-delay',i*0.1+'s');
		});
	});

	$('.fadeUpList').each(function(){
		var length = $(this).find('.fadeUp').length;
		if(length > 1){
			$(this).find('.fadeUp').each(function(i){
				$(this).css('transition-delay',i*0.15+'s');
			});
		}
	})

	if($('.pageTitle').length){
		var winH;
		$(window).on('resize',function(){
			if(window.innerWidth < 768){
				if(window.visualViewport){
					winH = window.visualViewport.height;
				}else{
					winH = window.innerHeight;
				}
				$('.pageTitle').innerHeight(winH + $('.pageTitle p:visible span:nth-last-child(6)').offset().top);
				$('.fullH').innerHeight(winH);
			}else {
				$('.pageTitle').css('height','76.8rem');
			}
		}).trigger('resize');

		$(window).on('scroll',function(){
			if($(window).scrollTop() > 1){
				$('.pageTitle').addClass('active');
			}else {
				$('.pageTitle').removeClass('active');
			}
		}).trigger('scroll');
	}

	$('.comList .textList .title').on('click', function() {
		$(this).toggleClass('on');
		$(this).next().stop().slideToggle();
		return false;
	});

});

$(window).on('load',function(){
	var localLink = window.location+'';
	if(localLink.indexOf("#") != -1 && localLink.slice(-1) != '#'){
		localLink = localLink.slice(localLink.indexOf("#")+1);
		if($('#'+localLink).length){
			setTimeout(function(){
				$('html,body').animate({scrollTop: $('#'+localLink).offset().top}, 500);
			},100);
		}
	}

	if($('.loading').length){
		setTimeout(function(){
			$('.loading').addClass('hide');
			$('body').removeClass('fixed');
		},100);
		setTimeout(function(){
			fade();
		},1600);
	}

	if($('.comTopLink').length){
		var ww = 0;
		var ind = $('.comTopLink li.on').index();
		var wid = $('.comTopLink li.on').width();
		$('.comTopLink li').each(function(i){
			if(i < ind){
				ww = ww + $(this).outerWidth(true);
			}
			$('.gNavi .globalBar').css('left',ww);
			$('.gNavi .globalBar').css('width',wid);
		})
		$('.comTopLink li').hover(function(){
			ww = 0;
			var ind = $(this).index();
			var wid = $(this).width();
			$('.comTopLink li').each(function(i){
				if(i < ind){
					ww = ww + $(this).outerWidth(true);
				}
				$('.gNavi .globalBar').css('left',ww);
				$('.gNavi .globalBar').css('width',wid);
			})
		},function(){
			ww = 0;
			var ind = $('.comTopLink li.on').index();
			var wid = $('.comTopLink li.on').width();
			$('.comTopLink li').each(function(i){
				if(i < ind){
					ww = ww + $(this).outerWidth(true);
				}
				$('.gNavi .globalBar').css('left',ww);
				$('.gNavi .globalBar').css('width',wid);
			})
		});
	}
});

function fade(){
	$(window).on('scroll',function(){
		$('.fadeTxt,.fadeIn,.fadeInUp,.animation,.fadeAni,.fadeLB,.jsBg').each(function(){
			if($(window).scrollTop() > $(this).offset().top - $(window).height() + 100){
				$(this).addClass('visible');
			}
		})
	}).trigger('scroll');
}