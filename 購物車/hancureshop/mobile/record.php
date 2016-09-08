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

$_SESSION['REFERER'] = $_SERVER['REQUEST_URI'];

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RecOrder = 15;
$pageNum = 0;
if (isset($_GET['pageNum'])) {
  $pageNum = $_GET['pageNum'];
}
$startRow_RecOrder = $pageNum * $maxRows_RecOrder;

mysql_select_db($database_connect2data, $connect2data);
$query_RecOrder = "SELECT * FROM order_set WHERE m_account='".$_SESSION['MM_UserAccount']."'  ORDER BY `datetime` DESC";
$query_limit_RecOrder = sprintf("%s LIMIT %d, %d", $query_RecOrder, $startRow_RecOrder, $maxRows_RecOrder);
$RecOrder = mysql_query($query_limit_RecOrder, $connect2data) or die(mysql_error());
$row_RecOrder = mysql_fetch_assoc($RecOrder);
$totalRows = mysql_num_rows($RecOrder);

/*if (isset($_GET['totalRows_RecOrder'])) {
  $totalRows = $_GET['totalRows_RecOrder'];
} else {
  $all_RecOrder = mysql_query($query_RecOrder);
  $totalRows = mysql_num_rows($all_RecOrder);
}*/
$all_RecOrder = mysql_query($query_RecOrder);
$totalRows = mysql_num_rows($all_RecOrder);
$totalPages = ceil($totalRows/$maxRows_RecOrder)-1;

$queryString = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum") == false && 
        stristr($param, "totalRows_RecOrder") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString = sprintf("&totalRows_RecOrder=%d%s", $totalRows, $queryString);
?>
<?php 
   $R_pageNum = 0;
 if (isset($_REQUEST["pageNum"])) 
 {
 	$R_pageNum = $_REQUEST["pageNum"];
 }
      if (! isset($R_pageNum)) 
      {
	  	$_SESSION["ToPage"]=0;
	  }
 	  //若指定分頁數小於1則預設顯示第一頁
  	  else if ($R_pageNum<0) 
      {
	  	$_SESSION["ToPage"]=0;
      }
	  //若指定指定的分頁超過總分頁數則顯示最後一頁
 	  else if ($R_pageNum>$totalPages)
      {
	  	$_SESSION["ToPage"]=$TotalPage;
	  }
	  else
	  {
	  	$_SESSION["ToPage"]=$R_pageNum;
 	  }
?>
<?php
	//如果指定的頁面大於資料所擁有的頁面,轉到最大的頁面
	if($R_pageNum>$totalPages && $R_pageNum!=0)
	{
		header("Location:record.php?pageNum=".$totalPages);
	}

	
?>
<?php require_once('../Connections/session.initialize.php'); ?>
<?php require_once('../orders_statusA.php'); ?>
<?php require_once('../js/fun_moneyFormat.php'); ?>
<?php require_once('../js/fun_changeStr.php'); ?>
<?php require_once('display_page_record.php'); ?>
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
		.h-bb{
			border-bottom: 1px solid #ad9f82;
			padding-bottom: 15px;
		}
		.h-mt{
			margin-top: 15px;
		}
		ul.h-mb{
			margin-bottom: 60px;
		}
		.btnstyle{
			margin-bottom: 0;
		}
	</style>

</head>
<body>

	<?php include 'topmenu-fixed.php'; ?>

	<div class="fortopmenupush"></div>

	<div class="bigtitle">訂單查詢</div>

	<div class="areatitle">訂單資訊</div>
    
<?php if ($totalRows > 0) { // Show if recordset not empty ?>
<?php $i=1; ?>
<?php do { ?>
    <div class="areacontent h-bb <?php echo ($i!=1)?'h-mt':''; ?>">
        <p>訂單編號 &nbsp; <?php echo $row_RecOrder['o_number']; ?></p>
        <p>訂單日期 &nbsp; <?php echo sortDate($row_RecOrder['datetime'],'/'); ?></p>
        <p>包裹編號 &nbsp; <?php echo isset($row_RecOrder['TrackingNum'])?$row_RecOrder['TrackingNum']:'暫無'; ?></p>
        <p>訂購金額 &nbsp; <?php echo $grandTotal = '$'.moneyFormat($row_RecOrder['GrandTotal']); ?></p>
        <p>付款方式 &nbsp; <?php

$payment = $row_RecOrder['payment'];
if (!(strcmp(1, $payment))) {echo "銀行轉帳<br>";}
if (!(strcmp(2, $payment))) {echo "貨到付款";}
?></p>
        <p>訂單狀態 &nbsp; <span class="red">
        
        <?php 
		foreach ($statusB as $i => $value) {
			if (!(strcmp($i, $row_RecOrder['transport_status']))) {echo $statusB[$i];}
		}
		?>        
        </span></p>
        <p>訂單詳細 &nbsp; <a href="order_detail.php?o_id=<?php echo $row_RecOrder['o_id']; ?>"><img src="images/record.png" width="14" class="recordpng"></a></p>
        
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
		
		echo '<p>回報狀態 &nbsp; 匯款已回報</p>';
		
	}else{
		
		echo "<p>回報狀態 &nbsp; 未回報</p><p class='btnstyle'><span><a href='report.php?o_id=".$row_RecOrder['o_id']."' title='按我回報' >按此匯款回報</a></span></p>";
		//echo "<a href='report.php?o_id=".$row_RecOrder['o_id']."'  title=\"按我回報\">匯款未回報<br>按我回報</a>";
		
	}
	
}/*else{
	echo "無";
}*/
?>

        
        
        
        <!--<p class="btnstyle"><span><a href="report.php">按此匯款回報</a></span></p>-->
    </div>
<?php $i++; ?>
<?php } while ($row_RecOrder = mysql_fetch_assoc($RecOrder)); ?>
<?php } // Show if recordset not empty ?>       
    
	<!--<div class="areacontent h-bb">
		<p>訂單編號 &nbsp; 2015090719425949</p>
		<p>訂單日期 &nbsp; 2015/09/07</p>
		<p>包裹編號 &nbsp; 19425949</p>
		<p>訂購金額 &nbsp; 6000元</p>
		<p>訂單狀態 &nbsp; <span class="red">等待匯款</span></p>
		<p>訂單詳細 &nbsp; <a href="order_detail.php"><img src="images/record.png" width="14" class="recordpng"></a></p>
		<p>付款方式 &nbsp; 銀行轉帳</p>
		<p>回報狀態 &nbsp; 未回報</p>
		<p class="btnstyle"><span><a href="report.php">按此匯款回報</a></span></p>
	</div>

	<div class="areacontent h-bb h-mt">
		<p>訂單編號 &nbsp; 2015090719425949</p>
		<p>訂單日期 &nbsp; 2015/09/07</p>
		<p>包裹編號 &nbsp; 19425949</p>
		<p>訂購金額 &nbsp; 6000元</p>
		<p>訂單狀態 &nbsp; <span class="red">等待匯款</span></p>
		<p>訂單詳細 &nbsp; <a href="order_detail.php"><img src="images/record.png" width="14" class="recordpng"></a></p>
		<p>付款方式 &nbsp; 銀行轉帳</p>
		<p>回報狀態 &nbsp; 未回報</p>
		<p class="btnstyle"><span><a href="report.php">按此匯款回報</a></span></p>
	</div>

	<div class="areacontent h-bb h-mt">
		<p>訂單編號 &nbsp; 2015090719425949</p>
		<p>訂單日期 &nbsp; 2015/09/07</p>
		<p>包裹編號 &nbsp; 19425949</p>
		<p>訂購金額 &nbsp; 6000元</p>
		<p>訂單狀態 &nbsp; <span class="red">已匯款</span></p>
		<p>訂單詳細 &nbsp; <a href="order_detail.php"><img src="images/record.png" width="14" class="recordpng"></a></p>
		<p>付款方式 &nbsp; 銀行轉帳</p>
		<p>回報狀態 &nbsp; 已回報</p>
	</div>

	<div class="areacontent h-bb h-mt">
		<p>訂單編號 &nbsp; 2015090719425949</p>
		<p>訂單日期 &nbsp; 2015/09/07</p>
		<p>包裹編號 &nbsp; 19425949</p>
		<p>訂購金額 &nbsp; 6000元</p>
		<p>訂單狀態 &nbsp; <span class="red">已匯款</span></p>
		<p>訂單詳細 &nbsp; <a href="order_detail.php"><img src="images/record.png" width="14" class="recordpng"></a></p>
		<p>付款方式 &nbsp; 銀行轉帳</p>
		<p>回報狀態 &nbsp; 已回報</p>
	</div>-->

	<!--<ul class="pager h-mt h-mb">
		<li>1</li>
		<li class="current">2</li>
		<li>3</li>
	</ul>-->
    
<?php
//顯示頁選擇與分頁設定開始
displayPages($pageNum, $queryString, $totalPages, $totalRows, $currentPage);
//顯示頁選擇與分頁設定結束
?> 

	<?php include 'footer.php'; ?>


</body>
</html>


