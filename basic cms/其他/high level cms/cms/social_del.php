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

if(!in_array(7,$_SESSION['MM_Limit']['a4'])){
	header("Location: social_list.php");
}

$colname_RecSocial = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecSocial = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecSocial = sprintf("SELECT * FROM term_relationships AS TR, data_set AS D, terms AS T WHERE TR.term_taxonomy_id = T.term_id AND D.d_id = TR.object_id AND D.d_id = %s", GetSQLValueString($colname_RecSocial, "int"));
$RecSocial = mysql_query($query_RecSocial, $connect2data) or die(mysql_error());
$row_RecSocial = mysql_fetch_assoc($RecSocial);
$totalRows_RecSocial = mysql_num_rows($RecSocial);

$G_selected1 = '';
if (isset($_SESSION['selected_artistsT'])){
	$G_selected1 = $_SESSION['selected_artistsT'] = $row_RecSocial['d_class2'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecArtistsT = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='post_tag' AND T.term_active='1' ORDER BY term_sort ASC, term_id DESC";
$RecArtistsT = mysql_query($query_RecArtistsT, $connect2data) or die(mysql_error());
$row_RecArtistsT = mysql_fetch_assoc($RecArtistsT);
$totalRows_RecArtistsT = mysql_num_rows($RecArtistsT);

$menu_is="artists";

require_once('../js/fun_moneyFormat.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php require_once('cmsTitle.php'); ?></title>
<?php require_once('script.php'); ?>
<!-- InstanceBeginEditable name="doctitle" -->
<title>無標題文件</title>
<style>
.chosen-choices {
	position: relative;
	/*overflow: hidden;*/
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	margin: 0;
	padding: 0;
	width: 100%;
	height: auto !important;
	height: 1%;	
	cursor: text;
}
.chosen-choices li.search-choice {
	position: relative;
	margin: 3px 5px 3px 0px;
	padding: 3px 5px;
	border: 1px solid #aaa;
	border-radius: 3px;
	background-color: #e4e4e4;
	background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(20%, #f4f4f4), color-stop(50%, #f0f0f0), color-stop(52%, #e8e8e8), color-stop(100%, #eeeeee));
	background-image: -webkit-linear-gradient(#f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eeeeee 100%);
	background-image: -moz-linear-gradient(#f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eeeeee 100%);
	background-image: -o-linear-gradient(#f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eeeeee 100%);
	background-image: linear-gradient(#f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eeeeee 100%);
	background-clip: padding-box;
	box-shadow: 0 0 2px white inset, 0 1px 0 rgba(0, 0, 0, 0.05);
	color: #333;
	line-height: 13px;
	cursor: default;
}
.chosen-choices li {
	float: left;
	list-style: none;
}
</style>
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
            <td width="30%" class="list_title">刪除Social Network</td>
            <td width="70%"><span class="no_data">確定刪除以下Social Network?</span></td>
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
            	  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">藝人</td>
            	  <td class="table_data">
            	    
            	    <ul class="chosen-choices">
            	      
            	      
            	      <?php
do {
	$selA = explode(',',$row_RecSocial['d_tag']);
	if (in_array($row_RecArtistsT['term_id'], $selA)){
		echo '<li class="search-choice"><span>'.$row_RecArtistsT['name'].' '.$row_RecArtistsT['name_en'].'</span></li>';
	}

} while ($row_RecArtistsT = mysql_fetch_assoc($RecArtistsT));
  $rows = mysql_num_rows($RecArtistsT);
  if($rows > 0) {
      mysql_data_seek($RecArtistsT, 0);
	  $row_RecArtistsT = mysql_fetch_assoc($RecArtistsT);
  }
?>
            	      </ul>
            	    
            	    <input name="d_id" type="hidden" id="d_id" value="<?php echo $row_RecSocial['d_id']; ?>" />
            	    <input name="delsure" type="hidden" id="delsure" value="1" /></td>
            	  <td bgcolor="#e5ecf6">&nbsp;</td>
          	  </tr>
            	<tr>
            	  <td align="center" bgcolor="#e5ecf6" class="table_col_title">專頁名稱</td>
            	  <td class="table_data"><?php echo $row_RecSocial['d_title']; ?></td>
            	  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
          	  </tr>
            	<tr>
            	  <td align="center" bgcolor="#e5ecf6" class="table_col_title">連結</td>
            	  <td class="table_data"><?php echo $row_RecSocial['d_content']; ?></td>
            	  <td bgcolor="#e5ecf6">&nbsp;</td>
          	  </tr>
                <tr>
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title">時間</td>
                  <td class="table_data"><?php echo $row_RecSocial['d_date']; ?></td>
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

	  $deleteSQL = sprintf("DELETE FROM term_relationships WHERE object_id=%s",
						   GetSQLValueString($_REQUEST['d_id'], "int"));
	
	  mysql_select_db($database_connect2data, $connect2data);
	  $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());	
	  
	  $deleteSQL = sprintf("DELETE FROM data_set WHERE d_id=%s",
						   GetSQLValueString($_REQUEST['d_id'], "int"));
	
	  mysql_select_db($database_connect2data, $connect2data);
	  $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());	  
	   
	  $deleteGoTo = "social_list.php?delchangeSort=1&selected1=".$G_selected1;
	  if (isset($_SERVER['QUERY_STRING'])) {
		$deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
		$deleteGoTo .= $_SERVER['QUERY_STRING']."&pageNum=".$_SESSION["ToPage"];
	  }
	  header(sprintf("Location: %s", $deleteGoTo));
	}
?>
<?php
mysql_free_result($RecSocial);
?>
