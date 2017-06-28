<?php
			if (!isset($_SESSION)) {
               session_start();
               }
            ob_start();
?>
<?php require_once('../Connections/connect2data.php'); ?>
<?php //require_once('photo_process_epaper.php'); ?>
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

if(!in_array(2,$_SESSION['MM_Limit']['a12'])){
	header("Location: epaper_list.php");
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

mysql_select_db($database_connect2data, $connect2data);
$query_RecClass2 = "SELECT * FROM class_set WHERE c_parent = 'careersC' AND c_active='1' ORDER BY c_sort ASC, c_id DESC";
$RecClass2 = mysql_query($query_RecClass2, $connect2data) or die(mysql_error());
$row_RecClass2 = mysql_fetch_assoc($RecClass2);
$totalRows_RecClass2 = mysql_num_rows($RecClass2);

mysql_select_db($database_connect2data, $connect2data);
$query_RecClass3 = "SELECT * FROM class_set WHERE c_parent = 'jobTitleC' AND c_active='1' ORDER BY c_sort ASC, c_id DESC";
$RecClass3 = mysql_query($query_RecClass3, $connect2data) or die(mysql_error());
$row_RecClass3 = mysql_fetch_assoc($RecClass3);
$totalRows_RecClass3 = mysql_num_rows($RecClass3);

$selected_careers = '';
if(isset($_SESSION['selected_careers'])){
	$selected_careers = $_SESSION['selected_careers'];
}

$menu_is="epaper";
$_SESSION['nowMenu']= "epaper";
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
          <td width="30%" class="list_title">新增電子報EMAIL資料</td>
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
                <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title" id="CompanyName">EMAIL</td>
                <td width="532"><input name="e_title" type="text" class="table_data" id="e_title" size="50"></td>
                <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
              </tr>
              
              
              <tr>
                 <td align="center" bgcolor="#e5ecf6" class="table_col_title">加入時間</td>
          	     <td><input name="e_date" type="text" class="table_data" id="e_date" value="<?php echo date("Y-m-d H:i:s"); ?>" size="50"></td>
        	     <td bgcolor="#e5ecf6">&nbsp;</td>
      	      </tr>

              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">狀態</td>
                <td><label>
                  <select name="e_active" class="table_data" id="e_active">
                    <option value="1">可使用</option>
                    <option value="0">不可使用</option>
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
         <td align="center">
    	 <input name="submitBtn" type="submit" class="btnType" id="submitBtn" value="送出" /></td>
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
  $insertSQL = sprintf("INSERT INTO epaper_set (e_title, e_class1, e_date, e_active) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['e_title'], "text"),
                       GetSQLValueString("epaper", "text"),
                       GetSQLValueString($_POST['e_date'], "date"),
                       GetSQLValueString($_POST['e_active'], "text"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
	
	/*//----------插入圖片資料到資料庫begin(須放入插入主資料後)----------
   			//echo image_process();
	
			$sql_max_data= "Select MAX(e_id) From epaper_set";//找到d_id的最大值,放入圖片資料內
			//echo $sql_max_data;
			$result_max_data=mysql_query($sql_max_data);
			
			if($row_max_data = mysql_fetch_array($result_max_data))
			{	
			
				$new_data_num=$row_max_data[0];
		
				//echo $row_max_data[0];
			}
			
	$image_result=image_process("epaper","add", "0", "0");
	
		//echo count($image_result);
		//echo $image_result[0][0];
		
		
		for($j=1;$j<count($image_result);$j++)
		{
			  $insertSQL = sprintf("INSERT INTO file_set (file_name, file_link1, file_link2, file_title, file_type, file_d_id) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($image_result[$j][0], "text"),
                       GetSQLValueString($image_result[$j][1], "text"),
                       GetSQLValueString($image_result[$j][2], "text"),
                       GetSQLValueString($image_result[$j][3], "text"),
                       GetSQLValueString("image", "text"),
                       GetSQLValueString($new_data_num, "int"));

  			  mysql_select_db($database_connect2data, $connect2data);
  			  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
			  $_SESSION["change_image"]=1;
		}*/
		
	
	
	//----------插入圖片資料到資料庫end----------


  mysql_select_db($database_connect2data, $connect2data);
  $query_RecEpaper = "SELECT * FROM epaper_set WHERE e_class1='epaper'";
  $RecEpaper = mysql_query($query_RecEpaper, $connect2data) or die(mysql_error());
  $totalRows = mysql_num_rows($RecEpaper);

  $_SESSION['totalRows'] = $totalRows;
  
  $insertGoTo = "epaper_list.php?pageNum_RecEpaper=0&totalRows_RecEpaper=".$_SESSION['totalRows']."&changeSort=1&now_d_id=".$new_data_num."&change_num=1";

  //$insertGoTo = "epaper_list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>