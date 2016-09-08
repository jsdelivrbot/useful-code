<?php
if(!isset($_SESSION)){
	session_start();
}
?>
<?php require_once('Connections/connect2data.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
	function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
	{
		$theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

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
			$theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
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

if (!isset($_SESSION['checkPost'])) {
	header("Location: index.php");
}
if($_SESSION['checkPost'] == 1 ){
	unset($_SESSION['checkPost']);
	header("Location: index.php");
}
//echo "checkPost = ".$_SESSION['checkPost'];
$err = "";
$message = "";

// google recaptcha
// echo $_POST['g-recaptcha-response'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>六角國際事業股份有限公司</title>

	<?php include('meta.php') ?>

	<script src="js/jquery/1.11.1/jquery.min.js"></script>

	<script src="js/jquery.validate.min.js"></script>
	<script src="js/jquery.tooltipster.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/tooltipster.css">


	<script src='https://www.google.com/recaptcha/api.js?hl=zh-TW' async defer></script>

	<link rel="stylesheet/less" type="text/css" href="style_ryder.less">
	<script src="js/less-1.3.0.min.js"></script>

	<style type="text/css">
		#g-recaptcha{
			display: inline-block;
		}
		#hiddenRecaptcha{
			position: absolute;
			z-index: -1;
			left: 80px;
			opacity: 0;
		}
		.err, .succ{
			font-family: MHeiHK, "STXihei", HEITI TC, "HEITI TC", "黑體-繁", "微軟正黑體", "黑體", sans-serif;
			font-size: 15px;
			letter-spacing: 1px;
			line-height: 24px;
		}
		.err{
			color: #CB583D;
		}
		.succ{
			color: #8c189b;
		}
	</style>
</head>
<body>
	<?php $now="contact"; ?>
	<?php include 'topmenu.php'; ?>
	<?php include 'socialicon.php'; ?>

	<div class="newsWrap">
		<div class="titlePic">
			<img src="images/contact-titlepic.png" width="189">
		</div>

		<?php
		if ( isset($_POST["MM_insert"]) && ($_POST["MM_insert"] == "subscription") ){

			$_SESSION['checkPost'] = 1;

				$m_title = checkV("m_title");		//d_title
				$m_company = checkV("m_company");	//d_data1
				$m_name = checkV("m_name");			//d_data2
				$m_phone = checkV("m_phone");		//d_data3
				$m_fax = checkV("m_fax");			//d_data4
				$m_mail = checkV("m_mail");			//d_data5
				$m_address = checkV("m_address");	//d_data6
				$m_type = checkV("m_type");			//d_data7
				$m_content = checkV("m_content");	//d_data8

				$insertSQL = sprintf("INSERT INTO data_set (d_title, d_data1, d_data2, d_data3, d_data4, d_data5, d_data6, d_data7, d_content, d_class1, d_date, d_active) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, 'contactUs', NOW(), '1')",

		                       GetSQLValueString($m_title, "text"),	//d_title
		                       GetSQLValueString($m_company, "text"),	//d_data1
		                       GetSQLValueString($m_name, "text"),		//d_data2
		                       GetSQLValueString($m_phone, "text"),	//d_data3
		                       GetSQLValueString($m_fax, "text"),		//d_data4
		                       GetSQLValueString($m_mail, "text"),		//d_data5
		                       GetSQLValueString($m_address, "text"),	//d_data6
		                       GetSQLValueString($m_type, "text"),		//d_data7
		                       GetSQLValueString($m_content, "text"));	//d_content

				mysql_select_db($database_connect2data, $connect2data);
				$Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());


				require_once('PHPMailer/class.phpmailer.php');
				$phpmailer = new PHPMailer();
				$phpmailer->SetLanguage('zh', '/PHPMailer/language/');
				$phpmailer->ContentType="text/html";
				$phpmailer->CharSet = "UTF-8";

				$phpmailer->Encoding = 'base64';
				$phpmailer->Timeout = 60; // 60 secs
				//$phpmailer->SMTPKeepAlive = TRUE;
				//$phpmailer->SMTPDebug = 1; // 1: message, 2: full result
				/////////////////////////////////////////////////////////////////

				$phpmailer->SingleTo = true; //will send mail to each email address individually

				// $phpmailer->SetFrom('group.sales@lakaffa.com.tw', "六角國際");
				$phpmailer->From = 'mail.alogotype.net'; //設定寄件者信箱
				$phpmailer->FromName = "宇揚設計"; //設定寄件者姓名

				// $phpmailer->AddReplyTo("group.sales@lakaffa.com.tw","六角國際");

				$phpmailer->AddAddress('williamshsu@gmail.com', "六角國際");

				//$phpmailer->AddBCC("studio.goods@gmail.com","六角國際-聯絡我們通知");
				$phpmailer->AddBCC("williamshsu@gmail.com","六角國際-聯絡我們通知");

				$phpmailer->IsHTML(true);

				$phpmailer->Subject    = "六角國際-聯絡我們通知-".$m_title;

				$mailContent = nl2br("六角國際官網管理員，您好！<br><br>"
					."下列為客戶 ".$m_company." ".$m_title." 所諮詢的相關資料，<br>"
					."<br>==================================================<br>"
					."公司名稱：".((isset($m_company)?$m_company:"無"))."<br><br>"
					."姓名：".((isset($m_name)?$m_name:"無"))."<br><br>"
					."電話：".((isset($m_phone)?$m_phone:"無"))."<br><br>"
					."傳真：".((isset($m_fax)?$m_fax:"無"))."<br><br>"
					."電子郵件：".((isset($m_mail)?$m_mail:"無"))."<br><br>"
					."地址：".((isset($m_address)?$m_address:"無"))."<br><br>"
					."類別：".((isset($m_type)?$m_type:"無"))."<br><br>"
					."主旨：".((isset($m_title)?$m_title:"無"))."<br><br>"
					."訊息：<br>".((isset($m_content)?$m_content:"無"))."<br/>"
					."<br>==================================================<br>"
					."<br>請您盡快回覆客戶，謝謝。"."<br><br>"
					."<div style='color: red;'>此為系統發信，請勿直接回覆。</div>"
					);


				//$phpmailer->MsgHTML($mailContent);
				$phpmailer->Body=$mailContent;


				if(!$phpmailer->Send()) {
					echo "<div class='err'>傳送時失敗，請稍後再試，或連絡客服！<br>錯誤訊息如下" . $phpmailer->ErrorInfo . "</div>";
					//$message = "<div class='err'>傳送時失敗，請稍後再試，或連絡客服！<br>錯誤訊息如下" . $phpmailer->ErrorInfo . "</div>";

				} else {

					echo "<div class='succ'>我們已經將您的訊息送出嘍！</div>";
					//$message = "<div class='succ'>我們已經將您的訊息送出嘍！</div>";
				  //return 'ok';
				  //echo 1;
				 /* $insertGoTo = "driveraddsuccess_mailok.php";
				  header(sprintf("Location: %s", $insertGoTo));
				  ;*/
				}

			  /*if($Result1){
			  	echo "我們已經將您的需求送出嘍！";
			  }else{
			  	echo "傳送時失敗，請稍後再試，或連絡客服！";
			  }*/

			  unset($_SESSION['checkPost']);

			}

			//echo 'message = '.$message;
			?>
		</div><!-- newsWrap end -->
	</body>
	</html>