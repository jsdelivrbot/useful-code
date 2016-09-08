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

$id = getSQLValueString($_POST["id"], "int");

mysql_select_db($database_connect2data, $connect2data);	
$sql = "SELECT class_set.c_level FROM class_set WHERE c_id=$id AND c_active=1";
$res = mysql_query($sql);
$row = mysql_fetch_array($res);

/*mysql_select_db($database_connect2data, $connect2data);
$query_RecCareersNote = "SELECT * FROM data_set WHERE d_class1 = 'careersNote' ORDER BY d_sort ASC, d_date DESC";
$query_limit_RecCareersNote = sprintf("%s LIMIT %d, %d", $query_RecCareersNote, $startRow_RecCareersNote, $maxRows_RecCareersNote);
$RecCareersNote = mysql_query($query_limit_RecCareersNote, $connect2data) or die(mysql_error());
$row_RecCareersNote = mysql_fetch_assoc($RecCareersNote);*/

//echo "id = ".$id."<br/>";
echo $row["c_level"];
?>