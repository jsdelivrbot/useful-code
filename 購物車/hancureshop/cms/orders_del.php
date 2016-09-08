<?php require_once('../Connections/connect2data.php'); ?>
<?php
			if (!isset($_SESSION)) {
               session_start();
               }
            ob_start();
?>
<?php require_once('../orders_statusA.php'); ?>
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

if(!in_array(7,$_SESSION['MM_Limit']['a6'])){
	header("Location: orders_list.php");
}

$_SESSION['REFERER'] = $_SERVER['REQUEST_URI'];

if ((isset($_GET['o_id'])) && ($_GET['o_id'] != "") && (isset($_POST['delsure'])) && $_POST['delsure']==1) {
  $deleteSQL = sprintf("DELETE FROM order_set WHERE o_id=%s",
                       GetSQLValueString($_GET['o_id'], "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());
  
  $deleteSQL = sprintf("DELETE FROM order_item WHERE o_id=%s",
                       GetSQLValueString($_GET['o_id'], "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());
  
  $deleteSQL = sprintf("DELETE FROM  response_set WHERE r_o_id=%s",
                       GetSQLValueString($_GET['o_id'], "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());

  $deleteGoTo = "orders_list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}
?>

<?php $editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}



$menu_is="orders";
require_once('../js/fun_moneyFormat.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php require_once('cmsTitle.php'); ?></title>
<?php require_once('script.php'); ?>
<!-- InstanceBeginEditable name="doctitle" -->
<title>無標題文件</title>

<!--edit.php刪除資料的javascript  begin-->
<script type="text/JavaScript">
<!--
function ifDelete(orders_id,id){
	
			if(confirm("你確定要刪除這個產品?")){
			location.href="orders_process.php?orders_id="+orders_id+"&id="+id;
			}
			else{
			}
		
			}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
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
//-->
</script>
<!-- //edit.php刪除資料的javascript   end-->

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

$colname_RecOrder = "-1";
if (isset($_GET['o_id'])) {
  $colname_RecOrder = $_GET['o_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecOrder = sprintf("SELECT * FROM order_set WHERE o_id = %s", GetSQLValueString($colname_RecOrder, "int"));
$RecOrder = mysql_query($query_RecOrder, $connect2data) or die(mysql_error());
$row_RecOrder = mysql_fetch_assoc($RecOrder);
$totalRows_RecOrder = mysql_num_rows($RecOrder);

$colname_RecOrderItem = "-1";
if (isset($row_RecOrder['o_id'])) {
  $colname_RecOrderItem = $row_RecOrder['o_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecOrderItem = sprintf("SELECT * FROM order_item WHERE o_id = %s ORDER BY oi_id ASC", GetSQLValueString($colname_RecOrderItem, "int"));
$RecOrderItem = mysql_query($query_RecOrderItem, $connect2data) or die(mysql_error());
$row_RecOrderItem = mysql_fetch_assoc($RecOrderItem);
$totalRows_RecOrderItem = mysql_num_rows($RecOrderItem);

$colname_RecMember = "-1";
if (isset($row_RecOrder['m_id'])) {
  $colname_RecMember = $row_RecOrder['m_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecMember = sprintf("SELECT * FROM member_set WHERE m_id = %s", GetSQLValueString($colname_RecMember, "int"));
$RecMember = mysql_query($query_RecMember, $connect2data) or die(mysql_error());
$row_RecMember = mysql_fetch_assoc($RecMember);
$totalRows_RecMember = mysql_num_rows($RecMember);
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="183" class="list_title" border="0" cellpadding="5" cellspacing="1">刪除訂單</td>
          <td width="617"><span class="no_data">確定刪除以下訂單資料?</span></td>
        </tr>
      </table>
  <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
  <tr>
    <td width="628" align="right" class="page_display">
    </td>
    <td width="78" align="right" class="page_display">&nbsp;</td>
    <td width="62" align="right" class="page_display">&nbsp;</td>
    <td width="32" align="right">&nbsp;</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="image/spacer.gif" width="1" height="1" /></td>
  </tr>
</table>
<form action="<?php echo $editFormAction; ?>" method="POST" name="form1" id="form1">
  
  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
  <tr>
    <td width="25%" height="20" align="center" class="table_title" >訂單日期</td>
    <td align="left" class="table_data" ><?php echo $row_RecOrder['datetime']; ?></td>
    <td width="158" align="center" class="table_data" ><input name="o_id" type="hidden" id="o_id" value="<?php echo $row_RecOrder['o_id']; ?>" />
      <?php if(0){ ?><input name="button3" type="button" class="button_set" id="button3" value="列印出貨單" onclick="window.open('orders_exportation.php?o_id=<?php echo $row_RecOrder['o_id']; ?>')"/><?php } ?></td>
  <tr>
    <td align="center" class="table_title" >訂單編號</td>
    <td align="left" class="table_data" bgcolor="#EAEAEA"><?php echo $row_RecOrder['o_number']; ?></td>
    <td align="left" class="table_data" bgcolor="#EAEAEA">&nbsp;</td>
  </table>
  <table width="100%" border="0" cellpadding="5" cellspacing="1">
  <td width="100%" align="left" class="order_title">商品清單：</td>
  </table>
  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
    <tr>
      <td colspan="2" align="center" class="table_title">商品名稱</td>
      <td align="center" class="table_title">售價</td>
      <td align="center" class="table_title">數量</td>
      <td align="center" class="table_title">小計</td>
    </tr>
    <?php
	$math_total=0; 
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
            <td colspan="2" align="center" class="table_data" ><?php echo $row_RecOrderItem['d_name']; ?></td>
            
            <td align="center" class="table_data" ><?php echo moneyFormat(round( $row_RecOrderItem['d_price1']));?>元</td>
            
            <td align="center"  class="table_data"><?php echo $row_RecOrderItem['qty']; ?></td>
            <td align="center" class="table_data">
<?php 
$subTotal = moneyFormat($row_RecOrderItem['subtotal']);
echo $subTotal;
?>元</td>
          </tr>
<?php } while ($row_RecOrderItem = mysql_fetch_assoc($RecOrderItem)); ?>
         
  </table>
  
  
  <table width="100%" border="0" cellpadding="5" cellspacing="1">
  <td width="100%" align="left" class="order_title">訂單資訊：</td>
  </table>
  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
    <tr>
      <td width="25%" align="center" class="table_title">資訊</td>
      <td align="center" class="table_title">內容</td>
    </tr> 
          <?php 
		  $tdBg = 'bgcolor="#EAEAEA"';  
		  ?>
    <tr>
  	<td width="25%" align="center" class="table_title">小計</td>
    <td class="table_data"><?php echo $TotalAll = moneyFormat($row_RecOrder['SubTotalAll']).' 元'; ?></td>
  </tr>
  <tr <?php echo $tdBg;?>>
  	<td align="center" class="table_title" >運費</td>
    <td class="table_data">
      <?php 
if( $row_RecOrder['tfee'] == 0 ){
	$fr = '免運費';	
}else{
	$fr = moneyFormat($row_RecOrder['tfee']).' 元';
}
echo $fr;
?>
</td>
  </tr>
  
  <tr>
  	<td align="center" class="table_title" >總計</td>
    <td class="table_data"><?php echo $grandTotal = moneyFormat($row_RecOrder['GrandTotal']).' 元'; ?></td>
  </tr>
  <tr <?php echo $tdBg;?>>
    <td align="center" class="table_title" >付款方式</td>
    <td class="table_data">
      <?php $payment = $row_RecOrder['payment'];?>
      <?php if (!(strcmp(1, $payment))) {echo "銀行轉帳";} ?>
      <?php if (!(strcmp(2, $payment))) {echo "貨到付款";} ?>
      <?php if (!(strcmp(3, $payment))) {echo "線上刷卡";} ?>    
      </td>
  </tr>
  <tr>
  	<td align="center" class="table_title" >付款狀態</td>
    <td class="table_data">
    
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
				//echo $statusA[3];
				$r_status = 1;
			}elseif( ($row_RecResponse['r_status']>0) ){
				//echo $statusA[2];
				$r_status = 0;
			}elseif( (($row_RecResponse['r_status']==NULL)||($row_RecResponse['r_status']<0)) ){
				//echo $statusA[4];
				$r_status = 2;
				/*echo 'card_status ='.$row_RecOrder['card_status'].'<br>';
				if($row_RecOrder['card_status']==2){
					$r_status = 2;
				}elseif($row_RecOrder['card_status']==3){
					$r_status = 3;
				}*/
			}
		}
	}else{
		$r_status = 3;
	}
	
	//echo 'selected ='.$r_status.'<br>';
	//echo 'r_status ='.$row_RecResponse['r_status'];

}elseif (!(strcmp(2, $payment))) { //貨到付款
	
	$statusArray = $statusA_2;
	$inputName = 'cash_status';
	$r_status = $row_RecOrder['cash_status'];
	
}elseif (!(strcmp(1, $payment))) { //銀行轉帳
	
	$statusArray = $statusA_2;
	$inputName = 'bank_status';
	
	if($row_RecOrder['bank_status']!=2){
		if($row_RecOrder['remitter_active']==1){
			$r_status = 1;
		}else{
			$r_status = 0;
		}
	}else{
		$r_status = 2;
	}
}
?>
<?php
echo $statusArray[$r_status];
?>

      
    </td>
    </tr>
    <?php if (!(strcmp(1, $payment))) { ?>
    <tr <?php echo $tdBg;?>>
    <td align="center" class="table_title" >匯款回報</td>
    <td  class="table_data">
	<?php if (!(strcmp(3, $row_RecOrder['payment']))) {
				echo "無";
			}elseif (!(strcmp(2, $row_RecOrder['payment']))) {
				echo "無";
			}elseif (!(strcmp(1, $row_RecOrder['payment']))) { //list使用
				if($row_RecOrder['remitter_active'])
				{
					//echo "<a href='orders_report_show.php?o_id=".$row_RecOrder['o_id']."'><img src=\"image/accept.png\" width=\"16\" height=\"16\"  >&nbsp;匯款已回報，回報資訊</a>";
					echo "<p>匯款帳戶名:".$row_RecOrder['remitter']."<br>";
					echo "匯款帳號後五碼:".$row_RecOrder['remitter_AC']."<br>";
					echo "匯款金額:".$row_RecOrder['remitter_money']."<br>";
					echo "匯款時間:".$row_RecOrder['remitter_time']."</p>";
				}
				else
				{
					echo "<a href='orders_report.php?o_id=".$row_RecOrder['o_id']."'  title=\"匯款未回報，按我回報\"><img src=\"image/delete.png\" width=\"16\" height=\"16\"  >&nbsp;匯款未回報，按我回報</a>";
				}
			}
				
?></td>
  </tr>
  <?php } ?>
  <tr <?php echo (!(strcmp(1, $payment)))?'':$tdBg;?>>
  	<td align="center" class="table_title" >物流狀態</td>
    <td class="table_data"><?php echo $statusB[$row_RecOrder['transport_status']]; ?></td>
    </tr>  
  </table>
  
  <?php if(0){?>
  <table width="100%" border="0" cellpadding="5" cellspacing="1">
  <td width="100%" align="left" class="order_title">發票資訊：</td>
  </table>
  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
    <tr>
      <td width="25%" align="center" class="table_title">資訊</td>
      <td align="center" class="table_title">內容</td>
    </tr>  
  <tr>
    <td align="center" class="table_title" >發票開立方式</td>
    <td colspan="7" class="table_data" >
      <?php if (!(strcmp(0, $row_RecOrder['invoice']))) {echo "二聯式";} ?>
      <?php if (!(strcmp(1, $row_RecOrder['invoice']))) {echo "三聯式";} ?>
     </td>
    </tr>
  <?php if (!(strcmp(1, $row_RecOrder['invoice']))) {?>
  <tr>
    <td align="center" class="table_title" >買受人統一編號</td>
    <td colspan="7" class="table_data" bgcolor="#EAEAEA"><?php if ($row_RecOrder['insn']=="") {echo "無指定";}else{echo $row_RecOrder['insn'];} ?></td>
    </tr>
  <tr>
    <td align="center" class="table_title" >買受人名稱</td>
    <td colspan="7" class="table_data" ><?php if ($row_RecOrder['inname']=="") {echo "無指定";}else{echo $row_RecOrder['inname'];} ?></td>
    </tr>
  <tr>
    <td align="center" class="table_title" >買受人地址</td>
    <td colspan="7" bgcolor="#EAEAEA" class="table_data">
	<?php 
	if (!(strcmp(1, $row_RecOrder['invoice']))) {
		echo $row_RecOrder['inadd'];
	}else{
		echo "無指定";
	}
	?>
    </td>
  </tr>
  <?php } ?>
 </table>
 <?php } ?>
 
  
  <table width="100%" border="0" cellpadding="5" cellspacing="1">
  <td width="100%" align="left" class="order_title">客戶資訊：</td>
  </table>
  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
    <tr>
      <td width="25%" align="center" class="table_title">資訊</td>
      <td align="center" class="table_title">內容</td>
      </tr>
 	<tr>
  	<td align="center" class="table_title" >訂購人姓名</td>
    <td align="left" class="table_data" ><?php echo $row_RecOrder['client']; ?></td>
    </tr>
    <tr>
  	<td align="center" class="table_title" >會員帳號</td>
    <td align="left" bgcolor="#EAEAEA" class="table_data" ><?php echo ($row_RecOrder['m_account']!='') ? $row_RecOrder['m_account'] : '非會員' ; ?></td>
    </tr>
    <tr>
  	<td align="center" class="table_title" >訂購人聯絡電話</td>
    <td align="left" class="table_data" ><?php echo $row_RecOrder['cellphone']; ?></td>
    </tr>
    <tr>
      <td align="center" class="table_title" >訂購人地址</td>
  	<td align="left" bgcolor="#EAEAEA" class="table_data" ><?php echo $row_RecOrder['address']; ?></td>
    </tr>
    <tr>
      <td align="center" class="table_title" >訂購人 EMAIL</td>
  	<td align="left" class="table_data" ><?php echo $row_RecOrder['email']; ?></td>
    </tr>
    <tr>
      <td align="center" class="table_title" >收件人姓名</td>
  	<td align="left" bgcolor="#EAEAEA" class="table_data" ><?php echo $row_RecOrder['r_client']; ?></td>
    </tr>
    <tr>
      <td align="center" class="table_title" >收件人聯絡電話</td>
  	<td align="left" class="table_data" ><?php echo $row_RecOrder['r_cellphone']; ?></td>
    </tr>
    <tr>
      <td align="center" class="table_title" >收件地址</td>
  	<td align="left" class="table_data" bgcolor="#EAEAEA" ><?php echo $row_RecOrder['r_address']; ?></td>
    </tr>
    <tr>
      <td align="center" class="table_title" >收件人EMAIL</td>
  	<td align="left" class="table_data" ><?php echo $row_RecOrder['r_email']; ?></td>
    </tr>
    <tr>
      <td align="center" bgcolor="#EAEAEA" class="table_title" >備註</td>
  	<td align="left" bgcolor="#EAEAEA" class="table_data" ><?php echo ($row_RecOrder['notation']!='')? nl2br($row_RecOrder['notation']):'無'; ?></td>
    </tr>
    <tr>    
      <td colspan="2" align="center" ><input name="submitBtn" type="submit" class="btnType" id="submitBtn" value="送出" /></td>
    </tr>
  </table>
  <input name="delsure" type="hidden" id="delsure" value="1" />
</form>
 <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
  <tr>
    <td width="628" align="right" class="page_display">
    </td>
    <td width="78" align="right" class="page_display">&nbsp;</td>
    <td width="62" align="right" class="page_display">&nbsp;</td>
    <td width="32" align="right">&nbsp;</td>
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

mysql_free_result($RecOrderItem);
?>
