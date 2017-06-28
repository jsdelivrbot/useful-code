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

$maxRows_RecReport = 10;
$pageNum_RecReport = 0;
if (isset($_GET['pageNum_RecReport'])) {
  $pageNum_RecReport = $_GET['pageNum_RecReport'];
}
$startRow_RecReport = $pageNum_RecReport * $maxRows_RecReport;

mysql_select_db($database_connect2data, $connect2data);
$query_RecReport = "SELECT * FROM data_set WHERE d_class1 = 'report' ORDER BY d_sort ASC, d_date DESC";
$query_limit_RecReport = sprintf("%s LIMIT %d, %d", $query_RecReport, $startRow_RecReport, $maxRows_RecReport);
$RecReport = mysql_query($query_limit_RecReport, $connect2data) or die(mysql_error());
$row_RecReport = mysql_fetch_assoc($RecReport);

if (isset($_GET['totalRows_RecReport'])) {
  $totalRows_RecReport = $_GET['totalRows_RecReport'];
} else {
  $all_RecReport = mysql_query($query_RecReport);
  $totalRows_RecReport = mysql_num_rows($all_RecReport);
}
$totalPages_RecReport = ceil($totalRows_RecReport/$maxRows_RecReport)-1;
$TotalPage = $totalPages_RecReport;

$queryString_RecReport = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RecReport") == false && 
        stristr($param, "totalRows_RecReport") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecReport = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecReport = sprintf("&totalRows_RecReport=%d%s", $totalRows_RecReport, $queryString_RecReport);
 $menu_is="report";?>
 <?php 
 $R_pageNum_RecReport = 0;
 if (isset($_REQUEST["pageNum_RecReport"])) 
 {
 	$R_pageNum_RecReport = $_REQUEST["pageNum_RecReport"];
 }
      if (! isset($R_pageNum_RecReport)) 
      {
	  	$_SESSION["ToPage"]=0;
	  }
 	  //若指定分頁數小於1則預設顯示第一頁
  	  else if ($R_pageNum_RecReport<0) 
      {
	  	$_SESSION["ToPage"]=0;
      }
	  //若指定指定的分頁超過總分頁數則顯示最後一頁
 	  else if ($R_pageNum_RecReport>$totalPages_RecReport)
      {
	  	$_SESSION["ToPage"]=$TotalPage;
	  }
	  else
	  {
	  	$_SESSION["ToPage"]=$R_pageNum_RecReport;
 	  }
?>
<?php
	//如果指定的頁面大於資料所擁有的頁面,轉到最大的頁面
	if($R_pageNum_RecReport>$totalPages_RecReport && $R_pageNum_RecReport!=0)
	{
		header("Location:report_list.php?pageNum_RecReport=".$totalPages_RecReport);
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
	$query_RecReport = "SELECT * FROM data_set WHERE d_class1 = 'report' ORDER BY d_sort ASC, d_date DESC";
	$RecReport = mysql_query($query_RecReport, $connect2data) or die(mysql_error());
	$row_RecReport = mysql_fetch_assoc($RecReport);
	

	do{
	
		if($row_RecReport['d_sort']==0)
		{}
		else if($row_RecReport['d_id']==$_GET['now_d_id'])
		{	
			echo $sort_num."<br/>";
			
		}else if($sort_num==$_GET['change_num'])
		{
			echo $sort_num."<br/>";
			$sort_num++;
			
			$updateSQL = sprintf("UPDATE data_set SET d_sort=%s WHERE d_id=%s",
			   GetSQLValueString($sort_num, "int"),
			   GetSQLValueString($row_RecReport['d_id'], "int"));

			mysql_select_db($database_connect2data, $connect2data);
			$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
			
			$sort_num++;
		}
		else
		{
			$updateSQL = sprintf("UPDATE data_set SET d_sort=%s WHERE d_id=%s",
			   GetSQLValueString($sort_num, "int"),
			   GetSQLValueString($row_RecReport['d_id'], "int"));

			mysql_select_db($database_connect2data, $connect2data);
			$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
			
			echo $sort_num."<br/>";
			echo $row_RecReport['d_title']."->".$sort_num."<br/>";
			
			$sort_num++;		
		}
		
		
	//echo " ".$row_RecReport['d_sort'];
	}while ($row_RecReport = mysql_fetch_assoc($RecReport));
	
	
			$updateSQL = sprintf("UPDATE data_set SET d_sort=%s WHERE d_id=%s",
			   GetSQLValueString($_GET['change_num'], "int"),
			   GetSQLValueString($_GET['now_d_id'], "int"));

			mysql_select_db($database_connect2data, $connect2data);
			$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
	if($G_changeSort==1)
	{
	header("Location:report_list.php?pageNum_RecReport=".$_GET['pageNum_RecReport']."&totalRows_RecReport=".$_GET['totalRows_RecReport']);
	}else if($G_delchangeSort==1)
	{
	header("Location:report_list.php?pageNum_RecReport=".$_GET['pageNum_RecReport']);
	}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php require_once('cmsTitle.php'); ?></title>
<?php require_once('script.php'); ?>
<!-- InstanceBeginEditable name="doctitle" -->
<title>無標題文件</title>
<script type="text/javascript">
<!--
function changeSort(pageNum_RecReport, totalRows_RecReport, now_d_id, change_num) { //v1.0
 //alert(pageNum_RecReport+"+"+totalPages_RecReport); 
 window.location.href="report_list.php?pageNum_RecReport="+pageNum_RecReport+"&totalRows_RecReport="+totalRows_RecReport+"&changeSort=1"+"&now_d_id="+now_d_id+"&change_num="+change_num;
}
//-->
</script>
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
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
    	<tr>
        	<td width="142" class="list_title">相關報導列表</td>
        	<td width="882"><span class="no_data">
            <?php if ($totalRows_RecReport == 0) { // Show if recordset empty ?>
              <strong>抱歉!找不到任何資料~</strong>
              <?php } // Show if recordset empty ?>
</span> </td>
        </tr>
    </table>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
    	<tr>
            <td width="739" align="right" class="page_display">
            <!-------顯示頁選擇與分頁設定開始---------->
    <table border="0">
      <tr>
        <td><?php if ($pageNum_RecReport > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_RecReport=%d%s", $currentPage, max(0, $pageNum_RecReport - 1), $queryString_RecReport); ?>"><</a>
              <?php } // Show if not first page ?>
        </td>
        
        <td>
        <?php
			//echo $totalRows_RecReport;//所有筆數
			//echo $totalPages_RecReport;//最後分頁的頁數,由0開始的陣列
			//echo $pageNum_RecReport;//現在顯示的頁面,由0開始的陣列
			//echo $currentPage;//現在的目錄路徑
			//echo $queryString_RecReport;//以字串顯示所有的筆數,如&totalRows_RecReport=11
			if($totalPages_RecReport<10)
			{
				if($totalRows_RecReport == 0)
				{
					//如果沒有任何資料，不顯示|符號
				}
				else
				{
					echo " | ";
				}
				
				for ($i=1; $i<=$totalPages_RecReport+1; $i++)
				{
				  //如果非正在顯示的分頁則建立頁碼連結
				  if ($i != $pageNum_RecReport+1 )
				  { 
					
					echo "<a href=";
					printf("%s?pageNum_RecReport=%d%s", $currentPage, $i-1, $queryString_RecReport);
					echo ">" . $i . "</a> | " ;
				  }
				  //如果是正在顯示的方頁則單純顯示頁碼
				  else
				  { 
					echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
				  }
				}
			}
			else//$totalPages_RecReport>10
			{
				$morePage_num=$totalPages_RecReport-$pageNum_RecReport;//此頁面之後總共有多少
				if($morePage_num>7)
				{
					if($pageNum_RecReport<3)
					{
						if($totalRows_RecReport == 0)
						{
							//如果沒有任何資料，不顯示|符號
						}
						else
						{
							echo " | ";
						}
				
						for ($i=1; $i<=10; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecReport+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecReport=%d%s", $currentPage, $i-1, $queryString_RecReport);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
							echo "<a href=";
							printf("%s?pageNum_RecReport=%d%s", $currentPage, $totalPages_RecReport, $queryString_RecReport);
							echo ">..." .($totalPages_RecReport+1). "</a> | " ;
					}
					else//$pageNum_RecReport>=3
					{
						echo "<a href=";
						printf("%s?pageNum_RecReport=%d%s", $currentPage, 0, $queryString_RecReport);
						echo ">" . 1 . "...</a> | " ;
												
						for ($i=$pageNum_RecReport-1; $i<=$pageNum_RecReport+8; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecReport+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecReport=%d%s", $currentPage, $i-1, $queryString_RecReport);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
						echo "<a href=";
						printf("%s?pageNum_RecReport=%d%s", $currentPage, $totalPages_RecReport, $queryString_RecReport);
						echo ">..." .($totalPages_RecReport+1). "</a> | " ;
					}
				}
				else//$morePage_num<=7
				{
						$beforePage_num=9-$morePage_num;
						$beforePage=$pageNum_RecReport-$beforePage_num;
						
						//echo "<br>beforePage_num=".$beforePage_num."<br>";
						//echo "beforePage=".$beforePage."<br>";
						
						echo "<a href=";
						printf("%s?pageNum_RecReport=%d%s", $currentPage, 0, $queryString_RecReport);
						echo ">" . 1 . "...</a> | " ;
							
						for ($i=$beforePage+1; $i<=$totalPages_RecReport+1; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecReport+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecReport=%d%s", $currentPage, $i-1, $queryString_RecReport);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
				}

			}
		
		?>
        </td>
        
        <td><?php if ($pageNum_RecReport < $totalPages_RecReport) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_RecReport=%d%s", $currentPage, min($totalPages_RecReport, $pageNum_RecReport + 1), $queryString_RecReport); ?>">></a>
              <?php } // Show if not last page ?>
        </td>
 <?php ?>      
        
        

      </tr>
    </table>
<!-------顯示頁選擇與分頁設定結束---------->
            <td width="110" align="right" class="page_display"><?php if ($totalRows_RecReport > 0) { // Show if recordset not empty ?>
                頁數:<?php echo (($pageNum_RecReport+1)."/".($totalPages_RecReport+1)); ?>
  <?php } // Show if recordset not empty ?>
</td>
            <td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows_RecReport ?> </td>
            <td width="24" align="right">&nbsp;</td>
     	</tr>
	</table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        	<td><img src="image/spacer.gif" width="1" height="1" /></td>
        </tr>
    </table>
	<form action="report_process.php" method="post" name="form1" id="form1">
      <?php if ($totalRows_RecReport > 0) { // Show if recordset not empty ?>
        <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
          <tr>
            <td width="142" align="center" class="table_title">日期</td>
            <td width="74" align="center" class="table_title">排序</td>
            <td width="470" align="center" class="table_title">標題</td>
            <td width="140" align="center" class="table_title">圖片</td>
            <td width="60" align="center" class="table_title">在網頁顯示</td>
            <td width="30" align="center" class="table_title">編輯</td>
            <td width="30" align="center" class="table_title">刪除</td>
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
		if (isset($row_RecReport['d_id'])) {
		  $colname_RecImage = $row_RecReport['d_id'];
		}
		mysql_select_db($database_connect2data, $connect2data);
		$query_RecImage = sprintf("SELECT * FROM file_set WHERE file_type='reportImage' AND file_d_id = %s", GetSQLValueString($colname_RecImage, "int"));
		$RecImage = mysql_query($query_RecImage, $connect2data) or die(mysql_error());
		$row_RecImage = mysql_fetch_assoc($RecImage);
		$totalRows_RecImage = mysql_num_rows($RecImage);
		
		//echo $totalRows_RecImage;
		if($totalRows_RecImage==0){
			$query_RecImage = sprintf("SELECT * FROM file_set WHERE file_type='image' AND file_d_id = %s", GetSQLValueString($colname_RecImage, "int"));
			$RecImage = mysql_query($query_RecImage, $connect2data) or die(mysql_error());
			$row_RecImage = mysql_fetch_assoc($RecImage);
			$totalRows_RecImage = mysql_num_rows($RecImage);
			if($totalRows_RecImage==0){
				$imgLink = "image/default_image_s.jpg";
			}else{
				$imgLink = "../".$row_RecImage['file_link2'];
			}
		}else{
			$imgLink = "../".$row_RecImage['file_link3'];
		}
		
		
		?>
          <td align="center" class="table_data" ><a href="report_edit.php?d_id=<?php echo $row_RecReport['d_id']; ?>"><?php echo $row_RecReport['d_date']; ?></a></td>
          <td align="center" class="table_data" ><label>
        <select name="d_sort" id="d_sort" onchange="changeSort('<?php echo $pageNum_RecReport; ?>','<?php echo $totalRows_RecReport; ?>','<?php echo $row_RecReport['d_id']; ?>',this.options[this.selectedIndex].value)">
          <option value="0" <?php if (!(strcmp(0, $row_RecReport['d_sort']))) {echo "selected=\"selected\"";} ?>>至頂</option>
          <?php
		 		
          for($j=1;$j<=($totalRows_RecReport);$j++)
          {
          	echo "<option value=\"".$j."\" ";
			if (!(strcmp($j, $row_RecReport['d_sort']))) {echo "selected=\"selected\"";}
			echo ">".$j."</option>";
          }
		  ?>
        </select>
        </label><?php $_SESSION['totalRows']=$totalRows_RecReport; ?></td>
        <td align="center" class="table_data" ><a href="report_edit.php?d_id=<?php echo $row_RecReport['d_id']; ?>"><?php echo $row_RecReport['d_title']; ?></a></td>
            <td align="center"  class="table_data"><a href="report_edit.php?d_id=<?php echo $row_RecReport['d_id']; ?>"><img src="<?php echo $imgLink; ?>" width="84" class="image_frame" /></a></td>
            <td align="center"  class="table_data"><?php  //list使用
				if($row_RecReport['d_active'])
				{
					echo "<a href='".$row_RecReport['d_active']."' rel='".$row_RecReport['d_id']."' class='activeCh'><img src=\"image/accept.png\" width=\"16\" height=\"16\"  ></a>";
				}
				else
				{
					echo "<a href='".$row_RecReport['d_active']."' rel='".$row_RecReport['d_id']."' class='activeCh'><img src=\"image/delete.png\" width=\"16\" height=\"16\"  ></a>";
				}
				
?></td>
            <td align="center" class="table_data"><a href="report_edit.php?d_id=<?php echo $row_RecReport['d_id']; ?>"><img src="image/pencil.png" width="16" height="16" /></a></td>
            <td align="center" class="table_data"><a href="report_del.php?d_id=<?php echo $row_RecReport['d_id']; ?>"><img src="image/cross.png" width="16" height="16" /></a></td>
          </tr>
          <?php } while ($row_RecReport = mysql_fetch_assoc($RecReport)); ?>
        </table>
        <?php } // Show if recordset not empty ?>
</form>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
        <tr>
            <td width="739" align="right" class="page_display">
            <!-------顯示頁選擇與分頁設定開始---------->
    <table border="0">
      <tr>
        <td><?php if ($pageNum_RecReport > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_RecReport=%d%s", $currentPage, max(0, $pageNum_RecReport - 1), $queryString_RecReport); ?>"><</a>
              <?php } // Show if not first page ?>
        </td>
        
        <td>
        <?php
			//echo $totalRows_RecReport;//所有筆數
			//echo $totalPages_RecReport;//最後分頁的頁數,由0開始的陣列
			//echo $pageNum_RecReport;//現在顯示的頁面,由0開始的陣列
			//echo $currentPage;//現在的目錄路徑
			//echo $queryString_RecReport;//以字串顯示所有的筆數,如&totalRows_RecReport=11
			if($totalPages_RecReport<10)
			{
				if($totalRows_RecReport == 0)
				{
					//如果沒有任何資料，不顯示|符號
				}
				else
				{
					echo " | ";
				}
				
				for ($i=1; $i<=$totalPages_RecReport+1; $i++)
				{
				  //如果非正在顯示的分頁則建立頁碼連結
				  if ($i != $pageNum_RecReport+1 )
				  { 
					
					echo "<a href=";
					printf("%s?pageNum_RecReport=%d%s", $currentPage, $i-1, $queryString_RecReport);
					echo ">" . $i . "</a> | " ;
				  }
				  //如果是正在顯示的方頁則單純顯示頁碼
				  else
				  { 
					echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
				  }
				}
			}
			else//$totalPages_RecReport>10
			{
				$morePage_num=$totalPages_RecReport-$pageNum_RecReport;//此頁面之後總共有多少
				if($morePage_num>7)
				{
					if($pageNum_RecReport<3)
					{
						if($totalRows_RecReport == 0)
						{
							//如果沒有任何資料，不顯示|符號
						}
						else
						{
							echo " | ";
						}
				
						for ($i=1; $i<=10; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecReport+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecReport=%d%s", $currentPage, $i-1, $queryString_RecReport);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
							echo "<a href=";
							printf("%s?pageNum_RecReport=%d%s", $currentPage, $totalPages_RecReport, $queryString_RecReport);
							echo ">..." .($totalPages_RecReport+1). "</a> | " ;
					}
					else//$pageNum_RecReport>=3
					{
						echo "<a href=";
						printf("%s?pageNum_RecReport=%d%s", $currentPage, 0, $queryString_RecReport);
						echo ">" . 1 . "...</a> | " ;
												
						for ($i=$pageNum_RecReport-1; $i<=$pageNum_RecReport+8; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecReport+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecReport=%d%s", $currentPage, $i-1, $queryString_RecReport);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
						echo "<a href=";
						printf("%s?pageNum_RecReport=%d%s", $currentPage, $totalPages_RecReport, $queryString_RecReport);
						echo ">..." .($totalPages_RecReport+1). "</a> | " ;
					}
				}
				else//$morePage_num<=7
				{
						$beforePage_num=9-$morePage_num;
						$beforePage=$pageNum_RecReport-$beforePage_num;
						
						//echo "<br>beforePage_num=".$beforePage_num."<br>";
						//echo "beforePage=".$beforePage."<br>";
						
						echo "<a href=";
						printf("%s?pageNum_RecReport=%d%s", $currentPage, 0, $queryString_RecReport);
						echo ">" . 1 . "...</a> | " ;
							
						for ($i=$beforePage+1; $i<=$totalPages_RecReport+1; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecReport+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecReport=%d%s", $currentPage, $i-1, $queryString_RecReport);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
				}

			}
		
		?>
        </td>
        
        <td><?php if ($pageNum_RecReport < $totalPages_RecReport) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_RecReport=%d%s", $currentPage, min($totalPages_RecReport, $pageNum_RecReport + 1), $queryString_RecReport); ?>">></a>
              <?php } // Show if not last page ?>
        </td>
 <?php ?>      
        
        

      </tr>
    </table>
<!-------顯示頁選擇與分頁設定結束---------->
            <td width="110" align="right" class="page_display"><?php if ($totalRows_RecReport > 0) { // Show if recordset not empty ?>
                頁數:<?php echo (($pageNum_RecReport+1)."/".($totalPages_RecReport+1)); ?>
  <?php } // Show if recordset not empty ?>
</td>
            <td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows_RecReport ?> </td>
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
mysql_free_result($RecReport);
?>
