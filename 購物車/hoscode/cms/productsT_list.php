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

if(!in_array(3,$_SESSION['MM_Limit']['a4'])){
	header("Location: first.php");
}

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RecProductsT = 15;
$pageNum = 0;
if (isset($_GET['pageNum'])) {
  $pageNum = $_GET['pageNum'];
}
$startRow_RecProductsT = $pageNum * $maxRows_RecProductsT;

mysql_select_db($database_connect2data, $connect2data);
$query_RecProductsT = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='post_tag' ORDER BY term_sort ASC, term_id DESC";
$query_limit_RecProductsT = sprintf("%s LIMIT %d, %d", $query_RecProductsT, $startRow_RecProductsT, $maxRows_RecProductsT);
$RecProductsT = mysql_query($query_limit_RecProductsT, $connect2data) or die(mysql_error());
$row_RecProductsT = mysql_fetch_assoc($RecProductsT);

if (isset($_GET['totalRows_RecProductsT'])) {
  $totalRows_RecProductsT = $_GET['totalRows_RecProductsT'];
} else {
  $all_RecProductsT = mysql_query($query_RecProductsT);
  $totalRows_RecProductsT = mysql_num_rows($all_RecProductsT);
}
$totalPages_RecProductsT = ceil($totalRows_RecProductsT/$maxRows_RecProductsT)-1;
$TotalPage = $totalPages_RecProductsT;


$queryString_RecProductsT = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum") == false && 
        stristr($param, "totalRows_RecProductsT") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecProductsT = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecProductsT = sprintf("&totalRows_RecProductsT=%d%s", $totalRows_RecProductsT, $queryString_RecProductsT);
 $menu_is="products";?>
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
 	  else if ($R_pageNum>$totalPages_RecProductsT)
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
	if($R_pageNum>$totalPages_RecProductsT && $R_pageNum!=0)
	{
		header("Location:productsT_list.php?pageNum=".$totalPages_RecProductsT);
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
	
	//echo "now_term_id=".$_GET['now_term_id'];
	//echo "change_num=".$_GET['change_num'];
	
	mysql_select_db($database_connect2data, $connect2data);
	$query_RecProductsT = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='post_tag' ORDER BY term_sort ASC, term_id DESC";
	$RecProductsT = mysql_query($query_RecProductsT, $connect2data) or die(mysql_error());
	$row_RecProductsT = mysql_fetch_assoc($RecProductsT);
	

	do{
	
		if($row_RecProductsT['term_sort']==0)
		{}
		else if($row_RecProductsT['term_id']==$_GET['now_term_id'])
		{	
			echo $sort_num."<br/>";
			
		}else if($sort_num==$_GET['change_num'])
		{
			echo $sort_num."<br/>";
			$sort_num++;
			
			$updateSQL = sprintf("UPDATE terms SET term_sort=%s WHERE term_id=%s",
			   GetSQLValueString($sort_num, "int"),
			   GetSQLValueString($row_RecProductsT['term_id'], "int"));

			mysql_select_db($database_connect2data, $connect2data);
			$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
			
			$sort_num++;
		}
		else
		{
			$updateSQL = sprintf("UPDATE terms SET term_sort=%s WHERE term_id=%s",
			   GetSQLValueString($sort_num, "int"),
			   GetSQLValueString($row_RecProductsT['term_id'], "int"));

			mysql_select_db($database_connect2data, $connect2data);
			$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
			
			echo $sort_num."<br/>";
			echo $row_RecProductsT['title']."->".$sort_num."<br/>";
			
			$sort_num++;		
		}
		
		
	//echo " ".$row_RecProductsT['term_sort'];
	}while ($row_RecProductsT = mysql_fetch_assoc($RecProductsT));
	
	
			$updateSQL = sprintf("UPDATE terms SET term_sort=%s WHERE term_id=%s",
			   GetSQLValueString($_GET['change_num'], "int"),
			   GetSQLValueString($_GET['now_term_id'], "int"));

			mysql_select_db($database_connect2data, $connect2data);
			$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
	if($G_changeSort==1)
	{
	header("Location:productsT_list.php?pageNum=".$_GET['pageNum']."&totalRows_RecProductsT=".$_GET['totalRows_RecProductsT']);
	}else if($G_delchangeSort==1)
	{
	header("Location:productsT_list.php?pageNum=".$_GET['pageNum']);
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
function changeSort(pageNum, totalRows_RecProductsT, now_term_id, change_num) { //v1.0
 //alert(pageNum+"+"+totalPages_RecProductsT); 
 window.location.href="productsT_list.php?pageNum="+pageNum+"&totalRows_RecProductsT="+totalRows_RecProductsT+"&changeSort=1"+"&now_term_id="+now_term_id+"&change_num="+change_num;
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
        	<td width="140" class="list_title">產品分類列表</td>
        	<td width="884"><span class="no_data">
            <?php if ($totalRows_RecProductsT == 0) { // Show if recordset empty ?>
              <strong>目前資料庫中沒有任何產品分類</strong>
              <?php } // Show if recordset empty ?>
</span> </td>
        </tr>
    </table>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
    	<tr>
            <td width="739" align="right" class="page_display">
            <!-------顯示頁選擇與分頁設定開始---------->
            <?php 	
	displayPages($pageNum, $queryString_RecProductsT, $totalPages_RecProductsT, $totalRows_RecProductsT, $currentPage);
	?>
<!-------顯示頁選擇與分頁設定結束---------->
            <td width="110" align="right" class="page_display"><?php if ($totalRows_RecProductsT > 0) { // Show if recordset not empty ?>
                頁數:<?php echo (($pageNum+1)."/".($totalPages_RecProductsT+1)); ?>
  <?php } // Show if recordset not empty ?>
</td>
            <td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows_RecProductsT ?> </td>
            <td width="24" align="right">&nbsp;</td>
     	</tr>
	</table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        	<td><img src="image/spacer.gif" width="1" height="1" /></td>
        </tr>
    </table>
	<form action="productsT_process.php" method="post" name="form1" id="form1">
      <?php if ($totalRows_RecProductsT > 0) { // Show if recordset not empty ?>
        <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
          <tr>
        	<td width="100" align="center" class="table_title">排序</td>
            <td align="center" class="table_title">分類名稱</td>
            <td width="40" align="center" class="table_title">狀態</td>
          <?php if(in_array(5,$_SESSION['MM_Limit']['a4'])){ ?>
            <td width="40" align="center" class="table_title">編輯</td>
            <?php } ?>
            <?php if(in_array(7,$_SESSION['MM_Limit']['a4'])){ ?>
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
		if (isset($row_RecProductsT['term_id'])) {
		  $colname_RecImage = $row_RecProductsT['term_id'];
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
          if(in_array(5,$_SESSION['MM_Limit']['a4'])){
			  ?>
           <label>
        <select name="term_sort" id="term_sort" onchange="changeSort('<?php echo $pageNum; ?>','<?php echo $totalRows_RecProductsT; ?>','<?php echo $row_RecProductsT['term_id']; ?>',this.options[this.selectedIndex].value)">
          <option value="0" <?php if (!(strcmp(0, $row_RecProductsT['term_sort']))) {echo "selected=\"selected\"";} ?>>至頂</option>
          <?php
		 		
          for($j=1;$j<=($totalRows_RecProductsT);$j++)
          {
          	echo "<option value=\"".$j."\" ";
			if (!(strcmp($j, $row_RecProductsT['term_sort']))) {echo "selected=\"selected\"";}
			echo ">".$j."</option>";
          }
		  ?>
        </select>
        </label>
		<?php }else{
			if (!(strcmp(0, $row_RecProductsT['term_sort']))) {
				echo "至頂";
			}else{
				echo $row_RecProductsT['term_sort'];
			}
			
		} ?>
            
            
            <?php $_SESSION['totalRows']=$totalRows_RecProductsT; ?></td>
         <td align="center" class="table_data" >
         
         <?php
          if(in_array(5,$_SESSION['MM_Limit']['a4'])){
			  echo '<a href="productsT_edit.php?term_id='.$row_RecProductsT['term_id'].'">'.$row_RecProductsT['name'].'</a>';
		  }else{
			  echo $row_RecProductsT['name'];
		  }
		  ?>
         </td>
         
            <td align="center"  class="table_data">
			
			<?php
          if(in_array(5,$_SESSION['MM_Limit']['a4'])){
			  if($row_RecProductsT['term_active']){
					echo "<a href='".$row_RecProductsT['term_active']."' rel='".$row_RecProductsT['term_id']."' class='activeChT'><img src=\"image/accept.png\" width=\"16\" height=\"16\"  ></a>";
				}else{
					echo "<a href='".$row_RecProductsT['term_active']."' rel='".$row_RecProductsT['term_id']."' class='activeChT'><img src=\"image/delete.png\" width=\"16\" height=\"16\"  ></a>";
				}
		  }else{
			  if($row_RecProductsT['term_active']){
					echo "<img src=\"image/accept.png\" width=\"16\" height=\"16\"  >";
				}else{
					echo "<img src=\"image/delete.png\" width=\"16\" height=\"16\"  >";
				}
		  }
		  ?>
			
			
			<?php  //list使用
				/*if($row_RecProductsT['term_active'])
				{
					echo "<a href='productsT_process.php?term_id=".$row_RecProductsT['term_id']."&active=".$row_RecProductsT['term_active']."'><img src=\"image/accept.png\" width=\"16\" height=\"16\"  ></a>";
				}
				else
				{
					echo "<a href='productsT_process.php?term_id=".$row_RecProductsT['term_id']."&active=".$row_RecProductsT['term_active']."'><img src=\"image/delete.png\" width=\"16\" height=\"16\"  ></a>";
				}*/
				
?></td>

<?php if(in_array(5,$_SESSION['MM_Limit']['a4'])){ ?>
    <td align="center" class="table_data"><a href="productsT_edit.php?term_id=<?php echo $row_RecProductsT['term_id']; ?>"><img src="image/pencil.png" width="16" height="16" /></a></td>
    <?php } ?>
            <?php if(in_array(7,$_SESSION['MM_Limit']['a4'])){ ?>
    <td align="center" class="table_data"><a href="productsT_del.php?term_id=<?php echo $row_RecProductsT['term_id']; ?>"><img src="image/cross.png" width="16" height="16" /></a></td>
    <?php } ?>

            <!--<td align="center" class="table_data"><a href="productsT_edit.php?term_id=<?php echo $row_RecProductsT['term_id']; ?>"><img src="image/pencil.png" width="16" height="16" /></a></td>
            <td align="center" class="table_data"><a href="productsT_del.php?term_id=<?php echo $row_RecProductsT['term_id']; ?>"><img src="image/cross.png" width="16" height="16" /></a></td>-->
          </tr>
          <?php } while ($row_RecProductsT = mysql_fetch_assoc($RecProductsT)); ?>
        </table>
        <?php } // Show if recordset not empty ?>
</form>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
        <tr>
            <td width="739" align="right" class="page_display">
            <!-------顯示頁選擇與分頁設定開始---------->
            <?php 	
	displayPages($pageNum, $queryString_RecProductsT, $totalPages_RecProductsT, $totalRows_RecProductsT, $currentPage);
	?>
<!-------顯示頁選擇與分頁設定結束---------->
            <td width="110" align="right" class="page_display"><?php if ($totalRows_RecProductsT > 0) { // Show if recordset not empty ?>
                頁數:<?php echo (($pageNum+1)."/".($totalPages_RecProductsT+1)); ?>
  <?php } // Show if recordset not empty ?>
</td>
            <td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows_RecProductsT ?> </td>
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
mysql_free_result($RecProductsT);
?>
