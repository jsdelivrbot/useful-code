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

if(!in_array(2,$_SESSION['MM_Limit']['a4'])){
	header("Location: social_list.php");
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$G_selected1 = '';
if (isset($_SESSION['selected_artistsT'])){
	$G_selected1 = $_SESSION['selected_artistsT'];
}

mysql_select_db($database_connect2data, $connect2data);
$query_RecArtistsT = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='post_tag' AND T.term_active='1' ORDER BY term_sort ASC, term_id DESC";
$RecArtistsT = mysql_query($query_RecArtistsT, $connect2data) or die(mysql_error());
$row_RecArtistsT = mysql_fetch_assoc($RecArtistsT);
$totalRows_RecArtistsT = mysql_num_rows($RecArtistsT);

$menu_is="artists";
$_SESSION['nowMenu']= $menu_is;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php require_once('cmsTitle.php'); ?></title>
<?php require_once('script.php'); ?>
<!-- InstanceBeginEditable name="doctitle" -->
<title>無標題文件</title>
<link rel="stylesheet" href="jquery/chosen_v1.0.0/chosen.css">

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
            <td width="30%" class="list_title">新增Social Network</td>
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
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">藝人</td>
                  <td>
  <label>
  <select data-placeholder="請選擇分類..." class="chosen-select table_data" tabindex="4" name="d_class2[]" id="d_class2">
  <?php
do {  
?>
  <option value="<?php echo $row_RecArtistsT['term_id']?>"<?php if (!(strcmp($row_RecArtistsT['term_id'], $G_selected1))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecArtistsT['name'].' '.$row_RecArtistsT['name_en']; ?><?php //echo $row_RecArtistsT['term_id']?></option>
  <?php
} while ($row_RecArtistsT = mysql_fetch_assoc($RecArtistsT));
  $rows = mysql_num_rows($RecArtistsT);
  if($rows > 0) {
      mysql_data_seek($RecArtistsT, 0);
	  $row_RecArtistsT = mysql_fetch_assoc($RecArtistsT);
  }
?>
  </select>
  </label>
                    </td>
                  <td width="250" bgcolor="#e5ecf6">
                    <input name="d_class1" type="hidden" id="d_class1" value="social" />
                    <!--<input id="fullIdPath" type="hidden" value="1,8,24" />-->
                    </td>
                </tr>
            	<tr>
            	  <td align="center" bgcolor="#e5ecf6" class="table_col_title">專頁名稱</td>
            	  <td><input name="d_title" type="text" class="table_data" id="d_title" size="50" /></td>
            	  <td bgcolor="#e5ecf6">&nbsp;</td>
          	  </tr>
              
              <tr>
            	  <td align="center" bgcolor="#e5ecf6" class="table_col_title">連結</td>
            	  <td><input name="d_content" type="text" class="table_data" id="d_content" size="50" /></td>
            	  <td bgcolor="#e5ecf6"><span class="red_letter">*請連結網址</span></td>
          	  </tr>
            	
              <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">時間</td>
                  <td><input name="d_date" type="text" class="table_data" id="d_date" value="<?php echo date("Y-m-d H:i:s"); ?>" size="50" /></td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">狀態</td>
                <td><label>
                  <select name="d_active" class="table_data" id="d_active">
                    <option value="1">公佈</option>
                    <option value="0">不公佈</option>
                  </select>
                </label></td>
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
mysql_free_result($RecArtistsT);

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

 $d_tag = '';
 $class3 = '';
 /*if(isset($_POST['d_class2'])){
 	$d_tag = $_POST['d_class2'];
 }*/
 $d_tag = is_null(checkV('d_class2')) ? NULL : implode (",", checkV('d_class2'));
 
 //echo 'd_tag = '.$d_tag.'<br>';
 
 $tagA = $_POST['d_class2'];
 $tagTMP = '';
 //echo 'tagA = '.$tagA.'<br>';
 
 $d_title	= checkV('d_title');
 $d_content	= checkV('d_content');
 $d_class1	= checkV('d_class1');
 $d_class2 = $d_tag;
 $d_class3	= checkV('d_class3');
 $d_class4	= checkV('d_class4');
 $d_class5	= checkV('d_class5');
 $d_class6	= checkV('d_class6');
 $d_date	= checkV('d_date');
 $d_active	= checkV('d_active'); 
  
 $d_data1	= checkV('d_data1');
 $d_data2	= checkV('d_data2');
 $d_data3	= checkV('d_data3');
  
  $insertSQL = sprintf("INSERT INTO data_set (d_title, d_content, d_class1, d_class2, d_tag, d_class3, d_class4, d_class5, d_class6, d_data1, d_data2, d_data3, d_price1, d_price2, d_date, d_active) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($d_title, "text"),
                       GetSQLValueString($d_content, "text"),
                       GetSQLValueString($d_class1, "text"),
                       GetSQLValueString($d_class2, "text"),
                       GetSQLValueString($d_tag, "text"),
                       GetSQLValueString($d_class3, "text"),
                       GetSQLValueString($d_class4, "text"),
                       GetSQLValueString($d_class5, "text"),
                       GetSQLValueString($d_class6, "text"),
                       GetSQLValueString($d_data1, "text"),
                       GetSQLValueString($d_data2, "text"),
                       GetSQLValueString($d_data3, "text"),
                       GetSQLValueString($d_price1, "int"),
                       GetSQLValueString($d_price2, "int"),
                       GetSQLValueString($d_date, "date"),
                       GetSQLValueString($d_active, "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());

	$new_data_num = mysql_insert_id();

  foreach ($tagA as $tagO){
    $insertSQL = sprintf("INSERT INTO term_relationships (object_id, term_taxonomy_id) VALUES (%s, %s)",
                       GetSQLValueString($new_data_num, "int"),
                       GetSQLValueString($tagO, "int"));

      mysql_select_db($database_connect2data, $connect2data);
      $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
      $tagTMP = $tagO;
  }
	
	
  $_SESSION['original_selected']=$_SESSION['selected_artistsT'];
  $insertGoTo = "social_list.php?selected1=".$tagTMP."&pageNum=0&totalRows_RecSocial=".($_SESSION['totalRows']+1)."&changeSort=1&now_d_id=".$new_data_num."&change_num=1";
  
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

