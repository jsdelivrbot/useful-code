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
?><?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  ini_set("session.cookie_httponly", 1);
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['user_account'])) {
  $loginUsername=clear_str($_POST['user_account']);
  $password=md5(clear_str($_POST['user_password']));
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "first.php";
  $MM_redirectLoginFailed = "login_again.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_connect2data, $connect2data);
  
  $LoginRS__query=sprintf("SELECT user_id, user_account, user_password, user_level, user_type, user_limit, user_active FROM `admin` WHERE user_account=%s AND user_password=%s AND user_active='1'",
      GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
      
   $LoginRS = mysql_query($LoginRS__query, $connect2data) or die(mysql_error());
   $row_LoginRS = mysql_fetch_assoc($LoginRS);
   $loginFoundUser = mysql_num_rows($LoginRS);

   //記錄登入資訊
   require_once('../Connections/get_client_ip.php');
   $IP = get_client_ip();  
     
   $insertSQL = sprintf("INSERT INTO admin_log (user_id, user_account, user_limit, user_active, login_date, login_ip, HTTP_USER_AGENT) VALUES (%s, %s, %s, %s, NOW(), %s, %s)",
                        GetSQLValueString($row_LoginRS['user_id'], "int"),
                        GetSQLValueString($loginUsername, "text"),
                        GetSQLValueString($row_LoginRS['user_limit'], "int"),
                        GetSQLValueString($row_LoginRS['user_active'], "int"),
                        GetSQLValueString($IP, "text"),
                        GetSQLValueString($_SERVER['HTTP_USER_AGENT'], "text"));

   mysql_select_db($database_connect2data, $connect2data);
   $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());

   $insert_id = mysql_insert_id();

   if ($loginFoundUser) {//帳密OK
      //更新登入第一階段OK
      $updateSQL = sprintf("UPDATE admin_log SET login_status=%s WHERE log_id=%s",
                          GetSQLValueString("OK", "text"),
                          GetSQLValueString($insert_id, "int"));

      mysql_select_db($database_connect2data, $connect2data);
      $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());

      $LoginRS__query=sprintf("SELECT user_id, user_account, user_level, user_type, user_limit, user_active FROM `admin` WHERE user_account=%s AND user_password=%s AND user_active='1' AND user_status='active' AND user_loginerr<5",
         GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text"));
      $LoginRS = mysql_query($LoginRS__query, $connect2data) or die(mysql_error());
      $row_LoginRS = mysql_fetch_assoc($LoginRS);
      $loginFoundUser = mysql_num_rows($LoginRS);

      if ($loginFoundUser){//帳號沒有被鎖

         //若登入成功後，登入錯誤次數則歸0
         $updateSQL = sprintf("UPDATE admin SET user_loginerr=%s WHERE user_id=%s",
                          GetSQLValueString(0, "int"),
                          GetSQLValueString($row_LoginRS['user_id'], "int"));
         mysql_select_db($database_connect2data, $connect2data);
         $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());

         //更新沒有被鎖
         $updateSQL = sprintf("UPDATE admin_log SET login_status=%s WHERE log_id=%s",
                          GetSQLValueString("Success", "text"),
                          GetSQLValueString($insert_id, "int"));
         mysql_select_db($database_connect2data, $connect2data);
         $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
         
         $loginStrGroup = "";

          if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
           //declare two session variables and assign them
           $_SESSION['MM_AccountUsername'] = $loginUsername;
           $_SESSION['MM_AccountUserGroup'] = $loginStrGroup;
           $_SESSION['MM_AccountUserLevel'] = $row_LoginRS['user_level'];
           $_SESSION['MM_AccountUserType'] = $row_LoginRS['user_type'];
           $_SESSION['MM_AccountUserLog'] = $insert_id;
           //瀏覽器
           $_SESSION['LAST_USER_AGENT'] = $_SERVER['HTTP_USER_AGENT'];



           require_once('getUser.php');

           if (isset($_SESSION['PrevUrl']) && false) {
             $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];
           }
           header("Location: " . $MM_redirectLoginSuccess );
           //header("Location: " . $MM_redirectLoginSuccess.'?logid='.$_SESSION['MM_AccountUserLog'] );
      }else{//帳號被鎖

         //更新被鎖
         $updateSQL = sprintf("UPDATE admin_log SET login_status=%s, logout_page=%s WHERE log_id=%s",
                          GetSQLValueString("Account Locked", "text"),
                          GetSQLValueString($_SERVER['PHP_SELF'], "text"),
                          GetSQLValueString($insert_id, "int"));
         mysql_select_db($database_connect2data, $connect2data);
         $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());

         $MM_redirectLoginFailed .= "?err=lock";
         header("Location: ". $MM_redirectLoginFailed );
      }
      
   }else {

      //因登入失敗，所以查詢是否有帳號，並已失敗多少次
      $checkErrSql = sprintf("SELECT user_loginerr FROM `admin` WHERE user_account=%s",
                           GetSQLValueString($loginUsername, "text")); 
      mysql_select_db($database_connect2data, $connect2data);
      $CheckErrRS = mysql_query($checkErrSql, $connect2data) or die(mysql_error());
      $row_CheckErrRS = mysql_fetch_assoc($CheckErrRS);
      $CheckErrRSTotal = mysql_num_rows($CheckErrRS);

      if($CheckErrRSTotal>0){ //表示有該帳號

         $err = intval($row_CheckErrRS['user_loginerr']);

         $err++;

         if($err>5){
            //更新被鎖
            $updateSQL = sprintf("UPDATE admin SET user_status=%s WHERE user_account=%s",
                             GetSQLValueString("Locked", "text"),
                             GetSQLValueString($loginUsername, "text"));
            mysql_select_db($database_connect2data, $connect2data);
            $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());

            $MM_redirectLoginFailed .= "?err=lock";

         }else{
            //紀錄登入失敗次數
            $updateSQL = sprintf("UPDATE admin SET user_loginerr=%s WHERE user_account=%s",
                             GetSQLValueString($err, "int"),
                             GetSQLValueString($loginUsername, "text"));

            mysql_select_db($database_connect2data, $connect2data);
            $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
         }
      }      

      //更新登入失敗
      $updateSQL = sprintf("UPDATE admin_log SET login_status=%s, logout_page=%s WHERE log_id=%s",
                          GetSQLValueString("LoginFailed", "text"),
                          GetSQLValueString($_SERVER['PHP_SELF'], "text"),
                          GetSQLValueString($insert_id, "int"));

      mysql_select_db($database_connect2data, $connect2data);
      $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());

      header("Location: ". $MM_redirectLoginFailed );
   }
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php require('cmsTitle.php'); ?></title>
<link href="css/work_css.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="../images/fav.ico" type="image/x-icon">
<!-- <script type="text/javascript" src="jquery/jquery-1.6.4.min.js"></script> -->


<script src="../js/vendor/jquery-1.11.1.min.js"></script>

<script src="../js/jquery.form.js"></script>
<script src="../js/jquery.validate.js"></script>

<!-- <script src='https://www.google.com/recaptcha/api.js?hl=zh-TW' async defer></script> -->

<script type="text/javascript">

$(document).ready(function() {
	
	$(".btnType").hover(function(){
		$(this).addClass('btnTypeClass');
		$(this).css('cursor', 'pointer');
	}, function(){
		$(this).removeClass('btnTypeClass');
	});
	
	//var mrg = ($(this).height() - $('#login-wrapper-form').height())/3;
	//$('#login-wrapper-form').css('margin-top',mrg+'px');
	
});

</script>
</head>
<body>
<div id="login-wrapper">
<div id="login-wrapper-form">
<form action="<?php echo $loginFormAction; ?>" method="POST" name="form1" id="form1">
    
    <div class="art-logo-name"><img src="../images/topmenu-logo@2x.png" width="220"></div>
    <!--<h2 class="art-logo-text"></h2>-->
    <h3 class="login-cms-text">後端內容管理系統</h3>
    
    
    <div id="login-content">
    <ul id="login-input">
    	<li><span class="login-input-text"><label for="user_account">ACCOUNT</label></span><input type="text" name="user_account" id="user_account" ></li>
    	<li><span class="login-input-text"><label for="user_password">PASSWORD</label></span><input type="password" name="user_password" id="user_password" ></li>

      <li>
        <div class="inputarea">
          <div class="login-input-text" id="where">驗證</div>

          <div class="g-recaptcha" id="g-recaptcha"></div>
          <input type="hidden" class="hiddenRecaptcha required" name="hiddenRecaptcha" id="hiddenRecaptcha">

          <!-- <span class="checkNumData">
            <input name="captcha"  type="text" id="captcha" size="6" maxlength="6" class="check-input"/>
          </span>
          <div class="checkNumImg">
            <a href="#" class="reload-img" title="按我重新產生驗證碼">
              <img src="../captchaCheck/check/showrandimg.php" alt="驗證碼" id="rand-img" />
            </a>
          </div>
          <div class="reCheckNumData">( <a href="#" class="reload-img" title="按我重新產生驗證碼">重新產生驗證碼</a> )</div> -->

          </div>

      </li>
    </ul>
    <img src="image/account_password_error.jpg" width="220" height="28">
    <input name="submitBtn" type="submit" class="btnType" id="submitBtn" value="送出" />
    <img src="image/bar.jpg" width="305" height="45">
    </div>
</form>
</div>

</div>


<link href="../captchaCheck/captchaLogin.css" rel="stylesheet" type="text/css">
<!-- <script src="../captchaCheck/reloadImg.js"></script> -->
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit&hl=zh-TW"
        async defer></script>
<script type="text/javascript">
  var onloadCallback = function() {
    grecaptcha.render('g-recaptcha', {
      'sitekey' : '6LeGlx4TAAAAAO7O4UIsrPXfk_F2MY0mERSvwaND'
    });
  };
</script>
<script>
$(window).load(function(){
  $("#login-wrapper-form").height($('form').height());
});
$(document).ready(function() {

    $("#form1").validate({
      ignore:[],
      rules: {
        user_account : {
        required: true,
        minlength: 5
        },
      user_password  : {
        required: true,
        minlength: 5
        },
        hiddenRecaptcha: {
          required: function () {
            //console.log(grecaptcha.getResponse());
              if (grecaptcha.getResponse() == '') {
                  return true;
              } else {
                  return false;
              }
          }
        }
        /*
        captcha: {
          required: true,
          remote: "../captchaCheck/validateCaptcha.php"
        }*/
      },
      messages: {
        user_account: {
        required: "必填欄位",
        minlength: "至少輸入五個字元"
      },
      user_password: {
        required: "必填欄位",
        minlength: "至少輸入五個字元"
      },      
      hiddenRecaptcha: {
        required: "請確認你不是機器人"
      }
        /*captcha : {
              required: "請輸入驗證碼",
              remote: "驗證碼錯誤"
          }*/
      },
      errorPlacement: function (error, element) {
        if(element.attr("name") == 'user_account'){
          error.insertAfter($("#user_account"));
        }
        if(element.attr("name") == 'user_password'){
          error.insertAfter($("#user_password"));
        }
        if(element.attr("name") == 'hiddenRecaptcha'){
          error.insertAfter($("#hiddenRecaptcha"));
        }
      }/*,
      submitHandler: function(validator, form, submitButton) {
        $('#MM_insert').val('formSend');
        //$( "#form1" ).submit();
      }*/
    });//goform
  

  
});
</script>
</body>
</html>
