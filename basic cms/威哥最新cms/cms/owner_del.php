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

if(!in_array(7,$_SESSION['MM_Limit']['a5'])){
	header("Location: owner_list.php");
}

$colname_RecOwner = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecOwner = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecOwner = sprintf("SELECT * FROM term_relationships AS TR, data_set AS D, terms AS T WHERE TR.term_taxonomy_id = T.term_id AND D.d_id = TR.object_id AND D.d_class1='owner' AND D.d_id = %s", GetSQLValueString($colname_RecOwner, "int"));
$RecOwner = mysql_query($query_RecOwner, $connect2data) or die(mysql_error());
$row_RecOwner = mysql_fetch_assoc($RecOwner);
$totalRows_RecOwner = mysql_num_rows($RecOwner);

if($totalRows_RecOwner==0){
  header("Location: owner_list.php");
}

$colname_RecImage = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecImage = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecImage = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'image' ORDER BY file_id DESC", GetSQLValueString($colname_RecImage, "int"));
$RecImage = mysql_query($query_RecImage, $connect2data) or die(mysql_error());
$row_RecImage = mysql_fetch_assoc($RecImage);
$totalRows_RecImage = mysql_num_rows($RecImage);

$G_sel = '';
if (isset($_SESSION['selected_awardT'])){
	$G_sel = $_SESSION['selected_awardT'] = $row_RecOwner['d_class2'];
}

mysql_select_db($database_connect2data, $connect2data);
$query_RecAwardT = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='awardT' AND T.term_active='1' ORDER BY term_sort ASC, term_id DESC";
$RecAwardT = mysql_query($query_RecAwardT, $connect2data) or die(mysql_error());
$row_RecAwardT = mysql_fetch_assoc($RecAwardT);
$totalRows_RecAwardT = mysql_num_rows($RecAwardT);

mysql_select_db($database_connect2data, $connect2data);
$query_RecYears = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='years' AND T.term_active='1'  ORDER BY term_sort ASC, term_id DESC";
$RecYears = mysql_query($query_RecYears, $connect2data) or die(mysql_error());
$row_RecYears = mysql_fetch_assoc($RecYears);
$totalRows_RecYears = mysql_num_rows($RecYears);

mysql_select_db($database_connect2data, $connect2data);
$query_RecMedia = "SELECT * FROM term_relationships AS TR, data_set AS D, terms AS T
WHERE TR.term_taxonomy_id = T.term_id AND D.d_id = TR.object_id AND D.d_class1='media' AND D.d_class3='1' AND D.d_active='1' ORDER BY term_order ASC, d_date DESC";
$RecMedia = mysql_query($query_RecMedia, $connect2data) or die(mysql_error());
$row_RecMedia = mysql_fetch_assoc($RecMedia);
$totalRows_RecMedia = mysql_num_rows($RecMedia);

mysql_select_db($database_connect2data, $connect2data);
$query_RecMediaVideo = "SELECT * FROM term_relationships AS TR, data_set AS D, terms AS T
WHERE TR.term_taxonomy_id = T.term_id AND D.d_id = TR.object_id AND D.d_class1='media' AND D.d_class3='2' AND D.d_active='1' ORDER BY term_order ASC, d_date DESC";
$RecMediaVideo = mysql_query($query_RecMediaVideo, $connect2data) or die(mysql_error());
$row_RecMediaVideo = mysql_fetch_assoc($RecMediaVideo);
$totalRows_RecMediaVideo = mysql_num_rows($RecMediaVideo);

$colname_RecTabs = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecTabs = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecTabs = sprintf("SELECT * FROM tab_set WHERE tab_d_id = %s AND tab_type = 'owner' ORDER BY tab_sort ASC, tab_id ASC", GetSQLValueString($colname_RecTabs, "int"));
$RecTabs = mysql_query($query_RecTabs, $connect2data) or die(mysql_error());
$row_RecTabs = mysql_fetch_assoc($RecTabs);
$totalRows_RecTabs = mysql_num_rows($RecTabs);

$colname_RecTabsReport = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecTabsReport = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecTabsReport = sprintf("SELECT * FROM tab_set WHERE tab_d_id = %s AND tab_type = 'ownerReport' ORDER BY tab_sort ASC, tab_id ASC", GetSQLValueString($colname_RecTabsReport, "int"));
$RecTabsReport = mysql_query($query_RecTabsReport, $connect2data) or die(mysql_error());
$row_RecTabsReport = mysql_fetch_assoc($RecTabsReport);
$totalRows_RecTabsReport = mysql_num_rows($RecTabsReport);
//echo $totalRows_RecTabsReport;

$colname_RecTabsOther = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecTabsOther = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecTabsOther = sprintf("SELECT * FROM tab_set WHERE tab_d_id = %s AND tab_type = 'ownerOther' ORDER BY tab_sort ASC, tab_id ASC", GetSQLValueString($colname_RecTabsOther, "int"));
$RecTabsOther = mysql_query($query_RecTabsOther, $connect2data) or die(mysql_error());
$row_RecTabsOther = mysql_fetch_assoc($RecTabsOther);
$totalRows_RecTabsOther = mysql_num_rows($RecTabsOther);

$menu_is="owner";;

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
            <td width="30%" class="list_title">刪除唐獎得主</td>
            <td width="70%"><span class="no_data">確定刪除以下唐獎得主?</span></td>
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
            	  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">獎項分類</td>
            	  <td class="table_data">
            	    
            	    <ul class="chosen-choices">
            	      <?php
                    do {
                    	$selA = explode(',',$row_RecOwner['d_tag']);
                    	if (in_array($row_RecAwardT['term_id'], $selA)){
                    		echo '<li class="search-choice"><span>'.$row_RecAwardT['name'].'</span></li>';
                    	}

                    } while ($row_RecAwardT = mysql_fetch_assoc($RecAwardT));
                      $rows = mysql_num_rows($RecAwardT);
                      if($rows > 0) {
                          mysql_data_seek($RecAwardT, 0);
                    	  $row_RecAwardT = mysql_fetch_assoc($RecAwardT);
                      }
                    ?>
            	      </ul>
            	    
            	    <input name="d_id" type="hidden" id="d_id" value="<?php echo $row_RecOwner['d_id']; ?>" />
            	    <input name="delsure" type="hidden" id="delsure" value="1" /></td>
            	  <td bgcolor="#e5ecf6">&nbsp;</td>
          	  </tr>

              <tr>
                <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">得獎年份</td>
                <td class="table_data">
                  
                  <ul class="chosen-choices">
                    <?php
                    do {
                      $selA = explode(',',$row_RecOwner['d_class3']);
                      if (in_array($row_RecYears['term_id'], $selA)){
                        echo '<li class="search-choice"><span>'.$row_RecYears['name'].'</span></li>';
                      }

                    } while ($row_RecYears = mysql_fetch_assoc($RecYears));
                      $rows = mysql_num_rows($RecYears);
                      if($rows > 0) {
                          mysql_data_seek($RecYears, 0);
                        $row_RecYears = mysql_fetch_assoc($RecYears);
                      }
                    ?>
                    </ul>
                  
                  </td>
                <td bgcolor="#e5ecf6">&nbsp;</td>
              </tr>

            	<tr>
            	  <td align="center" bgcolor="#e5ecf6" class="table_col_title">姓名</td>
            	  <td class="table_data"><?php echo $row_RecOwner['d_title']; ?></td>
            	  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
          	  </tr>
            	<tr>
            	  <td align="center" bgcolor="#e5ecf6" class="table_col_title">英文姓名</td>
            	  <td class="table_data"><?php echo $row_RecOwner['d_title_en']; ?></td>
            	  <td bgcolor="#e5ecf6">&nbsp;</td>
          	  </tr>
            	<tr>
            	  <td align="center" bgcolor="#e5ecf6" class="table_col_title">列表簡介</td>
            	  <td class="table_data"><?php echo nl2br($row_RecOwner['d_content']); ?></td>
            	  <td bgcolor="#e5ecf6">&nbsp;</td>
          	  </tr>
              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">貢獻概要</td>
                <td class="table_data"><?php echo $row_RecOwner['d_data1']; ?></td>
                <td bgcolor="#e5ecf6">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">簡歷</td>
                <td class="table_data"><?php echo $row_RecOwner['d_data2']; ?></td>
                <td bgcolor="#e5ecf6">&nbsp;</td>
              </tr>

              <tr>
                <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">內部相關報導</td>
                <td class="table_data">
                  
                  <ul class="chosen-choices">
                    <?php
                    do {
                      $selA = explode(',',$row_RecOwner['d_data3']);
                      if (in_array($row_RecMedia['d_id'], $selA)){
                        echo '<li class="search-choice"><span>'.$row_RecMedia['d_title'].'</span></li>';
                      }

                    } while ($row_RecMedia = mysql_fetch_assoc($RecMedia));
                      $rows = mysql_num_rows($RecMedia);
                      if($rows > 0) {
                          mysql_data_seek($RecMedia, 0);
                        $row_RecMedia = mysql_fetch_assoc($RecMedia);
                      }
                    ?>
                    </ul>
                  
                  </td>
                <td bgcolor="#e5ecf6">&nbsp;</td>
              </tr>

              <tr>
                <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">內部相關影音</td>
                <td class="table_data">
                  
                  <ul class="chosen-choices">
                    <?php
                    do {
                      $selA = explode(',',$row_RecOwner['d_data4']);
                      if (in_array($row_RecMediaVideo['d_id'], $selA)){
                        echo '<li class="search-choice"><span>'.$row_RecMediaVideo['d_title'].'</span></li>';
                      }

                    } while ($row_RecMediaVideo = mysql_fetch_assoc($RecMediaVideo));
                      $rows = mysql_num_rows($RecMediaVideo);
                      if($rows > 0) {
                          mysql_data_seek($RecMediaVideo, 0);
                        $row_RecMediaVideo = mysql_fetch_assoc($RecMediaVideo);
                      }
                    ?>
                    </ul>
                  
                  </td>
                <td bgcolor="#e5ecf6">&nbsp;</td>
              </tr>

              <?php //外部報導
                if($totalRows_RecTabsReport>0){ 
                  $i=1;
                  do{
              ?>
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">外部相關報導連結-標題<?php echo $i; ?></td>
                  <td class="table_data"><?php echo $row_RecTabsReport['tab_title']; ?></td>
                  <td width="250" bgcolor="#e5ecf6"></td>
                </tr>


                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">外部相關報導-連結<?php echo $i; ?></td>
                  <td class="table_data"><a href="<?php echo $row_RecTabsReport['tab_content']; ?>" target="_blank"><?php echo $row_RecTabsReport['tab_content']; ?></a></td>
                <td width="250" bgcolor="#e5ecf6"></td>
                </tr>

                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">外部連結-網站名稱<?php echo $i; ?></td>
                  <td class="table_data"><?php echo $row_RecTabsReport['tab_data1']; ?></td>
                <td width="250" bgcolor="#e5ecf6"></td>
                </tr>
              <?php 
                  $i++;
                  } while ($row_RecTabsReport = mysql_fetch_assoc($RecTabsReport));
                }
              ?>

              <?php //外部影音
                if($totalRows_RecTabs>0){ 
                  $i=1;
                  do{
              ?>
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">外部相關影音連結-標題<?php echo $i; ?></td>
                  <td class="table_data"><?php echo $row_RecTabs['tab_title']; ?></td>
                  <td width="250" bgcolor="#e5ecf6"></td>
                </tr>


                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">外部相關影音-連結<?php echo $i; ?></td>
                  <td class="table_data"><a href="<?php echo $row_RecTabs['tab_content']; ?>" target="_blank"><?php echo $row_RecTabs['tab_content']; ?></a></td>
                <td width="250" bgcolor="#e5ecf6"></td>
                </tr>

                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">外部連結-網站名稱<?php echo $i; ?></td>
                  <td class="table_data"><?php echo $row_RecTabs['tab_data1']; ?></td>
                <td width="250" bgcolor="#e5ecf6"></td>
                </tr>
              <?php 
                  $i++;
                  } while ($row_RecTabs = mysql_fetch_assoc($RecTabs));
                }
              ?>


              <?php
                if($totalRows_RecTabsOther>0){ 
                  $i=1;
                  do{
              ?>

                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">頁籤名稱</td>
                  <td class="table_data"><?php echo $row_RecTabsOther['tab_title']; ?></td>
                <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                </tr>
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">頁籤內容</td>
                  <td class="table_data"><?php echo $row_RecTabsOther['tab_content']; ?></td>
                  <td width="250" bgcolor="#e5ecf6"></td>
                </tr>

              <?php 
                  $i++;
                  } while ($row_RecTabsOther = mysql_fetch_assoc($RecTabsOther));
                }
              ?>

                <tr>
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title">時間</td>
                  <td class="table_data"><?php echo date("Y-m-d", strtotime($row_RecOwner['d_date'])); ?></td>
                  <td bgcolor="#e5ecf6">&nbsp;</td>
                </tr>
     	      	<tr>
                  <?php if ($totalRows_RecImage > 0) { // Show if recordset not empty ?>
                    <td align="center" bgcolor="#e5ecf6" class="table_col_title">圖片</td>
                    <td><?php do { ?>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="100" rowspan="2" align="center" height="70"><img src="../<?php echo $row_RecImage['file_link2']; ?>" alt="" class="image_frame"/></td>
                                    <td align="left" class="table_data">&nbsp;圖片說明：<?php echo $row_RecImage['file_title']; ?></td>
                              </tr>
                          <tr>
                            <td align="left" class="table_data">&nbsp;</td>
                              </tr>
                        </table>
                        <?php } while ($row_RecImage = mysql_fetch_assoc($RecImage)); ?></td>
                    <td bgcolor="#e5ecf6" class="table_col_title"><p>&nbsp;</p></td>
                    <?php } // Show if recordset not empty ?>
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

    //外部報導
    $deleteSQL = sprintf("DELETE FROM tab_set WHERE tab_type='ownerownerReport' AND tab_d_id=%s",
               GetSQLValueString($_REQUEST['d_id'], "int"));  
    mysql_select_db($database_connect2data, $connect2data);
    $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());

    //外部影音
    $deleteSQL = sprintf("DELETE FROM tab_set WHERE tab_type='owner' AND tab_d_id=%s",
               GetSQLValueString($_REQUEST['d_id'], "int"));  
    mysql_select_db($database_connect2data, $connect2data);
    $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());

    //----------刪除動態頁籤資料begin----------
    $deleteSQL = sprintf("DELETE FROM tab_set WHERE tab_type='ownerOther' AND tab_d_id=%s",
               GetSQLValueString($_REQUEST['d_id'], "int"));  
    mysql_select_db($database_connect2data, $connect2data);
    $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());
    //----------刪除動態頁籤資料end----------
	  
	  
	  $deleteSQL = sprintf("DELETE FROM term_relationships WHERE object_id=%s",
						   GetSQLValueString($_REQUEST['d_id'], "int"));	
	  mysql_select_db($database_connect2data, $connect2data);
	  $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());	

	  
	  $deleteSQL = sprintf("DELETE FROM data_set WHERE d_id=%s",
						   GetSQLValueString($_REQUEST['d_id'], "int"));	
	  mysql_select_db($database_connect2data, $connect2data);
	  $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());	
      
	   
	  $deleteGoTo = "owner_list.php?delchangeSort=1&sel=".$G_sel;
	  if (isset($_SERVER['QUERY_STRING'])) {
  		$deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
  		$deleteGoTo .= $_SERVER['QUERY_STRING']."&pageNum=".$_SESSION["ToPage"];
	  }
	  header(sprintf("Location: %s", $deleteGoTo));
	}
?>
<?php
mysql_free_result($RecOwner);

mysql_free_result($RecImage);
?>
