<?php
require_once('inc/EDcart.php');
if (!isset($_SESSION)) {
  session_start();
}

$cart =& $_SESSION['edCart'];
if(!is_object($cart)) $cart = new edCart();
//echo "item = ".$cart->itemCount;
?>
<?php require_once('logout_action.php'); ?>
<?php require_once('member_limit.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "modifyForm")) {

	$birthday = $_POST['m_birthday'];
	$y = substr($birthday, 0, 4);
	$m = substr($birthday, 5, 2);
	$d = substr($birthday, 8, 2);

  $updateSQL = sprintf("UPDATE member_set SET m_name=%s, m_gender=%s, m_birthyear=%s, m_birthmonth=%s, m_birthday=%s, m_email=%s, m_phone=%s, m_cellphone=%s,  m_zip=%s, m_city=%s, m_canton=%s, m_address=%s WHERE m_id=%s",
                       GetSQLValueString($_POST['m_name'], "text"),
                       GetSQLValueString($_POST['m_gender'], "text"),
                       GetSQLValueString($y, "text"),
                       GetSQLValueString($m, "text"),
                       GetSQLValueString($d, "text"),
                       GetSQLValueString($_POST['m_email'], "text"),
                       GetSQLValueString($_POST['m_phone'], "text"),
                       GetSQLValueString($_POST['m_cellphone'], "text"),
					   GetSQLValueString($_POST['zipcode'], "int"),
					   GetSQLValueString($_POST['county'], "text"),
					   GetSQLValueString($_POST['district'], "text"),
                       GetSQLValueString($_POST['m_address'], "text"),
                       GetSQLValueString($_POST['m_id'], "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());

  $updateGoTo = "member_list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "modifyPassForm")) {

  $updateSQL = sprintf("UPDATE member_set SET m_password=%s WHERE m_id=%s",
                       GetSQLValueString(md5($_POST['m_password']), "text"),
                       GetSQLValueString($_POST['m_id'], "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());

  $updateGoTo = "member_list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}


$colname_RecMember = "-1";
if (isset($_SESSION['MM_UserAccount'])) {
  $colname_RecMember = $_SESSION['MM_UserAccount'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecMember = sprintf("SELECT * FROM member_set WHERE m_account = %s AND m_active='1'", GetSQLValueString($colname_RecMember, "text"));
$RecMember = mysql_query($query_RecMember, $connect2data) or die(mysql_error());
$row_RecMember = mysql_fetch_assoc($RecMember);
$totalRows_RecMember = mysql_num_rows($RecMember);
?>
<?php require_once('Connections/session.initialize.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>HanCure 漢速敷</title>

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
<script src="js/jquery.twzipcode.min.js"></script>

<script src="js/bootstrap.js"></script>

<link rel="stylesheet" href="js/bootstrap-datepicker/css/datepicker3.css">
<script src="js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<link rel="stylesheet/less" type="text/css" href="style_ryder.less">
<script src="js/less-1.3.0.min.js" type="text/javascript"></script>

<?php require_once('ga.php'); ?>
</head>
<body>
	<?php $now="member"; ?>
	<?php include('topmenu.php'); ?>

	<div class="edit-wrap">
		<?php include 'logo.php'; ?>

		<div class="area1">
			<?php include 'menu.php'; ?>
		</div><!-- area1 end -->

		<?php
		$m_now='data';
		include('member_menu.php');
		?>

		<div class="area3">

        <form action="<?php echo $editFormAction; ?>"  method="post" enctype="multipart/form-data" name="modifyForm"  id="modifyForm">

			<ul class="left">
				<li class="item2">修改會員資料</li>
				<li class="item3"><span>姓名</span> <input name="m_name" type="text" class="textcss" id="m_name" placeholder="" value="<?php echo $row_RecMember['m_name']; ?>"></li>
				<li class="item5"><span>電子郵件</span> <input name="m_email" type="text" class="textcss" id="m_email" placeholder="" value="<?php echo $row_RecMember['m_email']; ?>"></li>
				<li class="item6"><span>電話</span> <input name="m_phone" type="text" class="textcss" id="m_phone" placeholder="" value="<?php echo $row_RecMember['m_phone']; ?>"></li>

                <li class="item7"><span>生日</span> <input name="m_birthday" type="text" class="textcss" id="m_birthday" placeholder="西元/月/日" value="<?php echo $row_RecMember['m_birthyear'].'/'.$row_RecMember['m_birthmonth'].'/'.$row_RecMember['m_birthday']; ?>" data-mask="yyyy/mm/dd">

					</li>

			  <li class="item8"><span style="vertical-align: top;">縣市</span>
						<!--<select name="" id="select">
							<option>真新鎮</option>
						</select>-->

                        <div id="twzipcode">
  <div data-role="zipcode" data-style="textcss" data-value="<?php echo $row_RecMember['m_zip']; ?>"></div>
  <div data-role="county" data-style="county" data-value=""></div>
  <div data-role="district" data-style="" data-value=""></div>
</div>

			  </li>

				<!--<li class="item9"><span>郵遞區號</span> <input type="text" placeholder="" class="textcss" style="width:75px"></li>-->
				<li class="item10"><span>地址</span> <textarea name="m_address" id="m_address"><?php echo $row_RecMember['m_address']; ?></textarea>
				</li>
				<li class="line"></li>
				<li class="item12" id="modifySubmit">儲存</li>
			</ul><!-- ul.left end -->


            <input name="m_id" type="hidden" id="m_id" value="<?php echo $row_RecMember['m_id']; ?>" />
                    <input type="hidden" name="MM_update" value="modifyForm" />

            </form>

			<form action="<?php echo $editFormAction; ?>"  method="post" enctype="multipart/form-data" name="modifyPassForm"  id="modifyPassForm">

			<ul class="right modifyRight">
				<li class="item2">更改密碼</li>
				<li class="item3"><span>舊密碼</span> <input name="m_oldPassword" type="password" class="textcss" id="m_oldPassword" placeholder="舊密碼"></li>
				<li class="item3"><span>輸入新密碼</span> <input name="m_password" type="password" class="textcss" id="m_password" placeholder="輸入新密碼"></li>
				<li class="item3"><span>確認新密碼</span> <input name="m_repassword" type="password" class="textcss" id="m_repassword" placeholder="確認新密碼"></li>
				<li class="line"></li>
				<li class="item12" id="modifyPassSubmit">儲存</li>
			</ul><!-- ul.right end -->

            <input name="m_id" type="hidden" id="m_id" value="<?php echo $row_RecMember['m_id']; ?>" />
                    <input type="hidden" name="MM_update" value="modifyPassForm" />

            </form>

		</div><!-- area3 end -->

	</div><!-- edit-wrap end -->

	<?php include 'backtotop.php'; ?>
	<?php include 'footer.php'; ?>

<script src="js/bootstrap-datepicker/js/locales/bootstrap-datepicker.zh-TW.js"></script>
<script type="text/javascript">

jQuery.validator.addMethod("phoneTW", function(phone_number, element) {
	phone_number = phone_number.replace(/\s+/g, "");
	var $m_tel_exp = /^[09]{2}[0-9]{8}$/;  //mobile
	var $h_tel_exp = /[0-9]{2,3}-[0-9]{5,}/;  //home
	return this.optional(element) || phone_number.length == 10 &&
	phone_number.match($m_tel_exp) || phone_number.length > 9 && phone_number.match($h_tel_exp);
}, "請正確的電話號碼");


$(document).ready(function() {

	$('#twzipcode').twzipcode({
		readonly: true
		});

	$('#m_birthday').datepicker({
		format: "yyyy/mm/dd",
		language: "zh-TW",
		autoclose: true,
		todayHighlight: true
	  });

	$("#modifyForm").validate({
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
			m_email	: {
				required: true,
				email: true
			},
			m_phone  : {
				required: true,
				phoneTW: true,
				minlength: 9
			},
			m_birthday:{
				required: true,
		        date: true
			},
			zipcode : {
				required: true,
				number: true,
				rangelength: [3, 3]
				},
			county : {
				required: true
				},
			m_address : {
				required: true,
				minlength: 4
				},
			m_gender : {
				required: true
				}
	    },
	    messages: {
	      m_name: {
	        required: "必填欄位",
	        minlength: "至少請輸入二個字"
	      },
			m_email: {
	        required: "必填欄位",
	        email: "請檢查EMAIL格式"
	      },
	      m_phone: {
	        required: "必填欄位",
	        phoneTW: "輸入的格式錯誤",
	        minlength: "至少輸入九個字元"
	      },
	      m_birthday:{
				required: "必填欄位",
		        date: "輸入的格式錯誤",
			},
			zipcode :  {
				required: "必填欄位",
				number: "請輸入阿拉伯數字",
		        rangelength: "請輸入三碼郵遞區號"
			},
			county :  {
				required: "必填欄位"
			},
			m_address :  {
				required: "必填欄位",
		        minlength: "你的地址是否太短了呢"
			},
			m_gender :  {
				required: "必填欄位"
			}
	    }
	  });

	  $("#modifyPassForm").validate({
		//debug: true,
		ignore:[],
		rules: {
			m_oldPassword: {
				required: true,
				minlength: 6,
				remote: "flashJson/jquery-validation-1.9.0/validatePass.php"
				},
		 	 m_password	: {
				required: true,
				minlength: 6
				},
			m_repassword: {
				required: true,
				minlength: 6,
				equalTo: "#m_password"
			}
	    },
	    messages: {
		  m_oldPassword: {
			  required: "必填欄位",
			  minlength: "至少輸入六個字元",
			  remote: "舊密碼錯誤"
		  },
		  m_password: {
			  required: "必填欄位",
			  minlength: "至少輸入六個字元"
		  },
			m_repassword: {
				required: "必填欄位",
			  minlength: "至少輸入六個字元",
				equalTo: "與上方登入密碼不相同	"
			}
	    }
	  });

	  $("#modifySubmit").click(function() {
		  //console.log($("#modifyForm").valid());
		  if($("#modifyForm").valid()==true){
			  $("#insertC").val(1);
		  }
		  $("#modifyForm").submit();
	  });

	   $("#modifyPassSubmit").click(function() {
		  //console.log($("#modifyForm").valid());
		  if($("#modifyPassForm").valid()==true){
			  $("#loginC").val(1);
		  }
		  $("#modifyPassForm").submit();
	  });

});

</script>

</body>
</html>
