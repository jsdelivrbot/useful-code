<?php
require_once('inc/EDcart.php');
if (!isset($_SESSION)) {
  session_start();
}

$cart =& $_SESSION['edCart']; 
if(!is_object($cart)) $cart = new edCart(); 

if( isset($_SESSION['receiveTime']) && $_SESSION['receiveTime'] == 'finish' ){
	unset($_SESSION['receiveTime']);
	header("Location: index.php");
}

require_once('../Connections/connect2data.php');
require_once('../Connections/session.initialize.php');
?>
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

function checkURLV($d){ 
	return (isset($_REQUEST[$d])) ? urldecode($_REQUEST[$d]) : NULL;
}
/**
//=========================================================
//接收基本回傳的參數//
//AllPay 提供的廠商編號
$r_MerchantID			= checkURLV('MerchantID');
//廠商交易編號
$r_MerchantTradeNo		= checkURLV('MerchantTradeNo');
//交易狀態
$r_RtnCode				= checkURLV('RtnCode');
//商品名稱or狀態
$r_szRtnMsg				= checkURLV('RtnMsg');
//是否為模擬付款
$r_SimulatePaid			= checkURLV('SimulatePaid');
//付款時間
$r_PaymentDate			= checkURLV('PaymentDate');
//會員選擇的付款方式
$r_PaymentType			= checkURLV('PaymentType');
//通路費
$r_PaymentTypeChargeFee	= checkURLV('PaymentTypeChargeFee');
//交易金額
$r_TradeAmt				= checkURLV('TradeAmt');
//訂單成立時間
$r_TradeDate			= checkURLV('TradeDate');
//AllPay的交易編號
$r_TradeNo				= checkURLV('TradeNo');
//=========================================================

//=========================================================
// 使用 Credit 交易時回傳的參數 //
//授權交易單號
$r_gwsr					= checkURLV('gwsr');
//處理時間
$r_process_date			= checkURLV('process_date');
//授權碼
$r_auth_code			= checkURLV('auth_code');
//金額
$r_amount				= checkURLV('amount');
//3D(VBV)
$r_eci					= checkURLV('eci');
//卡片的末4碼
$r_card4no				= checkURLV('card4no');
//卡片的前6碼
$r_card6no				= checkURLV('card6no');
//訂單建立時的每次要授權金額
$r_PeriodAmount			= checkURLV('PeriodAmount');
//訂單建立時的所設定的週期種類
$r_PeriodType			= checkURLV('PeriodType');
//目前已成功授權的金額合計
$r_TotalSuccessAmount	= checkURLV('TotalSuccessAmount');
//目前已成功授權的次數
$r_TotalSuccessTimes	= checkURLV('TotalSuccessTimes');

//------------------------分期------------------------//
//訂單建立時的所設定的執行次數(定期定額)
$r_ExecTimes	= checkURLV('ExecTimes');
//訂單建立時的所設定的執行頻率(定期定額)
$r_Frequency	= checkURLV('Frequency');
//各期金額
$r_staed		= checkURLV('staed');
//分期數
$r_stage		= checkURLV('stage');
//頭期金額
$r_stast		= checkURLV('stast');
//------------------------分期------------------------//
//------------------------紅利------------------------//
//紅利扣點
$r_red_dan		= checkURLV('red_dan');
//紅利折抵金額
$r_red_de_amt	= checkURLV('red_de_amt');
//實際扣款金額
$r_red_ok_amt	= checkURLV('red_ok_amt');
//紅利剩餘點數
$r_red_yet		= checkURLV('red_yet');
//------------------------紅利------------------------//
//=========================================================

//=========================================================
//當付款方式設定為 CVS 或 BARCODE 時//
//繳費超商
$r_PayFrom		= checkURLV('PayFrom');
//繳費代碼
$r_PaymentNo	= checkURLV('PaymentNo');
//=========================================================

//=========================================================
//當付款方式設定為 Alipay 時//
//付款人在支付寶的系統編號
$r_AlipayID			= checkURLV('AlipayID');
//支付寶交易編號
$r_AlipayTradeNo	= checkURLV('AlipayTradeNo');
//=========================================================

//=========================================================
// 使用 ATM 交易時回傳的參數 //
//付款人銀行代碼
$r_ATMAccBank	= checkURLV('ATMAccBank');
//付款人銀行帳號後五碼
$r_ATMAccNo		= checkURLV('ATMAccNo');
//=========================================================

//=========================================================
//當付款方式設定為 WebATM 時//
//付款人銀行代碼
$r_WebATMAccBank	= checkURLV('WebATMAccBank');
//付款人銀行帳號後五碼
$r_WebATMAccNo		= checkURLV('WebATMAccNo');
//銀行名稱
$r_WebATMBankName	= checkURLV('WebATMBankName');
//=========================================================

//=========================================================
//當付款方式設定為 Tenpay 時//
//財付通交易編號
$r_TenpayTradeNo	= checkURLV('TenpayTradeNo');
//=========================================================

//=========================================================
//驗查碼
$r_CheckMacValue	= checkURLV('CheckMacValue');
//=========================================================
**/

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>信用卡刷卡回應結果 | C+H 購物</title>

	<?php include('meta.php') ?>

	<script src="js/jquery/1.11.1/jquery.min.js"></script>

	<link rel="stylesheet/less" type="text/css" href="style_ryder.less">
	<script src="js/less-1.3.0.min.js" type="text/javascript"></script>

	<style type="text/css">
		.mb25{
			margin-bottom: 25px;
		}
		.mb18{
			margin-bottom: 18px;
		}
		span.w90{
			display: inline-block;
			width: 54px;
		}
		.cuspos{
			margin-top: 10px;
			margin-bottom: 6px;
		}
		.pl33{
			padding-left: 33px;
		}
		.areacontent{
			color:#B43125;
			font-size:14px;
			font-weight:bold;
			text-align:center;
			padding-top:30px;
			padding-bottom:30px;
		}
		.areacontent > p{
			margin-bottom:20px;
		}
		.footer{
			position: absolute;
			bottom: 0;
			width: 100%;
		}
		.info-err{
			margin-top: 30px;
			font-size: 18px;
			line-height: 26px;
			color: #BE2F24;
		}
		.info-succ{
			margin-top: 30px;
			font-size: 18px;
			line-height: 26px;
			color: #B43125;
		}
	</style>

</head>
<body>

	<?php include 'topmenu-fixed.php'; ?>

	<div class="fortopmenupush"></div>

	<div class="bigtitle">信用卡刷卡回應結果</div>

	<div class="areacontent mb25">

		<div class="receiveInfo">
			
			<?php

				require_once('../AioSDK/sdk/AllPay.Payment.Integration.php');
				require_once('../AioSDK/HAKIVMID.php');
				require_once('../allpayMsg.php');
				/*
				* 接收訂單資料產生完成的程式碼。
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

					//var_dump($arFeedback).'<br>';
					if (sizeof($arFeedback) > 0) {
						foreach ($arFeedback as $key => $value) {
							switch ($key)
							{
								/* 支付後的回傳的基本參數 */
								//廠商編號
								case "MerchantID": $r_MerchantID = $value; break;
								//廠商交易編號
								case "MerchantTradeNo": $r_MerchantTradeNo = $value; break;
								//交易狀態
								case "RtnCode": $r_RtnCode = $value; break;
								//交易訊息
								case "RtnMsg": $r_RtnMsg = $value; break;
								//是否為模擬付款
								case "SimulatePaid": $r_SimulatePaid = $value; break;
								//付款時間
								case "PaymentDate": $r_PaymentDate = $value; break;
								//付款方式
								case "PaymentType": $r_PaymentType = $value; break;
								//通路費
								case "PaymentTypeChargeFee": $r_PaymentTypeChargeFee = $value; break;
								//交易金額
								case "TradeAmt": $r_TradeAmt = $value; break;
								//訂單成立時間
								case "TradeDate": $r_TradeDate = $value; break;
								//AllPay 的交易編號
								case "TradeNo": $r_TradeNo = $value; break;

								/* 使用 Credit 交易時回傳的參數 */
								//授權交易單號
								case "gwsr": $r_gwsr = $value; break;
								//處理時間
								case "process_date": $r_process_date = $value; break;
								//授權碼
								case "auth_code": $r_auth_code = $value; break;
								//金額
								case "amount": $r_amount = $value; break;
								//3D(VBV)
								case "eci": $r_eci = $value; break;
								//卡片的末4碼
								case "card4no": $r_card4no = $value; break;
								//卡片的前6碼
								case "card6no": $r_card6no = $value; break;
								//每次授權金額
								case "PeriodAmount": $r_PeriodAmount = $value; break;
								//所設定的週期種類
								case "PeriodType": $r_PeriodType = $value; break;
								//已成功授權的金額合計
								case "TotalSuccessAmount": $r_TotalSuccessAmount = $value; break;
								//已成功授權的次數
								case "TotalSuccessTimes": $r_TotalSuccessTimes = $value; break;

								/*------------------------分期------------------------*/
								//所設定的執行次數
								case "ExecTimes": $r_ExecTimes = $value; break;
								//所設定的執行頻率
								case "Frequency": $r_Frequency = $value; break;
								//各期金額
								case "staed": $r_staed = $value; break;
								//分期數
								case "stage": $r_stage = $value; break;
								//頭期金額
								case "stast": $r_stast = $value; break;
								/*------------------------分期------------------------*/

								/*------------------------紅利------------------------*/
								//紅利扣點
								case "red_dan": $r_red_dan = $value; break;
								//紅利折抵金額
								case "red_de_amt": $r_red_de_amt = $value; break;
								//實際扣款金額
								case "red_ok_amt": $r_red_ok_amt = $value; break;
								//紅利剩餘點數
								case "red_yet": $r_red_yet = $value; break;
								/*------------------------紅利------------------------*/

								/*當付款方式設定為 CVS 或 BARCODE 時*/
								//繳費超商
								case "PayFrom": $r_PayFrom = $value; break;
								//繳費代碼
								case "PaymentNo": $r_PaymentNo = $value; break;

								/*當付款方式設定為 Alipay 時*/
								//付款人在支付寶的系統編號
								case "AlipayID": $r_AlipayID = $value; break;
								//支付寶交易編號
								case "AlipayTradeNo": $r_AlipayTradeNo = $value; break;

								/* 使用 ATM 交易時回傳的參數 */
								//銀行代碼
								case "ATMAccBank": $r_ATMAccBank = $value; break;
								//銀行帳號後五碼
								case "ATMAccNo": $r_ATMAccNo = $value; break;

								/*當付款方式設定為 WebATM 時*/
								//銀行代碼
								case "WebATMAccBank": $r_WebATMAccBank = $value; break;
								//帳號後五碼
								case "WebATMAccNo": $r_WebATMAccNo = $value; break;
								//銀行名稱
								case "WebATMBankName": $r_WebATMBankName = $value; break;

								/*當付款方式設定為 Tenpay 時*/
								//財付通交易編號
								case "TenpayTradeNo": $r_TenpayTradeNo = $value; break;

								//驗查碼
								case "CheckMacValue": $r_CheckMacValue = $value; break;



								default: break;
							}
						}

						// 其他資料處理。

						//驗查碼
						$r_CheckMacValue	= checkURLV('CheckMacValue');

						if($r_RtnCode=='1'){
							$r_status = 1;
							$card_status = 1;
						}else{
							$r_status = 0;
							$card_status = 2;
						}

						$rdate = date('Y/m/d H:i:s');

						//if( !isset($_SESSION['receiveTime']) ){
						//if( isset($_SESSION['receiveTime']) && $_SESSION['receiveTime']==1 ){

						$updateSQL = "UPDATE order_set SET 
										card_status = ".GetSQLValueString($card_status, "int")."
										WHERE o_number = ".GetSQLValueString($r_MerchantTradeNo, "text");
						mysql_select_db($database_connect2data, $connect2data);
						//echo $updateSQL.'<br>';
						$Result = mysql_query($updateSQL, $connect2data) or die(mysql_error());
						
							$updateSQL = "UPDATE response_set SET 
										r_MerchantID = ".GetSQLValueString($r_MerchantID, "text").",
										r_MerchantTradeNo = ".GetSQLValueString($r_MerchantTradeNo, "text").",
										r_RtnCode = ".GetSQLValueString($r_RtnCode, "int").",
										r_RtnMsg = ".GetSQLValueString($r_RtnMsg, "text").",
										r_SimulatePaid = ".GetSQLValueString($r_SimulatePaid, "int").",
										r_PaymentDate = ".GetSQLValueString($r_PaymentDate, "date").",
										r_PaymentType = ".GetSQLValueString($r_PaymentType, "text").",
										r_PaymentTypeChargeFee = ".GetSQLValueString($r_PaymentTypeChargeFee, "int").",
										r_TradeAmt = ".GetSQLValueString($r_TradeAmt, "int").",
										r_TradeDate = ".GetSQLValueString($r_TradeDate, "date").",
										r_TradeNo = ".GetSQLValueString($r_TradeNo, "text").",
										r_gwsr = ".GetSQLValueString($r_gwsr, "int").",
										r_process_date = ".GetSQLValueString($r_process_date, "date").",
										r_auth_code = ".GetSQLValueString($r_auth_code, "text").",
										r_amount = ".GetSQLValueString($r_amount, "int").",
										r_eci = ".GetSQLValueString($r_eci, "int").",
										r_card4no = ".GetSQLValueString($r_card4no, "text").",
										r_card6no = ".GetSQLValueString($r_card6no, "text").",
										r_PeriodAmount = ".GetSQLValueString($r_PeriodAmount, "int").",
										r_PeriodType = ".GetSQLValueString($r_PeriodType, "text").",
										r_TotalSuccessAmount = ".GetSQLValueString($r_TotalSuccessAmount, "int").",
										r_TotalSuccessTimes = ".GetSQLValueString($r_TotalSuccessTimes, "int").",
										r_ExecTimes = ".GetSQLValueString($r_ExecTimes, "int").",
										r_Frequency = ".GetSQLValueString($r_Frequency, "int").",
										r_staed = ".GetSQLValueString($r_staed, "int").",
										r_stage = ".GetSQLValueString($r_stage, "int").",
										r_stast = ".GetSQLValueString($r_stast, "int").",
										r_red_dan = ".GetSQLValueString($r_red_dan, "int").",
										r_red_de_amt = ".GetSQLValueString($r_red_de_amt, "int").",
										r_red_ok_amt = ".GetSQLValueString($r_red_ok_amt, "int").",
										r_red_yet = ".GetSQLValueString($r_red_yet, "int").",
										r_PayFrom = ".GetSQLValueString($r_PayFrom, "text").",
										r_PaymentNo = ".GetSQLValueString($r_PaymentNo, "text").",
										r_AlipayID = ".GetSQLValueString($r_AlipayID, "text").",
										r_AlipayTradeNo = ".GetSQLValueString($r_AlipayTradeNo, "text").",
										r_ATMAccBank = ".GetSQLValueString($r_ATMAccBank, "text").",
										r_ATMAccNo = ".GetSQLValueString($r_ATMAccNo, "text").",
										r_WebATMAccBank = ".GetSQLValueString($r_WebATMAccBank, "text").",
										r_WebATMAccNo = ".GetSQLValueString($r_WebATMAccNo, "text").",
										r_WebATMBankName = ".GetSQLValueString($r_WebATMBankName, "text").",
										r_TenpayTradeNo = ".GetSQLValueString($r_TenpayTradeNo, "text").",
										r_CheckMacValue = ".GetSQLValueString($r_CheckMacValue, "text").",
										r_status = ".GetSQLValueString( $r_status , "int").",
										r_response_date = ".GetSQLValueString($rdate, "date")."
										WHERE r_lidm = ".GetSQLValueString($r_MerchantTradeNo, "text");
							//echo $updateSQL.'<br>';

							mysql_select_db($database_connect2data, $connect2data);

							$Result = mysql_query($updateSQL, $connect2data) or die(mysql_error());
						//}

						$receiveArray = array(
							"r_MerchantID" => $r_MerchantID,
							"r_MerchantTradeNo" => $r_MerchantTradeNo,
							"r_RtnCode" => $r_RtnCode,
							"r_RtnMsg" => $r_RtnMsg,
							"r_SimulatePaid" => $r_SimulatePaid,
							"r_PaymentDate" => $r_PaymentDate,
							"r_PaymentType" => $r_PaymentType,
							"r_PaymentTypeChargeFee" => $r_PaymentTypeChargeFee,
							"r_TradeAmt" => $r_TradeAmt,
							"r_TradeDate" => $r_TradeDate,
							"r_TradeNo" => $r_TradeNo,
							"r_gwsr" => $r_gwsr,
							"r_process_date" => $r_process_date,
							"r_auth_code" => $r_auth_code,
							"r_amount" => $r_amount,
							"r_eci" => $r_eci,
							"r_card4no" => $r_card4no,
							"r_card6no" => $r_card6no,
							"r_PeriodAmount" => $r_PeriodAmount,
							"r_PeriodType" => $r_PeriodAmount,
							"r_TotalSuccessAmount" => $r_TotalSuccessAmount,
							"r_TotalSuccessTimes" => $r_TotalSuccessTimes,
							"r_ExecTimes" => $r_ExecTimes,
							"r_Frequency" => $r_Frequency,
							"r_staed" => $r_staed,
							"r_stage" => $r_stage,
							"r_stast" => $r_stast,
							"r_red_dan" => $r_red_dan,
							"r_red_de_amt" => $r_red_de_amt,
							"r_red_ok_amt" => $r_red_ok_amt,
							"r_red_yet" => $r_red_yet,
							"r_PayFrom" => $r_PayFrom,
							"r_PaymentNo" => $r_PaymentNo,
							"r_AlipayID" => $r_AlipayID,
							"r_AlipayTradeNo" => $r_AlipayTradeNo,
							"r_ATMAccBank" => $r_ATMAccBank,
							"r_ATMAccNo" => $r_ATMAccNo,
							"r_WebATMAccBank" => $r_WebATMAccBank,
							"r_WebATMAccNo" => $r_WebATMAccNo,
							"r_WebATMBankName" => $r_WebATMBankName,
							"r_TenpayTradeNo" => $r_TenpayTradeNo,
							"r_CheckMacValue" => $r_CheckMacValue
						);

						//var_dump($receiveArray).'<br>';

						if($Result){

							$_SESSION['o_num'] = $r_MerchantTradeNo;
							$_SESSION['receiveTime'] = 'edit';

							if($r_RtnCode==1){
								print '<div class="info-succ">'.$msgA[$r_RtnCode].'，頁面會自動轉跳，請稍待。</div>';
								header("refresh:3; cartFinish.php");
							}else{
								if (array_key_exists($r_RtnCode, $msgA)){
									print '<div class="info-err">刷卡失敗</div>';
									print '<div class="info-err">錯誤訊息：'.$msgA[$r_RtnCode].'。</div>';
								}else{
									print '<div class="info-err">刷卡未知錯誤，'.$row_RecResponse['r_RtnCode'].'請連絡客服。</div>';
								}								
							}
							
						}else{
							print '<div class="info-err">資料寫入錯誤，請連絡客服。</div>';
						}

						
					} else {
						print '<div class="info-err">資料回傳失敗，請連絡客服。</div>';
					}
				}
				catch (Exception $e)
				{
					// 例外錯誤處理。
					print '<div class="info-err">接收資料錯誤' . $e->getMessage() . '</div>';
				}
			?>

		</div>

	</div>

	<?php include 'footer.php'; ?>


</body>
</html>


