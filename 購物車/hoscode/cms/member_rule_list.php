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

$maxRows_RecMember_rule = 10;
$pageNum_RecMember_rule = 0;
if (isset($_GET['pageNum_RecMember_rule'])) {
  $pageNum_RecMember_rule = $_GET['pageNum_RecMember_rule'];
}
$startRow_RecMember_rule = $pageNum_RecMember_rule * $maxRows_RecMember_rule;

mysql_select_db($database_connect2data, $connect2data);
$query_RecMember_rule = "SELECT * FROM data_set WHERE d_class1 = 'member_rule' ORDER BY d_date DESC";
$query_limit_RecMember_rule = sprintf("%s LIMIT %d, %d", $query_RecMember_rule, $startRow_RecMember_rule, $maxRows_RecMember_rule);
$RecMember_rule = mysql_query($query_limit_RecMember_rule, $connect2data) or die(mysql_error());
$row_RecMember_rule = mysql_fetch_assoc($RecMember_rule);

if (isset($_GET['totalRows_RecMember_rule'])) {
  $totalRows_RecMember_rule = $_GET['totalRows_RecMember_rule'];
} else {
  $all_RecMember_rule = mysql_query($query_RecMember_rule);
  $totalRows_RecMember_rule = mysql_num_rows($all_RecMember_rule);
}
$totalPages_RecMember_rule = ceil($totalRows_RecMember_rule/$maxRows_RecMember_rule)-1;
$TotalPage = $totalPages_RecMember_rule;

$queryString_RecMember_rule = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RecMember_rule") == false && 
        stristr($param, "totalRows_RecMember_rule") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecMember_rule = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecMember_rule = sprintf("&totalRows_RecMember_rule=%d%s", $totalRows_RecMember_rule, $queryString_RecMember_rule);
 $menu_is="member";?>
 <?php 
     $R_pageNum_RecMember_rule = 0;
 if (isset($_REQUEST["pageNum_RecMember_rule"])) 
 {
 	$R_pageNum_RecMember_rule = $_REQUEST["pageNum_RecMember_rule"];
 }
      if (! isset($R_pageNum_RecMember_rule)) 
      {
	  	$_SESSION["ToPage"]=0;
	  }
 	  //若指定分頁數小於1則預設顯示第一頁
  	  else if ($R_pageNum_RecMember_rule<0) 
      {
	  	$_SESSION["ToPage"]=0;
      }
	  //若指定指定的分頁超過總分頁數則顯示最後一頁
 	  else if ($R_pageNum_RecMember_rule>$totalPages_RecMember_rule)
      {
	  	$_SESSION["ToPage"]=$TotalPage;
	  }
	  else
	  {
	  	$_SESSION["ToPage"]=$R_pageNum_RecMember_rule;
 	  }
	 
	//如果指定的頁面大於資料所擁有的頁面,轉到最大的頁面
	if($R_pageNum_RecMember_rule>$totalPages_RecMember_rule && $R_pageNum_RecMember_rule!=0)
	{
		header("Location:member_rule_list.php?pageNum_RecMember_rule=".$totalPages_RecMember_rule);
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
        	<td width="117" class="list_title">會員規範</td>
        	<td width="683"><span class="no_data">
            <?php if ($totalRows_RecMember_rule == 0) { // Show if recordset empty ?>
              <strong>目前資料庫中沒有任何會員規範</strong>
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
        <td><?php if ($pageNum_RecMember_rule > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_RecMember_rule=%d%s", $currentPage, max(0, $pageNum_RecMember_rule - 1), $queryString_RecMember_rule); ?>"><</a>
              <?php } // Show if not first page ?>
        </td>
        
        <td>
        <?php
			//echo $totalRows_RecMember_rule;//所有筆數
			//echo $totalPages_RecMember_rule;//最後分頁的頁數,由0開始的陣列
			//echo $pageNum_RecMember_rule;//現在顯示的頁面,由0開始的陣列
			//echo $currentPage;//現在的目錄路徑
			//echo $queryString_RecMember_rule;//以字串顯示所有的筆數,如&totalRows_RecMember_rule=11
			if($totalPages_RecMember_rule<10)
			{
				if($totalRows_RecMember_rule == 0)
				{
					//如果沒有任何資料，不顯示|符號
				}
				else
				{
					echo " | ";
				}
				
				for ($i=1; $i<=$totalPages_RecMember_rule+1; $i++)
				{
				  //如果非正在顯示的分頁則建立頁碼連結
				  if ($i != $pageNum_RecMember_rule+1 )
				  { 
					
					echo "<a href=";
					printf("%s?pageNum_RecMember_rule=%d%s", $currentPage, $i-1, $queryString_RecMember_rule);
					echo ">" . $i . "</a> | " ;
				  }
				  //如果是正在顯示的方頁則單純顯示頁碼
				  else
				  { 
					echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
				  }
				}
			}
			else//$totalPages_RecMember_rule>10
			{
				$morePage_num=$totalPages_RecMember_rule-$pageNum_RecMember_rule;//此頁面之後總共有多少
				if($morePage_num>7)
				{
					if($pageNum_RecMember_rule<3)
					{
						if($totalRows_RecMember_rule == 0)
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
						  if ($i != $pageNum_RecMember_rule+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecMember_rule=%d%s", $currentPage, $i-1, $queryString_RecMember_rule);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
							echo "<a href=";
							printf("%s?pageNum_RecMember_rule=%d%s", $currentPage, $totalPages_RecMember_rule, $queryString_RecMember_rule);
							echo ">..." .($totalPages_RecMember_rule+1). "</a> | " ;
					}
					else//$pageNum_RecMember_rule>=3
					{
						echo "<a href=";
						printf("%s?pageNum_RecMember_rule=%d%s", $currentPage, 0, $queryString_RecMember_rule);
						echo ">" . 1 . "...</a> | " ;
												
						for ($i=$pageNum_RecMember_rule-1; $i<=$pageNum_RecMember_rule+8; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecMember_rule+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecMember_rule=%d%s", $currentPage, $i-1, $queryString_RecMember_rule);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
						echo "<a href=";
						printf("%s?pageNum_RecMember_rule=%d%s", $currentPage, $totalPages_RecMember_rule, $queryString_RecMember_rule);
						echo ">..." .($totalPages_RecMember_rule+1). "</a> | " ;
					}
				}
				else//$morePage_num<=7
				{
						$beforePage_num=9-$morePage_num;
						$beforePage=$pageNum_RecMember_rule-$beforePage_num;
						
						//echo "<br>beforePage_num=".$beforePage_num."<br>";
						//echo "beforePage=".$beforePage."<br>";
						
						echo "<a href=";
						printf("%s?pageNum_RecMember_rule=%d%s", $currentPage, 0, $queryString_RecMember_rule);
						echo ">" . 1 . "...</a> | " ;
							
						for ($i=$beforePage+1; $i<=$totalPages_RecMember_rule+1; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecMember_rule+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecMember_rule=%d%s", $currentPage, $i-1, $queryString_RecMember_rule);
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
        
        <td><?php if ($pageNum_RecMember_rule < $totalPages_RecMember_rule) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_RecMember_rule=%d%s", $currentPage, min($totalPages_RecMember_rule, $pageNum_RecMember_rule + 1), $queryString_RecMember_rule); ?>">></a>
              <?php } // Show if not last page ?>
        </td>
 <?php ?>      
        
        

      </tr>
    </table>
<!-------顯示頁選擇與分頁設定結束---------->
            <td width="110" align="right" class="page_display"><?php if ($totalRows_RecMember_rule > 0) { // Show if recordset not empty ?>
                頁數:<?php echo (($pageNum_RecMember_rule+1)."/".($totalPages_RecMember_rule+1)); ?>
  <?php } // Show if recordset not empty ?>
</td>
            <td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows_RecMember_rule ?> </td>
            <td width="24" align="right">&nbsp;</td>
     	</tr>
	</table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        	<td><img src="image/spacer.gif" width="1" height="1" /></td>
        </tr>
    </table>
	<form action="member_rule_process.php" method="post" name="form1" id="form1">
      <?php if ($totalRows_RecMember_rule > 0) { // Show if recordset not empty ?>
        <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
          <tr>
            <td width="35%" align="center" class="table_title">新增日期</td>
            <td width="56%" align="center" class="table_title">標題</td>
            <td width="9%" align="center" class="table_title">編輯</td>
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
          <td align="center" class="table_data" ><a href="member_rule_edit.php?d_id=<?php echo $row_RecMember_rule['d_id']; ?>"><?php echo $row_RecMember_rule['d_date']; ?></a></td>
        <td align="center" class="table_data" ><a href="member_rule_edit.php?d_id=<?php echo $row_RecMember_rule['d_id']; ?>"><?php echo $row_RecMember_rule['d_title']; ?></a></td>

            <td align="center" class="table_data"><a href="member_rule_edit.php?d_id=<?php echo $row_RecMember_rule['d_id']; ?>"><img src="image/pencil.png" width="16" height="16" /></a></td>
         </tr>
          <?php } while ($row_RecMember_rule = mysql_fetch_assoc($RecMember_rule)); ?>
        </table>
        <?php } // Show if recordset not empty ?>
</form>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
        <tr>
            <td width="739" align="right" class="page_display">
            <!-------顯示頁選擇與分頁設定開始---------->
    <table border="0">
      <tr>
        <td><?php if ($pageNum_RecMember_rule > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_RecMember_rule=%d%s", $currentPage, max(0, $pageNum_RecMember_rule - 1), $queryString_RecMember_rule); ?>"><</a>
              <?php } // Show if not first page ?>
        </td>
        
        <td>
        <?php
			//echo $totalRows_RecMember_rule;//所有筆數
			//echo $totalPages_RecMember_rule;//最後分頁的頁數,由0開始的陣列
			//echo $pageNum_RecMember_rule;//現在顯示的頁面,由0開始的陣列
			//echo $currentPage;//現在的目錄路徑
			//echo $queryString_RecMember_rule;//以字串顯示所有的筆數,如&totalRows_RecMember_rule=11
			if($totalPages_RecMember_rule<10)
			{
				if($totalRows_RecMember_rule == 0)
				{
					//如果沒有任何資料，不顯示|符號
				}
				else
				{
					echo " | ";
				}
				
				for ($i=1; $i<=$totalPages_RecMember_rule+1; $i++)
				{
				  //如果非正在顯示的分頁則建立頁碼連結
				  if ($i != $pageNum_RecMember_rule+1 )
				  { 
					
					echo "<a href=";
					printf("%s?pageNum_RecMember_rule=%d%s", $currentPage, $i-1, $queryString_RecMember_rule);
					echo ">" . $i . "</a> | " ;
				  }
				  //如果是正在顯示的方頁則單純顯示頁碼
				  else
				  { 
					echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
				  }
				}
			}
			else//$totalPages_RecMember_rule>10
			{
				$morePage_num=$totalPages_RecMember_rule-$pageNum_RecMember_rule;//此頁面之後總共有多少
				if($morePage_num>7)
				{
					if($pageNum_RecMember_rule<3)
					{
						if($totalRows_RecMember_rule == 0)
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
						  if ($i != $pageNum_RecMember_rule+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecMember_rule=%d%s", $currentPage, $i-1, $queryString_RecMember_rule);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
							echo "<a href=";
							printf("%s?pageNum_RecMember_rule=%d%s", $currentPage, $totalPages_RecMember_rule, $queryString_RecMember_rule);
							echo ">..." .($totalPages_RecMember_rule+1). "</a> | " ;
					}
					else//$pageNum_RecMember_rule>=3
					{
						echo "<a href=";
						printf("%s?pageNum_RecMember_rule=%d%s", $currentPage, 0, $queryString_RecMember_rule);
						echo ">" . 1 . "...</a> | " ;
												
						for ($i=$pageNum_RecMember_rule-1; $i<=$pageNum_RecMember_rule+8; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecMember_rule+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecMember_rule=%d%s", $currentPage, $i-1, $queryString_RecMember_rule);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
						echo "<a href=";
						printf("%s?pageNum_RecMember_rule=%d%s", $currentPage, $totalPages_RecMember_rule, $queryString_RecMember_rule);
						echo ">..." .($totalPages_RecMember_rule+1). "</a> | " ;
					}
				}
				else//$morePage_num<=7
				{
						$beforePage_num=9-$morePage_num;
						$beforePage=$pageNum_RecMember_rule-$beforePage_num;
						
						//echo "<br>beforePage_num=".$beforePage_num."<br>";
						//echo "beforePage=".$beforePage."<br>";
						
						echo "<a href=";
						printf("%s?pageNum_RecMember_rule=%d%s", $currentPage, 0, $queryString_RecMember_rule);
						echo ">" . 1 . "...</a> | " ;
							
						for ($i=$beforePage+1; $i<=$totalPages_RecMember_rule+1; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecMember_rule+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecMember_rule=%d%s", $currentPage, $i-1, $queryString_RecMember_rule);
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
        
        <td><?php if ($pageNum_RecMember_rule < $totalPages_RecMember_rule) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_RecMember_rule=%d%s", $currentPage, min($totalPages_RecMember_rule, $pageNum_RecMember_rule + 1), $queryString_RecMember_rule); ?>">></a>
              <?php } // Show if not last page ?>
        </td>
 <?php ?>      
        
        

      </tr>
    </table>
<!-------顯示頁選擇與分頁設定結束---------->
            <td width="110" align="right" class="page_display"><?php if ($totalRows_RecMember_rule > 0) { // Show if recordset not empty ?>
                頁數:<?php echo (($pageNum_RecMember_rule+1)."/".($totalPages_RecMember_rule+1)); ?>
  <?php } // Show if recordset not empty ?>
</td>
            <td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows_RecMember_rule ?> </td>
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
mysql_free_result($RecMember_rule);
?>
