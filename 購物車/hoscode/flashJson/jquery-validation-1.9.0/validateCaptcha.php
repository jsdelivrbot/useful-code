<?php
if (!isset($_SESSION)) {
	session_start();
}
ob_start();
include('../recordset2json.php');
/* RECEIVE VALUE */
$captcha = '';
if(isset($_POST['captcha'])){
	$captcha = $_POST['captcha'];
}else if(isset($_GET['captcha'])){
	$captcha = $_GET['captcha'];
}
//echo strtoupper($captcha).'<br>';
//echo $_SESSION['Checknum'].'<br>';
// To avoid case conflicts, make the input uppercase and check against the session value
// If it's correct, echo '1' as a string
if((isset($_SESSION["Checknum"])) && ($captcha == $_SESSION['Checknum'])){
	echo 'true';
// Else echo '0' as a string
}else{
	echo 'false';
}

?>