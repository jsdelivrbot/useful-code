<?php
//require_once('../Connections/config.php'); 

$dbhost							= 'localhost';
$dbuser							= "goodsdes_hanadm";
$dbpass							= "N6pfKVSMvmxs84GKLW";
$dbname							= "goodsdes_hanshop";
/*$dbuser							= "goodsdes_hanadm";
$dbpass							= "NbTNRn(lMV7$IK$NmT";
$dbname							= "goodsdes_hanshop";*/

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ("Error connecting to mysql");
mysql_select_db($dbname);

$query = "SET CHARACTER SET utf8";
mysql_query( $query );
$query = "SET NAMES utf8";
mysql_query( $query );
?>