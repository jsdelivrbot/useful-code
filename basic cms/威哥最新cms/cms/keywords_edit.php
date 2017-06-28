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

if(!in_array(5,$_SESSION['MM_Limit']['a11'])){
	header("Location: keywords_list.php");
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$colname_RecKeywords = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecKeywords = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecKeywords = sprintf("SELECT * FROM data_set WHERE d_id = %s", GetSQLValueString($colname_RecKeywords, "int"));
$RecKeywords = mysql_query($query_RecKeywords, $connect2data) or die(mysql_error());
$row_RecKeywords = mysql_fetch_assoc($RecKeywords);
$totalRows_RecKeywords = mysql_num_rows($RecKeywords);

if($totalRows_RecKeywords==0){
  header("Location: keywords_list.php");
}

$menu_is="years";

//記錄帶資料去別地方的資訊
$_SESSION['nowPage']=$selfPage;
$_SESSION['nowMenu']= "keywords";
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

<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
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
            <td width="30%" class="list_title">修改關鍵字與描述</td>
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
          	    	<td class="table_data"><?php echo $row_RecKeywords['d_title']; ?>
          	    	  <input name="d_id" type="hidden" id="d_id" value="<?php echo $row_RecKeywords['d_id']; ?>" />
                    </td>
        	    	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	    	</tr>

            	<tr>
            	  <td align="center" bgcolor="#e5ecf6" class="table_col_title">關鍵字</td>
            	  <td><textarea name="d_content" cols="100" rows="20" class="table_data" id="d_content"><?php echo $row_RecKeywords['d_content']; ?></textarea></td>
            	  <td bgcolor="#e5ecf6"><span class="note_letter"></span></td>
          	  </tr>

              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">描述</td>
                <td><textarea name="d_class2" cols="100" rows="20" class="table_data" id="d_class2"><?php echo $row_RecKeywords['d_class2']; ?></textarea></td>
                <td bgcolor="#e5ecf6"><span class="note_letter"></span></td>
              </tr>

                <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">日期</td>
          	    	<td><input name="d_date" type="text" class="table_data" id="d_date" value="<?php echo ( ($row_RecKeywords['d_date']=='') || (!(strcmp("0000-00-00 00:00:00", $row_RecKeywords['d_date']))) ) ? date("Y-m-d H:i:s") : $row_RecKeywords['d_date']; ?>" size="50"></td>
        	    	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>

                <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">在網頁顯示</td>
          	    	<td><label>
          	        <select name="d_active" class="table_data" id="d_active">
          	          <option value="1" <?php if (!(strcmp(1, $row_RecKeywords['d_active']))) {echo "selected=\"selected\"";} ?>>顯示</option><option value="0" <?php if (!(strcmp(0, $row_RecKeywords['d_active']))) {echo "selected=\"selected\"";} ?>>不顯示</option>
       	            </select></label></td>
          	     	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>

                
			</table>
            </td>
		</tr>
        <tr>
        	<td>&nbsp;</td>
        </tr>
         <tr>
         	<td align="center">
            <input name="submitBtn" type="submit" class="btnType" id="submitBtn" value="送出" />
            <a href="#" class="btnType finishBtn" style="display: none;">完成</a>
            <a href="#" class="btnType pubBtn" style="display: none;" target="_blank">預覽</a>
          </td>
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

<?php
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {

  $d_content = checkV('d_content');
  $d_class2  = checkV('d_class2');
  $d_date  = checkV('d_date');
  $d_active  = checkV('d_active');
  $d_id  = checkV('d_id');
  
  $updateSQL = sprintf("UPDATE data_set SET d_content=%s, d_class2=%s, d_date=%s, d_active=%s WHERE d_id=%s",
                       GetSQLValueString($d_content, "text"),
                       GetSQLValueString($d_class2, "text"),
                       GetSQLValueString($d_date, "date"),
                       GetSQLValueString($d_active, "int"),
                       GetSQLValueString($d_id, "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());

    

  $updateGoTo = "keywords_list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING']."&pageNum_RecKeywords=".$_SESSION["ToPage"];
  }
  
  
  if($image_result[0][0]==1)
  {
    echo "<script type='text/javascript'>call_alert('".$updateGoTo."');</script>";
  }else
  {
    /*echo "<script type='text/javascript'>";
    echo "$(document).ready(function() {";
    echo "alert('您已儲存完成！');";
    //echo "window.location.href='".$editFormAction."&f=finish';";
    echo "$('#submitBtn').hide();";
    echo "$('.finishBtn').attr('href', '".$updateGoTo."' );";
    echo "$('.pubBtn').attr('href', '../keywords.php');";
    echo "$('.finishBtn').show();";
    echo "$('.pubBtn').show();";
    echo "});";
    echo "</script>";*/
      header(sprintf("Location: %s", $updateGoTo));
  }
}
?>

</body>
<!-- InstanceEnd --></html>

<?php
mysql_free_result($RecKeywords);
?>
