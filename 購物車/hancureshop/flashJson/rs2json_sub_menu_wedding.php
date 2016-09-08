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
$query_RecAllSet = "SELECT c_id, c_class, c_active, c_parent FROM fwukeh_class_set WHERE c_class = 'banquetSet' ORDER BY c_title DESC";
$RecAllSet = mysql_query($query_RecAllSet, $connect2data) or die(mysql_error());
$row_RecAllSet = mysql_fetch_assoc($RecAllSet);
$totalRows_RecAllSet = mysql_num_rows($RecAllSet);

include('recordset2json.php');
echo sd_recordset2json($RecAllSet);

mysql_free_result($RecAllSet);
?>


