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

if(!in_array(7,$_SESSION['MM_Limit']['a12'])){
	header("Location: environment3_list.php");
}

$colname_RecEnvironment3 = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecEnvironment3 = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecEnvironment3 = sprintf("SELECT * FROM data_set WHERE d_class1 = 'environment3' AND d_id = %s", GetSQLValueString($colname_RecEnvironment3, "int"));
$RecEnvironment3 = mysql_query($query_RecEnvironment3, $connect2data) or die(mysql_error());
$row_RecEnvironment3 = mysql_fetch_assoc($RecEnvironment3);
$totalRows = mysql_num_rows($RecEnvironment3);

if($totalRows==0){
  header("Location: environment3_list.php");
}

$colname_RecImage = "-1";
if (isset($row_RecEnvironment3['d_id'])) {
  $colname_RecImage = $row_RecEnvironment3['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecImage = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'image'" , GetSQLValueString($colname_RecImage, "int"));
$RecImage = mysql_query($query_RecImage, $connect2data) or die(mysql_error());
$row_RecImage = mysql_fetch_assoc($RecImage);
$totalRows_RecImage = mysql_num_rows($RecImage);

$colname_RecImageCover = "-1";
if (isset($row_RecEnvironment3['d_id'])) {
  $colname_RecImageCover = $row_RecEnvironment3['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecImageCover = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'imageCover'", GetSQLValueString($colname_RecImageCover, "int"));
$RecImageCover = mysql_query($query_RecImageCover, $connect2data) or die(mysql_error());
$row_RecImageCover = mysql_fetch_assoc($RecImageCover);
$totalRows_RecImageCover = mysql_num_rows($RecImageCover);

$colname_RecFile = "-1";
if (isset($row_RecEnvironment3['d_id'])) {
  $colname_RecFile = $row_RecEnvironment3['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecFile = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'file'", GetSQLValueString($colname_RecFile, "int"));
$RecFile = mysql_query($query_RecFile, $connect2data) or die(mysql_error());
$row_RecFile = mysql_fetch_assoc($RecFile);
$totalRows_RecFile = mysql_num_rows($RecFile);

 $menu_is = "environment";?>
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
            <td width="30%" class="list_title">刪除寬敞、舒適、安全、衛生</td>
            <td width="70%"><span class="no_data">您確定要刪除這筆資料?</span></td>
        </tr>
	</table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td><img src="image/spacer.gif" width="1" height="1"></td>
        </tr>
    </table>
    <form action="" method="POST" enctype="multipart/form-data" name="form1" id="form1">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  		<tr>
   			<td>
            <table width="100%" border="0" cellspacing="3" cellpadding="5">

            	<tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">標題</td>
          	    	<td class="table_data"><?php echo $row_RecEnvironment3['d_title']; ?>
          	    	  <input name="d_id" type="hidden" id="d_id" value="<?php echo $row_RecEnvironment3['d_id']; ?>" />
          	    	  <input name="delsure" type="hidden" id="delsure" value="1" /></td>
        	    	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	    	</tr>

              <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">列表描述</td>
                  <td class="table_data">
                    <?php echo nl2br($row_RecEnvironment3['d_data1']); ?>
                  </td>
                <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
              </tr>

              <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">內文</td>
                  <td class="table_data"><?php echo nl2br($row_RecEnvironment3['d_content']); ?>
                    </td>
                <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
              </tr>

                <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">日期</td>
          	    	<td class="table_data"><?php echo $row_RecEnvironment3['d_date']; ?></td>
        	    	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>

                <?php if ($totalRows_RecImageCover > 0) { // Show if recordset not empty ?>
                <tr>
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title">目前封面圖片</td>
                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><?php do { ?>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="100" rowspan="2" align="center"><img src="../<?php echo $row_RecImageCover['file_link2']; ?>" alt="" class="image_frame" /></td>
                                  <td align="left" class="table_data">
                                  <div class="ml">
                                &nbsp;圖片說明：
                                 <?php echo $row_RecImageCover['file_title']; ?>
                                 <div>
                                 <span class="coverFormat">&nbsp;封面樣式：</span><?php 
                                  if($row_RecImageCover['file_show_type']==1){
                                    echo '<div class="iconGroup table_data"><div class="icon_select icon_select1"></div><div class="icon_title">1Wx1H</div></div>';
                                  }elseif($row_RecImageCover['file_show_type']==2){
                                    echo '<div class="iconGroup table_data"><div class="icon_select icon_select2"></div><div class="icon_title">2Wx1H</div></div>';
                                  }elseif($row_RecImageCover['file_show_type']==3){
                                    echo '<div class="iconGroup table_data"><div class="icon_select icon_select3"></div><div class="icon_title">3Wx1H</div></div>';
                                  }elseif($row_RecImageCover['file_show_type']==4){
                                    echo '<div class="iconGroup table_data"><div class="icon_select icon_select4"></div><div class="icon_title">1Wx2H</div></div>';
                                  }elseif($row_RecImageCover['file_show_type']==5){
                                    echo '<div class="iconGroup table_data"><div class="icon_select icon_select5"></div><div class="icon_title">2Wx2H</div></div>';
                                  }elseif($row_RecImageCover['file_show_type']==6){
                                    echo '<div class="iconGroup table_data"><div class="icon_select icon_select6"></div><div class="icon_title">3Wx2H</div></div>';
                                  }
                                  ?>
                                 </div>
                               </div>
                                    
                                  </td>
                            </tr>
                        <tr>
                          <td align="left" class="table_data">&nbsp;</td>
                            </tr>
                        <tr>
                          <td align="center">&nbsp;</td>
                                          <td align="center">&nbsp;</td>
                              </tr>
                      </table>
                      <?php } while ($row_RecImageCover = mysql_fetch_assoc($RecImageCover)); ?></td>
                    </tr>
                  </table></td>
                  <td bgcolor="#e5ecf6" class="table_col_title"><p>&nbsp;</p></td>
                </tr>
               <?php } // Show if recordset not empty ?>

                <?php if ($totalRows_RecImage > 0) { // Show if recordset not empty ?>
                <tr>
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title">目前圖片</td>
                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><?php do { ?>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="100" rowspan="2" align="center"><img src="../<?php echo $row_RecImage['file_link2']; ?>" alt="" class="image_frame" /></td>
                                  <td align="left" class="table_data">&nbsp;圖片說明：<?php echo $row_RecImage['file_title']; ?></td>
                            </tr>
                        <tr>
                          <td align="left" class="table_data">&nbsp;</td>
                            </tr>
                        <tr>
                          <td align="center">&nbsp;</td>
                                          <td align="center">&nbsp;</td>
                              </tr>
                      </table>
                      <?php } while ($row_RecImage = mysql_fetch_assoc($RecImage)); ?></td>
                    </tr>
                  </table></td>
                  <td bgcolor="#e5ecf6" class="table_col_title"><p>&nbsp;</p></td>
                </tr>
               <?php } // Show if recordset not empty ?>

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
	if ((isset($_REQUEST['d_id'])) && ($_REQUEST['d_id'] != "") && (isset($_REQUEST['delsure']))) {
	
		//----------刪除圖片資料到資料庫begin(在主資料前)-----

    $sql="SELECT file_link1, file_link2, file_link3, file_link4, file_link5, file_link6 FROM file_set WHERE file_type='image' AND file_d_id='".$_POST['d_id']."'";

    $result = mysql_query($sql)or die("無法送出".mysql_error( ));
    while ( $row = mysql_fetch_assoc($result))
    {
      foreach ($row as $key => $value) {
        if ( (isset($value)) && file_exists("../".$value) ) {
          //echo "$value<br />\n";
          unlink("../".$value);//刪除檔案
        }
      }
    }
		
	  $deleteSQL = sprintf("DELETE FROM file_set WHERE file_type='image' AND file_d_id=%s",
						   GetSQLValueString($_REQUEST['d_id'], "int"));
	
	  mysql_select_db($database_connect2data, $connect2data);
	  $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());
	  
	  //----------刪除圖片資料到資料庫end(在主資料前)-----

    //----------刪除封面圖片資料到資料庫begin(在主資料前)-----

    $sql="SELECT file_link1, file_link2, file_link3, file_link4, file_link5, file_link6 FROM file_set WHERE file_type='imageCover' AND file_d_id='".$_POST['d_id']."'";

    $result = mysql_query($sql)or die("無法送出".mysql_error( ));
    while ( $row = mysql_fetch_assoc($result))
    {
      foreach ($row as $key => $value) {
        if ( (isset($value)) && file_exists("../".$value) ) {
          //echo "$value<br />\n";
          unlink("../".$value);//刪除檔案
        }
      }
    }
    
    $deleteSQL = sprintf("DELETE FROM file_set WHERE file_type='imageCover' AND file_d_id=%s",
               GetSQLValueString($_REQUEST['d_id'], "int"));
  
    mysql_select_db($database_connect2data, $connect2data);
    $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());
    
    //----------刪除封面圖片資料到資料庫end(在主資料前)-----

	  //----------刪除檔案資料到資料庫begin(在主資料前)-----	   
	    $sql="SELECT file_link1 FROM file_set WHERE file_type='file' AND file_d_id='".$_POST['d_id']."'";
		$result = mysql_query($sql)or die("無法送出".mysql_error( ));
		while ( $row = mysql_fetch_array($result))
		{
			unlink("../".$row[0]);
		}
		
	   	$deleteSQL = sprintf("DELETE FROM file_set WHERE file_type='file' AND file_d_id=%s",
						   GetSQLValueString($_REQUEST['d_id'], "int"));
	
	    mysql_select_db($database_connect2data, $connect2data);
	    $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());
	  
	  //echo $_REQUEST['d_id'];
	  //----------刪除檔案資料到資料庫begin(在主資料前)
	  $deleteSQL = sprintf("DELETE FROM data_set WHERE d_id=%s",
						   GetSQLValueString($_REQUEST['d_id'], "int"));
	
	  mysql_select_db($database_connect2data, $connect2data);
	  $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());
	 
	  $deleteGoTo = "environment3_list.php?delchangeSort=1";
	  if (isset($_SERVER['QUERY_STRING'])) {
		$deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
		$deleteGoTo .= $_SERVER['QUERY_STRING']."&pageNum=".$_SESSION["ToPage"];
	  }
	  header(sprintf("Location: %s", $deleteGoTo));
	}
?>
<?php
mysql_free_result($RecEnvironment3);

mysql_free_result($RecImage);
?>
