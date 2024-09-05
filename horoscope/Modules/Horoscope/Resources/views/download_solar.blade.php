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
					<p class="page01-header__logo"><img src="{{ public_path('/assets/images/logo1.png') }}" alt="HOSI NO MAI"></p>
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
        @php
            $page++;
        @endphp
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
                <p class="page5__title"><span>YOUR SOLAR RETURN CHART</span></p>
                <div class="page5-data">
                    <p class="page5-data__day">
                        {{$formattedAge2}}<br>
                        {{$formattedAge3}}
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
                    <p class="page--cover-block1__title">一年のエネルギーに大きく影響</p>
                    <p class="page__text">
                        <span> アセンダントとはソーラーリターンの瞬間の東の地平線の位置をさし、ここにあった星座(サイン)が、あなたの一年の無意識的な行動パターンとしてあらわれやすくなります。</span>
                        <span> また、アセンダントのサインとエネルギーが近い天体(チャートルーラー)の力が強まるため、チャートルーラーが何なのかを解説文に入れています。のちほど、チャートルーラーの天体を読む際に意識してみましょう。</span>
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
                    <span> ソーラーリターンの太陽は、あなたが生まれた時の星座と度数に必ずあります。しかし、どのハウスにあるのか、他の天体とどんなアスペクト（角度）をとっているのかについては毎年異なりますし、これがとても重要です。</span>
                    <span> 特に、太陽の入るハウスは一年のメインテーマといえるほど重要になります。</span>
                    <span> この一年が、あなたの目的意識の達成、成長、創造的な活動にどう影響するかを太陽の状況から予測することが出来ます。</span>
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
                    <span> 太陽が他の天体とどうかかわっているかがこの一年を読み解く重要なカギになります。一つひとつ丁寧に読み解いて、自分がやりたいことと比較し、進むヒントにしててください。</span>
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
                    <p class="page--cover-block1__title">あなたの暮らし。心は平穏か</p>
                    <p class="page__text">
                        <span> 月は、この一年の心の状況や私生活をあらわします。生まれたときとは全く
                            違う星座であることが多く、ソーラーリターンでは、この年のあなたの精神的
                            な中心テーマが月のサインやハウスにあらわれますので、とても重要です。
                            </span>
                        <span> どんなことに気持ちが向かうか、感受性にどんな変化があるか、健康や暮らし、
                            私生活全般がどんなふうになりそうかがあらわれています。
                        </span>
                        <span> 月の配置が豊かだと、暮らしや気持ちが安定する一年であることがわかりま
                            すし、月の配置が厳しいときは、実際に精神的に厳しいことが起こりやすいと
                            暗示されます。
                            </span>
                    </p>
                </div>
                <div class="page--cover__image moon"><svg></svg></div>
                <span class="page--cover__frame"></span>
            </div>
        </div>
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
                        <span> 今年、暮らしや心の中であなたが抱くテーマを具体的にあらわします。サビアンシンボルが示すような体験や気づ
                            きがあるでしょう。
                        </span>
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
                        <span> 暮らしそのものにストレスが多いか、楽しみや癒しが多いかといったことは、月とのアスペクトに表れてい場合が多くなります。</span>
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
                        <span> 水星からはこの一年、あなたが何に関心を示し、何を学ぼうとし、どのよう
                            な交友関係を結ぶのかといったことがわかります。
                            </span>
                        <span> 水星は太陽のそばにあることが多いため、出生図と同じ星座になることも多
                            いでしょうし、生まれた時の位置の前後の星座に入っていることもあるでしょ
                            う。出生図の水星と同じ星座の場合は普段通り、違う場合は、知的な関心ごと
                            や言葉で表現したいことのテーマがいつもと違う年になることがわかります。
                            </span>
                        <span>  ハウスやサビアンシンボル、水星へのアスペクトは毎年異なりますから、知
                            的な成長や学びがその年ごとに刷新されていきます。
                            </span>
                        <span> また、太陽があらわす目的意識を達成するために、知性やコミュニケーショ
                            ン能力をどう活かすといいかが示されていると考えるといいでしょう。
                            </span>
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
                        <span> 今年の知的な関心ごとやテーマが具体的にわかります。サビアンシンボルには、知識や認知的な領域で変わったり
                            獲得していくテーマが示されています。
                        </span>
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
                        <span> 言葉を用いたコミュニケーションや発信、情報の伝達などかがどうなりそうか、どのように発揮され、活かされるか
                            が示されています。
                        </span>
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
                        <span> 地球から見て金星は、太陽から約47度までしか離れませんので、生まれた時
                            の星座と同じ場所に金星があることも多いですが、異なる場合もあります。同
                            じ場合は、好きなことや楽しみごとにあまり変化がないともいえますし、星座
                            が異なるときにはその質が変化することがわかります。
                        </span>
                        <span> それ以外にも、サビアンシンボルからはあなたが今年獲得する楽しみや喜び
                            がどんなものなのかを具体的に知ることができますし、ハウスやアスペクトで
                            どんなふうに感受性が豊かに育まれるのか、魅力をどう打ち出していくことが
                            できそうか、などがあらわれています。
                        </span>
                        <span> ソーラーリターンの場合は太陽があらわす目的意識を成し遂げるために使わ
                            れる意味として読んでいくため、私生活ではなく仕事でこの感性が活かされる
                            か、仕事で楽しみが多いか、といったことがわかると考えます。
                        </span>
                        <span> 社会であなたの魅力的を表現するためにとても重要です。</span>
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
                        <span> 金星のサビアンシンボルからは、あなたのもって生まれた好みや感性の特徴が具体的にわかります。以下のシンボ
                            ル解説の内容は、「好きなことに関係するテーマ」で発揮されるのだということを頭に入れて読んでいきましょう。また、
                            先の金星のハウスのテーマを通して発揮できる面もあります。
                            </span>
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
                        <span> あなたの魅力や感性がうまく発揮されていきそうかが、他の天体とのかかわりから示されます。何らかの魅力や才
                            能を獲得しやすいのか、逆に制限してしまうのか、感性が高まるのか、出会いが多いか、など、さまざまなことがこ
                            こにあらわれます。
                        </span>
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
                        <span> この一年、自分がどんなことに情熱を注ぐか、同時にどんなことに怒りを感
                            じやすいかがあらわれています。生まれたときとは全く違う場所に位置してい
                            ることが多く、どんなことのために行動し、何を得ようとするのかがわかります。
                        </span>
                        <span>何かを成し遂げるためにうまく使うことができれば、大きな推進力となります。</span>
                        <span> 火星にハードな配置が多い場合はフラストレーションがたまりやすく、人と
                            争いやすいときかもしれません。火星はうまく扱う意識が大変重要になります。
                        </span>
                        <span> 火星のエネルギーを志のためにうまく扱えば、大きな成長を果たすことができ
                            るでしょう。
                        </span>
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
                        <span> この時期、社会的にどのようなことに集中して励むのか、どんなパッションをもって行動するのか、といったことが具体的に示されています</span>
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
                        <span> この時期、社会的にどのようなことに集中して励むのか、どんなパッションをもって行動するのか、といったことが具体的に示されています。</span>
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
                    <p class="page--cover-block1__title">その年の幸運のありか</p>
                    <p class="page__text">
                        <span> 拡大と幸運の星です。ソーラーリターンの木星からは、この一年、あなたが
                            どんなものを得ることができ、どんなチャンスや幸運がもたらされるのかが示
                            されています。
                            </span>
                        <span> 木星は一つの星座に一年ほど滞在するため、星座のテーマからは、その時期
                            に広がること、流行すること、好まれることなどがあらわれています。そのため、
                            12サインについての記述はあなた以外にも多くの人が該当する内容になりま
                            す。
                            </span>
                        <span> それに対して、ソーラーリターンの木星のハウス、サビアンシンボル、
                            アスペクトはあなた個人の一年の運勢としてとても重要になります。
                            </span>
                        <span> 木星は拡大と幸運の星ですから、どんなことをすれば社会的にうまくいくの
                            か、どんなことに恵まれるのかがわかります。特に、社会的·経済的な成功や、
                            だれもが気になるお金については、木星に示されています。
                            </span>

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
                        <span> あなたの今年の幸運にかかわるテーマがサビアンシンボルに具体的こあらわれています。そのような能力を身につけ、社会的に活かせるかもしれませんし、やるとうまくいきやすいことをあらわしていることもあります。そんな意識で見てみましょう。</span>
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
                        <span> 木星と個人天体がかかわると、その天体の意味を拡大させ、幸運につながりますので、非常に重要です。記載済み
                            のものも改めてご覧ください。また、ここに鑑定内容が記載される土星やトランスサタニアンとのアスペクトは時代
                            的な意味が強まりますので、だれにとっても今がそういう時期なのたと理解しましょう。
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
                    <p class="page--cover-block1__title">今年努力して手に入れるもの</p>
                    <p class="page__text">
                        <span> あなたがこの一年どんな努力をし何を形にしようとするのか、どのように社
                            会的な役割の基盤を構築するのかをあらわします。努力というとあまりいい気
                            分がしないかもしれませんが、しっかりと目的意識に合わせて努力ができてこ
                            そ、社会的な基盤が安定していきます。また、社会的な成功は責任とセットで
                            あることは否めないでしょう。
                        </span>
                        <span> 土星は一つの星座に 3年前後滞在するため、その影響は集合意識的なものに
                            なります。そのため12サインについては、みんなそういう時期なんだな、と思
                            うようにしてください。
                        </span>
                        <span> 個人として重要なのは、サビアンシンボルとハウスになります。</span>
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
                        <span> この一年、あなたが努力して手に入れようとすること、時間をかけて行っていこうとすることが具体的に示されています。社会的にはとても重要なテーマとなり、これを達成することで、社会基盤がさらに強固になるでしょう。</span>
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
                <div class="page-block page-block--2">
                    <p class="page-block--2__title">アスペクト<span>他の天体との関わりからわかること</span></p>
                    <p class="page__text">
                        <span> 土星のアスペクトについては、月から木星とのかかわりがある場合には記載済みです。土星とドラゴンヘッドのア
                            スペクトは時代に関わり、個人には影響しないため、記載を省略します。
                        </span>
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
                        <span> 太陽の外側にあり、「トランスサタニアン」と呼ばれる天王星、海王星、冥王
                            星は、太陽回帰において、アスペクトのみならずハウスにおいても無意識的で
                            強い影響を与えます。</span>
                            <br>
                        <span> 天王星は、新しいものを取り入れたり、あなたの独自性を出したくなるテー
                            マがあらわれています。</span>
                        <span> また、海王星は、あなたが抱くようになる理想。</span>
                        <span> 冥王星は、その一年で最も「変わる」テーマをあらわします。</span>
                        <br>
                        <span> 各天体のサビアンシンボルとハウスへの影響をまとめます。</span>
                        <br>
                        <span> ハウスに関してはわかりやすいと思いますが、サビアンシンボルは読んでも
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
        {{--<div class="page-break-before"></div>
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
        </div>--}}
        {{-- @php
            $page++;
        @endphp --}}
        <div class="page-break-before"></div>
        <div class="page page36 page--content page--uranus page--number page--number_left"data-pageno="{{ $page++ }}">
            <div class="page__inner">
                <div class="page--logo">
                    <img src="{{public_path('assets/images/logo_uranus.svg')}}" alt="">
                </div>
                <div class="page--title">
                    <p class="page-block--4__title">変革させること、あなたの独自性を出すテーマ</p>
                </div>
                <div class="page-block page-block--4">
                    <p class="page-block--4__title">
                        ハウス<span>{{ $explain->get('URANUS')->get('house_pattern')->house->symbol }}</span></p>
                    <p class="page__text">
                        <span style="text-indent: 0;">{!! nl2br($explain->get('URANUS')->get('house_pattern')->content_solar) !!}</span>
                    </p>
                </div>

                <div class="page-block page-block--2">
                    <p class="page-block--2__title">天王星のサビアンシンボル</p>
                    <p class="page__text">
                        <span style="text-indent: 0;"> あなたが変革したい、生き方を変えたい、新たに取り入れたいことなどについて、その具体的な方向性が天王星の
                            サビアンシンボルにあらわれます。
                        </span>
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

            </div>
        </div>
        {{-- <div class="page-break-before"></div> --}}
        {{-- <div class="page page35 page--cover page--neptune page--number page--number_right"
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
        </div> --}}
        {{-- @php
            $page++;
        @endphp --}}
        <div class="page-break-before"></div>
        <div class="page page36 page--content page--neptune page--number page--number_left"data-pageno="{{ $page++ }}">
            <div class="page__inner">
                <div class="page--logo">
                    <img src="{{public_path('assets/images/logo_neptune.svg')}}" alt="">
                </div>
                <div class="page--title">
                    <p class="page-block--4__title">この時期、あなたが描く理想</p>
                </div>

                <div class="page-block page-block--4">
                    <p class="page-block--4__title">
                        ハウス<span>{{ $explain->get('NEPTUNE')->get('house_pattern')->house->symbol }}</span></p>
                    <p class="page__text">
                        <span style="text-indent: 0;">{!! nl2br($explain->get('NEPTUNE')->get('house_pattern')->content_solar) !!}</span>
                    </p>
                </div>

                <div class="page-block page-block--2">
                    <p class="page-block--2__title">海王星のサビアンシンボル</p>
                    <p class="page__text">
                        <span>あなたが無意識的にどんな理想を描くのかが具体的にあらわれています。また、第六感的な感受性をどんな領域で
                            発揮させるか、どんな感覚が育つかがわかることもあります。
                            </span>
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

            </div>
        </div>
        <div class="page-break-before"></div>
        {{-- <div class="page page35 page--cover page--pluto page--number page--number_right"
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
        </div> --}}
        {{-- @php
            $page++;
        @endphp --}}
        <div class="page-break-before"></div>
        <div class="page page36 page--content page--pluto page--number page--number_left"data-pageno="{{ $page++ }}">
            <div class="page__inner">
                <div class="page--logo">
                    <img src="{{public_path('assets/images/logo_pluto.svg')}}" alt="">
                </div>
                <div class="page--title">
                    <p class="page-block--4__title">最も大きく変わるテーマ</p>
                </div>
                <div class="page-block page-block--4">
                    <p class="page-block--4__title">
                        ハウス<span>{{ $explain->get('PLUTO')->get('house_pattern')->house->symbol }}</span></p>
                    <p class="page__text">
                        <span style="text-indent: 0;">{!! nl2br($explain->get('PLUTO')->get('house_pattern')->content_solar) !!}</span>
                    </p>
                </div>
                <div class="page-block page-block--2">
                    <p class="page-block--2__title">冥王星のサビアンシンボル</p>
                    <p class="page__text">
                        <span>冥王星は一年かけてホロスコープ上をわずかしか進まないため、太陽回縁では多くの人が同じ冥王星のサビアンシ
                            ンボルを共有します。そのため、より集合意識的な意味が強まります。,とはいえ、あなたが深いレベルで変えようと
                            していることや手に入れようとしている力をあらわしていると考えてえんでみましょう。
                        </span>
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

            </div>
        </div>

        <div class="page-break-before"></div>
        <div class="page page41 page--thanks page--cover" data-title="{{ $dayCreate }}">
			<div class="page__inner">
                <div class="page--cover_icon"><img src="{{public_path('assets/images/title_icon.svg')}}" alt=""></div>
                <div class="page--cover__thank-image thanks"><svg></svg></div>
                <div class="page--cover__image hand"><svg></svg></div>
                <span class="page--cover__frame"></span>
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
