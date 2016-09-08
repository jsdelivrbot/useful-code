<?php require_once('../sstart.php'); ?>
<?php require_once('../Connections/connect2data.php'); ?>
<?php require_once('photo_process_products.php'); ?>
<?php  $menu_is="products";?>
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



$colname_RecImage = "-1";
if (isset($_GET['file_id'])) {
  $colname_RecImage = $_GET['file_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecImage = sprintf("SELECT * FROM file_set WHERE file_id = %s", GetSQLValueString($colname_RecImage, "int"));
$RecImage = mysql_query($query_RecImage, $connect2data) or die(mysql_error());
$row_RecImage = mysql_fetch_assoc($RecImage);
$totalRows_RecImage = mysql_num_rows($RecImage);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
            <td width="30%" class="list_title">修改圖片</td>
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
                	<td width="129" align="center" bgcolor="#e5ecf6" class="table_col_title">圖片說明</td>
          	    	<td width="440"><input name="file_title" type="text" class="table_data" id="file_title" value="<?php echo $row_RecImage['file_title']; ?>" size="50">
          	    	  <input name="file_id" type="hidden" id="file_id" value="<?php echo $row_RecImage['file_id']; ?>" /></td>
        	    	<td width="189" bgcolor="#e5ecf6">&nbsp;</td>
      	    	</tr>
     	      	<tr>
                	<td align="center" bgcolor="#e5ecf6" class="table_col_title">目前圖片</td>
                	<td><img src="<?php echo "../".$row_RecImage['file_link2']; ?>" alt="" class="image_frame" /></td>
                	<td bgcolor="#e5ecf6" class="table_col_title"><p>&nbsp;</p></td>
      		    </tr>
                <tr>
              		<td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>更換圖片</p>
              	    </td>
              	    <td><input name="image[]" type="file" class="table_data" id="image[]" size="50" ></td>
              	    <td bgcolor="#e5ecf6" class="table_col_title"><p><span class="red_letter">*橫式圖片請上傳寬189 pixel，高335 pixel 72dpi
                   	    之圖檔。<br />
*直式圖片請上傳寬312 pixel，高227 pixel 72dpi
                   	    之圖檔。</span></p>
           	        </td>
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
  $updateSQL = sprintf("UPDATE file_set SET file_title=%s WHERE file_id=%s",
                       GetSQLValueString($_POST['file_title'], "text"),
                       GetSQLValueString($_POST['file_id'], "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
  
      //----------插入圖片資料到資料庫begin(須放入插入主資料後)----------
   			//echo image_process();
		
		
	//$image_result=image_process("products","edit", "600", "480");
	$image_result=image_process($_FILES['image'], $_REQUEST['file_title'], "products","edit", "312", "335");
		//echo count($image_result);
		//echo $image_result[0][0];
		
		//刪除圖片真實檔案begin----
		if(count($image_result)==2)
		{
					$sql="SELECT file_link1 FROM file_set WHERE file_id='".$_POST['file_id']."'";
					$result = mysql_query($sql)or die("無法送出".mysql_error( ));
					while ( $row = mysql_fetch_array($result))
					{
						//echo $image_result[1][1]."<br>";
						//echo $row[0]."<BR>";
						if($image_result[1][1]==$row[0])
						{}
						else
						{
							unlink("../".$row[0]);//刪除檔案
						}
					}
					
					$sql="SELECT file_link2 FROM file_set WHERE file_id='".$_POST['file_id']."'";
					$result = mysql_query($sql)or die("無法送出".mysql_error( ));
					while ( $row = mysql_fetch_array($result))
					{
						//echo $image_result[1][2]."<br>";
						//echo $row[0]."<BR>";
						if($image_result[1][2]==$row[0])
						{}
						else
						{
							unlink("../".$row[0]);//刪除檔案
						}	
					}
					
					/*$sql="SELECT file_link3 FROM file_set WHERE file_id='".$_POST['file_id']."'";
					$result = mysql_query($sql)or die("無法送出".mysql_error( ));
					while ( $row = mysql_fetch_array($result))
					{
						//echo $image_result[1][3]."<br>";
						//echo $row[0]."<BR>";
						if($image_result[1][3]==$row[0])
						{}
						else
						{
							unlink("../".$row[0]);//刪除檔案
						}	
					}*/
										
		} 
		//刪除圖片真實檔案end----
		
		for($j=1;$j<count($image_result);$j++)
		{
			  $insertSQL = sprintf("UPDATE file_set SET file_name=%s, file_link1=%s, file_link2=%s, file_link3=%s, file_show_type=%s WHERE file_id=%s" ,
                       GetSQLValueString($image_result[$j][0], "text"),
                       GetSQLValueString($image_result[$j][1], "text"),
                       GetSQLValueString($image_result[$j][2], "text"),
                       GetSQLValueString($image_result[$j][3], "text"),
                       GetSQLValueString($image_result[$j][4], "int"),
					   GetSQLValueString($_POST['file_id'], "int"));

  			  mysql_select_db($database_connect2data, $connect2data);
  			  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
			  
			  $_SESSION["change_image"]=1;
		}
		
	
	
	//----------插入圖片資料到資料庫end----------

  $updateGoTo = "products_edit.php?d_id=" . $row_RecImage['file_d_id'] . "";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  $updateGoTo .= '#imageEdit';
  
  //echo $row_RecImage['d_id'];
  
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
mysql_free_result($RecImage);
?>
