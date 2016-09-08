<?php
require_once('inc/EDcart.php');
if (!isset($_SESSION)) {
  session_start();
}
ob_start();
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

  if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "buyFormular")) {

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

require_once('../js/fun_changeStr.php');
require_once('../js/fun_moneyFormat.php');
?>
<?php require_once('../Connections/session.initialize.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>C+H</title>

	<?php include('meta.php') ?>

	<script src="js/jquery/1.11.1/jquery.min.js"></script>

	<script src="js/jquery.bxslider/jquery.bxslider.js"></script>
	<link rel="stylesheet" type="text/css" href="js/jquery.bxslider/jquery.bxslider.css">

	<!-- <script src="js/jquery.twzipcode.js"></script> -->


<link rel="stylesheet" href="../js/country-select/build/css/countrySelect.min.css">

	<script src="../js/jquery.form.js"></script>
  <script src="../flashJson/jquery-validation-1.14.0/dist/jquery.validate.js"></script>
  <script src="../js/jquery.twzipcode.min.js"></script>

  <?php if (0 && $totalRows_RecMember == 0) { ?>
  <script src="../js/bootstrap.js"></script>
  <link rel="stylesheet" href="../js/bootstrap-datepicker/css/datepicker3.css">
  <script src="../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

  <!-- Add fancyBox -->
  <link rel="stylesheet" href="../js/fancyapps/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
  <script type="text/javascript" src="../js/fancyapps/source/jquery.fancybox.pack.js?v=2.1.5"></script>
  <!-- Optionally add helpers - button, thumbnail and/or media -->
  <link rel="stylesheet" href="../js/fancyapps/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
  <script type="text/javascript" src="../js/fancyapps/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
  <script type="text/javascript" src="../js/fancyapps/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

  <link rel="stylesheet" href="../js/fancyapps/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
  <script type="text/javascript" src="../js/fancyapps/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
  <?php } ?>

  <link rel="stylesheet/less" type="text/css" href="style_ryder.less?0.2">
  <script src="js/less-1.3.0.min.js" type="text/javascript"></script>

  <style type="text/css">
    .h-bb{
     border-bottom: 1px solid #ad9f82;
     padding-bottom: 14px;
   }
   .h-mt{
     margin-top: 93px;
   }
   .h-mb{
     margin-bottom: 25px;
   }
   .h-mb9{
     margin-bottom: 9px;
   }
   .big-mb{
     margin-bottom: 40px;
   }
   .shorttext{
     width: 115px;
   }
   p.unicorn{
     padding-left: 19px;
     position: relative;
     top: -15px;
   }
   ul.twochoice{
     margin-top: 113px;
   }
   .c-select{
     font-size: 12px;
     height: 20px;
   }
   /* .fancybox-close{
    top: 0;
    right: 0;
   } */
   a.fancyboxCloseBtn{
    position: absolute;
    top: 2px;
    right: 4px;
    width: 30px;
    height: 30px;
    cursor: pointer;
    z-index: 8040;
   }
   .fancyboxCloseBtn:before, .fancyboxCloseBtn:after {
      transition: all 0.6s;
      -webkit-transition: all 0.6s;
      content: '';
      position: absolute;
      border-bottom: 2px solid #717071;
      width: 100%;
    }
    .fancyboxCloseBtn:before {
      top: 16px;
      left: 0;
      transform: rotate(45deg);
      -webkit-transform: rotate(45deg);
    }
    .fancyboxCloseBtn:after {
      bottom: 12px;
      left: 0;
      transform: rotate(-45deg);
      -webkit-transform: rotate(-45deg);
    }
 </style>

</head>
<body>

	<?php include 'topmenu-fixed.php'; ?>

	<div class="fortopmenupush"></div>

	<div class="bigtitle">購物清單</div>

	<div class="areatitle h-mb9">商品資訊</div>


  <form action="<?php echo $updateAction; ?>" method="post" enctype="multipart/form-data" name="formular" id="formular" class="formular">


    <?php $k=0; ?>
    <?php if($cart->itemCount > 0) {?>

    <ul class="order-list">


      <?php foreach($cart->get_contents() as $item) { $k=$k+1; ?>

      <li>
      <?php if(0){ ?>
        <p class="order-list-img">

        <?php
          if(isset($item['pic2']) && $item['pic2']!=''){
           $img = '../'.$item['pic2'].'?'.(mt_rand(1,100000)/100000);
         }else{
           $img = '../'.str_replace('s301.','s100.',$item['pic']).'?'.(mt_rand(1,100000)/100000);
         }
         ?>
         <?php if(isset($img)){ ?>
         <img src="<?php echo $img; ?>" alt=""  class="image_frame" width="75" />
         <?php } ?>
        </p>
      <?php } ?>
     <!--<p><?php //echo CuttingStr(urldecode($item['name']), 34);?></p>-->
     <p class="pTitle">
      <?php echo urldecode($item['name']);?> X 
      <select name="qty[]" id="qty" class="c-select">
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
     </p>

     <?php if(0){ ?>
     <p><span class="red"><?php
      echo ($item['d_price1']!=0) ? '$'.moneyFormat(round( $item['d_price1'])) : '無';
      ?></span></p>
      <?php } ?>

      <?php if(0){ ?>
      <p>數量

       <select name="qty[]" id="qty" class="c-select">
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
  </p>
      <?php } ?>
  <p class="close">
   <a href="inc/functions.php?action=deleteFromBasket&productID=<?php echo $item['id'];?>" title="刪除商品">
     <img src="images/close.png" width="21">
   </a>
 </p>
 <input name="action" type="hidden" id="action" value="Update" />
 <input name="itemcount" type="hidden" id="itemcount2" value="<?php echo $cart->itemCount;?>" />
 <input name="productID[]" type="hidden" id="productID[]" value="<?php echo $item['id'];?>" />
</li>

   <?php } ?>

 </ul>
 <?php } ?>

 <div class="float-r">
  <p>小計：<?php
   $subAllTotal = moneyFormat($cart->total);
   echo '$'.$subAllTotal;
   ?></p>
   <p>運費：<?php
//echo 'AllItemCount = '.$cart->AllItemCount.'<br>';
//echo 'freightRating = '.$cart->freightRating.'<br>';
    $freight = ($cart->grandTotal - $cart->total);
    if($cart->total < $cart->freightRating){
      echo '$'.moneyFormat($cart->freightCosts);
    }else{
      echo '免運費';
    }

   

//echo '<br>$cart->freightCosts = '.$cart->freightCosts;
   ?></p>
   <p>總計：<span class="red"><?php
    $grandTotal = moneyFormat($cart->grandTotal);
    echo '$'.$grandTotal;
    ?></span></p>
  </div>



</form>

<div class="areatitle h-mt">運送方式</div>

<div class="areacontent h-mb">
  <p>
  郵寄或超商店到店服務運送，請註明收件時段。<br>
購物滿 $<?php echo ($row_Freight['d_price1']!='')?$row_Freight['d_price1']:'3000';?> 免運費，未滿 $<?php echo ($row_Freight['d_price1']!='')?$row_Freight['d_price1']:'3000';?> 運費 <?php echo ($row_Freight['d_price2']!='')?$row_Freight['d_price2']:'100';?> 元。</p>
</div>

<div class="areatitle">資料填寫</div>

<!-- <div class="areacontent h-mb">
  <p>購物滿 499 元(含)以上免運費，未滿 499 元，運費為 100 元。</p>
</div> -->

<div class="areatitle">訂購人資料</div>

<form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="buyFormular" id="buyFormular" >

	<div class="datahere big-mb">
    <?php if (0 && $totalRows_RecMember == 0) { ?>
    <div>
     <span class="reddot">加入會員</span>     
     <input name="addMember" type="radio" id="addMember_0" value="0" class="c-radio">
     <label for="addMember_0">否</label>
     <input name="addMember" type="radio" id="addMember_1" value="1" class="c-radio" checked="CHECKED">
     <label for="addMember_1">是</label>
     <label for="addMember" class="error def-err"></label>
   </div>
   <?php } ?>

		<div>
			<span class="reddot">姓名</span>
      <input name="client" type="text" id="client" value="<?php if (isset($row_RecMember['m_name'])){ echo $row_RecMember['m_name'];} ?>" class="c-text shorttext" placeholder=""/>
    </div>

    <?php if(0){ ?>
    <div>
     <span class="reddot">性別</span>

     <input name="c_gender" type="radio" id="c_gender1" value="1" <?php if (isset($row_RecMember['m_gender'])){if ($row_RecMember['m_gender']==1) {echo "checked=\"checked\"";}} ?> class="c-radio">
     <label for="c_gender1">男</label>
     <input name="c_gender" type="radio" id="c_gender0" value="0" <?php if (isset($row_RecMember['m_gender'])){if ($row_RecMember['m_gender']==0) {echo "checked=\"checked\"";}}else{echo "checked=\"checked\"";} ?> class="c-radio">
     <label for="c_gender0">女</label>
     <label for="c_gender" class="error def-err"></label>

   </div>
   <?php } ?>

   <div>
     <span class="reddot">電話</span>
     <input name="cellphone" type="text" id="cellphone" value="<?php if (isset($row_RecMember['m_phone'])){ echo $row_RecMember['m_phone'];} ?>" class="c-text shorttext" />
   </div>

   <div>
     <span class="reddot">Mail</span>
     <input name="m_account" type="text" id="m_account" value="<?php if (isset($row_RecMember['m_email'])){ echo $row_RecMember['m_email'];} ?>" size="40" class="c-text" />
   </div>

   <?php if(0){ ?>

   <div id="twzipcode">
     <span class="reddot">地址</span>
     <div data-role="zipcode" data-style="c-text shorttextZip" data-value="<?php if (isset($row_RecMember['m_zip'])){ echo $row_RecMember['m_zip'];}else{echo '110';} ?>"></div>
     <span class="blankspan blankspanNone"></span>
     <div data-role="county" data-style="data-select" data-value=""></div>
     <div data-role="district" data-style="data-select" data-value=""></div>
   </div>

		<!--<div id="twzipcode">
			<span class="reddot">地址</span>
			<div data-role="county" data-style="data-select"></div>
			<div data-role="district" data-style="data-select"></div>
		</div>-->
   <?php } ?>

   <div>
    <span class="reddot">國家</span>
    <div class="form-item">
      <input type="text" id="country" name="country">
      <input type="hidden" id="country_code" name="country_code" />
      <label for="country" style="display:none;">Select a country here...</label>
    </div> 
   </div>

    <div>
      <span class="reddot">郵遞區號</span>
      <input type="text" name="zipcode" id="zipcode" placeholder="" class="c-text" style="width:75px" value="<?php if (isset($row_RecMember['m_zip'])){ echo $row_RecMember['m_zip'];} ?>">

    </div>

		<div>
			<!-- <span class="blankspan"></span> -->
      <span class="reddot">地址</span>
      <input name="c_address" type="text" id="c_address" value="<?php if (isset($row_RecMember['m_address'])){ echo $row_RecMember['m_address'];} ?>" class="c-text" />
    </div>
  </div>

  <!--=====  End of 訂購人資料  ======-->


  <?php if (0 && $totalRows_RecMember == 0) { ?>

  
  <!--=====  加入會員資料  ======-->
  <div class="memberDate" style="display: none;">
    <div class="areatitle">填寫會員資料</div>

    <div class="datahere big-mb">

      <div>
        <span class="reddot">確認電子郵件</span>
              <input name="m_reaccount" type="text" class="c-text" id="m_reaccount" placeholder="確認電子郵件">
      </div>
      <div>
        <span class="reddot">密碼</span>
        <input name="m_password" type="password" class="c-text shorttext" id="m_password" placeholder="登入密碼">
      </div>
      <div>
        <span class="reddot">確認密碼</span>
        <input name="m_repassword" type="password" class="c-text shorttext" id="m_repassword" placeholder="登入確認密碼">
      </div>
      <div>
        <span class="reddot">生日</span>
              <input name="m_birthday" type="text" class="c-text shorttext" id="m_birthday" placeholder="西元/月/日" data-mask="yyyy/mm/dd">
      </div>

      <div class="agree">
        <span class="blankspan"></span>            
        <input type="radio" name="m_agree" id="m_agree" class="c-radio" required>
        <label for="m_agree" class="fancybox">我已經閱讀並同意條款</label>
      </div>

    </div>
  </div>
  <!--=====  加入會員資料  ======-->
  <?php } ?>


  <div class="areatitle">收件人資料</div>

  <div class="datahere big-mb">
    <div>
     <span class="reddot">資料同上</span>
     <input name="checkAddressee" type="radio" id="checkAddressee_0" value="0" checked="CHECKED" class="c-radio" >
     <label for="checkAddressee_0">否</label>
     <input name="checkAddressee" type="radio" id="checkAddressee_1" value="1"  class="c-radio">
     <label for="checkAddressee_1">是</label>
     <label for="checkAddressee" class="error def-err"></label>
   </div>
   <div>
     <span class="reddot">姓名</span>
     <input name="r_client" type="text" id="r_client" value="<?php if (isset($_POST['r_client'])){ echo $_POST['r_client'];} ?>" class="c-text shorttext" placeholder=""/>
   </div>

   <?php if(0){?>
   <div>
     <span class="reddot">性別</span>
     <input name="r_gender" type="radio" id="r_gender1" value="1" checked="CHECKED" class="c-radio" >
     <label for="r_gender1">男</label>
     <input name="r_gender" type="radio" id="r_gender0" value="0" class="c-radio" >
     <label for="r_gender0">女</label>
     <label for="r_gender" class="error def-err"></label>
   </div>
   <?php } ?>

   <div>
     <span class="reddot">電話</span>
     <input name="r_cellphone" type="text" id="r_cellphone" class="c-text shorttext" />
   </div>
   <div>
     <span class="reddot">Mail</span>
     <input name="r_email" type="text" id="r_email" size="40" class="c-text" />
   </div>

   <?php if(0){ ?>
   <div id="r_twzipcode">
     <span class="reddot">地址</span>
     <div data-role="zipcode" data-style="c-text shorttextZip" data-value="110" class="r_zipcodeC"></div>
     <span class="blankspan blankspanNone"></span>
     <div data-role="county" data-style="data-select" data-value=""></div>
     <div data-role="district" data-style="data-select" data-value=""></div>
   </div>

		<!--<div id="twzipcode2">
			<span class="reddot">地址</span>
			<div data-role="county" data-style="data-select"></div>
			<div data-role="district" data-style="data-select"></div>
		</div>-->
   <?php } ?>

   <div>
    <span class="reddot">國家</span>
    <div class="form-item">
      <input type="text" id="r_country" name="r_country">
      <input type="hidden" id="r_country_code" name="r_country_code" />
      <label for="r_country" style="display:none;">Select a country here...</label>
    </div> 
   </div>

    <div>
      <span class="reddot">郵遞區號</span>
      <input type="text" name="r_zipcode" id="r_zipcode" placeholder="" class="c-text" style="width:75px" value="">

    </div>

		<div>
			<!-- <span class="blankspan"></span> -->
      <span class="reddot">地址</span>
      <input name="r_address" type="text" id="r_address" value="" class="c-text" />
    </div>

    <div>
     <span class="reddot reddotNone">備註</span>
     <textarea name="notation" class="c-textarea" id="notation"></textarea>
   </div>

 </div>

 <!--=====  End of 收件人資料  ======-->

 <div class="areatitle">付款方式</div>

 <div class="datahere h-bb">
  <div>
   <input name="payment" type="radio" id="payment1" value="1" checked="CHECKED" class="pay-radio">
   <label for="payment1">ATM 虛擬帳戶匯款</label>

   <input name="payment" type="radio" id="payment2" value="2" <?php if (0 && $totalRows_RecMember == 0) {echo 'checked="CHECKED"';}?>  class="pay-radio">
   <label for="payment2">超商店到店</label>
   
   <input name="payment" type="radio" id="payment3" value="3" class="pay-radio">
   <label for="payment3">信用卡線上刷卡</label>

			<!--<input type="radio" class="pay-radio" name="radio4" id="r7">
			<label for="r7">ATM帳戶匯款</label>
			<input type="radio" class="pay-radio" name="radio4" id="r8">
			<label for="r8">超商店到店</label>-->
		</div>

    <p id="payTxt1" class="unicorn">當您的訂單資料成立後，依訂單專屬的帳號資訊，請您依據此組帳號進行轉帳即可；提醒您需於到貨日3天前完成匯款，以利如期出貨。<br /><br />
      <!-- 轉帳銀行:中國信託銀行(822)<br />帳號：613-54046670-8<br/><br/> -->
      <span class="lm">1.會員完成匯款後<strong>可進會員系統回報匯款資訊</strong></span><br>
      <span class="lm">2.非會員完成匯款後<strong>請來信或來電告知匯款帳號後五碼</strong></span>
    </p>

    <p id="payTxt3">可接受 VISA, Master, JCB</p>
    <p id="payTxt2">選擇超商店到店者，在實際收到ATM匯款後將商品寄出。</p>

    <!--<p class="unicorn">超商店到店金額超過 2 萬元者，請改用ATM匯款，謝謝您。</p>-->
  </div>

  <div class="float-r">
    <p>小計：<?php
     $subAllTotal = moneyFormat($cart->total);
     echo '$'.$subAllTotal;
     ?></p>
     <p>運費：<?php
//echo 'AllItemCount = '.$cart->AllItemCount.'<br>';
//echo 'freightRating = '.$cart->freightRating.'<br>';
      $freight = ($cart->grandTotal - $cart->total);
      if($cart->total < $cart->freightRating){
        echo '$'.moneyFormat($cart->freightCosts);
      }else{
        echo '免運費';
      }

//echo '<br>$cart->freightCosts = '.$cart->freightCosts;
     ?></p>
     <p>總計：<span class="red"><?php
      $grandTotal = moneyFormat($cart->grandTotal);
      echo '$'.$grandTotal;
      ?></span></p>
    </div>

    <ul class="twochoice">
      <li class="goback"><a href="javascript:;">繼續購物</a></li>
      <li class="gopay" id="buySubmit"><a href="javascript:;">確認結帳</a></li>
    </ul>

    <input name="tfee" type="hidden" id="tfee" value="<?php echo $freight;?>" />
    <input name="SubTotalAll" type="hidden" id="SubTotalAll" value="<?php echo $cart->total;?>" />
    <input name="GrandTotal" type="hidden" id="GrandTotal" value="<?php echo $cart->grandTotal;?>" />
    <input name="datetime" type="hidden" id="datetime" value="<?php echo date("Y-m-d H:i:s") ?>" />
    <input type="hidden" name="MM_insert" value="buyFormular" />

  </form>

  <?php include 'footer.php'; ?>

  <?php if (0 && $totalRows_RecMember == 0) { ?>
  <script src="../js/bootstrap-datepicker/js/locales/bootstrap-datepicker.zh-TW.js"></script>
  <?php } ?>

<script src="../js/country-select/build/js/countrySelect.min.js"></script>

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

    $(":input[name|='qty[]']").change(function(){
      //alert($(":input[name|='qty[]']").val());
      //alert("change");
      $('#action').attr('value', 'Update');
      $("#formular").submit();
      //return false;
    });


    $(".goback").click(function  () {
      //history.go(-1);
      window.location = 'goods.php';
    })

    /*$('#twzipcode').twzipcode({
      readonly: true
    });
    $('#r_twzipcode').twzipcode({
      readonly: true,
      'countyName' :'r_county',
      'districtName' : 'r_district',
      'zipcodeName' : 'r_zipcode'
    });*/

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


  $(document).ready(function() {

   $("#buySubmit").click(function() {
    //console.log($("#addForm").valid());
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
    },
    rules: {
      client  : {
       required: true,
       minlength: 2
     },
     cellphone: {
       required: true,
       //phoneTW: true,
       minlength: 6
     },
     m_account : {
      required: true,
      minlength: 6,
      email: true
     },
     /*county :  "required"
     ,*/
     c_address : "required"
     ,
     r_client: {
       required: true,
       minlength: 2
     },
     /*r_county : "required"
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
     //phoneTW: "輸入的格式錯誤",
     minlength: "至少輸入六個字元"
   },
   m_account: {
    required: "必填欄位",
    minlength: "至少輸入六個字元",
    email: "請檢查EMAIL格式"
   },
   /*county: {
     required: "必填欄位"
   },*/
   c_address: {
     required: "必填欄位"
   },
   r_client: {
     required: "必填欄位",
     minlength: "至少輸入六個字元"
   },
   /*r_county: {
     required: "必填欄位"
   },*/
   r_address: {
     required: "必填欄位"
   },
   r_cellphone: {
     required: "必填欄位",
     //phoneTW: "輸入的格式錯誤",
     minlength: "至少輸入九個字元"
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
    //console.log($(this).val());
    if ($('input[name="addMember"]:checked').val() == "0") {
      $('.memberDate').hide();
      $('input[name="m_account"]').attr('placeholder', '');
      $('input[name="m_account"]').rules('remove', 'remote');

      Fvalidate.element( $('input[name="m_account"]') );
      //Fvalidate.valid();
    } else {
      $('.memberDate').show();
      $('input[name="m_account"]').attr('placeholder', '登入帳號');
      $('input[name="m_account"]').rules('add', {
        remote: "../flashJson/jquery-validation-1.9.0/validateUser.php"
      });

      //Fvalidate.valid();
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

  $("label.fancybox").click(function() {
    $.fancybox.open({
      maxWidth  : 260,
      height    : 'auto',
      margin    : 0,
      padding   : 10,
      fitToView : false,
      autoSize  : false,
      closeClick  : false,
      openEffect  : 'none',
      closeEffect : 'none',
      type    : 'ajax',
      href    : '../member_rule.php',
      tpl       :{
              closeBtn : '<a title="Close" class="fancyboxCloseBtn" href="javascript:;"></a>'
      },
      helpers   :{
              overlay : {
                locked : true   // if true, the content will be locked into overlay
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

    $("#r_country").countrySelect("selectCountry", $("#country_code").val());

  }

}

<?php if (0 && $totalRows_RecMember == 0) { ?>
function checkAddMember(){
  var checked = $('input[name="addMember"]:checked').val();
  if(checked=='0'){
    
    $('.memberDate').hide();
    $('input[name="m_account"]').attr('placeholder', '');
    $('input[name="m_account"]').rules('remove', 'remote');

  }else{

    $('.memberDate').show();
    $('input[name="m_account"]').attr('placeholder', '登入帳號');
    $('input[name="m_account"]').rules('add', {
      remote: "../flashJson/jquery-validation-1.9.0/validateUser.php"
    });
    
  }
}
<?php } ?>
</script>



</body>
</html>
