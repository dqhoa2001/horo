<?php
  $months = array (0 => 'Choose month', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
  $my_error = "";

  // check if the form has been submitted
  if (isset($_POST['submitted']) Or isset($_POST['h_sys_submitted']))
  {
    // get all variables from form
    $h_sys = "";
    if (isset($_POST["h_sys"])) {
      $h_sys = safeEscapeString($_POST["h_sys"]);  
    }
    
    $name = safeEscapeString($_POST["name"]);

    // 生年月日
    // $birthday = safeEscapeString($_POST["birthday"]);

    // $month = safeEscapeString($_POST["month"]);
    // $day = safeEscapeString($_POST["day"]);
    // $year = safeEscapeString($_POST["year"]);

    // @MOD 2016/12/19 生年月日フィールドの分割対応
    $month = safeEscapeString($_POST["birthmonth"]);
    $day = safeEscapeString($_POST["birthday"]);
    $year = safeEscapeString($_POST["birthyear"]);

    // 時刻
    // $birthtime = safeEscapeString($_POST["birthtime"]);

    // $hour = explode( ":", $birthtime)[0];
    // $minute = explode( ":", $birthtime)[1]; // safeEscapeString($_POST["minute"]);

    $hour = safeEscapeString($_POST["birthhour"]);
    $minute = safeEscapeString($_POST["birthminute"]);

// echo "birthday is this !! $birthday <br/>\n";
// echo "and year is this !! $year <br/>\n";
// echo "and month is this !! $month <br/>\n";
// echo "and day is this !! $day <br/>\n";
// echo '<font size="2"><b>Born ' . strftime("%A, %B %d, %Y<br>%X (time zone = GMT $tz hours)</b></font><br />\n", mktime($hour, $minute, $secs, $month, $day, $year));

    // タイムゾーン
    $timezone = safeEscapeString($_POST["timezone"]);
// echo "  and time zone is this $timezone <br/>\n";

    // 経度
    $lng = safeEscapeString($_POST['lng']);
    $tmplng = explode(".", $lng);
    if ($tmplng != false) {
        $long_deg = $tmplng[0];
        $long_min = $tmplng[1];
    }
    if (intval($long_deg) < 0) {
      $ew = -1;
      $long_deg = abs($long_deg);
    } else {
      $ew = 1;
    }

    if ($long_min) {
      $long_min = intval(substr($long_min, 0,2) / 100 * 60);
    }

// echo "  and longitude is this $long_deg . ew = $ew.  min= $long_min<br/>\n";
    // 緯度
    $lat = safeEscapeString($_POST['lat']);
    $tmplat = explode(".", $lat);
    if ($tmplat != false) {
        $lat_deg = $tmplat[0];
        $lat_min = $tmplat[1];
    }
    if (intval($lat_deg) < 0) { 
      $ns = -1;
      $lat_deg = abs($lat_deg);
    } else {
      $ns = 1;
    }

    if ($lat_min) {
      $lat_min = intval(substr($lat_min, 0, 2) / 100 * 60);
    }

    // 地名
    $birthplace = safeEscapeString($_POST['birthplace']);

    // デザインモード
    $useBg = safeEscapeString($_POST['designMode']);

    // set cookie containing natal data here
    setcookie ('name', stripslashes($name), time() + 60 * 60 * 24 * 30, '/', '', 0);
    setcookie ('timezone', $timezone, time() + 60 * 60 * 24 * 30, '/', '', 0);

    setcookie ('long_deg', $long_deg, time() + 60 * 60 * 24 * 30, '/', '', 0);
    setcookie ('long_min', $long_min, time() + 60 * 60 * 24 * 30, '/', '', 0);
    setcookie ('ew', $ew, time() + 60 * 60 * 24 * 30, '/', '', 0);

    setcookie ('lat_deg', $lat_deg, time() + 60 * 60 * 24 * 30, '/', '', 0);
    setcookie ('lat_min', $lat_min, time() + 60 * 60 * 24 * 30, '/', '', 0);
    setcookie ('ns', $ns, time() + 60 * 60 * 24 * 30, '/', '', 0);

    setcookie ('birthplace', $birthplace, time() + 60 * 60 * 24 * 30, '/', '', 0);

    // include ('header_natal.html');				//here because of setting cookies above
    include('header.php');
    include("validation_class.php");

    //error check
    $my_form = new Validate_fields;

    $my_form->check_4html = true;

    $my_form->add_text_field("Name", $name, "text", "y", 40);

    $my_form->add_text_field("Month", $month, "text", "y", 2);
    $my_form->add_text_field("Day", $day, "text", "y", 2);
    $my_form->add_text_field("Year", $year, "text", "y", 4);

    $my_form->add_text_field("Hour", $hour, "text", "y", 2);
    $my_form->add_text_field("Minute", $minute, "text", "y", 2);

    $my_form->add_text_field("Time zone", $timezone, "text", "y", 4);

    $my_form->add_text_field("Longitude degree", $long_deg, "text", "y", 3);
    $my_form->add_text_field("Longitude minute", $long_min, "text", "y", 2);
    $my_form->add_text_field("Longitude E/W", $ew, "text", "y", 2);

    $my_form->add_text_field("Latitude degree", $lat_deg, "text", "y", 2);
    $my_form->add_text_field("Latitude minute", $lat_min, "text", "y", 2);
    $my_form->add_text_field("Latitude N/S", $ns, "text", "y", 2);

    // additional error checks on user-entered data
    if ($month == 0)
    {
      $my_error .= "生まれた月を入力してください.<br>";
    }

    if ($month != "" And $day != "" And $year != "")
    {
      if (!$date = checkdate(settype ($month, "integer"), settype ($day, "integer"), settype ($year, "integer")))
      {
        $my_error .= "誕生日の入力を確認してください。数字で入力していますか？<br>";
      }
    }

    if (($year < 1900) Or ($year >= 2100))
    {
      $my_error .= "生まれた年は1900年 から 2099年の間を指定してください<br>";
    }

    if (($hour < 0) Or ($hour > 23))
    {
      $my_error .= "生まれた時刻は 0 から 23 の間で指定してください<br>";
    }

    if (($minute < 0) Or ($minute > 59))
    {
      $my_error .= "生まれた時刻の「分」は 0 から 59 の間で指定してください<br>";
    }

    if (($long_deg < 0) Or ($long_deg > 179))
    {
      $my_error .= "経度は0 から 179の間で指定してください.<br>";
    }

    if (($long_min < 0) Or ($long_min > 59))
    {
      $my_error .= "Longitude minutes must be between 0 and 59.<br>";
    }

    if (($lat_deg < 0) Or ($lat_deg > 65))
    {
      $my_error .= "緯度は 0 から 65 の間で指定してください<br>";
    }

    if (($lat_min < 0) Or ($lat_min > 59))
    {
      $my_error .= "Latitude minutes must be between 0 and 59.<br>";
    }

    if (($ew == '-1') And ($timezone > 2))
    {
      $my_error .= "You have marked West longitude but set an east time zone.<br>";
    }

    if (($ew == '1') And ($timezone < 0))
    {
      $my_error .= "You have marked East longitude but set a west time zone.<br>";
    }

    if ($ew < 0)
    {
      $ew_txt = "w";
    }
    else
    {
      $ew_txt = "e";
    }

    if ($ns > 0)
    {
      $ns_txt = "n";
    }
    else
    {
      $ns_txt = "s";
    }

    // $validation_error = $my_form->validation();
    $validation_error = true;

    if ((!$validation_error) || ($my_error != ""))
    {
      $error = $my_form->create_msg();
      echo "<TABLE align='center' WIDTH='98%' BORDER='0' CELLSPACING='15' CELLPADDING='0'><tr><td><center><b>";
      echo "<font color='#ff0000' size=+2>入力エラーです。  お手数ですが前のページへ戻って、入力内容をご確認ください。</font><br>";

      if ($error)
      {
        echo $error . $my_error;
      }
      else
      {
        echo $error . "<br>" . $my_error;
      }

      echo "</font>";
      echo "<font color='#c020c0'";
      echo "<br>PLEASE RE-ENTER YOUR TIME ZONE DATA. THANK YOU.<br><br>";
      echo "</font>";
      echo "</b></center></td></tr></table>";
    }
    else
    {
      // no errors in filling out form, so process form
      // calculate astronomic data
      $swephsrc = __DIR__."/sweph";
      $sweph = "sweph";

      // Unset any variables not initialized elsewhere in the program
      unset($PATH,$out,$pl_name,$longitude1,$house_pos);

      //assign data from database to local variables
      $inmonth = $month;
      $inday = $day;
      $inyear = $year;

      $inhours = $hour;
      $inmins = $minute;
      $insecs = "0";

      $intz = $timezone;

      $my_longitude = $ew * ($long_deg + ($long_min / 60));
      $my_latitude = $ns * ($lat_deg + ($lat_min / 60));

      if ($intz >= 0)
      {
        $whole = floor($intz);
        $fraction = $intz - floor($intz);
      }
      else
      {
        $whole = ceil($intz);
        $fraction = $intz - ceil($intz);
      }

      $inhours = $inhours - $whole;
      $inmins = $inmins - ($fraction * 60);

      // adjust date and time for minus hour due to time zone taking the hour negative
      $utdatenow = strftime("%d.%m.%Y", mktime($inhours, $inmins, $insecs, $inmonth, $inday, $inyear));
      $utnow = strftime("%H:%M:%S", mktime($inhours, $inmins, $insecs, $inmonth, $inday, $inyear));

      $PATH = "";

      putenv("PATH=$PATH:$swephsrc");

      // get LAST_PLANET planets and all house cusps
      if (strlen($h_sys) != 1)
      {
        $h_sys = "p";
      }
// error_log("utdatenow = " . $utdatenow." ::: utnow".$utnow. "");
// error_log(__DIR__."/swetest -edir\"".__DIR__."/$sweph\" -b$utdatenow -ut$utnow -p0123456789DAttt -eswe -house$my_longitude,$my_latitude,$h_sys -flsj -g, -head");
      // exec (__DIR__."/swetest -edir\"".__DIR__."/$sweph\" -b$utdatenow -ut$utnow -p0123456789DAttt -eswe -house$my_longitude,$my_latitude,$h_sys -flsj -g, -head", $out);
      exec (__DIR__."/swetest64 -edir\"".__DIR__."/$sweph\" -b$utdatenow -ut$utnow -p0123456789tDAtt -eswe -house$my_longitude,$my_latitude,$h_sys -flsj -g, -head", $out);


      // Each line of output data from swetest is exploded into array $row, giving these elements:
      // 0 = longitude
      // 1 = speed
      // 2 = house position
      // planets are index 0 - index (LAST_PLANET), house cusps are index (LAST_PLANET + 1) - (LAST_PLANET + 12)
      foreach ($out as $key => $line)
      {

// error_log( $key."=[".$line."]" );

        $row = explode(',',$line);
        $longitude1[$key] = trim($row[0]);
        $speed1[$key] = trim($row[1]);
        
        
        $house_pos1[$key] ="";
        if (isset($row[2])) {
          $house_pos1[$key] = $row[2];
        }
      };


      include("constants.php");			// this is here because we must rename the planet names


      //calculate the Part of Fortune
      //is this a day chart or a night chart?
      if ($longitude1[LAST_PLANET + 1] > $longitude1[LAST_PLANET + 7])
      {
        if ($longitude1[0] <= $longitude1[LAST_PLANET + 1] And $longitude1[0] > $longitude1[LAST_PLANET + 7])
        {
          $day_chart = True;
        }
        else
        {
          $day_chart = False;
        }
      }
      else
      {
        if ($longitude1[0] > $longitude1[LAST_PLANET + 1] And $longitude1[0] <= $longitude1[LAST_PLANET + 7])
        {
          $day_chart = False;
        }
        else
        {
          $day_chart = True;
        }
      }

      if ($day_chart == True)
      {
        $longitude1[SE_POF] = $longitude1[LAST_PLANET + 1] + $longitude1[1] - $longitude1[0];
      }
      else
      {
        $longitude1[SE_POF] = $longitude1[LAST_PLANET + 1] - $longitude1[1] + $longitude1[0];
      }

      if ($longitude1[SE_POF] >= 360)
      {
        $longitude1[SE_POF] = $longitude1[SE_POF] - 360;
      }

      if ($longitude1[SE_POF] < 0)
      {
        $longitude1[SE_POF] = $longitude1[SE_POF] + 360;
      }

//add a planet - maybe some code needs to be put here

      //capture the Vertex longitude
      $longitude1[LAST_PLANET] = $longitude1[LAST_PLANET + 16];		//Asc = +13, MC = +14, RAMC = +15, Vertex = +16


//get house positions of planets here
      for ($x = 1; $x <= 12; $x++)
      {
        for ($y = 0; $y <= LAST_PLANET; $y++)
        {
          $pl = $longitude1[$y] + (1 / 36000);
          if ($x < 12 And $longitude1[$x + LAST_PLANET] > $longitude1[$x + LAST_PLANET + 1])
          {
            If (($pl >= $longitude1[$x + LAST_PLANET] And $pl < 360) Or ($pl < $longitude1[$x + LAST_PLANET + 1] And $pl >= 0))
            {
              $house_pos1[$y] = $x;
              continue;
            }
          }

          if ($x == 12 And ($longitude1[$x + LAST_PLANET] > $longitude1[LAST_PLANET + 1]))
          {
            if (($pl >= $longitude1[$x + LAST_PLANET] And $pl < 360) Or ($pl < $longitude1[LAST_PLANET + 1] And $pl >= 0))
            {
              $house_pos1[$y] = $x;
            }
            continue;
          }

          if (($pl >= $longitude1[$x + LAST_PLANET]) And ($pl < $longitude1[$x + LAST_PLANET + 1]) And ($x < 12))
          {
            $house_pos1[$y] = $x;
            continue;
          }

          if (($pl >= $longitude1[$x + LAST_PLANET]) And ($pl < $longitude1[LAST_PLANET + 1]) And ($x == 12))
          {
            $house_pos1[$y] = $x;
          }
        }
      }

      $restored_name = stripslashes($name);

      $secs = "0";
      if ($timezone < 0)
      {
        $tz = $timezone;
      }
      else
      {
        $tz = "+" . $timezone;
      }
?>
	<div class="border_point">
		<img src="../../themes/hosinomai/img/common/points01.svg" alt="">
	</div>
	<div class="page_title title_black">
		<h2>
			<?php echo $restored_name;?> さんの出生図
			<span>natal chart</span>
		</h2>
	</div>
	<p class="title_caption">
    <?php
      if ($ew == 1) {
        $strew = "東経";
      } else {
        $strew = "西経";
      }
      if ($ns == 1) {
        $strns = "北緯";
      } else {
        $strns = "南緯";
      }
    ?>
		<?php echo "$year 年$month 月$day 日 $hour 時 $minute 分 "; ?> のホロスコープ <br/>
		生まれた日時と場所から求めた、その時の星の配置図です <br/>    
    <?php echo "出生地 : $birthplace "; ?> <br/>
    <?php echo "$strew : $long_deg 度 $long_min 分"; ?> <br/>
    <?php echo "$strns : $lat_deg 度 $lat_min 分"; ?> <br/>

	</p>

	<hr/>

		<!--
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <select name="h_sys" size="1">
          <?php
          echo "<option value='p' ";
          if ($h_sys == "p"){ echo " selected"; }
          echo "> Placidus </option>";

          echo "<option value='k' ";
          if ($h_sys == "k"){ echo " selected"; }
          echo "> Koch </option>";

          echo "<option value='r' ";
          if ($h_sys == "r"){ echo " selected"; }
          echo "> Regiomontanus </option>";

          echo "<option value='c' ";
          if ($h_sys == "c"){ echo " selected"; }
          echo "> Campanus </option>";

          echo "<option value='b' ";
          if ($h_sys == "b"){ echo " selected"; }
          echo "> Alcabitus </option>";

          echo "<option value='o' ";
          if ($h_sys == "o"){ echo " selected"; }
          echo "> Porphyrius </option>";

          echo "<option value='m' ";
          if ($h_sys == "m"){ echo " selected"; }
          echo "> Morinus </option>";

          echo "<option value='a' ";
          if ($h_sys == "a"){ echo " selected"; }
          echo "> Equal house - Asc </option>";

          echo "<option value='t' ";
          if ($h_sys == "t"){ echo " selected"; }
          echo "> Topocentric </option>";

          echo "<option value='v' ";
          if ($h_sys == "v"){ echo " selected"; }
          echo "> Vehlow </option>";
          ?>
        </select>

        <input type="hidden" name="name" value="<?php echo $_POST['name']; ?>">
        <input type="hidden" name="month" value="<?php echo $_POST['month']; ?>">
        <input type="hidden" name="day" value="<?php echo $_POST['day']; ?>">
        <input type="hidden" name="year" value="<?php echo $_POST['year']; ?>">
        <input type="hidden" name="hour" value="<?php echo $_POST['hour']; ?>">
        <input type="hidden" name="minute" value="<?php echo $_POST['minute']; ?>">
        <input type="hidden" name="timezone" value="<?php echo $_POST['timezone']; ?>">
        <input type="hidden" name="long_deg" value="<?php echo $_POST['long_deg']; ?>">
        <input type="hidden" name="long_min" value="<?php echo $_POST['long_min']; ?>">
        <input type="hidden" name="ew" value="<?php echo $_POST['ew']; ?>">
        <input type="hidden" name="lat_deg" value="<?php echo $_POST['lat_deg']; ?>">
        <input type="hidden" name="lat_min" value="<?php echo $_POST['lat_min']; ?>">
        <input type="hidden" name="ns" value="<?php echo $_POST['ns']; ?>">

        <input type="hidden" name="h_sys_submitted" value="TRUE">
        <INPUT type="submit" name="submit" value="Go" align="middle" style="background-color:#66ff66;color:#000000;font-size:16px;font-weight:bold">
      </form>
      -->
<?php
//      echo "</center>";

      $hr_ob = $hour;
      $min_ob = $minute;

      $ubt1 = 0;
      if (($hr_ob == 12) And ($min_ob == 0))
      {
        $ubt1 = 1;				// this person has an unknown birth time
      }

      $ubt2 = $ubt1;

      $rx1 = "";
      for ($i = 0; $i <= SE_TNODE; $i++)
      {
        if ($speed1[$i] < 0)
        {
          $rx1 .= "R";
        }
        else
        {
          $rx1 .= " ";
        }
      }

      $rx2 = $rx1;

      for ($i = 1; $i <= LAST_PLANET; $i++)
      {
        $hc1[$i] = $longitude1[LAST_PLANET + $i];
      }

// no need to urlencode unless perhaps magic quotes is ON (??)
      $ser_L1 = serialize($longitude1);
      $ser_L2 = serialize($longitude1);
      $ser_hc1 = serialize($hc1);

      // $CUR_URL = plugins_url( 'linus.php', __FILE__);

      ?>
      <center>
      	<?php 
      		echo "<img border='0' src='https://lolipop-dp50195346.ssl-lolipop.jp/autrium/wp-content/plugins/orby/chart.php?rx1=$rx1&rx2=$rx2&p1=$ser_L1&p2=$ser_L2&hc1=$ser_hc1&ubt1=$ubt1&ubt2=$ubt2&bg=$useBg' style='max-width:800px;'>";
      	?>
      </center>

      <?php


      include ('footer.php');
      exit();
    }
  }
  else
  {
    // include ('header_natal.html');				//here because of cookies
    // 直接呼び出された場合、WPへリダイレクト
    if (!function_exists('get_template_directory_uri')) {
      header("Location: http://hoshinomai.jp/horoscope");
    }
    $name = stripslashes($_COOKIE['name']);


    $hour = $_COOKIE['hour'];
    $minute = $_COOKIE['minute'];
    $timezone = $_COOKIE['timezone'];
    $birthplace = $_COOKIE['birthplace'];

    $long_deg = $_COOKIE["long_deg"];
    $long_min = $_COOKIE["long_min"];
    $ew = $_COOKIE["ew"];

    $lat_deg = $_COOKIE["lat_deg"];
    $lat_min = $_COOKIE["lat_min"];
    $ns = $_COOKIE["ns"];
  }

?>

<script type="text/javascript">

  jQuery(document).ready(function(){

    // 地図を表示する際のオプションを設定
    var mapOptions = {
      center: new google.maps.LatLng( 36.205, 138.253),
      zoom: 6,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    // 入力フォームにもデフォルトの緯度経度をセット
    // $("#lng1").val(36.205);
    // $("#lat1").val(138.253);

    map = new google.maps.Map(jQuery("#map_canvas")[0], mapOptions);

    // var infoWindow = new google.maps.InfoWindow({map: map});

    // Try HTML5 geolocation.
    if (navigator.geolocation && location.protocol == 'https') {
      navigator.geolocation.getCurrentPosition(function(position) {
        var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };

        // infoWindow.setPosition(pos);
        // infoWindow.setContent('Location found.');
        map.setCenter(pos);
      }, function(err) {
        console.log(err);

        handleLocationError( err, true, infoWindow, map.getCenter());
      });
    } else {
      // Browser doesn't support Geolocation
      // handleLocationError( "", false, infoWindow, map.getCenter());
      // codeAddress('日本');
    }

    map.addListener('center_changed', function() {
      // 入力フォームにマップから緯度経度取得して設定

      console.log( map.getCenter() );
      jQuery("#lat").val( map.getCenter().lat );        
      jQuery("#lng").val( map.getCenter().lng );
    });


    // 地名で検索ボタンのハンドリング
    jQuery(".map-search").on('click', function(){
      console.log( jQuery("#nameOfBirthplace").val() );
      if (jQuery("#nameOfBirthplace").val()) {
        codeAddress(jQuery("#nameOfBirthplace").val());
      }
    });

    // バリデーション
    // jQuery.validator.addMethod( "zendigits", validationMethods["zendigits"]);

    jQuery("#natalform").validate({
    	rules : rules,
    	messages : validMsg
    });

    jQuery('#nameOfBirthplace').keypress(function(e) {
      var code = (e.keyCode ? e.keyCode : e.which);
      if ( (code==13) || (code==10)) {
        jQuery(this).blur();
        jQuery('#btnSearchBirthplace').trigger('click');
        jQuery('#btnSearchBirthplace').focus();        
        return false;
      }
    });
  });

	// バリデーション用追加ルールの定義
	var validationMethods = {
		zendigits: function(value, element){
		  return this.optional(element) || /^([0-9０１２３４５６７８９]+)$/.test(value);
		}
	};
	// フォームバリデーションの定義
	// 入力項目の検証ルール
	var rules = {
		birthyear : { digits : true },
		birthmonth: { digits : true },
		birthday  : { digits : true },
		birthhour : { digits : true },
		birthminute:{ digits : true }
	};
	var msgDigits = "半角の数字を入力してください";
	var validMsg = {
		birthyear : { digits : msgDigits },
		birthmonth : { digits : msgDigits },
		birthday : { digits : msgDigits },
		birthhour : { digits : msgDigits },
		birthminute : { digits : msgDigits }
	};
  function handleLocationError( response, okka, infoW, pos ) {
    console.log("エラーが起きました. response="+response.msg);
  }

  function handleCenterChange(newcenter) {

  }

  function codeAddress(address) {
    var geocoder = new google.maps.Geocoder();
    // geocoder.geocode()メソッドを実行 
    geocoder.geocode( { 'address': address}, function(results, status) {
      
      // ジオコーディングが成功した場合
      if (status == google.maps.GeocoderStatus.OK) {

        // google.maps.Map()コンストラクタに定義されているsetCenter()メソッドで
        // 変換した緯度・経度情報を地図の中心に表示
        map.setCenter(results[0].geometry.location);
        
        jQuery("#lat").val(map.getCenter().lat);      
        jQuery("#lng").val(map.getCenter().lng);

        // 地図上に目印となるマーカーを設定います。
        // google.maps.Marker()コンストラクタにマーカーを設置するMapオブジェクトと
        // 変換した緯度・経度情報を渡してインスタンスを生成
        // →マーカー詳細
        var marker = new google.maps.Marker({
          map: map,
          position: results[0].geometry.location
        });

      // ジオコーディングが成功しなかった場合
      } else {
        console.log('Geocode was not successful for the following reason: ' + status);
      }
    });
  }
  
</script>

<style type="text/css">
	.error {
		color : red;
		font-weight : bold;
	}
</style>

<form id="natalform"  action="<?php echo function_exists('plugins_url') ? plugins_url('natal_form_wheel.php',__FILE__) : 'natal_form_wheel.php'; ?>" method="post" style="margin: 0px 20px;">

  <!-- <?php if (function_exists('get_template_directory_uri')) { ?>
  <div class="border_point">
    <img src="<?php echo get_template_directory_uri(); ?>/img/common/points01.svg" alt="">
  </div>
  <?php } ?> -->



  <div class="page_title title_black">
    <h2>生年月日<span>birthday</span></h2>
  </div>
  <p class="title_caption">
    お名前と出生情報を入力してください<br/>
    (生年月日は西暦で入力してください。例:1980.01.01)
  </p>
  <hr/>
  <section class="birthday form-horizontal pb80">

    <div class="form-group">
      <label for="name" class="col-sm-2 control-label">
        お名前 <span class="required" aria-required="true">*</span>
      </label>
      <div class="col-sm-6">
        <input name="name" type="text" id="name" value="<?php echo $name; ?>"
          class="form-control input-lg" autocomplete="name" required>
      </div>            
    </div>


    <div class="form-group">
      <label for="birthday" class="col-sm-2 control-label">
        生年月日
      </label>
      <div class="col-sm-4">
	    <span class="input-group">
        	<input name="birthyear" value="<?php echo $year; ?>" required type="number"
        		autocomplete="bday-year birthday-year" class="form-control input-lg"/>      
        	<span class="input-group-addon">年</span>
        </span>
      </div>
    </div>
    <div class="form-group">
    	<label class="col-sm-2 control-label">
    	</label>
    	<div class="col-sm-4">
	    	<span class="input-group">
	    		<input type="number" name="birthmonth" value="<?php echo $month; ?>" required
	    			class="form-control input-lg" autocomplete="bday-month birthday-month" />
	    		<span class="input-group-addon">月</span>
	    	</span>
	    </div>
	</div>
	<div class="form-group">
    	<label class="col-sm-2 control-label">
    	</label>
    	<div class="col-sm-4">
    		<span class="input-group">
		    	<input type="number" name="birthday"  value="<?php echo $day; ?>" required
		    		class="form-control input-lg" autocomplete="bday-day birthday-day" />
	    		<span class="input-group-addon">日</span>
	    	</span>
	    </div>
	</div>
	<div class="form-group">
		<label for="birthtime" class="col-sm-2 control-label">
			時刻
		</label>
      	<div class="col-sm-4">
      		<span class="input-group">
	    		<input type="number" name="birthhour" value="<?php echo $hour; ?>" required
	    			class="form-control input-lg" autocomplete="bday-hour" />
	    		<span class="input-group-addon">時</span>
	    	</span>
    	</div>
    </div>
	<div class="form-group">
		<label for="birthtime" class="col-sm-2 control-label">
		</label>
      	<div class="col-sm-4">
      		<span class="input-group">
	    		<input type="number" name="birthminute" value="<?php echo $minute; ?>" required
	    			class="form-control input-lg" autocomplete="bday-minute" />
	    		<span class="input-group-addon">分</span>
	    	</span>
    	</div>
    </div>

	<!--
    <div class="form-group">
      <label for="birthtime" class="col-sm-2 control-label">
        時刻
      </label>
      <div class="col-sm-6">
        <input type="time" name="birthtime" class="form-control"/>
      </div>
    </div>
    -->

  </section>
  
  <?php

  	$long_min = $long_min / 60 * 100;
  	$lat_min = $lat_min / 60 * 100;

    if ($long_deg == 0) {
      $long_deg = 137;
      $long_min = 81;
    }
    if ($lat_deg == 0) {
      $lat_deg = 35;
      $lat_min = 53;
    }
  ?>

  <!-- 生まれた場所 -->
  <?php if (function_exists('get_template_directory_uri')) { ?>
    <div class="border_point"><img src="<?php echo get_template_directory_uri(); ?>/img/common/points01.svg" alt=""></div>
  <?php } ?>


  <div class="page_title title_black">
    <h2>生まれた場所<span>birth</span></h2>
  </div>
  <p class="title_caption">
    生まれた場所を検索してください。地図の中心の緯度と経度を使います。<br/>
    画面上の検索ボタンをクリックしてから次へ進んでください。
  </p>
  <hr/>
  <div class="row">
    <div class="col-md-6">
      <div class="form-inline">
        <div class="form-group">
            <label for="nameOfBirthplace" class="control-label">
              地名で検索
            </label>
            <input class="form-control input-lg" value="<?php echo $birthplace; ?>"
            	name="birthplace" id="nameOfBirthplace"/>
        </div>
        <button type="button" id="btnSearchBirthplace" class="btn btn-primary map-search">検索</button>
      </div>
    </div>
  </div> <!-- end row -->

  <div class="row pb80">
    <div class="col-md-6">

      <div id="map_canvas" style="margin-top:10px;width:100%; height:300px"></div>    
    </div>
    <div class="col-md-6">

      <section class="birthday form-horizontal" style="margin-top:10px;">
        <div class="form-group">
          <label for="lng" class="col-sm-4 control-label">
            経度<span class="required" aria-required="true">*</span>
          </label>
          <div class="col-sm-6">
            <input type="text" class="form-control" value="<?php echo $long_deg .".". $long_min; ?>"
            	name="lng" id="lng" readonly/> 
          </div>
        </div>

        <div class="form-group">
          <label for="lat" class="col-sm-4 control-label">
            緯度<span class="required" aria-required="true">*</span>
          </label>
          <div class="col-sm-6">
            <input type="text" class="form-control" value="<?php echo $lat_deg .".". $lat_min; ?>"
            	name="lat" id="lat" readonly/>
          </div>
        </div>

        <div class="form-group">
          <label for="timezone" class="col-sm-4 control-label">
            タイムゾーン
          </label>
          <div class="col-sm-6">
            <select name="timezone" size="1" class="form-control">
              <option value=''> Select Time Zone </option>
              <option value='-12'>GMT -12:00 hrs - IDLW</option>
              <option value='-11'>GMT -11:00 hrs - BET or NT</option>
              <option value='-10.5'>GMT -10:30 hrs - HST</option>
              <option value='-10'>GMT -10:00 hrs - AHST</option>
              <option value='-9.5'>GMT -09:30 hrs - HDT or HWT</option>
              <option value='-9'>GMT -09:00 hrs - YST or AHDT or AHWT</option>
              <option value='-8'>GMT -08:00 hrs - PST or YDT or YWT</option>
              <option value='-7'>GMT -07:00 hrs - MST or PDT or PWT</option>
              <option value='-6'>GMT -06:00 hrs - CST or MDT or MWT</option>
              <option value='-5'>GMT -05:00 hrs - EST or CDT or CWT</option>
              <option value='-4'>GMT -04:00 hrs - AST or EDT or EWT</option>
              <option value='-3.5'>GMT -03:30 hrs - NST</option>
              <option value='-3'>GMT -03:00 hrs - BZT2 or AWT</option>
              <option value='-2'>GMT -02:00 hrs - AT</option>
              <option value='-1'>GMT -01:00 hrs - WAT</option>
              <option value='0'>Greenwich Mean Time - GMT or UT</option>
              <option value='1'>GMT +01:00 hrs - CET or MET or BST</option>
              <option value='2'>GMT +02:00 hrs - EET or CED or MED or BDST or BWT</option>
              <option value='3'>GMT +03:00 hrs - BAT or EED</option>
              <option value='3.5'>GMT +03:30 hrs - IT</option>
              <option value='4'>GMT +04:00 hrs - USZ3</option>
              <option value='5'>GMT +05:00 hrs - USZ4</option>
              <option value='5.5'>GMT +05:30 hrs - IST</option>
              <option value='6'>GMT +06:00 hrs - USZ5</option>
              <option value='6.5'>GMT +06:30 hrs - NST</option>
              <option value='7'>GMT +07:00 hrs - SST or USZ6</option>
              <option value='7.5'>GMT +07:30 hrs - JT</option>
              <option value='8'>GMT +08:00 hrs - AWST or CCT</option>
              <option value='8.5'>GMT +08:30 hrs - MT</option>
              <option value='9' selected>GMT +09:00 hrs - JST or AWDT</option>
              <option value='9.5'>GMT +09:30 hrs - ACST or SAT or SAST</option>
              <option value='10'>GMT +10:00 hrs - AEST or GST</option>
              <option value='10.5'>GMT +10:30 hrs - ACDT or SDT or SAD</option>
              <option value='11'>GMT +11:00 hrs - UZ10 or AEDT</option>
              <option value='11.5'>GMT +11:30 hrs - NZ</option>
              <option value='12'>GMT +12:00 hrs - NZT or IDLE</option>
              <option value='12.5'>GMT +12:30 hrs - NZS</option>
              <option value='13'>GMT +13:00 hrs - NZST</option>
            </select>
          <p class="form-text text-muted">
            日本標準時がデフォルトです。出生地が海外の場合に選択してください。
          </p>                      
          </div>

        </div>

      </section>
    </div>

  </div>

  <!-- デザイン -->
  <?php if (function_exists('get_template_directory_uri')) { ?>
    <div class="border_point"><img src="<?php echo get_template_directory_uri(); ?>/img/common/points01.svg" alt=""></div>
  <?php } ?>


  <div class="page_title title_black">
    <h2>デザイン<span>design</span></h2>
  </div>
  <div class="form-group">
		<div class="radio">
		  <label>
		    <input type="radio" name="designMode" id="optionsRadios1" value="normal" checked>
		    すっきりシンプルなホロスコープ
		  </label>
		</div>
		<div class="radio">
		  <label>
		    <input type="radio" name="designMode" id="optionsRadios2" value="useimage">
		    星空のイメージのホロスコープ
		  </label>
		</div>
  </div>

  <hr/>

  <div class="form-group">
    <input type="hidden" name="submitted" value="TRUE">
    <INPUT type="submit" name="submit" class="btn btn-primary btn-large btn-lg btn-block" 
      value="ホロスコープを表示" align="middle" 
      style="">  
  </div>
</form>

<?php
// include ('footer_natal.html');


Function left($leftstring, $leftlength)
{
  return(substr($leftstring, 0, $leftlength));
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


Function Convert_Longitude($longitude)
{
  $signs = array (0 => 'Ari', 'Tau', 'Gem', 'Can', 'Leo', 'Vir', 'Lib', 'Sco', 'Sag', 'Cap', 'Aqu', 'Pis');

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

  return $deg . " " . $signs[$sign_num] . " " . $min . "' " . $full_sec . chr(34);
}


Function mid($midstring, $midstart, $midlength)
{
  return(substr($midstring, $midstart-1, $midlength));
}


Function safeEscapeString($string)
{
// replace HTML tags '<>' with '[]'
  $temp1 = str_replace("<", "[", $string);
  $temp2 = str_replace(">", "]", $temp1);

// but keep <br> or <br />
// turn <br> into <br /> so later it will be turned into ""
// using just <br> will add extra blank lines
  $temp1 = str_replace("[br]", "<br />", $temp2);
  $temp2 = str_replace("[br /]", "<br />", $temp1);

  if (get_magic_quotes_gpc())
  {
    return $temp2;
  }
  else
  {
    // return mysql_escape_string($temp2);
    return strip_tags($temp2);
  }
}


Function Find_Specific_Report_Paragraph($phrase_to_look_for, $file)
{
  $string = "";
  $len = strlen($phrase_to_look_for);

  //put entire file contents into an array, line by line
  $file_array = file($file);

  // look through each line searching for $phrase_to_look_for
  for($i = 0; $i < count($file_array); $i++)
  {
    if (left(trim($file_array[$i]), $len) == $phrase_to_look_for)
    {
      $flag = 0;
      while (trim($file_array[$i]) != "*")
      {
        if ($flag == 0)
        {
          $string .= "<b>" . $file_array[$i] . "</b>";
        }
        else
        {
          $string .= $file_array[$i];
        }
        $flag = 1;
        $i++;
      }
      break;
    }
  }

  return $string;
}

?>
