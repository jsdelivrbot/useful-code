<?php
require_once 'Connections/connect2data.php';

$_SESSION['checkPost'] = 0;

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

        <form class="contactForm" action="contact_finish.php#contactFinish" method="POST">
            <div class="head-en">CONTACT</div>
            <div class="head-ch">如有問題請填寫下列表格我們會盡快聯絡您</div>

            <div class="typein grid-x align-top">
                <div class="name cell shrink">NAME</div>
                <div class="col cell auto">
                    <input type="text" name="name" id="name" placeholder="您的姓名">
                </div>
            </div>
            <div class="typein grid-x align-top">
                <div class="name cell shrink">CELLPHONE</div>
                <div class="col cell auto">
                    <input type="text" name="phone" id="phone" placeholder="聯絡電話">
                </div>
            </div>
            <div class="typein grid-x align-top">
                <div class="name cell shrink">COMPANY NAME</div>
                <div class="col cell auto">
                    <input type="text" name="company" id="company" placeholder="企業名稱">
                </div>
            </div>
            <div class="typein grid-x align-top">
                <div class="name cell shrink">ADDRESS</div>
                <div class="col cell auto">
                    <input type="text" name="address" id="address" placeholder="聯絡地址">
                </div>
            </div>
            <div class="typein grid-x align-top">
                <div class="name cell shrink">E-MAIL</div>
                <div class="col cell auto">
                    <input type="text" name="email" id="email" placeholder="聯絡信箱">
                </div>
            </div>
            <div class="typein grid-x align-top">
                <div class="name cell shrink">TYPE</div>
                <div class="col cell auto grid-x">
                    <div class="cell large-shrink">
                        <input type="radio" name="type" id="r1" value="1">
                        <label for="r1">商品問題</label>
                    </div>
                    <div class="cell large-shrink">
                        <input type="radio" name="type" id="r2" value="2">
                        <label for="r2">寄送方式</label>
                    </div>
                    <div class="cell large-shrink">
                        <input type="radio" name="type" id="r3" value="3">
                        <label for="r3">匯款方式</label>
                    </div>
                    <div class="cell large-shrink">
                        <input type="radio" name="type" id="r4" value="4">
                        <label for="r4">其他</label>
                    </div>
                </div>
            </div>
            <div class="typein grid-x align-top">
                <div class="name cell shrink">QUESTION</div>
                <div class="col cell auto">
                    <textarea name="message" placeholder="您的問題與意見"></textarea>
                </div>
            </div>

            <input type="hidden" id="MM_insert" name="MM_insert" value="form1" />

            <div class="g-recaptcha" style="display: none;"
                data-sitekey="6LfXQFwUAAAAADsvjjfcJBYI4s7zyW7dUxS7DLpq"
                data-callback="onSubmit"
                data-size="invisible">
            </div>

            <div class="send"><span>送出</span></div>
        </form>
    </section>

    <?php include 'footer.php'; ?>
</body>

<?php include 'script.php'; ?>
</html>

<script>
    $(function () {
        $(".contactForm").validate({
            rules:{
                name: {
                    required: true,
                },
                email: {
                    required: true,
                },
                message: {
                    required: true,
                }
            },
            messages: {
                name: {
                    required: "必填欄位"
                },
                email: {
                    required: "必填欄位"
                },
                message: {
                    required: "必填欄位"
                },
            },
            errorPlacement: function(label, element) {
                label.addClass('contact-form-error');
                label.insertAfter(element);
            },
            wrapper: 'div'
        })

        $(".send").on("click", function () {
            if($(".contactForm").valid() == true){
                var answer = confirm("您確認要送出您所填寫的資訊嗎？");
                if (answer){
                    if($("#MM_insert").val()=='form1'){
                        $("#MM_insert").attr("value", "subscription");
                    }
                    grecaptcha.execute();
                }
            }
        })

        window.onSubmit = () => $(".contactForm").submit()

        if (device == 'mobile') {
            $(".news-banner").css({
                background: 'url(images/contact-banner-mobile.jpg) center center /cover no-repeat'
            })
        }
    })
</script>