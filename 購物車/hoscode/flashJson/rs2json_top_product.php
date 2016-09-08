<?php require_once('../Connections/connect2data.php'); ?>
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

mysql_select_db($database_connect2data, $connect2data);
$query_RecTopPro = "SELECT * FROM bobo_data_set WHERE d_class1 = 'top_products' AND d_active=1 ORDER BY d_sort ASC, d_date DESC";
$RecTopPro = mysql_query($query_RecTopPro, $connect2data) or die(mysql_error());
$row_RecTopPro = mysql_fetch_assoc($RecTopPro);
$totalRows_RecTopPro = mysql_num_rows($RecTopPro);

$colname_RecImage = "-1";
if (isset($row_RecTopPro['d_id'])) {
	$colname_RecImage = $row_RecTopPro['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecImage = sprintf("SELECT file_id, file_title, file_link1 FROM bobo_file_set WHERE file_type='image' AND file_d_id = %s", GetSQLValueString($colname_RecImage, "int"));
$RecImage = mysql_query($query_RecImage, $connect2data) or die(mysql_error());
$row_RecImage = mysql_fetch_assoc($RecImage);
$totalRows_RecImage = mysql_num_rows($RecImage);

include('recordset2json.php');
echo sd_recordset2json($RecImage);

mysql_free_result($RecImage);
?>


