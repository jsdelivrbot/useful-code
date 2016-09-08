<?php require_once('../sstart.php'); ?>
<?php require_once('../Connections/connect2data.php'); ?>
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

$colname_RecData = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecData = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecData = sprintf("SELECT * FROM data_set WHERE d_id = %s", GetSQLValueString($colname_RecData, "int"));
$RecData = mysql_query($query_RecData, $connect2data) or die(mysql_error());
$row_RecData = mysql_fetch_assoc($RecData);
$totalRows_RecData = mysql_num_rows($RecData);

$menu_is="contactUs";?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php require_once('cmsTitle.php'); ?></title>
<?php require_once('script.php'); ?>
<!-- InstanceBeginEditable name="doctitle" -->
<title>無標題文件</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->

<!-- InstanceEndEditable -->
<?php require_once('head.php');?>
<?php require_once('web_count.php');?>
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
            <td width="30%" class="list_title">查看聯絡我們</td>
            <td width="70%">&nbsp;</td>
        </tr>
	</table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td><img src="image/spacer.gif" width="1" height="1"></td>
        </tr>
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        	<td class="table_outline"><table border="0" align="center" cellpadding="5" cellspacing="1">
              <tr>
                <td width="100%" align="left" class="table_data">客戶資訊：</td>
              </tr>
      	  </table></td>
        </tr>
        <tr>
          <td><table width="100%" border="0" cellspacing="3" cellpadding="5">
            <tr>
              <td width="23%" align="center" class="table_title">聯絡人姓名</td>
              <td width="78%" bgcolor="#E4E4E4" class="table_data">
			  <?php 
			  	echo $row_RecData['d_title'];
				echo ($row_RecData['d_class4']==1) ? " 先生" : " 女士" ;
			  ?>
              </td>
            </tr>
            <tr>
              <td align="center" class="table_title">聯絡人EMAIL</td>
              <td class="table_data"><?php echo $row_RecData['d_class3']; ?></td>
            </tr>
            <tr>
              <td align="center" class="table_title">聯絡人電話</td>
              <td bgcolor="#E4E4E4" class="table_data"><?php echo $row_RecData['d_class2']; ?></td>
            </tr>
            <tr>
              <td align="center" class="table_title">顧客意見</td>
              <td class="table_data"><?php echo nl2br($row_RecData['d_content']); ?></td>
            </tr>
            <tr>
              <td align="center" class="table_title">諮詢時間</td>
              <td bgcolor="#E4E4E4" class="table_data"><?php echo $row_RecData['d_date']; ?></td>
            </tr>
          </table></td>
        </tr>
         <tr>
           <td align="center">&nbsp;</td>
         </tr>
         <tr>
         	<td align="center"><!--<button onclick="goBack()" class="no_board" id="goBackButton"><img src="image/back.gif" name="submit_pic" class="no_board" id="submit_pic" onmouseover="MM_swapImage('submit_pic','','image/back_over.gif',1)" onmouseout="MM_swapImgRestore()"></button>-->
            <input name="submitBtn" type="submit" class="btnType" id="submitBtn" value="回上一頁" />
            </td>
         </tr>
	</table>
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
</body>
<!-- InstanceEnd --></html>

<script type="text/javascript">
function goBack(){
	var referer = '<?php echo $_SERVER['HTTP_REFERER'];?>';
	if(referer==''){
		location.href = history.go(-1);
	}else{		
		location.href = referer;
	}
}

$(document).ready(function() {
	
	$('#submitBtn').click(goBack);
	
	$("#goBackButton").hover(function(){
		$(this).find('img').attr('src', 'image/back_over.gif');
	}, function(){
		$(this).find('img').attr('src', 'image/back.gif');
	});
  
});

</script>
<?php
mysql_free_result($RecData);
?>
