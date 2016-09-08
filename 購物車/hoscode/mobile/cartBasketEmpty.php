<?php
require_once('inc/EDcart.php');
if (!isset($_SESSION)) {
  session_start();
}

$cart =& $_SESSION['edCart']; 
if(!is_object($cart)) $cart = new edCart(); 
?>
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
$query_RecDownload = "SELECT * FROM data_set WHERE d_class1 = 'download' AND d_active='1' ORDER BY d_sort ASC, d_date DESC";
$RecDownload = mysql_query($query_RecDownload, $connect2data) or die(mysql_error());
$row_RecDownload = mysql_fetch_assoc($RecDownload);
$totalRows_RecDownload = mysql_num_rows($RecDownload);

$colname_RecFile = "-1";
if (isset($row_RecDownload['d_id'])) {
  $colname_RecFile = $row_RecDownload['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecFile = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'file'", GetSQLValueString($colname_RecFile, "int"));
$RecFile = mysql_query($query_RecFile, $connect2data) or die(mysql_error());
$row_RecFile = mysql_fetch_assoc($RecFile);
$totalRows_RecFile = mysql_num_rows($RecFile);
?>
<?php require_once('../Connections/session.initialize.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>C+H</title>

	<?php include('meta.php') ?>

	<script src="js/jquery/1.11.1/jquery.min.js"></script>

	<link rel="stylesheet/less" type="text/css" href="style_ryder.less">
	<script src="js/less-1.3.0.min.js" type="text/javascript"></script>

	<style type="text/css">
		.mb25{
			margin-bottom: 25px;
		}
		.mb18{
			margin-bottom: 18px;
		}
		span.w90{
			display: inline-block;
			width: 54px;
		}
		.cuspos{
			margin-top: 10px;
			margin-bottom: 6px;
		}
		.pl33{
			padding-left: 33px;
		}
		.areacontent{
			color:#B43125;
			font-size:14px;
			font-weight:bold;
			text-align:center;
			padding-top:30px;
			padding-bottom:30px;
		}
		.areacontent > p{
			margin-bottom:20px;
		}
		.footer{
			position: absolute;
			bottom: 0;
			width: 100%;
		}
	</style>

</head>
<body>

	<?php include 'topmenu-fixed.php'; ?>

	<div class="fortopmenupush"></div>

	<div class="bigtitle">商品清單</div>

	<div class="areacontent mb25">
		<p>目前您的購物車中無任何產品</p>
		<p class="btnstyle"><span><a href="goods.php">前往商品列表</a></span></p>
	</div>

	<?php include 'footer.php'; ?>


</body>
</html>


