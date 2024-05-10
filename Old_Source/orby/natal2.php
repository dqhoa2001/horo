<?php
  $months = array (0 => 'Choose month', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
  $my_error = "";

  // check if the form has been submitted
  if (isset($_POST['submitted']) Or isset($_POST['h_sys_submitted']))
  {

  }
  else
  {
    // include ('header_natal.html');				//here because of cookies


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

<form id="natalform" action="<?php echo plugins_url('natal_form_wheel.php',__FILE__); ?>" method="post" target="_blank" style="margin: 0px 20px;">

  <div class="border_point"><img src="<?php echo get_template_directory_uri(); ?>/img/common/points01.svg" alt=""></div>


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
          class="form-control" autocomplete="name" required>
      </div>            
    </div>


    <div class="form-group">
      <label for="birthday" class="col-sm-2 control-label">
        生年月日
      </label>
      <div class="col-sm-4">
	    <span class="input-group">
        	<input name="birthyear" value="<?php echo $year; ?>" required type="number"
        		autocomplete="bday-year birthday-year" class="form-control"/>      
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
	    			class="form-control" autocomplete="bday-month birthday-month" />
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
		    		class="form-control" autocomplete="bday-day birthday-day" />
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
	    			class="form-control" autocomplete="bday-hour" />
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
	    			class="form-control" autocomplete="bday-minute" />
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
  ?>

  <!-- 生まれた場所 -->
  <div class="border_point"><img src="<?php echo get_template_directory_uri(); ?>/img/common/points01.svg" alt=""></div>


  <div class="page_title title_black">
    <h2>生まれた場所<span>birth</span></h2>
  </div>
  <p class="title_caption">
    生まれた場所を検索してください。地図の中心の緯度と経度を使います。
  </p>
  <hr/>
  <div class="row">
    <div class="col-md-6">
      <div class="form-inline">
        <div class="form-group">
            <label for="nameOfBirthplace" class="control-label">
              地名で検索
            </label>
            <input class="form-control" value="<?php echo $birthplace; ?>"
            	name="birthplace" id="nameOfBirthplace"/>
        </div>
        <button type="button" class="btn btn-primary map-search">検索</button>
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
  <div class="border_point"><img src="<?php echo get_template_directory_uri(); ?>/img/common/points01.svg" alt=""></div>


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
