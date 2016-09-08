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
$query_RecClass2 = "SELECT * FROM fwukeh_class_set WHERE c_parent = 'featureC' AND c_active='1' ORDER BY c_sort ASC, c_id DESC";
$RecClass2 = mysql_query($query_RecClass2, $connect2data) or die(mysql_error());
$row_RecClass2 = mysql_fetch_assoc($RecClass2);
$totalRows_RecClass2 = mysql_num_rows($RecClass2);

$G_selected = '';
if(isset($_GET['selected1']))
{
$G_selected = $_GET['selected1'];
}else{
$G_selected = $row_RecClass2['c_id'];
}
//$G_selected = 1;
//$query_RecFeature = "SELECT fwukeh_data_set.*, fwukeh_class_set.c_title as c_title FROM fwukeh_data_set LEFT JOIN fwukeh_class_set ON fwukeh_data_set.d_class2 = fwukeh_class_set.c_id WHERE d_class1 = 'feature' AND d_class2='".$G_selected."' AND d_active='1' ORDER BY d_sort ASC, d_date DESC";
mysql_select_db($database_connect2data, $connect2data);
$query_RecFeature = "SELECT * FROM fwukeh_data_set WHERE d_class1 = 'feature' AND d_class2 = '".$G_selected."' AND d_active= '1' ORDER BY d_sort ASC, d_date DESC";
$RecFeature = mysql_query($query_RecFeature, $connect2data) or die(mysql_error());
$row_RecFeature = mysql_fetch_assoc($RecFeature);
$totalRows_RecFeature = mysql_num_rows($RecFeature);


$RecImageAll = array();
$RecImageSet = array();
include('recordset2json.php');

if ($totalRows_RecFeature > 0) { // Show if recordset not empty 

do { 
mysql_select_db($database_connect2data, $connect2data);
$query_RecImage = "SELECT file_id, file_title, file_link1 FROM fwukeh_file_set  WHERE file_type='image' AND file_d_id = ".$row_RecFeature['d_id'];
$RecImage = mysql_query($query_RecImage, $connect2data) or die(mysql_error());
$row_RecImage = mysql_fetch_assoc($RecImage);
$totalRows_RecImage = mysql_num_rows($RecImage);

//sd_recordset2array() 資料集轉換成陣列
$RecImageSet = sd_recordset2array($RecImage);
//array_merge() 函數把兩個或多個數組合併為一個數組。
$RecImageAll = array_merge($RecImageAll, $RecImageSet);
$RecImageSet = array();
//array_push($RecImageAll, $RecImageSet);
//unset($RecImageSet);
//echo sd_recordset2json($RecImage);					
//echo "<br/>";
 } while ($row_RecFeature = mysql_fetch_assoc($RecFeature));
//echo $RecImageAll."<br/>";
//print_r($RecImageAll);
//var_dump($RecImageAll);

} // Show if recordset not empty 

echo sd_array2json($RecImageAll);

mysql_free_result($RecFeature);

mysql_free_result($RecClass2);
?>


