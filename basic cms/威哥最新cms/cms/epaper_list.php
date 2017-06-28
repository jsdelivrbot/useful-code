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

if(!in_array(3,$_SESSION['MM_Limit']['a12'])){
	header("Location: first.php");
}

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RecEpaper = 10;
$pageNum_RecEpaper = 0;
if (isset($_GET['pageNum_RecEpaper'])) {
  $pageNum_RecEpaper = $_GET['pageNum_RecEpaper'];
}
$startRow_RecEpaper = $pageNum_RecEpaper * $maxRows_RecEpaper;




$date="";
$dateSQL='';
if(isset($_REQUEST['start']) && isset($_REQUEST['end'])){
	
	$start = $_REQUEST['start'];
	$end = $_REQUEST['end'];
	
	if($start!='' && $end!=''){
		//$dateSQL = " AND (`datetime`>='".$start." 00:00:00' AND `datetime`<='".$end." 23:59:59')";	
		$dateSQL = " AND (`d_date` BETWEEN '".$start." 00:00:00' AND '".$end." 23:59:59')";
	}	
	//echo "以日期查詢<br>";
}

$fulltxt="";
$fulltxtSQL='';
if(isset($_REQUEST['fulltxt']) && $_REQUEST['fulltxt']!=''){
	$fulltxt = $_REQUEST['fulltxt'];
	$fulltxtSQL = " AND ( d_title LIKE '%".$fulltxt."%' OR d_content LIKE '%".$fulltxt."%' )";
	//echo "以文字搜尋<br>";
}

mysql_select_db($database_connect2data, $connect2data);
$query_RecEpaper = "SELECT * FROM data_set WHERE d_class1='epaper' $dateSQL $fulltxtSQL ORDER BY d_date DESC, d_id ASC";
//echo $query_RecEpaper.'<br>';
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

<script src="../js/bootstrap.js"></script>
<link rel="stylesheet" href="../js/bootstrap-datepicker/css/datepicker3.css">
<script src="../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="../js/bootstrap-datepicker/js/locales/bootstrap-datepicker.zh-TW.js"></script>


<table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="200" class="list_title">電子報列表</td>
          <td align="right">
          <form action="epaper_list.php" method="post" enctype="multipart/form-data" id="searchF" >
            <table border="0" cellspacing="0" cellpadding="0" width="100%">
              <tr>
                <td valign="middle">
          <?php if ($totalRows_RecEpaper == 0) { // Show if recordset empty ?>
            <span class="no_data"><strong>目前沒有任何電子報資料</strong></span>&nbsp;&nbsp;
            <?php } // Show if recordset empty ?></td>
            
            	
                <td class="table_data" align="right">
                
                
                <table width="645" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="260">以日期查詢：</td>
    <td width="260">以文字搜尋：</td>
    <td width="54">&nbsp;</td>
    <td width="70">&nbsp;</td>
  </tr>
  <tr>
    
    <td>
    <label class="searchLab2">
                  <div class="input-daterange input-group" id="datepicker">
                        <input type="text" class="input-sm form-control table_data" name="start" style="width:117px;" />
                        <span class="input-group-addon">to</span>
                        <input type="text" class="input-sm form-control table_data" name="end" style="width:117px;" />
                    </div>
                    </label>
    </td>
    <td>
    <label class="searchLab2">
                  <input name="fulltxt" type="text" id="fulltxt" class="input-sm form-control table_data" style="width:260px;"/>
                  </label>
    </td>
    <td>
    <label class="searchLabBtn1">
                  <button id="searchBtn" class="btn btn-default btn-sm" type="button" >搜尋</button>
                  </label>
    </td>
    <td>
    	<?php if(0){ ?>
    	<!-- <label class="searchLabBtn2">
    		<button id="exportBtn" class="btn btn-default btn-sm" type="button">匯出表單</button>
    	</label> -->
    	<?php } ?>
    </td>
  </tr>
</table>
                  </td>
              </tr>
            </table>
            
            <input type="hidden" value="1" name="outexcel" />
            
          </form></td>
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
    </td>
    <td width="110" align="right" class="page_display"><?php if ($totalRows_RecEpaper > 0) { // Show if recordset not empty ?>
        頁數:<?php echo (($pageNum_RecEpaper+1)."/".($totalPages_RecEpaper+1)); ?>
  <?php } // Show if recordset not empty ?>
</td>
    <td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows_RecEpaper ?> </td>
    <td width="24" align="right">&nbsp;</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="image/spacer.gif" width="1" height="1" /></td>
  </tr>
</table>
<form action="epaper_process.php" method="post" name="form1" id="form1">
  <?php if ($totalRows_RecEpaper > 0) { // Show if recordset not empty ?>
    <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
      <tr>
      <td width="142" align="center" class="table_title">日期</td>
        <td align="center" class="table_title">標題</td>

        <td width="40" align="center" class="table_title">狀態</td>
        <?php if(in_array(5,$_SESSION['MM_Limit']['a12'])){ ?>
        <td width="40" align="center" class="table_title">編輯</td>
        <?php } ?>
        <?php if(in_array(7,$_SESSION['MM_Limit']['a12'])){ ?>
        <td width="40" align="center" class="table_title">刪除</td>
        <?php } ?>
      </tr>
      <?php 
  		$i=0;
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
		if (isset($row_RecEpaper['d_id'])) {
		  $colname_RecImage = $row_RecEpaper['d_id'];
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
          if(in_array(5,$_SESSION['MM_Limit']['a12'])){
			  echo '<a href="epaper_edit.php?d_id='.$row_RecEpaper['d_id'].'">'.$row_RecEpaper['d_date'].'</a>';
		  }else{
			  echo $row_RecEpaper['d_date'];
		  }
		  ?>
          
          
          </td>

          <td align="center" class="table_data" >
          <?php
          if(in_array(5,$_SESSION['MM_Limit']['a12'])){
			  echo '<a href="epaper_edit.php?d_id='.$row_RecEpaper['d_id'].'">'.$row_RecEpaper['d_title'].'</a>';
		  }else{
			  echo $row_RecEpaper['d_title'];
		  }
		  ?>
          
          <!--<a href="epaper_edit.php?d_id=<?php echo $row_RecEpaper['d_id']; ?>"><?php echo $row_RecEpaper['d_title']; ?></a>-->
          
          </td>
          
          <td align="center"  class="table_data">
		  
		  <?php
          if(in_array(5,$_SESSION['MM_Limit']['a12'])){
			  if($row_RecEpaper['d_active']){
					echo "<a href='".$row_RecEpaper['d_active']."' rel='".$row_RecEpaper['d_id']."' class='activeChE'><img src=\"image/accept.png\" width=\"16\" height=\"16\"  ></a>";
				}else{
					echo "<a href='".$row_RecEpaper['d_active']."' rel='".$row_RecEpaper['d_id']."' class='activeChE'><img src=\"image/delete.png\" width=\"16\" height=\"16\"  ></a>";
				}
		  }else{
			  if($row_RecEpaper['d_active']){
					echo "<img src=\"image/accept.png\" width=\"16\" height=\"16\"  >";
				}else{
					echo "<img src=\"image/delete.png\" width=\"16\" height=\"16\"  >";
				}
		  }
		  ?>
		  
		  <?php  //list使用
				/*if($row_RecEpaper['d_active']=="1")
				{
					echo "<a href='".$row_RecEpaper['d_active']."' rel='".$row_RecEpaper['d_id']."' class='activeChM'><img src=\"image/accept.png\" width=\"16\" height=\"16\"  ></a>";
				}
				else if($row_RecEpaper['d_active']=="0")
				{
					echo "<a href='".$row_RecEpaper['d_active']."' rel='".$row_RecEpaper['d_id']."' class='activeChM'><img src=\"image/delete.png\" width=\"16\" height=\"16\"  ></a>";
				}else
				{
					echo "未驗證";
				}*/
				
?></td>

		<?php if(in_array(5,$_SESSION['MM_Limit']['a12'])){ ?>
            <td align="center" class="table_data"><a href="epaper_edit.php?d_id=<?php echo $row_RecEpaper['d_id']; ?>"><img src="image/pencil.png" width="16" height="16" /></a></td>
            <?php } ?>
            <?php if(in_array(7,$_SESSION['MM_Limit']['a12'])){ ?>
            <td align="center" class="table_data"><a href="epaper_del.php?d_id=<?php echo $row_RecEpaper['d_id']; ?>"><img src="image/cross.png" width="16" height="16" /></a></td>
            <?php } ?>

          <!--<td align="center" class="table_data"><a href="epaper_edit.php?d_id=<?php echo $row_RecEpaper['d_id']; ?>"><img src="image/pencil.png" width="16" height="16" /></a></td>
          <td align="center" class="table_data"><a href="epaper_del.php?d_id=<?php echo $row_RecEpaper['d_id']; ?>"><img src="image/cross.png" width="16" height="16" /></a></td>-->
        </tr><?php } while ($row_RecEpaper = mysql_fetch_assoc($RecEpaper)); ?>
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
    </td>
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

<script type="text/javascript">
$(document).ready(function() {
   
   $(".no_board").hover(function(){
		$(this).find('img').attr('src', 'image/go2.gif');
		$(this).css('cursor', 'pointer');
	}, function(){
		$(this).find('img').attr('src', 'image/go1.gif');
	});
	
	
	$('#searchBtn').click(function(){
		//alert('searchBtn click');
		$("#searchF").attr('action', 'epaper_list.php');
		$("#searchF").submit();
		//window.location.href = "../PHPExcel_1.8.0_doc/export-xls.php?status="+$('#status').val()+"&num="+$('#num').val()+"&start="+$('input[name$="start"]').val()+"&end="+$('input[name$="end"]').val()+"&fulltxt="+$('#fulltxt').val();
	});
	
	$('#exportBtn').click(function(){
		//alert('exportBtn click');
		
		if(confirm('您確定要匯出表單嗎？')){
			$("#searchF").attr('action', '../PHPExcel_1.8.0_doc/export-xls.php');
			$("#searchF").submit();
		}
		
		/*$.ajax({
		  type: "POST",
		  url: '../PHPExcel_1.8.0_doc/export-xls.php',
		  data: $("#searchF").serialize(),
		  success: function(data) {
                //var obj = jQuery.parseJSON(data); if the dataType is not specified as json uncomment this
                // do what ever you want with the server response
				console.log(data);
            },
            error: function(){
                  alert('error handing here');
            }
		});*/
		//window.location.href
		//window.location.href = "../PHPExcel_1.8.0_doc/export-xls.php?status="+$('#status').val()+"&num="+$('#num').val()+"&start="+$('input[name$="start"]').val()+"&end="+$('input[name$="end"]').val()+"&fulltxt="+$('#fulltxt').val();
	});
	
	

		$('#datepicker').datepicker({
			format: "yyyy-mm-dd",
			endDate: "+0d",
			//startView: 1,
			language: "zh-TW",
   			autoclose: true,
			todayHighlight: true
		});
});
</script>

</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($RecEpaper);
?>
