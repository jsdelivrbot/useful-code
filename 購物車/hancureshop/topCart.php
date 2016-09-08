<?php
require_once('inc/EDcart.php');
if (!isset($_SESSION)) {
  session_start();
}
//var_dump($_SESSION['edCart']);
$cart =& $_SESSION['edCart']; 
if(!is_object($cart)) $cart = new edCart(); 
?>
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
require_once('js/fun_moneyFormat.php');
?>
<?php require_once('Connections/session.initialize.php'); ?>
<?php $k=0; ?>
<?php if($cart->itemCount > 0) {?>
<?php foreach($cart->get_contents() as $item) { $k=$k+1; ?> 

	<ul class="col1">
		<li><?php if(isset($item['pic'])){ ?>
                <img src="<?php echo $item['pic'].'?'.(mt_rand(1,100000)/100000);?>" width="90" />
                <?php } ?></li>
		<li class="itemTitle">
			<div class="title">項目</div>
			<div class="content"><?php echo urldecode($item['name']);?></div>
		</li>
		<li>
			<div class="title">數量</div>
			<div class="content"><?php echo $item['qty'];?></div>
		</li>
		<li>
			<div class="title before-line">金額</div>
			<div class="content"><?php 
			$subTotal = moneyFormat($item['subtotal']);
			echo '$'.$subTotal;
			?></div>
		</li>
	</ul><!-- ul.col1 end -->

<?php }?>

	<div class="middle-line"></div>

	<ul class="col2">
		<li>小計：<?php 
			$subAllTotal = moneyFormat($cart->total);
			echo '$'.$subAllTotal; 
			?></li>
            <li>運費：<?php 
//$freight = ($cart->grandTotal - $cart->total);
if($cart->total < $cart->freightRating){
	echo '$'.moneyFormat($cart->freightCosts);
}else{
	echo '免運費';
}
?>

</li>
				<li>總計：<span><?php 
		$grandTotal = moneyFormat($cart->grandTotal);
		echo '$'.$grandTotal; 
		?></span></li>
	</ul>

	<div class="col3"><a href="order_list.php"><span>前往結帳</span></a></div>
    
<?php }else{ ?>
<ul class="col1 noItem">
	<li><div class="title">目前您的購物車中無任何產品</div></li>
</ul>
<?php } ?>