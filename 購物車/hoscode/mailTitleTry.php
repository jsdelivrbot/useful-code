<?php

require_once('PHPMailer/class.phpmailer.php');
	$phpmailer = new PHPMailer();
	$phpmailer->SetLanguage('zh', '/PHPMailer/language/');
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
	//$phpmailer->SMTPDebug = 1; // 1: message, 2: full result
	/////////////////////////////////////////////////////////////////

	$phpmailer->From="chunhanstudio@gmail.com";
	$phpmailer->FromName="C+H-會員服務";
	$phpmailer->AddAddress("williamboss.tw@yahoo.com.tw");//
	//$phpmailer->AddCC('');
	$phpmailer->IsHTML(true);
	$phpmailer->Subject="C+H 歡迎您的加入";
	$mailBody=nl2br("william hsu"." 日安~~".
	  "<P>您的會員帳號資訊如下：<br>".
	  "帳號：".
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
	/*$phpmailer->Body=$mailBody;
	if(!$phpmailer->send()) {
		echo 'Message could not be sent.';
	   	echo 'Mailer Error: ' . $phpmailer->ErrorInfo;
	}else{
		echo "已寄出";
	}*/


?>
<?php require_once('Connections/connect2data.php'); ?>
<?php //require_once('Connections/session.initialize.php'); ?>
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

$oid = "2";
$colname_RecOrder = "-1";
if (isset($oid)) {
  $colname_RecOrder = $oid;
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecOrder = sprintf("SELECT * FROM order_set WHERE o_id = %s", GetSQLValueString($colname_RecOrder, "int"));
$RecOrder = mysql_query($query_RecOrder, $connect2data) or die(mysql_error());
$row_RecOrder = mysql_fetch_assoc($RecOrder);
$totalRows_RecOrder = mysql_num_rows($RecOrder);

$colname_RecOrderItem = "-1";
if (isset($oid)) {
  $colname_RecOrderItem = $oid;
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecOrderItem = sprintf("SELECT * FROM order_item WHERE o_id = %s ORDER BY oi_id ASC", GetSQLValueString($colname_RecOrderItem, "int"));
$RecOrderItem = mysql_query($query_RecOrderItem, $connect2data) or die(mysql_error());
$row_RecOrderItem = mysql_fetch_assoc($RecOrderItem);
$totalRows_RecOrderItem = mysql_num_rows($RecOrderItem);



require_once('js/fun_moneyFormat.php');
require_once('js/fun_changeStr.php');
$k=1;
$m_content = '';
?>
<?php do { ?>
<?php 

$d_price1 = '$'.moneyFormat(round( $row_RecOrderItem['d_price1']));
$subTotal = '$'.moneyFormat($row_RecOrderItem['subtotal']);
$styleC = " style='border-bottom:1px solid #AAA;'";
$m_content = $m_content . "<tr>
				<td align='center'".$styleC.">".$row_RecOrderItem['d_name']."</td>
				<td align='center'".$styleC.">".$d_price1."</td>
				<td align='center'".$styleC.">".$row_RecOrderItem['qty']."</td>
				<td align='center'".$styleC.">".$subTotal."</td>
				</tr>";

$k++;


?>
<?php } while ($row_RecOrderItem = mysql_fetch_assoc($RecOrderItem)); ?>
<?php 

$paymentStep='';
if($row_RecOrder['payment']==1){
	
	$payment = 'ATM 虛擬帳戶匯款';
	/*$paymentStep = '<p>當您的訂單資料成立後，您需於3 天內完成匯款，以利如期出貨。<br />
                    轉帳銀行:中國信託銀行(822)<br />帳號：613-54046670-8</p>';*/
					
	if($row_RecOrder['m_account']!=''){
		$paymentStep += '<p>請於匯款後，點此<a href="http://www.chstudio2010.com/member_login.php" target="_blank">連結</a>並依照一下列步驟進行匯款回報。</p>
<p>Step1.登入會員 -&gt; Step2.訂單紀錄-&gt; Step3.填寫匯款資訊。</p>
<p><strong>Step1.登入會員</strong></p>
<img src="http://www.chstudio2010.com/step/step1.jpg" />
<p><strong>Step2.點選訂單紀錄，並選擇要回報之訂單</strong></p>
<img src="http://www.chstudio2010.com/step/step2.jpg" />
<img src="http://www.chstudio2010.com/step/step3.jpg" />
<p><strong>Step1.填寫匯款資訊</strong></p>
<img src="http://www.chstudio2010.com/step/step4.jpg" /><br><br>';
	}else{
		$paymentStep += '<p>請於匯款後，回報匯款資訊如下二種方式：
						<br>1.服務專線：+886 7 3106766
						<br>2.EMAIl(chunhanstudio@gmail.com)
						<br><br>';
	}

}elseif($row_RecOrder['payment']==2){
	
	$payment = '超商店到店';
	/*$paymentStep = '<p>選擇超商店到店者，在實際送貨收款時，除訂單明細的總金額外，每筆訂單會另加收 30元 代收款項手續費。<br>超商店到店金額超過2萬元者，請改用ATM匯款，謝謝您。</p>';*/
	
}

if( $row_RecOrder['tfee'] == 0 ){
	$fr = '免運費';
}else{
	$fr = '$'.moneyFormat($row_RecOrder['tfee']);
}
$TotalAll = '$'.moneyFormat($row_RecOrder['SubTotalAll']);
$grandTotal = '$'.moneyFormat($row_RecOrder['GrandTotal']);

//$RIDNB = (isset($row_RecOrder['RID'])) ? $row_RecOrder['RID'] : '無';
$RIDNB = '無';
?>						
<?php 
if(isset($oid)){
	
	require_once('PHPMailer/class.phpmailer.php');
	date_default_timezone_set('Asia/Taipei');
	mb_internal_encoding('UTF-8');
//使用phpmailer函式所寫的新的發信程式
if($totalRows_RecOrder>0){
$r_gender =	($row_RecOrder['r_gender']==1) ? ' 先生' : ' 小姐';
$phpmailer = new PHPMailer();
$phpmailer->SetLanguage('zh', 'PHPMailer/language/'); 
$phpmailer->ContentType="text/html";
//$phpmailer->CharSet="utf-8";
//$phpmailer->CharSet = "UTF-8";
$phpmailer->CharSet = "utf-8";
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
//$phpmailer->SMTPDebug = 2; // 1: message, 2: full result
/////////////////////////////////////////////////////////////////
//$phpmailer->From="chunhanstudio@gmail.com";
//$phpmailer->FromName="C+H-線上購物訂購單通知";

$phpmailer->SetFrom('chunhanstudio@gmail.com', "C+H訂購通知");
$phpmailer->AddReplyTo("chunhanstudio@gmail.com","C+H訂購通知");
$phpmailer->Subject    = "C+H-線上購物訂購單通知";

//$phpmailer->AddAddress('williams188@msn.com');
$phpmailer->AddAddress("williamboss.tw@yahoo.com.tw", $row_RecOrder['client']);//
//$phpmailer->AddCC('williams188@msn.com');
//$phpmailer->AddBCC("williambossmailg@gmail.com","C+H-訂購單通知");
$phpmailer->IsHTML(true);
//$phpmailer->Subject="C+H-線上購物訂購單通知";
$mailBody=$row_RecOrder['client']."，您好！<br><br>"
				."歡迎您於C+H線上購物，以下為您的購物單明細<br>"
				."================================================================="."<br>"
				."訂單編號：".$row_RecOrder['o_number']."<br>"
				."訂購日期：".substr($row_RecOrder['datetime'],0,10)."<br>"
				."付款方式：".$payment."<br>"
				."收件人：".$row_RecOrder['r_client'].$r_gender."<br>"
				."收件人聯絡電話：".$row_RecOrder['r_cellphone']."<br>"
				."收件地址：".$row_RecOrder['r_zipcode'].$row_RecOrder['r_address']."<br>"
				."備註：".nl2br($row_RecOrder['notation'])."<br><br>"
				."訂購明細：<br><br>"
				."<table width='500' border='1' cellspacing='0' cellpadding='0' bordercolor='#CCCCCC' bgcolor='#F9F9F9'>"
				."<tbody><tr>
					<td align='center'".$styleC."><strong>品名</strong></td>
					<td align='center'".$styleC."><strong>售價</strong></td>			
					<td align='center'".$styleC."><strong>數量</strong></td>				
					<td align='center'".$styleC."><strong>小計</strong></td>
				</tr>"
				.$m_content."</tbody></table><br><br>"
				."<strong>基本運費：".$fr."</strong><br>"
				."<strong>總消費額：NT$ ".$TotalAll."</strong><br>"
				."<strong>總金額：NT$ ".$grandTotal."</strong><br><br>"
				."匯款資訊：<br>"
				."轉帳銀行:中國信託銀行 (822)<br>"
				."帳號:     613-54046670-8<br><br>"
				."選擇ATM轉帳的買家請於完成匯款後，進入會員系統/訂單紀錄，回覆匯款資訊。<br>"
				."請於7日內完成匯款，以利將盡快商品寄出。C+H 保留訂單確認的最終權利。<br><br>"
				."如需取消/修改訂單，或其他問題，請來信chunhanstudio@gmail.com，謝謝您！<br><br>"
				.$paymentStep
				."================================================================="
				."<p>
				  FB <a href='https://www.facebook.com/chstudio2010' target='_blank'>https://www.facebook.com/chstudio2010</a>。 官網 <a href='http://www.chstudio2010.com/' target='_blank'>http://www.chstudio2010.com/</a>
				  </p>"
				  ;

$phpmailer->Body=$mailBody;

//$phpmailer->Send();

if(!$phpmailer->Send()) {
	echo "Mailer Error: " . $phpmailer->ErrorInfo;
}else{
	//return 'ok';
	////echo 1;
	//$insertGoTo = "driveraddsuccess_mailok.php";
	//header(sprintf("Location: %s", $insertGoTo));
	//;
}


//echo $mailBody;

?>

<?php 
$phpmailer = new PHPMailer();
$phpmailer->SetLanguage('zh', 'PHPMailer/language/'); 
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
//$phpmailer->SMTPDebug = 2; // 1: message, 2: full result
/////////////////////////////////////////////////////////////////
//$phpmailer->From="chunhanstudio@gmail.com";
//$phpmailer->FromName="C+H-線上購物出貨單通知";

$phpmailer->SetFrom('chunhanstudio@gmail.com', "C+H");
$phpmailer->AddReplyTo("chunhanstudio@gmail.com","C+H");
$phpmailer->Subject    = "C+H-線上購物訂購單通知";


//$phpmailer->AddAddress('chunhanstudio@gmail.com', 'C+H-訂購單通知');//
$phpmailer->AddAddress('williamboss.tw@yahoo.com.tw', 'C+H-訂購單通知');//
//$phpmailer->AddCC('williams188@msn.com');
//$phpmailer->AddBCC("williambossmailg@gmail.com", 'C+H-訂購單通知');
$phpmailer->IsHTML(true);
//$phpmailer->Subject="C+H-線上購物出貨單通知";
$mailBody="C+H線上購物訂單管理員，您好！<br>"
				."以下為客戶".$row_RecOrder['client']."先生/小姐之訂購單<br><br>"
				."================================================================="."<br>"
				
				
				."訂單編號：".$row_RecOrder['o_number']."<br>"
				."訂購日期：".substr($row_RecOrder['datetime'],0,10)."<br>"
				."付款方式：".$payment."<br>"
				."收件人：".$row_RecOrder['r_client'].$r_gender."<br>"
				."收件人聯絡電話：".$row_RecOrder['r_cellphone']."<br>"
				."收件地址：".$row_RecOrder['r_zipcode'].$row_RecOrder['r_address']."<br>"
				."備註：".nl2br($row_RecOrder['notation'])."<br><br>"
				."<table width='500' border='1' cellspacing='0' cellpadding='0' bordercolor='#CCCCCC' bgcolor='#F9F9F9'>"
				."<tbody><tr>
					<td align='center'".$styleC."><strong>品名</strong></td>
					<td align='center'".$styleC."><strong>售價</strong></td>			
					<td align='center'".$styleC."><strong>數量</strong></td>				
					<td align='center'".$styleC."><strong>小計</strong></td>
				</tr>"
				.$m_content."</tbody></table><br>"
				."<strong>基本運費：".$fr."</strong><br>"
				."<strong>總消費額：NT$ ".$TotalAll."</strong><br>"
				."<strong>總金額：NT$ ".$grandTotal."</strong><br>"
				."================================================================="."<br><br>"
				."請您盡速處理訂單。"
;
$phpmailer->Body=$mailBody;
if(!$phpmailer->Send()) {
	echo "Mailer Error: " . $phpmailer->ErrorInfo;
}else{
	//return 'ok';
	////echo 1;
	//$insertGoTo = "driveraddsuccess_mailok.php";
	//header(sprintf("Location: %s", $insertGoTo));
	//;
}
//echo $mailBody;

?>
<?php  
$rows = mysql_num_rows($RecOrderItem);
  if($rows > 0) {
      mysql_data_seek($RecOrderItem, 0);
	  $row_RecOrderItem = mysql_fetch_assoc($RecOrderItem);
  }


 }//isset($oid
}//$totalRows_RecOrder>0
?>  