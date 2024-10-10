<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="format-detection" content="telephone=no">
{{-- <link rel="stylesheet" href="./assets/css/reset.css">
<link rel="stylesheet" href="./assets/css/class.css">
<link rel="stylesheet" href="./assets/css/pdf.css">
<link rel="stylesheet" href="./assets/css/pdf1.css"> --}}

<style>
    /* ------------pdf.css-------------↓ */
    @charset "utf-8";
    @import url('https://fonts.googleapis.com/css2?family=Alex+Brush&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Old+Standard+TT:ital@1&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Beau+Rivage&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Zeyada&display=swap');

    *,
    *::before,
    *::after{
        box-sizing: border-box;
        line-height: 1.771739;
        word-wrap: break-word;
    }
    html{
        font-size: 62.5%;
        width: 100%;
    }
    body{
        width: 100%;
        font-size: .92rem;
        letter-spacing: 0;
        font-weight: 500;
        -webkit-text-size-adjust: 100%;
        color: #3E3A39;
        z-index: 5000;
        position: relative;
        font-family: '游明朝','Yu Mincho',YuMincho,'Hiragino Mincho Pro',serif;
    }



    /*-------------------------------
        共通パーツ
    -------------------------------*/

    /*----- フォント */
    .handfont1{
        font-family: 'Alex Brush', cursive;
    }
    .handfont2{
        font-family: 'Zeyada', cursive;
    }

    /*----- 横幅設定 */
    .basewidth{
        width: 60rem;
        margin-left: auto;
        margin-right: auto;
    }

    /*----- ページブロック */
    .page{
        min-height: 84rem;
        padding: 1rem;
        position: relative;
    }

    /* ページナンバー */
    .page--number::after{
        font-size: 1.06rem;
        line-height: 1;
        bottom: 3rem;
        position: absolute;
        display: block;
        content: attr(data-pageno);
    }
    .page--number_left::after{
        left: 3rem;
    }
    .page--number_right::after{
        right: 3rem;
    }

    /* 背景写真ブロック */
    .page--bg{
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
    }

    /* カバー */
    .page--cover{
        padding-top: 0;
        padding-bottom: 36.5rem;
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
        position: relative;
    }
    .page--cover::before{
        font-size: 7.1rem;
        line-height: 1;
        text-shadow: 0 0 .05rem rgba(216,216,216,.75);
        height: calc(38.5rem - 23rem);
        position: absolute;
        left: 0;
        bottom: 0;
        right: 0;
        text-align: center;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        content: attr(data-title);
        font-family: 'Beau Rivage', cursive;
    }
    .page--cover .page__inner{
        width: calc(100% - 12rem);
        min-height: calc(84rem - 38.5rem);
        padding: 4.5rem 6.5rem 5rem;
        background: #fff;
        margin-left: auto;
        margin-right: auto;
        z-index: 6000;
        position: relative;
        text-align: center;
    }
    .page--cover .page__inner::after{
        width: 100%;
        height: 46rem;
        border-radius: 50%;
        left: 0;
        right: 0;
        bottom: calc(-23rem + 1px);
        z-index: -1;
        position: absolute;
        background: #fff;
        display: block;
        content: "";
    }
    .page--cover .page__inner > *:not(.page--cover__frame):not(.page--cover__image){
        z-index: 5000;
        position: relative;
    }
    .page--cover__title{
        font-size: 2.5rem;
        margin-bottom: 2.2rem;
        letter-spacing: .1em;
        text-align: center;
        display: inline-block;
    }
    .page--cover__title::before,
    .page--cover__title::after{
        width: 10rem;
        height: .7rem;
        top: calc(50% - .35rem);
        position: absolute;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center center;
        display: block;
        content: "";
    }
    .page--cover__title::before{
        left: calc(-10rem - .6rem);
    }
    .page--cover__title::after{
        right: calc(-10rem - .6rem);
    }
    .page--cover__title span{
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .page--cover__title span::before{
        width: 2.4rem;
        height: 2.4rem;
        margin-right: .5rem;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        display: block;
        content: "";
    }
    .page--cover-block1__title{
        font-size: 1.28rem;
        margin-bottom: 2rem;
        letter-spacing: .05em;
        text-align: center;
    }
    .page--cover__image{
        width: 100%;
        left: 0;
        bottom: calc(-23rem + 3.5rem);
        right: 0;
        position: absolute;
        text-align: center;
    }
    .page--cover__image img{
        max-width: 100%;
    }
    .page--cover__frame{
        width: calc(100% - 1.4rem);
        height: 100%;
        left: 0;
        top: 0;
        right: 0;
        border-left: 1px solid;
        border-right: 1px solid;
        position: absolute;
        margin-left: auto;
        margin-right: auto;
    }
    .page--cover__frame::after{
        width: calc(100% + 2px);
        height: 22.3rem;
        border-radius: 0 0 22.3rem 22.3rem;
        border: 1px solid;
        border-top: none;
        left: 0;
        bottom: -22.3rem;
        right: 0;
        transform: translate(-1px,0);
        position: absolute;
        display: block;
        content: "";
    }
    .page--cover-head .page__inner::before,
    .page--cover-foot .page__inner::before{
        width: 25rem;
        left: 0;
        right: 0;
        position: absolute;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center center;
        margin-left: auto;
        margin-right: auto;
        display: block;
        content: "";
    }
    .page--cover-head .page__inner::before{
        height: 3.5rem;
        background-image: url(../images/line_cover-head.svg);
    }
    .page--cover-foot .page__inner::before{
        height: 23rem;
        bottom: -23rem;
        background-image: url(../images/line_cover-foot.svg);
    }

    /* コンテンツ */
    .page--content .page__inner{
        padding: 5rem;
        min-height: calc(84rem - 2rem);
        background: #fff;
    }
    .page-block:not(:last-child){
        margin-bottom: 2.5rem;
    }
    .page-block__title{
        font-size: 1.28rem;
        margin-bottom: 1.7rem;
        letter-spacing: .05em;
        text-align: center;
    }
    .page__text span{
        text-indent: 1em;
        letter-spacing: 0;
        display: block;
        text-align: justify;
    }

    /* コンテンツ1 */
    .page-block--1__title{
        font-size: 1.28rem;
        margin-bottom: 2rem;
        text-align: center;
    }
    .page-block--1__title{
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .page-block--1__title span:nth-of-type(1){
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .page-block--1__title span:nth-of-type(1)::after{
        width: 1.8rem;
        height: 1.8rem;
        margin-left: .8rem;
        margin-right: .8rem;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center center;
        display: block;
        content: "";
    }
    .page-block--1__title span:nth-of-type(2){
        font-size: 2rem;
    }

    /* コンテンツ2 */
    .page-block--2__title{
        font-size: 1.28rem;
        margin-bottom: 1.5rem;
        text-align: center;
    }
    .page-block--2__title span{
        font-size: .92rem;
        margin-left: 1em;
        vertical-align: text-bottom;
    }
    .page-block--2 .page__text{
        padding: 1rem;
        font-size: .85rem;
    }
    .page-block--2 .page__text span{
        line-height: 1.647058;
    }

    /* コンテンツ3 */
    .page-block--3__title{
        width: 100%;
        font-size: 1.2rem;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .page-block--3__title::before{
        width: 2.2rem;
        height: 2.3rem;
        margin-right: .6rem;
        transform: translate(0, -.2rem);
        display: block;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center center;
        content: "";
    }

    /* コンテンツ4 */
    .page-block--4__title{
        font-size: 1.28rem;
        margin-bottom: 2.2rem;
        text-align: center;
    }
    .page-block--4__title span{
        font-size: 1.78rem;
        margin-left: .5em;
        line-height: 1;
        vertical-align: middle;
    }

    /* コンテンツ5 */
    .page-block--5{
        width: 100%;
        display: flex;
        align-items: inherit;
        justify-content: space-between;
    }
    .page-block--5__half{
        width: calc((100% - 1rem) / 2);
        padding: 1.2rem 1.6rem;
        border: 1px solid;
    }
    .page-block--5__title{
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        position: relative;
    }
    .page-block--5__title::before,
    .page-block--5__title::after{
        width: 1.2rem;
        height: 1.2rem;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center center;
        display: block;
        content: "";
    }
    .page-block--5__title span{
        width: .7rem;
        height: .7rem;
        margin-left: .6rem;
        margin-right: .6rem;
        border: 1px solid #C9CACA;
        display: block;
    }
    .page-block--5__title span::after{
        width: 7.2rem;
        height: .3rem;
        bottom: 0;
        left: 0;
        right: 0;
        margin-left: auto;
        margin-right: auto;
        position: absolute;
        background-image: url(../images/icon_block5-title_line.svg);
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center center;
        display: block;
        content: "";
    }
    .page-block--2 + .page-block--5{
        margin-top: -1.2rem;
    }


    /*-------------------------------
        月
    -------------------------------*/

    .page--moon{
        background: #D8E2E7;
    }
    .page--moon .page--cover__title::before{
        background-image: url(../images/line_cover-title-moon_left.svg);
    }
    .page--moon .page--cover__title::after{
        background-image: url(../images/line_cover-title-moon_right.svg);
    }
    .page--moon .page--cover__frame{
        border-left-color: #D8E2E7;
        border-right-color: #D8E2E7;
    }
    .page--moon .page--cover__frame::after{
        border-color: #D8E2E7;
    }

    .page--moon .page-block--1__title .icon-sign--kani:nth-of-type(1)::after,
    .page--moon .page-block--5__title.icon-sign--kani::after{
        background-image: url(../images/moon/icon_kani.svg);
    }
    .page--moon .page-block--1__title .icon-sign--hutago:nth-of-type(1)::after,
    .page--moon .page-block--5__title.icon-sign--hutago::after{
        background-image: url(../images/moon/icon_hutago.svg);
    }
    .page--moon .page-block--1__title .icon-sign--ite:nth-of-type(1)::after,
    .page--moon .page-block--5__title.icon-sign--ite::after{
        background-image: url(../images/moon/icon_ite.svg);
    }
    .page--moon .page-block--1__title .icon-sign--mizugame:nth-of-type(1)::after,
    .page--moon .page-block--5__title.icon-sign--mizugame::after{
        background-image: url(../images/moon/icon_mizugame.svg);
    }
    .page--moon .page-block--1__title .icon-sign--ohitsuji:nth-of-type(1)::after,
    .page--moon .page-block--5__title.icon-sign--ohitsuji::after{
        background-image: url(../images/moon/icon_ohitsuji.svg);
    }
    .page--moon .page-block--1__title .icon-sign--otome:nth-of-type(1)::after,
    .page--moon .page-block--5__title.icon-sign--otome::after{
        background-image: url(../images/moon/icon_otome.svg);
    }
    .page--moon .page-block--1__title .icon-sign--oushi:nth-of-type(1)::after,
    .page--moon .page-block--5__title.icon-sign--oushi::after{
        background-image: url(../images/moon/icon_oushi.svg);
    }
    .page--moon .page-block--1__title .icon-sign--sasori:nth-of-type(1)::after,
    .page--moon .page-block--5__title.icon-sign--sasori::after{
        background-image: url(../images/moon/icon_sasori.svg);
    }
    .page--moon .page-block--1__title .icon-sign--shishi:nth-of-type(1)::after,
    .page--moon .page-block--5__title.icon-sign--shishi::after{
        background-image: url(../images/moon/icon_shishi.svg);
    }
    .page--moon .page-block--1__title .icon-sign--tenbin:nth-of-type(1)::after,
    .page--moon .page-block--5__title.icon-sign--tenbin::after{
        background-image: url(../images/moon/icon_tenbin.svg);
    }
    .page--moon .page-block--1__title .icon-sign--uo:nth-of-type(1)::after,
    .page--moon .page-block--5__title.icon-sign--uo::after{
        background-image: url(../images/moon/icon_uo.svg);
    }
    .page--moon .page-block--1__title .icon-sign--yagi:nth-of-type(1)::after,
    .page--moon .page-block--5__title.icon-sign--yagi::after{
        background-image: url(../images/moon/icon_yagi.svg);
    }

    .page--moon .page-block--2 .page__text{
        background: rgba(216,226,231,.3);
    }
    .page--moon .page-block--5__half{
        border-color: #D8E2E7;
    }
    .page--moon .page--cover__title,
    .page--moon .page--cover-block1__title,
    .page--moon .page-block--1__title,
    .page--moon .page-block--2__title,
    .page--moon .page-block--3__title,
    .page--moon .page-block--4__title,
    .page--moon .page-block--5__title{
        color: #748F9F;
    }
    .page--moon .page-block--3__title::before{
        background-image: url(../images/icon_moon3.svg);
    }
    .page--moon .page--cover__title span::before,
    .page--moon .page-block--5__title::before{
        background-image: url(../images/icon_moon.svg);
    }



    /*-------------------------------
        水星
    -------------------------------*/

    .page--mercury{
        background: #CDE7E6;
    }
    .page--mercury .page--cover__title::before{
        background-image: url(../images/line_cover-title-mercury_left.svg);
    }
    .page--mercury .page--cover__title::after{
        background-image: url(../images/line_cover-title-mercury_right.svg);
    }
    .page--mercury .page--cover__frame{
        border-left-color: #CDE7E6;
        border-right-color: #CDE7E6;
    }
    .page--mercury .page--cover__frame::after{
        border-color: #CDE7E6;
    }

    .page--mercury .page-block--1__title .icon-sign--kani:nth-of-type(1)::after,
    .page--mercury .page-block--5__title.icon-sign--kani::after{
        background-image: url(../images/mercury/icon_kani.svg);
    }
    .page--mercury .page-block--1__title .icon-sign--hutago:nth-of-type(1)::after,
    .page--mercury .page-block--5__title.icon-sign--hutago::after{
        background-image: url(../images/mercury/icon_hutago.svg);
    }
    .page--mercury .page-block--1__title .icon-sign--ite:nth-of-type(1)::after,
    .page--mercury .page-block--5__title.icon-sign--ite::after{
        background-image: url(../images/mercury/icon_ite.svg);
    }
    .page--mercury .page-block--1__title .icon-sign--mizugame:nth-of-type(1)::after,
    .page--mercury .page-block--5__title.icon-sign--mizugame::after{
        background-image: url(../images/mercury/icon_mizugame.svg);
    }
    .page--mercury .page-block--1__title .icon-sign--ohitsuji:nth-of-type(1)::after,
    .page--mercury .page-block--5__title.icon-sign--ohitsuji::after{
        background-image: url(../images/mercury/icon_ohitsuji.svg);
    }
    .page--mercury .page-block--1__title .icon-sign--otome:nth-of-type(1)::after,
    .page--mercury .page-block--5__title.icon-sign--otome::after{
        background-image: url(../images/mercury/icon_otome.svg);
    }
    .page--mercury .page-block--1__title .icon-sign--oushi:nth-of-type(1)::after,
    .page--mercury .page-block--5__title.icon-sign--oushi::after{
        background-image: url(../images/mercury/icon_oushi.svg);
    }
    .page--mercury .page-block--1__title .icon-sign--sasori:nth-of-type(1)::after,
    .page--mercury .page-block--5__title.icon-sign--sasori::after{
        background-image: url(../images/mercury/icon_sasori.svg);
    }
    .page--mercury .page-block--1__title .icon-sign--shishi:nth-of-type(1)::after,
    .page--mercury .page-block--5__title.icon-sign--shishi::after{
        background-image: url(../images/mercury/icon_shishi.svg);
    }
    .page--mercury .page-block--1__title .icon-sign--tenbin:nth-of-type(1)::after,
    .page--mercury .page-block--5__title.icon-sign--tenbin::after{
        background-image: url(../images/mercury/icon_tenbin.svg);
    }
    .page--mercury .page-block--1__title .icon-sign--uo:nth-of-type(1)::after,
    .page--mercury .page-block--5__title.icon-sign--uo::after{
        background-image: url(../images/mercury/icon_uo.svg);
    }
    .page--mercury .page-block--1__title .icon-sign--yagi:nth-of-type(1)::after,
    .page--mercury .page-block--5__title.icon-sign--yagi::after{
        background-image: url(../images/mercury/icon_yagi.svg);
    }

    .page--mercury .page-block--2 .page__text{
        background: rgba(205,231,230,.3);
    }
    .page--mercury .page-block--5__half{
        border-color: #CDE7E6;
    }
    .page--mercury .page--cover__title,
    .page--mercury .page--cover-block1__title,
    .page--mercury .page-block--1__title,
    .page--mercury .page-block--2__title,
    .page--mercury .page-block--3__title,
    .page--mercury .page-block--4__title,
    .page--mercury .page-block--5__title{
        color: #719AA7;
    }
    .page--mercury .page-block--3__title::before{
        background-image: url(../images/icon_mercury3.svg);
    }
    .page--mercury .page--cover__title span::before,
    .page--mercury .page-block--5__title::before{
        background-image: url(../images/icon_mercury.svg);
    }



    /*-------------------------------
        金星
    -------------------------------*/

    .page--venus{
        background: #EEDEE2;
    }
    .page--venus .page--cover__title::before{
        background-image: url(../images/line_cover-title-venus_left.svg);
    }
    .page--venus .page--cover__title::after{
        background-image: url(../images/line_cover-title-venus_right.svg);
    }
    .page--venus .page--cover__frame{
        border-left-color: #EEDEE2;
        border-right-color: #EEDEE2;
    }
    .page--venus .page--cover__frame::after{
        border-color: #EEDEE2;
    }

    .page--venus .page-block--1__title .icon-sign--kani:nth-of-type(1)::after,
    .page--venus .page-block--5__title.icon-sign--kani::after{
        background-image: url(../images/venus/icon_kani.svg);
    }
    .page--venus .page-block--1__title .icon-sign--hutago:nth-of-type(1)::after,
    .page--venus .page-block--5__title.icon-sign--hutago::after{
        background-image: url(../images/venus/icon_hutago.svg);
    }
    .page--venus .page-block--1__title .icon-sign--ite:nth-of-type(1)::after,
    .page--venus .page-block--5__title.icon-sign--ite::after{
        background-image: url(../images/venus/icon_ite.svg);
    }
    .page--venus .page-block--1__title .icon-sign--mizugame:nth-of-type(1)::after,
    .page--venus .page-block--5__title.icon-sign--mizugame::after{
        background-image: url(../images/venus/icon_mizugame.svg);
    }
    .page--venus .page-block--1__title .icon-sign--ohitsuji:nth-of-type(1)::after,
    .page--venus .page-block--5__title.icon-sign--ohitsuji::after{
        background-image: url(../images/venus/icon_ohitsuji.svg);
    }
    .page--venus .page-block--1__title .icon-sign--otome:nth-of-type(1)::after,
    .page--venus .page-block--5__title.icon-sign--otome::after{
        background-image: url(../images/venus/icon_otome.svg);
    }
    .page--venus .page-block--1__title .icon-sign--oushi:nth-of-type(1)::after,
    .page--venus .page-block--5__title.icon-sign--oushi::after{
        background-image: url(../images/venus/icon_oushi.svg);
    }
    .page--venus .page-block--1__title .icon-sign--sasori:nth-of-type(1)::after,
    .page--venus .page-block--5__title.icon-sign--sasori::after{
        background-image: url(../images/venus/icon_sasori.svg);
    }
    .page--venus .page-block--1__title .icon-sign--shishi:nth-of-type(1)::after,
    .page--venus .page-block--5__title.icon-sign--shishi::after{
        background-image: url(../images/venus/icon_shishi.svg);
    }
    .page--venus .page-block--1__title .icon-sign--tenbin:nth-of-type(1)::after,
    .page--venus .page-block--5__title.icon-sign--tenbin::after{
        background-image: url(../images/venus/icon_tenbin.svg);
    }
    .page--venus .page-block--1__title .icon-sign--uo:nth-of-type(1)::after,
    .page--venus .page-block--5__title.icon-sign--uo::after{
        background-image: url(../images/venus/icon_uo.svg);
    }
    .page--venus .page-block--1__title .icon-sign--yagi:nth-of-type(1)::after,
    .page--venus .page-block--5__title.icon-sign--yagi::after{
        background-image: url(../images/venus/icon_yagi.svg);
    }

    .page--venus .page-block--2 .page__text{
        background: rgba(238,222,226,.3);
    }
    .page--venus .page-block--5__half{
        border-color: #EEDEE2;
    }
    .page--venus .page--cover__title,
    .page--venus .page--cover-block1__title,
    .page--venus .page-block--1__title,
    .page--venus .page-block--2__title,
    .page--venus .page-block--3__title,
    .page--venus .page-block--4__title,
    .page--venus .page-block--5__title{
        color: #C08E9E;
    }
    .page--venus .page-block--3__title::before{
        background-image: url(../images/icon_venus3.svg);
    }
    .page--venus .page--cover__title span::before,
    .page--venus .page-block--5__title::before{
        background-image: url(../images/icon_venus.svg);
    }



    /*-------------------------------
        太陽
    -------------------------------*/

    .page--sun{
        background: #F3F0B7;
    }
    .page--sun .page--cover__title::before{
        background-image: url(../images/line_cover-title-sun_left.svg);
    }
    .page--sun .page--cover__title::after{
        background-image: url(../images/line_cover-title-sun_right.svg);
    }
    .page--sun .page--cover__frame{
        border-left-color: #F3F0B7;
        border-right-color: #F3F0B7;
    }
    .page--sun .page--cover__frame::after{
        border-color: #F3F0B7;
    }

    .page--sun .page-block--1__title .icon-sign--kani:nth-of-type(1)::after,
    .page--sun .page-block--5__title.icon-sign--kani::after{
        background-image: url(../images/sun/icon_kani.svg);
    }
    .page--sun .page-block--1__title .icon-sign--hutago:nth-of-type(1)::after,
    .page--sun .page-block--5__title.icon-sign--hutago::after{
        background-image: url(../images/sun/icon_hutago.svg);
    }
    .page--sun .page-block--1__title .icon-sign--ite:nth-of-type(1)::after,
    .page--sun .page-block--5__title.icon-sign--ite::after{
        background-image: url(../images/sun/icon_ite.svg);
    }
    .page--sun .page-block--1__title .icon-sign--mizugame:nth-of-type(1)::after,
    .page--sun .page-block--5__title.icon-sign--mizugame::after{
        background-image: url(../images/sun/icon_mizugame.svg);
    }
    .page--sun .page-block--1__title .icon-sign--ohitsuji:nth-of-type(1)::after,
    .page--sun .page-block--5__title.icon-sign--ohitsuji::after{
        background-image: url(../images/sun/icon_ohitsuji.svg);
    }
    .page--sun .page-block--1__title .icon-sign--otome:nth-of-type(1)::after,
    .page--sun .page-block--5__title.icon-sign--otome::after{
        background-image: url(../images/sun/icon_otome.svg);
    }
    .page--sun .page-block--1__title .icon-sign--oushi:nth-of-type(1)::after,
    .page--sun .page-block--5__title.icon-sign--oushi::after{
        background-image: url(../images/sun/icon_oushi.svg);
    }
    .page--sun .page-block--1__title .icon-sign--sasori:nth-of-type(1)::after,
    .page--sun .page-block--5__title.icon-sign--sasori::after{
        background-image: url(../images/sun/icon_sasori.svg);
    }
    .page--sun .page-block--1__title .icon-sign--shishi:nth-of-type(1)::after,
    .page--sun .page-block--5__title.icon-sign--shishi::after{
        background-image: url(../images/sun/icon_shishi.svg);
    }
    .page--sun .page-block--1__title .icon-sign--tenbin:nth-of-type(1)::after,
    .page--sun .page-block--5__title.icon-sign--tenbin::after{
        background-image: url(../images/sun/icon_tenbin.svg);
    }
    .page--sun .page-block--1__title .icon-sign--uo:nth-of-type(1)::after,
    .page--sun .page-block--5__title.icon-sign--uo::after{
        background-image: url(../images/sun/icon_uo.svg);
    }
    .page--sun .page-block--1__title .icon-sign--yagi:nth-of-type(1)::after,
    .page--sun .page-block--5__title.icon-sign--yagi::after{
        background-image: url(../images/sun/icon_yagi.svg);
    }

    .page--sun .page-block--2 .page__text{
        background: rgba(243,240,183,.3);
    }
    .page--sun .page-block--5__half{
        border-color: #F3F0B7;
    }
    .page--sun .page--cover__title,
    .page--sun .page--cover-block1__title,
    .page--sun .page-block--1__title,
    .page--sun .page-block--2__title,
    .page--sun .page-block--3__title,
    .page--sun .page-block--4__title,
    .page--sun .page-block--5__title{
        color: #BFB685;
    }
    .page--sun .page-block--3__title::before{
        background-image: url(../images/icon_sun3.svg);
    }
    .page--sun .page--cover__title span::before,
    .page--sun .page-block--5__title::before{
        background-image: url(../images/icon_sun.svg);
    }



    /*-------------------------------
        火星
    -------------------------------*/

    .page--mars{
        background: #EBBAB2;
    }
    .page--mars .page--cover__title::before{
        background-image: url(../images/line_cover-title-mars_left.svg);
    }
    .page--mars .page--cover__title::after{
        background-image: url(../images/line_cover-title-mars_right.svg);
    }
    .page--mars .page--cover__frame{
        border-left-color: #EBBAB2;
        border-right-color: #EBBAB2;
    }
    .page--mars .page--cover__frame::after{
        border-color: #EBBAB2;
    }

    .page--mars .page-block--1__title .icon-sign--kani:nth-of-type(1)::after,
    .page--mars .page-block--5__title.icon-sign--kani::after{
        background-image: url(../images/mars/icon_kani.svg);
    }
    .page--mars .page-block--1__title .icon-sign--hutago:nth-of-type(1)::after,
    .page--mars .page-block--5__title.icon-sign--hutago::after{
        background-image: url(../images/mars/icon_hutago.svg);
    }
    .page--mars .page-block--1__title .icon-sign--ite:nth-of-type(1)::after,
    .page--mars .page-block--5__title.icon-sign--ite::after{
        background-image: url(../images/mars/icon_ite.svg);
    }
    .page--mars .page-block--1__title .icon-sign--mizugame:nth-of-type(1)::after,
    .page--mars .page-block--5__title.icon-sign--mizugame::after{
        background-image: url(../images/mars/icon_mizugame.svg);
    }
    .page--mars .page-block--1__title .icon-sign--ohitsuji:nth-of-type(1)::after,
    .page--mars .page-block--5__title.icon-sign--ohitsuji::after{
        background-image: url(../images/mars/icon_ohitsuji.svg);
    }
    .page--mars .page-block--1__title .icon-sign--otome:nth-of-type(1)::after,
    .page--mars .page-block--5__title.icon-sign--otome::after{
        background-image: url(../images/mars/icon_otome.svg);
    }
    .page--mars .page-block--1__title .icon-sign--oushi:nth-of-type(1)::after,
    .page--mars .page-block--5__title.icon-sign--oushi::after{
        background-image: url(../images/mars/icon_oushi.svg);
    }
    .page--mars .page-block--1__title .icon-sign--sasori:nth-of-type(1)::after,
    .page--mars .page-block--5__title.icon-sign--sasori::after{
        background-image: url(../images/mars/icon_sasori.svg);
    }
    .page--mars .page-block--1__title .icon-sign--shishi:nth-of-type(1)::after,
    .page--mars .page-block--5__title.icon-sign--shishi::after{
        background-image: url(../images/mars/icon_shishi.svg);
    }
    .page--mars .page-block--1__title .icon-sign--tenbin:nth-of-type(1)::after,
    .page--mars .page-block--5__title.icon-sign--tenbin::after{
        background-image: url(../images/mars/icon_tenbin.svg);
    }
    .page--mars .page-block--1__title .icon-sign--uo:nth-of-type(1)::after,
    .page--mars .page-block--5__title.icon-sign--uo::after{
        background-image: url(../images/mars/icon_uo.svg);
    }
    .page--mars .page-block--1__title .icon-sign--yagi:nth-of-type(1)::after,
    .page--mars .page-block--5__title.icon-sign--yagi::after{
        background-image: url(../images/mars/icon_yagi.svg);
    }

    .page--mars .page-block--2 .page__text{
        background: rgba(235,186,178,.3);
    }
    .page--mars .page-block--5__half{
        border-color: #EBBAB2;
    }
    .page--mars .page--cover__title,
    .page--mars .page--cover-block1__title,
    .page--mars .page-block--1__title,
    .page--mars .page-block--2__title,
    .page--mars .page-block--3__title,
    .page--mars .page-block--4__title,
    .page--mars .page-block--5__title{
        color: #B56E6C;
    }
    .page--mars .page-block--3__title::before{
        background-image: url(../images/icon_mars3.svg);
    }
    .page--mars .page--cover__title span::before,
    .page--mars .page-block--5__title::before{
        background-image: url(../images/icon_mars.svg);
    }



    /*-------------------------------
        木星
    -------------------------------*/

    .page--jupiter{
        background: #CADFCD;
    }
    .page--jupiter .page--cover__title::before{
        background-image: url(../images/line_cover-title-jupiter_left.svg);
    }
    .page--jupiter .page--cover__title::after{
        background-image: url(../images/line_cover-title-jupiter_right.svg);
    }
    .page--jupiter .page--cover__frame{
        border-left-color: #CADFCD;
        border-right-color: #CADFCD;
    }
    .page--jupiter .page--cover__frame::after{
        border-color: #CADFCD;
    }

    .page--jupiter .page-block--1__title .icon-sign--kani:nth-of-type(1)::after,
    .page--jupiter .page-block--5__title.icon-sign--kani::after{
        background-image: url(../images/jupiter/icon_kani.svg);
    }
    .page--jupiter .page-block--1__title .icon-sign--hutago:nth-of-type(1)::after,
    .page--jupiter .page-block--5__title.icon-sign--hutago::after{
        background-image: url(../images/jupiter/icon_hutago.svg);
    }
    .page--jupiter .page-block--1__title .icon-sign--ite:nth-of-type(1)::after,
    .page--jupiter .page-block--5__title.icon-sign--ite::after{
        background-image: url(../images/jupiter/icon_ite.svg);
    }
    .page--jupiter .page-block--1__title .icon-sign--mizugame:nth-of-type(1)::after,
    .page--jupiter .page-block--5__title.icon-sign--mizugame::after{
        background-image: url(../images/jupiter/icon_mizugame.svg);
    }
    .page--jupiter .page-block--1__title .icon-sign--ohitsuji:nth-of-type(1)::after,
    .page--jupiter .page-block--5__title.icon-sign--ohitsuji::after{
        background-image: url(../images/jupiter/icon_ohitsuji.svg);
    }
    .page--jupiter .page-block--1__title .icon-sign--otome:nth-of-type(1)::after,
    .page--jupiter .page-block--5__title.icon-sign--otome::after{
        background-image: url(../images/jupiter/icon_otome.svg);
    }
    .page--jupiter .page-block--1__title .icon-sign--oushi:nth-of-type(1)::after,
    .page--jupiter .page-block--5__title.icon-sign--oushi::after{
        background-image: url(../images/jupiter/icon_oushi.svg);
    }
    .page--jupiter .page-block--1__title .icon-sign--sasori:nth-of-type(1)::after,
    .page--jupiter .page-block--5__title.icon-sign--sasori::after{
        background-image: url(../images/jupiter/icon_sasori.svg);
    }
    .page--jupiter .page-block--1__title .icon-sign--shishi:nth-of-type(1)::after,
    .page--jupiter .page-block--5__title.icon-sign--shishi::after{
        background-image: url(../images/jupiter/icon_shishi.svg);
    }
    .page--jupiter .page-block--1__title .icon-sign--tenbin:nth-of-type(1)::after,
    .page--jupiter .page-block--5__title.icon-sign--tenbin::after{
        background-image: url(../images/jupiter/icon_tenbin.svg);
    }
    .page--jupiter .page-block--1__title .icon-sign--uo:nth-of-type(1)::after,
    .page--jupiter .page-block--5__title.icon-sign--uo::after{
        background-image: url(../images/jupiter/icon_uo.svg);
    }
    .page--jupiter .page-block--1__title .icon-sign--yagi:nth-of-type(1)::after,
    .page--jupiter .page-block--5__title.icon-sign--yagi::after{
        background-image: url(../images/jupiter/icon_yagi.svg);
    }

    .page--jupiter .page-block--2 .page__text{
        background: rgba(202,223,205,.3);
    }
    .page--jupiter .page-block--5__half{
        border-color: #CADFCD;
    }
    .page--jupiter .page--cover__title,
    .page--jupiter .page--cover-block1__title,
    .page--jupiter .page-block--1__title,
    .page--jupiter .page-block--2__title,
    .page--jupiter .page-block--3__title,
    .page--jupiter .page-block--4__title,
    .page--jupiter .page-block--5__title{
        color: #739082;
    }
    .page--jupiter .page-block--3__title::before{
        background-image: url(../images/icon_jupiter3.svg);
    }
    .page--jupiter .page--cover__title span::before,
    .page--jupiter .page-block--5__title::before{
        background-image: url(../images/icon_jupiter.svg);
    }



    /*-------------------------------
        土星
    -------------------------------*/

    .page--saturn{
        background: #E1DCCF;
    }
    .page--saturn .page--cover__title::before{
        background-image: url(../images/line_cover-title-saturn_left.svg);
    }
    .page--saturn .page--cover__title::after{
        background-image: url(../images/line_cover-title-saturn_right.svg);
    }
    .page--saturn .page--cover__frame{
        border-left-color: #E1DCCF;
        border-right-color: #E1DCCF;
    }
    .page--saturn .page--cover__frame::after{
        border-color: #E1DCCF;
    }

    .page--saturn .page-block--1__title .icon-sign--kani:nth-of-type(1)::after,
    .page--saturn .page-block--5__title.icon-sign--kani::after{
        background-image: url(../images/saturn/icon_kani.svg);
    }
    .page--saturn .page-block--1__title .icon-sign--hutago:nth-of-type(1)::after,
    .page--saturn .page-block--5__title.icon-sign--hutago::after{
        background-image: url(../images/saturn/icon_hutago.svg);
    }
    .page--saturn .page-block--1__title .icon-sign--ite:nth-of-type(1)::after,
    .page--saturn .page-block--5__title.icon-sign--ite::after{
        background-image: url(../images/saturn/icon_ite.svg);
    }
    .page--saturn .page-block--1__title .icon-sign--mizugame:nth-of-type(1)::after,
    .page--saturn .page-block--5__title.icon-sign--mizugame::after{
        background-image: url(../images/saturn/icon_mizugame.svg);
    }
    .page--saturn .page-block--1__title .icon-sign--ohitsuji:nth-of-type(1)::after,
    .page--saturn .page-block--5__title.icon-sign--ohitsuji::after{
        background-image: url(../images/saturn/icon_ohitsuji.svg);
    }
    .page--saturn .page-block--1__title .icon-sign--otome:nth-of-type(1)::after,
    .page--saturn .page-block--5__title.icon-sign--otome::after{
        background-image: url(../images/saturn/icon_otome.svg);
    }
    .page--saturn .page-block--1__title .icon-sign--oushi:nth-of-type(1)::after,
    .page--saturn .page-block--5__title.icon-sign--oushi::after{
        background-image: url(../images/saturn/icon_oushi.svg);
    }
    .page--saturn .page-block--1__title .icon-sign--sasori:nth-of-type(1)::after,
    .page--saturn .page-block--5__title.icon-sign--sasori::after{
        background-image: url(../images/saturn/icon_sasori.svg);
    }
    .page--saturn .page-block--1__title .icon-sign--shishi:nth-of-type(1)::after,
    .page--saturn .page-block--5__title.icon-sign--shishi::after{
        background-image: url(../images/saturn/icon_shishi.svg);
    }
    .page--saturn .page-block--1__title .icon-sign--tenbin:nth-of-type(1)::after,
    .page--saturn .page-block--5__title.icon-sign--tenbin::after{
        background-image: url(../images/saturn/icon_tenbin.svg);
    }
    .page--saturn .page-block--1__title .icon-sign--uo:nth-of-type(1)::after,
    .page--saturn .page-block--5__title.icon-sign--uo::after{
        background-image: url(../images/saturn/icon_uo.svg);
    }
    .page--saturn .page-block--1__title .icon-sign--yagi:nth-of-type(1)::after,
    .page--saturn .page-block--5__title.icon-sign--yagi::after{
        background-image: url(../images/saturn/icon_yagi.svg);
    }

    .page--saturn .page-block--2 .page__text{
        background: rgba(225,220,207,.3);
    }
    .page--saturn .page-block--5__half{
        border-color: #E1DCCF;
    }
    .page--saturn .page--cover__title,
    .page--saturn .page--cover-block1__title,
    .page--saturn .page-block--1__title,
    .page--saturn .page-block--2__title,
    .page--saturn .page-block--3__title,
    .page--saturn .page-block--4__title,
    .page--saturn .page-block--5__title{
        color: #A29381;
    }
    .page--saturn .page-block--3__title::before{
        background-image: url(../images/icon_saturn3.svg);
    }
    .page--saturn .page--cover__title span::before,
    .page--saturn .page-block--5__title::before{
        background-image: url(../images/icon_saturn.svg);
    }



    /*-------------------------------
        ドラゴンヘッド
    -------------------------------*/

    .page--dragonhead{
        background: #DDD6E4;
    }
    .page--dragonhead .page--cover__title::before,
    .page--dragonhead .page--cover__title::after{
        width: 5.6rem;
    }
    .page--dragonhead .page--cover__title::before{
        left: calc(-5.6rem - .6rem);
        background-image: url(../images/line_cover-title-dragonhead_left.svg);
    }
    .page--dragonhead .page--cover__title::after{
        right: calc(-5.6rem - .6rem);
        background-image: url(../images/line_cover-title-dragonhead_right.svg);
    }
    .page--dragonhead .page--cover__frame{
        border-left-color: #DDD6E4;
        border-right-color: #DDD6E4;
    }
    .page--dragonhead .page--cover__frame::after{
        border-color: #DDD6E4;
    }

    .page--dragonhead .page-block--1__title .icon-sign--kani:nth-of-type(1)::after{
        background-image: url(../images/dragonhead/icon_kani.svg);
    }
    .page--dragonhead .page-block--1__title .icon-sign--hutago:nth-of-type(1)::after{
        background-image: url(../images/dragonhead/icon_hutago.svg);
    }
    .page--dragonhead .page-block--1__title .icon-sign--ite:nth-of-type(1)::after{
        background-image: url(../images/dragonhead/icon_ite.svg);
    }
    .page--dragonhead .page-block--1__title .icon-sign--mizugame:nth-of-type(1)::after{
        background-image: url(../images/dragonhead/icon_mizugame.svg);
    }
    .page--dragonhead .page-block--1__title .icon-sign--ohitsuji:nth-of-type(1)::after{
        background-image: url(../images/dragonhead/icon_ohitsuji.svg);
    }
    .page--dragonhead .page-block--1__title .icon-sign--otome:nth-of-type(1)::after{
        background-image: url(../images/dragonhead/icon_otome.svg);
    }
    .page--dragonhead .page-block--1__title .icon-sign--oushi:nth-of-type(1)::after{
        background-image: url(../images/dragonhead/icon_oushi.svg);
    }
    .page--dragonhead .page-block--1__title .icon-sign--sasori:nth-of-type(1)::after{
        background-image: url(../images/dragonhead/icon_sasori.svg);
    }
    .page--dragonhead .page-block--1__title .icon-sign--shishi:nth-of-type(1)::after{
        background-image: url(../images/dragonhead/icon_shishi.svg);
    }
    .page--dragonhead .page-block--1__title .icon-sign--tenbin:nth-of-type(1)::after{
        background-image: url(../images/dragonhead/icon_tenbin.svg);
    }
    .page--dragonhead .page-block--1__title .icon-sign--uo:nth-of-type(1)::after{
        background-image: url(../images/dragonhead/icon_uo.svg);
    }
    .page--dragonhead .page-block--1__title .icon-sign--yagi:nth-of-type(1)::after{
        background-image: url(../images/dragonhead/icon_yagi.svg);
    }

    .page--dragonhead .page--cover__title,
    .page--dragonhead .page--cover-block1__title,
    .page--dragonhead .page-block--1__title,
    .page--dragonhead .page-block--2__title,
    .page--dragonhead .page-block--3__title,
    .page--dragonhead .page-block--4__title,
    .page--dragonhead .page-block--5__title{
        color: #9084A5;
    }
    .page--dragonhead .page--cover__title span::before{
        background-image: url(../images/icon_dragonhead.svg);
    }
    .page--dragonhead.page--cover::after{
        font-size: 5.3rem;
    }



    /*-------------------------------
        ページ0（表紙）
    -------------------------------*/

    .page0{
        text-align: center;
        background-size: cover;
        background-position: right center;
        background-repeat: no-repeat;
    }
    .page0 .page__inner{
        width: 100%;
        padding: 6.5rem;
        min-height: calc(84rem - 2rem);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }



    /*-------------------------------
        ページ1
    -------------------------------*/

    .page1{
        display: flex;
        align-items: center;
        justify-content: center;
        background-image: url(../images/bg_page1.jpg);
        background-image: image-set(url(../images/bg_page1.jpg) 1x, url(../images/bg_page1@2x.jpg) 2x);
        background-image: -webkit-image-set(url(../images/bg_page1.jpg) 1x, url(../images/bg_page1@2x.jpg) 2x);
    }
    .page1__title{
        font-size: 1.8rem;
        letter-spacing: .05em;
        text-shadow: 0 0 .28rem rgba(31,53,92,.88);
        color: #fff;
    }



    /*-------------------------------
        ページ2
    -------------------------------*/

    .page2{
        background-image: url(../images/bg_page2.jpg);
        background-image: image-set(url(../images/bg_page2.jpg) 1x, url(../images/bg_page2@2x.jpg) 2x);
        background-image: -webkit-image-set(url(../images/bg_page2.jpg) 1x, url(../images/bg_page2@2x.jpg) 2x);
    }
    .page2 *:not(:last-child){
        margin-bottom: 1.7rem;
    }
    .page2 .page__inner{
        padding: 5.5rem;
    }
    .page2__text{
        font-size: 1.06rem;
        line-height: 1.862745;
        letter-spacing: .05em;
        text-shadow: 0 0 .28rem rgba(31,53,92,.88);
        color: #fff;
    }
    .page2__name{
        text-align: right;
    }



    /*-------------------------------
        ページ3
    -------------------------------*/

    .page3.page--content{
        background: #AEC3D0;
    }
    .page3 .page-block__title{
        color: #70828B;
    }


    /*-------------------------------
        ページ4
    -------------------------------*/

    .page4.page--content{
        background: #AEC3D0;
    }
    .page4 .page-block__title{
        color: #70828B;
    }
    .page4-end{
        margin-top: 10rem;
        text-align: center;
    }
    .page4-end__english{
        /* font-size: 1.06rem; */
        margin-bottom: .8rem;
        letter-spacing: .05em;
        font-style: italic;
        color: #70828B;
        font-family: 'Old Standard TT', serif;
    }
    .page4-end__text{
        font-size: 1rem;
        color: #70828B;
    }



    /*-------------------------------
        ページ5
    -------------------------------*/

    .page5 .page__inner{
        width: 100%;
        padding: 5rem 2.8rem;
        min-height: calc(84rem - 2rem);
        position: relative;
        text-align: center;
    }
    .page5 .page__inner::after{
        width: 25rem;
        height: 3.5rem;
        left: 0;
        right: 0;
        bottom: 8.5rem;
        position: absolute;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center center;
        background-image: url(../images/line_cover-foot.svg);
        margin-left: auto;
        margin-right: auto;
        display: block;
        content: "";
    }
    .page5__title{
        font-size: 1.7rem;
        letter-spacing: .075em;
        margin-bottom: 4rem;
        color: #70828B;
        text-align: center;
        position: relative;
        display: inline-block;
    }
    .page5__title::before,
    .page5__title::after{
        width: 12rem;
        height: 3rem;
        top: calc(50% - 1.5rem);
        position: absolute;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center center;
        display: block;
        content: "";
    }
    .page5__title::before{
        left: calc(-12rem - 2rem);
        background-image: url(../images/line_horoscope-title_left.svg);
    }
    .page5__title::after{
        right: calc(-12rem - 2rem);
        background-image: url(../images/line_horoscope-title_right.svg);
    }
    .page5-data{
        width: 100%;
        margin-bottom: 4rem;
        font-size: 1.3rem;
        letter-spacing: .075em;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .page5-data > *:not(:last-child){
        margin-right: 1em;
    }
    .page5-horoscope{
        width: 100%;
        max-width: 45.6rem;
        margin-left: auto;
        margin-right: auto;
    }
    .page5-horoscope img{
        width: 100%;
    }



    /*-------------------------------
        ページ6
    -------------------------------*/

    .page6 .page__inner{
        width: 100%;
        min-height: calc(84rem - 2rem);
        padding: 5rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .page6-data{
        width: 100%;
        border: 1px solid #DDE4E7;
        border-radius: 2rem;
        /* max-width: 41rem;
        margin-left: auto;
        margin-right: auto; */
        display: flex;
        align-items: inherit;
        justify-content: space-between;
        position: relative;
    }
    .page6-data::after{
        width: 1px;
        height: 100%;
        left: 57.5%;
        top: 0;
        bottom: 0;
        position: absolute;
        background: #DDE4E7;
        display: block;
        content: "";
    }
    .page6-data__title{
        margin-bottom: 1rem;
        color: #70828B;
    }
    .page6-data-position{
        /* width: 24rem;
        border: 1px solid #999; */
        width: 57.5%;
        padding: 2rem 1.5rem;
    }
    .page6-data-position__item{
        width: 100%;
        padding: .2rem .5rem;
        display: flex;
        align-items: flex-start;
        justify-content: flex-start;
    }
    /* .page6-data-position__item:not(:last-child){
        border-bottom: 1px solid #999;
    } */
    .page6-data-position__title,
    .page6-data-position__text{
        width: 50%;
        font-size: 1rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .page6-data-position__title::before,
    .page6-data-position__text::before{
        width: 1.4rem;
        height: 1.4rem;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center center;
        display: block;
        content: "";
    }
    .page6-data-position__title span,
    .page6-data-position__text span{
        width: calc(100% - 2rem);
    }

    .page6-data-position__title--sun::before{
        background-image: url(../images/icon_sun-horo.svg);
    }
    .page6-data-position__title--moon::before{
        background-image: url(../images/icon_moon-horo.svg);
    }
    .page6-data-position__title--mercury::before{
        background-image: url(../images/icon_mercury-horo.svg);
    }
    .page6-data-position__title--venus::before{
        background-image: url(../images/icon_venus-horo.svg);
    }
    .page6-data-position__title--mars::before{
        background-image: url(../images/icon_mars-horo.svg);
    }
    .page6-data-position__title--jupiter::before{
        background-image: url(../images/icon_jupiter-horo.svg);
    }
    .page6-data-position__title--saturn::before{
        background-image: url(../images/icon_saturn-horo.svg);
    }
    .page6-data-position__title--uranus::before{
        background-image: url(../images/icon_uranus-horo.svg);
    }
    .page6-data-position__title--neptune::before{
        background-image: url(../images/icon_neptune-horo.svg);
    }
    .page6-data-position__title--pluto::before{
        background-image: url(../images/icon_pluto-horo.svg);
    }
    .page6-data-position__title--dragonhead::before{
        background-image: url(../images/icon_dragonhead-horo.svg);
    }
    .page6-data-position__title--kiron::before{
        background-image: url(../images/icon_kiron-horo.svg);
    }
    .page6-data-position__title--ririsu::before{
        background-image: url(../images/icon_ririsu-horo.svg);
    }

    .page6-data-position__text--otome::before{
        background-image: url(../images/icon_otome-horo.svg);
    }
    .page6-data-position__text--oushi::before{
        background-image: url(../images/icon_oushi-horo.svg);
    }
    .page6-data-position__text--kani::before{
        background-image: url(../images/icon_kani-horo.svg);
    }
    .page6-data-position__text--ohitsuji::before{
        background-image: url(../images/icon_ohitsuji-horo.svg);
    }
    .page6-data-position__text--shishi::before{
        background-image: url(../images/icon_shishi-horo.svg);
    }
    .page6-data-position__text--mizugame::before{
        background-image: url(../images/icon_mizugame-horo.svg);
    }
    .page6-data-position__text--sasori::before{
        background-image: url(../images/icon_sasori-horo.svg);
    }
    .page6-data-position__text--ite::before{
        background-image: url(../images/icon_ite-horo.svg);
    }
    .page6-data-position__text--yagi::before{
        background-image: url(../images/icon_yagi-horo.svg);
    }
    .page6-data-position__text--tenbin::before{
        background-image: url(../images/icon_tenbin-horo.svg);
    }
    .page6-data-position__text--hutago::before{
        background-image: url(../images/icon_hutago-horo.svg);
    }
    .page6-data-position__text--uo::before{
        background-image: url(../images/icon_uo-horo.svg);
    }

    .page6-data-boundarie{
        /* width: 16rem;
        border: 1px solid #999; */
        width: 42.5%;
        padding: 2rem 1.5rem;
    }
    .page6-data-boundarie__text{
        width: 100%;
        padding: .2rem .5rem;
        font-size: 1rem;
        display: flex;
        align-items: center;
        justify-content: flex-start;
    }
    /* .page6-data-boundarie__text:not(:last-child){
        border-bottom: 1px solid #999;
    } */
    .page6-data-boundarie__text::before{
        width: 5rem;
        text-align: center;
        content: attr(data-tag);
    }
    .page6-data-boundarie__text span{
        width: calc(100% - 5rem);
        padding-left: .5rem;
    }
    .page6-data-boundarie__boundarie--13::after{
        opacity: 0;
        visibility: hidden;
        content: "-";
    }

    /*-------------------------------
        ページ7
    -------------------------------*/

    .page7{
        background-image: url(../images/bg_page7.jpg);
        background-image: image-set(url(../images/bg_page7.jpg) 1x, url(../images/bg_page7@2x.jpg) 2x);
        background-image: -webkit-image-set(url(../images/bg_page7.jpg) 1x, url(../images/bg_page7@2x.jpg) 2x);
    }
    .page7 .page__inner{
        padding-bottom: 0;
    }
    .page7 .page--cover__title::before,
    .page7 .page--cover__title::after{
        width: 8.5rem;
    }
    .page7 .page--cover__title::before{
        left: calc(-8.5rem - .6rem);
        background-image: url(../images/line_cover-title-acmc_left.svg);
    }
    .page7 .page--cover__title::after{
        right: calc(-8.5rem - .6rem);
        background-image: url(../images/line_cover-title-acmc_right.svg);
    }
    .page7 .page--cover__title span::before{
        display: none;
    }
    .page7 .page--cover__title span::after{
        font-size: .92rem;
        letter-spacing: 0;
        content: attr(data-tag);
    }
    .page7 .page--cover-block1{
        margin-bottom: 5rem;
    }
    .page7 .page-block--1__title .icon-sign--kani:nth-of-type(1)::after{
        background-image: url(../images/acmc/icon_kani.svg);
    }
    .page7 .page-block--1__title .icon-sign--hutago:nth-of-type(1)::after{
        background-image: url(../images/acmc/icon_hutago.svg);
    }
    .page7 .page-block--1__title .icon-sign--ite:nth-of-type(1)::after{
        background-image: url(../images/acmc/icon_ite.svg);
    }
    .page7 .page-block--1__title .icon-sign--mizugame:nth-of-type(1)::after{
        background-image: url(../images/acmc/icon_mizugame.svg);
    }
    .page7 .page-block--1__title .icon-sign--ohitsuji:nth-of-type(1)::after{
        background-image: url(../images/acmc/icon_ohitsuji.svg);
    }
    .page7 .page-block--1__title .icon-sign--otome:nth-of-type(1)::after{
        background-image: url(../images/acmc/icon_otome.svg);
    }
    .page7 .page-block--1__title .icon-sign--oushi:nth-of-type(1)::after{
        background-image: url(../images/acmc/icon_oushi.svg);
    }
    .page7 .page-block--1__title .icon-sign--sasori:nth-of-type(1)::after{
        background-image: url(../images/acmc/icon_sasori.svg);
    }
    .page7 .page-block--1__title .icon-sign--shishi:nth-of-type(1)::after{
        background-image: url(../images/acmc/icon_shishi.svg);
    }
    .page7 .page-block--1__title .icon-sign--tenbin:nth-of-type(1)::after{
        background-image: url(../images/acmc/icon_tenbin.svg);
    }
    .page7 .page-block--1__title .icon-sign--uo:nth-of-type(1)::after{
        background-image: url(../images/acmc/icon_uo.svg);
    }
    .page7 .page-block--1__title .icon-sign--yagi:nth-of-type(1)::after{
        background-image: url(../images/acmc/icon_yagi.svg);
    }

    .page7 .page--cover__frame{
        border-left-color: #DDE4E7;
        border-right-color: #DDE4E7;
    }
    .page7 .page--cover__frame::after{
        border-color: #DDE4E7;
    }

    .page7 .page--cover__title,
    .page7 .page--cover-block1__title,
    .page7 .page-block--1__title{
        color: #70828B;
    }



    /*-------------------------------
        ページ8
    -------------------------------*/

    .page8{
        background-image: url(../images/bg_page8.jpg);
        background-image: image-set(url(../images/bg_page8.jpg) 1x, url(../images/bg_page8@2x.jpg) 2x);
        background-image: -webkit-image-set(url(../images/bg_page8.jpg) 1x, url(../images/bg_page8@2x.jpg) 2x);
    }
    .page8 .page__inner{
        padding-bottom: 0;
    }
    .page8 .page--cover__title::before,
    .page8 .page--cover__title::after{
        width: 8.5rem;
    }
    .page8 .page--cover__title::before{
        left: calc(-8.5rem - .6rem);
        background-image: url(../images/line_cover-title-acmc_left.svg);
    }
    .page8 .page--cover__title::after{
        right: calc(-8.5rem - .6rem);
        background-image: url(../images/line_cover-title-acmc_right.svg);
    }
    .page8 .page--cover__title::before{
        background-image: url(../images/line_cover-title-acmc_left.svg);
    }
    .page8 .page--cover__title::after{
        background-image: url(../images/line_cover-title-acmc_right.svg);
    }
    .page8 .page--cover__title span::before{
        display: none;
    }
    .page8 .page--cover-block1{
        margin-bottom: 5rem;
    }
    .page8 .page-block--1__title .icon-sign--kani:nth-of-type(1)::after{
        background-image: url(../images/acmc/icon_kani.svg);
    }
    .page8 .page-block--1__title .icon-sign--hutago:nth-of-type(1)::after{
        background-image: url(../images/acmc/icon_hutago.svg);
    }
    .page8 .page-block--1__title .icon-sign--ite:nth-of-type(1)::after{
        background-image: url(../images/acmc/icon_ite.svg);
    }
    .page8 .page-block--1__title .icon-sign--mizugame:nth-of-type(1)::after{
        background-image: url(../images/acmc/icon_mizugame.svg);
    }
    .page8 .page-block--1__title .icon-sign--ohitsuji:nth-of-type(1)::after{
        background-image: url(../images/acmc/icon_ohitsuji.svg);
    }
    .page8 .page-block--1__title .icon-sign--otome:nth-of-type(1)::after{
        background-image: url(../images/acmc/icon_otome.svg);
    }
    .page8 .page-block--1__title .icon-sign--oushi:nth-of-type(1)::after{
        background-image: url(../images/acmc/icon_oushi.svg);
    }
    .page8 .page-block--1__title .icon-sign--sasori:nth-of-type(1)::after{
        background-image: url(../images/acmc/icon_sasori.svg);
    }
    .page8 .page-block--1__title .icon-sign--shishi:nth-of-type(1)::after{
        background-image: url(../images/acmc/icon_shishi.svg);
    }
    .page8 .page-block--1__title .icon-sign--tenbin:nth-of-type(1)::after{
        background-image: url(../images/acmc/icon_tenbin.svg);
    }
    .page8 .page-block--1__title .icon-sign--uo:nth-of-type(1)::after{
        background-image: url(../images/acmc/icon_uo.svg);
    }
    .page8 .page-block--1__title .icon-sign--yagi:nth-of-type(1)::after{
        background-image: url(../images/acmc/icon_yagi.svg);
    }

    .page8 .page--cover__frame{
        border-left-color: #DDE4E7;
        border-right-color: #DDE4E7;
    }
    .page8 .page--cover__frame::after{
        border-color: #DDE4E7;
    }

    .page8 .page--cover__title,
    .page8 .page--cover-block1__title,
    .page8 .page-block--1__title{
        color: #70828B;
    }
    .page8 .page--cover-block1__title{
        font-size: 1.2rem;
    }



    /*-------------------------------
        ページ9
    -------------------------------*/

    .page9{
        background-image: url(../images/bg_page9.jpg);
        background-image: image-set(url(../images/bg_page9.jpg) 1x, url(../images/bg_page9@2x.jpg) 2x);
        background-image: -webkit-image-set(url(../images/bg_page9.jpg) 1x, url(../images/bg_page9@2x.jpg) 2x);
    }



    /*-------------------------------
        ページ10
    -------------------------------*/



    /*-------------------------------
        ページ11
    -------------------------------*/




    /*-------------------------------
        ページ12
    -------------------------------*/



    /*-------------------------------
        ページ13
    -------------------------------*/



    /*-------------------------------
        ページ14
    -------------------------------*/

    .page14{
        background-image: url(../images/bg_page14.jpg);
        background-image: image-set(url(../images/bg_page14.jpg) 1x, url(../images/bg_page14@2x.jpg) 2x);
        background-image: -webkit-image-set(url(../images/bg_page14.jpg) 1x, url(../images/bg_page14@2x.jpg) 2x);
    }



    /*-------------------------------
        ページ15
    -------------------------------*/



    /*-------------------------------
        ページ16
    -------------------------------*/



    /*-------------------------------
        ページ17
    -------------------------------*/



    /*-------------------------------
        ページ18
    -------------------------------*/

    .page18{
        background-image: url(../images/bg_page18.jpg);
        background-image: image-set(url(../images/bg_page18.jpg) 1x, url(../images/bg_page18@2x.jpg) 2x);
        background-image: -webkit-image-set(url(../images/bg_page18.jpg) 1x, url(../images/bg_page18@2x.jpg) 2x);
    }



    /*-------------------------------
        ページ19
    -------------------------------*/



    /*-------------------------------
        ページ20
    -------------------------------*/



    /*-------------------------------
        ページ21
    -------------------------------*/



    /*-------------------------------
        ページ22
    -------------------------------*/

    .page22{
        background-image: url(../images/bg_page2.jpg);
        background-image: image-set(url(../images/bg_page22.jpg) 1x, url(../images/bg_page22@2x.jpg) 2x);
        background-image: -webkit-image-set(url(../images/bg_page22.jpg) 1x, url(../images/bg_page22@2x.jpg) 2x);
    }



    /*-------------------------------
        ページ23
    -------------------------------*/



    /*-------------------------------
        ページ24
    -------------------------------*/



    /*-------------------------------
        ページ25
    -------------------------------*/



    /*-------------------------------
        ページ26
    -------------------------------*/

    .page26{
        background-image: url(../images/bg_page26.jpg);
        background-image: image-set(url(../images/bg_page26.jpg) 1x, url(../images/bg_page26@2x.jpg) 2x);
        background-image: -webkit-image-set(url(../images/bg_page26.jpg) 1x, url(../images/bg_page26@2x.jpg) 2x);
    }



    /*-------------------------------
        ページ27
    -------------------------------*/



    /*-------------------------------
        ページ28
    -------------------------------*/



    /*-------------------------------
        ページ29
    -------------------------------*/



    /*-------------------------------
        ページ30
    -------------------------------*/

    .page30{
        background-image: url(../images/bg_page30.jpg);
        background-image: image-set(url(../images/bg_page30.jpg) 1x, url(../images/bg_page30@2x.jpg) 2x);
        background-image: -webkit-image-set(url(../images/bg_page30.jpg) 1x, url(../images/bg_page30@2x.jpg) 2x);
    }



    /*-------------------------------
        ページ31
    -------------------------------*/



    /*-------------------------------
        ページ32
    -------------------------------*/



    /*-------------------------------
        ページ33
    -------------------------------*/



    /*-------------------------------
        ページ34
    -------------------------------*/

    .page34{
        background-image: url(../images/bg_page34.jpg);
        background-image: image-set(url(../images/bg_page34.jpg) 1x, url(../images/bg_page34@2x.jpg) 2x);
        background-image: -webkit-image-set(url(../images/bg_page34.jpg) 1x, url(../images/bg_page34@2x.jpg) 2x);
    }



    /*-------------------------------
        ページ35
    -------------------------------*/



    /*-------------------------------
        ページ36
    -------------------------------*/



    /*-------------------------------
        ページ37
    -------------------------------*/



    /*-------------------------------
        ページ38
    -------------------------------*/

    .page38{
        background-image: url(../images/bg_page38.jpg);
        background-image: image-set(url(../images/bg_page38.jpg) 1x, url(../images/bg_page38@2x.jpg) 2x);
        background-image: -webkit-image-set(url(../images/bg_page38.jpg) 1x, url(../images/bg_page38@2x.jpg) 2x);
    }



    /*-------------------------------
        ページ39
    -------------------------------*/



    /*-------------------------------
        ページ40
    -------------------------------*/



    /*-------------------------------
        ページ41
    -------------------------------*/

    .page41{
        background: #AEC3D0;
    }
    .page41.page--cover::before{
        font-size: 2.1rem;
        font-weight: 400;
    }
    .page41-block-wrap{
        padding-top: 10rem;
        text-align: right;
    }
    .page41-block:not(:last-child){
        margin-bottom: 4rem;
    }
    .page41-block__title,
    .page41-block__name{
        font-size: 1.3rem;
        position: relative;
        display: inline-block;
        color: #70828B;
    }
    .page41-block--english .page41-block__title,
    .page41-block--english .page41-block__name{
        /* font-size: 1.4rem; */
        font-size: 2rem;
    }
    .page41 .page41-block__name::before{
        width: 3.5rem;
        height: 1px;
        top: 50%;
        left: calc(-3.5rem - .5rem);
        position: absolute;
        background: #70828B;
        display: block;
        content: "";
    }
    .page41 .page--cover__frame{
        border-left-color: #AEC3D0;
        border-right-color: #AEC3D0;
    }
    .page41 .page--cover__frame::after{
        border-color: #AEC3D0;
    }



    /*-------------------------------
        ページ42（背表紙）
    -------------------------------*/

    .page42{
        background-size: cover;
        background-position: right center;
        background-repeat: no-repeat;
        display: flex;
        align-items: flex-end;
        justify-content: center;
    }
    .page42 .page__inner{
        padding-bottom: 2.5rem;
    }
    .page42__text{
        font-size: .7rem;
        letter-spacing: .01em;
        text-align: center;
    }
    .page42__text__name{
        font-size: 1rem;
        font-family: 'Beau Rivage', cursive;
    }

    /* ------------pdf1.css-------------↓ */

    .page0{
        background-image: url(../images/bg_cover1.jpg);
        background-image: image-set(url(../images/bg_cover1.jpg) 1x, url(../images/bbg_cover1@2x.jpg) 2x);
        background-image: -webkit-image-set(url(../images/bg_cover1.jpg) 1x, url(../images/bg_cover1@2x.jpg) 2x);
    }
    .page0-header{
        margin-bottom: 5rem;
    }
    .page0-header__logo{
        width: 5rem;
        margin-bottom: 1.5rem;
        margin-left: auto;
        margin-right: auto;
    }
    .page0-header__logo img{
        width: 100%;
    }
    .page0-header__name{
        font-size: 1.98rem;
        letter-spacing: .333em;
    }
    .page0-header__catchcopy{
        /* font-size: 2.3rem; */
        font-size: 3.3rem;
    }
    .page0-pdftitle{
        width: 100%;
        max-width: 100%;
        margin-bottom: 10rem;
    }
    .page0-pdftitle img{
        width: 100%;
    }
    .page0-footer__text{
        font-size: 1.7rem;
        margin-bottom: .5rem;
    }
    .page0-footer__name{
        font-size: 1.8rem;
        min-width: 25.5rem;
        padding: .5rem 1rem;
        min-height: 3.2rem;
        border-radius: 1.6rem;
        line-height: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255,255,255,.7);
    }



    /*-------------------------------
        ページ42（背表紙）
    -------------------------------*/

    .page42{
        background-size: cover;
        background-position: left center;
        background-repeat: no-repeat;
        background-image: url(../images/bg_cover1.jpg);
        background-image: image-set(url(../images/bg_cover1.jpg) 1x, url(../images/bbg_cover1@2x.jpg) 2x);
        background-image: -webkit-image-set(url(../images/bg_cover1.jpg) 1x, url(../images/bg_cover1@2x.jpg) 2x);
    }
    .page42__text{
        color: #fff;
    }
</style>

<title></title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
</head>
<body>
	<div class="basewidth">
		<div class="page page0">
			<div class="page__inner">
				<div class="page0-header">
					<p class="page0-header__logo"><img src="./assets/images/logo1.svg" alt="HOSI NO MAI"></p>
					<p class="page0-header__name">HOSHI NO MAI</p>
					<p class="page0-header__catchcopy handfont1">Know the universe , Live your life</p>
				</div>
				<div class="page0-pdftitle"><img src="./assets/images/logo_text1.svg" alt="STELLAR BLUEPRINT"></div>
				<div class="page0-footer">
					<p class="page0-footer__text">Blueprint of</p>
					<p class="page0-footer__name">Manami Kawabata</p>
				</div>
			</div>
		</div>
		<div class="page page1 page--bg">
			<div class="page__inner">
				<p class="page1__title">As above, so below.</p>
			</div>
		</div>
		<div class="page page2 page--bg">
			<div class="page__inner">
				<p class="page2__text">上なるもののごとく、下なるものはあり<br>あなたが生まれたとき、星々がどんな状態だったかをしっていますか？<br>あなたが「どんな星の元に生まれたか」を知ることは、<br>あなたの「魂のブループリント」を知ることでもあります。<br>星のエネルギーが魂に転写されて、あなたの唯一無二の個性を紡ぎあげているのです。</p>
				<p class="page2__text">わたしの願いは、多くの人が、自分の生まれた時の星の配置を知ることで、<br>自分の人生を星々のようにさらに輝かせて生ていくことです。</p>
				<p class="page2__text">占星術は古代シュメール時代にその原型ができ、<br>ヘレニズム時代に今の形になったといわれます。</p>
				<p class="page2__text">長い歴史を経て、現代にまで継承され続けた秘密の情報でもあるのです。</p>
				<p class="page2__text">このシステムをつくった海部舞は、2014 年に西洋占星術に出会い、<br>その情報の深遠さ、素晴らしさに魅了された、日本に住む一介の占星術師です。</p>
				<p class="page2__text">自分のホロスコープを知り、自己認識を深め、理想の誰かとか、親が望む誰かではない、<br>自分自身を真っすぐに生きることの重要性に気がつきました。</p>
				<p class="page2__text">そのおかげで人生が大きく変わり、精神的にも大きく成長することができました。</p>
				<p class="page2__text">人生を誰かのせいにしなくなり、他者の人生や価値観に寛容になることができ、<br>自分と宇宙を信頼して生きることができるようになりました。</p>
				<p class="page2__text">魂のブループリントを知ることで、「わたしとして生まれてよかった！」と思える人が一人でも増えることを願っています。</p>
				<p class="page2__text page2__name">海部 舞</p>
			</div>
		</div>
		<div class="page page3 page--content page--number page--number_left" data-pageno="3">
			<div class="page__inner">
				<div class="page-block">
					<p class="page-block__title">生まれた時の天体の情報を読み解く</p>
					<p class="page__text">
						<span>このStella Blueprint に掲載するのは、月、水星、金星、太陽、火星、木星、土星の情報をメインとしています。また、ドラゴンヘッドという月と太陽の軌道が交わるポイントから分かる、あなたの魂の課題やAC と呼ばれる東の地平線、MC と呼ばれる天頂の星座から分かることなどをお伝えします。</span>
						<span>各天体や感受点にはそれぞれ、個人に影響を及ぼすテーマと、天体の性質が最も強く現れる「年齢域」があります。また、それぞれの天体が、生まれた時にどのサイン（12 星座）にあり、どのハウスにあるか、他の天体とどんな角度をとっているか、といった情報を総合的に見ていくことになります。</span>
					</p>
				</div>
				<div class="page-block">
					<p class="page-block__title">サイン</p>
					<p class="page__text">
						<span>サイン（星座）とはいわゆる１２星座のことですが、西洋占星術では生まれた時の星の配置から、すべての星がサインを持っています。そのサインは、それぞれの天体が持つ特性や感受性をあらわしています。舞台であらわすと、登場人物の性格（キャラクター）をがサインです。</span>
					</p>
				</div>
				<div class="page-block">
					<p class="page-block__title">ハウス</p>
					<p class="page__text">
						<span>ハウスというのは、東の地平線から順番に1 日の流れ（24 時間）を時間を基準に割ったもので、より地上的な領域にかかわります。あなたがその天体のテーマをどのような領域で学び、サインの特性をどのような場で発揮していくのかをあらわします。舞台の背景にあたるのがハウスです。</span>
					</p>
				</div>
				<div class="page-block">
					<p class="page-block__title">天体の年齢域</p>
					<p class="page__text">
						<span>年齢域とはその天体のエネルギーが最も強く影響する年代をあらわします。私たちは成長しながら、一つ一つの天体の学びをしていくという考えが西洋占星術にはあります。</span>
						<span>この鑑定書には、年齢域の小さい順に月から解説をしていきますので、幼少期のあなた（月）、学童期（水星）、思春期（金星）…と順番に読んでいくことで、あなたの特性がどのように変化をしていき、どのような体験をし、どのような学びをし、どのような能力を手に入れるかをこれまでの人生の答え合わせをするかのように理解することが出来ます。また、年齢域を過ぎた天体はずっとあなたの中に記憶や経験、特性として残り続けますし、天体同士の響き合いによってその後も学びなおしをすることもあります。</span>
						<span>さらに、現在の年齢域の天体を見ることで、現在のあなたがどのような体験をし、どう成長していくかを知ることが出来ますし、まだ先の年齢域の天体は「これからそうなるのだ」と考えるようにします。</span>
						<span>この「年齢域」という考えは非常に重要になりますので必ず理解をしてください。</span>
					</p>
				</div>
				<div class="page-block">
					<p class="page-block__title">アスペクト</p>
					<p class="page__text">
						<span>この鑑定書では、星同士が特定の角度を作った際にできる「アスペクト」からの影響も読み解きます。この意味がよく分からなくても、記された内容にはハッとすることが多いのではないかと思います。</span>
					</p>
				</div>
			</div>
		</div>
		<div class="page page4 page--content page--number page--number_right" data-pageno="4">
			<div class="page__inner">
				<div class="page-block">
					<p class="page-block__title">サビアン占星術という新しい技法</p>
					<p class="page__text">
						<span>さらに、ここには、サビアンシンボルの情報も掲載しています。</span>
						<span>サビアンシンボルとは、12 星座の度数ごとのエネルギーを詩的な文章であらわしたもので、1925年にアメリカのマーク・エドモンド・ジョーンズという占星術家が、エリス・フィラーという霊能者と共に実験的に12 サインの各度数から浮かび上がるイメージを記録していく実験を行ったところから生まれています。</span>
						<span>サビアンシンボルの「サビアン」とは、この実験時にエリスが古代メソポタミアのハッラーンというエリアに住んでいた「サービア人」の助けを借りたと証言したことから名づけられています。面白いですね。</span>
						<span>なお、サビアンシンボルにはジョーンズ版とその後ディーン・ルディアによって改定されたルディア版がありますが、本書はエリスフィラーの言葉を純粋に採用することを大切に考えるためにジョーンズ版を採用しています。ルディア版に親しんでいる方には違和感がある可能性もありますが、ご理解いただけますと幸いです。</span>
						<span>監修者の海部舞はこのサビアンシンボルを鑑定の際に非常に重視しており、各天体ごとの解説の中にサビアンシンボルとその解釈も掲載しています。サビアンシンボルを取り入れることで、各天体のテーマやその天体の年齢域の体験をかなり具体的に理解できるようになります。</span>
					</p>
					<p class="page__text">
						<span>なお、本鑑定書では、天体ではない「感受点」と呼ばれるものも解釈をしていきますが、これらは１２サインの度数にずれが生じやすいため、サビアンシンボルは天体の解釈のみでしか採用していません。</span>
					</p>
				</div>
				<div class="page-block">
					<p class="page-block__title">サビアン占星術という新しい技法</p>
					<p class="page__text">
						<span>これを読む中で、おそらくあなたにはいろいろな感情が沸き起こることと思います。</span>
						<span>「すごい！その通りだ！」と思う場合もあれば、現状からはとても遠く感じられて、「本当だろうか？」と思うこともあるでしょう。もしくはあなたの生きにくさや痛みが書かれていることもあるでしょう。</span>
						<span>ここに書かれていることは、あなたの魂の設定であり、遺伝子の情報に似たものです。それを生かすか、気が付かずに使わないで生きるかはあなた次第。</span>
						<span>この、星のブループリントが、あなたの本来の可能性にスイッチを入れる役割となることを願っています。また、過去の苦しい体験も生きにくさも、すべて何かを学ぶためだった、魂の設定だった、とわかると、癒しが起こります。そのような、心の昇華体験にもつながると幸いです。</span>
					</p>
				</div>
				<div class="page4-end">
					<p class="page4-end__english">Now, let's take a look at your blueprint, the unique harmony woven by the stars.</p>
					<p class="page4-end__text">さぁ、それでは、星々が織りなす唯一無二のハーモニー、あなたのブループリントを見ていきましょう。</p>
				</div>
			</div>
		</div>
		<div class="page page5 page--number page--number_left" data-pageno="5">
			<div class="page__inner">
				<p class="page5__title"><span>YOUR HOROSCOPE</span></p>
				<div class="page5-data">
					<p class="page5-data__day">1980年12月23日</p>
					<p class="page5-data__time">0時40分</p>
					<p class="page5-data__country">ベトナム</p>
					<p class="page5-data__city">ニャチャン市</p>
				</div>
				<div class="page5-horoscope"><img src="./assets/dummy/dummy_horoscope.svg"></div>
			</div>
		</div>
		<div class="page page6 page--number page--number_right" data-pageno="6">
			<div class="page__inner">
				<div class="page6-data">
					<div class="page6-data-position">
						<p class="page6-data__title">Position</p>
						<div class="page6-data__inner">
							<div class="page6-data-position__item">
								<p class="page6-data-position__title page6-data-position__title--sun"><span>太陽</span></p>
								<p class="page6-data-position__text page6-data-position__text--otome"><span>乙女座 13° 15’58”</span></p>
							</div>
							<div class="page6-data-position__item">
								<p class="page6-data-position__title page6-data-position__title--moon"><span>月</span></p>
								<p class="page6-data-position__text page6-data-position__text--oushi"><span>牡牛座 13° 15’58”</span></p>
							</div>
							<div class="page6-data-position__item">
								<p class="page6-data-position__title page6-data-position__title--mercury"><span>水星</span></p>
								<p class="page6-data-position__text page6-data-position__text--kani"><span>蟹　座 13° 15’58”</span></p>
							</div>
							<div class="page6-data-position__item">
								<p class="page6-data-position__title page6-data-position__title--venus"><span>金星</span></p>
								<p class="page6-data-position__text page6-data-position__text--ohitsuji"><span>牡羊座 13° 15’58”</span></p>
							</div>
							<div class="page6-data-position__item">
								<p class="page6-data-position__title page6-data-position__title--mars"><span>火星</span></p>
								<p class="page6-data-position__text page6-data-position__text--shishi"><span>獅子座 13° 15’58”</span></p>
							</div>
							<div class="page6-data-position__item">
								<p class="page6-data-position__title page6-data-position__title--jupiter"><span>木星</span></p>
								<p class="page6-data-position__text page6-data-position__text--mizugame"><span>水瓶座 13° 15’58”</span></p>
							</div>
							<div class="page6-data-position__item">
								<p class="page6-data-position__title page6-data-position__title--saturn"><span>土星</span></p>
								<p class="page6-data-position__text page6-data-position__text--sasori"><span>蠍　座 13° 15’58”</span></p>
							</div>
							<div class="page6-data-position__item">
								<p class="page6-data-position__title page6-data-position__title--uranus"><span>天王星</span></p>
								<p class="page6-data-position__text page6-data-position__text--ite"><span>射手座 13° 15’58”</span></p>
							</div>
							<div class="page6-data-position__item">
								<p class="page6-data-position__title page6-data-position__title--neptune"><span>海王星</span></p>
								<p class="page6-data-position__text page6-data-position__text--yagi"><span>山羊座 13° 15’58”</span></p>
							</div>
							<div class="page6-data-position__item">
								<p class="page6-data-position__title page6-data-position__title--pluto"><span>冥王星</span></p>
								<p class="page6-data-position__text page6-data-position__text--tenbin"><span>天秤座 13° 15’58”</span></p>
							</div>
							<div class="page6-data-position__item">
								<p class="page6-data-position__title page6-data-position__title--dragonhead"><span>ドラゴンヘッド</span></p>
								<p class="page6-data-position__text page6-data-position__text--oushi"><span>牡牛座 13° 15’58”</span></p>
							</div>
							<div class="page6-data-position__item">
								<p class="page6-data-position__title page6-data-position__title--kiron"><span>キロン</span></p>
								<p class="page6-data-position__text page6-data-position__text--hutago"><span>双子座 13° 15’58”</span></p>
							</div>
							<div class="page6-data-position__item">
								<p class="page6-data-position__title page6-data-position__title--ririsu"><span>リリス</span></p>
								<p class="page6-data-position__text page6-data-position__text--uo"><span>魚　座 13° 15’58”</span></p>
							</div>
						</div>
					</div>
					<div class="page6-data-boundarie">
						<p class="page6-data__title">Boundarie</p>
						<div class="page6-data__inner">
							<p class="page6-data-boundarie__text page6-data-boundarie__boundarie--ac" data-tag="AC"><span>天秤座  01° 28’12”</span></p>
							<p class="page6-data-boundarie__text page6-data-boundarie__boundarie--2" data-tag="2ハウス"><span>天秤座 28° 31’22”</span></p>
							<p class="page6-data-boundarie__text page6-data-boundarie__boundarie--3" data-tag="3ハウス"><span>蠍　座 29° 00’39”</span></p>
							<p class="page6-data-boundarie__text page6-data-boundarie__boundarie--4" data-tag="4ハウス"><span>山羊座 01° 37’06”</span></p>
							<p class="page6-data-boundarie__text page6-data-boundarie__boundarie--5" data-tag="5ハウス"><span>水瓶座 04° 12’26”</span></p>
							<p class="page6-data-boundarie__text page6-data-boundarie__boundarie--6" data-tag="6ハウス"><span>うお座 04° 36’35”</span></p>
							<p class="page6-data-boundarie__text page6-data-boundarie__boundarie--7" data-tag="7ハウス"><span>牡羊座 01° 28’12”</span></p>
							<p class="page6-data-boundarie__text page6-data-boundarie__boundarie--8" data-tag="8ハウス"><span>牡羊座 28° 31’22”</span></p>
							<p class="page6-data-boundarie__text page6-data-boundarie__boundarie--9" data-tag="9ハウス"><span>牡牛座 29° 00’39”</span></p>
							<p class="page6-data-boundarie__text page6-data-boundarie__boundarie--mc" data-tag="MC"><span>かに座 01° 37’06”</span></p>
							<p class="page6-data-boundarie__text page6-data-boundarie__boundarie--11" data-tag="11ハウス"><span>獅子座 04° 12’26”</span></p>
							<p class="page6-data-boundarie__text page6-data-boundarie__boundarie--12" data-tag="12ハウス"><span>乙女座 04° 36’35”</span></p>
							<p class="page6-data-boundarie__text page6-data-boundarie__boundarie--13"></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="page page7 page--cover page--cover-foot" data-title="AC">
			<div class="page__inner">
				<p class="page--cover__title"><span data-tag="（アセンダント）">AC</span></p>
				<div class="page--cover-block1">
					<p class="page--cover-block1__title">見た目や癖、振る舞いなど</p>
					<p class="page__text">
						<span>アセンダントとは生まれた時の東の地平線の位置をさし、ここにあった星座が、あなたの見た目の印象やもって生まれた感受性、無意識的な素質などをあらわします。</span>
						<span>普段初対面の人にどう見られるか、無意識的にどうふるまっているか、といったことがアセンダントの星座の特徴に当てはまることが多いでしょう。</span>
					</p>
				</div>
				<div class="page-block page-block--1">
					<p class="page-block--1__title">
						<span class="icon-sign icon-sign--yagi">ACサイン  獅子座</span>
						<span class="handfont1">Leo</span>
					</p>
					<p class="page__text">
						<span>アセンダントが獅子座にあるあなたは、目鼻立ちがはっきりしていて華のある見た目になりがちです。ゴージャス感があり、堂々としていて、人目を惹き、カリスマ性を感じさせる雰囲気を持っていることも多くあります。本人に目立つつもりがなくても、他者に印象付けてしまう見た目になります。</span>
						<span>人前に出たり、注目を浴びることを好む人も多いでしょうし、自分自身はそうでなくても、周囲からステージに持ち上げられるようなこともあるのではないでしょうか。情熱を持って何かを継続的に努力することができ、自分を高めることを怠りません。何かに夢中になり、遊び心を忘れないでいることが必要な人です。</span>
					</p>
				</div>
				<span class="page--cover__frame"></span>
			</div>
		</div>
		<div class="page page8 page--cover page--cover-foot" data-title="MC">
			<div class="page__inner">
				<p class="page--cover__title"><span>MC</span></p>
				<div class="page--cover-block1">
					<p class="page--cover-block1__title">周囲があなたをどう見るか、社会的な役割や達成点</p>
					<p class="page__text">
						<span>MCはあなたが生まれた時の天頂の位置に合った星座であり、この星座はあなたが社会の役割を果たすために使うことのできるスキルや周囲から社会的に期待されることと関係します。</span>
						<span>これまでの社会経験と照らし合わせてみると大きな気づきがあるでしょう。</span>
					</p>
				</div>
				<div class="page-block page-block--1">
					<p class="page-block--1__title">
						<span class="icon-sign icon-sign--yagi">MCサイン  牡牛座</span>
						<span class="handfont1">Taurus</span>
					</p>
					<p class="page__text">
						<span>MCが牡牛座にあるあなたは〜文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。</span>
					</p>
				</div>
				<span class="page--cover__frame"></span>
			</div>
		</div>
		<div class="page page9 page--bg"></div>
		<div class="page page10 page--cover page--moon" data-title="Moon">
			<div class="page__inner">
				<p class="page--cover__title"><span>月</span></p>
				<div class="page--cover-block1">
					<p class="page--cover-block1__title">幼児期から変わらない、素のあなた［0～7 歳］</p>
					<p class="page__text">
						<span>月は、あなたの幼少期（0～7 歳）に最も強く影響し、生まれもったあなたの無意識の力、素の性質などをあらわします。何に安心し、心が満たされるかにかかわるため、月の特性を大事にすることが、あなた自身をいたわることになます。<br>また、自分を大切にできるようになることで、自分自身が満たされ、草木がしっかりと根を張ってから外に伸びていくように、あなたが自分を社会に打ち出し、成長していくパワーとなっていくため、とても大切です。</span>
						<span>月のサインやハウス、サビアンシンボルの特性を確認し、自分は日ごろそれを大切にできているか感じてみましょう。もしそういう部分をないがしろにしていたと感じたら、ぜひ暮らしの中で月を満たす時間を作りましょう。</span>
						<span>また、月の鑑定内容を見ることで、子ども時代の自分を思い出すこともできるでしょう。</span>
					</p>
				</div>
				<div class="page--cover__image"><img src="./assets/images/img_moon.png" srcset="./assets/images/img_moon.png 1x, ./assets/images/img_moon@2x.png 2x" alt="月"></div>
				<span class="page--cover__frame"></span>
			</div>
		</div>
		<div class="page page11 page--content page--number page--number_left page--moon" data-pageno="11">
			<div class="page__inner">
				<div class="page-block page-block--1">
					<p class="page-block--1__title">
						<span class="icon-sign icon-sign--yagi">サイン  蟹座</span>
						<span class="handfont1">Cancer</span>
					</p>
					<p class="page__text">
						<span>月が蟹座のあなたは、面倒見がよく優しくて、人の心や場のエネルギーに敏感な子どもだったのではないでしょうか。たくさんの人と関わるのは苦手で人見知りだったかもしれませんが、特定の親しい友人を作ったり、家族との時間、家での時間を大切にします。また、家での暮らしを充実させ、家の中が安心できる場所であることが何より重要な人です。</span>
						<span>子どもや動物をかわいがる優しさがある反面、身内に対しては特に、感情的になりやすい面があり、心が揺らいで不安定になりやすいところがあります。庶民派でナチュラルなものが好きで、愛嬌があり、親しみやすい雰囲気を持っています。</span>
						<span>多産な傾向が強く、子育てに力を注ぎます。子どもや女性、一般大衆と関わるような仕事を選ぶ人もいます。ただし、その性質をうまく外へとアウトプットが出来ないことも多いため、家事や料理が得意ではない人も多く、すごく家庭的かというとそうでもなく、仕事の方が好きな人もいます。それでも、家庭や子どもとの関わりが安定していることがあなたにとってはとても重要です。</span>
						<span>場の空気や相手の感情をうまく察知する能力を生かし、人の相談に乗るような仕事をする人もいるでしょう。模倣が得意な人が多く、絵を上手に書き写したり、人のしぐさや話し方をまねるのが好きな場合もあります。聴覚が敏感で、小さな音でも聞き逃さない人も多くいます。</span>
					</p>
				</div>
				<div class="page-block page-block--2">
					<p class="page-block--2__title">月のサビアンシンボル</p>
					<p class="page__text">
						<span>本質的に持っている能力や特性をあらわすことが多く、このサビアンシンボルのテーマはあまり自覚できなかったり表には出にくい傾向があります。</span>
						<span>しかし、確実に持ち合わせているものであり、この能力を生かせるようになると大きく変わります。</span>
						<span>また、このサビアンシンボルがあらわすことが幼児期の体験や心象にかかわることも多くあります。</span>
					</p>
				</div>
				<div class="page-block page-block--3">
					<p class="page-block--3__title">蟹座15 度「食べ過ぎを楽しんだ人々のグループ」</p>
					<p class="page__text">
						<span>胃袋は蟹座を象徴する身体部位で、蟹座の、ものごとを吸収し消化していく力が極大に達した度数です。</span>
						<span>あなたは、目に見える贅沢を満喫しようとする人です。</span>
						<span>あなたは一度しっかりと目に見えない世界の真理を理解した後に物質世界に戻り、それを仲間と存分に楽しみ味わおうとします。いき過ぎると、過剰に物質性を追求することもあります。存在や暮らしの充満がテーマとなるため、自分のありたいライフスタイルをしっかりと見つめ、それを手に入れようとします。また、日常を満喫するために仕事をするとか、実社会での自己実現を果たそうとします。なんでも吸収し自分の血肉にしていく力や、衣食住へのこだわりも強くあります。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。</span>
					</p>
				</div>
			</div>
		</div>
		<div class="page page12 page--content page--number page--number_right page--moon" data-pageno="12">
			<div class="page__inner">
				<div class="page-block page-block--4">
					<p class="page-block--4__title">ハウス<span>9</span></p>
					<p class="page__text">
						<span>小さいうちに宗教に触れる環境にいたり、哲学的な倫理観を獲得している傾向があります。旅行が好きで、海外や精神、宗教に興味があり、生まれながらに強い向上心があります。精神性の成長のために社会への理想を描き、自分の信念や哲学体系を早いうちに構築する傾向もあります。不特定多数に向けてに何かを教えたり、伝えたりすることにとても向いています。勉強が好きで、アカデミックに体得しようとしますが、浮き沈みが多く変化もしやすいのが月なので、その時々でテーマや関心の方向性が変化しやすい傾向もあります。ここに月がある人は遠い世界にあこがれを持ちやすく、生まれた場所を離れることが多くなります。小さいうちに宗教に触れる環境にいたり、哲学的な倫理観を獲得している傾向があります。旅行が好きで、海外や精神、宗教に興味があり、生まれながらに強い向上心があります。精神性の成長のために社会への理想を描き、自分の信念や哲学体系を早いうちに構築する傾向もあります。不特定多数に向けてに何かを教えたり、伝えたりすることにとても向いています。勉強が好きで、アカデミックに体得しようとしますが、浮き沈みが多く変化もしやすいのが月なので、その時々でテーマや関心の方向性が変化しやすい傾向</span>
					</p>
				</div>
				<div class="page-block page-block--2">
					<p class="page-block--2__title">アスペクト<span>他の天体との関わりからわかること</span></p>
					<p class="page__text">
						<span>あなたが過酷な子ども時代を生きていたり、どうにも言えない生きにくさを抱えていたり、私生活に変化が多かったりする場合、他の天体からそのような影響を受けているからかもしれません。</span>
						<span>逆に、恵まれた子供時代であったり、暮らしの充足を感じられる場合もまた、他の天体からの影響かもしれません。</span>
						<span>あなたの素質をよりよく生かすヒントや抱える困難の意味を知り、その克服に必要なことが月と他の天体とのアスペクトで理解できます。</span>
					</p>
				</div>
				<div class="page-block page-block--5">
					<div class="page-block--5__half">
						<p class="page-block--5__title icon-sign icon-sign--yagi"><span></span></p>
						<p class="page__text">私生活や気持ちの急な変化やトラブルを経験しやすいとされます。あれこれと思い付きで出費を重ねてしまいやすい傾向もあり、家に物がたまりやすい面もあります。何でもかんでも受け入れようとしてしまい、断るのが下手だったり、不用心だったりもします。あれこれと受け入れることでチャンスや金銭などを得ることにもつながりますので、必ずしもマイナスではありません。</p>
					</div>
					<div class="page-block--5__half">
						<p class="page-block--5__title icon-sign icon-sign--yagi"><span></span></p>
						<p class="page__text">あなたは幼少期に自分らしさを見失ってしまいやすく、上記の月星座の性質を見て、あまり自分らしいと感じなかったかもしれません。一度自分の中の「らしさ」や「心地よさ」を見失いがちですが、30歳前後から自分のアイデンティティを取り戻そうと模索するようになったり、結婚して子供を産むなどする中で再び自分の月星座の性質に出会うかもしれません。また、どこか批判精神が強く、感情の防御のために意図的に鈍感になるようなところがあり、素直な自分を出せない、他者を頼ったり信頼したりができない、感情の上がり下がりが大きい、などといった生きにくさや課題と繋がりやすくなります。このような部分は、自分の月星座の性質をうまく生かせるようになったり、自分の土星の課題を克服する中で中和されていきますので、年齢が高くなるほどに心の安定性が増していきます。</p>
					</div>
				</div>
			</div>
		</div>
		<div class="page page13 page--content page--moon">
			<div class="page__inner">
				<div class="page-block page-block--5">
					<div class="page-block--5__half">
						<p class="page-block--5__title icon-sign icon-sign--yagi"><span></span></p>
						<p class="page__text">私生活や気持ちの急な変化やトラブルを経験しやすいとされます。あれこれと思い付きで出費を重ねてしまいやすい傾向もあり、家に物がたまりやすい面もあります。何でもかんでも受け入れようとしてしまい、断るのが下手だったり、不用心だったりもします。あれこれと受け入れることでチャンスや金銭などを得ることにもつながりますので、必ずしもマイナスではありません。</p>
					</div>
					<div class="page-block--5__half">
						<p class="page-block--5__title icon-sign icon-sign--yagi"><span></span></p>
						<p class="page__text">あなたは幼少期に自分らしさを見失ってしまいやすく、上記の月星座の性質を見て、あまり自分らしいと感じなかったかもしれません。一度自分の中の「らしさ」や「心地よさ」を見失いがちですが、30歳前後から自分のアイデンティティを取り戻そうと模索するようになったり、結婚して子供を産むなどする中で再び自分の月星座の性質に出会うかもしれません。また、どこか批判精神が強く、感情の防御のために意図的に鈍感になるようなところがあり、素直な自分を出せない、他者を頼ったり信頼したりができない、感情の上がり下がりが大きい、などといった生きにくさや課題と繋がりやすくなります。このような部分は、自分の月星座の性質をうまく生かせるようになったり、自分の土星の課題を克服する中で中和されていきますので、年齢が高くなるほどに心の安定性が増していきます。</p>
					</div>
				</div>
			</div>
		</div>
		<div class="page page14 page--bg"></div>
		<div class="page page15 page--cover page--mercury" data-title="Mercury">
			<div class="page__inner">
				<p class="page--cover__title"><span>水星</span></p>
				<div class="page--cover-block1">
					<p class="page--cover-block1__title">あなたの知的な興味関心［8～15 歳］</p>
					<p class="page__text">
						<span>あなたは学童期にどのようなことに関心を持ち、どのように友人と接していましたか？ 学童期である8～15 歳ごろに最も強く作用し、あなたの知的興味関心や学習、人とのコミュニケーションなどにかかわるのが生まれた時の水星です。</span>
						<span>あなたがこの頃に関心があったこと、得意だった教科、どんなタイプの子どもだったか、といったことを思い出すと、以下の水星にかかわる鑑定内容と合致するでしょう。</span>
						<span>わたしたちは学童期に得た知的関心や学習方法、人とのかかわり方などを、大人になっても仕事の技術や興味関心のある分野、ものの考え方や言葉での伝え方、人とのかかわり方などの形で影響し続けます。</span>
					</p>
				</div>
				<div class="page--cover__image"><img src="./assets/images/img_mercury.png" srcset="./assets/images/img_mercury.png 1x, ./assets/images/img_mercury@2x.png 2x" alt="水星"></div>
				<span class="page--cover__frame"></span>
			</div>
		</div>
		<div class="page page16 page--content page--mercury">
			<div class="page__inner">
				<div class="page-block page-block--1">
					<p class="page-block--1__title">
						<span class="icon-sign icon-sign--yagi">サイン  蟹座</span>
						<span class="handfont1">Cancer</span>
					</p>
					<p class="page__text">
						<span>月が蟹座のあなたは、面倒見がよく優しくて、人の心や場のエネルギーに敏感な子どもだったのではないでしょうか。たくさんの人と関わるのは苦手で人見知りだったかもしれませんが、特定の親しい友人を作ったり、家族との時間、家での時間を大切にします。また、家での暮らしを充実させ、家の中が安心できる場所であることが何より重要な人です。</span>
						<span>子どもや動物をかわいがる優しさがある反面、身内に対しては特に、感情的になりやすい面があり、心が揺らいで不安定になりやすいところがあります。庶民派でナチュラルなものが好きで、愛嬌があり、親しみやすい雰囲気を持っています。</span>
						<span>多産な傾向が強く、子育てに力を注ぎます。子どもや女性、一般大衆と関わるような仕事を選ぶ人もいます。ただし、その性質をうまく外へとアウトプットが出来ないことも多いため、家事や料理が得意ではない人も多く、すごく家庭的かというとそうでもなく、仕事の方が好きな人もいます。それでも、家庭や子どもとの関わりが安定していることがあなたにとってはとても重要です。</span>
						<span>場の空気や相手の感情をうまく察知する能力を生かし、人の相談に乗るような仕事をする人もいるでしょう。模倣が得意な人が多く、絵を上手に書き写したり、人のしぐさや話し方をまねるのが好きな場合もあります。聴覚が敏感で、小さな音でも聞き逃さない人も多くいます。</span>
					</p>
				</div>
				<div class="page-block page-block--2">
					<p class="page-block--2__title">水星のサビアンシンボル</p>
					<p class="page__text">
						<span>水星のサビアンシンボルからは、あなたのもって生まれた知性の特徴がわかります。シンボルの解説文を読むときには、あなたが、学習や人とのコミュニケーションといった知的な活動をどのようにしようとしているか、といったことについて言及されているのだという意識で見てみましょう。</span>
					</p>
				</div>
				<div class="page-block page-block--3">
					<p class="page-block--3__title">蟹座15 度「食べ過ぎを楽しんだ人々のグループ」</p>
					<p class="page__text">
						<span>胃袋は蟹座を象徴する身体部位で、蟹座の、ものごとを吸収し消化していく力が極大に達した度数です。</span>
						<span>あなたは、目に見える贅沢を満喫しようとする人です。</span>
						<span>あなたは一度しっかりと目に見えない世界の真理を理解した後に物質世界に戻り、それを仲間と存分に楽しみ味わおうとします。いき過ぎると、過剰に物質性を追求することもあります。存在や暮らしの充満がテーマとなるため、自分のありたいライフスタイルをしっかりと見つめ、それを手に入れようとします。また、日常を満喫するために仕事をするとか、実社会での自己実現を果たそうとします。なんでも吸収し自分の血肉にしていく力や、衣食住へのこだわりも強くあります。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。</span>
					</p>
				</div>
			</div>
		</div>
		<div class="page page17 page--content page--mercury">
			<div class="page__inner">
				<div class="page-block page-block--4">
					<p class="page-block--4__title">ハウス<span>9</span></p>
					<p class="page__text">
						<span>小さいうちに宗教に触れる環境にいたり、哲学的な倫理観を獲得している傾向があります。旅行が好きで、海外や精神、宗教に興味があり、生まれながらに強い向上心があります。精神性の成長のために社会への理想を描き、自分の信念や哲学体系を早いうちに構築する傾向もあります。不特定多数に向けてに何かを教えたり、伝えたりすることにとても向いています。勉強が好きで、アカデミックに体得しようとしますが、浮き沈みが多く変化もしやすいのが月なので、その時々でテーマや関心の方向性が変化しやすい傾向もあります。ここに月がある人は遠い世界にあこがれを持ちやすく、生まれた場所を離れることが多くなります。小さいうちに宗教に触れる環境にいたり、哲学的な倫理観を獲得している傾向があります。旅行が好きで、海外や精神、宗教に興味があり、生まれながらに強い向上心があります。精神性の成長のために社会への理想を描き、自分の信念や哲学体系を早いうちに構築する傾向もあります。不特定多数に向けてに何かを教えたり、伝えたりすることにとても向いています。勉強が好きで、アカデミックに体得しようとしますが、浮き沈みが多く変化もしやすいのが月なので、その時々でテーマや関心の方向性が変化しやすい傾向</span>
					</p>
				</div>
				<div class="page-block page-block--2">
					<p class="page-block--2__title">アスペクト<span>他の天体との関わりからわかること</span></p>
					<p class="page__text">
						<span>あなたの知性がどう活かされるか、その発揮にどのような課題があるか、逆にどのような才能や個性を伴うか、といったことを、他の天体とのかかわりを理解することが出来ます。</span>
					</p>
				</div>
				<div class="page-block page-block--5">
					<div class="page-block--5__half">
						<p class="page-block--5__title icon-sign icon-sign--yagi"><span></span></p>
						<p class="page__text">私生活や気持ちの急な変化やトラブルを経験しやすいとされます。あれこれと思い付きで出費を重ねてしまいやすい傾向もあり、家に物がたまりやすい面もあります。何でもかんでも受け入れようとしてしまい、断るのが下手だったり、不用心だったりもします。あれこれと受け入れることでチャンスや金銭などを得ることにもつながりますので、必ずしもマイナスではありません。</p>
					</div>
					<div class="page-block--5__half">
						<p class="page-block--5__title icon-sign icon-sign--yagi"><span></span></p>
						<p class="page__text">あなたは幼少期に自分らしさを見失ってしまいやすく、上記の月星座の性質を見て、あまり自分らしいと感じなかったかもしれません。一度自分の中の「らしさ」や「心地よさ」を見失いがちですが、30歳前後から自分のアイデンティティを取り戻そうと模索するようになったり、結婚して子供を産むなどする中で再び自分の月星座の性質に出会うかもしれません。また、どこか批判精神が強く、感情の防御のために意図的に鈍感になるようなところがあり、素直な自分を出せない、他者を頼ったり信頼したりができない、感情の上がり下がりが大きい、などといった生きにくさや課題と繋がりやすくなります。このような部分は、自分の月星座の性質をうまく生かせるようになったり、自分の土星の課題を克服する中で中和されていきますので、年齢が高くなるほどに心の安定性が増していきます。</p>
					</div>
				</div>
			</div>
		</div>
		<div class="page page18 page--bg"></div>
		<div class="page page19 page--cover page--venus" data-title="Venus">
			<div class="page__inner">
				<p class="page--cover__title"><span>金星</span></p>
				<div class="page--cover-block1">
					<p class="page--cover-block1__title">あなたの喜びや楽しみ［16～25 歳］</p>
					<p class="page__text">
						<span>感受性が生き生きと豊かさを増す思春期に、あなたは何かに夢中になったり、誰かを好きになったりしませんでしたか？そういった、あなたの好みや楽しみの方向性や何に魅力を感じるのか、といったことにかかわるのが、「宵の明星」「明けの明星」として知られ、美の女神が支配する金星です。</span>
						<span>あなたの金星のサインやハウス、サビアンシンボルは、あなたがどんなことに夢中になるか、何を美しいと感じるか、何を好むか、ということをあらわします。思春期は金星の性質があなた自身のキャラクターとして最も強く影響します。そして、その後の人生においても、この頃大好きだったものを今も好きでい続けることが多いでしょう。</span>
						<span>以下の金星の鑑定内容を、青春時代の自分、そしてそのころから変わらない自分の「好きなもの」を思い出しながら読んでみると、多くの気づきがあるでしょう。</span>
						<span>また、女性にとっては恋愛の傾向が表れており、男性にとっては好みの女性のタイプを金星のサインやハウスなどがあらわしているとされますので気にして読んでみてください。</span>
					</p>
				</div>
				<div class="page--cover__image"><img src="./assets/images/img_venus.png" srcset="./assets/images/img_venus.png 1x, ./assets/images/img_venus@2x.png 2x" alt="金星"></div>
				<span class="page--cover__frame"></span>
			</div>
		</div>
		<div class="page page20 page--content page--venus">
			<div class="page__inner">
				<div class="page-block page-block--1">
					<p class="page-block--1__title">
						<span class="icon-sign icon-sign--yagi">サイン  蟹座</span>
						<span class="handfont1">Cancer</span>
					</p>
					<p class="page__text">
						<span>月が蟹座のあなたは、面倒見がよく優しくて、人の心や場のエネルギーに敏感な子どもだったのではないでしょうか。たくさんの人と関わるのは苦手で人見知りだったかもしれませんが、特定の親しい友人を作ったり、家族との時間、家での時間を大切にします。また、家での暮らしを充実させ、家の中が安心できる場所であることが何より重要な人です。</span>
						<span>子どもや動物をかわいがる優しさがある反面、身内に対しては特に、感情的になりやすい面があり、心が揺らいで不安定になりやすいところがあります。庶民派でナチュラルなものが好きで、愛嬌があり、親しみやすい雰囲気を持っています。</span>
						<span>多産な傾向が強く、子育てに力を注ぎます。子どもや女性、一般大衆と関わるような仕事を選ぶ人もいます。ただし、その性質をうまく外へとアウトプットが出来ないことも多いため、家事や料理が得意ではない人も多く、すごく家庭的かというとそうでもなく、仕事の方が好きな人もいます。それでも、家庭や子どもとの関わりが安定していることがあなたにとってはとても重要です。</span>
						<span>場の空気や相手の感情をうまく察知する能力を生かし、人の相談に乗るような仕事をする人もいるでしょう。模倣が得意な人が多く、絵を上手に書き写したり、人のしぐさや話し方をまねるのが好きな場合もあります。聴覚が敏感で、小さな音でも聞き逃さない人も多くいます。</span>
					</p>
				</div>
				<div class="page-block page-block--2">
					<p class="page-block--2__title">金星のサビアンシンボル</p>
					<p class="page__text">
						<span>金星のサビアンシンボルからは、あなたのもって生まれた好みや感性の特徴が具体的にわかります。以下のシンボル解説の内容は、「好きなことに関係するテーマ」で発揮されるのだということを頭に入れて読んでいきましょう。また、先の金星のハウスのテーマを通して発揮できる面もあります。</span>
					</p>
				</div>
				<div class="page-block page-block--3">
					<p class="page-block--3__title">蟹座15 度「食べ過ぎを楽しんだ人々のグループ」</p>
					<p class="page__text">
						<span>胃袋は蟹座を象徴する身体部位で、蟹座の、ものごとを吸収し消化していく力が極大に達した度数です。</span>
						<span>あなたは、目に見える贅沢を満喫しようとする人です。</span>
						<span>あなたは一度しっかりと目に見えない世界の真理を理解した後に物質世界に戻り、それを仲間と存分に楽しみ味わおうとします。いき過ぎると、過剰に物質性を追求することもあります。存在や暮らしの充満がテーマとなるため、自分のありたいライフスタイルをしっかりと見つめ、それを手に入れようとします。また、日常を満喫するために仕事をするとか、実社会での自己実現を果たそうとします。なんでも吸収し自分の血肉にしていく力や、衣食住へのこだわりも強くあります。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。</span>
					</p>
				</div>
			</div>
		</div>
		<div class="page page21 page--content page--venus">
			<div class="page__inner">
				<div class="page-block page-block--4">
					<p class="page-block--4__title">ハウス<span>9</span></p>
					<p class="page__text">
						<span>小さいうちに宗教に触れる環境にいたり、哲学的な倫理観を獲得している傾向があります。旅行が好きで、海外や精神、宗教に興味があり、生まれながらに強い向上心があります。精神性の成長のために社会への理想を描き、自分の信念や哲学体系を早いうちに構築する傾向もあります。不特定多数に向けてに何かを教えたり、伝えたりすることにとても向いています。勉強が好きで、アカデミックに体得しようとしますが、浮き沈みが多く変化もしやすいのが月なので、その時々でテーマや関心の方向性が変化しやすい傾向もあります。ここに月がある人は遠い世界にあこがれを持ちやすく、生まれた場所を離れることが多くなります。小さいうちに宗教に触れる環境にいたり、哲学的な倫理観を獲得している傾向があります。旅行が好きで、海外や精神、宗教に興味があり、生まれながらに強い向上心があります。精神性の成長のために社会への理想を描き、自分の信念や哲学体系を早いうちに構築する傾向もあります。不特定多数に向けてに何かを教えたり、伝えたりすることにとても向いています。勉強が好きで、アカデミックに体得しようとしますが、浮き沈みが多く変化もしやすいのが月なので、その時々でテーマや関心の方向性が変化しやすい傾向</span>
					</p>
				</div>
				<div class="page-block page-block--2">
					<p class="page-block--2__title">アスペクト<span>他の天体との関わりからわかること</span></p>
					<p class="page__text">
						<span>あなたの魅力や感性をうまく発揮できるか、もしくはそれが制限されやすいか、そしてあなたの魅力の独創性は…？といったことが他の天体とのアスペクトから理解できます。</span>
						<span>恋愛運や金運もまた、金星が他の天体とうまく調和しているかどうかなどから判断することが出来ます。</span>
					</p>
				</div>
				<div class="page-block page-block--5">
					<div class="page-block--5__half">
						<p class="page-block--5__title icon-sign icon-sign--yagi"><span></span></p>
						<p class="page__text">私生活や気持ちの急な変化やトラブルを経験しやすいとされます。あれこれと思い付きで出費を重ねてしまいやすい傾向もあり、家に物がたまりやすい面もあります。何でもかんでも受け入れようとしてしまい、断るのが下手だったり、不用心だったりもします。あれこれと受け入れることでチャンスや金銭などを得ることにもつながりますので、必ずしもマイナスではありません。</p>
					</div>
					<div class="page-block--5__half">
						<p class="page-block--5__title icon-sign icon-sign--yagi"><span></span></p>
						<p class="page__text">あなたは幼少期に自分らしさを見失ってしまいやすく、上記の月星座の性質を見て、あまり自分らしいと感じなかったかもしれません。一度自分の中の「らしさ」や「心地よさ」を見失いがちですが、30歳前後から自分のアイデンティティを取り戻そうと模索するようになったり、結婚して子供を産むなどする中で再び自分の月星座の性質に出会うかもしれません。また、どこか批判精神が強く、感情の防御のために意図的に鈍感になるようなところがあり、素直な自分を出せない、他者を頼ったり信頼したりができない、感情の上がり下がりが大きい、などといった生きにくさや課題と繋がりやすくなります。このような部分は、自分の月星座の性質をうまく生かせるようになったり、自分の土星の課題を克服する中で中和されていきますので、年齢が高くなるほどに心の安定性が増していきます。</p>
					</div>
				</div>
			</div>
		</div>
		<div class="page page22 page--bg"></div>
		<div class="page page23 page--cover page--sun" data-title="Sun">
			<div class="page__inner">
				<p class="page--cover__title"><span>太陽</span></p>
				<div class="page--cover-block1">
					<p class="page--cover-block1__title">この人生の目的［26～35 歳］</p>
					<p class="page__text">
						<span>社会に出てしばらくすると、太陽の年齢域に差し掛かることが多いでしょう。水星や金星といった地球の内惑星は、地球からは太陽のそばをうろちょろしているように見えます。太陽の近くにあるので、水星、金星、太陽がどれも同じ星座であることもありますし、太陽の一つ隣の星座にある、ということも多いでしょう。</span>
						<span>金星が太陽と違う星座にある場合、太陽の年齢域から人生の方向性を大きく変える人が多くなります。これまでは好きなこと、楽しいことを学び職業選択の基準として行く人が多いのですが、太陽の年齢である２０代後半になると、より深く本質的な意味で自分の「生きがい」を見出そうとし始めます。そのために、太陽の年齢域に差し掛かる２０代後半ごろから職業や生き方を再選択する人が増える傾向にあります。</span>
						<span>太陽の表す人生の目的は非常に重要です。あなたにしかできないこと、生出せないもの、この人生の意味と深くかかわります。そして、できるならばそれを３５歳の太陽の年齢域までに見出すことが出来るといいでしょう。</span>
						<span>以下の鑑定文を読んで、自分が太陽のあらわす人生の目的を実際に全うできているかを感じてみてください。</span>
					</p>
				</div>
				<div class="page--cover__image"><img src="./assets/images/img_sun.png" srcset="./assets/images/img_sun.png 1x, ./assets/images/img_sun@2x.png 2x" alt="太陽"></div>
				<span class="page--cover__frame"></span>
			</div>
		</div>
		<div class="page page24 page--content page--sun">
			<div class="page__inner">
				<div class="page-block page-block--1">
					<p class="page-block--1__title">
						<span class="icon-sign icon-sign--yagi">サイン  蟹座</span>
						<span class="handfont1">Cancer</span>
					</p>
					<p class="page__text">
						<span>太陽が蟹座のあなたは、面倒見がよく優しくて、人の心や場のエネルギーに敏感な子どもだったのではないでしょうか。たくさんの人と関わるのは苦手で人見知りだったかもしれませんが、特定の親しい友人を作ったり、家族との時間、家での時間を大切にします。また、家での暮らしを充実させ、家の中が安心できる場所であることが何より重要な人です。</span>
						<span>子どもや動物をかわいがる優しさがある反面、身内に対しては特に、感情的になりやすい面があり、心が揺らいで不安定になりやすいところがあります。庶民派でナチュラルなものが好きで、愛嬌があり、親しみやすい雰囲気を持っています。</span>
						<span>多産な傾向が強く、子育てに力を注ぎます。子どもや女性、一般大衆と関わるような仕事を選ぶ人もいます。ただし、その性質をうまく外へとアウトプットが出来ないことも多いため、家事や料理が得意ではない人も多く、すごく家庭的かというとそうでもなく、仕事の方が好きな人もいます。それでも、家庭や子どもとの関わりが安定していることがあなたにとってはとても重要です。</span>
						<span>場の空気や相手の感情をうまく察知する能力を生かし、人の相談に乗るような仕事をする人もいるでしょう。模倣が得意な人が多く、絵を上手に書き写したり、人のしぐさや話し方をまねるのが好きな場合もあります。聴覚が敏感で、小さな音でも聞き逃さない人も多くいます。</span>
					</p>
				</div>
				<div class="page-block page-block--2">
					<p class="page-block--2__title">太陽のサビアンシンボル</p>
					<p class="page__text">
						<span>太陽のサビアンシンボルからは、あなたの人生の目的の詳細がわかります。また、太陽の年齢域に自身の目的に気が付くためにどんな体験をするかといったことがあらわれる場合もあります。太陽の意識はあなたの人生の根幹にかかわるものですのでよく理解しましょう。</span>
					</p>
				</div>
				<div class="page-block page-block--3">
					<p class="page-block--3__title">蟹座15 度「食べ過ぎを楽しんだ人々のグループ」</p>
					<p class="page__text">
						<span>胃袋は蟹座を象徴する身体部位で、蟹座の、ものごとを吸収し消化していく力が極大に達した度数です。</span>
						<span>あなたは、目に見える贅沢を満喫しようとする人です。</span>
						<span>あなたは一度しっかりと目に見えない世界の真理を理解した後に物質世界に戻り、それを仲間と存分に楽しみ味わおうとします。いき過ぎると、過剰に物質性を追求することもあります。存在や暮らしの充満がテーマとなるため、自分のありたいライフスタイルをしっかりと見つめ、それを手に入れようとします。また、日常を満喫するために仕事をするとか、実社会での自己実現を果たそうとします。なんでも吸収し自分の血肉にしていく力や、衣食住へのこだわりも強くあります。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。</span>
					</p>
				</div>
			</div>
		</div>
		<div class="page page25 page--content page--sun">
			<div class="page__inner">
				<div class="page-block page-block--4">
					<p class="page-block--4__title">ハウス<span>9</span></p>
					<p class="page__text">
						<span>小さいうちに宗教に触れる環境にいたり、哲学的な倫理観を獲得している傾向があります。旅行が好きで、海外や精神、宗教に興味があり、生まれながらに強い向上心があります。精神性の成長のために社会への理想を描き、自分の信念や哲学体系を早いうちに構築する傾向もあります。不特定多数に向けてに何かを教えたり、伝えたりすることにとても向いています。勉強が好きで、アカデミックに体得しようとしますが、浮き沈みが多く変化もしやすいのが月なので、その時々でテーマや関心の方向性が変化しやすい傾向もあります。ここに月がある人は遠い世界にあこがれを持ちやすく、生まれた場所を離れることが多くなります。小さいうちに宗教に触れる環境にいたり、哲学的な倫理観を獲得している傾向があります。旅行が好きで、海外や精神、宗教に興味があり、生まれながらに強い向上心があります。精神性の成長のために社会への理想を描き、自分の信念や哲学体系を早いうちに構築する傾向もあります。不特定多数に向けてに何かを教えたり、伝えたりすることにとても向いています。勉強が好きで、アカデミックに体得しようとしますが、浮き沈みが多く変化もしやすいのが月なので、その時々でテーマや関心の方向性が変化しやすい傾向</span>
					</p>
				</div>
				<div class="page-block page-block--2">
					<p class="page-block--2__title">アスペクト<span>他の天体との関わりからわかること</span></p>
					<p class="page__text">
						<span>あなたの人生の目的を社会においてうまく発揮できるかどうか、社会でどのような困難にぶつかる可能性があるか、などといったことが太陽とのアスペクトから分かります。太陽の場合は、他の天体とのハードな配置を持っていても、乗り越えていく力や行動力が強いため、それを成長の糧にしていくことが可能です。</span>
					</p>
				</div>
				<div class="page-block page-block--5">
					<div class="page-block--5__half">
						<p class="page-block--5__title icon-sign icon-sign--yagi"><span></span></p>
						<p class="page__text">私生活や気持ちの急な変化やトラブルを経験しやすいとされます。あれこれと思い付きで出費を重ねてしまいやすい傾向もあり、家に物がたまりやすい面もあります。何でもかんでも受け入れようとしてしまい、断るのが下手だったり、不用心だったりもします。あれこれと受け入れることでチャンスや金銭などを得ることにもつながりますので、必ずしもマイナスではありません。</p>
					</div>
					<div class="page-block--5__half">
						<p class="page-block--5__title icon-sign icon-sign--yagi"><span></span></p>
						<p class="page__text">あなたは幼少期に自分らしさを見失ってしまいやすく、上記の月星座の性質を見て、あまり自分らしいと感じなかったかもしれません。一度自分の中の「らしさ」や「心地よさ」を見失いがちですが、30歳前後から自分のアイデンティティを取り戻そうと模索するようになったり、結婚して子供を産むなどする中で再び自分の月星座の性質に出会うかもしれません。また、どこか批判精神が強く、感情の防御のために意図的に鈍感になるようなところがあり、素直な自分を出せない、他者を頼ったり信頼したりができない、感情の上がり下がりが大きい、などといった生きにくさや課題と繋がりやすくなります。このような部分は、自分の月星座の性質をうまく生かせるようになったり、自分の土星の課題を克服する中で中和されていきますので、年齢が高くなるほどに心の安定性が増していきます。</p>
					</div>
				</div>
			</div>
		</div>
		<div class="page page26 page--bg"></div>
		<div class="page page27 page--cover page--mars" data-title="Mars">
			<div class="page__inner">
				<p class="page--cover__title"><span>火星</span></p>
				<div class="page--cover-block1">
					<p class="page--cover-block1__title">社会でチャレンジしたいこと［36～45 歳］</p>
					<p class="page__text">
						<span>働き盛りといわれる年代が火星の年齢域で、この頃あなたが社会的にどのようなことを頑張るのか、どんな志を持ちチャレンジしていくのかを火星が表しています。火星は地球よりも外側のある天体で、より大きな宇宙への架け橋となります。</span>
						<span>この年齢の頃は、自分の限界や枠を広げようと新しいチャレンジをすることが重要になります。失敗もあるかもしれませんが、そうしたことも乗り越えていくことで、次の木星があらわす社会的な成功や拡大につながっていくのです。</span>
						<span>女性のホロスコープにおいて、火星は好みの男性のタイプをあらわすともされます。このような男性が好みかどうか、女性の皆様は鑑定をみながら感じてみてください。そして、本来は、男性に期待することとしてではなく、自分自身が社会に発揮して打ち出すものとして火星の性質を持っているのであり、たとえパートナーであってもそれを代行することはできないのだと理解しましょう。</span>
					</p>
				</div>
				<div class="page--cover__image"><img src="./assets/images/img_mars.png" srcset="./assets/images/img_mars.png 1x, ./assets/images/img_mars@2x.png 2x" alt="火星"></div>
				<span class="page--cover__frame"></span>
			</div>
		</div>
		<div class="page page28 page--content page--mars">
			<div class="page__inner">
				<div class="page-block page-block--1">
					<p class="page-block--1__title">
						<span class="icon-sign icon-sign--yagi">サイン  蟹座</span>
						<span class="handfont1">Cancer</span>
					</p>
					<p class="page__text">
						<span>火星が蟹座のあなたは、面倒見がよく優しくて、人の心や場のエネルギーに敏感な子どもだったのではないでしょうか。たくさんの人と関わるのは苦手で人見知りだったかもしれませんが、特定の親しい友人を作ったり、家族との時間、家での時間を大切にします。また、家での暮らしを充実させ、家の中が安心できる場所であることが何より重要な人です。</span>
						<span>子どもや動物をかわいがる優しさがある反面、身内に対しては特に、感情的になりやすい面があり、心が揺らいで不安定になりやすいところがあります。庶民派でナチュラルなものが好きで、愛嬌があり、親しみやすい雰囲気を持っています。</span>
						<span>多産な傾向が強く、子育てに力を注ぎます。子どもや女性、一般大衆と関わるような仕事を選ぶ人もいます。ただし、その性質をうまく外へとアウトプットが出来ないことも多いため、家事や料理が得意ではない人も多く、すごく家庭的かというとそうでもなく、仕事の方が好きな人もいます。それでも、家庭や子どもとの関わりが安定していることがあなたにとってはとても重要です。</span>
						<span>場の空気や相手の感情をうまく察知する能力を生かし、人の相談に乗るような仕事をする人もいるでしょう。模倣が得意な人が多く、絵を上手に書き写したり、人のしぐさや話し方をまねるのが好きな場合もあります。聴覚が敏感で、小さな音でも聞き逃さない人も多くいます。</span>
					</p>
				</div>
				<div class="page-block page-block--2">
					<p class="page-block--2__title">火星のサビアンシンボル</p>
					<p class="page__text">
						<span>火星のサビアンシンボルからは、あなたの火星の年齢域の頃の特徴やそのころに獲得する能力、社会で実現させようと情熱を傾けるテーマなどが詳しくわかります。</span>
					</p>
				</div>
				<div class="page-block page-block--3">
					<p class="page-block--3__title">蟹座15 度「食べ過ぎを楽しんだ人々のグループ」</p>
					<p class="page__text">
						<span>胃袋は蟹座を象徴する身体部位で、蟹座の、ものごとを吸収し消化していく力が極大に達した度数です。</span>
						<span>あなたは、目に見える贅沢を満喫しようとする人です。</span>
						<span>あなたは一度しっかりと目に見えない世界の真理を理解した後に物質世界に戻り、それを仲間と存分に楽しみ味わおうとします。いき過ぎると、過剰に物質性を追求することもあります。存在や暮らしの充満がテーマとなるため、自分のありたいライフスタイルをしっかりと見つめ、それを手に入れようとします。また、日常を満喫するために仕事をするとか、実社会での自己実現を果たそうとします。なんでも吸収し自分の血肉にしていく力や、衣食住へのこだわりも強くあります。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。</span>
					</p>
				</div>
			</div>
		</div>
		<div class="page page29 page--content page--mars">
			<div class="page__inner">
				<div class="page-block page-block--4">
					<p class="page-block--4__title">ハウス<span>9</span></p>
					<p class="page__text">
						<span>小さいうちに宗教に触れる環境にいたり、哲学的な倫理観を獲得している傾向があります。旅行が好きで、海外や精神、宗教に興味があり、生まれながらに強い向上心があります。精神性の成長のために社会への理想を描き、自分の信念や哲学体系を早いうちに構築する傾向もあります。不特定多数に向けてに何かを教えたり、伝えたりすることにとても向いています。勉強が好きで、アカデミックに体得しようとしますが、浮き沈みが多く変化もしやすいのが月なので、その時々でテーマや関心の方向性が変化しやすい傾向もあります。ここに月がある人は遠い世界にあこがれを持ちやすく、生まれた場所を離れることが多くなります。小さいうちに宗教に触れる環境にいたり、哲学的な倫理観を獲得している傾向があります。旅行が好きで、海外や精神、宗教に興味があり、生まれながらに強い向上心があります。精神性の成長のために社会への理想を描き、自分の信念や哲学体系を早いうちに構築する傾向もあります。不特定多数に向けてに何かを教えたり、伝えたりすることにとても向いています。勉強が好きで、アカデミックに体得しようとしますが、浮き沈みが多く変化もしやすいのが月なので、その時々でテーマや関心の方向性が変化しやすい傾向</span>
					</p>
				</div>
				<div class="page-block page-block--2">
					<p class="page-block--2__title">アスペクト<span>他の天体との関わりからわかること</span></p>
					<p class="page__text">
						<span>あなたが自分の野心をまっすぐに注ぎ達成することが出来るか、もしくは困難に多く突き当たるかといったことが他の天体とのかかわりからわかります。</span>
					</p>
				</div>
				<div class="page-block page-block--5">
					<div class="page-block--5__half">
						<p class="page-block--5__title icon-sign icon-sign--yagi"><span></span></p>
						<p class="page__text">私生活や気持ちの急な変化やトラブルを経験しやすいとされます。あれこれと思い付きで出費を重ねてしまいやすい傾向もあり、家に物がたまりやすい面もあります。何でもかんでも受け入れようとしてしまい、断るのが下手だったり、不用心だったりもします。あれこれと受け入れることでチャンスや金銭などを得ることにもつながりますので、必ずしもマイナスではありません。</p>
					</div>
					<div class="page-block--5__half">
						<p class="page-block--5__title icon-sign icon-sign--yagi"><span></span></p>
						<p class="page__text">あなたは幼少期に自分らしさを見失ってしまいやすく、上記の月星座の性質を見て、あまり自分らしいと感じなかったかもしれません。一度自分の中の「らしさ」や「心地よさ」を見失いがちですが、30歳前後から自分のアイデンティティを取り戻そうと模索するようになったり、結婚して子供を産むなどする中で再び自分の月星座の性質に出会うかもしれません。また、どこか批判精神が強く、感情の防御のために意図的に鈍感になるようなところがあり、素直な自分を出せない、他者を頼ったり信頼したりができない、感情の上がり下がりが大きい、などといった生きにくさや課題と繋がりやすくなります。このような部分は、自分の月星座の性質をうまく生かせるようになったり、自分の土星の課題を克服する中で中和されていきますので、年齢が高くなるほどに心の安定性が増していきます。</p>
					</div>
				</div>
			</div>
		</div>
		<div class="page page30 page--bg"></div>
		<div class="page page31 page--cover page--jupiter" data-title="Jupiter">
			<div class="page__inner">
				<p class="page--cover__title"><span>木星</span></p>
				<div class="page--cover-block1">
					<p class="page--cover-block1__title">社会的に恵まれること［46～55 歳］</p>
					<p class="page__text">
						<span>太陽系の惑星の中で最も大きな、大神ゼウスの星です。木星のサインやハウスなどからは、あなたがもともと恵まれていること、社会的に成功しやすいこと、お金につながる能力などを読み取ることが出来ます。</span>
						<span>また、木星の年齢域にあたる４０代後半からが最も木星と自己同一化しやすいため、木星のサインやハウスのテーマを社会の中で体現しやすくなります。</span>
						<span>人は恵まれていることには鈍感になりやすいのですが、木星を生かさなければ社会的な成功はありえません。ぜひ意識してよりよく生きる糧にしてください。</span>
					</p>
				</div>
				<div class="page--cover__image"><img src="./assets/images/img_jupiter.png" srcset="./assets/images/img_jupiter.png 1x, ./assets/images/img_jupiter@2x.png 2x" alt="木星"></div>
				<span class="page--cover__frame"></span>
			</div>
		</div>
		<div class="page page32 page--content page--jupiter">
			<div class="page__inner">
				<div class="page-block page-block--1">
					<p class="page-block--1__title">
						<span class="icon-sign icon-sign--yagi">サイン  蟹座</span>
						<span class="handfont1">Cancer</span>
					</p>
					<p class="page__text">
						<span>木星が蟹座のあなたは、面倒見がよく優しくて、人の心や場のエネルギーに敏感な子どもだったのではないでしょうか。たくさんの人と関わるのは苦手で人見知りだったかもしれませんが、特定の親しい友人を作ったり、家族との時間、家での時間を大切にします。また、家での暮らしを充実させ、家の中が安心できる場所であることが何より重要な人です。</span>
						<span>子どもや動物をかわいがる優しさがある反面、身内に対しては特に、感情的になりやすい面があり、心が揺らいで不安定になりやすいところがあります。庶民派でナチュラルなものが好きで、愛嬌があり、親しみやすい雰囲気を持っています。</span>
						<span>多産な傾向が強く、子育てに力を注ぎます。子どもや女性、一般大衆と関わるような仕事を選ぶ人もいます。ただし、その性質をうまく外へとアウトプットが出来ないことも多いため、家事や料理が得意ではない人も多く、すごく家庭的かというとそうでもなく、仕事の方が好きな人もいます。それでも、家庭や子どもとの関わりが安定していることがあなたにとってはとても重要です。</span>
						<span>場の空気や相手の感情をうまく察知する能力を生かし、人の相談に乗るような仕事をする人もいるでしょう。模倣が得意な人が多く、絵を上手に書き写したり、人のしぐさや話し方をまねるのが好きな場合もあります。聴覚が敏感で、小さな音でも聞き逃さない人も多くいます。</span>
					</p>
				</div>
				<div class="page-block page-block--2">
					<p class="page-block--2__title">木星のサビアンシンボル</p>
					<p class="page__text">
						<span>木星は一つのサインにおよそ１年間滞在するため、あなたの木星の性質は、サビアンシンボルが最もよくあらわしています。木星のシンボル解説に書かれた能力などが、あなたの社会的な成功につながるのだとはっきりと認識できるといいでしょう。</span>
					</p>
				</div>
				<div class="page-block page-block--3">
					<p class="page-block--3__title">蟹座15 度「食べ過ぎを楽しんだ人々のグループ」</p>
					<p class="page__text">
						<span>胃袋は蟹座を象徴する身体部位で、蟹座の、ものごとを吸収し消化していく力が極大に達した度数です。</span>
						<span>あなたは、目に見える贅沢を満喫しようとする人です。</span>
						<span>あなたは一度しっかりと目に見えない世界の真理を理解した後に物質世界に戻り、それを仲間と存分に楽しみ味わおうとします。いき過ぎると、過剰に物質性を追求することもあります。存在や暮らしの充満がテーマとなるため、自分のありたいライフスタイルをしっかりと見つめ、それを手に入れようとします。また、日常を満喫するために仕事をするとか、実社会での自己実現を果たそうとします。なんでも吸収し自分の血肉にしていく力や、衣食住へのこだわりも強くあります。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。</span>
					</p>
				</div>
			</div>
		</div>
		<div class="page page33 page--content page--jupiter">
			<div class="page__inner">
				<div class="page-block page-block--4">
					<p class="page-block--4__title">ハウス<span>9</span></p>
					<p class="page__text">
						<span>小さいうちに宗教に触れる環境にいたり、哲学的な倫理観を獲得している傾向があります。旅行が好きで、海外や精神、宗教に興味があり、生まれながらに強い向上心があります。精神性の成長のために社会への理想を描き、自分の信念や哲学体系を早いうちに構築する傾向もあります。不特定多数に向けてに何かを教えたり、伝えたりすることにとても向いています。勉強が好きで、アカデミックに体得しようとしますが、浮き沈みが多く変化もしやすいのが月なので、その時々でテーマや関心の方向性が変化しやすい傾向もあります。ここに月がある人は遠い世界にあこがれを持ちやすく、生まれた場所を離れることが多くなります。小さいうちに宗教に触れる環境にいたり、哲学的な倫理観を獲得している傾向があります。旅行が好きで、海外や精神、宗教に興味があり、生まれながらに強い向上心があります。精神性の成長のために社会への理想を描き、自分の信念や哲学体系を早いうちに構築する傾向もあります。不特定多数に向けてに何かを教えたり、伝えたりすることにとても向いています。勉強が好きで、アカデミックに体得しようとしますが、浮き沈みが多く変化もしやすいのが月なので、その時々でテーマや関心の方向性が変化しやすい傾向</span>
					</p>
				</div>
				<div class="page-block page-block--2">
					<p class="page-block--2__title">アスペクト<span>他の天体との関わりからわかること</span></p>
					<p class="page__text">
						<span>あなたの人生の目的を社会においてうまく発揮できるかどうか、社会でどのような困難にぶつかる可能性があるか、などといったことが太陽とのアスペクトから分かります。太陽の場合は、他の天体とのハードな配置を持っていても、乗り越えていく力や行動力が強いため、それを成長の糧にしていくことが可能です。</span>
					</p>
				</div>
				<div class="page-block page-block--5">
					<div class="page-block--5__half">
						<p class="page-block--5__title icon-sign icon-sign--yagi"><span></span></p>
						<p class="page__text">私生活や気持ちの急な変化やトラブルを経験しやすいとされます。あれこれと思い付きで出費を重ねてしまいやすい傾向もあり、家に物がたまりやすい面もあります。何でもかんでも受け入れようとしてしまい、断るのが下手だったり、不用心だったりもします。あれこれと受け入れることでチャンスや金銭などを得ることにもつながりますので、必ずしもマイナスではありません。</p>
					</div>
					<div class="page-block--5__half">
						<p class="page-block--5__title icon-sign icon-sign--yagi"><span></span></p>
						<p class="page__text">あなたは幼少期に自分らしさを見失ってしまいやすく、上記の月星座の性質を見て、あまり自分らしいと感じなかったかもしれません。一度自分の中の「らしさ」や「心地よさ」を見失いがちですが、30歳前後から自分のアイデンティティを取り戻そうと模索するようになったり、結婚して子供を産むなどする中で再び自分の月星座の性質に出会うかもしれません。また、どこか批判精神が強く、感情の防御のために意図的に鈍感になるようなところがあり、素直な自分を出せない、他者を頼ったり信頼したりができない、感情の上がり下がりが大きい、などといった生きにくさや課題と繋がりやすくなります。このような部分は、自分の月星座の性質をうまく生かせるようになったり、自分の土星の課題を克服する中で中和されていきますので、年齢が高くなるほどに心の安定性が増していきます。</p>
					</div>
				</div>
			</div>
		</div>
		<div class="page page34 page--bg"></div>
		<div class="page page35 page--cover page--saturn" data-title="Saturn">
			<div class="page__inner">
				<p class="page--cover__title"><span>土星</span></p>
				<div class="page--cover-block1">
					<p class="page--cover-block1__title">人生の課題や最終目的［晩年期］</p>
					<p class="page__text">
						<span>土星は肉眼で見える最も遠い星で、わたしたちの個性にかかわる天体は土星までだといえます。また、土星の内側の世界は時間と空間に支配され、この太陽系の「ルール」や「制限」にかかわります。</span>
						<span>わたしたちは、生まれた時から制限の中で生きています。この体も特性もある種の制限です。しかし、あらゆる創造活動にはルールや制限が必ず必要です。描くべきキャンパスや画材、テーマが無ければ絵を描くことはできないように、この人生はあなたにしかできない何らかの創造活動の場なのです。</span>
						<span>占星術において、この人生であなたが達成したいことをあらわすのが土星です。若いうちはそれが苦手だと感じても、土星の年齢域である晩年期にはたいてい、それが安定してできるようになっています。</span>
						<span>土星のテーマは人生の課題であるとされますし、古典的な占星術では大凶星とされますが、本来は、あなたの社会的な基盤や安定にかかわるとともに、人生をより成熟させてくれる大切な天体です。</span>
						<span>鑑定文を読みながら、あなたがすでに土星の課題を克服できているか、まだまだ苦手なままか、などを感じ取ってみましょう。</span>
					</p>
				</div>
				<div class="page--cover__image"><img src="./assets/images/img_saturn.png" srcset="./assets/images/img_saturn.png 1x, ./assets/images/img_saturn@2x.png 2x" alt="土星"></div>
				<span class="page--cover__frame"></span>
			</div>
		</div>
		<div class="page page36 page--content page--saturn">
			<div class="page__inner">
				<div class="page-block page-block--1">
					<p class="page-block--1__title">
						<span class="icon-sign icon-sign--yagi">サイン  蟹座</span>
						<span class="handfont1">Cancer</span>
					</p>
					<p class="page__text">
						<span>土星が蟹座のあなたは、面倒見がよく優しくて、人の心や場のエネルギーに敏感な子どもだったのではないでしょうか。たくさんの人と関わるのは苦手で人見知りだったかもしれませんが、特定の親しい友人を作ったり、家族との時間、家での時間を大切にします。また、家での暮らしを充実させ、家の中が安心できる場所であることが何より重要な人です。</span>
						<span>子どもや動物をかわいがる優しさがある反面、身内に対しては特に、感情的になりやすい面があり、心が揺らいで不安定になりやすいところがあります。庶民派でナチュラルなものが好きで、愛嬌があり、親しみやすい雰囲気を持っています。</span>
						<span>多産な傾向が強く、子育てに力を注ぎます。子どもや女性、一般大衆と関わるような仕事を選ぶ人もいます。ただし、その性質をうまく外へとアウトプットが出来ないことも多いため、家事や料理が得意ではない人も多く、すごく家庭的かというとそうでもなく、仕事の方が好きな人もいます。それでも、家庭や子どもとの関わりが安定していることがあなたにとってはとても重要です。</span>
						<span>場の空気や相手の感情をうまく察知する能力を生かし、人の相談に乗るような仕事をする人もいるでしょう。模倣が得意な人が多く、絵を上手に書き写したり、人のしぐさや話し方をまねるのが好きな場合もあります。聴覚が敏感で、小さな音でも聞き逃さない人も多くいます。</span>
					</p>
				</div>
				<div class="page-block page-block--2">
					<p class="page-block--2__title">土星のサビアンシンボル</p>
					<p class="page__text">
						<span>土星のサビアンシンボルには、あなたが時間をかけ、努力して手に入れる能力が表れています。こういう人です、こういう能力があります、などと書かれた解説文でも、それを手に入れるのは晩年期であり、最終的な目標なのだと認識しておきましょう。また、土星の年齢域の頃にどのように生きるかをサビアンシンボルが示唆していることも多いでしょう。</span>
					</p>
				</div>
				<div class="page-block page-block--3">
					<p class="page-block--3__title">蟹座15 度「食べ過ぎを楽しんだ人々のグループ」</p>
					<p class="page__text">
						<span>胃袋は蟹座を象徴する身体部位で、蟹座の、ものごとを吸収し消化していく力が極大に達した度数です。</span>
						<span>あなたは、目に見える贅沢を満喫しようとする人です。</span>
						<span>あなたは一度しっかりと目に見えない世界の真理を理解した後に物質世界に戻り、それを仲間と存分に楽しみ味わおうとします。いき過ぎると、過剰に物質性を追求することもあります。存在や暮らしの充満がテーマとなるため、自分のありたいライフスタイルをしっかりと見つめ、それを手に入れようとします。また、日常を満喫するために仕事をするとか、実社会での自己実現を果たそうとします。なんでも吸収し自分の血肉にしていく力や、衣食住へのこだわりも強くあります。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。家族や仲間と豊かさを味わい楽しもうとする人です。</span>
					</p>
				</div>
			</div>
		</div>
		<div class="page page37 page--content page--saturn">
			<div class="page__inner">
				<div class="page-block page-block--4">
					<p class="page-block--4__title">ハウス<span>9</span></p>
					<p class="page__text">
						<span>小さいうちに宗教に触れる環境にいたり、哲学的な倫理観を獲得している傾向があります。旅行が好きで、海外や精神、宗教に興味があり、生まれながらに強い向上心があります。精神性の成長のために社会への理想を描き、自分の信念や哲学体系を早いうちに構築する傾向もあります。不特定多数に向けてに何かを教えたり、伝えたりすることにとても向いています。勉強が好きで、アカデミックに体得しようとしますが、浮き沈みが多く変化もしやすいのが月なので、その時々でテーマや関心の方向性が変化しやすい傾向もあります。ここに月がある人は遠い世界にあこがれを持ちやすく、生まれた場所を離れることが多くなります。小さいうちに宗教に触れる環境にいたり、哲学的な倫理観を獲得している傾向があります。旅行が好きで、海外や精神、宗教に興味があり、生まれながらに強い向上心があります。精神性の成長のために社会への理想を描き、自分の信念や哲学体系を早いうちに構築する傾向もあります。不特定多数に向けてに何かを教えたり、伝えたりすることにとても向いています。勉強が好きで、アカデミックに体得しようとしますが、浮き沈みが多く変化もしやすいのが月なので、その時々でテーマや関心の方向性が変化しやすい傾向</span>
					</p>
				</div>
				<div class="page-block page-block--2">
					<p class="page-block--2__title">アスペクト<span>他の天体との関わりからわかること</span></p>
					<p class="page__text">
						<span>土星は他の天体とアスペクトすると、その天体の意味するテーマに制限をかけたり「苦手」にしてしまうことが多くなります。アスペクトがあればすでに出ている天体の箇所に記載済みです。天王星、海王星、冥王星とのアスペクトをお持ちの場合はここに記載されます。世代的な傾向ではありますが、社会生活の中で感じられる面も多いと思います。</span>
					</p>
				</div>
				<div class="page-block page-block--5">
					<div class="page-block--5__half">
						<p class="page-block--5__title icon-sign icon-sign--yagi"><span></span></p>
						<p class="page__text">私生活や気持ちの急な変化やトラブルを経験しやすいとされます。あれこれと思い付きで出費を重ねてしまいやすい傾向もあり、家に物がたまりやすい面もあります。何でもかんでも受け入れようとしてしまい、断るのが下手だったり、不用心だったりもします。あれこれと受け入れることでチャンスや金銭などを得ることにもつながりますので、必ずしもマイナスではありません。</p>
					</div>
					<div class="page-block--5__half">
						<p class="page-block--5__title icon-sign icon-sign--yagi"><span></span></p>
						<p class="page__text">あなたは幼少期に自分らしさを見失ってしまいやすく、上記の月星座の性質を見て、あまり自分らしいと感じなかったかもしれません。一度自分の中の「らしさ」や「心地よさ」を見失いがちですが、30歳前後から自分のアイデンティティを取り戻そうと模索するようになったり、結婚して子供を産むなどする中で再び自分の月星座の性質に出会うかもしれません。また、どこか批判精神が強く、感情の防御のために意図的に鈍感になるようなところがあり、素直な自分を出せない、他者を頼ったり信頼したりができない、感情の上がり下がりが大きい、などといった生きにくさや課題と繋がりやすくなります。このような部分は、自分の月星座の性質をうまく生かせるようになったり、自分の土星の課題を克服する中で中和されていきますので、年齢が高くなるほどに心の安定性が増していきます。</p>
					</div>
				</div>
			</div>
		</div>
		<div class="page page38 page--bg"></div>
		<div class="page page39 page--cover page--dragonhead" data-title="Dragon head">
			<div class="page__inner">
				<p class="page--cover__title"><span>ドラゴンヘッド</span></p>
				<div class="page--cover-block1">
					<p class="page--cover-block1__title">魂の課題</p>
					<p class="page__text">
						<span>ドラゴンヘッドは月と太陽の軌道の交点であり、このそばでの新月や満月は「日食」や「月食」となります。太陽は魂の目的意識であり、月は過去や記憶、潜在意識にかかわります。それらが交わるポイントであるドラゴンヘッドは、魂の出入りが行われるホール（穴）のようになっているイメージがあります。</span>
						<span>魂の出入り口である筒状の穴が「龍」をあらわすのかもしれません。また、「ドラゴンヘッド」の名の通り、世界中の神話に出てくる、一体が輪になって自分のしっぽを噛む蛇や龍のシンボル「ウロボロス」との関連もある感受点です。</span>
						<span>西洋占星術では、この龍の姿がわたしたちの命の循環　　すなわち輪廻転生に例えられます。しっぽはカルマであり、龍の頭部は成長しようとする意識です。それらを踏まえ、わたしたちがどのようなテーマをもって魂の成長を目指して生まれてきたのかを表すのがドラゴンヘッドという感受点です。</span>
					</p>
				</div>
				<div class="page--cover__image"><img src="./assets/images/img_dragonhead.png" srcset="./assets/images/img_dragonhead.png 1x, ./assets/images/img_dragonhead@2x.png 2x" alt="ドラゴンヘッド"></div>
				<span class="page--cover__frame"></span>
			</div>
		</div>
		<div class="page page40 page--content page--dragonhead">
			<div class="page__inner">
				<div class="page-block page-block--1">
					<p class="page-block--1__title">
						<span class="icon-sign icon-sign--yagi">サイン  蟹座</span>
						<span class="handfont1">Cancer</span>
					</p>
					<p class="page__text">
						<span>ドラゴンヘッドが蟹座のあなたは、面倒見がよく優しくて、人の心や場のエネルギーに敏感な子どもだったのではないでしょうか。たくさんの人と関わるのは苦手で人見知りだったかもしれませんが、特定の親しい友人を作ったり、家族との時間、家での時間を大切にします。また、家での暮らしを充実させ、家の中が安心できる場所であることが何より重要な人です。</span>
						<span>子どもや動物をかわいがる優しさがある反面、身内に対しては特に、感情的になりやすい面があり、心が揺らいで不安定になりやすいところがあります。庶民派でナチュラルなものが好きで、愛嬌があり、親しみやすい雰囲気を持っています。</span>
						<span>多産な傾向が強く、子育てに力を注ぎます。子どもや女性、一般大衆と関わるような仕事を選ぶ人もいます。ただし、その性質をうまく外へとアウトプットが出来ないことも多いため、家事や料理が得意ではない人も多く、すごく家庭的かというとそうでもなく、仕事の方が好きな人もいます。それでも、家庭や子どもとの関わりが安定していることがあなたにとってはとても重要です。</span>
						<span>場の空気や相手の感情をうまく察知する能力を生かし、人の相談に乗るような仕事をする人もいるでしょう。模倣が得意な人が多く、絵を上手に書き写したり、人のしぐさや話し方をまねるのが好きな場合もあります。聴覚が敏感で、小さな音でも聞き逃さない人も多くいます。</span>
					</p>
				</div>
				<div class="page-block page-block--4">
					<p class="page-block--4__title">ハウス<span>9</span></p>
					<p class="page__text">
						<span>小さいうちに宗教に触れる環境にいたり、哲学的な倫理観を獲得している傾向があります。旅行が好きで、海外や精神、宗教に興味があり、生まれながらに強い向上心があります。精神性の成長のために社会への理想を描き、自分の信念や哲学体系を早いうちに構築する傾向もあります。不特定多数に向けてに何かを教えたり、伝えたりすることにとても向いています。勉強が好きで、アカデミックに体得しようとしますが、浮き沈みが多く変化もしやすいのが月なので、その時々でテーマや関心の方向性が変化しやすい傾向もあります。ここに月がある人は遠い世界にあこがれを持ちやすく、生まれた場所を離れることが多くなります。小さいうちに宗教に触れる環境にいたり、哲学的な倫理観を獲得している傾向があります。旅行が好きで、海外や精神、宗教に興味があり、生まれながらに強い向上心があります。精神性の成長のために社会への理想を描き、自分の信念や哲学体系を早いうちに構築する傾向もあります。不特定多数に向けてに何かを教えたり、伝えたりすることにとても向いています。勉強が好きで、アカデミックに体得しようとしますが、浮き沈みが多く変化もしやすいのが月なので、その時々でテーマや関心の方向性が変化しやすい傾向</span>
					</p>
				</div>
			</div>
		</div>
		<div class="page page41 page--cover page--cover-head" data-title="2023.10.27">
			<div class="page__inner">
				<div class="page41-block-wrap">
					<div class="page41-block">
						<p class="page41-block__title">自分を知ることは、すべての知恵のはじまりである。</p>
						<p class="page41-block__name">アリストテレス</p>
					</div>
					<div class="page41-block page41-block--english">
						<p class="page41-block__title handfont2">Knowing yourself is the beginning of all wisdom.</p>
						<p class="page41-block__name handfont2">Aristotle</p>
					</div>
				</div>
				<div class="page--cover__image"><img src="./assets/images/img_page41.png" srcset="./assets/images/img_page41.png 1x, ./assets/images/img_page41@2x.png 2x" alt="アリストテレス"></div>
				<span class="page--cover__frame"></span>
			</div>
		</div>
		<div class="page page42 page--last">
			<div class="page__inner">
				<p class="page42__text">HOSHI NO MAI STELLAR BLUEPRINT SINCE 2024<br>Mai KaibeAstrology by<span class="page42__text__name">Mai Kaibe</span></p>
			</div>
		</div>
	</div>
</body>
</html>