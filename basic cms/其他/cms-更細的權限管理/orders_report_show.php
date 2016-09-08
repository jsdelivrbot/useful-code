<?php require_once('../Connections/connect2data.php'); ?>
<?php
			if (!isset($_SESSION)) {
               session_start();
               }
            ob_start();
?>
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

if(!in_array(3,$_SESSION['MM_Limit']['a6'])){
	header("Location: first.php");
}



$menu_is="orders";?>
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
<style type="text/css">
<!--
.ff02 {font-size: 13px;
	font-family: "ө";
	font-style: normal;
	line-height: 23px;
	font-weight: normal;
	font-variant: normal;
	text-transform: none;
	color: #333333;
}
-->
</style>
<style type="text/css">
<!--
.f0111 {font-size: 13px;
	line-height: normal;
	color: #990000;
	margin-right:7px;
}
-->
</style>
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
?>
      <?php
$colname_RecRecOrder = "-1";
if (isset($_GET['o_id'])) {
  $colname_RecRecOrder = $_GET['o_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecRecOrder = sprintf("SELECT * FROM order_set WHERE o_id = %s", GetSQLValueString($colname_RecRecOrder, "int"));
$RecRecOrder = mysql_query($query_RecRecOrder, $connect2data) or die(mysql_error());
$row_RecOrder = mysql_fetch_assoc($RecRecOrder);
$totalRows_RecRecOrder = mysql_num_rows($RecRecOrder);
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="183" class="list_title" border="0" cellpadding="5" cellspacing="1">匯款回報資訊</td>
          <td width="617">&nbsp;</td>
        </tr>
      </table>
  <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
  <tr>
    <td width="628" align="right" class="page_display">    </td>
    <td width="78" align="right" class="page_display">&nbsp;</td>
    <td width="62" align="right" class="page_display">&nbsp;</td>
    <td width="32" align="right">&nbsp;</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="image/spacer.gif" width="1" height="1" /></td>
  </tr>
</table>
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
  <tr>
    <td width="22%" align="center" class="table_title">匯款帳戶名</td>
    <td width="78%" class="table_data">　<?php echo $row_RecOrder['remitter']; ?></td>
  </tr>
  <tr>
    <td align="center" class="table_title">匯款帳號後五碼</td>
    <td bgcolor="#EAEAEA" class="table_data">　<?php echo $row_RecOrder['remitter_AC']; ?></td>
  </tr>
  <tr>
    <td align="center" class="table_title">匯款金額</td>
    <td class="table_data">　<?php echo $row_RecOrder['remitter_money']; ?>元</td>
  </tr>
  <tr>
    <td align="center" class="table_title">匯款時間</td>
    <td  bgcolor="#EAEAEA"class="table_data">　<?php echo $row_RecOrder['remitter_time']; ?></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input name="button" type="button" class="button_set" id="button" value="返回列表" onclick="window.location='<?php echo $_SESSION['REFERER'];?>';"/>
    <!--<input name="Submit" type="button" class="button_set" value="修改" onclick="window.location='orders_report.php?o_id=<?php //echo $row_RecOrder['o_id']; ?>';"/>-->
    </td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
  <tr>
    <td width="628" align="right" class="page_display">    </td>
    <td width="78" align="right" class="page_display">&nbsp;</td>
    <td width="62" align="right" class="page_display">&nbsp;</td>
    <td width="32" align="right">&nbsp;</td>
  </tr>
</table>
	<!-- InstanceEndEditable --></td>
  </tr>
</table></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($RecRecOrder);
?>
