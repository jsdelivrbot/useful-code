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

if(!in_array(3,$_SESSION['MM_Limit']['a5'])){
  header("Location: first.php");
}

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RecEventsC = 15;
$pageNum = 0;
if (isset($_GET['pageNum'])) {
  $pageNum = $_GET['pageNum'];
}
$startRow_RecEventsC = $pageNum * $maxRows_RecEventsC;

mysql_select_db($database_connect2data, $connect2data);
$query_RecEventsC = "SELECT * FROM class_set WHERE c_parent = 'eventsC' ORDER BY c_sort ASC, c_id DESC";
$query_limit_RecEventsC = sprintf("%s LIMIT %d, %d", $query_RecEventsC, $startRow_RecEventsC, $maxRows_RecEventsC);
$RecEventsC = mysql_query($query_limit_RecEventsC, $connect2data) or die(mysql_error());
$row_RecEventsC = mysql_fetch_assoc($RecEventsC);

if (isset($_GET['totalRows_RecEventsC'])) {
  $totalRows_RecEventsC = $_GET['totalRows_RecEventsC'];
} else {
  $all_RecEventsC = mysql_query($query_RecEventsC);
  $totalRows_RecEventsC = mysql_num_rows($all_RecEventsC);
}
$totalPages_RecEventsC = ceil($totalRows_RecEventsC/$maxRows_RecEventsC)-1;
$TotalPage = $totalPages_RecEventsC;


$queryString_RecEventsC = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum") == false && 
        stristr($param, "totalRows_RecEventsC") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecEventsC = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecEventsC = sprintf("&totalRows_RecEventsC=%d%s", $totalRows_RecEventsC, $queryString_RecEventsC);
 $menu_is="events";?>
 <?php 
  $R_pageNum = 0;
 if (isset($_REQUEST["pageNum"])) 
 {
 	$R_pageNum_RecHorse = $_REQUEST["pageNum"];
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
 	  else if ($R_pageNum>$totalPages_RecEventsC)
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
	if($R_pageNum>$totalPages_RecEventsC && $R_pageNum!=0)
	{
		header("Location:eventsC_list.php?pageNum=".$totalPages_RecEventsC);
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
	
	//echo "now_c_id=".$_GET['now_c_id'];
	//echo "change_num=".$_GET['change_num'];
	
	mysql_select_db($database_connect2data, $connect2data);
	$query_RecEventsC = "SELECT * FROM class_set WHERE c_parent = 'eventsC' ORDER BY c_sort ASC, c_id DESC";
	$RecEventsC = mysql_query($query_RecEventsC, $connect2data) or die(mysql_error());
	$row_RecEventsC = mysql_fetch_assoc($RecEventsC);
	

	do{
	
		if($row_RecEventsC['c_sort']==0)
		{}
		else if($row_RecEventsC['c_id']==$_GET['now_c_id'])
		{	
			echo $sort_num."<br/>";
			
		}else if($sort_num==$_GET['change_num'])
		{
			echo $sort_num."<br/>";
			$sort_num++;
			
			$updateSQL = sprintf("UPDATE class_set SET c_sort=%s WHERE c_id=%s",
			   GetSQLValueString($sort_num, "int"),
			   GetSQLValueString($row_RecEventsC['c_id'], "int"));

			mysql_select_db($database_connect2data, $connect2data);
			$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
			
			$sort_num++;
		}
		else
		{
			$updateSQL = sprintf("UPDATE class_set SET c_sort=%s WHERE c_id=%s",
			   GetSQLValueString($sort_num, "int"),
			   GetSQLValueString($row_RecEventsC['c_id'], "int"));

			mysql_select_db($database_connect2data, $connect2data);
			$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
			
			echo $sort_num."<br/>";
			echo $row_RecEventsC['title']."->".$sort_num."<br/>";
			
			$sort_num++;		
		}
		
		
	//echo " ".$row_RecEventsC['c_sort'];
	}while ($row_RecEventsC = mysql_fetch_assoc($RecEventsC));
	
	
			$updateSQL = sprintf("UPDATE class_set SET c_sort=%s WHERE c_id=%s",
			   GetSQLValueString($_GET['change_num'], "int"),
			   GetSQLValueString($_GET['now_c_id'], "int"));

			mysql_select_db($database_connect2data, $connect2data);
			$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
	if($G_changeSort==1)
	{
	header("Location:eventsC_list.php?pageNum=".$_GET['pageNum']."&totalRows_RecEventsC=".$_GET['totalRows_RecEventsC']);
	}else if($G_delchangeSort==1)
	{
	header("Location:eventsC_list.php?pageNum=".$_GET['pageNum']);
	}
}

?>
<?php require_once('display_page.php'); ?>
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
function changeSort(pageNum, totalRows_RecEventsC, now_c_id, change_num) { //v1.0
 //alert(pageNum+"+"+totalPages_RecEventsC); 
 window.location.href="eventsC_list.php?pageNum="+pageNum+"&totalRows_RecEventsC="+totalRows_RecEventsC+"&changeSort=1"+"&now_c_id="+now_c_id+"&change_num="+change_num;
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
        	<td width="140" class="list_title">活動分類列表</td>
        	<td width="884"><span class="no_data">
            <?php if ($totalRows_RecEventsC == 0) { // Show if recordset empty ?>
              <strong>目前資料庫中沒有任何活動分類</strong>
              <?php } // Show if recordset empty ?>
</span> </td>
        </tr>
    </table>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
    	<tr>
            <td width="739" align="right" class="page_display">
            <!-------顯示頁選擇與分頁設定開始---------->
            <?php 	
	displayPages($pageNum, $queryString_RecEventsC, $totalPages_RecEventsC, $totalRows_RecEventsC, $currentPage);
	?>
<!-------顯示頁選擇與分頁設定結束---------->
            <td width="110" align="right" class="page_display"><?php if ($totalRows_RecEventsC > 0) { // Show if recordset not empty ?>
                頁數:<?php echo (($pageNum+1)."/".($totalPages_RecEventsC+1)); ?>
  <?php } // Show if recordset not empty ?>
</td>
            <td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows_RecEventsC ?> </td>
            <td width="24" align="right">&nbsp;</td>
     	</tr>
	</table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        	<td><img src="image/spacer.gif" width="1" height="1" /></td>
        </tr>
    </table>
	<form action="eventsC_process.php" method="post" name="form1" id="form1">
      <?php if ($totalRows_RecEventsC > 0) { // Show if recordset not empty ?>
        <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
          <tr>
        	<td width="100" align="center" class="table_title">排序</td>
            <td align="center" class="table_title">分類名稱</td>
            <td width="40" align="center" class="table_title">狀態</td>
            <?php if(in_array(5,$_SESSION['MM_Limit']['a5'])){ ?>
            <td width="40" align="center" class="table_title">編輯</td>
            <?php } ?>
            <?php if(in_array(7,$_SESSION['MM_Limit']['a5'])){ ?>
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
		
		$colname_RecImage = "-1";
		if (isset($row_RecEventsC['c_id'])) {
		  $colname_RecImage = $row_RecEventsC['c_id'];
		}
		mysql_select_db($database_connect2data, $connect2data);
		$query_RecImage = sprintf("SELECT * FROM file_set WHERE file_type='brandImage' AND file_d_id = %s", GetSQLValueString($colname_RecImage, "int"));
		$RecImage = mysql_query($query_RecImage, $connect2data) or die(mysql_error());
		$row_RecImage = mysql_fetch_assoc($RecImage);
		$totalRows_RecImage = mysql_num_rows($RecImage);
		
		//echo $totalRows_RecImage;
		?>
            <td align="center" class="table_data" >
            
            <?php
          if(in_array(5,$_SESSION['MM_Limit']['a5'])){
			  ?>
           <label>
        <select name="c_sort" id="c_sort" onchange="changeSort('<?php echo $pageNum; ?>','<?php echo $totalRows_RecEventsC; ?>','<?php echo $row_RecEventsC['c_id']; ?>',this.options[this.selectedIndex].value)">
          <option value="0" <?php if (!(strcmp(0, $row_RecEventsC['c_sort']))) {echo "selected=\"selected\"";} ?>>至頂</option>
          <?php
		 		
          for($j=1;$j<=($totalRows_RecEventsC);$j++)
          {
          	echo "<option value=\"".$j."\" ";
			if (!(strcmp($j, $row_RecEventsC['c_sort']))) {echo "selected=\"selected\"";}
			echo ">".$j."</option>";
          }
		  ?>
        </select>
        </label>
		<?php }else{
			if (!(strcmp(0, $row_RecEventsC['c_sort']))) {
				echo "至頂";
			}else{
				echo $row_RecEventsC['c_sort'];
			}
			
		} ?>
            
            
           <?php $_SESSION['totalRows']=$totalRows_RecEventsC; ?></td>
         <td align="center" class="table_data" >
         
         <?php
          if(in_array(5,$_SESSION['MM_Limit']['a5'])){
			  echo '<a href="eventsC_edit.php?c_id='.$row_RecEventsC['c_id'].'">'.$row_RecEventsC['c_title'].'</a>';
		  }else{
			  echo $row_RecEventsC['c_title'];
		  }
		  ?>
         
         
         </td>
         
            <td align="center"  class="table_data">
			
            <?php
          if(in_array(5,$_SESSION['MM_Limit']['a5'])){
			  if($row_RecEventsC['c_active']){
					echo "<a href='".$row_RecEventsC['c_active']."' rel='".$row_RecEventsC['c_id']."' class='activeChC'><img src=\"image/accept.png\" width=\"16\" height=\"16\"  ></a>";
				}else{
					echo "<a href='".$row_RecEventsC['c_active']."' rel='".$row_RecEventsC['c_id']."' class='activeChC'><img src=\"image/delete.png\" width=\"16\" height=\"16\"  ></a>";
				}
		  }else{
			  if($row_RecEventsC['c_active']){
					echo "<img src=\"image/accept.png\" width=\"16\" height=\"16\"  >";
				}else{
					echo "<img src=\"image/delete.png\" width=\"16\" height=\"16\"  >";
				}
		  }
		  ?></td>
          
          <?php if(in_array(5,$_SESSION['MM_Limit']['a5'])){ ?>
            <td align="center" class="table_data"><a href="eventsC_edit.php?c_id=<?php echo $row_RecEventsC['c_id']; ?>"><img src="image/pencil.png" width="16" height="16" /></a></td>
                       
            <?php } ?>
            <?php if(in_array(7,$_SESSION['MM_Limit']['a5'])){ ?>
            
            <td align="center" class="table_data"><a href="eventsC_del.php?c_id=<?php echo $row_RecEventsC['c_id']; ?>"><img src="image/cross.png" width="16" height="16" /></a></td>
            <?php } ?>
          </tr>
          <?php } while ($row_RecEventsC = mysql_fetch_assoc($RecEventsC)); ?>
        </table>
        <?php } // Show if recordset not empty ?>
</form>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
        <tr>
            <td width="739" align="right" class="page_display">
            <!-------顯示頁選擇與分頁設定開始---------->
            <?php 	
	displayPages($pageNum, $queryString_RecEventsC, $totalPages_RecEventsC, $totalRows_RecEventsC, $currentPage);
	?>
<!-------顯示頁選擇與分頁設定結束---------->
            <td width="110" align="right" class="page_display"><?php if ($totalRows_RecEventsC > 0) { // Show if recordset not empty ?>
                頁數:<?php echo (($pageNum+1)."/".($totalPages_RecEventsC+1)); ?>
  <?php } // Show if recordset not empty ?>
</td>
            <td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows_RecEventsC ?> </td>
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
mysql_free_result($RecEventsC);
?>
