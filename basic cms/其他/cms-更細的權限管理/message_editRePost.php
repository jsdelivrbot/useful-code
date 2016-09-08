<?php
			if (!isset($_SESSION)) {
               session_start();
               }
            ob_start();
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


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


$colname_RecMessage = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecMessage = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecMessage = sprintf("SELECT * FROM data_set WHERE d_id = %s", GetSQLValueString($colname_RecMessage, "int"));
$RecMessage = mysql_query($query_RecMessage, $connect2data) or die(mysql_error());
$row_RecMessage = mysql_fetch_assoc($RecMessage);
$totalRows_RecMessage = mysql_num_rows($RecMessage);

$colname_RecMessageOnly = "-1";
if (isset($_GET['m_id'])) {
  $colname_RecMessageOnly = $_GET['m_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecMessageOnly = sprintf("SELECT * FROM message_set WHERE m_id = %s AND m_type='post' ORDER BY m_date DESC", GetSQLValueString($colname_RecMessageOnly, "int"));
$RecMessageOnly = mysql_query($query_RecMessageOnly, $connect2data) or die(mysql_error());
$row_RecMessageOnly = mysql_fetch_assoc($RecMessageOnly);
$totalRows_RecMessageOnly = mysql_num_rows($RecMessageOnly);

mysql_select_db($database_connect2data, $connect2data);
$query_RecMessageRePost = "SELECT * FROM message_set WHERE m_type = 'repost' AND m_rem_id='".$row_RecMessageOnly['m_id']."' ORDER BY m_date ASC";
$RecMessageRePost = mysql_query($query_RecMessageRePost, $connect2data) or die(mysql_error());
$row_RecMessageRePost = mysql_fetch_assoc($RecMessageRePost);
$totalRows_RecMessageRePost = mysql_num_rows($RecMessageRePost);

$menu_is="message";?>
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
	
	function call_alert(link_url) {
		
		alert("上傳得檔案中，有的不是圖片!");
		window.location=link_url;
		
	}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
<?php require_once('head.php');?>
<?php require_once('web_count.php');?>
</head>
<body onload="MM_preloadImages('image/submit_btn_over_01.png')">
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
            <td width="30%" class="list_title">回覆產品留言訊息</td>
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
            <table width="100%" border="0" cellpadding="5" cellspacing="3">
            	<tr>
            	  <td width="250" align="center" bgcolor="#e5ecf6" class="table_col_title">留言產品</td>
            	  <td class="table_data"><?php echo $row_RecMessage['d_title']; ?></td>
            	  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
          	  </tr>
            	<tr>
                	<td align="center" bgcolor="#e5ecf6" class="table_col_title">留言標題</td>
          	    	<td class="table_data"><?php echo $row_RecMessageOnly['m_title']; ?></td>
          	    	<td bgcolor="#e5ecf6">&nbsp;</td>
      	    	</tr>
            	<tr>
                	<td align="center" bgcolor="#e5ecf6" class="table_col_title">留言內容</td>
          	    	<td class="table_data" style="word-break:break-all"><?php echo $row_RecMessageOnly['m_content']; ?></td>
          	    	<td bgcolor="#e5ecf6">&nbsp;</td>
      	    	</tr>
                <tr>
                	<td align="center" bgcolor="#e5ecf6" class="table_col_title">留言暱稱</td>
          	    	<td class="table_data"><?php echo $row_RecMessageOnly['m_name']; ?></td>
          	    	<td bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
                <tr>
                	<td align="center" bgcolor="#e5ecf6" class="table_col_title">留言時間</td>
                	<td class="table_data"><?php echo $row_RecMessageOnly['m_date']; ?></td>
                	<td bgcolor="#e5ecf6" class="table_col_title">&nbsp;</td>
      		    </tr>
                <tr>
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title">&nbsp;</td>
                  <td>&nbsp;</td>
                  <td bgcolor="#e5ecf6" class="table_col_title">&nbsp;</td>
                </tr>
                <tr>
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title">回覆內容</td>
                  <td><span class="cart">
                    <textarea name="m_content" cols="100" rows="20" class="table_data" id="m_content"><?php echo $row_RecMessageRePost['m_content']; ?></textarea>
                  </span></td>
                  <td bgcolor="#e5ecf6" class="table_col_title">&nbsp;</td>
                </tr>
                <tr>
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title">回覆人名稱</td>
                  <td><span class="cart">
                    <input name="m_name" type="text" class="table_data" id="m_name" value="<?php echo $row_RecMessageRePost['m_name']; ?>" size="50" />
                  </span></td>
                  <td bgcolor="#e5ecf6" class="table_col_title">&nbsp;</td>
                </tr>
			</table>
            </td>
		</tr>
        <tr>
        	<td>&nbsp;</td>
        </tr>
         <tr>
         	<td align="center"><input name="m_id" type="hidden" id="m_id" value="<?php echo $row_RecMessageOnly['m_id']; ?>" />
         	<input name="d_id" type="hidden" id="d_id" value="<?php echo $row_RecMessage['d_id']; ?>" />
              <input name="m_date" type="hidden" id="m_date" value="<?php echo date("Y-m-d H:i:s");?>" />
              <button type=submit class="no_board"><img src="image/submit_btn_01.png" name="submit_pic" class="no_board" id="submit_pic" onmouseover="MM_swapImage('submit_pic','','image/submit_btn_over_01.png',1)" onmouseout="MM_swapImgRestore()"></button></td>
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
  $updateSQL = sprintf("UPDATE message_set SET m_d_id=%s, m_title=%s, m_content=%s, m_date=%s, m_name=%s WHERE m_rem_id=%s",
                       GetSQLValueString($_POST['d_id'], "int"),
                       GetSQLValueString($_POST['m_title'], "text"),
                       GetSQLValueString($_POST['m_content'], "text"),
                       GetSQLValueString($_POST['m_date'], "date"),
                       GetSQLValueString($_POST['m_name'], "text"),
                       GetSQLValueString($_POST['m_id'], "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());

 $updateGoTo = "message_show.php?d_id=" . $row_RecMessageOnly['m_d_id'] . "";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING']."&pageNum_RecMessage=".$_SESSION["ToPage"];
  }
  header(sprintf("Location: %s", $updateGoTo));
 
}
?>
<?php
 mysql_free_result($RecMessage);

mysql_free_result($RecMessageOnly);
?>
