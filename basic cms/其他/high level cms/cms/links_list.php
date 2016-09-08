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

if(!in_array(3,$_SESSION['MM_Limit']['a10'])){
	header("Location: first.php");
}

$_SESSION['listLinks'] = NULL;


$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RecLinks = 50;
$pageNum_RecLinks = 0;
if (isset($_GET['pageNum_RecLinks'])) {
  $pageNum_RecLinks = $_GET['pageNum_RecLinks'];
}
$startRow_RecLinks = $pageNum_RecLinks * $maxRows_RecLinks;

mysql_select_db($database_connect2data, $connect2data);
$query_RecLinks = "SELECT * FROM data_set WHERE d_class1 = 'links' ORDER BY d_sort ASC, d_date DESC";
$query_limit_RecLinks = sprintf("%s LIMIT %d, %d", $query_RecLinks, $startRow_RecLinks, $maxRows_RecLinks);
$RecLinks = mysql_query($query_limit_RecLinks, $connect2data) or die(mysql_error());
$row_RecLinks = mysql_fetch_assoc($RecLinks);

if (isset($_GET['totalRows_RecLinks'])) {
  $totalRows_RecLinks = $_GET['totalRows_RecLinks'];
} else {
  $all_RecLinks = mysql_query($query_RecLinks);
  $totalRows_RecLinks = mysql_num_rows($all_RecLinks);
}
$totalPages_RecLinks = ceil($totalRows_RecLinks/$maxRows_RecLinks)-1;
$TotalPage = $totalPages_RecLinks;

$queryString_RecLinks = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RecLinks") == false && 
        stristr($param, "totalRows_RecLinks") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecLinks = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecLinks = sprintf("&totalRows_RecLinks=%d%s", $totalRows_RecLinks, $queryString_RecLinks);
 $menu_is="founder";?>
 <?php 
 $R_pageNum_RecLinks = 0;
 if (isset($_REQUEST["pageNum_RecLinks"])) 
 {
 	$R_pageNum_RecLinks = $_REQUEST["pageNum_RecLinks"];
 }
      if (! isset($R_pageNum_RecLinks)) 
      {
	  	$_SESSION["ToPage"]=0;
	  }
 	  //若指定分頁數小於1則預設顯示第一頁
  	  else if ($R_pageNum_RecLinks<0) 
      {
	  	$_SESSION["ToPage"]=0;
      }
	  //若指定指定的分頁超過總分頁數則顯示最後一頁
 	  else if ($R_pageNum_RecLinks>$totalPages_RecLinks)
      {
	  	$_SESSION["ToPage"]=$TotalPage;
	  }
	  else
	  {
	  	$_SESSION["ToPage"]=$R_pageNum_RecLinks;
 	  }
?>
<?php
	//如果指定的頁面大於資料所擁有的頁面,轉到最大的頁面
	if($R_pageNum_RecLinks>$totalPages_RecLinks && $R_pageNum_RecLinks!=0)
	{
		header("Location:links_list.php?pageNum_RecLinks=".$totalPages_RecLinks);
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
	$query_RecLinks = "SELECT * FROM data_set WHERE d_class1 = 'links' ORDER BY d_sort ASC, d_date DESC";
	$RecLinks = mysql_query($query_RecLinks, $connect2data) or die(mysql_error());
	$row_RecLinks = mysql_fetch_assoc($RecLinks);
	

	do{
	
		if($row_RecLinks['d_sort']==0)
		{}
		else if($row_RecLinks['d_id']==$_GET['now_d_id'])
		{	
			echo $sort_num."<br/>";
			
		}else if($sort_num==$_GET['change_num'])
		{
			echo $sort_num."<br/>";
			$sort_num++;
			
			$updateSQL = sprintf("UPDATE data_set SET d_sort=%s WHERE d_id=%s",
			   GetSQLValueString($sort_num, "int"),
			   GetSQLValueString($row_RecLinks['d_id'], "int"));

			mysql_select_db($database_connect2data, $connect2data);
			$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
			
			$sort_num++;
		}
		else
		{
			$updateSQL = sprintf("UPDATE data_set SET d_sort=%s WHERE d_id=%s",
			   GetSQLValueString($sort_num, "int"),
			   GetSQLValueString($row_RecLinks['d_id'], "int"));

			mysql_select_db($database_connect2data, $connect2data);
			$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
			
			echo $sort_num."<br/>";
			echo $row_RecLinks['d_title']."->".$sort_num."<br/>";
			
			$sort_num++;		
		}
		
		
	//echo " ".$row_RecLinks['d_sort'];
	}while ($row_RecLinks = mysql_fetch_assoc($RecLinks));
	
	
			$updateSQL = sprintf("UPDATE data_set SET d_sort=%s WHERE d_id=%s",
			   GetSQLValueString($_GET['change_num'], "int"),
			   GetSQLValueString($_GET['now_d_id'], "int"));

			mysql_select_db($database_connect2data, $connect2data);
			$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
	if($G_changeSort==1)
	{
	header("Location:links_list.php?pageNum_RecLinks=".$_GET['pageNum_RecLinks']."&totalRows_RecLinks=".$_GET['totalRows_RecLinks']);
	}else if($G_delchangeSort==1)
	{
	header("Location:links_list.php?pageNum_RecLinks=".$_GET['pageNum_RecLinks']);
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
function changeSort(pageNum_RecLinks, totalRows_RecLinks, now_d_id, change_num) { //v1.0
 //alert(pageNum_RecLinks+"+"+totalPages_RecLinks); 
 window.location.href="links_list.php?pageNum_RecLinks="+pageNum_RecLinks+"&totalRows_RecLinks="+totalRows_RecLinks+"&changeSort=1"+"&now_d_id="+now_d_id+"&change_num="+change_num;
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
        	<td width="142" class="list_title">相關連結列表</td>
        	<td width="882"><span class="no_data">
            <?php if ($totalRows_RecLinks == 0) { // Show if recordset empty ?>
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
        <td><?php if ($pageNum_RecLinks > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_RecLinks=%d%s", $currentPage, max(0, $pageNum_RecLinks - 1), $queryString_RecLinks); ?>"><</a>
              <?php } // Show if not first page ?>
        </td>
        
        <td>
        <?php
			//echo $totalRows_RecLinks;//所有筆數
			//echo $totalPages_RecLinks;//最後分頁的頁數,由0開始的陣列
			//echo $pageNum_RecLinks;//現在顯示的頁面,由0開始的陣列
			//echo $currentPage;//現在的目錄路徑
			//echo $queryString_RecLinks;//以字串顯示所有的筆數,如&totalRows_RecLinks=11
			if($totalPages_RecLinks<10)
			{
				if($totalRows_RecLinks == 0)
				{
					//如果沒有任何資料，不顯示|符號
				}
				else
				{
					echo " | ";
				}
				
				for ($i=1; $i<=$totalPages_RecLinks+1; $i++)
				{
				  //如果非正在顯示的分頁則建立頁碼連結
				  if ($i != $pageNum_RecLinks+1 )
				  { 
					
					echo "<a href=";
					printf("%s?pageNum_RecLinks=%d%s", $currentPage, $i-1, $queryString_RecLinks);
					echo ">" . $i . "</a> | " ;
				  }
				  //如果是正在顯示的方頁則單純顯示頁碼
				  else
				  { 
					echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
				  }
				}
			}
			else//$totalPages_RecLinks>10
			{
				$morePage_num=$totalPages_RecLinks-$pageNum_RecLinks;//此頁面之後總共有多少
				if($morePage_num>7)
				{
					if($pageNum_RecLinks<3)
					{
						if($totalRows_RecLinks == 0)
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
						  if ($i != $pageNum_RecLinks+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecLinks=%d%s", $currentPage, $i-1, $queryString_RecLinks);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
							echo "<a href=";
							printf("%s?pageNum_RecLinks=%d%s", $currentPage, $totalPages_RecLinks, $queryString_RecLinks);
							echo ">..." .($totalPages_RecLinks+1). "</a> | " ;
					}
					else//$pageNum_RecLinks>=3
					{
						echo "<a href=";
						printf("%s?pageNum_RecLinks=%d%s", $currentPage, 0, $queryString_RecLinks);
						echo ">" . 1 . "...</a> | " ;
												
						for ($i=$pageNum_RecLinks-1; $i<=$pageNum_RecLinks+8; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecLinks+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecLinks=%d%s", $currentPage, $i-1, $queryString_RecLinks);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
						echo "<a href=";
						printf("%s?pageNum_RecLinks=%d%s", $currentPage, $totalPages_RecLinks, $queryString_RecLinks);
						echo ">..." .($totalPages_RecLinks+1). "</a> | " ;
					}
				}
				else//$morePage_num<=7
				{
						$beforePage_num=9-$morePage_num;
						$beforePage=$pageNum_RecLinks-$beforePage_num;
						
						//echo "<br>beforePage_num=".$beforePage_num."<br>";
						//echo "beforePage=".$beforePage."<br>";
						
						echo "<a href=";
						printf("%s?pageNum_RecLinks=%d%s", $currentPage, 0, $queryString_RecLinks);
						echo ">" . 1 . "...</a> | " ;
							
						for ($i=$beforePage+1; $i<=$totalPages_RecLinks+1; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecLinks+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecLinks=%d%s", $currentPage, $i-1, $queryString_RecLinks);
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
        
        <td><?php if ($pageNum_RecLinks < $totalPages_RecLinks) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_RecLinks=%d%s", $currentPage, min($totalPages_RecLinks, $pageNum_RecLinks + 1), $queryString_RecLinks); ?>">></a>
              <?php } // Show if not last page ?>
        </td>
 <?php ?>      
        
        

      </tr>
    </table>
<!-------顯示頁選擇與分頁設定結束---------->
            <td width="110" align="right" class="page_display"><?php if ($totalRows_RecLinks > 0) { // Show if recordset not empty ?>
                頁數:<?php echo (($pageNum_RecLinks+1)."/".($totalPages_RecLinks+1)); ?>
  <?php } // Show if recordset not empty ?>
</td>
            <td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows_RecLinks ?> </td>
            <td width="24" align="right">&nbsp;</td>
     	</tr>
	</table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        	<td><img src="image/spacer.gif" width="1" height="1" /></td>
        </tr>
    </table>
	<form action="links_process.php" method="post" name="form1" id="form1">
      <?php if ($totalRows_RecLinks > 0) { // Show if recordset not empty ?>
        <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
          <tr>
            <td width="142" align="center" class="table_title">日期</td>
            <td width="74" align="center" class="table_title">排序</td>
            <td align="center" class="table_title">標題</td>
            <!-- <td width="140" align="center" class="table_title">圖片</td> -->

            <td width="60" align="center" class="table_title">在網頁顯示</td>

            <?php if(in_array(5,$_SESSION['MM_Limit']['a10'])){ ?>
            <td width="60" align="center" class="table_title">發佈狀態</td>
            <?php } ?>

            <?php
          if(in_array(5,$_SESSION['MM_Limit']['a10'])){
		  ?>
            <td width="30" align="center" class="table_title">編輯</td>
            <?php } ?>

            <?php if(in_array(7,$_SESSION['MM_Limit']['a10'])){ ?>
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
		if (isset($row_RecLinks['d_id'])) {
		  $colname_RecImage = $row_RecLinks['d_id'];
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
          if(in_array(5,$_SESSION['MM_Limit']['a10'])){
			  echo '<a href="links_edit.php?d_id='.$row_RecLinks['d_id'].'">'.$row_RecLinks['d_date'].'</a>';
		  }else{
			  echo $row_RecLinks['d_date'];
		  }
		  ?>
          
          <!--<a href="links_edit.php?d_id=<?php //echo $row_RecLinks['d_id']; ?>"><?php //echo $row_RecLinks['d_date']; ?></a>-->
          
          </td>
          <td align="center" class="table_data" ><label>
        <select name="d_sort" id="d_sort" onchange="changeSort('<?php echo $pageNum_RecLinks; ?>','<?php echo $totalRows_RecLinks; ?>','<?php echo $row_RecLinks['d_id']; ?>',this.options[this.selectedIndex].value)">
          <option value="0" <?php if (!(strcmp(0, $row_RecLinks['d_sort']))) {echo "selected=\"selected\"";} ?>>至頂</option>
          <?php
		 		
          for($j=1;$j<=($totalRows_RecLinks);$j++)
          {
          	echo "<option value=\"".$j."\" ";
			if (!(strcmp($j, $row_RecLinks['d_sort']))) {echo "selected=\"selected\"";}
			echo ">".$j."</option>";
          }
		  ?>
        </select>
        </label><?php //$_SESSION['totalRows']=$totalRows_RecLinks; ?></td>
        <td align="center" class="table_data" >
        
        <?php
          if(in_array(5,$_SESSION['MM_Limit']['a10'])){
			  echo '<a href="links_edit.php?d_id='.$row_RecLinks['d_id'].'">'.$row_RecLinks['d_title'].'</a>';
		  }else{
			  echo $row_RecLinks['d_title'];
		  }
		  ?>
        
        <!--<a href="links_edit.php?d_id=<?php //echo $row_RecLinks['d_id']; ?>"><?php //echo $row_RecLinks['d_title']; ?></a>-->
        
        </td>

        <?php if(0){ ?>
            <td align="center"  class="table_data">
            
            <?php
          if(in_array(5,$_SESSION['MM_Limit']['a10'])){
			  echo '<a href="links_edit.php?d_id='.$row_RecLinks['d_id'].'">';
			  echo '<img src="';
			  if($totalRows_RecImage==0){
				  echo "image/default_image_s.jpg";
			  }else{
				  echo "../".$row_RecImage['file_link2'];
			  }
			  echo '" alt="" class="image_frame" />';
			  echo '</a>';
		  }else{
			  echo '<img src="';
			  if($totalRows_RecImage==0){
				  echo "image/default_image_s.jpg";
			  }else{
				  echo "../".$row_RecImage['file_link2'];
			  }
			  echo '" alt="" class="image_frame" />';
		  }
		  ?>
            
            <!--<a href="links_edit.php?d_id=<?php //echo $row_RecLinks['d_id']; ?>"><img src="<?php //if($totalRows_RecImage==0){echo "image/default_image_s.jpg";}else{echo "../".$row_RecImage['file_link2'];} ?>" alt="" class="image_frame" /></a>-->
            
            </td>

            <?php } ?>
            
            <td align="center"  class="table_data">
			<?php
          if(in_array(5,$_SESSION['MM_Limit']['a10'])){
			  if($row_RecLinks['d_active']){
					echo "<a href='".$row_RecLinks['d_active']."' rel='".$row_RecLinks['d_id']."' class='activeCh'><img src=\"image/accept.png\" width=\"16\" height=\"16\"  ></a>";
				}else{
					echo "<a href='".$row_RecLinks['d_active']."' rel='".$row_RecLinks['d_id']."' class='activeCh'><img src=\"image/delete.png\" width=\"16\" height=\"16\"  ></a>";
				}
		  }else{
			  if($row_RecLinks['d_active']){
					echo "<img src=\"image/accept.png\" width=\"16\" height=\"16\"  >";
				}else{
					echo "<img src=\"image/delete.png\" width=\"16\" height=\"16\"  >";
				}
		  }
		  ?></td>

        <td align="center"  class="table_data">
      
            <?php //發佈狀態
            if(in_array(5,$_SESSION['MM_Limit']['a10'])){
		        if($row_RecLinks['d_pub']){
		          echo "<a href='".$row_RecLinks['d_pub']."' rel='".$row_RecLinks['d_id']."' class='pubD' title='發佈'>發佈</a>";
		        }else{
		          echo "<a href='".$row_RecLinks['d_pub']."' rel='".$row_RecLinks['d_id']."' class='pubD' title='草稿'>草稿</a>";
		        }
		      }else{
		        if($row_RecLinks['d_pub']){
		          echo "發佈";
		        }else{
		          echo "草稿";
		        }
	      	}
	      	?>
        </td>
			

<?php
          if(in_array(5,$_SESSION['MM_Limit']['a10'])){
		  ?>
            <td align="center" class="table_data"><a href="links_edit.php?d_id=<?php echo $row_RecLinks['d_id']; ?>"><img src="image/pencil.png" width="16" height="16" /></a></td>
            <?php } ?>

          <?php if(in_array(7,$_SESSION['MM_Limit']['a10'])){ ?>
		    <td align="center" class="table_data"><a href="links_del.php?d_id=<?php echo $row_RecLinks['d_id']; ?>"><img src="image/cross.png" width="16" height="16" /></a></td>
		  <?php } ?> 
            
          </tr>
          <?php } while ($row_RecLinks = mysql_fetch_assoc($RecLinks)); ?>
        </table>
        <?php } // Show if recordset not empty ?>
</form>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
        <tr>
            <td width="739" align="right" class="page_display">
            <!-------顯示頁選擇與分頁設定開始---------->
    <table border="0">
      <tr>
        <td><?php if ($pageNum_RecLinks > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_RecLinks=%d%s", $currentPage, max(0, $pageNum_RecLinks - 1), $queryString_RecLinks); ?>"><</a>
              <?php } // Show if not first page ?>
        </td>
        
        <td>
        <?php
			//echo $totalRows_RecLinks;//所有筆數
			//echo $totalPages_RecLinks;//最後分頁的頁數,由0開始的陣列
			//echo $pageNum_RecLinks;//現在顯示的頁面,由0開始的陣列
			//echo $currentPage;//現在的目錄路徑
			//echo $queryString_RecLinks;//以字串顯示所有的筆數,如&totalRows_RecLinks=11
			if($totalPages_RecLinks<10)
			{
				if($totalRows_RecLinks == 0)
				{
					//如果沒有任何資料，不顯示|符號
				}
				else
				{
					echo " | ";
				}
				
				for ($i=1; $i<=$totalPages_RecLinks+1; $i++)
				{
				  //如果非正在顯示的分頁則建立頁碼連結
				  if ($i != $pageNum_RecLinks+1 )
				  { 
					
					echo "<a href=";
					printf("%s?pageNum_RecLinks=%d%s", $currentPage, $i-1, $queryString_RecLinks);
					echo ">" . $i . "</a> | " ;
				  }
				  //如果是正在顯示的方頁則單純顯示頁碼
				  else
				  { 
					echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
				  }
				}
			}
			else//$totalPages_RecLinks>10
			{
				$morePage_num=$totalPages_RecLinks-$pageNum_RecLinks;//此頁面之後總共有多少
				if($morePage_num>7)
				{
					if($pageNum_RecLinks<3)
					{
						if($totalRows_RecLinks == 0)
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
						  if ($i != $pageNum_RecLinks+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecLinks=%d%s", $currentPage, $i-1, $queryString_RecLinks);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
							echo "<a href=";
							printf("%s?pageNum_RecLinks=%d%s", $currentPage, $totalPages_RecLinks, $queryString_RecLinks);
							echo ">..." .($totalPages_RecLinks+1). "</a> | " ;
					}
					else//$pageNum_RecLinks>=3
					{
						echo "<a href=";
						printf("%s?pageNum_RecLinks=%d%s", $currentPage, 0, $queryString_RecLinks);
						echo ">" . 1 . "...</a> | " ;
												
						for ($i=$pageNum_RecLinks-1; $i<=$pageNum_RecLinks+8; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecLinks+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecLinks=%d%s", $currentPage, $i-1, $queryString_RecLinks);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
						echo "<a href=";
						printf("%s?pageNum_RecLinks=%d%s", $currentPage, $totalPages_RecLinks, $queryString_RecLinks);
						echo ">..." .($totalPages_RecLinks+1). "</a> | " ;
					}
				}
				else//$morePage_num<=7
				{
						$beforePage_num=9-$morePage_num;
						$beforePage=$pageNum_RecLinks-$beforePage_num;
						
						//echo "<br>beforePage_num=".$beforePage_num."<br>";
						//echo "beforePage=".$beforePage."<br>";
						
						echo "<a href=";
						printf("%s?pageNum_RecLinks=%d%s", $currentPage, 0, $queryString_RecLinks);
						echo ">" . 1 . "...</a> | " ;
							
						for ($i=$beforePage+1; $i<=$totalPages_RecLinks+1; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecLinks+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecLinks=%d%s", $currentPage, $i-1, $queryString_RecLinks);
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
        
        <td><?php if ($pageNum_RecLinks < $totalPages_RecLinks) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_RecLinks=%d%s", $currentPage, min($totalPages_RecLinks, $pageNum_RecLinks + 1), $queryString_RecLinks); ?>">></a>
              <?php } // Show if not last page ?>
        </td>
 <?php ?>      
        
        

      </tr>
    </table>
<!-------顯示頁選擇與分頁設定結束---------->
            <td width="110" align="right" class="page_display"><?php if ($totalRows_RecLinks > 0) { // Show if recordset not empty ?>
                頁數:<?php echo (($pageNum_RecLinks+1)."/".($totalPages_RecLinks+1)); ?>
  <?php } // Show if recordset not empty ?>
</td>
            <td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows_RecLinks ?> </td>
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
mysql_free_result($RecLinks);
?>
