<?php

    // include( __DIR__ ."/astrology_scripts/constants.php");
    include( __DIR__ ."/constants.php");


    $retrograde = strip_tags($_GET["rx1"]);

    if (get_magic_quotes_gpc())
    {
        $longitude = unserialize(stripslashes($_GET["p1"]));
        $hc = unserialize(stripslashes($_GET["hc1"]));
    }
    else
    {
        $longitude = unserialize($_GET["p1"]);
        $hc = unserialize($_GET["hc1"]);
    }

    $useBg = strip_tags($_GET["bg"]);



function initPlanets(
    $longitude, 
    $num_planets,
    $max_num_pl_in_each_house,
    $deg_in_each_house
) {
    $planets = array();

    foreach ($longitude as $idx => $angle) {
        // 小惑星などはスルー
        if ($idx > ($num_planets-1)) {
            continue;
        }        
        $planets[$idx] = array(
          "angle" => $angle,
          "house" => floor($angle / 30) + 1
        );
    }
    arsort($planets);

    // 惑星記号の表示位置を決める
    foreach ($planets as $idx => $planet) {
        $from_cusp = Reduce_below_30($planet["angle"]);

        // @TODO 360-0度 付近のことを書く

        // 惑星の位置(角度)をハウスを６分割したスポットのいずれかに当てはめていく
        $indexy = floor($from_cusp * $max_num_pl_in_each_house / $deg_in_each_house);

        // 円盤グローバルのスポット(位置)
        //   ハウスごとのスポット数(6) × 惑星のハウス + 惑星のハウス内におけるスポット
        $chart_idx = ($planet["house"] - 1) * $max_num_pl_in_each_house + $indexy;

        // スポットが空いているか確認する
        //   -> 空いているところが見つかるまで隣へスライド
        while ($spots[$chart_idx] == 1) {
          $chart_idx++;
        }
        // 最終的に、使用するスポットを予約しておく
        $spots[$chart_idx] = 1;

        // $planet_angle[$sort_pos[$i]]
        $planets[$idx]["angleGlyph"] 
            = ($chart_idx * (3 * $deg_in_each_house) / (3 * $max_num_pl_in_each_house)) 
                + ($deg_in_each_house / (2 * $max_num_pl_in_each_house));    // needed for aspect lines

        $angle_spot = deg2rad($planet_angle[$idx] - $Ascendant);
        $angle_real = deg2rad($planet["angle"] - $Ascendant);                        
    }
    return $planets;
}


    // create the blank image
    $SCALE = 1;
    $OVERALL_SIZE = 640;
    $OVERALL_SIZE = 740 * $SCALE;
    // $IM = @imagecreatetruecolor($OVERALL_SIZE, $OVERALL_SIZE) or die("Cannot initialize new GD image stream");


    //
    //  Color Definitions
    // 
    // specify the colors
    $WHITE = isset($IM) ? imagecolorallocate($IM, 255, 255, 255) : "white";
    
    $RED = isset($IM) ? imagecolorallocate($IM, 255, 0, 0) : "red";
    $RED = isset($IM) ? imagecolorallocate($IM, 255, 0, 0) : "rgb(255,36,95)";

    $BLUE = isset($IM) ? imagecolorallocate($IM, 0, 0, 255) : "blue";
    $BLUE = isset($IM) ? imagecolorallocate($IM, 0, 0, 255) : "rgb(143,131,232)";

    $MAGENTA = isset($IM) ? imagecolorallocate($IM, 255, 0, 255) : "rgb(255,0,255)";
    $YELLOW = isset($IM) ? imagecolorallocate($IM, 255, 255, 0) : "yellow";
    $CYAN = isset($IM) ? imagecolorallocate($IM, 0, 255, 255) : "rgb(0,255,255)";

    $GREEN = isset($IM) ? imagecolorallocate($IM, 0, 224, 0) : "green";
    $GREEN = isset($IM) ? imagecolorallocate($IM, 0, 224, 0) : "rgb(53, 128, 114)";

    $DARK_GREY = isset($IM) ? imagecolorallocate($IM, 127, 127, 127) : "rgb(46,46,46)";
    $GREY = isset($IM) ? imagecolorallocate($IM, 127, 127, 127) : "rgb(127,127,127)";
    $GGREY = isset($IM) ? imagecolorallocate($IM, 217, 217, 217) : "rgb(217,217,217)";  
    $BLACK = isset($IM) ? imagecolorallocate($IM, 0, 0, 0) : "black";
    $LAVENDER = isset($IM) ? imagecolorallocate($IM, 160, 0, 255) : "rgb(160,0,255)";

    $ORANGE = isset($IM) ? imagecolorallocate($IM, 255, 127, 0) : "orange";
    $ORANGE = isset($IM) ? imagecolorallocate($IM, 255, 127, 0) : "rgb(232, 185, 112)";

    $LIGHT_BLUE = isset($IM) ? imagecolorallocate($IM, 239, 255, 255) : "rgb(239, 255, 255)";
    // $LIGHT_BLUE = isset($IM) ? imagecolorallocate($IM, 239, 255, 255) : "rgb(205, 255, 249)";

    $CREAM = isset($IM) ? imagecolorallocate($IM, 255, 255, 240) : "rgb(255,255,240)";
    // $CREAM = isset($IM) ? imagecolorallocate($IM, 255, 255, 240) : "rgb(219,255,191)";

    $BROWN = isset($IM) ? imagecolorallocate($IM, 249, 222, 200) : "brown";
    $LIGHT_BROWN = isset($IM) ? imagecolorallocate($IM, 249, 222, 200) : "rgb(232,201,163)";
    // $LIGHT_BROWN = $CREAM;


    //
    // Use cases and Colors
    //  線やサインなどの配色を定義
    //
    $BG_COLOR = "rgba( 255,255,255,0)";          // 水色
    $AURA_COLOR = $LIGHT_BLUE;
    $WHEEL_COLOR = $CREAM;            // チャート円盤はクリーム
    $LINE_COLOR = $GREY;              // 線色
    $LINE_COLOR_SECOND = $GREY;       // 線色 (2nd)
    $LINE_COLOR_3RD = $GGREY;         // 線色 (3rd)

    // 12星座とエレメントの配色
    $SIGN_COLOR = $GREY;              // 12宮
    $SIGN_COLOR_FIRE = $RED;          // 火のエレメント
    $SIGN_COLOR_EARTH= $GREEN;        // 土のエレメント
    $SIGN_COLOR_WIND = $ORANGE;       // 風のエレメント
    $SIGN_COLOR_WATER= $BLUE;         // 水のエレメント

    // specific colors
    $PLANET_COLOR = $BLACK;		    // was $CYAN;
    $PLANET_COLOR = $CYAN;		    // was $CYAN;
    $PLANET_COLOR = $DARK_GREY;		// was $CYAN;

    //
    // 設定のフラグ
    //
    // 背景に画像を重ねる
    if ($useBg === 'normal') {
    	$USE_BG_IMAGE = false;
    } else {
    	$USE_BG_IMAGE = true;
    }

    if ($USE_BG_IMAGE == true) {
      // use on bg_image
      $PLANET_COLOR = $WHITE;
      $BG_COLOR = $BLACK;
      $AURA_COLOR = $BLACK;
      $WHEEL_COLOR = "rgba( 127, 127, 127, 0.3)";
      $LINE_COLOR = $WHITE;      
    }

    $deg_min_color = $BLACK;		//$WHITE;
    $sign_color = $MAGENTA;

    $CANVAS_SIZE = $OVERALL_SIZE;		// size of rectangle in which to draw the wheel
    $CANVAS_SIZE_Y = $CANVAS_SIZE + 800;
    
    // WHEEL
    $diameter = 500 * $SCALE;						// diameter of circle drawn
    $RAD_WHEEL = $diameter / 2;

    // OUTER_WHEEL
    $outer_outer_diameter = 600 * $SCALE;			// diameter of circle drawn
    $outer_diameter_distance = ($outer_outer_diameter - $diameter) / 2;	// distance between outer-outer diameter and diameter    
    $RAD_WHEEL_OUTER = $outer_outer_diameter / 2;

    // INNER_WHEEL 
    //  内側の円盤（アスペクトを描くところ）はホイールからの距離で定義する
    $inner_diameter_offset = 90;			// diameter of circle drawn Default value
    $inner_diameter_offset = 160 * $SCALE;			// diameter of circle drawn
    $RAD_WHEEL_INNER = $RAD_WHEEL - $inner_diameter_offset / 2;

    // AURA
    $aura_diameter_offset = 80 * $SCALE;
    $RAD_AURA = $RAD_WHEEL_OUTER + $aura_diameter_offset / 2;

    // 惑星の表示径
    $dist_from_diameter1 = 40 * 1;			// distance inner planet glyph is from circumference of wheel
    $dist_from_diameter1 = 50 * 1;			// distance inner planet glyph is from circumference of wheel

    $dist_from_diameter1a = 12 * 1;			// distance inner planet glyph is from circumference of wheel - for line
    $dist_from_diameter2 = 58 * 1;			// distance outer planet glyph is from circumference of wheel
    $dist_from_diameter2a = 28 * 1;			// distance outer planet glyph is from circumference of wheel - for line
    $RADIUS = $diameter / 2;				// radius of circle drawn
    $CENTER_PT = $CANVAS_SIZE / 2;		// center of circle

    $last_planet_num = 14;				//add a planet
    $last_planet_num = 12;				//add a planet    
    $num_planets = $last_planet_num + 1;
    $max_num_pl_in_each_house = 6;
    $deg_in_each_house = 30;

    $planet_angle = array();

    // glyphs used for planets - HamburgSymbols.ttf - Sun, Moon - Pluto
    $pl_glyph[0] = 81;
    $pl_glyph[1] = 87;
    $pl_glyph[2] = 69;
    $pl_glyph[3] = 82;
    $pl_glyph[4] = 84;
    $pl_glyph[5] = 89;
    $pl_glyph[6] = 85;
    $pl_glyph[7] = 73;
    $pl_glyph[8] = 79;
    $pl_glyph[9] = 80;
    $pl_glyph[10] = 77;
    $pl_glyph[11] = 96;		//add a planet
    $pl_glyph[12] = 141;
    $pl_glyph[13] = 60;
    $pl_glyph[14] = 109;


    $PLANET_GLYPHS = array(
        "standard" => array(
            "0" => "?", // Sun
            "1" => "?", // 
            "2" => "?", // 
            "3" => "♀", // 
            "4" => "♂", // 
            "5" => "?", // 
            "6" => "?", // 
            "7" => "?", // 
            "8" => "?", // 
            "9" => "?", // 
            "10"=> "?", // 
            "11"=> "?", // 
            "12"=> "", //
            "13"=> "",
            "14"=> "", 
            "font" => __DIR__."/font/HamburgSymbols.ttf"          
        ),
        "Hamburg" => array(
            "0" => 81, //             
            "1" => 87, // 
            "2" => 69, // 
            "3" => 82, // 
            "4" => 84, // 
            "5" => 89, // 
            "6" => 85, // 
            "7" => 73, // 
            "8" => 79, // 
            "9" => 80, // 
            "10"=> 77, // 
            "11"=> 96, // 
            "12"=> 141, //
            "13"=> 60,
            "14"=> 109, 
            "font" => __DIR__."/font/HamburgSymbols.ttf"            
        ),
        "basic" => array(
            "0" => 65, //  sun
            "1" => 66,
            "2" => 67,
            "3" => 68,
            "4" => 69,
            "5" => 70,
            "6" => 71,
            "7" => 72,
            "8" => 73,
            "9" => 74,
            "10"=> 76, // ドラゴンヘッド
            "11"=> 85, // キロン
            "12"=> 84, // リリス

            "font" => __DIR__."/font/AstroDotBasic.ttf"
        ),
        "astrogadget" => array(
            "0" => "A",
            "1" => "B",
            "2" => "C",
            "3" => "D",
            "4" => "E",
            "5" => "F",
            "6" => "G",
            "7" => "H",
            "8" => "I",
            "9" => "J",
            "10"=> "K",
            "11"=> "L",
            "font" => __DIR__."/font/AstroDotBasic.ttf"          
        ),
        // これはプルートがPマークになっていないので使わないで
        "zodiacs" => array(
            "0" => "A",
            "1" => "B",
            "2" => "C",
            "3" => "D",
            "4" => "E",
            "5" => "F",
            "6" => "G",
            "7" => "g",
            "8" => "h",
            "9" => "i",
            "10"=> "j",
            "11"=> "k",
            "12"=> "l",
            "font" => __DIR__."/font/zodiac.s.ttf"
        ),        
    );

    $SIGN_GLYPHS = array(
        "Hamburg" => array(
            "1" => "a",
            "2" => "s",
            "3" => "d",
            "4" => "f",
            "5" => "g",
            "6" => "h",
            "7" => "j",
            "8" => "k",
            "9" => "l",
            "10"=> "z",
            "11"=> "x",
            "12"=> "c",
            "font" => __DIR__."/font/HamburgSymbols.ttf",
            "width" => 14,
            "height" => 12,
            "gap" => -20            
        ),
        "zodiacs" => array(
            "1" => "a",
            "2" => "b",
            "3" => "c",
            "4" => "d",
            "5" => "e",
            "6" => "f",
            "7" => "g",
            "8" => "h",
            "9" => "i",
            "10"=> "j",
            "11"=> "k",
            "12"=> "l",
            "font" => __DIR__."/font/zodiac.s.ttf",
            "width" => 24,
            "height" => 20,
            "gap" => -20
        ),
        "kr" => array(
            "1" => "A",
            "2" => "B",
            "3" => "C",
            "4" => "D",
            "5" => "E",
            "6" => "F",
            "7" => "G",
            "8" => "H",
            "9" => "I",
            "10"=> "J",
            "11"=> "K",
            "12"=> "L",
            "font" => __DIR__."/font/KR.Astro.1.ttf",
            "width" => 14,
            "height" => 12,
            "gap" => -20            
        ),
        "SL" => array(
            "1" => "a",
            "2" => "b",
            "3" => "c",
            "4" => "d",
            "5" => "e",
            "6" => "f",
            "7" => "g",
            "8" => "h",
            "9" => "i",
            "10"=> "j",
            "11"=> "k",
            "12"=> "l",
            "font" => __DIR__."/font/SLZodiacIcons.ttf",
            "width" => 14,
            "height" => 12,
            "gap" => -20          
        )
    );
    // glyphs used for planets - HamburgSymbols.ttf - Aries - Pisces
    $sign_glyph[1] = 97;
    $sign_glyph[2] = 115;
    $sign_glyph[3] = 100;
    $sign_glyph[4] = 102;
    $sign_glyph[5] = 103;
    $sign_glyph[6] = 104;
    $sign_glyph[7] = 106;
    $sign_glyph[8] = 107;
    $sign_glyph[9] = 108;
    $sign_glyph[10] = 122;
    $sign_glyph[11] = 120;
    $sign_glyph[12] = 99;

    $sign_glyph = $SIGN_GLYPHS[zodiacs];

    //
    // ハウスとアセンダントの初期化
    //
    $Ascendant = $hc[1];
    $HOUSE_CUSP = array();

    foreach ($hc as $key => $val) {
      if ($key <= 12) {
        $HOUSE_CUSP[$key] = array(
            "angle" => $val,
            "numberTextPos" => display_house_cusp_number( $key, (-1) * ($Ascendant - $val), 30),
            "countPlanet" => 0
        );
      }
    }

    //
    //  天体の初期化
    //   $PLANETS は後で キーを維持した値ソートをかける
    //   なので、ループするときは必ず foreach を使用すること
    //   
    //   インデックスは 0 -> 11 の 12個
    //      0:Sun
    //      1:Moon
    //      2:Mercury
    //      3:Venus
    //      4:Mars
    //      5:Jupiter
    //      6:Saturn
    //      7:Uranus
    //      8:Neptune
    //      9:Pluto
    //     10:キロン
    //     11:リリス
    //     12:ドラゴンヘッド
    // @TODO 天体数を決め打ちで渡しているのを可変にすること
    $PLANETS = initPlanets($longitude, 13,
        $max_num_pl_in_each_house, $deg_in_each_house);

    // 天体名の設定
    $PLANETS[0]["name"] = "太陽";
    $PLANETS[1]["name"] = "月";
    $PLANETS[2]["name"] = "水星";
    $PLANETS[3]["name"] = "金星";
    $PLANETS[4]["name"] = "火星";
    $PLANETS[5]["name"] = "木星";
    $PLANETS[6]["name"] = "土星";
    $PLANETS[7]["name"] = "天王星";
    $PLANETS[8]["name"] = "海王星";
    $PLANETS[9]["name"] = "冥王星";
    $PLANETS[10]["name"] = "ドラゴンヘッド";    
    $PLANETS[11]["name"] = "キロン";
    $PLANETS[12]["name"] = "リリス";
    // 天体をループし、各ハウスの天体数をカウントする
    foreach ($PLANETS as $k => $planet) {
        // $ttemp_house = floor($planet["angle"] / 30) + 1;
        $HOUSE_CUSP[$planet["house"]]["countPlanet"]++;
    }

    //
    // アスペクトの初期化
    //
    $ASPECTS = buildAspects($Ascendant);

    // アスペクト 記号
    $ASPECT_GLYPH = array(
      "1" => array("code" => 113, "color" => $RED),     //  0 deg
      "180" => array("code" => 119, "color" => $RED),	  //180 deg
      "120" => array("code" => 101, "color" => $BLUE),	//120 deg
      "90"  => array("code" => 114, "color" => $RED),	  // 90 deg
      "150" => array("code" => 111, "color" => $GREY),	//150 deg
      "60"  => array("code" => 116, "color" => $BLUE),	// 60 deg    
      "30"  => array("code" => 105, "color" => $GREY),  // 30 deg
      "45"  => array("code" => 121, "color" => $GREY)   // 45 deg
    );

    // 使用する文字の大きさをまとめて定義
    $FONTSIZE_DEFAULT = 18 * $SCALE;
    $FONTSIZE_SIGN = 24 * $SCALE;
    $FONTSIZE_PLANET = 32 * $SCALE;

    // imagefilledrectangle($IM, 0, 0, $CANVAS_SIZE, $CANVAS_SIZE, $WHITE);
    $image = new Imagick();
    $image->newImage( $CANVAS_SIZE, $CANVAS_SIZE, new ImagickPixel($BG_COLOR));
    $image->setImageFormat('png');

    // MUST BE HERE - I DO NOT KNOW WHY - MAYBE TO PRIME THE PUMP
    // imagettftext($IM, 10, 0, 0, 0, $BLACK, 'arial.ttf', " ");

    //
    // 円盤の背景
    //
    $outerAura = new ImagickDraw();
    $outerAura->setFillColor( new ImagickPixel( $AURA_COLOR));
    $outerAura->setStrokeOpacity(1);
    $outerAura->setStrokeWidth(2);    
    $outerAura->ellipse( $CENTER_PT, $CENTER_PT, $RAD_AURA, $RAD_AURA, 0, 360);

    $outerAura->setFontSize ( 15 * $SCALE);
    // $outerAura->annotation( 50, 50,'the size of rect is '.$CANVAS_SIZE."  and $useBg ?");

    $image->drawImage($outerAura);
    // // draw the outer-outer border of the chartwheel
    // imagefilledellipse($IM, $CENTER_PT, $CENTER_PT, $outer_outer_diameter + 80, $outer_outer_diameter + 80, $LIGHT_BLUE);

    // create colored rectangle on blank image

    //
    // 一番外側の円盤 = outer wheel
    //
    $outerDisk = new ImagickDraw();
    $outerDisk->setFillColor( new ImagickPixel($WHEEL_COLOR));
    $outerDisk->setStrokeColor( new ImagickPixel($LINE_COLOR));    
    $outerDisk->setStrokeWidth(1);
    $outerDisk->ellipse( $CENTER_PT, $CENTER_PT, 
        $RAD_WHEEL_OUTER, $RAD_WHEEL_OUTER, 0, 360);

    $offset_from_start_of_sign = $Ascendant - (floor($Ascendant / 30) * 30);
    for ($i = $offset_from_start_of_sign; $i <= $offset_from_start_of_sign + 330; $i = $i + 10)
    {
        $xx = -($RAD_WHEEL_OUTER) * cos(deg2rad($i));
        $yy = -($RAD_WHEEL_OUTER) * sin(deg2rad($i));
        $outerDisk->line($CENTER_PT,$CENTER_PT, $CENTER_PT+$xx, $CENTER_PT+$yy);
    }

    // 線を描く
    // $outerDisk->setStrokeColor( new ImagickPixel);
    $outerDisk->ellipse( $CENTER_PT, $CENTER_PT, 
        $RAD_WHEEL_OUTER-(5*$SCALE), $RAD_WHEEL_OUTER-(5*$SCALE), 0, 360);


    // 内側の飾り線を描きますよ
    $outerDisk->ellipse( $CENTER_PT, $CENTER_PT, 
        $RAD_WHEEL+(5*$SCALE), $RAD_WHEEL+(5*$SCALE), 0, 360);
    $outerDisk->ellipse( $CENTER_PT, $CENTER_PT, 
        $RAD_WHEEL, $RAD_WHEEL, 0, 360);
    
    // 12宮の分割線を描きますよ
    drawDividingLineBetweenSigns( $outerDisk, $Ascendant);
    

    // 12宮のサインを描きます
    $outerDisk->setFont($sign_glyph["font"]);
    $outerDisk->setFontSize( $FONTSIZE_SIGN );
    $outerDisk->setStrokeColor($GREY);
    $outerDisk->setFillColor($SIGN_COLOR);


    // さらに細かく線を描きます
    $offset_from_start_of_sign = $Ascendant - (floor($Ascendant / 30) * 30);
    for ($i = $offset_from_start_of_sign; $i <= $offset_from_start_of_sign + 330; $i = $i + 10)
    {
        $xx = -($RAD_WHEEL+(5*$SCALE)) * cos(deg2rad($i));
        $yy = -($RAD_WHEEL+(5*$SCALE)) * sin(deg2rad($i));
        $outerDisk->line($CENTER_PT,$CENTER_PT, $CENTER_PT+$xx, $CENTER_PT+$yy);
    }

    drawSigns( $outerDisk, $sign_glyph, $Ascendant);
  
// @TODO コメント外してください    
   $image->drawImage($outerDisk);
    // // draw the outer-outer circle of the chartwheel
    // imagefilledellipse($IM, $CENTER_PT, $CENTER_PT, 
            // $outer_outer_diameter, $outer_outer_diameter, $LIGHT_BROWN); // $WHITE);
    // imageellipse($IM, $CENTER_PT, $CENTER_PT, 
            // $outer_outer_diameter, $outer_outer_diameter, $LINE_COLOR_SECOND);
    // imageellipse($IM, $CENTER_PT, $CENTER_PT, 
            // $outer_outer_diameter-10, $outer_outer_diameter-10, $LINE_COLOR_SECOND);
    //
    //  一番外側の円盤 = outer wheel
    //  ここまで　
    //  

    //
    // チャートホイールを描画する
    //
    $mainWheel = new ImagickDraw();
    $mainWheel->setFillColor( new ImagickPixel($AURA_COLOR));
    $mainWheel->setStrokeColor( new ImagickPixel($LINE_COLOR));
    $mainWheel->setFont( $PLANET_GLYPHS["basic"]["font"]);
    $mainWheel->setFontSize( $FONTSIZE_PLANET );       
    $mainWheel->ellipse( $CENTER_PT, $CENTER_PT,
        $RAD_WHEEL, $RAD_WHEEL, 0, 360);

    // put planets in chartwheel
    // sort longitudes in descending order from 360 down to 0
    $sort_pos = array();
    Sort_planets_by_descending_longitude($num_planets, $longitude, $sort, $sort_pos);

    // count how many planets are in each house
    Count_planets_in_each_house($num_planets, $sort, $sort_pos, $nopih, $spot_filled);

// var_dump($sort);
// var_dump($sort_pos);

    // 惑星のサインを描画
    // drawPlanetGlyphs( $num_planets, $sort, $sort_pos, $nopih, $spot_filled, $Ascendant );
    // hogehogefunc($mainWheel, $num_planets, $Ascendant);
    $mainWheel->setFillColor( new ImagickPixel($PLANET_COLOR));
    $mainWheel->setStrokeColor( new ImagickPixel($PLANET_COLOR));
    $planet_angle = calcPlanetSpot( $mainWheel, $Ascendant);

    // @TODO コメント外して
    $image->drawImage($mainWheel);

    // // draw the outer circle of the chartwheel
    // imagefilledellipse($IM, $CENTER_PT, $CENTER_PT, $diameter, $diameter, $LIGHT_BLUE);
    // imageellipse($IM, $CENTER_PT, $CENTER_PT, $diameter, $diameter, $LINE_COLOR_SECOND);
    // imageellipse($IM, $CENTER_PT, $CENTER_PT, $diameter+10, $diameter+10, $LINE_COLOR_SECOND);  
    //
    // チャートホイールを描画する
    // -- ここまで

    //
    // 内側の円盤を描画する (アスペクト)
    //
    $innerWheel = new ImagickDraw();
    $innerWheel->setFillColor( new ImagickPixel($WHEEL_COLOR));
    $innerWheel->setStrokeColor( new ImagickPixel($LINE_COLOR));
    $innerWheel->setFont(__DIR__."/font/HandyGeorge.ttf");
    $innerWheel->setFontSize($FONTSIZE_DEFAULT);    
    $innerWheel->ellipse( $CENTER_PT, $CENTER_PT,
        $RAD_WHEEL_INNER, $RAD_WHEEL_INNER, 0, 360);

    // アスペクトの線を描画します
    // @TODO
    // drawAspectLines( $innerWheel, 10, $Ascendant, $sort_pos);
    drawAspects2( $innerWheel, $Ascendant);
    $innerWheel->setStrokeColor( new ImagickPixel($LINE_COLOR));

    // var_dump ($ASPECTS);

    // ハウスの分割線を描画する
    drawHouseCusps( $innerWheel, $Ascendant );

// @TODO コメント外してください
    $image->drawImage($innerWheel);  // 円盤の描画を終える

    // 惑星の表を描画
    $imgPlTable = new Imagick();
    $imgPlTable->newImage( $CANVAS_SIZE, $CANVAS_SIZE, new ImagickPixel('white'));
    $imgPlTable->setImageFormat("png");

    $plTable = new ImagickDraw();
    drawPlanetTable( $plTable );
    $imgPlTable->drawImage($plTable);

    // // draw the inner circle of the chartwheel
    // imagefilledellipse($IM, $CENTER_PT, $CENTER_PT, $diameter - ($inner_diameter_offset * 2), $diameter - ($inner_diameter_offset * 2), $LIGHT_BROWN); // $WHITE);
    // imageellipse($IM, $CENTER_PT, $CENTER_PT, $diameter - ($inner_diameter_offset * 2), $diameter - ($inner_diameter_offset * 2), $LINE_COLOR_SECOND);
    // 
    // 内側の円盤を描画する (アスペクト)
    // ここまで!! 

    // テクスチャになる透過用の画像をロード
    $image_back = new Imagick();
    $imgnumber = mt_rand(1, 7);
    // $image_back->readImage(__DIR__."/img/39379535_p16_master1200.jpg");
    // $image_back->readImage(__DIR__."/img/shinsotsusaiyou.jpg");

    // $image_back->readImage(__DIR__."/img/39379535_p13_master1200.jpg");
    // $image_back->readImage(__DIR__."/img/170353fc5c5e66489_m.jpeg");
    // $image_back->readImage(__DIR__."/img/8379386209_27c9fcfa07_b.jpg");
    $image_back->readImage(__DIR__."/img/$imgnumber.jpeg");

    // イメージを複製して
    //   1, 背景の空間をチャートの形に切り抜いて
    //   2, チャートと重ねるという順番にしようか

    // 1, 複製を作る
    $image_copied = clone $image;

    // 2, 複製使って背景を切り抜く
    $image_copied->compositeImage( $image_back, Imagick::COMPOSITE_IN, 0, 0, Imagick::CHANNEL_DEFAULT);

    // 3, チャートと重ねる
    // $image_back->compositeImage( $image, Imagick::COMPOSITE_SCREEN, 0, 0, Imagick::CHANNEL_DEFAULT);
    if ($USE_BG_IMAGE) {
      // $image->compositeImage( $image_copied, Imagick::COMPOSITE_HARDLIGHT , 0, 0, Imagick::CHANNEL_DEFAULT);
      $image->compositeImage( $image_copied, Imagick::COMPOSITE_BLEND , 0, 0, Imagick::CHANNEL_DEFAULT);
    }        
    // $outerAura->composite( COMPOSITE_SCREEN, 0, 0, $CANVAS_SIZE, $CANVAS_SIZE, $image_back);


    // チャートと惑星表を結合
    $image->addImage($imgPlTable);
    $image->setImageIndex(0);
    $image = $image->appendImages(true);

    // set the content-type
    header("Content-type: image/png");


    echo $image;
    $image->clear();
    $image_back->clear();
    $image_copied->clear();


    /*
    *  drawDividingLineBetweenSigns 
    *    星座間の分割線を描画する
    *
    *   @param $outer_diameter_distance -- 外径までの距離
    *   @param $CENTER_PT -- 中心座標
    *   @param $Ascendant -- アセンダント 
    */
    function drawDividingLineBetweenSigns( 
        $draw, 
        $Ascendant
    ) {
        global 
            $CENTER_PT, 
            $IM, 
            $BLACK, 
            $RADIUS,
            $RAD_WHEEL_OUTER
            ;
        $offset_from_start_of_sign = $Ascendant - (floor($Ascendant / 30) * 30);

        for ($i = $offset_from_start_of_sign; $i <= $offset_from_start_of_sign + 330; $i = $i + 30)
        {
            $x7 = -($RAD_WHEEL_OUTER) * cos(deg2rad($i));
            $y7 = -($RAD_WHEEL_OUTER) * sin(deg2rad($i));
            $draw->line($CENTER_PT, $CENTER_PT, $CENTER_PT + $x7, $CENTER_PT + $y7);            
        }
    }

    /*
    *  drawHouseCusps 
    *    ハウスの境界線を描画する
    *
    *   @param $inner_diameter_offset -- 円周から内径までの距離
    *   @param $center_pt -- 中心座標
    *   @param $color -- 描画する色
    *   @param $Ascendant -- アセンダント (上昇点?)
    */
    function drawHouseCusps( &$draw, $Ascendant ) {

        global 
            $IM, 
            $RADIUS, 
            $LIGHT_BLUE,

            $HOUSE_CUSP,
            $CENTER_PT,
            $RAD_WHEEL,
            $LINE_COLOR
        ;

        // draw the lines for the house cusps
        $spoke_length = 20;
        for ($i = 1; $i <= 12; $i = $i + 1)
        {
            $angle = $Ascendant - $HOUSE_CUSP[$i]["angle"];
            
            $x1 = -$RADIUS * cos(deg2rad($angle));
            $y1 = -$RADIUS * sin(deg2rad($angle));

            $x2 = -($RADIUS - $inner_diameter_offset) * cos(deg2rad($angle));
            $y2 = -($RADIUS - $inner_diameter_offset) * sin(deg2rad($angle));

            $x2 = $center_pt;
            $y2 = $center_pt;

            $x7 = -$RAD_WHEEL * cos(deg2rad($angle));
            $y7 = -$RAD_WHEEL * sin(deg2rad($angle));
            $draw->line( $CENTER_PT, $CENTER_PT, $CENTER_PT + $x7, $CENTER_PT + $y7 );

            // if ($i != 1 And $i != 10)
            // imageline($IM, $x1 + $center_pt, $y1 + $center_pt, $x2 + $center_pt, $y2 + $center_pt, $color);
            // imageline($IM, $x1 + $center_pt, $y1 + $center_pt, $center_pt, $center_pt, $color);      

            // ハウスの番号を描画する
            // display the house cusp numbers themselves
            // display_house_cusp_number($i, -$angle, $RADIUS - $inner_diameter_offset, $xy);


            // ここはまだ未実装
            // display_house_cusp_number($i, -$angle, 30, $xy);    
            // imagettftext($IM, 10, 0, $xy[0] + $center_pt, $xy[1] + $center_pt, $color, 'arial.ttf', $i);
            $txtX = $HOUSE_CUSP[$i]["numberTextPos"]["x"] + $CENTER_PT;
            $txtY = $HOUSE_CUSP[$i]["numberTextPos"]["y"] + $CENTER_PT;
            $hcNum = $HOUSE_CUSP[$i]["numberTextPos"]["num"];
            // $txtY = $HOUSE_CUSP[$i]["numberTextPos"]["num"] + $CENTER_PT;            
            $draw->annotation( $txtX, $txtY, $hcNum);
        }

        // @TODO ここもこれから Magick化すること
        // $draw->
        $draw->ellipse( $CENTER_PT, $CENTER_PT, 30, 30, 0, 360);        
        // imagefilledellipse($IM, $center_pt, $center_pt, 50, 50, $LIGHT_BLUE);
        // imageellipse($IM, $center_pt, $center_pt, 50, 50, $BLACK);
    }            

    /*
    *
    *  ハウス番号の表示位置を決定する
    *  @return xy 番号表示位置の座標
    */
    Function display_house_cusp_number($num, $angle, $radii)
    {
        if ($num < 10)
        {
            $char_width = 10;
        }
        else
        {
            $char_width = 16;
        }
        $half_char_width = $char_width / 2;
        $char_height = 12;
        $half_char_height = $char_height / 2;

        //puts center of character right on circumference of circle
        $xpos0 = -$half_char_width;
        $ypos0 = $char_height;

        if ($num == 1)
        {
            $x_adj = -cos(deg2rad($angle)) * $char_width;
            $y_adj = sin(deg2rad($angle)) * $char_height;
        }
        elseif ($num == 2)
        {
            $x_adj = -cos(deg2rad($angle)) * $half_char_width;
            $y_adj = sin(deg2rad($angle)) * $char_height;
        }
        elseif ($num == 3)
        {
            $xpos0 = $half_char_width;
            $x_adj = -cos(deg2rad($angle)) * $half_char_width;
            $y_adj = sin(deg2rad($angle)) * $half_char_height;
        }
        elseif ($num == 4)
        {
            $xpos0 = $char_width;
            $x_adj = -cos(deg2rad($angle)) * $half_char_width;
            $y_adj = sin(deg2rad($angle)) * $half_char_height;
        }
        elseif ($num == 5)
        {
            $xpos0 = $char_width;
            $x_adj = -cos(deg2rad($angle)) * $half_char_width;
            $ypos0 = $half_char_height;
            $y_adj = sin(deg2rad($angle)) * $half_char_height;
        }
        elseif ($num == 6)
        {
            $xpos0 = $char_width;
            $x_adj = -cos(deg2rad($angle)) * $half_char_width;
            $ypos0 = -$half_char_height;
            $y_adj = sin(deg2rad($angle)) * $half_char_height;
        }
        elseif ($num == 7)
        {
            $x_adj = -cos(deg2rad($angle)) * $char_width;
            $ypos0 = -$half_char_height;
            $y_adj = -sin(deg2rad($angle)) * $half_char_height;
        }
        elseif ($num == 8)
        {
            $x_adj = -cos(deg2rad($angle)) * $char_width;
            $ypos0 = -$half_char_height;
            $y_adj = sin(deg2rad($angle)) * $half_char_height;
        }
        elseif ($num == 9)
        {
            $xpos0 = -$char_width;
            $x_adj = -cos(deg2rad($angle)) * $char_width;
            $ypos0 = -$half_char_height;
            $y_adj = sin(deg2rad($angle)) * $half_char_height;
        }
        elseif ($num == 10)
        {
            $xpos0 = -$char_width;
            $x_adj = -cos(deg2rad($angle)) * $char_width;
            $ypos0 = $half_char_height;
            $y_adj = sin(deg2rad($angle)) * $char_height;
        }
        elseif ($num == 11)
        {
            $xpos0 = -$char_width;
            $x_adj = -cos(deg2rad($angle)) * $char_width;
            $y_adj = sin(deg2rad($angle)) * $char_height;
        }
        elseif ($num == 12)
        {
            $x_adj = -cos(deg2rad($angle)) * $char_width;
            $y_adj = sin(deg2rad($angle)) * $half_char_height;
        }
        $xy = array(
            "x" => $xpos0 + $x_adj - ($radii * cos(deg2rad($angle))),
            "y" => $ypos0 + $y_adj + ($radii * sin(deg2rad($angle))),
            "num" => $num
        );
        // $xy["x"] = $xpos0 + $x_adj - ($radii * cos(deg2rad($angle)));
        // $xy["y"] = $ypos0 + $y_adj + ($radii * sin(deg2rad($angle)));

        return $xy;
    }

/*
*  drawSigns 
*    １２星座のサインを描画する
*
*   @param &$draw
*   @param $sign_glyph
*   @param $Ascendant
*/
function drawSigns( &$draw, $sign_glyph, $Ascendant) {
  
  global  
    $SIGN_COLOR_FIRE,
    $SIGN_COLOR_EARTH,
    $SIGN_COLOR_WIND,
    $SIGN_COLOR_WATER,

    $CENTER_PT,
    $RAD_WHEEL
;

  // put signs around chartwheel
  $cw_sign_glyph = $sign_glyph["width"]; // 14;
  $ch_sign_glyph = $sign_glyph["height"]; // 12;
  $gap_sign_glyph = $sign_glyph["gap"]; // -20;

  $cw_sign_glyph = 22;
  $ch_sign_glyph = 20;
  $gap_sign_glyph = -14;

  for ($i = 1; $i <= 12; $i++)
  {
    $angle_to_use = deg2rad((($i - 1) * 30) + 15 - $Ascendant);

    $center_pos_x = -$cw_sign_glyph / 2;
    $center_pos_y = $ch_sign_glyph / 2;

    $offset_pos_x = $center_pos_x * cos($angle_to_use);
    $offset_pos_y = $center_pos_y * sin($angle_to_use);

    $x1 = $center_pos_x + $offset_pos_x + ((-$RAD_WHEEL + $gap_sign_glyph) * cos($angle_to_use));
    $y1 = $center_pos_y + $offset_pos_y + (($RAD_WHEEL - $gap_sign_glyph) * sin($angle_to_use));

    // $x1 = (-$RAD_WHEEL) * cos($angle_to_use);
    // $y1 = $RAD_WHEEL * sin($angle_to_use);

    // 火のエレメント
    if ($i == 1 Or $i == 5 Or $i == 9)
    {
      $clr_to_use = $SIGN_COLOR_FIRE;
    }
    // 土のエレメント
    elseif ($i == 2 Or $i == 6 Or $i == 10)
    {
      $clr_to_use = $SIGN_COLOR_EARTH;
    }
    // 風のエレメント
    elseif ($i == 3 Or $i == 7 Or $i == 11)
    {
      $clr_to_use = $SIGN_COLOR_WIND;
    }
    // 水のエレメント
    elseif ($i == 4 Or $i == 8 Or $i == 12)
    {
      $clr_to_use = $SIGN_COLOR_WATER;
    }

    $draw->setStrokeColor( new ImagickPixel($clr_to_use));
    $draw->setFillColor( new ImagickPixel($clr_to_use));
    $draw->annotation( $x1 + $CENTER_PT, $y1 + $CENTER_PT, $sign_glyph[$i]);    
  }
} 

function buildAspects( $Ascendant ) {
  global 
    $PLANETS,
    $last_planet_num
  ;

  $planets = $PLANETS;
  ksort ($planets);

  $aspects = array();

  for ($i = 0; $i <= 8; $i++) {
    for ($j = $i + 1; $j <= 9; $j++) {

      $q = 0;
      $da = Abs($planets[$i]["angle"] - $planets[$j]["angle"]);

      if ($da > 180) {
        $da = 360 - $da;
      }

      // set orb - 8 if Sun or Moon, 6 if not Sun or Moon
      if ($i == 0 Or $i == 1 Or $j == 0 Or $j == 1) {
        $orb = 8;
      } else {
        $orb = 6;
      }

      // is there an aspect within orb ?
      if ($da <= $orb) {
        $q = 1;
      } elseif (($da <= (30 + $orb)) And ($da >= (30 - $orb))) {
        $q = 30;
      } elseif (($da <= (45 + $orb)) And ($da >= (45 - $orb))) {
        $q = 45;        
      } elseif (($da <= (60 + $orb)) And ($da >= (60 - $orb))) {
        $q = 60;
      } elseif (($da <= (90 + $orb)) And ($da >= (90 - $orb))) {
        $q = 90;
      } elseif (($da <= (120 + $orb)) And ($da >= (120 - $orb))) {
        $q = 120;
      } elseif (($da <= (150 + $orb)) And ($da >= (150 - $orb))) {
        $q = 150;
      } elseif ($da >= (180 - $orb)) {
        $q = 180;
      }

      if ($q > 0) {

        $aspects[$i][$j] = $q;

      }
    }
  }
  return $aspects;
}

function drawAspects2 (&$draw, $Ascendant) {
  global
    $BLUE, $RED, $GREEN, $LIGHT_BROWN,
    $PLANETS,
    $RAD_WHEEL,
    $RAD_WHEEL_INNER,
    $CENTER_PT,
    $ASPECTS,
    $last_planet_num
  ;
  // 惑星の配列をコピーし （※代入でディープコピー）
  //  キーの昇順にソート
  $planets = $PLANETS;
  ksort ($planets);

  foreach ($ASPECTS as $idxi => $another) {
    foreach ($another as $idxj => $qval) {

      if ($qval == 60 Or $qval == 90 Or $qval == 120 Or $qval == 180) {

        $angle1 = deg2rad ($planets[$idxi]["angle"] - $Ascendant);
        $angle2 = deg2rad ($planets[$idxj]["angle"] - $Ascendant);

        $x1 = (-$RAD_WHEEL_INNER) * cos($angle1);
        $y1 = ($RAD_WHEEL_INNER) * sin($angle1);
        $x2 = (-$RAD_WHEEL_INNER) * cos($angle2);
        $y2 = ($RAD_WHEEL_INNER) * sin($angle2);

  // echo "aspect  i=[$idxi] j=[$idxj] angle1=[$angle1]  angle2=[$angle2] q=[$qval] <br/>\n";

        if ($qval == 1 Or $qval == 30 Or $qval == 60 Or $qval == 120) {
          $draw->setStrokeColor($BLUE);
        } elseif ($qval == 90 Or $qval == 180) {
          $draw->setStrokeColor($RED);
        }
        $draw->line ($x1 + $CENTER_PT, $y1 + $CENTER_PT, $x2 + $CENTER_PT, $y2 + $CENTER_PT);
      }
    }
  }
}

function drawAspects( &$draw, $Ascendant) {

  global
    $BLUE, $RED, $GREEN, $LIGHT_BROWN,

    $PLANETS,
    $RAD_WHEEL,
    $RAD_WHEEL_INNER,
    $CENTER_PT,

    $last_planet_num
  ;

  // 惑星の配列をコピーし、 (※代入でディープコピー)
  //   キーの昇順にソート
  $planets = $PLANETS;
  ksort ($planets);

  for ($i = 0; $i <= 8; $i++) {

    //   echo "____i=[$i] angle=[".$PLANETS[$i]["angleGlyph"]."] <br/>\n";
    for ($j = $i + 1; $j <= 9; $j++) {

      $q = 0;
      $da = Abs($planets[$i]["angle"] - $planets[$j]["angle"]);

      if ($da > 180)
      {
        $da = 360 - $da;
      }

      // set orb - 8 if Sun or Moon, 6 if not Sun or Moon
      if ($i == 0 Or $i == 1 Or $j == 0 Or $j == 1)
      {
        $orb = 8;
      }
      else
      {
        $orb = 6;
      }

      // is there an aspect within orb?
      if ($da <= $orb)
      {
        $q = 1;
      }
      elseif (($da <= (60 + $orb)) And ($da >= (60 - $orb)))
      {
        $q = 60;
      }
      elseif (($da <= (90 + $orb)) And ($da >= (90 - $orb)))
      {
        $q = 90;
      }
      elseif (($da <= (120 + $orb)) And ($da >= (120 - $orb)))
      {
        $q = 120;
      }
      // elseif (($da <= (150 + $orb)) And ($da >= (150 - $orb)))
      // {
      //   $q = 5;
      // }
      elseif ($da >= (180 - $orb))
      {
        $q = 180;
      }

      if ($q > 0)
      {
        if ($q == 1 Or $q == 30 Or $q == 60)
        {
          $aspect_color = $BLUE;
        }
        elseif ($q == 90 Or $q == 180)
        {
          $aspect_color = $RED;
        }
        // elseif ($q == 5)
        // {
        //   $aspect_color = $BLUE;
        // }

        if ($q != 1)
        {
// echo "________i=[$i] j=[$j] angle1=[".$planets[$i]['angleGlyph'] ."] angle2=[". $planets[$j]['angleGlyph']." ] da=[$da]<br/>\n";
// echo "aspect  i=[$i] j=[$j] angle=[$da] q=[$q] <br/>\n";

          $angle1 = deg2rad($planets[$i]["angle"] - $Ascendant);
          $angle2 = deg2rad($planets[$j]["angle"] - $Ascendant);

          $x1 = (-$RAD_WHEEL_INNER) * cos($angle1);
          $y1 = ($RAD_WHEEL_INNER) * sin($angle1);
          $x2 = (-$RAD_WHEEL_INNER) * cos($angle2);
          $y2 = ($RAD_WHEEL_INNER) * sin($angle2);

          //   imageline($IM, $x1 + $CENTER_PT, $y1 + $CENTER_PT, $x2 + $CENTER_PT, $y2 + $CENTER_PT, $aspect_color);
          $draw->setStrokeColor( new ImagickPixel($aspect_color) );          
          $draw->line( $x1 + $CENTER_PT, $y1 + $CENTER_PT, $x2 + $CENTER_PT, $y2 + $CENTER_PT);
        }
      }    
    }
  }
}

/*
*  drawAspectLines 
*    アスペクトを描画する
*
*   @param $last_planet_num --- 最後の惑星番号 (固定で13？)
*   @param $Ascendant -- アセンダント
*   @param $sort_pos  -- ソート位置 (はて？)
*/
function drawAspectLines( &$draw, $last_planet_num, $Ascendant, &$sort_pos) {
  
  global 
    $IM, 
    $RADIUS,  
    $BLUE, $RED, $GREEN, $LIGHT_BROWN, 
    $planet_angle,

    $longitude,
    $RAD_WHEEL,
    $RAD_WHEEL_INNER,
    $CENTER_PT,

    $PLANETS,

    $inner_diameter_offset // 円周と内円のオフセット
;

  // draw in the aspect lines
  for ($i = 0; $i <= $last_planet_num - 1; $i++)
  {

      // echo "____i=[$i] sort_pos[i]= [ $sort_pos[$i]] angle=[".$planet_angle[$sort_pos[$i]]."] <br/>\n";

    for ($j = $i + 1; $j <= $last_planet_num; $j++)
    {
      $q = 0;
      $da = Abs($longitude[$sort_pos[$i]] - $longitude[$sort_pos[$j]]);


      if ($da > 180)
      {
        $da = 360 - $da;
      }

      // set orb - 8 if Sun or Moon, 6 if not Sun or Moon
      if ($sort_pos[$i] == 0 Or $sort_pos[$i] == 1 Or $sort_pos[$j] == 0 Or $sort_pos[$j] == 1)
      {
        $orb = 8;
      }
      else
      {
        $orb = 6;
      }

      // is there an aspect within orb?
      if ($da <= $orb)
      {
        $q = 1;
      }
      elseif (($da <= (60 + $orb)) And ($da >= (60 - $orb)))
      {
        $q = 60;
      }
      elseif (($da <= (90 + $orb)) And ($da >= (90 - $orb)))
      {
        $q = 90;
      }
      elseif (($da <= (120 + $orb)) And ($da >= (120 - $orb)))
      {
        $q = 120;
      }
      // elseif (($da <= (150 + $orb)) And ($da >= (150 - $orb)))
      // {
      //   $q = 150;
      // }
      elseif ($da >= (180 - $orb))
      {
        $q = 180;
      }

      if ($q > 0)
      {
        if ($q == 1 Or $q == 30 Or $q == 60)
        {
          // $aspect_color = $GREEN;
          $aspect_color = $BLUE;
        }
        elseif ($q == 90 Or $q == 180)
        {
          $aspect_color = $RED;
        }
        // elseif ($q == 5)
        // {
        //   $aspect_color = $BLUE;
        // }

        if ($q != 1)
        {
// echo "________i=[$sort_pos[$i]] j=[$sort_pos[$j]] angle1=[".$planet_angle[$sort_pos[$i]] ."] angle2=[". $planet_angle[$sort_pos[$j]]." ] da=[$da]<br/>\n";
          //non-conjunctions
          // $x1 = (-$RAD_WHEEL + $inner_diameter_offset) * cos(deg2rad($planet_angle[$sort_pos[$i]] - $Ascendant));
          // $y1 = ($RAD_WHEEL - $inner_diameter_offset) * sin(deg2rad($planet_angle[$sort_pos[$i]] - $Ascendant));
          // $x2 = (-$RAD_WHEEL + $inner_diameter_offset) * cos(deg2rad($planet_angle[$sort_pos[$j]] - $Ascendant));
          // $y2 = ($RAD_WHEEL - $inner_diameter_offset) * sin(deg2rad($planet_angle[$sort_pos[$j]] - $Ascendant));

          $x1 = (-$RAD_WHEEL_INNER) * cos(deg2rad($planet_angle[$sort_pos[$i]] - $Ascendant));
          $y1 = ($RAD_WHEEL_INNER) * sin(deg2rad($planet_angle[$sort_pos[$i]] - $Ascendant));
          $x2 = (-$RAD_WHEEL_INNER) * cos(deg2rad($planet_angle[$sort_pos[$j]] - $Ascendant));
          $y2 = ($RAD_WHEEL_INNER) * sin(deg2rad($planet_angle[$sort_pos[$j]] - $Ascendant));
          //   imageline($IM, $x1 + $CENTER_PT, $y1 + $CENTER_PT, $x2 + $CENTER_PT, $y2 + $CENTER_PT, $aspect_color);
          $draw->setStrokeColor( $aspect_color );
          $draw->line( $x1 + $CENTER_PT, $y1 + $CENTER_PT, $x2 + $CENTER_PT, $y2 + $CENTER_PT);
        }
      }
    }
  }
} 


Function Sort_planets_by_descending_longitude($num_planets, $longitude, &$sort, &$sort_pos)
{
// load all $longitude() into sort() and keep track of the planet numbers in $sort_pos()
  for ($i = 0; $i <= $num_planets - 1; $i++)
  {
    $sort[$i] = $longitude[$i];
    $sort_pos[$i] = $i;
  }

// do the actual sort
  for ($i = 0; $i <= $num_planets - 2; $i++)
  {
    for ($j = $i + 1; $j <= $num_planets - 1; $j++)
    {
      if ($sort[$j] > $sort[$i])
      {
        $temp = $sort[$i];
        $temp1 = $sort_pos[$i];

        $sort[$i] = $sort[$j];
        $sort_pos[$i] = $sort_pos[$j];

        $sort[$j] = $temp;
        $sort_pos[$j] = $temp1;
      }
    }
  }
}


Function Count_planets_in_each_house($num_planets, $sort, $sort_pos, &$nopih, &$spot_filled)
{
// count the number of planets in each house
// unset any variables not initialized elsewhere in the program
// reset the number of planets in each house
// make $spot_filled times 15 (instead of 12) just to be sure (to cover overflow)
  unset($spot_filled);

  for ($i = 1; $i <= 12; $i++)
  {
    $nopih[$i] = 0;
  }

// run through all the planets and see how many planets are in each house
  for ($i = 0; $i <= $num_planets - 1; $i++)
  {
    // get sign planet is in, since the sign and the house are the same
    $p_num = $sort_pos[$i];
    $temp = floor($sort[$p_num] / 30) + 1;
    $nopih[$temp]++;
  }
}

function hogehogefunc(&$draw, $num_planets, $Ascendant) {

    global $PLANETS,
        $RAD_WHEEL,
        $CENTER_PT,
        $GREY,
        $PLANET_GLYPHS
    ;

    // add planet glyph around circl
    $flag = false;
    $house_num = 0;
    for ($i = $num_planets - 1; $i >= 0; $i--) {
        // $sort() holds longitudes in descending order from 360 down to 0
        // $sort_pos() holds the planet number corresponding to that longitude
        $temp = $house_num;
        $house_num = floor($sort[$i] / 30) + 1;              // get house (sign) planet is in        
    }

    foreach ($PLANETS as $idx => $planet) {

        // 小惑星などはスルー
        if ($idx > ($num_planets-1)) {
            continue;
        }

        $angle_to_use = deg2rad($planet["angle"] - $Ascendant);

        $pt = array("x"=>0, "y"=>0);
        display_planet_glyph( $angle_to_use, $RAD_WHEEL - 50 , $pt);

// echo " to print the planet No.$idx at angle $angle_to_use. was Originally [$angle] Ascendant=[$Ascendant]<br/>\n";

// @TODO
// echo " to print the planet No.$idx angle= ".($angle-$Ascendant)." at x= $pt[0] and y= $pt[1] <br/>\n";
        // $draw->setStrokeColor();
        $draw->setFillColor( new ImagickPixel( $GREY));        
        $draw->annotation($CENTER_PT + $pt[0], $CENTER_PT + $pt[1], chr($PLANET_GLYPHS["Hamburg"][$idx]));
    }
}

function calcPlanetSpot(&$draw, $Ascendant) {
    global
        $HOUSE_CUSP,
        $PLANETS,
        $max_num_pl_in_each_house, $deg_in_each_house,
        $retrograde,

        $RAD_WHEEL,
        $dist_from_diameter1,
        $dist_from_diameter1a,        
        $CENTER_PT,
        $PLANET_GLYPHS
    ;

    $num_planets = count($PLANETS);
    $spots = array();

    // echo "    mogemoge!! num_planets=[$num_planets]<br/>\n";
    // echo "    mogemoge!! <br/><br/>\n";

    foreach ($PLANETS as $idx => $planet) {

        $from_cusp = Reduce_below_30($planet["angle"]);

        // @TODO 360-0度 付近のことを書く

        // 惑星の位置(角度)をハウスを６分割したスポットのいずれかに当てはめていく
        $indexy = floor($from_cusp * $max_num_pl_in_each_house / $deg_in_each_house);

        // 円盤グローバルのスポット(位置)
        //   ハウスごとのスポット数(6) × 惑星のハウス + 惑星のハウス内におけるスポット
        $chart_idx = ($planet["house"] - 1) * $max_num_pl_in_each_house + $indexy;

        // スポットが空いているか確認する
        //   -> 空いているところが見つかるまで隣へスライド
        while ($spots[$chart_idx] == 1) {
          $chart_idx++;
        }
        // 最終的に、使用するスポットを予約しておく
        $spots[$chart_idx] = 1;

        // $planet_angle[$sort_pos[$i]]
        $planet_angle[$idx] 
            = ($chart_idx * (3 * $deg_in_each_house) / (3 * $max_num_pl_in_each_house)) 
                + ($deg_in_each_house / (2 * $max_num_pl_in_each_house));    // needed for aspect lines

        $angle_spot = deg2rad($planet_angle[$idx] - $Ascendant);
        $angle_real = deg2rad($planet["angle"] - $Ascendant);
        
        // echo "    i=[$idx]. house=[".$planet["house"]."] from=[$from_cusp] indexy=[$indexy] original=[".$planet['angle'] ."] calc=[".$planet_angle[$idx]."] final=[$angle_to_use]<br/>\n";


        // @TODO -- ひとまずここで描画してしまうけど、後で必ず分離すことをね
        $xy = array(0=>0, 1=>0);
        display_planet_glyph( $angle_spot, $RAD_WHEEL - $dist_from_diameter1, $xy);

        // echo "    PT-X=[". $CENTER_PT+$xy[0] ."]  PT-Y=[".$CENTER_PT+$xy[1] ."]  glyph=[". chr($PLANET_GLYPHS['Hamburg'][$idx]) . "]  <br>\n";
        // 惑星の記号を描画 @TODO 描画を分離
        $draw->annotation ($CENTER_PT + $xy[0], $CENTER_PT + $xy[1], chr($PLANET_GLYPHS["basic"][$idx]));

        if (strtoupper(mid($retrograde, $idx + 1, 1)) == 'R') {
          $t = sprintf("%.1f", Reduce_below_30($planet["angle"])) . " r";
        } else {
          $t = sprintf("%.1f", Reduce_below_30($planet["angle"]));
        }

        $x1 = (-$RAD_WHEEL + $dist_from_diameter1a) * cos($angle_spot);
        $y1 = ($RAD_WHEEL - $dist_from_diameter1a) * sin($angle_spot);
        $x2 = (-$RAD_WHEEL + 6) * cos($angle_real);
        $y2 = ($RAD_WHEEL - 6) * sin($angle_real);

        $draw->line ($CENTER_PT+$x1, $CENTER_PT+$y1, $CENTER_PT+$x2, $CENTER_PT+$y2);
    }
    return $planet_angle;
}

/*
*  drawPlanetGlyphs 
*    惑星のサインを描画する
*
*   @param $inner_diameter_offset -- 円周と内円のオフセット
*   @param $last_planet_num --- 最後の惑星番号 (固定で13？)
*   @param $center_pt -- 中心座標
*   @param $Ascendant -- アセンダント
*   @param $sort_pos  -- ソート位置 (はて？)
*/
function drawPlanetGlyphs( $num_planets, &$sort, &$sort_pos, &$nopih, &$spot_filled, $Ascendant ) {

  global 
    $max_num_pl_in_each_house, 
    $deg_in_each_house, 
    // $planet_angle,


    // これは描画時の座標計算に必要となる数値
    $dist_from_diameter1, 
    $dist_from_diameter1a, 
    $dist_from_diameter2, 
    $dist_from_diameter2a,

    // pl_glyph
    // あまり要らないな。消す方向で整理しましょう
    $pl_glyph, 

    $IM, $BLACK, $BLUE, $RED, $GREEN, $RADIUS
    ,

    // 描画時に必要となる円盤の中心座標ですよ
    $CENTER_PT,

    // これはなんだっけか？
    //   -> そうだ、逆行 
    $retrograde
  ;

  // add planet glyphs around circle
  $flag = False;
  $house_num = 0;

  $planet_angle = array();

// echo " max_pl_in_each_house = [$max_num_pl_in_each_house]<br/> \n";
// echo " de_in_each_house = [$deg_in_each_house]<br/> \n";

  for ($i = $num_planets - 1; $i >= 0; $i--)
  {
    // $sort() holds longitudes in descending order from 360 down to 0
    // $sort_pos() holds the planet number corresponding to that longitude
    $temp = $house_num;
    $house_num = floor($sort[$i] / 30) + 1;              // get house (sign) planet is in


    if ($temp != $house_num)
    {
      // this planet is in a different house than the last one - this planet is the first one in this house, in other words
      $planets_done = 1;
    }    
    // get index for this planet as to where it should be in the possible xx different positions around the wheel
    $from_cusp = Reduce_below_30($sort[$i]);
    if (($from_cusp >= 360 - 1 / 36000) And ($from_cusp <= 360 + 1 / 36000))
    {
      $from_cusp = 0;
    }



    $indexy = floor($from_cusp * $max_num_pl_in_each_house / $deg_in_each_house);

// echo "    i=[$i] .  house=[$house_num].  from_cusp=[$from_cusp].. indexy=[$indexy] <br/> \n";

    // adjust the index as needed based on other planets in the same house, etc.
    if ($indexy >= $max_num_pl_in_each_house - $nopih[$house_num])
    {
      if ($max_num_pl_in_each_house - $indexy - $nopih[$house_num] + $planets_done <= 0)
      {
        if ($indexy - $nopih[$house_num] + $planets_done < 0)
        {
          $indexy = $max_num_pl_in_each_house - $nopih[$house_num];
        }
        else
        {
          if ($spot_filled[(($house_num - 1) * $max_num_pl_in_each_house) + $indexy] == 0)
          {
            $indexy = $max_num_pl_in_each_house - $nopih[$house_num] + $planets_done - 1;
          }
          else
          {
            $indexy = $max_num_pl_in_each_house - $nopih[$house_num];
          }
        }
      }

      if ($indexy < 0)
      {
        $indexy = 0;
      }
    }
    // see if this spot around the wheel has already been filled
    while ($spot_filled[(($house_num - 1) * $max_num_pl_in_each_house) + $indexy] == 1)
    {
      // yes, so push the planet up one position
      $indexy++;
    }
// echo "        indexy revised to [$indexy] <br/> \n";
    // mark this position as being filled
    $spot_filled[(($house_num - 1) * $max_num_pl_in_each_house) + $indexy] = 1;

    // set the final index
    $chart_idx = ($house_num - 1) * $max_num_pl_in_each_house + $indexy;

    // take the above index and convert it into an angle
    $planet_angle[$sort_pos[$i]] = ($chart_idx * (3 * $deg_in_each_house) / (3 * $max_num_pl_in_each_house)) + ($deg_in_each_house / (2 * $max_num_pl_in_each_house));    // needed for aspect lines
    // $planet_angle[$sort_pos[$i]] = $sort[$i];

    $angle_to_use = $planet_angle[$sort_pos[$i]] - $Ascendant;         // needed for placing info on chartwheel

//    echo "No.$sort_pos[$i] angle=$angle_to_use <br/>\n";

    // denote that we have done at least one planet in this house (actually count the planets in this house that we have done)
    $planets_done++;

    // display the planet in the wheel
    $angle_to_use = deg2rad($angle_to_use);

    //
    // ここまでで処理は大きく切れている。
    //  要は角度と2つの軌道のどちらかというのを求めているだけ
    //
    if ($flag == False)
    {
      display_planet_glyph($angle_to_use, $RADIUS - $dist_from_diameter1, $xy);
    }
    else
    {
      display_planet_glyph($angle_to_use, $RADIUS - ($dist_from_diameter2), $xy);
    }

// @TODO
//    echo "  so, No.$sort_pos[$i].  angle= ".($planet_angle[$sort_pos[$i]]-$Ascendant). "  at x= $xy[0]  and y= $xy[1] <br/> \n";


    // imagettftext($IM, 16, 0, $xy[0] + $center_pt, $xy[1] + $center_pt, $PLANET_COLOR, 
    //   'HamburgSymbols.ttf', chr($pl_glyph[$sort_pos[$i]]));

    // display degrees of longitude for each planet
    if (strtoupper(mid($retrograde, $sort_pos[$i] + 1, 1)) == "R")
    {
      $t = sprintf("%.1f", Reduce_below_30($sort[$i])) . " r";
    }
    else
    {
      $t = sprintf("%.1f", Reduce_below_30($sort[$i]));
    }
    //draw line from planet to circumference
    if ($flag == False)
    {
      $x1 = (-$RADIUS + $dist_from_diameter1a) * cos($angle_to_use);
      $y1 = ($RADIUS - $dist_from_diameter1a) * sin($angle_to_use);
      $x2 = (-$RADIUS + 6) * cos($angle_to_use);
      $y2 = ($RADIUS - 6) * sin($angle_to_use);
    }
    else
    {
      $x1 = (-$RADIUS + $dist_from_diameter2a) * cos($angle_to_use);
      $y1 = ($RADIUS - $dist_from_diameter2a) * sin($angle_to_use);
      $x2 = (-$RADIUS + 6) * cos($angle_to_use);
      $y2 = ($RADIUS - 6) * sin($angle_to_use);
    }

    // imageline($IM, $x1 + $center_pt, $y1 + $center_pt, $x2 + $center_pt, $y2 + $center_pt, $BLACK);

    $flag = !$flag;
  }
} // ここまでFor ループ < num_planets


function drawPlanetTable( &$draw ) {
  global
    $last_planet_num,
    $num_planets,
    $longitude,
    $PLANETS,
    $PLANET_GLYPHS,
    $SIGN_GLYPHS,
    $ASPECTS,
    $ASPECT_GLYPH,
    $HOUSE_CUSP,

    $GREY,
    $LINE_COLOR,
    $LINE_COLOR_SECOND,
    $LINE_COLOR_3RD,
    $SIGN_COLOR
  ;

  $cell_width = 40;
  $cell_height = 40;
  $padding_x = 12;
  $padding_y = -6;  
  $cell_offset_x = 12;
  $cell_offset_y = -15;
  $margins = 0;

  $left_margin_planet_table = ($num_planets + 0.5) * $cell_width;  
  $left_margin_planet_table = 10;
  
// draw in the planet glyphs
  for ($i = 0; $i <= $last_planet_num; $i++)
  {
    $ypos = $cell_height * ($i + 1);
    $stdx = $margins + $left_margin_planet_table; 

    // $draw->setStrokeDashArray([5,3,2]);
    $draw->setStrokeColor($LINE_COLOR_3RD);
    $draw->setStrokeWidth(2);
    $draw->line(
      $stdx, $ypos, 
      $stdx + $cell_width * 10.2, $ypos
    );

    $draw->line(
      $stdx + $cell_width * 11, $ypos, 
      $stdx + $cell_width * 20, $ypos
    );

    $draw->setStrokeDashArray(null);
    $draw->setStrokeColor($SIGN_COLOR);
    $draw->setStrokeWidth(1);

    // 表に惑星の記号を描画
    $draw->setFontSize(16);
    $draw->setFontSize(32);
    $draw->setFont( $PLANET_GLYPHS["basic"]["font"]);
    // $draw->setFont( "arial.ttf" );
    $draw->annotation( 
      // $margins + $cell_offset_x + $left_margin_planet_table,  // 横位置
      $stdx + $padding_x, 
      $ypos + $padding_y,               // 縦位置　  
      chr($PLANET_GLYPHS["basic"][$i])                        // 文字列
      // $PLANET_GLYPHS["standard"][$i]
    );

    // 表に惑星の名前を描画
    $draw->setFontSize(10);        
    $draw->setFontSize(20);        
    // $draw->setFont(__DIR__."/font/arial.ttf");
    $draw->setFont(__DIR__."/font/rounded-mgenplus-2c-light.ttf");
    $draw->annotation( 
      // $margins + $cell_offset_x + $left_margin_planet_table + $cell_width * 1,  // 横位置
      $stdx + $padding_x + $cell_width * 1,
      $ypos + $padding_y - 0,                             // 縦位置
      $PLANETS[$i]["name"]                                                      // 文字列
    );

    $sign_num = floor($PLANETS[$i]["angle"] / 30) + 1;
    
    // 表に12宮のサインを描画
    // $draw->setFont(__DIR__."/HamburgSymbols.ttf");
    $draw->setFont($SIGN_GLYPHS["zodiacs"]["font"]);    
    // $draw->setFont($SIGN_GLYPHS["Hamburg"]["font"]);    
    // $draw->setFont($SIGN_GLYPHS["SL"]["font"]);    
    $draw->setFontSize(24);        
    $draw->annotation( 
      // $margins + $cell_offset_x + $left_margin_planet_table + $cell_width * 3,   // 横位置
      $stdx + $padding_x + $cell_width * 5, 
      $ypos + $padding_y,                                  // 縦位置
      // $SIGN_GLYPHS["Hamburg"][$sign_num]                                         // 文字列
      $SIGN_GLYPHS["zodiacs"][$sign_num]                                         // 文字列
    );

    // $draw->setFont("arial.ttf");    
    $draw->setFont(__DIR__."/font/rounded-mgenplus-2c-light.ttf");    
    $draw->setFontSize(20);    
    $draw->annotation( 
      // $margins + $cell_offset_x + $left_margin_planet_table + $cell_width * 4,
      $stdx + $padding_x + $cell_width * 6, 
      $ypos + $padding_y - 3, 
      Convert_Longitude($PLANETS[$i]["angle"])
    );
  }

  // ハウスの一覧表を描画
  foreach ($HOUSE_CUSP as $idx => $cusp) {

    $houseLabel = "";

    if ($idx == 1) {
      $houseLabel = "アセンダント";
    } elseif ($idx == 10) {
      $houseLabel = "    MC      ";
    } else {
      $houseLabel = sprintf("%2d", $idx) ;
      $houseLabel .= "ハウス";
    }
    $houseLabel .= "     ".Convert_Longitude($cusp["angle"]);    

    $draw->annotation(
      // $margins + $cell_offset_x + $left_margin_planet_table + $cell_width * 10,
      $stdx + $padding_x + $cell_width * 11,
      $padding_y + $cell_height * ($idx) - 3,
      $houseLabel
    );
  } 
}

Function display_planet_glyph($angle_to_use, $radii, &$xy)
{
  $cw_pl_glyph = 16;
  $ch_pl_glyph = 16;
  $gap_pl_glyph = -10;

// take into account the width and height of the glyph, defined below
// get distance we need to shift the glyph so that the absolute middle of the glyph is the start point
  $center_pos_x = -$cw_pl_glyph / 2;
  $center_pos_y = $ch_pl_glyph / 2;

// get the offset we have to move the center point to in order to be properly placed
  $offset_pos_x = $center_pos_x * cos($angle_to_use);
  $offset_pos_y = $center_pos_y * sin($angle_to_use);

// now get the final X, Y coordinates
  $xy[0] = $center_pos_x + $offset_pos_x + ((-$radii + $gap_pl_glyph) * cos($angle_to_use));
  $xy[1] = $center_pos_y + $offset_pos_y + (($radii - $gap_pl_glyph) * sin($angle_to_use));

  return ($xy);
}

Function Convert_Longitude($longitude)
{
  $signs = array (0 => '牡羊座', '牡牛座', '双子座', '蟹座', '獅子座', '乙女座', '天秤座', '蠍  座', '射手座', '山羊座', '水瓶座', '魚座');

  $sign_num = floor($longitude / 30);
  $pos_in_sign = $longitude - ($sign_num * 30);
  $deg = floor($pos_in_sign);
  $full_min = ($pos_in_sign - $deg) * 60;
  $min = floor($full_min);
  $full_sec = round(($full_min - $min) * 60);

  if ($deg < 10)
  {
    $deg = "0" . $deg;
  }

  if ($min < 10)
  {
    $min = "0" . $min;
  }

  if ($full_sec < 10)
  {
    $full_sec = "0" . $full_sec;
  }

  // return $deg . " " . $signs[$sign_num] . " " . $min . "' " . $full_sec . chr(34);
  return $signs[$sign_num] . " " . $deg . "° " . $min . "' " . $full_sec . chr(34);
}


Function Reduce_below_30($longitude)
{
  $lng = $longitude;

  while ($lng >= 30)
  {
    $lng = $lng - 30;
  }

  return $lng;
}
Function mid($midstring, $midstart, $midlength)
{
  return(substr($midstring, $midstart-1, $midlength));
}


?>