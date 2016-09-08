<?php
if (!isset($_SESSION)) {
	session_start();
}
ob_start();

require_once('../Connections/connect2data.php');
require_once('../Connections/session.initialize.php');

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

require_once('../AioSDK/sdk/AllPay.Payment.Integration.php');
require_once('../AioSDK/HAKIVMID.php');
/*
* 接收訂單資料產生完成的範例程式碼。
*/
try
{
	$oPayment = new AllInOne();
	/* 服務參數 */
	//AllPay提供給您的Hash Key
	$oPayment->HashKey = _HASHKEY;
	//AllPay提供給您的Hash IV
	$oPayment->HashIV = _HASHIV;
	//AllPay提供給您的特店編號
	$oPayment->MerchantID = _MERCHANTID;
	/* 取得回傳參數 */
	$arFeedback = $oPayment->CheckOutFeedback();
	/* 檢核與變更訂單狀態 */
	if (sizeof($arFeedback) > 0) {
		foreach ($arFeedback as $key => $value) {
			switch ($key)
			{
				/* 支付後的回傳的基本參數 */
				//廠商編號
				case "MerchantID": $szMerchantID = $value; break;
				//廠商交易編號
				case "MerchantTradeNo": $szMerchantTradeNo = $value; break;
				//付款時間
				case "PaymentDate": $szPaymentDate = $value; break;
				//付款方式
				case "PaymentType": $szPaymentType = $value; break;
				//通路費
				case "PaymentTypeChargeFee": $szPaymentTypeChargeFee = $value; break;
				//交易狀態
				case "RtnCode": $szRtnCode = $value; break;
				//交易訊息
				case "RtnMsg": $szRtnMsg = $value; break;
				//是否為模擬付款
				case "SimulatePaid": $szSimulatePaid = $value; break;
				//交易金額
				case "TradeAmt": $szTradeAmt = $value; break;
				//訂單成立時間
				case "TradeDate": $szTradeDate = $value; break;
				//AllPay 的交易編號
				case "TradeNo": $szTradeNo = $value; break;
				default: break;
			}
		}
		// 其他資料處理。

		$rdate = date('Y/m/d H:i:s');
		mysql_select_db($database_connect2data, $connect2data);
		$updateSQL = "UPDATE response_set SET 
					MerchantID = ".GetSQLValueString($szMerchantID, "text").",
					MerchantTradeNo = ".GetSQLValueString($szMerchantTradeNo, "text").",
					PaymentDate = ".GetSQLValueString($szPaymentDate, "date").",
					PaymentType = ".GetSQLValueString($szPaymentType, "text").",
					PaymentTypeChargeFee = ".GetSQLValueString($szPaymentTypeChargeFee, "int").",
					RtnCode = ".GetSQLValueString($szRtnCode, "int").",
					RtnMsg = ".GetSQLValueString($szRtnMsg, "text").",
					SimulatePaid = ".GetSQLValueString($szSimulatePaid, "int").",
					TradeAmt = ".GetSQLValueString($szTradeAmt, "int").",
					TradeDate = ".GetSQLValueString($szTradeDate, "date").",
					TradeNo = ".GetSQLValueString($szTradeNo, "text").",
					ReturnStatus  = ".GetSQLValueString( 1 , "int").",
					ReturnTime = ".GetSQLValueString($rdate, "date")."
					WHERE r_lidm = ".GetSQLValueString($szMerchantTradeNo, "text");
		$result = mysql_query($updateSQL) or die('Error, UPDATE query failed');
		//$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());



		require_once('../PHPMailer/class.phpmailer.php');
		$phpmailer = new PHPMailer();
		$phpmailer->SetLanguage('zh', '../PHPMailer/language/'); 
		$phpmailer->ContentType="text/html";
		$phpmailer->CharSet="utf-8";
		$phpmailer->Encoding = 'base64';
		//$phpmailer->From="chunhanstudio@gmail.com";
		//$phpmailer->FromName="C+H-線上購物訂購單通知";
		$phpmailer->SetFrom('chunhanstudio@gmail.com', 'C+H-線上購物訂購單通知');
		//$phpmailer->AddAddress('williams188@msn.com');
		$phpmailer->AddAddress('williamshsu@gmail.com');//
		//$phpmailer->AddCC('williams188@msn.com');
		//$phpmailer->AddBCC("williamshsu@gmail.com");
		$phpmailer->IsHTML(true);
		$phpmailer->Subject="C+H-刷卡回傳通知";
		$mailBody="================================================================="."<br>"
						."廠商編號 MerchantID：".$szMerchantID."<br>"
						."廠商交易編號 MerchantTradeNo：".$szMerchantTradeNo."<br>"
						."付款時間 PaymentDate：".$szPaymentDate."<br>"
						."付款方式 PaymentType：".$szPaymentType."<br>"
						."通路費 PaymentTypeChargeFee：".$szPaymentTypeChargeFee."<br>"
						."授權碼 RtnCode：".$szRtnCode."<br>"
						."交易訊息 RtnMsg：".$szRtnMsg."<br>"
						."是否為模擬付款 SimulatePaid：".$szSimulatePaid."<br>"
						."交易金額 TradeAmt：".$szTradeAmt."<br>"
						."訂單成立時間 TradeDate：".$szTradeDate."<br>"
						."AllPay 的交易編號 TradeNo：".$szTradeNo."<br>"
						."歐付寶回傳時間：".$rdate."<br>"
						."資料庫寫入結果：".$result."<br>"
						."================================================================="."<br><br>";			

		$phpmailer->Body=$mailBody;

		$phpmailer->Send();



		print '1|OK';
	} else {
		print '0|Fail';
	}
}
catch (Exception $e)
{
	// 例外錯誤處理。
	print '0|' . $e->getMessage();
}

?>