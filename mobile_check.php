<!-- 各版本code -->
http://detectmobilebrowsers.com/


<?php require_once('mobileCheck.php'); ?>

<!-- mobileCheck.php -->
<?php
require_once 'js/MobileDetect/Mobile_Detect.php';

$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');

if($deviceType=='computer'){
	$_SESSION["mobile"] = 0;
		//echo 'SERVER_NAME - '.$_SERVER['SERVER_NAME'].'<br>';
		//echo 'HTTP_HOST = '.$_SERVER['HTTP_HOST'].'<br>';
}else{
	if(isset($_SESSION["mobile"]) && $_SESSION["mobile"]==1){
			//echo $_SESSION["mobile"].'<br>';
	}else{
		$_SESSION["mobile"] = 1;
		//$urln = "http://".$_SERVER['SERVER_NAME']."/mobile/";

		echo '<script>
			window.location = "mobile/";
			</script>';

		// header('Location: mobile/');

	}
}
?>
