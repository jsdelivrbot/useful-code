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

$_SESSION['checkPost'] = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php include 'html_title.php'; ?></title>

	<?php include('meta.php') ?>

	<link rel="stylesheet" href="stylesheets/style.css">
</head>

<body>
	<?php $now='contact' ?>
	<?php include 'topmenu.php'; ?>

	<div class="contactWrap">
		<div class="cw-method">
			<div class="head bg-is-gray">聯絡方式</div>

			<div class="cw-innerWrap">
				<ul class="cw-iconList">
					<li class="image-2x"><a href="https://www.facebook.com/Weibyapps/" target="new"><img src="images/conatct/icon-1.png"><img src="images/conatct/icon-1@2x.png" width="36"></a></li>
					<li class="line-qrcode image-2x"><a href="line://ti/p/%40zml8093p"><img src="images/conatct/icon-3.png"><img src="images/conatct/icon-3@2x.png" width="36"></a></li>
				</ul>

				<div class="cw-address"><span class="image-2x"><img src="images/conatct/marker.png"><img src="images/conatct/marker@2x.png" width="24"></span>406 台灣台中市北屯區崇德路二段346巷25弄22號12樓</div>
				<div class="cw-phone"><span class="image-2x"><img src="images/conatct/phone.png"><img src="images/conatct/phone@2x.png" width="24"></span>(04) 2241-3797<br>0979-061958</div>
				<div class="cw-mail"><span class="image-2x"><img src="images/conatct/mail.png"><img src="images/conatct/mail@2x.png" width="24"></span>help@weibyapps.com</div>
			</div>
		</div>

		<div class="cw-contactus">
			<div class="head bg-is-gray">與我們聯絡</div>

			<form action="contact_finish" id="contactForm" method="POST">
				<div class="row">
					<div class="item">姓名</div>
					<div class="item"><input type="text" name="name" id=""></div>
				</div>
				<div class="row">
					<div class="item">電子郵件</div>
					<div class="item"><input type="text" name="email" id=""></div>
				</div>
				<div class="row">
					<div class="item">聯絡電話</div>
					<div class="item"><input type="text" name="phone" id=""></div>
				</div>
				<div class="row">
					<div class="item">希望聯絡方式</div>
					<div class="item">
						<input type="radio" name="type" id="r1" value="電子郵件">
						<label for="r1">電子郵件</label>
						<input type="radio" name="type" id="r2" value="電話">
						<label for="r2">電話</label>
						<input type="radio" name="type" id="r3" value="均可" checked>
						<label for="r3">均可</label>
					</div>
				</div>
				<div class="row">
					<div class="item dibAlignTop">詢問內容</div>
					<div class="item dibAlignTop"><textarea name="message" placeholder="留言....."></textarea></div>
					<div class="item">
						<input type="checkbox" name="subscrip" id="info" checked value="我要訂閱">
						<label for="info">我希望收到微碧愛普科技的相關資訊</label>
					</div>
				</div>
				<div id="submit" class="bg-is-red">送出</div>
				<input type="hidden" id="MM_insert" name="MM_insert" value="contact" />
				<!-- invisible recaptcha -->
				<div id='recaptcha' class="g-recaptcha"
				          data-sitekey="6Lc-OBkUAAAAAMCeet8dB6h81_63l01prRKOb9sV"
				          data-callback="onSubmit"
				          data-size="invisible"></div>
			</form>
		</div>
	</div>

	<?php include 'footer.php'; ?>
</body>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="js/jquery.validate.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/tooltipster.css">
<script src="js/jquery.tooltipster.min.js"></script>
<script src="js/common.js"></script>
</html>

<script>
	$(function () {
		$('#contactForm input[type="text"], #contactForm textarea').tooltipster({
			trigger: 'custom',
			onlyOne: false,
			position: 'top',
			theme: 'ryderisgood',
		});

		var validator = $("#contactForm").validate({
			ignore:[],
			rules:{
				name	: {
					required: true,
				},
				email	: {
					required: true,
					email: true
				},
				message	: {
					required: true,
				},
	        },
	        messages: {
	        	name: {
	        		required: "必填欄位",
	        	},
	        	email: {
	        		required: "必填欄位",
	        		email: "請檢查EMAIL格式"
	        	},
	        	message: {
	        		required: "必填欄位",
	        	},
	        },
	        errorPlacement: function (error, element) {
	        	$(element).tooltipster('update', $(error).text());
	        	$(element).tooltipster('show');
	        },
	        success: function (label, element) {
	        	$(element).tooltipster('hide');
	        }
	    })

		$("#submit").click(function () {
			if($("#contactForm").valid()==true){
				var answer = confirm("您確認要送出您所填寫的資訊嗎？");
				if (answer){
					grecaptcha.execute();
				}
			}
		})

		onSubmit = function (token) {
			$("#contactForm").submit();
		}
	})
</script>