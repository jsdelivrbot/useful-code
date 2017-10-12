<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"

$hostname_connect2data = "localhost";
$database_connect2data = "sino";
$username_connect2data = "root";
$password_connect2data = "1234";
define("HOSTNAME", $hostname_connect2data);
define("DATABASE", $database_connect2data);
define("USERNAME", $username_connect2data);
define("PASSWORD", $password_connect2data);

$connect2data = mysql_pconnect($hostname_connect2data, $username_connect2data, $password_connect2data) or trigger_error(mysql_error(),E_USER_ERROR);

define("CONNECT2DATA", $connect2data);

$query = "SET CHARACTER SET utf8";
mysql_query( $query );
$query = "SET NAMES utf8";
mysql_query( $query );
/*
if (!isset($_SESSION)) {
	session_start();
	}
	ob_start();*/
	$selfPage=basename($_SERVER['PHP_SELF']);
/**
 * @since 0.71
 */
define( 'OBJECT', 'OBJECT', true );

/**
 * @since 2.5.0
 */
define( 'OBJECT_K', 'OBJECT_K' );

date_default_timezone_set('Asia/Taipei');

function checkV($d){
	return (isset($_REQUEST[$d])) ? $_REQUEST[$d] : NULL;
}
?>