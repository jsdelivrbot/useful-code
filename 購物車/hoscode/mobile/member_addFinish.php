<?php
require_once('inc/EDcart.php');
if (!isset($_SESSION)) {
  session_start();
}
$cart =& $_SESSION['edCart']; 
if(!is_object($cart)) $cart = new edCart(); 
//echo "item = ".$cart->itemCount;
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

$colname_RecMember = "-1";
if (isset($_SESSION['max_id'])) {
  $colname_RecMember = $_SESSION['max_id'];
  unset($_SESSION['max_id']);
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecMember = sprintf("SELECT * FROM member_set WHERE m_id = %s", GetSQLValueString($colname_RecMember, "int"));
$RecMember = mysql_query($query_RecMember, $connect2data) or die(mysql_error());
$row_RecMember = mysql_fetch_assoc($RecMember);
$totalRows_RecMember = mysql_num_rows($RecMember);


//if(0){
if($totalRows_RecMember>0){

require_once('../PHPMailer/class.phpmailer.php');  
$phpmailer = new PHPMailer();
$phpmailer->SetLanguage('zh', '../PHPMailer/language/');
//$phpmailer->IsSMTP(); // telling the class to use SMTP
$phpmailer->ContentType="text/html";
//$phpmailer->CharSet="utf-8";
$phpmailer->CharSet = "UTF-8";

//////////////////////////////////////////////////////////////////
/*$phpmailer->IsSMTP(); // telling the class to use SMTP
$phpmailer->SMTPAuth   = true;                  // enable SMTP authentication
$phpmailer->SMTPSecure = "tls";
$phpmailer->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$phpmailer->Port       = 587;                   // set the SMTP port for the GMAIL server
$phpmailer->Username   = "williambossmailg@gmail.com";  // GMAIL username
$phpmailer->Password   = "";            // GMAIL password*/

$phpmailer->Encoding = 'base64';
$phpmailer->Timeout = 60; // 60 secs
//$phpmailer->SMTPKeepAlive = TRUE;
$phpmailer->SMTPDebug = 1; // 1: message, 2: full result
/////////////////////////////////////////////////////////////////

$phpmailer->From="chunhanstudio@gmail.com";
$phpmailer->FromName="C+H-會員服務";
$phpmailer->AddAddress($row_RecMember['m_email']);//
//$phpmailer->AddCC('');
$phpmailer->IsHTML(true);
$phpmailer->Subject="C+H 歡迎您的加入";
$mailBody=nl2br($row_RecMember['m_name']." 日安~~".
  "<P>您的會員帳號資訊如下：<br>".
  "帳號：".$row_RecMember['m_account'].
  "請您妥善保管您的帳號與密碼。</P>

  <p>未來，您可以使用此帳號、密碼登入官網，<br>您可使用您所申請的會員帳號登入，並享受不定期會員服務哦！。</p>

  <p>若對 C+H 的會員服務有任何疑問或建議，<br>
  歡迎來信至 chunhanstudio@gmail.com，敬祝一切順心~<br>
  <a href='http://www.chstudio2010.com/' target='_blank'>http://www.chstudio2010.com/</a></p>

  <p>＊請注意：本信件為系統自動發信，請勿直接回覆，其他問題，請來信chunhanstudio@gmail.com，謝謝您！＊</p>
  <p>=================================================================</p>

  <p>
  FB <a href='https://www.facebook.com/chstudio2010' target='_blank'>https://www.facebook.com/chstudio2010</a>。 官網 <a href='http://www.chstudio2010.com/' target='_blank'>http://www.chstudio2010.com/</a>
  </p>
  "
);
$phpmailer->Body=$mailBody;
if(!$phpmailer->send()) {
	echo 'Message could not be sent.';
   	echo 'Mailer Error: ' . $phpmailer->ErrorInfo;
}
}

?>
<?php require_once('../Connections/session.initialize.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>C+H</title>

	<?php include('meta.php') ?>

	<script src="js/jquery/1.11.1/jquery.min.js"></script>

	<link rel="stylesheet/less" type="text/css" href="style_ryder.less">
	<script src="js/less-1.3.0.min.js" type="text/javascript"></script>

	<style type="text/css">
		.big-mb{
			margin-bottom: 35px;
		}
		.shorttext{
			width: 115px;
		}
		.savebtn{
			text-align: center;
		}
	</style>

</head>
<body>

	<?php include 'topmenu-fixed.php'; ?>

	<div class="fortopmenupush"></div>



	<div class="bigtitle">會員註冊</div>

	<div class="addFinish">
    C+H歡迎您的加入<br>

您可以登入會員，並可查詢購買紀錄！

<a href="member_login.php" class="loginBtn">會員登入</a>
    </div>
    


	<?php include 'footer.php'; ?>
</body>
</html>

