<?php
require_once('inc/EDcart.php');
if (!isset($_SESSION)) {
  session_start();
}

$cart =& $_SESSION['edCart']; 
if(!is_object($cart)) $cart = new edCart(); 
//echo "item = ".$cart->itemCount;
?>
<?php require_once('../logout_action.php'); ?>
<?php require_once('../member_limit.php'); ?>
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


$colname_RecOrder = "-1";
if (isset($_GET['o_id'])) {
  $colname_RecOrder = $_GET['o_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecOrder = sprintf("SELECT * FROM order_set WHERE o_id = %s AND  m_account='".$_SESSION['MM_UserAccount']."'", GetSQLValueString($colname_RecOrder, "int"));
$RecOrder = mysql_query($query_RecOrder, $connect2data) or die(mysql_error());
$row_RecOrder = mysql_fetch_assoc($RecOrder);
$totalRows_RecOrder = mysql_num_rows($RecOrder);

if($totalRows_RecOrder==0){
	header("Location:record.php");	
}


$colname_RecOrderItem = "-1";
if (isset($row_RecOrder['o_id'])) {
  $colname_RecOrderItem = $row_RecOrder['o_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecOrderItem = sprintf("SELECT * FROM order_item WHERE o_id = %s ORDER BY oi_id ASC", GetSQLValueString($colname_RecOrderItem, "int"));
$RecOrderItem = mysql_query($query_RecOrderItem, $connect2data) or die(mysql_error());
$row_RecOrderItem = mysql_fetch_assoc($RecOrderItem);
$totalRows_RecOrderItem = mysql_num_rows($RecOrderItem);

$payment = $row_RecOrder['payment'];
/*if (!(strcmp(1, $payment))) {echo "銀行轉帳<br>";}
if (!(strcmp(2, $payment))) {echo "貨到付款";}*/
?>
<?php require_once('../Connections/session.initialize.php'); ?>
<?php require_once('../orders_statusA.php'); ?>
<?php require_once('../js/fun_moneyFormat.php'); ?>
<?php require_once('../js/fun_changeStr.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>HanCure 漢速敷</title>

	<?php include('meta.php') ?>

	<script src="js/jquery/1.11.1/jquery.min.js"></script>

	<script src="js/jquery.bxslider/jquery.bxslider.js"></script>
	<link rel="stylesheet" type="text/css" href="js/jquery.bxslider/jquery.bxslider.css">

	<script src="js/jquery.twzipcode.js"></script>

	<link rel="stylesheet/less" type="text/css" href="style_ryder.less">
	<script src="js/less-1.3.0.min.js" type="text/javascript"></script>

	<style type="text/css">
		.h-bb{
			border-bottom: 1px solid #ad9f82;
			padding-bottom: 14px;
		}
		.h-mt{
			margin-top: 93px;
		}
		.h-mb9{
			margin-bottom: 9px;
		}
		ul.twochoice{
			margin-top: 113px;
		}
		.c-select{
			font-size: 12px;
			height: 20px;
		}
	</style>

</head>
<body>

	<?php include 'topmenu-fixed.php'; ?>

	<div class="fortopmenupush"></div>

	<div class="bigtitle">訂單 <?php echo $row_RecOrder['o_number']; ?> 資訊</div>

	<div class="areatitle h-mb9">商品資訊</div>
	
	<ul class="order-list">
    
<?php do{ ?>
<?php
if(isset($row_RecOrderItem['pic2']) && $row_RecOrderItem['pic2']!=''){
	$img = '../'.$row_RecOrderItem['pic2'];
}else{
	$img = '../'.str_replace('s301.','s100.',$row_RecOrderItem['pic']);
}
?>
	<li>
        <p class="order-list-img"><img src="<?php echo $img; ?>"></p>
        <p><?php echo $row_RecOrderItem['d_name']; ?></p>
        <p><span class="red">$<?php 
$subTotal = moneyFormat($row_RecOrderItem['subtotal']);
echo $subTotal;
?></span></p>
        <p>數量：<?php echo $row_RecOrderItem['qty']; ?></p>
    </li>
<?php } while ($row_RecOrderItem = mysql_fetch_assoc($RecOrderItem)); ?>
    
		<!--<li>
			<p class="order-list-img"><img src="images/order-list1.png"></p>
			<p>小罐子點心鋪【金薯C x 10入禮盒】</p>
			<p><span class="red">$400</span></p>
			<p>數量：12</p>
		</li>
		<li>
			<p class="order-list-img"><img src="images/order-list2.png"></p>
			<p>小罐子點心鋪【金薯C x 10入禮盒】</p>
			<p><span class="red">$400</span></p>
			<p>數量：8</p>
		</li>-->
	</ul>

	<div class="float-r">
		<p>小計：$<?php echo $TotalAll = moneyFormat($row_RecOrder['SubTotalAll']); ?></p>
		<p>運費：<?php 
if( $row_RecOrder['tfee'] == 0 ){
	$fr = '免運費';	
}else{
	$fr = '$'.moneyFormat($row_RecOrder['tfee']);
}
/*if($row_RecOrder['SubTotalAll']>=3500){
	$fr = '免運費';
}else{
	$fr = '將由專人電話說明';
}*/
echo $fr;
?></p>
		<p>總計：<span class="red">$<?php echo $grandTotal = moneyFormat($row_RecOrder['GrandTotal']); ?></span></p>
	</div>

	<div class="areatitle h-mt">訂單明細</div>

	<div class="areacontent h-mb">
		<p>訂單填寫日 ： <?php echo sortDate($row_RecOrder['datetime'],'/'); ?></p>
		<p>訂單成立日 : <?php echo sortDate($row_RecOrder['datetime'],'/'); ?></p>
		<p>訂單編號 : <?php echo $row_RecOrder['o_number']; ?></p>
		<p>訂單總金額 : $<?php echo $grandTotal = moneyFormat($row_RecOrder['GrandTotal']); ?></p>
        
        <?php
$r_status = 0;
$inputName = '';
$statusArray = array();

if (!(strcmp(3, $payment))) { //線上刷卡
	
	$statusArray = $statusA_1;
	$inputName = 'card_status';
	
	if($row_RecOrder['card_status']!=3){
		mysql_select_db($database_connect2data, $connect2data);
		$query_RecResponse = "SELECT r_status FROM response_set WHERE r_lidm = '".$row_RecOrder['o_number']."' AND r_o_id = '".$row_RecOrder['o_id']."'";
		$RecResponse = mysql_query($query_RecResponse, $connect2data) or die(mysql_error());
		$row_RecResponse = mysql_fetch_assoc($RecResponse);
		$totalRows_RecResponse = mysql_num_rows($RecResponse);
	
		if($totalRows_RecResponse>0){
			if( (isset($row_RecResponse['r_status'])) && ($row_RecResponse['r_status']==0) ){
				$r_status = 1;
			}elseif( ($row_RecResponse['r_status']>0) ){
				$r_status = 0;
			}elseif( (($row_RecResponse['r_status']==NULL)||($row_RecResponse['r_status']<0)) ){
				$r_status = 2;
			}
		}
	}else{
		$r_status = 3;
	}

}elseif (!(strcmp(2, $payment))) { //貨到付款
	
	$statusArray = $statusA_2;
	$inputName = 'cash_status';
	$r_status = $row_RecOrder['cash_status'];
	
}elseif (!(strcmp(1, $payment))) { //銀行轉帳
	
	$statusArray = $statusA_2;
	$inputName = 'bank_status';
	
	/*if($row_RecOrder['bank_status']!=2){
		if($row_RecOrder['remitter_active']==1){
			$r_status = 1;
		}else{
			$r_status = 0;
		}
	}else{
		$r_status = 2;
	}*/
	$r_status = $row_RecOrder['bank_status'];
	//echo $statusArray[$r_status];
}

?>

<?php
if (!(strcmp(1, $payment))) {
		
	if ($row_RecOrder['remitter_active']==1){
		
		echo '<p>匯款回報狀態 : <span class="red">匯款已回報</span></p>';
		
	}else{
		
		echo '<p>匯款回報狀態 : <span class="red">未回報</span></p><p class="btnstyle"><span><a href="report.php?o_id='.$row_RecOrder['o_id'].'" title="按我回報" >按此匯款回報</a></span></p>';
		//echo "<p>回報狀態 &nbsp; 未回報</p><p class='btnstyle'><span><a href='report.php?o_id=".$row_RecOrder['o_id']."' title='按我回報' >按此匯款回報</a></span></p>";
		//echo "<a href='report.php?o_id=".$row_RecOrder['o_id']."'  title=\"按我回報\">匯款未回報<br>按我回報</a>";
		
	}
	
}/*else{
	echo "無";
}*/
?>

		<!--<p>匯款回報狀態 : <span class="red">未回報</span></p>
		<p class="btnstyle"><span><a href="report.php">按此匯款回報</a></span></p>-->
		<p>匯款帳戶名 :  <?php echo $row_RecOrder['remitter']; ?></p>
		<p>匯款帳後後五碼 :  <?php echo $row_RecOrder['remitter_AC']; ?></p>
		<p>匯款金額 :  <?php echo $row_RecOrder['remitter_money'].'元'; ?></p>
		<p>匯款時間 : <?php echo $row_RecOrder['remitter_time']; ?></p>
		<p>訂單狀態 : <span class="red"><?php 
		foreach ($statusB as $i => $value) {
			if (!(strcmp($i, $row_RecOrder['transport_status']))) {echo $statusB[$i];}
		}
		?></span></p>
		<p>對帳狀態 : <span class="red"><?php
$r_status = 0;
$inputName = '';
$statusArray = array();
if (!(strcmp(3, $payment))) { //線上刷卡
	
	$statusArray = $statusA_1;
	$inputName = 'card_status';
	
	if($row_RecOrder['card_status']!=3){
		mysql_select_db($database_connect2data, $connect2data);
		$query_RecResponse = "SELECT r_status FROM response_set WHERE r_lidm = '".$row_RecOrder['o_number']."' AND r_o_id = '".$row_RecOrder['o_id']."'";
		$RecResponse = mysql_query($query_RecResponse, $connect2data) or die(mysql_error());
		$row_RecResponse = mysql_fetch_assoc($RecResponse);
		$totalRows_RecResponse = mysql_num_rows($RecResponse);
	
		if($totalRows_RecResponse>0){
			if( (isset($row_RecResponse['r_status'])) && ($row_RecResponse['r_status']==0) ){
				$r_status = 1;
			}elseif( ($row_RecResponse['r_status']>0) ){
				$r_status = 0;
			}elseif( (($row_RecResponse['r_status']==NULL)||($row_RecResponse['r_status']<0)) ){
				$r_status = 2;
			}
		}
	}else{
		$r_status = 3;
	}

}elseif (!(strcmp(2, $payment))) { //貨到付款
	
	$statusArray = $statusA_2;
	$inputName = 'cash_status';
	$r_status = $row_RecOrder['cash_status'];
	
}elseif (!(strcmp(1, $payment))) { //銀行轉帳
	
	$statusArray = $statusA_2;
	$inputName = 'bank_status';
	
	/*if($row_RecOrder['bank_status']!=2){
		if($row_RecOrder['remitter_active']==1){
			$r_status = 1;
		}else{
			$r_status = 0;
		}
	}else{
		$r_status = 2;
	}*/
	$r_status = $row_RecOrder['bank_status'];
}
/*echo 'r_status = '.$r_status.'<br>';
echo 'payment = '.$payment.'<br>';
echo 'bank_status = '.$row_RecOrder['bank_status'].'<br>';
echo 'cash_status = '.$row_RecOrder['cash_status'].'<br>';
echo 'remitter_active = '.$row_RecOrder['remitter_active'].'<br>';*/
/*if (!(strcmp(1, $payment))) {
	//if (!(strcmp(1, $row_RecOrder['bank_status'])) && $row_RecOrder['remitter_active']==1){
	if ($row_RecOrder['remitter_active']==1){
		echo "<a href='orders_report_show.php?o_id=".$row_RecOrder['o_id']."'><img src=\"image/accept.png\" width=\"16\" height=\"16\"  >&nbsp;".$statusArray[$r_status]."，匯款已回報，回報資訊</a>";
	}else{
		echo "<a href='orders_report.php?o_id=".$row_RecOrder['o_id']."'  title=\"匯款未回報，按我回報\"><img src=\"image/delete.png\" width=\"16\" height=\"16\"  >&nbsp;".$statusArray[$r_status]."，匯款未回報，按我回報</a>";
	}
}else{
	echo $statusArray[$r_status];
}*/
echo $statusArray[$r_status];
	//echo $r_status.'<br>';
?></span></p>
		<p>備註 : <span class="textarea"><?php echo ($row_RecOrder['notation']!='')? nl2br($row_RecOrder['notation']):'無'; ?></span></p>
	</div>

	<ul class="onechoice">
		<li class="goback"><a href="javascript:;">回上一頁</a></li>
	</ul>

	<?php include 'footer.php'; ?>


</body>
</html>

<script type="text/javascript">

	$(".goback").click(function  () {
		history.go(-1);
	})

</script>

