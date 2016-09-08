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

$_SESSION['REFERER'] = $_SERVER['REQUEST_URI'];

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RecOrder = 15;
$pageNum_RecOrder = 0;
if (isset($_GET['pageNum_RecOrder'])) {
  $pageNum_RecOrder = $_GET['pageNum_RecOrder'];
}
$startRow_RecOrder = $pageNum_RecOrder * $maxRows_RecOrder;

mysql_select_db($database_connect2data, $connect2data);
$query_RecOrder = "SELECT * FROM order_set WHERE m_account='".$_SESSION['MM_UserAccount']."'  ORDER BY `datetime` DESC";
$RecOrder = mysql_query($query_RecOrder, $connect2data) or die(mysql_error());
$row_RecOrder = mysql_fetch_assoc($RecOrder);
$totalRows_RecOrder = mysql_num_rows($RecOrder);

/*if (isset($_GET['totalRows_RecOrder'])) {
  $totalRows_RecOrder = $_GET['totalRows_RecOrder'];
} else {
  $all_RecOrder = mysql_query($query_RecOrder);
  $totalRows_RecOrder = mysql_num_rows($all_RecOrder);
}*/
$all_RecOrder = mysql_query($query_RecOrder);
$totalRows_RecOrder = mysql_num_rows($all_RecOrder);
$totalPages_RecOrder = ceil($totalRows_RecOrder/$maxRows_RecOrder)-1;
$TotalPage = $totalPages_RecOrder;

$queryString_RecOrder = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RecOrder") == false && 
        stristr($param, "totalRows_RecOrder") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecOrder = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecOrder = sprintf("&totalRows_RecOrder=%d%s", $totalRows_RecOrder, $queryString_RecOrder);
?>
<?php 
   $R_pageNum_RecOrder = 0;
 if (isset($_REQUEST["pageNum_RecOrder"])) 
 {
 	$R_pageNum_RecOrder = $_REQUEST["pageNum_RecOrder"];
 }
      if (! isset($R_pageNum_RecOrder)) 
      {
	  	$_SESSION["ToPage"]=0;
	  }
 	  //若指定分頁數小於1則預設顯示第一頁
  	  else if ($R_pageNum_RecOrder<0) 
      {
	  	$_SESSION["ToPage"]=0;
      }
	  //若指定指定的分頁超過總分頁數則顯示最後一頁
 	  else if ($R_pageNum_RecOrder>$totalPages_RecOrder)
      {
	  	$_SESSION["ToPage"]=$TotalPage;
	  }
	  else
	  {
	  	$_SESSION["ToPage"]=$R_pageNum_RecOrder;
 	  }
?>
<?php
	//如果指定的頁面大於資料所擁有的頁面,轉到最大的頁面
	if($R_pageNum_RecOrder>$totalPages_RecOrder && $R_pageNum_RecOrder!=0)
	{
		header("Location:order_look.php?pageNum_RecOrder=".$totalPages_RecOrder);
	}

	
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

	<div class="order-look-wrap">
		<?php include 'logo.php'; ?>

		<div class="area1">
			<?php include 'menu.php'; ?>
		</div><!-- area1 end -->

		<?php 
		$m_now='orderlist';
		include('member_menu.php');
		?>

		
		<div class="area3">

			<ul class="name">
				<li class="sub-item1">訂單編號</li>
				<li class="sub-item2">訂購日期</li>
				<li class="sub-item3">包裏編號</li>
				<li class="sub-item4">訂購金額</li>
				<li class="sub-item5">訂單狀態</li>
				<li class="sub-item6">訂購管理</li>
				<!-- <li class="sub-item7">備註</li> -->
			</ul>
            
<?php if ($totalRows_RecOrder > 0) { // Show if recordset not empty ?>
<?php do { ?>
  
			<ul class="goods">
				<li class="sub-item1"><a href="order_look_detail.php?o_id=<?php echo $row_RecOrder['o_id']; ?>"><?php echo $row_RecOrder['o_number']; ?></a></li>
                
				<li class="sub-item2"><a href="order_look_detail.php?o_id=<?php echo $row_RecOrder['o_id']; ?>"><?php echo sortDate($row_RecOrder['datetime'],'/'); ?></a></li>
                
				<li class="sub-item3"><a href="order_look_detail.php?o_id=<?php echo $row_RecOrder['o_id']; ?>"><?php echo isset($row_RecOrder['TrackingNum'])?$row_RecOrder['TrackingNum']:'暫無'; ?></a></li>
                
				<li class="sub-item4"><a href="order_look_detail.php?o_id=<?php echo $row_RecOrder['o_id']; ?>"><?php echo $grandTotal = '$'.moneyFormat($row_RecOrder['GrandTotal']); ?></a></li>
				<li class="sub-item5 red">
<?php

$payment = $row_RecOrder['payment'];
if (!(strcmp(1, $payment))) {echo "ATM 虛擬帳戶匯款";}
if (!(strcmp(2, $payment))) {echo "超商店到店";}
if (!(strcmp(3, $payment))) {echo "線上刷卡";}

?>

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
	//echo $statusArray[$r_status];
	
if (!(strcmp(1, $payment))) {
	
	if ($row_RecOrder['remitter_active']==1){
		
		//echo "<a href='orders_report_show.php?o_id=".$row_RecOrder['o_id']."' title=\"按我查看回報資訊\">匯款已回報<br>回報資訊</a>";
		echo '匯款已回報';
		
	}else{
		
		echo "<a href='orders_report.php?o_id=".$row_RecOrder['o_id']."'  title=\"按我回報\">匯款未回報<br>按我回報</a>";
		
	}
	
}else{
	echo "無";
}


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

	//echo $r_status.'<br>';
?></li>
				<li class="sub-item6 detail"><a href="order_look_detail.php?o_id=<?php echo $row_RecOrder['o_id']; ?>"><img src="images/order-look-detail.png" height="11" width="9">訂單明細</a></li>
		  </ul>
          
<?php } while ($row_RecOrder = mysql_fetch_assoc($RecOrder)); ?>
<?php } // Show if recordset not empty ?>            
            
		  <!--<ul class="goods">
				<a href="order_look_detail.php"><li class="sub-item1">015123</li></a>
				<a href="order_look_detail.php"><li class="sub-item2">2015/08/01</li></a>
				<a href="order_look_detail.php"><li class="sub-item3">014788</li></a>
				<a href="order_look_detail.php"><li class="sub-item4">$1390</li></a>
				<a href="order_look_detail.php"><li class="sub-item5 red">處理中</li></a>
				<a href="order_look_detail.php"><li class="sub-item6 detail"><img src="images/order-look-detail.png" height="11" width="9">訂單明細</li></a>				
			</ul>-->
		</div><!-- area3 end -->

	</div><!-- order-look-wrap end -->

	<?php include 'backtotop.php'; ?>
	<?php include 'footer.php'; ?>

</body>
</html>
<?php
mysql_free_result($RecOrder);
?>
