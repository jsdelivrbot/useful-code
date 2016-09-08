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

$_SESSION['REFERER'] = $_SERVER['REQUEST_URI'];

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RecRecOrder = 15;
$pageNum_RecRecOrder = 0;
if (isset($_GET['pageNum_RecRecOrder'])) {
  $pageNum_RecRecOrder = $_GET['pageNum_RecRecOrder'];
}
$startRow_RecRecOrder = $pageNum_RecRecOrder * $maxRows_RecRecOrder;

mysql_select_db($database_connect2data, $connect2data);
$query_RecRecOrder = "SELECT * FROM order_set ORDER BY `datetime` DESC";

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
$input4="";
if(isset($_POST['input4'])){
	$input4 = $_POST['input4'];
}
if($input1!="")
{
	$query_RecRecOrder = "SELECT * FROM order_set WHERE order_set.o_number='".$input1."' ORDER BY `datetime` DESC";
	//echo "訂單編號<br>";
	
}else if($input1=="" && $input2!="")
{
	$query_RecRecOrder = "SELECT * FROM order_set WHERE order_set.client LIKE '%".$input2."%' ORDER BY `datetime` DESC";
	//echo "客戶姓名<br>";

}else if($input1=="" && $input2=="" && $input4!="")
{
	$query_RecRecOrder = "SELECT * FROM order_set WHERE order_set.phone LIKE '%".$input4."%' OR order_set.cellphone LIKE '%".$input4."%' ORDER BY `datetime` DESC";
	//echo "電話<br>";
	
}else if($input1=="" && $input2=="" && $input4=="" && $input3=="-1")
{
	$query_RecRecOrder = "SELECT * FROM order_set ORDER BY `datetime` DESC";
	//echo "null<br>";
	
}else if($input1=="" && $input2=="" && $input4=="" && $input3!="-1")
{
	$query_RecRecOrder = "SELECT * FROM order_set WHERE order_set.transport_status LIKE '%".$input3."%' ORDER BY `datetime` DESC";
	//echo "進度<br>";
	
}
//echo "query = $query_RecRecOrder<br>";
$query_limit_RecRecOrder = sprintf("%s LIMIT %d, %d", $query_RecRecOrder, $startRow_RecRecOrder, $maxRows_RecRecOrder);
$RecRecOrder = mysql_query($query_limit_RecRecOrder, $connect2data) or die(mysql_error());
$row_RecOrder = mysql_fetch_assoc($RecRecOrder);

if (isset($_GET['totalRows_RecRecOrder'])) {
  $totalRows_RecRecOrder = $_GET['totalRows_RecRecOrder'];
} else {
  $all_RecRecOrder = mysql_query($query_RecRecOrder);
  $totalRows_RecRecOrder = mysql_num_rows($all_RecRecOrder);
}
$totalPages_RecRecOrder = ceil($totalRows_RecRecOrder/$maxRows_RecRecOrder)-1;
$TotalPage = $totalPages_RecRecOrder;

$queryString_RecRecOrder = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RecRecOrder") == false && 
        stristr($param, "totalRows_RecRecOrder") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecRecOrder = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecRecOrder = sprintf("&totalRows_RecRecOrder=%d%s", $totalRows_RecRecOrder, $queryString_RecRecOrder);
?>
<?php 
   $R_pageNum_RecRecOrder = 0;
 if (isset($_REQUEST["pageNum_RecRecOrder"])) 
 {
 	$R_pageNum_RecRecOrder = $_REQUEST["pageNum_RecRecOrder"];
 }
      if (! isset($R_pageNum_RecRecOrder)) 
      {
	  	$_SESSION["ToPage"]=0;
	  }
 	  //若指定分頁數小於1則預設顯示第一頁
  	  else if ($R_pageNum_RecRecOrder<0) 
      {
	  	$_SESSION["ToPage"]=0;
      }
	  //若指定指定的分頁超過總分頁數則顯示最後一頁
 	  else if ($R_pageNum_RecRecOrder>$totalPages_RecRecOrder)
      {
	  	$_SESSION["ToPage"]=$TotalPage;
	  }
	  else
	  {
	  	$_SESSION["ToPage"]=$R_pageNum_RecRecOrder;
 	  }
?>
<?php
	//如果指定的頁面大於資料所擁有的頁面,轉到最大的頁面
	if($R_pageNum_RecRecOrder>$totalPages_RecRecOrder && $R_pageNum_RecRecOrder!=0)
	{
		header("Location:orders_list.php?pageNum_RecRecOrder=".$totalPages_RecRecOrder);
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
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
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
          <td width="87" class="list_title">訂單列表</td>
          <td width="719" align="right">
          <form action="orders_search.php" method="post">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td><span class="no_data">
          <?php if ($totalRows_RecRecOrder == 0) { // Show if recordset empty ?>
            <strong>目前沒有任何相關訂單</strong>
            <?php } // Show if recordset empty ?></span></td>
                <td width="150" class="table_data">以訂單編號搜尋：
                  <label><br />
                  <input name="input1" type="text" id="input1" size="10" />
                  <button type="submit" class="no_board"><img src="image/go1.gif" name="Image53" width="25" height="15" border="0" id="Image" /></button>
                  </label></td>
                <td width="150" class="table_data">以聯絡電話搜尋：
                  <label><br />
                  <input name="input4" type="text" id="input4" size="10" />
                  <button type="submit" class="no_board"><img src="image/go1.gif" name="Image53" width="25" height="15" border="0" id="Image53" /></button></label></td>
                <td width="150" class="table_data">以客戶姓名搜尋：<br />
                  <label>
                  <input name="input2" type="text" id="input2" size="10" />
                  <button type="submit" class="no_board"><img src="image/go1.gif" name="Image54" width="25" height="15" border="0" id="Image54" /></button></label></td>
                <td width="130" class="table_data">以物流進度搜尋：
                  <label>                  <br />
                  <select name="input3" id="input3">
                    <option value="-1">請選擇</option>
                    <?php 
					foreach ($statusB as $i => $value) {
					?>
                    <option value="<?php echo $i; ?>"><?php echo $statusB[$i]; ?></option>
                    <?php } ?>
                          </select>
                  <button type="submit" class="no_board"><img src="image/go1.gif" name="Image55" width="25" height="15" border="0" id="Image55" /></button></label></td>
              </tr>
            </table>
          </form></td>
        </tr>
      </table>
  <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
  <tr>
    <td width="314" align="left" valign="middle" class="page_display">   </td>
    <td align="right" class="page_display"><table border="0">
      <tr>
        <td><?php if ($pageNum_RecRecOrder > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_RecRecOrder=%d%s", $currentPage, max(0, $pageNum_RecRecOrder - 1), $queryString_RecRecOrder); ?>">&lt;</a>
            <?php } // Show if not first page ?>
        </td>
        <td><?php
			//echo $totalRows_RecRecOrder;//所有筆數
			//echo $totalPages_RecRecOrder;//最後分頁的頁數,由0開始的陣列
			//echo $pageNum_RecRecOrder;//現在顯示的頁面,由0開始的陣列
			//echo $currentPage;//現在的目錄路徑
			//echo $queryString_RecRecOrder;//以字串顯示所有的筆數,如&totalRows_RecRecOrder=11
			if($totalPages_RecRecOrder<10)
			{
				if($totalRows_RecRecOrder == 0)
				{
					//如果沒有任何資料，不顯示|符號
				}
				else
				{
					echo " | ";
				}
				
				for ($i=1; $i<=$totalPages_RecRecOrder+1; $i++)
				{
				  //如果非正在顯示的分頁則建立頁碼連結
				  if ($i != $pageNum_RecRecOrder+1 )
				  { 
					
					echo "<a href=";
					printf("%s?pageNum_RecRecOrder=%d%s", $currentPage, $i-1, $queryString_RecRecOrder);
					echo ">" . $i . "</a> | " ;
				  }
				  //如果是正在顯示的方頁則單純顯示頁碼
				  else
				  { 
					echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
				  }
				}
			}
			else//$totalPages_RecRecOrder>10
			{
				$morePage_num=$totalPages_RecRecOrder-$pageNum_RecRecOrder;//此頁面之後總共有多少
				if($morePage_num>7)
				{
					if($pageNum_RecRecOrder<3)
					{
						if($totalRows_RecRecOrder == 0)
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
						  if ($i != $pageNum_RecRecOrder+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecRecOrder=%d%s", $currentPage, $i-1, $queryString_RecRecOrder);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
							echo "<a href=";
							printf("%s?pageNum_RecRecOrder=%d%s", $currentPage, $totalPages_RecRecOrder, $queryString_RecRecOrder);
							echo ">..." .($totalPages_RecRecOrder+1). "</a> | " ;
					}
					else//$pageNum_RecRecOrder>=3
					{
						echo "<a href=";
						printf("%s?pageNum_RecRecOrder=%d%s", $currentPage, 0, $queryString_RecRecOrder);
						echo ">" . 1 . "...</a> | " ;
												
						for ($i=$pageNum_RecRecOrder-1; $i<=$pageNum_RecRecOrder+8; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecRecOrder+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecRecOrder=%d%s", $currentPage, $i-1, $queryString_RecRecOrder);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
						echo "<a href=";
						printf("%s?pageNum_RecRecOrder=%d%s", $currentPage, $totalPages_RecRecOrder, $queryString_RecRecOrder);
						echo ">..." .($totalPages_RecRecOrder+1). "</a> | " ;
					}
				}
				else//$morePage_num<=7
				{
						$beforePage_num=9-$morePage_num;
						$beforePage=$pageNum_RecRecOrder-$beforePage_num;
						
						//echo "<br>beforePage_num=".$beforePage_num."<br>";
						//echo "beforePage=".$beforePage."<br>";
						
						echo "<a href=";
						printf("%s?pageNum_RecRecOrder=%d%s", $currentPage, 0, $queryString_RecRecOrder);
						echo ">" . 1 . "...</a> | " ;
							
						for ($i=$beforePage+1; $i<=$totalPages_RecRecOrder+1; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecRecOrder+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecRecOrder=%d%s", $currentPage, $i-1, $queryString_RecRecOrder);
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
        <td><?php if ($pageNum_RecRecOrder < $totalPages_RecRecOrder) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_RecRecOrder=%d%s", $currentPage, min($totalPages_RecRecOrder, $pageNum_RecRecOrder + 1), $queryString_RecRecOrder); ?>">&gt;</a>
            <?php } // Show if not last page ?>
        </td>
        <?php ?>
      </tr>
    </table></td>
    <td width="110" align="right" class="page_display"><?php if ($totalRows_RecRecOrder > 0) { // Show if recordset not empty ?>
        頁數:<?php echo (($pageNum_RecRecOrder+1)."/".($totalPages_RecRecOrder+1)); ?>
  <?php } // Show if recordset not empty ?></td>
    <td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows_RecRecOrder ?> </td>
    <td width="24" align="right">&nbsp;</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="image/spacer.gif" width="1" height="1" /></td>
  </tr>
</table>
<form action="news_process.php" method="post" name="form1" id="form1">
  <?php if ($totalRows_RecRecOrder > 0) { // Show if recordset not empty ?>
    <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
      <tr>
        <td width="105" align="center" class="table_title">訂單編號</td>
        <td width="75" align="center" class="table_title">訂單日期</td>
        <td align="center" class="table_title">客戶</td>
        <td align="center" class="table_title">訂單總額</td>
        <td align="center" class="table_title">付款方式</td>
        <td align="center" class="table_title">銀行匯款狀態</td>
        <td align="center" class="table_title">訂單狀態</td>
        <td align="center" class="table_title">物流方式</td>
        <td align="center" class="table_title">物流狀態</td>
        <td align="center" class="table_title">編輯</td>
        <td align="center" class="table_title">刪除</td>
      </tr>
      <?php
	    $j=0;
	    do {
	?>
      <tr <?php echo (($j%2==0))?"":"bgcolor='#E4E4E4'";?>><td height="25" align="center" class="table_data" ><a href="orders_edit.php?o_id=<?php echo $row_RecOrder['o_id']; ?>"><?php echo $row_RecOrder['o_number']; ?></a></td>
        <td align="center" class="table_data" ><a href="orders_edit.php?o_id=<?php echo $row_RecOrder['o_id']; ?>"><?php echo sortDate($row_RecOrder['datetime'], '-'); ?></a></td>
        <td align="center" class="table_data" ><a href="orders_edit.php?o_id=<?php echo $row_RecOrder['o_id']; ?>"><?php echo $row_RecOrder['client']; ?></a></td>
        <td align="center" class="table_data" ><a href="orders_edit.php?o_id=<?php echo $row_RecOrder['o_id']; ?>"><?php echo $grandTotal = moneyFormat($row_RecOrder['GrandTotal']).' 元'; ?></a></td>
        <td align="center" class="table_data" ><a href="orders_edit.php?o_id=<?php echo $row_RecOrder['o_id']; ?>">
<?php 
$payment = $row_RecOrder['payment'];
if (!(strcmp(1, $payment))) {echo "ATM 虛擬帳戶匯款";}
if (!(strcmp(2, $payment))) {echo "超商店到店";}
?>
</a></td>

<td align="center" class="table_data" >
        <?php
if (!(strcmp(1, $payment))) {
	
	if ($row_RecOrder['remitter_active']==1){
		
		echo "<a href='orders_report_show.php?o_id=".$row_RecOrder['o_id']."' title=\"按我查看回報資訊\"><img src=\"image/accept.png\" width=\"16\" height=\"16\"  >&nbsp;匯款已回報，回報資訊</a>";
		
	}else{
		
		echo "<a href='orders_report.php?o_id=".$row_RecOrder['o_id']."'  title=\"按我回報\"><img src=\"image/delete.png\" width=\"16\" height=\"16\"  >&nbsp;匯款未回報，按我回報</a>";
		
	}
	
}else{
	echo "無";
}
?></td>
        <td align="center"  class="table_data">
        <a href="orders_edit.php?o_id=<?php echo $row_RecOrder['o_id']; ?>">
<?php 
/*		if (!(strcmp(3, $row_RecOrder['payment']))) {
			
				mysql_select_db($database_connect2data, $connect2data);
				$query_RecResponse = "SELECT r_status FROM response_set WHERE r_lidm = '".$row_RecOrder['o_number']."' AND r_o_id = '".$row_RecOrder['o_id']."'";
				$RecResponse = mysql_query($query_RecResponse, $connect2data) or die(mysql_error());
				$row_RecResponse = mysql_fetch_assoc($RecResponse);
				$totalRows_RecResponse = mysql_num_rows($RecResponse);
				if($totalRows_RecResponse>0){
					if( (isset($row_RecResponse['r_status'])) && ($row_RecResponse['r_status']==0) ){
						echo $statusA_1[$row_RecOrder['card_status']];
					}elseif( ($row_RecResponse['r_status']>0) ){
						echo $statusA_1[$row_RecOrder['card_status']];
					}elseif( (($row_RecResponse['r_status']==NULL)||($row_RecResponse['r_status']<0)) ){
						echo $statusA_1[$row_RecOrder['card_status']];
					}
				}else{
					echo "非線上刷卡";
				}
				
			}elseif (!(strcmp(2, $row_RecOrder['payment']))) {
				
				if (!(strcmp(1, $row_RecOrder['cash_status']))){
					echo $statusA_2[$row_RecOrder['cash_status']];
				}else{
					echo $statusA_2[$row_RecOrder['cash_status']];
				}
				
			}elseif (!(strcmp(1, $row_RecOrder['payment']))) { //list使用
			
				if (!(strcmp(1, $row_RecOrder['bank_status'])) && $row_RecOrder['remitter_active']==1){
					echo "<a href='orders_report_show.php?o_id=".$row_RecOrder['o_id']."'><img src=\"image/accept.png\" width=\"16\" height=\"16\"  >&nbsp;".$statusA_2[$row_RecOrder['bank_status']]."，匯款已回報，回報資訊</a>";				
				}else{
					echo "<a href='orders_report.php?o_id=".$row_RecOrder['o_id']."'  title=\"匯款未回報，按我回報\"><img src=\"image/delete.png\" width=\"16\" height=\"16\"  >&nbsp;".$statusA_2[$row_RecOrder['bank_status']]."，匯款未回報，按我回報</a>";
				}
			}
*/				


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

}elseif (!(strcmp(2, $payment))) { //超商店到店
	
	$statusArray = $statusA_2;
	$inputName = 'cash_status';
	$r_status = $row_RecOrder['cash_status'];
	
}elseif (!(strcmp(1, $payment))) { //ATM 虛擬帳戶匯款
	
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
echo $statusArray[$r_status];
	//echo $r_status.'<br>';
?>
</a>
</td>
        <td align="center" class="table_data" ><a href="orders_edit.php?o_id=<?php echo $row_RecOrder['o_id']; ?>"><?php
if($row_RecOrder['transport']==1){
	echo '黑貓宅急便';
}elseif($row_RecOrder['transport']==2){
	echo '超商店到店';
}
?></a></td>
        <td align="center"  class="table_data"><a href="orders_edit.php?o_id=<?php echo $row_RecOrder['o_id']; ?>">
		<?php 
		foreach ($statusB as $i => $value) {
			if (!(strcmp($i, $row_RecOrder['transport_status']))) {echo $statusB[$i];}
		}
		?>
     
        </a></td>
        <td align="center" class="table_data"><a href="orders_edit.php?o_id=<?php echo $row_RecOrder['o_id']; ?>"><img src="image/pencil.png" width="16" height="16" /></a></td>
        <td align="center" class="table_data"><a href="orders_del.php?o_id=<?php echo $row_RecOrder['o_id']; ?>"><img src="image/cross.png" width="16" height="16" /></a></td>
      </tr>
      <?php $j=$j+1; ?>
      <?php } while ($row_RecOrder = mysql_fetch_assoc($RecRecOrder)); ?>
    </table>
    <?php } // Show if recordset not empty ?>
</form>
 <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
  <tr>
    <td align="right" class="page_display">
    <!-------顯示頁選擇與分頁設定開始---------->
    <table border="0">
      <tr>
        <td><?php if ($pageNum_RecRecOrder > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_RecRecOrder=%d%s", $currentPage, max(0, $pageNum_RecRecOrder - 1), $queryString_RecRecOrder); ?>"><</a>
              <?php } // Show if not first page ?>
        </td>
        
        <td>
        <?php
			//echo $totalRows_RecRecOrder;//所有筆數
			//echo $totalPages_RecRecOrder;//最後分頁的頁數,由0開始的陣列
			//echo $pageNum_RecRecOrder;//現在顯示的頁面,由0開始的陣列
			//echo $currentPage;//現在的目錄路徑
			//echo $queryString_RecRecOrder;//以字串顯示所有的筆數,如&totalRows_RecRecOrder=11
			if($totalPages_RecRecOrder<10)
			{
				if($totalRows_RecRecOrder == 0)
				{
					//如果沒有任何資料，不顯示|符號
				}
				else
				{
					echo " | ";
				}
				
				for ($i=1; $i<=$totalPages_RecRecOrder+1; $i++)
				{
				  //如果非正在顯示的分頁則建立頁碼連結
				  if ($i != $pageNum_RecRecOrder+1 )
				  { 
					
					echo "<a href=";
					printf("%s?pageNum_RecRecOrder=%d%s", $currentPage, $i-1, $queryString_RecRecOrder);
					echo ">" . $i . "</a> | " ;
				  }
				  //如果是正在顯示的方頁則單純顯示頁碼
				  else
				  { 
					echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
				  }
				}
			}
			else//$totalPages_RecRecOrder>10
			{
				$morePage_num=$totalPages_RecRecOrder-$pageNum_RecRecOrder;//此頁面之後總共有多少
				if($morePage_num>7)
				{
					if($pageNum_RecRecOrder<3)
					{
						if($totalRows_RecRecOrder == 0)
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
						  if ($i != $pageNum_RecRecOrder+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecRecOrder=%d%s", $currentPage, $i-1, $queryString_RecRecOrder);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
							echo "<a href=";
							printf("%s?pageNum_RecRecOrder=%d%s", $currentPage, $totalPages_RecRecOrder, $queryString_RecRecOrder);
							echo ">..." .($totalPages_RecRecOrder+1). "</a> | " ;
					}
					else//$pageNum_RecRecOrder>=3
					{
						echo "<a href=";
						printf("%s?pageNum_RecRecOrder=%d%s", $currentPage, 0, $queryString_RecRecOrder);
						echo ">" . 1 . "...</a> | " ;
												
						for ($i=$pageNum_RecRecOrder-1; $i<=$pageNum_RecRecOrder+8; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecRecOrder+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecRecOrder=%d%s", $currentPage, $i-1, $queryString_RecRecOrder);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
						echo "<a href=";
						printf("%s?pageNum_RecRecOrder=%d%s", $currentPage, $totalPages_RecRecOrder, $queryString_RecRecOrder);
						echo ">..." .($totalPages_RecRecOrder+1). "</a> | " ;
					}
				}
				else//$morePage_num<=7
				{
						$beforePage_num=9-$morePage_num;
						$beforePage=$pageNum_RecRecOrder-$beforePage_num;
						
						//echo "<br>beforePage_num=".$beforePage_num."<br>";
						//echo "beforePage=".$beforePage."<br>";
						
						echo "<a href=";
						printf("%s?pageNum_RecRecOrder=%d%s", $currentPage, 0, $queryString_RecRecOrder);
						echo ">" . 1 . "...</a> | " ;
							
						for ($i=$beforePage+1; $i<=$totalPages_RecRecOrder+1; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecRecOrder+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecRecOrder=%d%s", $currentPage, $i-1, $queryString_RecRecOrder);
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
        
        <td><?php if ($pageNum_RecRecOrder < $totalPages_RecRecOrder) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_RecRecOrder=%d%s", $currentPage, min($totalPages_RecRecOrder, $pageNum_RecRecOrder + 1), $queryString_RecRecOrder); ?>">></a>
              <?php } // Show if not last page ?>
        </td>
 <?php ?>      
        
        

      </tr>
    </table>
<!-------顯示頁選擇與分頁設定結束---------->
    </td>
    <td width="110" align="right" class="page_display"><?php if ($totalRows_RecRecOrder > 0) { // Show if recordset not empty ?>
        頁數:<?php echo (($pageNum_RecRecOrder+1)."/".($totalPages_RecRecOrder+1)); ?>
  <?php } // Show if recordset not empty ?></td>
    <td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows_RecRecOrder ?> </td>
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
mysql_free_result($RecRecOrder);
?>

<script type="text/javascript">
$(document).ready(function() {
   
   $(".no_board").hover(function(){
		$(this).find('img').attr('src', 'image/go2.gif');
		$(this).css('cursor', 'pointer');
	}, function(){
		$(this).find('img').attr('src', 'image/go1.gif');
	});
});
</script>