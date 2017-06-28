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

if(!in_array(7,$_SESSION['MM_Limit']['a11'])){
	header("Location: articleTag_list.php");
}

$colname_RecArticleTag = "-1";
if (isset($_GET['term_id'])) {
  $colname_RecArticleTag = $_GET['term_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecArticleTag = sprintf("SELECT * FROM terms WHERE term_id = %s", GetSQLValueString($colname_RecArticleTag, "int"));
$RecArticleTag = mysql_query($query_RecArticleTag, $connect2data) or die(mysql_error());
$row_RecArticleTag = mysql_fetch_assoc($RecArticleTag);
$totalRows_RecArticleTag = mysql_num_rows($RecArticleTag);

if($totalRows_RecArticleTag==0){
  header("Location: articleTag_list.php");
}

$menu_is="articleTag";?>
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
            <td width="30%" class="list_title">刪除文章標籤</td>
            <td width="70%"><span class="no_data">確定刪除以下文章標籤?</span></td>
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
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">標籤名稱</td>
          	    	<td width="532" class="table_data"><?php echo $row_RecArticleTag['name']; ?>
          	    	  <input name="term_id" type="hidden" id="term_id" value="<?php echo $row_RecArticleTag['term_id']; ?>" />
          	    	  <input name="delsure" type="hidden" id="delsure" value="1" /></td>
        	    	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	    	</tr>
              <?php if(0){ ?>
              <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">分類英文名稱</td>
                  <td width="532" class="table_data"><?php echo $row_RecArticleTag['name_en']; ?></td>
                <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
              </tr>
              <?php } ?>
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
		
			   
	  $deleteSQL = sprintf("DELETE FROM terms WHERE term_id=%s",
						   GetSQLValueString($_REQUEST['term_id'], "int"));
	
	  mysql_select_db($database_connect2data, $connect2data);
	  $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());
	  
	  $deleteSQL = sprintf("DELETE FROM term_taxonomy WHERE term_id=%s",
						   GetSQLValueString($_REQUEST['term_id'], "int"));	
	  mysql_select_db($database_connect2data, $connect2data);
	  $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());


    if(0){
      //main new
      $deleteSQL = sprintf("DELETE FROM data_set WHERE d_class3=%s AND d_class1='mainNews' AND d_class2='articleTag'",
                 GetSQLValueString($_REQUEST['term_id'], "int")); 
      mysql_select_db($database_connect2data, $connect2data);
      $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());

      /**********修改排序************/
      mysql_select_db($database_connect2data, $connect2data);  
      $query_RecMainNews = "SELECT d_id, d_sort, d_class1, d_class2, d_class3 FROM data_set AS D WHERE D.d_class1='mainNews' ORDER BY d_sort ASC, d_date DESC";  
      $RecMainNews = mysql_query($query_RecMainNews, $connect2data) or die(mysql_error());
      $row_RecMainNews = mysql_fetch_assoc($RecMainNews);
      //echo '<br>query 2 = '.$query_RecMainNews.'<br>';

      $sort_num=1;
      do{
        //echo 'd_id = >'.$row_RecMainNews['d_id'].' d_sort =>'.$row_RecMainNews['d_sort'].', sort_num =>'.$sort_num.'<br>';
        if($row_RecMainNews['d_sort']==0)
        {}
        else if($sort_num==1)
        {
          //echo 'sort_num(change_num) = '.$sort_num."<br/>";
          //$sort_num++;
          
          $updateSQL = sprintf("UPDATE data_set SET d_sort=%s WHERE d_id=%s AND d_class1='mainNews'",
             GetSQLValueString($sort_num, "int"),
             GetSQLValueString($row_RecMainNews['d_id'], "int"));

          mysql_select_db($database_connect2data, $connect2data);
          $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
          
          $sort_num++;
        }
        else
        {
          $updateSQL = sprintf("UPDATE data_set SET d_sort=%s WHERE d_id=%s AND d_class1='mainNews'",
             GetSQLValueString($sort_num, "int"),
             GetSQLValueString($row_RecMainNews['d_id'], "int"));

          mysql_select_db($database_connect2data, $connect2data);
          $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
          
          //echo $sort_num."<br/>";
          //echo $row_RecMainNews['d_title']."->".$sort_num."<br/>";
          
          $sort_num++;    
        }
        
        
      //echo " ".$row_RecMainNews['d_sort'].'<br>';
      }while ($row_RecMainNews = mysql_fetch_assoc($RecMainNews));


    /**********修改排序************/
    }
	
	  $deleteGoTo = "articleTag_list.php?delchangeSort=1";
	  
	  if (isset($_SERVER['QUERY_STRING'])) {
		$deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
		$deleteGoTo .= $_SERVER['QUERY_STRING']."&pageNum=".$_SESSION["ToPage"];
	  }
	  header(sprintf("Location: %s", $deleteGoTo));
	}
?>
<?php
mysql_free_result($RecArticleTag);
?>
