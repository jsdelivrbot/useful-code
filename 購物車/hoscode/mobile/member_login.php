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
  $MM_redirectLoginSuccess = "order_list.php";
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

	<link rel="stylesheet/less" type="text/css" href="style_ryder.less">
	<script src="js/less-1.3.0.min.js" type="text/javascript"></script>

	<style type="text/css">
		.big-mb{
			margin-bottom: 35px;
		}
		.shorttext{
			width: 135px;
		}
		.datahere{
			text-align: center;
			margin-top: 50px;
			margin-bottom: 30px;
		}
		.savebtn{
			text-align: center;
		}
		.loginspan{
			display: inline-block;
			width: 80px;
		}
		.underline{
			text-decoration: underline;
			cursor: pointer;
		}
	</style>

</head>
<body>

	<?php include 'topmenu-fixed.php'; ?>

	<div class="fortopmenupush"></div>

	<div class="bigtitle">會員登入</div>

<form action="member_login.php"  method="post" enctype="multipart/form-data" name="logoForm"  id="logoForm">
	<div class="datahere">
    
    	<?php if($err=="err"){?>
            <span class="item-err">登入帳號或密碼錯誤</span>
            <?php } ?>
		<div>
			<span class="loginspan">帳號</span>
            <input name="login_account" type="text" class="c-text shorttext" id="login_account" placeholder="會員帳號">
		</div>
		<div>
			<span class="loginspan">密碼</span>
            <input name="login_password" type="password" class="c-text shorttext" id="login_password" placeholder="登入密碼">
            
            
		</div>

		<p>還不是會員嗎?  &nbsp;   <span class="underline"><a href="register.php">立即註冊</a></span></p>

		<p><br><span class="underline"><a href="QuserPassReset.php">忘記密碼?</a></span></p>
        
        <input type="hidden" name="MM_insert" value="loginForm" />
        <input name="insertC" type="hidden" id="insertC" value="0" />
        
	</div>

	<div class="savebtn"><span id="loginSubmit">登入</span></div>

        </form>

	<?php include 'footer.php'; ?>




</body>
</html>

<script type="text/javascript">

$(document).ready(function() {
	  
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
	  
	   $("#loginSubmit").click(function() {
		  //console.log($("#addForm").valid());
		  if($("#logoForm").valid()==true){
			  $("#loginC").val(1);
		  }		  
		  $("#logoForm").submit();		  
	  });

});

</script>

