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
$query_RecMessage = sprintf("SELECT * FROM data_set WHERE d_id = %s AND d_class1 = 'message'", GetSQLValueString($colname_RecMessage, "int"));
$RecMessage = mysql_query($query_RecMessage, $connect2data) or die(mysql_error());
$row_RecMessage = mysql_fetch_assoc($RecMessage);
$totalRows_RecMessage = mysql_num_rows($RecMessage);

$colname_RecMessageOnly = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecMessageOnly = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecMessageOnly = sprintf("SELECT * FROM message_set WHERE m_d_id = %s AND m_type='post' ORDER BY m_date DESC", GetSQLValueString($colname_RecMessageOnly, "int"));
$RecMessageOnly = mysql_query($query_RecMessageOnly, $connect2data) or die(mysql_error());
$row_RecMessageOnly = mysql_fetch_assoc($RecMessageOnly);
$totalRows_RecMessageOnly = mysql_num_rows($RecMessageOnly);

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

$(document).ready(function() {
	$(".delBtn").click(function() {
		if(confirm("您確定要刪除該筆"+$(this).attr('alt')+"嗎？")){
			window.location = $(this).attr('data-rel');
		}
	});
});

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
            <td width="30%" class="list_title">產品留言訊息</td>
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
        <td><table width="100%" border="0" cellpadding="5" cellspacing="3">
            <tr>
              <td width="250" align="center" bgcolor="#e5ecf6" class="table_col_title">留言產品</td>
              <td class="table_data"><?php echo $row_RecMessage['d_title']; ?></td>
              <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
            </tr>
            <tr>
              <td align="center" bgcolor="#e5ecf6" class="table_col_title">更新時間</td>
              <td class="table_data"><?php echo $row_RecMessage['d_date']; ?></td>
              <td bgcolor="#e5ecf6" class="table_col_title">&nbsp;</td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
      </tr>
      <tr>
        <td align="center">
        <?php if ($totalRows_RecMessageOnly > 0) { // Show if recordset not empty ?>
                <?php do { ?>
                
<?php
mysql_select_db($database_connect2data, $connect2data);
$query_RecMessageRePost = "SELECT * FROM message_set WHERE m_type = 'repost' AND m_rem_id='".$row_RecMessageOnly['m_id']."' ORDER BY m_date ASC";
$RecMessageRePost = mysql_query($query_RecMessageRePost, $connect2data) or die(mysql_error());
$row_RecMessageRePost = mysql_fetch_assoc($RecMessageRePost);
$totalRows_RecMessageRePost = mysql_num_rows($RecMessageRePost);
?>
                
                <form method="get" enctype="multipart/form-data" name="form1" id="form1">
                 <table width="100%" border="0" cellpadding="5" cellspacing="3">

                    
                   
                    <tr>
                      <td width="250" align="center" bgcolor="#EBEBD6" class="table_col_title">留言標題</td>
                      <td align="left" class="table_data" style="word-break:break-all"><?php echo $row_RecMessageOnly['m_title']; ?></td>
                      <td width="250" bgcolor="#EBEBD6">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="center" bgcolor="#EBEBD6" class="table_col_title">留言內容</td>
                      <td align="left" class="table_data" style="word-break:break-all"><?php echo $row_RecMessageOnly['m_content']; ?></td>
                      <td bgcolor="#EBEBD6">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="center" bgcolor="#EBEBD6" class="table_col_title">留言暱稱</td>
                      <td align="left" class="table_data" style="word-break:break-all"><label><?php echo $row_RecMessageOnly['m_name']; ?></label></td>
                      <td bgcolor="#EBEBD6">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="center" bgcolor="#EBEBD6" class="table_col_title">留言時間</td>
                      <td align="left" class="table_data" style="word-break:break-all"><?php echo $row_RecMessageOnly['m_date']; ?></td>
                      <td bgcolor="#EBEBD6">&nbsp;</td>
                    </tr>
                  </table>
                  
                  <?php if ($totalRows_RecMessageRePost > 0) { // Show if recordset not empty ?>
                <?php do { ?>
                  <table width="100%" border="0" cellpadding="5" cellspacing="3">
                    <tr>
                      <td width="250" align="center" bgcolor="#FFEFDF" class="table_col_title">回覆內容</td>
                      <td align="left" class="table_data" style="word-break:break-all"><?php echo $row_RecMessageRePost['m_content']; ?></td>
                      <td width="250" bgcolor="#FFEFDF">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="center" bgcolor="#FFEFDF" class="table_col_title">回覆人名稱</td>
                      <td align="left" class="table_data" style="word-break:break-all"><label><?php echo $row_RecMessageRePost['m_name']; ?></label></td>
                      <td bgcolor="#FFEFDF">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="center" bgcolor="#FFEFDF" class="table_col_title">回覆時間</td>
                      <td align="left" class="table_data" style="word-break:break-all"><?php echo $row_RecMessageRePost['m_date']; ?></td>
                      <td bgcolor="#FFEFDF">&nbsp;</td>
                    </tr>
                  </table>
                  <?php } while ($row_RecMessageRePost = mysql_fetch_assoc($RecMessageRePost)); ?>
                  <?php } // Show if recordset not empty ?>
                  
                        
                        <input name="delsure" type="hidden" id="delsure" value="1" />
                        <input name="d_id" type="hidden" id="d_id" value="<?php echo $row_RecMessage['d_id']; ?>" />
                        <input name="m_id" type="hidden" id="m_id" value="<?php echo $row_RecMessageOnly['m_id']; ?>" />
                        
                        
                        
                        <?php if ($totalRows_RecMessageRePost == 0) { // Show if recordset empty ?>
                        
                  <span class="no_data">您尚未回覆留言</span>
                        
                        <input name="repostBtn<?php echo $row_RecMessageOnly['m_id']; ?>" type="button" class="button_set" id="repostBtn<?php echo $row_RecMessageOnly['m_id']; ?>" value="回覆留言" onclick="window.location='message_editRe.php?m_id=<?php echo $row_RecMessageOnly['m_id']; ?>&d_id=<?php echo $row_RecMessage['d_id']; ?>'" title="回覆留言" />
                  <?php } // Show if recordset empty ?>
                  
                  <input name="delBtn<?php echo $row_RecMessageOnly['m_id']; ?>" type="button" class="delBtn button_set" id="delBtn<?php echo $row_RecMessageOnly['m_id']; ?>" value="刪除留言" data-rel="message_show.php?m_id=<?php echo $row_RecMessageOnly['m_id']; ?>&d_id=<?php echo $row_RecMessage['d_id']; ?>&delsure=1&delT=post" title="刪除留言" alt="留言與回覆" />
                  
                  <?php if ($totalRows_RecMessageRePost > 0) { // Show if recordset not empty ?>
                  
                  <input name="editRepostBtn<?php echo $row_RecMessageOnly['m_id']; ?>" type="button" class="button_set" id="editRepostBtn<?php echo $row_RecMessageOnly['m_id']; ?>" value="修改回覆" onclick="window.location='message_editRePost.php?m_id=<?php echo $row_RecMessageOnly['m_id']; ?>&d_id=<?php echo $row_RecMessage['d_id']; ?>'" title="修改回覆" />
                  
                        <span class="table_data" style="word-break:break-all"><span class="table_data" style="word-break:break-all">
                        <input name="delReBtn<?php echo $row_RecMessageOnly['m_id']; ?>" type="button" class="delBtn button_set" id="delReBtn<?php echo $row_RecMessageOnly['m_id']; ?>" value="刪除回覆" data-rel="message_show.php?m_id=<?php echo $row_RecMessageOnly['m_id']; ?>&d_id=<?php echo $row_RecMessage['d_id']; ?>&delsure=1&delT=repost" title="刪除回覆" alt="回覆" />
                        </span></span>
                  <?php } // Show if recordset not empty ?>
                  
                  
                
                        
                  
                 </form>
                  <?php } while ($row_RecMessageOnly = mysql_fetch_assoc($RecMessageOnly)); ?>
                  <?php } // Show if recordset not empty ?>
                  </td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
      </tr>
      <tr>
        <td align="center">
        <?php if ($totalRows_RecMessageOnly > 0) { // Show if recordset not empty ?>
                <input name="backList" type="button" class="button_set" id="backList" value="回列表" onclick="window.location='message_list.php?pageNum_RecMessage=<?php echo $_SESSION["ToPage"] ?>'"/>
                <?php } // Show if recordset not empty ?>
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
<?php 
if ((isset($_GET['m_id'])) && ($_GET['m_id'] != "") && (isset($_GET['delsure']))) {
	
	if(isset($_GET['delT'])&&$_GET['delT']=='repost'){
		
		$deleteSQL = sprintf("DELETE FROM message_set WHERE m_type = 'repost' AND m_rem_id=%s",
                       GetSQLValueString($_GET['m_id'], "text"));

		  mysql_select_db($database_connect2data, $connect2data);
		  $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());
		  
	}if(isset($_GET['delT'])&&$_GET['delT']=='post'){
		
		$deleteSQL = sprintf("DELETE FROM message_set WHERE m_type = 'repost' AND m_rem_id=%s",
                       GetSQLValueString($_GET['m_id'], "text"));

		  mysql_select_db($database_connect2data, $connect2data);
		  $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());
		  
		
		
		$deleteSQL = sprintf("DELETE FROM message_set WHERE m_type = 'post' AND m_id=%s",
                       GetSQLValueString($_GET['m_id'], "text"));

		  mysql_select_db($database_connect2data, $connect2data);
		  $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());
		  
		  $colname_RecMessageOnly = "-1";
		if (isset($_GET['d_id'])) {
		  $colname_RecMessageOnly = $_GET['d_id'];
		}
		mysql_select_db($database_connect2data, $connect2data);
		$query_RecMessageOnly = sprintf("SELECT Count(m_d_id) AS num_re FROM message_set WHERE m_d_id = %s AND m_type='post' ORDER BY m_date DESC", GetSQLValueString($colname_RecMessageOnly, "int"));
		$RecMessageOnly = mysql_query($query_RecMessageOnly, $connect2data) or die(mysql_error());
		$row_RecMessageOnly = mysql_fetch_assoc($RecMessageOnly);
		$totalRows_RecMessageOnly = mysql_num_rows($RecMessageOnly);
		
		if(isset($row_RecMessageOnly['num_re'])&&$row_RecMessageOnly['num_re']>1){
			$updateSQL = sprintf("UPDATE data_set SET d_price1=%s WHERE d_id=%s AND d_class1='message'",
                       GetSQLValueString($row_RecMessageOnly['num_re'], "int"),
                       GetSQLValueString($_GET['d_id'], "text"));

		  mysql_select_db($database_connect2data, $connect2data);
		  $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
		  $deleteGoTo = "message_show.php?d_id=" . $_GET['d_id'];
		  
		}else{
			
			$deleteSQL = sprintf("DELETE FROM data_set WHERE d_id=%s AND d_class1='message'",
						   GetSQLValueString($_REQUEST['d_id'], "int"));
	
			  mysql_select_db($database_connect2data, $connect2data);
			  $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());
			 
			  $deleteSQL = sprintf("DELETE FROM message_set WHERE m_d_id=%s",
								   GetSQLValueString($_REQUEST['d_id'], "int"));
			
			  mysql_select_db($database_connect2data, $connect2data);
			  $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());	
			  
			  $deleteGoTo = "message_list.php";
		}
				
		
	}
	
  
  
  
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING']."&pageNum_RecMessage=".$_SESSION["ToPage"];
  }*/
  header(sprintf("Location: %s", $deleteGoTo));
}
?>

<?php
 mysql_free_result($RecMessage);

mysql_free_result($RecMessageOnly);

mysql_free_result($RecMessageRePost);
?>
