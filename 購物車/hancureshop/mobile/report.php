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

$editFormAction = $_SERVER['PHP_SELF'];
/*if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}*/

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	
	//echo 'MM_update = '.$_POST["MM_update"];
	
  $updateSQL = sprintf("UPDATE order_set SET remitter=%s, remitter_AC=%s, remitter_money=%s, remitter_time=%s, remitter_active=%s, bank_status=%s WHERE o_id=%s",
                       GetSQLValueString($_POST['remitter'], "text"),
                       GetSQLValueString($_POST['remitter_AC'], "text"),
                       GetSQLValueString($_POST['remitter_money'], "text"),
					   GetSQLValueString($_POST['remitter_time'], "text"),
                       GetSQLValueString('1', "int"),
                       GetSQLValueString('1', "int"),
                       GetSQLValueString($_POST['o_id'], "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());

  $updateGoTo = "record.php";
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  //header(sprintf("Location: %s", $_SESSION['REFERER']));
  header(sprintf("Location: %s", $updateGoTo));
}


$colname_RecOrder = "-1";
if (isset($_GET['o_id'])) {
  $colname_RecOrder = $_GET['o_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecOrder = sprintf("SELECT * FROM order_set WHERE o_id = %s", GetSQLValueString($colname_RecOrder, "int"));
$RecOrder = mysql_query($query_RecOrder, $connect2data) or die(mysql_error());
$row_RecOrder = mysql_fetch_assoc($RecOrder);
$totalRows_RecOrder = mysql_num_rows($RecOrder);

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

	<script src="../js/jquery.form.js"></script>
    <script src="../flashJson/jquery-validation-1.14.0/dist/jquery.validate.js"></script>

	<link rel="stylesheet/less" type="text/css" href="style_ryder.less">
	<script src="js/less-1.3.0.min.js" type="text/javascript"></script>

	<style type="text/css">
		.shorttext{
			width: 160px;
		}
		span.reddot{
			width: 115px;
		}
		body{
			position:relative;
			height: auto;
			min-height:100%;
			padding-bottom:238px;
		}
		#reportFormular{
			position:relative;
			min-height:280px;
		}
		ul.onechoice{
			position: absolute;
			bottom: 238px;
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

	<div class="bigtitle">匯款回報 <?php echo $row_RecOrder['o_number']; ?></div>

	<div class="areatitle">匯款回報</div>

	<form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="reportFormular" id="reportFormular" >
    <div class="datahere">
		<div>
			<span class="reddot">匯款帳戶名</span>
            <input name="remitter" type="text" class="c-text shorttext" id="remitter" placeholder="" value="<?php echo ($row_RecOrder['remitter']!='')?$row_RecOrder['remitter']:''; ?>"/>
		</div>
		<div>
			<span class="reddot">匯款帳號後五碼</span>
            <input name="remitter_AC" type="text" class="c-text shorttext" id="remitter_AC" value="<?php echo ($row_RecOrder['remitter_AC']!='')?$row_RecOrder['remitter_AC']:''; ?>" />
		</div>
		<div>
			<span class="reddot">匯款金額</span>
            <input name="remitter_money" type="text" class="c-text shorttext" id="remitter_money" value="<?php echo ($row_RecOrder['remitter_money']!='')?$row_RecOrder['remitter_money']:''; ?>" />
		</div>
		<div>
			<span class="reddot">匯款時間</span>
            <input name="remitter_time" type="text" class="c-text shorttext" id="remitter_time" value="<?php echo date('Y-m-d H:i')?>" />
		</div>
	</div>
    
    	<input name="o_id" type="hidden" id="o_id" value="<?php echo $row_RecOrder['o_id']; ?>" />
        <input name="remitter_active" type="hidden" id="remitter_active" value="<?php echo $row_RecOrder['remitter_active']; ?>" />
        <input type="hidden" name="MM_update" value="form1" />
	</form>  

	<ul class="onechoice">
		<li class="savereport" id="reportSubmit"><a href="javascript:;">儲存匯款資訊</a></li>
	</ul>

	<?php include 'footer.php'; ?>

	<div class="confirm">
		<div class="savedone">儲存成功</div>
	</div>

</body>
</html>

<script type="text/javascript">

$(document).ready(function() {
	
	$("#reportSubmit").click(function() {	  
	  $("#reportFormular").submit();		  
  });
	
	$("#reportFormular").validate({
		ignore:[],
		rules: {
				remitter	: {
					required: true,
					minlength: 2
				},
				remitter_AC: {
					required: true,
					rangelength: [5, 5]
				},
				remitter_money	: {
					required: true,
					number: true
				},
				remitter_time: {
					required: true,
					date: true
				}
				
		},
		messages: {
				remitter: {
					required: "必填欄位",
					minlength: "至少輸入二個字元"
				},
				remitter_AC: {
					required: "必填欄位",
					rangelength: "輸入帳號後五碼"
				},
				remitter_money: {
					required: "必填欄位",
     		  		number: "請輸入阿拉伯數字"
				},
				remitter_time: {
					required: "必填欄位",
					date: "時間格式錯誤"
				}
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
			var answer = confirm("提醒您，匯款回報送出後將無法修改！\n您確認要送出匯款回報了嗎？");
			if (answer){
				form.submit();
			}else{
			}
			//$("#confirmation").dialog("open");
		}
	});
});	


	/*$(".savereport").click(function  () {
		$(".confirm").fadeIn(700);
	})
	$(".confirm").click(function  () {
		$(this).fadeOut(700);
	})*/

</script>

