<?php require_once('../Connections/connect2data.php'); ?><?php
			if (!isset($_SESSION)) {
               session_start();
               }
            ob_start();
?>
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>出貨單</title>
<link href="css/work_css.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style></head>

<body>
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
?>
      <?php
$colname_RecRecOrder = "-1";
if (isset($_GET['o_id'])) {
  $colname_RecRecOrder = $_GET['o_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecRecOrder = sprintf("SELECT * FROM order_set WHERE o_id = %s", GetSQLValueString($colname_RecRecOrder, "int"));
$RecRecOrder = mysql_query($query_RecRecOrder, $connect2data) or die(mysql_error());
$row_RecOrder = mysql_fetch_assoc($RecRecOrder);
$totalRows_RecRecOrder = mysql_num_rows($RecRecOrder);

$colname_RecOrder_item = "-1";
if (isset($row_RecOrder['o_id'])) {
  $colname_RecOrder_item = $row_RecOrder['o_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecOrder_item = sprintf("SELECT * FROM order_item WHERE o_id = %s ORDER BY oi_id ASC", GetSQLValueString($colname_RecOrder_item, "int"));
$RecOrder_item = mysql_query($query_RecOrder_item, $connect2data) or die(mysql_error());
$row_RecOrder_item = mysql_fetch_assoc($RecOrder_item);
$totalRows_RecOrder_item = mysql_num_rows($RecOrder_item);

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
  <table border="0" align="center" cellpadding="5" cellspacing="1">
    <tr>
      <td width="100%" align="left" class="table_data" >訂單編號：<?php echo $row_RecOrder['o_id']; ?>
          <input name="o_id" type="hidden" id="o_id" value="<?php echo $row_RecOrder['o_id']; ?>" /></td>
    </tr>
  </table>
  <table width="650" border="1" align="center" cellpadding="3" cellspacing="0" bordercolor="#F3F3F3">
    <tr>
      <td colspan="2" align="center" class="table_title">商品名稱</td>
      <td width="182" align="center" class="table_title">產品編號</td>
      <td width="138" align="center" class="table_title">尺寸</td>
      <td width="143" align="center" class="table_title">單價</td>
      <td width="161" align="center" class="table_title">數量</td>
      <td width="152" align="center" class="table_title">金額</td>
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
    
      <td colspan="2" align="center" class="table_data" ><?php echo $row_RecOrder_item['d_name']; ?></td>
      <td align="center" class="table_data" ><?php echo $row_RecOrder_item['serial_num']; ?>&nbsp;</td>
      <td align="center" class="table_data" ><?php echo $row_RecOrder_item['size']; ?>&nbsp;</td>
      <td align="center" class="table_data" ><?php echo $row_RecOrder_item['price']; ?></td>
      <td align="center"  class="table_data"><label><?php echo $row_RecOrder_item['amount']; ?></label></td>
      <td align="center" class="table_data"><?php echo ($row_RecOrder_item['price']*$row_RecOrder_item['amount']); ?>
          <?php $math_total+=$row_RecOrder_item['price']*$row_RecOrder_item['amount']; ?>
      </td>
    </tr>
    <?php } while ($row_RecOrder_item = mysql_fetch_assoc($RecOrder_item)); ?>
    <tr>
      <td align="center" class="table_title" >贈送商品</td>
      <td colspan="5" align="center" bgcolor="#EAEAEA" class="no_data" >&nbsp;</td>
      <td align="center" bgcolor="#EAEAEA" class="table_data" ><?php
			if($row_RecOrder['bread_add']==0 && $row_RecOrder['cake_add']==0){
				echo "無贈送商品";
			}
			if($row_RecOrder['bread_add']!=0){
				echo "<strong>贈送 <span class=\"no_data\">".$row_RecOrder['bread_add']."</span> 包餐包</strong><br>";
			}
			if($row_RecOrder['cake_add']!=0){
				echo "<strong>贈送 <span class=\"no_data\">".$row_RecOrder['cake_add']."</span> 盒北海道濃奶蛋</strong>";
			}
			 ?></td>
    </tr>
    <tr>
      <td width="160" align="center" class="table_title" >小計</td>
      <td colspan="5" align="center" class="table_data" >&nbsp;</td>
      <td align="center" class="table_data"><?php echo $math_total; ?></td>
    </tr>
    <tr>
      <td align="center" class="table_title" >運費</td>
      <td colspan="5" align="center" bgcolor="#EAEAEA" class="table_data" >&nbsp;</td>
      <td align="center" bgcolor="#EAEAEA" class="table_data"><label><?php echo $row_RecOrder['tfee']; ?></label></td>
    </tr>
    <tr>
      <td align="center" class="table_title" >總計</td>
      <td colspan="5" align="center" class="table_data" >&nbsp;</td>
      <td align="center" class="table_data"><?php echo $math_total+$row_RecOrder['tfee']; ?></td>
    </tr>
    <tr>
      <td align="center" class="table_title" >匯款回報</td>
      <td colspan="5" align="center" bgcolor="#EAEAEA" class="table_data" >&nbsp;</td>
      <td align="center" bgcolor="#EAEAEA"  class="table_data"><?php  //list使用
				if($row_RecOrder['remitter_active'])
				{
					echo "&nbsp;已回報";
				}
				else
				{
					echo "&nbsp;未回報";
				}
				
?></td>
    </tr>
    <tr>
      <td align="center" class="table_title" >發票開立方式</td>
      <td colspan="5" align="center" class="table_data" >&nbsp;</td>
      <td align="center"  class="table_data"><?php if (!(strcmp(0, $row_RecOrder['invoice']))) {echo "二聯式";} ?>
          <?php if (!(strcmp(1, $row_RecOrder['invoice']))) {echo "三聯式";} ?>
      </td>
    </tr>
    <tr>
      <td align="center" class="table_title" >買受人統一編號</td>
      <td colspan="5" align="center" bgcolor="#EAEAEA" class="table_data" >&nbsp;</td>
      <td align="center" bgcolor="#EAEAEA"  class="table_data"><?php if ($row_RecOrder['insn']=="") {echo "無指定";}else{echo $row_RecOrder['insn'];} ?></td>
    </tr>
    <tr>
      <td align="center" class="table_title" >買受人名稱</td>
      <td colspan="5" align="right" class="table_data" >&nbsp;</td>
      <td align="center" class="table_data" ><?php if ($row_RecOrder['inname']=="") {echo "無指定";}else{echo $row_RecOrder['inname'];} ?></td>
    </tr>
    <tr>
      <td align="center" class="table_title" >買受人地址</td>
      <td colspan="6" align="right" bgcolor="#EAEAEA" class="table_data" ><?php if ($row_RecOrder['inadd']=="") {echo "無指定";}else{echo $row_RecOrder['inadd'];} ?></td>
    </tr>
    <tr>
      <td align="center" class="table_title" >收貨日</td>
      <td colspan="5" align="center" class="table_data" >&nbsp;</td>
      <td align="center"  class="table_data"><input name="appointed_date" type="hidden" id="appointed_date" value="<?php echo $row_RecOrder['appointed_date']; ?>" />
          <?php if (!(strcmp(1, $row_RecOrder['appointed_date']))) {echo "平日";} ?>
          <?php if (!(strcmp(2, $row_RecOrder['appointed_date']))) {echo "假日";} ?>
          <?php if (!(strcmp(3, $row_RecOrder['appointed_date']))) {echo "不指定";} ?>
      </td>
    </tr>
    <tr>
      <td align="center" class="table_title" >收貨時間</td>
      <td colspan="5" align="center" bgcolor="#EAEAEA" class="table_data" >&nbsp;</td>
      <td align="center" bgcolor="#EAEAEA"  class="table_data"><input name="appointed_time" type="hidden" id="appointed_time" value="<?php echo $row_RecOrder['appointed_time']; ?>" />
          <?php if (!(strcmp(1, $row_RecOrder['appointed_time']))) {echo "08時 ─ 12時";} ?>
          <?php if (!(strcmp(2, $row_RecOrder['appointed_time']))) {echo "12時 ─ 17時";} ?>
          <?php if (!(strcmp(3, $row_RecOrder['appointed_time']))) {echo "17時 ─ 20時";} ?>
      </td>
    </tr>
    <tr>
      <td align="center" class="table_title" >交易方式</td>
      <td colspan="5" align="center" class="table_data" >&nbsp;</td>
      <td align="center"  class="table_data"><label>
      <?php if (!(strcmp(1, $row_RecOrder['method']))) {echo "ATM 轉帳";} ?>
      <?php if (!(strcmp(2, $row_RecOrder['method']))) {echo "超商店到店";} ?>
</label></td>
    </tr>
    <tr>
      <td align="center" class="table_title" >進度</td>
      <td colspan="6" align="right" bgcolor="#EAEAEA" class="table_data" ><label>
      <?php if (!(strcmp(0, $row_RecOrder['status']))) {echo "1.新近未處理";} ?>
      <?php if (!(strcmp(1, $row_RecOrder['status']))) {echo "2.待匯款，未寄出";} ?>
      <?php if (!(strcmp(2, $row_RecOrder['status']))) {echo "2.超商店到店:訂單確認，未收款";} ?>
      <?php if (!(strcmp(3, $row_RecOrder['status']))) {echo "3.匯款:已匯款，未寄出";} ?>
      <?php if (!(strcmp(4, $row_RecOrder['status']))) {echo "3.店取:確認有貨，待取";} ?>
      <?php if (!(strcmp(5, $row_RecOrder['status']))) {echo "3.貨到付:貨物已寄出，未收款";} ?>
      <?php if (!(strcmp(6, $row_RecOrder['status']))) {echo "4.匯款:寄出商品";} ?>
      <?php if (!(strcmp(7, $row_RecOrder['status']))) {echo "4.店取:客戶已結帳，交易結束";} ?>
      <?php if (!(strcmp(8, $row_RecOrder['status']))) {echo "4.貨到付:客戶已收到，未確認收款";} ?>
      <?php if (!(strcmp(9, $row_RecOrder['status']))) {echo "5.匯款:客戶已收到，交易結束";} ?>
      <?php if (!(strcmp(10, $row_RecOrder['status']))) {echo "5.貨到付:已收款，交易結束";} ?>
      </label></td>
    </tr>
</table>
<table border="0" align="center" cellpadding="5" cellspacing="1">
    <tr>
      <td width="100%" align="left" class="table_data">客戶資訊：</td>
    </tr>
  </table>
  <table width="650" border="1" align="center" cellpadding="3" cellspacing="0" bordercolor="#F3F3F3">
    <tr>
      <td width="105" align="center" class="table_title">資訊</td>
      <td width="532" align="center" class="table_title">內容</td>
    </tr>
    <tr>
      <td align="center" class="table_title" >姓名</td>
      <td align="left" class="table_data" ><?php echo $row_RecOrder['client']; ?></td>
    </tr>
    <tr>
      <td align="center" class="table_title" >會員帳號</td>
      <td align="left" bgcolor="#EAEAEA" class="table_data" ><?php echo $row_RecOrder['account']; ?></td>
    </tr>
    <tr>
      <td align="center" class="table_title" >連絡電話</td>
      <td align="left" class="table_data" >電話：<?php echo $row_RecOrder['phone']; ?> 手機：<?php echo $row_RecOrder['cellphone']; ?></td>
    </tr>
    <tr>
      <td align="center" class="table_title" >住址</td>
      <td align="left" bgcolor="#EAEAEA" class="table_data" ><?php echo $row_RecOrder['address']; ?></td>
    </tr>
    <tr>
      <td align="center" class="table_title" >電子郵件</td>
      <td align="left" class="table_data" ><?php echo $row_RecOrder['email']; ?></td>
    </tr>
    <tr>
      <td align="center" class="table_title" >收件者姓名</td>
      <td align="left" bgcolor="#EAEAEA" class="table_data" ><?php echo $row_RecOrder['r_client']; ?></td>
    </tr>
    <tr>
      <td align="center" class="table_title" >收件者連絡電話</td>
      <td align="left" class="table_data" >電話： <?php echo $row_RecOrder['r_phone']; ?> 手機：<?php echo $row_RecOrder['r_cellphone']; ?></td>
    </tr>
    <tr>
      <td align="center" class="table_title" >收件者住址</td>
      <td align="left" bgcolor="#EAEAEA" class="table_data" ><?php echo $row_RecOrder['r_address']; ?></td>
    </tr>
    <tr>
      <td align="center" class="table_title" >收件者電子郵件</td>
      <td align="left" class="table_data" ><?php echo $row_RecOrder['r_email']; ?></td>
    </tr>
    <tr>
      <td align="center" bgcolor="#EAEAEA" class="table_title" >備註</td>
      <td align="left" valign="middle" class="table_data" ><?php echo $row_RecOrder['notation']; ?></td>
    </tr>
</table>

</body>
</html>
<?php
mysql_free_result($RecRecOrder);

mysql_free_result($RecOrder_item);

mysql_free_result($RecMember);
?>