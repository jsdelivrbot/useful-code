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
	<title>HanCure 漢速敷</title>

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
		span.w95{
			display: inline-block;
			width: 59px;
		}
		.cuspos{
			margin-top: 10px;
			margin-bottom: 6px;
		}
		.pl33{
			padding-left: 33px;
		}
		.fs13{
			font-size: 13px;
			margin-bottom: 2px;
		}
	</style>

</head>
<body>

	<?php include 'topmenu-fixed.php'; ?>

	<div class="fortopmenupush"></div>

	<div class="bigtitle">如何訂購</div>

	<div class="areatitle">購買方式 1 - 網路訂購</div>
	<div class="areacontent mb25">
		<p><span class="fs13">會員訂購：</span><span class="textarea">會員訂購需先註冊會員，並登入會員。會員可不定期享有本站優惠。</span></p>
		<p class="fs13">訪客訂購(非會員)。</p>
		<p class="btnstyle"><span><a href="goods.php">前往商品列表</a></span></p>
	</div>

	<?php if(0){ ?>
	<div class="areatitle">購買方式 2 - 電話預購，需填寫預購單</div>
	<?php } ?>

	<div class="areacontent mb25">
		<p><span class="w95 fs13">服務專線</span>：<a href="tel:0223930862">+886 7 3106766</a></p>
		<!-- <p><span class="w95 fs13">Line ID</span>：0925266198</p>
		<p class="cuspos"><img src="images/qrcode.png" width="85"></p> -->
		<p><span class="fs13">服務時間：</span>09:00-17:00，週一~週五</p>
		<p class="btnstyle"><span><a href="<?php echo '../'.$row_RecFile['file_link1']; ?>" target="new" title="<?php echo $row_RecFile['file_title']; ?>" id="downloadFile">按此表單下載</a></span></p>
	</div>

	<div class="areatitle">付款方式</div>

	<div class="areacontent mb25">
		<p class="fs13">(1) ATM 轉帳：</p>
		<p class="pl33">當您的訂單資料成立後，您需於 3 內完成匯款，以利如期出貨。</p>
		<p><BR></p>
		<p class="pl33">1.會員完成匯款後可進會員系統回報匯款資訊</p>
		<p class="pl33">2.非會員完成匯款後請來信或來電告知匯款帳號後五碼</p>
		<p><BR></p>
		<p class="fs13">(2) 貨到付款：</p>
		<p class="pl33">貨到付款金額超過 2 萬元者，請改用ATM匯款，謝謝您。</p>
	</div>

	<div class="areatitle">配送方式</div>

	<div class="areacontent mb25">
		<p class="fs13">(1) 送貨方式：</p>
		<p class="pl33">全程常溫宅配運送，請註明收件時段
		</p>
		<p class="fs13">(2) 送貨範圍：</p>
		<p class="pl33">限台灣本島地區，若有台灣本島以外地區，運費需額外計算。</p>
		<p class="fs13">(3) 寄送時間：</p>
		<p class="pl33">付款後 7 天內出貨或視顧客情況而排定日期出貨。</p>
	</div>

	<div class="areatitle">退換貨說明</div>

	<div class="areacontent mb25">
		<p class="mb18">請在收到產品後拆箱確認，若有問題請當場拍照以及向宅配司機反應，並於到貨日 3 日內與我們聯繫進行退換貨處理。
		</p>
		<p><span class="w95 fs13">服務電話</span>：<a href="tel:0223930862">+886 7 3106766</a></p>
		<!-- <p><span class="w95 fs13">Line ID</span>：0925266198</p>
		<p class="cuspos"><img src="images/qrcode.png" width="85"></p> -->
	</div>

	<?php include 'footer.php'; ?>


</body>
</html>


