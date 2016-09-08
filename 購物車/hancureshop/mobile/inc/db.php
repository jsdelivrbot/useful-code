<?php
$dbhost							= 'localhost';

$dbuser							= "goodsdes_hanadm";
$dbpass							= "N6pfKVSMvmxs84GKLW";
$dbname							= "goodsdes_hanshop";

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ("Error connecting to mysql");
mysql_select_db($dbname);

$query = "SET CHARACTER SET utf8";
mysql_query( $query );
$query = "SET NAMES utf8";
mysql_query( $query );
?>