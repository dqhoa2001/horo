document.addEventListener('DOMContentLoaded', function() {
    var swiper;
    function initializeSwiper() {
        swiper = new Swiper(".swiper", {
            slidesPerView: "auto",
            mousewheel: true,
            pagination: {
                el: ".swiper-pagination",
                //clickable: true
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            }
        });
    }
    function destroySwiper() {
        if (swiper) {
            swiper.destroy();
            swiper = undefined;
        }
    }
    // if分を用いて横幅に応じて関数を実行
    function handleResize() {
        var w = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
        if (w > 500) {
            if (!swiper) {
                initializeSwiper();
            }
        } else {
            destroySwiper();
        }
    }
    // 初回実行
    handleResize();
    window.addEventListener('resize', handleResize);
});
/* const swiper = new Swiper(".swiper", {
    slidesPerView: "auto",
    mousewheel: true,
    pagination: {
        el: ".swiper-pagination",
        //clickable: true
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
    }
}); */