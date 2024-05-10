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
    <style>
        .container {
           max-width: 800px; 
           margin: auto;
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
            font-size: 16px;
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
        body{
    color: #39385d;
}
    </style>
</head>

<body>

    <div class="container"> 
        @php
            $removePlanet = Modules\Horoscope\Enums\ExplainEnum::removePlanet;
        @endphp
        <div class="cover-image page-break">
            <br>
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
        <div class="commentary page-break">
            <p>上なるもののごとく、下なるものはあり</p>
            <p>あなたが生まれたとき、星々がどんな状態だったかを知っていますか？<br>
                あなたが「どんな星の元に生まれたか」を知ることは、あなたの「魂のブループリント」を知ることでもあります。<br>                
            </p>
            <p>星のエネルギーが魂に転写されて、あなたの唯一無二の個性を紡ぎあげています。<br></p>
            <p>わたしの願いは、多くの人が、自分の生まれた時の星の配置を知り、その人が自分の人生を星々のように輝かせて生きてもらうことです。<br>
            </p>
            <p>占星術は古代シュメール時代にその原型ができ、ヘレニズム時代に今の形になったといわれます。<br>               
            </p>
            <p>長い歴史を経て、現代にまで継承され続けた秘密の情報でもあるのです。</p>
            <p>このシステムをつくった海部舞は、2014 年に西洋占星術に出会い、その情報の深遠さ、素晴らしさに魅了された、日本に住む一介の占星術師です。<br>               
            </p>
            <p>自分のホロスコープを知り、自己認識を深め、理想の誰かとか、親が望む誰かではない、自分自身を真っすぐに生きることの重要性に気がつきました。<br>               
            </p>
            <p>そのおかげで人生が大きく変わり、精神的にも大きく成長することができました。</p>
            <p>人生を誰かのせいにしなくなり、他者の人生や価値観に寛容になることができ、自分と宇宙を信頼して生きることができるようになりました。<br>                
            </p>
            <p>魂のブループリントを知ることで、「わたしとして生まれてよかった！」と思える人が一人でも増えることを願っています。              
            </p>
        </div>
        <div class="commentary page-break">
            <p class="bold">生まれた時の天体の情報を読み解く</p>
            <p>&nbsp;&nbsp;このホロスコープブループリントに掲載するのは、月、水星、金星、太陽、火星、木星、土星の情報をメインとし、更に、天王星、海王星、冥王星が月から土星までの星々に何らかの働きかけをしていればお伝えしています。また、ドラゴンヘッドという月と太陽の軌道が交わるポイントから分かる、あなたの魂の課題もお伝えします。<br>               
            </p>
            <p>&nbsp;&nbsp;各天体にはそれぞれ、個人に影響を及ぼすテーマと、天体の性質が最も強く現れる「年齢域」があります。また、それぞれの天体が、生まれた時にどのサイン（12&nbsp;星座）にあり、どのハウスにあるか、他の天体とどんな角度をとっているか、といった情報を総合的に見ていくことになります。<br>             
            </p>
            <p class="bold">サビアン占星術という新しい技法</p>
            <p>&nbsp;&nbsp;さらに、ここには、サビアンシンボルの情報も掲載します。<br>
                &nbsp;&nbsp;サビアンシンボルとは、12&nbsp;星座の度数ごとのエネルギーを詩的な文章であらわしたもので、1925&nbsp;年にアメリカのマーク・エドモンド・ジョーンズという占星術家が、エリス・フィラーという霊能者と共に実験的に&nbsp;12&nbsp;サインの各度数から浮かび上がるイメージを記録していく実験から生まれています。<br>
            </p>
            <p>&nbsp;&nbsp;海部舞はこのサビアンシンボルを鑑定の際に非常に重視しています。各天体ごとに解説をしていく際に、サビアンシンボルからのキーワードも掲載します。各天体のテーマを、更に具体的に理解する助けになるでしょう。<br>
            </p>
            <p class="bold">恒星から分かるテーマ</p>
            <p>&nbsp;&nbsp;また、ヘレニズムの占星術の頃から扱われていた、シリウス、ベテルギウス、アンタレスなどといった、太陽系よりも遠い銀河の星々は、あなたの魂の故郷であるかのように、その本質的に眠っている力の形を教えてくれます。<br>
                &nbsp;&nbsp;若年期、青年期、老年期にそれぞれ発現する力、深いベースとして、潜在意識的に扱われ続ける力、といった領域で、関わる星々が異なります。<br>
            </p>
        </div>
        @foreach ($explain as $key => $item)
            @if (in_array($key, $removePlanet))
                @continue
            @endif
            <div class="explain-{{ $key }} page-break py-4 px-4">
                <x-horoscope::planetcard :planetExplain=$item />
            </div>
        @endforeach
        <div class="explain-AC page-break py-4 px-4">
            <div class="border-card justify-content-center">
                <div class="title-card mt-2">               
                    <p class="bold"> AC
                        </p>
                </div>
                <div class="content-card">
                    <div class="zodiac">
                        <div class="zodiac-title">
                            @foreach ($degreeData->get('houses') as $house)
                            @if ($house->get('number') == 1)
                             <p class="bold my-0">&nbsp;&nbsp;●&nbsp;
                                 {{ $zodaics->where('id', $house->get('zodiac_num'))->pluck('name')->first() }}</p>
                            @endif
                         @endforeach                            
                        </div>
                        <div class="zodiac-content">
                            @foreach ($degreeData->get('houses') as $house)
                            @if ($house->get('number') == 1)
                             <p class="zodiac-content ms-2">
                                &nbsp;&nbsp;{{ $zodaicsPattern->where('zodiac_id', $house->get('zodiac_num'))->where('planet_id',14)->pluck('content')->first() }}</p>
                            @endif
                         @endforeach
                        </div>
                    </div>
            
            
                    <div class="sabian">
                        <div class="sabian-title">
                                <p class="bold my-0">&nbsp;&nbsp;●&nbsp;
                                    AC のサビアンシンボル―無意識的だが本質的に持っている能力や特性</p>
                        </div>
                        <div class="sabian-degrees-title ms-2">
                            @foreach ($degreeData->get('houses') as $house)
                            @if ($house->get('number') == 1)
                                <p>&nbsp;&nbsp;<ins>{{ $zodaics->where('id', $house->get('zodiac_num'))->pluck('name')->first() }}
                                        {{ $house->get('sabian_degrees_dms')->get('degrees')}}
                                         {{ __('horoscope::pdf.degrees') }}「{{ $sabian->where('zodiac_id', $house->get('zodiac_num'))->where('sabian_degrees', $house->get('sabian_degrees_dms')->get('degrees'))->pluck('title')->first() }}」</ins> 
                                </p>
                            @endif
                            @endforeach  
                        </div>
                        <div class="sabian-content">
                            @foreach ($degreeData->get('houses') as $house)
                            @if ($house->get('number') == 1)
                                <p class="sabian-content ms-2">
                                    &nbsp;&nbsp;{!! nl2br ($sabian->where('zodiac_id', $house->get('zodiac_num'))->where('sabian_degrees', $house->get('sabian_degrees_dms')->get('degrees'))->pluck('content')->first() )!!}</p>
                                    @endif
                            @endforeach 
                        </div>
                    </div>      
                </div>
            </div>
        </div>
        <div class="explain-MC page-break py-4 px-4">
            <div class="border-card justify-content-center">
                <div class="title-card mt-2">               
                    <p class="bold"> MC
                        </p>
                </div>
                <div class="content-card">
                    <div class="zodiac">
                        <div class="zodiac-title">
                            @foreach ($degreeData->get('houses') as $house)
                            @if ($house->get('number') == 10)
                             <p class="bold my-0">&nbsp;&nbsp;●&nbsp;
                                 {{ $zodaics->where('id', $house->get('zodiac_num'))->pluck('name')->first() }}</p>
                            @endif
                         @endforeach                            
                        </div>
                        <div class="zodiac-content">
                            @foreach ($degreeData->get('houses') as $house)
                            @if ($house->get('number') == 10)
                             <p class="zodiac-content ms-2">
                                &nbsp;&nbsp;{{ $zodaicsPattern->where('zodiac_id', $house->get('zodiac_num'))->where('planet_id',15)->pluck('content')->first() }}</p>
                            @endif
                         @endforeach
                        </div>
                    </div>
            
            
                    <div class="sabian">
                        <div class="sabian-title">
                            <p class="bold my-0">&nbsp;&nbsp;●&nbsp;
                                MC のサビアンシンボル―無意識的だが本質的に持っている能力や特性</p>
                    </div>
                    <div class="sabian-degrees-title ms-2">
                        @foreach ($degreeData->get('houses') as $house)
                        @if ($house->get('number') == 10)
                            <p>&nbsp;&nbsp;<ins>{{ $zodaics->where('id', $house->get('zodiac_num'))->pluck('name')->first() }}
                                    {{ $house->get('sabian_degrees_dms')->get('degrees')}}
                                     {{ __('horoscope::pdf.degrees') }}「{{ $sabian->where('zodiac_id', $house->get('zodiac_num'))->where('sabian_degrees', $house->get('sabian_degrees_dms')->get('degrees'))->pluck('title')->first() }}」</ins> 
                            </p>
                        @endif
                        @endforeach  
                    </div>
                    <div class="sabian-content">
                        @foreach ($degreeData->get('houses') as $house)
                        @if ($house->get('number') == 10)
                            <p class="sabian-content ms-2">
                                &nbsp;&nbsp;{!! nl2br ($sabian->where('zodiac_id', $house->get('zodiac_num'))->where('sabian_degrees', $house->get('sabian_degrees_dms')->get('degrees'))->pluck('content')->first() )!!}</p>
                                @endif
                        @endforeach 
                    </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>

</body>

</html>
