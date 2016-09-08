<?php require_once('../sstart.php'); ?>
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

$compareToday_RecToday = date("Y-m-d");
mysql_select_db($database_connect2data, $connect2data);
$query_RecToday = sprintf("SELECT * FROM webcount WHERE count_time LIKE %s", GetSQLValueString($compareToday_RecToday . "%", "text"));
$RecToday = mysql_query($query_RecToday, $connect2data) or die(mysql_error());
$row_RecToday = mysql_fetch_assoc($RecToday);
$totalRows_RecToday = mysql_num_rows($RecToday);

$compareThisMonth_RecThisMonth = date("Y-m");
mysql_select_db($database_connect2data, $connect2data);
$query_RecThisMonth = sprintf("SELECT * FROM webcount WHERE count_time LIKE %s", GetSQLValueString($compareThisMonth_RecThisMonth . "%", "text"));
$RecThisMonth = mysql_query($query_RecThisMonth, $connect2data) or die(mysql_error());
$row_RecThisMonth = mysql_fetch_assoc($RecThisMonth);
$totalRows_RecThisMonth = mysql_num_rows($RecThisMonth);

$compareThisYear_RecThisYear = date("Y");
mysql_select_db($database_connect2data, $connect2data);
$query_RecThisYear = sprintf("SELECT * FROM webcount WHERE count_time LIKE %s", GetSQLValueString($compareThisYear_RecThisYear . "%", "text"));
$RecThisYear = mysql_query($query_RecThisYear, $connect2data) or die(mysql_error());
$row_RecThisYear = mysql_fetch_assoc($RecThisYear);
$totalRows_RecThisYear = mysql_num_rows($RecThisYear);

mysql_select_db($database_connect2data, $connect2data);
$query_RecTotal = "SELECT * FROM webcount";
$RecTotal = mysql_query($query_RecTotal, $connect2data) or die(mysql_error());
$row_RecTotal = mysql_fetch_assoc($RecTotal);
$totalRows_RecTotal = mysql_num_rows($RecTotal);

 $menu_is="webCount";
 ?>
 
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
<script type="text/javascript">
<!--

function centerWindow(theURL,winName,width,height,features) {
//織夢平台 http://www.e-dreamer.idv.tw
//分享是成長的開始
    var window_width = width;
    var window_height = height;
    var edfeatures= features;
    var window_top = (screen.height-window_height)/2;
    var window_left = (screen.width-window_width)/2;
    newWindow=window.open(''+ theURL + '',''+ winName + '','width=' + window_width + ',height=' + window_height + ',top=' + window_top + ',left=' + window_left + ',features=' + edfeatures + '');
    newWindow.focus();
}
//-->
</script>
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
	<table width="800" border="0" cellpadding="0" cellspacing="0">
    	<tr>
        	<td width="145" class="list_title">常見問題分類列表</td>
        	<td width="655">&nbsp;</td>
        </tr>
    </table>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
    	<tr>
            <td width="739" align="right" class="page_display">
            <!-------顯示頁選擇與分頁設定開始---------->
            <!-------顯示頁選擇與分頁設定結束---------->
            <td width="110" align="right" class="page_display">&nbsp;</td>
            <td width="151" align="right" class="page_display">&nbsp;</td>
            <td width="24" align="right">&nbsp;</td>
     	</tr>
	</table>
    <table width="800" border="0" cellspacing="0" cellpadding="0">
        <tr>
        	<td><img src="image/spacer.gif" width="1" height="1" /></td>
        </tr>
    </table>
	<form action="" method="post" name="form1" id="form1">
      <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
        <tr>
          <td align="center" class="table_title">本日</td>
          <td align="center" class="table_title">本月</td>
          <td align="center" class="table_title">本年</td>
          <td align="center" class="table_title">總人次</td>
          <td align="center" class="table_title">最近瀏覽者資料</td>
        </tr>
  <td align="center" class="table_data" ><label><span class="buttom_dot_line"><span class="no_data"><?php echo $totalRows_RecToday ?></span>人次</span></label></td>
      <td align="center" class="table_data" ><span class="buttom_dot_line"><span class="no_data"><?php echo $totalRows_RecThisMonth ?> </span>人次</span></td>
    <td align="center"  class="table_data"><span class="buttom_dot_line"><span class="no_data"><?php echo $totalRows_RecThisYear ?> </span>人次</span></td>
    <td align="center" class="table_data"><span class="buttom_dot_line"><span class="no_data"><?php echo $totalRows_RecTotal ?></span>人次</span></td>
    <td align="center" class="table_data"><a href="javascript:;" class="table_data" onclick="centerWindow('showVisit.php','巴特里精緻烘培瀏覽者資料','400','480','')">最近瀏覽者資料</a></td>
  </tr>
      </table>
	</form>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
        <tr>
            <td width="739" align="right" class="page_display">
            <!-------顯示頁選擇與分頁設定開始---------->
            <!-------顯示頁選擇與分頁設定結束---------->
            <td width="110" align="right" class="page_display">&nbsp;</td>
            <td width="151" align="right" class="page_display">&nbsp;</td>
            <td width="24" align="right">&nbsp;</td>
        </tr>
    </table>
	<!-- InstanceEndEditable --></td>
  </tr>
</table></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
