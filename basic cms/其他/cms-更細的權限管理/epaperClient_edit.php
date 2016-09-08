<?php
			if (!isset($_SESSION)) {
               session_start();
               }
            ob_start();
?>
<?php require_once('../Connections/connect2data.php'); ?>
<?php require_once('photo_process.php'); ?>
<?php require_once('file_process.php'); ?>
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

$colname_RecEpaper_client = "-1";
if (isset($_GET['a_id'])) {
  $colname_RecEpaper_client = $_GET['a_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecEpaper_client = sprintf("SELECT * FROM address_book_set WHERE a_id = %s", GetSQLValueString($colname_RecEpaper_client, "int"));
$RecEpaper_client = mysql_query($query_RecEpaper_client, $connect2data) or die(mysql_error());
$row_RecEpaper_client = mysql_fetch_assoc($RecEpaper_client);
$totalRows_RecEpaper_client = mysql_num_rows($RecEpaper_client);

$colname_RecImage = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecImage = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecImage = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'image'", GetSQLValueString($colname_RecImage, "int"));
$RecImage = mysql_query($query_RecImage, $connect2data) or die(mysql_error());
$row_RecImage = mysql_fetch_assoc($RecImage);
$totalRows_RecImage = mysql_num_rows($RecImage);

$colname_RecFile = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecFile = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecFile = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'file'", GetSQLValueString($colname_RecFile, "int"));
$RecFile = mysql_query($query_RecFile, $connect2data) or die(mysql_error());
$row_RecFile = mysql_fetch_assoc($RecFile);
$totalRows_RecFile = mysql_num_rows($RecFile);

$menu_is="epaper";?>

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
		<?php
			if($_SESSION["change_image"]==1)
			{
				$_SESSION["change_image"]=0;
				echo "window.location.reload();";
			}
		?>
		
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
			if(myField.value){
				var aTr=pTable.insertRow(lastRow);
				var newRow = lastRow+1;
				var newImg='img'+(newRow);
				var aTd1=aTr.insertCell(0);
				aTd1.innerHTML = '<span class="table_data">選擇圖片： </span><input name="image[]" type="file" class="table_data" id="image'+newRow+'"><br><span class="table_data">圖片說明： </span><input name="image_title[]" type="text" class="table_data" id="image_title'+newRow+'">';
			}else{
				alert("尚有未選取之圖片欄位!!");
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
//-->
</script>
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
            <td width="30%" class="list_title">修改電子報訂閱</td>
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
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">姓名</td>
            	  <td width="532"><input name="a_display_name" type="text" class="table_data" id="a_display_name" value="<?php echo $row_RecEpaper_client['a_display_name']; ?>" size="50" />
            	    <label>
            	    <input name="a_id" type="hidden" id="a_id" value="<?php echo $row_RecEpaper_client['a_id']; ?>" />
            	    </label></td>
            	  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
          	  </tr>
            	<tr>
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title">電子信箱</td>
            	  <td><input name="a_email" type="text" class="table_data" id="a_email" value="<?php echo $row_RecEpaper_client['a_email']; ?>" size="50" /></td>
            	  <td bgcolor="#e5ecf6" class="table_col_title">&nbsp;</td>
          	  </tr>
            	<tr>
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title">使用狀態</td>
            	  <td><label>
            	  <select name="a_status" class="table_data" id="a_status">
            	    <option value="1" <?php if (!(strcmp(1, $row_RecEpaper_client['a_status']))) {echo "selected=\"selected\"";} ?>>允許</option>
            	    <option value="0" <?php if (!(strcmp(0, $row_RecEpaper_client['a_status']))) {echo "selected=\"selected\"";} ?>>不允許</option>
                  </select>
            	  </label></td>
            	  <td bgcolor="#e5ecf6">&nbsp;</td>
          	  </tr>
            	<tr>
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title">訂閱狀態</td>
            	  <td><label>
            	  <select name="a_epaper" class="table_data" id="a_epaper">
            	    <option value="1" <?php if (!(strcmp(1, $row_RecEpaper_client['a_epaper']))) {echo "selected=\"selected\"";} ?>>訂閱中</option>
            	    <option value="0" <?php if (!(strcmp(0, $row_RecEpaper_client['a_epaper']))) {echo "selected=\"selected\"";} ?>>取消訂閱</option>
                  </select>
            	  </label></td>
            	  <td bgcolor="#e5ecf6">&nbsp;</td>
          	  </tr>
              <?php if(0){ ?>
            	<tr>
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title">電話</td>
            	  <td><label>
                    <input name="a_tel" type="text" class="table_data" id="a_tel" value="<?php echo $row_RecEpaper_client['a_tel']; ?>" size="50" />
                  </label></td>
            	  <td bgcolor="#e5ecf6" class="table_col_title"><p>&nbsp;</p></td>
          	  </tr>
            	<tr>
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title">住址</td>
            	  <td><input name="a_address" type="text" class="table_data" id="a_address" value="<?php echo $row_RecEpaper_client['a_address']; ?>" size="50" /></td>
            	  <td bgcolor="#e5ecf6" class="table_col_title">&nbsp;</td>
          	  </tr>
              <?php } ?>
              <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">日期</td>
          	    	<td width="532"><input name="a_date" type="text" class="table_data" id="a_date" value="<?php echo $row_RecEpaper_client['a_date']; ?>" size="50"></td>
        	    	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
			</table>
            </td>
		</tr>
        <tr>
        	<td>&nbsp;</td>
        </tr>
         <tr>
         	<td align="center"><button type=submit class="no_board"><img src="image/submit_btn_01.png" name="submit_pic" class="no_board" id="submit_pic" /></button></td>
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
  $updateSQL = sprintf("UPDATE address_book_set SET a_display_name=%s, a_tel=%s, a_address=%s, a_email=%s, a_status=%s, a_epaper=%s, a_date=%s WHERE a_id=%s",
                       GetSQLValueString($_POST['a_display_name'], "text"),
                       GetSQLValueString($_POST['a_tel'], "text"),
                       GetSQLValueString($_POST['a_address'], "text"),
                       GetSQLValueString($_POST['a_email'], "text"),
                       GetSQLValueString($_POST['a_status'], "int"),
                       GetSQLValueString($_POST['a_epaper'], "int"),
                       GetSQLValueString($_POST['a_date'], "date"),
                       GetSQLValueString($_POST['a_id'], "int"));
  echo $updateSQL ;
				

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());



  $updateGoTo = "epaperClient_list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING']."&pageNum_RecEpaper_client=".$_SESSION["ToPage"];
  }
  
  
  if($image_result[0][0]==1)
  {
		echo "<script type=\"text/javascript\">call_alert('".$updateGoTo."');</script>";
  }else
  {
  		header(sprintf("Location: %s", $updateGoTo));
  }
}
?>
<?php
mysql_free_result($RecEpaper_client);
mysql_free_result($RecImage);
mysql_free_result($RecFile);
?>
