<html>
<head>
<title>PHPMailer - SMTP (Gmail) basic test</title>
</head>
<body>

<?php
$message .="***************************************************<br>";
$message .="請注意︰此郵件是系統自動傳送，請勿直接回覆此郵件。 <br>";
$message .="***************************************************<br>";
$message .="<br>";
$message .="親愛的";
$message .="WHO";
$message .=" 您好，感謝您註冊會員於 ProjectD-台灣D計畫<br>";
$message .="<br>";
$message .="這封認證信是由『ProjectD-台灣D計畫 ( <a href=http://www.projectd.com.tw>http://www.projectd.com.tw</a> )』發出，用以啟動閣下會員身份。<br>";
$message .="<br>";
$message .="您所註冊的會員資料如下：<br>";
$message .="<br>";
$message .="帳號：";
$message .="WHO";
$message .="<br>";
$message .="密碼：";
$message .="WHO";
$message .="<br>";
$message .="<br>";
$message .="如果您收到多封『認證信函』，請以最新的那一封，方為有效。<br>";
$message .="<br>";
$message .="總共有兩種認證方法，方法如下：<br>";
$message .="<br>";
$message .="認證方法一：(快速認證)<br>";
$message .="<br>";
$message .="點選或複製以下的連結至瀏覽器進行快速認證。<br>";
$message .="<br>";
$message .="WHO<br>";
$message .="<br>";
$message .="認證方法二：(手動認證)<br>";
$message .="<br>";
$message .="如方法一無法認證，可採取方法二。<br>";
$message .="<ol>";
$message .=" <li>請先連線至本網站 <a href=http:///www.projectd.com.tw>http:///www.projectd.com.tw</a></li>";
$message .=" <li>先登入您的帳號密碼後在左邊會員區下方輸入認證碼後----->按下『手動認證』即可</li>";
$message .=" <li>輸入您這次的認證號碼『";
$message .="WHO";
$message .="』</li>";
$message .=" <li>畫面出現 認證成功 字樣，就完成認證手續了</li>";
$message .="</ol>";
$message .="<br>";
$message .="歡迎您加入 ProjectD-台灣D計畫 這個專為 頭文字D大型電玩 所設計的網站。<br><br>";

//error_reporting(E_ALL);
error_reporting(E_STRICT);

//date_default_timezone_set('America/Toronto');
date_default_timezone_set("Asia/Taipei");
require_once('../class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail             = new PHPMailer();

//$body             = file_get_contents('contents.html');
$body             = $message;//信件內容
$body             = eregi_replace("[\]",'',$body);

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "smtp.gmail.com"; // SMTP server
//$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
$mail->Username   = "projectd.taiwan@gmail.com";  // GMAIL username
$mail->Password   = "happy1122";            // GMAIL password


$mail->SetFrom('projectd.taiwan@gmail.com', '台灣D計畫');

$mail->AddReplyTo("projectd.taiwan@gmail.com","台灣D計畫");

$mail->Subject    = "台灣D計畫會員認證信";

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($body);

$address = "link7311@hotmail.com";
$mail->AddAddress($address, "中文");//收件人
$mail->CharSet = "big5"; //設定郵件編碼 
//$mail->AddAttachment("images/phpmailer.gif");      // attachment
//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

if(!$mail->Send()) {
 // echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}

?>

</body>
</html>
