<html>
<head>
<title>PHPMailer - SMTP (Gmail) basic test</title>
</head>
<body>

<?php
$message .="***************************************************<br>";
$message .="�Ъ`�N�J���l��O�t�Φ۰ʶǰe�A�ФŪ����^�Ц��l��C <br>";
$message .="***************************************************<br>";
$message .="<br>";
$message .="�˷R��";
$message .="WHO";
$message .=" �z�n�A�P�±z���U�|���� ProjectD-�x�WD�p�e<br>";
$message .="<br>";
$message .="�o�ʻ{�ҫH�O�ѡyProjectD-�x�WD�p�e ( <a href=http://www.projectd.com.tw>http://www.projectd.com.tw</a> )�z�o�X�A�ΥH�ҰʻդU�|�������C<br>";
$message .="<br>";
$message .="�z�ҵ��U���|����Ʀp�U�G<br>";
$message .="<br>";
$message .="�b���G";
$message .="WHO";
$message .="<br>";
$message .="�K�X�G";
$message .="WHO";
$message .="<br>";
$message .="<br>";
$message .="�p�G�z����h�ʡy�{�ҫH��z�A�ХH�̷s�����@�ʡA�謰���ġC<br>";
$message .="<br>";
$message .="�`�@����ػ{�Ҥ�k�A��k�p�U�G<br>";
$message .="<br>";
$message .="�{�Ҥ�k�@�G(�ֳt�{��)<br>";
$message .="<br>";
$message .="�I��νƻs�H�U���s�����s�����i��ֳt�{�ҡC<br>";
$message .="<br>";
$message .="WHO<br>";
$message .="<br>";
$message .="�{�Ҥ�k�G�G(��ʻ{��)<br>";
$message .="<br>";
$message .="�p��k�@�L�k�{�ҡA�i�Ĩ���k�G�C<br>";
$message .="<ol>";
$message .=" <li>�Х��s�u�ܥ����� <a href=http:///www.projectd.com.tw>http:///www.projectd.com.tw</a></li>";
$message .=" <li>���n�J�z���b���K�X��b����|���ϤU���J�{�ҽX��----->���U�y��ʻ{�ҡz�Y�i</li>";
$message .=" <li>��J�z�o�����{�Ҹ��X�y";
$message .="WHO";
$message .="�z</li>";
$message .=" <li>�e���X�{ �{�Ҧ��\ �r�ˡA�N�����{�Ҥ���F</li>";
$message .="</ol>";
$message .="<br>";
$message .="�w��z�[�J ProjectD-�x�WD�p�e �o�ӱM�� �Y��rD�j���q�� �ҳ]�p�������C<br><br>";

//error_reporting(E_ALL);
error_reporting(E_STRICT);

//date_default_timezone_set('America/Toronto');
date_default_timezone_set("Asia/Taipei");
require_once('../class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail             = new PHPMailer();

//$body             = file_get_contents('contents.html');
$body             = $message;//�H�󤺮e
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


$mail->SetFrom('projectd.taiwan@gmail.com', '�x�WD�p�e');

$mail->AddReplyTo("projectd.taiwan@gmail.com","�x�WD�p�e");

$mail->Subject    = "�x�WD�p�e�|���{�ҫH";

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($body);

$address = "link7311@hotmail.com";
$mail->AddAddress($address, "����");//����H
$mail->CharSet = "big5"; //�]�w�l��s�X 
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
