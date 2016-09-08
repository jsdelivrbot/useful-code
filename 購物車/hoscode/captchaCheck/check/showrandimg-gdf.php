<?php

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
$code = code(6);

  $num="";
	$num_max = 6;
	$img_height = 34;
	$img_width = 165;
	$mass = 1000;
    /*for($i=0;$i<$num_max;$i++){
    $num .= rand(0,9);
    }*/
	$num = $code;
   //$num_max  創造出N位的驗證碼，也可以用rand(1000,9999)直接產生
   //將產生的驗證碼寫入session，轉換至驗證頁面使用
    session_start();
    $_SESSION["Checknum"] = $num;
   //產生驗證圖片，並定義文字顏色與背景顏色
    header("Content-type: image/PNG");
    srand((double)microtime()*1000000);
    $im = imagecreate($img_width,$img_height);
    $black = imagecolorallocate($im, 165,0,0);
    $gray = imagecolorallocate($im, 255,255,255);
    imagefill($im,0,0,$gray);
	
	$captchaImage = imagecreatefrompng("captcha3.png") or die("Cannot Initialize new GD image stream");
	$im = $captchaImage;
    //上方mass變數，可在視窗中產生雜點，使其不好辨別
    /*for($i=0;$i<$mass;$i++)
    {
	$black = imagecolorallocate($im, rand(0,200),rand(0,200),rand(0,200));
   imagesetpixel($im, rand(0,$img_width), rand(0,$img_height), $black);
    }*/
    //將驗證碼隨機顯示在視窗中，驗證字元的水平間距與位置均依照一定的波動範圍生成。
//imagestring之中的5為字體大小，strops 後方數字為水平位置(垂直的高度變動)，strx應該為水平間距
	$font = imageloadfont("myGdf7.gdf");
    $strx=rand(1,1);
    for($i=0;$i<$num_max;$i++){
    //$strpos=rand(1,1);
	//$strx=rand((12*$i),(12*($i+1)));
	//$strpos=rand(0,($img_height-40));
	$strpos=rand(-5,-5);
	
	$black = imagecolorallocate($im, rand(0,100),rand(0,100),rand(0,100));
	//$black = imagecolorallocate($im, 165,0,0);
    imagestring($im,$font,$strx,$strpos, substr($num,$i,1), $black);
    $strx+=rand(25,25);
	//$strx=rand((12*$i),(12*($i+1)));
    }
    imagepng($im);
    imagedestroy($im);
   ?>