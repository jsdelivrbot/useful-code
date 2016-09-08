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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

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

  $updateGoTo = "order_look.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $_SESSION['REFERER']));
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

<script src="js/jquery.form.js"></script>
<script src="flashJson/jquery-validation-1.14.0/dist/jquery.validate.js"></script>
<script src="js/jquery.twzipcode.min.js"></script>

<link rel="stylesheet/less" type="text/css" href="style_ryder.less">
<script src="js/less-1.3.0.min.js" type="text/javascript"></script>

<?php require_once('ga.php'); ?>

</head>
<body>
	<?php $now="member"; ?>
	<?php include('topmenu.php'); ?>

	<div class="order-look-wrap order-list-wrap">
		<?php include 'logo.php'; ?>

		<div class="area1">
			<?php include 'menu.php'; ?>
		</div><!-- area1 end -->

		<?php 
		$m_now='orderlist';
		include('member_menu.php');
		?>

		
		<div class="area6 report-area"> <!-- 填寫資料 -->
        
        <form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="reportFormular" id="reportFormular" >
        
			<div class="step">匯款回報</div>
			<ul class="ul-1">
				<li class="left">填寫匯款資料</li>
				<li class="right reportRight">
					<ul class="info">
						<li class="item3"><span>匯款帳戶名</span>
                        <input name="remitter" type="text" class="textcss" id="remitter" placeholder="" value="<?php echo ($row_RecOrder['remitter']!='')?$row_RecOrder['remitter']:''; ?>"/>
                      </li>
                        
					  <li class="item6"><span>匯款帳號後五碼</span>
                        <input name="remitter_AC" type="text" class="textcss" id="remitter_AC" value="<?php echo ($row_RecOrder['remitter_AC']!='')?$row_RecOrder['remitter_AC']:''; ?>" /></li>
                        
						<li class="item5"><span>匯款金額</span>
						  <input name="remitter_money" type="text" class="textcss" id="remitter_money" value="<?php echo ($row_RecOrder['remitter_money']!='')?$row_RecOrder['remitter_money']:''; ?>" size="40" /></li>
                        
					  <li class="item10"><span>匯款時間</span> <input name="remitter_time" type="text" class="textcss" id="remitter_time" value="<?php echo date('Y-m-d H:i')?>" /></li>
                      
                      <li class="btn" id="reportSubmit">儲存</li>
				  </ul><!-- ul.left end -->
				</li>
			</ul>
            
            <input name="o_id" type="hidden" id="o_id" value="<?php echo $row_RecOrder['o_id']; ?>" />
        <input name="remitter_active" type="hidden" id="remitter_active" value="<?php echo $row_RecOrder['remitter_active']; ?>" />
        <input type="hidden" name="MM_update" value="form1" />
         </form>   
            
		</div><!-- area3 end -->
        
        

	</div><!-- order-look-wrap end -->

	<?php include 'backtotop.php'; ?>
	<?php include 'footer.php'; ?>

<script type="text/javascript">

	$(window).load(function  () {
	})

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


</script>

</body>
</html>
<?php
mysql_free_result($RecOrder);
?>
