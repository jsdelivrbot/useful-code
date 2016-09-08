<?php
if (!isset($_SESSION)) {
	session_start();
}
ob_start();
?>
<?php require_once('../Connections/connect2data.php'); ?>
<?php require_once('../orders_statusA.php'); ?>
<?php require_once('../js/fun_moneyFormat.php'); ?>
<?php require_once('../js/fun_changeStr.php'); ?>
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

if(!in_array(3,$_SESSION['MM_Limit']['a6'])){
	header("Location: first.php");
}

$num="";
$numSQL='';
if(isset($_REQUEST['num']) && $_REQUEST['num']!=''){
	$num = $_REQUEST['num'];
	$numSQL = " AND (O.o_number='$num')";		
	//echo "以訂單編號搜尋<br>";
}

$date="";
$dateSQL='';
if(isset($_REQUEST['start']) && isset($_REQUEST['end'])){
	
	$start = $_REQUEST['start'];
	$end = $_REQUEST['end'];
	
	if($start!='' && $end!=''){
		//$dateSQL = " AND (`datetime`>='".$start." 00:00:00' AND `datetime`<='".$end." 23:59:59')";	
		$dateSQL = " AND (`datetime` BETWEEN '".$start." 00:00:00' AND '".$end." 23:59:59')";
	}
	
	//echo "以日期查詢<br>";
}

$fulltxt="";
$fulltxtSQL='';
if(isset($_REQUEST['fulltxt']) && $_REQUEST['fulltxt']!=''){
	$fulltxt = $_REQUEST['fulltxt'];
	$fulltxtSQL = " AND (O.client LIKE '%".$fulltxt."%' OR O.cellphone LIKE '%".$fulltxt."%' OR O.email LIKE '%".$fulltxt."%' OR O.address LIKE '%".$fulltxt."%' OR O.r_client LIKE '%".$fulltxt."%' OR O.r_cellphone LIKE '%".$fulltxt."%' OR O.r_email LIKE '%".$fulltxt."%' OR O.r_address LIKE '%".$fulltxt."%' OR O.remitter LIKE '%".$fulltxt."%' OR O.remitter_AC LIKE '%".$fulltxt."%' OR O.remitter_money LIKE '%".$fulltxt."%' OR O.notation LIKE '%".$fulltxt."%' OR O.GrandTotal LIKE '%".$fulltxt."%' OR OI.d_name LIKE '%".$fulltxt."%')";
	//echo "以文字搜尋<br>";
}

$status="";
$statusSQL='';
if(isset($_REQUEST['status'])){
	$status = $_REQUEST['status'];
	if($status=='-1'){
		$statusSQL='';
	}else{
		$statusSQL = " AND (O.transport_status = '$status')";
		//echo "進度<br>";
	}	
}


/*購買產品*/
$items="-1";
$itemsSQL='';
if(isset($_REQUEST['items'])){
	$items = $_REQUEST['items'];
	if($items!='-1'){
		$itemsSQL = " AND (OI.d_id = '$items' )";
	}
}
/*mysql_select_db($database_connect2data, $connect2data);
$query_RecOrderItem = sprintf("SELECT o_id, d_name FROM order_item WHERE d_id = %s", GetSQLValueString($items, "int"));
$RecOrderItem = mysql_query($query_RecOrderItem,$connect2data) or die(mysql_error());
$row_RecOrderItem = mysql_fetch_assoc($RecOrderItem);
$totalRows_RecOrderItem = mysql_num_rows($RecOrderItem);

if($totalRows_RecOrderItem>0){
	$itemsSQL = " AND (O.o_id = '".$row_RecOrderItem['o_id']."' )";
}*/
/*購買產品*/

//echo $itemsSQL.'<br>';

/*所有產品*/
mysql_select_db($database_connect2data, $connect2data);
$query_RecProducts = "SELECT * FROM term_relationships AS TR, data_set AS D, terms AS T
WHERE TR.term_taxonomy_id = T.term_id AND D.d_id = TR.object_id ORDER BY term_order ASC, d_date DESC";
$RecProducts = mysql_query($query_RecProducts, $connect2data) or die(mysql_error());
$row_RecProducts = mysql_fetch_assoc($RecProducts);
/*所有產品*/


$_SESSION['REFERER'] = $_SERVER['REQUEST_URI'];

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RecOrder = 15;
$pageNum_RecOrder = 0;
if (isset($_GET['pageNum_RecOrder'])) {
  $pageNum_RecOrder = $_GET['pageNum_RecOrder'];
}
$startRow_RecOrder = $pageNum_RecOrder * $maxRows_RecOrder;

mysql_select_db($database_connect2data, $connect2data);
//$query_RecOrder = "SELECT * FROM order_set AS O WHERE O.o_number!='' $numSQL $dateSQL $fulltxtSQL $statusSQL $itemsSQL ORDER BY `datetime` DESC";
$query_RecOrder = "SELECT * FROM order_set AS O LEFT JOIN order_item AS OI ON O.o_id=OI.o_id WHERE O.o_number!='' $numSQL $dateSQL $fulltxtSQL $statusSQL $itemsSQL GROUP BY O.o_id ORDER BY `datetime` DESC";
$query_limit_RecOrder = sprintf("%s LIMIT %d, %d", $query_RecOrder, $startRow_RecOrder, $maxRows_RecOrder);
$RecOrder = mysql_query($query_limit_RecOrder, $connect2data) or die(mysql_error());
$row_RecOrder = mysql_fetch_assoc($RecOrder);

//echo $query_RecOrder;

/*if (isset($_GET['totalRows_RecOrder'])) {
  $totalRows_RecOrder = $_GET['totalRows_RecOrder'];
} else {
  $all_RecOrder = mysql_query($query_RecOrder);
  $totalRows_RecOrder = mysql_num_rows($all_RecOrder);
}*/
$all_RecOrder = mysql_query($query_RecOrder);
  $totalRows_RecOrder = mysql_num_rows($all_RecOrder);
$totalPages = ceil($totalRows_RecOrder/$maxRows_RecOrder)-1;

$TotalPage = $totalPages;

$queryString_RecOrder = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RecOrder") == false && 
        stristr($param, "totalRows_RecOrder") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecOrder = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecOrder = sprintf("&totalRows_RecOrder=%d%s", $totalRows_RecOrder, $queryString_RecOrder);
?>
<?php 
   $R_pageNum_RecOrder = 0;
 if (isset($_REQUEST["pageNum_RecOrder"])) 
 {
 	$R_pageNum_RecOrder = $_REQUEST["pageNum_RecOrder"];
 }
      if (! isset($R_pageNum_RecOrder)) 
      {
	  	$_SESSION["ToPage"]=0;
	  }
 	  //若指定分頁數小於1則預設顯示第一頁
  	  else if ($R_pageNum_RecOrder<0) 
      {
	  	$_SESSION["ToPage"]=0;
      }
	  //若指定指定的分頁超過總分頁數則顯示最後一頁
 	  else if ($R_pageNum_RecOrder>$totalPages)
      {
	  	$_SESSION["ToPage"]=$TotalPage;
	  }
	  else
	  {
	  	$_SESSION["ToPage"]=$R_pageNum_RecOrder;
 	  }
?>
<?php
	//如果指定的頁面大於資料所擁有的頁面,轉到最大的頁面
	if($R_pageNum_RecOrder>$totalPages && $R_pageNum_RecOrder!=0)
	{
		header("Location:orders_list.php?pageNum_RecOrder=".$totalPages);
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
    
    
<!--<link rel="stylesheet" href="../js/bootstrap.min.css">-->
<script src="../js/bootstrap.js"></script>
<link rel="stylesheet" href="../js/bootstrap-datepicker/css/datepicker3.css">
<script src="../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="../js/bootstrap-datepicker/js/locales/bootstrap-datepicker.zh-TW.js"></script>


    
	  <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="87" class="list_title">訂單列表</td>
          <td align="right">
          <form action="orders_list.php" method="post" enctype="multipart/form-data" id="searchF" >
            <table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td valign="middle">
          <?php if ($totalRows_RecOrder == 0) { // Show if recordset empty ?>
            <span class="no_data"><strong>目前沒有任何訂單</strong></span>&nbsp;&nbsp;
            <?php } // Show if recordset empty ?></td>
            
            	
                <td class="table_data">
                
                
                <table width="1030" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="130">以物流進度搜尋：</td>
    <td width="130">以產品搜尋：</td>
    <td width="130">以訂單編號搜尋：</td>
    <td width="260">以日期查詢：</td>
    <td width="260">以文字搜尋：</td>
    <td width="54">&nbsp;</td>
    <td width="70">&nbsp;</td>
  </tr>
  <tr>
    <td><label class="searchLab">
                  <select name="status" id="status" class="input-sm form-control table_data"  style="width:130px;"><option value="-1">請選擇</option><?php foreach ($statusB as $i => $value) {?><option value="<?php echo $i; ?>"><?php echo $statusB[$i]; ?></option><?php } ?></select></label></td>
                  

    <td><label class="searchLab">
    		<select name="items" id="items" class="input-sm form-control table_data"  style="width:130px;">
                  
                  <option value="-1">請選擇</option>
	<?php
    do{
		echo "<option value='".$row_RecProducts['d_id']."'>".$row_RecProducts['d_title']."</option>";
	} while ($row_RecProducts = mysql_fetch_assoc($RecProducts));
	?>                 
                  
       </select></label>
                  
    </td>
                  
    <td>
    <label class="searchLab">
                  <input name="num" type="text" id="num" class="input-sm form-control table_data" style="width:130px;" />
                  </label>
    </td>
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
    <label class="searchLabBtn2">							
                  <button id="exportBtn" class="btn btn-default btn-sm" type="button">匯出表單</button>
                  </label>
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
        <td><?php if ($pageNum_RecOrder > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_RecOrder=%d%s", $currentPage, max(0, $pageNum_RecOrder - 1), $queryString_RecOrder); ?>"><</a>
              <?php } // Show if not first page ?>
        </td>
        
        <td>
        <?php
			//echo $totalRows_RecOrder;//所有筆數
			//echo $totalPages;//最後分頁的頁數,由0開始的陣列
			//echo $pageNum_RecOrder;//現在顯示的頁面,由0開始的陣列
			//echo $currentPage;//現在的目錄路徑
			//echo $queryString_RecOrder;//以字串顯示所有的筆數,如&totalRows_RecOrder=11
			if($totalPages<10)
			{
				if($totalRows_RecOrder == 0)
				{
					//如果沒有任何資料，不顯示|符號
				}
				else
				{
					echo " | ";
				}
				
				for ($i=1; $i<=$totalPages+1; $i++)
				{
				  //如果非正在顯示的分頁則建立頁碼連結
				  if ($i != $pageNum_RecOrder+1 )
				  { 
					
					echo "<a href=";
					printf("%s?pageNum_RecOrder=%d%s", $currentPage, $i-1, $queryString_RecOrder);
					echo ">" . $i . "</a> | " ;
				  }
				  //如果是正在顯示的方頁則單純顯示頁碼
				  else
				  { 
					echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
				  }
				}
			}
			else//$totalPages>10
			{
				$morePage_num=$totalPages-$pageNum_RecOrder;//此頁面之後總共有多少
				if($morePage_num>7)
				{
					if($pageNum_RecOrder<3)
					{
						if($totalRows_RecOrder == 0)
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
						  if ($i != $pageNum_RecOrder+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecOrder=%d%s", $currentPage, $i-1, $queryString_RecOrder);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
							echo "<a href=";
							printf("%s?pageNum_RecOrder=%d%s", $currentPage, $totalPages, $queryString_RecOrder);
							echo ">..." .($totalPages+1). "</a> | " ;
					}
					else//$pageNum_RecOrder>=3
					{
						echo "<a href=";
						printf("%s?pageNum_RecOrder=%d%s", $currentPage, 0, $queryString_RecOrder);
						echo ">" . 1 . "...</a> | " ;
												
						for ($i=$pageNum_RecOrder-1; $i<=$pageNum_RecOrder+8; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecOrder+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecOrder=%d%s", $currentPage, $i-1, $queryString_RecOrder);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
						echo "<a href=";
						printf("%s?pageNum_RecOrder=%d%s", $currentPage, $totalPages, $queryString_RecOrder);
						echo ">..." .($totalPages+1). "</a> | " ;
					}
				}
				else//$morePage_num<=7
				{
						$beforePage_num=9-$morePage_num;
						$beforePage=$pageNum_RecOrder-$beforePage_num;
						
						//echo "<br>beforePage_num=".$beforePage_num."<br>";
						//echo "beforePage=".$beforePage."<br>";
						
						echo "<a href=";
						printf("%s?pageNum_RecOrder=%d%s", $currentPage, 0, $queryString_RecOrder);
						echo ">" . 1 . "...</a> | " ;
							
						for ($i=$beforePage+1; $i<=$totalPages+1; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecOrder+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecOrder=%d%s", $currentPage, $i-1, $queryString_RecOrder);
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
        
        <td><?php if ($pageNum_RecOrder < $totalPages) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_RecOrder=%d%s", $currentPage, min($totalPages, $pageNum_RecOrder + 1), $queryString_RecOrder); ?>">></a>
              <?php } // Show if not last page ?>
        </td>
 <?php ?>      
        
        

      </tr>
    </table>
<!-------顯示頁選擇與分頁設定結束---------->
    </td>
    <td width="110" align="right" class="page_display"><?php if ($totalRows_RecOrder > 0) { // Show if recordset not empty ?>
        頁數:<?php echo (($pageNum_RecOrder+1)."/".($totalPages+1)); ?>
  <?php } // Show if recordset not empty ?>
</td>
    <td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows_RecOrder ?> </td>
    <td width="24" align="right">&nbsp;</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="image/spacer.gif" width="1" height="1" /></td>
  </tr>
</table>
<form action="news_process.php" method="post" name="form1" id="form1">
  <?php if ($totalRows_RecOrder > 0) { // Show if recordset not empty ?>
    <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
      <tr>
        <td align="center" class="table_title">訂單編號</td>
        <td align="center" class="table_title">訂單日期</td>
        <td align="center" class="table_title">客戶</td>
        <td align="center" class="table_title">訂單總額</td>
        <td align="center" class="table_title">付款方式</td>
        <td align="center" class="table_title">銀行匯款狀態</td>
        <td align="center" class="table_title">訂單狀態</td>
        <td align="center" class="table_title">物流狀態</td>
        
        <?php if(in_array(5,$_SESSION['MM_Limit']['a6'])){ ?>
            <td align="center" class="table_title">編輯</td>
            <?php } ?>
            <?php if(in_array(7,$_SESSION['MM_Limit']['a6'])){ ?>
            <td align="center" class="table_title">刪除</td>
            <?php } ?>
            
      </tr>
      <?php
	    $j=0;
	    do {
	?>
      <tr <?php echo (($j%2==0))?"":"bgcolor='#E4E4E4'";?>>
      
      <td height="25" align="center" class="table_data" >
      
      <?php
          if(in_array(5,$_SESSION['MM_Limit']['a6'])){
			  echo '<a href="orders_edit.php?o_id='.$row_RecOrder['o_id'].'">'.$row_RecOrder['o_number'].'</a>';
		  }else{
			  echo $row_RecOrder['o_number'];
		  }
		  ?>
      
      <!--<a href="orders_edit.php?o_id=<?php //echo $row_RecOrder['o_id']; ?>"><?php //echo $row_RecOrder['o_number']; ?></a>-->
      
      </td>
      
        <td align="center" class="table_data" >
      
      <?php
          if(in_array(5,$_SESSION['MM_Limit']['a6'])){
			  echo '<a href="orders_edit.php?o_id='.$row_RecOrder['o_id'].'">'.sortDate($row_RecOrder['datetime'], '-').'</a>';
		  }else{
			  echo sortDate($row_RecOrder['datetime'], '-');
		  }
		  ?>
        
        <!--<a href="orders_edit.php?o_id=<?php //echo $row_RecOrder['o_id']; ?>"><?php //echo sortDate($row_RecOrder['datetime'], '-'); ?></a>-->
        
        </td>
        
        <td align="center" class="table_data" >        
      
      <?php
          if(in_array(5,$_SESSION['MM_Limit']['a6'])){
			  echo '<a href="orders_edit.php?o_id='.$row_RecOrder['o_id'].'">'.$row_RecOrder['client'].'</a>';
		  }else{
			  echo $row_RecOrder['client'];
		  }
		  ?>
          
        <!--<a href="orders_edit.php?o_id=<?php //echo $row_RecOrder['o_id']; ?>"><?php //echo $row_RecOrder['client']; ?></a>-->
        
        </td>
        <td align="center" class="table_data" >
      
      <?php
          if(in_array(5,$_SESSION['MM_Limit']['a6'])){
			  echo '<a href="orders_edit.php?o_id='.$row_RecOrder['o_id'].'">'.moneyFormat($row_RecOrder['GrandTotal']).' 元'.'</a>';
		  }else{
			  echo moneyFormat($row_RecOrder['GrandTotal']).' 元';
		  }
		  ?>
        
        <!--<a href="orders_edit.php?o_id=<?php //echo $row_RecOrder['o_id']; ?>"><?php //echo $grandTotal = moneyFormat($row_RecOrder['GrandTotal']).' 元'; ?></a>-->
        
        </td>
        
        <td align="center" class="table_data" >
        
   <?php
   $paymentTxt = '';
   $payment = $row_RecOrder['payment'];
if (!(strcmp(1, $payment))) {$paymentTxt = "銀行轉帳";}
if (!(strcmp(2, $payment))) {$paymentTxt =  "貨到付款";}
          if(in_array(5,$_SESSION['MM_Limit']['a6'])){
			  echo '<a href="orders_edit.php?o_id='.$row_RecOrder['o_id'].'">'.$paymentTxt.'</a>';
		  }else{
			  echo $paymentTxt;
		  }
		  ?>     
        
        <!--<a href="orders_edit.php?o_id=<?php //echo $row_RecOrder['o_id']; ?>">
<?php
/*$payment = $row_RecOrder['payment'];
if (!(strcmp(1, $payment))) {echo "銀行轉帳";}
if (!(strcmp(2, $payment))) {echo "貨到付款";}*/
?>
    </a>--></td>

        <td align="center" class="table_data" >
        
<?php
          if(in_array(5,$_SESSION['MM_Limit']['a6'])){
			  if (!(strcmp(1, $payment))) {
	
				if ($row_RecOrder['remitter_active']==1){
					
					echo "<a href='orders_report_show.php?o_id=".$row_RecOrder['o_id']."' title=\"按我查看回報資訊\"><img src=\"image/accept.png\" width=\"16\" height=\"16\"  >&nbsp;匯款已回報，回報資訊</a>";
					
				}else{
					
					echo "<a href='orders_report.php?o_id=".$row_RecOrder['o_id']."'  title=\"按我回報\"><img src=\"image/delete.png\" width=\"16\" height=\"16\"  >&nbsp;匯款未回報，按我回報</a>";
					
				}
				
			}else{
				echo "無";
			}
		  }else{
			  if (!(strcmp(1, $payment))) {
	
				if ($row_RecOrder['remitter_active']==1){
					
					echo "<a href='orders_report_show.php?o_id=".$row_RecOrder['o_id']."' title=\"按我查看回報資訊\"><img src=\"image/accept.png\" width=\"16\" height=\"16\"  >&nbsp;匯款已回報，回報資訊</a>";
					
				}else{
					
					echo "<img src=\"image/delete.png\" width=\"16\" height=\"16\"  >&nbsp;匯款未回報";
					
				}
				
			}else{
				echo "無";
			}
		  }
		  ?>
                  
        <?php
/*if (!(strcmp(1, $payment))) {
	
	if ($row_RecOrder['remitter_active']==1){
		
		echo "<a href='orders_report_show.php?o_id=".$row_RecOrder['o_id']."' title=\"按我查看回報資訊\"><img src=\"image/accept.png\" width=\"16\" height=\"16\"  >&nbsp;匯款已回報，回報資訊</a>";
		
	}else{
		
		echo "<a href='orders_report.php?o_id=".$row_RecOrder['o_id']."'  title=\"按我回報\"><img src=\"image/delete.png\" width=\"16\" height=\"16\"  >&nbsp;匯款未回報，按我回報</a>";
		
	}
	
}else{
	echo "無";
}*/
?></td>
        <td align="center" class="table_data" >
        
 <?php
$r_status = 0;
$inputName = '';
$statusArray = array();
if (!(strcmp(3, $payment))) { //線上刷卡
	
	$statusArray = $statusA_1;
	$inputName = 'card_status';
	
	if($row_RecOrder['card_status']!=3){
		mysql_select_db($database_connect2data, $connect2data);
		$query_RecResponse = "SELECT r_status FROM response_set WHERE r_lidm = '".$row_RecOrder['o_number']."' AND r_o_id = '".$row_RecOrder['o_id']."'";
		$RecResponse = mysql_query($query_RecResponse, $connect2data) or die(mysql_error());
		$row_RecResponse = mysql_fetch_assoc($RecResponse);
		$totalRows_RecResponse = mysql_num_rows($RecResponse);
	
		if($totalRows_RecResponse>0){
			if( (isset($row_RecResponse['r_status'])) && ($row_RecResponse['r_status']==0) ){
				$r_status = 1;
			}elseif( ($row_RecResponse['r_status']>0) ){
				$r_status = 0;
			}elseif( (($row_RecResponse['r_status']==NULL)||($row_RecResponse['r_status']<0)) ){
				$r_status = 2;
			}
		}
	}else{
		$r_status = 3;
	}

}elseif (!(strcmp(2, $payment))) { //貨到付款
	
	$statusArray = $statusA_2;
	$inputName = 'cash_status';
	$r_status = $row_RecOrder['cash_status'];
	
}elseif (!(strcmp(1, $payment))) { //銀行轉帳
	
	$statusArray = $statusA_2;
	$inputName = 'bank_status';
	
	/*if($row_RecOrder['bank_status']!=2){
		if($row_RecOrder['remitter_active']==1){
			$r_status = 1;
		}else{
			$r_status = 0;
		}
	}else{
		$r_status = 2;
	}*/
	$r_status = $row_RecOrder['bank_status'];
}
/*echo 'r_status = '.$r_status.'<br>';
echo 'payment = '.$payment.'<br>';
echo 'bank_status = '.$row_RecOrder['bank_status'].'<br>';
echo 'cash_status = '.$row_RecOrder['cash_status'].'<br>';
echo 'remitter_active = '.$row_RecOrder['remitter_active'].'<br>';*/
/*if (!(strcmp(1, $payment))) {
	//if (!(strcmp(1, $row_RecOrder['bank_status'])) && $row_RecOrder['remitter_active']==1){
	if ($row_RecOrder['remitter_active']==1){
		echo "<a href='orders_report_show.php?o_id=".$row_RecOrder['o_id']."'><img src=\"image/accept.png\" width=\"16\" height=\"16\"  >&nbsp;".$statusArray[$r_status]."，匯款已回報，回報資訊</a>";
	}else{
		echo "<a href='orders_report.php?o_id=".$row_RecOrder['o_id']."'  title=\"匯款未回報，按我回報\"><img src=\"image/delete.png\" width=\"16\" height=\"16\"  >&nbsp;".$statusArray[$r_status]."，匯款未回報，按我回報</a>";
	}
}else{
	echo $statusArray[$r_status];
}*/
 if(in_array(5,$_SESSION['MM_Limit']['a6'])){
	 echo '<a href="orders_edit.php?o_id='.$row_RecOrder['o_id'].'">'.$statusArray[$r_status].'</a>';
 }else{
	echo $statusArray[$r_status];	 
 }

	//echo $r_status.'<br>';
?>       
        
        <!--<a href="orders_edit.php?o_id=<?php //echo $row_RecOrder['o_id']; ?>">
<?php
/*$r_status = 0;
$inputName = '';
$statusArray = array();
if (!(strcmp(3, $payment))) { //線上刷卡
	
	$statusArray = $statusA_1;
	$inputName = 'card_status';
	
	if($row_RecOrder['card_status']!=3){
		mysql_select_db($database_connect2data, $connect2data);
		$query_RecResponse = "SELECT r_status FROM response_set WHERE r_lidm = '".$row_RecOrder['o_number']."' AND r_o_id = '".$row_RecOrder['o_id']."'";
		$RecResponse = mysql_query($query_RecResponse, $connect2data) or die(mysql_error());
		$row_RecResponse = mysql_fetch_assoc($RecResponse);
		$totalRows_RecResponse = mysql_num_rows($RecResponse);
	
		if($totalRows_RecResponse>0){
			if( (isset($row_RecResponse['r_status'])) && ($row_RecResponse['r_status']==0) ){
				$r_status = 1;
			}elseif( ($row_RecResponse['r_status']>0) ){
				$r_status = 0;
			}elseif( (($row_RecResponse['r_status']==NULL)||($row_RecResponse['r_status']<0)) ){
				$r_status = 2;
			}
		}
	}else{
		$r_status = 3;
	}

}elseif (!(strcmp(2, $payment))) { //貨到付款
	
	$statusArray = $statusA_2;
	$inputName = 'cash_status';
	$r_status = $row_RecOrder['cash_status'];
	
}elseif (!(strcmp(1, $payment))) { //銀行轉帳
	
	$statusArray = $statusA_2;
	$inputName = 'bank_status';
	
	$r_status = $row_RecOrder['bank_status'];
}

echo $statusArray[$r_status];*/
?>
</a>-->
</td>
        
        <td align="center"  class="table_data">
        
        <?php
          if(in_array(5,$_SESSION['MM_Limit']['a6'])){
			  echo '<a href="orders_edit.php?o_id='.$row_RecOrder['o_id'].'">';
			  foreach ($statusB as $i => $value) {
				if (!(strcmp($i, $row_RecOrder['transport_status']))) {echo $statusB[$i];}
			}
			  echo '</a>';
		  }else{
			  foreach ($statusB as $i => $value) {
				if (!(strcmp($i, $row_RecOrder['transport_status']))) {echo $statusB[$i];}
			}
		  }
		  ?>
        
        <!--<a href="orders_edit.php?o_id=<?php //echo $row_RecOrder['o_id']; ?>">
		<?php 
		/*foreach ($statusB as $i => $value) {
			if (!(strcmp($i, $row_RecOrder['transport_status']))) {echo $statusB[$i];}
		}*/
		?>
     
        </a>-->
        </td>
        
        <?php if(in_array(5,$_SESSION['MM_Limit']['a6'])){ ?>
            <td align="center" class="table_data"><a href="orders_edit.php?o_id=<?php echo $row_RecOrder['o_id']; ?>"><img src="image/pencil.png" width="16" height="16" /></a></td>
            <?php } ?>
            <?php if(in_array(7,$_SESSION['MM_Limit']['a6'])){ ?>
            <td align="center" class="table_data"><a href="orders_del.php?o_id=<?php echo $row_RecOrder['o_id']; ?>"><img src="image/cross.png" width="16" height="16" /></a></td>
            <?php } ?>
        
        
        <!--<td align="center" class="table_data"><a href="orders_edit.php?o_id=<?php //echo $row_RecOrder['o_id']; ?>"><img src="image/pencil.png" width="16" height="16" /></a></td>
        <td align="center" class="table_data"><a href="orders_del.php?o_id=<?php //echo $row_RecOrder['o_id']; ?>"><img src="image/cross.png" width="16" height="16" /></a></td>-->
      </tr>
      <?php $j=$j+1; ?>
      <?php } while ($row_RecOrder = mysql_fetch_assoc($RecOrder)); ?>
    </table>
    <?php } // Show if recordset not empty ?>
</form>
 <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
  <tr>
    <td width="739" align="right" class="page_display">
    <!-------顯示頁選擇與分頁設定開始---------->
    <table border="0">
      <tr>
        <td><?php if ($pageNum_RecOrder > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_RecOrder=%d%s", $currentPage, max(0, $pageNum_RecOrder - 1), $queryString_RecOrder); ?>"><</a>
              <?php } // Show if not first page ?>
        </td>
        
        <td>
        <?php
			//echo $totalRows_RecOrder;//所有筆數
			//echo $totalPages;//最後分頁的頁數,由0開始的陣列
			//echo $pageNum_RecOrder;//現在顯示的頁面,由0開始的陣列
			//echo $currentPage;//現在的目錄路徑
			//echo $queryString_RecOrder;//以字串顯示所有的筆數,如&totalRows_RecOrder=11
			if($totalPages<10)
			{
				if($totalRows_RecOrder == 0)
				{
					//如果沒有任何資料，不顯示|符號
				}
				else
				{
					echo " | ";
				}
				
				for ($i=1; $i<=$totalPages+1; $i++)
				{
				  //如果非正在顯示的分頁則建立頁碼連結
				  if ($i != $pageNum_RecOrder+1 )
				  { 
					
					echo "<a href=";
					printf("%s?pageNum_RecOrder=%d%s", $currentPage, $i-1, $queryString_RecOrder);
					echo ">" . $i . "</a> | " ;
				  }
				  //如果是正在顯示的方頁則單純顯示頁碼
				  else
				  { 
					echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
				  }
				}
			}
			else//$totalPages>10
			{
				$morePage_num=$totalPages-$pageNum_RecOrder;//此頁面之後總共有多少
				if($morePage_num>7)
				{
					if($pageNum_RecOrder<3)
					{
						if($totalRows_RecOrder == 0)
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
						  if ($i != $pageNum_RecOrder+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecOrder=%d%s", $currentPage, $i-1, $queryString_RecOrder);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
							echo "<a href=";
							printf("%s?pageNum_RecOrder=%d%s", $currentPage, $totalPages, $queryString_RecOrder);
							echo ">..." .($totalPages+1). "</a> | " ;
					}
					else//$pageNum_RecOrder>=3
					{
						echo "<a href=";
						printf("%s?pageNum_RecOrder=%d%s", $currentPage, 0, $queryString_RecOrder);
						echo ">" . 1 . "...</a> | " ;
												
						for ($i=$pageNum_RecOrder-1; $i<=$pageNum_RecOrder+8; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecOrder+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecOrder=%d%s", $currentPage, $i-1, $queryString_RecOrder);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
						echo "<a href=";
						printf("%s?pageNum_RecOrder=%d%s", $currentPage, $totalPages, $queryString_RecOrder);
						echo ">..." .($totalPages+1). "</a> | " ;
					}
				}
				else//$morePage_num<=7
				{
						$beforePage_num=9-$morePage_num;
						$beforePage=$pageNum_RecOrder-$beforePage_num;
						
						//echo "<br>beforePage_num=".$beforePage_num."<br>";
						//echo "beforePage=".$beforePage."<br>";
						
						echo "<a href=";
						printf("%s?pageNum_RecOrder=%d%s", $currentPage, 0, $queryString_RecOrder);
						echo ">" . 1 . "...</a> | " ;
							
						for ($i=$beforePage+1; $i<=$totalPages+1; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecOrder+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecOrder=%d%s", $currentPage, $i-1, $queryString_RecOrder);
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
        
        <td><?php if ($pageNum_RecOrder < $totalPages) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_RecOrder=%d%s", $currentPage, min($totalPages, $pageNum_RecOrder + 1), $queryString_RecOrder); ?>">></a>
              <?php } // Show if not last page ?>
        </td>
 <?php ?>      
        
        

      </tr>
    </table>
<!-------顯示頁選擇與分頁設定結束---------->
    </td>
    <td width="110" align="right" class="page_display">頁數:<?php echo (($pageNum_RecOrder+1)."/".($totalPages+1)); ?></td>
    <td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows_RecOrder ?> </td>
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
mysql_free_result($RecOrder);
?>
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
		$("#searchF").attr('action', 'orders_list.php');
		$("#searchF").submit();
		//window.location.href = "../PHPExcel_1.8.0_doc/download-xls.php?status="+$('#status').val()+"&num="+$('#num').val()+"&start="+$('input[name$="start"]').val()+"&end="+$('input[name$="end"]').val()+"&fulltxt="+$('#fulltxt').val();
	});
	
	$('#exportBtn').click(function(){
		//alert('exportBtn click');
		
		if(confirm('您確定要匯出表單嗎？')){
			$("#searchF").attr('action', '../PHPExcel_1.8.0_doc/download-xls.php');
			$("#searchF").submit();
		}
		
		/*$.ajax({
		  type: "POST",
		  url: '../PHPExcel_1.8.0_doc/download-xls.php',
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
		//window.location.href = "../PHPExcel_1.8.0_doc/download-xls.php?status="+$('#status').val()+"&num="+$('#num').val()+"&start="+$('input[name$="start"]').val()+"&end="+$('input[name$="end"]').val()+"&fulltxt="+$('#fulltxt').val();
	});
	
	

		$('#datepicker').datepicker({
			format: "yyyy-mm-dd",
			endDate: "+1d",
			//startView: 1,
			language: "zh-TW",
   			autoclose: true,
			todayHighlight: true
		});
});
</script>