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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$colname_RecMenu = "-1";
if (isset($_GET['menu_id'])) {
  $colname_RecMenu = $_GET['menu_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecMenu = sprintf("SELECT * FROM menu WHERE menu_id = %s", GetSQLValueString($colname_RecMenu, "int"));
$RecMenu = mysql_query($query_RecMenu, $connect2data) or die(mysql_error());
$row_RecMenu = mysql_fetch_assoc($RecMenu);
$totalRows_RecMenu = mysql_num_rows($RecMenu);
//echo 'ToPage = '.$_SESSION["ToPage"];
$menu_is="menu";?>

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
            <td width="30%" class="list_title">修改主選單</td>
            <td width="70%">&nbsp;</td>
        </tr>
	</table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td><img src="image/spacer.gif" width="1" height="1"></td>
        </tr>
    </table>
    <form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1" id="form1">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  		<tr>
   			<td>
            <table width="100%" border="0" cellspacing="3" cellpadding="5">
            	<tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">標題</td>
          	    	<td width="532"><input name="menu_title" type="text" class="table_data" id="menu_title" value="<?php echo $row_RecMenu['menu_title']; ?>" size="50" />
          	    	  <input name="menu_id" type="hidden" id="menu_id" value="<?php echo $row_RecMenu['menu_id']; ?>" /></td>
        	    	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	    	</tr>
            	<tr>
            	  <td align="center" bgcolor="#e5ecf6" class="table_col_title">連結</td>
            	  <td><input name="menu_link" type="text" class="table_data" id="menu_link" value="<?php echo $row_RecMenu['menu_link']; ?>" size="50" /></td>
            	  <td bgcolor="#e5ecf6">&nbsp;</td>
          	  </tr>
                <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">ID</td>
          	    	<td width="532"><input name="menu_use" type="text" class="table_data" id="menu_use" value="<?php echo $row_RecMenu['menu_use']; ?>" size="50"></td>
        	    	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
                <tr>
                	<td align="center" bgcolor="#e5ecf6" class="table_col_title">pageTitle1</td>
          	    	<td><input name="menu_pageTitle1" type="text" class="table_data" id="menu_pageTitle1" value="<?php echo $row_RecMenu['menu_pageTitle1']; ?>" size="50"></td>
        	    	<td bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
                <tr>
                	<td align="center" bgcolor="#e5ecf6" class="table_col_title">pageTitle2</td>
          	    	<td><input name="menu_pageTitle2" type="text" class="table_data" id="menu_pageTitle2" value="<?php echo $row_RecMenu['menu_pageTitle2']; ?>" size="50"></td>
        	    	<td bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
                <tr>
                	<td align="center" bgcolor="#e5ecf6" class="table_col_title">pageTitle3</td>
          	    	<td><input name="menu_pageTitle3" type="text" class="table_data" id="menu_pageTitle3" value="<?php echo $row_RecMenu['menu_pageTitle3']; ?>" size="50"></td>
        	    	<td bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
                <tr>
                	<td align="center" bgcolor="#e5ecf6" class="table_col_title">pageTitle4</td>
          	    	<td><input name="menu_pageTitle4" type="text" class="table_data" id="menu_pageTitle4" value="<?php echo $row_RecMenu['menu_pageTitle4']; ?>" size="50"></td>
        	    	<td bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
                <tr>
                	<td align="center" bgcolor="#e5ecf6" class="table_col_title">pageTitle5</td>
          	    	<td><input name="menu_pageTitle5" type="text" class="table_data" id="menu_pageTitle5" value="<?php echo $row_RecMenu['menu_pageTitle5']; ?>" size="50"></td>
        	    	<td bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
			</table>
            </td>
		</tr>
        <tr>
        	<td>&nbsp;</td>
        </tr>
         <tr>
         	<td align="center"><input name="submitBtn" type="submit" class="btnType" id="submitBtn" value="送出" /></td>
         </tr>
	</table>
    <input type="hidden" name="MM_update" value="form1" />
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
</body>
<!-- InstanceEnd --></html>
<?php
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	
  $updateSQL = sprintf("UPDATE menu SET menu_title=%s, menu_link=%s, menu_use=%s, menu_pageTitle1=%s, menu_pageTitle2=%s, menu_pageTitle3=%s, menu_pageTitle4=%s, menu_pageTitle5=%s WHERE menu_id=%s",
                       GetSQLValueString($_POST['menu_title'], "text"),
                       GetSQLValueString($_POST['menu_link'], "text"),
                       GetSQLValueString($_POST['menu_use'], "text"),
                       GetSQLValueString($_POST['menu_pageTitle1'], "text"),
                       GetSQLValueString($_POST['menu_pageTitle2'], "text"),
                       GetSQLValueString($_POST['menu_pageTitle3'], "text"),
                       GetSQLValueString($_POST['menu_pageTitle4'], "text"),
                       GetSQLValueString($_POST['menu_pageTitle5'], "text"),
                       GetSQLValueString($_POST['menu_id'], "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());

  $updateGoTo = "menu_list.php";
 /* if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    //$updateGoTo .= $_SERVER['QUERY_STRING']."&pageNum_RecMenu=".$_SESSION["ToPage"];
	$updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  
  //echo $updateGoTo;
  header(sprintf("Location: %s", $updateGoTo));
}
?>
<?php
mysql_free_result($RecMenu);
?>
