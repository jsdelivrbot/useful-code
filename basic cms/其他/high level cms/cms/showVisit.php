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

$maxRows_RecVisit = 10;
$pageNum_RecVisit = 0;
if (isset($_GET['pageNum_RecVisit'])) {
  $pageNum_RecVisit = $_GET['pageNum_RecVisit'];
}
$startRow_RecVisit = $pageNum_RecVisit * $maxRows_RecVisit;

mysql_select_db($database_connect2data, $connect2data);
$query_RecVisit = "SELECT * FROM webcount ORDER BY count_time DESC";
$query_limit_RecVisit = sprintf("%s LIMIT %d, %d", $query_RecVisit, $startRow_RecVisit, $maxRows_RecVisit);
$RecVisit = mysql_query($query_limit_RecVisit, $connect2data) or die(mysql_error());
$row_RecVisit = mysql_fetch_assoc($RecVisit);

if (isset($_GET['totalRows_RecVisit'])) {
  $totalRows_RecVisit = $_GET['totalRows_RecVisit'];
} else {
  $all_RecVisit = mysql_query($query_RecVisit);
  $totalRows_RecVisit = mysql_num_rows($all_RecVisit);
}
$totalPages_RecVisit = ceil($totalRows_RecVisit/$maxRows_RecVisit)-1;
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>最近 10 筆訪客資料</title>
<style type="text/css">
<!--
p {
	font-size: 10pt;
	line-height: 120%;
	margin-bottom: 10px;
}
tr td {
	font-size: 10pt;
	line-height: 120%;
}
.head {
	line-height: 24px;
	background-image: url(images/headback1.jpg);
	background-repeat: repeat-x;
	font-size: 10pt;
	font-weight: bold;
	color: #FFFFFF;
	font-family: "新細明體";
}
-->
</style>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {
	background-color: #FFFFFF;
}
-->
</style>
<link href="css/work_css.css" rel="stylesheet" type="text/css" />
</head>

<body>
<p>網站瀏覽總人數：<span class="err_data"><?php echo $totalRows_RecVisit ?></span> 人次，<br />
  最後記錄時間為：<span class="err_data"><?php echo $row_RecVisit['count_time']; ?></span>。<br />
以下為最近 <span class="err_data">10</span> 筆訪客資料：</p>
<table width="100%" border="0" cellpadding="4" cellspacing="1">
  <tr >
    <td height="24" align="center" class="table_title"><strong>訪客 IP </strong></td>
    <td height="24" align="center" class="table_title" ><strong>訪客登入時間</strong></td>
  </tr>
  <?php do { ?>
    <tr>
      <td height="24" align="center" bgcolor="#FFFFFF" class="buttom_dot_line"><div align="center" class="err_data"><?php echo $row_RecVisit['count_ip']; ?></div></td>
      <td height="24" align="center" bgcolor="#FFFFFF" class="buttom_dot_line"><div align="center" class="err_data"><?php echo $row_RecVisit['count_time']; ?></div></td>
    </tr>
    <?php } while ($row_RecVisit = mysql_fetch_assoc($RecVisit)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($RecVisit);
?>