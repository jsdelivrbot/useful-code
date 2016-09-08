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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RecFarmer = 10;
$pageNum_RecFarmer = 0;
if (isset($_GET['pageNum_RecFarmer'])) {
  $pageNum_RecFarmer = $_GET['pageNum_RecFarmer'];
}
$startRow_RecFarmer = $pageNum_RecFarmer * $maxRows_RecFarmer;

mysql_select_db($database_connect2data, $connect2data);

	
	if(isset($_GET["input3"])){
		$input3 = urldecode($_GET["input3"]);
	}else{
		$input3 = '';
	}	
	$input3x = (!empty($input3)) ? "AND M.m_name LIKE '%".$input3."%'" : "";


if($input3!="")
{
	//$query_RecFarmer = "SELECT * FROM member_set WHERE member_set.m_name LIKE '%".$input1."%' AND m_level=2 ORDER BY `m_date` DESC";
	//$query_RecFarmer = "SELECT M.*, C2.c_title AS C2T, C3.c_title AS C3T FROM member_set AS M LEFT JOIN class_set AS C2 ON C2.c_parent='careersC' AND C2.c_active='1' AND M.m_class2=C2.c_id LEFT JOIN class_set AS C3 ON C3.c_parent='jobTitleC' AND C3.c_active='1' AND M.m_class3=C3.c_id WHERE M.m_level=2".$input1x.$input2x.$input3x." ORDER BY M.m_id DESC, M.m_class2 ASC, M.m_class3 ASC";
	$query_RecFarmer = "SELECT M.* FROM member_set AS M WHERE M.m_class2='farmer' ".$input3x." ORDER BY M.m_id DESC";
	//echo "農友姓名<br>";	
}else{
	//$query_RecFarmer = "SELECT * FROM member_set WHERE m_level=2 ORDER BY m_id DESC";
	//$query_RecFarmer = "SELECT M.*, C2.c_title AS C2T, C3.c_title AS C3T FROM member_set AS M LEFT JOIN class_set AS C2 ON C2.c_parent='careersC' AND C2.c_active='1' AND M.m_class2=C2.c_id LEFT JOIN class_set AS C3 ON C3.c_parent='jobTitleC' AND C3.c_active='1' AND M.m_class3=C3.c_id WHERE M.m_level=2 ORDER BY M.m_id DESC, M.m_class2 ASC, M.m_class3 ASC";
	$query_RecFarmer = "SELECT M.* FROM member_set AS M WHERE M.m_class2='farmer' ORDER BY M.m_id DESC";
	//echo "all<br>";	
}
//echo $query_RecFarmer.'<br>';
$query_limit_RecFarmer = sprintf("%s LIMIT %d, %d", $query_RecFarmer, $startRow_RecFarmer, $maxRows_RecFarmer);
$RecFarmer = mysql_query($query_limit_RecFarmer, $connect2data) or die(mysql_error());
$row_RecFarmer = mysql_fetch_assoc($RecFarmer);

mysql_select_db($database_connect2data, $connect2data);
$query_RecClass2 = "SELECT * FROM class_set WHERE c_parent = 'careersC' AND c_active='1' ORDER BY c_sort ASC, c_id DESC";
$RecClass2 = mysql_query($query_RecClass2, $connect2data) or die(mysql_error());
$row_RecClass2 = mysql_fetch_assoc($RecClass2);
$totalRows_RecClass2 = mysql_num_rows($RecClass2);

mysql_select_db($database_connect2data, $connect2data);
$query_RecClass3 = "SELECT * FROM class_set WHERE c_parent = 'jobTitleC' AND c_active='1' ORDER BY c_sort ASC, c_id DESC";
$RecClass3 = mysql_query($query_RecClass3, $connect2data) or die(mysql_error());
$row_RecClass3 = mysql_fetch_assoc($RecClass3);
$totalRows_RecClass3 = mysql_num_rows($RecClass3);



if (isset($_GET['totalRows_RecFarmer'])) {
  $totalRows_RecFarmer = $_GET['totalRows_RecFarmer'];
} else {
  $all_RecFarmer = mysql_query($query_RecFarmer);
  $totalRows_RecFarmer = mysql_num_rows($all_RecFarmer);
}
$totalPages_RecFarmer = ceil($totalRows_RecFarmer/$maxRows_RecFarmer)-1;
$TotalPage = $totalPages_RecFarmer;


$queryString_RecFarmer = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RecFarmer") == false && 
        stristr($param, "totalRows_RecFarmer") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecFarmer = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecFarmer = sprintf("&totalRows_RecFarmer=%d%s", $totalRows_RecFarmer, $queryString_RecFarmer);
 $menu_is="farmer";?>
 <?php 
    $R_pageNum_RecFarmer = 0;
 if (isset($_REQUEST["pageNum_RecFarmer"])) 
 {
 	$R_pageNum_RecFarmer = $_REQUEST["pageNum_RecFarmer"];
 }
      if (! isset($R_pageNum_RecFarmer)) 
      {
	  	$_SESSION["ToPage"]=0;
	  }
 	  //若指定分頁數小於1則預設顯示第一頁
  	  else if ($R_pageNum_RecFarmer<0) 
      {
	  	$_SESSION["ToPage"]=0;
      }
	  //若指定指定的分頁超過總分頁數則顯示最後一頁
 	  else if ($R_pageNum_RecFarmer>$totalPages_RecFarmer)
      {
	  	$_SESSION["ToPage"]=$TotalPage;
	  }
	  else
	  {
	  	$_SESSION["ToPage"]=$R_pageNum_RecFarmer;
 	  }
?>
<?php
	//如果指定的頁面大於資料所擁有的頁面,轉到最大的頁面
	if($R_pageNum_RecFarmer>$totalPages_RecFarmer && $R_pageNum_RecFarmer!=0)
	{
		header("Location:farmer_list.php?pageNum_RecFarmer=".$totalPages_RecFarmer);
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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><!-- InstanceBeginEditable name="編輯區域" -->
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr valign="top">
          <td width="120" class="list_title">農友管理</td>
          <td width="904" valign="top"><form id="form2" name="form2" method="get" action="farmer_list.php">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr valign="baseline">
                <td width="1%"></td>
                <td width="99%" align="left" class="table_data">
                <span class="no_data">
          
          <?php if ($totalRows_RecFarmer == 0) { // Show if recordset empty ?>
          	<?php if( ($input1=='') && ($input2=='') && ($input3=='') ){?>
            <strong>目前資料庫中沒有任何農友</strong>
            <?php }else{ ?>
            <strong>沒有符合搜尋條件的任何農友</strong>
            <?php }?>
            <?php } // Show if recordset empty ?>
</span> 
                <?php if(0){ ?>
                <label>門市部門：
                    <select name="input1" id="input1">
                    <option value=""<?php if ($input1=="") {echo "selected=\"selected\"";} ?>>所有部門</option>
                      <?php
do {  
?>
                      <option value="<?php echo $row_RecClass2['c_id']?>"<?php if (!(strcmp($row_RecClass2['c_id'], $input1))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecClass2['c_title']?></option>
                      
                      <?php
} while ($row_RecClass2 = mysql_fetch_assoc($RecClass2));
  $rows = mysql_num_rows($RecClass2);
  if($rows > 0) {
      mysql_data_seek($RecClass2, 0);
	  $row_RecClass2 = mysql_fetch_assoc($RecClass2);
  }
?>
                    </select></label>
                <label>工作職稱：<select name="input2" id="input2">
                <option value=""<?php if ($input2=="") {echo "selected=\"selected\"";} ?>>所有職稱</option>
                    <?php
do {  
?>
                    <option value="<?php echo $row_RecClass3['c_id']?>"<?php if (!(strcmp($row_RecClass3['c_id'], $input2))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecClass3['c_title']?></option>
                    <?php
} while ($row_RecClass3 = mysql_fetch_assoc($RecClass3));
  $rows = mysql_num_rows($RecClass3);
  if($rows > 0) {
      mysql_data_seek($RecClass3, 0);
	  $row_RecClass3 = mysql_fetch_assoc($RecClass3);
  }
?>
                  </select></label>
                  <?php } ?>
                
                    <label>農友姓名搜尋：
                    <input name="input3" type="text" id="input3" size="10" />
                    
                      <button type="submit" class="no_board" id='searchButton'><img src="image/go1.gif" name="Image54" width="25" height="15" border="0" id="Image54" /></button>
                    </label></td>
                </tr>
            </table>
                    </form></td>
        </tr>
      </table>
  <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
  <tr>
    <td width="739" align="right" class="page_display">
    <!-------顯示頁選擇與分頁設定開始---------->
    <table border="0">
      <tr>
        <td><?php if ($pageNum_RecFarmer > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_RecFarmer=%d%s", $currentPage, max(0, $pageNum_RecFarmer - 1), $queryString_RecFarmer); ?>"><</a>
              <?php } // Show if not first page ?>
        </td>
        
        <td>
        <?php
			//echo $totalRows_RecFarmer;//所有筆數
			//echo $totalPages_RecFarmer;//最後分頁的頁數,由0開始的陣列
			//echo $pageNum_RecFarmer;//現在顯示的頁面,由0開始的陣列
			//echo $currentPage;//現在的目錄路徑
			//echo $queryString_RecFarmer;//以字串顯示所有的筆數,如&totalRows_RecFarmer=11
			if($totalPages_RecFarmer<10)
			{
				if($totalRows_RecFarmer == 0)
				{
					//如果沒有任何資料，不顯示|符號
				}
				else
				{
					echo " | ";
				}
				
				for ($i=1; $i<=$totalPages_RecFarmer+1; $i++)
				{
				  //如果非正在顯示的分頁則建立頁碼連結
				  if ($i != $pageNum_RecFarmer+1 )
				  { 
					
					echo "<a href=";
					printf("%s?pageNum_RecFarmer=%d%s", $currentPage, $i-1, $queryString_RecFarmer);
					echo ">" . $i . "</a> | " ;
				  }
				  //如果是正在顯示的方頁則單純顯示頁碼
				  else
				  { 
					echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
				  }
				}
			}
			else//$totalPages_RecFarmer>10
			{
				$morePage_num=$totalPages_RecFarmer-$pageNum_RecFarmer;//此頁面之後總共有多少
				if($morePage_num>7)
				{
					if($pageNum_RecFarmer<3)
					{
						if($totalRows_RecFarmer == 0)
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
						  if ($i != $pageNum_RecFarmer+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecFarmer=%d%s", $currentPage, $i-1, $queryString_RecFarmer);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
							echo "<a href=";
							printf("%s?pageNum_RecFarmer=%d%s", $currentPage, $totalPages_RecFarmer, $queryString_RecFarmer);
							echo ">..." .($totalPages_RecFarmer+1). "</a> | " ;
					}
					else//$pageNum_RecFarmer>=3
					{
						echo "<a href=";
						printf("%s?pageNum_RecFarmer=%d%s", $currentPage, 0, $queryString_RecFarmer);
						echo ">" . 1 . "...</a> | " ;
												
						for ($i=$pageNum_RecFarmer-1; $i<=$pageNum_RecFarmer+8; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecFarmer+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecFarmer=%d%s", $currentPage, $i-1, $queryString_RecFarmer);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
						echo "<a href=";
						printf("%s?pageNum_RecFarmer=%d%s", $currentPage, $totalPages_RecFarmer, $queryString_RecFarmer);
						echo ">..." .($totalPages_RecFarmer+1). "</a> | " ;
					}
				}
				else//$morePage_num<=7
				{
						$beforePage_num=9-$morePage_num;
						$beforePage=$pageNum_RecFarmer-$beforePage_num;
						
						//echo "<br>beforePage_num=".$beforePage_num."<br>";
						//echo "beforePage=".$beforePage."<br>";
						
						echo "<a href=";
						printf("%s?pageNum_RecFarmer=%d%s", $currentPage, 0, $queryString_RecFarmer);
						echo ">" . 1 . "...</a> | " ;
							
						for ($i=$beforePage+1; $i<=$totalPages_RecFarmer+1; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecFarmer+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecFarmer=%d%s", $currentPage, $i-1, $queryString_RecFarmer);
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
        
        <td><?php if ($pageNum_RecFarmer < $totalPages_RecFarmer) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_RecFarmer=%d%s", $currentPage, min($totalPages_RecFarmer, $pageNum_RecFarmer + 1), $queryString_RecFarmer); ?>">></a>
              <?php } // Show if not last page ?>
        </td>
 <?php ?>      
        
        

      </tr>
    </table>
<!-------顯示頁選擇與分頁設定結束---------->
    </td>
    <td width="110" align="right" class="page_display"><?php if ($totalRows_RecFarmer > 0) { // Show if recordset not empty ?>
        頁數:<?php echo (($pageNum_RecFarmer+1)."/".($totalPages_RecFarmer+1)); ?>
  <?php } // Show if recordset not empty ?>
</td>
    <td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows_RecFarmer ?> </td>
    <td width="24" align="right">&nbsp;</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="image/spacer.gif" width="1" height="1" /></td>
  </tr>
</table>
<form action="farmer_process.php" method="post" name="form1" id="form1">
  <?php if ($totalRows_RecFarmer > 0) { // Show if recordset not empty ?>
    <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
      <tr>
        <td align="center" class="table_title">農友姓名</td>
            <td width="140" align="center" class="table_title">照片</td>
        <td width="40" align="center" class="table_title">狀態</td>
        <td width="40" align="center" class="table_title">編輯</td>
        <td width="40" align="center" class="table_title">刪除</td>
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
		if (isset($row_RecFarmer['m_id'])) {
		  $colname_RecImage = $row_RecFarmer['m_id'];
		}
		mysql_select_db($database_connect2data, $connect2data);
		$query_RecImage = sprintf("SELECT * FROM file_set WHERE file_type='imageP' AND file_d_id = %s", GetSQLValueString($colname_RecImage, "int"));
		$RecImage = mysql_query($query_RecImage, $connect2data) or die(mysql_error());
		$row_RecImage = mysql_fetch_assoc($RecImage);
		$totalRows_RecImage = mysql_num_rows($RecImage);
		
		//echo $totalRows_RecImage;
		?>
          <td align="center" class="table_data" ><a href="farmer_edit.php?m_id=<?php echo $row_RecFarmer['m_id']; ?>"><?php echo $row_RecFarmer['m_name']; ?></a></td>
          
          <td align="center"  class="table_data"><a href="farmer_edit.php?m_id=<?php echo $row_RecFarmer['m_id']; ?>"><img src="<?php if($totalRows_RecImage==0){echo "image/default_image_s.jpg";}else{echo "../".$row_RecImage['file_link2'];} ?>" alt="" class="image_frame" /></a></td>
          
          <td align="center"  class="table_data"><?php  //list使用
				if($row_RecFarmer['m_active']=="1")
				{
					echo "<a href='".$row_RecFarmer['m_active']."' rel='".$row_RecFarmer['m_id']."' class='activeChM'><img src=\"image/accept.png\" width=\"16\" height=\"16\"  ></a>";
				}
				else if($row_RecFarmer['m_active']=="0")
				{
					echo "<a href='".$row_RecFarmer['m_active']."' rel='".$row_RecFarmer['m_id']."' class='activeChM'><img src=\"image/delete.png\" width=\"16\" height=\"16\"  ></a>";
				}else
				{
					echo "未驗證";
				}
				
?></td>
          <td align="center" class="table_data"><a href="farmer_edit.php?m_id=<?php echo $row_RecFarmer['m_id']; ?>"><img src="image/pencil.png" width="16" height="16" /></a></td>
          <td align="center" class="table_data"><a href="farmer_del.php?m_id=<?php echo $row_RecFarmer['m_id']; ?>"><img src="image/cross.png" width="16" height="16" /></a></td>
        </tr><?php } while ($row_RecFarmer = mysql_fetch_assoc($RecFarmer)); ?>
    </table>
    <?php } // Show if recordset not empty ?>
</form>
 <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
  <tr>
    <td width="739" align="right" class="page_display">
    <!-------顯示頁選擇與分頁設定開始---------->
    <table border="0">
      <tr>
        <td><?php if ($pageNum_RecFarmer > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_RecFarmer=%d%s", $currentPage, max(0, $pageNum_RecFarmer - 1), $queryString_RecFarmer); ?>"><</a>
              <?php } // Show if not first page ?>
        </td>
        
        <td>
        <?php
			//echo $totalRows_RecFarmer;//所有筆數
			//echo $totalPages_RecFarmer;//最後分頁的頁數,由0開始的陣列
			//echo $pageNum_RecFarmer;//現在顯示的頁面,由0開始的陣列
			//echo $currentPage;//現在的目錄路徑
			//echo $queryString_RecFarmer;//以字串顯示所有的筆數,如&totalRows_RecFarmer=11
			if($totalPages_RecFarmer<10)
			{
				if($totalRows_RecFarmer == 0)
				{
					//如果沒有任何資料，不顯示|符號
				}
				else
				{
					echo " | ";
				}
				
				for ($i=1; $i<=$totalPages_RecFarmer+1; $i++)
				{
				  //如果非正在顯示的分頁則建立頁碼連結
				  if ($i != $pageNum_RecFarmer+1 )
				  { 
					
					echo "<a href=";
					printf("%s?pageNum_RecFarmer=%d%s", $currentPage, $i-1, $queryString_RecFarmer);
					echo ">" . $i . "</a> | " ;
				  }
				  //如果是正在顯示的方頁則單純顯示頁碼
				  else
				  { 
					echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
				  }
				}
			}
			else//$totalPages_RecFarmer>10
			{
				$morePage_num=$totalPages_RecFarmer-$pageNum_RecFarmer;//此頁面之後總共有多少
				if($morePage_num>7)
				{
					if($pageNum_RecFarmer<3)
					{
						if($totalRows_RecFarmer == 0)
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
						  if ($i != $pageNum_RecFarmer+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecFarmer=%d%s", $currentPage, $i-1, $queryString_RecFarmer);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
							echo "<a href=";
							printf("%s?pageNum_RecFarmer=%d%s", $currentPage, $totalPages_RecFarmer, $queryString_RecFarmer);
							echo ">..." .($totalPages_RecFarmer+1). "</a> | " ;
					}
					else//$pageNum_RecFarmer>=3
					{
						echo "<a href=";
						printf("%s?pageNum_RecFarmer=%d%s", $currentPage, 0, $queryString_RecFarmer);
						echo ">" . 1 . "...</a> | " ;
												
						for ($i=$pageNum_RecFarmer-1; $i<=$pageNum_RecFarmer+8; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecFarmer+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecFarmer=%d%s", $currentPage, $i-1, $queryString_RecFarmer);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
						echo "<a href=";
						printf("%s?pageNum_RecFarmer=%d%s", $currentPage, $totalPages_RecFarmer, $queryString_RecFarmer);
						echo ">..." .($totalPages_RecFarmer+1). "</a> | " ;
					}
				}
				else//$morePage_num<=7
				{
						$beforePage_num=9-$morePage_num;
						$beforePage=$pageNum_RecFarmer-$beforePage_num;
						
						//echo "<br>beforePage_num=".$beforePage_num."<br>";
						//echo "beforePage=".$beforePage."<br>";
						
						echo "<a href=";
						printf("%s?pageNum_RecFarmer=%d%s", $currentPage, 0, $queryString_RecFarmer);
						echo ">" . 1 . "...</a> | " ;
							
						for ($i=$beforePage+1; $i<=$totalPages_RecFarmer+1; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecFarmer+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecFarmer=%d%s", $currentPage, $i-1, $queryString_RecFarmer);
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
        
        <td><?php if ($pageNum_RecFarmer < $totalPages_RecFarmer) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_RecFarmer=%d%s", $currentPage, min($totalPages_RecFarmer, $pageNum_RecFarmer + 1), $queryString_RecFarmer); ?>">></a>
              <?php } // Show if not last page ?>
        </td>
 <?php ?>      
        
        

      </tr>
    </table>
<!-------顯示頁選擇與分頁設定結束---------->
    </td>
    <td width="110" align="right" class="page_display"><?php if ($totalRows_RecFarmer > 0) { // Show if recordset not empty ?>
        頁數:<?php echo (($pageNum_RecFarmer+1)."/".($totalPages_RecFarmer+1)); ?>
  <?php } // Show if recordset not empty ?>
</td>
    <td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows_RecFarmer ?> </td>
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
mysql_free_result($RecFarmer);
?>
