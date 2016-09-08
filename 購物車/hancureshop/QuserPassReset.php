<?php
require_once('inc/EDcart.php');
if (!isset($_SESSION)) {
  session_start();
}
$cart =& $_SESSION['edCart']; 
if(!is_object($cart)) $cart = new edCart(); 
//echo "item = ".$cart->itemCount;
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

// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "resetForm") && $_POST["resetC"] == 1) {

	$newPass = '-1';
	$colname_RecRestMember = "-1";
	if (isset($_POST['resetAccount'])) {
	  $colname_RecRestMember = $_POST['resetAccount'];
	}
	mysql_select_db($database_connect2data, $connect2data);
	$query_RecRestMember = sprintf("SELECT * FROM member_set WHERE m_account = %s AND m_active='1'", GetSQLValueString($colname_RecRestMember, "text"));
	$RecRestMember = mysql_query($query_RecRestMember, $connect2data) or die(mysql_error());
	$row_RecRestMember = mysql_fetch_assoc($RecRestMember);
	$totalRows_RecRestMember = mysql_num_rows($RecRestMember);

	if($totalRows_RecRestMember>0){
		require_once('flashJson/generatePassword.php');
		$newPass = generatePassword();

		$updateSQL = sprintf("UPDATE member_set SET m_password=%s WHERE m_account=%s AND m_active='1'",
                       GetSQLValueString(md5($newPass), "text"),
                       GetSQLValueString($colname_RecRestMember, "text"));

		mysql_select_db($database_connect2data, $connect2data);
		$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());

		
	}

	  /*$insertGoTo = "member_addFinish.php";
	  if (isset($_SERVER['QUERY_STRING'])) {
	    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
	    $insertGoTo .= $_SERVER['QUERY_STRING'];
	  }
	  header(sprintf("Location: %s", $insertGoTo));*/


}


?>
<?php require_once('Connections/session.initialize.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>HanCure 漢速敷</title>

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


<link rel="stylesheet/less" type="text/css" href="style_ryder.less">
<script src="js/less-1.3.0.min.js" type="text/javascript"></script>

<style type="text/css">
.login-wrap .area2 .left{
	width: 296px;
}
.login-wrap .area2 .left span{
	width: 98px;
}
label.error{
	display: block;
	margin: auto;
	margin-top: 10px;
}
.QuserPassReset{
	font-family: "STXihei", HEITI TC, "HEITI TC", "黑體-繁", "微軟正黑體", "黑體", sans-serif;
    font-size: 15px;
    letter-spacing: 1px;
    color: #717171;
}

</style>

<?php require_once('ga.php'); ?>
</head>
<body>
	<?php $now="login"; ?>
	<?php include('topmenu.php'); ?>

	<div class="passreset-wrap">
		<?php include 'logo.php'; ?>

		<div class="area1">
			<?php include 'menu.php'; ?>
		</div><!-- area1 end -->

		<div class="area2">

			<form action="<?php echo $loginFormAction;?>"  method="post" enctype="multipart/form-data" name="resetForm"  id="resetForm">

				<div>

				</div>
				<ul class="center">
					<li class="item1">密碼查詢</li>

					
						<?php
						if(isset($totalRows_RecRestMember) && $totalRows_RecRestMember > 0){
							
							if(isset($newPass) && $newPass!='-1'){

								echo '<li class="item3"><span class="getpassnote">';

								require_once('PHPMailer/class.phpmailer.php');  
								$phpmailer = new PHPMailer();
								$phpmailer->SetLanguage('zh', '/PHPMailer/language/');
								//$phpmailer->IsSMTP(); // telling the class to use SMTP
								$phpmailer->ContentType="text/html";
								$phpmailer->CharSet = "UTF-8";

								$phpmailer->Encoding = 'base64';
								$phpmailer->Timeout = 60; // 60 secs
								//$phpmailer->SMTPKeepAlive = TRUE;
								$phpmailer->SMTPDebug = 1; // 1: message, 2: full result
								/////////////////////////////////////////////////////////////////

								$phpmailer->From="info@hancure.com";
								$phpmailer->FromName="HanCure 漢速敷-會員服務";
								$phpmailer->AddAddress($row_RecRestMember['m_email']);//
								//$phpmailer->AddCC('');
								$phpmailer->IsHTML(true);
								$phpmailer->Subject="HanCure 漢速敷 歡迎您的加入";
								$mailBody=nl2br("日安~~".
								  "<P>系統已重新設定新的密碼，<br>".
								  "新密碼：".$newPass.
								  "請您使用新密碼登入官網，並至會員資料修改您的新密碼。</P>	  

								  <p>若對 HanCure 漢速敷 的會員服務有任何疑問或建議，<br>
								  歡迎來信至 info@hancure.com，敬祝一切順心~<br>
								  <a href='http://www.hancure.com/' target='_blank'>http://www.hancure.com/</a></p>

								  <p>＊請注意：本信件為系統自動發信，請勿直接回覆，其他問題，請來信info@hancure.com，謝謝您！＊</p>
								  <p>=================================================================</p>

								  <p>
								  FB <a href='http://tiny.cc/hancure' target='_blank'>http://tiny.cc/hancure</a>。 官網 <a href='http://www.hancure.com/' target='_blank'>http://www.hancure.com/</a>
								  </p>
								  "
								);

								$phpmailer->Body=$mailBody;
								if(!$phpmailer->send()) {
									echo '發送重設密碼信失敗，請於稍後再重新設定或連絡客服，謝謝。<br>';
								   	echo 'Mailer Error: ' . $phpmailer->ErrorInfo;
								}else{
									echo "已將新密碼，<br>寄送至您設定的EMAIL，<br>請至信箱確認EMAIL。";
								}

								//echo $newPass;
								echo '</span></li>';
								
							}
						}elseif(isset($totalRows_RecRestMember) && $totalRows_RecRestMember==0){

							echo '<li class="item3"><span class="getpassnote">';
							echo "查詢不到此帳號，<br>請重新確認您的帳號。";
							echo '</span></li>';
						}
						
						?>
					

					<li class="item2"><span class="item3">
					  <input name="resetAccount" type="text" class="textcss" id="resetAccount" placeholder="會員帳號(電子郵件)">
					</span></li>

					<li class="item5" id="resetSubmit">查詢</li>


				</ul><!-- ul.right end -->				
                
                <input type="hidden" name="MM_insert" value="resetForm" />
                <input name="resetC" type="hidden" id="resetC" value="0" />
			</form>

		</div><!-- area2 end -->

	</div><!-- login-wrap end -->

	<?php include 'backtotop.php'; ?>
	<?php include 'footer.php'; ?>

<script type="text/javascript">


$(document).ready(function() {
	  
	  $("#resetForm").validate({
		//debug: true,
		ignore:[],
		rules: {
			resetAccount	: {
				required: true,
				minlength: 6,
				email: true
				}
	    },
	    messages: {
		  resetAccount: {
			  required: "必填欄位",
			  minlength: "至少輸入六個字元",
	          email: "請檢查EMAIL格式"
		  }
	    }
	  });
	  
	   $("#resetSubmit").click(function() {
		  //console.log($("#addForm").valid());
		  if($("#resetForm").valid()==true){
			  $("#resetC").val(1);
		  }		  
		  $("#resetForm").submit();		  
	  });

});

</script>

</body>
</html>
