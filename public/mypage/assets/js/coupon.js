$(window).on('load resize',function(){

    var wrap_size = $('.Coupon-main__name').width();
    var ob_size = $('.Coupon-main__name__inner').width();
    var line_size = ((wrap_size - ob_size - 20) / 2);
    $('.Coupon-main__name__line').css({"width": line_size + "px"});
});


/*----- コピーアクション */
$('.Coupon-main-code__data').on('click',function(){
    copyToClipboard(".Coupon-main-code__data__number");
    $('.Coupon-copycomplate').addClass('on');
    window.setTimeout(noview, 2000);
});
function copyToClipboard(element) {
    var $temp = $(".Coupon-main-code__textarea");
    $temp.val($(element).text()).select();
    document.execCommand("copy");
}
$(".Coupon-main-code__textarea").on('mousedown', function(e) {
    e.preventDefault();
});
function noview(){
    $('.Coupon-copycomplate').removeClass('on');
}

/*----- ポップアップ */
$('.Coupon-history-button').on('click',function(){
    $('.Coupon-history').stop().fadeIn();
    $('.Pageframe-main__scroll').mCustomScrollbar("disable",true);
});
$('.Coupon-history__scroll').mCustomScrollbar({
    scrollEasing: 'linear',
    callbacks:{
        onScrollStart:function(){
            $('.Coupon-history__scroll').removeClass('end');
        },
        onTotalScroll:function(){
            $('.Coupon-history__scroll').addClass('end');
        },
        whileScrolling:function(){
            $('.Coupon-history__scroll .mCSB_scrollTools').addClass('on');
        },
        onScroll:function(){
            $('.Coupon-history__scroll .mCSB_scrollTools').removeClass('on');
        }
    }
});
$('.Coupon-history .C-popup-close').on('click',function(){
    $('.Pageframe-main__scroll').mCustomScrollbar("update");
});


/*----- タブレット表記 */
$(window).on('load resize',function(){
	if (navigator.userAgent.indexOf('iPhone') > 0 || navigator.userAgent.indexOf('Android') > 0 && navigator.userAgent.indexOf('Mobile') > 0)
	{
	}
	else if(navigator.userAgent.indexOf('iPad') > 0 || navigator.userAgent.indexOf('Android') > 0)
	{
		$('.Coupon-main-code .Button').addClass('no');
		$('.Coupon-main-code-sns').removeClass('no');
	}
	else
	{
		$('.Coupon-main-code .Button').addClass('no');
		$('.Coupon-main-code-sns').removeClass('no');
	}
});


const link_btn = document.getElementById('Coupon-main-code__share');
if(link_btn) {
    console.log(link_btn);
    link_btn.addEventListener('click', async () => {
        try {
            const currentURL = "https://hoshinomai.jp/stellar-blueprint ";
            await navigator.share({ title: document.title, url: currentURL });
        } catch (error) {
            console.log(error);
        }
    });
}


/*----- SNSシェア */
/* facebook */
$('.Coupon-main-code-sns__item--facebook a').on('click',function(e) {
    e.preventDefault();
    // var url = window.location.href;
    window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent('https://hoshinomai.jp/stellar-blueprint'), 'facebook-share-dialog', 'width=800,height=600');
});
/* x（ツイッター） */
$('.Coupon-main-code-sns__item--x a').on('click',function(e) {
    e.preventDefault();
    // var url = window.location.href;
    // var text = "ここにツイートのテキストを入力"; // カスタムテキスト
    // window.open('https://twitter.com/intent/tweet?text=' + encodeURIComponent(text) + '&url=' + encodeURIComponent('https://hoshinomai.jp/stellar-blueprint'), 'twitter-share-dialog', 'width=800,height=600');
    window.open('https://twitter.com/intent/tweet?text=' + '&url=' + encodeURIComponent('https://hoshinomai.jp/stellar-blueprint'), 'twitter-share-dialog', 'width=800,height=600');
});
/* LINE */
$('.Coupon-main-code-sns__item--line a').on('click',function(e) {
    e.preventDefault();
    // var url = window.location.href;
    // var text = "ここにシェアのテキストを入力"; // カスタムテキスト
    // window.open('https://line.me/R/msg/text/?' + encodeURIComponent(text) + '%0D%0A' + encodeURIComponent('https://hoshinomai.jp/stellar-blueprint'));
    window.open('https://line.me/R/msg/text/?' +  encodeURIComponent('https://hoshinomai.jp/stellar-blueprint'));

});
