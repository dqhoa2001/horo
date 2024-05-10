@extends('layouts.user.mypage.app')

@section('css')
<link rel="stylesheet" href="{{ asset('mypage/assets/css/myappraisal.css') }}">
@endsection

@section('content')
<div class="Pageframe">

	@include('components.parts.side_header')


	<main class="Pageframe-main">

		@include('components.parts.top_header')

		<div class="Pageframe-main__scroll">

			<header class="Pageframe-main-header">
				<div class="Pageframe-main-header__first"><a href="{{ route('user.popup') }}">マイページ</a></div>
				<h2 class="Pageframe-main-header__pagename">個人鑑定</h2>
			</header>

			<div class="Pageframe-main__inner">
				<div class="Pageframe-main-content">
					<!-- ***** セクション名 ***** -->
					<section class="sec Myappraisal--detail" id="Myappraisal--detail">
						<h2 class="Pageframe-main__title"><img src="{{ asset('mypage/assets/images/myappraisal/img_title.svg') }}"
								alt="PERSONAL APPRAISAL"></h2>
						<div class="Pageframe-main__body">

							{{-- ユーザー --}}
							<div class="C-user-list">
								<div class="C-user-list-block">
									<span class="C-user-list-block__inner C-user-list-block__hasimage">
										<figure class="C-user-list-block__image"><img
												src="{{ asset('mypage/assets/images/familyappraisal/img_thumbnail.svg') }}" alt="画像"></figure>
										<div class="C-user-list-block__hasimage__inner">
											<h3 class="C-user-list-block__title" data-tag="Name"><span>{{ auth()->guard('user')->user()->full_name }}</span>さん</h3>
											<div class="C-user-list-block__content">
												<p class="C-user-list-block__item" data-tag="Birthday">
													{{ $appraisalApply->birthday->format('Y-m-d') }}
												</p>
												<p class="C-user-list-block__item" data-tag="Birth Time">
													{{ $appraisalApply->birthday_time->format('H:i') }}
												</p>
												<p class="C-user-list-block__item" data-tag="Location">
													{{ $appraisalApply->birthday_prefectures }} {{ $appraisalApply->birthday_city }}
												</p>
											</div>
										</div>
									</span>
								</div>
							</div>

							{{-- 鑑定結果 --}}
							<div class="C-appraisal">
								<div class="C-appraisal-tab__scroll">
									<ul class="C-appraisal-tab">
										<li class="C-appraisal-tab__item">TOP</li>
										@foreach ( $explain as $planetExplain)
										<li class="C-appraisal-tab__item">
											{{ $planetExplain->get('planet')->name }}
										</li>
										@endforeach
										<li class="C-appraisal-tab__item">その他</li>
									</ul>
								</div>

								<div class="C-appraisal__inner">
									{{-- TOP --}}
									<div class="C-appraisal-content C-appraisal-content--top">
										<div class="C-appraisal-content-header">
											<h3 class="C-appraisal-content-header__title fcolor2 mincho">幼児期から変わらない、<br class="pc">素のあなた。</h3>
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
									@foreach($explain as $planet => $planetExplain)
										{{-- 1項目のタブ単位 --}}
										<div class="C-appraisal-content C-appraisal-content--{{ $planets->where('id', $planetExplain->get('planet')->id)->pluck('class_name')->first() }}">
											<div class="C-appraisal-content-header">
												<h3 class="C-appraisal-content-header__title fcolor2 mincho">幼児期から変わらない、<br class="pc">素のあなた。</h3>
												<div class="C-appraisal-content-header-data">
													<div class="C-appraisal-content-header-data__mark"></div>
													<div class="C-appraisal-content-header-data__jp">{{ $planetExplain->get('planet')->name }}</div>
													<div class="C-appraisal-content-header-data__en font">{{ $planetExplain->get('planet')->name_en }}</div>
													<div class="C-appraisal-content-header-data__year">0〜7 歳</div>
												</div>

												<div class="C-appraisal-content-header__inner">
													<dl class="C-appraisal-content-header-block">
														<dt class="C-appraisal-content-header-block__title C-appraisal-content-header-block__title--{{ $zodiacs->where('id', $planetExplain->get('zodiac_pattern')->zodiac_id)->pluck('class_name')->first() }}">
															<span class="fcolor2">{{ $zodiacs->where('id', $planetExplain->get('zodiac_pattern')->zodiac_id)->pluck('name')->first() }}</span>
														</dt>
														<dd class="C-appraisal-content-header-block__text">
															{!! nl2br ($planetExplain->get('zodiac_pattern')->content) !!}
														</dd>
													</dl>
													<dl class="C-appraisal-content-header-block">
														<dt class="C-appraisal-content-header-block__title">
															<span class="fcolor2">{{ $planetExplain->get('house_pattern')->house->name }}</span>
														</dt>
														<dd class="C-appraisal-content-header-block__text">
															{!! nl2br ($planetExplain->get('house_pattern')->content )!!}
														</dd>
													</dl>
													<dl class="C-appraisal-content-header-block">
														<dt class="C-appraisal-content-header-block__title">
															<span class="fcolor2">{{ $planetExplain->get('planet')->name }}のサビアンシンボル―無意識的だが本質的に持っている能力や特性</span>
														</dt>
														<dd class="C-appraisal-content-header-block__text">
															{!! nl2br ($planetExplain->get('sabian_pattern')->content )!!}
														</dd>
													</dl>

												</div>
											</div>

											{{-- 他の天体との関わり --}}
											<div class="C-appraisal-content-footer">
												<p class="C-appraisal-content-footer__title">他の天体との関わり</p>
												@php
													$aspectPatternCount = $planetExplain->get('aspect_pattern')->count();
													$loopCount = ceil($aspectPatternCount / 2);
												@endphp
                                                @for ($i=1, $j=0; $i <= $loopCount; $i++, $j+=2)
                                                    @php
                                                        $aspectPattern = $planetExplain->get('aspect_pattern')->slice($j, 2);
                                                    @endphp
                                                    <div class="C-appraisal-content-footer__inner">
                                                        @foreach ( $aspectPattern as $item)
                                                            <div class="C-appraisal-content-footer-block">
                                                                <dl class="C-appraisal-content-footer-block__inner">
                                                                    <dt class="C-appraisal-content-footer-block__title fcolor2">{{ $planetExplain->get('planet')->name }} - {{ $planets->where('id', $item->to_planet_id)->pluck('name')->first() }}</dt>
                                                                    <dd class="C-appraisal-content-footer-block__text">
                                                                        {!! nl2br($item->content) !!}
                                                                    </dd>
                                                                </dl>
                                                                <div class="C-appraisal-content-footer-block__last">
                                                                    <p class="C-appraisal-content-footer-block__last__mark C-appraisal-content-footer-block__last__mark--{{ $zodiacs->where('id', $planetExplain->get('zodiac_pattern')->zodiac_id)->pluck('class_name')->first() }}"></p>
                                                                    <p class="C-appraisal-content-footer-block__last__text font">{{ $planetExplain->get('planet')->name_en }} - {{ $planets->where('id', $item->to_planet_id)->pluck('name_en')->first() }}</p>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endfor
											</div>
										</div>
									@endforeach
									<div class="C-appraisal-content C-appraisal-content--other C-appraisal-content--ririsu">
										<div class="C-appraisal-content-header">
											<h3 class="C-appraisal-content-header__title fcolor2 mincho">幼児期から変わらない、<br class="pc">素のあなた。</h3>
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

							{{-- 製本バナー --}}
							@include('components.parts.user.appraisal_apply_common_baner')

							{{-- 個人鑑定履歴 --}}
							<div class="C-appraisal-history">
								<h3 class="C-appraisal-history__title"><span>個人鑑定履歴</span></h3>
								<div class="C-appraisal-history__inner">
									@foreach ($allAppraisalApplies as $appraisalApply)
									<div class="C-appraisal-history-block">
										<a href="{{ route('user.appraisals.showPersonalAppraisal', $appraisalApply) }}">
											<time class="C-appraisal-history-block__time" datetime="{{ $appraisalApply->birthday->format('Y.m.d') }}">
											{{ $appraisalApply->birthday->format('Y.m.d') }}
												</time>
											<p class="C-appraisal-history-block__title">
												{{ $appraisalApply->reference->full_name }}さんの個人鑑定
											</p>
										</a>
									</div>
									@endforeach
								</div>
							</div>

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
