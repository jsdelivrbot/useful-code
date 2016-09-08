<?php require_once('../sstart.php'); ?>
<?php $editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
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
            <td width="30%" class="list_title">新增主選單</td>
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
   			<td><table width="100%" border="0" cellspacing="3" cellpadding="5">
            	<tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">標題</td>
          	    	<td width="532"><input name="menu_title" type="text" class="table_data" id="menu_title" value="" size="50" /></td>
        	    	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	    	</tr>
            	<tr>
            	  <td align="center" bgcolor="#e5ecf6" class="table_col_title">連結</td>
            	  <td><input name="menu_link" type="text" class="table_data" id="menu_link" value="" size="50" /></td>
            	  <td bgcolor="#e5ecf6">&nbsp;</td>
          	  </tr>
                <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">ID</td>
          	    	<td width="532"><input name="menu_use" type="text" class="table_data" id="menu_use" size="50"></td>
        	    	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
                <tr>
                	<td align="center" bgcolor="#e5ecf6" class="table_col_title">pageTitle1</td>
          	    	<td><input name="menu_pageTitle1" type="text" class="table_data" id="menu_pageTitle1" size="50"></td>
        	    	<td bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
                <tr>
                	<td align="center" bgcolor="#e5ecf6" class="table_col_title">pageTitle2</td>
          	    	<td><input name="menu_pageTitle2" type="text" class="table_data" id="menu_pageTitle2" size="50"></td>
        	    	<td bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
                <tr>
                	<td align="center" bgcolor="#e5ecf6" class="table_col_title">pageTitle3</td>
          	    	<td><input name="menu_pageTitle3" type="text" class="table_data" id="menu_pageTitle3" size="50"></td>
        	    	<td bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
                <tr>
                	<td align="center" bgcolor="#e5ecf6" class="table_col_title">pageTitle4</td>
          	    	<td><input name="menu_pageTitle4" type="text" class="table_data" id="menu_pageTitle4" size="50"></td>
        	    	<td bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
                <tr>
                	<td align="center" bgcolor="#e5ecf6" class="table_col_title">pageTitle5</td>
          	    	<td><input name="menu_pageTitle5" type="text" class="table_data" id="menu_pageTitle5" size="50"></td>
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
</body>
<!-- InstanceEnd --></html>

<?php
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	
  $insertSQL = sprintf("INSERT INTO menu (menu_title, menu_link, menu_use, menu_pageTitle1, menu_pageTitle2, menu_pageTitle3, menu_pageTitle4, menu_pageTitle5) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['menu_title'], "text"),
                       GetSQLValueString($_POST['menu_link'], "text"),
                       GetSQLValueString($_POST['menu_use'], "text"),
                       GetSQLValueString($_POST['menu_pageTitle1'], "text"),
                       GetSQLValueString($_POST['menu_pageTitle2'], "text"),
                       GetSQLValueString($_POST['menu_pageTitle3'], "text"),
                       GetSQLValueString($_POST['menu_pageTitle4'], "text"),
                       GetSQLValueString($_POST['menu_pageTitle5'], "text"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
  	
  $insertGoTo = "menu_list.php?pageNum_RecMenu=0&totalRows_RecMenu=".($_SESSION['totalRows']+1)."&changeSort=1&now_d_id=".$new_data_num."&change_num=1";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  
  if($image_result[0][0]==1)
  {
  		echo "<script type=\"text/javascript\">call_alert('".$insertGoTo."');</script>";
  }else
  {
  		header(sprintf("Location: %s", $insertGoTo));
  }
  
}
?>

