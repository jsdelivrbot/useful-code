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

$maxRows_RecMessage = 10;
$pageNum_RecMessage = 0;
if (isset($_GET['pageNum_RecMessage'])) {
  $pageNum_RecMessage = $_GET['pageNum_RecMessage'];
}
$startRow_RecMessage = $pageNum_RecMessage * $maxRows_RecMessage;


//$query_RecMessage = "SELECT data_set.d_id, data_set.d_date, data_set.d_title, data_set.d_class2, data_set.d_class3, Count(message_set.m_d_id) AS TIMES, max(If(message_set.m_date ,message_set.m_date,data_set.d_date)) AS NewUpdate FROM data_set LEFT JOIN message_set ON data_set.d_id = message_set.m_d_id WHERE data_set.d_class1 = 'message'  GROUP BY data_set.d_id ORDER BY NewUpdate DESC";
//$query_RecMessage = "SELECT data_set.d_id, data_set.d_date, data_set.d_title, data_set.d_class2, data_set.d_class3, Count(message_set.m_d_id) AS TIMES, max(If(message_set.m_date ,message_set.m_date,data_set.d_date)) AS NewUpdate FROM data_set LEFT JOIN message_set ON data_set.d_id = message_set.m_d_id WHERE data_set.d_class1 = 'message'  GROUP BY data_set.d_id ORDER BY NewUpdate DESC";

mysql_select_db($database_connect2data, $connect2data);
$query_RecMessage = "SELECT D.d_id, D.d_date, D.d_title, D.d_price1, Count(M.m_d_id) AS TIMES, max(If(M.m_date, M.m_date, D.d_date)) AS NewUpdate FROM data_set AS D LEFT JOIN message_set AS M ON D.d_id = M.m_d_id WHERE D.d_class1='message' GROUP BY D.d_id ORDER BY NewUpdate DESC";
$query_limit_RecMessage = sprintf("%s LIMIT %d, %d", $query_RecMessage, $startRow_RecMessage, $maxRows_RecMessage);
$RecMessage = mysql_query($query_limit_RecMessage, $connect2data) or die(mysql_error());
$row_RecMessage = mysql_fetch_assoc($RecMessage);

if (isset($_GET['totalRows_RecMessage'])) {
  $totalRows_RecMessage = $_GET['totalRows_RecMessage'];
} else {
  $all_RecMessage = mysql_query($query_RecMessage);
  $totalRows_RecMessage = mysql_num_rows($all_RecMessage);
}
$totalPages_RecMessage = ceil($totalRows_RecMessage/$maxRows_RecMessage)-1;


mysql_select_db($database_connect2data, $connect2data);
$G_selected = '';
/*if(isset($_GET['selected']))
{
$G_selected = $_GET['selected'];
	$query_RecMessage = "SELECT * FROM data_set WHERE class1 = 'message' AND class2='".$G_selected."' ORDER BY sort ASC, date DESC";
	$_SESSION['selected_message']=$G_selected; 
}else 
{
	$query_RecMessage = "SELECT * FROM data_set WHERE class1 = 'message' AND class2='".$row_RecMessage['c_id']."' ORDER BY sort ASC, date DESC";
	$_SESSION['selected_message']=$row_RecMessage['c_id'];
}



$query_limit_RecMessage = sprintf("%s LIMIT %d, %d", $query_RecMessage, $startRow_RecMessage, $maxRows_RecMessage);
$RecMessage = mysql_query($query_limit_RecMessage, $connect2data) or die(mysql_error());
$row_RecMessage = mysql_fetch_assoc($RecMessage);
*/
if (isset($_GET['totalRows_RecMessage'])) {
  $S_original_selected='';
  if(isset($_SESSION['original_selected'])){
  	$S_original_selected = $_SESSION['original_selected'];
  }
  if(isset($_GET['selected'])){
	$G_selected = $_GET['selected'];
  } 
  if($S_original_selected==$G_selected)
	{
		$totalRows_RecMessage = $_GET['totalRows_RecMessage'];
	}else
	{
		$all_RecMessage = mysql_query($query_RecMessage);
 		$totalRows_RecMessage = mysql_num_rows($all_RecMessage);
	}
} else {
  $all_RecMessage = mysql_query($query_RecMessage);
  $totalRows_RecMessage = mysql_num_rows($all_RecMessage);
}
$totalPages_RecMessage = ceil($totalRows_RecMessage/$maxRows_RecMessage)-1;
$TotalPage = $totalPages_RecMessage;

$queryString_RecMessage = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RecMessage") == false && 
        stristr($param, "totalRows_RecMessage") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecMessage = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecMessage = sprintf("&totalRows_RecMessage=%d%s", $totalRows_RecMessage, $queryString_RecMessage);
 $menu_is="message";?>
 <?php 
    $R_pageNum_RecMessage = 0;
 if (isset($_REQUEST["pageNum_RecMessage"])) 
 {
 	$R_pageNum_RecMessage = $_REQUEST["pageNum_RecMessage"];
 }
      if (! isset($R_pageNum_RecMessage)) 
      {
	  	$_SESSION["ToPage"]=0;
	  }
 	  //若指定分頁數小於1則預設顯示第一頁
  	  else if ($R_pageNum_RecMessage<0) 
      {
	  	$_SESSION["ToPage"]=0;
      }
	  //若指定指定的分頁超過總分頁數則顯示最後一頁
 	  else if ($R_pageNum_RecMessage>$totalPages_RecMessage)
      {
	  	$_SESSION["ToPage"]=$TotalPage;
	  }
	  else
	  {
	  	$_SESSION["ToPage"]=$R_pageNum_RecMessage;
 	  }
?>
<?php
	//如果指定的頁面大於資料所擁有的頁面,轉到最大的頁面
	if($R_pageNum_RecMessage>$totalPages_RecMessage && $R_pageNum_RecMessage!=0)
	{
		header("Location:message_list.php?pageNum_RecMessage=".$totalPages_RecMessage);
	}

	
?>

<?php
//修改排序
/*$G_changeSort = 0;
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
	
	if(isset($_GET['selected']))
{
	$G_selected = $_GET['selected'];
	$query_RecMessage = "SELECT * FROM data_set WHERE class1 = 'message' AND class2='".$G_selected."' ORDER BY sort ASC, date DESC";
}else 
{
	$query_RecMessage = "SELECT * FROM data_set WHERE class1 = 'message' AND class2='".$row_RecMessage[c_id]."' ORDER BY sort ASC, date DESC";
}

	$RecMessage = mysql_query($query_RecMessage, $connect2data) or die(mysql_error());
	$row_RecMessage = mysql_fetch_assoc($RecMessage);
	

	do{
	
		if($row_RecMessage['sort']==0)
		{}
		else if($row_RecMessage['d_id']==$_GET['now_d_id'])
		{	
			echo $sort_num."<br/>";
			
		}else if($sort_num==$_GET['change_num'])
		{
			echo $sort_num."<br/>";
			$sort_num++;
			
			$updateSQL = sprintf("UPDATE data_set SET sort=%s WHERE d_id=%s",
			   GetSQLValueString($sort_num, "int"),
			   GetSQLValueString($row_RecMessage['d_id'], "int"));

			mysql_select_db($database_connect2data, $connect2data);
			$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
			
			$sort_num++;
		}
		else
		{
			$updateSQL = sprintf("UPDATE data_set SET sort=%s WHERE d_id=%s",
			   GetSQLValueString($sort_num, "int"),
			   GetSQLValueString($row_RecMessage['d_id'], "int"));

			mysql_select_db($database_connect2data, $connect2data);
			$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
			
			echo $sort_num."<br/>";
			echo $row_RecMessage['title']."->".$sort_num."<br/>";
			
			$sort_num++;		
		}
		
		
	//echo " ".$row_RecMessage['sort'];
	}while ($row_RecMessage = mysql_fetch_assoc($RecMessage));
	
	
			$updateSQL = sprintf("UPDATE data_set SET sort=%s WHERE d_id=%s",
			   GetSQLValueString($_GET['change_num'], "int"),
			   GetSQLValueString($_GET['now_d_id'], "int"));

			mysql_select_db($database_connect2data, $connect2data);
			$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
	if($G_changeSort==1)
	{
		if(isset($_GET['selected']))
		{
			$G_selected = $_GET['selected'];
			header("Location:message_list.php?selected=".$G_selected."&pageNum_RecMessage=".$_GET['pageNum_RecMessage']."&totalRows_RecMessage=".$_GET['totalRows_RecMessage']);
		}else
		{
			header("Location:message_list.php?selected=".$row_RecMessage[c_id]."&pageNum_RecMessage=".$_GET['pageNum_RecMessage']."&totalRows_RecMessage=".$_GET['totalRows_RecMessage']);
		}
	
	}else if($G_delchangeSort==1)
	{
		if(isset($_GET['selected']))
		{	
			$G_selected = $_GET['selected'];
			header("Location:message_list.php?selected=".$G_selected."&pageNum_RecMessage=".$_GET['pageNum_RecMessage']);
		}else
		{
			header("Location:message_list.php?selected=".$row_RecMessage[c_id]."&pageNum_RecMessage=".$_GET['pageNum_RecMessage']);
		}
	}
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
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<script type="text/javascript">
<!--
function changeSort(pageNum_RecMessage, totalRows_RecMessage, now_d_id, change_num, selected) { //v1.0
 //alert(pageNum_RecMessage+"+"+totalPages_RecMessage); 
 window.location.href="message_list.php?selected="+selected+"&pageNum_RecMessage="+pageNum_RecMessage+"&totalRows_RecMessage="+totalRows_RecMessage+"&changeSort=1"+"&now_d_id="+now_d_id+"&change_num="+change_num;
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
        	<td width="128" class="list_title">產品留言訊息列表</td>
        	<td width="672"><span class="table_data">
        	  <label></label>
</span><span class="no_data">
            <?php if ($totalRows_RecMessage == 0) { // Show if recordset empty ?>
              <strong>目前資料庫中沒有任何產品留言訊息資料</strong>
              <?php } // Show if recordset empty ?>
</span></td>
        </tr>
    </table>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
    	<tr>
            <td width="739" align="right" class="page_display">
            <!-------顯示頁選擇與分頁設定開始---------->
            <table border="0">
      <tr>
        <td><?php if ($pageNum_RecMessage > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_RecMessage=%d%s", $currentPage, max(0, $pageNum_RecMessage - 1), $queryString_RecMessage); ?>"><</a>
              <?php } // Show if not first page ?>
        </td>
        
        <td>
        <?php
			//echo $totalRows_RecMessage;//所有筆數
			//echo $totalPages_RecMessage;//最後分頁的頁數,由0開始的陣列
			//echo $pageNum_RecMessage;//現在顯示的頁面,由0開始的陣列
			//echo $currentPage;//現在的目錄路徑
			//echo $queryString_RecMessage;//以字串顯示所有的筆數,如&totalRows_RecMessage=11
			if($totalPages_RecMessage<10)
			{
				if($totalRows_RecMessage == 0)
				{
					//如果沒有任何資料，不顯示|符號
				}
				else
				{
					echo " | ";
				}
				
				for ($i=1; $i<=$totalPages_RecMessage+1; $i++)
				{
				  //如果非正在顯示的分頁則建立頁碼連結
				  if ($i != $pageNum_RecMessage+1 )
				  { 
					
					echo "<a href=";
					printf("%s?pageNum_RecMessage=%d%s", $currentPage, $i-1, $queryString_RecMessage);
					echo ">" . $i . "</a> | " ;
				  }
				  //如果是正在顯示的方頁則單純顯示頁碼
				  else
				  { 
					echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
				  }
				}
			}
			else//$totalPages_RecMessage>10
			{
				$morePage_num=$totalPages_RecMessage-$pageNum_RecMessage;//此頁面之後總共有多少
				if($morePage_num>7)
				{
					if($pageNum_RecMessage<3)
					{
						if($totalRows_RecMessage == 0)
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
						  if ($i != $pageNum_RecMessage+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecMessage=%d%s", $currentPage, $i-1, $queryString_RecMessage);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
							echo "<a href=";
							printf("%s?pageNum_RecMessage=%d%s", $currentPage, $totalPages_RecMessage, $queryString_RecMessage);
							echo ">..." .($totalPages_RecMessage+1). "</a> | " ;
					}
					else//$pageNum_RecMessage>=3
					{
						echo "<a href=";
						printf("%s?pageNum_RecMessage=%d%s", $currentPage, 0, $queryString_RecMessage);
						echo ">" . 1 . "...</a> | " ;
												
						for ($i=$pageNum_RecMessage-1; $i<=$pageNum_RecMessage+8; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecMessage+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecMessage=%d%s", $currentPage, $i-1, $queryString_RecMessage);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
						echo "<a href=";
						printf("%s?pageNum_RecMessage=%d%s", $currentPage, $totalPages_RecMessage, $queryString_RecMessage);
						echo ">..." .($totalPages_RecMessage+1). "</a> | " ;
					}
				}
				else//$morePage_num<=7
				{
						$beforePage_num=9-$morePage_num;
						$beforePage=$pageNum_RecMessage-$beforePage_num;
						
						//echo "<br>beforePage_num=".$beforePage_num."<br>";
						//echo "beforePage=".$beforePage."<br>";
						
						echo "<a href=";
						printf("%s?pageNum_RecMessage=%d%s", $currentPage, 0, $queryString_RecMessage);
						echo ">" . 1 . "...</a> | " ;
							
						for ($i=$beforePage+1; $i<=$totalPages_RecMessage+1; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecMessage+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecMessage=%d%s", $currentPage, $i-1, $queryString_RecMessage);
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
        
        <td><?php if ($pageNum_RecMessage < $totalPages_RecMessage) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_RecMessage=%d%s", $currentPage, min($totalPages_RecMessage, $pageNum_RecMessage + 1), $queryString_RecMessage); ?>">></a>
              <?php } // Show if not last page ?>
        </td>
 <?php ?>      
        
        

      </tr>
    </table>
<!-------顯示頁選擇與分頁設定結束---------->
            <td width="110" align="right" class="page_display"><?php if ($totalRows_RecMessage > 0) { // Show if recordset not empty ?>
                頁數:<?php echo (($pageNum_RecMessage+1)."/".($totalPages_RecMessage+1)); ?>
  <?php } // Show if recordset not empty ?>
</td>
            <td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows_RecMessage ?> </td>
            <td width="24" align="right">&nbsp;</td>
     	</tr>
	</table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        	<td><img src="image/spacer.gif" width="1" height="1" /></td>
        </tr>
    </table>
	<form action="message_process.php" method="post" name="form1" id="form1">
      <?php if ($totalRows_RecMessage > 0) { // Show if recordset not empty ?>
        <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
          <tr>
            <td width="200" align="center" class="table_title">更新日期</td>
                <td align="center" class="table_title">留言產品</td>
                <td align="center" class="table_title">留言次數</td>
                <td width="60" align="center" class="table_title">編輯</td>
                <td width="60" align="center" class="table_title">刪除</td>
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
          <td align="center" class="table_data" ><a href="message_show.php?d_id=<?php echo $row_RecMessage['d_id']; ?>">
            <?php 
		echo $d_date = $row_RecMessage['NewUpdate']; ?>
          </a></td>
      <td align="center" class="table_data" ><label><a href="message_show.php?d_id=<?php echo $row_RecMessage['d_id']; ?>"><?php echo $row_RecMessage['d_title']; ?></a></label></td>
        <td align="center"  class="table_data"><a href="message_show.php?d_id=<?php echo $row_RecMessage['d_id']; ?>"><?php echo $row_RecMessage['d_price1']; ?></a></td>
        <td align="center" class="table_data"><a href="message_show.php?d_id=<?php echo $row_RecMessage['d_id']; ?>"><img src="image/pencil.png" width="16" height="16" /></a></td>
        <td align="center" class="table_data"><a href="message_del.php?d_id=<?php echo $row_RecMessage['d_id']; ?>"><img src="image/cross.png" width="16" height="16" /></a></td>
    </tr>
          <?php } while ($row_RecMessage = mysql_fetch_assoc($RecMessage)); ?>
        </table>
        <?php } // Show if recordset not empty ?>
</form>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
        <tr>
            <td width="739" align="right" class="page_display">
            <!-------顯示頁選擇與分頁設定開始---------->
    <table border="0">
      <tr>
        <td><?php if ($pageNum_RecMessage > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_RecMessage=%d%s", $currentPage, max(0, $pageNum_RecMessage - 1), $queryString_RecMessage); ?>"><</a>
              <?php } // Show if not first page ?>
        </td>
        
        <td>
        <?php
			//echo $totalRows_RecMessage;//所有筆數
			//echo $totalPages_RecMessage;//最後分頁的頁數,由0開始的陣列
			//echo $pageNum_RecMessage;//現在顯示的頁面,由0開始的陣列
			//echo $currentPage;//現在的目錄路徑
			//echo $queryString_RecMessage;//以字串顯示所有的筆數,如&totalRows_RecMessage=11
			if($totalPages_RecMessage<10)
			{
				if($totalRows_RecMessage == 0)
				{
					//如果沒有任何資料，不顯示|符號
				}
				else
				{
					echo " | ";
				}
				
				for ($i=1; $i<=$totalPages_RecMessage+1; $i++)
				{
				  //如果非正在顯示的分頁則建立頁碼連結
				  if ($i != $pageNum_RecMessage+1 )
				  { 
					
					echo "<a href=";
					printf("%s?pageNum_RecMessage=%d%s", $currentPage, $i-1, $queryString_RecMessage);
					echo ">" . $i . "</a> | " ;
				  }
				  //如果是正在顯示的方頁則單純顯示頁碼
				  else
				  { 
					echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
				  }
				}
			}
			else//$totalPages_RecMessage>10
			{
				$morePage_num=$totalPages_RecMessage-$pageNum_RecMessage;//此頁面之後總共有多少
				if($morePage_num>7)
				{
					if($pageNum_RecMessage<3)
					{
						if($totalRows_RecMessage == 0)
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
						  if ($i != $pageNum_RecMessage+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecMessage=%d%s", $currentPage, $i-1, $queryString_RecMessage);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
							echo "<a href=";
							printf("%s?pageNum_RecMessage=%d%s", $currentPage, $totalPages_RecMessage, $queryString_RecMessage);
							echo ">..." .($totalPages_RecMessage+1). "</a> | " ;
					}
					else//$pageNum_RecMessage>=3
					{
						echo "<a href=";
						printf("%s?pageNum_RecMessage=%d%s", $currentPage, 0, $queryString_RecMessage);
						echo ">" . 1 . "...</a> | " ;
												
						for ($i=$pageNum_RecMessage-1; $i<=$pageNum_RecMessage+8; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecMessage+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecMessage=%d%s", $currentPage, $i-1, $queryString_RecMessage);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
						echo "<a href=";
						printf("%s?pageNum_RecMessage=%d%s", $currentPage, $totalPages_RecMessage, $queryString_RecMessage);
						echo ">..." .($totalPages_RecMessage+1). "</a> | " ;
					}
				}
				else//$morePage_num<=7
				{
						$beforePage_num=9-$morePage_num;
						$beforePage=$pageNum_RecMessage-$beforePage_num;
						
						//echo "<br>beforePage_num=".$beforePage_num."<br>";
						//echo "beforePage=".$beforePage."<br>";
						
						echo "<a href=";
						printf("%s?pageNum_RecMessage=%d%s", $currentPage, 0, $queryString_RecMessage);
						echo ">" . 1 . "...</a> | " ;
							
						for ($i=$beforePage+1; $i<=$totalPages_RecMessage+1; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecMessage+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecMessage=%d%s", $currentPage, $i-1, $queryString_RecMessage);
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
        
        <td><?php if ($pageNum_RecMessage < $totalPages_RecMessage) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_RecMessage=%d%s", $currentPage, min($totalPages_RecMessage, $pageNum_RecMessage + 1), $queryString_RecMessage); ?>">></a>
              <?php } // Show if not last page ?>
        </td>
 <?php ?>      
        
        

      </tr>
    </table>
<!-------顯示頁選擇與分頁設定結束---------->
            <td width="110" align="right" class="page_display"><?php if ($totalRows_RecMessage > 0) { // Show if recordset not empty ?>
                頁數:<?php echo (($pageNum_RecMessage+1)."/".($totalPages_RecMessage+1)); ?>
  <?php } // Show if recordset not empty ?>
</td>
            <td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows_RecMessage ?> </td>
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
mysql_free_result($RecMessage);
?>
