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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RecShopProcess = 20;
$pageNum = 0;
if (isset($_GET['pageNum'])) {
  $pageNum = $_GET['pageNum'];
}
$startRow_RecShopProcess = $pageNum * $maxRows_RecShopProcess;

mysql_select_db($database_connect2data, $connect2data);
$query_RecShopProcessC = "SELECT * FROM class_set WHERE c_parent = 'shopProcessC' AND c_active='1' ORDER BY c_sort ASC, c_id DESC";
$RecShopProcessC = mysql_query($query_RecShopProcessC, $connect2data) or die(mysql_error());
$row_RecShopProcessC = mysql_fetch_assoc($RecShopProcessC);
$totalRows_RecShopProcessC = mysql_num_rows($RecShopProcessC);

$type = (isset($_GET['type'])) ? $_GET['type'] : '1';

if($type=='1'){	
	$SortType = "d_sort ASC, d_date DESC";
}elseif($type=='2'){
	$SortType = "d_date ASC, d_sort ASC";
}elseif($type=='3'){
	$SortType = "d_date DESC, d_date ASC";
}else{
	$SortType = "d_sort ASC, d_date DESC";
}

$G_selected1 = '';
if(isset($_GET['selected1']))
{
	$_SESSION['selected_shopProcessC'] = $G_selected1 = $_GET['selected1'];
}else 
{
	$G_selected1 = $_SESSION['selected_shopProcessC'] = $row_RecShopProcessC['c_id'];
}

mysql_select_db($database_connect2data, $connect2data);
$query_RecShopProcess = "SELECT * FROM data_set WHERE d_class1 = 'shopProcess' AND d_class2='".$G_selected1."' ORDER BY $SortType";
$query_limit_RecShopProcess = sprintf("%s LIMIT %d, %d", $query_RecShopProcess, $startRow_RecShopProcess, $maxRows_RecShopProcess);
$RecShopProcess = mysql_query($query_limit_RecShopProcess, $connect2data) or die(mysql_error());
$row_RecShopProcess = mysql_fetch_assoc($RecShopProcess);
//$_SESSION['selected_shopProcess']=$G_selected2;


if (isset($_GET['totalRows_RecShopProcess'])) {
  $S_original_selected='';
  if(isset($_SESSION['original_selected'])){
  	$S_original_selected = $_SESSION['original_selected'];
  }
 /*if(isset($_GET['selected2']) && $_GET['selected2']!=''){
	$G_selected2 = $_GET['selected2'];
  } */
	  if($S_original_selected==$G_selected1)
		{
			$totalRows_RecShopProcess = $_GET['totalRows_RecShopProcess'];
		}else
		{
			$all_RecShopProcess = mysql_query($query_RecShopProcess);
 	  		$totalRows_RecShopProcess = mysql_num_rows($all_RecShopProcess);
		}
	} else {
	  $all_RecShopProcess = mysql_query($query_RecShopProcess);
 	  $totalRows_RecShopProcess = mysql_num_rows($all_RecShopProcess);
	}
	$all_RecShopProcess = mysql_query($query_RecShopProcess);
 	$totalRows_RecShopProcess = mysql_num_rows($all_RecShopProcess);
	$totalPages_RecShopProcess = ceil($totalRows_RecShopProcess/$maxRows_RecShopProcess)-1;
	$TotalPage = $totalPages_RecShopProcess;

$queryString_RecShopProcess = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum") == false && 
        stristr($param, "totalRows_RecShopProcess") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecShopProcess = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecShopProcess = sprintf("&totalRows_RecShopProcess=%d%s", $totalRows_RecShopProcess, $queryString_RecShopProcess);
 $menu_is="shopProcess";?>
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
 	  else if ($R_pageNum>$totalPages_RecShopProcess)
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
	if($R_pageNum>$totalPages_RecShopProcess && $R_pageNum!=0)
	{
		header("Location:shopProcess_list.php?pageNum=".$totalPages_RecShopProcess);
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
	
	/*if(isset($_GET['selected2']))
	{
	$G_selected2 = $_GET['selected2'];*/
	//$query_RecShopProcess = "SELECT data_set.*, class_set.c_title as c_title FROM data_set LEFT JOIN class_set ON data_set.d_class2 =class_set.c_id WHERE d_class1 = 'shopProcess' AND d_class2='".$G_selected1."' ORDER BY $SortType";
	$query_RecShopProcess = "SELECT * FROM data_set WHERE d_class1 = 'shopProcess' AND d_class2='".$G_selected1."' ORDER BY $SortType";
	$_SESSION['selected_shopProcessC']=$G_selected1;
	/*}else 
	{
	$query_RecShopProcess = "SELECT data_set.*, class_set.c_title as c_title FROM data_set LEFT JOIN class_set ON data_set.class2 =class_set.c_id WHERE d_class1 = 'shopProcess' AND d_class2='".$row_RecShopProcessC['c_id']."' ORDER BY $SortType";
	$_SESSION['selected_shopProcess']=$row_RecBrandSeries['c_id'];
	}*/
	
	$RecShopProcess = mysql_query($query_RecShopProcess, $connect2data) or die(mysql_error());
	$row_RecShopProcess = mysql_fetch_assoc($RecShopProcess);
	

	do{
	
		if($row_RecShopProcess['d_sort']==0)
		{}
		else if($row_RecShopProcess['d_id']==$_GET['now_d_id'])
		{	
			echo $sort_num."<br/>";
			
		}else if($sort_num==$_GET['change_num'])
		{
			echo $sort_num."<br/>";
			$sort_num++;
			
			$updateSQL = sprintf("UPDATE data_set SET d_sort=%s WHERE d_id=%s",
			   GetSQLValueString($sort_num, "int"),
			   GetSQLValueString($row_RecShopProcess['d_id'], "int"));

			mysql_select_db($database_connect2data, $connect2data);
			$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
			
			$sort_num++;
		}
		else
		{
			$updateSQL = sprintf("UPDATE data_set SET d_sort=%s WHERE d_id=%s",
			   GetSQLValueString($sort_num, "int"),
			   GetSQLValueString($row_RecShopProcess['d_id'], "int"));

			mysql_select_db($database_connect2data, $connect2data);
			$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
			
			echo $sort_num."<br/>";
			echo $row_RecShopProcess['d_title']."->".$sort_num."<br/>";
			
			$sort_num++;		
		}
		
		
	//echo " ".$row_RecShopProcess['sort'];
	}while ($row_RecShopProcess = mysql_fetch_assoc($RecShopProcess));
	
	
			$updateSQL = sprintf("UPDATE data_set SET d_sort=%s WHERE d_id=%s",
			   GetSQLValueString($_GET['change_num'], "int"),
			   GetSQLValueString($_GET['now_d_id'], "int"));

			mysql_select_db($database_connect2data, $connect2data);
			$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
	if($G_changeSort==1)
	{
		/*if(isset($_GET['selected2']))
		{
		$G_selected2 = $_GET['selected2'];*/
		if(isset($_GET['now_d_id'])){
			header("Location:shopProcess_list.php?selected1=".$G_selected1."&pageNum=".$_GET['pageNum']."&totalRows_RecShopProcess=".$_GET['totalRows_RecShopProcess']."#".$_GET['now_d_id']);
		}else{
			header("Location:shopProcess_list.php?selected1=".$G_selected1."&pageNum=".$_GET['pageNum']."&totalRows_RecShopProcess=".$_GET['totalRows_RecShopProcess']);
		}
		/*}else
		{
			header("Location:shopProcess_list.php?selected1=".$row_RecShopProcessC['c_id']."&pageNum=".$_GET['pageNum']."&totalRows_RecShopProcess=".$_GET['totalRows_RecShopProcess']);
		}*/
	
	}else if($G_delchangeSort==1)
	{
		/*if(isset($_GET['selected2']))
		{
		$G_selected2 = $_GET['selected2'];*/
			header("Location:shopProcess_list.php?selected1=".$G_selected1."&pageNum=".$_GET['pageNum']);
		/*}else
		{
			header("Location:shopProcess_list.php?selected=".$row_RecShopProcessC['c_id']."&pageNum=".$_GET['pageNum']);
		}*/
	}
}

?>
<?php 
require_once('display_page.php');
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
<script type="text/javascript">
<!--
function changeSort(pageNum, totalRows_RecShopProcess, now_d_id, change_num, selected1) { //v1.0
 window.location.href="shopProcess_list.php?selected1="+selected1+"&changeSort=1"+"&now_d_id="+now_d_id+"&change_num="+change_num+"&pageNum="+pageNum+"&totalRows_RecShopProcess="+totalRows_RecShopProcess;
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
        	<td width="150" class="list_title">購物說明列表</td>
        	<td width="437"><span class="table_data">分類：
<label>
<select name="select1" id="select1">
<?php
do {  
?>
<option value="<?php echo $row_RecShopProcessC['c_id']?>"<?php if (!(strcmp($row_RecShopProcessC['c_id'], $G_selected1))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecShopProcessC['c_title']?><?php //echo $row_RecShopProcessC['c_id']?></option>
<?php
} while ($row_RecShopProcessC = mysql_fetch_assoc($RecShopProcessC));
  $rows = mysql_num_rows($RecShopProcessC);
  if($rows > 0) {
      mysql_data_seek($RecShopProcessC, 0);
	  $row_RecShopProcessC = mysql_fetch_assoc($RecShopProcessC);
  }
?>
</select>
</label>
        	</span><span class="no_data">
        	    <?php if ($totalRows_RecShopProcess == 0) { // Show if recordset empty ?>
        	      <strong>此分類沒有資料</strong>
        	      <?php } // Show if recordset empty ?>
            </span> </td>
        	<td width="437" class="table_data"><?php if(0){?><label for="sortType">排序方式</label>
        	  <select name="sortType" id="sortType">
        	    <option value="1" <?php if (!(strcmp($type, 1))) {echo "selected=\"selected\"";} ?>>正常排序</option>
        	    <option value="2" <?php if (!(strcmp($type, 2))) {echo "selected=\"selected\"";} ?>>日期排序(由小到大)</option>
        	    <option value="3" <?php if (!(strcmp($type, 3))) {echo "selected=\"selected\"";} ?>>日期排序(由大到小)</option>
      	      </select><?php } ?></td>
        </tr>
    </table>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
    	<tr>
            <td width="739" align="right" class="page_display">
            <!-------顯示頁選擇與分頁設定開始---------->
            <?php 	
	displayPages($pageNum, $queryString_RecShopProcess, $totalPages_RecShopProcess, $totalRows_RecShopProcess, $currentPage);
	?>
<!-------顯示頁選擇與分頁設定結束---------->
            <td width="110" align="right" class="page_display"><?php if ($totalRows_RecShopProcess > 0) { // Show if recordset not empty ?>
                頁數:<?php echo (($pageNum+1)."/".($totalPages_RecShopProcess+1)); ?>
  <?php } // Show if recordset not empty ?>
</td>
            <td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows_RecShopProcess ?> </td>
            <td width="24" align="right">&nbsp;</td>
     	</tr>
	</table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        	<td><img src="image/spacer.gif" width="1" height="1" /></td>
        </tr>
    </table>
	<form action="shopProcess_process.php" method="post" name="form1" id="form1">
      <?php if ($totalRows_RecShopProcess > 0) { // Show if recordset not empty ?>
        <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
          <tr>
            <td width="140" align="center" class="table_title">新增日期</td>
            <td width="100" align="center" class="table_title">排序</td>
            <td align="center" class="table_title">標題</td>
            <td width="140" align="center" class="table_title">圖片</td>
            <td width="40" align="center" class="table_title">狀態</td>
            <td width="40" align="center" class="table_title">編輯</td>
            <td width="40" align="center" class="table_title">刪除</td>
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
		mysql_select_db($database_connect2data, $connect2data);
		$query_RecImage = "SELECT * FROM file_set  WHERE file_type='image' AND file_d_id = ".$row_RecShopProcess['d_id'];
		$RecImage = mysql_query($query_RecImage, $connect2data) or die(mysql_error());
		$row_RecImage = mysql_fetch_assoc($RecImage);
		$totalRows_RecImage = mysql_num_rows($RecImage);
		//echo $totalRows_RecImage;
		?>
  
    
      <td align="center" class="table_data" ></a><a href="shopProcess_edit.php?d_id=<?php echo $row_RecShopProcess['d_id']; ?>"><?php echo $row_RecShopProcess['d_date']; ?></a></td>
  <td align="center" class="table_data" ><label>
        <select name="sort" id="sort" onchange="changeSort('<?php echo $pageNum; ?>','<?php echo $totalRows_RecShopProcess; ?>','<?php echo $row_RecShopProcess['d_id']; ?>',this.options[this.selectedIndex].value,'<?php if(isset($G_selected1)){echo $G_selected1;}else{echo $row_RecShopProcessC['c_id'];} ?>')">
          <option value="0" <?php if (!(strcmp(0, $row_RecShopProcess['d_sort']))) {echo "selected=\"selected\"";} ?>>至頂</option>
          <?php
		 		
          for($j=1;$j<=($totalRows_RecShopProcess);$j++)
          {
          	echo "<option value=\"".$j."\" ";
			if (!(strcmp($j, $row_RecShopProcess['d_sort']))) {echo "selected=\"selected\"";}
			echo ">".$j."</option>";
          }
		  ?>
        </select>
        </label><?php $_SESSION['totalRows']=$totalRows_RecShopProcess; ?></td>
      <td align="center" class="table_data" ><a href="shopProcess_edit.php?d_id=<?php echo $row_RecShopProcess['d_id']; ?>"><?php echo $row_RecShopProcess['d_title']; ?></a></td>     
    <td align="center"  class="table_data">
    <a name="<?php echo $row_RecShopProcess['d_id']; ?>" id="<?php echo $row_RecShopProcess['d_id']; ?>">
    <a href="shopProcess_edit.php?d_id=<?php echo $row_RecShopProcess['d_id']; ?>#imageEdit"><img src="<?php if($totalRows_RecImage==0){echo "image/default_image_s.jpg";}else{echo "../".$row_RecImage['file_link2'];} ?>" alt="" class="image_frame" /></a></td>
    
    <td align="center"  class="table_data"><?php  //list使用
				if($row_RecShopProcess['d_active'])
				{
					echo "<a href='".$row_RecShopProcess['d_active']."' rel='".$row_RecShopProcess['d_id']."' class='activeCh'><img src=\"image/accept.png\" width=\"16\" height=\"16\"  ></a>";
				}
				else
				{
					echo "<a href='".$row_RecShopProcess['d_active']."' rel='".$row_RecShopProcess['d_id']."' class='activeCh'><img src=\"image/delete.png\" width=\"16\" height=\"16\"  ></a>";
				}
				
?></td>
    <td align="center" class="table_data"><a href="shopProcess_edit.php?d_id=<?php echo $row_RecShopProcess['d_id']; ?>"><img src="image/pencil.png" width="16" height="16" /></a></td>
    <td align="center" class="table_data"><a href="shopProcess_del.php?d_id=<?php echo $row_RecShopProcess['d_id']; ?>"><img src="image/cross.png" width="16" height="16" /></a></td>
  </tr>
  <?php } while ($row_RecShopProcess = mysql_fetch_assoc($RecShopProcess)); ?>
        </table>
        <?php } // Show if recordset not empty ?>
</form>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
        <tr>
            <td width="739" align="right" class="page_display">
            <!-------顯示頁選擇與分頁設定開始---------->
            <?php 	
	displayPages($pageNum, $queryString_RecShopProcess, $totalPages_RecShopProcess, $totalRows_RecShopProcess, $currentPage);
	?>
<!-------顯示頁選擇與分頁設定結束---------->
            <td width="110" align="right" class="page_display"><?php if ($totalRows_RecShopProcess > 0) { // Show if recordset not empty ?>
                頁數:<?php echo (($pageNum+1)."/".($totalPages_RecShopProcess+1)); ?>
  <?php } // Show if recordset not empty ?>
</td>
            <td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows_RecShopProcess ?> </td>
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
mysql_free_result($RecShopProcess);

mysql_free_result($RecShopProcessC);
?>

<script type="text/javascript">
$(document).ready(function() {
	$('#select1').change(function() {
		//alert($(this).val());
		window.location.href = "shopProcess_list.php?selected1="+$(this).val()+"&type="+$('#sortType').val();
	});
	$('#sortType').change(function() {
		//alert($(this).val());
		window.location.href = "shopProcess_list.php?selected1="+$('#select1').val()+"&type="+$(this).val();
	});
  
});
</script>