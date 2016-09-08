<?php
$insertSQL = sprintf("INSERT INTO data_set (d_title, d_data1, d_content, d_class1, d_date, d_active) VALUES (%s, %s, %s, 'contactUs', NOW(), '1')",

	GetSQLValueString($m_name, "text"),
	GetSQLValueString($m_email, "text"),
	GetSQLValueString($m_content, "text"));

mysql_select_db($database_connect2data, $connect2data);
$Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
 ?>

<?php
if (!function_exists("GetSQLValueString")) {
	function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
	{
		if (PHP_VERSION < 6) {
			$theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
		}

		$theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

		switch ($theType) {
			case "text":
			$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
			break;
			case "long":
			case "int":
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			break;
			case "double":
			$theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
			break;
			case "date":
			$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
			break;
			case "defined":
			$theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
			break;
		}
		return $theValue;
	}
}
 ?>

 <?php
 if (!function_exists("GetSQLValueString")) {
 	function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
 	{
 		$theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

 		$theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

 		switch ($theType) {
 			case "text":
 			$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
 			break;
 			case "long":
 			case "int":
 			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
 			break;
 			case "double":
 			$theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
 			break;
 			case "date":
 			$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
 			break;
 			case "defined":
 			$theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
 			break;
 		}
 		return $theValue;
 	}
 }
  ?>