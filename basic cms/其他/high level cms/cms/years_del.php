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

if(!in_array(7,$_SESSION['MM_Limit']['a10'])){
  header("Location: years_list.php");
}

$colname_RecYears = "-1";
if (isset($_GET['term_id'])) {
  $colname_RecYears = $_GET['term_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecYears = sprintf("SELECT * FROM terms AS T LEFT JOIN term_taxonomy AS TT ON T.term_id=TT.term_id  WHERE T.term_id = %s", GetSQLValueString($colname_RecYears, "int"));
$RecYears = mysql_query($query_RecYears, $connect2data) or die(mysql_error());
$row_RecYears = mysql_fetch_assoc($RecYears);
$totalRows_RecYears = mysql_num_rows($RecYears);

$colname_RecImage = "-1";
if (isset($_GET['term_id'])) {
  $colname_RecImage = $_GET['term_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecImage = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'yearsCover' ORDER BY file_id DESC", GetSQLValueString($colname_RecImage, "int"));
$RecImage = mysql_query($query_RecImage, $connect2data) or die(mysql_error());
$row_RecImage = mysql_fetch_assoc($RecImage);
$totalRows_RecImage = mysql_num_rows($RecImage);

$menu_is="otherSet";?>
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
            <td width="30%" class="list_title">刪除年份</td>
            <td width="70%"><span class="no_data">確定刪除以下年份?</span></td>
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
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">中文名稱</td>
                  <td width="532" class="table_data"><?php echo $row_RecYears['name']; ?>
                    <input name="term_id" type="hidden" id="term_id" value="<?php echo $row_RecYears['term_id']; ?>" />
                    <input name="delsure" type="hidden" id="delsure" value="1" /></td>
                <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
              </tr>
              <?php if(0){ ?>
              <tr>
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title">英文名稱</td>
                  <td class="table_data"><?php echo $row_RecYears['name_en']; ?></td>
                <td bgcolor="#e5ecf6">&nbsp;</td>
              </tr>
              <tr>
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title">描述</td>
                  <td class="table_data"><?php echo nl2br($row_RecYears['description']); ?></td>
                <td bgcolor="#e5ecf6">&nbsp;</td>
              </tr>
              <?php } ?>
              <?php if ($totalRows_RecImage > 0) { // Show if recordset not empty ?>
                <tr>
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title">目前圖片<a name="imageEdit" id="imageEdit"></a></td>
                  <td><?php do { ?>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="100" rowspan="2" align="center"><img src="../<?php echo $row_RecImage['file_link2'].'?'.(mt_rand(1,100000)/100000); ?>" alt="" class="image_frame"/></td>
                                  <td align="left" class="table_data">&nbsp;圖片說明：<?php echo $row_RecImage['file_title']; ?></td>
                            </tr>
                        <tr>
                          <td align="left" class="table_data">&nbsp;</td>
                        </tr>
                        <tr>
                          <td align="center"></td>
                          <td align="center">&nbsp;</td>
                        </tr>
                      </table>
                      <?php } while ($row_RecImage = mysql_fetch_assoc($RecImage)); ?></td>
                  <td bgcolor="#e5ecf6" class="table_col_title"><p class="red_letter"></td>
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
  if ((isset($_REQUEST['term_id'])) && ($_REQUEST['term_id'] != "") && (isset($_REQUEST['delsure']))) {
    

    //刪除圖片真實檔案begin----
    
    $sql="SELECT file_link1, file_link2, file_link3 FROM file_set WHERE file_type = 'yearsCover' AND file_d_id='".$_POST['term_id']."'";

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

    //刪除圖片真實檔案end----
    //
    //刪除圖片資料庫資料begin----
    $deleteSQL = sprintf("DELETE FROM file_set WHERE file_type = 'yearsCover' AND file_d_id=%s",
                       GetSQLValueString($_POST['term_id'], "int"));
    mysql_select_db($database_connect2data, $connect2data);
    $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());

    $deleteSQL = sprintf("DELETE FROM terms WHERE term_id=%s",
               GetSQLValueString($_REQUEST['term_id'], "int"));
    //刪除圖片資料庫資料end----
  
    mysql_select_db($database_connect2data, $connect2data);
    $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());
    
    $deleteSQL = sprintf("DELETE FROM term_taxonomy WHERE term_id=%s",
               GetSQLValueString($_REQUEST['term_id'], "int")); 
    mysql_select_db($database_connect2data, $connect2data);
    $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());
  
    $deleteGoTo = "years_list.php?delchangeSort=1";
    
    if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING']."&pageNum=".$_SESSION["ToPage"];
    }
    header(sprintf("Location: %s", $deleteGoTo));
  }
?>
<?php
mysql_free_result($RecYears);
?>
