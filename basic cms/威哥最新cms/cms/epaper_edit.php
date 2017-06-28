<?php
if (!isset($_SESSION)) {
  session_start();
}
ob_start();
?>
<?php require_once('../Connections/connect2data.php'); ?>
<?php require_once('photo_process_epaper.php'); ?>
<?php require_once('imagesSize.php'); ?>
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

if(!in_array(5,$_SESSION['MM_Limit']['a12'])){
	header("Location: epaper_list.php");
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {

  $d_title  = checkV('d_title');
  $d_title_en = checkV('d_title_en');
  $d_content = checkV('d_content');

  $d_date  = checkV('d_date');
  $d_active  = checkV('d_active');
  $d_pub  = checkV('d_pub');

  $d_price1 = checkV('d_price1');
  $d_data1 = checkV('d_data1');
  $d_data2 = checkV('d_data2');
  $d_id = checkV('d_id');


  $updateSQL = sprintf("UPDATE data_set SET d_title=%s, d_title_en=%s, d_content=%s, d_data1=%s, d_data2=%s, d_price1=%s, d_date=%s, d_active=%s, d_pub=%s WHERE d_id=%s",
                       GetSQLValueString($d_title, "text"),
                       GetSQLValueString($d_title_en, "text"),
                       GetSQLValueString($d_content, "text"),
                       GetSQLValueString($d_data1, "text"),
                       GetSQLValueString($d_data2, "text"),
                       GetSQLValueString($d_price1, "int"),
                       GetSQLValueString($d_date, "date"),
                       GetSQLValueString($d_active, "int"),
                       GetSQLValueString($d_pub, "int"),
                       GetSQLValueString($d_id, "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());

  //----------插入 SHORT 圖片資料到資料庫begin(須放入插入主資料後)----------
        //echo image_process();
        
    //$image_result=image_process("founder","add", "0", "0");
    $image_result = image_process($_FILES['image'], "", "epaper","add", $imagesSize["epaperShort1"]['IW'], $imagesSize["epaperShort1"]['IH'], "short");
      //echo count($image_result);
      //echo $image_result[0][0];
      
      
      for($j=1;$j<count($image_result);$j++)
      {
        $insertSQL = sprintf("INSERT INTO file_set (file_name, file_link1, file_link2, file_link3, file_type, file_d_id, file_title, file_show_type) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($image_result[$j][0], "text"),
                       GetSQLValueString($image_result[$j][1], "text"),
                       GetSQLValueString($image_result[$j][2], "text"),
                       GetSQLValueString($image_result[$j][3], "text"),
                       GetSQLValueString("imageShort", "text"),
                       GetSQLValueString($d_id, "int"),
                       GetSQLValueString($image_result[$j][4], "text"),
                       GetSQLValueString($image_result[$j][5], "int"));
  
          mysql_select_db($database_connect2data, $connect2data);
          $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
          
          $_SESSION["change_image"]=1;
      }   
    //----------插入 SHORT 圖片資料到資料庫end----------

  //----------插入 LONG 圖片資料到資料庫begin(須放入插入主資料後)----------
        //echo image_process();
        
    //$image_result=image_process("founder","add", "0", "0");
    $image_result = image_process($_FILES['imageLong'], "", "epaper","add", $imagesSize["epaperLong1"]['IW'], $imagesSize["epaperLong1"]['IH'], "long");
      //echo count($image_result);
      //echo $image_result[0][0];
      
      
      for($j=1;$j<count($image_result);$j++)
      {
        $insertSQL = sprintf("INSERT INTO file_set (file_name, file_link1, file_link2, file_link3, file_type, file_d_id, file_title, file_show_type) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($image_result[$j][0], "text"),
                       GetSQLValueString($image_result[$j][1], "text"),
                       GetSQLValueString($image_result[$j][2], "text"),
                       GetSQLValueString($image_result[$j][3], "text"),
                       GetSQLValueString("imageLong", "text"),
                       GetSQLValueString($d_id, "int"),
                       GetSQLValueString($image_result[$j][4], "text"),
                       GetSQLValueString($image_result[$j][5], "int"));
  
          mysql_select_db($database_connect2data, $connect2data);
          $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
          
          $_SESSION["change_image"]=1;
      }   
    //----------插入 LONG 圖片資料到資料庫end----------
	
//----------插入動態 索引與連結 到資料庫begin(須放入插入主資料後)----------

  if(isset($_POST['tabReport_title'])){ //如果有資料
    //tabReport_id
    //先將該ID的tabOther全都刪掉，然後再全新增

    $deleteSQL = sprintf("DELETE FROM tab_set WHERE tab_type='epaperReport' AND tab_d_id=%s",
               GetSQLValueString($d_id, "int"));
  
    mysql_select_db($database_connect2data, $connect2data);
    $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());

    //全新增
    $tabReport_title = $_POST['tabReport_title'];
    $tabReport_content = $_POST['tabReport_content'];
    //$tabReport_id = $_POST['tabReport_id'];

    for($j=0; $j<count($tabReport_title); $j++){

      if($tabReport_title[$j]!='' || $tabReport_content[$j]!=''){

        $insertSQL = sprintf("INSERT INTO tab_set (tab_d_id, tab_type, tab_title, tab_content, tab_sort) VALUES (%s, %s, %s, %s, %s)",
                         GetSQLValueString($d_id, "int"),
                         GetSQLValueString('epaperReport', "text"),
                         GetSQLValueString($tabReport_title[$j], "text"),
                         GetSQLValueString($tabReport_content[$j], "text"),
                         GetSQLValueString($j+1, "int"));
    
            mysql_select_db($database_connect2data, $connect2data);
            $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
      }

      
    }

  }else{//沒資料就全刪

    $deleteSQL = sprintf("DELETE FROM tab_set WHERE tab_type='epaperReport' AND tab_d_id=%s",
               GetSQLValueString($d_id, "int"));
  
    mysql_select_db($database_connect2data, $connect2data);
    $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());

  }
  //----------插入動態 索引與連結 到資料庫end----------

  //----------插入動態 版型 到資料庫begin(須放入插入主資料後)----------

  $deleteSQL = sprintf("DELETE FROM tab_set WHERE (tab_type='epaperTemp1' OR tab_type='epaperTemp2' OR tab_type='epaperTemp3' OR tab_type='epaperTemp4') AND tab_d_id=%s",
                 GetSQLValueString($d_id, "int"));
    
      mysql_select_db($database_connect2data, $connect2data);
      $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());

  if($d_price1==1){
    //版型－窄圖片版

    if(isset($_POST['tabOther1_title']) && isset($_POST['tabOther1_content'])){ //如果有資料
      //tabReport_id
      //先將該ID的tabOther全都刪掉，然後再全新增

      /*$deleteSQL = sprintf("DELETE FROM tab_set WHERE tab_type='epaperTemp1' AND tab_d_id=%s",
                 GetSQLValueString($d_id, "int"));
    
      mysql_select_db($database_connect2data, $connect2data);
      $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());*/

      //全新增
      $tabOther1_title    = $_POST['tabOther1_title'];
      $tabOther1_content  = $_POST['tabOther1_content'];
      $tab_data1          = $_POST['tab_data1'];
      //$tabReport_id = $_POST['tabReport_id'];

      for($j=0; $j<count($tabOther1_title); $j++){

        if($tabOther1_title[$j]!='' && $tabOther1_content[$j]!=''){

          $insertSQL = sprintf("INSERT INTO tab_set (tab_d_id, tab_type, tab_title, tab_content, tab_data1, tab_sort) VALUES (%s, %s, %s, %s, %s, %s)",
                             GetSQLValueString($d_id, "int"),
                             GetSQLValueString("epaperTemp1", "text"),
                             GetSQLValueString($tabOther1_title[$j], "text"),
                             GetSQLValueString($tabOther1_content[$j], "text"),
                             GetSQLValueString($tab_data1[$j], "text"),
                             GetSQLValueString($j+1, "int"));
        
                mysql_select_db($database_connect2data, $connect2data);
                $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
        }/* if */

      }/* for */

    }else{//沒資料就全刪

      $deleteSQL = sprintf("DELETE FROM tab_set WHERE tab_type='epaperTemp1' AND tab_d_id=%s",
                 GetSQLValueString($d_id, "int"));
    
      mysql_select_db($database_connect2data, $connect2data);
      $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());

    }
    //版型－窄圖片版

  }elseif($d_price1==2){
    //版型－寬圖片版型

    if(isset($_POST['tabOther2_title']) && isset($_POST['tabOther2_content'])){ //如果有資料
      //tabReport_id
      //先將該ID的tabOther全都刪掉，然後再全新增

      /*$deleteSQL = sprintf("DELETE FROM tab_set WHERE tab_type='epaperTemp2' AND tab_d_id=%s",
                 GetSQLValueString($d_id, "int"));
    
      mysql_select_db($database_connect2data, $connect2data);
      $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());*/

      //全新增
      $tabOther2_title    = $_POST['tabOther2_title'];
      $tabOther2_content  = $_POST['tabOther2_content'];
      $tab_data2          = $_POST['tab_data2'];
      //$tabReport_id = $_POST['tabReport_id'];

      for($j=0; $j<count($tabOther2_title); $j++){

        if($tabOther2_title[$j]!='' && $tabOther2_content[$j]!=''){

          $insertSQL = sprintf("INSERT INTO tab_set (tab_d_id, tab_type, tab_title, tab_content, tab_data1, tab_sort) VALUES (%s, %s, %s, %s, %s, %s)",
                             GetSQLValueString($d_id, "int"),
                             GetSQLValueString("epaperTemp2", "text"),
                             GetSQLValueString($tabOther2_title[$j], "text"),
                             GetSQLValueString($tabOther2_content[$j], "text"),
                             GetSQLValueString($tab_data2[$j], "text"),
                             GetSQLValueString($j+1, "int"));
        
                mysql_select_db($database_connect2data, $connect2data);
                $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
        }/* if */

      }/* for */

    }else{//沒資料就全刪

      $deleteSQL = sprintf("DELETE FROM tab_set WHERE tab_type='epaperTemp2' AND tab_d_id=%s",
                 GetSQLValueString($d_id, "int"));
    
      mysql_select_db($database_connect2data, $connect2data);
      $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());

    }
    //版型－寬圖片版型

  }elseif($d_price1==3){
    //版型－綜合圖片版型
    //寬圖片
    if(isset($_POST['tabOther3_title']) && isset($_POST['tabOther3_content'])){ //如果有資料
      //tabReport_id
      //先將該ID的tabOther全都刪掉，然後再全新增

      /*$deleteSQL = sprintf("DELETE FROM tab_set WHERE tab_type='epaperTemp3' AND tab_d_id=%s",
                 GetSQLValueString($d_id, "int"));
    
      mysql_select_db($database_connect2data, $connect2data);
      $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());*/

      //全新增
      $tabOther3_title    = $_POST['tabOther3_title'];
      $tabOther3_content  = $_POST['tabOther3_content'];
      $tab_data3          = $_POST['tab_data3'];
      //$tabReport_id = $_POST['tabReport_id'];

      for($j=0; $j<count($tabOther3_title); $j++){

        if($tabOther3_title[$j]!='' && $tabOther3_content[$j]!=''){

          $insertSQL = sprintf("INSERT INTO tab_set (tab_d_id, tab_type, tab_title, tab_content, tab_data1, tab_sort) VALUES (%s, %s, %s, %s, %s, %s)",
                             GetSQLValueString($d_id, "int"),
                             GetSQLValueString("epaperTemp3", "text"),
                             GetSQLValueString($tabOther3_title[$j], "text"),
                             GetSQLValueString($tabOther3_content[$j], "text"),
                             GetSQLValueString($tab_data3[$j], "text"),
                             GetSQLValueString($j+1, "int"));
        
                mysql_select_db($database_connect2data, $connect2data);
                $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
        }/* if */

      }/* for */

    }else{//沒資料就全刪

      $deleteSQL = sprintf("DELETE FROM tab_set WHERE tab_type='epaperTemp4' AND tab_d_id=%s",
                 GetSQLValueString($d_id, "int"));
    
      mysql_select_db($database_connect2data, $connect2data);
      $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());

    }
    //寬圖片
    //窄圖片
    if(isset($_POST['tabOther4_title']) && isset($_POST['tabOther4_content'])){ //如果有資料
      //tabReport_id
      //先將該ID的tabOther全都刪掉，然後再全新增

      /*$deleteSQL = sprintf("DELETE FROM tab_set WHERE tab_type='epaperTemp4' AND tab_d_id=%s",
                 GetSQLValueString($d_id, "int"));
    
      mysql_select_db($database_connect2data, $connect2data);
      $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());*/

      //全新增
      $tabOther4_title    = $_POST['tabOther4_title'];
      $tabOther4_content  = $_POST['tabOther4_content'];
      $tab_data4          = $_POST['tab_data4'];
      //$tabReport_id = $_POST['tabReport_id'];

      for($j=0; $j<count($tabOther4_title); $j++){

        if($tabOther4_title[$j]!='' && $tabOther4_content[$j]!=''){

          $insertSQL = sprintf("INSERT INTO tab_set (tab_d_id, tab_type, tab_title, tab_content, tab_data1, tab_sort) VALUES (%s, %s, %s, %s, %s, %s)",
                             GetSQLValueString($d_id, "int"),
                             GetSQLValueString("epaperTemp4", "text"),
                             GetSQLValueString($tabOther4_title[$j], "text"),
                             GetSQLValueString($tabOther4_content[$j], "text"),
                             GetSQLValueString($tab_data4[$j], "text"),
                             GetSQLValueString($j+1, "int"));
        
                mysql_select_db($database_connect2data, $connect2data);
                $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
        }/* if */

      }/* for */

    }else{//沒資料就全刪

      $deleteSQL = sprintf("DELETE FROM tab_set WHERE tab_type='epaperTemp3' AND tab_d_id=%s",
                 GetSQLValueString($d_id, "int"));
    
      mysql_select_db($database_connect2data, $connect2data);
      $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());

    }
    //窄圖片
    //版型－綜合圖片版型
  }
	
  $updateGoTo = "epaper_list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
	 $updateGoTo .= $_SERVER['QUERY_STRING']."&pageNum_RecEpaper=".$_SESSION["ToPage"];
  }
  header(sprintf("Location: %s", $updateGoTo));
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


 $menu_is="epaper";
  //記錄帶資料去別地方的資訊
  $_SESSION['nowPage']=$selfPage;
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
<link rel="stylesheet" href="jquery/chosen_v1.0.0/chosen.css">
<script type="text/javascript" src="jquery/fancyapps-fancyBox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="jquery/fancyapps-fancyBox/source/jquery.fancybox.pack.js"></script>
<link rel="stylesheet" type="text/css" href="jquery/fancyapps-fancyBox/source/jquery.fancybox.css" media="screen" />

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
          <td width="30%" class="list_title">修改電子報</td>
          <td width="70%">&nbsp;</td>
        </tr>
      </table>
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="image/spacer.gif" width="1" height="1"></td>
        </tr>
      </table>
      
      <form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1" id="form1">

      <div class="groupBtn">
      <?php 

        $reviewLink = "http://".$_SERVER['HTTP_HOST'].$nowFile."/epaper.php?id=".$row_RecEpaper['d_id'];

        if(isset($_SESSION['listLinks']) && $_SESSION['listLinks']!=''){ 
        ?>
          <a href="<?php echo $_SESSION['listLinks'];?>" class="btnType finishBtn">完成</a>
          <a href="<?php echo $reviewLink; ?>" class="btnType pubBtn" target="_blank">預覽</a>
        <?php } ?>

        <p><a href="<?php echo $reviewLink; ?>" class="pubBtn red_letter" target="_blank">預覽網址:<?php echo $reviewLink; ?></a></p>
      </div>

      <table width="100%" border="0" cellspacing="0" cellpadding="0">
  		<tr>
   		 	<td>
            <table width="100%" border="0" cellpadding="5" cellspacing="3">
                  <tr>
                 <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">標題</td>
          	     <td><input name="d_title" type="text" class="table_data" id="d_title" value="<?php echo $row_RecEpaper['d_title']; ?>" size="50">
          	       <input name="d_id" type="hidden" class="table_data" id="d_id" value="<?php echo $row_RecEpaper['d_id']; ?>" /></td>
        	     <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      </tr>

              <tr>
                <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">UID</td>
                <td><input name="d_data1" type="text" class="table_data" id="d_data1" size="50" value="<?php echo $row_RecEpaper['d_data1']; ?>" /></td>
                <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
              </tr>

              <tr>
                <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">英文版網址</td>
                <td><input name="d_data2" type="text" class="table_data" id="d_data2" size="50" value="<?php echo $row_RecEpaper['d_data2']; ?>" /></td>
                <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
              </tr>

              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">版型選擇</td>
                <td class="table_data">
                
                  <div class="radioGroup">
                    <label for="d_price1_1">
                      <input name="d_price1" type="radio" id="d_price1_1" value="1" <?php if (!(strcmp(1, $row_RecEpaper['d_price1']))) {echo 'checked="CHECKED"';} ?> >
                      窄圖片版型
                    </label>
                  </div>

                  <div class="radioGroup">
                    <label for="d_price1_2">
                      <input name="d_price1" type="radio" id="d_price1_2" value="2" <?php if (!(strcmp(2, $row_RecEpaper['d_price1']))) {echo 'checked="CHECKED"';} ?> >
                      寬圖片版型
                    </label>
                  </div>

                  <div class="radioGroup">
                    <label for="d_price1_3">
                      <input name="d_price1" type="radio" id="d_price1_3" value="3" <?php if (!(strcmp(3, $row_RecEpaper['d_price1']))) {echo 'checked="CHECKED"';} ?> >
                      綜合圖片版型
                    </label>
                  </div>

                </td>
                <td bgcolor="#e5ecf6"><span class="note_letter">*不同版型有各版型之圖片尺寸，請依各圖片尺寸上傳。</span></td>
              </tr>

              </table>

              <table width="100%" border="0" cellspacing="3" cellpadding="5" id="addOtherReportArea">

                <?php
                  if($totalRows_RecTabsReport>0){ 
                    $i=1;
                    do{
                ?>
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">索引-標題<?php echo $i; ?></td>
                  <td><input name="tabReport_title[]" type="text" class="table_data" id="tabReport_title<?php echo $i; ?>" value="<?php echo $row_RecTabsReport['tab_title']; ?>" size="70" />

                    <input name="tabReport_id" type="hidden" class="table_data" id="tabReport_id<?php echo $i; ?>" value="<?php echo $row_RecTabsReport['tab_id']; ?>" />
                  </td>
                  <td width="250" bgcolor="#e5ecf6"><p class="red_letter">*請直接填寫索引標題。</p></td>
                </tr>


                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">索引-連結<?php echo $i; ?></td>
                  <td>
                    <input name="tabReport_content[]" type="text" class="table_data" id="tabReport_content<?php echo $i; ?>" value="<?php echo $row_RecTabsReport['tab_content']; ?>" size="70" />
                  </td>
                <td width="250" bgcolor="#e5ecf6"><p class="red_letter">*請直接填寫索引連結。</p></td>
                </tr>
                <?php 
                    $i++;
                    } while ($row_RecTabsReport = mysql_fetch_assoc($RecTabsReport));
                  }
                ?>

              </table>

              <table width="100%" border="0" cellspacing="3" cellpadding="5" >
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title"></td>
                  <td>
                    <table border="0" cellspacing="2" cellpadding="2">
                      <tr>
                          <td><a href="javascript:;" class="addReportTage"><img src="image/add.png" width="16" height="16" border="0"></a></td>
                            <td><a href="javascript:;" class="table_data addReportTage">新增索引</a></td>
                            <td class="red_letter">&nbsp;</td>
                        </tr>
                    </table>
                  </td>
                <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                </tr>
              </table>

              <table width="100%" border="0" cellspacing="3" cellpadding="5" >
                <?php if ($totalRows_RecImage > 0) { // Show if recordset not empty ?>

                  <tr>
                    <td align="center" bgcolor="#e5ecf6" class="table_col_title">目前窄圖片<a name="imageEdit" id="imageEdit"></a></td>
                    <td><?php do { ?>
                    <?php 
                    $actual_link = 'http://'.$_SERVER['HTTP_HOST'].$nowFile.'/'.$row_RecImage['file_link1'];
                    ?>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="100" rowspan="2" align="center"><a href="../<?php echo $row_RecImage['file_link1'].'?'.(mt_rand(1,100000)/100000); ?>" class="fancyboxImg" rel="group" title="<?php echo $row_RecImage['file_title']; ?>"><img src="../<?php echo $row_RecImage['file_link2'].'?'.(mt_rand(1,100000)/100000); ?>" alt="" class="image_frame"/></a></td>
                              <td align="left" class="table_data"><div class="imgNot"><div>圖片網址：</div><?php echo $actual_link; ?></div></td>
                              </tr>
                          <tr>
                            <td align="left" class="table_data">&nbsp;</td>
                              </tr>
                          <tr>
                            <td align="center"><a href="image_edit.php?type=imageShort&file_id=<?php echo $row_RecImage['file_id']; ?>" class="fancyboxEdit" title="修改圖片"><img src="image/media_edit.gif" width="16" height="16" title="修改圖片"/></a><a href="image_del.php?type=imageShort&file_id=<?php echo $row_RecImage['file_id']; ?>" class="fancyboxEdit" title="刪除圖片"><img src="image/media_delete.gif" width="16" height="16" title="刪除圖片"/></a></td>
                                            <td align="center">&nbsp;</td>
                                </tr>
                        </table>
                        <?php } while ($row_RecImage = mysql_fetch_assoc($RecImage)); ?></td>
                    <td bgcolor="#e5ecf6" class="table_col_title"><p class="red_letter">*<?php echo $imagesSize["epaperShort1"]['note'];?></p>
                      </td>
                  </tr>
                  <?php } // Show if recordset not empty ?>
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳窄圖片</p>                    </td>
                    <td>
                    <table width="100%" border="0" cellpadding="2" cellspacing="2" bordercolor="#CCCCCC" class="data" id="pTable">
                      <tr>
                        <td> <span class="table_data">選擇圖片：</span>
                          <input name="image[]" type="file" class="table_data" id="image1" />
                          </td>
                      </tr>
                    </table>
                    <table width="100%" border="0" cellspacing="5" cellpadding="2">
                      <tr>
                          <td height="28">
                          <table border="0" cellspacing="2" cellpadding="2">
                            <tr>
                                <td><a href="javascript:addField()"><img src="image/add.png" width="16" height="16" border="0"></a></td>
                                  <td><a href="javascript:addField()" class="table_data">新增窄圖片</a></td>
                                  <td class="red_letter">&nbsp;</td>
                              </tr>
                          </table>
                          </td>
                        </tr>
                    </table>
                    </td>  
                    <td width="250" bgcolor="#e5ecf6" class="table_col_title"><p class="red_letter">*<?php echo $imagesSize["epaperShort1"]['note'];?></p></td>
                </tr>

                <?php if ($totalRows_RecImageLong > 0) { // Show if recordset not empty ?>
                  <tr>
                    <td align="center" bgcolor="#e5ecf6" class="table_col_title">目前寬圖片<a name="imageEdit" id="imageEdit"></a></td>
                    <td><?php do { ?>
                    <?php 
                    $actual_link = 'http://'.$_SERVER['HTTP_HOST'].$nowFile.'/'.$row_RecImageLong['file_link1'];
                    ?>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="100" rowspan="2" align="center"><a href="../<?php echo $row_RecImageLong['file_link1'].'?'.(mt_rand(1,100000)/100000); ?>" class="fancyboxImg" rel="group" title="<?php echo $row_RecImageLong['file_title']; ?>"><img src="../<?php echo $row_RecImageLong['file_link2'].'?'.(mt_rand(1,100000)/100000); ?>" alt="" class="image_frame"/></a></td>
                              <td align="left" class="table_data"><div class="imgNot"><div>圖片網址：</div><?php echo $actual_link; ?></div></td>
                              </tr>
                          <tr>
                            <td align="left" class="table_data">&nbsp;</td>
                              </tr>
                          <tr>
                            <td align="center"><a href="image_edit.php?type=imageLong&file_id=<?php echo $row_RecImageLong['file_id']; ?>" class="fancyboxEdit" title="修改圖片"><img src="image/media_edit.gif" width="16" height="16" title="修改圖片"/></a><a href="image_del.php?type=imageLong&file_id=<?php echo $row_RecImageLong['file_id']; ?>" class="fancyboxEdit" title="刪除圖片"><img src="image/media_delete.gif" width="16" height="16" title="刪除圖片"/></a></td>
                                            <td align="center">&nbsp;</td>
                                </tr>
                        </table>
                        <?php } while ($row_RecImageLong = mysql_fetch_assoc($RecImageLong)); ?></td>
                    <td bgcolor="#e5ecf6" class="table_col_title"><p class="red_letter">*<?php echo $imagesSize["epaperLong1"]['note'];?></p>
                      </td>
                  </tr>
                  <?php } // Show if recordset not empty ?>

                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳寬圖片</p></td>
                    <td>
                    <table width="100%" border="0" cellpadding="2" cellspacing="2" bordercolor="#CCCCCC" class="data" id="pTableLong">
                      <tr>
                        <td> <span class="table_data">選擇圖片：</span>
                          <input name="imageLong[]" type="file" class="table_data" id="imageLong1" />
                          </td>
                      </tr>
                    </table>
                    <table width="100%" border="0" cellspacing="5" cellpadding="2">
                      <tr>
                          <td height="28">
                          <table border="0" cellspacing="2" cellpadding="2">
                            <tr>
                                <td><a href="javascript:addFieldLong()"><img src="image/add.png" width="16" height="16" border="0"></a></td>
                                  <td><a href="javascript:addFieldLong()" class="table_data">新增寬圖片</a></td>
                                  <td class="red_letter">&nbsp;</td>
                              </tr>
                          </table>
                          </td>
                        </tr>
                    </table>
                    </td>  
                    <td width="250" bgcolor="#e5ecf6" class="table_col_title"><p class="red_letter">*<?php echo $imagesSize["epaperLong1"]['note'];?></p></td>
                </tr>
              </table>


              <!-- 版型－窄圖片版 -->
              <div id="temp1">
                <table width="100%" border="0" cellspacing="3" cellpadding="5" id="addAreaOther1">

                  <?php
                    if($totalRows_RecTabOther1>0){ 
                      $i=1;
                      do{
                  ?>

                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">窄圖片版型區塊-標題<?php echo $i; ?></td>
                    <td><input name="tabOther1_title[]" type="text" class="table_data" id="tabOther1_title<?php echo $i; ?>" value="<?php echo $row_RecTabOther1['tab_title']; ?>" size="70" />

                    <input name="tabOther1_id" type="hidden" class="table_data" id="tabOther1_id<?php echo $i; ?>" value="<?php echo $row_RecTabOther1['tab_id']; ?>" />
                      </td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">窄圖片版型區塊-內容<?php echo $i; ?></td>
                    <td><textarea name="tabOther1_content[]" cols="100" rows="20" class="table_data tinyNoP" id="tabOther1_content<?php echo $i; ?>"><?php echo $row_RecTabOther1['tab_content']; ?></textarea></td>
                    <td width="250" bgcolor="#e5ecf6"><span class="note_letter">*小斷行請按Shift+Enter。</span></td>
                  </tr>


                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">上傳窄圖片<?php echo $i; ?></td>
                    <td><textarea name="tab_data1[]" cols="100" rows="20" class="table_data tinyImg" id="tab_data1_<?php echo $i; ?>"><?php echo $row_RecTabOther1['tab_data1']; ?></textarea></td>
                    <td width="250" bgcolor="#e5ecf6"><span class="note_letter">*<?php echo $imagesSize["epaperShort1"]['note'];?></span></td>
                  </tr>

                  <?php 
                      $i++;
                      } while ($row_RecTabOther1 = mysql_fetch_assoc($RecTabOther1));
                    }else{
                  ?>
                    <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">窄圖片版型區塊-標題1</td>
                    <td><input name="tabOther1_title[]" type="text" class="table_data" id="tabOther1_title1" value="" size="70" />
                    <input name="tabOther1_id" type="hidden" class="table_data" id="tabOther1_id1" value="" />
                      </td>
                    <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">窄圖片版型區塊-內容1</td>
                    <td><textarea name="tabOther1_content[]" cols="100" rows="20" class="table_data tinyNoP" id="tabOther1_content1"></textarea></td>
                    <td width="250" bgcolor="#e5ecf6"><span class="note_letter">*小斷行請按Shift+Enter。</span></td>
                  </tr>


                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">上傳窄圖片1</td>
                    <td><textarea name="tab_data1[]" cols="100" rows="20" class="table_data tinyImg" id="tab_data1_1"></textarea></td>
                    <td width="250" bgcolor="#e5ecf6"><span class="note_letter">*<?php echo $imagesSize["epaperShort1"]['note'];?></span></td>
                  </tr>

                  <?php } ?>


                  <?php if(0){ ?>
                  <!-- <tr>
                    <td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳窄圖片1</p></td>
                      <td>
                        <span class="table_data">選擇圖片：</span>
                        <input name="imageShort[]" type="file" class="table_data" id="imageShort1" />
                        <br>
                        <span class="table_data">圖片說明：</span>
                        <input name="imageShort_title[]" type="text" class="table_data" id="imageShort_title1">
                      </td>  
                      <td bgcolor="#e5ecf6" class="table_col_title">
                      <p class="red_letter">*<?php //echo $imagesSize["epaperShort1"]['note'];?></p>
                      </td>
                  </tr> -->
                  <?php } ?>
                </table>

                <table width="100%" border="0" cellspacing="3" cellpadding="5" >
                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title"></td>
                    <td>
                      <table border="0" cellspacing="2" cellpadding="2">
                        <tr>
                            <td><a href="javascript:;" class="addTageOther1"><img src="image/add.png" width="16" height="16" border="0"></a></td>
                              <td><a href="javascript:;" class="table_data addTageOther1">新增區塊</a></td>
                              <td class="red_letter">&nbsp;</td>
                          </tr>
                      </table>
                    </td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                  </tr>
                </table>
              </div>
              <!-- #temp1 版型－窄圖片版 -->

              <!-- 版型－寬圖片版型 -->
              <div id="temp2">
                <table width="100%" border="0" cellspacing="3" cellpadding="5" id="addAreaOther2">

                <?php
                    if($totalRows_RecTabOther2>0){ 
                      $i=1;
                      do{
                  ?>
                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">寬圖片版型區塊-標題<?php echo $i; ?></td>
                    <td><input name="tabOther2_title[]" type="text" class="table_data" id="tabOther2_title<?php echo $i; ?>" value="<?php echo $row_RecTabOther2['tab_title']; ?>" size="70" />

                    <input name="tabOther2_id" type="hidden" class="table_data" id="tabOther2_id<?php echo $i; ?>" value="<?php echo $row_RecTabOther2['tab_id']; ?>" />
                      </td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">寬圖片版型區塊-內容<?php echo $i; ?></td>
                    <td><textarea name="tabOther2_content[]" cols="100" rows="20" class="table_data tinyNoP" id="tabOther2_content<?php echo $i; ?>"><?php echo $row_RecTabOther2['tab_content']; ?></textarea></td>
                    <td width="250" bgcolor="#e5ecf6"><span class="note_letter">*小斷行請按Shift+Enter。</span></td>
                  </tr>

                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">上傳寬圖片<?php echo $i; ?></td>
                    <td><textarea name="tab_data2[]" cols="100" rows="20" class="table_data tinyImg" id="tab_data2_<?php echo $i; ?>"><?php echo $row_RecTabOther2['tab_data1']; ?></textarea></td>
                    <td width="250" bgcolor="#e5ecf6"><span class="note_letter">*<?php echo $imagesSize["epaperLong1"]['note'];?></span></td>
                  </tr>


                  <?php 
                      $i++;
                      } while ($row_RecTabOther2 = mysql_fetch_assoc($RecTabOther2));
                    }else{
                  ?>

                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">寬圖片版型區塊-標題1</td>
                    <td><input name="tabOther2_title[]" type="text" class="table_data" id="tabOther2_title1" value="" size="70" />
                    <input name="tabOther2_id" type="hidden" class="table_data" id="tabOther2_id1" value="" />
                      </td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">寬圖片版型區塊-內容1</td>
                    <td><textarea name="tabOther2_content[]" cols="100" rows="20" class="table_data tinyNoP" id="tabOther2_content1"></textarea></td>
                    <td width="250" bgcolor="#e5ecf6"><span class="note_letter">*小斷行請按Shift+Enter。</span></td>
                  </tr>

                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">上傳寬圖片1</td>
                    <td><textarea name="tab_data2[]" cols="100" rows="20" class="table_data tinyImg" id="tab_data2_1"></textarea></td>
                    <td width="250" bgcolor="#e5ecf6"><span class="note_letter">*<?php echo $imagesSize["epaperLong1"]['note'];?></span></td>
                  </tr>

                  <?php } ?>

                  <?php if(0){ ?>
                  <!-- <tr>
                    <td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳寬圖片1</p></td>
                      <td>
                        <span class="table_data">選擇圖片：</span>
                        <input name="imageLong[]" type="file" class="table_data" id="imageLong1" />
                        <br>
                        <span class="table_data">圖片說明：</span>
                        <input name="imageLong_title[]" type="text" class="table_data" id="imageLong_title1">
                      </td>  
                      <td bgcolor="#e5ecf6" class="table_col_title">
                      <p class="red_letter">*<?php //echo $imagesSize["epaperLong1"]['note'];?></p>
                      </td>
                  </tr> -->
                  <?php } ?>
                </table>

                <table width="100%" border="0" cellspacing="3" cellpadding="5" >
                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title"></td>
                    <td>
                      <table border="0" cellspacing="2" cellpadding="2">
                        <tr>
                            <td><a href="javascript:;" class="addTageOther2"><img src="image/add.png" width="16" height="16" border="0"></a></td>
                              <td><a href="javascript:;" class="table_data addTageOther2">新增區塊</a></td>
                              <td class="red_letter">&nbsp;</td>
                          </tr>
                      </table>
                    </td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                  </tr>
                </table>
              </div>
              <!-- #temp2 版型－寬圖片版 -->

              <!-- 版型－綜合圖片版型 -->
              <div id="temp3">
                <table width="100%" border="0" cellspacing="3" cellpadding="5" id="addAreaOther3">
                <?php
                    if($totalRows_RecTabOther3>0){ 
                      $i=1;
                      do{
                  ?>
                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">綜合圖片版型-寬圖片區塊-標題<?php echo $i; ?></td>
                    <td><input name="tabOther3_title[]" type="text" class="table_data" id="tabOther3_title<?php echo $i; ?>" value="<?php echo $row_RecTabOther3['tab_title']; ?>" size="70" />

                    <input name="tabOther3_id" type="hidden" class="table_data" id="tabOther3_id<?php echo $i; ?>" value="<?php echo $row_RecTabOther3['tab_id']; ?>" />
                      </td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">綜合圖片版型-寬圖片區塊-內容<?php echo $i; ?></td>
                    <td><textarea name="tabOther3_content[]" cols="100" rows="20" class="table_data tinyNoP" id="tabOther3_content<?php echo $i; ?>"><?php echo $row_RecTabOther3['tab_content']; ?></textarea></td>
                    <td width="250" bgcolor="#e5ecf6"><span class="note_letter">*小斷行請按Shift+Enter。</span></td>
                  </tr>

                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">上傳寬圖片<?php echo $i; ?></td>
                    <td><textarea name="tab_data3[]" cols="100" rows="20" class="table_data tinyImg" id="tab_data3_<?php echo $i; ?>"><?php echo $row_RecTabOther3['tab_data1']; ?></textarea></td>
                    <td width="250" bgcolor="#e5ecf6"><span class="note_letter">*<?php echo $imagesSize["epaperLong1"]['note'];?></span></td>
                  </tr>
                  <?php 
                      $i++;
                      } while ($row_RecTabOther3 = mysql_fetch_assoc($RecTabOther3));
                    }else{
                  ?>

                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">綜合圖片版型-寬圖片區塊-標題1</td>
                    <td><input name="tabOther3_title[]" type="text" class="table_data" id="tabOther3_title1" value="" size="70" />
                    <input name="tabOther3_id" type="hidden" class="table_data" id="tabOther3_id1" value="" />
                      </td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">綜合圖片版型-寬圖片區塊-內容1</td>
                    <td><textarea name="tabOther3_content[]" cols="100" rows="20" class="table_data tinyNoP" id="tabOther3_content1"></textarea></td>
                    <td width="250" bgcolor="#e5ecf6"><span class="note_letter">*小斷行請按Shift+Enter。</span></td>
                  </tr>

                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">上傳寬圖片1</td>
                    <td><textarea name="tab_data3[]" cols="100" rows="20" class="table_data tinyImg" id="tab_data3_1"></textarea></td>
                    <td width="250" bgcolor="#e5ecf6"><span class="note_letter">*<?php echo $imagesSize["epaperLong1"]['note'];?></span></td>
                  </tr>

                  <?php } ?>

                  <?php if(0){ ?>
                  <!-- <tr>
                    <td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳寬圖片1</p></td>
                      <td>
                        <span class="table_data">選擇圖片：</span>
                        <input name="imageLong[]" type="file" class="table_data" id="imageLong1" />
                        <br>
                        <span class="table_data">圖片說明：</span>
                        <input name="imageLong_title[]" type="text" class="table_data" id="imageLong_title1">
                      </td>  
                      <td bgcolor="#e5ecf6" class="table_col_title">
                      <p class="red_letter">*<?php //echo $imagesSize["epaperLong1"]['note'];?></p>
                      </td>
                  </tr> -->
                  <?php } ?>
                </table>

                <table width="100%" border="0" cellspacing="3" cellpadding="5" >
                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title"></td>
                    <td>
                      <table border="0" cellspacing="2" cellpadding="2">
                        <tr>
                            <td><a href="javascript:;" class="addTageOther3"><img src="image/add.png" width="16" height="16" border="0"></a></td>
                              <td><a href="javascript:;" class="table_data addTageOther3">新增寬圖片區塊</a></td>
                              <td class="red_letter">&nbsp;</td>
                          </tr>
                      </table>
                    </td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                  </tr>
                </table>

                <table width="100%" border="0" cellspacing="3" cellpadding="5" id="addAreaOther4">

                <?php
                    if($totalRows_RecTabOther4>0){ 
                      $i=1;
                      do{
                  ?>
                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">綜合圖片版型-窄圖片區塊-標題<?php echo $i; ?></td>
                    <td><input name="tabOther4_title[]" type="text" class="table_data" id="tabOther4_title<?php echo $i; ?>" value="<?php echo $row_RecTabOther4['tab_title']; ?>" size="70" />

                    <input name="tabOther4_id" type="hidden" class="table_data" id="tabOther4_id<?php echo $i; ?>" value="<?php echo $row_RecTabOther4['tab_id']; ?>" />
                      </td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">綜合圖片版型-窄圖片區塊-內容<?php echo $i; ?></td>
                    <td><textarea name="tabOther4_content[]" cols="100" rows="20" class="table_data tinyNoP" id="tabOther4_content<?php echo $i; ?>"><?php echo $row_RecTabOther4['tab_content']; ?></textarea></td>
                    <td width="250" bgcolor="#e5ecf6"><span class="note_letter">*小斷行請按Shift+Enter。</span></td>
                  </tr>

                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">上傳窄圖片<?php echo $i; ?></td>
                    <td><textarea name="tab_data4[]" cols="100" rows="20" class="table_data tinyImg" id="tab_data4_<?php echo $i; ?>"><?php echo $row_RecTabOther4['tab_data1']; ?></textarea></td>
                    <td width="250" bgcolor="#e5ecf6"><span class="note_letter">*<?php echo $imagesSize["epaperShort1"]['note'];?></span></td>
                  </tr>

                  <?php 
                      $i++;
                      } while ($row_RecTabOther4 = mysql_fetch_assoc($RecTabOther4));
                    }else{
                  ?>

                    <tr>
                      <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">綜合圖片版型-窄圖片區塊-標題1</td>
                      <td><input name="tabOther4_title[]" type="text" class="table_data" id="tabOther4_title1" value="" size="70" />
                      <input name="tabOther4_id" type="hidden" class="table_data" id="tabOther4_id1" value="" />
                        </td>
                    <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">綜合圖片版型-窄圖片區塊-內容1</td>
                      <td><textarea name="tabOther4_content[]" cols="100" rows="20" class="table_data tinyNoP" id="tabOther4_content1"></textarea></td>
                      <td width="250" bgcolor="#e5ecf6"><span class="note_letter">*小斷行請按Shift+Enter。</span></td>
                    </tr>

                    <tr>
                      <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">上傳窄圖片1</td>
                      <td><textarea name="tab_data4[]" cols="100" rows="20" class="table_data tinyImg" id="tab_data4_1"></textarea></td>
                      <td width="250" bgcolor="#e5ecf6"><span class="note_letter">*<?php echo $imagesSize["epaperShort1"]['note'];?></span></td>
                    </tr>

                  <?php } ?>

                  <?php if(0){ ?>
                  <!-- <tr>
                    <td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳窄圖片1</p></td>
                      <td>
                        <span class="table_data">選擇圖片：</span>
                        <input name="imageShort[]" type="file" class="table_data" id="imageShort1" />
                        <br>
                        <span class="table_data">圖片說明：</span>
                        <input name="imageShort_title[]" type="text" class="table_data" id="imageShort_title1">
                      </td>  
                      <td bgcolor="#e5ecf6" class="table_col_title">
                      <p class="red_letter">*<?php //echo $imagesSize["epaperShort1"]['note'];?></p>
                      </td>
                  </tr> -->
                  <?php } ?>
                </table>

                <table width="100%" border="0" cellspacing="3" cellpadding="5" >
                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title"></td>
                    <td>
                      <table border="0" cellspacing="2" cellpadding="2">
                        <tr>
                            <td><a href="javascript:;" class="addTageOther4"><img src="image/add.png" width="16" height="16" border="0"></a></td>
                              <td><a href="javascript:;" class="table_data addTageOther4">新增窄圖片區塊</a></td>
                              <td class="red_letter">&nbsp;</td>
                          </tr>
                      </table>
                    </td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                  </tr>
                </table>

              </div>
              <!-- #temp3 版型－綜合圖片版 -->
              
              <table width="100%" border="0" cellspacing="3" cellpadding="5" >
              <tr>
                 <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">加入時間</td>
          	     <td class="table_data"><input name="d_date" type="text" class="table_data" id="d_date" value="<?php echo $row_RecEpaper['d_date']; ?>" size="50"></td>
        	     <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      </tr>
              <tr>
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title">在網頁顯示</td>
                  <td><label>
                    <select name="d_active" class="table_data" id="d_active">
                      <option value="0" <?php if (!(strcmp(0, $row_RecEpaper['d_active']))) {echo "selected='selected'";} ?>>不公佈</option>
                      <option value="1" <?php if (!(strcmp(1, $row_RecEpaper['d_active']))) {echo "selected='selected'";} ?>>公佈</option>
                    </select>
                  </label></td>
                  <td bgcolor="#e5ecf6">&nbsp;</td>
                </tr>

              <?php if(0){ ?>
              <tr>
                <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">發佈狀態</td>
                <td><label>
                  <select name="d_pub" class="table_data" id="d_pub">
                    <option value="0" <?php if (!(strcmp(0, $row_RecEpaper['d_pub']))) {echo "selected='selected'";} ?>>草稿</option>
                    <option value="1" <?php if (!(strcmp(0, $row_RecEpaper['d_pub']))) {echo "selected='selected'";} ?>>發佈</option>
                  </select></label></td>
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
         <td align="center">
          <input name="submitBtn" type="submit" class="btnType" id="submitBtn" value="送出" />
              <a href="<?php echo $reviewLink; ?>" class="btnType pubBtn" target="_blank">預覽</a>
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

<script src="tinyEpaper.js"></script>

<script type="text/javascript">

function checkSelectTemp(){
  var selV = $("input[name='d_price1']:checked").val();
  //console.log( selV );

  if(selV==1){
    $("#temp1").show();
    $("#temp2").hide();
    $("#temp3").hide();
  }else if(selV==2){
    $("#temp1").hide();
    $("#temp2").show();
    $("#temp3").hide();
  }else if(selV==3){
    $("#temp1").hide();
    $("#temp2").hide();
    $("#temp3").show();
  }
}

function addField() {
  var rowindex = $('#pTable tr').length;
  //console.log(rowindex);
  var myField = $('#image'+rowindex);
  //console.log(myField.val());

  if(myField.val()!=""){
    var newRow = rowindex + 1;
    var addTxt = '<tr><td><span class="table_data">選擇圖片： </span><input name="image[]" type="file" class="table_data" id="image'+newRow+'"></td></tr>';

    $('#pTable').append(addTxt);

  }else{
    alert("尚有未選取之圖片欄位!!");
  }

}

function addFieldLong() {
  var rowindex = $('#pTableLong tr').length;
  //console.log(rowindex);
  var myField = $('#imageLong'+rowindex);
  //console.log(myField.val());

  if(myField.val()!=""){
    var newRow = rowindex + 1;
    var addTxt = '<tr><td><span class="table_data">選擇圖片： </span><input name="imageLong[]" type="file" class="table_data" id="imageLong'+newRow+'"></td></tr>';

    $('#pTableLong').append(addTxt);

  }else{
    alert("尚有未選取之圖片欄位!!");
  }

}

function updateData(){
    //var content = $("#content").val().replace(/&/g, escape("&"));
    var d_id = $('#d_id').val();
    $.ajax({
        type: "POST",
      url: "data_save.php",
      data: $('#form1').serializeArray(),
        success: function(data){
            //nothing
            //alert(data);
          }
     });
}

$(document).ready(function(){

  checkSelectTemp();

    $('input[name="d_price1"]').on('click', function(){
      checkSelectTemp();
    });

   $("a[rel=group]").fancybox({
      autoSize  : true,
      openEffect  : 'elastic',
        closeEffect : 'elastic',
       helpers : {
        overlay : {
          css : {
            'background' : 'rgba(0, 0, 0, 0.7)'
          }
        }
      }
  });
  $("a.fancyboxEdit").fancybox({
    type: 'ajax',   
    openEffect  : 'fade',
    closeEffect : 'fade',
    autoSize  : true,
     helpers : {
      overlay : {
        css : {
          'background' : 'rgba(0, 0, 0, 0.7)'
        }
      }
    },
    beforeShow  : function() {
      //updateData();
    }
  });


  $('.addTage').on('click', function(){
    var rowindex = (($('#addArea tr').length)/3)+1;
    //var rowindex = $("#addArea").closest('tr').index();
    // console.debug('rowindex', rowindex);
    // console.log('rowindex', rowindex);
    console.log("tab_title = "+ $("#tab_title"+(rowindex-1)).val());
    console.log("tab_content = "+ $("#tab_content"+(rowindex-1)).val());

    if( ($("#tab_title"+(rowindex-1)).val()=="") || ($("#tab_content"+(rowindex-1)).val()=="") ){
      alert("尚有外部相關影音標題或連結未填寫!!");
    }else{
      //var addTxt = '<tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">外部相關影音連結'+rowindex+'</td><td><input name="tab_title[]" type="text" class="table_data" id="tab_title'+rowindex+'" value="" size="70" /></td><td width="250" bgcolor="#e5ecf6">&nbsp;</td></tr>';

      //var addTxt = '<tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">外部相關影音連結'+rowindex+'</td><td><input name="tab_content[]" type="text" class="table_data" id="tab_content'+rowindex+'" value="" size="70" /></td><td width="250" bgcolor="#e5ecf6"><p class="red_letter">*請直接填寫外部影音連結。</p></td></tr><tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">外部連結網站名稱'+rowindex+'</td><td><input name="tab_title[]" type="text" class="table_data" id="tab_title'+rowindex+'" value="" size="70" /></td><td width="250" bgcolor="#e5ecf6"><p class="red_letter">*請直接填寫連結網站名稱。</p></td></tr>';

      var addTxt = '<tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">外部相關影音連結-標題'+rowindex+'</td><td><input name="tab_title[]" type="text" class="table_data" id="tab_title'+rowindex+'" value="" size="70" /></td><td width="250" bgcolor="#e5ecf6"><p class="red_letter">*請直接填寫外部影音標題。</p></td></tr><tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">外部相關影音-連結'+rowindex+'</td><td><input name="tab_content[]" type="text" class="table_data" id="tab_content'+rowindex+'" value="" size="70" /></td><td width="250" bgcolor="#e5ecf6"><p class="red_letter">*請直接填寫外部影音連結。</p></td></tr><tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">外部連結-網站名稱'+rowindex+'</td><td><input name="tab_data1[]" type="text" class="table_data" id="tab_data1_'+rowindex+'" value="" size="20" /></td><td width="250" bgcolor="#e5ecf6"><p class="red_letter">*請直接填寫連結網站名稱。</p></td></tr>';

      $('#addArea').append(addTxt);

    }
  });

  $('.addReportTage').on('click', function(){
    var rowindex = (($('#addOtherReportArea tr').length)/2)+1;
    //var rowindex = $("#addArea").closest('tr').index();
    // console.debug('rowindex', rowindex);
    // console.log('rowindex', rowindex);
    console.log("tabReport_title = "+ $("#tabReport_title"+(rowindex-1)).val());
    console.log("tabReport_content = "+ $("#tabReport_content"+(rowindex-1)).val());

    //if( ($("#tabReport_title"+(rowindex-1)).val()=="") || ($("#tabReport_content"+(rowindex-1)).val()=="") ){
    if( ($("#tabReport_title"+(rowindex-1)).val()=="") ){
      alert("尚有索引標題未填寫!!");
    }else{

      var addTxt = '<tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">索引-標題'+rowindex+'</td><td><input name="tabReport_title[]" type="text" class="table_data" id="tabReport_title'+rowindex+'" value="" size="70" /><input name="tabReport_id" type="hidden" class="table_data" id="tabReport_id'+rowindex+'" value="" /></td><td width="250" bgcolor="#e5ecf6"><p class="red_letter">*請直接填寫索引標題。</p></td></tr><tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">索引-連結'+rowindex+'</td><td><input name="tabReport_content[]" type="text" class="table_data" id="tabReport_content'+rowindex+'" value="" size="70" /></td><td width="250" bgcolor="#e5ecf6"><p class="red_letter">*請直接填寫索引連結。</p></td></tr>';

      $('#addOtherReportArea').append(addTxt);

    }
  });


  $('.addTageOther1').on('click', function(){
    var rowindex = (($('#addAreaOther1 tr').length)/3)+1;
    //var rowindex = $("#addAreaOther1").closest('tr').index();
    // console.debug('rowindex', rowindex);
    console.log('rowindex', rowindex);
    console.log("tabOther1_title = "+ $("#tabOther1_title"+(rowindex-1)).val());
    console.log("tabOther1_content = "+ $("#tabOther1_content"+(rowindex-1)).val());

    if(( $("#tabOther1_title"+(rowindex-1)).val()=="" ) || ( $("#tabOther1_content"+(rowindex-1)).val()=="" )){
      alert("尚有標題或內容未填寫!!");
    }else{
       /*var addTxt = '<tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">窄圖片版型區塊-標題'+rowindex+'</td><td><input name="tabOther1_title[]" type="text" class="table_data" id="tabOther1_title'+rowindex+'" value="" size="70" /></td><td width="250" bgcolor="#e5ecf6">&nbsp;</td></tr><tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">窄圖片版型區塊-內容'+rowindex+'</td><td><textarea name="tabOther1_content[]" cols="100" rows="20" class="table_data tiny" id="tabOther1_content'+rowindex+'"></textarea></td><td width="250" bgcolor="#e5ecf6"><span class="note_letter">*小斷行請按Shift+Enter。</span></td></tr><tr><td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳窄圖片'+rowindex+'</p></td><td><span class="table_data">選擇圖片：</span><input name="image[]" type="file" class="table_data" id="image'+rowindex+'" /><br><span class="table_data">圖片說明：</span><input name="image_title[]" type="text" class="table_data" id="image_title'+rowindex+'"></td><td bgcolor="#e5ecf6" class="table_col_title"><p class="red_letter">*'+'<?php //echo $imagesSize["epaperShort1"]["note"];?>'+'</p></td></tr>';*/

       var addTxt = '<tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">窄圖片版型區塊-標題'+rowindex+'</td><td><input name="tabOther1_title[]" type="text" class="table_data" id="tabOther1_title'+rowindex+'" value="" size="70" /><input name="tabOther1_id" type="hidden" class="table_data" id="tabOther1_id'+rowindex+'" value="" /></td><td width="250" bgcolor="#e5ecf6">&nbsp;</td></tr><tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">窄圖片版型區塊-內容'+rowindex+'</td><td><textarea name="tabOther1_content[]" cols="100" rows="20" class="table_data tinyNoP" id="tabOther1_content'+rowindex+'"></textarea></td><td width="250" bgcolor="#e5ecf6"><span class="note_letter">*小斷行請按Shift+Enter。</span></td></tr><tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">上傳窄圖片'+rowindex+'</td><td><textarea name="tab_data1[]" cols="100" rows="20" class="table_data tinyImg" id="tab_data1_'+rowindex+'"></textarea></td><td width="250" bgcolor="#e5ecf6"><span class="note_letter">*<?php echo $imagesSize["epaperShort1"]['note'];?></span></td></tr>';

      $('#addAreaOther1').append(addTxt);

      //console.log('tabOther1_content', rowindex);

      //tinyMCE.execCommand('mceFocus', false, 'tabOther1_content' + rowindex); // focus on the last editor
      tinyEpaper('#tabOther1_content' + rowindex);
      tinyEpaperNoImg('#tab_data1_' + rowindex);
    }

  });

  $('.addTageOther2').on('click', function(){
    var rowindex = (($('#addAreaOther2 tr').length)/3)+1;
    //var rowindex = $("#addAreaOther2").closest('tr').index();
    // console.debug('rowindex', rowindex);
    console.log('rowindex', rowindex);
    console.log("tabOther2_title = "+ $("#tabOther2_title"+(rowindex-1)).val());
    console.log("tabOther2_content = "+ $("#tabOther2_content"+(rowindex-1)).val());

    if(( $("#tabOther2_title"+(rowindex-1)).val()=="" ) || ( $("#tabOther2_content"+(rowindex-1)).val()=="" )){
      alert("尚有標題或內容未填寫!!");
    }else{
       /*var addTxt = '<tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">寬圖片版型區塊-標題'+rowindex+'</td><td><input name="tabOther2_title[]" type="text" class="table_data" id="tabOther2_title'+rowindex+'" value="" size="70" /></td><td width="250" bgcolor="#e5ecf6">&nbsp;</td></tr><tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">寬圖片版型區塊-內容'+rowindex+'</td><td><textarea name="tabOther2_content[]" cols="100" rows="20" class="table_data tinyNoP" id="tabOther2_content'+rowindex+'"></textarea></td><td width="250" bgcolor="#e5ecf6"><span class="note_letter">*小斷行請按Shift+Enter。</span></td></tr><tr><td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳寬圖片'+rowindex+'</p></td><td><span class="table_data">選擇圖片：</span><input name="image[]" type="file" class="table_data" id="image'+rowindex+'" /><br><span class="table_data">圖片說明：</span><input name="image_title[]" type="text" class="table_data" id="image_title'+rowindex+'"></td><td bgcolor="#e5ecf6" class="table_col_title"><p class="red_letter">*'+'<?php //echo $imagesSize["epaperLong1"]["note"];?>'+'</p></td></tr>';*/

       var addTxt = '<tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">寬圖片版型區塊-標題'+rowindex+'</td><td><input name="tabOther2_title[]" type="text" class="table_data" id="tabOther2_title'+rowindex+'" value="" size="70" /><input name="tabOther2_id" type="hidden" class="table_data" id="tabOther2_id'+rowindex+'" value="" /></td><td width="250" bgcolor="#e5ecf6">&nbsp;</td></tr><tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">寬圖片版型區塊-內容'+rowindex+'</td><td><textarea name="tabOther2_content[]" cols="100" rows="20" class="table_data tinyNoP" id="tabOther2_content'+rowindex+'"></textarea></td><td width="250" bgcolor="#e5ecf6"><span class="note_letter">*小斷行請按Shift+Enter。</span></td></tr><tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">上傳寬圖片'+rowindex+'</td><td><textarea name="tab_data2[]" cols="100" rows="20" class="table_data tinyImg" id="tab_data2_'+rowindex+'"></textarea></td><td width="250" bgcolor="#e5ecf6"><span class="note_letter">*<?php echo $imagesSize["epaperLong1"]['note'];?></span></td></tr>';


      $('#addAreaOther2').append(addTxt);

      //console.log('tabOther2_content', rowindex);

      //tinyMCE.execCommand('mceFocus', false, 'tabOther2_content' + rowindex); // focus on the last editor
      tinyEpaper('#tabOther2_content' + rowindex);
      tinyEpaperNoImg('#tab_data2_' + rowindex);
    }

  });

  $('.addTageOther3').on('click', function(){
    var rowindex = (($('#addAreaOther3 tr').length)/3)+1;
    //var rowindex = $("#addAreaOther3").closest('tr').index();
    // console.debug('rowindex', rowindex);
    console.log('rowindex', rowindex);
    console.log("tabOther3_title = "+ $("#tabOther3_title"+(rowindex-1)).val());
    console.log("tabOther3_content = "+ $("#tabOther3_content"+(rowindex-1)).val());

    if(( $("#tabOther3_title"+(rowindex-1)).val()=="" ) || ( $("#tabOther3_content"+(rowindex-1)).val()=="" )){
      alert("尚有標題或內容未填寫!!");
    }else{
       /*var addTxt = '<tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">綜合圖片版型-寬圖片區塊-標題'+rowindex+'</td><td><input name="tabOther3_title[]" type="text" class="table_data" id="tabOther3_title'+rowindex+'" value="" size="70" /></td><td width="250" bgcolor="#e5ecf6">&nbsp;</td></tr><tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">綜合圖片版型-寬圖片區塊-內容'+rowindex+'</td><td><textarea name="tabOther3_content[]" cols="100" rows="20" class="table_data tinyNoP" id="tabOther3_content'+rowindex+'"></textarea></td><td width="250" bgcolor="#e5ecf6"><span class="note_letter">*小斷行請按Shift+Enter。</span></td></tr><tr><td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳寬圖片'+rowindex+'</p></td><td><span class="table_data">選擇圖片：</span><input name="image[]" type="file" class="table_data" id="image'+rowindex+'" /><br><span class="table_data">圖片說明：</span><input name="image_title[]" type="text" class="table_data" id="image_title'+rowindex+'"></td><td bgcolor="#e5ecf6" class="table_col_title"><p class="red_letter">*'+'<?php //echo $imagesSize["epaperLong1"]["note"];?>'+'</p></td></tr>';*/

       var addTxt = '<tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">綜合圖片版型-寬圖片區塊-標題'+rowindex+'</td><td><input name="tabOther3_title[]" type="text" class="table_data" id="tabOther3_title'+rowindex+'" value="" size="70" /><input name="tabOther3_id" type="hidden" class="table_data" id="tabOther3_id'+rowindex+'" value="" /></td><td width="250" bgcolor="#e5ecf6">&nbsp;</td></tr><tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">綜合圖片版型-寬圖片區塊-內容'+rowindex+'</td><td><textarea name="tabOther3_content[]" cols="100" rows="20" class="table_data tinyNoP" id="tabOther3_content'+rowindex+'"></textarea></td><td width="250" bgcolor="#e5ecf6"><span class="note_letter">*小斷行請按Shift+Enter。</span></td></tr><tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">上傳寬圖片'+rowindex+'</td><td><textarea name="tab_data3[]" cols="100" rows="20" class="table_data tinyImg" id="tab_data3_'+rowindex+'"></textarea></td><td width="250" bgcolor="#e5ecf6"><span class="note_letter">*<?php echo $imagesSize["epaperLong1"]['note'];?></span></td></tr>';

      $('#addAreaOther3').append(addTxt);

      //console.log('tabOther3_content', rowindex);

      //tinyMCE.execCommand('mceFocus', false, 'tabOther3_content' + rowindex); // focus on the last editor
      tinyEpaper('#tabOther3_content' + rowindex);
      tinyEpaperNoImg('#tab_data3_' + rowindex);
    }

    /*$("#tabOther1_content"+rowindex).load(function(){
      initTinyMce();
    });*/
  });

  $('.addTageOther4').on('click', function(){
    var rowindex = (($('#addAreaOther4 tr').length)/3)+1;
    //var rowindex = $("#addAreaOther4").closest('tr').index();
    // console.debug('rowindex', rowindex);
    console.log('rowindex', rowindex);
    console.log("tabOther4_title = "+ $("#tabOther4_title"+(rowindex-1)).val());
    console.log("tabOther4_content = "+ $("#tabOther4_content"+(rowindex-1)).val());

    if(( $("#tabOther4_title"+(rowindex-1)).val()=="" ) || ( $("#tabOther4_content"+(rowindex-1)).val()=="" )){
      alert("尚有標題或內容未填寫!!");
    }else{
       /*var addTxt = '<tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">綜合圖片版型-窄圖片區塊-標題'+rowindex+'</td><td><input name="tabOther4_title[]" type="text" class="table_data" id="tabOther4_title'+rowindex+'" value="" size="70" /></td><td width="250" bgcolor="#e5ecf6">&nbsp;</td></tr><tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">綜合圖片版型-窄圖片區塊-內容'+rowindex+'</td><td><textarea name="tabOther4_content[]" cols="100" rows="20" class="table_data tinyNoP" id="tabOther4_content'+rowindex+'"></textarea></td><td width="250" bgcolor="#e5ecf6"><span class="note_letter">*小斷行請按Shift+Enter。</span></td></tr><tr><td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳窄圖片'+rowindex+'</p></td><td><span class="table_data">選擇圖片：</span><input name="image[]" type="file" class="table_data" id="image'+rowindex+'" /><br><span class="table_data">圖片說明：</span><input name="image_title[]" type="text" class="table_data" id="image_title'+rowindex+'"></td><td bgcolor="#e5ecf6" class="table_col_title"><p class="red_letter">*'+'<?php //echo $imagesSize["epaperShort1"]["note"];?>'+'</p></td></tr>';*/

       var addTxt = '<tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">綜合圖片版型-窄圖片區塊-標題'+rowindex+'</td><td><input name="tabOther4_title[]" type="text" class="table_data" id="tabOther4_title'+rowindex+'" value="" size="70" /><input name="tabOther4_id" type="hidden" class="table_data" id="tabOther4_id'+rowindex+'" value="" /></td><td width="250" bgcolor="#e5ecf6">&nbsp;</td></tr><tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">綜合圖片版型-窄圖片區塊-內容'+rowindex+'</td><td><textarea name="tabOther4_content[]" cols="100" rows="20" class="table_data tinyNoP" id="tabOther4_content'+rowindex+'"></textarea></td><td width="250" bgcolor="#e5ecf6"><span class="note_letter">*小斷行請按Shift+Enter。</span></td></tr><tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">上傳窄圖片'+rowindex+'</td><td><textarea name="tab_data4[]" cols="100" rows="20" class="table_data tinyImg" id="tab_data4_'+rowindex+'"></textarea></td><td width="250" bgcolor="#e5ecf6"><span class="note_letter">*<?php echo $imagesSize["epaperShort1"]['note'];?></span></td></tr>';


      $('#addAreaOther4').append(addTxt);

      //console.log('tabOther4_content', rowindex);

      //tinyMCE.execCommand('mceFocus', false, 'tabOther4_content' + rowindex); // focus on the last editor
      tinyEpaper('#tabOther4_content' + rowindex);
      tinyEpaperNoImg('#tab_data4_' + rowindex);
    }

    /*$("#tabOther1_content"+rowindex).load(function(){
      initTinyMce();
    });*/
  });

});
</script>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($RecEpaper);
?>
