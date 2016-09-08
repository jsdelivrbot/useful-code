<?php
			if (!isset($_SESSION)) {
               session_start();
               }
            ob_start();
?>
<?php require_once('../Connections/connect2data.php'); ?>
<?php $menu_is="orders";?>
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

$maxRows_RecMember = 10;
$pageNum_RecMember = 0;
if (isset($_GET['pageNum_RecMember'])) {
  $pageNum_RecMember = $_GET['pageNum_RecMember'];
}
$startRow_RecMember = $pageNum_RecMember * $maxRows_RecMember;

mysql_select_db($database_connect2data, $connect2data);

$input1="";
if(isset($_POST['input1'])){
	$input1 = $_POST['input1'];
}
$input2="";
if(isset($_POST['input2'])){
	$input2 = $_POST['input2'];
}
$input3="";
if(isset($_POST['input3'])){
	$input3 = $_POST['input3'];
}
if($input1!="")
{
	$query_RecMember = "SELECT * FROM member_set WHERE member_set.m_name LIKE '%".$input1."%' ORDER BY `m_date` DESC";	
	//echo "客戶姓名<br>";	
}else if($input1=="" && $input2!="")
{
	$query_RecMember = "SELECT * FROM member_set WHERE member_set.m_account LIKE '%".$input2."%' ORDER BY `m_date` DESC";	
	//echo "會員帳號<br>";
}else if($input1=="" && $input2=="" && $input3!="")
{
	$query_RecMember = "SELECT * FROM member_set  WHERE member_set.m_id='".$input3."' ORDER BY `m_date` DESC";
	//echo "會員編號<br>";
}else if($input1=="" && $input2=="" && $input3=="")
{
	$query_RecMember = "SELECT * FROM member_set ORDER BY m_id DESC";
}

$query_limit_RecMember = sprintf("%s LIMIT %d, %d", $query_RecMember, $startRow_RecMember, $maxRows_RecMember);
$RecMember = mysql_query($query_limit_RecMember, $connect2data) or die(mysql_error());
$row_RecMember = mysql_fetch_assoc($RecMember);

if (isset($_GET['totalRows_RecMember'])) {
  $totalRows_RecMember = $_GET['totalRows_RecMember'];
} else {
  $all_RecMember = mysql_query($query_RecMember);
  $totalRows_RecMember = mysql_num_rows($all_RecMember);
}
$totalPages_RecMember = ceil($totalRows_RecMember/$maxRows_RecMember)-1;
$TotalPage = $totalPages_RecMember;

$queryString_RecMember = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RecMember") == false && 
        stristr($param, "totalRows_RecMember") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecMember = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecMember = sprintf("&totalRows_RecMember=%d%s", $totalRows_RecMember, $queryString_RecMember);
?>
<?php 
   $R_pageNum_RecMember = 0;
 if (isset($_REQUEST["pageNum_RecMember"])) 
 {
 	$R_pageNum_RecMember = $_REQUEST["pageNum_RecMember"];
 }
      if (! isset($R_pageNum_RecMember)) 
      {
	  	$_SESSION["ToPage"]=0;
	  }
 	  //若指定分頁數小於1則預設顯示第一頁
  	  else if ($R_pageNum_RecMember<0) 
      {
	  	$_SESSION["ToPage"]=0;
      }
	  //若指定指定的分頁超過總分頁數則顯示最後一頁
 	  else if ($R_pageNum_RecMember>$totalPages_RecMember)
      {
	  	$_SESSION["ToPage"]=$TotalPage;
	  }
	  else
	  {
	  	$_SESSION["ToPage"]=$R_pageNum_RecMember;
 	  }
?>
<?php
	//如果指定的頁面大於資料所擁有的頁面,轉到最大的頁面
	if($R_pageNum_RecMember>$totalPages_RecMember && $R_pageNum_RecMember!=0)
	{
		header("Location:orders_list.php?pageNum_RecMember=".$totalPages_RecMember);
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
<script type="text/javascript">
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
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
          <td width="87" class="list_title">會員列表</td>
          <td width="719" align="right">
          <form action="orders_searchM_add.php" method="post">
            <table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><span class="no_data">
          <?php if ($totalRows_RecMember == 0) { // Show if recordset empty ?>
            <strong>目前沒有任何相關會員</strong>
            <?php } // Show if recordset empty ?></span></td>
                <td align="left" class="table_data">以會員姓名搜尋：
                  <label><br />
                  <input name="input1" type="text" id="input1" size="20" />
                  <a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image53','','image/go2.gif',1)">
                  <button type="submit" class="no_board"><img src="image/go1.gif" name="Image53" width="25" height="15" border="0" id="Image" /></button>
                  </a></label></td>
                <td align="left" class="table_data">以會員帳號搜尋：
                  <label><br />
                    <input name="input2" type="text" id="input2" size="20" />
                    <a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image53','','image/go2.gif',1)">
                    <button type="submit" class="no_board"><img src="image/go1.gif" name="Image53" width="25" height="15" border="0" id="Image" /></button>
                    </a></label></td>
                <td align="left" class="table_data">&nbsp;</td>
                <td align="left" class="table_data">以會員編號搜尋：
                  <label><br />
                  <input name="input3" type="text" id="input3" size="20" />
                  <a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image53','','image/go2.gif',1)"><button type="submit" class="no_board"><img src="image/go1.gif" name="Image53" width="25" height="15" border="0" id="Image53" /></button></a></label></td>
                </tr>
            </table>
          </form></td>
        </tr>
      </table>
  <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
  <tr>
    <td width="739" align="right" class="page_display">
    <!-------顯示頁選擇與分頁設定開始---------->
    <!-------顯示頁選擇與分頁設定結束---------->
    <table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td width="300" align="center" class="list_title">請先選擇新增單訂之會員</td>
        <td width="268" align="right"><table border="0">
          <tr>
            <td><?php if ($pageNum_RecMember > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_RecMember=%d%s", $currentPage, max(0, $pageNum_RecMember - 1), $queryString_RecMember); ?>">&lt;</a>
                <?php } // Show if not first page ?>
            </td>
            <td><?php
			//echo $totalRows_RecMember;//所有筆數
			//echo $totalPages_RecMember;//最後分頁的頁數,由0開始的陣列
			//echo $pageNum_RecMember;//現在顯示的頁面,由0開始的陣列
			//echo $currentPage;//現在的目錄路徑
			//echo $queryString_RecMember;//以字串顯示所有的筆數,如&totalRows_RecMember=11
			if($totalPages_RecMember<10)
			{
				if($totalRows_RecMember == 0)
				{
					//如果沒有任何資料，不顯示|符號
				}
				else
				{
					echo " | ";
				}
				
				for ($i=1; $i<=$totalPages_RecMember+1; $i++)
				{
				  //如果非正在顯示的分頁則建立頁碼連結
				  if ($i != $pageNum_RecMember+1 )
				  { 
					
					echo "<a href=";
					printf("%s?pageNum_RecMember=%d%s", $currentPage, $i-1, $queryString_RecMember);
					echo ">" . $i . "</a> | " ;
				  }
				  //如果是正在顯示的方頁則單純顯示頁碼
				  else
				  { 
					echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
				  }
				}
			}
			else//$totalPages_RecMember>10
			{
				$morePage_num=$totalPages_RecMember-$pageNum_RecMember;//此頁面之後總共有多少
				if($morePage_num>7)
				{
					if($pageNum_RecMember<3)
					{
						if($totalRows_RecMember == 0)
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
						  if ($i != $pageNum_RecMember+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecMember=%d%s", $currentPage, $i-1, $queryString_RecMember);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
							echo "<a href=";
							printf("%s?pageNum_RecMember=%d%s", $currentPage, $totalPages_RecMember, $queryString_RecMember);
							echo ">..." .($totalPages_RecMember+1). "</a> | " ;
					}
					else//$pageNum_RecMember>=3
					{
						echo "<a href=";
						printf("%s?pageNum_RecMember=%d%s", $currentPage, 0, $queryString_RecMember);
						echo ">" . 1 . "...</a> | " ;
												
						for ($i=$pageNum_RecMember-1; $i<=$pageNum_RecMember+8; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecMember+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecMember=%d%s", $currentPage, $i-1, $queryString_RecMember);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
						echo "<a href=";
						printf("%s?pageNum_RecMember=%d%s", $currentPage, $totalPages_RecMember, $queryString_RecMember);
						echo ">..." .($totalPages_RecMember+1). "</a> | " ;
					}
				}
				else//$morePage_num<=7
				{
						$beforePage_num=9-$morePage_num;
						$beforePage=$pageNum_RecMember-$beforePage_num;
						
						//echo "<br>beforePage_num=".$beforePage_num."<br>";
						//echo "beforePage=".$beforePage."<br>";
						
						echo "<a href=";
						printf("%s?pageNum_RecMember=%d%s", $currentPage, 0, $queryString_RecMember);
						echo ">" . 1 . "...</a> | " ;
							
						for ($i=$beforePage+1; $i<=$totalPages_RecMember+1; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecMember+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecMember=%d%s", $currentPage, $i-1, $queryString_RecMember);
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
            <td><?php if ($pageNum_RecMember < $totalPages_RecMember) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_RecMember=%d%s", $currentPage, min($totalPages_RecMember, $pageNum_RecMember + 1), $queryString_RecMember); ?>">&gt;</a>
                <?php } // Show if not last page ?>
            </td>
            <?php ?>
          </tr>
        </table></td>
      </tr>
    </table></td>
    <td width="110" align="right" class="page_display"><?php if ($totalRows_RecMember > 0) { // Show if recordset not empty ?>
        頁數:<?php echo (($pageNum_RecMember+1)."/".($totalPages_RecMember+1)); ?>
  <?php } // Show if recordset not empty ?>
</td>
    <td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows_RecMember ?> </td>
    <td width="24" align="right">&nbsp;</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="image/spacer.gif" width="1" height="1" /></td>
  </tr>
</table>
<form action="news_process.php" method="post" name="form1" id="form1">
  <?php if ($totalRows_RecMember > 0) { // Show if recordset not empty ?>
    <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
      <tr>
        <td align="center" class="table_title">會員編號</td>
        <td align="center" class="table_title">會員姓名</td>
        <td align="center" class="table_title">會員帳號</td>
        <td align="center" class="table_title">電話</td>
        <td width="80" align="center" class="table_title">新增訂單</td>
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
     <td align="center" class="table_data" ><a href="orders_add.php?m_id=<?php echo $row_RecMember['m_id']; ?>"><?php echo $row_RecMember['m_id']; ?></a></td>
        <td align="center" class="table_data" ><a href="orders_add.php?m_id=<?php echo $row_RecMember['m_id']; ?>"><?php echo $row_RecMember['m_name']; ?></a></td>
        <td align="center" class="table_data" ><a href="orders_add.php?m_id=<?php echo $row_RecMember['m_id']; ?>"><?php echo $row_RecMember['m_account']; ?></a></td>
        <td align="center" class="table_data" ><a href="orders_add.php?m_id=<?php echo $row_RecMember['m_id']; ?>"><?php echo $row_RecMember['m_phone']; ?></a></td>
        <td align="center" class="table_data"><a href="orders_add.php?m_id=<?php echo $row_RecMember['m_id']; ?>"><img src="image/add.png" width="16" height="16" /></a></td>
        </tr>
      <?php } while ($row_RecMember = mysql_fetch_assoc($RecMember)); ?>
    </table>
    <?php } // Show if recordset not empty ?>
</form>
 <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
  <tr>
    <td width="739" align="right" class="page_display">
    <!-------顯示頁選擇與分頁設定開始---------->
    <table border="0">
      <tr>
        <td><?php if ($pageNum_RecMember > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_RecMember=%d%s", $currentPage, max(0, $pageNum_RecMember - 1), $queryString_RecMember); ?>"><</a>
              <?php } // Show if not first page ?>
        </td>
        
        <td>
        <?php
			//echo $totalRows_RecMember;//所有筆數
			//echo $totalPages_RecMember;//最後分頁的頁數,由0開始的陣列
			//echo $pageNum_RecMember;//現在顯示的頁面,由0開始的陣列
			//echo $currentPage;//現在的目錄路徑
			//echo $queryString_RecMember;//以字串顯示所有的筆數,如&totalRows_RecMember=11
			if($totalPages_RecMember<10)
			{
				if($totalRows_RecMember == 0)
				{
					//如果沒有任何資料，不顯示|符號
				}
				else
				{
					echo " | ";
				}
				
				for ($i=1; $i<=$totalPages_RecMember+1; $i++)
				{
				  //如果非正在顯示的分頁則建立頁碼連結
				  if ($i != $pageNum_RecMember+1 )
				  { 
					
					echo "<a href=";
					printf("%s?pageNum_RecMember=%d%s", $currentPage, $i-1, $queryString_RecMember);
					echo ">" . $i . "</a> | " ;
				  }
				  //如果是正在顯示的方頁則單純顯示頁碼
				  else
				  { 
					echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
				  }
				}
			}
			else//$totalPages_RecMember>10
			{
				$morePage_num=$totalPages_RecMember-$pageNum_RecMember;//此頁面之後總共有多少
				if($morePage_num>7)
				{
					if($pageNum_RecMember<3)
					{
						if($totalRows_RecMember == 0)
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
						  if ($i != $pageNum_RecMember+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecMember=%d%s", $currentPage, $i-1, $queryString_RecMember);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
							echo "<a href=";
							printf("%s?pageNum_RecMember=%d%s", $currentPage, $totalPages_RecMember, $queryString_RecMember);
							echo ">..." .($totalPages_RecMember+1). "</a> | " ;
					}
					else//$pageNum_RecMember>=3
					{
						echo "<a href=";
						printf("%s?pageNum_RecMember=%d%s", $currentPage, 0, $queryString_RecMember);
						echo ">" . 1 . "...</a> | " ;
												
						for ($i=$pageNum_RecMember-1; $i<=$pageNum_RecMember+8; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecMember+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecMember=%d%s", $currentPage, $i-1, $queryString_RecMember);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
						echo "<a href=";
						printf("%s?pageNum_RecMember=%d%s", $currentPage, $totalPages_RecMember, $queryString_RecMember);
						echo ">..." .($totalPages_RecMember+1). "</a> | " ;
					}
				}
				else//$morePage_num<=7
				{
						$beforePage_num=9-$morePage_num;
						$beforePage=$pageNum_RecMember-$beforePage_num;
						
						//echo "<br>beforePage_num=".$beforePage_num."<br>";
						//echo "beforePage=".$beforePage."<br>";
						
						echo "<a href=";
						printf("%s?pageNum_RecMember=%d%s", $currentPage, 0, $queryString_RecMember);
						echo ">" . 1 . "...</a> | " ;
							
						for ($i=$beforePage+1; $i<=$totalPages_RecMember+1; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecMember+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecMember=%d%s", $currentPage, $i-1, $queryString_RecMember);
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
        
        <td><?php if ($pageNum_RecMember < $totalPages_RecMember) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_RecMember=%d%s", $currentPage, min($totalPages_RecMember, $pageNum_RecMember + 1), $queryString_RecMember); ?>">></a>
              <?php } // Show if not last page ?>
        </td>
 <?php ?>      
        
        

      </tr>
    </table>
<!-------顯示頁選擇與分頁設定結束---------->
    </td>
    <td width="110" align="right" class="page_display">頁數:<?php echo (($pageNum_RecMember+1)."/".($totalPages_RecMember+1)); ?></td>
    <td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows_RecMember ?> </td>
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
mysql_free_result($RecMember);
?>
