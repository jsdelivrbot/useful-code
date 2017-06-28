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

if(!in_array(7,$_SESSION['MM_Limit']['a12'])){
	header("Location: epaper_list.php");
}

if ((isset($_REQUEST['d_id'])) && ($_REQUEST['d_id'] != "") && (isset($_REQUEST['delsure']))) {

	$d_id = $_REQUEST['d_id'];

	//----------刪除圖片資料到資料庫begin(在主資料前)-----

    $sql="SELECT file_link1, file_link2, file_link3, file_link4, file_link5, file_link6 FROM file_set WHERE (file_type='imageShort' OR file_type='imageLong') AND file_d_id='".$d_id."'";

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
    
    $deleteSQL = sprintf("DELETE FROM file_set WHERE (file_type='imageShort' OR file_type='imageLong') AND file_d_id=%s",
               GetSQLValueString($d_id, "int"));
  
    mysql_select_db($database_connect2data, $connect2data);
    $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());
    
    //----------刪除圖片資料到資料庫end(在主資料前)-----

    //索引
    $deleteSQL = sprintf("DELETE FROM tab_set WHERE tab_type='epaperReport' AND tab_d_id=%s",
               GetSQLValueString($d_id, "int"));  
    mysql_select_db($database_connect2data, $connect2data);
    $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());

    //三個版型
    $deleteSQL = sprintf("DELETE FROM tab_set WHERE (tab_type='epaperTemp1' OR tab_type='epaperTemp2' OR tab_type='epaperTemp3' OR tab_type='epaperTemp4') AND tab_d_id=%s",
               GetSQLValueString($d_id, "int"));  
    mysql_select_db($database_connect2data, $connect2data);
    $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());
    
    $deleteSQL = sprintf("DELETE FROM data_set WHERE d_id=%s",
               GetSQLValueString($d_id, "int"));  
    mysql_select_db($database_connect2data, $connect2data);
    $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());  

  $deleteGoTo = "epaper_list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
	$deleteGoTo .= $_SERVER['QUERY_STRING']."&pageNum_RecEpaper=".$_SESSION["ToPage"];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_RecEpaper = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecEpaper = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecEpaper = sprintf("SELECT * FROM data_set WHERE d_id = %s", GetSQLValueString($colname_RecEpaper, "int"));
$RecEpaper = mysql_query($query_RecEpaper, $connect2data) or die(mysql_error());
$row_RecEpaper = mysql_fetch_assoc($RecEpaper);
$totalRows_RecEpaper = mysql_num_rows($RecEpaper);

$colname_RecTabsReport = "-1";
if (isset($row_RecEpaper['d_id'])) {
  $colname_RecTabsReport = $row_RecEpaper['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecTabsReport = sprintf("SELECT * FROM tab_set WHERE tab_d_id = %s AND tab_type = 'epaperReport' ORDER BY tab_sort ASC, tab_id ASC", GetSQLValueString($colname_RecTabsReport, "int"));
$RecTabsReport = mysql_query($query_RecTabsReport, $connect2data) or die(mysql_error());
$row_RecTabsReport = mysql_fetch_assoc($RecTabsReport);
$totalRows_RecTabsReport = mysql_num_rows($RecTabsReport);



$colname_RecTabOther1 = "-1";
if (isset($row_RecEpaper['d_id'])) {
  $colname_RecTabOther1 = $row_RecEpaper['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecTabOther1 = sprintf("SELECT * FROM tab_set WHERE tab_d_id = %s AND tab_type = 'epaperTemp1' ORDER BY tab_sort ASC, tab_id ASC", GetSQLValueString($colname_RecTabOther1, "int"));
$RecTabOther1 = mysql_query($query_RecTabOther1, $connect2data) or die(mysql_error());
$row_RecTabOther1 = mysql_fetch_assoc($RecTabOther1);
$totalRows_RecTabOther1 = mysql_num_rows($RecTabOther1);

$colname_RecTabOther2 = "-1";
if (isset($row_RecEpaper['d_id'])) {
  $colname_RecTabOther2 = $row_RecEpaper['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecTabOther2 = sprintf("SELECT * FROM tab_set WHERE tab_d_id = %s AND tab_type = 'epaperTemp2' ORDER BY tab_sort ASC, tab_id ASC", GetSQLValueString($colname_RecTabOther2, "int"));
$RecTabOther2 = mysql_query($query_RecTabOther2, $connect2data) or die(mysql_error());
$row_RecTabOther2 = mysql_fetch_assoc($RecTabOther2);
$totalRows_RecTabOther2 = mysql_num_rows($RecTabOther2);

$colname_RecTabOther3 = "-1";
if (isset($row_RecEpaper['d_id'])) {
  $colname_RecTabOther3 = $row_RecEpaper['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecTabOther3 = sprintf("SELECT * FROM tab_set WHERE tab_d_id = %s AND tab_type = 'epaperTemp3' ORDER BY tab_sort ASC, tab_id ASC", GetSQLValueString($colname_RecTabOther3, "int"));
$RecTabOther3 = mysql_query($query_RecTabOther3, $connect2data) or die(mysql_error());
$row_RecTabOther3 = mysql_fetch_assoc($RecTabOther3);
$totalRows_RecTabOther3 = mysql_num_rows($RecTabOther3);

$colname_RecTabOther4 = "-1";
if (isset($row_RecEpaper['d_id'])) {
  $colname_RecTabOther4 = $row_RecEpaper['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecTabOther4 = sprintf("SELECT * FROM tab_set WHERE tab_d_id = %s AND tab_type = 'epaperTemp4' ORDER BY tab_sort ASC, tab_id ASC", GetSQLValueString($colname_RecTabOther4, "int"));
$RecTabOther4 = mysql_query($query_RecTabOther4, $connect2data) or die(mysql_error());
$row_RecTabOther4 = mysql_fetch_assoc($RecTabOther4);
$totalRows_RecTabOther4 = mysql_num_rows($RecTabOther4);

$colname_RecImage = "-1";
if (isset($row_RecEpaper['d_id'])) {
  $colname_RecImage = $row_RecEpaper['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecImage = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'imageShort' ORDER BY file_id DESC", GetSQLValueString($colname_RecImage, "int"));
$RecImage = mysql_query($query_RecImage, $connect2data) or die(mysql_error());
$row_RecImage = mysql_fetch_assoc($RecImage);
$totalRows_RecImage = mysql_num_rows($RecImage);

$colname_RecImageLong = "-1";
if (isset($row_RecEpaper['d_id'])) {
  $colname_RecImageLong = $row_RecEpaper['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecImageLong = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'imageLong' ORDER BY file_id DESC", GetSQLValueString($colname_RecImageLong, "int"));
$RecImageLong = mysql_query($query_RecImageLong, $connect2data) or die(mysql_error());
$row_RecImageLong = mysql_fetch_assoc($RecImageLong);
$totalRows_RecImageLong = mysql_num_rows($RecImageLong);

 $menu_is="epaper";?>
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
          <td width="30%" class="list_title">刪除電子報</td>
          <td width="70%"><span class="no_data">確定刪除以下電子報?</span></td>
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
            <table width="100%" border="0" cellpadding="5" cellspacing="3">
              <tr>
                <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">標題</td>
                <td class="table_data"><?php echo $row_RecEpaper['d_title']; ?></td>
                <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
              </tr>

              <tr>
                <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">UID</td>
                <td class="table_data"><?php echo $row_RecEpaper['d_data1']; ?></td>
                <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
              </tr>

              <tr>
                <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">英文版網址</td>
                <td class="table_data"><?php echo $row_RecEpaper['d_data2']; ?></td>
                <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
              </tr>

              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">版型選擇</td>
                <td class="table_data">

                <?php if (!(strcmp(1, $row_RecEpaper['d_price1']))) {echo '窄圖片版型';} ?>
                <?php if (!(strcmp(2, $row_RecEpaper['d_price1']))) {echo '寬圖片版型';} ?>
                <?php if (!(strcmp(3, $row_RecEpaper['d_price1']))) {echo '綜合圖片版型';} ?>

                </td>
                <td bgcolor="#e5ecf6"></td>
              </tr>

              <?php
                  if($totalRows_RecTabsReport>0){ 
                    $i=1;
                    do{
                ?>
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">索引-標題<?php echo $i; ?></td>
                  <td class="table_data">
                    <?php echo $row_RecTabsReport['tab_title']; ?>
                  </td>
                  <td width="250" bgcolor="#e5ecf6"></td>
                </tr>


                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">索引-連結<?php echo $i; ?></td>
                  <td class="table_data">
                    <?php echo $row_RecTabsReport['tab_content']; ?>
                  </td>
                <td width="250" bgcolor="#e5ecf6"></td>
                </tr>
                <?php 
                    $i++;
                    } while ($row_RecTabsReport = mysql_fetch_assoc($RecTabsReport));
                  }
                ?>

                <?php if ($totalRows_RecImage > 0) { // Show if recordset not empty ?>

                  <tr>
                    <td align="center" bgcolor="#e5ecf6" class="table_col_title">目前窄圖片<a name="imageEdit" id="imageEdit"></a></td>
                    <td><?php do { ?>
                    <?php 
                    $actual_link = 'http://'.$_SERVER['HTTP_HOST'].'/'.$row_RecImage['file_link1'];
                    ?>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="100" rowspan="2" align="center"><img src="../<?php echo $row_RecImage['file_link2'].'?'.(mt_rand(1,100000)/100000); ?>" alt="" class="image_frame"/></td>
                              <td align="left" class="table_data"><div class="imgNot"><div>圖片網址：</div><?php echo $actual_link; ?></div></td>
                              </tr>
                          <tr>
                            <td align="left" class="table_data">&nbsp;</td>
                          </tr>
                        </table>
                        <?php } while ($row_RecImage = mysql_fetch_assoc($RecImage)); ?></td>
                    <td bgcolor="#e5ecf6" class="table_col_title">
                      </td>
                  </tr>
                  <?php } // Show if recordset not empty ?>

                  <?php if ($totalRows_RecImageLong > 0) { // Show if recordset not empty ?>
                  <tr>
                    <td align="center" bgcolor="#e5ecf6" class="table_col_title">目前寬圖片<a name="imageEdit" id="imageEdit"></a></td>
                    <td><?php do { ?>
                    <?php 
                    $actual_link = 'http://'.$_SERVER['HTTP_HOST'].'/'.$row_RecImageLong['file_link1'];
                    ?>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="100" rowspan="2" align="center"><img src="../<?php echo $row_RecImageLong['file_link2'].'?'.(mt_rand(1,100000)/100000); ?>" alt="" class="image_frame"/></td>
                              <td align="left" class="table_data"><div class="imgNot"><div>圖片網址：</div><?php echo $actual_link; ?></div></td>
                              </tr>
                          <tr>
                            <td align="left" class="table_data">&nbsp;</td>
                              </tr>
                          
                        </table>
                        <?php } while ($row_RecImageLong = mysql_fetch_assoc($RecImageLong)); ?></td>
                    <td bgcolor="#e5ecf6" class="table_col_title">
                      </td>
                  </tr>
                  <?php } // Show if recordset not empty ?>

                  <?php
                    if($totalRows_RecTabOther1>0){ 
                      $i=1;
                      do{
                  ?>

                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">窄圖片版型區塊-標題<?php echo $i; ?></td>
                    <td class="table_data">
                      <?php echo $row_RecTabOther1['tab_title']; ?>
                    </td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">窄圖片版型區塊-內容<?php echo $i; ?></td>
                    <td class="table_data"><?php echo $row_RecTabOther1['tab_content']; ?></td>
                    <td width="250" bgcolor="#e5ecf6"></td>
                  </tr>


                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">上傳窄圖片<?php echo $i; ?></td>
                    <td class="table_data"><?php echo $row_RecTabOther1['tab_data1']; ?></td>
                    <td width="250" bgcolor="#e5ecf6"></td>
                  </tr>

                  <?php 
                      $i++;
                      } while ($row_RecTabOther1 = mysql_fetch_assoc($RecTabOther1));
                    }
                  ?>

                  <?php
                    if($totalRows_RecTabOther2>0){ 
                      $i=1;
                      do{
                  ?>
                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">寬圖片版型區塊-標題<?php echo $i; ?></td>
                    <td class="table_data">
                      <?php echo $row_RecTabOther2['tab_title']; ?>
                    </td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">寬圖片版型區塊-內容<?php echo $i; ?></td>
                    <td class="table_data">
                    <?php echo $row_RecTabOther2['tab_content']; ?>
                    </td>
                    <td width="250" bgcolor="#e5ecf6"></td>
                  </tr>

                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">上傳寬圖片<?php echo $i; ?></td>
                    <td class="table_data">
                      <?php echo $row_RecTabOther2['tab_data1']; ?>
                    </td>
                    <td width="250" bgcolor="#e5ecf6"></td>
                  </tr>
                  <?php 
                      $i++;
                      } while ($row_RecTabOther2 = mysql_fetch_assoc($RecTabOther2));
                    }
                  ?>

                  <?php
                    if($totalRows_RecTabOther3>0){ 
                      $i=1;
                      do{
                  ?>
                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">綜合圖片版型-寬圖片區塊-標題<?php echo $i; ?></td>
                    <td class="table_data">
                      <?php echo $row_RecTabOther3['tab_title']; ?>
                    </td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">綜合圖片版型-寬圖片區塊-內容<?php echo $i; ?></td>
                    <td class="table_data">
                      <?php echo $row_RecTabOther3['tab_content']; ?>
                    </td>
                    <td width="250" bgcolor="#e5ecf6"></td>
                  </tr>

                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">上傳寬圖片<?php echo $i; ?></td>
                    <td class="table_data">
                      <?php echo $row_RecTabOther3['tab_data1']; ?>
                    </td>
                    <td width="250" bgcolor="#e5ecf6"></td>
                  </tr>
                  <?php 
                      $i++;
                      } while ($row_RecTabOther3 = mysql_fetch_assoc($RecTabOther3));
                    }
                  ?>

                  <?php
                    if($totalRows_RecTabOther4>0){ 
                      $i=1;
                      do{
                  ?>
                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">綜合圖片版型-窄圖片區塊-標題<?php echo $i; ?></td>
                    <td class="table_data">
                      <?php echo $row_RecTabOther4['tab_title']; ?>
                    </td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">綜合圖片版型-窄圖片區塊-內容<?php echo $i; ?></td>
                    <td class="table_data">
                      <?php echo $row_RecTabOther4['tab_content']; ?>
                    </td>
                    <td width="250" bgcolor="#e5ecf6"></td>
                  </tr>

                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">上傳窄圖片<?php echo $i; ?></td>
                    <td class="table_data"><?php echo $row_RecTabOther4['tab_data1']; ?></td>
                    <td width="250" bgcolor="#e5ecf6"></td>
                  </tr>

                  <?php 
                      $i++;
                      } while ($row_RecTabOther4 = mysql_fetch_assoc($RecTabOther4));
                    }
                  ?>

              
              <tr>
                 <td align="center" bgcolor="#e5ecf6" class="table_col_title">加入時間</td>
          	     <td class="table_data"><?php echo $row_RecEpaper['d_date']; ?></td>
          	     <td bgcolor="#e5ecf6">&nbsp;</td>
      	      </tr>
             </table>
            </td>
         </tr>
         <tr>
           <td>&nbsp;</td>
         </tr>
         <tr>
         <td align="center">
    	 <input name="delsure" type="hidden" id="delsure" value="1" />
       <input name="d_id" type="hidden" id="d_id" value="<?php echo $row_RecEpaper['d_id']; ?>" />
    	 <input name="submitBtn" type="submit" class="btnType" id="submitBtn" value="送出" /></td>
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
mysql_free_result($RecEpaper);
?>
