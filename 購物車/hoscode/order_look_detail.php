<?php
require_once('inc/EDcart.php');
if (!isset($_SESSION)) {
  session_start();
}

$cart =& $_SESSION['edCart']; 
if(!is_object($cart)) $cart = new edCart(); 
//echo "item = ".$cart->itemCount;
?>
<?php require_once('logout_action.php'); ?>
<?php require_once('member_limit.php'); ?>
<?php require_once('mobileCheck.php'); ?>
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
	header("Location:order_look.php");	
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
/*if (!(strcmp(1, $payment))) {echo "ATM 虛擬帳戶匯款<br>";}
if (!(strcmp(2, $payment))) {echo "超商店到店";}*/
?>
<?php require_once('Connections/session.initialize.php'); ?>
<?php require_once('orders_statusA.php'); ?>
<?php require_once('js/fun_moneyFormat.php'); ?>
<?php require_once('js/fun_changeStr.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>C+H</title>

<!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->

<link rel="shortcut icon" href="img/fav.png" type="image/x-icon">
<!-- <link rel="apple-touch-icon" href="img/fav.png">
<link rel="apple-touch-icon" sizes="76x76" href="img/fav.png">
<link rel="apple-touch-icon" sizes="120x120" href="img/fav.png">
<link rel="apple-touch-icon" sizes="152x152" href="img/fav.png"> -->
<?php include('meta.php') ?>

<script src="js/jquery/1.11.1/jquery.min.js"></script>

<link rel="stylesheet/less" type="text/css" href="style_ryder.less">
<script src="js/less-1.3.0.min.js" type="text/javascript"></script>

<?php require_once('ga.php'); ?>

</head>
<body>
	<?php $now="member"; ?>
	<?php include('topmenu.php'); ?>

	<div class="order-look-detail-wrap">
		<?php include 'logo.php'; ?>

		<div class="area1">
			<?php include 'menu.php'; ?>
		</div><!-- area1 end -->

		<?php 
		$m_now='orderlist';
		include('member_menu.php');
		?>


		<ul class="area3">
			<li>
				<div class="left">訂單明細</div>
				<div class="right">
					<p>訂單填寫日：<?php echo sortDate($row_RecOrder['datetime'],'/'); ?></p>
					<p>訂單成立日：<?php echo sortDate($row_RecOrder['datetime'],'/'); ?></p>
					<p>訂單編號：<?php echo $row_RecOrder['o_number']; ?></p>
                    <p>匯款帳戶名：<?php echo $row_RecOrder['remitter']; ?></p>
                    <p>匯款帳號後五碼：<?php echo $row_RecOrder['remitter_AC']; ?></p>
                    <p>匯款金額：<?php echo $row_RecOrder['remitter_money'].'元'; ?></p>
                    <p>匯款時間：<?php echo $row_RecOrder['remitter_time']; ?></p>
					<p>
						訂單狀態：<span><?php 
		foreach ($statusB as $i => $value) {
			if (!(strcmp($i, $row_RecOrder['transport_status']))) {echo $statusB[$i];}
		}
		?></span>
					</p>
					<p>
						對帳狀態：<span><?php
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

}elseif (!(strcmp(2, $payment))) { //超商店到店
	
	$statusArray = $statusA_2;
	$inputName = 'cash_status';
	$r_status = $row_RecOrder['cash_status'];
	
}elseif (!(strcmp(1, $payment))) { //ATM 虛擬帳戶匯款
	
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
?></span>
					</p>
					<!--<p>運送方式：宅配</p>-->
					<p>備註：<?php echo ($row_RecOrder['notation']!='')? nl2br($row_RecOrder['notation']):'無'; ?></p>
				</div>
			</li>
			<li id="push" class="clearfix"></li>
			<li>
				<div class="left">總金額</div>
				<div class="money">$<?php echo $grandTotal = moneyFormat($row_RecOrder['GrandTotal']); ?></div>
			</li>
		</ul><!-- area3 end -->

		<div class="area4 clearfix"> <!-- 商品清單 -->
			<div class="step">訂單資訊</div>

			<ul class="name">
				<li class="sub-item3">商品名稱</li>
				<!--<li class="sub-item1">商品編號</li>-->
				<li class="sub-item2"></li>
				<li class="sub-item4">數量</li>
				<li class="sub-item5">單價</li>
				<li class="sub-item6">總金額</li>
				<li class="sub-item7">訂單日期</li>
				<li class="sub-item8">寄送日期</li>
				
			</ul>
            
            
<?php do{ ?>
<ul class="goods">
    <li class="sub-item3"><?php echo $row_RecOrderItem['d_name']; ?></li>
    <!--<li class="sub-item1">115320</li>-->
    <li class="sub-item2"><img src="<?php echo $row_RecOrderItem['pic']; ?>" width="141"></li>
    <li class="sub-item4"><span><?php echo $row_RecOrderItem['qty']; ?></span></li>
    <li class="sub-item5">$<?php 
$subTotal = moneyFormat($row_RecOrderItem['subtotal']);
echo $subTotal;
?></li>
    <li class="sub-item6">$<?php echo moneyFormat(round( $row_RecOrderItem['d_price1']));?></li>
    <li class="sub-item7"><?php echo sortDate($row_RecOrder['datetime'],'/'); ?></li>
    <li class="sub-item8">處理中</li>    
</ul>
<?php } while ($row_RecOrderItem = mysql_fetch_assoc($RecOrderItem)); ?>

			<!--<ul class="goods">
				<li class="sub-item1">115320</li>
				<li class="sub-item2"><img src="images/order-list.png"></li>
				<li class="sub-item3">番仔挖烏魚子 - 五兩一片</li>
				<li class="sub-item4"><span>500</span></li>
				<li class="sub-item5">$1390</li>
				<li class="sub-item6">$1390</li>
				<li class="sub-item7">2015/08/01</li>
				<li class="sub-item8">處理中</li>
				
			</ul>
            
			<ul class="goods">
				<li class="sub-item1">115320</li>
				<li class="sub-item2"><img src="images/order-list.png"></li>
				<li class="sub-item3">番仔挖烏魚子 - 五兩一片</li>
				<li class="sub-item4"><span>500</span></li>
				<li class="sub-item5">$1390</li>
				<li class="sub-item6">$1390</li>
				<li class="sub-item7">2015/08/01</li>
				<li class="sub-item8">處理中</li>
				
			</ul>-->
            
			<div class="step" style="margin-top:15px;">
			備註

			<p class="ps_content">
				<?php echo ($row_RecOrder['notation']!='')? nl2br($row_RecOrder['notation']):'無'; ?>
			</p>
			</div>

		</div><!-- area4 end -->

	</div><!-- order-look-detail-wrap end -->

	<?php include 'backtotop.php'; ?>
	<?php include 'footer.php'; ?>

</body>
</html>

