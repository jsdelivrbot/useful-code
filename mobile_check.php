<!-- 各版本code -->
http://detectmobilebrowsers.com/


<?php require_once('mobileCheck.php'); ?>

<!-- 以下另存成 mobileCheck.php -->
ps. 可能會有 header already send 的錯誤
新增一個 .htaccess 開啟下面這個即可
php_flag output_buffering on
因為哥不爽用javascript
<?php
require_once 'js/MobileDetect/Mobile_Detect.php';

$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');

$nowPage = $_SERVER['REQUEST_URI'];  //now page
$nowDir = dirname($_SERVER['PHP_SELF']);  //footdisc
$computerPage = str_replace('/mobile', '', $nowPage);
$mobilePage = str_replace($nowDir, $nowDir.'/mobile', $nowPage);

if($deviceType=='computer'){
	// header('location:'.$computerPage);
}else{
	header('location:'.$mobilePage);
}
?>
