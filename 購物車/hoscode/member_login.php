<?php
require_once('inc/EDcart.php');
if (!isset($_SESSION)) {
  session_start();
}
$cart =& $_SESSION['edCart']; 
if(!is_object($cart)) $cart = new edCart(); 
//echo "item = ".$cart->itemCount;
?>
<?php require_once('mobileCheck.php'); ?>
<?php require_once('Connections/connect2data.php'); ?>
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

// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

$err = checkV('err');

if (isset($_POST['login_account'])) {	
	
  $loginUsername=$_POST['login_account'];
  $password = md5($_POST['login_password']);
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "member_list.php";
  $MM_redirectLoginFailed = "member_login.php?err=err";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_connect2data, $connect2data);
  
  $LoginRS__query=sprintf("SELECT m_account, m_password FROM member_set WHERE m_account=%s AND m_password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $connect2data) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_UserAccount'] = $loginUsername;
    $_SESSION['MM_UserMemberGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: ". $MM_redirectLoginSuccess );
	//echo "$MM_redirectLoginSuccess";
	//redirect("member.php");
	//redirect('ruyi.php');
  }
  else {
	  header("Location: ". $MM_redirectLoginFailed );
	//echo "$MM_redirectLoginFailed";
	//redirect($MM_redirectLoginFailed);
  }
}

mysql_select_db($database_connect2data, $connect2data);
$query_RecMemberRule = "SELECT * FROM data_set WHERE d_class1 = 'member_rule' ORDER BY d_sort ASC";
$RecMemberRule = mysql_query($query_RecMemberRule, $connect2data) or die(mysql_error());
$row_RecMemberRule = mysql_fetch_assoc($RecMemberRule);
$totalRows_RecMemberRule = mysql_num_rows($RecMemberRule);

/*$birthday = date('Y-m-d');
	echo $y = substr($birthday, 0, 4).'<br>';
	echo $m = substr($birthday, 5, 2).'<br>';
	echo $d = substr($birthday, 8, 2).'<br>';*/

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1") && $_POST["insertC"] == 1) {
	
	$birthday = $_POST['m_birthday'];
	$y = substr($birthday, 0, 4);
	$m = substr($birthday, 5, 2);
	$d = substr($birthday, 8, 2);

	$m_name         = checkV("m_name");
	$m_account      = checkV("m_account");
	$m_password     = checkV("m_password");
	$m_gender      = checkV("m_gender");
	$m_phone      = checkV("m_phone");
	$m_cellphone      = checkV("m_cellphone");
	$zipcode      = checkV("zipcode");
	$county      = checkV("county");
	$district      = checkV("district");
	$m_address      = checkV("m_address");
	$m_active      = checkV("m_active");
	$m_date      = checkV("m_date");

	$country_code      = checkV("country_code");
	$country      = checkV("country");

	
	
  $insertSQL = sprintf("INSERT INTO member_set (m_name, m_account, m_password, m_gender, m_birthyear, m_birthmonth, m_birthday, m_email, m_phone, m_cellphone, m_zip, m_city, m_canton, m_address, m_country, m_country_code, m_active, m_date) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($m_name, "text"),
                       GetSQLValueString($m_account, "text"),
                       GetSQLValueString(md5($m_password), "text"),
                       GetSQLValueString($m_gender, "text"),
					   GetSQLValueString($y, "text"),
					   GetSQLValueString($m, "text"),
                       GetSQLValueString($d, "text"),
                       GetSQLValueString($m_account, "text"),
                       GetSQLValueString($m_phone, "text"),
                       GetSQLValueString($m_cellphone, "text"),
					   GetSQLValueString($zipcode, "text"),
					   GetSQLValueString($county, "text"),
					   GetSQLValueString($district, "text"),
                       GetSQLValueString($m_address, "text"),
                       GetSQLValueString($country, "text"),
                       GetSQLValueString($country_code, "text"),
                       GetSQLValueString("1", "text"),
                       GetSQLValueString($m_date, "date"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());

//取得最新的會員ID編號========================================================
$mid = mysql_insert_id();
$_SESSION['max_id']=$mid;//將編號存變數值中


  $insertGoTo = "member_addFinish.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<?php require_once('Connections/session.initialize.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>C+H</title>

<!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->

<link rel="shortcut icon" href="img/fav.png" type="image/x-icon">
<!-- <link rel="apple-touch-icon" href="img/fav.png">
<link rel="apple-touch-icon" sizes="76x76" href="img/fav.png">
<link rel="apple-touch-icon" sizes="120x120" href="img/fav.png">
<link rel="apple-touch-icon" sizes="152x152" href="img/fav.png"> -->
<?php include('meta.php') ?>

<script src="js/jquery/1.11.1/jquery.min.js"></script>

<script src="js/jquery.form.js"></script>
<script src="flashJson/jquery-validation-1.14.0/dist/jquery.validate.js"></script>
<!-- <script src="js/jquery.twzipcode.min.js"></script> -->

<link rel="stylesheet" href="js/country-select/build/css/countrySelect.min.css">


<!-- Latest compiled and minified CSS -->
<!--<link rel="stylesheet" href="js/bootstrap.min.css">-->
<!-- Optional theme -->
<!-- Latest compiled and minified JavaScript -->
<script src="js/bootstrap.js"></script>

<link rel="stylesheet" href="js/bootstrap-datepicker/css/datepicker3.css">
<script src="js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!-- Add fancyBox -->
<link rel="stylesheet" href="js/fancyapps/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="js/fancyapps/source/jquery.fancybox.pack.js?v=2.1.5"></script>
<!-- Optionally add helpers - button, thumbnail and/or media -->
<link rel="stylesheet" href="js/fancyapps/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<script type="text/javascript" src="js/fancyapps/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="js/fancyapps/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

<link rel="stylesheet" href="js/fancyapps/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
<script type="text/javascript" src="js/fancyapps/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

<link rel="stylesheet/less" type="text/css" href="style_ryder.less">
<script src="js/less-1.3.0.min.js" type="text/javascript"></script>

<style type="text/css">
.login-wrap .area2 .left{
	width: 296px;
}
.login-wrap .area2 .left span{
	width: 98px;
}
label.error{
	margin-left: 102px;
}
.QuserPassReset{
	    font-family: "STXihei", HEITI TC, "HEITI TC", "黑體-繁", "微軟正黑體", "黑體", sans-serif;
    font-size: 15px;
    letter-spacing: 1px;
    color: #717171;
}

</style>

<?php require_once('ga.php'); ?>
</head>
<body>
	<?php $now="login"; ?>
	<?php include('topmenu.php'); ?>

	<div class="login-wrap">
		<?php include 'logo.php'; ?>

		<div class="area1">
			<?php include 'menu.php'; ?>
		</div><!-- area1 end -->

		<div class="area2">

			<form action="member_login.php"  method="post" enctype="multipart/form-data" name="addForm"  id="addForm">
				<ul class="left">
					<li class="item1">加入會員</li>
					<li class="item2">填寫會員資料</li>

					 <li class="item3">
                        <span>電子郵件</span>
                        <input name="m_account" type="text" class="textcss" id="m_account" placeholder="登入帳號">
                    </li>
                    
                    
                    <li class="item3">
                        <span>確認電子郵件</span>
                        <input name="m_reaccount" type="text" class="textcss" id="m_reaccount" placeholder="確認電子郵件">
                    </li>

					<li class="item3"><span>姓名</span> <input name="m_name" type="text" class="textcss" id="m_name" placeholder=""></li>

					<li class="item4">
                        <span>密碼</span>
                    	<input name="m_password" type="password" class="textcss" id="m_password" placeholder="登入密碼">
                    </li>
					<li class="item4">
                        <span>確認密碼</span>
                    	<input name="m_repassword" type="password" class="textcss" id="m_repassword" placeholder="登入確認密碼">
                    </li>
                    
                    
				  <?php if(0){ ?>
				  <li class="item4"><span>性別</span>
					 	<input name="m_gender" type="radio" id="r1" value="1" checked="checked">
					 	<label for="r1">男</label>
					 	<input name="m_gender" type="radio" id="r2" value="0">
					 	<label for="r2">女</label>
                    <label for="m_gender" class="error def-err"></label>
				  </li>
				  <?php } ?>
					<!--<li class="item5"><span>電子郵件</span> <input name="m_email" type="text" class="textcss" id="m_email" placeholder=""></li>-->
					<li class="item6"><span>電話</span> <input name="m_phone" type="text" class="textcss" id="m_phone" placeholder=""></li>
					<li class="item7"><span>生日</span> <input name="m_birthday" type="text" class="textcss" id="m_birthday" placeholder="西元/月/日" data-mask="yyyy/mm/dd"></li>

					<?php if(0){ ?>
					<li class="item8"><span style="vertical-align: top;">縣市</span>
						<!--<select name="" id="select">
							<option>真新鎮</option>
						</select>-->
                        
                        <div id="twzipcode">
						  <div data-role="zipcode" data-style="textcss" data-value="110"></div>
						  <div data-role="county" data-style="county" data-value="信義區"></div>
						  <div data-role="district" data-style="" data-value="台北市"></div>
						</div>
                        
					</li>
					<?php } ?>

					<li class="item8"><span>國家</span>
		              <div class="form-item">
		                  <input type="text" id="country" name="country">
		                  <input type="hidden" id="country_code" name="country_code" />
		                  <label for="country" style="display:none;">Select a country here...</label>
		              </div>              
		            </li>
                        
					<li class="item9"><span>郵遞區號</span> <input type="text" name="zipcode" id="zipcode" placeholder="" class="textcss" style="width:75px"></li>


					<li class="item10"><span>地址</span> <textarea name="m_address" id="m_address"></textarea></li>
                    
                    
                    
					<li class="item11 fancybox">
						<input type="radio" name="m_agree" id="m_agree" required>
					 	<label for="m_agree" class="fancybox">我已經閱讀並同意條款</label>

                        <!--<div class="error" id="m_agree-error">error</div>-->
                    </li>
                  
                 
					<li class="item12" id="addSubmit">註冊</li>
                    
				</ul><!-- ul.left end -->
                
                <input name="m_date" type="hidden" id="m_date" value="<?php echo date('Y-m-d H:i:s');?>" />
                <input name="m_active" type="hidden" id="m_active" value="1" />
                <input type="hidden" name="MM_insert" value="form1" />
                <input name="insertC" type="hidden" id="insertC" value="0" />
			</form>

			<form action="member_login.php"  method="post" enctype="multipart/form-data" name="logoForm"  id="logoForm">
				<ul class="right">
					<li class="item1">會員登入</li>
					<li class="item2"><span class="item3">
					  <input name="login_account" type="text" class="textcss" id="login_account" placeholder="會員帳號(電子郵件)">
					</span></li>
					<li class="item3"></li>
					<li class="item4"><input name="login_password" type="password" class="textcss" id="login_password" placeholder="登入密碼"></li>

					<li class="item4"><a href="QuserPassReset.php" class="QuserPassReset">忘記密碼?</a></li>

					<li class="item5" id="loginSubmit">登入</li>
                    <?php if($err=="err"){?>
                    <li class="item-err">登入帳號或密碼錯誤</li>
                    <?php } ?>


				</ul><!-- ul.right end -->
                
                <input type="hidden" name="MM_insert" value="loginForm" />
                <input name="insertC" type="hidden" id="insertC" value="0" />
			</form>

		</div><!-- area2 end -->

	</div><!-- login-wrap end -->

	<?php include 'backtotop.php'; ?>
	<?php include 'footer.php'; ?>

<script src="js/bootstrap-datepicker/js/locales/bootstrap-datepicker.zh-TW.js"></script>

<script src="js/country-select/build/js/countrySelect.min.js"></script>
<script type="text/javascript">

var country = $("#country").countrySelect(
    {
        defaultCountry: "tw",
        //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        //preferredCountries: ['ca', 'gb', 'tw', 'us'],
        preferredCountries: ['tw'],
        responsiveDropdown: true
    });
	
jQuery.validator.addMethod("phoneTW", function(phone_number, element) {
	phone_number = phone_number.replace(/\s+/g, "");
	var $m_tel_exp = /^[09]{2}[0-9]{8}$/;  //mobile
	var $h_tel_exp = /[0-9]{2,3}-[0-9]{5,}/;  //home
	return this.optional(element) || phone_number.length == 10 &&
	phone_number.match($m_tel_exp) || phone_number.length > 9 && phone_number.match($h_tel_exp);
}, "請正確的電話號碼");


$(document).ready(function() {

	$("label.fancybox").click(function() {
		$.fancybox.open({
			maxWidth	: 600,
			maxHeight	: 600,
			fitToView	: false,
			autoSize	: true,
			closeClick	: false,
			openEffect	: 'none',
			closeEffect	: 'none',
			type		: 'ajax',
			href		: 'member_rule.php',
			helpers		:{
							overlay : {
								locked : false   // if true, the content will be locked into overlay
							}
						}
		});
	});
	

	/*$("label.fancybox").fancybox({
		maxWidth	: 600,
		maxHeight	: 600,
		fitToView	: false,
		autoSize	: true,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none',
		type		: 'ajax',
		href		: 'member_rule.php',
		helpers		:{
						overlay : {
							locked : false   // if true, the content will be locked into overlay
						}
					}
	});*/
	$("#country").change(function() {     
      console.log($(this).val() + " => " + $("#country_code").val());
    });
	
	/*$('#twzipcode').twzipcode({
		readonly: true
		});*/
	
	$('#m_birthday').datepicker({
		format: "yyyy/mm/dd",
		language: "zh-TW",
		autoclose: true,
		todayHighlight: true
	  });

	$("#addForm").validate({
		//debug: true,
		ignore:[],
		/*errorElement: "div",
		errorClass: 'error_validate',*/
		errorPlacement: function (label, element) {
			// default
			if (element.is(':radio')) {
				label.insertAfter(element.next('label'));       
			}
			else {
				label.insertAfter(element);
			}
		},
		rules: {
	      	m_name	: {
				required: true,
				minlength: 2
				},
			m_account	: {
				required: true,
				minlength: 6,
				email: true,
				remote: "flashJson/jquery-validation-1.9.0/validateUser.php"
				},
			m_reaccount	: {
				required: true,
				minlength: 6,
				email: true,
				equalTo: "#m_account"
				},
			m_password	: {
				required: true,
				minlength: 6
				},
			m_repassword: {
				required: true,
				minlength: 6,
				equalTo: "#m_password"
			},
			m_email	: {
				required: true,
				email: true
			},
			m_phone  : {
				required: true,
				//phoneTW: true,
				minlength: 6
			},
			m_birthday:{
				required: true,
		        date: true
			},
			zipcode : {
				required: true/*,
				number: true,
				rangelength: [3, 3]*/
				},
			country : {
				required: true
				},
			m_address : {
				required: true,
				minlength: 4
				},
			/*m_gender : {
				required: true
				},*/
			m_agree : {
				required: true
				}/*,
			captcha: {
				required: true,
				remote: "flashJson/jquery-validation-1.9.0/validateCaptcha.php"
			}*/
	    },
	    messages: {
	      m_name: {
	        required: "必填欄位",
	        minlength: "至少請輸入二個字"
	      },
		  m_account: {
			  required: "必填欄位",
			  minlength: "至少輸入六個字元",
	          email: "請檢查EMAIL格式",
			  remote: "此帳號已被使用"
		  },
		  m_reaccount: {
			  required: "必填欄位",
			  minlength: "至少輸入六個字元",
	          email: "請檢查EMAIL格式",
	          equalTo: "與上方帳號不相同"
		  },
		  m_password: {
			  required: "必填欄位",
			  minlength: "至少輸入六個字元"
		  },
			m_repassword: {
				required: "必填欄位",
			  minlength: "至少輸入六個字元",
				equalTo: "與上方登入密碼不相同"
			},
			m_email: {
	        required: "必填欄位",
	        email: "請檢查EMAIL格式"
	      },
	      m_phone: {
	        required: "必填欄位",
	        //phoneTW: "輸入的格式錯誤",
	        minlength: "至少輸入六個字元"
	      },
	      m_birthday:{
				required: "必填欄位",
		        date: "輸入的格式錯誤"
			},
			zipcode :  {
				required: "必填欄位"/*,
				number: "請輸入阿拉伯數字",
		        rangelength: "請輸入三碼郵遞區號"*/
			},
			country :  {
				required: "必填欄位"
			},
			m_address :  {
				required: "必填欄位",
		        minlength: "你的地址是否太短了呢"
			},
			/*m_gender :  {
				required: "必填欄位"
			},*/
			m_agree :  {
				required: "必填欄位"
			}
	    }
	  });
	  
	  $("#logoForm").validate({
		//debug: true,
		ignore:[],
		rules: {
			login_account	: {
				required: true,
				minlength: 6,
				email: true
				},
			login_password	: {
				required: true,
				minlength: 6
				}
	    },
	    messages: {
		  login_account: {
			  required: "必填欄位",
			  minlength: "至少輸入六個字元",
	          email: "請檢查EMAIL格式"
		  },
		  login_password: {
			  required: "必填欄位",
			  minlength: "至少輸入六個字元"
		  }
	    }
	  });
	  
	  $("#addSubmit").click(function() {
		  //console.log($("#addForm").valid());
		  if($("#addForm").valid()==true){
			  $("#insertC").val(1);
		  }		  
		  $("#addForm").submit();		  
	  });
	  
	   $("#loginSubmit").click(function() {
		  //console.log($("#addForm").valid());
		  if($("#logoForm").valid()==true){
			  $("#loginC").val(1);
		  }		  
		  $("#logoForm").submit();		  
	  });

});

</script>

</body>
</html>
