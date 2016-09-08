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

		header("Location: mobile/");
		//$urln = "http://".$_SERVER['SERVER_NAME']."/mobile/";

		/*echo '<script type="text/javascript">
            var answer = confirm("您使用的裝置為行動裝置，是否要幫您導至行動版網站?");
				if(answer){
					window.location = "mobile/";
				}
        </script>';*/

		}
	}

?>
