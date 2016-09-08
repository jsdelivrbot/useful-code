<?php
require_once('inc/EDcart.php');
if (!isset($_SESSION)) {
  session_start();
}
//var_dump($_SESSION['edCart']);
$cart =& $_SESSION['edCart']; 
if(!is_object($cart)) $cart = new edCart(); 
//echo "item = ".$cart->itemCount;
//$cart->empty_cart();
//var_dump($cart);
//unset($_SESSION['edCart']);

//require_once('logout_action.php');
//require_once('member_limit.php');

//購物車為空時重新導向指定頁
if ($cart->itemCount == 0){
	//echo "empty";
	//header("Location: cartBasketEmpty.php?errmsg=".urlencode(＊＊目前您的購物車中無任何產品＊＊));
	/*echo "<script>window.location=cartBasketEmpty.php?errmsg=".urlencode("＊＊目前您的購物車中無任何產品＊＊")."</script>";*/
	
	header("Location:cartBasketEmpty.php");
    /*echo "<script>
			window.location = 'cartBasketEmpty.php';
		</script>";*/
}
?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$colname_RecMember = "-1";
if (isset($_SESSION['MM_UserAccount'])) {
  $colname_RecMember = $_SESSION['MM_UserAccount'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecMember = sprintf("SELECT * FROM member_set WHERE m_account = %s", GetSQLValueString($colname_RecMember, "text"));
$RecMember = mysql_query($query_RecMember, $connect2data) or die(mysql_error());
$row_RecMember = mysql_fetch_assoc($RecMember);
$totalRows_RecMember = mysql_num_rows($RecMember);

mysql_select_db($database_connect2data, $connect2data);
$query_RecMemberRule = "SELECT * FROM data_set WHERE d_class1 = 'member_rule' ORDER BY d_sort ASC";
$RecMemberRule = mysql_query($query_RecMemberRule, $connect2data) or die(mysql_error());
$row_RecMemberRule = mysql_fetch_assoc($RecMemberRule);
$totalRows_RecMemberRule = mysql_num_rows($RecMemberRule);

mysql_select_db($database_connect2data, $connect2data);
$query_Freight = "SELECT d_price1, d_price2 FROM data_set WHERE d_class1='freight'";
$Freight = mysql_query($query_Freight, $connect2data) or die(mysql_error());
$row_Freight = mysql_fetch_assoc($Freight);
$totalRows_Freight = mysql_num_rows($Freight);


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "buyFormular") && (isset($_POST["MM_submit"])) && ($_POST["MM_submit"] == "1")) {
	
	$zipcode = checkV("zipcode");
	$r_zipcode = checkV("r_zipcode");
	
	//$addressAll = $_POST['county'].$_POST['district'].$_POST['c_address'];
  //$r_addressAll = $_POST['r_county'].$_POST['r_district'].$_POST['r_address'];

  $addressAll = $_POST['country'].' '.$_POST['c_address'];
  $r_addressAll = $_POST['r_country'].' '.$_POST['r_address'];


	//$in_addressAll = $_POST['in_county'].$_POST['in_district'].$_POST['inadd'];
	
if (0 && $totalRows_RecMember == 0 && ( isset($_POST['addMember']) && $_POST['addMember']=='1') ) {

  $birthday = $_POST['m_birthday'];
  $y = substr($birthday, 0, 4);
  $m = substr($birthday, 5, 2);
  $d = substr($birthday, 8, 2);

	$insertSQL = sprintf("INSERT INTO member_set (m_name, m_account, m_password, m_gender, m_birthyear, m_birthmonth, m_birthday, m_email, m_phone, m_zip, m_city, m_canton, m_address, m_active, m_date) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, NOW())",
                      GetSQLValueString($_POST['client'], "text"),
                      GetSQLValueString($_POST['m_account'], "text"),
                      GetSQLValueString(md5($_POST['m_password']), "text"),
                      GetSQLValueString($_POST['c_gender'], "text"),
                      GetSQLValueString($y, "text"),
                      GetSQLValueString($m, "text"),
                      GetSQLValueString($d, "text"),
                      GetSQLValueString($_POST['m_account'], "text"),
                      GetSQLValueString($_POST['cellphone'], "text"),
                      GetSQLValueString($_POST['zipcode'], "int"),
                      GetSQLValueString($_POST['county'], "text"),
                      GetSQLValueString($_POST['district'], "text"),
                      GetSQLValueString($_POST['c_address'], "text"),  
                      GetSQLValueString('1', "text"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());

  //取得最新的會員ID編號========================================================
  $_SESSION['max_id'] = mysql_insert_id();  //將編號存變數值中

  $m_id = $_SESSION['m_id'] = $_SESSION['max_id'];//將編號存變數值中  
   
  //取得最新的會員ID編號========================================================
  mysql_select_db($database_connect2data, $connect2data);
  $query_GetId = "SELECT m_account FROM member_set WHERE m_id='".$_SESSION['m_id']."'";
  $RecGetId = mysql_query($query_GetId, $connect2data) or die(mysql_error());
  $row_RecGetId = mysql_fetch_assoc($RecGetId);
  // 關閉繫結的資料集
   mysql_free_result($RecGetId);

  $m_account = $_SESSION['m_account'] = $row_RecGetId['m_account'];
  $_SESSION['ma'] = 'add';
  $m_account = NULL;
 
}else{
	$m_id = $_SESSION['m_id'] = $row_RecMember['m_id'];
	$m_account = $_SESSION['m_account'] = $row_RecMember['m_account'];
	$_SESSION['ma'] = 'none';
}

$client         = checkV("client");
$c_gender       = checkV("c_gender");
$phone          = checkV("phone");
$cellphone      = checkV("cellphone");
$m_account      = checkV("m_account");
$country_code   = checkV("country_code");
$r_client       = checkV("r_client");
$r_gender       = checkV("r_gender");
$r_phone        = checkV("r_phone");
$r_cellphone    = checkV("r_cellphone");
$r_email        = checkV("r_email");
$r_country_code = checkV("r_country_code");
$delivery       = checkV("delivery");
$transport      = checkV("transport");
$payment        = checkV("payment");
$invoice        = checkV("invoice");
$insn           = checkV("insn");
$inname         = checkV("inname");
$in_zipcode     = checkV("in_zipcode");
$in_phone       = checkV("in_phone");
$notation       = checkV("notation");
$tfee           = checkV("tfee");
$SubTotalAll    = checkV("SubTotalAll");
$GrandTotal     = checkV("GrandTotal");
$datetime       = checkV("datetime");
$RID            = checkV("RID");
	
  $insertSQL = sprintf("INSERT INTO order_set (client, c_gender, phone, cellphone, email, country_code, address, zipcode, r_client, r_gender, r_phone, r_cellphone, r_email, r_country_code, r_zipcode, r_address, delivery, transport, payment, invoice, insn, inname, in_zipcode, inadd, in_phone, notation, tfee, SubTotalAll, GrandTotal, m_id, m_account, datetime, RID) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($client, "text"),
                       GetSQLValueString($c_gender, "int"),
                       GetSQLValueString($phone, "text"),
                       GetSQLValueString($cellphone, "text"),
                       GetSQLValueString($m_account, "text"),
                       GetSQLValueString($country_code, "text"),
                       GetSQLValueString($addressAll, "text"),
                       GetSQLValueString($zipcode, "text"),
                       GetSQLValueString($r_client, "text"),
                       GetSQLValueString($r_gender, "int"),
                       GetSQLValueString($r_phone, "text"),
                       GetSQLValueString($r_cellphone, "text"),
                       GetSQLValueString($r_email, "text"),
                       GetSQLValueString($r_country_code, "text"),
                       GetSQLValueString($r_zipcode, "text"),
                       GetSQLValueString($r_addressAll, "text"),
                       GetSQLValueString($delivery, "int"),
                       GetSQLValueString($transport, "int"),
                       GetSQLValueString($payment, "int"),
                       GetSQLValueString($invoice, "int"),
                       GetSQLValueString($insn, "text"),
                       GetSQLValueString($inname, "text"),
                       GetSQLValueString($in_zipcode, "text"),
                       GetSQLValueString($in_addressAll, "text"),
                       GetSQLValueString($in_phone, "text"),
                       GetSQLValueString($notation, "text"),
                       GetSQLValueString($tfee, "int"),
                       GetSQLValueString($SubTotalAll, "int"),
                       GetSQLValueString($GrandTotal, "int"),
                       GetSQLValueString($m_id, "int"),
                       GetSQLValueString($m_account, "text"),
                       GetSQLValueString($datetime, "date"),
                       GetSQLValueString($RID, "text"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
  
  
  //echo 'insertSQL = '.$insertSQL.'<br>';
  
  // 取得最新的id值  
  $oid = mysql_insert_id();  
  $_SESSION['o_id'] = $oid; 
  
  mysql_select_db($database_connect2data, $connect2data);
  //$query_RecGetTodayOrder = "SELECT * FROM order_set WHERE TO_DAYS( NOW( ) ) - TO_DAYS(  `datetime` ) = 0";
  $query_RecGetTodayOrder = "SELECT * FROM order_set WHERE DATEDIFF( NOW( ) ,  `datetime` ) = 0";
  $RecGetTodayOrder = mysql_query($query_RecGetTodayOrder,$connect2data) or die(mysql_error());
  $row_RecGetTodayOrder = mysql_fetch_assoc($RecGetTodayOrder);
  $totalRows_RecGetTodayOrder = mysql_num_rows($RecGetTodayOrder);
  
  //echo 'totalRows_RecGetTodayOrder = '.$totalRows_RecGetTodayOrder.'<br>';
  
  $tmp_num = sprintf("%05d", $totalRows_RecGetTodayOrder);
  
  //echo 'tmp_num = '.$tmp_num.'<br>';
  
  $o_number = 'CHS'.date('ymd').$tmp_num;
  $_SESSION['o_num'] = $o_number;
  //echo 'o_number = '.$o_number.'<br>';
  
  $updateSQL = sprintf("UPDATE order_set SET o_number=%s WHERE o_id=%s",
                       GetSQLValueString($o_number, "text"),
                       GetSQLValueString($_SESSION['o_id'], "int"));
  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
  
  if($_POST['payment']==3){
  $order_data = date("Y-m-d H:i:s");
  $insertSQL = sprintf("INSERT INTO response_set (r_o_id, r_lidm, r_order_date) VALUES (%s, %s, %s)",
                       GetSQLValueString($_SESSION['o_id'], "int"),
                       GetSQLValueString($o_number, "text"),
                       GetSQLValueString($order_data, "date"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
  } 


//將購物車的詳細內容一筆筆寫入資料表
  if($cart->itemCount > 0) {
    	foreach($cart->get_contents() as $item) {
	  	$insertSQL = sprintf("INSERT INTO order_item (o_id, d_id, d_class, d_name, serial_num, qty, d_price1, d_price2, d_price3, d_sale, unit, perUnit, price_status, pic, pic2, d_new_p, subtotal) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
  	                    GetSQLValueString($_SESSION['o_id'], "int"),
        	              GetSQLValueString($item['id'], "int"),
          						  GetSQLValueString($item['class'], "text"),
          						  GetSQLValueString($item['name'], "text"),
          						  GetSQLValueString($item['sn'], "text"),
                	      GetSQLValueString($item['qty'], "int"),
          						  GetSQLValueString($item['d_price1'], "int"),
          						  GetSQLValueString($item['d_price2'], "int"),
          						  GetSQLValueString($item['d_price3'], "int"),
          						  GetSQLValueString($item['d_sale'], "int"),
          						  GetSQLValueString($item['unit'], "text"),
          						  GetSQLValueString($item['perUnit'], "int"),
          						  GetSQLValueString($item['priceStatus'], "text"),
          						  GetSQLValueString($item['pic'], "text"),
          						  GetSQLValueString($item['pic2'], "text"),
                	      GetSQLValueString($item['d_new_p'], "int"),
                	      GetSQLValueString($item['subtotal'], "int")); 
		mysql_select_db($database_connect2data, $connect2data);
		$Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error()); 
		}
  }
  
  //echo 'before empty_cart<br>';

  //echo "session mid1 = ".$_SESSION['m_id'].'<br>';

  $cart->empty_cart();

  if($_POST['payment']=='3'){ //線上刷卡

    $insertGoTo = "CreateOrderSDK.php";

  }else{

    $insertGoTo = "cartFinish.php";
    if (isset($_SERVER['QUERY_STRING'])) {
      $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
      $insertGoTo .= $_SERVER['QUERY_STRING'];
    }

  }

  //echo "session mid2 = ".$_SESSION['m_id'].'<br>';
  //echo "session ma = ".$_SESSION['ma'].'<br>';

  //echo 'after empty_cart<br>';
  
 // $insertGoTo = "cartCheckout.php";
  /*$insertGoTo = "cartFinish.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $insertGoTo));
}



//echo 'prulink = '.$_SESSION['prulink'];
$s1 = (isset($_GET['s1']) ? $_GET['s1'] : "");
$s2 = (isset($_GET['s2']) ? $_GET['s2'] : "");
$s3 = (isset($_GET['s3']) ? $_GET['s3'] : "");
$s4 = (isset($_GET['s4']) ? $_GET['s4'] : "");

//$updateAction = "inc/addtocart.php?s1=$s1&s2=$s2&s3=$s3&s4=$s4";
//$updateAction = "inc/functions.php?action=Update";
$updateAction = "inc/functions.php";
//updateToBasket($productID, $cart, $sessionID, $noJavaScript, $qty);
$addLink = 	"s1=".$s1."&s2=".$s2."&s3=".$s3."&s4=".$s4;

require_once('js/fun_moneyFormat.php');
?>
<?php require_once('Connections/session.initialize.php'); ?>
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

<script src="js/jquery.scrollTo.js"></script>

<script src="js/jquery.form.js"></script>
<script src="flashJson/jquery-validation-1.14.0/dist/jquery.validate.js"></script>
<!-- <script src="js/jquery.twzipcode.min.js"></script> -->
<link rel="stylesheet" href="js/country-select/build/css/countrySelect.min.css">

<?php if (0 && $totalRows_RecMember == 0) { ?>
<script src="js/bootstrap.js"></script>
<link rel="stylesheet" href="js/bootstrap-datepicker/css/datepicker3.css">
<script src="js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!-- Add fancyBox -->
<link rel="stylesheet" href="js/fancyapps/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="js/fancyapps/source/jquery.fancybox.pack.js?v=2.1.5"></script>
<!-- Optionally add helpers - button, thumbnail and/or media -->
<link rel="stylesheet" href="js/fancyapps/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<script type="text/javascript" src="js/fancyapps/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="js/fancyapps/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

<link rel="stylesheet" href="js/fancyapps/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
<script type="text/javascript" src="js/fancyapps/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
<?php } ?>




<link rel="stylesheet/less" type="text/css" href="style_ryder.less">
<script src="js/less-1.3.0.min.js" type="text/javascript"></script>

<style type="text/css">
  .item11.fancybox label.error{
    margin-left: 52px;
  }
  .order-list-wrap .area6 .right .info li.item11.fancybox{
    margin-left: 94px;
    margin-top: 5px;
  }
  #buyFormular li.item11.fancybox label.error{
    margin-left: 4px;
  }
  li.fancybox input, li.fancybox label.fancybox{
    cursor: pointer;
  }
</style>

<?php require_once('ga.php'); ?>
</head>
<body>
	<?php $now="member"; ?>
	<?php include('topmenu.php'); ?>

	<div class="order-list-wrap">
		<?php include 'logo.php'; ?>

		<div class="area1">
			<?php include 'menu.php'; ?>
		</div><!-- area1 end -->

		<?php 
		$m_now='buylist';
		include('member_menu.php');
		?>

		<div class="area3"  id="List"><img src="img/order-top.png"></div><!-- area3 end -->

		<div class="area4"> <!-- 商品清單 -->
        
        <form action="<?php echo $updateAction; ?>" method="post" enctype="multipart/form-data" name="formular" id="formular" class="formular">
        
			<div class="step">商品清單</div>

			<ul class="name">
				<li class="sub-item1 item">編號</li>
				<li class="sub-item2 item">商品縮圖</li>
				<li class="sub-item3 item">商品名稱</li>
				<li class="sub-item4 item">數量</li>
				<li class="sub-item5 item">單價</li>
				<!-- <li class="sub-item6">小計</li> -->
				<li class="sub-item7 item">刪除</li>
			</ul>
            
            
            <?php $k=0; ?>
<?php if($cart->itemCount > 0) {?>
<?php foreach($cart->get_contents() as $item) { $k=$k+1; ?> 
<ul class="goods" id="L<?php echo $item['id'];?>">
				<li class="sub-item1"><?php echo $k; ?></li>
				<li class="sub-item2"><?php if(isset($item['pic'])){ ?>
                <img src="<?php echo $item['pic'].'?'.(mt_rand(1,100000)/100000);?>" alt=""  class="image_frame" width="141" />
                <?php } ?></li>
				<li class="sub-item3"><?php echo urldecode($item['name']);?></li>
				<li class="sub-item4">
                
                <select name="qty[]" id="qty">				
				<?php 
				
				
                if(intval($item['qtyLimit'])>0){
                    for($i=1; $i<=intval($item['qtyLimit']); $i++){
                        echo "<option value='$i' ";
						if (!(strcmp($i, $item['qty']))) {
							echo "selected=\"selected\"";
						}
						echo ">$i</option>";
                    }
                }else{
                    echo "<option value='0'>0</option>";
                }
                ?>
                </select>
                    
                    <!--<input name="qty[]" type="text" id="quanity" value="<?php echo $item['qty'];?>" size="3"/>-->
            <input name="action" type="hidden" id="action" value="Update" />
            <input name="itemcount" type="hidden" id="itemcount2" value="<?php echo $cart->itemCount;?>" />
				</li>
				<li class="sub-item5"><?php 
echo ($item['d_price1']!=0) ? '$'.moneyFormat(round( $item['d_price1'])) : '無';
?></li>
				<!-- <li class="sub-item6">$1390</li> -->
				<li class="sub-item7">
                <a href="inc/functions.php?action=deleteFromBasket&productID=<?php echo $item['id'];?>" title="刪除商品">
                <img src="images/order-x.png"  width="20">
                </a>
                <input name="productID[]" type="hidden" id="productID[]" value="<?php echo $item['id'];?>" /></li>
			</ul>

<?php } } ?>
            

			<!--<ul class="goods">
				<li class="sub-item1">1</li>
				<li class="sub-item2"><img src="images/order-list.png"></li>
				<li class="sub-item3">番仔挖烏魚子 - 五兩一片</li>
				<li class="sub-item4">
					<select id="select">
						<option>999</option>
						<option>1</option>
					</select>
				</li>
				<li class="sub-item5">$1390</li>
				<li class="sub-item7"><img src="images/order-x.png"  width="20"></li>
			</ul>
			<ul class="goods">
				<li class="sub-item1">2</li>
				<li class="sub-item2"><img src="images/order-list.png"></li>
				<li class="sub-item3">番仔挖烏魚子 - 五兩一片</li>
				<li class="sub-item4">
					<select id="select">
						<option>999</option>
						<option>1</option>
					</select>
				</li>
				<li class="sub-item5">$1390</li>
				<li class="sub-item7"><img src="images/order-x.png" width="20"></li>
			</ul>-->

			<ul class="total">
				<li>小計：<?php 
			$subAllTotal = moneyFormat($cart->total);
			echo '$'.$subAllTotal; 
			?></li>
            <li>運費：<?php
//echo 'total = '.$cart->total.'<br>';
//echo 'freightRating = '.$cart->freightRating.'<br>';
$freight = ($cart->grandTotal - $cart->total);
if($cart->total < $cart->freightRating){
  echo '$'.moneyFormat($cart->freightCosts);
}else{
  echo '免運費';
}

//echo '<br>$cart->freightCosts = '.$cart->freightCosts;
?></li>
				<li>總計：<span><?php 
		$grandTotal = moneyFormat($cart->grandTotal);
		echo '$'.$grandTotal; 
		?></span></li>
				<li class="next" id="nextstep">下一步</li>
			</ul>
            
         </form>
            
		</div><!-- area4 end -->

		<div class="area5"> <!-- 運送方式 -->
			<div class="step">運送方式</div>

			<ul>
      <?php 
        $price1 = ($row_Freight['d_price1']!='') ? $row_Freight['d_price1'] : '3000';
        $price1 = moneyFormat($price1);
      ?>
				<li class="left">運費計算與優惠辦法</li>
				<li class="right">購物未滿 NT<?php echo $price1;?> 元，單筆訂單運費 NT<?php echo ($row_Freight['d_price2']!='')?$row_Freight['d_price2']:'60';?> 元（限單一定點）
        <br>購物滿 NT<?php echo $price1;?> 元免運費（限單一定點）</li>
			</ul>
		</div><!-- area5 end -->


<form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="buyFormular" id="buyFormular" >

		<div class="area6"> <!-- 填寫資料 -->
			<div class="step">填寫資料</div>

			<ul class="ul-1">
				<li class="left">填寫訂購人聯絡方式</li>
				<li class="right">
					<ul class="info">

            <?php if (0 && $totalRows_RecMember == 0) { ?>
            <li class="item12"><span>加入會員</span>
              <input name="addMember" type="radio" id="addMember_0" value="0" >
              <label for="addMember_0">否</label>
              <input name="addMember" type="radio" id="addMember_1" value="1" checked="CHECKED" >
              <label for="addMember_1">是</label>
              <label for="addMember" class="error def-err"></label>
            </li>
            <?php } ?>

						<li class="item3"><span>姓名</span>
              <input name="client" type="text" id="client" value="<?php if (isset($row_RecMember['m_name'])){ echo $row_RecMember['m_name'];} ?>" class="textcss" placeholder=""/>
            </li>
                      
            <?php if(0){ ?>
            <li class="item4"><span>性別</span>
  					 	<input name="c_gender" type="radio" id="c_gender1" value="1" <?php if (isset($row_RecMember['m_gender'])){if ($row_RecMember['m_gender']==1) {echo "checked=\"checked\"";}} ?>>
  					 	<label for="c_gender1">男</label>
  					 	<input name="c_gender" type="radio" id="c_gender0" value="0" <?php if (isset($row_RecMember['m_gender'])){if ($row_RecMember['m_gender']==0) {echo "checked=\"checked\"";}}else{echo "checked=\"checked\"";} ?>>
  					 	<label for="c_gender0">女</label>
              <label for="c_gender" class="error def-err"></label>
				    </li>
            <?php } ?>
                        
					  <li class="item6"><span>電話</span>
              <input name="cellphone" type="text" id="cellphone" value="<?php if (isset($row_RecMember['m_phone'])){ echo $row_RecMember['m_phone'];} ?>" class="textcss" />
            </li>
                        
						<li class="item5"><span>電子郵件</span>
						  <input name="m_account" type="text" id="m_account" value="<?php if (isset($row_RecMember['m_email'])){ echo $row_RecMember['m_email'];} ?>" size="40" class="textcss" placeholder=""/>
            </li>
                        
					  <?php if(0){ ?>
            <li class="item8"><span>縣市</span>

              <div id="twzipcode">
                <div data-role="zipcode" data-style="textcss" data-value="<?php if (isset($row_RecMember['m_zip'])){ echo $row_RecMember['m_zip'];}else{echo '110';} ?>"></div>
                <div data-role="county" data-style="county" data-value=""></div>
                <div data-role="district" data-style="" data-value=""></div>
              </div>
                        
							<!--<select name="" id="select">
								<option>真新鎮</option>
							</select>-->
						</li>
            <?php } ?>

            <li class="item8"><span>國家</span>
              <div class="form-item">
                  <input type="text" id="country" name="country">
                  <input type="hidden" id="country_code" name="country_code" />
                  
                  <!-- <input type="text" id="country" />
                  <input type="hidden" id="country_code" /> -->


                  <label for="country" style="display:none;">Select a country here...</label>
              </div>              
            </li>
                        
						<li class="item9"><span>郵遞區號</span> <input type="text" name="zipcode" id="zipcode" placeholder="" class="textcss" style="width:75px" value="<?php if (isset($row_RecMember['m_zip'])){ echo $row_RecMember['m_zip'];} ?>"></li>
                        
					  <li class="item10"><span>地址</span> <input name="c_address" type="text" id="c_address" value="<?php if (isset($row_RecMember['m_address'])){ echo $row_RecMember['m_address'];} ?>" class="textcss" /></li>
						<!--<li class="item11"><span>備註</span> <textarea name="notation" cols="50" rows="10" class="text-input" id="notation"></textarea></li>-->

					</ul><!-- ul.left end -->

				</li>
			</ul>

      <?php if (0 && $totalRows_RecMember == 0) { ?>
      <ul class="ul-1 memberDate" style="display: none;">
        <li class="left">填寫會員資料</li>
        <li class="right">
          <ul class="info">

            <li class="item3">
                <span>確認電子郵件</span>
                <input name="m_reaccount" type="text" class="textcss" id="m_reaccount" placeholder="確認電子郵件">
            </li>
            <li class="item4">
              <span>密碼</span>
              <input name="m_password" type="password" class="textcss" id="m_password" placeholder="登入密碼">
            </li>
            <li class="item4">
                <span>確認密碼</span>
              <input name="m_repassword" type="password" class="textcss" id="m_repassword" placeholder="登入確認密碼">
            </li>
              <li class="item7"><span>生日</span> <input name="m_birthday" type="text" class="textcss" id="m_birthday" placeholder="西元/月/日" data-mask="yyyy/mm/dd">

            </li>

            <li class="item11 fancybox">
              <input type="radio" name="m_agree" id="m_agree" required>
              <label for="m_agree" class="fancybox">我已經閱讀並同意條款</label>
                          <!--<div class="error" id="m_agree-error">error</div>-->
            </li>
          </ul>

        </li>
      </ul>
      <?php } ?>
            
            <ul class="ul-1">
				<li class="left">填寫收件人聯絡方式</li>
				<li class="right">
					<ul class="info">
                        
                        <li class="item12"><span>資料同上</span>
					 	<input name="checkAddressee" type="radio" id="checkAddressee_0" value="0" checked="CHECKED" >
					 	<label for="checkAddressee_0">否</label>
					 	<input name="checkAddressee" type="radio" id="checkAddressee_1" value="1" >
					 	<label for="checkAddressee_1">是</label>
                    <label for="checkAddressee" class="error def-err"></label>
				  </li>
                    
                    
					<li class="item3"><span>姓名</span>
              <input name="r_client" type="text" id="r_client" value="<?php if (isset($_POST['r_client'])){ echo $_POST['r_client'];} ?>" class="textcss" placeholder=""/>
          </li>

          <?php if(0){ ?>
          <li class="item4"><span>性別</span>
					 	<input name="r_gender" type="radio" id="r_gender1" value="1" checked="CHECKED" >
					 	<label for="r_gender1">男</label>
					 	<input name="r_gender" type="radio" id="r_gender0" value="0" >
					 	<label for="r_gender0">女</label>
                    <label for="r_gender" class="error def-err"></label>
				  </li>
          <?php } ?>
                        
					  <li class="item6"><span>電話</span>
                        <input name="r_cellphone" type="text" id="r_cellphone" class="textcss" /></li>
                        
						<li class="item5"><span>電子郵件</span>
						  <input name="r_email" type="text" id="r_email" size="40" class="textcss" /></li>
                        
					  <?php if(0){ ?>
            <li class="item8"><span>縣市</span>
                        
                        	<div id="r_twzipcode">
  <div data-role="zipcode" data-style="textcss r_zipcode" data-value="110" class="r_zipcodeC"></div>
  <div data-role="county" data-style="county" data-value=""></div>
  <div data-role="district" data-style="" data-value=""></div>
</div>
                        
							<!--<select name="" id="select">
								<option>真新鎮</option>
							</select>-->
					  </li>
            <?php } ?>

            <li class="item8"><span>國家</span>
              <div class="form-item">
                  <input type="text" id="r_country" name="r_country">
                  <input type="hidden" id="r_country_code" name="r_country_code" />
                  
                  <!-- <input type="text" id="country" />
                  <input type="hidden" id="country_code" /> -->


                  <label for="r_country" style="display:none;">Select a country here...</label>
              </div>              
            </li>
                        
						<li class="item9"><span>郵遞區號</span> <input type="text" name="r_zipcode" id="r_zipcode" placeholder="" class="textcss" style="width:75px"></li>
                        
					  <li class="item10"><span>地址</span> <input name="r_address" type="text" id="r_address" value="" class="textcss" /></li>
						<li class="item11"><span>備註</span> <textarea name="notation" cols="50" rows="10" class="text-input" id="notation"></textarea></li>
					</ul><!-- ul.left end -->
				</li>
			</ul>
		</div><!-- area6 end -->

		<div class="area7"> <!-- 付款方式 -->
			<div class="step">付款方式</div>

			<ul>
				<li class="left">
                
                	
					<div class="item1">
						<input name="payment" type="radio" id="payment1" value="1" checked="CHECKED">
					 	<label for="payment1">ATM 虛擬帳戶匯款</label>
					</div>
                    
          <div class="item1">
            <input type="radio" name="payment" id="payment3" value="3">
            <label for="payment3">信用卡線上刷卡</label>
          </div>
					<div class="item1">
						<input name="payment" type="radio" id="payment2" value="2" <?php if ($totalRows_RecMember == 0) {echo 'checked="CHECKED"';}?> >
					 	<label for="payment2">超商店到店</label>
					</div>
				</li>
				<li class="right">
					<p id="payTxt1">當您的訂單資料成立後，依訂單專屬的帳號資訊，請您依據此組帳號進行轉帳即可；提醒您需於到貨日3天前完成匯款，以利如期出貨。<br /><br/>
                    <!-- 轉帳銀行:中國信託銀行(822)<br />帳號：613-54046670-8<br/><br/> -->
                    <span class="lm"> 1.會員完成匯款後<strong>可進會員系統回報匯款資訊</strong></span><br>
                    <span class="lm">2.非會員完成匯款後<strong>請來信或來電告知匯款帳號後五碼</strong></span>
                    </p>
                    
					<p id="payTxt3">可接受 VISA, Master, JCB</p>
					<p id="payTxt2">選擇超商店到店者，在實際收到ATM匯款後將商品寄出。</p>
				</li>
			</ul>
		</div><!-- area7 end -->

		<div class="area8">
			<ul class="total">
				<li>小計：<span><?php 
			$subAllTotal = moneyFormat($cart->total);
			echo '$'.$subAllTotal; 
			?></span></li>
				<li>運費：<span><?php
//echo 'AllItemCount = '.$cart->AllItemCount.'<br>';
//echo 'freightRating = '.$cart->freightRating.'<br>';
$freight = ($cart->grandTotal - $cart->total);
if($cart->total < $cart->freightRating){
  echo '$'.moneyFormat($cart->freightCosts);
}else{
  echo '免運費';
}

//echo '<br>$cart->freightCosts = '.$cart->freightCosts;
?></span></li>
				<li>總計：<span class="red"><?php 
		$grandTotal = moneyFormat($cart->grandTotal);
		echo '$'.$grandTotal; 
		?></span></li>
				<li class="next" id="buySubmit">確認送出</li>
			</ul>	
		</div>
        
        
        <input name="tfee" type="hidden" id="tfee" value="<?php echo $freight;?>" />
                    <input name="SubTotalAll" type="hidden" id="SubTotalAll" value="<?php echo $cart->total;?>" />
                  <input name="GrandTotal" type="hidden" id="GrandTotal" value="<?php echo $cart->grandTotal;?>" />
                  <input name="datetime" type="hidden" id="datetime" value="<?php echo date("Y-m-d H:i:s") ?>" />
                  <!--<input name="m_account" type="hidden" id="m_account" value="<?php //echo $row_RecMember['m_account']; ?>" />-->
                  <!--<input name="m_id" type="hidden" id="m_id" value="<?php //echo $row_RecMember['m_id']; ?>" />-->
                  
                    <input type="hidden" name="MM_insert" value="buyFormular" />
                  <input type="hidden" name="MM_submit" id="MM_submit" value="0" />
</form>
	</div><!-- order-list-wrap end -->

	<?php include 'backtotop.php'; ?>
	<?php include 'footer.php'; ?>

<?php if (0 && $totalRows_RecMember == 0) { ?>
<script src="js/bootstrap-datepicker/js/locales/bootstrap-datepicker.zh-TW.js"></script>
<?php } ?>
<script src="js/country-select/build/js/countrySelect.min.js"></script>

<script type="text/javascript">


    var country = $("#country").countrySelect(
    {
        defaultCountry: "tw",
        //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        //preferredCountries: ['ca', 'gb', 'tw', 'us'],
        preferredCountries: ['tw'],
        responsiveDropdown: true
    });

    var country = $("#r_country").countrySelect(
    {
        defaultCountry: "tw",
        //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        //preferredCountries: ['ca', 'gb', 'tw', 'us'],
        preferredCountries: ['tw'],
        responsiveDropdown: true
    });

  $(window).load(function  () {
    $("#nextstep").mousedown(function() {
      $.scrollTo( $('.area5'), {duration:1000,offset:-100} );
    });
    
    $(":input[name|='qty[]']").change(function(){
      //alert($(":input[name|='qty[]']").val());
      //alert("change");
      $('#action').attr('value', 'Update');
      $("#formular").submit();
      //return false;
    }); 
    
    /*$('#twzipcode').twzipcode({
      readonly: true
    });
    $('#r_twzipcode').twzipcode({
      readonly: true,
      'countyName' :'r_county',
      'districtName' : 'r_district',
      'zipcodeName' : 'r_zipcode'
    });*/

    $("#country").change(function() {     
      console.log($(this).val() + " => " + $("#country_code").val());
    });
    $("#r_country").change(function() {     
      console.log($(this).val() + " => " + $("#r_country_code").val());
    });
    
    $('input[name="checkAddressee"]').change(function() {
      checkAddressee($(this).val());
    });
    
    checkPaymentWay($("input[name='payment']:checked").val());
    
    $("input[name='payment']").change(function(){
      checkPaymentWay($("input[name='payment']:checked").val());
    });
  })
jQuery.validator.addMethod("phoneTW", function(phone_number, element) {
  phone_number = phone_number.replace(/\s+/g, "");
  var $m_tel_exp = /^[09]{2}[0-9]{8}$/;  //mobile
  var $h_tel_exp = /[0-9]{2,3}-[0-9]{5,}/;  //home
  return this.optional(element) || phone_number.length == 10 &&
  phone_number.match($m_tel_exp) || phone_number.length > 9 && phone_number.match($h_tel_exp);
}, "請正確的電話號碼");

jQuery.validator.addMethod("intPhone", function(phone_number, element) {
  phone_number = phone_number.replace(/\s+/g, "");
  //var $m_tel_exp = /\+(?:\d ?){6,14}\d/;  //phone
  var $m_tel_exp = /^\+(?:[0-9] ?){6,14}[0-9]$/;

  return this.optional(element) || phone_number.match($m_tel_exp);
}, "請正確的電話號碼");



$(document).ready(function() {
  
  
  $("#buySubmit").click(function() {
    console.log($("#buyFormular").valid());
    if($("#buyFormular").valid()==true){
      $("#insertC").val(1);
    }     
    $("#buyFormular").submit();     
  });

  $("#m_account").on('change', function(){
      Fvalidate.element( this );
    });
  
  Fvalidate = $("#buyFormular").validate({
    ignore:[],
    errorPlacement: function (label, element) {
      // default
      if (element.is(':radio')) {
        label.insertAfter(element.next('label'));       
      }
      else {
        label.insertAfter(element);
      }
      //console.log(element);
    },
    rules: {
        client  : {
          required: true,
          minlength: 1
        },
        cellphone: {
          required: true,
          //intPhone: true,
          minlength: 6
          //rangelength: [6, 14]
        },
        m_account : {
          required: true,
          minlength: 6,
          email: true
        },
        /*country :  "required"
        ,*/
        c_address : "required"
        ,
        r_client: {
          required: true,
          minlength: 2
        },
        /*r_country : "required"
        ,*/
        r_address : "required"
        ,
        r_cellphone: {
          required: true,
          //phoneTW: true,
          minlength: 6
        },
        r_email: {
          required: true,
          email: true
        }
        <?php if (0 && $totalRows_RecMember == 0) { ?>
        ,
        m_reaccount : {
          required: '#addMember_1:checked',
          minlength: 6,
          email: true,
          equalTo: "#m_account"
          },
        m_password  : {
          required: '#addMember_1:checked',
          minlength: 6
          },
        m_repassword: {
          required: '#addMember_1:checked',
          minlength: 6,
          equalTo: "#m_password"
        },
        m_birthday:{
          required: '#addMember_1:checked',
              date: true
        },
        m_agree : {
          required: '#addMember_1:checked',
        }
        <?php } ?>
        
    },
    messages: {
        client: {
          required: "必填欄位",
          minlength: "至少輸入六個字元"
        },
        cellphone: {
          required: "必填欄位",
          //intPhone: "輸入的格式錯誤",
          minlength: "至少輸入六個字元"
          //rangelength: "請輸入六至十四個電話號碼"
        },
        m_account: {
          required: "必填欄位",
          minlength: "至少輸入六個字元",
          email: "請檢查EMAIL格式"
        },
        /*country: {
          required: "必填欄位"
        },*/
        c_address: {
          required: "必填欄位"
        },
        r_client: {
          required: "必填欄位",
          minlength: "至少輸入六個字元"
        },
        /*r_country: {
          required: "必填欄位"
        },*/
        r_address: {
          required: "必填欄位"
        },
        r_cellphone: {
          required: "必填欄位",
          //phoneTW: "輸入的格式錯誤",
          minlength: "至少輸入六個字元"
        },
        r_email: {
          required: "必填欄位",
              email: "請檢查EMAIL格式"
        }
        <?php if (0 && $totalRows_RecMember == 0) { ?>
        ,
        m_reaccount: {
          required: "必填欄位",
          minlength: "至少輸入六個字元",
              email: "請檢查EMAIL格式",
              equalTo: "與上方帳號不相同"
        },
        m_password: {
          required: "必填欄位",
          minlength: "至少輸入六個字元"
        },
        m_repassword: {
          required: "必填欄位",
          minlength: "至少輸入六個字元",
          equalTo: "與上方登入密碼不相同"
        },
        m_birthday:{
          required: "必填欄位",
              date: "輸入的格式錯誤"
        },
        m_agree :  {
          required: "必填欄位"
        }
        <?php } ?>
    },
    highlight: function(element, errorClass) {
      console.log(element);
      /*alert(element);
        $(element).fadeOut(function() {
            $(element).fadeIn();
        });*/
      /*$('#myCart').css({'height': 'auto'});
      $('#mainContent-cart-white').css({'height': 'auto'});
      $('#contentWrapper-white').css({'height': 'auto'});
      $('#contents').css({'height': 'auto'});*/
      //$('#contents').height($('#contentWrapper-white').height());
      },
    submitHandler: function(form) {
      
      //form.submit();
      var answer = confirm("提醒您，訂單送出後將無法修改訂單！\n您確認要送出訂單了嗎？");
      if (answer){

        var NUM = parseInt( $('#MM_submit').val() );
        NUM++;
        $('#MM_submit').val( NUM );
        console.log( $('#MM_submit').val() );

        form.submit();
      }else{
      }
      //$("#confirmation").dialog("open");
    }
  });



  <?php if (0 && $totalRows_RecMember == 0) { ?>

  checkAddMember();

  $('input[name="addMember"]').on('change', function() {
    //console.log($('input[name="addMember"]:checked').val());
    if ($('input[name="addMember"]:checked').val() == "0") {
      $('ul.memberDate').hide();
      $('input[name="m_account"]').attr('placeholder', '');
      $('input[name="m_account"]').rules('remove', 'remote');

      Fvalidate.element( $('input[name="m_account"]') );
    } else {
      $('ul.memberDate').show();
      $('input[name="m_account"]').attr('placeholder', '登入帳號');
      $('input[name="m_account"]').rules('add', {
        remote: "flashJson/jquery-validation-1.9.0/validateUser.php"
      });

      Fvalidate.element( $('input[name="m_account"]') );
    }
  });

  $('#m_birthday').datepicker({
    format: "yyyy/mm/dd",
    language: "zh-TW",
    autoclose: true,
    todayHighlight: true
  }).on('change', function(){
      Fvalidate.element( this );
    });;

  $("li.fancybox").click(function() {
    $.fancybox.open({
      maxWidth  : 600,
      maxHeight : 600,
      fitToView : false,
      autoSize  : true,
      closeClick  : false,
      openEffect  : 'none',
      closeEffect : 'none',
      type    : 'ajax',
      href    : 'member_rule.php',
      helpers   :{
              overlay : {
                locked : false   // if true, the content will be locked into overlay
              }
            }
    });
  });

  <?php } ?>


}); 

function checkPaymentWay(way){
  if(way==1){
    $('#payTxt1').show();
    $('#payTxt2').hide();
    $('#payTxt3').hide();
  }else if(way==2){
    $('#payTxt1').hide();
    $('#payTxt2').show();
    $('#payTxt3').hide();
  }else if(way==3){
    $('#payTxt1').hide();
    $('#payTxt2').hide();
    $('#payTxt3').show();
  }
}

function checkAddressee(sel){
  if(sel==0){
    $('#r_client').val( '' );
      
    $('#r_gender1').prop('checked', true);  
    $('#r_gender0').prop('checked', false);
    
    $('#r_address').val( '' );
    $('#r_phone').val( '' );
    $('#r_cellphone').val( '' );
    $('#r_email').val( '' );
    
    
    $('input[name="r_zipcode"]').val( '110' ).blur();
    
  }else if(sel==1){
    $('#r_client').val( $('#client').val() );
    if($('input[name="c_gender"]:checked').val() == 1){
      
      $('#r_gender1').prop('checked', true);  
      $('#r_gender0').prop('checked', false);
    }else{
      $('#r_gender1').prop('checked', false);
      $('#r_gender0').prop('checked', true);
    }
    
    $('#r_address').val( $('#c_address').val() );
    $('#r_cellphone').val( $('#cellphone').val() );
    $('#r_email').val( $('#m_account').val() );
    
    aipcodeS = $('input[name="zipcode"]').val();    
    $('input[name="r_zipcode"]').val( aipcodeS ).blur();


    //console.log($("#country_code").val());
    $("#r_country").countrySelect("selectCountry", $("#country_code").val());
  }
  
}
<?php if (0 && $totalRows_RecMember == 0) { ?>
function checkAddMember(){
  //console.log($('input[name="addMember"]:checked').val());
  var checked = $('input[name="addMember"]:checked').val();
  checked = 0;
  if(checked=='0'){
    
    $('ul.memberDate').hide();
    $('input[name="m_account"]').attr('placeholder', '');
    $('input[name="m_account"]').rules('remove', 'remote');

  }else{

    $('ul.memberDate').show();
    $('input[name="m_account"]').attr('placeholder', '登入帳號');
    $('input[name="m_account"]').rules('add', {
      remote: "flashJson/jquery-validation-1.9.0/validateUser.php"
    });
    
  }
}
<?php } ?>

</script>

</body>
</html>

