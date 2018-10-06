<?php require_once 'Connections/connect2data.php'; ?>



<?php



if (!isset($_SESSION['checkPost'])) {

    header("Location: ./");

}



if($_SESSION['checkPost'] == 1 ){

    unset($_SESSION['checkPost']);

    header("Location: ./");

}




if ( isset($_SESSION['checkPost']) && $_SESSION['checkPost'] == 0 ){



    $_SESSION['checkPost'] = 1;



    $m_name = $_POST['name'];

    $m_email = $_POST['email'];

    $m_title = $_POST['title'];

    $m_message = $_POST['message'];



    require_once('PHPMailer/class.phpmailer.php');
    $phpmailer = new PHPMailer();
    $phpmailer->SetLanguage('zh', '/PHPMailer/language/');
    $phpmailer->ContentType = "text/html";
    $phpmailer->CharSet = "UTF-8";
    $phpmailer->Encoding = "base64";
    $phpmailer->Timeout = 60;
    /////////////////////////////////////////////////////////////////

    $phpmailer->SingleTo = true; //will send mail to each email address individually

    $phpmailer->SetFrom('ryderisg@ryderisgood.com', '梧桐樹');
    $phpmailer->AddReplyTo('ryderisg@ryderisgood.com', '梧桐樹');

    $phpmailer->AddAddress('ts01173166@gmail.com', '梧桐樹-聯絡我們通知');

    // $phpmailer->AddBCC("ts01173166@gmail.com","梧桐樹-聯絡我們通知");



    $phpmailer->Subject = "梧桐樹-聯絡我們通知 - $m_name";



    $mailContent = "<div style='max-width: 500px; letter-spacing: 1px;'>"

    ."梧桐樹官網管理員，您好！<br><br>"

    ."==================================================<br><br><br>"

    ."姓名： $m_name <br><br>"

    ."信箱： $m_email <br><br>"

    ."標題： $m_title <br><br>"

    ."<div style='line-height: 2;'>"

    ."內容： $m_message <br><br>"

    ."</div>"

    ."==================================================<br><br>"

    ."請您盡快回覆客戶，謝謝。<br><br><br>"

    ."<div style='color: red;'>此為系統發信，請勿直接回覆。</div>"

    ."</div>";



    $phpmailer->Body = $mailContent;

    $phpmailer->IsHTML(true);



    if(!$phpmailer->Send()) {

        echo "<div class='err'>傳送時失敗，請稍後再試，或連絡客服！</div>";

    } else {

        echo "感謝您的來信！我們將會儘快回覆您。<br>Thanks for your message, and we'll contact you ASAP.";

    }



    unset($_SESSION['checkPost']);

}