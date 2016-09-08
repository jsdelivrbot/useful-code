<?php require_once('../Connections/connect2data.php'); ?>
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
$query_RecProducts = "SELECT D.d_id, D.d_title, D.d_class3, D.d_class4, D.d_class5
, D.d_other1, D.d_other2, D.d_price1, D.d_price2, D.d_price3, D.d_price4, D.d_sale, D.d_date, F.file_title, F.file_link1 FROM data_set AS D LEFT JOIN file_set AS F ON D.d_id = F.file_d_id WHERE D.d_class1='products' AND D.d_active='1' AND D.d_new_product='0' AND F.file_type='image' ORDER BY d_sort ASC, d_date DESC";
//$query_RecProducts = "SELECT data_set.*, file_set.* FROM data_set LEFT JOIN file_set ON data_set.d_id = file_set.file_d_id WHERE d_class1 = 'products' AND d_active='1' AND d_new_product='0' ORDER BY d_sort ASC, d_date DESC";
$RecProducts = mysql_query($query_RecProducts, $connect2data) or die(mysql_error());
$row_RecProducts = mysql_fetch_assoc($RecProducts);
$totalRows_RecProducts = mysql_num_rows($RecProducts);

include('recordset2json.php');
echo sd_recordset2json($RecProducts);

mysql_free_result($RecProducts);
?>


