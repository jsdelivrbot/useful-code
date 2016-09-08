<?php
//require_once('config.php');
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
//date_default_timezone_set( 'Asia/Taipei' );

ini_set('date.timezone','Asia/Taipei');

$hostname_connect2data = 'localhost';
/*$database_connect2data = 'hancure_shop';
$username_connect2data = 'root';
$password_connect2data = '0708';*/

$database_connect2data = 'hancure_shop';
$username_connect2data = 'root';
$password_connect2data = '1234';

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
$selfPage=basename($_SERVER['PHP_SELF']);

function checkV($d){
	return (isset($_REQUEST[$d])) ? $_REQUEST[$d] : NULL;
}
?>