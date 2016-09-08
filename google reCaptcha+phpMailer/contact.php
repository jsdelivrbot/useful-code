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


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
	$editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

/*if (!isset($_SESSION['checkPost'])) {
	$_SESSION['checkPost'] = 0;
}*/

$_SESSION['checkPost'] = 0;

$err = "";
$message = "";




/*if ((!empty($_SESSION['check_word'])) && (!empty($_POST['m_checkword']))) {
	if($_SESSION['check_word'] == $_POST['m_checkword']){
		echo '<script> alert("表單已送出。"); </script>';
	}else{
		echo '<script type="text/javascript"> alert("驗證碼有分大小寫。"); </script>';
	}
}*/

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>六角國際事業股份有限公司</title>

	<?php include('meta.php') ?>

	<script src="js/jquery/1.11.1/jquery.min.js"></script>

	<script src="js/jquery.validate.min.js"></script>
	<script src="js/jquery.tooltipster.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/tooltipster.css">


	<script src='https://www.google.com/recaptcha/api.js?hl=zh-TW&onload=onloadCallback&render=explicit' async defer></script>

	<link rel="stylesheet/less" type="text/css" href="style_ryder.less">
	<script src="js/less-1.3.0.min.js"></script>

	<style type="text/css">
		#g-recaptcha{
			display: inline-block;
		}
		#hiddenRecaptcha{
			position: absolute;
			z-index: -1;
			left: 80px;
			/*opacity: 0;*/
		}
		.err, .succ{
			font-family: MHeiHK, "STXihei", HEITI TC, "HEITI TC", "黑體-繁", "微軟正黑體", "黑體", sans-serif;
			font-size: 15px;
			letter-spacing: 1px;
			line-height: 24px;
		}
		.err{
			color: #CB583D;
		}
		.succ{
			color: #8c189b;
		}
	</style>
</head>
<body>
	<?php $now="contact"; ?>
	<?php include 'topmenu.php'; ?>
	<?php include 'socialicon.php'; ?>

	<div class="newsWrap">
		<div class="titlePic">
			<img src="images/contact-titlepic.png" width="189">
		</div>

		<form action="contact_finish.php" method="POST" id="form1">
			<div class="formWrap">
				<div class="form-titlepic"><img alt="" src="images/nesonsary.png" width="208"></div>

				<div class="item">
					<span class="textWrap"><span class="title">公司名稱</span><input type="text" class="contactText" name="m_company"></span>
					<span class="textWrap"><span class="title">姓名</span><input type="text" class="contactText" name="m_name"></span>
				</div>
				<div class="item">
					<span class="textWrap"><span class="title">電話</span><input type="text" class="contactText" name="m_phone"></span>
					<span class="textWrap"><span class="title" style="color: #3c3c3d;">傳真</span><input type="text" class="contactText" name="m_fax"></span>
				</div>
				<div class="item">
					<span class="textWrap"><span class="title">電子郵件</span><input type="text" class="contactText" style="width: 552px;" name="m_mail"></span>
				</div>
				<div class="item">
					<span class="textWrap"><span class="title">地址</span><input type="text" class="contactText" style="width: 552px;" name="m_address"></span>
				</div>
				<div class="item">
					<span class="textWrap">
						<span class="title">類別</span>
						<select class="news-select" style="margin-left: -3px;" name="m_type">
							<option value="客服">客服</option>
						</select>

					</span>
				</div>
				<div class="item">
					<span class="textWrap"><span class="title">主旨</span><input type="text" class="contactText" name="m_title"></span>
				</div>
				<div class="item">
					<span class="textWrap"><span class="title" style="vertical-align: top;">訊息</span><textarea class="contactTextarea" name="m_content"></textarea></span>
				</div>
				<div class="item">
					<span class="textWrap" style="position: relative;">
						<span class="title" style="vertical-align: top;">驗證</span>

						<div class="g-recaptcha" id="g-recaptcha"></div>
						<input type="text" class="hiddenRecaptcha" name="hiddenRecaptcha" id="hiddenRecaptcha">
						<!-- recaptcha-anchor -->

						<!-- <img id="imgcode" src="captcha.php" onclick="refresh_code()" /><span class="ryder-form-note">點擊圖片可以更換驗證碼</span>
						<input type="text" class="contactText" name="m_checkword" style="width: 67px;"> -->
					</span>


				</div>

				<div class="item">
					<span class="textWrap">
						<span class="title"></span>
						<a href="javascript:;" class="btn" id="submit">確定送出</a>
						<a href="javascript:;" class="btn" id="clear">清除全部</a>
					</span>

				</div>

			</div><!-- formWrap end -->
			<input type="hidden" id="MM_insert" name="MM_insert" value="form1" />
		</form>

	</div><!-- newsWrap end -->
</body>
</html>

<script>


	$("#clear").click(function  () {
		$("#form1").find(":text,textarea").each(function() {
			$(this).val("");
		});
	})

	$('#form1 input[type="text"], #form1 textarea').tooltipster({
	       trigger: 'custom', // default is 'hover' which is no good here
	       onlyOne: false,    // allow multiple tips to be open at a time
	       position: 'top',  // display the tips to the right of the element
	   });

	// google captcha
	var verifyCallback = function(response) {
	    $("#hiddenRecaptcha").val(response);
	    validator.element("#hiddenRecaptcha");
	};

	onloadCallback = function() {
	    grecaptcha.render('g-recaptcha', {
	        'sitekey': '6LfPkSgTAAAAAMOM9QDqggcR-EbrdpbggxkLr8bU',
	        'callback' : verifyCallback,
	    });
	};

	var validator = $("#form1").validate({
		ignore:[],
		rules:{
			m_company	: {
				required: true,
				minlength: 2
			},
			m_name	: {
				required: true,
				minlength: 2
			},
			m_phone	: {
				required: true,
				minlength: 2
			},
			m_mail	: {
				required: true,
				email: true
			},
			m_address	: {
				required: true,
				minlength: 2
			},
			m_title	: {
				required: true,
				minlength: 2
			},
			m_content : {
				required: true,
				minlength: 2
			},
			hiddenRecaptcha: {
				required: true,
            }
        },
        messages: {
        	m_company: {
        		required: "必填欄位",
        		minlength: "您填寫的資料的是否太短了呢"
        	},
        	m_name: {
        		required: "必填欄位",
        		minlength: "您填寫的資料的是否太短了呢"
        	},
        	m_phone: {
        		required: "必填欄位",
        		minlength: "您填寫的資料的是否太短了呢"
        	},
        	m_mail: {
        		required: "必填欄位",
        		email: "請檢查EMAIL格式"
        	},
        	m_address: {
        		required: "必填欄位",
        		minlength: "您填寫的資料的是否太短了呢"
        	},
        	m_title: {
        		required: "必填欄位",
        		minlength: "您填寫的資料的是否太短了呢"
        	},
        	m_content: {
        		required: "必填欄位",
        		minlength: "您填寫的資料的是否太短了呢"
        	},
        	hiddenRecaptcha: {
        		required: "請確認你不是機器人"
        	}
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
		if($("#form1").valid()==true){
			var answer = confirm("您確認要送出您所填寫的資訊嗎？");
			if (answer){

				if($("#MM_insert").val()=='form1'){
					$("#MM_insert").attr("value", "subscription");
				}

				$("#form1").submit();
			}

		}
	})

	function refresh_code(){
		document.getElementById("imgcode").src="captcha.php";
	}
</script>