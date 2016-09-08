<?php require_once('Connections/connect2data.php'); ?>
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

mysql_select_db($database_connect2data, $connect2data);
$query_RecBanners = "SELECT d_content FROM data_set WHERE d_class1 = 'banners' AND d_active='1' ORDER BY d_sort ASC, d_date DESC";
$RecBanners = mysql_query($query_RecBanners, $connect2data) or die(mysql_error());
$row_RecBanners = mysql_fetch_assoc($RecBanners);
$totalRows_RecBanners = mysql_num_rows($RecBanners);



include('flashJson/recordset2json.php');
echo sd_recordset2json($RecBanners);

mysql_free_result($RecBanners);
?>