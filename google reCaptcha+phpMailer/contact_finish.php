<?php
require_once 'Connections/connect2data.php';

if (!isset($_SESSION['checkPost'])) {
    header("Location: index.php");
}
if($_SESSION['checkPost'] == 1 ){
    unset($_SESSION['checkPost']);
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <?php include 'html_title.php'; ?>
    <?php include 'meta.php'; ?>
    <link rel="stylesheet" href="stylesheets/style.css">
</head>
<body>
    <?php $now = 'contact' ?>
    <?php include 'topmenu.php'; ?>

    <div class="news-banner wow fadeIn" data-wow-duration="2s" style="background: url(images/contact-banner.jpg) center center /cover no-repeat;">
        <div class="slogan-container">
            <div class="title">CONTACT</div>
            <div class="note">Contact Us</div>
            <div class="slogan">美好體驗現在實踐</div>
        </div>

        <div class="scroll-line"></div>

        <div class="news-copyright">© 2018 AQUA FORMOSA  ALL RIGHT SERVED</div>
    </div>

    <section class="contactWrap">
        <div class="companyInfo grid-x align-center-middle">
            <div class="pic cell shrink"><img src="images/contact-pic.png"></div>
            <div class="article cell shrink">
                <div class="title">天泉温泉水</div>
                <div class="address">
                    <div class="ch">台中市西屯區天水西街2號</div>
                    <div class="en">No.2, Tianshui W. St., Xitun Dist., Taichung City 407, Taiwan (R.O.C.)</div>
                </div>
                <ul class="phone">
                    <li>
                        <span class="sign">T</span>
                        <span class="text">0800 055 009</span>
                    </li>
                    <li>
                        <span class="sign">M</span>
                        <span class="text">service@aquaformosa.com</span>
                    </li>
                    <li>
                        <span class="sign">F</span>
                        <span class="text">@aquaformosa921</span>
                    </li>
                </ul>
            </div>
        </div>

        <div id="contactFinish">
            <!-- 感謝您的來信！我們將會儘快回覆您。<br>Thanks for your message, and we'll contact you ASAP. -->

            <?php
            if ( isset($_POST["MM_insert"]) && ($_POST["MM_insert"] == "subscription") && isset($_SESSION['checkPost']) && $_SESSION['checkPost'] == 0 ){

                $_SESSION['checkPost'] = 1;

                // 要用 checkV 需把空白也濾掉
                $m_title = checkV("d_title");
                $m_name = checkV("name");
                $m_phone = checkV("phone");
                $m_company = checkV("company");
                $m_address = checkV("address");
                $m_email = checkV("email");
                $m_type = contact_type(checkV("type"));
                $m_data7 = checkV("d_data7");
                $m_message = checkV("message");

                // insert sql
                $insertSQL = "INSERT INTO data_set (d_title, d_data1, d_data2, d_data3, d_data4, d_data5, d_data6, d_data7, d_content, d_class1, d_date, d_active) VALUES (:d_title, :d_data1, :d_data2, :d_data3, :d_data4, :d_data5, :d_data6, :d_data7, :d_content, 'contact', NOW(), '1')";

                $sth = $conn->prepare($insertSQL);
                $sth->bindParam(':d_title', $m_title, PDO::PARAM_STR);
                $sth->bindParam(':d_data1', $m_name, PDO::PARAM_STR);
                $sth->bindParam(':d_data2', $m_phone, PDO::PARAM_STR);
                $sth->bindParam(':d_data3', $m_company, PDO::PARAM_STR);
                $sth->bindParam(':d_data4', $m_address, PDO::PARAM_STR);
                $sth->bindParam(':d_data5', $m_email, PDO::PARAM_STR);
                $sth->bindParam(':d_data6', $m_type, PDO::PARAM_STR);
                $sth->bindParam(':d_data7', $m_data7, PDO::PARAM_STR);
                $sth->bindParam(':d_content', $m_message, PDO::PARAM_STR);
                $sth->execute();

                require_once('PHPMailer/class.phpmailer.php');
                $phpmailer = new PHPMailer();
                $phpmailer->SetLanguage('zh', '/PHPMailer/language/');
                $phpmailer->ContentType="text/html";
                $phpmailer->CharSet = "UTF-8";

                $phpmailer->Encoding = 'base64';
                $phpmailer->Timeout = 60; // 60 secs
                /////////////////////////////////////////////////////////////////

                $phpmailer->SingleTo = true; //will send mail to each email address individually

                $phpmailer->From = 'cp23.g-dns.com'; //設定寄件者信箱
                $phpmailer->FromName = "天泉温泉水"; //設定寄件者姓名

                $phpmailer->AddAddress('ts01173166@gmail.com', "天泉温泉水-聯絡我們通知");

                // $phpmailer->AddBCC("williamshsu@gmail.com","天泉温泉水-聯絡我們通知");

                $phpmailer->IsHTML(true);

                $phpmailer->Subject = "天泉温泉水-聯絡我們通知-".$m_name;

                $mailContent = nl2br("天泉温泉水官網管理員，您好！<br><br>"
                    ."下列為客戶 ".$m_name." 所諮詢的相關資料，<br>"
                    ."<br>==================================================<br>"
                    ."姓名：". isset($m_name) ? $m_name : "無" ."<br><br>"
                    ."電話：". isset($m_phone) ? $m_phone : "無" ."<br><br>"
                    ."公司：". isset($m_company) ? $m_company : "無" ."<br><br>"
                    ."地址：". isset($m_address) ? $m_address : "無" ."<br><br>"
                    ."信箱：". isset($m_email) ? $m_email : "無" ."<br><br>"
                    ."類別：". isset($m_type) ? $m_type : "無" ."<br><br>"
                    ."訊息：<br>". isset($m_message) ? $m_message : "無" ."<br/>"
                    ."<br>==================================================<br>"
                    ."<br>請您盡快回覆客戶，謝謝。"."<br><br>"
                    ."<div style='color: red;'>此為系統發信，請勿直接回覆。</div>"
                );

                $phpmailer->Body=$mailContent;

                if(!$phpmailer->Send()) {
                    echo "<div class='err'>傳送時失敗，請稍後再試，或連絡客服！<br>錯誤訊息如下" . $phpmailer->ErrorInfo . "</div>";
                } else {
                    echo "感謝您的來信！我們將會儘快回覆您。<br>Thanks for your message, and we'll contact you ASAP.";
                }

                unset($_SESSION['checkPost']);
            }
            ?>
        </div>
    </section>

    <?php include 'footer.php'; ?>
</body>

<?php include 'script.php'; ?>
</html>