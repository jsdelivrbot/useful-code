<?php
require_once('inc/EDcart.php');
if (!isset($_SESSION)) {
  session_start();
}
$cart =& $_SESSION['edCart']; 
if(!is_object($cart)) $cart = new edCart(); 
//echo "item = ".$cart->itemCount;
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

$colname_RecMember = "182";
mysql_select_db($database_connect2data, $connect2data);
$query_RecMember = sprintf("SELECT * FROM member_set WHERE m_id = %s", GetSQLValueString($colname_RecMember, "int"));
$RecMember = mysql_query($query_RecMember, $connect2data) or die(mysql_error());
$row_RecMember = mysql_fetch_assoc($RecMember);
$totalRows_RecMember = mysql_num_rows($RecMember);

echo 'totalRows_RecMember = '.$totalRows_RecMember .'<br>';
//if(0){
if($totalRows_RecMember>0){

require_once('PHPMailer/class.phpmailer.php');  
$phpmailer = new PHPMailer();
$phpmailer->SetLanguage('zh', 'PHPMailer/language/');
//$phpmailer->IsSMTP(); // telling the class to use SMTP
$phpmailer->ContentType="text/html";
$phpmailer->CharSet="utf-8";

//////////////////////////////////////////////////////////////////
//$phpmailer->IsSMTP(); // telling the class to use SMTP
/*$phpmailer->SMTPDebug = 4; // 1: message, 2: full result
$phpmailer->SMTPAuth   = true;                  // enable SMTP authentication
$phpmailer->SMTPSecure = "tls";
$phpmailer->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$phpmailer->Port       = 587;                   // set the SMTP port for the GMAIL server*/
$phpmailer->IsHTML(true);
/*$phpmailer->Username   = "williambossmailg@gmail.com";  // GMAIL username
$phpmailer->Password   = "";            // GMAIL password*/

$phpmailer->Encoding = 'base64';
$phpmailer->Timeout = 60; // 60 secs
//$phpmailer->SMTPKeepAlive = TRUE;
/////////////////////////////////////////////////////////////////

$phpmailer->From="chunhanstudio@gmail.com";
$phpmailer->FromName="小罐子點心鋪-會員服務";
$phpmailer->AddAddress($row_RecMember['m_email']);//
//$phpmailer->AddCC('');
$phpmailer->Subject="小罐子點心鋪-會員服務";
$mailBody=nl2br("哈囉！".$row_RecMember['m_name']."
<P>小罐子點心鋪歡迎您的加入，
</br>您的會員帳號是：".$row_RecMember['m_account']."
</br>請您妥善保管您的帳號與密碼。</P>
<p>未來，您可以利用此帳號、密碼登入官網，您可使用您所申請的會員帳號登入，並享受會員服務哦！。</p>

</br>
</br>小罐子點心鋪再次歡迎您的加入！
</br><a href=\"http://www.petitpot.tw/\">http://www.petitpot.tw/</a>"

);
$phpmailer->Body=$mailBody;
	if(!$phpmailer->send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $phpmailer->ErrorInfo;
	}else{
		echo 'send already!';	
	}
}

?>
<?php require_once('Connections/session.initialize.php'); ?>