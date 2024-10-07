{{-- 鑑定結果 --}}
<div class="C-appraisal">
    <div class="C-appraisal-tab__scroll">
        <ul class="C-appraisal-tab">
            <li class="C-appraisal-tab__item C-appraisal-tab__item--current">TOP</li>
            <li class="C-appraisal-tab__item">AC</li>
            {{-- <li class="C-appraisal-tab__item">MC</li> --}}
            @foreach ( $explain as $planet => $planetExplain)
                @if ($planet == 'URANUS' or $planet == 'NEPTUNE' or $planet == 'PLUTO')
                    <li class="C-appraisal-tab__item" style="width: 12rem;">{{ $planetExplain->get('planet')->name }}</li>
                @else
                    <li class="C-appraisal-tab__item">{{ $planetExplain->get('planet')->name }}</li>
                @endif
            @endforeach
        </ul>
    </div>

    <div class="C-appraisal__inner"> 

        {{-- TOPタブ --}}
        <div class="C-appraisal-content C-appraisal-content--top C-appraisal-content--current">
            <dl class="C-appraisal-content--top__first-message">
                <!-- <dt class="C-appraisal-content--top__first-message__title mincho">太陽が戻り、新たな一年が巡りゆく</dt> -->
                <dd class="C-appraisal-content--top__first-message__body" style="padding-top: 4rem;">
                    <p class="C-appraisal-content--top__first-message__text">わたしたちの住まう太陽系の軸である太陽の周りを、<br>地球は365日かけて回っています。</p>
                    <p class="C-appraisal-content--top__first-message__text">わたしたちは太陽と地球の関わりのサイクルから暦を作っているため、<br>あなたの誕生日は、あなたが生まれた時の場所に太陽が戻る日でもあります。<br>(太陽の周期と暦のズレで1日ほど前後することがあります)</p>
                    <p class="C-appraisal-content--top__first-message__text">誕生日には、あなたがこの星にやってきたことを祝います。</p>
                    <p class="C-appraisal-content--top__first-message__text">西洋占星術では、あなたが生まれた時の場所に太陽が戻ってくることを<br>Solar Return (太陽回帰) といい、<br>そのタイミングのホロスコープがあなたの年をあらわすとされます。</p>
                    {{-- <p class="C-appraisal-content--top__first-message__text">しかし、太陽の位置は毎年同じでも、<br>同じ春はないように、<br>他の天体との組み合わせなどは毎年異なります。</p> --}}
                    <p class="C-appraisal-content--top__first-message__text">しかし、ソーラーリターンの太陽の位置は毎年同じですが、同じ春はないように、<br>その年ごとに他の天体との組み合わせや太陽の位置するハウスなどは全く異なります。</p>
                    <p class="C-appraisal-content--top__first-message__text">あなたの意識は、太陽が戻るたびにリセットしています。</p>
                    {{-- <p class="C-appraisal-content--top__first-message__text">あなたの意識は、太陽が戻るたびにリセットされます。</p> --}}
                    <p class="C-appraisal-content--top__first-message__text">毎年毎年、自分の誕生日を祝うように、<br>毎年毎年、ソーラーリターンのホロスコープから、一年を予測する。</p>
                    <p class="C-appraisal-content--top__first-message__text">そして、その一年を楽しみに生きて、いろいろな体験をして、<br>ソーラーリターンのホロスコープを再び確認し、<br>目標を決めたり、修正したり、気持ちを新たに日々を楽しく生きる。</p>
                    <p class="C-appraisal-content--top__first-message__text">そんな風に使っていただきたくて、本サービスを開発しました。</p>
                    <p class="C-appraisal-content--top__first-message__text">この星で唯一無二のあなたの年が、唯一無二の輝きを放つように。<br>人生をよりクリエイティブに楽しく送ることが出来るように。</p>
                    <p class="C-appraisal-content--top__first-message__text">お役に立てますと幸いです。</p>
                    {{-- <p class="C-appraisal-content--top__first-message__text">毎年、自分の誕生日を祝うように、<br>毎年、ソーラーリターンのホロスコープから、一年を予測する。<br>そして、その一年を楽しみに生きて、いろいろな体験をして、<br>ソーラーリターンのホロスコープを再び確認し、<br>目標を決めたり、修正したり、気持ちを新たに日々を楽しく生きる。</p>
                    <p class="C-appraisal-content--top__first-message__text">そんな風に使っていただきたくて、本サービスを開発しました。</p>
                    <p class="C-appraisal-content--top__first-message__text">この星で唯一無二のあなたの1 年が、唯一無二の輝きを放つように。<br>人生をよりクリエイティブに楽しく送ることが出来るように。<br>お役に立てますと幸いです。</p>--}}
                    <p class="C-appraisal-content--top__first-message__name">海部 舞</p>
                </dd>
            </dl>
            {{-- <div class="C-appraisal-content--top-last">
                <p class="C-appraisal-content--top-last__title">さぁ、それでは、星々が織りなす<br
                        class="sp">唯一無二のハーモニー<br>あなたのブループリントを<br class="sp">見ていきましょう。</p>
                <p class="C-appraisal-content--top-last__text mincho">Now, let's take a look at your blueprint,the unique
                    harmony woven by the stars.</p>
            </div> --}}
        </div>

        {{-- ACとMC --}}
        @foreach ($degreeData->get('houses') as $house)
            @if ($house->get('number') == 1)
                <div class="C-appraisal-content C-appraisal-content--acmc">
                    <div class="C-appraisal-content-header">
                        <h3 class="C-appraisal-content-header__title fcolor2 mincho">
                            @if ($house->get('number') == 1)
                                一年のエネルギーに大きく影響
                            @endif
                        </h3>
                        <div class="C-appraisal-content-header-data">
                            <div class="C-appraisal-content-header-data__mark">
                                @if ($house->get('number') == 1)
                                    ACサイン
                                @endif
                            </div>
                            <div class="C-appraisal-content-header-data__jp planet" style="font-size: 25px; display: flex; align-items: center;">{{ $zodaics->where('id', $house->get('zodiac_num'))->pluck('symbol')->first() }}</div>
                            <div class="C-appraisal-content-header-data__en font">{{ $zodaics->where('id', $house->get('zodiac_num'))->pluck('name')->first() }}</div>
                            <div class="C-appraisal-content-header-data__year mincho">{{ $zodaics->where('id', $house->get('zodiac_num'))->pluck('name_en')->first() }}</div>
                        </div>

                        <div class="C-appraisal-content-header__first-message">
                            <p class="C-appraisal-content-header__first-message__text">
                                @if ($house->get('number') == 1)
                                    <dl class="C-appraisal-content--acmc-block">
                                        <dt class="C-appraisal-content--acmc-block__title">AC（アセンダント）とは</dt>
                                        <dd class="C-appraisal-content--acmc-block__body__content">
                                            　アセンダントとはソーラーリターンの瞬間の東の地平線の位置をさし、ここにあった星座（サイン）が、あなたの一年の無意識的な行動パターンとしてあらわれやすくなります。<br>
                                            　また、アセンダントのサインとエネルギーが近い天体（チャートルーラー）の力が強まるため、チャートルーラーが何なのかを解説文に入れています。のちほど、チャートルーラーの天体を読む際に意識してみましょう。
                                        </dd>
                                    </dl>
                                @endif
                                {{-- <p class="C-appraisal-content--acmc-block__text">
                                    @if ($house->get('number') == 1)
                                        　生まれた時の東の地平線の位置をさし、ここにあった星座が、あなたの見た目の印象やもって生まれた感受性、無意識的な素質などをあらわします。
                                        普段初対面の人にどう見られるか、無意識的にどうふるまっているか、といったことがアセンダントの星座の特徴に当てはまることが多いでしょう。
                                    @else
                                        MCはあなたが生まれた時の天頂の位置にあった星座であり、この星座は
                                        あなたが社会の役割を果たすために使うことのできるスキルや周囲から社会的に期待されることと関係します。
                                        これまでの社会経験と照らし合わせてみると大きな気づきがあるでしょう。
                                    @endif
                                </p> --}}
                            </p>
                        </div>
                        @if ($house->get('number') == 1)
                            <dl class="C-appraisal-content--acmc-block">
                                {{-- <dt class="C-appraisal-content--acmc-block__title">AC（アセンダント）とは</dt> --}}
                                <dd class="C-appraisal-content--acmc-block__body">
                                    {!! nl2br($zodaicsPattern->where('zodiac_id', $house->get('zodiac_num'))->where('planet_id', 14)->pluck('content_solar')->first()) !!}
                                </dd>
                            </dl>
                        @endif

                    </div>
                </div>
            @endif
        @endforeach

        {{-- その他の天体 --}}
        @foreach($explain as $planet => $planetExplain)
            {{-- 1項目のタブ単位 --}}
            <div class="C-appraisal-content C-appraisal-content--{{$planet}}">
                <div class="C-appraisal-content-header" style="padding-bottom: 1rem">
                    @switch($planet)
                        @case('SUN')
                            <h3 class="C-appraisal-content-header__title fcolor2 mincho">最も重要。今年はやりたいことがうまくいくだろうか</h3>
                            @break
                        @case('MOON')
                            <h3 class="C-appraisal-content-header__title fcolor2 mincho">あなたの暮らし。心は平穏か                            </h3>
                            @break
                        @case('MERCURY')
                            <h3 class="C-appraisal-content-header__title fcolor2 mincho">知的な活動</h3>
                            @break
                        @case('VENUS')
                            <h3 class="C-appraisal-content-header__title fcolor2 mincho">その年の楽しみや喜び</h3>
                            @break
                        @case('MARS')
                            <h3 class="C-appraisal-content-header__title fcolor2 mincho">情熱を注入するが危なさも</h3>
                            @break
                        @case('JUPITER')
                            <h3 class="C-appraisal-content-header__title fcolor2 mincho">その年の幸運のありか</h3>
                            @break
                        @case('SATURN')
                            <h3 class="C-appraisal-content-header__title fcolor2 mincho">今年努力して手に入れるもの</h3>
                            @break
                        @case('URANUS')
                            <h3 class="C-appraisal-content-header__title fcolor2 mincho">変革させること、あなたの独自性を出すテーマ</h3>
                            @break
                        @case('NEPTUNE')
                            <h3 class="C-appraisal-content-header__title fcolor2 mincho">この時期、あなたが描く理想</h3>
                            @break
                        @case('PLUTO')
                            <h3 class="C-appraisal-content-header__title fcolor2 mincho">最も大きく変わるテーマ</h3>
                            @break
                    @endswitch




                    {{-- @if ($planet == 'MOON')
                        <h3 class="C-appraisal-content-header__title fcolor2 mincho">幼児期から変わらない、<br class="pc">素のあなた。</h3>
                    @else
                        <h3 class="C-appraisal-content-header__title fcolor2 mincho">{{ $planetExplain->get('planet')->title }}</h3>
                    @endif --}}
                    <div class="C-appraisal-content-header-data">
                        <div class="C-appraisal-content-header-data__mark"></div>
                        <div class="C-appraisal-content-header-data__jp">{{ $planetExplain->get('planet')->name }}</div>
                        <div class="C-appraisal-content-header-data__en font">{{ $planetExplain->get('planet')->name_en }}</div>
                        <div class="C-appraisal-content-header-data__year"></div>
                        <!-- @if($planet == 'SUN')
                            <div class="C-appraisal-content-header-data__year"></div>
                        @else
                            <div class="C-appraisal-content-header-data__year">{{ $planetExplain->get('planet')->year_range }}</div>
                        @endif -->
                    </div>

                    <div class="C-appraisal-content-header__first-message">
                        @if ($planet == 'SUN')
                            <p class="C-appraisal-content-header__first-message__text">
                                　ソーラーリターンの太陽は、あなたが生まれた時の星座と度数に必ずあります。しかし、どのハウスにあるのか、他の天体とどんなアスペクト（角度）をとっているのかについては毎年異なりますし、これがとても重要です。<br>
                                　特に、太陽の入るハウスは一年のメインテーマといえるほど重要になります。<br>
                                　この一年が、あなたの目的意識の達成、成長、創造的な活動にどう影響するかを太陽の状況から予測することが出来ます。
                            </p>
                        @endif
                        @if ($planet == 'MOON')
                            <p class="C-appraisal-content-header__first-message__text">
                                　月は、この一年の心の状況や私生活をあらわします。生まれたときとは全く違う星座であることが多く、ソーラーリターンでは、この年のあなたの精神的な中心テーマが月のサインやハウスにあらわれますので、とても重要です。<br>
                                　どんなことに気持ちが向かうか、感受性にどんな変化があるか、健康や暮らし、私生活全般がどんなふうになりそうかがあらわれています。<br>
                                　月の配置が豊かだと、暮らしや気持ちが安定する一年であることがわかりますし、月の配置が厳しいときは、実際に精神的に厳しいことが起こりやすいと暗示されます。
                            </p>
                        @endif
                        @if ($planet == 'MERCURY')
                            <p class="C-appraisal-content-header__first-message__text">
                                　水星からはこの一年、あなたが何に関心を示し、何を学ぼうとし、どのような交友関係を結ぶのかといったことがわかります。<br>
                                　水星は太陽のそばにあることが多いため、出生図と同じ星座になることも多いでしょうし、生まれた時の位置の前後の星座に入っていることもあるでしょう。出生図の水星と同じ星座の場合は普段通り、違う場合は、知的な関心ごとや言葉で表現したいことのテーマがいつもと違う年になることがわかります。<br>
                                　ハウスやサビアンシンボル、水星へのアスペクトは毎年異なりますから、知的な成長や学びがその年ごとに刷新されていきます。<br>
                                　また、太陽があらわす目的意識を達成するために、知性やコミュニケーション能力をどう活かすといいかが示されていると考えるといいでしょう。
                            </p>
                        @endif
                        @if ($planet == 'VENUS')
                            <p class="C-appraisal-content-header__first-message__text">
                                　地球から見て金星は、太陽から約47度までしか離れませんので、生まれた時の星座と同じ場所に金星があることも多いですが、異なる場合もあります。同じ場合は、好きなことや楽しみごとにあまり変化がないともいえますし、星座が異なるときにはその質が変化することがわかります。<br>
                                　それ以外にも、サビアンシンボルからはあなたが今年獲得する楽しみや喜びがどんなものなのかを具体的に知ることができますし、ハウスやアスペクトでどんなふうに感受性が豊かに育まれるのか、魅力をどう打ち出していくことができそうか、などがあらわれています。<br>
                                　ソーラーリターンの場合は太陽があらわす目的意識を成し遂げるために使われる意味として読んでいくため、私生活ではなく仕事でこの感性が活かされるか、仕事で楽しみが多いか、といったことがわかると考えます。<br>
                                　社会であなたの魅力を表現するためにとても重要です。
                            </p>
                        @endif
                        @if ($planet == 'MARS')
                            <p class="C-appraisal-content-header__first-message__text">
                                　この一年、自分がどんなことに情熱を注ぐか、同時にどんなことに怒りを感じやすいかがあらわれています。生まれたときとは全く違う場所に位置していることが多く、どんなことのために行動し、何を得ようとするのかがわかります。何かを成し遂げるためにうまく使うことができれば、大きな推進力となります。<br>
                                　火星にハードな配置が多い場合はフラストレーションがたまりやすく、人と争いやすいときかもしれません。火星はうまく扱う意識が大変重要になります。火星のエネルギーを志のためにうまく扱えば、大きな成長を果たすことができるでしょう。
                            </p>
                        @endif
                        @if ($planet == 'JUPITER')
                            <p class="C-appraisal-content-header__first-message__text">
                                　拡大と幸運の星です。ソーラーリターンの木星からは、この一年、あなたがどんなものを得ることができ、どんなチャンスや幸運がもたらされるのかが示されています。<br>
                                　木星は一つの星座に一年ほど滞在するため、星座のテーマからは、その時期に広がること、流行すること、好まれることなどがあらわれています。そのため、あなた以外にも多くの人が該当する内容になります。<br>
                                　それに対して、ソーラーリターンの木星のハウス、サビアンシンボル、アスペクトはあなた個人の一年の運勢としてとても重要になります。<br>
                                　木星は拡大と幸運の星ですから、どんなことをすれば社会的にうまくいくのか、どんなことに恵まれるのかがわかります。特に、社会的・経済的な成功や、だれもが気になるお金については、木星に示されています。
                            </p>
                        @endif
                        @if ($planet == 'SATURN')
                            <p class="C-appraisal-content-header__first-message__text">
                                　あなたがこの一年どんな努力をしてきたか、どのように社会的な役割の基盤を構築するのかをあらわします。努力というとあまりいい気分がしないかもしれませんが、しっかりと目的意識に合わせて努力ができてこそ、社会的な基盤が安定していきます。また、社会的な成功は責任とセットであることは否めないでしょう。<br>
                                　土星は一つの星座に3年前後滞在するため、その影響は集合意識的なものになります。そのためサインについては、みんなそういう時期なんだな、と思うようにしてください。<br>
                                　個人として重要なのは、サビアンシンボルとハウスになります。
                            </p>
                        @endif
                        @if ($planet == 'URANUS')
                            <p class="C-appraisal-content-header__first-message__text">
                                　この一年で目に見える変化を起こしたり、新しく取り入れること、刷新させるテーマなどがわかります。天王星からの影響で、急な変化や手放しが起こることもありますが、よりあなたらしい生き方に向かっていくきっかけとなるでしょう。
                            </p>
                        @endif
                        @if ($planet == 'NEPTUNE')
                            <p class="C-appraisal-content-header__first-message__text">
                                　この一年の目に見えないものとのつながりや、どんな夢や理想を抱くかをあらわします。海王星からの影響で、気持ちが揺らぎやすくなったり、信念や無意識的な感性に変化が起こりやすくもなります。<br>
                                　海王星からの影響は無意識ですが深くかかわりますので、これを読んで意識に昇らせるように気にかけていただくといいでしょう。
                            </p>
                        @endif
                        @if ($planet == 'PLUTO')
                            <p class="C-appraisal-content-header__first-message__text">
                                　ソーラーリターンチャートで冥王星が滞在するハウスには、あなたの意識が大きく変化するテーマが示されています。深く重要な影響となりますので認識しておく必要があります。この影響は嫌が応にも起こるものであり、それによって大きく成長したり、影響力が増したり、よりあなたの本質に会った生き方に変容することにつながっていきます。
                            </p>
                        @endif
                    </div>

                    <div class="C-appraisal-content-header__inner">
                        @if ($planet != 'SUN' && $planet != 'URANUS' && $planet != 'NEPTUNE' && $planet != 'PLUTO')
                            <dl class="C-appraisal-content-header-block">
                                <dt class="C-appraisal-content-header-block__title C-appraisal-content-header-block__title--{{$planetExplain->get('zodiac_pattern')->zodiac->name_en}}">
                                    <span class="fcolor2">{{$planetExplain->get('zodiac_pattern')->zodiac->name}}</span>
                                </dt>
                                <dd class="C-appraisal-content-header-block__text">{!! nl2br ($planetExplain->get('zodiac_pattern')->content_solar ?? '') !!}</dd>
                            </dl>
                        @endif
                        @if ($planet == 'MOON')
                            <dl class="C-appraisal-content-header-message">
                                <dt class="C-appraisal-content-header-message__title">月のサビアンシンボル</dt>
                                <dd class="C-appraisal-content-header-message__text">
                                    この一年、暮らしや心の中であなたが抱くテーマを具体的にあらわします。サビアンシンボルが示すような体験や気づきがあるでしょう。
                                </dd>
                            </dl>
                        @endif
                        @if ($planet == 'MERCURY')
                            <dl class="C-appraisal-content-header-message">
                                <dt class="C-appraisal-content-header-message__title">水星のサビアンシンボル</dt>
                                <dd class="C-appraisal-content-header-message__text">
                                    この一年の知的な関心ごとやテーマが具体的にわかります。サビアンシンボルには、知識や認知的な領域で変わったり獲得していくテーマが示されています。
                                </dd>
                            </dl>
                        @endif
                        @if ($planet == 'VENUS')
                            <dl class="C-appraisal-content-header-message">
                                <dt class="C-appraisal-content-header-message__title">金星のサビアンシンボル</dt>
                                <dd class="C-appraisal-content-header-message__text">
                                    この一年、どんなことが楽しいのか、どんな能力を得ることで魅力を高めるのか、といったことが具体的に示されています。
                                </dd>
                            </dl>
                        @endif
                        @if ($planet == 'MARS')
                            <dl class="C-appraisal-content-header-message">
                                <dt class="C-appraisal-content-header-message__title">火星のサビアンシンボル</dt>
                                <dd class="C-appraisal-content-header-message__text">
                                    この時期、社会的にどのようなことに集中して励むのか、どんなパッションをもって行動するのか、といったことが具体的に示されています。</dd>
                            </dl>
                        @endif
                        @if ($planet == 'JUPITER')
                            <dl class="C-appraisal-content-header-message">
                                <dt class="C-appraisal-content-header-message__title">木星のサビアンシンボル</dt>
                                <dd class="C-appraisal-content-header-message__text">
                                    あなたのこの一年の幸運にかかわるテーマがサビアンシンボルに具体的にあらわれています。そのような能力を身につけ、社会的に活かせるかもしれませんし、やるとうまくいきやすいことをあらわしていることもあります。そんな意識で見てみましょう。
                                </dd>
                            </dl>
                        @endif
                        @if ($planet == 'SATURN')
                            <dl class="C-appraisal-content-header-message">
                                <dt class="C-appraisal-content-header-message__title">土星のサビアンシンボル</dt>
                                <dd class="C-appraisal-content-header-message__text">
                                    この一年、あなたが努力して手に入れようとすること、時間をかけて行っていこうとすることが具体的に示されています。社会的にはとても重要なテーマとなり、これを達成することで、社会基盤がさらに強固になるでしょう。
                                </dd>
                            </dl>
                        @endif
                        @if ($planet == 'URANUS')
                            <dl class="C-appraisal-content-header-message">
                                <dt class="C-appraisal-content-header-message__title">天王星のサビアンシンボル</dt>
                                <dd class="C-appraisal-content-header-message__text">
                                    あなたが変革したい、生き方を変えたい、新たに取り入れたいことなどについて、その具体的な方向性が天王星のサビアンシンボルにあらわれます。

                                </dd>
                            </dl>
                        @endif
                        @if ($planet == 'NEPTUNE')
                            <dl class="C-appraisal-content-header-message">
                                <dt class="C-appraisal-content-header-message__title">海王星のサビアンシンボル</dt>
                                <dd class="C-appraisal-content-header-message__text">
                                    あなたが無意識的にどんな理想を描くのかが具体的にあらわれています。また、第六感的な感受
                                    性をどんな領域で発揮させるか、どんな感覚が育つかがわかることもあります。
                                </dd>
                            </dl>
                        @endif
                        @if ($planet == 'PLUTO')
                            <dl class="C-appraisal-content-header-message">
                                <dt class="C-appraisal-content-header-message__title">冥王星のサビアンシンボル</dt>
                                <dd class="C-appraisal-content-header-message__text">
                                　冥王星は一年をかけてホロスコープ上をわずかしか進まないため、ソーラーリターンでは、多くの人が同じ冥王星のサビアンシンボルを共有します。
                                </dd>
                            </dl>
                        @endif
                        {{-- @if ($planet == 'CHIRON')
                            <dl class="C-appraisal-content-header-message">
                                <dt class="C-appraisal-content-header-message__title">その他のサビアンシンボル</dt>
                                <dd class="C-appraisal-content-header-message__text">
                                    その他のサビアンシンボルのテキストが入ります。その他のサビアンシンボルのテキストが入ります。その他のサビアンシンボルのテキストが入ります。</dd>
                            </dl>
                        @endif --}}


                        @if ($planet != 'CHIRON' && $planet != 'SUN')
                            <dl class="C-appraisal-content-header-block">
                                <dt class="C-appraisal-content-header-block__title">
                                    <span class="fcolor2">
                                        {{ $planetExplain->get('planet')->name }}のサビアンシンボル<br>
                                        @if($planetExplain->get('sabian_pattern'))
                                            {{ $planetExplain->get('sabian_pattern')->zodiac->name }}
                                            {{ $planetExplain->get('sabian_pattern')->sabian_degrees }}度
                                            「{{ $planetExplain->get('sabian_pattern')->title }}」
                                        @endif
                                    </span>
                                </dt>
                                <dd class="C-appraisal-content-header-block__text">
                                    {!! nl2br ($planetExplain->get('sabian_pattern')->content_solar ?? '' )!!}
                                </dd>
                            </dl>
                        @endif

                        <dl class="C-appraisal-content-header-block">
                            <dt class="C-appraisal-content-header-block__title">
                                <span class="fcolor2">{{ $planetExplain->get('house_pattern')->house->name }}</span>
                            </dt>
                            <dd class="C-appraisal-content-header-block__text">
                                {!! nl2br ($planetExplain->get('house_pattern')->content_solar ?? '' )!!}
                            </dd>
                        </dl>
                        @if ($planet == 'SUN')
                            <dl class="C-appraisal-content-header-message">
                                <dt class="C-appraisal-content-header-message__title">アスペクト<br
                                        class="sp">（他の天体との関わりからわかること）</dt>
                                <dd class="C-appraisal-content-header-message__text">
                                    太陽が他の天体とどうかかわっているかがこの一年を読み解く重要なカギになります。一つひとつ丁
                                    寧に読み解いて、自分がやりたいことと比較し、進むヒントにしてください。
                                </dd>
                            </dl>
                        @endif
                        @if ($planet == 'MOON')
                            <dl class="C-appraisal-content-header-message">
                                <dt class="C-appraisal-content-header-message__title">アスペクト<br
                                        class="sp">（他の天体との関わりからわかること）</dt>
                                <dd class="C-appraisal-content-header-message__text">
                                    暮らしそのものにストレスが多いか、楽しみや癒しが多いか、といったことは、月とのアスペクトにあらわれている場合が多くなります。
                                </dd>
                            </dl>
                        @endif
                        @if ($planet == 'MERCURY')
                            <dl class="C-appraisal-content-header-message">
                                <dt class="C-appraisal-content-header-message__title">アスペクト<br
                                        class="sp">（他の天体との関わりからわかること）</dt>
                                <dd class="C-appraisal-content-header-message__text">
                                    言葉を用いたコミュニケーションや発信、情報の伝達などがどうなりそうか、どのように発揮され、活かされるかが示されています。

                                </dd>
                            </dl>
                        @endif
                        @if ($planet == 'VENUS')
                            <dl class="C-appraisal-content-header-message">
                                <dt class="C-appraisal-content-header-message__title">アスペクト<br
                                        class="sp">（他の天体との関わりからわかること）</dt>
                                <dd class="C-appraisal-content-header-message__text">
                                    あなたの魅力や感性がうまく発揮されていきそうかが、他の天体とのかかわりから示されます。何らかの魅力や才能を獲得しやすいのか、逆に制限してしまうのか、感性が高まるのか、出会いが多いか、など、さまざまなことがここにあらわれます。
                                </dd>
                            </dl>
                        @endif
                        @if ($planet == 'MARS')
                            <dl class="C-appraisal-content-header-message">
                                <dt class="C-appraisal-content-header-message__title">アスペクト<br
                                        class="sp">（他の天体との関わりからわかること）</dt>
                                <dd class="C-appraisal-content-header-message__text">
                                    他の天体とうまく連携して志を達成できるのか、それにどのような変化が起ここるのか、他の天体からの制限や制約があるのか、といったことがわかります。
                                </dd>
                            </dl>
                        @endif
                        @if ($planet == 'JUPITER')
                            <dl class="C-appraisal-content-header-message">
                                <dt class="C-appraisal-content-header-message__title">アスペクト<br
                                        class="sp">（他の天体との関わりからわかること）</dt>
                                <dd class="C-appraisal-content-header-message__text">
                                    木星と個人天体がかかわると、その天体の意味を拡大させ、幸運につながりますので、非常に重要です。記載済みのものも改めてご覧ください。また、ここに鑑定内容が記載される土星やトランスサタニアンとのアスペクトは時代的な意味が強まりますので、だれにとっても今がそういう時期なのだと理解しましょう。
                                </dd>
                            </dl>
                        @endif
                        @if ($planet == 'SATURN')
                            <dl class="C-appraisal-content-header-message">
                                <dt class="C-appraisal-content-header-message__title">アスペクト<br
                                        class="sp">（他の天体との関わりからわかること）</dt>
                                <dd class="C-appraisal-content-header-message__text">
                                    土星のアスペクトについては、月から木星とのかかわりがある場合には記載済みです。土星とドラゴ
                                    ンヘッドのアスペクトは時代に関わり、個人には影響しないため、記載を省略します。
                                </dd>
                            </dl>
                        @endif
                        {{-- @if ($planet == 'CHIRON')
                            <dl class="C-appraisal-content-header-message">
                                <dt class="C-appraisal-content-header-message__title">アスペクト<br
                                        class="sp">（他の天体との関わりからわかること）</dt>
                                <dd class="C-appraisal-content-header-message__text">
                                    その他のアスペクトのテキストが入ります。その他のアスペクトのテキストが入ります。その他のアスペクトのテキストが入ります。その他のアスペクトのテキストが入ります。</dd>
                            </dl>
                        @endif --}}
                    </div>
                </div>

                {{-- 他の天体との関わり --}}
                <div class="C-appraisal-content-footer">
                    <div class="C-appraisal-content-footer__inner">
                        @if ($planet != 'SATURN' && $planet != 'URANUS' && $planet != 'NEPTUNE' && $planet != 'PLUTO')
                            @foreach ( $planetExplain->get('aspect_pattern') as $item)
                                {{-- $itemがnullの場合はスキップ --}}
                                @if ($item === null)
                                    @continue
                                @endif
                                @if ($item->toPlanet && $item->toPlanet->name != 'キロン')
                                    <div class="C-appraisal-content-footer-block">
                                        <dl class="C-appraisal-content-footer-block__inner">
                                            <dt class="C-appraisal-content-footer-block__title fcolor2">{{ $item->fromPlanet->name }} - {{ $item->toPlanet->name }}</dt>
                                            <dd class="C-appraisal-content-footer-block__text">{!! nl2br($item->content_solar ?? '') !!}</dd>
                                        </dl>
                                        <div class="C-appraisal-content-footer-block__last">
                                            <p class="C-appraisal-content-footer-block__last planet">
                                                {{ $item->fromPlanet->symbol }}
                                                @if ($item->aspect->symbol === 'q')
                                                    <img src="{{ asset('images/Sextile_symbol.svg') }}" alt="" width="20" height="20" alt="セクスタイルの記号" style="margin: 0px 0px 14px 0px">
                                                @else
                                                    {{ $item->aspect->symbol }}
                                                @endif
                                                {{ $item->toPlanet->symbol }}
                                            </p>
                                            <p class="C-appraisal-content-footer-block__last__text font">{{ $item->fromPlanet->name_en }} - {{ $item->toPlanet->name_en }}</p>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                        {{-- @foreach ($planetExplain->get('aspect_pattern') as $item)
                            <div class="C-appraisal-content-footer-block">
                                <dl class="C-appraisal-content-footer-block__inner">
                                    <dt class="C-appraisal-content-footer-block__title fcolor2">{{ $item->fromPlanet ? $item->fromPlanet->name : '' }} - {{$item->toPlanet ? $item->toPlanet->name : '' }}</dt>
                                    <dd class="C-appraisal-content-footer-block__text">{!! nl2br  ($item->content ?? '') !!}</dd>
                                </dl>
                                <div class="C-appraisal-content-footer-block__last">
                                    <p class="C-appraisal-content-footer-block__last planet">{{$item->fromPlanet ? $item->fromPlanet->symbol : '' }} {{ $item->aspect->symbol }} {{$item->toPlanet ? $item->toPlanet->symbol : '' }}</p>
                                    <p class="C-appraisal-content-footer-block__last__text font">{{$item->fromPlanet ? $item->fromPlanet->name_en : '' }} - {{$item->toPlanet ? $item->toPlanet->name_en : '' }}</p>
                                </div>
                            </div>
                        @endforeach --}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
