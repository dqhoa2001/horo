@extends('layouts.user.mypage.app')

@section('css')
<link rel="stylesheet" href="{{ asset('mypage/assets/css/familyappraisal.css') }}">
@endsection

@section('content')
	<div class="Pageframe">

		@include('components.parts.side_header')


		<main class="Pageframe-main">

			@include('components.parts.top_header')


			<div class="Pageframe-main__scroll">

				<header class="Pageframe-main-header">
					<div class="Pageframe-main-header__first"><a href="{{ route('user.popup') }}">マイページ</a></div>
					<h2 class="Pageframe-main-header__pagename">家族の個人鑑定</h2>
				</header>

				<div class="Pageframe-main__inner">
					<div class="Pageframe-main-content">
						<!-- ***** セクション名 ***** -->
						<section class="sec Familyappraisal--detail" id="Familyappraisal--detail">
							<h2 class="Pageframe-main__title"><img src="{{ asset('mypage/assets/images/familyappraisal/img_title.svg') }}" alt="FAMILY APPRAISAL" class="pc"><img src="{{ asset('mypage/assets/images/familyappraisal/sp_img_title.svg') }}" alt="FAMILY APPRAISAL" class="sp"></h2>
							<div class="Pageframe-main__body">
								<div class="C-user-list">
									<div class="C-user-list-block">
										<span class="C-user-list-block__inner C-user-list-block__hasimage">
											<figure class="C-user-list-block__image"><img src="{{ asset('mypage/assets/images/familyappraisal/img_thumbnail.svg') }}" alt="画像"></figure>
											<div class="C-user-list-block__hasimage__inner">
												<h3 class="C-user-list-block__title" data-tag="Name"><span>川端 百合子</span>さん</h3>
												<div class="C-user-list-block__content">
													<p class="C-user-list-block__item" data-tag="Relationship">実母</p>
													<p class="C-user-list-block__item" data-tag="Birthday">1960 / 4 / 10</p>
													<p class="C-user-list-block__item" data-tag="Birth Time">2 : 50</p>
													<p class="C-user-list-block__item" data-tag="Location">岐阜県 笠松町</p>
												</div>
											</div>
										</span>
									</div>
								</div>
								<div class="C-appraisal">
									<div class="C-appraisal-tab__scroll">
										<ul class="C-appraisal-tab">
											<li class="C-appraisal-tab__item">TOP</li>
											<li class="C-appraisal-tab__item C-appraisal-tab__item--current">月</li>
											<li class="C-appraisal-tab__item">水星</li>
											<li class="C-appraisal-tab__item">金星</li>
											<li class="C-appraisal-tab__item">太陽</li>
											<li class="C-appraisal-tab__item">火星</li>
											<li class="C-appraisal-tab__item">木星</li>
											<li class="C-appraisal-tab__item">土星</li>
											<li class="C-appraisal-tab__item">その他</li>
										</ul>
									</div>
									<div class="C-appraisal__inner">
										<div class="C-appraisal-content C-appraisal-content--top">
											<div class="C-appraisal-content-header">
												<h3 class="C-appraisal-content-header__title fcolor2 mincho">幼児期から変わらない、<br>素のあなた。</h3>
												<div class="C-appraisal-content-header-data">
													<div class="C-appraisal-content-header-data__mark"></div>
													<div class="C-appraisal-content-header-data__jp">TOP</div>
													<div class="C-appraisal-content-header-data__en font">MOON</div>
													<div class="C-appraisal-content-header-data__year">0〜7 歳</div>
												</div>
												<div class="C-appraisal-content-header__inner">
													<dl class="C-appraisal-content-header-block">
														<dt class="C-appraisal-content-header-block__title C-appraisal-content-header-block__title--kani"><span class="fcolor2">蟹座</span></dt>
														<dd class="C-appraisal-content-header-block__text">月が蟹座にあるあなたは、小さなころから面倒見がよく、人の心に共感できる人です。家族をとても大切にし、家での暮らしが充実し、家の中が安心できる場所であることを大切します。子どもや動 物をかわいがる優しさがある反面、身内にヒステリックになりやすかったり、心が不安定になりやす い面があります。家族のために尽くし過ぎたり頑張りすぎて疲れてしまうことも多いでしょう。庶民 派で愛嬌があり、親しみやすい人です。</dd>
													</dl>
													<dl class="C-appraisal-content-header-block">
														<dt class="C-appraisal-content-header-block__title"><span class="fcolor2">9ハウス</span></dt>
														<dd class="C-appraisal-content-header-block__text">月が 9 ハウスにあるあなたは、小さい頃に哲学や宗教的なものに興味を示し、海外に興味を持ち、とても向上心があり、勉強や読書が好きだったのではないでしょうか。このハウスに月がある人は、 生まれ育った場所を離れる暗示があります。旅行やアウトドアなど、遠くに出かけ、身体を動かすこ とが好きでしょう。</dd>
													</dl>
													<dl class="C-appraisal-content-header-block">
														<dt class="C-appraisal-content-header-block__title"><span class="fcolor2">月のサビアンシンボル<br>無意識的だが本質的に持っている能力や特性</span></dt>
														<dd class="C-appraisal-content-header-block__text">月が 9 ハウスにあるあなたは、小さい頃に哲学や宗教的なものに興味を示し、海外に興味を持ち、とても向上心があり、勉強や読書が好きだったのではないでしょうか。このハウスに月がある人は、 生まれ育った場所を離れる暗示があります。旅行やアウトドアなど、遠くに出かけ、身体を動かすこ とが好きでしょう。</dd>
													</dl>
												</div>
											</div>
											<div class="C-appraisal-content-footer">
												<p class="C-appraisal-content-footer__title">他の天体との関わり</p>
												<div class="C-appraisal-content-footer__inner">
													<div class="C-appraisal-content-footer-block">
														<dl class="C-appraisal-content-footer-block__inner">
															<dt class="C-appraisal-content-footer-block__title fcolor2">月 - 山羊座</dt>
															<dd class="C-appraisal-content-footer-block__text">突然気持ちが大きくなることがあり、急に大きな出費を決意することもあります。キャパシティ以上のものを引き受けて疲れてしまうことも。そんな不用心さはありますが、いろいろなチャレンジが できる、ということでもありますし、基本的にとてもポジティブな人です。</dd>
														</dl>
														<div class="C-appraisal-content-footer-block__last">
															<p class="C-appraisal-content-footer-block__last__mark C-appraisal-content-footer-block__last__mark--yagi"></p>
															<p class="C-appraisal-content-footer-block__last__text font">MOON - CAPRICORN</p>
														</div>
													</div>
													<div class="C-appraisal-content-footer-block">
														<dl class="C-appraisal-content-footer-block__inner">
															<dt class="C-appraisal-content-footer-block__title fcolor2">月 - 蠍座</dt>
															<dd class="C-appraisal-content-footer-block__text">あなたは子ども時代に、自分の感情を抑圧してきたのではないでしょうか。自分らしさが分からなくなったり、素直に自分を表現することが難しかったかもしれません。それは、自分の心を守るため の意図的な防衛でした。権威あるものや両親への反発心は強く、社会への批判精神を育ててきたとも いえます。</dd>
														</dl>
														<div class="C-appraisal-content-footer-block__last">
															<p class="C-appraisal-content-footer-block__last__mark C-appraisal-content-footer-block__last__mark--sasori"></p>
															<p class="C-appraisal-content-footer-block__last__text font">MOON - CAPRICORN</p>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="C-appraisal-content C-appraisal-content--tsuki C-appraisal-content--current">
											<div class="C-appraisal-content-header">
												<h3 class="C-appraisal-content-header__title fcolor2 mincho">幼児期から変わらない、<br>素のあなた。</h3>
												<div class="C-appraisal-content-header-data">
													<div class="C-appraisal-content-header-data__mark"></div>
													<div class="C-appraisal-content-header-data__jp">月</div>
													<div class="C-appraisal-content-header-data__en font">MOON</div>
													<div class="C-appraisal-content-header-data__year">0〜7 歳</div>
												</div>
												<div class="C-appraisal-content-header__inner">
													<dl class="C-appraisal-content-header-block">
														<dt class="C-appraisal-content-header-block__title C-appraisal-content-header-block__title--yagi"><span class="fcolor2">蟹座</span></dt>
														<dd class="C-appraisal-content-header-block__text">月が蟹座にあるあなたは、小さなころから面倒見がよく、人の心に共感できる人です。家族をとても大切にし、家での暮らしが充実し、家の中が安心できる場所であることを大切します。子どもや動 物をかわいがる優しさがある反面、身内にヒステリックになりやすかったり、心が不安定になりやす い面があります。家族のために尽くし過ぎたり頑張りすぎて疲れてしまうことも多いでしょう。庶民 派で愛嬌があり、親しみやすい人です。</dd>
													</dl>
													<dl class="C-appraisal-content-header-block">
														<dt class="C-appraisal-content-header-block__title"><span class="fcolor2">9ハウス</span></dt>
														<dd class="C-appraisal-content-header-block__text">月が 9 ハウスにあるあなたは、小さい頃に哲学や宗教的なものに興味を示し、海外に興味を持ち、とても向上心があり、勉強や読書が好きだったのではないでしょうか。このハウスに月がある人は、 生まれ育った場所を離れる暗示があります。旅行やアウトドアなど、遠くに出かけ、身体を動かすこ とが好きでしょう。</dd>
													</dl>
													<dl class="C-appraisal-content-header-block">
														<dt class="C-appraisal-content-header-block__title"><span class="fcolor2">月のサビアンシンボル<br>無意識的だが本質的に持っている能力や特性</span></dt>
														<dd class="C-appraisal-content-header-block__text">月が 9 ハウスにあるあなたは、小さい頃に哲学や宗教的なものに興味を示し、海外に興味を持ち、とても向上心があり、勉強や読書が好きだったのではないでしょうか。このハウスに月がある人は、 生まれ育った場所を離れる暗示があります。旅行やアウトドアなど、遠くに出かけ、身体を動かすこ とが好きでしょう。</dd>
													</dl>
												</div>
											</div>
											<div class="C-appraisal-content-footer">
												<p class="C-appraisal-content-footer__title">他の天体との関わり</p>
												<div class="C-appraisal-content-footer__inner">
													<div class="C-appraisal-content-footer-block">
														<dl class="C-appraisal-content-footer-block__inner">
															<dt class="C-appraisal-content-footer-block__title fcolor2">月 - 山羊座</dt>
															<dd class="C-appraisal-content-footer-block__text">突然気持ちが大きくなることがあり、急に大きな出費を決意することもあります。キャパシティ以上のものを引き受けて疲れてしまうことも。そんな不用心さはありますが、いろいろなチャレンジが できる、ということでもありますし、基本的にとてもポジティブな人です。</dd>
														</dl>
														<div class="C-appraisal-content-footer-block__last">
															<p class="C-appraisal-content-footer-block__last__mark C-appraisal-content-footer-block__last__mark--yagi"></p>
															<p class="C-appraisal-content-footer-block__last__text font">MOON - CAPRICORN</p>
														</div>
													</div>
													<div class="C-appraisal-content-footer-block">
														<dl class="C-appraisal-content-footer-block__inner">
															<dt class="C-appraisal-content-footer-block__title fcolor2">月 - 蠍座</dt>
															<dd class="C-appraisal-content-footer-block__text">あなたは子ども時代に、自分の感情を抑圧してきたのではないでしょうか。自分らしさが分からなくなったり、素直に自分を表現することが難しかったかもしれません。それは、自分の心を守るため の意図的な防衛でした。権威あるものや両親への反発心は強く、社会への批判精神を育ててきたとも いえます。</dd>
														</dl>
														<div class="C-appraisal-content-footer-block__last">
															<p class="C-appraisal-content-footer-block__last__mark C-appraisal-content-footer-block__last__mark--sasori"></p>
															<p class="C-appraisal-content-footer-block__last__text font">MOON - CAPRICORN</p>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="C-appraisal-content C-appraisal-content--suisei">
											<div class="C-appraisal-content-header">
												<h3 class="C-appraisal-content-header__title fcolor2 mincho">幼児期から変わらない、<br>素のあなた。</h3>
												<div class="C-appraisal-content-header-data">
													<div class="C-appraisal-content-header-data__mark"></div>
													<div class="C-appraisal-content-header-data__jp">水星</div>
													<div class="C-appraisal-content-header-data__en font">MOON</div>
													<div class="C-appraisal-content-header-data__year">0〜7 歳</div>
												</div>
												<div class="C-appraisal-content-header__inner">
													<dl class="C-appraisal-content-header-block">
														<dt class="C-appraisal-content-header-block__title C-appraisal-content-header-block__title--uo"><span class="fcolor2">蟹座</span></dt>
														<dd class="C-appraisal-content-header-block__text">月が蟹座にあるあなたは、小さなころから面倒見がよく、人の心に共感できる人です。家族をとても大切にし、家での暮らしが充実し、家の中が安心できる場所であることを大切します。子どもや動 物をかわいがる優しさがある反面、身内にヒステリックになりやすかったり、心が不安定になりやす い面があります。家族のために尽くし過ぎたり頑張りすぎて疲れてしまうことも多いでしょう。庶民 派で愛嬌があり、親しみやすい人です。</dd>
													</dl>
													<dl class="C-appraisal-content-header-block">
														<dt class="C-appraisal-content-header-block__title"><span class="fcolor2">9ハウス</span></dt>
														<dd class="C-appraisal-content-header-block__text">月が 9 ハウスにあるあなたは、小さい頃に哲学や宗教的なものに興味を示し、海外に興味を持ち、とても向上心があり、勉強や読書が好きだったのではないでしょうか。このハウスに月がある人は、 生まれ育った場所を離れる暗示があります。旅行やアウトドアなど、遠くに出かけ、身体を動かすこ とが好きでしょう。</dd>
													</dl>
													<dl class="C-appraisal-content-header-block">
														<dt class="C-appraisal-content-header-block__title"><span class="fcolor2">月のサビアンシンボル<br>無意識的だが本質的に持っている能力や特性</span></dt>
														<dd class="C-appraisal-content-header-block__text">月が 9 ハウスにあるあなたは、小さい頃に哲学や宗教的なものに興味を示し、海外に興味を持ち、とても向上心があり、勉強や読書が好きだったのではないでしょうか。このハウスに月がある人は、 生まれ育った場所を離れる暗示があります。旅行やアウトドアなど、遠くに出かけ、身体を動かすこ とが好きでしょう。</dd>
													</dl>
												</div>
											</div>
											<div class="C-appraisal-content-footer">
												<p class="C-appraisal-content-footer__title">他の天体との関わり</p>
												<div class="C-appraisal-content-footer__inner">
													<div class="C-appraisal-content-footer-block">
														<dl class="C-appraisal-content-footer-block__inner">
															<dt class="C-appraisal-content-footer-block__title fcolor2">月 - 山羊座</dt>
															<dd class="C-appraisal-content-footer-block__text">突然気持ちが大きくなることがあり、急に大きな出費を決意することもあります。キャパシティ以上のものを引き受けて疲れてしまうことも。そんな不用心さはありますが、いろいろなチャレンジが できる、ということでもありますし、基本的にとてもポジティブな人です。</dd>
														</dl>
														<div class="C-appraisal-content-footer-block__last">
															<p class="C-appraisal-content-footer-block__last__mark C-appraisal-content-footer-block__last__mark--yagi"></p>
															<p class="C-appraisal-content-footer-block__last__text font">MOON - CAPRICORN</p>
														</div>
													</div>
													<div class="C-appraisal-content-footer-block">
														<dl class="C-appraisal-content-footer-block__inner">
															<dt class="C-appraisal-content-footer-block__title fcolor2">月 - 蠍座</dt>
															<dd class="C-appraisal-content-footer-block__text">あなたは子ども時代に、自分の感情を抑圧してきたのではないでしょうか。自分らしさが分からなくなったり、素直に自分を表現することが難しかったかもしれません。それは、自分の心を守るため の意図的な防衛でした。権威あるものや両親への反発心は強く、社会への批判精神を育ててきたとも いえます。</dd>
														</dl>
														<div class="C-appraisal-content-footer-block__last">
															<p class="C-appraisal-content-footer-block__last__mark C-appraisal-content-footer-block__last__mark--sasori"></p>
															<p class="C-appraisal-content-footer-block__last__text font">MOON - CAPRICORN</p>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="C-appraisal-content C-appraisal-content--kinsei">
											<div class="C-appraisal-content-header">
												<h3 class="C-appraisal-content-header__title fcolor2 mincho">幼児期から変わらない、<br>素のあなた。</h3>
												<div class="C-appraisal-content-header-data">
													<div class="C-appraisal-content-header-data__mark"></div>
													<div class="C-appraisal-content-header-data__jp">金星</div>
													<div class="C-appraisal-content-header-data__en font">MOON</div>
													<div class="C-appraisal-content-header-data__year">0〜7 歳</div>
												</div>
												<div class="C-appraisal-content-header__inner">
													<dl class="C-appraisal-content-header-block">
														<dt class="C-appraisal-content-header-block__title C-appraisal-content-header-block__title--tenbin"><span class="fcolor2">蟹座</span></dt>
														<dd class="C-appraisal-content-header-block__text">月が蟹座にあるあなたは、小さなころから面倒見がよく、人の心に共感できる人です。家族をとても大切にし、家での暮らしが充実し、家の中が安心できる場所であることを大切します。子どもや動 物をかわいがる優しさがある反面、身内にヒステリックになりやすかったり、心が不安定になりやす い面があります。家族のために尽くし過ぎたり頑張りすぎて疲れてしまうことも多いでしょう。庶民 派で愛嬌があり、親しみやすい人です。</dd>
													</dl>
													<dl class="C-appraisal-content-header-block">
														<dt class="C-appraisal-content-header-block__title"><span class="fcolor2">9ハウス</span></dt>
														<dd class="C-appraisal-content-header-block__text">月が 9 ハウスにあるあなたは、小さい頃に哲学や宗教的なものに興味を示し、海外に興味を持ち、とても向上心があり、勉強や読書が好きだったのではないでしょうか。このハウスに月がある人は、 生まれ育った場所を離れる暗示があります。旅行やアウトドアなど、遠くに出かけ、身体を動かすこ とが好きでしょう。</dd>
													</dl>
													<dl class="C-appraisal-content-header-block">
														<dt class="C-appraisal-content-header-block__title"><span class="fcolor2">月のサビアンシンボル<br>無意識的だが本質的に持っている能力や特性</span></dt>
														<dd class="C-appraisal-content-header-block__text">月が 9 ハウスにあるあなたは、小さい頃に哲学や宗教的なものに興味を示し、海外に興味を持ち、とても向上心があり、勉強や読書が好きだったのではないでしょうか。このハウスに月がある人は、 生まれ育った場所を離れる暗示があります。旅行やアウトドアなど、遠くに出かけ、身体を動かすこ とが好きでしょう。</dd>
													</dl>
												</div>
											</div>
											<div class="C-appraisal-content-footer">
												<p class="C-appraisal-content-footer__title">他の天体との関わり</p>
												<div class="C-appraisal-content-footer__inner">
													<div class="C-appraisal-content-footer-block">
														<dl class="C-appraisal-content-footer-block__inner">
															<dt class="C-appraisal-content-footer-block__title fcolor2">月 - 山羊座</dt>
															<dd class="C-appraisal-content-footer-block__text">突然気持ちが大きくなることがあり、急に大きな出費を決意することもあります。キャパシティ以上のものを引き受けて疲れてしまうことも。そんな不用心さはありますが、いろいろなチャレンジが できる、ということでもありますし、基本的にとてもポジティブな人です。</dd>
														</dl>
														<div class="C-appraisal-content-footer-block__last">
															<p class="C-appraisal-content-footer-block__last__mark C-appraisal-content-footer-block__last__mark--yagi"></p>
															<p class="C-appraisal-content-footer-block__last__text font">MOON - CAPRICORN</p>
														</div>
													</div>
													<div class="C-appraisal-content-footer-block">
														<dl class="C-appraisal-content-footer-block__inner">
															<dt class="C-appraisal-content-footer-block__title fcolor2">月 - 蠍座</dt>
															<dd class="C-appraisal-content-footer-block__text">あなたは子ども時代に、自分の感情を抑圧してきたのではないでしょうか。自分らしさが分からなくなったり、素直に自分を表現することが難しかったかもしれません。それは、自分の心を守るため の意図的な防衛でした。権威あるものや両親への反発心は強く、社会への批判精神を育ててきたとも いえます。</dd>
														</dl>
														<div class="C-appraisal-content-footer-block__last">
															<p class="C-appraisal-content-footer-block__last__mark C-appraisal-content-footer-block__last__mark--sasori"></p>
															<p class="C-appraisal-content-footer-block__last__text font">MOON - CAPRICORN</p>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="C-appraisal-content C-appraisal-content--taiyo">
											<div class="C-appraisal-content-header">
												<h3 class="C-appraisal-content-header__title fcolor2 mincho">幼児期から変わらない、<br>素のあなた。</h3>
												<div class="C-appraisal-content-header-data">
													<div class="C-appraisal-content-header-data__mark"></div>
													<div class="C-appraisal-content-header-data__jp">太陽</div>
													<div class="C-appraisal-content-header-data__en font">MOON</div>
													<div class="C-appraisal-content-header-data__year">0〜7 歳</div>
												</div>
												<div class="C-appraisal-content-header__inner">
													<dl class="C-appraisal-content-header-block">
														<dt class="C-appraisal-content-header-block__title C-appraisal-content-header-block__title--shishi"><span class="fcolor2">蟹座</span></dt>
														<dd class="C-appraisal-content-header-block__text">月が蟹座にあるあなたは、小さなころから面倒見がよく、人の心に共感できる人です。家族をとても大切にし、家での暮らしが充実し、家の中が安心できる場所であることを大切します。子どもや動 物をかわいがる優しさがある反面、身内にヒステリックになりやすかったり、心が不安定になりやす い面があります。家族のために尽くし過ぎたり頑張りすぎて疲れてしまうことも多いでしょう。庶民 派で愛嬌があり、親しみやすい人です。</dd>
													</dl>
													<dl class="C-appraisal-content-header-block">
														<dt class="C-appraisal-content-header-block__title"><span class="fcolor2">9ハウス</span></dt>
														<dd class="C-appraisal-content-header-block__text">月が 9 ハウスにあるあなたは、小さい頃に哲学や宗教的なものに興味を示し、海外に興味を持ち、とても向上心があり、勉強や読書が好きだったのではないでしょうか。このハウスに月がある人は、 生まれ育った場所を離れる暗示があります。旅行やアウトドアなど、遠くに出かけ、身体を動かすこ とが好きでしょう。</dd>
													</dl>
													<dl class="C-appraisal-content-header-block">
														<dt class="C-appraisal-content-header-block__title"><span class="fcolor2">月のサビアンシンボル<br>無意識的だが本質的に持っている能力や特性</span></dt>
														<dd class="C-appraisal-content-header-block__text">月が 9 ハウスにあるあなたは、小さい頃に哲学や宗教的なものに興味を示し、海外に興味を持ち、とても向上心があり、勉強や読書が好きだったのではないでしょうか。このハウスに月がある人は、 生まれ育った場所を離れる暗示があります。旅行やアウトドアなど、遠くに出かけ、身体を動かすこ とが好きでしょう。</dd>
													</dl>
												</div>
											</div>
											<div class="C-appraisal-content-footer">
												<p class="C-appraisal-content-footer__title">他の天体との関わり</p>
												<div class="C-appraisal-content-footer__inner">
													<div class="C-appraisal-content-footer-block">
														<dl class="C-appraisal-content-footer-block__inner">
															<dt class="C-appraisal-content-footer-block__title fcolor2">月 - 山羊座</dt>
															<dd class="C-appraisal-content-footer-block__text">突然気持ちが大きくなることがあり、急に大きな出費を決意することもあります。キャパシティ以上のものを引き受けて疲れてしまうことも。そんな不用心さはありますが、いろいろなチャレンジが できる、ということでもありますし、基本的にとてもポジティブな人です。</dd>
														</dl>
														<div class="C-appraisal-content-footer-block__last">
															<p class="C-appraisal-content-footer-block__last__mark C-appraisal-content-footer-block__last__mark--yagi"></p>
															<p class="C-appraisal-content-footer-block__last__text font">MOON - CAPRICORN</p>
														</div>
													</div>
													<div class="C-appraisal-content-footer-block">
														<dl class="C-appraisal-content-footer-block__inner">
															<dt class="C-appraisal-content-footer-block__title fcolor2">月 - 蠍座</dt>
															<dd class="C-appraisal-content-footer-block__text">あなたは子ども時代に、自分の感情を抑圧してきたのではないでしょうか。自分らしさが分からなくなったり、素直に自分を表現することが難しかったかもしれません。それは、自分の心を守るため の意図的な防衛でした。権威あるものや両親への反発心は強く、社会への批判精神を育ててきたとも いえます。</dd>
														</dl>
														<div class="C-appraisal-content-footer-block__last">
															<p class="C-appraisal-content-footer-block__last__mark C-appraisal-content-footer-block__last__mark--sasori"></p>
															<p class="C-appraisal-content-footer-block__last__text font">MOON - CAPRICORN</p>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="C-appraisal-content C-appraisal-content--kasei">
											<div class="C-appraisal-content-header">
												<h3 class="C-appraisal-content-header__title fcolor2 mincho">幼児期から変わらない、<br>素のあなた。</h3>
												<div class="C-appraisal-content-header-data">
													<div class="C-appraisal-content-header-data__mark"></div>
													<div class="C-appraisal-content-header-data__jp">火星</div>
													<div class="C-appraisal-content-header-data__en font">MOON</div>
													<div class="C-appraisal-content-header-data__year">0〜7 歳</div>
												</div>
												<div class="C-appraisal-content-header__inner">
													<dl class="C-appraisal-content-header-block">
														<dt class="C-appraisal-content-header-block__title C-appraisal-content-header-block__title--sasori"><span class="fcolor2">蟹座</span></dt>
														<dd class="C-appraisal-content-header-block__text">月が蟹座にあるあなたは、小さなころから面倒見がよく、人の心に共感できる人です。家族をとても大切にし、家での暮らしが充実し、家の中が安心できる場所であることを大切します。子どもや動 物をかわいがる優しさがある反面、身内にヒステリックになりやすかったり、心が不安定になりやす い面があります。家族のために尽くし過ぎたり頑張りすぎて疲れてしまうことも多いでしょう。庶民 派で愛嬌があり、親しみやすい人です。</dd>
													</dl>
													<dl class="C-appraisal-content-header-block">
														<dt class="C-appraisal-content-header-block__title"><span class="fcolor2">9ハウス</span></dt>
														<dd class="C-appraisal-content-header-block__text">月が 9 ハウスにあるあなたは、小さい頃に哲学や宗教的なものに興味を示し、海外に興味を持ち、とても向上心があり、勉強や読書が好きだったのではないでしょうか。このハウスに月がある人は、 生まれ育った場所を離れる暗示があります。旅行やアウトドアなど、遠くに出かけ、身体を動かすこ とが好きでしょう。</dd>
													</dl>
													<dl class="C-appraisal-content-header-block">
														<dt class="C-appraisal-content-header-block__title"><span class="fcolor2">月のサビアンシンボル<br>無意識的だが本質的に持っている能力や特性</span></dt>
														<dd class="C-appraisal-content-header-block__text">月が 9 ハウスにあるあなたは、小さい頃に哲学や宗教的なものに興味を示し、海外に興味を持ち、とても向上心があり、勉強や読書が好きだったのではないでしょうか。このハウスに月がある人は、 生まれ育った場所を離れる暗示があります。旅行やアウトドアなど、遠くに出かけ、身体を動かすこ とが好きでしょう。</dd>
													</dl>
												</div>
											</div>
											<div class="C-appraisal-content-footer">
												<p class="C-appraisal-content-footer__title">他の天体との関わり</p>
												<div class="C-appraisal-content-footer__inner">
													<div class="C-appraisal-content-footer-block">
														<dl class="C-appraisal-content-footer-block__inner">
															<dt class="C-appraisal-content-footer-block__title fcolor2">月 - 山羊座</dt>
															<dd class="C-appraisal-content-footer-block__text">突然気持ちが大きくなることがあり、急に大きな出費を決意することもあります。キャパシティ以上のものを引き受けて疲れてしまうことも。そんな不用心さはありますが、いろいろなチャレンジが できる、ということでもありますし、基本的にとてもポジティブな人です。</dd>
														</dl>
														<div class="C-appraisal-content-footer-block__last">
															<p class="C-appraisal-content-footer-block__last__mark C-appraisal-content-footer-block__last__mark--yagi"></p>
															<p class="C-appraisal-content-footer-block__last__text font">MOON - CAPRICORN</p>
														</div>
													</div>
													<div class="C-appraisal-content-footer-block">
														<dl class="C-appraisal-content-footer-block__inner">
															<dt class="C-appraisal-content-footer-block__title fcolor2">月 - 蠍座</dt>
															<dd class="C-appraisal-content-footer-block__text">あなたは子ども時代に、自分の感情を抑圧してきたのではないでしょうか。自分らしさが分からなくなったり、素直に自分を表現することが難しかったかもしれません。それは、自分の心を守るため の意図的な防衛でした。権威あるものや両親への反発心は強く、社会への批判精神を育ててきたとも いえます。</dd>
														</dl>
														<div class="C-appraisal-content-footer-block__last">
															<p class="C-appraisal-content-footer-block__last__mark C-appraisal-content-footer-block__last__mark--sasori"></p>
															<p class="C-appraisal-content-footer-block__last__text font">MOON - CAPRICORN</p>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="C-appraisal-content C-appraisal-content--mokusei">
											<div class="C-appraisal-content-header">
												<h3 class="C-appraisal-content-header__title fcolor2 mincho">幼児期から変わらない、<br>素のあなた。</h3>
												<div class="C-appraisal-content-header-data">
													<div class="C-appraisal-content-header-data__mark"></div>
													<div class="C-appraisal-content-header-data__jp">木星</div>
													<div class="C-appraisal-content-header-data__en font">MOON</div>
													<div class="C-appraisal-content-header-data__year">0〜7 歳</div>
												</div>
												<div class="C-appraisal-content-header__inner">
													<dl class="C-appraisal-content-header-block">
														<dt class="C-appraisal-content-header-block__title C-appraisal-content-header-block__title--hutago"><span class="fcolor2">蟹座</span></dt>
														<dd class="C-appraisal-content-header-block__text">月が蟹座にあるあなたは、小さなころから面倒見がよく、人の心に共感できる人です。家族をとても大切にし、家での暮らしが充実し、家の中が安心できる場所であることを大切します。子どもや動 物をかわいがる優しさがある反面、身内にヒステリックになりやすかったり、心が不安定になりやす い面があります。家族のために尽くし過ぎたり頑張りすぎて疲れてしまうことも多いでしょう。庶民 派で愛嬌があり、親しみやすい人です。</dd>
													</dl>
													<dl class="C-appraisal-content-header-block">
														<dt class="C-appraisal-content-header-block__title"><span class="fcolor2">9ハウス</span></dt>
														<dd class="C-appraisal-content-header-block__text">月が 9 ハウスにあるあなたは、小さい頃に哲学や宗教的なものに興味を示し、海外に興味を持ち、とても向上心があり、勉強や読書が好きだったのではないでしょうか。このハウスに月がある人は、 生まれ育った場所を離れる暗示があります。旅行やアウトドアなど、遠くに出かけ、身体を動かすこ とが好きでしょう。</dd>
													</dl>
													<dl class="C-appraisal-content-header-block">
														<dt class="C-appraisal-content-header-block__title"><span class="fcolor2">月のサビアンシンボル<br>無意識的だが本質的に持っている能力や特性</span></dt>
														<dd class="C-appraisal-content-header-block__text">月が 9 ハウスにあるあなたは、小さい頃に哲学や宗教的なものに興味を示し、海外に興味を持ち、とても向上心があり、勉強や読書が好きだったのではないでしょうか。このハウスに月がある人は、 生まれ育った場所を離れる暗示があります。旅行やアウトドアなど、遠くに出かけ、身体を動かすこ とが好きでしょう。</dd>
													</dl>
												</div>
											</div>
											<div class="C-appraisal-content-footer">
												<p class="C-appraisal-content-footer__title">他の天体との関わり</p>
												<div class="C-appraisal-content-footer__inner">
													<div class="C-appraisal-content-footer-block">
														<dl class="C-appraisal-content-footer-block__inner">
															<dt class="C-appraisal-content-footer-block__title fcolor2">月 - 山羊座</dt>
															<dd class="C-appraisal-content-footer-block__text">突然気持ちが大きくなることがあり、急に大きな出費を決意することもあります。キャパシティ以上のものを引き受けて疲れてしまうことも。そんな不用心さはありますが、いろいろなチャレンジが できる、ということでもありますし、基本的にとてもポジティブな人です。</dd>
														</dl>
														<div class="C-appraisal-content-footer-block__last">
															<p class="C-appraisal-content-footer-block__last__mark C-appraisal-content-footer-block__last__mark--yagi"></p>
															<p class="C-appraisal-content-footer-block__last__text font">MOON - CAPRICORN</p>
														</div>
													</div>
													<div class="C-appraisal-content-footer-block">
														<dl class="C-appraisal-content-footer-block__inner">
															<dt class="C-appraisal-content-footer-block__title fcolor2">月 - 蠍座</dt>
															<dd class="C-appraisal-content-footer-block__text">あなたは子ども時代に、自分の感情を抑圧してきたのではないでしょうか。自分らしさが分からなくなったり、素直に自分を表現することが難しかったかもしれません。それは、自分の心を守るため の意図的な防衛でした。権威あるものや両親への反発心は強く、社会への批判精神を育ててきたとも いえます。</dd>
														</dl>
														<div class="C-appraisal-content-footer-block__last">
															<p class="C-appraisal-content-footer-block__last__mark C-appraisal-content-footer-block__last__mark--sasori"></p>
															<p class="C-appraisal-content-footer-block__last__text font">MOON - CAPRICORN</p>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="C-appraisal-content C-appraisal-content--dosei">
											<div class="C-appraisal-content-header">
												<h3 class="C-appraisal-content-header__title fcolor2 mincho">幼児期から変わらない、<br>素のあなた。</h3>
												<div class="C-appraisal-content-header-data">
													<div class="C-appraisal-content-header-data__mark"></div>
													<div class="C-appraisal-content-header-data__jp">土星</div>
													<div class="C-appraisal-content-header-data__en font">MOON</div>
													<div class="C-appraisal-content-header-data__year">0〜7 歳</div>
												</div>
												<div class="C-appraisal-content-header__inner">
													<dl class="C-appraisal-content-header-block">
														<dt class="C-appraisal-content-header-block__title C-appraisal-content-header-block__title--ite"><span class="fcolor2">蟹座</span></dt>
														<dd class="C-appraisal-content-header-block__text">月が蟹座にあるあなたは、小さなころから面倒見がよく、人の心に共感できる人です。家族をとても大切にし、家での暮らしが充実し、家の中が安心できる場所であることを大切します。子どもや動 物をかわいがる優しさがある反面、身内にヒステリックになりやすかったり、心が不安定になりやす い面があります。家族のために尽くし過ぎたり頑張りすぎて疲れてしまうことも多いでしょう。庶民 派で愛嬌があり、親しみやすい人です。</dd>
													</dl>
													<dl class="C-appraisal-content-header-block">
														<dt class="C-appraisal-content-header-block__title"><span class="fcolor2">9ハウス</span></dt>
														<dd class="C-appraisal-content-header-block__text">月が 9 ハウスにあるあなたは、小さい頃に哲学や宗教的なものに興味を示し、海外に興味を持ち、とても向上心があり、勉強や読書が好きだったのではないでしょうか。このハウスに月がある人は、 生まれ育った場所を離れる暗示があります。旅行やアウトドアなど、遠くに出かけ、身体を動かすこ とが好きでしょう。</dd>
													</dl>
													<dl class="C-appraisal-content-header-block">
														<dt class="C-appraisal-content-header-block__title"><span class="fcolor2">月のサビアンシンボル<br>無意識的だが本質的に持っている能力や特性</span></dt>
														<dd class="C-appraisal-content-header-block__text">月が 9 ハウスにあるあなたは、小さい頃に哲学や宗教的なものに興味を示し、海外に興味を持ち、とても向上心があり、勉強や読書が好きだったのではないでしょうか。このハウスに月がある人は、 生まれ育った場所を離れる暗示があります。旅行やアウトドアなど、遠くに出かけ、身体を動かすこ とが好きでしょう。</dd>
													</dl>
												</div>
											</div>
											<div class="C-appraisal-content-footer">
												<p class="C-appraisal-content-footer__title">他の天体との関わり</p>
												<div class="C-appraisal-content-footer__inner">
													<div class="C-appraisal-content-footer-block">
														<dl class="C-appraisal-content-footer-block__inner">
															<dt class="C-appraisal-content-footer-block__title fcolor2">月 - 山羊座</dt>
															<dd class="C-appraisal-content-footer-block__text">突然気持ちが大きくなることがあり、急に大きな出費を決意することもあります。キャパシティ以上のものを引き受けて疲れてしまうことも。そんな不用心さはありますが、いろいろなチャレンジが できる、ということでもありますし、基本的にとてもポジティブな人です。</dd>
														</dl>
														<div class="C-appraisal-content-footer-block__last">
															<p class="C-appraisal-content-footer-block__last__mark C-appraisal-content-footer-block__last__mark--yagi"></p>
															<p class="C-appraisal-content-footer-block__last__text font">MOON - CAPRICORN</p>
														</div>
													</div>
													<div class="C-appraisal-content-footer-block">
														<dl class="C-appraisal-content-footer-block__inner">
															<dt class="C-appraisal-content-footer-block__title fcolor2">月 - 蠍座</dt>
															<dd class="C-appraisal-content-footer-block__text">あなたは子ども時代に、自分の感情を抑圧してきたのではないでしょうか。自分らしさが分からなくなったり、素直に自分を表現することが難しかったかもしれません。それは、自分の心を守るため の意図的な防衛でした。権威あるものや両親への反発心は強く、社会への批判精神を育ててきたとも いえます。</dd>
														</dl>
														<div class="C-appraisal-content-footer-block__last">
															<p class="C-appraisal-content-footer-block__last__mark C-appraisal-content-footer-block__last__mark--sasori"></p>
															<p class="C-appraisal-content-footer-block__last__text font">MOON - CAPRICORN</p>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="C-appraisal-content C-appraisal-content--other">
											<div class="C-appraisal-content-header">
												<h3 class="C-appraisal-content-header__title fcolor2 mincho">幼児期から変わらない、<br>素のあなた。</h3>
												<div class="C-appraisal-content-header-data">
													<div class="C-appraisal-content-header-data__mark"></div>
													<div class="C-appraisal-content-header-data__jp">その他</div>
													<div class="C-appraisal-content-header-data__en font">MOON</div>
													<div class="C-appraisal-content-header-data__year">0〜7 歳</div>
												</div>
												<div class="C-appraisal-content-header__inner">
													<dl class="C-appraisal-content-header-block">
														<dt class="C-appraisal-content-header-block__title C-appraisal-content-header-block__title--mizugame"><span class="fcolor2">蟹座</span></dt>
														<dd class="C-appraisal-content-header-block__text">月が蟹座にあるあなたは、小さなころから面倒見がよく、人の心に共感できる人です。家族をとても大切にし、家での暮らしが充実し、家の中が安心できる場所であることを大切します。子どもや動 物をかわいがる優しさがある反面、身内にヒステリックになりやすかったり、心が不安定になりやす い面があります。家族のために尽くし過ぎたり頑張りすぎて疲れてしまうことも多いでしょう。庶民 派で愛嬌があり、親しみやすい人です。</dd>
													</dl>
													<dl class="C-appraisal-content-header-block">
														<dt class="C-appraisal-content-header-block__title"><span class="fcolor2">9ハウス</span></dt>
														<dd class="C-appraisal-content-header-block__text">月が 9 ハウスにあるあなたは、小さい頃に哲学や宗教的なものに興味を示し、海外に興味を持ち、とても向上心があり、勉強や読書が好きだったのではないでしょうか。このハウスに月がある人は、 生まれ育った場所を離れる暗示があります。旅行やアウトドアなど、遠くに出かけ、身体を動かすこ とが好きでしょう。</dd>
													</dl>
													<dl class="C-appraisal-content-header-block">
														<dt class="C-appraisal-content-header-block__title"><span class="fcolor2">月のサビアンシンボル<br>無意識的だが本質的に持っている能力や特性</span></dt>
														<dd class="C-appraisal-content-header-block__text">月が 9 ハウスにあるあなたは、小さい頃に哲学や宗教的なものに興味を示し、海外に興味を持ち、とても向上心があり、勉強や読書が好きだったのではないでしょうか。このハウスに月がある人は、 生まれ育った場所を離れる暗示があります。旅行やアウトドアなど、遠くに出かけ、身体を動かすこ とが好きでしょう。</dd>
													</dl>
												</div>
											</div>
											<div class="C-appraisal-content-footer">
												<p class="C-appraisal-content-footer__title">他の天体との関わり</p>
												<div class="C-appraisal-content-footer__inner">
													<div class="C-appraisal-content-footer-block">
														<dl class="C-appraisal-content-footer-block__inner">
															<dt class="C-appraisal-content-footer-block__title fcolor2">月 - 山羊座</dt>
															<dd class="C-appraisal-content-footer-block__text">突然気持ちが大きくなることがあり、急に大きな出費を決意することもあります。キャパシティ以上のものを引き受けて疲れてしまうことも。そんな不用心さはありますが、いろいろなチャレンジが できる、ということでもありますし、基本的にとてもポジティブな人です。</dd>
														</dl>
														<div class="C-appraisal-content-footer-block__last">
															<p class="C-appraisal-content-footer-block__last__mark C-appraisal-content-footer-block__last__mark--yagi"></p>
															<p class="C-appraisal-content-footer-block__last__text font">MOON - CAPRICORN</p>
														</div>
													</div>
													<div class="C-appraisal-content-footer-block">
														<dl class="C-appraisal-content-footer-block__inner">
															<dt class="C-appraisal-content-footer-block__title fcolor2">月 - 蠍座</dt>
															<dd class="C-appraisal-content-footer-block__text">あなたは子ども時代に、自分の感情を抑圧してきたのではないでしょうか。自分らしさが分からなくなったり、素直に自分を表現することが難しかったかもしれません。それは、自分の心を守るため の意図的な防衛でした。権威あるものや両親への反発心は強く、社会への批判精神を育ててきたとも いえます。</dd>
														</dl>
														<div class="C-appraisal-content-footer-block__last">
															<p class="C-appraisal-content-footer-block__last__mark C-appraisal-content-footer-block__last__mark--sasori"></p>
															<p class="C-appraisal-content-footer-block__last__text font">MOON - CAPRICORN</p>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<figure class="C-appraisal-banner"><a href="#"><img src="{{ asset('mypage/assets/images/family/img_bookbanner.png') }}" srcset="{{ asset('mypage/assets/images/family/img_bookbanner.png 1x') }} ,{{ asset('mypage/assets/images/family/img_bookbanner@2x.png 2x') }}" alt="製本" class="pc"><img src="{{ asset('mypage/assets/images/family/sp_img_bookbanner.png') }}" srcset="{{ asset('mypage/assets/images/family/sp_img_bookbanner.png 1x') }}, {{ asset('mypage/assets/images/family/sp_img_bookbanner@2x.png 2x') }}" alt="製本" class="sp"></a></figure>
								<div class="C-appraisal-history">
									<h3 class="C-appraisal-history__title"><span>個人鑑定履歴</span></h3>
									<div class="C-appraisal-history__inner">
										<div class="C-appraisal-history-block">
											<a href="./familyappraisal-detail.html">
												<time class="C-appraisal-history-block__time" datetime="2023-01-10">2023.1.10</time>
												<p class="C-appraisal-history-block__title">川端 百合子さんの個人鑑定</p>
											</a>
										</div>
										<div class="C-appraisal-history-block">
											<a href="./familyappraisal-detail.html">
												<time class="C-appraisal-history-block__time" datetime="2023-01-10">2023.1.10</time>
												<p class="C-appraisal-history-block__title">川端 百合子さんの個人鑑定</p>
											</a>
										</div>
										<div class="C-appraisal-history-block">
											<a href="./familyappraisal-detail.html">
												<time class="C-appraisal-history-block__time" datetime="2023-01-10">2023.1.10</time>
												<p class="C-appraisal-history-block__title">川端 百合子さんの個人鑑定</p>
											</a>
										</div>
									</div>
								</div>
								<div class="C-back"><a href="./familyappraisal-list.html"><span>家族の個人鑑定一覧へ戻る</span></a></div>
							</div>
						</section>
						<!-- ***** セクション名 ***** -->
					</div>
				</div>

				@include('components.parts.footer')

				
			</div>

		</main>

	</div>
@endsection