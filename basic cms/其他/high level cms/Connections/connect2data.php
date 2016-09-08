<?php
//require_once('config.php');
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
//date_default_timezone_set( 'Asia/Taipei' );

ini_set('date.timezone','Asia/Taipei');

error_reporting(E_ALL ^ E_DEPRECATED);

if (!isset($_SESSION)) {
	session_start();
}

$hostname_connect2data = 'localhost';
$database_connect2data = 'seasonart';
$username_connect2data = 'root';
$password_connect2data = '';

$connect2data = mysql_pconnect($hostname_connect2data, $username_connect2data, $password_connect2data) or trigger_error(mysql_error(),E_USER_ERROR);

$query = "SET CHARACTER SET utf8";
mysql_query( $query );
$query = "SET NAMES utf8";
mysql_query( $query );
/*
if (!isset($_SESSION)) {
	session_start();
	}
ob_start();*/

require_once('config_set.php');
require_once('clear_str.php');


/*
$script   = $_SERVER['SCRIPT_NAME'];
echo 'script = '.$script.'<br>';
$SCRIPT_NAME = explode('/',$_SERVER['SCRIPT_NAME']);
$toLanPage = $SCRIPT_NAME[count($SCRIPT_NAME)-1];
echo 'toLanPage = '.$toLanPage.'<br>';

// echo 'QUERY_STRING = '.$_SERVER['QUERY_STRING'].'<br>';
// echo 'PHP_SELF = '.$_SERVER['PHP_SELF'].'<br>';
//echo 'REQUEST_URI = '.$_SERVER['REQUEST_URI'].'<br>';
//echo "basename = ".basename(__FILE__, '.php').'<br>';

// $REQUEST_URI = explode('/',$_SERVER['REQUEST_URI']);
// $toLanPage = $REQUEST_URI[count($REQUEST_URI)-1];

//取得URL變數
$QUERY_STRING = $_SERVER['QUERY_STRING'];
$QUERY_STRING_A = explode('&',$QUERY_STRING);

var_dump($QUERY_STRING_A);
echo '<br>';
// var_dump($SCRIPT_NAME);
// echo '<br>';
// echo 'QUERY_STRING = '.$_SERVER['QUERY_STRING'].'<br>';
// echo 'SCRIPT_FILENAME = '.$_SERVER['SCRIPT_FILENAME'].'<br>';
// echo 'SCRIPT_NAME = '.$_SERVER['SCRIPT_NAME'].'<br>';
//$toLanPageLanLink = "en/"

//var_dump($SCRIPT_NAME);
//echo $toLanPage;

$count = count($SCRIPT_NAME);
$comL = 3; //本機端
$phoL = 4; //本機端
//$comL = 2; //網路端
//$phoL = 3; //網路端
echo "toLanPage = ".$toLanPage.'<br>';
$detailCheck = explode('.php',$toLanPage);

echo 'detailCheck = '.$detailCheck[0].'<br>';
echo 'QUERY_STRING_A = '.$QUERY_STRING_A[0];

*/
?>