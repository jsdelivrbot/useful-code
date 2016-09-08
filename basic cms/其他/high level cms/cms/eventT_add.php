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

if(!in_array(2,$_SESSION['MM_Limit']['a8'])){
	header("Location: eventT_list.php");
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$menu_is="event";
$_SESSION['nowMenu']= "event";
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
            <td width="30%" class="list_title">新增活動訊息分類</td>
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
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">分類名稱</td>
          	    	<td width="532"><input name="name" type="text" class="table_data" id="name" size="50">
          	    	  <input name="c_parent" type="hidden" id="c_parent" value="eventT" /></td>
        	    	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	    	</tr>

              <!-- <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">英文分類名稱</td>
                  <td width="532"><input name="name_en" type="text" class="table_data" id="name_en" size="50">
                  </td>
                <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
              </tr> -->

                <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">狀態</td>
          	    	<td width="532"><label>
          	        <select name="term_active" class="table_data" id="term_active">
          	        	<option value="1">公佈</option>
          	        	<option value="0">不公佈</option>
       	            </select></label></td>
          	     	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
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
  if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

  $name = checkV('name');
  $slug = ($name!=NULL) ? urlencode($name) : NULL;
  $name_en = checkV('name_en');
  $term_active = checkV('term_active');
  $description = checkV('description');
  
  $insertSQL = sprintf("INSERT INTO terms (name, name_en, slug, term_active) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($name, "text"),
                       GetSQLValueString($name_en, "text"),
                       GetSQLValueString($slug, "text"),
                       GetSQLValueString($term_active, "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
	
	//找到term_id的最大值
	$new_data_num = mysql_insert_id();
	
	$insertSQL = sprintf("INSERT INTO term_taxonomy (term_id, description, taxonomy) VALUES (%s, %s, %s)",
                       GetSQLValueString($new_data_num, "int"),
                       GetSQLValueString($description, "text"),
                       GetSQLValueString('eventT', "text"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());

  //存給 main news 用
  $insertSQL = sprintf("INSERT INTO data_set (d_title, d_class1, d_class2, d_class3, d_active, d_pub, d_sort) VALUES (%s, %s, %s, %s, 1, 0, 1)",
                       GetSQLValueString($name, "text"),
                       GetSQLValueString('mainNews', "text"),
                       GetSQLValueString('eventT', "text"),
                       GetSQLValueString($new_data_num, "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());

  //找到main news id的最大值
  $mainNewsId = mysql_insert_id();


  /**********修改排序************/
  mysql_select_db($database_connect2data, $connect2data);  
  $query_RecMainNews = "SELECT * FROM data_set AS D WHERE D.d_class1='mainNews' ORDER BY d_sort ASC, d_date DESC";  
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

  mysql_select_db($database_connect2data, $connect2data);
  $query_RecEventT = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='eventT' ORDER BY term_sort ASC, term_id DESC";
  $RecEventT = mysql_query($query_RecEventT, $connect2data) or die(mysql_error());
  $totalRows_RecEventT = mysql_num_rows($RecEventT);

  $_SESSION['totalRows'] = $totalRows_RecEventT;
	
   
  $insertGoTo = "eventT_list.php?pageNum=0&totalRows_RecEventT=".$_SESSION['totalRows']."&changeSort=1&now_term_id=".$new_data_num."&change_num=1";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  
  
  header(sprintf("Location: %s", $insertGoTo));
  
  
}
?>

