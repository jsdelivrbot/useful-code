<?php
$dbhost							= 'localhost';

$dbuser							= "goodstes_chadm";
$dbpass							= "mPS5EBUg5lBDupW9ie";
$dbname							= "goodstes_chunhanstudio";

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ("Error connecting to mysql");
mysql_select_db($dbname);

$query = "SET CHARACTER SET utf8";
mysql_query( $query );
$query = "SET NAMES utf8";
mysql_query( $query );
?>