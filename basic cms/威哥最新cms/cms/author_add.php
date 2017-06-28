<?php require_once('../sstart.php'); ?>
<?php require_once('../Connections/connect2data.php'); ?>
<?php require_once('photo_process_author.php'); ?>
<?php require_once('file_process.php'); ?>
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

if(!in_array(2,$_SESSION['MM_Limit']['a5'])){
	header("Location: author_list.php");
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$G_sel = '';
if (isset($_SESSION['selected_authorT'])){
	$G_sel = $_SESSION['selected_authorT'];
}

mysql_select_db($database_connect2data, $connect2data);
$query_RecAuthorT = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='authorT' AND T.term_active='1' ORDER BY term_sort ASC, term_id DESC";
$RecAuthorT = mysql_query($query_RecAuthorT, $connect2data) or die(mysql_error());
$row_RecAuthorT = mysql_fetch_assoc($RecAuthorT);
$totalRows_RecAuthorT = mysql_num_rows($RecAuthorT);

mysql_select_db($database_connect2data, $connect2data);
$query_RecLevel = "SELECT * FROM a_set WHERE a_type=0 ORDER BY a_id ASC";
$RecLevel = mysql_query($query_RecLevel, $connect2data) or die(mysql_error());
$row_RecLevel = mysql_fetch_assoc($RecLevel);
$totalRows_RecLevel = mysql_num_rows($RecLevel);

mysql_select_db($database_connect2data, $connect2data);
$query_RecArticleT = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='articleT' AND T.term_active='1' ORDER BY term_sort ASC, term_id DESC";
$RecArticleT = mysql_query($query_RecArticleT, $connect2data) or die(mysql_error());
$row_RecArticleT = mysql_fetch_assoc($RecArticleT);
$totalRows_RecArticleT = mysql_num_rows($RecArticleT);

$menu_is="author";
$_SESSION['nowMenu']= "author";
?>
<?php require_once('imagesSize.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php require_once('cmsTitle.php'); ?></title>
<?php require_once('script.php'); ?>
<!-- InstanceBeginEditable name="doctitle" -->
<title>無標題文件</title>

<script type="text/javascript">
<!--
function call_alert(link_url) {
			
			alert("上傳得檔案中，有的不是圖片!");
			window.location=link_url;
			
		}
		
		function addField() {
			var pTable=document.getElementById('pTable');
			var lastRow = pTable.rows.length;
			//alert(pTable.rows.length);
			var myField=document.getElementById('image'+lastRow);
			//alert('image'+lastRow);
			console.log('image'+lastRow);
			
			if(lastRow<4){
				if(myField.value){
					var aTr=pTable.insertRow(lastRow);
					var newRow = lastRow+1;
					var newImg='img'+(newRow);
					var aTd1=aTr.insertCell(0);
					aTd1.innerHTML = '<span class="table_data">選擇圖片： </span><input name="image[]" type="file" class="table_data" id="image'+newRow+'"><br><span class="table_data">圖片說明： </span><input name="image_title[]" type="text" class="table_data" id="image_title'+newRow+'">';
				}else{
					alert("尚有未選取之圖片欄位!!");
				}
				if(lastRow==3){
					$('#addF').hide();
				}
			}else{
				alert("最多上傳四張圖片哦!!");
			}
		
	    }
	
		function addField2() {
		var pTable2=document.getElementById('pTable2');
		var lastRow = pTable2.rows.length;
		//alert(pTable2.rows.length);
		var myField=document.getElementById('upfile'+lastRow);
		//alert('upfile'+lastRow);
		if(myField.value){
			var aTr=pTable2.insertRow(lastRow);
			var newRow = lastRow+1;
			var newFile='file'+(newRow);
			var aTd1=aTr.insertCell(0);
			aTd1.innerHTML = '<span class="table_data">選擇檔案： </span><input name="upfile[]" type="file" class="table_data" id="upfile'+newRow+'"><br><span class="table_data">檔案說明： </span><input name="upfile_title[]" type="text" class="table_data" id="upfile_title'+newRow+'">';
		}else{
			alert("尚有未選取之檔案欄位!!");
		}
	    }
//}

//-->
</script>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<link rel="stylesheet" href="jquery/chosen_v1.7.0/chosen.css">
<!-- <link rel="stylesheet" href="../js/datetimepicker-master/jquery.datetimepicker.css"> -->
<?php require_once('head.php');?>
<?php require_once('web_count.php');?>

<style type="text/css">
  meter {
  /* Reset the default appearance */
  /*-webkit-appearance: none;
     -moz-appearance: none;
          appearance: none;*/
  display: block;
  /*margin: 0 auto 1em;*/
  width: 367px;
  height: 0.5em;

  /* Applicable only to Firefox */
  background: none;
  background-color: rgba(100, 100, 100, 0.1);
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
}

meter::-webkit-meter-bar {
  background: none;
  background-color: rgba(100, 100, 100, 0.1);
}

/* Webkit based browsers */
meter[value="1"]::-webkit-meter-optimum-value { background: red; }
meter[value="2"]::-webkit-meter-optimum-value { background: yellow; }
meter[value="3"]::-webkit-meter-optimum-value { background: orange; }
meter[value="4"]::-webkit-meter-optimum-value { background: green; }

/* Gecko based browsers */
meter[value="1"]::-moz-meter-bar { background: red; }
meter[value="2"]::-moz-meter-bar { background: yellow; }
meter[value="3"]::-moz-meter-bar { background: orange; }
meter[value="4"]::-moz-meter-bar { background: green; }

input#user_account, input#user_password{
  width: auto;
}
#password-strength-text{
  display: block;
  margin-top: 0;
  margin-bottom: 0;
}
  label.error{
    /*position: absolute;
    left: 102%;
    top: 0;*/
    width: 160px;
    display: inline-block;
    text-align: left;
    font-size: 12px;
    color: #BF1733;
    font-family: Arial,Helvetica,Sans-Serif;
  }
  input.error{
    border-color: #BF1733 !important;
  }
</style>
</head>
<body>
<table width="1280" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td rowspan="2" align="left">
          <?php require_once('cmsHeader.php');?>
        </td>
        <td width="100" align="right" valign="middle">
          <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td colspan="5" align="left"><span class="color_white"><a href="<?php echo $logoutAction ?>">&nbsp;&nbsp;<img src="image/logout.gif" width="48" height="16" /></a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              </tr>
            <tr>
              <td>&nbsp;</td>
              <td align="left" class="color_white">&nbsp;</td>
              <td>&nbsp;</td>
              <td align="left" class="color_white">&nbsp;</td>
              <td>&nbsp;</td>
              </tr>
            <tr>
              <td colspan="5" align="left" class="table_data">&nbsp;&nbsp;<a href="../index.php" target="_blank">觀看首頁</a></td>
              </tr>
            </table>
        </td>
      </tr>
    </table>
<?php require_once('top.php'); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><!-- InstanceBeginEditable name="編輯區域" -->
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="30%" class="list_title">新增作者</td>
            <td width="70%">&nbsp;</td>
        </tr>
	</table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td><img src="image/spacer.gif" width="1" height="1"></td>
        </tr>
    </table>
    <form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1" id="form1">

    <?php if(0){ ?>
    <div class="groupBtn">
      <?php 
      if(isset($_SESSION['listLinks']) && $_SESSION['listLinks']!=''){ 

          if( (isset($_GET['sel'])&&$_GET['sel']!='') && (isset($_GET['now_d_id'])&&$_GET['now_d_id']!='') ){
            $reviewLink = "http://".$_SERVER['HTTP_HOST'].$nowFile."/"."author_detail.php?cat=".$_GET['sel']."&id=".$_GET['now_d_id'];
          }else{
            $reviewLink = "http://".$_SERVER['HTTP_HOST'].$nowFile."/"."author.php";
          }
      ?>
        <a href="<?php echo $_SESSION['listLinks'];?>" class="btnType finishBtn">完成</a>
        <a href="<?php echo $reviewLink; ?>" class="btnType pubBtn" target="_blank">預覽</a>

        <p>
        <a href="<?php echo $reviewLink; ?>" class="pubBtn red_letter" target="_blank">預覽網址:<?php echo $reviewLink; ?></a>
        </p>
      <?php } ?>
    </div>
    <?php } ?>

    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  		<tr>
   			<td>
            <table width="100%" border="0" cellpadding="5" cellspacing="3">
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">分類</td>
                  <td>
                    <label>
                      <select data-placeholder="請選擇分類..." class="table_data" tabindex="4" name="user_class" id="user_class">
                      <?php
                      do {  
                      ?>
                      <option value="<?php echo $row_RecAuthorT['term_id']?>"<?php if (!(strcmp($row_RecAuthorT['term_id'], $G_sel))) {echo "selected='selected'";} ?>><?php echo $row_RecAuthorT['name']?><?php //echo $row_RecAuthorT['term_id']?></option>
                      <?php
                    } while ($row_RecAuthorT = mysql_fetch_assoc($RecAuthorT));
                      $rows = mysql_num_rows($RecAuthorT);
                      if($rows > 0) {
                          mysql_data_seek($RecAuthorT, 0);
                    	  $row_RecAuthorT = mysql_fetch_assoc($RecAuthorT);
                      }
                    ?>
                      </select>
                    </label>
                    </td>
                  <td width="250" bgcolor="#e5ecf6">
                    
                    </td>
                </tr>

              <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">權限種類</td>
                  <td><label>
                    <select name="user_level" class="table_data" id="user_level">
                      <?php
                      do {
                      ?>
                      <option value="<?php echo $row_RecLevel['a_id']?>"><?php echo $row_RecLevel['a_title']?></option>
                      <?php
                      } while ($row_RecLevel = mysql_fetch_assoc($RecLevel));
                        $rows = mysql_num_rows($RecLevel);
                        if($rows > 0) {
                            mysql_data_seek($RecLevel, 0);
                          $row_RecLevel = mysql_fetch_assoc($RecLevel);
                        }
                      ?>
                    </select>
                  </label></td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
              </tr>
            	<tr>
            	  <td align="center" bgcolor="#e5ecf6" class="table_col_title">作者名</td>
            	  <td><input name="user_name" type="text" class="table_data" id="user_name" size="50" /></td>
            	  <td bgcolor="#e5ecf6">&nbsp;</td>
          	  </tr>

              <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">作者登入帳號</td>
                  <td><input name="user_account" type="text" class="table_data" id="user_account" value="" size="50" /></td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
              </tr>
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">作者登入密碼</td>
                  <td><input name="user_password" type="password" class="table_data" id="user_password" value="" size="50" />
                  
                  <meter max="4" id="password-strength-meter"></meter>
                  <p id="password-strength-text" class="red_letter"></p>
                  

                  </td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
              </tr>

              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">簡介</td>
                <td><textarea name="user_content" cols="100" rows="20" class="table_data" id="user_content"></textarea></td>
                <td bgcolor="#e5ecf6"><p class="red_letter">*小斷行請按Shift+Enter。<br />
                  輸入區域的右下角可以調整輸入空間的大小。</p></td>
              </tr>

              <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">主要專欄</td>
                  <td>
                    <label>
                      <select data-placeholder="請選擇主要專欄..." class="chosen-select table_data" multiple tabindex="4" name="user_column[]" id="user_column" style="width:80%;">
                      <?php
                      do {  
                      ?>
                      <option value="<?php echo $row_RecArticleT['term_id']?>"<?php if (!(strcmp($row_RecArticleT['term_id'], $G_sel))) {echo "selected='selected'";} ?>><?php echo $row_RecArticleT['name'].' '.$row_RecArticleT['name_en']?><?php //echo $row_RecArticleT['term_id']?></option>
                      <?php
                    } while ($row_RecArticleT = mysql_fetch_assoc($RecArticleT));
                      $rows = mysql_num_rows($RecArticleT);
                      if($rows > 0) {
                          mysql_data_seek($RecArticleT, 0);
                        $row_RecArticleT = mysql_fetch_assoc($RecArticleT);
                      }
                    ?>
                      </select>
                    </label>
                    </td>
                  <td width="250" bgcolor="#e5ecf6">
                    </td>
                </tr>

              
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">帳號是否有效</td>
                  <td><label>
                    <select name="user_active" class="table_data" id="user_active">
                      <option value="1">有效</option>
                      <option value="0">無效</option>
                    </select></label></td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                </tr>
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">時間</td>
                  <td><input name="user_date" type="text" class="table_data" id="user_date" value="<?php echo date("Y-m-d H:i:s"); ?>" size="50" /></td>
                	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
                <tr>
              		<td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳作者圖片</p></td>
              	    <td>
                    <table width="100%" border="0" cellpadding="2" cellspacing="2" bordercolor="#CCCCCC" class="data" id="pTable">
                    	<tr>
                     		<td> <span class="table_data">選擇圖片：</span>
                        	<input name="image[]" type="file" class="table_data" id="image1" />
                        	<br>
                        	<span class="table_data">圖片說明：</span>
                        	<input name="image_title[]" type="text" class="table_data" id="image_title1">                        	</td>
                  		</tr>
                    </table>
                    <?php if(0){ ?>
                    <table width="100%" border="0" cellspacing="5" cellpadding="2" id="addF">
                      <tr>
                        	<td height="28">
                        	<table border="0" cellspacing="2" cellpadding="2">
                        		<tr>
                            		<td><a href="javascript:addField()"><img src="image/add.png" width="16" height="16" border="0"></a></td>
                                	<td><a href="javascript:addField()" class="table_data">新增圖片</a></td>
                                	<td class="note_letter">&nbsp;</td>
                            	</tr>
                        	</table>
                          </td>
                        </tr>
                    </table>
                    <?php } ?> 
                    
                              </td>  
              	    <td bgcolor="#e5ecf6" class="table_col_title">
                    <p class="red_letter">*<?php echo $imagesSize[$_SESSION['nowMenu']]['note'];?></p>
                    </td>
                </tr>

                
			</table>
            </td>
		</tr>
        <tr>
        	<td>&nbsp;</td>
        </tr>
        <tr>
         	<td align="center">
          <?php if(0){ ?>
            <?php 

            if(isset($_SESSION['listLinks']) && $_SESSION['listLinks']!=''){ 
            ?>
              <a href="<?php echo $_SESSION['listLinks'];?>" class="btnType finishBtn">完成</a>
              <a href="<?php echo $reviewLink; ?>" class="btnType pubBtn" target="_blank">預覽</a>
            <?php 
              if(isset($_GET['now_d_id']) && $_GET['now_d_id']!=''){
                $_SESSION['listLinks'] = NULL;
              }              
            }else{ ?>
              <input name="submitBtn" type="submit" class="btnType" id="submitBtn" value="送出" />
            <?php } ?>
            <?php } ?>
            <input name="submitBtn" type="submit" class="btnType" id="submitBtn" value="送出" />
            </td>
        </tr>
	</table>
    <input type="hidden" name="MM_insert" value="form1" />
    </form>
    <table width="100%" height="1" border="0" align="center" cellpadding="0" cellspacing="0" class="buttom_dot_line">
        <tr>
            <td>&nbsp;</td>
        </tr>
    </table>
	<!-- InstanceEndEditable --></td>
  </tr>
</table></td>
  </tr>
</table>


<script src="jquery/zxcvbnJs/data/zxcvbn.js"></script>
<script src="jquery/chosen_v1.7.0/chosen.jquery.js" type="text/javascript"></script>
<script src="../js/datetimepicker-master/build/jquery.datetimepicker.full.js"></script>

<script src="../js/jquery.form.js"></script>
<script src="jquery/jquery-validation-1.15.1/dist/jquery.validate.js"></script>

<script type="text/javascript">
var config = {
  '.chosen-select' : {}
}
for (var selector in config) {
  $(selector).chosen(config[selector]);
}

var strength = {
    0: "最差",
    1: "壞",
    2: "弱",
    3: "好",
    4: "強"
  }
  var password = document.getElementById('user_password');
  var meter = document.getElementById('password-strength-meter');
  var text = document.getElementById('password-strength-text');

  password.addEventListener('input', function() {
    var val = password.value;
    var result = zxcvbn(val);

    // Update the password strength meter
    meter.value = result.score;

    //console.log(meter.value);

    // Update the text indicator
    if (val !== "") {
      text.innerHTML = "密碼強度： " + strength[result.score]; 
    } else {
      text.innerHTML = "";
    }
  });

$(document).ready(function(){
  $(".chosen-select").chosen({no_results_text: "沒有找到符合的字！"});

 /* $("#password-strength-meter").width( $("#user_password").width() );*/

  /*$.datetimepicker.setLocale('zh-TW');
  $('#user_date').datetimepicker({
    timepicker:false,
    format:'Y-m-d',
    dayOfWeekStart : 1
  });*/

  $("#form1").validate({
    //debug: true,
    ignore:[],
    /*errorElement: "div",
    errorClass: 'error_validate',*/
    errorPlacement: function (label, element) {
      // default
      console.log(element);
      if (element.is(':radio')) {
        label.insertAfter(element.next('label'));
      }
      else {
        label.insertAfter(element);
      }
    },
    rules: {
          user_name  : {
        required: true,
        minlength: 2
        },
      user_account : {
        required: true,
        minlength: 6,
        //email: true,
        remote: "jquery/validateUser.php"
        },
      m_reaccount : {
        required: true,
        minlength: 6,
        email: true,
        equalTo: "#m_account"
        },
      user_password  : {
        required: true,
        minlength: 6
        },
      m_repassword: {
        required: true,
        minlength: 6,
        equalTo: "#m_password"
      },
      user_column: {
        required: true
      },
      m_email : {
        required: true,
        email: true
      }
      },
      messages: {
        user_name: {
          required: "必填欄位",
          minlength: "至少請輸入二個字"
        },
        user_account: {
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
        user_password: {
          required: "必填欄位",
          minlength: "至少輸入六個字元"
        },
        m_repassword: {
          required: "必填欄位",
          minlength: "至少輸入六個字元",
          equalTo: "與上方登入密碼不相同"
        },
        user_column: {
            required: "必填欄位"
        },
        m_email: {
            required: "必填欄位",
            email: "請檢查EMAIL格式"
        }
      }
    });
});
</script>

</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($RecAuthorT);

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

 $user_tag = '';
 $class3 = '';
 /*if(isset($_POST['d_class2'])){
 	$user_tag = $_POST['d_class2'];
 }*/
 $user_tag = is_null(checkV('user_column')) ? NULL : implode (",", checkV('user_column'));
 
 //echo 'user_tag = '.$user_tag.'<br>';
 
 $tagA = $_POST['user_column'];
 $tagTMP = '';
 $user_tagTXT = "";
 //echo 'tagA = '.$tagA.'<br>';
 
 $user_name	= checkV('user_name');
 $user_account = checkV('user_account');
 $user_password	= checkV('user_password');
 $user_content	= checkV('user_content');
 $user_class  = checkV('user_class');
 $user_column = $user_tag;
 $user_level	= checkV('user_level');
 $user_active	= checkV('user_active');
 $user_date	= checkV('user_date');




 $insertSQL = sprintf("INSERT INTO admin (user_name, user_account, user_password, user_content, user_column, user_class, user_level, user_active, user_date, user_status, user_type) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, 0)",
                       GetSQLValueString($user_name, "text"),
                       GetSQLValueString($user_account, "text"),
                       GetSQLValueString(md5($user_password), "text"),
                       GetSQLValueString($user_content, "text"),
                       GetSQLValueString($user_column, "text"),
                       GetSQLValueString($user_class, "int"),
                       GetSQLValueString($user_level, "int"),
                       GetSQLValueString($user_active, "int"),
                       GetSQLValueString($user_date, "date"),
                       GetSQLValueString("active", "text"));
 mysql_select_db($database_connect2data, $connect2data);
 $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
  
	
	$new_data_num = mysql_insert_id();

  if(1){


    mysql_select_db($database_connect2data, $connect2data);
    $query_RecAuthorT = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='authorT' AND T.term_active='1' AND term_id='$user_class'";
    $RecAuthorT = mysql_query($query_RecAuthorT, $connect2data) or die(mysql_error());
    $row_RecAuthorT = mysql_fetch_assoc($RecAuthorT);
    $totalRows_RecAuthorT = mysql_num_rows($RecAuthorT);

    if($row_RecAuthorT['name']!=''){
      $user_tagTXT = $user_tagTXT.$row_RecAuthorT['name'].",";
    }
    if($row_RecAuthorT['name_en']!=''){
      $user_tagTXT = $user_tagTXT.$row_RecAuthorT['name_en'].",";
    }

    $i=1;
  			
  	foreach ($tagA as $tagO){
  		/*$insertSQL = sprintf("INSERT INTO term_relationships (object_id, term_taxonomy_id) VALUES (%s, %s)",
                         GetSQLValueString($new_data_num, "int"),
                         GetSQLValueString($tagO, "int"));

  		  mysql_select_db($database_connect2data, $connect2data);
  		  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());

        mysql_select_db($database_connect2data, $connect2data);
        $query_RecAuthorT = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='articleT' AND T.term_active='1' ORDER BY term_sort ASC, term_id DESC";
        $RecAuthorT = mysql_query($query_RecAuthorT, $connect2data) or die(mysql_error());
        $row_RecAuthorT = mysql_fetch_assoc($RecAuthorT);
        $totalRows_RecAuthorT = mysql_num_rows($RecAuthorT);

        if($i==1){
          $tagTMP = $tagO;  
        }
  		  $i++;*/

      mysql_select_db($database_connect2data, $connect2data);
      $query_RecArticleT = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='articleT' AND T.term_active='1' AND term_id='$tagO'";
      $RecArticleT = mysql_query($query_RecArticleT, $connect2data) or die(mysql_error());
      $row_RecArticleT = mysql_fetch_assoc($RecArticleT);
      $totalRows_RecArticleT = mysql_num_rows($RecArticleT);
     
      //$user_tagTXT = $user_tagTXT.$row_RecArticleT['name'].",".$row_RecArticleT['name_en'].",";

      if($row_RecArticleT['name']!=''){
        $user_tagTXT = $user_tagTXT.$row_RecArticleT['name'].",";
      }
      if($row_RecArticleT['name_en']!=''){
        $user_tagTXT = $user_tagTXT.$row_RecArticleT['name_en'].",";
      }
  	}


    $updateSQL = sprintf("UPDATE admin SET user_tag_txt=%s WHERE user_id=%s",
                         GetSQLValueString($user_tagTXT, "text"),
                         GetSQLValueString($new_data_num, "int"));

    mysql_select_db($database_connect2data, $connect2data);
    $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
  }
			
  //----------插入圖片資料到資料庫begin(須放入插入主資料後)----------
  //
  if(isset($_FILES['image']) && $_FILES['image']!=''){

    $image_result=image_process($_FILES['image'], $_REQUEST['image_title'], "author", "add", $imagesSize[$_SESSION['nowMenu']]['IW'], $imagesSize[$_SESSION['nowMenu']]['IH']);
    //echo count($image_result);
    //echo $image_result[0][0];
    
    for($j=1;$j<count($image_result);$j++)
    {
        $insertSQL = sprintf("INSERT INTO file_set (file_name, file_link1, file_link2, file_link3, file_type, file_d_id, file_title, file_show_type) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($image_result[$j][0], "text"),
                       GetSQLValueString($image_result[$j][1], "text"),
                       GetSQLValueString($image_result[$j][2], "text"),
                       GetSQLValueString($image_result[$j][3], "text"),
                       GetSQLValueString("imageAuthor", "text"),
                       GetSQLValueString($new_data_num, "int"),
                       GetSQLValueString($image_result[$j][4], "text"),
                       GetSQLValueString($image_result[$j][5], "int"));

          mysql_select_db($database_connect2data, $connect2data);
          $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
        $_SESSION["change_image"]=1;
    }

  }
	//----------插入圖片資料到資料庫end----------
	//----------插入檔案資料到資料庫begin(須放入插入主資料後)----------
   			//echo file_process();
		
  if(isset($_FILES['image']) && $_FILES['image']!=''){

    $file_result=file_process("author","add");
    //echo count($file_result);
    
    for($j=0;$j<count($file_result);$j++)
    {
        $insertSQL = sprintf("INSERT INTO file_set (file_name, file_link1, file_type, file_d_id, file_title) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($file_result[$j][0], "text"),
                       GetSQLValueString($file_result[$j][1], "text"),
                       GetSQLValueString("file", "text"),
                       GetSQLValueString($new_data_num, "int"),
                       GetSQLValueString($file_result[$j][2], "text"));

          mysql_select_db($database_connect2data, $connect2data);
          $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
    }  
  }
		


   /* mysql_select_db($database_connect2data, $connect2data);
    $query_RecAuthor = "SELECT * FROM term_relationships AS TR, data_set AS D, terms AS T
    WHERE TR.term_taxonomy_id = T.term_id AND D.d_id = TR.object_id AND T.term_id='$tagTMP' ORDER BY term_order ASC, d_date DESC";
    $RecAuthor = mysql_query($query_RecAuthor, $connect2data) or die(mysql_error());
    $row_RecAuthor = mysql_fetch_assoc($RecAuthor);
    $totalRows_RecAuthor = mysql_num_rows($RecAuthor);*/

    mysql_select_db($database_connect2data, $connect2data);
    $query_RecAuthor = "SELECT * FROM `admin` WHERE user_type=0 ORDER BY user_id ASC";
    $RecAuthor = mysql_query($query_RecAuthor, $connect2data) or die(mysql_error());
    $row_RecAuthor = mysql_fetch_assoc($RecAuthor);
    $totalRows_RecAuthor = mysql_num_rows($RecAuthor);

    $_SESSION['totalRows'] = $totalRows_RecAuthor;
	
	
  $_SESSION['original_selected'] = $_SESSION['selected_authorT'] = $user_class;


  $stringLink = "?sel=".$user_class."&pageNum=0&totalRows_RecAuthor=".$_SESSION['totalRows']."&changeSort=1&now_d_id=".$new_data_num."&change_num=1";
  
  $insertGoTo = "author_list.php".$stringLink;

  //$insertGoTo = "author_list.php?sel=".$tagTMP."&pageNum=0&totalRows_RecAuthor=".$_SESSION['totalRows']."&changeSort=1&now_d_id=".$new_data_num."&change_num=1";
  
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }

  $_SESSION['listLinks'] = $insertGoTo;

  $selfLink = "author_add.php".$stringLink;
  
  if($image_result[0][0]==1)
  {
  		echo "<script type=\"text/javascript\">call_alert('".$insertGoTo."');</script>";
  }else
  {
  		header(sprintf("Location: %s", $insertGoTo));
  }
  
}
?>

