<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Module Horoscope</title>
    {{-- Laravel Vite - CSS File --}}
    {{ module_vite('build-horoscope', 'Resources/assets/sass/app.scss') }}
    {{ module_vite('build-horoscope', 'Resources/assets/js/app.js') }}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;600&display=swap" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+SC&display=swap" rel="stylesheet">
    <!-- Scripts -->
    <style>
        .container {
            max-width: 800px;
            margin: auto;
            background-image:
        }

        @font-face {
            font-family: 'zodiac';
            src: url("https://db.onlinewebfonts.com/t/f49b03e1cd95150f726af35c7d3b5250.woff")format("woff");
            font-weight: normal;
        }

        p.planet {
            font-family: 'zodiac';
            font-size: 25px;
        }

        p {
            font-family: 'Noto Sans JP', sans-serif;
            font-size: 14px;
            word-wrap: break-word;
        }

        p.bold {
            font-family: 'Noto Sans JP', sans-serif;
            font-weight: 600;
            font-size: 15px;
        }

        .cover-image {
            margin: 3% 0;
            text-align: center;
        }

        .cover-image .header,
        .cover-image .footer {
            text-align: center;
        }

        .cover-image .center {
            color: #2e5395;
        }

        .cover-image .center h1 {
            font-family: 'Times New Roman', Times, serif;
            font-size: 2.5rem;
            margin: 50px 0px;
        }

        .cover-image .center img {
            display: block;
            margin: auto;
        }

        .message-text {
            padding-left: 10%;
            padding-top: 15%;
        }

        .commentary {
            padding: 12% 8%;
        }

        .page-break {
            page-break-after: always;
        }

        .page-break .border-card {
            width: 100%;
            height: auto;
            border: 1px solid black;
        }

        .page-break .border-card .title-card {
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="container">
        @php
            $removePlanet = Modules\Horoscope\Enums\ExplainEnum::removePlanet;
        @endphp
        {{-- conver image page --}}
        <div class="cover-image page-break">
            <div class="header">
                <img style="width:211px; height:165px;color:blue;"
                    src="https://hoshinomai.jp/wp/wp-content/themes/hosinomai/img/common/page_logo.svg" alt="星の舞">
            </div>
            <div class="center">
                <h1>Your Horoscope Blueprint</h1>
                <img src="data:image/png;base64, {{ $image }}" style="max-width: 800px" alt="horoscope">
            </div>
            <div class="footer">
                <p>{{ $formData['year'] }} 年 {{ $formData['month'] }} 月 {{ $formData['day'] }}
                    日&nbsp;&nbsp;{{ $formData['hour'] }} 時 {{ $formData['minute'] }}
                    分&nbsp;&nbsp;{{ $formData['map-city'] }}</p>
            </div>
        </div>
        {{-- message text page (include nek) --}}
        <div class="message-text page-break">
            <p>上なるもののごとく、下なるものはあり</p>
            <p>あなたが生まれたとき、星々がどんな状態だったかを知っていますか？<br>
                あなたが「どんな星の元に生まれたか」を知ることは、<br>
                あなたの「魂のブループリント」を知ることでもあります。<br>
            </p>
            <p>星のエネルギーが魂に転写されて、あなたの唯一無二の個性を紡ぎあげています。<br></p>
            <p>わたしの願いは、多くの人が、自分の生まれた時の星の配置を知り、<br>
                その人が自分の人生を星々のように輝かせて生きてもらうことです。<br>
            </p>
            <p>占星術は古代シュメール時代にその原型ができ、<br>
                ヘレニズム時代に今の形になったといわれます。<br>
            </p>
            <p>長い歴史を経て、現代にまで継承され続けた秘密の情報でもあるのです。</p>
            <p>このシステムをつくった海部舞は、2014 年に西洋占星術に出会い、<br>
                その情報の深遠さ、素晴らしさに魅了された、日本に住む一介の占星術師です。<br>
            </p>
            <p>自分のホロスコープを知り、自己認識を深め、理想の誰かとか、親が望む誰かではない、<br>
                自分自身を真っすぐに生きることの重要性に気がつきました。<br>
            </p>
            <p>そのおかげで人生が大きく変わり、精神的にも大きく成長することができました。</p>
            <p>人生を誰かのせいにしなくなり、他者の人生や価値観に寛容になることができ、<br>
                自分と宇宙を信頼して生きることができるようになりました。<br>
            </p>
            <p>魂のブループリントを知ることで、「わたしとして生まれてよかった！」と思える人が一人でも増<br>
                えることを願っています。
            </p>
        </div>
        {{-- Commentary page --}}
        <div class="commentary page-break">
            <p class="bold">生まれた時の天体の情報を読み解く</p>
            <p>&nbsp;&nbsp;このホロスコープブループリントに掲載するのは、月、水星、金星、太陽、火星、木星、土星<br>
                の情報をメインとし、更に、天王星、海王星、冥王星が月から土星までの星々に何らかの働きか<br>
                けをしていればお伝えしています。<br>
                また、ドラゴンヘッドという月と太陽の軌道が交わるポイントから分かる、あなたの魂の課題も<br>
                お伝えします。<br>
            </p>
            <p>&nbsp;&nbsp;各天体にはそれぞれ、個人に影響を及ぼすテーマと、天体の性質が最も強く現れる「年齢域」<br>
                があります。また、それぞれの天体が、生まれた時にどのサイン（12&nbsp;星座）にあり、どのハウス<br>
                にあるか、他の天体とどんな角度をとっているか、といった情報を総合的に見ていくことになり<br>
                ます。<br>
            </p>
            <p class="bold">サビアン占星術という新しい技法</p>
            <p>&nbsp;&nbsp;さらに、ここには、サビアンシンボルの情報も掲載します。<br>
                &nbsp;&nbsp;サビアンシンボルとは、12&nbsp;星座の度数ごとのエネルギーを詩的な文章であらわしたもので、<br>
                1925&nbsp;年にアメリカのマーク・エドモンド・ジョーンズという占星術家が、エリス・フィラーとい<br>
                う霊能者と共に実験的に&nbsp;12&nbsp;サインの各度数から浮かび上がるイメージを記録していく実験から生<br>
                まれています。<br>
            </p>
            <p>&nbsp;&nbsp;海部舞はこのサビアンシンボルを鑑定の際に非常に重視しています。各天体ごとに解説をして<br>
                いく際に、サビアンシンボルからのキーワードも掲載します。各天体のテーマを、更に具体的に<br>
                理解する助けになるでしょう。<br>
            </p>
            <p class="bold">恒星から分かるテーマ</p>
            <p>&nbsp;&nbsp;また、ヘレニズムの占星術の頃から扱われていた、シリウス、ベテルギウス、アンタレスなど<br>
                といった、太陽系よりも遠い銀河の星々は、あなたの魂の故郷であるかのように、その本質的に<br>
                眠っている力の形を教えてくれます。<br>
                &nbsp;&nbsp;若年期、青年期、老年期にそれぞれ発現する力、深いベースとして、潜在意識的に扱われ続け<br>
                る力、といった領域で、関わる星々が異なります。<br>
            </p>
        </div>
        {{-- list explain celestial body page $planet --}}
        @foreach ($explain as $key => $item)
            @if (in_array($key, $removePlanet))
                @continue
            @endif
            <div class="explain-{{ $key }} page-break py-4 px-4">
                <x-horoscope::planetcard :planetExplain=$item />
            </div>
        @endforeach
    </div>

</body>

</html>
