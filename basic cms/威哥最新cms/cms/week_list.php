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

if(!in_array(3,$_SESSION['MM_Limit']['a6'])){
	header("Location: first.php");
}

$_SESSION['listLinks'] = NULL;

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RecWeek = 50;
$pageNum_RecWeek = 0;
if (isset($_GET['pageNum_RecWeek'])) {
  $pageNum_RecWeek = $_GET['pageNum_RecWeek'];
}
$startRow_RecWeek = $pageNum_RecWeek * $maxRows_RecWeek;


mysql_select_db($database_connect2data, $connect2data);
$query_RecYears = "SELECT YEAR( d_date ) AS Y FROM data_set WHERE d_class1 = 'week' AND d_active='1' GROUP BY Y ORDER BY Y DESC, d_sort ASC, d_date DESC";
$RecYears = mysql_query($query_RecYears, $connect2data) or die(mysql_error());
$row_RecYears = mysql_fetch_assoc($RecYears);
$totalRows_RecYears = mysql_num_rows($RecYears);

//echo $query_RecYears.'<br>';

$years = 'all';
if (isset($_GET['y'])) {

  	//$years = GetSQLValueString($_GET['y'], "text");
  	$years = $_GET['y'];

  	mysql_select_db($database_connect2data, $connect2data);
	$query_RecCheckYears = "SELECT YEAR( d_date ) AS Y FROM data_set WHERE d_class1 = 'week' AND d_active='1' AND YEAR( d_date )=".GetSQLValueString($years, "text")." ORDER BY Y DESC, d_date DESC, d_sort ASC";

	//echo $query_RecCheckYears.'<br>';

	$RecCheckYears = mysql_query($query_RecCheckYears, $connect2data) or die(mysql_error());
	$row_RecCheckYears = mysql_fetch_assoc($RecCheckYears);
	$totalRows_RecCheckYears = mysql_num_rows($RecCheckYears);



	if($totalRows_RecCheckYears==0){
		$years = $row_RecYears['Y'];
	}

}else{
	$years = $row_RecYears['Y'];
}
if($years=='all'){
	$ySql = '';
}else{
	$ySql = " AND YEAR( d_date )=".GetSQLValueString($years, "text");
}

mysql_select_db($database_connect2data, $connect2data);
$query_RecWeek = "SELECT * FROM data_set WHERE d_class1 = 'week' $ySql ORDER BY d_sort ASC, d_date DESC";
$query_limit_RecWeek = sprintf("%s LIMIT %d, %d", $query_RecWeek, $startRow_RecWeek, $maxRows_RecWeek);
$RecWeek = mysql_query($query_limit_RecWeek, $connect2data) or die(mysql_error());
$row_RecWeek = mysql_fetch_assoc($RecWeek);
//echo $query_RecWeek;
/*if (isset($_GET['totalRows_RecWeek'])) {
  $totalRows_RecWeek = $_GET['totalRows_RecWeek'];
} else {
  $all_RecWeek = mysql_query($query_RecWeek);
  $totalRows_RecWeek = mysql_num_rows($all_RecWeek);
}*/
$all_RecWeek = mysql_query($query_RecWeek);
$totalRows_RecWeek = mysql_num_rows($all_RecWeek);
$totalPages_RecWeek = ceil($totalRows_RecWeek/$maxRows_RecWeek)-1;
$TotalPage = $totalPages_RecWeek;

$queryString_RecWeek = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RecWeek") == false && 
        stristr($param, "totalRows_RecWeek") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecWeek = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecWeek = sprintf("&totalRows_RecWeek=%d%s", $totalRows_RecWeek, $queryString_RecWeek);
 $menu_is="week";
$_SESSION['nowMenu']= "week";
 ?>
 <?php 
 $R_pageNum_RecWeek = 0;
 if (isset($_REQUEST["pageNum_RecWeek"])) 
 {
 	$R_pageNum_RecWeek = $_REQUEST["pageNum_RecWeek"];
 }
      if (! isset($R_pageNum_RecWeek)) 
      {
	  	$_SESSION["ToPage"]=0;
	  }
 	  //若指定分頁數小於1則預設顯示第一頁
  	  else if ($R_pageNum_RecWeek<0) 
      {
	  	$_SESSION["ToPage"]=0;
      }
	  //若指定指定的分頁超過總分頁數則顯示最後一頁
 	  else if ($R_pageNum_RecWeek>$totalPages_RecWeek)
      {
	  	$_SESSION["ToPage"]=$TotalPage;
	  }
	  else
	  {
	  	$_SESSION["ToPage"]=$R_pageNum_RecWeek;
 	  }
?>
<?php
	//如果指定的頁面大於資料所擁有的頁面,轉到最大的頁面
	if($R_pageNum_RecWeek>$totalPages_RecWeek && $R_pageNum_RecWeek!=0)
	{
		header("Location:week_list.php?pageNum_RecWeek=".$totalPages_RecWeek."&y=".$years);
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
	$query_RecWeek = "SELECT * FROM data_set WHERE d_class1 = 'week' $ySql ORDER BY d_sort ASC, d_date DESC";
	$RecWeek = mysql_query($query_RecWeek, $connect2data) or die(mysql_error());
	$row_RecWeek = mysql_fetch_assoc($RecWeek);
	

	do{
	
		if($row_RecWeek['d_sort']==0)
		{}
		else if($row_RecWeek['d_id']==$_GET['now_d_id'])
		{	
			echo $sort_num."<br/>";
			
		}else if($sort_num==$_GET['change_num'])
		{
			echo $sort_num."<br/>";
			$sort_num++;
			
			$updateSQL = sprintf("UPDATE data_set SET d_sort=%s WHERE d_id=%s",
			   GetSQLValueString($sort_num, "int"),
			   GetSQLValueString($row_RecWeek['d_id'], "int"));

			mysql_select_db($database_connect2data, $connect2data);
			$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
			
			$sort_num++;
		}
		else
		{
			$updateSQL = sprintf("UPDATE data_set SET d_sort=%s WHERE d_id=%s",
			   GetSQLValueString($sort_num, "int"),
			   GetSQLValueString($row_RecWeek['d_id'], "int"));

			mysql_select_db($database_connect2data, $connect2data);
			$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
			
			echo $sort_num."<br/>";
			echo $row_RecWeek['d_title']."->".$sort_num."<br/>";
			
			$sort_num++;		
		}
		
		
	//echo " ".$row_RecWeek['d_sort'];
	}while ($row_RecWeek = mysql_fetch_assoc($RecWeek));
	
	
			$updateSQL = sprintf("UPDATE data_set SET d_sort=%s WHERE d_id=%s",
			   GetSQLValueString($_GET['change_num'], "int"),
			   GetSQLValueString($_GET['now_d_id'], "int"));

			mysql_select_db($database_connect2data, $connect2data);
			$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
	if($G_changeSort==1)
	{
	header("Location:week_list.php?pageNum_RecWeek=".$_GET['pageNum_RecWeek']."&totalRows_RecWeek=".$_GET['totalRows_RecWeek']."&y=".$years);
	}else if($G_delchangeSort==1)
	{
	header("Location:week_list.php?pageNum_RecWeek=".$_GET['pageNum_RecWeek']."&y=".$years);
	}
}

?>

<?php
//整個排序重整
/*if (isset($_GET['sortAll']) && $_GET['sortAll']=='sortAll') 
{
	$sort_num=1;

	mysql_select_db($database_connect2data, $connect2data);
	$query_RecWeek = "SELECT * FROM data_set WHERE d_class1 = 'week' $ySql ORDER BY d_date DESC";
	$RecWeek = mysql_query($query_RecWeek, $connect2data) or die(mysql_error());
	$row_RecWeek = mysql_fetch_assoc($RecWeek);

	do{
		$updateSQL = sprintf("UPDATE data_set SET d_sort=%s WHERE d_id=%s",
			   GetSQLValueString($sort_num, "int"),
			   GetSQLValueString($row_RecWeek['d_id'], "int"));

			mysql_select_db($database_connect2data, $connect2data);
			$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
			
			$sort_num++;
		
		
	//echo " ".$row_RecMedia['term_order'].'<br>';
	}while ($row_RecWeek = mysql_fetch_assoc($RecWeek));
			
			//echo $updateSQL;
	header("Location:week_list.php?y=".$years);
}*/
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
function changeSort(pageNum_RecWeek, totalRows_RecWeek, now_d_id, change_num) { //v1.0
 //alert(pageNum_RecWeek+"+"+totalPages_RecWeek); 
 //alert( "week_list.php?pageNum_RecWeek="+pageNum_RecWeek+"&totalRows_RecWeek="+totalRows_RecWeek+"&changeSort=1"+"&now_d_id="+now_d_id+"&change_num="+change_num+"&y="+$("#select1").val() );
 window.location.href="week_list.php?pageNum_RecWeek="+pageNum_RecWeek+"&totalRows_RecWeek="+totalRows_RecWeek+"&changeSort=1"+"&now_d_id="+now_d_id+"&change_num="+change_num+"&y="+$("#select1").val();
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
        	<td width="142" class="list_title">唐獎週列表</td>
        	<td width="882">
			
			<span class="table_data">分類：
			<label>
			<select name="select1" id="select1">
			<?php
			do {  
			?>
			<option value="<?php echo $row_RecYears['Y']?>"<?php if (!(strcmp($row_RecYears['Y'], $years))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecYears['Y']?></option>
			<?php
			} while ( $row_RecYears = mysql_fetch_assoc($RecYears));
			  $rows = mysql_num_rows($RecYears);
			  if($rows > 0) {
			      mysql_data_seek($RecYears, 0);
				  $row_RecYears = mysql_fetch_assoc($RecYears);
			  }
			?>
			</select>
			</label>

        	</span>


			<!-- <a href="week_list.php?sortAll=sortAll&y=<?php echo $years; ?>" class="submenu" style="margin-left: 10px;">重整排序</a> -->

        	<span class="no_data">
            <?php if ($totalRows_RecWeek == 0) { // Show if recordset empty ?>
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
        <td><?php if ($pageNum_RecWeek > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_RecWeek=%d%s", $currentPage, max(0, $pageNum_RecWeek - 1), $queryString_RecWeek); ?>"><</a>
              <?php } // Show if not first page ?>
        </td>
        
        <td>
        <?php
			//echo $totalRows_RecWeek;//所有筆數
			//echo $totalPages_RecWeek;//最後分頁的頁數,由0開始的陣列
			//echo $pageNum_RecWeek;//現在顯示的頁面,由0開始的陣列
			//echo $currentPage;//現在的目錄路徑
			//echo $queryString_RecWeek;//以字串顯示所有的筆數,如&totalRows_RecWeek=11
			if($totalPages_RecWeek<10)
			{
				if($totalRows_RecWeek == 0)
				{
					//如果沒有任何資料，不顯示|符號
				}
				else
				{
					echo " | ";
				}
				
				for ($i=1; $i<=$totalPages_RecWeek+1; $i++)
				{
				  //如果非正在顯示的分頁則建立頁碼連結
				  if ($i != $pageNum_RecWeek+1 )
				  { 
					
					echo "<a href=";
					printf("%s?pageNum_RecWeek=%d%s", $currentPage, $i-1, $queryString_RecWeek);
					echo ">" . $i . "</a> | " ;
				  }
				  //如果是正在顯示的方頁則單純顯示頁碼
				  else
				  { 
					echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
				  }
				}
			}
			else//$totalPages_RecWeek>10
			{
				$morePage_num=$totalPages_RecWeek-$pageNum_RecWeek;//此頁面之後總共有多少
				if($morePage_num>7)
				{
					if($pageNum_RecWeek<3)
					{
						if($totalRows_RecWeek == 0)
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
						  if ($i != $pageNum_RecWeek+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecWeek=%d%s", $currentPage, $i-1, $queryString_RecWeek);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
							echo "<a href=";
							printf("%s?pageNum_RecWeek=%d%s", $currentPage, $totalPages_RecWeek, $queryString_RecWeek);
							echo ">..." .($totalPages_RecWeek+1). "</a> | " ;
					}
					else//$pageNum_RecWeek>=3
					{
						echo "<a href=";
						printf("%s?pageNum_RecWeek=%d%s", $currentPage, 0, $queryString_RecWeek);
						echo ">" . 1 . "...</a> | " ;
												
						for ($i=$pageNum_RecWeek-1; $i<=$pageNum_RecWeek+8; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecWeek+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecWeek=%d%s", $currentPage, $i-1, $queryString_RecWeek);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
						echo "<a href=";
						printf("%s?pageNum_RecWeek=%d%s", $currentPage, $totalPages_RecWeek, $queryString_RecWeek);
						echo ">..." .($totalPages_RecWeek+1). "</a> | " ;
					}
				}
				else//$morePage_num<=7
				{
						$beforePage_num=9-$morePage_num;
						$beforePage=$pageNum_RecWeek-$beforePage_num;
						
						//echo "<br>beforePage_num=".$beforePage_num."<br>";
						//echo "beforePage=".$beforePage."<br>";
						
						echo "<a href=";
						printf("%s?pageNum_RecWeek=%d%s", $currentPage, 0, $queryString_RecWeek);
						echo ">" . 1 . "...</a> | " ;
							
						for ($i=$beforePage+1; $i<=$totalPages_RecWeek+1; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecWeek+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecWeek=%d%s", $currentPage, $i-1, $queryString_RecWeek);
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
        
        <td><?php if ($pageNum_RecWeek < $totalPages_RecWeek) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_RecWeek=%d%s", $currentPage, min($totalPages_RecWeek, $pageNum_RecWeek + 1), $queryString_RecWeek); ?>">></a>
              <?php } // Show if not last page ?>
        </td>
 <?php ?>      
        
        

      </tr>
    </table>
<!-------顯示頁選擇與分頁設定結束---------->
            <td width="110" align="right" class="page_display"><?php if ($totalRows_RecWeek > 0) { // Show if recordset not empty ?>
                頁數:<?php echo (($pageNum_RecWeek+1)."/".($totalPages_RecWeek+1)); ?>
  <?php } // Show if recordset not empty ?>
</td>
            <td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows_RecWeek ?> </td>
            <td width="24" align="right">&nbsp;</td>
     	</tr>
	</table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        	<td><img src="image/spacer.gif" width="1" height="1" /></td>
        </tr>
    </table>
	<form action="week_process.php" method="post" name="form1" id="form1">
      <?php if ($totalRows_RecWeek > 0) { // Show if recordset not empty ?>
        <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
          <tr>
            <td width="142" align="center" class="table_title">日期</td>
            <td width="74" align="center" class="table_title">排序</td>
            <td align="center" class="table_title">名稱</td>
            <td align="center" class="table_title">英文名稱</td>
            <td width="106" align="center" class="table_title">圖片</td>
            
            <td width="60" align="center" class="table_title">是否進行中</td>

            <td width="60" align="center" class="table_title">在網頁顯示</td>

            <?php if(in_array(5,$_SESSION['MM_Limit']['a6'])){ ?>
            <td width="60" align="center" class="table_title">發佈狀態</td>
            <?php } ?>
            
          <?php
          if(in_array(5,$_SESSION['MM_Limit']['a6'])){
		  ?>
            <td width="30" align="center" class="table_title">編輯</td>
            <?php } ?>


            <?php if(in_array(7,$_SESSION['MM_Limit']['a6'])){ ?>
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
		if (isset($row_RecWeek['d_id'])) {
		  $colname_RecImage = $row_RecWeek['d_id'];
		}
		mysql_select_db($database_connect2data, $connect2data);
		$query_RecImage = sprintf("SELECT * FROM file_set WHERE file_type='image' AND file_d_id = %s", GetSQLValueString($colname_RecImage, "int"));
		$RecImage = mysql_query($query_RecImage, $connect2data) or die(mysql_error());
		$row_RecImage = mysql_fetch_assoc($RecImage);
		$totalRows_RecImage = mysql_num_rows($RecImage);
		
		//echo $totalRows_RecImage;
		?>
          <td align="center" class="table_data" >
          <?php
          if(in_array(5,$_SESSION['MM_Limit']['a6'])){
			  echo '<a href="week_edit.php?d_id='.$row_RecWeek['d_id'].'">'.date("Y-m-d", strtotime($row_RecWeek['d_date'])).'</a>';
		  }else{
			  echo $row_RecWeek['d_date'];
		  }
		  ?>
          
          
          </td>
          <td align="center" class="table_data" ><label>
        <select name="d_sort" id="d_sort" onchange="changeSort('<?php echo $pageNum_RecWeek; ?>','<?php echo $totalRows_RecWeek; ?>','<?php echo $row_RecWeek['d_id']; ?>',this.options[this.selectedIndex].value)">
          <option value="0" <?php if (!(strcmp(0, $row_RecWeek['d_sort']))) {echo "selected=\"selected\"";} ?>>至頂</option>
          <?php
		 		
          for($j=1;$j<=($totalRows_RecWeek);$j++)
          {
          	echo "<option value=\"".$j."\" ";
			if (!(strcmp($j, $row_RecWeek['d_sort']))) {echo "selected=\"selected\"";}
			echo ">".$j."</option>";
          }
		  ?>
        </select>
        </label><?php //$_SESSION['totalRows']=$totalRows_RecWeek; ?></td>

        <td align="center" class="table_data" >
        
        <?php
          if(in_array(5,$_SESSION['MM_Limit']['a6'])){
			  echo '<a href="week_edit.php?d_id='.$row_RecWeek['d_id'].'">'.$row_RecWeek['d_title'].'</a>';
		  }else{
			  echo $row_RecWeek['d_title'];
		  }
		  ?>
        
        </td>

        <td align="center" class="table_data" >
        
        <?php
          if(in_array(5,$_SESSION['MM_Limit']['a6'])){
			  echo '<a href="week_edit.php?d_id='.$row_RecWeek['d_id'].'">'.$row_RecWeek['d_title_en'].'</a>';
		  }else{
			  echo $row_RecWeek['d_title_en'];
		  }
		  ?>
        
        </td>

            <td align="center"  class="table_data">
            
            <?php
          if(in_array(5,$_SESSION['MM_Limit']['a6'])){
			  echo '<a href="week_edit.php?d_id='.$row_RecWeek['d_id'].'">';
			  echo '<img src="';
			  if($totalRows_RecImage==0){
				  echo "image/default_image_s.jpg";
			  }else{
				  echo "../".$row_RecImage['file_link2'];
			  }
			  echo '" alt="" class="image_frame" width="100" />';
			  echo '</a>';
		  }else{
			  echo '<img src="';
			  if($totalRows_RecImage==0){
				  echo "image/default_image_s.jpg";
			  }else{
				  echo "../".$row_RecImage['file_link2'];
			  }
			  echo '" alt="" class="image_frame" width="100" />';
		  }
		  ?>
            
           <!-- <a href="week_edit.php?d_id=<?php echo $row_RecWeek['d_id']; ?>"><img src="<?php if($totalRows_RecImage==0){echo "image/default_image_s.jpg";}else{echo "../".$row_RecImage['file_link2'];} ?>" alt="" class="image_frame" /></a>-->
            
            
            </td>


	        <td align="center"  class="table_data">
	      
	            <?php //進行中
	            if(in_array(5,$_SESSION['MM_Limit']['a6'])){
			        if($row_RecWeek['d_sale']){
			          echo "<a href='".$row_RecWeek['d_sale']."' rel='".$row_RecWeek['d_id']."' class='pubA' title='進行中'>進行中</a>";
			        }else{
			          echo "<a href='".$row_RecWeek['d_sale']."' rel='".$row_RecWeek['d_id']."' class='pubA' title='非進行中'>非進行中</a>";
			        }
			      }else{
			        if($row_RecWeek['d_sale']){
			          echo "進行中";
			        }else{
			          echo "非進行中";
			        }
		      	}
		      	?>
	        </td>

            <td align="center"  class="table_data">
			
			
			<?php
          if(in_array(5,$_SESSION['MM_Limit']['a6'])){
			  if($row_RecWeek['d_active']){
					echo "<a href='".$row_RecWeek['d_active']."' rel='".$row_RecWeek['d_id']."' class='activeCh'><img src=\"image/accept.png\" width=\"16\" height=\"16\"  ></a>";
				}else{
					echo "<a href='".$row_RecWeek['d_active']."' rel='".$row_RecWeek['d_id']."' class='activeCh'><img src=\"image/delete.png\" width=\"16\" height=\"16\"  ></a>";
				}
		  }else{
			  if($row_RecWeek['d_active']){
					echo "<img src=\"image/accept.png\" width=\"16\" height=\"16\"  >";
				}else{
					echo "<img src=\"image/delete.png\" width=\"16\" height=\"16\"  >";
				}
		  }
		  ?>
          </td>


        <td align="center"  class="table_data">
      
            <?php //發佈狀態
            if(in_array(5,$_SESSION['MM_Limit']['a6'])){
		        if($row_RecWeek['d_pub']){
		          echo "<a href='".$row_RecWeek['d_pub']."' rel='".$row_RecWeek['d_id']."' class='pubD' title='發佈'>發佈</a>";
		        }else{
		          echo "<a href='".$row_RecWeek['d_pub']."' rel='".$row_RecWeek['d_id']."' class='pubD' title='草稿'>草稿</a>";
		        }
		      }else{
		        if($row_RecWeek['d_pub']){
		          echo "發佈";
		        }else{
		          echo "草稿";
		        }
	      	}
	      	?>
        </td>
        
          <?php
          if(in_array(5,$_SESSION['MM_Limit']['a6'])){
		  ?>
            <td align="center" class="table_data"><a href="week_edit.php?d_id=<?php echo $row_RecWeek['d_id']; ?>"><img src="image/pencil.png" width="16" height="16" /></a></td>
          <?php } ?> 

          <?php if(in_array(7,$_SESSION['MM_Limit']['a6'])){ ?>
		    <td align="center" class="table_data"><a href="week_del.php?d_id=<?php echo $row_RecWeek['d_id']; ?>"><img src="image/cross.png" width="16" height="16" /></a></td>
		  <?php } ?> 
            
          </tr>
          <?php } while ($row_RecWeek = mysql_fetch_assoc($RecWeek)); ?>
        </table>
        <?php } // Show if recordset not empty ?>
</form>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
        <tr>
            <td width="739" align="right" class="page_display">
            <!-------顯示頁選擇與分頁設定開始---------->
    <table border="0">
      <tr>
        <td><?php if ($pageNum_RecWeek > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_RecWeek=%d%s", $currentPage, max(0, $pageNum_RecWeek - 1), $queryString_RecWeek); ?>"><</a>
              <?php } // Show if not first page ?>
        </td>
        
        <td>
        <?php
			//echo $totalRows_RecWeek;//所有筆數
			//echo $totalPages_RecWeek;//最後分頁的頁數,由0開始的陣列
			//echo $pageNum_RecWeek;//現在顯示的頁面,由0開始的陣列
			//echo $currentPage;//現在的目錄路徑
			//echo $queryString_RecWeek;//以字串顯示所有的筆數,如&totalRows_RecWeek=11
			if($totalPages_RecWeek<10)
			{
				if($totalRows_RecWeek == 0)
				{
					//如果沒有任何資料，不顯示|符號
				}
				else
				{
					echo " | ";
				}
				
				for ($i=1; $i<=$totalPages_RecWeek+1; $i++)
				{
				  //如果非正在顯示的分頁則建立頁碼連結
				  if ($i != $pageNum_RecWeek+1 )
				  { 
					
					echo "<a href=";
					printf("%s?pageNum_RecWeek=%d%s", $currentPage, $i-1, $queryString_RecWeek);
					echo ">" . $i . "</a> | " ;
				  }
				  //如果是正在顯示的方頁則單純顯示頁碼
				  else
				  { 
					echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
				  }
				}
			}
			else//$totalPages_RecWeek>10
			{
				$morePage_num=$totalPages_RecWeek-$pageNum_RecWeek;//此頁面之後總共有多少
				if($morePage_num>7)
				{
					if($pageNum_RecWeek<3)
					{
						if($totalRows_RecWeek == 0)
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
						  if ($i != $pageNum_RecWeek+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecWeek=%d%s", $currentPage, $i-1, $queryString_RecWeek);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
							echo "<a href=";
							printf("%s?pageNum_RecWeek=%d%s", $currentPage, $totalPages_RecWeek, $queryString_RecWeek);
							echo ">..." .($totalPages_RecWeek+1). "</a> | " ;
					}
					else//$pageNum_RecWeek>=3
					{
						echo "<a href=";
						printf("%s?pageNum_RecWeek=%d%s", $currentPage, 0, $queryString_RecWeek);
						echo ">" . 1 . "...</a> | " ;
												
						for ($i=$pageNum_RecWeek-1; $i<=$pageNum_RecWeek+8; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecWeek+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecWeek=%d%s", $currentPage, $i-1, $queryString_RecWeek);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
						echo "<a href=";
						printf("%s?pageNum_RecWeek=%d%s", $currentPage, $totalPages_RecWeek, $queryString_RecWeek);
						echo ">..." .($totalPages_RecWeek+1). "</a> | " ;
					}
				}
				else//$morePage_num<=7
				{
						$beforePage_num=9-$morePage_num;
						$beforePage=$pageNum_RecWeek-$beforePage_num;
						
						//echo "<br>beforePage_num=".$beforePage_num."<br>";
						//echo "beforePage=".$beforePage."<br>";
						
						echo "<a href=";
						printf("%s?pageNum_RecWeek=%d%s", $currentPage, 0, $queryString_RecWeek);
						echo ">" . 1 . "...</a> | " ;
							
						for ($i=$beforePage+1; $i<=$totalPages_RecWeek+1; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecWeek+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecWeek=%d%s", $currentPage, $i-1, $queryString_RecWeek);
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
        
        <td><?php if ($pageNum_RecWeek < $totalPages_RecWeek) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_RecWeek=%d%s", $currentPage, min($totalPages_RecWeek, $pageNum_RecWeek + 1), $queryString_RecWeek); ?>">></a>
              <?php } // Show if not last page ?>
        </td>
 <?php ?>      
        
        

      </tr>
    </table>
<!-------顯示頁選擇與分頁設定結束---------->
            <td width="110" align="right" class="page_display"><?php if ($totalRows_RecWeek > 0) { // Show if recordset not empty ?>
                頁數:<?php echo (($pageNum_RecWeek+1)."/".($totalPages_RecWeek+1)); ?>
  <?php } // Show if recordset not empty ?>
</td>
            <td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows_RecWeek ?> </td>
            <td width="24" align="right">&nbsp;</td>
        </tr>
    </table>
	<!-- InstanceEndEditable --></td>
  </tr>
</table></td>
  </tr>
</table>

<script type="text/javascript">
$(document).ready(function() {
	$('#select1').change(function() {
		//alert($(this).val());
		window.location.href = "week_list.php?y="+$(this).val();
	});
  
});
</script>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($RecWeek);
?>
