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

<?php $editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {

////寄送MAIL開始//////
if($_POST["sendMail"]==1){

// 取得顧戶資訊
$colname = "-1";
if (isset($_POST['o_id'])) {
  $colname = $_POST['o_id'];
}
  mysql_select_db($database_connect2data, $connect2data);
  $query_RecGetOrder = sprintf("SELECT * FROM order_set WHERE o_id = %s", GetSQLValueString($colname, "int"));
  $RecGetOrder = mysql_query($query_RecGetOrder,$connect2data) or die(mysql_error());
  $row_RecGetOrder = mysql_fetch_assoc($RecGetOrder);
  $totalRows_RecGetOrder = mysql_num_rows($RecGetOrder);
////
require_once('../phpmailer/class.phpmailer.php');
$phpmailer = new PHPMailer();
$phpmailer->IsSMTP(); // telling the class to use SMTP
$phpmailer->ContentType="text/html";
$phpmailer->CharSet="utf-8";
$phpmailer->SMTPAuth=true;
$phpmailer->From="k54789090@yahoo.com.tw";
$phpmailer->FromName="巴特里精緻烘培線上購物備註通知";
$phpmailer->AddAddress($row_RecGetOrder['email']);

$phpmailer->IsHTML(true);
$phpmailer->Subject="巴特里精緻烘培線上購物備註通知";
$mailBody=$row_RecGetOrder['client']."您好！<br>"
				."下列資訊為巴特里精緻烘培線上購物備註說明，<br>"
				."訂單編號：".$row_RecGetOrder['o_id']."<br>"
				."訂購日期：".substr($row_RecGetOrder['datetime'],0,10)."<br><br>"				
				."================================================================="."<br>"
				."備註說明：".$_POST['notation']."<br>"
				."================================================================="."<br><br>"
				."服務mail: k54789090@yahoo.com.tw <br>"
				."若您有任何問題，請洽客服中心"
;
$phpmailer->Body=$mailBody;
$phpmailer->Send();

}
////寄送MAIL結束//////

  $updateSQL = sprintf("UPDATE order_set SET status=%s, method=%s, notation=%s WHERE o_id=%s",
                       GetSQLValueString($_POST['status'], "text"),
                       GetSQLValueString($_POST['method'], "text"),
                       GetSQLValueString($_POST['notation'], "text"),
                       GetSQLValueString($_POST['o_id'], "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());

  $updateGoTo = "orders_list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$menu_is="orders";?>
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
function submitF(){	
	document.all.form1.sendMail.value = 1;
	//alert(document.all.form1.sendMail.value);
	if(confirm("你確定要寄發備註給顧戶?")){
		//alert(document.all.form1.sendMail.value);
		document.all.form1.submit(); 
	}
	
}

function addField() {
		var pTable=document.getElementById('pTable');
		var lastRow = pTable.rows.length;
		//alert(pTable.rows.length);
		var myField=document.getElementById('product'+lastRow);
		//alert('image'+lastRow);
		if(myField.value){
			var aTr=pTable.insertRow(lastRow);
			var newRow = lastRow+1;
			var newImg='img'+(newRow);
			var aTd1=aTr.insertCell(0);
			//aTd1.innerHTML = '<span class="table_data">選擇圖片： </span><input name="product[]" type="file" class="table_data" id="image'+newRow+'"><br><span class="table_data">圖片說明： </span><input name="image_title[]" type="text" class="table_data" id="image_title'+newRow+'">';
			aTd1.innerHTML = '<td width="272"><select name="product[]" id="product'+newRow+'"><option value="aaaaaaaaa">aaaaaaaaa</option></select></td><td width="138" align="center">&nbsp;</td><td width="121" align="center">&nbsp;</td><td width="136" align="center"><input name="price'+newRow+'" type="text" id="price1" size="10" /></td><td width="141" align="center"><input name="amount'+newRow+'" type="text" id="amount1" size="10" /></td><td width="204" align="center">&nbsp;</td>';
		}else{
			alert("尚有未選取之圖片欄位!!");
		}
	    }
		
function reNew(index){
	
	//for(var i=0;i<select_value[index].length;i++){
		
		//document.form1.price.options[i]=new Option(select_text[index][i], select_value[index][i]);	// 設定新選項
		//alert(select_value[index][0]);
		document.form1.price.value = select_value[index][0];
		//alert(document.form1.price.value);
		//}
	//document.form1.price.length=select_value[index].length;	// 刪除多餘的選項
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
<body onload="MM_preloadImages('image/submit_btn_over_01.png')">
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
$colname_RecOrder_set = "-1";
if (isset($_GET['o_id'])) {
  $colname_RecOrder_set = $_GET['o_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecOrder_set = sprintf("SELECT * FROM order_set WHERE o_id = %s", GetSQLValueString($colname_RecOrder_set, "int"));
$RecOrder_set = mysql_query($query_RecOrder_set, $connect2data) or die(mysql_error());
$row_RecOrder_set = mysql_fetch_assoc($RecOrder_set);
$totalRows_RecOrder_set = mysql_num_rows($RecOrder_set);

$colname_RecOrder_item = "-1";
if (isset($row_RecOrder_set['o_id'])) {
  $colname_RecOrder_item = $row_RecOrder_set['o_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecOrder_item = sprintf("SELECT * FROM order_item WHERE o_id = %s ORDER BY oi_id ASC", GetSQLValueString($colname_RecOrder_item, "int"));
$RecOrder_item = mysql_query($query_RecOrder_item, $connect2data) or die(mysql_error());
$row_RecOrder_item = mysql_fetch_assoc($RecOrder_item);
$totalRows_RecOrder_item = mysql_num_rows($RecOrder_item);

$colname_RecMember = "-1";
if (isset($_GET['m_id'])) {
  $colname_RecMember = $_GET['m_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecMember = sprintf("SELECT * FROM member_set WHERE m_id = %s", GetSQLValueString($colname_RecMember, "int"));
$RecMember = mysql_query($query_RecMember, $connect2data) or die(mysql_error());
$row_RecMember = mysql_fetch_assoc($RecMember);
$totalRows_RecMember = mysql_num_rows($RecMember);

mysql_select_db($database_connect2data, $connect2data);
$query_RecProduct = "SELECT * FROM data_set WHERE d_class1 = 'product' ORDER BY d_id ASC";
$RecProduct = mysql_query($query_RecProduct, $connect2data) or die(mysql_error());
$row_RecProduct = mysql_fetch_assoc($RecProduct);
$totalRows_RecProduct = mysql_num_rows($RecProduct);
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="87" class="list_title" border="0" cellpadding="5" cellspacing="1">新增訂單</td>
          <td width="713">&nbsp;</td>
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
  <table border="0" align="center" cellpadding="5" cellspacing="1">
  <td width="100%" align="left" class="table_data" >訂單編號：<?php echo $row_RecOrder_set['o_id']; ?>
    <input name="o_id" type="hidden" id="o_id" value="<?php echo $row_RecOrder_set['o_id']; ?>" /></td>
  </table>
  <table width="100%" border="0" cellpadding="5" cellspacing="1">
    <tr align="center">
      <td width="34%" class="table_title">商品名稱</td>
      <td width="30%" class="table_title">單價</td>
      <td width="18%" class="table_title">數量</td>
      <td width="18%" class="table_title">金額</td>
    </tr>
    <tr align="center">
      <td colspan="4"><table width="100%" border="0" cellpadding="0" cellspacing="0" id="pTable">
        <tr align="center">
          <td width="34%"><select name="product[]" id="product1" onChange="reNew(this.selectedIndex);"><!--主分類更動要呼叫javascript//-->
                      <script type="text/javascript">
                      <!--//儲存次分類資料的陣列
					   var select_text=new Array();
					   var select_value=new Array();
					  //-->
					  </script>
              <?php
			   $row_num=0;//***重要要加，不然有bug
			   do { 
			   ?>
              <option value="<?php echo $row_RecProduct['d_id']; ?>"><?php echo $row_RecProduct['d_title']; ?></option>
              
              <?php 
						 //次分類儲存於陣列begin---
						 
						 mysql_select_db($database_connect2data, $connect2data);						 
						 $query_RecProduct_extra = "SELECT * FROM product_extra WHERE match_id = ".$row_RecProduct['d_id'];
						 $RecProduct_extra = mysql_query($query_RecProduct_extra, $connect2data) or die(mysql_error());
						 $row_RecProduct_extra = mysql_fetch_assoc($RecProduct_extra);
						 $totalRows_RecProduct_extra = mysql_num_rows($RecProduct_extra);
						 
						 echo "<script type=\"text/javascript\">";
						 echo "<!--\n";
						 echo "select_value[".$row_num."]=[";
						 $col_num=0;
						 do{
						 $select_value[$row_num][$col_num]=$row_RecProduct_extra['price_L'];
						 $select_text[$row_num][$col_num]=$row_RecProduct_extra['price_L'];
						 echo $row_RecProduct_extra['price_L'].",";
						 $col_num++;
						 } while ($row_RecProduct_extra = mysql_fetch_assoc($RecProduct_extra));
												 
						 echo "];";
						 echo "\n//-->\n";
						 echo "</script>";
						 
						 $rows = mysql_num_rows($RecProduct_extra);
						 if($rows > 0) {
      					 mysql_data_seek($RecProduct_extra, 0);//將讀取的指標放回到第一筆
	  					 $row_RecProduct_extra = mysql_fetch_assoc($RecProduct_extra);
                         }
						 		 
						 echo "<script type=\"text/javascript\">";
						 echo "<!--\n";
						 echo "select_text[".$row_num."]=[\"";
						 $col_num=0;
						 do{
						 echo $row_RecProduct_extra['price_L']."\",\"";
						 $col_num++;
						 } while ($row_RecProduct_extra = mysql_fetch_assoc($RecProduct_extra));
												 
						 echo "\"];";
						 echo "\n//-->\n";
						 echo "</script>";
						 
						 $row_num++;
						 //次分類儲存於陣列end---
						?>
          	    	    <?php
						} while ($row_RecProduct = mysql_fetch_assoc($RecProduct));
  						$rows = mysql_num_rows($RecProduct);
 						if($rows > 0) {
      					mysql_data_seek($RecProduct, 0);
	  					$row_RecProduct = mysql_fetch_assoc($RecProduct);
 						}
						?>
          </select></td>
          <td width="30%" align="center">
          <label>
          	    	
          	    	  <?php
						//do {  
						?>
          	    	   <input name="price[]" type="text" id="price" value="<?php echo $row_RecProduct_extra['price_L']; ?>" size="10" />
          	    	  <?php
						/*} while ($row_RecProduct_extra = mysql_fetch_assoc($RecProduct_extra));
  						$rows = mysql_num_rows($RecProduct_extra);
 						if($rows > 0) {
     					mysql_data_seek($RecProduct_extra, 0);
	  					$row_RecProduct_extra = mysql_fetch_assoc($RecProduct_extra);
						}*/
					  ?>
          	    	</label>
          </td>
          <td width="18%" align="center"><input name="amount[]" type="text" id="amount1" size="10" /></td>
          <td width="18%" align="center"><span class="table_data"><?php echo ($row_RecOrder_item['price']*$row_RecOrder_item['amount']); ?></span></td>
        </tr>
      </table></td>
      </tr>
    <tr align="center">
      <td align="left"><table border="0" cellspacing="1" cellpadding="1">
        <tr>
          <td><a href="javascript:addField()"><img src="image/add.png" width="16" height="16" border="0" /></a></td>
          <td><a href="javascript:addField()" class="table_data">增加圖片</a></td>
          <td class="red_letter">&nbsp;</td>
        </tr>
      </table></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
    
          <tr>
            <td align="center" class="table_title" >贈送商品</td>
            <td width="534" colspan="3" align="center" bgcolor="#EAEAEA" class="no_data" >&nbsp;</td>
            <td width="177" align="center" bgcolor="#EAEAEA" class="table_data" ><?php
			if($row_RecOrder_set['bread_add']==0 && $row_RecOrder_set['cake_add']==0){
				echo "無贈送商品";
			}
			if($row_RecOrder_set['bread_add']!=0){
				echo "<strong>贈送 <span class=\"no_data\">".$row_RecOrder_set['bread_add']."</span> 包餐包</strong><br>";
			}
			if($row_RecOrder_set['cake_add']!=0){
				echo "<strong>贈送 <span class=\"no_data\">".$row_RecOrder_set['cake_add']."</span> 盒北海道濃奶蛋</strong>";
			}
			 ?></td>
          </tr>
          <tr>
  	<td width="168" align="center" class="table_title" >小計</td>
    <td colspan="3" align="center" class="table_data" >&nbsp;</td>
    <td align="center" class="table_data"><?php echo $math_total; ?></td>
  </tr>
  <tr>
  	<td align="center" class="table_title" >運費</td>
    <td colspan="3" align="center" bgcolor="#EAEAEA" class="table_data" >&nbsp;</td>
    <td align="center" bgcolor="#EAEAEA" class="table_data">
      <label><?php echo $row_RecOrder_set['tfee']; ?></label></td>
  </tr>
  <tr>
  	<td align="center" class="table_title" >總計</td>
    <td colspan="3" align="center" class="table_data" >&nbsp;</td>
    <td align="center" class="table_data"><?php echo $math_total+$row_RecOrder_set['tfee']; ?></td>
  </tr>
  <tr>
    <td align="center" class="table_title" >匯款回報</td>
    <td colspan="3" align="center" bgcolor="#EAEAEA" class="table_data" >&nbsp;</td>
    <td align="center" bgcolor="#EAEAEA"  class="table_data"><?php  //list使用
				if($row_RecOrder_set['remitter_active'])
				{
					echo "<a href='orders_report_show.php?o_id=".$row_RecOrder_set['o_id']."'><img src=\"image/accept.png\" width=\"16\" height=\"16\"  >&nbsp;已回報，回報資訊</a>";
				}
				else
				{
					echo "<a href='orders_report.php?o_id=".$row_RecOrder_set['o_id']."'><img src=\"image/delete.png\" width=\"16\" height=\"16\"  >&nbsp;未回報，按我回報</a>";
				}
				
?></td>
  </tr>
  <tr>
  	<td align="center" class="table_title" >交易方式</td>
    <td colspan="3" align="center" class="table_data" >&nbsp;</td>
    <td align="center"  class="table_data"><label>
      <select name="method" id="method">
        <option value="1" <?php if (!(strcmp(1, $row_RecOrder_set['method']))) {echo "selected=\"selected\"";} ?>>ATM 轉帳</option>
        <option value="2" <?php if (!(strcmp(2, $row_RecOrder_set['method']))) {echo "selected=\"selected\"";} ?>>超商店到店</option>
      </select>
    </label></td>
  </tr>
  <tr>
  	<td align="center" class="table_title" >進度</td>
    <td colspan="4" align="right" bgcolor="#EAEAEA" class="table_data" ><select name="status" id="status">
      <option value="0" <?php if (!(strcmp(0, $row_RecOrder_set['status']))) {echo "selected=\"selected\"";} ?>>1.新近未處理</option>
      <option value="1" <?php if (!(strcmp(1, $row_RecOrder_set['status']))) {echo "selected=\"selected\"";} ?>>2.待匯款，未寄出</option>
      <option value="2" <?php if (!(strcmp(2, $row_RecOrder_set['status']))) {echo "selected=\"selected\"";} ?>>2.超商店到店:訂單確認，未收款</option>
      <option value="3" <?php if (!(strcmp(3, $row_RecOrder_set['status']))) {echo "selected=\"selected\"";} ?>>3.匯款:已匯款，未寄出</option>
      <option value="4" <?php if (!(strcmp(4, $row_RecOrder_set['status']))) {echo "selected=\"selected\"";} ?>>3.店取:確認有貨，待取</option>
      <option value="5" <?php if (!(strcmp(5, $row_RecOrder_set['status']))) {echo "selected=\"selected\"";} ?>>3.貨到付:貨物已寄出，未收款</option>
      <option value="6" <?php if (!(strcmp(6, $row_RecOrder_set['status']))) {echo "selected=\"selected\"";} ?>>4.匯款:寄出商品</option>
      <option value="7" <?php if (!(strcmp(7, $row_RecOrder_set['status']))) {echo "selected=\"selected\"";} ?>>4.店取:客戶已結帳，交易結束</option>
      <option value="8" <?php if (!(strcmp(8, $row_RecOrder_set['status']))) {echo "selected=\"selected\"";} ?>>4.貨到付:客戶已收到，未確認收款</option>
      <option value="9" <?php if (!(strcmp(9, $row_RecOrder_set['status']))) {echo "selected=\"selected\"";} ?>>5.匯款:客戶已收到，交易結束</option>
      <option value="10" <?php if (!(strcmp(10, $row_RecOrder_set['status']))) {echo "selected=\"selected\"";} ?>>5.貨到付:已收款，交易結束</option>
    </select>
      <label></label></td>
    </tr>  
  </table>
  <table border="0" align="center" cellpadding="5" cellspacing="1">
  <td width="100%" align="left" class="table_data">客戶資訊：</td>
  </table>
  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
    <tr>
      <td width="156" align="center" class="table_title">資訊</td>
      <td width="621" align="center" class="table_title">內容</td>
      </tr>
 	<tr>
  	<td align="center" class="table_title" >姓名</td>
    <td align="left" class="table_data" ><input name="client" type="text" class="input_data" id="client" value="<?php echo $row_RecMember['m_name']; ?>" size="50" /></td>
    </tr>
    <tr>
  	<td align="center" class="table_title" >會員帳號</td>
    <td align="left" bgcolor="#EAEAEA" class="table_data" ><input name="account" type="text" class="input_data" id="account" value="<?php echo $row_RecMember['m_account']; ?>" size="50" /></td>
    </tr>
    <tr>
  	<td align="center" class="table_title" >連絡室內電話</td>
    <td align="left" class="table_data" ><input name="phone" type="text" class="input_data" id="phone" value="<?php echo $row_RecMember['m_phone']; ?>" size="50" /></td>
    </tr>
    <tr>
      <td align="center" class="table_title" >連絡手機</td>
      <td align="left" bgcolor="#EAEAEA" class="table_data" ><input name="cellphone" type="text" class="input_data" id="cellphone" value="<?php echo $row_RecMember['m_cellphone']; ?>" size="50" /></td>
    </tr>
    <tr>
  	<td align="center" class="table_title" >住址</td>
    <td align="left" class="table_data" ><input name="address" type="text" class="input_data" id="address" value="<?php echo $row_RecMember['m_zip']." ".$row_RecMember['m_city'].$row_RecMember['m_canton'].$row_RecMember['m_address']; ?>" size="60" /></td>
    </tr>
    <tr>
  	<td align="center" class="table_title" >電子郵件</td>
    <td align="left" bgcolor="#EAEAEA" class="table_data" ><input name="email" type="text" class="input_data" id="email" value="<?php echo $row_RecMember['m_email']; ?>" size="60" /></td>
    </tr>
    <tr>
  	<td align="center" class="table_title" >收件者姓名</td>
    <td align="left" class="table_data" ><input name="r_client" type="text" class="input_data" id="r_client" size="50" /></td>
    </tr>
    <tr>
  	<td align="center" class="table_title" >收件者連絡室內電話</td>
    <td align="left" bgcolor="#EAEAEA" class="table_data" ><input name="r_phone" type="text" class="input_data" id="r_phone" size="50" /></td>
    </tr>
    <tr>
      <td align="center" class="table_title" >收件者連絡手機</td>
      <td align="left" class="table_data" ><input name="r_cellphone" type="text" class="input_data" id="r_cellphone" size="50" /></td>
    </tr>
    <tr>
  	<td align="center" class="table_title" >收件者住址</td>
    <td align="left" bgcolor="#EAEAEA" class="table_data" ><input name="r_address" type="text" class="input_data" id="r_address" size="60" /></td>
    </tr>
    <tr>
  	<td align="center" class="table_title" >收件者電子郵件</td>
    <td align="left" class="table_data" ><input name="r_email" type="text" class="input_data" id="r_email" size="60" /></td>
    </tr>
    <tr>
  	<td align="center" bgcolor="#EAEAEA" class="table_title" >備註</td>
    <td align="left" class="table_data" ><label>
      <textarea name="notation" id="notation" cols="50" rows="5"><?php echo $row_RecOrder_set['notation']; ?></textarea>
      <br />
    </label></td>
    </tr>
    <tr>    
    <td colspan="2" align="center" ><button type=submit class="no_board"><img src="image/submit_btn_01.png" name="submit_pic" class="no_board" id="submit_pic" onmouseover="MM_swapImage('submit_pic','','image/submit_btn_over_01.png',1)" onmouseout="MM_swapImgRestore()"></button></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
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
mysql_free_result($RecOrder_set);

mysql_free_result($RecOrder_item);

mysql_free_result($RecMember);

mysql_free_result($RecProduct);
?>
