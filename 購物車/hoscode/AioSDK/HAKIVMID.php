<?php 
/*class HAKIVMID
{
    //protected $str;
    private $HASHKEY = "5294y06JbISpM5x9";
    private $HASHIV = "v77hoKGq4kWxNNIS";
    private $MERCHANTID = "2000132";
    const SERVICEURL	=	"http://payment-stage.allpay.com.tw/Cashier/AioCheckOut";

    public function __construct(){}

    public function dis(){
    	return $this->HASHKEY;
    }
    public function disS(){
    	return SERVICEURL;
    }


}*/

$webURL = "http://www.chstudio2010.com/";

//您該筆訂單的描述
define("_TRADEDESC", "C+H-線上購物(測試)");

define("_WEBURL", "http://www.chstudio2010.com/");

/*====================測試用====================*/

//AllPay提供給您的Hash Key
define("_HASHKEY", "5294y06JbISpM5x9");
//AllPay提供給您的Hash IV
define("_HASHIV", "v77hoKGq4kWxNNIS");
//AllPay提供給您的特店編號
define("_MERCHANTID", "2000132");
//您要呼叫的服務位址
define("_SERVICEURL", "http://payment-stage.allpay.com.tw/Cashier/AioCheckOut");

/*====================測試用====================*/

/*====================正式用====================*/
/*
//AllPay提供給您的Hash Key
define("_HASHKEY", "m4ETi8ILxBvROWBS");
//AllPay提供給您的Hash IV
define("_HASHIV", "u4w4nqt5ORHkuojq");
//AllPay提供給您的特店編號
define("_MERCHANTID", "1303279");
//您要呼叫的服務位址
define("_SERVICEURL", "https://payment.allpay.com.tw/Cashier/AioCheckOut");
*/
/*====================正式用====================*/



//收到付款完成通知的伺服器端網址
define("_RETURNURL", _WEBURL."return.php"); 
//歐付寶返回按鈕導向的瀏覽器端網址
define("_CLIENTBACKURL", _WEBURL."receiveClient.php"); 
//收到付款完成通知的瀏覽器端網址
define("_ORDERRESULTURL", _WEBURL."receive.php");

define("_RETURNURL_MOBILE", _WEBURL."mobile/return.php"); 
//歐付寶返回按鈕導向的瀏覽器端網址
define("_CLIENTBACKURL_MOBILE", _WEBURL."mobile/receiveClient.php"); 
//收到付款完成通知的瀏覽器端網址
define("_ORDERRESULTURL_MOBILE", _WEBURL."mobile/receive.php");

/*$H = new HAKIVMID();
echo $H->dis();
echo _ORDERRESULTURL;*/
?>