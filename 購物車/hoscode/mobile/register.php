<?php
require_once('inc/EDcart.php');
if (!isset($_SESSION)) {
  session_start();
}
$cart =& $_SESSION['edCart']; 
if(!is_object($cart)) $cart = new edCart(); 
//echo "item = ".$cart->itemCount;
?>
<?php require_once('../Connections/connect2data.php'); ?>
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
<?php require_once('../Connections/session.initialize.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>C+H</title>

	<?php include('meta.php') ?>

	<script src="js/jquery/1.11.1/jquery.min.js"></script>

	
	<script src="../js/jquery.form.js"></script>
    <script src="../flashJson/jquery-validation-1.14.0/dist/jquery.validate.js"></script>
    <!-- <script src="../js/jquery.twzipcode.min.js"></script> -->

	<link rel="stylesheet" href="../js/country-select/build/css/countrySelect.min.css">
    
    <link rel="stylesheet" href="../js/bootstrap-datepicker/css/datepicker3.css">
    <script src="../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

	<!--<script src="js/jquery.twzipcode.js"></script>-->

	<!-- Add fancyBox -->
	<link rel="stylesheet" href="../js/fancyapps/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
	<script type="text/javascript" src="../js/fancyapps/source/jquery.fancybox.pack.js?v=2.1.5"></script>
	<!-- Optionally add helpers - button, thumbnail and/or media -->
	<link rel="stylesheet" href="../js/fancyapps/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
	<script type="text/javascript" src="../js/fancyapps/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
	<script type="text/javascript" src="../js/fancyapps/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

	<link rel="stylesheet" href="../js/fancyapps/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
	<script type="text/javascript" src="../js/fancyapps/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

	<link rel="stylesheet/less" type="text/css" href="style_ryder.less">
	<script src="js/less-1.3.0.min.js" type="text/javascript"></script>

	<style type="text/css">
		.big-mb{
			margin-bottom: 35px;
		}
		.shorttext{
			width: 115px;
		}
		.savebtn{
			text-align: center;
		}
		span.reddot, span.blankspan{
			width: 92px;
		}
		form#addForm label.error{
			margin-left: 96px;
		}
	   a.fancyboxCloseBtn{
	    position: absolute;
	    top: 2px;
	    right: 4px;
	    width: 30px;
	    height: 30px;
	    cursor: pointer;
	    z-index: 8040;
	   }
	   .fancyboxCloseBtn:before, .fancyboxCloseBtn:after {
	      transition: all 0.6s;
	      -webkit-transition: all 0.6s;
	      content: '';
	      position: absolute;
	      border-bottom: 2px solid #717071;
	      width: 100%;
	    }
	    .fancyboxCloseBtn:before {
	      top: 16px;
	      left: 0;
	      transform: rotate(45deg);
	      -webkit-transform: rotate(45deg);
	    }
	    .fancyboxCloseBtn:after {
	      bottom: 12px;
	      left: 0;
	      transform: rotate(-45deg);
	      -webkit-transform: rotate(-45deg);
	    }
	</style>

</head>
<body>

	<?php include 'topmenu-fixed.php'; ?>

	<div class="fortopmenupush"></div>

<form action="register.php"  method="post" enctype="multipart/form-data" name="addForm"  id="addForm">

	<div class="bigtitle">會員註冊</div>

	<div class="areatitle">填寫會員資料</div>

	<div class="datahere big-mb">
		<div>
			<span class="reddot">電子郵件</span>
            <input name="m_account" type="text" class="c-text" id="m_account" placeholder="登入帳號">
		</div>

		<div>
			<span class="reddot">確認電子郵件</span>
            <input name="m_reaccount" type="text" class="c-text" id="m_reaccount" placeholder="確認電子郵件">
		</div>

		<div>
			<span class="reddot">姓名</span>
          <input name="m_name" type="text" class="c-text shorttext" id="m_name" placeholder="">
		</div>
	  <div>
			<span class="reddot">密碼</span>
        <input name="m_password" type="password" class="c-text shorttext" id="m_password" placeholder="登入密碼">
		</div>
		<div>
			<span class="reddot">確認密碼</span>
                    	<input name="m_repassword" type="password" class="c-text shorttext" id="m_repassword" placeholder="登入確認密碼">
	  </div>
	  <?php if(0){ ?>
		<div>
			<span class="reddot">性別</span>            
            <input name="m_gender" type="radio" class="c-radio" id="r1" value="1" checked="CHECKED">
            <label for="r1">男</label>
            <input name="m_gender" type="radio" id="r2" value="0" class="c-radio">
            <label for="r2">女</label>
            <label for="m_gender" class="error def-err"></label>
	  </div>
	  <?php } ?>
		<div>
			<span class="reddot">電話</span>
            <input name="m_phone" type="text" class="c-text shorttext" id="m_phone" placeholder="">
	  </div>
		<div>
			<span class="reddot">生日</span>
            <input name="m_birthday" type="text" class="c-text shorttext" id="m_birthday" placeholder="西元/月/日" data-mask="yyyy/mm/dd">
		</div>
        
        
        <?php if(0){ ?>
        <div id="twzipcode">
        	<span class="reddot">地址</span>
          <div data-role="zipcode" data-style="c-text shorttextZip" data-value="110" class="zipCode-container"></div>
          <span class="blankspan blankspanNone"></span>
          <div data-role="county" data-style="data-select" data-value="信義區"></div>
          <div data-role="district" data-style="data-select" data-value="台北市"></div>
        </div>
        
		<!--<div id="twzipcode2">
			<span class="reddot">地址</span>
		  <div data-role="county" data-style="data-select"></div>
		  <div data-role="district" data-style="data-select"></div>
		</div>-->
		<?php } ?>


		   <div>
		    <span class="reddot">國家</span>
		    <div class="form-item">
		      <input type="text" id="country" name="country">
		      <input type="hidden" id="country_code" name="country_code" />
		      <label for="country" style="display:none;">Select a country here...</label>
		    </div> 
		   </div>

		    <div>
		      <span class="reddot">郵遞區號</span>
		      <input type="text" name="zipcode" id="zipcode" placeholder="" class="c-text" style="width:75px" value="<?php if (isset($row_RecMember['m_zip'])){ echo $row_RecMember['m_zip'];} ?>">

		    </div>

		<div>
			<!-- <span class="blankspan"></span> -->
      		<span class="reddot">地址</span>  
			<input type="text" class="c-text" name="m_address" id="m_address">
		</div>
        
        <div class="agree">  
        	<span class="blankspan"></span>     
            <input type="radio" name="m_agree" id="m_agree" class="c-radio" required>
            <label for="m_agree" class="fancybox">我已經閱讀並同意條款</label>
	  </div>
      
	</div>

	<div class="savebtn" id="addSubmit"><span>註冊</span></div>
    
    <input name="m_date" type="hidden" id="m_date" value="<?php echo date('Y-m-d H:i:s');?>" />
    <input name="m_active" type="hidden" id="m_active" value="1" />
    <input type="hidden" name="MM_insert" value="form1" />
    <input name="insertC" type="hidden" id="insertC" value="0" />
</form>
	<!--=====  End of 會員資料  ======-->


	<?php include 'footer.php'; ?>



<script src="../js/bootstrap-datepicker/js/locales/bootstrap-datepicker.zh-TW.js"></script>

<script src="../js/country-select/build/js/countrySelect.min.js"></script>

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
		      maxWidth  : 260,
		      height    : 'auto',
		      margin    : 0,
		      padding   : 10,
		      fitToView : false,
		      autoSize  : false,
		      closeClick  : false,
		      openEffect  : 'none',
		      closeEffect : 'none',
		      type    : 'ajax',
		      href    : '../member_rule.php',
		      tpl       :{
		              closeBtn : '<a title="Close" class="fancyboxCloseBtn" href="javascript:;"></a>'
		      },
		      helpers   :{
		              overlay : {
		                locked : true   // if true, the content will be locked into overlay
		              }
		            }
		    });
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
				remote: "../flashJson/jquery-validation-1.9.0/validateUser.php"
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
				equalTo: "與上方登入密碼不相同	"
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
		        date: "輸入的格式錯誤",
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
	  
	  $("#addSubmit").click(function() {
		  //console.log($("#addForm").valid());
		  if($("#addForm").valid()==true){
			  $("#insertC").val(1);
		  }		  
		  $("#addForm").submit();		  
	  });

});

</script>
</body>
</html>