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
    {{-- <link rel="stylesheet" href="{{ public_path('/assets/css/a4print.css') }}"> --}}

    <link rel="stylesheet" href="{{ public_path('/assets/css/reset.css') }}">
    <link rel="stylesheet" href="{{ public_path('/assets/css/class.css') }}">
    <link rel="stylesheet" href="{{ public_path('/assets/css/pdf.css') }}">
    <link rel="stylesheet" href="{{ public_path('/assets/css/pdf_solar.css') }}">
    <link rel="stylesheet" href="{{ public_path('/assets/css/a4print.css') }}">

    {{-- <link rel="stylesheet" href="{{ asset('/assets/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/class.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/pdf.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/pdf3.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/a4print.css') }}"> --}}
</head>

<body>
    <div class="basewidth">
        @php
            $page = 1;
        @endphp
        <div class="page page0" style="position: relative">
			<div class="page__inner">
				<div class="page0-header">
					<p class="page0-header__catchcopy handfont1">
                        {{-- <img src="{{ public_path('/assets/images/cathcopy3.svg') }}" alt="Know the universe , Live your life"> --}}
                    </p>
				</div>
				<div class="page0-pdftitle">
                    {{-- <img src="{{ public_path('/assets/images/logo_text3.svg') }}" alt="STELLAR BLUEPRINT"> --}}
                </div>
				<p class="page0-header__logo">
                    {{-- <img src="{{ public_path('/assets/images/logo3.svg') }}" alt="HOSI NO MAI"> --}}
                </p>
				<div class="page0-footer">
					{{-- <p class="page0-footer__text">Blueprint of</p> --}}
					<p class="page0-footer__text"></p>
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
				<div class="page01-pdftitle"><img src="{{ public_path('/assets/images/logo_solar.png') }}" alt="STELLAR BLUEPRINT"></div>
				<div class="page01-footer">
					<p class="page01-footer__text">Solar Return of {{ $formData['bookbinding_name'] }}</p>
					<p class="page01-footer__name">{{$formattedAge}}</p>
				</div>
			</div>
		</div>
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
        <div class="page page5 page--number page--number_left" data-pageno="{{ $page++ }}">
            <div class="page__inner">
                <p class="page5__title"><span>YOUR SOLAR RETURN CHAR</span></p>
                <div class="page5-data">
                    <p class="page5-data__day">
                        {{ $formattedAge2}}
                    </p>
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
                <p class="page--cover__title"><span data-tag="（アセンダント）">AC</span></p>
                <div class="page--cover-block1">
                    <p class="page--cover-block1__title">見た目や癖、振る舞いなど</p>
                    <p class="page__text">
                        <span>　アセンダントとはソーラーリターンの瞬間の東の地平線の位置をさし、ここにあった星座（サイン）が、あなたの1 年の無意識的な行動パターンとして現れやすくなります。</span>
                        <span>　また、アセンダントのサインとエネルギーが近い天体（チャートルーラー）の力が強まるため、チャートルーラが何なのかを解説文に入れています。後程チャートルーラーの天体を読む際に意識してみましょう。ントの星座の特徴に当てはまることが多いでしょう。</span>
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
                                    {{ $zodaicsPattern->where('zodiac_id', $house->get('zodiac_num'))->where('planet_id', 14)->pluck('content')->first() }}</span>
                            </p>
                        @endif
                    @endforeach
                </div>
                <span class="page--cover__frame"></span>
            </div>
        </div>
        <div class="page-break-before"></div>
        @php
            $page++;
        @endphp
        <div class="page page23 page--cover page--sun page--number page--number_right"
        data-pageno="" data-title="Sun">
        <div class="page__inner">
            <p class="page--cover__title"><span>太陽</span></p>
            <div class="page--cover-block1">
                <p class="page--cover-block1__title">最も重要。今年はやりたいことがうまくいくだろうか</p>
                <p class="page__text">
                    <span>　ソーラーリターンの太陽は、どんな年もあなたが生まれた時の星座と度数にあります。しかし、どのハウスにあるのか、他の天体とどんなアスペクト（角度）をとっているのかについては大変重要です。</span>
                    <span>　この１ 年が、あなたの目的意識の達成、成長、創造的な活動にどう影響するかは太陽の状況から予測することが出来ます。</span>
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
    <div class="page page25 page--content page--sun page--number page--number_right"
        data-pageno="{{ $page++ }}">
        <div class="page__inner">
            <div class="page-block page-block--4">
                <p class="page-block--4__title">
                    ハウス<span>{{ $explain->get('SUN')->get('house_pattern')->house->symbol }}</span></p>
                <p class="page__text">
                    <span style="text-indent: 0;">{!! nl2br($explain->get('SUN')->get('house_pattern')->content_solar) !!}</span>
                </p>
            </div>
            <div class="page-block page-block--2">
                <p class="page-block--2__title">アスペクト<span>他の天体との関わりからわかること</span></p>
                <p class="page__text">
                    <span>　太陽が他の天体とどうかかわっているかがこの1 年を読み解く重要なカギになります。一つ一つ丁寧に読み解いて、自分がやりたいことと比べてどうかを考えてみましょう。</span>
                </p>
            </div>
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
                            @if ($key < 2)
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
                                    <p class="page__text">{!! nl2br($item->content_solar) !!}</p>
                                </div>
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
    @if ($explain->get('SUN')->get('aspect_pattern')->forget([0,1])->values()->count() > 0)
        @php
            $items = $explain->get('SUN')->get('aspect_pattern')->forget([0,1])->values();
            $itemPairs = array_chunk($items->all(), 4);
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
                                        <p class="page__text">{!! nl2br($item->content_solar) !!}</p>
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
                    <p class="page--cover-block1__title">心の向かう先</p>
                    <p class="page__text">
                        <span>　月は、この1 年の心の状況や私生活をあらわします。生まれたときとは全く違う星座であることが多く、ソーラーリターンでは、この年のあなたの精神的な中心テーマが月のサインやハウスに表れやすくなっています。</span>
                        <span>　どんなことに気持ちが向かうか、感受性にどんな変化があるか、健康や暮らし、私生活全廃がどんなふうになりそうかがあらわれています。</span>
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
                        <span style="text-indent: 0;">{!! nl2br($explain->get('MOON')->get('zodiac_pattern')->content_solar) !!}</span>
                    </p>
                </div>
                <div class="page-block page-block--2">
                    <p class="page-block--2__title">月のサビアンシンボル</p>
                    <p class="page__text">
                        <span>　今年、暮らしや心の中であなたが抱くテーマを具体的にあらわします。サビアンシンボルが示すような体験や気づきがあるでしょう。</span>
                    </p>
                </div>
                <div class="page-block page-block--3">
                    @if (empty($explain->get('MOON')->get('sabian_pattern')))
                        <p class="page-block--3__title">これは特殊なケースです。 角度が0度の場合はサビアンは存在しません</p>
                    @else
                        <p class="page-block--3__title">
                            {{ $explain->get('MOON')->get('sabian_pattern')->zodiac->name }}{{ $explain->get('MOON')->get('sabian_pattern')->sabian_degrees }}
                            度「{{ $explain->get('MOON')->get('sabian_pattern')->title_solar }}」</p>
                        <p class="page__text">
                            <span style="text-indent: 0;">{!! nl2br($explain->get('MOON')->get('sabian_pattern')->content_solar) !!}</span>
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
                        <span style="text-indent: 0;">{!! nl2br($explain->get('MOON')->get('house_pattern')->content_solar) !!}</span>
                    </p>
                </div>
                <div class="page-block page-block--2">
                    <p class="page-block--2__title">アスペクト<span>他の天体との関わりからわかること</span></p>
                    <p class="page__text">
                        <span>　暮らしそのものにストレスが多いか、楽しみや癒しが多いかといったことは、月とのアスペクトに表れてい場合が多くなります。</span>
                    </p>
                </div>

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
                                @if ($key <= 1)
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
                                        <p class="page__text">{!! nl2br($item->content_solar) !!}</p>
                                    </div>
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
        @if ($explain->get('MOON')->get('aspect_pattern')->forget([0,1])->values()->count() > 0)
            @php
                $items = $explain->get('MOON')->get('aspect_pattern')->forget([0,1])->values();
                $itemPairs = array_chunk($items->all(), 4);
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
                                            <p class="page__text">{!! nl2br($item->content_solar) !!}</p>
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
                    <p class="page--cover-block1__title">知的な活動</p>
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
                        <span style="text-indent: 0;">{!! nl2br($explain->get('MERCURY')->get('zodiac_pattern')->content_solar) !!}</span>
                    </p>
                </div>
                <div class="page-block page-block--2">
                    <p class="page-block--2__title">水星のサビアンシンボル</p>
                    <p class="page__text">
                        <span>　水星のサビアンシンボルからは、あなたのもって生まれた知性の特徴がわかります。シンボルの解説文を読むときには、あなたが、学習や人とのコミュニケーションといった知的な活動をどのようにしようとしているか、といったことについて言及されているのだという意識で見てみましょう。</span>
                    </p>
                </div>
                <div class="page-block page-block--3">
                    @empty($explain->get('MERCURY')->get('sabian_pattern'))
                        <p class="page-block--3__title">これは特殊なケースです。 角度が0度の場合はサビアンは存在しません</p>
                    @else
                        <p class="page-block--3__title">
                            {{ $explain->get('MERCURY')->get('sabian_pattern')->zodiac->name }}{{ $explain->get('MERCURY')->get('sabian_pattern')->sabian_degrees }}
                            度「{{ $explain->get('MERCURY')->get('sabian_pattern')->title_solar }}」</p>
                        <p class="page__text">
                            <span style="text-indent: 0;">{!! nl2br($explain->get('MERCURY')->get('sabian_pattern')->content_solar) !!}</span>
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
                        <span style="text-indent: 0;">{!! nl2br($explain->get('MERCURY')->get('house_pattern')->content_solar) !!}</span>
                    </p>
                </div>
                <div class="page-block page-block--2">
                    <p class="page-block--2__title">アスペクト<span>他の天体との関わりからわかること</span></p>
                    <p class="page__text">
                        <span>　あなたの知性がどう活かされるか、その発揮にどのような課題があるか、逆にどのような才能や個性を伴うか、といったことを、他の天体とのかかわりを理解することが出来ます。</span>
                    </p>
                </div>
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
                                @if ($key <= 1)
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
                                        <p class="page__text">{!! nl2br($item->content_solar) !!}</p>
                                    </div>
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
        {{-- @if ($explain->get('MERCURY')->get('aspect_pattern')->count() > 0 && $explain->get('MERCURY')->get('aspect_pattern')[2] !== null) --}}
        @if ($explain->get('MERCURY')->get('aspect_pattern')->forget([0,1])->values()->count() > 0)
            @php
                $items = $explain->get('MERCURY')->get('aspect_pattern')->forget([0,1])->values();
                $itemPairs = array_chunk($items->all(), 4);
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
                                            <p class="page__text">{!! nl2br($item->content_solar) !!}</p>
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
                    <p class="page--cover-block1__title">その年の楽しみや喜び</p>
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
                        <span style="text-indent: 0;">{!! nl2br($explain->get('VENUS')->get('zodiac_pattern')->content_solar) !!}</span>
                    </p>
                </div>
                <div class="page-block page-block--2">
                    <p class="page-block--2__title">金星のサビアンシンボル</p>
                    <p class="page__text">
                        <span>　金星のサビアンシンボルからは、あなたのもって生まれた好みや感性の特徴が具体的にわかります。以下のシンボル解説の内容は、「好きなことに関係するテーマ」で発揮されるのだということを頭に入れて読んでいきましょう。また、先の金星のハウスのテーマを通して発揮できる面もあります。</span>
                    </p>
                </div>
                <div class="page-block page-block--3">
                    @if (empty($explain->get('VENUS')->get('sabian_pattern')))
                        <p class="page-block--3__title">これは特殊なケースです。 角度が0度の場合はサビアンは存在しません</p>
                    @else
                        <p class="page-block--3__title">
                            {{ $explain->get('VENUS')->get('sabian_pattern')->zodiac->name }}{{ $explain->get('VENUS')->get('sabian_pattern')->sabian_degrees }}
                            度「{{ $explain->get('VENUS')->get('sabian_pattern')->title_solar }}」</p>
                        <p class="page__text">
                            <span style="text-indent: 0;">{!! nl2br($explain->get('VENUS')->get('sabian_pattern')->content_solar) !!}</span>
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
                        <span style="text-indent: 0;">{!! nl2br($explain->get('VENUS')->get('house_pattern')->content_solar) !!}</span>
                    </p>
                </div>
                <div class="page-block page-block--2">
                    <p class="page-block--2__title">アスペクト<span>他の天体との関わりからわかること</span></p>
                    <p class="page__text">
                        <span>　あなたの魅力や感性をうまく発揮できるか、もしくはそれが制限されやすいか、そしてあなたの魅力の独創性は…？といったことが他の天体とのアスペクトから理解できます。</span>
                        <span>　恋愛運や金運もまた、金星が他の天体とうまく調和しているかどうかなどから判断することが出来ます。</span>
                    </p>
                </div>
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
                                @if ($key < 2)
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
                                        <p class="page__text">{!! nl2br($item->content_solar) !!}</p>
                                    </div>
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
        @if ($explain->get('VENUS')->get('aspect_pattern')->forget([0,1])->values()->count() > 0)
            @php
                $items = $explain->get('VENUS')->get('aspect_pattern')->forget([0,1])->values();
                $itemPairs = array_chunk($items->all(), 4);
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
                                            <p class="page__text">{!! nl2br($item->content_solar) !!}</p>
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

        {{-- <div class="page page26 page--bg page--number page--number_right" data-pageno="{{ $page++ }}"></div> --}}
        <div class="page-break-before"></div>
        <div class="page page27 page--cover page--mars page--number page--number_right"
            data-pageno="" data-title="Mars">
            <div class="page__inner">
                <p class="page--cover__title"><span>火星</span></p>
                <div class="page--cover-block1">
                    <p class="page--cover-block1__title">情熱を注入するが危なさも</p>
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
                        <span style="text-indent: 0;">{!! nl2br($explain->get('MARS')->get('zodiac_pattern')->content_solar) !!}</span>
                    </p>
                </div>
                <div class="page-block page-block--2">
                    <p class="page-block--2__title">火星のサビアンシンボル</p>
                    <p class="page__text">
                        <span>　火星のサビアンシンボルからは、あなたの火星の年齢域の頃の特徴やそのころに獲得する能力、社会で実現させようと情熱を傾けるテーマなどが詳しくわかります。</span>
                    </p>
                </div>
                <div class="page-block page-block--3">
                    @if (empty($explain->get('MARS')->get('sabian_pattern')))
                        <p class="page-block--3__title">これは特殊なケースです。 角度が0度の場合はサビアンは存在しません</p>
                    @else
                        <p class="page-block--3__title">
                            {{ $explain->get('MARS')->get('sabian_pattern')->zodiac->name }}{{ $explain->get('MARS')->get('sabian_pattern')->sabian_degrees }}
                            度「{{ $explain->get('MARS')->get('sabian_pattern')->title_solar }}」</p>
                        <p class="page__text">
                            <span style="text-indent: 0;">{!! nl2br($explain->get('MARS')->get('sabian_pattern')->content_solar) !!}</span>
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
                        <span style="text-indent: 0;">{!! nl2br($explain->get('MARS')->get('house_pattern')->content_solar) !!}</span>
                    </p>
                </div>
                <div class="page-block page-block--2">
                    <p class="page-block--2__title">アスペクト<span>他の天体との関わりからわかること</span></p>
                    <p class="page__text">
                        <span>　あなたが自分の野心をまっすぐに注ぎ達成することが出来るか、もしくは困難に多く突き当たるかといったことが他の天体とのかかわりからわかります。</span>
                    </p>
                </div>
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
                                @if ($key < 2)
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
                                        <p class="page__text">{!! nl2br($item->content_solar) !!}</p>
                                    </div>
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
        @if ($explain->get('MARS')->get('aspect_pattern')->forget([0,1])->values()->count() > 0)
            @php
                $items = $explain->get('MARS')->get('aspect_pattern')->forget([0,1])->values();
                $itemPairs = array_chunk($items->all(), 4);
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
                                            <p class="page__text">{!! nl2br($item->content_solar) !!}</p>
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
                    <p class="page--cover-block1__title">その年の幸運や拡大のありか</p>
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
                        <span style="text-indent: 0;">{!! nl2br($explain->get('JUPITER')->get('zodiac_pattern')->content_solar) !!}</span>
                    </p>
                </div>
                <div class="page-block page-block--2">
                    <p class="page-block--2__title">木星のサビアンシンボル</p>
                    <p class="page__text">
                        <span>　木星は一つのサインにおよそ１年間滞在するため、あなたの木星の性質は、サビアンシンボルが最もよくあらわしています。木星のシンボル解説に書かれた能力などが、あなたの社会的な成功につながるのだとはっきりと認識できるといいでしょう。</span>
                    </p>
                </div>
                <div class="page-block page-block--3">
                    @if (empty($explain->get('JUPITER')->get('sabian_pattern')))
                        <p class="page-block--3__title">これは特殊なケースです。 角度が0度の場合はサビアンは存在しません</p>
                    @else
                        <p class="page-block--3__title">
                            {{ $explain->get('JUPITER')->get('sabian_pattern')->zodiac->name }}{{ $explain->get('JUPITER')->get('sabian_pattern')->sabian_degrees }}
                            度「{{ $explain->get('JUPITER')->get('sabian_pattern')->title_solar }}」</p>
                        <p class="page__text">
                            <span style="text-indent: 0;">{!! nl2br($explain->get('JUPITER')->get('sabian_pattern')->content_solar) !!}</span>
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
                        <span style="text-indent: 0;">{!! nl2br($explain->get('JUPITER')->get('house_pattern')->content_solar) !!}</span>
                    </p>
                </div>
                <div class="page-block page-block--2">
                    <p class="page-block--2__title">アスペクト<span>他の天体との関わりからわかること</span></p>
                    <p class="page__text">
                        <span>　あなたの人生の目的を社会においてうまく発揮できるかどうか、社会でどのような困難にぶつかる可能性があるか、などといったことが太陽とのアスペクトから分かります。太陽の場合は、他の天体とのハードな配置を持っていても、乗り越えていく力や行動力が強いため、それを成長の糧にしていくことが可能です。
                        </span>
                    </p>
                </div>
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
                                @if ($key < 2)
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
                                        <p class="page__text">{!! nl2br($item->content_solar) !!}</p>
                                    </div>
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
        {{-- @if ($explain->get('JUPITER')->get('aspect_pattern')->count() > 0 && $explain->get('JUPITER')->get('aspect_pattern')[2] !== null) --}}
        {{-- @if ($explain->get('JUPITER')->get('aspect_pattern')->count() > 0 && !empty($explain->get('JUPITER')->get('aspect_pattern')[2])) --}}
        @if ($explain->get('JUPITER')->get('aspect_pattern')->forget([0,1])->values()->count() > 0)
            @php
                $items = $explain->get('JUPITER')->get('aspect_pattern')->forget([0,1])->values();
                $itemPairs = array_chunk($items->all(), 4);
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
                                            <p class="page__text">{!! nl2br($item->content_solar) !!}</p>
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
                    <p class="page--cover-block1__title">社会的な役割の変遷</p>
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
                        <span style="text-indent: 0;">{!! nl2br($explain->get('SATURN')->get('zodiac_pattern')->content_solar) !!}</span>
                    </p>
                </div>
                <div class="page-block page-block--2">
                    <p class="page-block--2__title">土星のサビアンシンボル</p>
                    <p class="page__text">
                        <span>　土星のサビアンシンボルには、あなたが時間をかけ、努力して手に入れる能力が表れています。こういう人です、こういう能力があります、などと書かれた解説文でも、それを手に入れるのは晩年期であり、最終的な目標なのだと認識しておきましょう。また、土星の年齢域の頃にどのように生きるかをサビアンシンボルが示唆していることも多いでしょう。</span>
                    </p>
                </div>
                <div class="page-block page-block--3">
                    @if (empty($explain->get('SATURN')->get('sabian_pattern')))
                        <p class="page-block--3__title">これは特殊なケースです。 角度が0度の場合はサビアンは存在しません</p>
                    @else
                        <p class="page-block--3__title">
                            {{ $explain->get('SATURN')->get('sabian_pattern')->zodiac->name }}{{ $explain->get('SATURN')->get('sabian_pattern')->sabian_degrees }}
                            度「{{ $explain->get('SATURN')->get('sabian_pattern')->title_solar }}」</p>
                        <p class="page__text">
                            <span style="text-indent: 0;">{!! nl2br($explain->get('SATURN')->get('sabian_pattern')->content_solar) !!}</span>
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
                        <span style="text-indent: 0;">{!! nl2br($explain->get('SATURN')->get('house_pattern')->content_solar) !!}</span>
                    </p>
                </div>
            </div>
        </div>
        @php
            $page++;
        @endphp
        <div class="page page--cover page--saturnians page--number page--number_right"
            data-pageno="" data-title="トランスサタニアン">
            <div class="page__inner">
                <p class="page--cover__title">トランスサタニアン</p>
                <div class="page--cover-block1">
                    <p class="page__text">
                        <span>　太陽の外側にあり、「トランスサタニアン」と呼ばれる天王星、海王星、冥王
                            星は、太陽回帰において、アスペクトのみならずハウスにおいても無意識的で
                            強い影響を与えます。</span>
                            <br>
                        <span>　天王星は、新しいものを取り入れたり、あなたの独自性を出したくなるテー
                            マがあらわれています。</span>
                        <span>　また、海王星は、あなたが抱くようになる理想。</span>
                        <span>　冥王星は、その一年で最も「変わる」テーマをあらわします。</span>
                        <br>
                        <span>　各天体のサビアンシンボルとハウスへの影響をまとめます。</span>
                        <br>
                        <span>　ハウスに関してはわかりやすいと思いますが、サビアンシンボルは読んでも
                            あまりピンと来ない可能性もあります。その場合は、一年経ったあとに改めて
                            読んでみると、なるほど！と思えるかもしれません。</span>
                    </p>
                </div>
                <div class="page--cover__image saturnians">
                    <svg style="height: 415px; width: 580px;"></svg>
                </div>
                <span class="page--cover__frame"></span>
            </div>
        </div>
        <div class="page-break-before"></div>
        <div class="page page35 page--cover page--uranus page--number page--number_right"
            data-pageno="" data-title="Uranus">
            <div class="page__inner">
                <p class="page--cover__title"><span>天王星</span></p>
                <div class="page--cover-block1">
                    <p class="page--cover-block1__title">変革させること、あなたの独自性を出すテーマ</p>
                    <p class="page__text">
                        <span>Content Uranus</span>
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
        <div class="page page36 page--content page--uranus page--number page--number_left"data-pageno="{{ $page++ }}">
            <div class="page__inner">
                <div class="page-block page-block--2">
                    <p class="page-block--2__title">天王星のサビアンシンボル</p>
                    <p class="page__text">
                        <span>content</span>
                    </p>
                </div>
                <div class="page-block page-block--3">
                    @if (empty($explain->get('URANUS')->get('sabian_pattern')))
                        <p class="page-block--3__title">これは特殊なケースです。 角度が0度の場合はサビアンは存在しません</p>
                    @else
                        <p class="page-block--3__title">
                            {{ $explain->get('URANUS')->get('sabian_pattern')->zodiac->name }}{{ $explain->get('URANUS')->get('sabian_pattern')->sabian_degrees }}
                            度「{{ $explain->get('URANUS')->get('sabian_pattern')->title_solar }}」</p>
                        <p class="page__text">
                            <span style="text-indent: 0;">{!! nl2br($explain->get('URANUS')->get('sabian_pattern')->content_solar) !!}</span>
                        </p>
                    @endif
                </div>
                <div class="page-block page-block--4">
                    <p class="page-block--4__title">
                        ハウス<span>{{ $explain->get('URANUS')->get('house_pattern')->house->symbol }}</span></p>
                    <p class="page__text">
                        <span style="text-indent: 0;">{!! nl2br($explain->get('URANUS')->get('house_pattern')->content_solar) !!}</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="page-break-before"></div>
        <div class="page page35 page--cover page--neptune page--number page--number_right"
            data-pageno="" data-title="Neptune">
            <div class="page__inner">
                <p class="page--cover__title"><span>海王星</span></p>
                <div class="page--cover-block1">
                    <p class="page--cover-block1__title">この時期、あなたが描く理想</p>
                    <p class="page__text">
                        <span>Content Neptune</span>
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
        <div class="page page36 page--content page--neptune page--number page--number_left"data-pageno="{{ $page++ }}">
            <div class="page__inner">
                <div class="page-block page-block--2">
                    <p class="page-block--2__title">海王星のサビアンシンボル</p>
                    <p class="page__text">
                        <span>content</span>
                    </p>
                </div>
                <div class="page-block page-block--3">
                    @if (empty($explain->get('NEPTUNE')->get('sabian_pattern')))
                        <p class="page-block--3__title">これは特殊なケースです。 角度が0度の場合はサビアンは存在しません</p>
                    @else
                        <p class="page-block--3__title">
                            {{ $explain->get('NEPTUNE')->get('sabian_pattern')->zodiac->name }}{{ $explain->get('NEPTUNE')->get('sabian_pattern')->sabian_degrees }}
                            度「{{ $explain->get('NEPTUNE')->get('sabian_pattern')->title_solar }}」</p>
                        <p class="page__text">
                            <span style="text-indent: 0;">{!! nl2br($explain->get('NEPTUNE')->get('sabian_pattern')->content_solar) !!}</span>
                        </p>
                    @endif
                </div>
                <div class="page-block page-block--4">
                    <p class="page-block--4__title">
                        ハウス<span>{{ $explain->get('NEPTUNE')->get('house_pattern')->house->symbol }}</span></p>
                    <p class="page__text">
                        <span style="text-indent: 0;">{!! nl2br($explain->get('NEPTUNE')->get('house_pattern')->content_solar) !!}</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="page-break-before"></div>
        <div class="page page35 page--cover page--pluto page--number page--number_right"
            data-pageno="" data-title="Pluto">
            <div class="page__inner">
                <p class="page--cover__title"><span>冥王星</span></p>
                <div class="page--cover-block1">
                    <p class="page--cover-block1__title">最も大きく変わるテーマ</p>
                    <p class="page__text">
                        <span>Content Pluto</span>
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
        <div class="page page36 page--content page--pluto page--number page--number_left"data-pageno="{{ $page++ }}">
            <div class="page__inner">
                <div class="page-block page-block--2">
                    <p class="page-block--2__title">冥王星のサビアンシンボル</p>
                    <p class="page__text">
                        <span>content</span>
                    </p>
                </div>
                <div class="page-block page-block--3">
                    @if (empty($explain->get('PLUTO')->get('sabian_pattern')))
                        <p class="page-block--3__title">これは特殊なケースです。 角度が0度の場合はサビアンは存在しません</p>
                    @else
                        <p class="page-block--3__title">
                            {{ $explain->get('PLUTO')->get('sabian_pattern')->zodiac->name }}{{ $explain->get('PLUTO')->get('sabian_pattern')->sabian_degrees }}
                            度「{{ $explain->get('PLUTO')->get('sabian_pattern')->title_solar }}」</p>
                        <p class="page__text">
                            <span style="text-indent: 0;">{!! nl2br($explain->get('PLUTO')->get('sabian_pattern')->content_solar) !!}</span>
                        </p>
                    @endif
                </div>
                <div class="page-block page-block--4">
                    <p class="page-block--4__title">
                        ハウス<span>{{ $explain->get('PLUTO')->get('house_pattern')->house->symbol }}</span></p>
                    <p class="page__text">
                        <span style="text-indent: 0;">{!! nl2br($explain->get('PLUTO')->get('house_pattern')->content_solar) !!}</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="page-break-before"></div>
        <div class="page page42 page--last">
			<div class="page__inner">
			</div>
		</div>
    </div>

</body>

</html>
