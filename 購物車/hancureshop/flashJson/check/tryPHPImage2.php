<?php
/***
 * File : captcha.php
 * Description : Creating a captha image and
 * store the text in a session variable
 * Author : Kiran Paul V.J. aka kiranvj aka human
 * License : Freeware
 * Last update : 22-Aug-2007
 */

  // Initialize session data
session_start();
// all images in this file is of PNG format,
// there is not specific reason for that.
// this line is used to set the header of the page
// setting the header to image/png means this page
// contians data of image->PNG type
header("Content-type: image/png");

// create a new image resource from a file
$captchaImage = imagecreatefrompng("captcha1.png")
or die("Cannot Initialize new GD image stream");

//Loads a new font from a file
//$captchaFont = imageloadfont("anonymous.gdf");
$captchaFont = imageloadfont("bubblebath.gdf");

// Create the captcha text with some manipulation
$captchaText = substr(md5(uniqid('')),0,7);

// stores the captha text in a session variable
$_SESSION['session_captchaText'] = $captchaText;

// Allocating color for captcha text to be used
// in imagestring function
$captchaColor = imagecolorallocate($captchaImage,0,0,0);

// drawing the string 
imagestring($captchaImage,$captchaFont,15,5,$captchaText,$captchaColor);

// Outputs the captha image in PNG format.
// You can change the image format using
// imagejpeg,imagegif ,imagewbmp etc.
imagepng($captchaImage);

//frees memory
imagedestroy($captchaImage);
?>