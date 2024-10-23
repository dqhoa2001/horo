<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Module Horoscope</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+SC&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Alex+Brush&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Beau+Rivage&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Old+Standard+TT:ital@1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Zeyada&display=swap" rel="stylesheet">
    {{-- {{ module_vite('build-horoscope', 'Resources/views/assets/css/mydowload.css') }} --}}

    {{-- <link rel="stylesheet" href="{{ asset('/assets/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/class.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/pdf.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/pdf2.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/a4print.css') }}"> --}}

    <link rel="stylesheet" href="{{ public_path('/assets/css/reset.css') }}">
    <link rel="stylesheet" href="{{ public_path('/assets/css/class.css') }}">
    <link rel="stylesheet" href="{{ public_path('/assets/css/pdf.css') }}">
    <link rel="stylesheet" href="{{ public_path('/assets/css/pdf2.css') }}">
    <link rel="stylesheet" href="{{ public_path('/assets/css/a4print.css') }}">

</head>

<body>
    @php
        $totalLength = [];
        $sunAspectFirstPage = [];
        $moonAspectFirstPage = [];
        $mercuryAspectFirstPage = [];
        $venusAspectFirstPage = [];
        $marsAspectFirstPage = [];
        $jupiterAspectFirstPage = [];
        $saturnAspectFirstPage = [];
        $planets = $explain->keys();
        $sortAspect =[];

        foreach ($planets as $planet) {
            $aspectPattern = $explain->get($planet)->get('aspect_pattern')->sortByDesc(function ($item) {
                return mb_strlen($item->content ?? '', 'UTF-8');
            })->values();
            $sortAspect[$planet] = $aspectPattern;
            $explain->get($planet)->put('aspect_pattern', $aspectPattern);

            $contentSolarLengths = []; 
            foreach ($aspectPattern as $key => $item) {
                $contentSolarLengths[$key] = mb_strlen($item->content ?? '', 'UTF-8');
            }
            $totalLength[$planet]['key01'] = array_sum(array_slice($contentSolarLengths, 0, 2));
            $totalLength[$planet]['key23'] = array_sum(array_slice($contentSolarLengths, 2, 2));

            $length[$planet] = array_slice($contentSolarLengths, 0, 4);
        }
    @endphp
    <div class="basewidth">
        @php
            $page = 1;
        @endphp
        <div class="page page0" style="position: relative">
			<div class="page__inner">
				<div class="page0-header">
					{{-- <p class="page0-header__name">HOSHI NO MAI</p> --}}
					<p class="page0-header__name"></p>
					<p class="page0-header__catchcopy handfont1">
                        {{-- <img src="{{ public_path('/assets/images/cathcopy2.svg') }}" alt="Know the universe , Live your life"> --}}
                    </p>
				</div>
				<div class="page0-pdftitle">
                    {{-- <img src="{{ public_path('/assets/images/logo_text2.svg') }}" alt="STELLAR BLUEPRINT"> --}}
                </div>
				<p class="page0-header__logo">
                    {{-- <img src="{{ public_path('/assets/images/logo2.svg') }}" alt="HOSI NO MAI"> --}}
                </p>
				<div class="page0-footer">
					{{-- <p class="page0-footer__text">Blueprint of</p> --}}
					{{-- <p class="page0-footer__text"></p> --}}

                    <p class="page0-footer__name">{{ $formData['bookbinding_name'] }}</p>
                </div>
			</div>
		</div>
        <div class="page-break-before"></div>
        <div class="page page01">
			<div class="page__inner">
				<div class="page01-header">
					<p class="page01-header__logo"><img src="{{ public_path('/assets/images/logo1.svg') }}" alt="HOSI NO MAI"></p>
					<p class="page01-header__name">HOSHI NO MAI</p>
					<p class="page01-header__catchcopy handfont1">
                        <img src="{{ public_path('/assets/images/Know〜.png') }}" alt="Know the universe , Live your life">
                    </p>
				</div>
				<div class="page01-pdftitle"><img src="{{ public_path('/assets/images/logo_text1.svg') }}" alt="STELLAR BLUEPRINT"></div>
				<div class="page01-footer">
					<p class="page01-footer__text">Blueprint of</p>
					<p class="page01-footer__name">{{ $formData['bookbinding_name'] }}</p>
				</div>
			</div>
		</div>
        <div class="page-break-before"></div>
        <div class="page page1 page--bg page--number page--number_right" data-pageno="">
            <div class="page__inner">
                {{-- <p class="page1__title">As above, so below.</p> --}}
            </div>
        </div>
        @php
            $page++;
        @endphp
        <div class="page-break-before"></div>
        <div class="page page2 page--bg page--number page--number_right" data-pageno="">
            <div class="page__inner">
                {{-- <p class="page2__text">"上なるもののごとく、下なるものはあり"</p>
                <p class="page2__text">
                    あなたが生まれたとき、星々がどんな状態だったかを知っていますか？<br>あなたが「どんな星の元に生まれたか」を知ることは、<br>あなたの「魂のブループリント」を知ることでもあります。<br>星のエネルギーが魂に転写されて、あなたの唯一無二の個性を紡ぎあげているのです。
                </p>
                <p class="page2__text">わたしの願いは、多くの人が、自分の生まれた時の星の配置を知ることで、<br>自分の人生を星々のようにさらに輝かせて生きていくことです。</p>
                <p class="page2__text">西洋占星術は古代シュメール時代にその原型ができ、<br>ヘレニズム時代に今の形になったといわれます。</p>
                <p class="page2__text">長い歴史を経て、現代にまで継承され続けた秘密の情報でもあるのです。</p>
                <p class="page2__text">このシステムをつくった海部舞は、2014 年に西洋占星術に出会い、<br>その情報の深遠さ、素晴らしさに魅了された、日本に住む一介の占星術師です。</p>
                <p class="page2__text">自分のホロスコープを知り、自己認識を深め、理想の誰かとか、親が望む誰かではない、<br>自分自身を真っすぐに生きることの重要性に気がつきました。</p>
                <p class="page2__text">そのおかげで人生が大きく変わり、精神的にも大きく成長することができました。</p>
                <p class="page2__text">人生を誰かのせいにしなくなり、他者の人生や価値観に寛容になることができ、<br>自分と宇宙を信頼して生きることができるようになりました。</p>
                <p class="page2__text">魂のブループリントを知ることで、「わたしとして生まれてよかった！」と思える人が一人でも増えることを願っています。</p>
                <p class="page2__text page2__name">海部 舞</p> --}}
            </div>
        </div>
        @php
            $page++;
        @endphp
        <div class="page-break-before"></div>
        <div class="page page3 page--content page--number page--number_left" data-pageno="{{ $page++ }}">
            <div class="page__inner" style="padding-bottom: 2rem;">
                <div class="page-block" style="margin-bottom: 2rem !important">
                    <p class="page-block__title" style="margin-bottom: 0.8rem !important">生まれた時の天体の情報を読み解く</p>
                    <p class="page__text" style="font-size: 0.9rem">
                        <span>このStella Blueprint
                            に掲載するのは、月、水星、金星、太陽、火星、木星、土星の情報をメインとしています。また、ドラゴンヘッドという月と太陽の軌道が交わるポイントから分かる、あなたの魂の課題やAC
                            と呼ばれる東の地平線、MC と呼ばれる天頂の星座から分かることなどをお伝えします。</span>
                        <span>各天体や感受点にはそれぞれ、個人に影響を及ぼすテーマと、天体の性質が最も強く現れる「年齢域」があります。また、それぞれの天体が、生まれた時にどのサイン（12
                            星座）にあり、どのハウスにあるか、他の天体とどんな角度をとっているか、といった情報を総合的に見ていくことになります。</span>
                    </p>
                </div>
                <div class="page-block" style="margin-bottom: 2rem !important">
                    <p class="page-block__title" style="margin-bottom: 0.8rem !important">サイン</p>
                    <p class="page__text" style="font-size: 0.9rem">
                        <span>サイン（星座）とはいわゆる１２星座のことですが、西洋占星術では生まれた時の星の配置から、すべての星がサインを持っています。そのサインは、それぞれの天体が持つ特性や感受性をあらわしています。舞台であらわすと、登場人物の性格（キャラクター）がサインです。</span>
                    </p>
                </div>
                <div class="page-block" style="margin-bottom: 2rem !important">
                    <p class="page-block__title" style="margin-bottom: 0.8rem !important">ハウス</p>
                    <p class="page__text" style="font-size: 0.9rem">
                        <span>ハウスというのは、東の地平線から順番に1 日の流れ（24
                            時間）を時間を基準に割ったもので、より地上的な領域にかかわります。あなたがその天体のテーマをどのような領域で学び、サインの特性をどのような場で発揮していくのかをあらわします。舞台の背景にあたるのがハウスです。</span>
                        <span>なお、通常ハウスを読む際は５度前ルール（ハウスの切り替わりの位置の５度前から次のハウスとして読む）を採用することが多いですが、今回はシステムの都合上５度前ルールとはなっておりません。とはいえ、ハウスの境目はグラデーション的で明確な切り替わりラインというのはないため、特に違和感なく読むことが出来ると思います。</span>
                    </p>
                </div>
                <div class="page-block" style="margin-bottom: 2rem !important">
                    <p class="page-block__title" style="margin-bottom: 0.8rem !important">天体の年齢域</p>
                    <p class="page__text" style="font-size: 0.9rem">
                        <span>年齢域とはその天体のエネルギーが最も強く影響する年代をあらわします。私たちは成長しながら、一つ一つの天体の学びをしていくという考えが西洋占星術にはあります。</span>
                        <span>この鑑定書には、年齢域の小さい順に月から解説をしていきますので、幼少期のあなた（月）、学童期（水星）、思春期（金星）…と順番に読んでいくことで、あなたの特性がどのように変化をしていき、どのような体験をし、どのような学びをし、どのような能力を手に入れるかをこれまでの人生の答え合わせをするかのように理解できます。また、年齢域を過ぎた天体はずっとあなたの中に記憶や経験、特性として残り続けますし、天体同士の響き合いによってその後も学びなおしをすることがあります。</span>
                        <span>さらに、現在の年齢域の天体を見ることで、現在のあなたがどのような体験をし、どう成長していくかを知ることが出来ますし、まだ先の年齢域の天体は「これからそうなるのだ」と考えるようにします。</span>
                        <span>この「年齢域」という考えは非常に重要になりますので必ず理解をしてください。</span>
                    </p>
                </div>
                <div class="page-block" style="margin-bottom: 2rem !important">
                    <p class="page-block__title" style="margin-bottom: 0.8rem !important">アスペクト</p>
                    <p class="page__text" style="font-size: 0.9rem">
                        <span>この鑑定書では、星同士が特定の角度を作った際にできる「アスペクト」からの影響も読み解きます。この意味がよく分からなくても、記された内容にはハッとすることが多いのではないかと思います。</span>
                        <span>なお、この項目に何も出てこなかった場合、他の天体とつながりがなくノーアスペクトと呼ばれ、その天体の意味するテーマの発揮のしかたがわからなくなるとされます。</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="page-break-before"></div>
        <div class="page page4 page--content page--number page--number_right" data-pageno="{{ $page++ }}">
            <div class="page__inner">
                <div class="page-block">
                    <p class="page-block__title">サビアン占星術という新しい技法</p>
                    <p class="page__text">
                        <span>さらに、ここには、サビアンシンボルの情報も掲載しています。</span>
                        <span>サビアンシンボルとは、12
                            星座の度数ごとのエネルギーを詩的な文章であらわしたもので、1925年にアメリカのマーク・エドモンド・ジョーンズという占星術家が、エリス・フィラーという霊能者と共に12サインの各度数から浮かび上がるイメージを記録していく実験を行ったところから生まれています。</span>
                        <span>サビアンシンボルの「サビアン」とは、この実験時にエリスが古代メソポタミアのハッラーンというエリアに住んでいた「サービア人」の助けを借りたと証言したことから名づけられています。面白いですね。</span>
                        <span>なお、サビアンシンボルにはジョーンズ版とその後ディーン・ルディアによって改訂されたルディア版がありますが、本書はエリスフィラーの言葉を純粋に採用することを大切に考えるためにジョーンズ版を用いています。ルディア版に親しんでいる方には違和感がある可能性もありますが、ご理解いただけますと幸いです。</span>
                        <span>監修者の海部舞はこのサビアンシンボルを鑑定の際に非常に重視しており、各天体ごとの解説の中にサビアンシンボルとその解釈も掲載しています。サビアンシンボルを取り入れることで、各天体のテーマやその天体の年齢域の体験をかなり具体的に理解できるようになります。</span>
                    </p>
                    <p class="page__text">
                        <span>なお、本鑑定書では、天体ではない「感受点」と呼ばれるものも解釈をしていきますが、これらは12サインの度数にずれが生じやすいため、サビアンシンボルは天体の解釈のみでしか採用していません。</span>
                    </p>
                </div>
                <div class="page-block">
                    <p class="page-block__title">鑑定書を読む際に意識して欲しいこと</p>
                    <p class="page__text">
                        <span>これを読む中で、おそらくあなたにはいろいろな感情が沸き起こることと思います。</span>
                        <span>「すごい！その通りだ！」と思う場合もあれば、現状からはとても遠く感じられて、「本当だろうか？」と思うこともあるでしょう。もしくはあなたの生きにくさや痛みが書かれていることもあるでしょう。</span>
                        <span>ここに書かれていることは、あなたの魂の設定であり、遺伝子の情報に似たものです。それを生かすか、気が付かずに使わないで生きるかはあなた次第。</span>
                        <span>この、星のブループリントが、あなたの本来の可能性にスイッチを入れる役割となることを願っています。また、過去の苦しい体験も生きにくさも、すべて何かを学ぶためだった、魂の設定だった、とわかると、癒しが起こります。そのような、心の昇華体験にもつながると幸いです。</span>
                    </p>
                </div>
                <div class="page4-end">
                    <p class="page4-end__english">Now, let's take a look at your blueprint, the unique harmony woven by
                        the
                        stars.</p>
                    <p class="page4-end__text">さぁ、それでは、星々が織りなす唯一無二のハーモニー、あなたのブループリントを見ていきましょう。</p>
                </div>
            </div>
        </div>
        <div class="page-break-before"></div>
        <div class="page page5 page--number page--number_left" data-pageno="{{ $page++ }}">
            <div class="page__inner">
                <p class="page5__title"><span>YOUR HOROSCOPE</span></p>
                <div class="page5-data">
                    <p class="page5-data__day">
                        {{ $formData['year'] }}年{{ $formData['month'] }}月{{ $formData['day'] }}日
                    </p>
                    <p class="page5-data__time">{{ $formData['hour'] }}時{{ $formData['minute'] }}分</p>
                    <p class="page5-data__country">{{ $formData['map-city'] }}</p>
                    {{-- <p class="page5-data__city">ニャチャン市</p> --}}
                </div>
                <div class="page5-horoscope"><img src="data:image/png;base64, {{ $image }}"
                        style="max-width: 800px" alt="horoscope"></div>
            </div>
        </div>
        <div class="page-break-before"></div>
        <div class="page page6 page--number page--number_right" data-pageno="{{ $page++ }}">
            <div class="page__inner">
                <div class="page6-data">
					<div class="page6-data-position">
						<p class="page6-data__title">Position</p>
						<div class="page6-data__inner">
							<div class="page6-data-position__item">
								<p class="page6-data-position__title page6-data-position__title--sun"><span>太陽</span></p>
								<p class="page6-data-position__text page6-data-position__text--{{$zodaics->where('id', $degreeData->get('planets')->get('0')->get('zodiac_num'))->pluck('name_en')->first()}}"><span>{{$zodaics->where('id', $degreeData->get('planets')->get('0')->get('zodiac_num'))->pluck('name')->first()}} {{ $degreeData->get('planets')->get('0')->get('sabian_degrees_dms')->get('degrees') . '°' . $degreeData->get('planets')->get('0')->get('sabian_degrees_dms')->get('minnute') . "'" . $degreeData->get('planets')->get('0')->get('sabian_degrees_dms')->get('second') . '"' }}</span></p>
							</div>
							<div class="page6-data-position__item">
								<p class="page6-data-position__title page6-data-position__title--moon"><span>月</span></p>
								<p class="page6-data-position__text page6-data-position__text--{{$zodaics->where('id', $degreeData->get('planets')->get('1')->get('zodiac_num'))->pluck('name_en')->first()}}"><span>{{$zodaics->where('id', $degreeData->get('planets')->get('1')->get('zodiac_num'))->pluck('name')->first()}} {{ $degreeData->get('planets')->get('1')->get('sabian_degrees_dms')->get('degrees') . '°' . $degreeData->get('planets')->get('1')->get('sabian_degrees_dms')->get('minnute') . "'" . $degreeData->get('planets')->get('1')->get('sabian_degrees_dms')->get('second') . '"' }}</span></p>
							</div>
							<div class="page6-data-position__item">
								<p class="page6-data-position__title page6-data-position__title--mercury"><span>水星</span></p>
								<p class="page6-data-position__text page6-data-position__text--{{$zodaics->where('id', $degreeData->get('planets')->get('2')->get('zodiac_num'))->pluck('name_en')->first()}}"><span>{{$zodaics->where('id', $degreeData->get('planets')->get('2')->get('zodiac_num'))->pluck('name')->first()}} {{ $degreeData->get('planets')->get('2')->get('sabian_degrees_dms')->get('degrees') . '°' . $degreeData->get('planets')->get('2')->get('sabian_degrees_dms')->get('minnute') . "'" . $degreeData->get('planets')->get('2')->get('sabian_degrees_dms')->get('second') . '"' }}</span></p>
							</div>
							<div class="page6-data-position__item">
								<p class="page6-data-position__title page6-data-position__title--venus"><span>金星</span></p>
								<p class="page6-data-position__text page6-data-position__text--{{$zodaics->where('id', $degreeData->get('planets')->get('3')->get('zodiac_num'))->pluck('name_en')->first()}}"><span>{{$zodaics->where('id', $degreeData->get('planets')->get('3')->get('zodiac_num'))->pluck('name')->first()}} {{ $degreeData->get('planets')->get('3')->get('sabian_degrees_dms')->get('degrees') . '°' . $degreeData->get('planets')->get('3')->get('sabian_degrees_dms')->get('minnute') . "'" . $degreeData->get('planets')->get('3')->get('sabian_degrees_dms')->get('second') . '"' }}</span></p>
							</div>
							<div class="page6-data-position__item">
								<p class="page6-data-position__title page6-data-position__title--mars"><span>火星</span></p>
								<p class="page6-data-position__text page6-data-position__text--{{$zodaics->where('id', $degreeData->get('planets')->get('4')->get('zodiac_num'))->pluck('name_en')->first()}}"><span>{{$zodaics->where('id', $degreeData->get('planets')->get('4')->get('zodiac_num'))->pluck('name')->first()}} {{ $degreeData->get('planets')->get('4')->get('sabian_degrees_dms')->get('degrees') . '°' . $degreeData->get('planets')->get('4')->get('sabian_degrees_dms')->get('minnute') . "'" . $degreeData->get('planets')->get('4')->get('sabian_degrees_dms')->get('second') . '"' }}</span></p>
							</div>
							<div class="page6-data-position__item">
								<p class="page6-data-position__title page6-data-position__title--jupiter"><span>木星</span></p>
								<p class="page6-data-position__text page6-data-position__text--{{$zodaics->where('id', $degreeData->get('planets')->get('5')->get('zodiac_num'))->pluck('name_en')->first()}}"><span>{{$zodaics->where('id', $degreeData->get('planets')->get('5')->get('zodiac_num'))->pluck('name')->first()}} {{ $degreeData->get('planets')->get('5')->get('sabian_degrees_dms')->get('degrees') . '°' . $degreeData->get('planets')->get('5')->get('sabian_degrees_dms')->get('minnute') . "'" . $degreeData->get('planets')->get('5')->get('sabian_degrees_dms')->get('second') . '"' }}</span></p>
							</div>
							<div class="page6-data-position__item">
								<p class="page6-data-position__title page6-data-position__title--saturn"><span>土星</span></p>
								<p class="page6-data-position__text page6-data-position__text--{{$zodaics->where('id', $degreeData->get('planets')->get('6')->get('zodiac_num'))->pluck('name_en')->first()}}"><span>{{$zodaics->where('id', $degreeData->get('planets')->get('6')->get('zodiac_num'))->pluck('name')->first()}} {{ $degreeData->get('planets')->get('6')->get('sabian_degrees_dms')->get('degrees') . '°' . $degreeData->get('planets')->get('6')->get('sabian_degrees_dms')->get('minnute') . "'" . $degreeData->get('planets')->get('6')->get('sabian_degrees_dms')->get('second') . '"' }}</span></p>
							</div>
							<div class="page6-data-position__item">
								<p class="page6-data-position__title page6-data-position__title--uranus"><span>天王星</span></p>
								<p class="page6-data-position__text page6-data-position__text--{{$zodaics->where('id', $degreeData->get('planets')->get('7')->get('zodiac_num'))->pluck('name_en')->first()}}"><span>{{$zodaics->where('id', $degreeData->get('planets')->get('7')->get('zodiac_num'))->pluck('name')->first()}} {{ $degreeData->get('planets')->get('7')->get('sabian_degrees_dms')->get('degrees') . '°' . $degreeData->get('planets')->get('7')->get('sabian_degrees_dms')->get('minnute') . "'" . $degreeData->get('planets')->get('7')->get('sabian_degrees_dms')->get('second') . '"' }}</span></p>
							</div>
							<div class="page6-data-position__item">
								<p class="page6-data-position__title page6-data-position__title--neptune"><span>海王星</span></p>
								<p class="page6-data-position__text page6-data-position__text--{{$zodaics->where('id', $degreeData->get('planets')->get('8')->get('zodiac_num'))->pluck('name_en')->first()}}"><span>{{$zodaics->where('id', $degreeData->get('planets')->get('8')->get('zodiac_num'))->pluck('name')->first()}} {{ $degreeData->get('planets')->get('8')->get('sabian_degrees_dms')->get('degrees') . '°' . $degreeData->get('planets')->get('8')->get('sabian_degrees_dms')->get('minnute') . "'" . $degreeData->get('planets')->get('8')->get('sabian_degrees_dms')->get('second') . '"' }}</span></p>
							</div>
							<div class="page6-data-position__item">
								<p class="page6-data-position__title page6-data-position__title--pluto"><span>冥王星</span></p>
								<p class="page6-data-position__text page6-data-position__text--{{$zodaics->where('id', $degreeData->get('planets')->get('9')->get('zodiac_num'))->pluck('name_en')->first()}}"><span>{{$zodaics->where('id', $degreeData->get('planets')->get('9')->get('zodiac_num'))->pluck('name')->first()}} {{ $degreeData->get('planets')->get('9')->get('sabian_degrees_dms')->get('degrees') . '°' . $degreeData->get('planets')->get('9')->get('sabian_degrees_dms')->get('minnute') . "'" . $degreeData->get('planets')->get('9')->get('sabian_degrees_dms')->get('second') . '"' }}</span></p>
							</div>
							<div class="page6-data-position__item">
								<p class="page6-data-position__title page6-data-position__title--dragonhead"><span>ドラゴンヘッド</span></p>
								<p class="page6-data-position__text page6-data-position__text--{{$zodaics->where('id', $degreeData->get('planets')->get('10')->get('zodiac_num'))->pluck('name_en')->first()}}"><span>{{$zodaics->where('id', $degreeData->get('planets')->get('10')->get('zodiac_num'))->pluck('name')->first()}} {{ $degreeData->get('planets')->get('10')->get('sabian_degrees_dms')->get('degrees') . '°' . $degreeData->get('planets')->get('10')->get('sabian_degrees_dms')->get('minnute') . "'" . $degreeData->get('planets')->get('10')->get('sabian_degrees_dms')->get('second') . '"' }}</span></p>
							</div>
							<div class="page6-data-position__item">
								<p class="page6-data-position__title page6-data-position__title--kiron"><span>キロン</span></p>
								<p class="page6-data-position__text page6-data-position__text--{{$zodaics->where('id', $degreeData->get('planets')->get('11')->get('zodiac_num'))->pluck('name_en')->first()}}"><span>{{$zodaics->where('id', $degreeData->get('planets')->get('11')->get('zodiac_num'))->pluck('name')->first()}} {{ $degreeData->get('planets')->get('11')->get('sabian_degrees_dms')->get('degrees') . '°' . $degreeData->get('planets')->get('11')->get('sabian_degrees_dms')->get('minnute') . "'" . $degreeData->get('planets')->get('11')->get('sabian_degrees_dms')->get('second') . '"' }}</span></p>
							</div>
							<div class="page6-data-position__item">
								<p class="page6-data-position__title page6-data-position__title--ririsu"><span>リリス</span></p>
								<p class="page6-data-position__text page6-data-position__text--{{$zodaics->where('id', $degreeData->get('planets')->get('12')->get('zodiac_num'))->pluck('name_en')->first()}}"><span>{{$zodaics->where('id', $degreeData->get('planets')->get('12')->get('zodiac_num'))->pluck('name')->first()}} {{ $degreeData->get('planets')->get('12')->get('sabian_degrees_dms')->get('degrees') . '°' . $degreeData->get('planets')->get('12')->get('sabian_degrees_dms')->get('minnute') . "'" . $degreeData->get('planets')->get('12')->get('sabian_degrees_dms')->get('second') . '"' }}</span></p>
							</div>
						</div>
					</div>
					<div class="page6-data-boundarie">
						<p class="page6-data__title">Boundarie</p>
						<div class="page6-data__inner">
							<p class="page6-data-boundarie__text page6-data-boundarie__boundarie--ac" data-tag="AC"><span>{{ $zodaics->where('id', $degreeData->get('houses')->get('0')->get('zodiac_num'))->pluck('name')->first() }}  {{ $degreeData->get('houses')->get('0')->get('sabian_degrees_dms')->get('degrees') . '°' . $degreeData->get('houses')->get('0')->get('sabian_degrees_dms')->get('minnute') . "'" . $degreeData->get('houses')->get('0')->get('sabian_degrees_dms')->get('second') . '"' }}</span></p>
							<p class="page6-data-boundarie__text page6-data-boundarie__boundarie--2" data-tag="2ハウス"><span>{{ $zodaics->where('id', $degreeData->get('houses')->get('1')->get('zodiac_num'))->pluck('name')->first() }} {{ $degreeData->get('houses')->get('1')->get('sabian_degrees_dms')->get('degrees') . '°' . $degreeData->get('houses')->get('1')->get('sabian_degrees_dms')->get('minnute') . "'" . $degreeData->get('houses')->get('1')->get('sabian_degrees_dms')->get('second') . '"' }}</span></p>
							<p class="page6-data-boundarie__text page6-data-boundarie__boundarie--3" data-tag="3ハウス"><span>{{ $zodaics->where('id', $degreeData->get('houses')->get('2')->get('zodiac_num'))->pluck('name')->first() }} {{ $degreeData->get('houses')->get('2')->get('sabian_degrees_dms')->get('degrees') . '°' . $degreeData->get('houses')->get('2')->get('sabian_degrees_dms')->get('minnute') . "'" . $degreeData->get('houses')->get('2')->get('sabian_degrees_dms')->get('second') . '"' }}</span></p>
							<p class="page6-data-boundarie__text page6-data-boundarie__boundarie--4" data-tag="4ハウス"><span>{{ $zodaics->where('id', $degreeData->get('houses')->get('3')->get('zodiac_num'))->pluck('name')->first() }} {{ $degreeData->get('houses')->get('3')->get('sabian_degrees_dms')->get('degrees') . '°' . $degreeData->get('houses')->get('3')->get('sabian_degrees_dms')->get('minnute') . "'" . $degreeData->get('houses')->get('3')->get('sabian_degrees_dms')->get('second') . '"' }}</span></p>
							<p class="page6-data-boundarie__text page6-data-boundarie__boundarie--5" data-tag="5ハウス"><span>{{ $zodaics->where('id', $degreeData->get('houses')->get('4')->get('zodiac_num'))->pluck('name')->first() }} {{ $degreeData->get('houses')->get('4')->get('sabian_degrees_dms')->get('degrees') . '°' . $degreeData->get('houses')->get('4')->get('sabian_degrees_dms')->get('minnute') . "'" . $degreeData->get('houses')->get('4')->get('sabian_degrees_dms')->get('second') . '"' }}</span></p>
							<p class="page6-data-boundarie__text page6-data-boundarie__boundarie--6" data-tag="6ハウス"><span>{{ $zodaics->where('id', $degreeData->get('houses')->get('5')->get('zodiac_num'))->pluck('name')->first() }} {{ $degreeData->get('houses')->get('5')->get('sabian_degrees_dms')->get('degrees') . '°' . $degreeData->get('houses')->get('5')->get('sabian_degrees_dms')->get('minnute') . "'" . $degreeData->get('houses')->get('5')->get('sabian_degrees_dms')->get('second') . '"' }}</span></p>
							<p class="page6-data-boundarie__text page6-data-boundarie__boundarie--7" data-tag="7ハウス"><span>{{ $zodaics->where('id', $degreeData->get('houses')->get('6')->get('zodiac_num'))->pluck('name')->first() }} {{ $degreeData->get('houses')->get('6')->get('sabian_degrees_dms')->get('degrees') . '°' . $degreeData->get('houses')->get('6')->get('sabian_degrees_dms')->get('minnute') . "'" . $degreeData->get('houses')->get('6')->get('sabian_degrees_dms')->get('second') . '"' }}</span></p>
							<p class="page6-data-boundarie__text page6-data-boundarie__boundarie--8" data-tag="8ハウス"><span>{{ $zodaics->where('id', $degreeData->get('houses')->get('7')->get('zodiac_num'))->pluck('name')->first() }} {{ $degreeData->get('houses')->get('7')->get('sabian_degrees_dms')->get('degrees') . '°' . $degreeData->get('houses')->get('7')->get('sabian_degrees_dms')->get('minnute') . "'" . $degreeData->get('houses')->get('7')->get('sabian_degrees_dms')->get('second') . '"' }}</span></p>
							<p class="page6-data-boundarie__text page6-data-boundarie__boundarie--9" data-tag="9ハウス"><span>{{ $zodaics->where('id', $degreeData->get('houses')->get('8')->get('zodiac_num'))->pluck('name')->first() }} {{ $degreeData->get('houses')->get('8')->get('sabian_degrees_dms')->get('degrees') . '°' . $degreeData->get('houses')->get('8')->get('sabian_degrees_dms')->get('minnute') . "'" . $degreeData->get('houses')->get('8')->get('sabian_degrees_dms')->get('second') . '"' }}</span></p>
							<p class="page6-data-boundarie__text page6-data-boundarie__boundarie--mc" data-tag="MC"><span>{{ $zodaics->where('id', $degreeData->get('houses')->get('9')->get('zodiac_num'))->pluck('name')->first() }} {{ $degreeData->get('houses')->get('9')->get('sabian_degrees_dms')->get('degrees') . '°' . $degreeData->get('houses')->get('9')->get('sabian_degrees_dms')->get('minnute') . "'" . $degreeData->get('houses')->get('9')->get('sabian_degrees_dms')->get('second') . '"' }}</span></p>
							<p class="page6-data-boundarie__text page6-data-boundarie__boundarie--11" data-tag="11ハウス"><span>{{ $zodaics->where('id', $degreeData->get('houses')->get('10')->get('zodiac_num'))->pluck('name')->first() }} {{ $degreeData->get('houses')->get('10')->get('sabian_degrees_dms')->get('degrees') . '°' . $degreeData->get('houses')->get('10')->get('sabian_degrees_dms')->get('minnute') . "'" . $degreeData->get('houses')->get('10')->get('sabian_degrees_dms')->get('second') . '"' }}</span></p>
							<p class="page6-data-boundarie__text page6-data-boundarie__boundarie--12" data-tag="12ハウス"><span>{{ $zodaics->where('id', $degreeData->get('houses')->get('11')->get('zodiac_num'))->pluck('name')->first() }} {{ $degreeData->get('houses')->get('11')->get('sabian_degrees_dms')->get('degrees') . '°' . $degreeData->get('houses')->get('11')->get('sabian_degrees_dms')->get('minnute') . "'" . $degreeData->get('houses')->get('11')->get('sabian_degrees_dms')->get('second') . '"' }}</span></p>
							<p class="page6-data-boundarie__text page6-data-boundarie__boundarie--13"></p>
						</div>
					</div>
				</div>
            </div>
        </div>
        <div class="page-break-before"></div>
        <div class="page page7 page--cover page--cover-foot page--number page--number_right"
            data-pageno="" data-title="AC">
            <div class="page__inner" style="height: 460px;">
                <p class="page--cover__title"><span>AC</span></p>
                <div class="page--cover-block1">
                    <p class="page--cover-block1__title">見た目や癖、振る舞いなど</p>
                    <p class="page__text">
                        <span>アセンダントとは生まれた時の東の地平線の位置をさし、ここにあった星座が、あなたの見た目の印象やもって生まれた感受性、無意識的な素質などをあらわします。</span>
                        <span>普段初対面の人にどう見られるか、無意識的にどうふるまっているか、といったことがアセンダントの星座の特徴に当てはまることが多いでしょう。</span>
                    </p>
                </div>
                <div class="page-block page-block--1">
                    @foreach ($degreeData->get('houses') as $house)
                        @if ($house->get('number') == 1)
                            <p class="page-block--1__title">
                                <span
                                    class="icon-sign icon-sign--{{ $zodaics->where('id', $house->get('zodiac_num'))->pluck('name_en')->first() }}">ACサイン
                                    {{ $zodaics->where('id', $house->get('zodiac_num'))->pluck('name')->first() }}</span>
                                <span
                                    class="handfont1">{{ $zodaics->where('id', $house->get('zodiac_num'))->pluck('name_en')->first() }}</span>
                            </p>
                            <p class="page__text">
                                <span style="text-indent: 0;">
                                    {!! nl2br($zodaicsPattern->where('zodiac_id', $house->get('zodiac_num'))->where('planet_id', 14)->pluck('content')->first()) !!}</span>
                            </p>
                        @endif
                    @endforeach
                </div>
                <span class="page--cover__frame"></span>
            </div>
        </div>
        @php
            $page++;
        @endphp
        <div class="page-break-before"></div>
        <div class="page page8 page--cover page--cover-foot page--number page--number_right"
            data-pageno="" data-title="MC">
            <div class="page__inner" style="height: 460px;">
                @foreach ($degreeData->get('houses') as $house)
                    @if ($house->get('number') == 10)
                        <p class="page--cover__title"><span>MC</span></p>
                        <div class="page--cover-block1">
                            <p class="page--cover-block1__title">周囲があなたをどう見るか、社会的な役割や達成点</p>
                            <p class="page__text">
                                <span>MCはあなたが生まれた時の天頂の位置にあった星座であり、この星座はあなたが社会の役割を果たすために使うことのできるスキルや周囲から社会的に期待されることと関係します。</span>
                                <span>これまでの社会経験と照らし合わせてみると大きな気づきがあるでしょう。</span>
                            </p>
                        </div>
                        <div class="page-block page-block--1">
                            <p class="page-block--1__title">
                                <span
                                    class="icon-sign icon-sign--{{ $zodaics->where('id', $house->get('zodiac_num'))->pluck('name_en')->first() }}">MCサイン
                                    {{ $zodaics->where('id', $house->get('zodiac_num'))->pluck('name')->first() }}</span>
                                <span
                                    class="handfont1">{{ $zodaics->where('id', $house->get('zodiac_num'))->pluck('name_en')->first() }}</span>
                            </p>
                            <p class="page__text">
                                <span style="text-indent: 0;">{!! nl2br($zodaicsPattern->where('zodiac_id', $house->get('zodiac_num'))->where('planet_id', 15)->pluck('content')->first()) !!}</span>
                            </p>
                        </div>
                    @endif
                @endforeach
                <span class="page--cover__frame"></span>
            </div>
        </div>
        @php
            $page++;
        @endphp
        <div class="page-break-before"></div>
        {{-- <div class="page page9 page--bg page--number page--number_right" data-pageno="{{ $page++ }}"></div> --}}
        <div class="page-break-before"></div>
        <div class="page page10 page--cover page--moon page--number page--number_right"
            data-pageno="" data-title="Moon">
            <div class="page__inner">
                <p class="page--cover__title"><span>月</span></p>
                <div class="page--cover-block1">
                    <p class="page--cover-block1__title">幼児期から変わらない、素のあなた［0～7 歳］</p>
                    <p class="page__text">
                        <span>月は、あなたの幼少期（0～7
                            歳）に最も強く影響し、生まれもったあなたの無意識の力、素の性質などをあらわします。何に安心し、心が満たされるかにかかわるため、月の特性を大事にすることが、あなた自身をいたわることになります。</span>
                        <span>また、自分を大切にできるようになることで、自分自身が満たされ、草木がしっかりと根を張ってから外に伸びていくように、あなたが自分を社会に打ち出し、成長していくパワーとなっていくため、とても大切です。</span>
                        <span>月のサインやハウス、サビアンシンボルの特性を確認し、自分は日ごろそれを大切にできているか感じてみましょう。もしそういう部分をないがしろにしていたと感じたら、ぜひ暮らしの中で月を満たす時間を作りましょう。</span>
                        <span>また、月の鑑定内容を見ることで、子ども時代の自分を思い出すこともできるでしょう。</span>
                    </p>
                </div>
                <div class="page--cover__image moon"><svg></svg></div>
                <span class="page--cover__frame"></span>
            </div>
        </div>
        @php
            $page++;
        @endphp
        <div class="page-break-before"></div>
        <div class="page page11 page--content page--number page--number_left page--moon"
            data-pageno="{{ $page++ }}">
            <div class="page__inner">
                <div class="page-block page-block--1">
                    <p class="page-block--1__title">
                        <span
                            class="icon-sign icon-sign--{{ $explain->get('MOON')->get('zodiac_pattern')->zodiac->name_en }}">サイン
                            {{ $explain->get('MOON')->get('zodiac_pattern')->zodiac->name }}</span>
                        <span
                            class="handfont1">{{ $explain->get('MOON')->get('zodiac_pattern')->zodiac->name_en }}</span>
                    </p>
                    <p class="page__text">
                        <span style="text-indent: 0;">{!! nl2br($explain->get('MOON')->get('zodiac_pattern')->content) !!}</span>
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
                    @if (empty($explain->get('MOON')->get('sabian_pattern')))
                        <p class="page-block--3__title">これは特殊なケースです。 角度が0度の場合はサビアンは存在しません</p>
                    @else
                        <p class="page-block--3__title">
                            {{ $explain->get('MOON')->get('sabian_pattern')->zodiac->name }}{{ $explain->get('MOON')->get('sabian_pattern')->sabian_degrees }}
                            度「{{ $explain->get('MOON')->get('sabian_pattern')->title }}」</p>
                        <p class="page__text">
                            <span style="text-indent: 0;">{!! nl2br($explain->get('MOON')->get('sabian_pattern')->content) !!}</span>
                        </p>
                    @endif
                </div>
            </div>
        </div>
        <div class="page-break-before"></div>
        <div class="page page12 page--content page--number page--number_right page--moon"
            data-pageno="{{ $page++ }}">
            <div class="page__inner">
                <div class="page-block page-block--4">
                    <p class="page-block--4__title">
                        ハウス<span>{{ $explain->get('MOON')->get('house_pattern')->house->symbol }}</span></p>
                    <p class="page__text">
                        <span style="text-indent: 0;">{!! nl2br($explain->get('MOON')->get('house_pattern')->content) !!}</span>
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

                @php 
                    $moonHouse = mb_strlen($explain->get('MOON')->get('house_pattern')->content ?? '', 'UTF-8');
                    $key2 = mb_strlen($explain['MOON']['aspect_pattern'][2]->content ?? '', 'UTF-8');
                    $key3 = mb_strlen($explain['MOON']['aspect_pattern'][3]->content ?? '', 'UTF-8');
                    $moonKey01 = $totalLength['MOON']['key01'];
                    $moonKey23 = $totalLength['MOON']['key23'];
                @endphp

                <div class="page-block page-block--5">
                    {{-- @if (!$explain->get('MOON')->get('aspect_pattern')->isNotEmpty())
                        <p class="page__text">
                            <span>この天体は他の天体との関わりがなく、天体の力をうまく発揮できないとされます。</span>
                        </p>
                    @endif --}}
                    @if ($explain->get('MOON')->get('aspect_pattern')->isNotEmpty())
                        @foreach ($explain->get('MOON')->get('aspect_pattern') as $key => $item)
                            @if (is_null($item))
                                @if ($key == 0)
                                    <p class="page__text">
                                        <span>この天体は他の天体との関わりがなく、天体の力をうまく発揮できないとされます。</span>
                                    </p>
                                @else
                                    <p></p>
                                @endif
                            @else
                                @php
                                    switch (true) {
                                        case $moonKey01 > 300 && $moonKey01 <350:
                                            $show = ($moonHouse<160) ? ($moonKey23 < 280 ? 4 : 3) : ($moonKey23 < 50 ? 4 : 3);
                                            break;

                                        case $moonKey01 > 250 && $moonKey01 < 300 :
                                            $show = ($moonHouse<160) ? ($moonKey23 < 180 ? 4 : 3) : ($moonKey23 < 150 ? 4 : 3);
                                            break;

                                        case $moonKey01 > 350 && $moonKey01 <650:
                                            $show = ($moonHouse<160) ? ( $key2 < 120 ? 3 : 2) : ($key2 < 50 ? 3 : 2);
                                            break;
                                            
                                        case $moonKey01 > 50 && $moonKey01 < 250:
                                            $show = ($moonHouse<160) ? ($moonKey23 < 371 && $key2 > 150 ? 4 : 3) : ($moonKey23 < 50 ? 4 : 3);
                                            break;

                                        case $moonKey01 < 50:
                                            $show = ($moonHouse<160) ? ($moonKey23 < 371 && $key2 > 150 ? 4 : 3) : ($moonKey23 < 50 ? 4 : 3);
                                            break;
                                    }
                                @endphp

                                @if ($key < $show)
                                    <div class="page-block--5__half">
                                        <p class="planet page-block--5__title icon-sign icon-sign" style="font-size: 16px !important">
                                             <span>{{ $item->fromPlanet->symbol }}</span> @if ($item->aspect->symbol === 'q')
                                                <svg xmlns:dc="http://purl.org/dc/elements/1.1/"
                                                    xmlns:cc="http://creativecommons.org/ns#"
                                                    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                                                    xmlns:svg="http://www.w3.org/2000/svg"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
                                                    xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
                                                    width="12px" height="12px" viewBox="0 0 12 12" version="1.1"
                                                    id="svg9" sodipodi:docname="Pallas_symbol_(fixed_width).svg"
                                                    inkscape:version="0.92.5 (2060ec1f9f, 2020-04-08)"
                                                    style="margin-left: 5px ; margin-right: 5px">
                                                    <metadata id="metadata15">
                                                        <rdf:RDF>
                                                            <cc:Work rdf:about="">
                                                                <dc:format>image/svg+xml</dc:format>
                                                                <dc:type
                                                                    rdf:resource="http://purl.org/dc/dcmitype/StillImage" />
                                                            </cc:Work>
                                                        </rdf:RDF>
                                                    </metadata>
                                                    <defs id="defs13" />
                                                    <sodipodi:namedview pagecolor="#ffffff" bordercolor="#666666"
                                                        borderopacity="1" objecttolerance="10" gridtolerance="10"
                                                        guidetolerance="10" inkscape:pageopacity="0"
                                                        inkscape:pageshadow="2" inkscape:window-width="1920"
                                                        inkscape:window-height="1015" id="namedview11"
                                                        showgrid="false" inkscape:zoom="29.5" inkscape:cx="7.5762712"
                                                        inkscape:cy="5.9661012" inkscape:window-x="0"
                                                        inkscape:window-y="0" inkscape:window-maximized="1"
                                                        inkscape:current-layer="svg9" />
                                                    <path inkscape:connector-curvature="0" id="path4-3"
                                                        d="M 11.00025,6 H 0.99975"
                                                        style="fill:none;stroke: #748F9F;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        sodipodi:nodetypes="cc" />
                                                    <path inkscape:connector-curvature="0" id="path4-3-6-27-9"
                                                        d="m 6.0000002,6.0000001 2.499937,4.3300179"
                                                        style="fill:none;stroke: #748F9F;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        sodipodi:nodetypes="cc" />
                                                    <path inkscape:connector-curvature="0" id="path4-3-6-27-3"
                                                        d="M 3.5000629,1.6699816 5.9999993,5.9999992"
                                                        style="fill:none;stroke: #748F9F;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        sodipodi:nodetypes="cc" />
                                                    <path inkscape:connector-curvature="0" id="path4-3-6-1-6"
                                                        d="M 8.4999375,1.6699816 6.0000005,5.9999999"
                                                        style="fill:none;stroke: #748F9F;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        sodipodi:nodetypes="cc" />
                                                    <path inkscape:connector-curvature="0" id="path4-3-6-1-0"
                                                        d="M 5.9999995,6.0000002 3.5000625,10.330018"
                                                        style="fill:none;stroke: #748F9F;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        sodipodi:nodetypes="cc" />
                                                </svg>
                                            @else
                                                <span style="font-size: 12px">{{ $item->aspect->symbol }}</span>
                                            @endif
                                            <span>{{ $item->toPlanet->symbol }}</span>
                                        </p>
                                        <p class="page__text">{!! nl2br($item->content) !!}</p>
                                    </div>
                                    @php $moonAspectFirstPage[] = $key; @endphp
                                @endif
                            @endif
                        @endforeach
                    @else
                        <p class="page__text">
                            <span>この天体は他の天体との関わりがなく、天体の力をうまく発揮できないとされます。</span>
                        </p>
                    @endif
                </div>
            </div>
        </div>
        <div class="page-break-before"></div>
        {{-- @if ($explain->get('MOON')->get('aspect_pattern')->count() > 0 && $explain->get('MOON')->get('aspect_pattern')[2] !== null) --}}
        {{-- @if ($explain->get('MOON')->get('aspect_pattern')->count() > 0 && !empty($explain->get('MOON')->get('aspect_pattern')[2])) --}}
        @if ($explain->get('MOON')->get('aspect_pattern')->forget($moonAspectFirstPage)->values()->count() > 0)
            @php
                $length = 0;         
                $items = $explain->get('MOON')->get('aspect_pattern')->forget($moonAspectFirstPage)->values();
                foreach($items as $item){
                    $length+= mb_strlen($item->content ?? '','UTF-8'); 
                }
                $showPage2 = ($length <= 900) ? 5 : 4;
                $itemPairs = array_chunk($items->all(), $showPage2);
            @endphp
            @foreach($itemPairs as $itemPair)
            @if ($itemPair[0] !== null)
            <div class="page page12 page--content page--number page--number_left page--moon"
                data-pageno="{{ $page++ }}">
                <div class="page__inner">
                    <div class="page-block page-block--5">
                        @if ($explain->get('MOON')->get('aspect_pattern')->isNotEmpty())
                            {{-- @foreach ($explain->get('MOON')->get('aspect_pattern') as $key => $item) --}}
                            @foreach($itemPair as $key => $item)
                                @if (is_null($item))
                                    @if ($key == 0)
                                    <p class="page__text">
                                        <span>この天体は他の天体との関わりがなく、天体の力をうまく発揮できないとされます。</span>
                                    </p>
                                @else
                                    <p></p>
                                @endif
                                @else
                                    {{-- @if ($key >= 2) --}}
                                        {{-- <div class="page-block--5__half"> --}}
                                            <div class="page-block--5__half @if ($key >= 2) flex-margin-top @endif">
                                            <p class="planet page-block--5__title icon-sign icon-sign" style="font-size: 16px !important">
                                                 <span>{{ $item->fromPlanet->symbol }}</span> @if ($item->aspect->symbol === 'q')
                                                    
                                                    <svg xmlns:dc="http://purl.org/dc/elements/1.1/"
                                                        xmlns:cc="http://creativecommons.org/ns#"
                                                        xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                                                        xmlns:svg="http://www.w3.org/2000/svg"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
                                                        xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
                                                       width="12px" height="12px" viewBox="0 0 12 12"
                                                        version="1.1" id="svg9"
                                                        sodipodi:docname="Pallas_symbol_(fixed_width).svg"
                                                        inkscape:version="0.92.5 (2060ec1f9f, 2020-04-08)"
                                                    style="margin-left: 5px ; margin-right: 5px">
                                                        <metadata id="metadata15">
                                                            <rdf:RDF>
                                                                <cc:Work rdf:about="">
                                                                    <dc:format>image/svg+xml</dc:format>
                                                                    <dc:type
                                                                        rdf:resource="http://purl.org/dc/dcmitype/StillImage" />
                                                                </cc:Work>
                                                            </rdf:RDF>
                                                        </metadata>
                                                        <defs id="defs13" />
                                                        <sodipodi:namedview pagecolor="#ffffff" bordercolor="#666666"
                                                            borderopacity="1" objecttolerance="10" gridtolerance="10"
                                                            guidetolerance="10" inkscape:pageopacity="0"
                                                            inkscape:pageshadow="2" inkscape:window-width="1920"
                                                            inkscape:window-height="1015" id="namedview11"
                                                            showgrid="false" inkscape:zoom="29.5"
                                                            inkscape:cx="7.5762712" inkscape:cy="5.9661012"
                                                            inkscape:window-x="0" inkscape:window-y="0"
                                                            inkscape:window-maximized="1"
                                                            inkscape:current-layer="svg9" />
                                                        <path inkscape:connector-curvature="0" id="path4-3"
                                                            d="M 11.00025,6 H 0.99975"
                                                            style="fill:none;stroke: #748F9F;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            sodipodi:nodetypes="cc" />
                                                        <path inkscape:connector-curvature="0" id="path4-3-6-27-9"
                                                            d="m 6.0000002,6.0000001 2.499937,4.3300179"
                                                            style="fill:none;stroke: #748F9F;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            sodipodi:nodetypes="cc" />
                                                        <path inkscape:connector-curvature="0" id="path4-3-6-27-3"
                                                            d="M 3.5000629,1.6699816 5.9999993,5.9999992"
                                                            style="fill:none;stroke: #748F9F;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            sodipodi:nodetypes="cc" />
                                                        <path inkscape:connector-curvature="0" id="path4-3-6-1-6"
                                                            d="M 8.4999375,1.6699816 6.0000005,5.9999999"
                                                            style="fill:none;stroke: #748F9F;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            sodipodi:nodetypes="cc" />
                                                        <path inkscape:connector-curvature="0" id="path4-3-6-1-0"
                                                            d="M 5.9999995,6.0000002 3.5000625,10.330018"
                                                            style="fill:none;stroke: #748F9F;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            sodipodi:nodetypes="cc" />
                                                    </svg>
                                                    
                                                @else
                                                    
                                                    <span style="font-size: 12px">{{ $item->aspect->symbol }}</span>
                                                    
                                                @endif
                                                <span>{{ $item->toPlanet->symbol }}</span>
                                            </p>
                                            <p class="page__text">{!! nl2br($item->content) !!}</p>
                                        </div>
                                    {{-- @endif --}}
                                @endif
                            @endforeach
                        @else
                            <p class="page__text">
                                <span>この天体は他の天体との関わりがなく、天体の力をうまく発揮できないとされます。</span>
                            </p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="page-break-before"></div>
            @endif
            @endforeach
        @endif

        {{-- <div class="page page14 page--bg page--number page--number_right" data-pageno="{{ $page++ }}"></div> --}}
        <div class="page-break-before"></div>
        <div class="page page15 page--cover page--mercury page--number page--number_right"
            data-pageno="" data-title="Mercury">
            <div class="page__inner">
                <p class="page--cover__title"><span>水星</span></p>
                <div class="page--cover-block1">
                    <p class="page--cover-block1__title">あなたの知的な興味関心［8～15 歳］</p>
                    <p class="page__text">
                        <span>あなたは学童期にどのようなことに関心を持ち、どのように友人と接していましたか？ 学童期である8～15
                            歳ごろに最も強く作用し、あなたの知的興味関心や学習、人とのコミュニケーションなどにかかわるのが生まれた時の水星です。</span>
                        <span>あなたがこの頃に関心があったこと、得意だった教科、どんなタイプの子どもだったか、といったことを思い出すと、以下の水星にかかわる鑑定内容と合致するでしょう。</span>
                        <span>わたしたちは学童期に得た知的関心や学習方法、人とのかかわり方などを、大人になっても仕事の技術や興味関心のある分野、ものの考え方や言葉での伝え方、人とのかかわり方などの形で影響し続けます。</span>
                    </p>
                </div>
                <div class="page--cover__image mercury"> <svg></svg>
                </div>
                <span class="page--cover__frame"></span>
            </div>
        </div>
        @php
            $page++;
        @endphp
        <div class="page-break-before"></div>
        <div class="page page16 page--content page--mercury page--number page--number_left"
            data-pageno="{{ $page++ }}">
            <div class="page__inner">
                <div class="page-block page-block--1">
                    <p class="page-block--1__title">
                        <span
                            class="icon-sign icon-sign--{{ $explain->get('MERCURY')->get('zodiac_pattern')->zodiac->name_en }}">サイン
                            {{ $explain->get('MERCURY')->get('zodiac_pattern')->zodiac->name }}</span>
                        <span
                            class="handfont1">{{ $explain->get('MERCURY')->get('zodiac_pattern')->zodiac->name_en }}</span>
                    </p>
                    <p class="page__text">
                        <span style="text-indent: 0;">{!! nl2br($explain->get('MERCURY')->get('zodiac_pattern')->content) !!}</span>
                    </p>
                </div>
                <div class="page-block page-block--2">
                    <p class="page-block--2__title">水星のサビアンシンボル</p>
                    <p class="page__text">
                        <span>水星のサビアンシンボルからは、あなたのもって生まれた知性の特徴がわかります。シンボルの解説文を読むときには、あなたが、学習や人とのコミュニケーションといった知的な活動をどのようにしようとしているかについて言及されているのだという意識で見てみましょう。</span>
                    </p>
                </div>
                <div class="page-block page-block--3">
                    @empty($explain->get('MERCURY')->get('sabian_pattern'))
                        <p class="page-block--3__title">これは特殊なケースです。 角度が0度の場合はサビアンは存在しません</p>
                    @else
                        <p class="page-block--3__title">
                            {{ $explain->get('MERCURY')->get('sabian_pattern')->zodiac->name }}{{ $explain->get('MERCURY')->get('sabian_pattern')->sabian_degrees }}
                            度「{{ $explain->get('MERCURY')->get('sabian_pattern')->title }}」</p>
                        <p class="page__text">
                            <span style="text-indent: 0;">{!! nl2br($explain->get('MERCURY')->get('sabian_pattern')->content) !!}</span>
                        </p>
                    @endempty
                </div>
            </div>
        </div>
        <div class="page-break-before"></div>
        <div class="page page17 page--content page--mercury page--number page--number_right"
            data-pageno="{{ $page++ }}">
            <div class="page__inner">
                <div class="page-block page-block--4">
                    <p class="page-block--4__title">
                        ハウス<span>{{ $explain->get('MERCURY')->get('house_pattern')->house->symbol }}</span></p>
                    <p class="page__text">
                        <span style="text-indent: 0;">{!! nl2br($explain->get('MERCURY')->get('house_pattern')->content) !!}</span>
                    </p>
                </div>
                <div class="page-block page-block--2">
                    <p class="page-block--2__title">アスペクト<span>他の天体との関わりからわかること</span></p>
                    <p class="page__text">
                        <span>あなたの知性がどう活かされるか、その発揮にどのような課題があるか、逆にどのような才能や個性を伴うか、といったことを、他の天体とのかかわりから理解することが出来ます。</span>
                    </p>
                </div>

                @php 
                    $mercuryHouse = mb_strlen($explain->get('MERCURY')->get('house_pattern')->content ?? '', 'UTF-8');
                    $key2 = mb_strlen($explain['MERCURY']['aspect_pattern'][2]->content ?? '', 'UTF-8');
                    $key3 = mb_strlen($explain['MERCURY']['aspect_pattern'][3]->content ?? '', 'UTF-8');
                    $mercuryKey01 = $totalLength['MERCURY']['key01'];
                    $mercuryKey23 = $totalLength['MERCURY']['key23'];
                @endphp

                <div class="page-block page-block--5">
                    {{-- @if (!$explain->get('MERCURY')->get('aspect_pattern')->isNotEmpty())
                        <p class="page__text">
                            <span>この天体は他の天体との関わりがなく、天体の力をうまく発揮できないとされます。</span>
                        </p>
                    @endif --}}
                    @if ($explain->get('MERCURY')->get('aspect_pattern')->isNotEmpty())
                        @foreach ($explain->get('MERCURY')->get('aspect_pattern') as $key => $item)
                            @if (is_null($item))
                                @if ($key == 0)
                                    <p class="page__text">
                                        <span>この天体は他の天体との関わりがなく、天体の力をうまく発揮できないとされます。</span>
                                    </p>
                                @else
                                    <p></p>
                                @endif
                            @else
                                @php
                                    switch (true) {
                                        case $mercuryKey01 > 300 && $mercuryKey01 <350:
                                            $show = ($mercuryHouse<160) ? ($mercuryKey23 < 280 ? 4 : 3) : ($mercuryKey23 < 50 ? 4 : 3);
                                            break;

                                        case $mercuryKey01 > 250 && $mercuryKey01 < 300 :
                                            $show = ($mercuryHouse<160) ? ($mercuryKey23 < 180 ? 4 : 3) : ($mercuryKey23 < 150 ? 4 : 3);
                                            break;

                                        case $mercuryKey01 > 350 && $mercuryKey01 <650:
                                            $show = ($mercuryHouse<160) ? ( $key2 < 120 ? 3 : 2) : ($key2 < 50 ? 3 : 2);
                                            break;
                                            
                                        case $mercuryKey01 > 50 && $mercuryKey01 < 250:
                                            $show = ($mercuryHouse<160) ? ($mercuryKey23 < 371 && $key2 > 150 ? 4 : 3) : ($mercuryKey23 < 50 ? 4 : 3);
                                            break;

                                        case $mercuryKey01 < 50:
                                            $show = ($mercuryHouse<160) ? ($mercuryKey23 < 371 && $key2 > 150 ? 4 : 3) : ($mercuryKey23 < 50 ? 4 : 3);
                                            break;
                                    }
                                @endphp

                                @if ($key < $show)
                                    <div class="page-block--5__half">
                                        <p class="planet page-block--5__title icon-sign icon-sign" style="font-size: 16px !important">
                                             <span>{{ $item->fromPlanet->symbol }}</span> @if ($item->aspect->symbol === 'q')
                                                
                                                <svg xmlns:dc="http://purl.org/dc/elements/1.1/"
                                                    xmlns:cc="http://creativecommons.org/ns#"
                                                    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                                                    xmlns:svg="http://www.w3.org/2000/svg"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
                                                    xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
                                                   width="12px" height="12px" viewBox="0 0 12 12" version="1.1"
                                                    id="svg9" sodipodi:docname="Pallas_symbol_(fixed_width).svg"
                                                    inkscape:version="0.92.5 (2060ec1f9f, 2020-04-08)"
                                                    style="margin-left: 5px ; margin-right: 5px">
                                                    <metadata id="metadata15">
                                                        <rdf:RDF>
                                                            <cc:Work rdf:about="">
                                                                <dc:format>image/svg+xml</dc:format>
                                                                <dc:type
                                                                    rdf:resource="http://purl.org/dc/dcmitype/StillImage" />
                                                            </cc:Work>
                                                        </rdf:RDF>
                                                    </metadata>
                                                    <defs id="defs13" />
                                                    <sodipodi:namedview pagecolor="#ffffff" bordercolor="#666666"
                                                        borderopacity="1" objecttolerance="10" gridtolerance="10"
                                                        guidetolerance="10" inkscape:pageopacity="0"
                                                        inkscape:pageshadow="2" inkscape:window-width="1920"
                                                        inkscape:window-height="1015" id="namedview11"
                                                        showgrid="false" inkscape:zoom="29.5" inkscape:cx="7.5762712"
                                                        inkscape:cy="5.9661012" inkscape:window-x="0"
                                                        inkscape:window-y="0" inkscape:window-maximized="1"
                                                        inkscape:current-layer="svg9" />
                                                    <path inkscape:connector-curvature="0" id="path4-3"
                                                        d="M 11.00025,6 H 0.99975"
                                                        style="fill:none;stroke: #719AA7;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        sodipodi:nodetypes="cc" />
                                                    <path inkscape:connector-curvature="0" id="path4-3-6-27-9"
                                                        d="m 6.0000002,6.0000001 2.499937,4.3300179"
                                                        style="fill:none;stroke: #719AA7;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        sodipodi:nodetypes="cc" />
                                                    <path inkscape:connector-curvature="0" id="path4-3-6-27-3"
                                                        d="M 3.5000629,1.6699816 5.9999993,5.9999992"
                                                        style="fill:none;stroke: #719AA7;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        sodipodi:nodetypes="cc" />
                                                    <path inkscape:connector-curvature="0" id="path4-3-6-1-6"
                                                        d="M 8.4999375,1.6699816 6.0000005,5.9999999"
                                                        style="fill:none;stroke: #719AA7;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        sodipodi:nodetypes="cc" />
                                                    <path inkscape:connector-curvature="0" id="path4-3-6-1-0"
                                                        d="M 5.9999995,6.0000002 3.5000625,10.330018"
                                                        style="fill:none;stroke: #719AA7;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        sodipodi:nodetypes="cc" />
                                                </svg>
                                                
                                            @else
                                                
                                                <span style="font-size: 12px">{{ $item->aspect->symbol }}</span>
                                                
                                            @endif
                                            <span>{{ $item->toPlanet->symbol }}</span>
                                        </p>
                                        <p class="page__text">{!! nl2br($item->content) !!}</p>
                                    </div>
                                    @php $mercuryAspectFirstPage[] = $key; @endphp
                                @endif
                            @endif
                        @endforeach
                    @else
                        <p class="page__text">
                            <span>この天体は他の天体との関わりがなく、天体の力をうまく発揮できないとされます。</span>
                        </p>
                    @endif
                </div>
            </div>
        </div>
        <div class="page-break-before"></div>
        {{-- @if ($explain->get('MERCURY')->get('aspect_pattern')->count() > 0 && $explain->get('MERCURY')->get('aspect_pattern')[2] !== null)) --}}
        {{-- @if ($explain->get('MERCURY')->get('aspect_pattern')->count() > 0 && !empty($explain->get('MERCURY')->get('aspect_pattern')[2])) --}}
        @if ($explain->get('MERCURY')->get('aspect_pattern')->forget($mercuryAspectFirstPage)->values()->count() > 0)
            @php
                $items = $explain->get('MERCURY')->get('aspect_pattern')->forget($mercuryAspectFirstPage)->values();
                $length=0;
                foreach($items as $item){
                    $length+= mb_strlen($item->content ?? '','UTF-8'); 
                }
                $showPage2 = ($length <= 900) ? 5 : 4;
                $itemPairs = array_chunk($items->all(), $showPage2);
            @endphp
            @foreach($itemPairs as $itemPair)
            @if ($itemPair[0] !== null)
            <div class="page page17 page--content page--number page--number_left page--mercury"
                data-pageno="{{ $page++ }}">
                <div class="page__inner">
                    <div class="page-block page-block--5">
                        @if ($explain->get('MERCURY')->get('aspect_pattern')->isNotEmpty())
                            {{-- @foreach ($explain->get('MERCURY')->get('aspect_pattern') as $key => $item) --}}
                            @foreach($itemPair as $key => $item)
                                @if (is_null($item))
                                    @if ($key == 0)
                                    <p class="page__text">
                                        <span>この天体は他の天体との関わりがなく、天体の力をうまく発揮できないとされます。</span>
                                    </p>
                                @else
                                    <p></p>
                                @endif
                                @else
                                    {{-- @if ($key >= 2) --}}
                                        {{-- <div class="page-block--5__half"> --}}
                                            <div class="page-block--5__half @if ($key >= 2) flex-margin-top @endif">
                                            <p class="planet page-block--5__title icon-sign icon-sign" style="font-size: 16px !important">
                                                 <span>{{ $item->fromPlanet->symbol }}</span> @if ($item->aspect->symbol === 'q')
                                                    
                                                    <svg xmlns:dc="http://purl.org/dc/elements/1.1/"
                                                        xmlns:cc="http://creativecommons.org/ns#"
                                                        xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                                                        xmlns:svg="http://www.w3.org/2000/svg"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
                                                        xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
                                                       width="12px" height="12px" viewBox="0 0 12 12"
                                                        version="1.1" id="svg9"
                                                        sodipodi:docname="Pallas_symbol_(fixed_width).svg"
                                                        inkscape:version="0.92.5 (2060ec1f9f, 2020-04-08)"
                                                    style="margin-left: 5px ; margin-right: 5px">
                                                        <metadata id="metadata15">
                                                            <rdf:RDF>
                                                                <cc:Work rdf:about="">
                                                                    <dc:format>image/svg+xml</dc:format>
                                                                    <dc:type
                                                                        rdf:resource="http://purl.org/dc/dcmitype/StillImage" />
                                                                </cc:Work>
                                                            </rdf:RDF>
                                                        </metadata>
                                                        <defs id="defs13" />
                                                        <sodipodi:namedview pagecolor="#ffffff" bordercolor="#666666"
                                                            borderopacity="1" objecttolerance="10" gridtolerance="10"
                                                            guidetolerance="10" inkscape:pageopacity="0"
                                                            inkscape:pageshadow="2" inkscape:window-width="1920"
                                                            inkscape:window-height="1015" id="namedview11"
                                                            showgrid="false" inkscape:zoom="29.5"
                                                            inkscape:cx="7.5762712" inkscape:cy="5.9661012"
                                                            inkscape:window-x="0" inkscape:window-y="0"
                                                            inkscape:window-maximized="1"
                                                            inkscape:current-layer="svg9" />
                                                        <path inkscape:connector-curvature="0" id="path4-3"
                                                            d="M 11.00025,6 H 0.99975"
                                                            style="fill:none;stroke: #719AA7;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            sodipodi:nodetypes="cc" />
                                                        <path inkscape:connector-curvature="0" id="path4-3-6-27-9"
                                                            d="m 6.0000002,6.0000001 2.499937,4.3300179"
                                                            style="fill:none;stroke: #719AA7;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            sodipodi:nodetypes="cc" />
                                                        <path inkscape:connector-curvature="0" id="path4-3-6-27-3"
                                                            d="M 3.5000629,1.6699816 5.9999993,5.9999992"
                                                            style="fill:none;stroke: #719AA7;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            sodipodi:nodetypes="cc" />
                                                        <path inkscape:connector-curvature="0" id="path4-3-6-1-6"
                                                            d="M 8.4999375,1.6699816 6.0000005,5.9999999"
                                                            style="fill:none;stroke: #719AA7;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            sodipodi:nodetypes="cc" />
                                                        <path inkscape:connector-curvature="0" id="path4-3-6-1-0"
                                                            d="M 5.9999995,6.0000002 3.5000625,10.330018"
                                                            style="fill:none;stroke: #719AA7;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            sodipodi:nodetypes="cc" />
                                                    </svg>
                                                    
                                                @else
                                                    
                                                    <span style="font-size: 12px">{{ $item->aspect->symbol }}</span>
                                                    
                                                @endif
                                                <span>{{ $item->toPlanet->symbol }}</span>
                                            </p>
                                            <p class="page__text">{!! nl2br($item->content) !!}</p>
                                        </div>
                                    {{-- @endif --}}
                                @endif
                            @endforeach
                        @else
                            <p class="page__text">
                                <span>この天体は他の天体との関わりがなく、天体の力をうまく発揮できないとされます。</span>
                            </p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="page-break-before"></div>
            @endif
            @endforeach
        @endif
        {{-- <div class="page page18 page--bg page--number page--number_right" data-pageno="{{ $page++ }}"></div> --}}
        <div class="page-break-before"></div>
        <div class="page page19 page--cover page--venus page--number page--number_right"
            data-pageno="" data-title="Venus">
            <div class="page__inner">
                <p class="page--cover__title"><span>金星</span></p>
                <div class="page--cover-block1">
                    <p class="page--cover-block1__title">あなたの喜びや楽しみ［16～25 歳］</p>
                    <p class="page__text">
                        <span>感受性が生き生きと豊かさを増す思春期に、あなたは何かに夢中になったり、誰かを好きになったりしませんでしたか？そういった、あなたの好みや楽しみの方向性や何に魅力を感じるのか、といったことにかかわるのが、「宵の明星」「明けの明星」として知られ、美の女神が支配する金星です。</span>
                        <span>あなたの金星のサインやハウス、サビアンシンボルは、あなたがどんなことに夢中になるか、何を美しいと感じるか、何を好むか、ということをあらわします。思春期は金星の性質があなた自身のキャラクターとして最も強く影響します。そして、その後の人生においても、この頃大好きだったものを今も好きでい続けることが多いでしょう。</span>
                        <span>以下の金星の鑑定内容を、青春時代の自分、そしてその頃から変わらない自分の「好きなもの」を思い出しながら読んでみると、多くの気づきがあるでしょう。</span>
                        <span>また、女性にとっては恋愛の傾向があらわれており、男性にとっては好みの女性のタイプを金星のサインやハウスなどがあらわしている、とされますので気にして読んでみてください。</span>
                    </p>
                </div>
                <div class="page--cover__image venus"><svg></svg>
                </div>
                <span class="page--cover__frame"></span>
            </div>
        </div>
        @php
            $page++;
        @endphp
        <div class="page-break-before"></div>
        <div class="page page20 page--content page--venus page--number page--number_left"
            data-pageno="{{ $page++ }}">
            <div class="page__inner">
                <div class="page-block page-block--1">
                    <p class="page-block--1__title">
                        <span
                            class="icon-sign icon-sign--{{ $explain->get('VENUS')->get('zodiac_pattern')->zodiac->name_en }}">サイン
                            {{ $explain->get('VENUS')->get('zodiac_pattern')->zodiac->name }}</span>
                        <span
                            class="handfont1">{{ $explain->get('VENUS')->get('zodiac_pattern')->zodiac->name_en }}</span>
                    </p>
                    <p class="page__text">
                        <span style="text-indent: 0;">{!! nl2br($explain->get('VENUS')->get('zodiac_pattern')->content) !!}</span>
                    </p>
                </div>
                <div class="page-block page-block--2">
                    <p class="page-block--2__title">金星のサビアンシンボル</p>
                    <p class="page__text">
                        <span>金星のサビアンシンボルからは、あなたのもって生まれた好みや感性の特徴が具体的にわかります。以下のシンボル解説の内容は、「好きなことに関係するテーマ」で発揮されるのだということを頭に入れて読んでいきましょう。また、先の金星のハウスのテーマを通して発揮できる面もあります。</span>
                    </p>
                </div>
                <div class="page-block page-block--3">
                    @if (empty($explain->get('VENUS')->get('sabian_pattern')))
                        <p class="page-block--3__title">これは特殊なケースです。 角度が0度の場合はサビアンは存在しません</p>
                    @else
                        <p class="page-block--3__title">
                            {{ $explain->get('VENUS')->get('sabian_pattern')->zodiac->name }}{{ $explain->get('VENUS')->get('sabian_pattern')->sabian_degrees }}
                            度「{{ $explain->get('VENUS')->get('sabian_pattern')->title }}」</p>
                        <p class="page__text">
                            <span style="text-indent: 0;">{!! nl2br($explain->get('VENUS')->get('sabian_pattern')->content) !!}</span>
                        </p>
                    @endif
                </div>
            </div>
        </div>
        <div class="page-break-before"></div>
        <div class="page page21 page--content page--venus page--number page--number_right"
            data-pageno="{{ $page++ }}">
            <div class="page__inner">
                <div class="page-block page-block--4">
                    <p class="page-block--4__title">
                        ハウス<span>{{ $explain->get('VENUS')->get('house_pattern')->house->symbol }}</span></p>
                    <p class="page__text">
                        <span style="text-indent: 0;">{!! nl2br($explain->get('VENUS')->get('house_pattern')->content) !!}</span>
                    </p>
                </div>
                <div class="page-block page-block--2">
                    <p class="page-block--2__title">アスペクト<span>他の天体との関わりからわかること</span></p>
                    <p class="page__text">
                        <span>あなたの魅力や感性をうまく発揮できるか、もしくはそれが制限されやすいか、そしてあなたの魅力の独創性は…？といったことが他の天体とのアスペクトから理解できます。</span>
                        <span>恋愛運や金運もまた、金星が他の天体とうまく調和しているかどうかで判断することが出来ます。</span>
                    </p>
                </div>

                @php 
                    $venusHouse = mb_strlen($explain->get('VENUS')->get('house_pattern')->content ?? '', 'UTF-8');
                    $key2 = mb_strlen($explain['VENUS']['aspect_pattern'][2]->content ?? '', 'UTF-8');
                    $key3 = mb_strlen($explain['VENUS']['aspect_pattern'][3]->content ?? '', 'UTF-8');
                    $venusKey01 = $totalLength['VENUS']['key01'];
                    $venusKey23 = $totalLength['VENUS']['key23'];
                @endphp

                <div class="page-block page-block--5">
                    {{-- @if (!$explain->get('VENUS')->get('aspect_pattern')->isNotEmpty())
                        <p class="page__text">
                            <span>この天体は他の天体との関わりがなく、天体の力をうまく発揮できないとされます。</span>
                        </p>
                    @endif --}}
                    @if ($explain->get('VENUS')->get('aspect_pattern')->isNotEmpty())
                        @foreach ($explain->get('VENUS')->get('aspect_pattern') as $key => $item)
                            @if (is_null($item))
                                @if ($key == 0)
                                    <p class="page__text">
                                        <span>この天体は他の天体との関わりがなく、天体の力をうまく発揮できないとされます。</span>
                                    </p>
                                @else
                                    <p></p>
                                @endif
                            @else

                                @php
                                    switch (true) {
                                        case $venusKey01 > 300 && $venusKey01 < 350:
                                            $show = ($venusHouse<160) ? ($venusKey23 < 280 ? 4 : 3) : ($venusKey23 < 50 ? 4 : 3);
                                            break;

                                        case $venusKey01 > 250 && $venusKey01 < 300:
                                            $show = ($venusHouse<160) ? ($venusKey23 < 180 ? 4 : 3) : ($venusKey23 < 150 ? 4 : 3);
                                            break;

                                        case $venusKey01 > 350 && $venusKey01 <650:
                                            $show = ($venusHouse<160) ? ( $key2 < 120 ? 3 : 2) : ($key2 < 50 ? 3 : 2);
                                            break;
                                        case $venusKey01 > 50 && $venusKey01 < 250:
                                            $show = ($venusHouse<160) ? ($venusKey23 < 371 && $key2 > 150 ? 4 : 3) : ($venusKey23 < 50 ? 4 : 3);
                                            break;

                                        case $venusKey01 < 50:
                                            $show = ($venusHouse<160) ? ($venusKey23 < 371 && $key2 > 150 ? 4 : 3) : ($venusKey23 < 50 ? 4 : 3);
                                            break;
                                    }
                                @endphp

                                @if ($key < $show)
                                    <div class="page-block--5__half">
                                        <p class="planet page-block--5__title icon-sign icon-sign" style="font-size: 16px !important">
                                             <span>{{ $item->fromPlanet->symbol }}</span> @if ($item->aspect->symbol === 'q')
                                                
                                                <svg xmlns:dc="http://purl.org/dc/elements/1.1/"
                                                    xmlns:cc="http://creativecommons.org/ns#"
                                                    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                                                    xmlns:svg="http://www.w3.org/2000/svg"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
                                                    xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
                                                   width="12px" height="12px" viewBox="0 0 12 12" version="1.1"
                                                    id="svg9" sodipodi:docname="Pallas_symbol_(fixed_width).svg"
                                                    inkscape:version="0.92.5 (2060ec1f9f, 2020-04-08)"
                                                    style="margin-left: 5px ; margin-right: 5px">
                                                    <metadata id="metadata15">
                                                        <rdf:RDF>
                                                            <cc:Work rdf:about="">
                                                                <dc:format>image/svg+xml</dc:format>
                                                                <dc:type
                                                                    rdf:resource="http://purl.org/dc/dcmitype/StillImage" />
                                                            </cc:Work>
                                                        </rdf:RDF>
                                                    </metadata>
                                                    <defs id="defs13" />
                                                    <sodipodi:namedview pagecolor="#ffffff" bordercolor="#666666"
                                                        borderopacity="1" objecttolerance="10" gridtolerance="10"
                                                        guidetolerance="10" inkscape:pageopacity="0"
                                                        inkscape:pageshadow="2" inkscape:window-width="1920"
                                                        inkscape:window-height="1015" id="namedview11"
                                                        showgrid="false" inkscape:zoom="29.5" inkscape:cx="7.5762712"
                                                        inkscape:cy="5.9661012" inkscape:window-x="0"
                                                        inkscape:window-y="0" inkscape:window-maximized="1"
                                                        inkscape:current-layer="svg9" />
                                                    <path inkscape:connector-curvature="0" id="path4-3"
                                                        d="M 11.00025,6 H 0.99975"
                                                        style="fill:none;stroke: #C08E9E;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        sodipodi:nodetypes="cc" />
                                                    <path inkscape:connector-curvature="0" id="path4-3-6-27-9"
                                                        d="m 6.0000002,6.0000001 2.499937,4.3300179"
                                                        style="fill:none;stroke: #C08E9E;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        sodipodi:nodetypes="cc" />
                                                    <path inkscape:connector-curvature="0" id="path4-3-6-27-3"
                                                        d="M 3.5000629,1.6699816 5.9999993,5.9999992"
                                                        style="fill:none;stroke: #C08E9E;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        sodipodi:nodetypes="cc" />
                                                    <path inkscape:connector-curvature="0" id="path4-3-6-1-6"
                                                        d="M 8.4999375,1.6699816 6.0000005,5.9999999"
                                                        style="fill:none;stroke: #C08E9E;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        sodipodi:nodetypes="cc" />
                                                    <path inkscape:connector-curvature="0" id="path4-3-6-1-0"
                                                        d="M 5.9999995,6.0000002 3.5000625,10.330018"
                                                        style="fill:none;stroke: #C08E9E;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        sodipodi:nodetypes="cc" />
                                                </svg>
                                                
                                            @else
                                                
                                                <span style="font-size: 12px">{{ $item->aspect->symbol }}</span>
                                                
                                            @endif
                                            <span>{{ $item->toPlanet->symbol }}</span>
                                        </p>
                                        <p class="page__text">{!! nl2br($item->content) !!}</p>
                                    </div>
                                    @php $venusAspectFirstPage[] = $key; @endphp
                                @endif
                            @endif
                        @endforeach
                    @else
                        <p class="page__text">
                            <span>この天体は他の天体との関わりがなく、天体の力をうまく発揮できないとされます。</span>
                        </p>
                    @endif
                </div>
            </div>
        </div>
        {{-- @if ($explain->get('VENUS')->get('aspect_pattern')->count() > 0 && $explain->get('VENUS')->get('aspect_pattern')[2] !== null) --}}
        {{-- @if ($explain->get('VENUS')->get('aspect_pattern')->count() > 0 && !empty($explain->get('VENUS')->get('aspect_pattern')[2])) --}}
        @if ($explain->get('VENUS')->get('aspect_pattern')->forget($venusAspectFirstPage)->values()->count() > 0)
            @php
                $items = $explain->get('VENUS')->get('aspect_pattern')->forget($venusAspectFirstPage)->values();
                $length=0;
                foreach($items as $item){
                    $length+= mb_strlen($item->content ?? '','UTF-8'); 
                }
                $showPage2 = ($length <= 900) ? 5 : 4;
                $itemPairs = array_chunk($items->all(), $showPage2);
            @endphp
            @foreach($itemPairs as $itemPair)
            @if ($itemPair[0] !== null)
            <div class="page page21 page--content page--number page--number_left page--venus"
                data-pageno="{{ $page++ }}">
                <div class="page__inner">
                    <div class="page-block page-block--5">
                        @if ($explain->get('VENUS')->get('aspect_pattern')->isNotEmpty())
                            {{-- @foreach ($explain->get('VENUS')->get('aspect_pattern') as $key => $item) --}}
                            @foreach($itemPair as $key => $item)
                                @if (is_null($item))
                                    @if ($key == 0)
                                    <p class="page__text">
                                        <span>この天体は他の天体との関わりがなく、天体の力をうまく発揮できないとされます。</span>
                                    </p>
                                @else
                                    <p></p>
                                @endif
                                @else
                                    {{-- @if ($key >= 2) --}}
                                        {{-- <div class="page-block--5__half"> --}}
                                            <div class="page-block--5__half">
                                            <p class="planet page-block--5__title icon-sign icon-sign" style="font-size: 16px !important">
                                                 <span>{{ $item->fromPlanet->symbol }}</span> @if ($item->aspect->symbol === 'q')
                                                    
                                                    <svg xmlns:dc="http://purl.org/dc/elements/1.1/"
                                                        xmlns:cc="http://creativecommons.org/ns#"
                                                        xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                                                        xmlns:svg="http://www.w3.org/2000/svg"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
                                                        xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
                                                       width="12px" height="12px" viewBox="0 0 12 12"
                                                        version="1.1" id="svg9"
                                                        sodipodi:docname="Pallas_symbol_(fixed_width).svg"
                                                        inkscape:version="0.92.5 (2060ec1f9f, 2020-04-08)"
                                                    style="margin-left: 5px ; margin-right: 5px">
                                                        <metadata id="metadata15">
                                                            <rdf:RDF>
                                                                <cc:Work rdf:about="">
                                                                    <dc:format>image/svg+xml</dc:format>
                                                                    <dc:type
                                                                        rdf:resource="http://purl.org/dc/dcmitype/StillImage" />
                                                                </cc:Work>
                                                            </rdf:RDF>
                                                        </metadata>
                                                        <defs id="defs13" />
                                                        <sodipodi:namedview pagecolor="#ffffff" bordercolor="#666666"
                                                            borderopacity="1" objecttolerance="10" gridtolerance="10"
                                                            guidetolerance="10" inkscape:pageopacity="0"
                                                            inkscape:pageshadow="2" inkscape:window-width="1920"
                                                            inkscape:window-height="1015" id="namedview11"
                                                            showgrid="false" inkscape:zoom="29.5"
                                                            inkscape:cx="7.5762712" inkscape:cy="5.9661012"
                                                            inkscape:window-x="0" inkscape:window-y="0"
                                                            inkscape:window-maximized="1"
                                                            inkscape:current-layer="svg9" />
                                                        <path inkscape:connector-curvature="0" id="path4-3"
                                                            d="M 11.00025,6 H 0.99975"
                                                            style="fill:none;stroke: #C08E9E;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            sodipodi:nodetypes="cc" />
                                                        <path inkscape:connector-curvature="0" id="path4-3-6-27-9"
                                                            d="m 6.0000002,6.0000001 2.499937,4.3300179"
                                                            style="fill:none;stroke: #C08E9E;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            sodipodi:nodetypes="cc" />
                                                        <path inkscape:connector-curvature="0" id="path4-3-6-27-3"
                                                            d="M 3.5000629,1.6699816 5.9999993,5.9999992"
                                                            style="fill:none;stroke: #C08E9E;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            sodipodi:nodetypes="cc" />
                                                        <path inkscape:connector-curvature="0" id="path4-3-6-1-6"
                                                            d="M 8.4999375,1.6699816 6.0000005,5.9999999"
                                                            style="fill:none;stroke: #C08E9E;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            sodipodi:nodetypes="cc" />
                                                        <path inkscape:connector-curvature="0" id="path4-3-6-1-0"
                                                            d="M 5.9999995,6.0000002 3.5000625,10.330018"
                                                            style="fill:none;stroke: #C08E9E;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            sodipodi:nodetypes="cc" />
                                                    </svg>
                                                    
                                                @else
                                                    
                                                    <span style="font-size: 12px">{{ $item->aspect->symbol }}</span>
                                                    
                                                @endif
                                                <span>{{ $item->toPlanet->symbol }}</span>
                                            </p>
                                            <p class="page__text">{!! nl2br($item->content) !!}</p>
                                        </div>
                                    {{-- @endif --}}
                                @endif
                            @endforeach
                        @else
                            <p class="page__text">
                                <span>この天体は他の天体との関わりがなく、天体の力をうまく発揮できないとされます。</span>
                            </p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="page-break-before"></div>
            @endif
            @endforeach
        @endif
        <div class="page-break-before"></div>
        {{-- <div class="page page22 page--bg page--number page--number_right" data-pageno="{{ $page++ }}"></div> --}}
        <div class="page-break-before"></div>
        <div class="page page23 page--cover page--sun page--number page--number_right"
            data-pageno="" data-title="Sun">
            <div class="page__inner">
                <p class="page--cover__title"><span>太陽</span></p>
                <div class="page--cover-block1">
                    <p class="page--cover-block1__title">この人生の目的［26～35 歳］</p>
                    <p class="page__text">
                        <span>社会に出てしばらくすると、太陽の年齢域に差し掛かることになります。水星や金星といった地球の内惑星は、地球からは太陽のそばをうろちょろしているように見えます。太陽の近くにあるので、水星、金星、太陽がどれも同じ星座にあることもありますし、太陽の一つ隣の星座にある、ということも多いでしょう。</span>
                        <span>金星が太陽と違う星座にある場合、太陽の年齢域から人生の方向性を大きく変える人が増えます。これまでは好きなこと、楽しいことを学び、職業選択の基準としていく人が多いのですが、太陽の年齢域である２０代後半に差し掛かると、より深く本質的な意味で自分の「生きがい」を見出そうとし始めるため、職業や生き方を再選択する人が増える傾向にあります。</span>
                        <span>太陽のあらわす人生の目的は非常に重要です。あなたにしかできないこと、生み出せないもの、この人生の意味と深くかかわります。そして、できるならばそれを３５歳の太陽の年齢域が終わるまでに見出せるといいでしょう。</span>
                        <span>以下の鑑定文を読んで、自分が太陽のあらわす人生の目的を実際に全うできているかを感じてみてください。</span>
                    </p>
                </div>
                <div class="page--cover__image sun"><svg></svg></div>
                <span class="page--cover__frame"></span>
            </div>
        </div>
        @php
            $page++;
        @endphp
        <div class="page-break-before"></div>
        <div class="page page24 page--content page--sun page--number page--number_left"
            data-pageno="{{ $page++ }}">
            <div class="page__inner">
                <div class="page-block page-block--1">
                    <p class="page-block--1__title">
                        <span
                            class="icon-sign icon-sign--{{ $explain->get('SUN')->get('zodiac_pattern')->zodiac->name_en }}">サイン
                            {{ $explain->get('SUN')->get('zodiac_pattern')->zodiac->name }}</span>
                        <span
                            class="handfont1">{{ $explain->get('SUN')->get('zodiac_pattern')->zodiac->name_en }}</span>
                    </p>
                    <p class="page__text">
                        <span style="text-indent: 0;">{!! nl2br($explain->get('SUN')->get('zodiac_pattern')->content) !!}</span>
                    </p>
                </div>
                <div class="page-block page-block--2">
                    <p class="page-block--2__title">太陽のサビアンシンボル</p>
                    <p class="page__text">
                        <span>太陽のサビアンシンボルからは、あなたの人生の目的の詳細がわかります。また、太陽の年齢域に自身の目的に気が付くためにどんな体験をするか、といったことがあらわれる場合もあります。太陽の意識はあなたの人生の根幹にかかわるものですのでよく理解しましょう。</span>
                    </p>
                </div>
                <div class="page-block page-block--3">
                    @if (empty($explain->get('SUN')->get('sabian_pattern')))
                        <p class="page-block--3__title">これは特殊なケースです。 角度が0度の場合はサビアンは存在しません</p>
                    @else
                        <p class="page-block--3__title">
                            {{ $explain->get('SUN')->get('sabian_pattern')->zodiac->name }}{{ $explain->get('SUN')->get('sabian_pattern')->sabian_degrees }}
                            度「{{ $explain->get('SUN')->get('sabian_pattern')->title }}」</p>
                        <p class="page__text">
                            <span style="text-indent: 0;">{!! nl2br($explain->get('SUN')->get('sabian_pattern')->content) !!}</span>
                        </p>
                    @endif
                </div>
            </div>
        </div>
        <div class="page-break-before"></div>
        <div class="page page25 page--content page--sun page--number page--number_right"
            data-pageno="{{ $page++ }}">
            <div class="page__inner">
                <div class="page-block page-block--4">
                    <p class="page-block--4__title">
                        ハウス<span>{{ $explain->get('SUN')->get('house_pattern')->house->symbol }}</span></p>
                    <p class="page__text">
                        <span style="text-indent: 0;">{!! nl2br($explain->get('SUN')->get('house_pattern')->content) !!}</span>
                    </p>
                </div>
                <div class="page-block page-block--2">
                    <p class="page-block--2__title">アスペクト<span>他の天体との関わりからわかること</span></p>
                    <p class="page__text">
                        <span>あなたの人生の目的を社会においてうまく発揮できるかどうか、社会でどのような困難にぶつかる可能性があるか、などといったことが太陽とのアスペクトから分かります。太陽の場合は、他の天体とのハードな配置を持っていても、乗り越えていく力や行動力が強いため、それを成長の糧にしていくことが可能です。</span>
                    </p>
                </div>

                @php 
                    $sunHouse = mb_strlen($explain->get('SUN')->get('house_pattern')->content ?? '', 'UTF-8');
                    $key2 = mb_strlen($explain['SUN']['aspect_pattern'][2]->content ?? '', 'UTF-8');
                    $key3 = mb_strlen($explain['SUN']['aspect_pattern'][3]->content ?? '', 'UTF-8');
                    $sunKey01 = $totalLength['SUN']['key01'];
                    $sunKey23 = $totalLength['SUN']['key23'];
                @endphp

                <div class="page-block page-block--5">
                    {{-- @if (!$explain->get('SUN')->get('aspect_pattern')->isNotEmpty())
                        <p class="page__text">
                            <span>この天体は他の天体との関わりがなく、天体の力をうまく発揮できないとされます。</span>
                        </p>
                    @endif --}}
                    @if ($explain->get('SUN')->get('aspect_pattern')->isNotEmpty())
                        @foreach ($explain->get('SUN')->get('aspect_pattern') as $key => $item)
                            @if (is_null($item))
                                @if ($key == 0)
                                    <p class="page__text">
                                        <span>この天体は他の天体との関わりがなく、天体の力をうまく発揮できないとされます。</span>
                                    </p>
                                @else
                                    <p></p>
                                @endif
                            @else
                                @php
                                    switch (true) {
                                        case $sunKey01 > 300 && $sunKey01 < 350:
                                            $show = ($sunHouse<160) ? ($sunKey23 < 280 ? 4 : 3) : ($sunKey23 < 50 ? 4 : 3);
                                            break;

                                        case $sunKey01 > 250 && $sunKey01 < 300:
                                            $show = ($sunHouse<160) ? ($sunKey23 < 180 ? 4 : 3) : ($sunKey23 < 150 ? 4 : 3);
                                            break;

                                        case $sunKey01 > 350 && $sunKey01 <650:
                                            $show = ($sunHouse<160) ? ( $key2 < 120 ? 3 : 2) : ($key2 < 50 ? 3 : 2);
                                            break;
                                        case $sunKey01 > 50 && $sunKey01 < 250:
                                            $show = ($sunHouse<160) ? ($sunKey23 < 371 && $key2 > 150 ? 4 : 3) : ($sunKey23 < 50 ? 4 : 3);
                                            break;

                                        case $sunKey01 < 50:
                                            $show = ($sunHouse<160) ? ($sunKey23 < 371 && $key2 > 150 ? 4 : 3) : ($sunKey23 < 50 ? 4 : 3);
                                            break;
                                    }
                                @endphp

                                @if ($key < $show)
                                    <div class="page-block--5__half">
                                        <p class="planet page-block--5__title icon-sign icon-sign" style="font-size: 16px !important">
                                             <span>{{ $item->fromPlanet->symbol }}</span> @if ($item->aspect->symbol === 'q')
                                                
                                                <svg xmlns:dc="http://purl.org/dc/elements/1.1/"
                                                    xmlns:cc="http://creativecommons.org/ns#"
                                                    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                                                    xmlns:svg="http://www.w3.org/2000/svg"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
                                                    xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
                                                   width="12px" height="12px" viewBox="0 0 12 12" version="1.1"
                                                    id="svg9" sodipodi:docname="Pallas_symbol_(fixed_width).svg"
                                                    inkscape:version="0.92.5 (2060ec1f9f, 2020-04-08)"
                                                    style="margin-left: 5px ; margin-right: 5px">
                                                    <metadata id="metadata15">
                                                        <rdf:RDF>
                                                            <cc:Work rdf:about="">
                                                                <dc:format>image/svg+xml</dc:format>
                                                                <dc:type
                                                                    rdf:resource="http://purl.org/dc/dcmitype/StillImage" />
                                                            </cc:Work>
                                                        </rdf:RDF>
                                                    </metadata>
                                                    <defs id="defs13" />
                                                    <sodipodi:namedview pagecolor="#ffffff" bordercolor="#666666"
                                                        borderopacity="1" objecttolerance="10" gridtolerance="10"
                                                        guidetolerance="10" inkscape:pageopacity="0"
                                                        inkscape:pageshadow="2" inkscape:window-width="1920"
                                                        inkscape:window-height="1015" id="namedview11"
                                                        showgrid="false" inkscape:zoom="29.5" inkscape:cx="7.5762712"
                                                        inkscape:cy="5.9661012" inkscape:window-x="0"
                                                        inkscape:window-y="0" inkscape:window-maximized="1"
                                                        inkscape:current-layer="svg9" />
                                                    <path inkscape:connector-curvature="0" id="path4-3"
                                                        d="M 11.00025,6 H 0.99975"
                                                        style="fill:none;stroke: #BFB685;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        sodipodi:nodetypes="cc" />
                                                    <path inkscape:connector-curvature="0" id="path4-3-6-27-9"
                                                        d="m 6.0000002,6.0000001 2.499937,4.3300179"
                                                        style="fill:none;stroke: #BFB685;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        sodipodi:nodetypes="cc" />
                                                    <path inkscape:connector-curvature="0" id="path4-3-6-27-3"
                                                        d="M 3.5000629,1.6699816 5.9999993,5.9999992"
                                                        style="fill:none;stroke: #BFB685;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        sodipodi:nodetypes="cc" />
                                                    <path inkscape:connector-curvature="0" id="path4-3-6-1-6"
                                                        d="M 8.4999375,1.6699816 6.0000005,5.9999999"
                                                        style="fill:none;stroke: #BFB685;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        sodipodi:nodetypes="cc" />
                                                    <path inkscape:connector-curvature="0" id="path4-3-6-1-0"
                                                        d="M 5.9999995,6.0000002 3.5000625,10.330018"
                                                        style="fill:none;stroke: #BFB685;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        sodipodi:nodetypes="cc" />
                                                </svg>
                                                
                                            @else
                                                
                                                <span style="font-size: 12px">{{ $item->aspect->symbol }}</span>
                                                
                                            @endif
                                            <span>{{ $item->toPlanet->symbol }}</span>
                                        </p>
                                        <p class="page__text">{!! nl2br($item->content) !!}</p>
                                    </div>
                                    @php $sunAspectFirstPage[] = $key; @endphp
                                @endif
                            @endif
                        @endforeach
                    @else
                        <p class="page__text">
                            <span>この天体は他の天体との関わりがなく、天体の力をうまく発揮できないとされます。</span>
                        </p>
                    @endif
                </div>
            </div>
        </div>
        {{-- @if ($explain->get('SUN')->get('aspect_pattern')->count() > 0 && $explain->get('SUN')->get('aspect_pattern')[2] !== null) --}}
        {{-- @if ($explain->get('SUN')->get('aspect_pattern')->count() > 0 && !empty($explain->get('SUN')->get('aspect_pattern')[2])) --}}
        @if ($explain->get('SUN')->get('aspect_pattern')->forget($sunAspectFirstPage)->values()->count() > 0)
            @php
                $items = $explain->get('SUN')->get('aspect_pattern')->forget($sunAspectFirstPage)->values();
                $length=0;
                foreach($items as $item){
                    $length+= mb_strlen($item->content ?? '','UTF-8'); 
                }
                $showPage2 = ($length <= 900) ? 5 : 4;
                $itemPairs = array_chunk($items->all(), $showPage2);
            @endphp
            @foreach($itemPairs as $itemPair)
            @if ($itemPair[0] !== null)
            <div class="page page25 page--content page--number page--number_left page--sun"
                data-pageno="{{ $page++ }}">
                <div class="page__inner">
                    <div class="page-block page-block--5">
                        @if ($explain->get('SUN')->get('aspect_pattern')->isNotEmpty())
                            {{-- @foreach ($explain->get('SUN')->get('aspect_pattern') as $key => $item) --}}
                            @foreach($itemPair as $key => $item)
                                @if (is_null($item))
                                    @if ($key == 0)
                                    <p class="page__text">
                                        <span>この天体は他の天体との関わりがなく、天体の力をうまく発揮できないとされます。</span>
                                    </p>
                                @else
                                    <p></p>
                                @endif
                                @else
                                    {{-- @if ($key >= 2) --}}
                                        {{-- <div class="page-block--5__half"> --}}
                                            <div class="page-block--5__half">
                                            <p class="planet page-block--5__title icon-sign icon-sign" style="font-size: 16px !important">
                                                 <span>{{ $item->fromPlanet->symbol }}</span> @if ($item->aspect->symbol === 'q')
                                                    
                                                    <svg xmlns:dc="http://purl.org/dc/elements/1.1/"
                                                        xmlns:cc="http://creativecommons.org/ns#"
                                                        xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                                                        xmlns:svg="http://www.w3.org/2000/svg"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
                                                        xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
                                                       width="12px" height="12px" viewBox="0 0 12 12"
                                                        version="1.1" id="svg9"
                                                        sodipodi:docname="Pallas_symbol_(fixed_width).svg"
                                                        inkscape:version="0.92.5 (2060ec1f9f, 2020-04-08)"
                                                    style="margin-left: 5px ; margin-right: 5px">
                                                        <metadata id="metadata15">
                                                            <rdf:RDF>
                                                                <cc:Work rdf:about="">
                                                                    <dc:format>image/svg+xml</dc:format>
                                                                    <dc:type
                                                                        rdf:resource="http://purl.org/dc/dcmitype/StillImage" />
                                                                </cc:Work>
                                                            </rdf:RDF>
                                                        </metadata>
                                                        <defs id="defs13" />
                                                        <sodipodi:namedview pagecolor="#ffffff" bordercolor="#666666"
                                                            borderopacity="1" objecttolerance="10" gridtolerance="10"
                                                            guidetolerance="10" inkscape:pageopacity="0"
                                                            inkscape:pageshadow="2" inkscape:window-width="1920"
                                                            inkscape:window-height="1015" id="namedview11"
                                                            showgrid="false" inkscape:zoom="29.5"
                                                            inkscape:cx="7.5762712" inkscape:cy="5.9661012"
                                                            inkscape:window-x="0" inkscape:window-y="0"
                                                            inkscape:window-maximized="1"
                                                            inkscape:current-layer="svg9" />
                                                        <path inkscape:connector-curvature="0" id="path4-3"
                                                            d="M 11.00025,6 H 0.99975"
                                                            style="fill:none;stroke: #BFB685;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            sodipodi:nodetypes="cc" />
                                                        <path inkscape:connector-curvature="0" id="path4-3-6-27-9"
                                                            d="m 6.0000002,6.0000001 2.499937,4.3300179"
                                                            style="fill:none;stroke: #BFB685;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            sodipodi:nodetypes="cc" />
                                                        <path inkscape:connector-curvature="0" id="path4-3-6-27-3"
                                                            d="M 3.5000629,1.6699816 5.9999993,5.9999992"
                                                            style="fill:none;stroke: #BFB685;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            sodipodi:nodetypes="cc" />
                                                        <path inkscape:connector-curvature="0" id="path4-3-6-1-6"
                                                            d="M 8.4999375,1.6699816 6.0000005,5.9999999"
                                                            style="fill:none;stroke: #BFB685;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            sodipodi:nodetypes="cc" />
                                                        <path inkscape:connector-curvature="0" id="path4-3-6-1-0"
                                                            d="M 5.9999995,6.0000002 3.5000625,10.330018"
                                                            style="fill:none;stroke: #BFB685;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            sodipodi:nodetypes="cc" />
                                                    </svg>
                                                    
                                                @else
                                                    
                                                    <span style="font-size: 12px">{{ $item->aspect->symbol }}</span>
                                                    
                                                @endif
                                                <span>{{ $item->toPlanet->symbol }}</span>
                                            </p>
                                            <p class="page__text">{!! nl2br($item->content) !!}</p>
                                        </div>
                                    {{-- @endif --}}
                                @endif
                            @endforeach
                        @else
                            <p class="page__text">
                                <span>この天体は他の天体との関わりがなく、天体の力をうまく発揮できないとされます。</span>
                            </p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="page-break-before"></div>
            @endif
            @endforeach
        @endif
        <div class="page-break-before"></div>
        {{-- <div class="page page26 page--bg page--number page--number_right" data-pageno="{{ $page++ }}"></div> --}}
        <div class="page-break-before"></div>
        <div class="page page27 page--cover page--mars page--number page--number_right"
            data-pageno="" data-title="Mars">
            <div class="page__inner">
                <p class="page--cover__title"><span>火星</span></p>
                <div class="page--cover-block1">
                    <p class="page--cover-block1__title">社会でチャレンジしたいこと［36～45 歳］</p>
                    <p class="page__text">
                        <span>「働き盛り」といわれる年代が火星の年齢域で、この頃あなたが社会的にどのようなことを頑張るのか、どんな志を持ちチャレンジしていくのかを火星があらわしています。火星は地球よりも外側にある天体で、より大きな宇宙への架け橋となります。</span>
                        <span>この年齢域の頃は、自分の限界や枠を広げようと新しいチャレンジをすることが重要になります。失敗もあるかもしれませんが、そうしたことも乗り越えていくことで、次の木星があらわす社会的な成功や拡大につながっていくのです。</span>
                        <span>女性のホロスコープにおいて、火星は好みの男性のタイプをあらわすともされます。このような男性が好みかどうか、女性の皆様は鑑定をみながら感じてみてください。そして、本来は、男性に期待することとしてではなく、自分自身が社会に発揮して打ち出すものとして火星の性質を持っているのであり、たとえパートナーであってもそれを代行することはできないのだと理解しましょう。</span>
                    </p>
                </div>
                <div class="page--cover__image mars"><svg></svg></div>
                <span class="page--cover__frame"></span>
            </div>
        </div>
        @php
            $page++;
        @endphp
        <div class="page-break-before"></div>
        <div class="page page28 page--content page--mars page--number page--number_left"
            data-pageno="{{ $page++ }}">
            <div class="page__inner">
                <div class="page-block page-block--1">
                    <p class="page-block--1__title">
                        <span
                            class="icon-sign icon-sign--{{ $explain->get('MARS')->get('zodiac_pattern')->zodiac->name_en }}">サイン
                            {{ $explain->get('MARS')->get('zodiac_pattern')->zodiac->name }}</span>
                        <span
                            class="handfont1">{{ $explain->get('MARS')->get('zodiac_pattern')->zodiac->name_en }}</span>
                    </p>
                    <p class="page__text">
                        <span style="text-indent: 0;">{!! nl2br($explain->get('MARS')->get('zodiac_pattern')->content) !!}</span>
                    </p>
                </div>
                <div class="page-block page-block--2">
                    <p class="page-block--2__title">火星のサビアンシンボル</p>
                    <p class="page__text">
                        <span>火星のサビアンシンボルからは、あなたの火星の年齢域の頃の特徴やそのころに獲得する能力、社会で実現させようと情熱を傾けるテーマなどが詳しくわかります。</span>
                    </p>
                </div>
                <div class="page-block page-block--3">
                    @if (empty($explain->get('MARS')->get('sabian_pattern')))
                        <p class="page-block--3__title">これは特殊なケースです。 角度が0度の場合はサビアンは存在しません</p>
                    @else
                        <p class="page-block--3__title">
                            {{ $explain->get('MARS')->get('sabian_pattern')->zodiac->name }}{{ $explain->get('MARS')->get('sabian_pattern')->sabian_degrees }}
                            度「{{ $explain->get('MARS')->get('sabian_pattern')->title }}」</p>
                        <p class="page__text">
                            <span style="text-indent: 0;">{!! nl2br($explain->get('MARS')->get('sabian_pattern')->content) !!}</span>
                        </p>
                    @endif
                </div>
            </div>
        </div>
        <div class="page-break-before"></div>
        <div class="page page29 page--content page--mars page--number page--number_right"
            data-pageno="{{ $page++ }}">
            <div class="page__inner">
                <div class="page-block page-block--4">
                    <p class="page-block--4__title">
                        ハウス<span>{{ $explain->get('MARS')->get('house_pattern')->house->symbol }}</span></p>
                    <p class="page__text">
                        <span style="text-indent: 0;">{!! nl2br($explain->get('MARS')->get('house_pattern')->content) !!}</span>
                    </p>
                </div>
                <div class="page-block page-block--2">
                    <p class="page-block--2__title">アスペクト<span>他の天体との関わりからわかること</span></p>
                    <p class="page__text">
                        <span>あなたが自分の野心をまっすぐに注ぎ達成することが出来るか、もしくは困難に多く突き当たるかといったことが他の天体とのかかわりからわかります。</span>
                    </p>
                </div>

                @php 
                    $marsHouse = mb_strlen($explain->get('MARS')->get('house_pattern')->content ?? '', 'UTF-8');
                    $key2 = mb_strlen($explain['MARS']['aspect_pattern'][2]->content ?? '', 'UTF-8');
                    $key3 = mb_strlen($explain['MARS']['aspect_pattern'][3]->content ?? '', 'UTF-8');
                    $marsKey01 = $totalLength['MARS']['key01'];
                    $marsKey23 = $totalLength['MARS']['key23'];
                @endphp

                <div class="page-block page-block--5">
                    {{-- @if (!$explain->get('MARS')->get('aspect_pattern')->isNotEmpty())
                        <p class="page__text">
                            <span>この天体は他の天体との関わりがなく、天体の力をうまく発揮できないとされます。</span>
                        </p>
                    @endif --}}
                    @if ($explain->get('MARS')->get('aspect_pattern')->isNotEmpty())
                        @foreach ($explain->get('MARS')->get('aspect_pattern') as $key => $item)
                            @if (is_null($item))
                                @if ($key == 0)
                                    <p class="page__text">
                                        <span>この天体は他の天体との関わりがなく、天体の力をうまく発揮できないとされます。</span>
                                    </p>
                                @else
                                    <p></p>
                                @endif
                            @else
                                @php
                                    switch (true) {
                                        case $marsKey01 > 300 && $marsKey01 <350:
                                            $show = ($marsHouse<160) ? ($marsKey23 < 280 ? 4 : 3) : ($marsKey23 < 50 ? 4 : 3);
                                            break;

                                        case $marsKey01 > 250 && $marsKey01 < 300 :
                                            $show = ($marsHouse<160) ? ($marsKey23 < 180 ? 4 : 3) : ($marsKey23 < 150 ? 4 : 3);
                                            break;
                                        case $marsKey01 > 350 && $marsKey01 <650:
                                            $show = ($marsHouse<160) ? ( $key2 < 120 ? 3 : 2) : ($key2 < 50 ? 3 : 2);
                                            break;
                                        case $marsKey01 > 50 && $marsKey01 < 250:
                                            $show = ($marsHouse<160) ? ($marsKey23 < 371 && $key2 > 150 ? 4 : 3) : ($marsKey23 < 50 ? 4 : 3);
                                            break;

                                        case $marsKey01 < 50:
                                            $show = ($marsHouse<160) ? ($marsKey23 < 371 && $key2 > 150 ? 4 : 3) : ($marsKey23 < 50 ? 4 : 3);
                                            break;
                                    }
                                @endphp

                                @if ($key < $show)
                                    <div class="page-block--5__half">
                                        <p class="planet page-block--5__title icon-sign icon-sign" style="font-size: 16px !important">
                                             <span>{{ $item->fromPlanet->symbol }}</span> @if ($item->aspect->symbol === 'q')
                                                
                                                <svg xmlns:dc="http://purl.org/dc/elements/1.1/"
                                                    xmlns:cc="http://creativecommons.org/ns#"
                                                    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                                                    xmlns:svg="http://www.w3.org/2000/svg"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
                                                    xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
                                                   width="12px" height="12px" viewBox="0 0 12 12" version="1.1"
                                                    id="svg9" sodipodi:docname="Pallas_symbol_(fixed_width).svg"
                                                    inkscape:version="0.92.5 (2060ec1f9f, 2020-04-08)"
                                                    style="margin-left: 5px ; margin-right: 5px">
                                                    <metadata id="metadata15">
                                                        <rdf:RDF>
                                                            <cc:Work rdf:about="">
                                                                <dc:format>image/svg+xml</dc:format>
                                                                <dc:type
                                                                    rdf:resource="http://purl.org/dc/dcmitype/StillImage" />
                                                            </cc:Work>
                                                        </rdf:RDF>
                                                    </metadata>
                                                    <defs id="defs13" />
                                                    <sodipodi:namedview pagecolor="#ffffff" bordercolor="#666666"
                                                        borderopacity="1" objecttolerance="10" gridtolerance="10"
                                                        guidetolerance="10" inkscape:pageopacity="0"
                                                        inkscape:pageshadow="2" inkscape:window-width="1920"
                                                        inkscape:window-height="1015" id="namedview11"
                                                        showgrid="false" inkscape:zoom="29.5" inkscape:cx="7.5762712"
                                                        inkscape:cy="5.9661012" inkscape:window-x="0"
                                                        inkscape:window-y="0" inkscape:window-maximized="1"
                                                        inkscape:current-layer="svg9" />
                                                    <path inkscape:connector-curvature="0" id="path4-3"
                                                        d="M 11.00025,6 H 0.99975"
                                                        style="fill:none;stroke: #B56E6C;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        sodipodi:nodetypes="cc" />
                                                    <path inkscape:connector-curvature="0" id="path4-3-6-27-9"
                                                        d="m 6.0000002,6.0000001 2.499937,4.3300179"
                                                        style="fill:none;stroke: #B56E6C;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        sodipodi:nodetypes="cc" />
                                                    <path inkscape:connector-curvature="0" id="path4-3-6-27-3"
                                                        d="M 3.5000629,1.6699816 5.9999993,5.9999992"
                                                        style="fill:none;stroke: #B56E6C;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        sodipodi:nodetypes="cc" />
                                                    <path inkscape:connector-curvature="0" id="path4-3-6-1-6"
                                                        d="M 8.4999375,1.6699816 6.0000005,5.9999999"
                                                        style="fill:none;stroke: #B56E6C;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        sodipodi:nodetypes="cc" />
                                                    <path inkscape:connector-curvature="0" id="path4-3-6-1-0"
                                                        d="M 5.9999995,6.0000002 3.5000625,10.330018"
                                                        style="fill:none;stroke: #B56E6C;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        sodipodi:nodetypes="cc" />
                                                </svg>
                                                
                                            @else
                                                
                                                <span style="font-size: 12px">{{ $item->aspect->symbol }}</span>
                                                
                                            @endif
                                            <span>{{ $item->toPlanet->symbol }}</span>
                                        </p>
                                        <p class="page__text">{!! nl2br($item->content) !!}</p>
                                    </div>
                                    @php $marsAspectFirstPage[] = $key; @endphp
                                @endif
                            @endif
                        @endforeach
                    @else
                        <p class="page__text">
                            <span>この天体は他の天体との関わりがなく、天体の力をうまく発揮できないとされます。</span>
                        </p>
                    @endif
                </div>
            </div>
        </div>
        {{-- @if ($explain->get('MARS')->get('aspect_pattern')->count() > 0 && $explain->get('MARS')->get('aspect_pattern')[2] !== null) --}}
        {{-- @if ($explain->get('MARS')->get('aspect_pattern')->count() > 0 && !empty($explain->get('MARS')->get('aspect_pattern')[2])) --}}
        @if ($explain->get('MARS')->get('aspect_pattern')->forget($marsAspectFirstPage)->values()->count() > 0)
            @php
                $items = $explain->get('MARS')->get('aspect_pattern')->forget($marsAspectFirstPage)->values();
                $length=0;
                foreach($items as $item){
                    $length+= mb_strlen($item->content ?? '','UTF-8'); 
                }
                $showPage2 = ($length <= 900) ? 5 : 4;
                $itemPairs = array_chunk($items->all(), $showPage2);
            @endphp
            @foreach($itemPairs as $itemPair)
            @if ($itemPair[0] !== null)
            <div class="page page29 page--content page--number page--number_left page--mars"
                data-pageno="{{ $page++ }}">
                <div class="page__inner">
                    <div class="page-block page-block--5">
                        @if ($explain->get('MARS')->get('aspect_pattern')->isNotEmpty())
                            {{-- @foreach ($explain->get('MARS')->get('aspect_pattern') as $key => $item) --}}
                            @foreach($itemPair as $key => $item)
                                @if (is_null($item))
                                    @if ($key == 0)
                                    <p class="page__text">
                                        <span>この天体は他の天体との関わりがなく、天体の力をうまく発揮できないとされます。</span>
                                    </p>
                                @else
                                    <p></p>
                                @endif
                                @else
                                    {{-- @if ($key >= 2) --}}
                                        {{-- <div class="page-block--5__half"> --}}
                                            <div class="page-block--5__half">
                                            <p class="planet page-block--5__title icon-sign icon-sign" style="font-size: 16px !important">
                                                 <span>{{ $item->fromPlanet->symbol }}</span> @if ($item->aspect->symbol === 'q')
                                                    
                                                    <svg xmlns:dc="http://purl.org/dc/elements/1.1/"
                                                        xmlns:cc="http://creativecommons.org/ns#"
                                                        xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                                                        xmlns:svg="http://www.w3.org/2000/svg"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
                                                        xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
                                                       width="12px" height="12px" viewBox="0 0 12 12"
                                                        version="1.1" id="svg9"
                                                        sodipodi:docname="Pallas_symbol_(fixed_width).svg"
                                                        inkscape:version="0.92.5 (2060ec1f9f, 2020-04-08)"
                                                    style="margin-left: 5px ; margin-right: 5px">
                                                        <metadata id="metadata15">
                                                            <rdf:RDF>
                                                                <cc:Work rdf:about="">
                                                                    <dc:format>image/svg+xml</dc:format>
                                                                    <dc:type
                                                                        rdf:resource="http://purl.org/dc/dcmitype/StillImage" />
                                                                </cc:Work>
                                                            </rdf:RDF>
                                                        </metadata>
                                                        <defs id="defs13" />
                                                        <sodipodi:namedview pagecolor="#ffffff" bordercolor="#666666"
                                                            borderopacity="1" objecttolerance="10" gridtolerance="10"
                                                            guidetolerance="10" inkscape:pageopacity="0"
                                                            inkscape:pageshadow="2" inkscape:window-width="1920"
                                                            inkscape:window-height="1015" id="namedview11"
                                                            showgrid="false" inkscape:zoom="29.5"
                                                            inkscape:cx="7.5762712" inkscape:cy="5.9661012"
                                                            inkscape:window-x="0" inkscape:window-y="0"
                                                            inkscape:window-maximized="1"
                                                            inkscape:current-layer="svg9" />
                                                        <path inkscape:connector-curvature="0" id="path4-3"
                                                            d="M 11.00025,6 H 0.99975"
                                                            style="fill:none;stroke: #B56E6C;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            sodipodi:nodetypes="cc" />
                                                        <path inkscape:connector-curvature="0" id="path4-3-6-27-9"
                                                            d="m 6.0000002,6.0000001 2.499937,4.3300179"
                                                            style="fill:none;stroke: #B56E6C;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            sodipodi:nodetypes="cc" />
                                                        <path inkscape:connector-curvature="0" id="path4-3-6-27-3"
                                                            d="M 3.5000629,1.6699816 5.9999993,5.9999992"
                                                            style="fill:none;stroke: #B56E6C;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            sodipodi:nodetypes="cc" />
                                                        <path inkscape:connector-curvature="0" id="path4-3-6-1-6"
                                                            d="M 8.4999375,1.6699816 6.0000005,5.9999999"
                                                            style="fill:none;stroke: #B56E6C;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            sodipodi:nodetypes="cc" />
                                                        <path inkscape:connector-curvature="0" id="path4-3-6-1-0"
                                                            d="M 5.9999995,6.0000002 3.5000625,10.330018"
                                                            style="fill:none;stroke: #B56E6C;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            sodipodi:nodetypes="cc" />
                                                    </svg>
                                                    
                                                @else
                                                    
                                                    <span style="font-size: 12px">{{ $item->aspect->symbol }}</span>
                                                    
                                                @endif
                                                <span>{{ $item->toPlanet->symbol }}</span>
                                            </p>
                                            <p class="page__text">{!! nl2br($item->content) !!}</p>
                                        </div>
                                    {{-- @endif --}}
                                @endif
                            @endforeach
                        @else
                            <p class="page__text">
                                <span>この天体は他の天体との関わりがなく、天体の力をうまく発揮できないとされます。</span>
                            </p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="page-break-before"></div>
            @endif
            @endforeach
        @endif
        <div class="page-break-before"></div>
        {{-- <div class="page page30 page--bg page--number page--number_right" data-pageno="{{ $page++ }}"></div> --}}
        <div class="page-break-before"></div>
        <div class="page page31 page--cover page--jupiter page--number page--number_right"
            data-pageno="" data-title="Jupiter">
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
                <div class="page--cover__image jupiter"><svg></svg>
                </div>
                <span class="page--cover__frame"></span>
            </div>
        </div>
        @php
            $page++;
        @endphp
        <div class="page-break-before"></div>
        <div class="page page32 page--content page--jupiter page--number page--number_left"
            data-pageno="{{ $page++ }}">
            <div class="page__inner">
                <div class="page-block page-block--1">
                    <p class="page-block--1__title">
                        <span
                            class="icon-sign icon-sign--{{ $explain->get('JUPITER')->get('zodiac_pattern')->zodiac->name_en }}">サイン
                            {{ $explain->get('JUPITER')->get('zodiac_pattern')->zodiac->name }}</span>
                        <span
                            class="handfont1">{{ $explain->get('JUPITER')->get('zodiac_pattern')->zodiac->name_en }}</span>
                    </p>
                    <p class="page__text">
                        <span style="text-indent: 0;">{!! nl2br($explain->get('JUPITER')->get('zodiac_pattern')->content) !!}</span>
                    </p>
                </div>
                <div class="page-block page-block--2">
                    <p class="page-block--2__title">木星のサビアンシンボル</p>
                    <p class="page__text">
                        <span>木星は一つのサインにおよそ１年間滞在するため、あなたの木星の性質は、サビアンシンボルが最もよくあらわしています。木星のシンボル解説に書かれた能力などが、あなたの社会的な成功につながるのだとはっきりと認識できるといいでしょう。</span>
                    </p>
                </div>
                <div class="page-block page-block--3">
                    @if (empty($explain->get('JUPITER')->get('sabian_pattern')))
                        <p class="page-block--3__title">これは特殊なケースです。 角度が0度の場合はサビアンは存在しません</p>
                    @else
                        <p class="page-block--3__title">
                            {{ $explain->get('JUPITER')->get('sabian_pattern')->zodiac->name }}{{ $explain->get('JUPITER')->get('sabian_pattern')->sabian_degrees }}
                            度「{{ $explain->get('JUPITER')->get('sabian_pattern')->title }}」</p>
                        <p class="page__text">
                            <span style="text-indent: 0;">{!! nl2br($explain->get('JUPITER')->get('sabian_pattern')->content) !!}</span>
                        </p>
                    @endif
                </div>
            </div>
        </div>
        <div class="page-break-before"></div>
        <div class="page page33 page--content page--jupiter page--number page--number_right"
            data-pageno="{{ $page++ }}">
            <div class="page__inner">
                <div class="page-block page-block--4">
                    <p class="page-block--4__title">
                        ハウス<span>{{ $explain->get('JUPITER')->get('house_pattern')->house->symbol }}</span></p>
                    <p class="page__text">
                        <span style="text-indent: 0;">{!! nl2br($explain->get('JUPITER')->get('house_pattern')->content) !!}</span>
                    </p>
                </div>
                <div class="page-block page-block--2">
                    <p class="page-block--2__title">アスペクト<span>他の天体との関わりからわかること</span></p>
                    <p class="page__text">
                        <span>木星は拡大させ光を当てる天体であり、これまでの天体にアスペクトをしていたなら、すでにその天体の恵まれた要素として先の鑑定文に掲載済みです。<br>
                            　トランスサタニアンとのアスペクトは世代的な傾向でもあり、わりと漠然としたものとなりますが、参考にはなるでしょう。</span>
                    </p>
                </div>

                @php 
                    $jupiterHouse = mb_strlen($explain->get('JUPITER')->get('house_pattern')->content ?? '', 'UTF-8');
                    $key2 = mb_strlen($explain['JUPITER']['aspect_pattern'][2]->content ?? '', 'UTF-8');
                    $key3 = mb_strlen($explain['JUPITER']['aspect_pattern'][3]->content ?? '', 'UTF-8');
                    $jupiterKey01 = $totalLength['JUPITER']['key01'];
                    $jupiterKey23 = $totalLength['JUPITER']['key23'];
                    $length = 0;
                    foreach($explain['JUPITER']['aspect_pattern'] as $item){
                        $length+= mb_strlen($item->content ?? '','UTF-8'); 
                    }
                @endphp
                
                <div class="page-block page-block--5">
                    {{-- @if (!$explain->get('JUPITER')->get('aspect_pattern')->isNotEmpty())
                        <p class="page__text">
                            <span>この天体は他の天体との関わりがなく、天体の力をうまく発揮できないとされます。</span>
                        </p>
                    @endif --}}
                    @if ($explain->get('JUPITER')->get('aspect_pattern')->isNotEmpty())
                        @foreach ($explain->get('JUPITER')->get('aspect_pattern') as $key => $item)
                            @if (is_null($item))
                                @if ($key == 0)
                                    <p class="page__text">
                                        <span>この天体は他の天体との関わりがなく、天体の力をうまく発揮できないとされます。</span>
                                    </p>
                                @else
                                    <p></p>
                                @endif
                            @else

                                @php
                                    switch (true) {
                                        case $jupiterKey01 > 300 && $jupiterKey01 <350:
                                            $show = ($jupiterHouse<160) ? ($jupiterKey23 < 280 ? 4 : 3) : ($jupiterKey23 < 50 ? 4 : 3);
                                            break;

                                        case $jupiterKey01 > 250 && $jupiterKey01 < 300 :
                                            $show = ($jupiterHouse<160) ? ($jupiterKey23 < 180 ? 4 : 3) : ($jupiterKey23 < 150 ? 4 : 3);
                                            break;
                                        case $jupiterKey01 > 350 && $jupiterKey01 <650:
                                            $show = ($jupiterHouse<160) ? ( $key2 < 120 ? 3 : 2) : ($key2 < 50 ? 3 : 2);
                                            break;
                                        case $jupiterKey01 > 50 && $jupiterKey01 < 250:
                                            $show = ($jupiterHouse<160) ? ($jupiterKey23 < 371 && $key2 > 150 ? 4 : 3) : ($jupiterKey23 < 50 ? 4 : 3);
                                            break;

                                        case $jupiterKey01 < 50:
                                            $show = ($jupiterHouse<160) ? ($jupiterKey23 < 371 && $key2 > 150 ? 4 : 3) : ($jupiterKey23 < 50 ? 4 : 3);
                                            break;
                                    }
                                @endphp

                                @if ($key < $show)
                                    <div class="page-block--5__half">
                                        <p class="planet page-block--5__title icon-sign icon-sign" style="font-size: 16px !important">
                                             <span>{{ $item->fromPlanet->symbol }}</span> @if ($item->aspect->symbol === 'q')
                                                
                                                <svg xmlns:dc="http://purl.org/dc/elements/1.1/"
                                                    xmlns:cc="http://creativecommons.org/ns#"
                                                    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                                                    xmlns:svg="http://www.w3.org/2000/svg"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
                                                    xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
                                                   width="12px" height="12px" viewBox="0 0 12 12"
                                                    version="1.1" id="svg9"
                                                    sodipodi:docname="Pallas_symbol_(fixed_width).svg"
                                                    inkscape:version="0.92.5 (2060ec1f9f, 2020-04-08)"
                                                    style="margin-left: 5px ; margin-right: 5px">
                                                    <metadata id="metadata15">
                                                        <rdf:RDF>
                                                            <cc:Work rdf:about="">
                                                                <dc:format>image/svg+xml</dc:format>
                                                                <dc:type
                                                                    rdf:resource="http://purl.org/dc/dcmitype/StillImage" />
                                                            </cc:Work>
                                                        </rdf:RDF>
                                                    </metadata>
                                                    <defs id="defs13" />
                                                    <sodipodi:namedview pagecolor="#ffffff" bordercolor="#666666"
                                                        borderopacity="1" objecttolerance="10" gridtolerance="10"
                                                        guidetolerance="10" inkscape:pageopacity="0"
                                                        inkscape:pageshadow="2" inkscape:window-width="1920"
                                                        inkscape:window-height="1015" id="namedview11"
                                                        showgrid="false" inkscape:zoom="29.5"
                                                        inkscape:cx="7.5762712" inkscape:cy="5.9661012"
                                                        inkscape:window-x="0" inkscape:window-y="0"
                                                        inkscape:window-maximized="1"
                                                        inkscape:current-layer="svg9" />
                                                    <path inkscape:connector-curvature="0" id="path4-3"
                                                        d="M 11.00025,6 H 0.99975"
                                                        style="fill:none;stroke: #739082;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        sodipodi:nodetypes="cc" />
                                                    <path inkscape:connector-curvature="0" id="path4-3-6-27-9"
                                                        d="m 6.0000002,6.0000001 2.499937,4.3300179"
                                                        style="fill:none;stroke: #739082;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        sodipodi:nodetypes="cc" />
                                                    <path inkscape:connector-curvature="0" id="path4-3-6-27-3"
                                                        d="M 3.5000629,1.6699816 5.9999993,5.9999992"
                                                        style="fill:none;stroke: #739082;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        sodipodi:nodetypes="cc" />
                                                    <path inkscape:connector-curvature="0" id="path4-3-6-1-6"
                                                        d="M 8.4999375,1.6699816 6.0000005,5.9999999"
                                                        style="fill:none;stroke: #739082;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        sodipodi:nodetypes="cc" />
                                                    <path inkscape:connector-curvature="0" id="path4-3-6-1-0"
                                                        d="M 5.9999995,6.0000002 3.5000625,10.330018"
                                                        style="fill:none;stroke: #739082;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        sodipodi:nodetypes="cc" />
                                                </svg>
                                                
                                            @else
                                                
                                                <span style="font-size: 12px">{{ $item->aspect->symbol }}</span>
                                                
                                            @endif
                                            <span>{{ $item->toPlanet->symbol }}</span>
                                        </p>
                                        <p class="page__text">{!! nl2br($item->content) !!}</p>
                                    </div>
                                    @php $jupiterAspectFirstPage[] = $key; @endphp
                                @endif
                            @endif
                        @endforeach
                    @else
                        <p class="page__text">
                            <span>この天体は他の天体との関わりがなく、天体の力をうまく発揮できないとされます。</span>
                        </p>
                    @endif
                </div>
            </div>
        </div>
        {{-- @if ($explain->get('JUPITER')->get('aspect_pattern')->count() > 0 && $explain->get('JUPITER')->get('aspect_pattern')[2] !== null)) --}}
        {{-- @if ($explain->get('JUPITER')->get('aspect_pattern')->count() > 0 && !empty($explain->get('JUPITER')->get('aspect_pattern')[2])) --}}
        @if ($explain->get('JUPITER')->get('aspect_pattern')->forget($jupiterAspectFirstPage)->values()->count() > 0)
            @php
                $items = $explain->get('JUPITER')->get('aspect_pattern')->forget($jupiterAspectFirstPage)->values();
                $length=0;
                foreach($items as $item){
                    $length+= mb_strlen($item->content ?? '','UTF-8'); 
                }
                $showPage2 = ($length <= 900) ? 5 : 4;
                $itemPairs = array_chunk($items->all(), $showPage2);
                //$itemPairs = array_chunk($items->all(), 4);
            @endphp
            @foreach($itemPairs as $itemPair)
            @if ($itemPair[0] !== null)
            <div class="page page33 page--content page--number page--number_left page--jupiter"
                data-pageno="{{ $page++ }}">
                <div class="page__inner">
                    <div class="page-block page-block--5">
                        @if ($explain->get('JUPITER')->get('aspect_pattern')->isNotEmpty())
                            {{-- @foreach ($explain->get('JUPITER')->get('aspect_pattern') as $key => $item) --}}
                            @foreach($itemPair as $key => $item)
                                @if (is_null($item))
                                    @if ($key == 0)
                                    <p class="page__text">
                                        <span>この天体は他の天体との関わりがなく、天体の力をうまく発揮できないとされます。</span>
                                    </p>
                                @else
                                    <p></p>
                                @endif
                                @else
                                    {{-- @if ($key >= 2) --}}
                                        {{-- <div class="page-block--5__half"> --}}
                                        <div class="page-block--5__half">
                                            <p class="planet page-block--5__title icon-sign icon-sign" style="font-size: 16px !important">
                                                 <span>{{ $item->fromPlanet->symbol }}</span> @if ($item->aspect->symbol === 'q')
                                                    
                                                    <svg xmlns:dc="http://purl.org/dc/elements/1.1/"
                                                        xmlns:cc="http://creativecommons.org/ns#"
                                                        xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                                                        xmlns:svg="http://www.w3.org/2000/svg"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
                                                        xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
                                                       width="12px" height="12px" viewBox="0 0 12 12"
                                                        version="1.1" id="svg9"
                                                        sodipodi:docname="Pallas_symbol_(fixed_width).svg"
                                                        inkscape:version="0.92.5 (2060ec1f9f, 2020-04-08)"
                                                    style="margin-left: 5px ; margin-right: 5px">
                                                        <metadata id="metadata15">
                                                            <rdf:RDF>
                                                                <cc:Work rdf:about="">
                                                                    <dc:format>image/svg+xml</dc:format>
                                                                    <dc:type
                                                                        rdf:resource="http://purl.org/dc/dcmitype/StillImage" />
                                                                </cc:Work>
                                                            </rdf:RDF>
                                                        </metadata>
                                                        <defs id="defs13" />
                                                        <sodipodi:namedview pagecolor="#ffffff"
                                                            bordercolor="#666666" borderopacity="1"
                                                            objecttolerance="10" gridtolerance="10"
                                                            guidetolerance="10" inkscape:pageopacity="0"
                                                            inkscape:pageshadow="2" inkscape:window-width="1920"
                                                            inkscape:window-height="1015" id="namedview11"
                                                            showgrid="false" inkscape:zoom="29.5"
                                                            inkscape:cx="7.5762712" inkscape:cy="5.9661012"
                                                            inkscape:window-x="0" inkscape:window-y="0"
                                                            inkscape:window-maximized="1"
                                                            inkscape:current-layer="svg9" />
                                                        <path inkscape:connector-curvature="0" id="path4-3"
                                                            d="M 11.00025,6 H 0.99975"
                                                            style="fill:none;stroke: #739082;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            sodipodi:nodetypes="cc" />
                                                        <path inkscape:connector-curvature="0" id="path4-3-6-27-9"
                                                            d="m 6.0000002,6.0000001 2.499937,4.3300179"
                                                            style="fill:none;stroke: #739082;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            sodipodi:nodetypes="cc" />
                                                        <path inkscape:connector-curvature="0" id="path4-3-6-27-3"
                                                            d="M 3.5000629,1.6699816 5.9999993,5.9999992"
                                                            style="fill:none;stroke: #739082;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            sodipodi:nodetypes="cc" />
                                                        <path inkscape:connector-curvature="0" id="path4-3-6-1-6"
                                                            d="M 8.4999375,1.6699816 6.0000005,5.9999999"
                                                            style="fill:none;stroke: #739082;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            sodipodi:nodetypes="cc" />
                                                        <path inkscape:connector-curvature="0" id="path4-3-6-1-0"
                                                            d="M 5.9999995,6.0000002 3.5000625,10.330018"
                                                            style="fill:none;stroke: #739082;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            sodipodi:nodetypes="cc" />
                                                    </svg>
                                                    
                                                @else
                                                    
                                                    <span style="font-size: 12px">{{ $item->aspect->symbol }}</span>
                                                    
                                                @endif
                                                <span>{{ $item->toPlanet->symbol }}</span>
                                            </p>
                                            <p class="page__text">{!! nl2br($item->content) !!}</p>
                                        </div>
                                    {{-- @endif --}}
                                @endif
                            @endforeach
                        @else
                            <p class="page__text">
                                <span>この天体は他の天体との関わりがなく、天体の力をうまく発揮できないとされます。</span>
                            </p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="page-break-before"></div>
            @endif
            @endforeach
        @endif
        <div class="page-break-before"></div>
        {{-- <div class="page page34 page--bg page--number page--number_right" data-pageno="{{ $page++ }}"></div> --}}
        <div class="page-break-before"></div>
        <div class="page page35 page--cover page--saturn page--number page--number_right"
            data-pageno="" data-title="Saturn">
            <div class="page__inner">
                <p class="page--cover__title"><span>土星</span></p>
                <div class="page--cover-block1">
                    <p class="page--cover-block1__title">人生の課題や最終目的［56歳～晩年期］</p>
                    <p class="page__text">
                        <span>土星は肉眼で見える最も遠い星で、わたしたちの個性にかかわる天体は土星までだといえます。また、土星の内側の世界は時間と空間に支配され、この太陽系の「ルール」や「制限」にかかわります。</span>
                        <span>わたしたちは、生まれた時から制限の中で生きています。この体も特性もある種の制限です。しかし、あらゆる創造活動にはルールや制限が必ず必要です。描くべきキャンバスや画材、テーマが無ければ絵を描くことはできないように、この人生はあなたにしかできない何らかの創造活動の場なのです。</span>
                        <span>西洋占星術において、この人生であなたが達成したいことをあらわすのが土星です。若いうちはそれが苦手だと感じても、土星の年齢域である晩年期にはたいてい、それが安定してできるようになっています。</span>
                        <span>土星のテーマは人生の課題であるとされますし、古典的な占星術では大凶星とされますが、本来は、あなたの社会的な基盤や安定にかかわるとともに、人生をより成熟させてくれる大切な天体です。</span>
                        <span>鑑定文を読みながら、あなたがすでに土星の課題を克服できているか、まだまだ苦手なままか、などを感じ取ってみましょう。</span>
                    </p>
                </div>
                <div class="page--cover__image saturn">
                    <svg style="height: 285px; width: 450px;"></svg>
                </div>
                <span class="page--cover__frame"></span>
            </div>
        </div>
        @php
            $page++;
        @endphp
        <div class="page-break-before"></div>
        <div class="page page36 page--content page--saturn page--number page--number_left"
            data-pageno="{{ $page++ }}">
            <div class="page__inner">
                <div class="page-block page-block--1">
                    <p class="page-block--1__title">
                        <span
                            class="icon-sign icon-sign--{{ $explain->get('SATURN')->get('zodiac_pattern')->zodiac->name_en }}">サイン
                            {{ $explain->get('SATURN')->get('zodiac_pattern')->zodiac->name }}</span>
                        <span
                            class="handfont1">{{ $explain->get('SATURN')->get('zodiac_pattern')->zodiac->name_en }}</span>
                    </p>
                    <p class="page__text">
                        <span style="text-indent: 0;">{!! nl2br($explain->get('SATURN')->get('zodiac_pattern')->content) !!}</span>
                    </p>
                </div>
                <div class="page-block page-block--2">
                    <p class="page-block--2__title">土星のサビアンシンボル</p>
                    <p class="page__text">
                        <span>土星のサビアンシンボルには、あなたが時間をかけ、努力して手に入れる能力があらわれています。こういう人です、こういう能力があります、などと書かれた解説文でも、それを手に入れるのは晩年期であり、最終的な目標なのだと認識しておきましょう。また、土星の年齢域の頃にどのように生きるかをサビアンシンボルが示唆していることも多いでしょう。</span>
                    </p>
                </div>
                <div class="page-block page-block--3">
                    @if (empty($explain->get('SATURN')->get('sabian_pattern')))
                        <p class="page-block--3__title">これは特殊なケースです。 角度が0度の場合はサビアンは存在しません</p>
                    @else
                        <p class="page-block--3__title">
                            {{ $explain->get('SATURN')->get('sabian_pattern')->zodiac->name }}{{ $explain->get('SATURN')->get('sabian_pattern')->sabian_degrees }}
                            度「{{ $explain->get('SATURN')->get('sabian_pattern')->title }}」</p>
                        <p class="page__text">
                            <span style="text-indent: 0;">{!! nl2br($explain->get('SATURN')->get('sabian_pattern')->content) !!}</span>
                        </p>
                    @endif
                </div>
            </div>
        </div>
        <div class="page-break-before"></div>
        <div class="page page37 page--content page--saturn page--number page--number_right"
            data-pageno="{{ $page++ }}">
            <div class="page__inner">
                <div class="page-block page-block--4">
                    <p class="page-block--4__title">
                        ハウス<span>{{ $explain->get('SATURN')->get('house_pattern')->house->symbol }}</span></p>
                    <p class="page__text">
                        <span style="text-indent: 0;">{!! nl2br($explain->get('SATURN')->get('house_pattern')->content) !!}</span>
                    </p>
                </div>
                <div class="page-block page-block--2">
                    <p class="page-block--2__title">アスペクト<span>他の天体との関わりからわかること</span></p>
                    <p class="page__text">
                        <span>土星は他の天体とアスペクトすると、その天体の意味するテーマに制限をかけたり「苦手」にしてしまうことが多くなります。アスペクトがあればすでに出ている天体の箇所に記載済みです。天王星、海王星、冥王星とのアスペクトをお持ちの場合はここに記載されます。世代的な傾向ではありますが、社会生活の中で感じられる面も多いと思います。</span>
                    </p>
                </div>

                @php 
                    $saturnHouse = mb_strlen($explain->get('SATURN')->get('house_pattern')->content ?? '', 'UTF-8');
                    $key2 = mb_strlen($explain['SATURN']['aspect_pattern'][2]->content ?? '', 'UTF-8');
                    $key3 = mb_strlen($explain['SATURN']['aspect_pattern'][3]->content ?? '', 'UTF-8');
                    $saturnKey01 = $totalLength['SATURN']['key01'];
                    $saturnKey23 = $totalLength['SATURN']['key23'];
                    $length = 0;
                    foreach($explain['SATURN']['aspect_pattern'] as $item){
                        $length+= mb_strlen($item->content ?? '','UTF-8'); 
                    }
                @endphp

                <div class="page-block page-block--5">
                    {{-- @if (!$explain->get('SATURN')->get('aspect_pattern')->isNotEmpty())
                        <p class="page__text">
                            <span>この天体は他の天体との関わりがなく、天体の力をうまく発揮できないとされます。</span>
                        </p>
                    @endif --}}
                    @if ($explain->get('SATURN')->get('aspect_pattern')->isNotEmpty())
                        @foreach ($explain->get('SATURN')->get('aspect_pattern') as $key => $item)
                            @if (is_null($item))
                                @if ($key == 0)
                                    <p class="page__text">
                                        <span>この天体は他の天体との関わりがなく、天体の力をうまく発揮できないとされます。</span>
                                    </p>
                                @else
                                    <p></p>
                                @endif
                            @else
                                @php
                                    switch (true) {
                                        case $saturnKey01 > 300 && $saturnKey01 <350:
                                            $show = ($saturnHouse<160) ? ($saturnKey23 < 280 ? 4 : 3) : ($saturnKey23 < 50 ? 4 : 3);
                                            break;

                                        case $saturnKey01 > 250 && $saturnKey01 < 300 :
                                            $show = ($saturnHouse<160) ? ($saturnKey23 < 180 ? 4 : 3) : ($saturnKey23 < 150 ? 4 : 3);
                                            break;
                                        case $saturnKey01 > 350 && $saturnKey01 <650:
                                            $show = ($saturnHouse<160) ? ( $key2 < 120 ? 3 : 2) : ($key2 < 50 ? 3 : 2);
                                            break;
                                        case $saturnKey01 > 50 && $saturnKey01 < 250:
                                            $show = ($saturnHouse<160) ? ($saturnKey23 < 371 && $key2 > 150 ? 4 : 3) : ($saturnKey23 < 50 ? 4 : 3);
                                            break;

                                        case $saturnKey01 < 50:
                                            $show = ($saturnHouse<160) ? ($saturnKey23 < 371 && $key2 > 150 ? 4 : 3) : ($saturnKey23 < 50 ? 4 : 3);
                                            break;
                                    }
                                @endphp

                                @if ($key < $show)
                                    <div class="page-block--5__half">
                                        <p class="planet page-block--5__title icon-sign icon-sign" style="font-size: 16px !important">
                                             <span>{{ $item->fromPlanet->symbol }}</span> @if ($item->aspect->symbol === 'q')
                                                
                                                <svg xmlns:dc="http://purl.org/dc/elements/1.1/"
                                                    xmlns:cc="http://creativecommons.org/ns#"
                                                    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                                                    xmlns:svg="http://www.w3.org/2000/svg"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
                                                    xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
                                                   width="12px" height="12px" viewBox="0 0 12 12"
                                                    version="1.1" id="svg9"
                                                    sodipodi:docname="Pallas_symbol_(fixed_width).svg"
                                                    inkscape:version="0.92.5 (2060ec1f9f, 2020-04-08)"
                                                    style="margin-left: 5px ; margin-right: 5px">
                                                    <metadata id="metadata15">
                                                        <rdf:RDF>
                                                            <cc:Work rdf:about="">
                                                                <dc:format>image/svg+xml</dc:format>
                                                                <dc:type
                                                                    rdf:resource="http://purl.org/dc/dcmitype/StillImage" />
                                                            </cc:Work>
                                                        </rdf:RDF>
                                                    </metadata>
                                                    <defs id="defs13" />
                                                    <sodipodi:namedview pagecolor="#ffffff" bordercolor="#666666"
                                                        borderopacity="1" objecttolerance="10" gridtolerance="10"
                                                        guidetolerance="10" inkscape:pageopacity="0"
                                                        inkscape:pageshadow="2" inkscape:window-width="1920"
                                                        inkscape:window-height="1015" id="namedview11"
                                                        showgrid="false" inkscape:zoom="29.5"
                                                        inkscape:cx="7.5762712" inkscape:cy="5.9661012"
                                                        inkscape:window-x="0" inkscape:window-y="0"
                                                        inkscape:window-maximized="1"
                                                        inkscape:current-layer="svg9" />
                                                    <path inkscape:connector-curvature="0" id="path4-3"
                                                        d="M 11.00025,6 H 0.99975"
                                                        style="fill:none;stroke: #A29381;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        sodipodi:nodetypes="cc" />
                                                    <path inkscape:connector-curvature="0" id="path4-3-6-27-9"
                                                        d="m 6.0000002,6.0000001 2.499937,4.3300179"
                                                        style="fill:none;stroke: #A29381;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        sodipodi:nodetypes="cc" />
                                                    <path inkscape:connector-curvature="0" id="path4-3-6-27-3"
                                                        d="M 3.5000629,1.6699816 5.9999993,5.9999992"
                                                        style="fill:none;stroke: #A29381;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        sodipodi:nodetypes="cc" />
                                                    <path inkscape:connector-curvature="0" id="path4-3-6-1-6"
                                                        d="M 8.4999375,1.6699816 6.0000005,5.9999999"
                                                        style="fill:none;stroke: #A29381;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        sodipodi:nodetypes="cc" />
                                                    <path inkscape:connector-curvature="0" id="path4-3-6-1-0"
                                                        d="M 5.9999995,6.0000002 3.5000625,10.330018"
                                                        style="fill:none;stroke: #A29381;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        sodipodi:nodetypes="cc" />
                                                </svg>
                                                
                                            @else
                                                
                                                <span style="font-size: 12px">{{ $item->aspect->symbol }}</span>
                                                
                                            @endif
                                            <span>{{ $item->toPlanet->symbol }}</span>
                                        </p>
                                        <p class="page__text">{!! nl2br($item->content) !!}</p>
                                    </div>
                                    @php $saturnAspectFirstPage[] = $key; @endphp
                                @endif
                            @endif
                        @endforeach
                    @else
                        <p class="page__text">
                            <span>この天体は他の天体との関わりがなく、天体の力をうまく発揮できないとされます。</span>
                        </p>
                    @endif
                </div>
            </div>
        </div>
        {{-- @if ($explain->get('SATURN')->get('aspect_pattern')->count() > 0 && $explain->get('SATURN')->get('aspect_pattern')[2] !== null) --}}
        {{-- @if ($explain->get('SATURN')->get('aspect_pattern')->count() > 0 && !empty($explain->get('SATURN')->get('aspect_pattern')[2])) --}}
        @if ($explain->get('SATURN')->get('aspect_pattern')->forget($saturnAspectFirstPage)->values()->count() > 0)
            @php
                $items = $explain->get('SATURN')->get('aspect_pattern')->forget($saturnAspectFirstPage)->values();
                $length=0;
                foreach($items as $item){
                    $length+= mb_strlen($item->content ?? '','UTF-8'); 
                }
                $showPage2 = ($length <= 900) ? 5 : 4;
                $itemPairs = array_chunk($items->all(), $showPage2);
                //$itemPairs = array_chunk($items->all(), 4);
            @endphp
            @foreach($itemPairs as $itemPair)
            @if ($itemPair[0] !== null)
            <div class="page page37 page--content page--number page--number_left page--saturn"
                data-pageno="{{ $page++ }}">
                <div class="page__inner">
                    <div class="page-block page-block--5">
                        @if ($explain->get('SATURN')->get('aspect_pattern')->isNotEmpty())
                            {{-- @foreach ($explain->get('SATURN')->get('aspect_pattern') as $key => $item) --}}
                            @foreach($itemPair as $key => $item)
                                @if (is_null($item))
                                    @if ($key == 0)
                                    <p class="page__text">
                                        <span>この天体は他の天体との関わりがなく、天体の力をうまく発揮できないとされます。</span>
                                    </p>
                                @else
                                    <p></p>
                                @endif
                                @else
                                    {{-- @if ($key >= 2) --}}
                                        {{-- <div class="page-block--5__half"> --}}
                                        <div class="page-block--5__half">
                                            <p class="planet page-block--5__title icon-sign icon-sign" style="font-size: 16px !important">
                                                 <span>{{ $item->fromPlanet->symbol }}</span> @if ($item->aspect->symbol === 'q')
                                                    
                                                    <svg xmlns:dc="http://purl.org/dc/elements/1.1/"
                                                        xmlns:cc="http://creativecommons.org/ns#"
                                                        xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                                                        xmlns:svg="http://www.w3.org/2000/svg"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
                                                        xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
                                                       width="12px" height="12px" viewBox="0 0 12 12"
                                                        version="1.1" id="svg9"
                                                        sodipodi:docname="Pallas_symbol_(fixed_width).svg"
                                                        inkscape:version="0.92.5 (2060ec1f9f, 2020-04-08)"
                                                    style="margin-left: 5px ; margin-right: 5px">
                                                        <metadata id="metadata15">
                                                            <rdf:RDF>
                                                                <cc:Work rdf:about="">
                                                                    <dc:format>image/svg+xml</dc:format>
                                                                    <dc:type
                                                                        rdf:resource="http://purl.org/dc/dcmitype/StillImage" />
                                                                </cc:Work>
                                                            </rdf:RDF>
                                                        </metadata>
                                                        <defs id="defs13" />
                                                        <sodipodi:namedview pagecolor="#ffffff"
                                                            bordercolor="#666666" borderopacity="1"
                                                            objecttolerance="10" gridtolerance="10"
                                                            guidetolerance="10" inkscape:pageopacity="0"
                                                            inkscape:pageshadow="2" inkscape:window-width="1920"
                                                            inkscape:window-height="1015" id="namedview11"
                                                            showgrid="false" inkscape:zoom="29.5"
                                                            inkscape:cx="7.5762712" inkscape:cy="5.9661012"
                                                            inkscape:window-x="0" inkscape:window-y="0"
                                                            inkscape:window-maximized="1"
                                                            inkscape:current-layer="svg9" />
                                                        <path inkscape:connector-curvature="0" id="path4-3"
                                                            d="M 11.00025,6 H 0.99975"
                                                            style="fill:none;stroke: #A29381;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            sodipodi:nodetypes="cc" />
                                                        <path inkscape:connector-curvature="0" id="path4-3-6-27-9"
                                                            d="m 6.0000002,6.0000001 2.499937,4.3300179"
                                                            style="fill:none;stroke: #A29381;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            sodipodi:nodetypes="cc" />
                                                        <path inkscape:connector-curvature="0" id="path4-3-6-27-3"
                                                            d="M 3.5000629,1.6699816 5.9999993,5.9999992"
                                                            style="fill:none;stroke: #A29381;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            sodipodi:nodetypes="cc" />
                                                        <path inkscape:connector-curvature="0" id="path4-3-6-1-6"
                                                            d="M 8.4999375,1.6699816 6.0000005,5.9999999"
                                                            style="fill:none;stroke: #A29381;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            sodipodi:nodetypes="cc" />
                                                        <path inkscape:connector-curvature="0" id="path4-3-6-1-0"
                                                            d="M 5.9999995,6.0000002 3.5000625,10.330018"
                                                            style="fill:none;stroke: #A29381;stroke-width:0.60000002;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            sodipodi:nodetypes="cc" />
                                                    </svg>
                                                    
                                                @else
                                                    
                                                    <span style="font-size: 12px">{{ $item->aspect->symbol }}</span>
                                                    
                                                @endif
                                                <span>{{ $item->toPlanet->symbol }}</span>
                                            </p>
                                            <p class="page__text">{!! nl2br($item->content) !!}</p>
                                        </div>
                                    {{-- @endif --}}
                                @endif
                            @endforeach
                        @else
                            <p class="page__text">
                                <span>この天体は他の天体との関わりがなく、天体の力をうまく発揮できないとされます。</span>
                            </p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="page-break-before"></div>
            @endif
            @endforeach
        @endif
        <div class="page-break-before"></div>
        {{-- <div class="page page38 page--bg page--number page--number_right" data-pageno="{{ $page++ }}"></div> --}}
        <div class="page-break-before"></div>
        <div class="page page39 page--cover page--dragonhead page--number page--number_right"
            data-pageno="" data-title="Dragon head">
            <div class="page__inner">
                <p class="page--cover__title"><span>ドラゴンヘッド</span></p>
                <div class="page--cover-block1">
                    <p class="page--cover-block1__title">魂の課題</p>
                    <p class="page__text">
                        <span>ドラゴンヘッドは月と太陽の軌道の交点であり、このそばでの新月や満月は「日食」や「月食」となります。太陽は魂の目的意識であり、月は過去や記憶、潜在意識にかかわります。それらが交わるポイントであるドラゴンヘッドは、魂の出入りが行われるホール（穴）のようになっているイメージがあります。</span>
                        <span>魂の出入り口である筒状の穴が「龍」をあらわすのかもしれません。また、「ドラゴンヘッド」の名の通り、世界中の神話に出てくる、一体が輪になって自分のしっぽを噛む蛇や龍のシンボル「ウロボロス」との関連もある感受点です。</span>
                        <span>西洋占星術では、この龍の姿がわたしたちの命の循環、すなわち輪廻転生に例えられます。しっぽはカルマであり、頭部は成長しようとする意識です。</span>
                        <span>それらを踏まえ、わたしたちがどのようなテーマをもって魂の成長を目指して生まれてきたのかをあらわすのがドラゴンヘッドという感受点です。</span>
                    </p>
                </div>
                <div class="page--cover__image dragonhead"><svg></svg></div>
                <span class="page--cover__frame"></span>
            </div>
        </div>
        @php
            $page++;
        @endphp
        <div class="page-break-before"></div>
        <div class="page page40 page--content page--dragonhead page--number page--number_left"
            data-pageno="{{ $page++ }}">
            <div class="page__inner">
                <div class="page-block page-block--1">
                    <p class="page-block--1__title">
                        <span
                            class="icon-sign icon-sign--{{ $explain->get('CHIRON')->get('zodiac_pattern')->zodiac->name_en }}">サイン
                            {{ $explain->get('CHIRON')->get('zodiac_pattern')->zodiac->name }}</span>
                        <span
                            class="handfont1">{{ $explain->get('CHIRON')->get('zodiac_pattern')->zodiac->name_en }}</span>
                    </p>
                    <p class="page__text">
                        <span style="text-indent: 0;">{!! nl2br($explain->get('CHIRON')->get('zodiac_pattern')->content) !!}</span>
                    </p>
                </div>
                <div class="page-block page-block--4">
                    <p class="page-block--4__title">
                        ハウス<span>{{ $explain->get('CHIRON')->get('house_pattern')->house->symbol }}</span></p>
                    <p class="page__text">
                        <span style="text-indent: 0;">{!! nl2br($explain->get('CHIRON')->get('house_pattern')->content) !!}</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="page-break-before"></div>
        <div class="page page41 page--cover page--cover-head" data-title="{{ $dayCreate }}">
            <div class="page__inner">
                <div class="page41-block-wrap">
                    <div class="page41-block page41-block--english">
                        <p class="page41-block__title handfont2">
                            <img src="{{ asset('/assets/images/img_page41_message.png') }}"
                                style="width: 450px; height: 310px; object-fit: contain;"
                                >
                        </p>
                    </div>
                </div>
                <div class="page--cover__image">
                    <img src="{{ asset('/assets/images/img_page41.png') }}"
                        srcset="{{ asset('/assets/images/img_page41.png') }} 1x, {{ asset('/assets/images/img_page41@2x.png') }} 2x"
                        alt="アリストテレス"
                        style="width: 27rem; height: auto;">
                </div>
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
