<?php
if (!isset($_SESSION)) {
	session_start();
}
ob_start();

include('recordset2json.php');
/* RECEIVE VALUE */
$captcha = '';
if(isset($_POST['captcha'])){
	$captcha = $_POST['captcha'];
}else if(isset($_GET['captcha'])){
	$captcha = $_GET['captcha'];
}


//echo '_COOKIE = '.$_COOKIE['Checknum'];


//echo strtoupper($captcha).'<br>';
//echo $_SESSION['Checknum'].'<br>';
// To avoid case conflicts, make the input uppercase and check against the session value
// If it's correct, echo '1' as a string
if((isset($_SESSION["Checknum"])) && ($captcha == $_SESSION['Checknum'])){
	echo 'true';
// Else echo '0' as a string
}else{
	require_once('../Connections/connect2data.php');
	$ci = $_COOKIE['PHPSESSID'];
	$query  = "SELECT CA.* FROM captcha_set AS CA WHERE CA.ca_psid = '$ci'";
	//echo "query = $query <br>";
	mysql_select_db($database_connect2data, $connect2data);
	$result = mysql_query($query, $connect2data) or die(mysql_error());
	//$result = mysql_query($query);
	$row = mysql_fetch_array( $result );

	if((isset($row['ca_captcha'])) && ($captcha == $row['ca_captcha'])){
		echo 'true';
	}else{
		echo 'false';
	}
}




?>