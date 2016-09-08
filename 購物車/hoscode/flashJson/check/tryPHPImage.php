<?php 
//---------------------------------------------------------------
//Meezerk's CAPTCHA - A Computer Assisted Program for Telling 
// Computers and Humans Apart
//Copyright (C) 2004 Daniel Foster dan_software@meezerk.com
//---------------------------------------------------------------

//Select size of image
$size_x = "200";
$size_y = "100";

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
$code = code(8);

//store captcha code in session vars
session_start();
$_SESSION['captcha_code'] = $code;

//create image to play with
$image = imagecreate($size_x,$size_y);

//add content to image
//------------------------------------------------------

//make background white - first colour allocated is background
$background = imagecolorallocate($image,255,255,255);

//select grey content number
$text_number1 = mt_rand("0","150");
$text_number2 = mt_rand("0","150");
$text_number3 = mt_rand("0","150");

//allocate colours
$white = imagecolorallocate($image,255,255,255);
$black = imagecolorallocate($image,0,0,0);
$text = imagecolorallocate($image,$text_number1,$text_number2,$text_number3);

//get number of dots to draw
$total_dots = ($size_x * $size_y)/15;

//draw many many dots that are the same colour as the text
for($counter = 0; $counter < $total_dots; $counter++) {
//get positions for dot
$pos_x = mt_rand("0",$size_x);
$pos_y = mt_rand("0",$size_y);

//draw dot
imagesetpixel($image,$pos_x,$pos_y,$text);
};

//draw border
imagerectangle($image,0,0,$size_x-1,$size_y-1,$black);

//get coordinates of position for string
//on the font 5 size, each char is 15 pixels high by 9 pixels wide
//with 6 digits at a width of 9, the code is 54 pixels wide
$pos_x = bcmod($code,$size_x-60) +3;
$pos_y = bcmod($code,$size_y-15);

//(* I tried changing the "5" below, but it did not do anything.)

//draw random number
imagestring($image, 5, $pos_x, $pos_y, $code, $text);

//------------------------------------------------------
//end add content to image

//send browser headers
header("Content-Type: image/jpeg");

//send image to browser
echo imageJPEG($image);

//destroy image
imagedestroy($image);

?>