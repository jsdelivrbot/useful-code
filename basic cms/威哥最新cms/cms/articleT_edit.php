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

if(!in_array(5,$_SESSION['MM_Limit']['a3'])){
	header("Location: articleT_list.php");
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


$colname_RecArticleT = "-1";
if (isset($_GET['term_id'])) {
  $colname_RecArticleT = $_GET['term_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecArticleT = sprintf("SELECT * FROM terms WHERE term_id = %s", GetSQLValueString($colname_RecArticleT, "int"));
$RecArticleT = mysql_query($query_RecArticleT, $connect2data) or die(mysql_error());
$row_RecArticleT = mysql_fetch_assoc($RecArticleT);
$totalRows_RecArticleT = mysql_num_rows($RecArticleT);

if($totalRows_RecArticleT==0){
  header("Location: articleT_list.php");
}

$colname_RecImage = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecImage = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecImage = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'imageT'", GetSQLValueString($colname_RecImage, "int"));
$RecImage = mysql_query($query_RecImage, $connect2data) or die(mysql_error());
$row_RecImage = mysql_fetch_assoc($RecImage);
$totalRows_RecImage = mysql_num_rows($RecImage);

$colname_RecImageMobile = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecImageMobile = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecImageMobile = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'imageTContentBanner'", GetSQLValueString($colname_RecImageMobile, "int"));
$RecImageMobile = mysql_query($query_RecImageMobile, $connect2data) or die(mysql_error());
$row_RecImageMobile = mysql_fetch_assoc($RecImageMobile);
$totalRows_RecImageMobile = mysql_num_rows($RecImageMobile);

$menu_is="articleT";
$_SESSION['nowMenu']= "articleT";

?>
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
            <td width="30%" class="list_title">修改文章分類</td>
            <td width="70%">&nbsp;</td>
        </tr>
	</table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td><img src="image/spacer.gif" width="1" height="1"></td>
        </tr>
    </table>
    <form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1" id="form1">
    <table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td><table width="100%" border="0" cellspacing="3" cellpadding="5">
      <tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" border="0" cellspacing="3" cellpadding="5">
            <tr>
              <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">分類名稱</td>
              <td width="516"><input name="name" type="text" class="table_data" id="name" value="<?php echo $row_RecArticleT['name']; ?>" size="50" />
                  <input name="term_id" type="hidden" id="term_id" value="<?php echo $row_RecArticleT['term_id']; ?>" /></td>
              <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
            </tr>

            <tr>
              <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">分類英文名稱</td>
              <td width="516"><input name="name_en" type="text" class="table_data" id="name_en" value="<?php echo $row_RecArticleT['name_en']; ?>" size="50" />
                  </td>
              <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
            </tr>

            <tr>
              <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">是否推薦</td>
              <td width="516"><label>
                <select name="term_recommend" class="table_data" id="term_recommend">
                  <option value="0" <?php if (!(strcmp(0, $row_RecArticleT['term_recommend']))) {echo "selected=\"selected\"";} ?>>否</option>
                  <option value="1" <?php if (!(strcmp(1, $row_RecArticleT['term_recommend']))) {echo "selected=\"selected\"";} ?>>推薦</option>
                </select>
              </label></td>
              <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
            </tr>

            <tr>
              <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">狀態</td>
              <td width="516"><label>
                <select name="term_active" class="table_data" id="term_active">
                  <option value="0" <?php if (!(strcmp(0, $row_RecArticleT['term_active']))) {echo "selected=\"selected\"";} ?>>不公佈</option>
                  <option value="1" <?php if (!(strcmp(1, $row_RecArticleT['term_active']))) {echo "selected=\"selected\"";} ?>>公佈</option>
                </select>
              </label></td>
              <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
            </tr>
            
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="center"><input name="submitBtn" type="submit" class="btnType" id="submitBtn" value="送出" /></td>
      </tr>
    </table></td>
        	    	</tr>
    </table>
            </td>
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
	
	$name = checkV('name');
  $slug = ($name!=NULL) ? urlencode($name) : NULL;
  $name_en = checkV('name_en');
  $term_active = checkV('term_active');
  $description = checkV('description');
  $term_id = checkV('term_id');
  $term_recommend = checkV('term_recommend');
	
  $updateSQL = sprintf("UPDATE terms SET name=%s, name_en=%s, slug=%s, term_active=%s, term_recommend=%s WHERE term_id=%s",
                       GetSQLValueString($name, "text"),
                       GetSQLValueString($name_en, "text"),
                       GetSQLValueString($slug, "text"),
                       GetSQLValueString($term_active, "int"),
                       GetSQLValueString($term_recommend, "int"),
                       GetSQLValueString($term_id, "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
  
  $updateSQL = sprintf("UPDATE term_taxonomy SET description=%s WHERE term_id=%s",
                       GetSQLValueString($description, "text"),
                       GetSQLValueString($term_id, "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());

  //----------插入圖片資料到資料庫begin(須放入插入主資料後)----------
        //echo image_process();
  if(isset($_FILES['image']) && $_FILES['image']!=''){

    $image_result=image_process($_FILES['image'], $_REQUEST['image_title'], $_SESSION['nowMenu'].'Banner' ,"add", $imagesSize[$_SESSION['nowMenu'].'Banner']['IW'], $imagesSize[$_SESSION['nowMenu']]['IH']);
    
      //echo count($image_result);
      //echo $image_result[0][0];
      
      for($j=1;$j<count($image_result);$j++)
      {              
        $insertSQL = sprintf("INSERT INTO file_set (file_name, file_link1, file_link2, file_link3, file_type, file_d_id, file_title, file_show_type) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($image_result[$j][0], "text"),
                       GetSQLValueString($image_result[$j][1], "text"),
                       GetSQLValueString($image_result[$j][2], "text"),
                       GetSQLValueString($image_result[$j][3], "text"),
                       GetSQLValueString("imageT", "text"),
                       GetSQLValueString($_POST['d_id'], "int"),
                       GetSQLValueString($image_result[$j][4], "text"),
                       GetSQLValueString($image_result[$j][5], "int"));
  
          mysql_select_db($database_connect2data, $connect2data);
          $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
          
          $_SESSION["change_image"]=1;
      }
      
    
    }
    //----------插入圖片資料到資料庫end----------

    //----------插入Mobile圖片資料到資料庫begin(須放入插入主資料後)----------
    
    if(isset($_FILES['imageContentBanner']) && $_FILES['imageContentBanner']!=''){

      $image_result=image_process($_FILES['imageContentBanner'], $_REQUEST['imageContentBanner_title'], $_SESSION['nowMenu'].'ContentBanner', "add", $imagesSize[$_SESSION['nowMenu'].'ContentBanner']['IW'], $imagesSize[$_SESSION['nowMenu'].'ContentBanner']['IH']);
      
      
      for($j=1;$j<count($image_result);$j++)
      {              
        $insertSQL = sprintf("INSERT INTO file_set (file_name, file_link1, file_link2, file_link3, file_type, file_d_id, file_title, file_show_type) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($image_result[$j][0], "text"),
                       GetSQLValueString($image_result[$j][1], "text"),
                       GetSQLValueString($image_result[$j][2], "text"),
                       GetSQLValueString($image_result[$j][3], "text"),
                       GetSQLValueString("imageTContentBanner", "text"),
                       GetSQLValueString($_POST['d_id'], "int"),
                       GetSQLValueString($image_result[$j][4], "text"),
                       GetSQLValueString($image_result[$j][5], "int"));
  
          mysql_select_db($database_connect2data, $connect2data);
          $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
          
          $_SESSION["change_image"]=1;
      }
    } 
    
    //----------插入Mobile圖片資料到資料庫end----------

  
  if(0){
  /*******************************************************************/
  
    //存給 main news 用

    mysql_select_db($database_connect2data, $connect2data);  
    $query_RecCheckMainNews = "SELECT * FROM data_set AS D WHERE D.d_class1='mainNews' AND D.d_class2='articleT' AND D.d_class3='$term_id'";  
    $RecCheckMainNews = mysql_query($query_RecCheckMainNews, $connect2data) or die(mysql_error());
    $row_RecCheckMainNews = mysql_fetch_assoc($RecCheckMainNews);
    $totalRows_RecCheckMainNews = mysql_num_rows($RecCheckMainNews);

    if($totalRows_RecCheckMainNews==0){
      $insertSQL = sprintf("INSERT INTO data_set (d_title, d_class1, d_class2, d_class3, d_active, d_pub, d_sort) VALUES (%s, %s, %s, %s, 1, 0, 1)",
                         GetSQLValueString($name, "text"),
                         GetSQLValueString('mainNews', "text"),
                         GetSQLValueString('articleT', "text"),
                         GetSQLValueString($term_id, "int"));

      mysql_select_db($database_connect2data, $connect2data);
      $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());

      //找到main news id的最大值
      $mainNewsId = mysql_insert_id();
    }else{

      $updateSQL = sprintf("UPDATE data_set SET d_title=%s WHERE d_class3=%s AND d_class1='mainNews' AND d_class2='articleT'",
         GetSQLValueString($name, "text"),
         GetSQLValueString($term_id, "int"));

      mysql_select_db($database_connect2data, $connect2data);
      $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());

      $selectSQL = sprintf("SELECT d_id FROM data_set WHERE d_class3=%s AND d_class1='mainNews' AND d_class2='articleT'",       
         GetSQLValueString($term_id, "int"));

      mysql_select_db($database_connect2data, $connect2data);
      $Result1 = mysql_query($selectSQL, $connect2data) or die(mysql_error());
      $row = mysql_fetch_assoc($Result1);

      $mainNewsId = $row['d_id'];

    }

    


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
      else if($row_RecMainNews['d_id']==$mainNewsId)
      { 
        //echo 'sort_num(now_d_id) = '.$sort_num."<br/>";
        
      }else if($sort_num==1)
      {
        //echo 'sort_num(change_num) = '.$sort_num."<br/>";
        $sort_num++;
        
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
  
  $updateGoTo = "articleT_list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING']."&pageNum=".$_SESSION["ToPage"];
  }
  header(sprintf("Location: %s", $updateGoTo));
 
}
?>
<?php
 mysql_free_result($RecArticleT);
?>