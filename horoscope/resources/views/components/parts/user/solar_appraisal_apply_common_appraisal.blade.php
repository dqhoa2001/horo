{{-- 鑑定結果 --}}
<div class="C-appraisal">
    <div class="C-appraisal-tab__scroll">
        <ul class="C-appraisal-tab">
            <li class="C-appraisal-tab__item C-appraisal-tab__item--current">TOP</li>
            <li class="C-appraisal-tab__item">AC</li>
            <li class="C-appraisal-tab__item">MC</li>
            @foreach ( $explain as $planet => $planetExplain)
                @if ($planet == 'CHIRON')
                    <li class="C-appraisal-tab__item" style="width: calc((100% / 4) + (0.1rem * 9));">{{ $planetExplain->get('planet')->name }}</li>
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
                <dt class="C-appraisal-content--top__first-message__title mincho">太陽が戻り、新たな一年が巡りゆく</dt>
                <dd class="C-appraisal-content--top__first-message__body">
                    <p class="C-appraisal-content--top__first-message__text">わたしたちの住まう太陽系の軸である太陽の周りを、<br>地球は３６５日かけて回っています。</p>
                    <p class="C-appraisal-content--top__first-message__text">わたしたちは太陽と地球の関わりのサイクルから暦を作っているため、<br>あなたの誕生日は、あなたが生まれた時の場所に太陽が戻る日でもあります。<br>（太陽の周期と暦のズレで1 日ほど前後することがあります）</p>
                    <p class="C-appraisal-content--top__first-message__text">誕生日には、あなたがこの星にやってきたことを祝います。</p>
                    <p class="C-appraisal-content--top__first-message__text">西洋占星術では、あなたが生まれた時の場所に太陽が戻ってくることを<br>Solar Returen（太陽回帰）といい、<br>そのタイミングのホロスコープがあなたの1 年をあらわすとされます。</p>
                    <p class="C-appraisal-content--top__first-message__text">しかし、太陽の位置は毎年同じでも、<br>同じ春はないように、<br>他の天体との組み合わせなどは毎年異なります。</p>
                    <p class="C-appraisal-content--top__first-message__text">あなたの意識は、太陽が戻るたびにリセットされます。</p>
                    <p class="C-appraisal-content--top__first-message__text">毎年、自分の誕生日を祝うように、<br>毎年、ソーラーリターンのホロスコープから、一年を予測する。<br>そして、その一年を楽しみに生きて、いろいろな体験をして、<br>ソーラーリターンのホロスコープを再び確認し、<br>目標を決めたり、修正したり、気持ちを新たに日々を楽しく生きる。</p>
                    <p class="C-appraisal-content--top__first-message__text">そんな風に使っていただきたくて、本サービスを開発しました。</p>
                    <p class="C-appraisal-content--top__first-message__text">この星で唯一無二のあなたの1 年が、唯一無二の輝きを放つように。<br>人生をよりクリエイティブに楽しく送ることが出来るように。<br>お役に立てますと幸いです。</p>
                    <p class="C-appraisal-content--top__first-message__name">海部 舞</p>
                </dd>
            </dl>
            <div class="C-appraisal-content--top-last">
                <p class="C-appraisal-content--top-last__title">さぁ、それでは、星々が織りなす<br
                        class="sp">唯一無二のハーモニー<br>あなたのブループリントを<br class="sp">見ていきましょう。</p>
                <p class="C-appraisal-content--top-last__text mincho">Now, let's take a look at your blueprint,the unique
                    harmony woven by the stars.</p>
            </div>
        </div>

        {{-- ACとMC --}}
        @foreach ($degreeData->get('houses') as $house)
            @if ($house->get('number') == 1 || $house->get('number') == 10)
                <div class="C-appraisal-content C-appraisal-content--acmc">
                    <div class="C-appraisal-content-header">
                        <h3 class="C-appraisal-content-header__title fcolor2 mincho">
                            @if ($house->get('number') == 1)
                                見た目や癖、振る舞いなど
                            @else
                                周囲があなたをどう見るか、<br>社会的な役割や達成点
                            @endif
                        </h3>
                        <div class="C-appraisal-content-header-data">
                            <div class="C-appraisal-content-header-data__mark">
                                @if ($house->get('number') == 1)
                                    ACサイン
                                @else
                                    MCサイン
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
                                            　生まれた時の東の地平線の位置をさし、ここにあった星座が、あなたの見た目の印象やもって生まれた感受性、無意識的な素質などをあらわします。
                                            普段初対面の人にどう見られるか、無意識的にどうふるまっているか、といったことがアセンダントの星座の特徴に当てはまることが多いでしょう。
                                        </dd>
                                    </dl>
                                @else
                                    <dl class="C-appraisal-content--acmc-block">
                                        <dt class="C-appraisal-content--acmc-block__title">MCとは</dt>
                                        <dd class="C-appraisal-content--acmc-block__body__content">
                                            　MCはあなたが生まれた時の天頂の位置にあった星座であり、この星座は
                                            あなたが社会の役割を果たすために使うことのできるスキルや周囲から社会的に期待されることと関係します。
                                            これまでの社会経験と照らし合わせてみると大きな気づきがあるでしょう。
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
                                    {{ $zodaicsPattern->where('zodiac_id', $house->get('zodiac_num'))->where('planet_id', 14)->pluck('content_solar')->first() }}
                                </dd>
                            </dl>
                        @else
                            <dl class="C-appraisal-content--acmc-block">
                                {{-- <dt class="C-appraisal-content--acmc-block__title">MCとは</dt> --}}
                                <dd class="C-appraisal-content--acmc-block__body">
                                    {{ $zodaicsPattern->where('zodiac_id', $house->get('zodiac_num'))->where('planet_id', 15)->pluck('content_solar')->first() }}
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
                <div class="C-appraisal-content-header">
                    @if ($planet == 'MOON')
                        <h3 class="C-appraisal-content-header__title fcolor2 mincho">幼児期から変わらない、<br class="pc">素のあなた。</h3>
                    @else
                        <h3 class="C-appraisal-content-header__title fcolor2 mincho">{{ $planetExplain->get('planet')->title }}</h3>
                    @endif
                    <div class="C-appraisal-content-header-data">
                        <div class="C-appraisal-content-header-data__mark"></div>
                        <div class="C-appraisal-content-header-data__jp">{{ $planetExplain->get('planet')->name }}</div>
                        <div class="C-appraisal-content-header-data__en font">{{ $planetExplain->get('planet')->name_en }}</div>
                        <div class="C-appraisal-content-header-data__year">{{ $planetExplain->get('planet')->year_range }}</div>
                    </div>

                    <div class="C-appraisal-content-header__first-message">
                        @if ($planet == 'SUN')
                            <p class="C-appraisal-content-header__first-message__text">
                                　社会に出てしばらくすると、太陽の年齢域に差し掛かることになります。水星や金星といった地球の内惑星は、地球からは太陽のそばをうろちょろしているように見え、太陽の近くにあるので、水星、金星、太陽がどれも同じ星座であることもありますし、太陽の一つ隣の星座にある、ということも多いでしょう。<br>
                                　金星が太陽と違う星座にある場合、太陽の年齢域から人生の方向性を大きく変える人が多くなります。これまでは好きなこと、楽しいことを学び、職業選択の基準としていく人が多いのですが、太陽の年齢である20代後半になると、より深く本質的な意味で自分の「生きがい」を見出そうとし始めます。そのために、太陽の年齢域に差し掛かる20代後半ごろから職業や生き方を再選択する人が増える傾向にあります。<br>
                                　太陽の表す人生の目的は非常に重要です。あなたにしかできないこと、生み出せないもの、この人生の意味と深くかかわります。そして、できるならばそれを35歳の太陽の年齢域までに見出すことが出来るといいでしょう。<br>
                                　以下の鑑定文を読んで、自分が太陽のあらわす人生の目的を実際に全うできているかを感じてみてください。
                            </p>
                        @endif
                        @if ($planet == 'MOON')
                            <p class="C-appraisal-content-header__first-message__text">　月は、あなたの幼少期（0～7歳）に最も強く影響し、生まれもったあなたの無意識の力、素の性質などをあらわします。何に安心し、心が満たされるかにかかわるため、月の特性を大事にすることが、あなた自身をいたわることになります。また、自分を大切にできるようになることで、自分自身が満たされ、草木がしっかりと根を張ってから外に伸びていくように、あなたが自分を社会に打ち出し、成長していくパワーとなっていくため、とても大切です。月のサインやハウス、サビアンシンボルの特性を確認し、自分は日ごろそれを大切にできているか感じてみましょう。もしそういう部分をないがしろにしていたと感じたら、ぜひ暮らしの中で月を満たす時間を作りましょう。また、月の鑑定内容を見ることで、子ども時代の自分を思い出すこともできるでしょう。
                            </p>
                        @endif
                        @if ($planet == 'MERCURY')
                            <p class="C-appraisal-content-header__first-message__text">
                                　あなたは学童期にどのようなことに関心を持ち、どのように友人と接していましたか？ 学童期である8～15
                                歳ごろに最も強く作用し、あなたの知的興味関心や学習、人とのコミュニケーションなどにかかわるのが生まれた時の水星です。あなたがこの頃に関心があったこと、得意だった教科、どんなタイプの子どもだったか、といったことを思い出すと、以下の水星にかかわる鑑定内容と合致するでしょう。わたしたちは学童期に得た知的関心や学習方法、人とのかかわり方などを、大人になっても仕事の技術や興味関心のある分野、ものの考え方や言葉での伝え方、人とのかかわり方などの形で影響し続けます。
                            </p>
                        @endif
                        @if ($planet == 'VENUS')
                            <p class="C-appraisal-content-header__first-message__text">
                                　感受性が生き生きと豊かさを増す思春期に、あなたは何かに夢中になったり、誰かを好きになったりしませんでしたか？そういった、あなたの好みや楽しみの方向性や何に魅力を感じるのか、といったことにかかわるのが、「宵の明星」「明けの明星」として知られ、美の女神が支配する金星です。あなたの金星のサインやハウス、サビアンシンボルは、あなたがどんなことに夢中になるか、何を美しいと感じるか、何を好むか、ということをあらわします。思春期は金星の性質があなた自身のキャラクターとして最も強く影響します。そして、その後の人生においても、この頃大好きだったものを今も好きでい続けることが多いでしょう。以下の金星の鑑定内容を、青春時代の自分、そしてそのころから変わらない自分の「好きなもの」を思い出しながら読んでみると、多くの気づきがあるでしょう。また、女性にとっては恋愛の傾向があらわれて、男性にとっては好みの女性のタイプを金星のサインやハウスなどがあらわしているとされますので気にして読んでみてください。
                            </p>
                        @endif
                        @if ($planet == 'MARS')
                            <p class="C-appraisal-content-header__first-message__text">
                                　働き盛りといわれる年代が火星の年齢域で、この頃あなたが社会的にどのようなことを頑張るのか、どんな志を持ちチャレンジしていくのかを火星が表しています。火星は地球よりも外側のある天体で、より大きな宇宙への架け橋となります。この年齢の頃は、自分の限界や枠を広げようと新しいチャレンジをすることが重要になります。失敗もあるかもしれませんが、そうしたことも乗り越えていくことで、次の木星があらわす社会的な成功や拡大につながっていくのです。女性のホロスコープにおいて、火星は好みの男性のタイプをあらわすともされます。このような男性が好みかどうか、女性の皆様は鑑定をみながら感じてみてください。そして、本来は、男性に期待することとしてではなく、自分自身が社会に発揮して打ち出すものとして火星の性質を持っているのであり、たとえパートナーであってもそれを代行することはできないのだと理解しましょう。
                            </p>
                        @endif
                        @if ($planet == 'JUPITER')
                            <p class="C-appraisal-content-header__first-message__text">
                                　太陽系の惑星の中で最も大きな、大神ゼウスの星です。木星のサインやハウスなどからは、あなたがもともと恵まれていること、社会的に成功しやすいこと、お金につながる能力などを読み取ることが出来ます。また、木星の年齢域にあたる４０代後半からが最も木星と自己同一化しやすいため、木星のサインやハウスのテーマを社会の中で体現しやすくなります。人は恵まれていることには鈍感になりやすいのですが、木星を生かさなければ社会的な成功はありえません。ぜひ意識してよりよく生きる糧にしてください。
                            </p>
                        @endif
                        @if ($planet == 'SATURN')
                            <p class="C-appraisal-content-header__first-message__text">
                                　土星は肉眼で見える最も遠い星で、わたしたちの個性にかかわる天体は土星までだといえます。また、土星の内側の世界は時間と空間に支配され、この太陽系の「ルール」や「制限」にかかわります。わたしたちは、生まれた時から制限の中で生きています。この体も特性もある種の制限です。しかし、あらゆる創造活動にはルールや制限が必要です。描くべきキャンバスや画材、テーマが無ければ絵を描くことはできないように、この人生はあなたにしかできない何らかの創造活動の場なのです。占星術において、この人生であなたが達成したいことをあらわすのが土星です。若いうちはそれが苦手だと感じても、土星の年齢域である晩年期にはたいてい、それが安定してできるようになっています。土星のテーマは人生の課題であるとされますし、古典的な占星術では大凶星とされますが、本来は、あなたの社会的な基盤や安定にかかわるとともに、人生をより成熟させてくれる大切な天体です。鑑定文を読みながら、あなたがすでに土星の課題を克服できているか、まだまだ苦手なままか、などを感じ取ってみましょう。
                            </p>
                        @endif
                        @if ($planet == 'CHIRON')
                            <p class="C-appraisal-content-header__first-message__text">
                                　ドラゴンヘッドは月と太陽の軌道の交点であり、このそばでの新月や満月は「日食」や「月食」となります。太陽は魂の目的意識であり、月は過去や記憶、潜在意識にかかわります。それらが交わるポイントであるドラゴンヘッドは、魂の出入りが行われるホール（穴）のようになっているイメージがあります。魂の出入り口である筒状の穴が「龍」をあらわすのかもしれません。また、「ドラゴンヘッド」の名の通り、世界中の神話に出てくる、一体が輪になって自分のしっぽを噛む蛇や龍のシンボル「ウロボロス」との関連もある感受点です。西洋占星術では、この龍の姿がわたしたちの命の循環すなわち輪廻転生に例えられます。しっぽはカルマであり、龍の頭部は成長しようとする意識です。それらを踏まえ、わたしたちがどのようなテーマをもって魂の成長を目指して生まれてきたのかを表すのがドラゴンヘッドという感受点です。
                            </p>
                        @endif
                    </div>

                    <div class="C-appraisal-content-header__inner">
                        @if ($planet != 'SUN')
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
                                    本質的に持っている能力や特性をあらわすことが多く、このサビアンシンボルのテーマはあまり自覚できなかったり表には出にくい傾向があります。<br>しかし、確実に持ち合わせているものであり、この能力を生かせるようになると大きく変わります。<br>また、このサビアンシンボルがあらわすことが幼児期の体験や心象にかかわることも多くあります。
                                </dd>
                            </dl>
                        @endif
                        @if ($planet == 'MERCURY')
                            <dl class="C-appraisal-content-header-message">
                                <dt class="C-appraisal-content-header-message__title">水星のサビアンシンボル</dt>
                                <dd class="C-appraisal-content-header-message__text">
                                    水星のサビアンシンボルからは、あなたのもって生まれた知性の特徴がわかります。シンボルの解説文を読むときには、あなたが、学習や人とのコミュニケーションといった知的な活動をどのようにしようとしているか、といったことについて言及されているのだという意識で見てみましょう。
                                </dd>
                            </dl>
                        @endif
                        @if ($planet == 'VENUS')
                            <dl class="C-appraisal-content-header-message">
                                <dt class="C-appraisal-content-header-message__title">金星のサビアンシンボル</dt>
                                <dd class="C-appraisal-content-header-message__text">
                                    金星のサビアンシンボルからは、あなたのもって生まれた好みや感性の特徴が具体的にわかります。以下のシンボル解説の内容は、「好きなことに関係するテーマ」で発揮されるのだということを頭に入れて読んでいきましょう。また、先の金星のハウスのテーマを通して発揮できる面もあります。
                                </dd>
                            </dl>
                        @endif
                        @if ($planet == 'MARS')
                            <dl class="C-appraisal-content-header-message">
                                <dt class="C-appraisal-content-header-message__title">火星のサビアンシンボル</dt>
                                <dd class="C-appraisal-content-header-message__text">
                                    火星のサビアンシンボルからは、あなたの火星の年齢域の頃の特徴やそのころに獲得する能力、社会で実現させようと情熱を傾けるテーマなどが詳しくわかります。</dd>
                            </dl>
                        @endif
                        @if ($planet == 'JUPITER')
                            <dl class="C-appraisal-content-header-message">
                                <dt class="C-appraisal-content-header-message__title">木星のサビアンシンボル</dt>
                                <dd class="C-appraisal-content-header-message__text">
                                    木星は一つのサインにおよそ１年間滞在するため、あなたの木星の性質は、サビアンシンボルが最もよくあらわしています。木星のシンボル解説に書かれた能力などが、あなたの社会的な成功につながるのだとはっきりと認識できるといいでしょう。
                                </dd>
                            </dl>
                        @endif
                        @if ($planet == 'SATURN')
                            <dl class="C-appraisal-content-header-message">
                                <dt class="C-appraisal-content-header-message__title">土星のサビアンシンボル</dt>
                                <dd class="C-appraisal-content-header-message__text">
                                    土星のサビアンシンボルには、あなたが時間をかけ、努力して手に入れる能力が表れています。こういう人です、こういう能力があります、などと書かれた解説文でも、それを手に入れるのは晩年期であり、最終的な目標なのだと認識しておきましょう。また、土星の年齢域の頃にどのように生きるかをサビアンシンボルが示唆していることも多いでしょう。
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
                                    あなたの人生の目的を社会においてうまく発揮できるかどうか、社会でどのような困難にぶつかる可能性があるか、などといったことが太陽とのアスペクトから分かります。太陽の場合は、他の天体とのハードな配置を持っていても、乗り越えていく力や行動力が強いため、それを成長の糧にしていくことが可能です。
                                </dd>
                            </dl>
                        @endif
                        @if ($planet == 'MOON')
                            <dl class="C-appraisal-content-header-message">
                                <dt class="C-appraisal-content-header-message__title">アスペクト<br
                                        class="sp">（他の天体との関わりからわかること）</dt>
                                <dd class="C-appraisal-content-header-message__text">
                                    あなたが過酷な子ども時代を生きていたり、どうにも言えない生きにくさを抱えていたり、私生活に変化が多かったりする場合、他の天体からそのような影響を受けているからかもしれません。逆に、恵まれた子供時代であったり、暮らしの充足を感じられる場合もまた、他の天体からの影響かもしれません。<br>あなたの素質をよりよく生かすヒントや抱える困難の意味を知り、その克服に必要なことが月と他の天体とのアスペクトで理解できます。
                                </dd>
                            </dl>
                        @endif
                        @if ($planet == 'MERCURY')
                            <dl class="C-appraisal-content-header-message">
                                <dt class="C-appraisal-content-header-message__title">アスペクト<br
                                        class="sp">（他の天体との関わりからわかること）</dt>
                                <dd class="C-appraisal-content-header-message__text">
                                    あなたの知性がどう活かされるか、その発揮にどのような課題があるか、逆にどのような才能や個性を伴うか、といったことを、他の天体とのかかわりを理解することが出来ます。</dd>
                            </dl>
                        @endif
                        @if ($planet == 'VENUS')
                            <dl class="C-appraisal-content-header-message">
                                <dt class="C-appraisal-content-header-message__title">アスペクト<br
                                        class="sp">（他の天体との関わりからわかること）</dt>
                                <dd class="C-appraisal-content-header-message__text">
                                    あなたの魅力や感性をうまく発揮できるか、もしくはそれが制限されやすいか、そしてあなたの魅力の独創性は…？といったことが他の天体とのアスペクトから理解できます。<br>恋愛運や金運もまた、金星が他の天体とうまく調和しているかどうかなどから判断することが出来ます。
                                </dd>
                            </dl>
                        @endif
                        @if ($planet == 'MARS')
                            <dl class="C-appraisal-content-header-message">
                                <dt class="C-appraisal-content-header-message__title">アスペクト<br
                                        class="sp">（他の天体との関わりからわかること）</dt>
                                <dd class="C-appraisal-content-header-message__text">
                                    あなたが自分の野心をまっすぐに注ぎ達成することが出来るか、もしくは困難に多く突き当たるかといったことが他の天体とのかかわりからわかります。</dd>
                            </dl>
                        @endif
                        @if ($planet == 'JUPITER')
                            <dl class="C-appraisal-content-header-message">
                                <dt class="C-appraisal-content-header-message__title">アスペクト<br
                                        class="sp">（他の天体との関わりからわかること）</dt>
                                <dd class="C-appraisal-content-header-message__text">
                                    　木星は拡大させ光を当てる天体であり、これまでの天体にアスペクトをしていたなら、すでにその天体の恵まれた要素として先の鑑定文に掲載済みです。<br>
                                    　トランスサタニアンとのアスペクトは世代的な傾向でもあり、わりと漠然としたものとなりますが、参考にはなるでしょう。
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
                        @if ($planet != 'SATURN')
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
                                                    <img src="{{ asset('images/Sextile_symbol.svg') }}" alt="" width="20" height="20" alt="セクスタイルの記号" style="margin: 10px">
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
