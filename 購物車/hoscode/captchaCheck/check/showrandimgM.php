<?php

require_once('../../Connections/connect2data.php');

//generate random string
function code($length)
{
// Generate random 32 charecter string
$string = md5(time());

// Position Limiting
$highest_startpoint = 32-$length;

// Take a random starting point in the randomly
// Generated String, not going any higher then $highest_startpoint
$code = substr($string,rand(0,$highest_startpoint),$length);

return $code;

}

// Gets a random string of length 8


  $num="";
	$num_max = 6;

  $code = code($num_max);



/*$ci = '-1';
if( isset($_GET['ci']) ){
  $ci = $_GET['ci'];
}elseif( isset($_COOKIE['PHPSESSID']) ){
  $ci = $_COOKIE['PHPSESSID'];
}*/
$ci = $_COOKIE['PHPSESSID'];

$query  = "SELECT CA.* FROM captcha_set AS CA WHERE CA.ca_psid = '$ci'";
//echo "query = $query <br>";
mysql_select_db($database_connect2data, $connect2data);
$result = mysql_query($query, $connect2data) or die(mysql_error());
//$result = mysql_query($query);
$row = mysql_fetch_array( $result );
//echo mysql_num_rows($result);
if(mysql_num_rows($result)==0){
  //$ci = $_COOKIE['PHPSESSID'];
  $query = "INSERT INTO captcha_set (ca_psid, ca_captcha, ca_datetime) VALUES ('$ci', '$code', NOW() )";
  //echo 'query = '.$query;
  mysql_query($query) or die('Error, insert query failed');
}else{
  $updateSQL = "UPDATE captcha_set SET ca_captcha='$code' WHERE ca_psid='$ci'";
  //echo "updateSQL = ".$updateSQL;
  mysql_query($updateSQL) or die('Error, UPDATE query failed'); 
}


	$img_height = 37;
	$img_width = 165;
	$mass = 1500;
    /*for($i=0;$i<$num_max;$i++){
    $num .= rand(0,9);
    }*/
	$num = $code;
  $text = $code;
  $font_size = 26; // Font size is in pixels.
  $fontFile1 = 'AppleChancery.ttf'; // This is the path to your font file.
  $fontFile2 = 'HARNGTON.TTF';
  $fontFile3 = 'ARIALN.TTF';
  $fontFile4 = 'tunga.ttf';
  $fontFile5 = 'AHGBold.ttf';

  //$num_max  創造出N位的驗證碼，也可以用rand(1000,9999)直接產生
   //將產生的驗證碼寫入session，轉換至驗證頁面使用
    session_start();
    $_SESSION["Checknum"] = $num;
    $_COOKIE['Checknum'] = $num;
    
    //echo $_COOKIE[$_COOKIE['PHPSESSID']];


    //產生驗證圖片，並定義文字顏色與背景顏色
    header("Content-type: image/PNG");
    srand((double)microtime()*1000000);

// Retrieve bounding box:
$type_space = imagettfbbox($font_size, 0, $fontFile1, $text);

// Determine image width and height, 10 pixels are added for 5 pixels padding:
$image_width = abs($type_space[4] - $type_space[0]) + 10;
$image_height = abs($type_space[5] - $type_space[1]) + 10;

//$image = imagecreate($img_width,$img_height);

// Create image:
$image = imagecreatetruecolor($img_width, $img_height);

// Allocate text and background colors (RGB format):
$text_color = imagecolorallocate($image, 255, 255, 255);
//$bg_color = imagecolorallocate($image, 0, 0, 0);

$text_color = imagecolorallocate($image, 150, 150, 150);
$bg_color = imagecolorallocate($image, 230, 230, 230);

$massColor = imagecolorallocate($image, 217, 223, 196);

// Fill image:
imagefill($image, 0, 0, $bg_color);

//背景圖片
//$captchaImage = imagecreatefrompng("captcha3.png") or die("Cannot Initialize new GD image stream");
//$image = $captchaImage;

//distortedCopy($image, $img_width, $img_height);

//在圖示布上隨機產生大量躁點  
for ($i = 0; $i < $mass; $i++) {  
    imagesetpixel($image, rand(0, $img_width), rand(0, $img_height), $text_color);  
}
//$image = WaveImage($image, $img_width, $img_height, 3, 11, 12, 5, 14);
//畫線
$white = imagecolorallocate($image, 255, 255, 255);
//$black = imagecolorallocate($image, rand(234, 244), rand(207, 217), rand(181, 191));
$black = imagecolorallocate($image, rand(180, 230), rand(180, 230), rand(180, 230));
for ($i = 0; $i < 50; $i++) {
    //imagefilledrectangle($im, $i + $i2, 5, $i + $i3, 70, $black);
    imagesetthickness($image, rand(1, 5));
    imagearc(
        $image,
        rand(1, 300), // x-coordinate of the center.
        rand(1, 300), // y-coordinate of the center.
        rand(1, 300), // The arc width.
        rand(1, 300), // The arc height.
        rand(1, 300), // The arc start angle, in degrees.
        rand(1, 300), // The arc end angle, in degrees.
        (rand(0, 1) ? $black : $white) // A color identifier.
    );
}
//畫線

// Fix starting x and y coordinates for the text:
$x = 5; // Padding of 5 pixels.
$y = $image_height - 5; // So that the text is vertically centered.


$strx=rand(6,8);
for($i=0;$i<$num_max;$i++){
  //$strpos=rand(1,1);
  //$strx=rand((12*$i),(12*($i+1)));
  //$strpos=rand(0,($img_height-40));
  $strpos=rand(26,27);

  $fontR = rand(1, 4);

  switch ($fontR){
    case "1":
    $fontFile = $fontFile1;
    break;

    case "2":
    $fontFile = $fontFile2;
    break;

    case "3":
    $fontFile = $fontFile3;
    break;

    case "4":
    $fontFile = $fontFile4;
    break;

    case "5":
    $fontFile = $fontFile5;
    break;

    default:
     $fontFile = $fontFile1;
}

$fontFile = $fontFile5;

  $fontNewSize = rand($font_size-3, $font_size+2);

  $angle = rand(-30, 30);

  //$fontColor = imagecolorallocate($image, rand(150,220),rand(80,120),rand(80,120));

  //$fontColor = imagecolorallocate($image, rand(190,200),rand(136,146),rand(94,103));
  $fontColor = imagecolorallocate($image, 100, 100, 100);
  $black = imagecolorallocate($image, 60, 60, 60);
  //imagestring($image,$fontFile, $strx,$strpos, substr($text,$i,1), $black);

  //imagettftext($image, $fontNewSize, $angle, $strx+1, $strpos+1, $black, $fontFile, substr($text,$i,1));

  imagettftext($image, $fontNewSize, $angle, $strx, $strpos, $fontColor, $fontFile, substr($text,$i,1));



  $strx+=rand(26,28);
  //$strx=rand((12*$i),(12*($i+1)));
}




// Add TrueType text to image:
//imagettftext($image, $font_size, 0, $x, $y, $text_color, $fontFile, $text);

// Generate and send image to browser:
header('Content-type: image/png');
imagepng($image);

// Destroy image in memory to free-up resources:
imagedestroy($image);



function WaveImage($im, $width, $height, $S, $XP, $YP, $XA, $YA) {
  $scale = $S;        //3
  $Xperiod = $XP;     //11
  $Yperiod = $YP;     //12
  $Xamplitude = $XA;  //5
  $Yamplitude = $YA;  //14

  // X-axis wave generation
  $xp = $scale*$Xperiod*rand(1,3);
  $k = rand(0, 100);
  for ($i = 0; $i < ($width*$scale); $i++) {
      imagecopy($im, $im,
          $i-1, sin($k+$i/$xp) * ($scale*$Xamplitude),
          $i, 0, 1, $height*$scale);
  }

  // Y-axis wave generation
  $k = rand(0, 100);
  $yp = $scale*$Yperiod*rand(1,2);
  for ($i = 0; $i < ($height*$scale); $i++) {
      imagecopy($im, $im,
          sin($k+$i/$yp) * ($scale*$Yamplitude), $i-1,
          0, $i, $width*$scale, 1);
  }

  return $im;
}

?>