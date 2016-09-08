<?php
			if (!isset($_SESSION)) {
               session_start();
               }
            ob_start();
?>
<?php require_once('../Connections/connect2data.php'); ?>
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
//echo "ToPage = ".$_SESSION["ToPage"]."<br/>";
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RecEpaper = 10;
$pageNum_RecEpaper = 0;
if (isset($_GET['pageNum_RecEpaper'])) {
  $pageNum_RecEpaper = $_GET['pageNum_RecEpaper'];
}
$startRow_RecEpaper = $pageNum_RecEpaper * $maxRows_RecEpaper;

mysql_select_db($database_connect2data, $connect2data);
$query_RecEpaper = "SELECT * FROM epaper_set WHERE e_class1 = 'epaper' ORDER BY e_sort ASC, e_date DESC";
$query_limit_RecEpaper = sprintf("%s LIMIT %d, %d", $query_RecEpaper, $startRow_RecEpaper, $maxRows_RecEpaper);
$RecEpaper = mysql_query($query_limit_RecEpaper, $connect2data) or die(mysql_error());
$row_RecEpaper = mysql_fetch_assoc($RecEpaper);

if (isset($_GET['totalRows_RecEpaper'])) {
  $totalRows_RecEpaper = $_GET['totalRows_RecEpaper'];
} else {
  $all_RecEpaper = mysql_query($query_RecEpaper);
  $totalRows_RecEpaper = mysql_num_rows($all_RecEpaper);
}
$totalPages_RecEpaper = ceil($totalRows_RecEpaper/$maxRows_RecEpaper)-1;
$TotalPage = $totalPages_RecEpaper;
//echo "totalPages_RecEpaper = ".$totalPages_RecEpaper."<br/>";
//echo "TotalPage = ".$TotalPage;
$queryString_RecEpaper = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RecEpaper") == false && 
        stristr($param, "totalRows_RecEpaper") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecEpaper = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecEpaper = sprintf("&totalRows_RecEpaper=%d%s", $totalRows_RecEpaper, $queryString_RecEpaper);
 $menu_is="epaper";?>
 <?php 
 $R_pageNum_RecEpaper = 0;
 if (isset($_REQUEST["pageNum_RecEpaper"])) 
 {
 	$R_pageNum_RecEpaper = $_REQUEST["pageNum_RecEpaper"];
 }
      if (! isset($R_pageNum_RecEpaper)) 
      {
	  	$_SESSION["ToPage"]=0;
	  }
 	  //若指定分頁數小於1則預設顯示第一頁
  	  else if ($R_pageNum_RecEpaper<0) 
      {
	  	$_SESSION["ToPage"]=0;
      }
	  //若指定指定的分頁超過總分頁數則顯示最後一頁
 	  else if ($R_pageNum_RecEpaper>$totalPages_RecEpaper)
      {
	  	$_SESSION["ToPage"]=$TotalPage;
	  }
	  else
	  {
	  	$_SESSION["ToPage"]=$R_pageNum_RecEpaper;
 	  }
?>
<?php
	//如果指定的頁面大於資料所擁有的頁面,轉到最大的頁面
	if($R_pageNum_RecEpaper>$totalPages_RecEpaper && $R_pageNum_RecEpaper!=0)
	{
		header("Location:epaper_list.php?pageNum_RecEpaper=".$totalPages_RecEpaper);
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
	
	//echo "now_e_id=".$_GET['now_e_id'];
	//echo "change_num=".$_GET['change_num'];
	
	mysql_select_db($database_connect2data, $connect2data);
	$query_RecEpaper = "SELECT * FROM epaper_set WHERE e_class1 = 'epaper' ORDER BY e_sort ASC, e_date DESC";
	$RecEpaper = mysql_query($query_RecEpaper, $connect2data) or die(mysql_error());
	$row_RecEpaper = mysql_fetch_assoc($RecEpaper);
	

	do{
	
		if($row_RecEpaper['e_sort']==0)
		{}
		else if($row_RecEpaper['e_id']==$_GET['now_e_id'])
		{	
			echo $sort_num."<br/>";
			
		}else if($sort_num==$_GET['change_num'])
		{
			echo $sort_num."<br/>";
			$sort_num++;
			
			$updateSQL = sprintf("UPDATE epaper_set SET e_sort=%s WHERE e_id=%s",
			   GetSQLValueString($sort_num, "int"),
			   GetSQLValueString($row_RecEpaper['e_id'], "int"));

			mysql_select_db($database_connect2data, $connect2data);
			$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
			
			$sort_num++;
		}
		else
		{
			$updateSQL = sprintf("UPDATE epaper_set SET e_sort=%s WHERE e_id=%s",
			   GetSQLValueString($sort_num, "int"),
			   GetSQLValueString($row_RecEpaper['e_id'], "int"));

			mysql_select_db($database_connect2data, $connect2data);
			$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
			
			echo $sort_num."<br/>";
			echo $row_RecEpaper['e_title']."->".$sort_num."<br/>";
			
			$sort_num++;		
		}
		
		
	//echo " ".$row_RecEpaper['e_sort'];
	}while ($row_RecEpaper = mysql_fetch_assoc($RecEpaper));
	
	
			$updateSQL = sprintf("UPDATE epaper_set SET e_sort=%s WHERE e_id=%s",
			   GetSQLValueString($_GET['change_num'], "int"),
			   GetSQLValueString($_GET['now_e_id'], "int"));

			mysql_select_db($database_connect2data, $connect2data);
			$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
	if($G_changeSort==1)
	{
	header("Location:epaper_list.php?pageNum_RecEpaper=".$_GET['pageNum_RecEpaper']."&totalRows_RecEpaper=".$_GET['totalRows_RecEpaper']);
	}else if($G_delchangeSort==1)
	{
	header("Location:epaper_list.php?pageNum_RecEpaper=".$_GET['pageNum_RecEpaper']);
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
function changeSort(pageNum_RecEpaper, totalRows_RecEpaper, now_e_id, change_num) { //v1.0
 //alert(pageNum_RecEpaper+"+"+totalPages_RecEpaper); 
 window.location.href="epaper_list.php?pageNum_RecEpaper="+pageNum_RecEpaper+"&totalRows_RecEpaper="+totalRows_RecEpaper+"&changeSort=1"+"&now_e_id="+now_e_id+"&change_num="+change_num;
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
        	<td width="117" class="list_title">電子報列表</td>
        	<td width="683"><span class="no_data">
            <?php if ($totalRows_RecEpaper == 0) { // Show if recordset empty ?>
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
        <td><?php if ($pageNum_RecEpaper > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_RecEpaper=%d%s", $currentPage, max(0, $pageNum_RecEpaper - 1), $queryString_RecEpaper); ?>"><</a>
              <?php } // Show if not first page ?>
        </td>
        
        <td>
        <?php
			//echo $totalRows_RecEpaper;//所有筆數
			//echo $totalPages_RecEpaper;//最後分頁的頁數,由0開始的陣列
			//echo $pageNum_RecEpaper;//現在顯示的頁面,由0開始的陣列
			//echo $currentPage;//現在的目錄路徑
			//echo $queryString_RecEpaper;//以字串顯示所有的筆數,如&totalRows_RecEpaper=11
			if($totalPages_RecEpaper<10)
			{
				if($totalRows_RecEpaper == 0)
				{
					//如果沒有任何資料，不顯示|符號
				}
				else
				{
					echo " | ";
				}
				
				for ($i=1; $i<=$totalPages_RecEpaper+1; $i++)
				{
				  //如果非正在顯示的分頁則建立頁碼連結
				  if ($i != $pageNum_RecEpaper+1 )
				  { 
					
					echo "<a href=";
					printf("%s?pageNum_RecEpaper=%d%s", $currentPage, $i-1, $queryString_RecEpaper);
					echo ">" . $i . "</a> | " ;
				  }
				  //如果是正在顯示的方頁則單純顯示頁碼
				  else
				  { 
					echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
				  }
				}
			}
			else//$totalPages_RecEpaper>10
			{
				$morePage_num=$totalPages_RecEpaper-$pageNum_RecEpaper;//此頁面之後總共有多少
				if($morePage_num>7)
				{
					if($pageNum_RecEpaper<3)
					{
						if($totalRows_RecEpaper == 0)
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
						  if ($i != $pageNum_RecEpaper+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecEpaper=%d%s", $currentPage, $i-1, $queryString_RecEpaper);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
							echo "<a href=";
							printf("%s?pageNum_RecEpaper=%d%s", $currentPage, $totalPages_RecEpaper, $queryString_RecEpaper);
							echo ">..." .($totalPages_RecEpaper+1). "</a> | " ;
					}
					else//$pageNum_RecEpaper>=3
					{
						echo "<a href=";
						printf("%s?pageNum_RecEpaper=%d%s", $currentPage, 0, $queryString_RecEpaper);
						echo ">" . 1 . "...</a> | " ;
												
						for ($i=$pageNum_RecEpaper-1; $i<=$pageNum_RecEpaper+8; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecEpaper+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecEpaper=%d%s", $currentPage, $i-1, $queryString_RecEpaper);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
						echo "<a href=";
						printf("%s?pageNum_RecEpaper=%d%s", $currentPage, $totalPages_RecEpaper, $queryString_RecEpaper);
						echo ">..." .($totalPages_RecEpaper+1). "</a> | " ;
					}
				}
				else//$morePage_num<=7
				{
						$beforePage_num=9-$morePage_num;
						$beforePage=$pageNum_RecEpaper-$beforePage_num;
						
						//echo "<br>beforePage_num=".$beforePage_num."<br>";
						//echo "beforePage=".$beforePage."<br>";
						
						echo "<a href=";
						printf("%s?pageNum_RecEpaper=%d%s", $currentPage, 0, $queryString_RecEpaper);
						echo ">" . 1 . "...</a> | " ;
							
						for ($i=$beforePage+1; $i<=$totalPages_RecEpaper+1; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecEpaper+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecEpaper=%d%s", $currentPage, $i-1, $queryString_RecEpaper);
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
        
        <td><?php if ($pageNum_RecEpaper < $totalPages_RecEpaper) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_RecEpaper=%d%s", $currentPage, min($totalPages_RecEpaper, $pageNum_RecEpaper + 1), $queryString_RecEpaper); ?>">></a>
              <?php } // Show if not last page ?>
        </td>
 <?php ?>      
        
        

      </tr>
    </table>
<!-------顯示頁選擇與分頁設定結束---------->
            <td width="110" align="right" class="page_display"><?php if ($totalRows_RecEpaper > 0) { // Show if recordset not empty ?>
                頁數:<?php echo (($pageNum_RecEpaper+1)."/".($totalPages_RecEpaper+1)); ?>
  <?php } // Show if recordset not empty ?>
</td>
            <td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows_RecEpaper ?> </td>
            <td width="24" align="right">&nbsp;</td>
     	</tr>
	</table>
    <table width="800" border="0" cellspacing="0" cellpadding="0">
        <tr>
        	<td><img src="image/spacer.gif" width="1" height="1" /></td>
        </tr>
    </table>
	<form action="epaper_process.php" method="post" name="form1" id="form1">
      <?php if ($totalRows_RecEpaper > 0) { // Show if recordset not empty ?>
        <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
          <tr>
            <td width="150" align="center" class="table_title">日期</td>
            <td width="90" align="center" class="table_title">排序</td>
            <td width="456" align="center" class="table_title">標題</td>
            <td width="90" align="center" class="table_title">發送電子報</td>
            <td width="60" align="center" class="table_title">已寄送次數</td>
            <td width="50" align="center" class="table_title">編輯</td>
            <td width="50" align="center" class="table_title">刪除</td>
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
          <td align="center" class="table_data" ><a href="epaper_edit.php?e_id=<?php echo $row_RecEpaper['e_id']; ?>"><?php echo $row_RecEpaper['e_date']; ?></a></td>
          <td align="center" class="table_data" ><label>
        <select name="e_sort" id="e_sort" onchange="changeSort('<?php echo $pageNum_RecEpaper; ?>','<?php echo $totalRows_RecEpaper; ?>','<?php echo $row_RecEpaper['e_id']; ?>',this.options[this.selectedIndex].value)">
          <option value="0" <?php if (!(strcmp(0, $row_RecEpaper['e_sort']))) {echo "selected=\"selected\"";} ?>>至頂</option>
          <?php
		 		
          for($j=1;$j<=($totalRows_RecEpaper);$j++)
          {
          	echo "<option value=\"".$j."\" ";
			if (!(strcmp($j, $row_RecEpaper['e_sort']))) {echo "selected=\"selected\"";}
			echo ">".$j."</option>";
          }
		  ?>
        </select>
        </label><?php $_SESSION['totalRows']=$totalRows_RecEpaper; ?></td>
        <td align="center" class="table_data" ><a href="epaper_edit.php?e_id=<?php echo $row_RecEpaper['e_id']; ?>"><?php echo $row_RecEpaper['e_title']; ?></a></td>
        <td align="center" class="table_data"><a href="epaper_sendCheck.php?e_id=<?php echo $row_RecEpaper['e_id']; ?>"><img src="image/letter.png" width="20" height="16" /></a></td>
            <td align="center"  class="table_data"><?php echo $row_RecEpaper['e_class2']; ?></td>
            <td align="center" class="table_data"><a href="epaper_edit.php?e_id=<?php echo $row_RecEpaper['e_id']; ?>"><img src="image/pencil.png" width="16" height="16" /></a></td>
            <td align="center" class="table_data"><a href="epaper_del.php?e_id=<?php echo $row_RecEpaper['e_id']; ?>"><img src="image/cross.png" width="16" height="16" /></a></td>
          </tr>
          <?php } while ($row_RecEpaper = mysql_fetch_assoc($RecEpaper)); ?>
        </table>
        <?php } // Show if recordset not empty ?>
</form>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
        <tr>
            <td width="739" align="right" class="page_display">
            <!-------顯示頁選擇與分頁設定開始---------->
    <table border="0">
      <tr>
        <td><?php if ($pageNum_RecEpaper > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_RecEpaper=%d%s", $currentPage, max(0, $pageNum_RecEpaper - 1), $queryString_RecEpaper); ?>"><</a>
              <?php } // Show if not first page ?>
        </td>
        
        <td>
        <?php
			//echo $totalRows_RecEpaper;//所有筆數
			//echo $totalPages_RecEpaper;//最後分頁的頁數,由0開始的陣列
			//echo $pageNum_RecEpaper;//現在顯示的頁面,由0開始的陣列
			//echo $currentPage;//現在的目錄路徑
			//echo $queryString_RecEpaper;//以字串顯示所有的筆數,如&totalRows_RecEpaper=11
			if($totalPages_RecEpaper<10)
			{
				if($totalRows_RecEpaper == 0)
				{
					//如果沒有任何資料，不顯示|符號
				}
				else
				{
					echo " | ";
				}
				
				for ($i=1; $i<=$totalPages_RecEpaper+1; $i++)
				{
				  //如果非正在顯示的分頁則建立頁碼連結
				  if ($i != $pageNum_RecEpaper+1 )
				  { 
					
					echo "<a href=";
					printf("%s?pageNum_RecEpaper=%d%s", $currentPage, $i-1, $queryString_RecEpaper);
					echo ">" . $i . "</a> | " ;
				  }
				  //如果是正在顯示的方頁則單純顯示頁碼
				  else
				  { 
					echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
				  }
				}
			}
			else//$totalPages_RecEpaper>10
			{
				$morePage_num=$totalPages_RecEpaper-$pageNum_RecEpaper;//此頁面之後總共有多少
				if($morePage_num>7)
				{
					if($pageNum_RecEpaper<3)
					{
						if($totalRows_RecEpaper == 0)
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
						  if ($i != $pageNum_RecEpaper+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecEpaper=%d%s", $currentPage, $i-1, $queryString_RecEpaper);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
							echo "<a href=";
							printf("%s?pageNum_RecEpaper=%d%s", $currentPage, $totalPages_RecEpaper, $queryString_RecEpaper);
							echo ">..." .($totalPages_RecEpaper+1). "</a> | " ;
					}
					else//$pageNum_RecEpaper>=3
					{
						echo "<a href=";
						printf("%s?pageNum_RecEpaper=%d%s", $currentPage, 0, $queryString_RecEpaper);
						echo ">" . 1 . "...</a> | " ;
												
						for ($i=$pageNum_RecEpaper-1; $i<=$pageNum_RecEpaper+8; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecEpaper+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecEpaper=%d%s", $currentPage, $i-1, $queryString_RecEpaper);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
						echo "<a href=";
						printf("%s?pageNum_RecEpaper=%d%s", $currentPage, $totalPages_RecEpaper, $queryString_RecEpaper);
						echo ">..." .($totalPages_RecEpaper+1). "</a> | " ;
					}
				}
				else//$morePage_num<=7
				{
						$beforePage_num=9-$morePage_num;
						$beforePage=$pageNum_RecEpaper-$beforePage_num;
						
						//echo "<br>beforePage_num=".$beforePage_num."<br>";
						//echo "beforePage=".$beforePage."<br>";
						
						echo "<a href=";
						printf("%s?pageNum_RecEpaper=%d%s", $currentPage, 0, $queryString_RecEpaper);
						echo ">" . 1 . "...</a> | " ;
							
						for ($i=$beforePage+1; $i<=$totalPages_RecEpaper+1; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecEpaper+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecEpaper=%d%s", $currentPage, $i-1, $queryString_RecEpaper);
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
        
        <td><?php if ($pageNum_RecEpaper < $totalPages_RecEpaper) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_RecEpaper=%d%s", $currentPage, min($totalPages_RecEpaper, $pageNum_RecEpaper + 1), $queryString_RecEpaper); ?>">></a>
              <?php } // Show if not last page ?>
        </td>
 <?php ?>      
        
        

      </tr>
    </table>
<!-------顯示頁選擇與分頁設定結束---------->
            <td width="110" align="right" class="page_display"><?php if ($totalRows_RecEpaper > 0) { // Show if recordset not empty ?>
                頁數:<?php echo (($pageNum_RecEpaper+1)."/".($totalPages_RecEpaper+1)); ?>
  <?php } // Show if recordset not empty ?>
</td>
            <td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows_RecEpaper ?> </td>
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
mysql_free_result($RecEpaper);
?>
