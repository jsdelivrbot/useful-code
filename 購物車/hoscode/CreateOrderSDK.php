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

require_once('login_query.php');
require_once('mobileCheck.php');
require_once('Connections/connect2data.php');
require_once('Connections/session.initialize.php');

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

/*echo $totalRows_RecOrder.'<br>';
echo 'o_num = '.$_SESSION['o_num'].'<br>';
echo 'payment = '.$row_RecOrder['payment'];*/


if( $totalRows_RecOrder==0 || $row_RecOrder['payment']!='3' ){	
	header( "Location: cartFinish.php" );
}


require_once('AioSDK/sdk/AllPay.Payment.Integration.php');
require_once('AioSDK/HAKIVMID.php');
/*
* 產生訂單。
*/
try
{
	$oPayment = new AllInOne();
	/* 服務參數 */
	//您要呼叫的服務位址
	$oPayment->ServiceURL = _SERVICEURL;
	//AllPay提供給您的Hash Key
	$oPayment->HashKey = _HASHKEY;
	//AllPay提供給您的Hash IV
	$oPayment->HashIV = _HASHIV;
	//AllPay提供給您的特店編號
	$oPayment->MerchantID = _MERCHANTID;

	/* 基本參數 */
	//收到付款完成通知的伺服器端網址
	$oPayment->Send['ReturnURL'] = _RETURNURL;
	//歐付寶返回按鈕導向的瀏覽器端網址
	$oPayment->Send['ClientBackURL'] = _CLIENTBACKURL;
	//收到付款完成通知的瀏覽器端網址
	$oPayment->Send['OrderResultURL'] = _ORDERRESULTURL;
	//此筆訂單交易編號
	$oPayment->Send['MerchantTradeNo'] = $_SESSION['o_num'];
	//廠商交易時間
	//$oPayment->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');
	$oPayment->Send['MerchantTradeDate'] = date_format( date_create($row_RecOrder['datetime']) ,"Y/m/d H:i:s");
	//您此筆訂單的交易總金額
	$oPayment->Send['TotalAmount'] = (int) $row_RecOrder['GrandTotal'];
	//您該筆訂單的描述
	$oPayment->Send['TradeDesc'] = _TRADEDESC;
	//選擇預設付款方式 ALL
	//$oPayment->Send['ChoosePayment'] = PaymentMethod::ALL;Credit
	$oPayment->Send['ChoosePayment'] = PaymentMethod::Credit;
	//您要填寫的其他備註
	$oPayment->Send['Remark'] = "";
	//使用的付款子項目 預設None
	$oPayment->Send['ChooseSubPayment'] = PaymentMethodItem::None;
	//是否需要額外的付款資訊 預設No ExtraPaymentInfo::No
	$oPayment->Send['NeedExtraPaidInfo'] = ExtraPaymentInfo::Yes;
	//裝置Device 預設桌機版 PC 手機版Mobile
	$oPayment->Send['DeviceSource'] = DeviceType::PC;
	//您不要顯示的付款方式
	$oPayment->Send['IgnorePayment'] = ""; // 例(排除支付寶與財富通): Alipay#Tenpay

	// 加入選購商品資料。
	$webURL = _WEBURL . "products_detail.php?id="; 

	//array_push($oPayment->Send['Items'], array('Name' => "POPBIKE客製化訂單", 'Price' => (int) $row_Recorder['SubTotal'], 'Currency' => "元", 'Quantity' => (int) "1", 'URL' => $webURL));

	do{

		array_push($oPayment->Send['Items'], array(
			'Name' => $row_RecOrderItem['d_name'], 
			'Price' => (int) $row_RecOrderItem['subtotal'], 
			'Currency' => "元", 
			'Quantity' => (int) $row_RecOrderItem['qty'], 
			'URL' => $webURL.$row_RecOrderItem['d_id'])
		);

	} while ($row_RecOrderItem = mysql_fetch_assoc($RecOrderItem));

	/*array_push($oPayment->Send['Items'], array('Name' => "很好設計負責人", 'Price' => (int)"199",
	'Currency' => "元", 'Quantity' => (int) "4", 'URL' => "很好設計負責人產品說明位址"));

	array_push($oPayment->Send['Items'], array('Name' => "心有所薯", 'Price' => (int)"299",
	'Currency' => "元", 'Quantity' => (int) "1", 'URL' => "心有所薯產品說明位址"));*/

	/*array_push($oPayment->Send['Items'], array('Name' => "<<產品B>>", 'Price' => (int)"<<單價>>",
	'Currency' => "<<幣別>>", 'Quantity' => (int) "<<數量>>", 'URL' => "<<產品說明位址>>"));
	array_push($oPayment->Send['Items'], array('Name' => "<<產品C>>", 'Price' => (int)"<<單價>>",
	'Currency' => "<<幣別>>", 'Quantity' => (int) "<<數量>>", 'URL' => "<<產品說明位址>>"));*/
	/* 產生訂單 */
	$oPayment->CheckOut();
	/* 產生產生訂單 Html Code 的方法 */
	//$szHtml = $oPayment->CheckOutString();
}
catch (Exception $e)
{
	// 例外錯誤處理。
	throw $e;
}
?>