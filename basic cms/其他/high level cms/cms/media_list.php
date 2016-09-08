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

if(!in_array(3,$_SESSION['MM_Limit']['a7'])){
	header("Location: first.php");
}

$_SESSION['listLinks'] = NULL;

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RecMedia = 50;
$pageNum = 0;
if (isset($_GET['pageNum'])) {
  $pageNum = $_GET['pageNum'];
}
$startRow_RecMedia = $pageNum * $maxRows_RecMedia;

mysql_select_db($database_connect2data, $connect2data);
$query_RecMediaT = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='mediaT' AND T.term_active='1' ORDER BY term_sort ASC, term_id DESC";
$RecMediaT = mysql_query($query_RecMediaT, $connect2data) or die(mysql_error());
$row_RecMediaT = mysql_fetch_assoc($RecMediaT);
$totalRows_RecMediaT = mysql_num_rows($RecMediaT);

$G_sel = '';
if(isset($_GET['sel']))
{
	$_SESSION['selected_mediaT'] = $G_sel = $_GET['sel'];
}else 
{
	$G_sel = $_SESSION['selected_mediaT'] = $row_RecMediaT['term_id'];
}

mysql_select_db($database_connect2data, $connect2data);
$query_RecMedia = "SELECT * FROM term_relationships AS TR, data_set AS D, terms AS T
WHERE TR.term_taxonomy_id = T.term_id AND D.d_id = TR.object_id AND T.term_id='$G_sel' AND D.d_class1='media' ORDER BY term_order ASC, d_date DESC";
$query_limit_RecMedia = sprintf("%s LIMIT %d, %d", $query_RecMedia, $startRow_RecMedia, $maxRows_RecMedia);
$RecMedia = mysql_query($query_limit_RecMedia, $connect2data) or die(mysql_error());
$row_RecMedia = mysql_fetch_assoc($RecMedia);
//$_SESSION['selected_media']=$G_selected2;
//echo $query_RecMedia;

mysql_select_db($database_connect2data, $connect2data);
$query_RecFarmer = "SELECT * FROM member_set WHERE m_class2='farmer' AND m_active='1' ORDER BY m_id ASC";
$RecFarmer = mysql_query($query_RecFarmer, $connect2data) or die(mysql_error());
$row_RecFarmer = mysql_fetch_assoc($RecFarmer);
$totalRows_RecFarmer = mysql_num_rows($RecFarmer);


if (isset($_GET['totalRows_RecMedia'])) {
  $S_original_selected='';
  if(isset($_SESSION['original_selected'])){
  	$S_original_selected = $_SESSION['original_selected'];
  }
 /*if(isset($_GET['selected2']) && $_GET['selected2']!=''){
	$G_selected2 = $_GET['selected2'];
  } */
	  if($S_original_selected==$G_sel)
		{
			$totalRows_RecMedia = $_GET['totalRows_RecMedia'];
		}else
		{
			$all_RecMedia = mysql_query($query_RecMedia);
 	  		$totalRows_RecMedia = mysql_num_rows($all_RecMedia);
		}
	} else {
	  $all_RecMedia = mysql_query($query_RecMedia);
 	  $totalRows_RecMedia = mysql_num_rows($all_RecMedia);
	}
	$all_RecMedia = mysql_query($query_RecMedia);
 	$totalRows_RecMedia = mysql_num_rows($all_RecMedia);
	$totalPages_RecMedia = ceil($totalRows_RecMedia/$maxRows_RecMedia)-1;
	$TotalPage = $totalPages_RecMedia;

$queryString_RecMedia = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum") == false && 
        stristr($param, "totalRows_RecMedia") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecMedia = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecMedia = sprintf("&totalRows_RecMedia=%d%s", $totalRows_RecMedia, $queryString_RecMedia);
 $menu_is="media";?>
 <?php 
    $R_pageNum = 0;
 if (isset($_REQUEST["pageNum"])) 
 {
 	$R_pageNum = $_REQUEST["pageNum"];
 }
      if (! isset($R_pageNum)) 
      {
	  	$_SESSION["ToPage"]=0;
	  }
 	  //若指定分頁數小於1則預設顯示第一頁
  	  else if ($R_pageNum<0) 
      {
	  	$_SESSION["ToPage"]=0;
      }
	  //若指定指定的分頁超過總分頁數則顯示最後一頁
 	  else if ($R_pageNum>$totalPages_RecMedia)
      {
	  	$_SESSION["ToPage"]=$TotalPage;
	  }
	  else
	  {
	  	$_SESSION["ToPage"]=$R_pageNum;
 	  }
?>
<?php
	//如果指定的頁面大於資料所擁有的頁面,轉到最大的頁面
	if($R_pageNum>$totalPages_RecMedia && $R_pageNum!=0)
	{
		header("Location:media_list.php?pageNum=".$totalPages_RecMedia);
	}

	
?>
  <?php
//修改排序
$G_changeSort = 0;
$G_delchangeSort = 0;
if (isset($_GET['changeSort']))
{
	$G_changeSort = $_GET['changeSort'];
}
if (isset($_GET['delchangeSort']))
{
	$G_delchangeSort = $_GET['delchangeSort'];
}
if ($G_changeSort==1||$G_delchangeSort==1) 
{
	$sort_num=1;
	
	//echo "now_d_id=".$_GET['now_d_id'];
	//echo "change_num=".$_GET['change_num'];
	
	mysql_select_db($database_connect2data, $connect2data);
	
	$query_RecMedia = "SELECT * FROM term_relationships AS TR, data_set AS D, terms AS T
WHERE TR.term_taxonomy_id = T.term_id AND D.d_id = TR.object_id AND T.term_id='$G_sel' AND D.d_class1='media' GROUP BY D.d_id ORDER BY term_order ASC, d_date DESC";
	$_SESSION['selected_mediaT']=$G_sel;
	
	$RecMedia = mysql_query($query_RecMedia, $connect2data) or die(mysql_error());
	$row_RecMedia = mysql_fetch_assoc($RecMedia);
	//echo '<br>query 2 = '.$query_RecMedia.'<br>';

	do{
		//echo 'd_id = >'.$row_RecMedia['d_id'].' term_order =>'.$row_RecMedia['term_order'].', sort_num =>'.$sort_num.'<br>';
		if($row_RecMedia['term_order']==0)
		{}
		else if($row_RecMedia['d_id']==$_GET['now_d_id'])
		{	
			//echo 'sort_num(now_d_id) = '.$sort_num."<br/>";
			
		}else if($sort_num==$_GET['change_num'])
		{
			//echo 'sort_num(change_num) = '.$sort_num."<br/>";
			$sort_num++;
			
			$updateSQL = sprintf("UPDATE term_relationships SET term_order=%s WHERE object_id=%s AND term_taxonomy_id=%s ",
			   GetSQLValueString($sort_num, "int"),
			   GetSQLValueString($row_RecMedia['d_id'], "int"),
			   GetSQLValueString($row_RecMedia['term_id'], "int"));

			mysql_select_db($database_connect2data, $connect2data);
			$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
			
			$sort_num++;
		}
		else
		{
			$updateSQL = sprintf("UPDATE term_relationships SET term_order=%s WHERE object_id=%s AND term_taxonomy_id=%s ",
			   GetSQLValueString($sort_num, "int"),
			   GetSQLValueString($row_RecMedia['d_id'], "int"),
			   GetSQLValueString($row_RecMedia['term_id'], "int"));

			mysql_select_db($database_connect2data, $connect2data);
			$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
			
			echo $sort_num."<br/>";
			echo $row_RecMedia['d_title']."->".$sort_num."<br/>";
			
			$sort_num++;		
		}
		
		
	//echo " ".$row_RecMedia['term_order'].'<br>';
	}while ($row_RecMedia = mysql_fetch_assoc($RecMedia));
	
	
			$updateSQL = sprintf("UPDATE term_relationships SET term_order=%s WHERE object_id=%s AND term_taxonomy_id=%s ",
			   GetSQLValueString($_GET['change_num'], "int"),
			   GetSQLValueString($_GET['now_d_id'], "int"),
			   GetSQLValueString($G_sel, "int"));

			mysql_select_db($database_connect2data, $connect2data);
			$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
			
			//echo $updateSQL;
	if($G_changeSort==1)
	{
		/*if(isset($_GET['selected2']))
		{
		$G_selected2 = $_GET['selected2'];*/
		if(isset($_GET['now_d_id'])){
			header("Location:media_list.php?sel=".$G_sel."&pageNum=".$_GET['pageNum']."&totalRows_RecMedia=".$_GET['totalRows_RecMedia']."#".$_GET['now_d_id']);
		}else{
			header("Location:media_list.php?sel=".$G_sel."&pageNum=".$_GET['pageNum']."&totalRows_RecMedia=".$_GET['totalRows_RecMedia']);
		}
		/*}else
		{
			header("Location:media_list.php?sel=".$row_RecMediaT['term_id']."&pageNum=".$_GET['pageNum']."&totalRows_RecMedia=".$_GET['totalRows_RecMedia']);
		}*/
	
	}else if($G_delchangeSort==1)
	{
		/*if(isset($_GET['selected2']))
		{
		$G_selected2 = $_GET['selected2'];*/
			header("Location:media_list.php?sel=".$G_sel."&pageNum=".$_GET['pageNum']);
		/*}else
		{
			header("Location:media_list.php?selected=".$row_RecMediaT['term_id']."&pageNum=".$_GET['pageNum']);
		}*/
	}
}
//echo 'selected_mediaT = '.$_SESSION['selected_mediaT'];
?>
<?php
//整個排序重整
if (isset($_GET['sortAll']) && $_GET['sortAll']=='sortAll') 
{
	$sort_num=1;
	
	//echo "now_d_id=".$_GET['now_d_id'];
	//echo "change_num=".$_GET['change_num'];
	
	mysql_select_db($database_connect2data, $connect2data);
	
	$query_RecMedia = "SELECT * FROM term_relationships AS TR, data_set AS D, terms AS T
WHERE TR.term_taxonomy_id = T.term_id AND D.d_id = TR.object_id AND T.term_id='$G_sel' AND D.d_class1='media' GROUP BY D.d_id ORDER BY d_date DESC";
	$_SESSION['selected_mediaT']=$G_sel;
	
	$RecMedia = mysql_query($query_RecMedia, $connect2data) or die(mysql_error());
	$row_RecMedia = mysql_fetch_assoc($RecMedia);
	//echo '<br>query 2 = '.$query_RecMedia.'<br>';

	do{
		$updateSQL = sprintf("UPDATE term_relationships SET term_order=%s WHERE object_id=%s AND term_taxonomy_id=%s ",
			   GetSQLValueString($sort_num, "int"),
			   GetSQLValueString($row_RecMedia['d_id'], "int"),
			   GetSQLValueString($row_RecMedia['term_id'], "int"));

			mysql_select_db($database_connect2data, $connect2data);
			$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
			
			//echo $sort_num."<br/>";
			//echo $row_RecMedia['d_title']."->".$sort_num."<br/>";
			
			$sort_num++;
		
		
	//echo " ".$row_RecMedia['term_order'].'<br>';
	}while ($row_RecMedia = mysql_fetch_assoc($RecMedia));
			
			//echo $updateSQL;
	header("Location:media_list.php?sel=".$G_sel);
}
?>
<?php 
require_once('display_page.php');
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
}
.chosen-choices li {
	list-style: none;
}
</style>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<script type="text/javascript">
<!--
function changeSort(pageNum, totalRows_RecMedia, now_d_id, change_num, sel) { //v1.0
 window.location.href="media_list.php?sel="+sel+"&changeSort=1"+"&now_d_id="+now_d_id+"&change_num="+change_num+"&pageNum="+pageNum+"&totalRows_RecMedia="+totalRows_RecMedia;
}
//-->
</script>
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
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
    	<tr>
        	<td width="150" class="list_title">媒體專區列表</td>
        	<td width="874"><span class="table_data">分類：
<label>
<select name="select1" id="select1">
<?php
do {  
?>
<option value="<?php echo $row_RecMediaT['term_id']?>"<?php if (!(strcmp($row_RecMediaT['term_id'], $G_sel))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecMediaT['name']?><?php //echo $row_RecMediaT['term_id']?></option>
<?php
} while ($row_RecMediaT = mysql_fetch_assoc($RecMediaT));
  $rows = mysql_num_rows($RecMediaT);
  if($rows > 0) {
      mysql_data_seek($RecMediaT, 0);
	  $row_RecMediaT = mysql_fetch_assoc($RecMediaT);
  }
?>
</select>
</label>

        	</span>

			<a href="media_list.php?sortAll=sortAll&sel=<?php echo $G_sel; ?>" class="submenu" style="margin-left: 10px;">重整排序</a>


        	<span class="no_data">
        	    <?php if ($totalRows_RecMedia == 0) { // Show if recordset empty ?>
        	      <strong>此分類沒有資料</strong>
        	      <?php } // Show if recordset empty ?>
            </span> </td>
        </tr>
    </table>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
    	<tr>
            <td width="739" align="right" class="page_display">
            <!-------顯示頁選擇與分頁設定開始---------->
            <?php 	
	displayPages($pageNum, $queryString_RecMedia, $totalPages_RecMedia, $totalRows_RecMedia, $currentPage);
	?>
<!-------顯示頁選擇與分頁設定結束---------->
            <td width="110" align="right" class="page_display"><?php if ($totalRows_RecMedia > 0) { // Show if recordset not empty ?>
                頁數:<?php echo (($pageNum+1)."/".($totalPages_RecMedia+1)); ?>
  <?php } // Show if recordset not empty ?>
</td>
            <td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows_RecMedia ?> </td>
            <td width="24" align="right">&nbsp;</td>
     	</tr>
	</table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        	<td><img src="image/spacer.gif" width="1" height="1" /></td>
        </tr>
    </table>
	<form action="media_process.php" method="post" name="form1" id="form1">
      <?php if ($totalRows_RecMedia > 0) { // Show if recordset not empty ?>
        <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
          <tr>
            <td width="140" align="center" class="table_title">日期</td>
            <td width="60" align="center" class="table_title">排序</td>
            <td align="center" class="table_title">標題</td>
            <td width="90" align="center" class="table_title">圖片</td>

            <td width="60" align="center" class="table_title">在網頁顯示</td>

            <?php if(in_array(5,$_SESSION['MM_Limit']['a7'])){ ?>
            <td width="60" align="center" class="table_title">發佈狀態</td>
            <?php } ?>

          <?php if(in_array(5,$_SESSION['MM_Limit']['a7'])){ ?>
            <td width="40" align="center" class="table_title">編輯</td>
            <?php } ?>

            <?php if(in_array(7,$_SESSION['MM_Limit']['a7'])){ ?>
            <td width="40" align="center" class="table_title">刪除</td>
            <?php } ?>

          </tr>
          <?php 
    	$i=0;//加上i
  		do { 
  		if ($i%2==0)
		{
		$i=$i+1;
		echo "<tr>";} 
		else
		{
		$i=$i+1;
		echo "<tr bgcolor='#E4E4E4'>";}
  		?>
        <?php

        $typ = 'image';

        if (!(strcmp(1, $row_RecMedia['d_class3']))) {
        	$typ = 'image';
        }elseif (!(strcmp(2, $row_RecMedia['d_class3']))) {
        	$typ = 'videoImage';
        }elseif (!(strcmp(3, $row_RecMedia['d_class3']))) {
        	$typ = 'photoImage';
        }
		mysql_select_db($database_connect2data, $connect2data);
		$query_RecImage = "SELECT * FROM file_set  WHERE file_type='$typ' AND file_d_id = ".$row_RecMedia['d_id']." ORDER BY file_id ASC";
		$RecImage = mysql_query($query_RecImage, $connect2data) or die(mysql_error());
		$row_RecImage = mysql_fetch_assoc($RecImage);
		$totalRows_RecImage = mysql_num_rows($RecImage);

		if($totalRows_RecImage==0 && (!(strcmp(2, $row_RecMedia['d_class3'])))){
			mysql_select_db($database_connect2data, $connect2data);
			$query_RecImage = "SELECT * FROM file_set  WHERE file_type='youtubeThumbnail' AND file_d_id = ".$row_RecMedia['d_id'];
			$RecImage = mysql_query($query_RecImage, $connect2data) or die(mysql_error());
			$row_RecImage = mysql_fetch_assoc($RecImage);
			$totalRows_RecImage = mysql_num_rows($RecImage);
		}
		?>
  
    
      <td align="center" class="table_data" >
      
      <?php
          if(in_array(5,$_SESSION['MM_Limit']['a7'])){
			  echo '<a href="media_edit.php?d_id='.$row_RecMedia['d_id'].'">'.date("Y-m-d", strtotime($row_RecMedia['d_date'])).'</a>';
		  }else{
			  echo date("Y-m-d", strtotime($row_RecMedia['d_date']));
		  }
		  ?>
      
      
      
     </td>
  <td align="center" class="table_data" >
  <?php
          if(in_array(5,$_SESSION['MM_Limit']['a7'])){
			  ?>
           <label>
        <select name="sort" id="sort" onchange="changeSort('<?php echo $pageNum; ?>','<?php echo $totalRows_RecMedia; ?>','<?php echo $row_RecMedia['d_id']; ?>',this.options[this.selectedIndex].value,'<?php if(isset($G_sel)){echo $G_sel;}else{echo $row_RecMediaT['term_id'];} ?>')">
          <option value="0" <?php if (!(strcmp(0, $row_RecMedia['term_order']))) {echo "selected=\"selected\"";} ?>>至頂</option>
          <?php
		 		
          for($j=1;$j<=($totalRows_RecMedia);$j++)
          {
          	echo "<option value=\"".$j."\" ";
			if (!(strcmp($j, $row_RecMedia['term_order']))) {echo "selected=\"selected\"";}
			echo ">".$j."</option>";
          }
		  ?>
        </select>
        </label>
		<?php }else{
			if (!(strcmp(0, $row_RecMedia['term_order']))) {
				echo "至頂";
			}else{
				echo $row_RecMedia['term_order'];
			}
			
		} ?>
  
  
  <?php $_SESSION['totalRows']=$totalRows_RecMedia; ?></td>
     
      <td align="center" class="table_data" >
      
      <?php
          if(in_array(5,$_SESSION['MM_Limit']['a7'])){
			  echo '<a href="media_edit.php?d_id='.$row_RecMedia['d_id'].'">'.$row_RecMedia['d_title'].'</a>';
		  }else{
			  echo $row_RecMedia['d_title'];
		  }
		  ?>
          
      
      </td>
      
      
      
      
     
    <td align="center"  class="table_data">
    <a name="<?php echo $row_RecMedia['d_id']; ?>" id="<?php echo $row_RecMedia['d_id']; ?>"></a>
    
    
    <?php
          if(in_array(5,$_SESSION['MM_Limit']['a7'])){
			  echo '<a href="media_edit.php?d_id='.$row_RecMedia['d_id'].'">';
			  echo '<img src="';
			  if($totalRows_RecImage==0){
				  echo "image/default_image_s.jpg";
			  }else{
				  echo "../".$row_RecImage['file_link2'];
			  }
			  echo '" alt="" class="image_frame"  width="100" />';
			  echo '</a>';
		  }else{
			  echo '<img src="';
			  if($totalRows_RecImage==0){
				  echo "image/default_image_s.jpg";
			  }else{
				  echo "../".$row_RecImage['file_link2'];
			  }
			  echo '" alt="" class="image_frame"  width="100" />';
		  }
		  ?>
    
    </td>
    
   
    <td align="center"  class="table_data">
	
	<?php
          if(in_array(5,$_SESSION['MM_Limit']['a7'])){
			  if($row_RecMedia['d_active']){
					echo "<a href='".$row_RecMedia['d_active']."' rel='".$row_RecMedia['d_id']."' class='activeCh'><img src=\"image/accept.png\" width=\"16\" height=\"16\"  ></a>";
				}else{
					echo "<a href='".$row_RecMedia['d_active']."' rel='".$row_RecMedia['d_id']."' class='activeCh'><img src=\"image/delete.png\" width=\"16\" height=\"16\"  ></a>";
				}
		  }else{
			  if($row_RecMedia['d_active']){
					echo "<img src=\"image/accept.png\" width=\"16\" height=\"16\"  >";
				}else{
					echo "<img src=\"image/delete.png\" width=\"16\" height=\"16\"  >";
				}
		  }
		  ?>
          </td>

        <td align="center"  class="table_data">
      
            <?php //發佈狀態
            if(in_array(5,$_SESSION['MM_Limit']['a7'])){
		        if($row_RecMedia['d_pub']){
		          echo "<a href='".$row_RecMedia['d_pub']."' rel='".$row_RecMedia['d_id']."' class='pubD' title='發佈'>發佈</a>";
		        }else{
		          echo "<a href='".$row_RecMedia['d_pub']."' rel='".$row_RecMedia['d_id']."' class='pubD' title='草稿'>草稿</a>";
		        }
		      }else{
		        if($row_RecMedia['d_pub']){
		          echo "發佈";
		        }else{
		          echo "草稿";
		        }
	      	}
	      	?>
        </td>

          <?php if(in_array(5,$_SESSION['MM_Limit']['a7'])){ ?>
    <td align="center" class="table_data"><a href="media_edit.php?d_id=<?php echo $row_RecMedia['d_id']; ?>"><img src="image/pencil.png" width="16" height="16" /></a></td>
    <?php } ?>

            <?php if(in_array(7,$_SESSION['MM_Limit']['a7'])){ ?>
    <td align="center" class="table_data"><a href="media_del.php?d_id=<?php echo $row_RecMedia['d_id']; ?>"><img src="image/cross.png" width="16" height="16" /></a></td>
    <?php } ?>

  </tr>
  <?php } while ($row_RecMedia = mysql_fetch_assoc($RecMedia)); ?>
        </table>
        <?php } // Show if recordset not empty ?>
</form>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
        <tr>
            <td width="739" align="right" class="page_display">
            <!-------顯示頁選擇與分頁設定開始---------->
            <?php 	
	displayPages($pageNum, $queryString_RecMedia, $totalPages_RecMedia, $totalRows_RecMedia, $currentPage);
	?>
<!-------顯示頁選擇與分頁設定結束---------->
            <td width="110" align="right" class="page_display"><?php if ($totalRows_RecMedia > 0) { // Show if recordset not empty ?>
                頁數:<?php echo (($pageNum+1)."/".($totalPages_RecMedia+1)); ?>
  <?php } // Show if recordset not empty ?>
</td>
            <td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows_RecMedia ?> </td>
            <td width="24" align="right">&nbsp;</td>
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
mysql_free_result($RecMedia);

mysql_free_result($RecMediaT);
?>

<script type="text/javascript">
$(document).ready(function() {
	$('#select1').change(function() {
		//alert($(this).val());
		window.location.href = "media_list.php?sel="+$(this).val();
	});
  
});
</script>