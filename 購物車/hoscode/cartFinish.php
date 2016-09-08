<?php
//加入購物車Class的宣告
require_once('inc/EDcart.php');
if (!isset($_SESSION)) {
	session_start();
}
ob_start();

$cart =& $_SESSION['edCart']; 
if(!is_object($cart)) $cart = new edCart(); 
//echo "item = ".$cart->itemCount;
//echo 'o_id = '.$_SESSION['o_id'].'<br>';
//購物車為空時重新導向指定頁
if ( !(isset($_SESSION['o_num'])) || $_SESSION['o_num']=='' ){
    echo "<script>
			window.location = 'cartBasketEmpty.php';
		</script>";
}
$_SESSION['receiveTime'] = 'finish';
unset($_SESSION['receiveTime']);
//echo 'm_id = '.$_SESSION['m_id'].'<br>';
//echo 'm_account = '.$_SESSION['m_account'].'<br>';
//echo 'ma = '.$_SESSION['ma'].'<br>';
?>
<?php require_once('login_query.php'); ?>
<?php require_once('mobileCheck.php'); ?>
<?php require_once('Connections/connect2data.php'); ?>
<?php require_once('Connections/session.initialize.php'); ?>
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

$colname_RecNewMember = "-1";
if (isset($_SESSION['m_id'])) {
  $colname_RecNewMember = $_SESSION['m_id'];
  unset($_SESSION['m_id']);
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecNewMember = sprintf("SELECT * FROM member_set WHERE m_id = %s", GetSQLValueString($colname_RecNewMember, "int"));
$RecNewMember = mysql_query($query_RecNewMember, $connect2data) or die(mysql_error());
$row_RecNewMember = mysql_fetch_assoc($RecNewMember);
$totalRows_RecNewMember = mysql_num_rows($RecNewMember);

//echo "totalRows_RecNewMember = ".$totalRows_RecNewMember.'<br>';

$colname_RecOrder = "-1";
if (isset($_SESSION['o_num'])) {
  $colname_RecOrder = $_SESSION['o_num'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecOrder = sprintf("SELECT * FROM order_set WHERE o_number = %s", GetSQLValueString($colname_RecOrder, "text"));
$RecOrder = mysql_query($query_RecOrder, $connect2data) or die(mysql_error());
$row_RecOrder = mysql_fetch_assoc($RecOrder);
$totalRows_RecOrder = mysql_num_rows($RecOrder);

$colname_RecOrderItem = "-1";
if (isset($row_RecOrder['o_id'])) {
  $colname_RecOrderItem = $row_RecOrder['o_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecOrderItem = sprintf("SELECT * FROM order_item WHERE o_id = %s ORDER BY oi_id ASC", GetSQLValueString($colname_RecOrderItem, "int"));
$RecOrderItem = mysql_query($query_RecOrderItem, $connect2data) or die(mysql_error());
$row_RecOrderItem = mysql_fetch_assoc($RecOrderItem);
$totalRows_RecOrderItem = mysql_num_rows($RecOrderItem);

$colname_RecResponse = "-1";
if (isset($row_RecOrder['o_id'])) {
  $colname_RecResponse = $row_RecOrder['o_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecResponse = sprintf("SELECT * FROM response_set WHERE r_o_id = %s AND r_lidm = %s ORDER BY r_o_id ASC", GetSQLValueString($colname_RecResponse, "int"),
	GetSQLValueString($_SESSION['o_num'], "text"));
$RecResponse = mysql_query($query_RecResponse, $connect2data) or die(mysql_error());
$row_RecResponse = mysql_fetch_assoc($RecResponse);
$totalRows_RecResponse = mysql_num_rows($RecResponse);

/*$tmp_num = sprintf("%05d", 2+1);
echo $o_number = 'RY'.date('ymd').$tmp_num;*/
//echo $_SERVER["HTTP_USER_AGENT"].'<br>';
//echo $_SERVER["HTTP_ACCEPT_LANGUAGE"].'<br>';

if($totalRows_RecNewMember>0 && $_SESSION['ma']=='add'){
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
	$phpmailer->AddAddress($row_RecNewMember['m_email']);//
	//$phpmailer->AddCC('');
	$phpmailer->IsHTML(true);
	$phpmailer->Subject="C+H 歡迎您的加入";
	$mailBody=nl2br($row_RecNewMember['m_name']." 日安~~".
	  "<P>您的會員帳號資訊如下：<br>".
	  "帳號：".$row_RecNewMember['m_account'].
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
		echo 'MEMBER Message could not be sent.';
	   	echo 'Mailer Error: ' . $phpmailer->ErrorInfo;
	}
}

require_once('js/fun_moneyFormat.php');
require_once('js/fun_changeStr.php');
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

<link rel="stylesheet/less" type="text/css" href="style_ryder.less">
<script src="js/less-1.3.0.min.js" type="text/javascript"></script>

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

		<div class="area3"  id="List"><img src="img/order-top.png" ></div><!-- area3 end -->

		<div class="area4"> <!-- 商品清單 -->
        
<?php
$memberStasus = ( (isset($row_RecOrder['m_id'])) && ($row_RecOrder['m_id']!='') ) ? TRUE : FALSE ;
//echo 'memberStasus = '.$memberStasus;
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

if($row_RecOrder['payment']==1){
		
		$payment = 'ATM 虛擬帳戶匯款';
		$paymentStep = '<p>當您的訂單資料成立後，依訂單專屬的帳號資訊，請您依據此組帳號進行轉帳即可；提醒您需於到貨日3天前完成匯款，以利如期出貨。</p>';
						
		if($row_RecOrder['m_account']!=''){
			$paymentStep += '<p>請於匯款後，點此<a href="http://www.chstudio2010.com/member_login.php" target="_blank">連結</a>並依照一下列步驟進行匯款回報。</p>
				<p>Step1.登入會員 -&gt; Step2.訂單紀錄-&gt; Step3.填寫匯款資訊。</p>
				<p><strong>Step1.登入會員</strong></p>
				<img src="http://www.chstudio2010.com/step/step1.png" />
				<p><strong>Step2.點選訂單紀錄，並選擇要回報之訂單</strong></p>
				<img src="http://www.chstudio2010.com/step/step2.png" />
				<img src="http://www.chstudio2010.com/step/step3.png" />
				<p><strong>Step1.填寫匯款資訊</strong></p>
				<img src="http://www.chstudio2010.com/step/step4.png" /><br><br>';
		}else{
			$paymentStep += '<p>請於匯款後，回報匯款資訊如下方式：
							<br>1.EMAIl(chunhanstudio@gmail.com)
							<br><br>';
		}

}elseif($row_RecOrder['payment']==2){
	
	$payment = '超商店到店';
	$paymentStep = '<p>選擇超商店到店者，在實際收到ATM匯款後將商品寄出。</p>';
	
}elseif($row_RecOrder['payment']==3){

	require_once('orders_statusA.php');
	require_once('allpayMsg.php');

	if($row_RecOrder['card_status']!=3){
		$colname_RecResponse = "-1";
		if (isset($row_RecOrder['o_id'])) {
		  $colname_RecResponse = $row_RecOrder['o_id'];
		}
		mysql_select_db($database_connect2data, $connect2data);
		$query_RecResponse = sprintf("SELECT * FROM response_set WHERE r_o_id = %s AND r_lidm = %s ORDER BY r_o_id ASC", GetSQLValueString($colname_RecResponse, "int"),
			GetSQLValueString($_SESSION['o_num'], "text"));
		$RecResponse = mysql_query($query_RecResponse, $connect2data) or die(mysql_error());
		$row_RecResponse = mysql_fetch_assoc($RecResponse);
		$totalRows_RecResponse = mysql_num_rows($RecResponse);

		if($totalRows_RecResponse>0){

			if($row_RecResponse['r_status']==-1){
				$r_status = 0;
				$statusNote = $statusArray[$r_status];
			}elseif($row_RecResponse['r_status']==1){

				
				if (array_key_exists($row_RecResponse['r_RtnCode'], $msgA)){
					$statusNote = $msgA[$row_RecResponse['r_RtnCode']];
				}else{
					$statusNote = '刷卡未知錯誤，'.$row_RecResponse['r_RtnCode'].'請連絡客服。';
				}
				
			}elseif($row_RecResponse['r_status']==0){

				
				if (array_key_exists($row_RecResponse['r_RtnCode'], $msgA)){
					$statusNote = $msgA[$row_RecResponse['r_RtnCode']];
				}else{
					$statusNote = '刷卡未知錯誤，'.$row_RecResponse['r_RtnCode'].'請連絡客服。';
				}
				
			}

		}
	}else{
		$r_status = 3;
		$statusNote = $statusArray[$r_status];
	}
	
	$payment = '線上刷卡 - '.$statusNote;
	
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
if(isset($_SESSION['o_id'])){
	
	require_once('PHPMailer/class.phpmailer.php');
	
//使用phpmailer函式所寫的新的發信程式
if($totalRows_RecOrder>0){
$r_gender =	($row_RecOrder['r_gender']==1) ? ' 先生' : ' 小姐';
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
$phpmailer->SMTPDebug = 2; // 1: message, 2: full result
/////////////////////////////////////////////////////////////////
//$phpmailer->From="chunhanstudio@gmail.com";
//$phpmailer->FromName="C+H-線上購物訂購單通知";

$phpmailer->SetFrom('chunhanstudio@gmail.com', "C+H訂購通知");
$phpmailer->AddReplyTo("chunhanstudio@gmail.com","C+H訂購通知");
$phpmailer->Subject    = "C+H-線上購物訂購單通知";

//$phpmailer->AddAddress('williams188@msn.com');
$phpmailer->AddAddress($row_RecOrder['email'], $row_RecOrder['client']);//
//$phpmailer->AddCC('williams188@msn.com');
$phpmailer->AddBCC("williambossmailg@gmail.com","C+H-訂購單通知");
$phpmailer->IsHTML(true);
//$phpmailer->Subject="C+H-線上購物訂購單通知";
$mailBody=$row_RecOrder['client']."，您好！<br><br>"
				."歡迎您於C+H線上購物，以下為您的購物單明細<br>"
				."================================================================="."<br>"
				."訂單編號：".$row_RecOrder['o_number']."<br>"
				."訂購日期：".substr($row_RecOrder['datetime'],0,10)."<br>"
				."付款方式：".$payment."<br>"
				."收件人：".$row_RecOrder['r_client']."<br>"
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
$phpmailer->SMTPDebug = 2; // 1: message, 2: full result
/////////////////////////////////////////////////////////////////
//$phpmailer->From="chunhanstudio@gmail.com";
//$phpmailer->FromName="C+H-線上購物出貨單通知";

$phpmailer->SetFrom('chunhanstudio@gmail.com', "C+H訂購通知");
$phpmailer->AddReplyTo("chunhanstudio@gmail.com","C+H訂購通知");
$phpmailer->Subject    = "C+H-線上購物訂購單通知";


//$phpmailer->AddAddress('chunhanstudio@gmail.com', 'C+H-訂購單通知');//
$phpmailer->AddAddress('williamshsu@gmail.com', 'C+H-訂購單通知');//
//$phpmailer->AddCC('williams188@msn.com');
$phpmailer->AddBCC("williambossmailg@gmail.com", 'C+H-訂購單通知');
$phpmailer->IsHTML(true);
//$phpmailer->Subject="C+H-線上購物出貨單通知";
$mailBody="C+H線上購物訂單管理員，您好！<br>"
				."以下為客戶".$row_RecOrder['client']."先生/小姐之訂購單<br><br>"
				."================================================================="."<br>"
				
				
				."訂單編號：".$row_RecOrder['o_number']."<br>"
				."訂購日期：".substr($row_RecOrder['datetime'],0,10)."<br>"
				."付款方式：".$payment."<br>"
				."收件人：".$row_RecOrder['r_client']."<br>"
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

	if($row_RecOrder['payment']==1 || $row_RecOrder['payment']==2 || $row_RecOrder['payment']==3){
		if(isset($_SESSION['o_num'])){
			$_SESSION['o_num'] = NULL;
			unset($_SESSION['o_num']);
			setcookie("RID", '', time()-3600);
		}
	}

 }//isset($_SESSION['o_id']
}//$totalRows_RecOrder>0
?>      
        <span class="cart-textNote">

        	<?php 
        	if($_SESSION['ma']=='add'){
        		echo "<p>C+H歡迎您的加入<br>您可以登入會員，並可查詢購買紀錄！</p><p></p>";
        		unset($_SESSION['ma']);
        	}
        	?>
        	

			<p><?php echo $row_RecOrder['client']; ?>，我們會儘快將您選購的商品寄出！</p>
        <p>再次謝謝您熱情地參與C+H線上購物！</p>
        <p></p>
        <h4 class="sweetNote">貼心小叮嚀</h4>

            <p>已email一份訂購單到您的電子信箱。</p>
            <p>選擇ATM轉帳的買家，請於完成匯款後，</p>
            <p>進入會員系統/訂單紀錄，回覆匯款資訊，謝謝。</p>

            <?php if($row_RecOrder['payment']==1){ ?>
            <!-- <p></p>
                    	<p>轉帳銀行:中國信託銀行(822)<br />帳號：613-54046670-8</p> -->
        	<?php } ?>
        
        </span>
        
        </div>

	</div>

	<?php include 'backtotop.php'; ?>
	<?php include 'footer.php'; ?>

</body>
</html>

