<?php require_once('../Connections/connect2data.php'); ?>
<?php
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

if(!in_array(2,$_SESSION['MM_Limit']['a6'])){
	header("Location: orders_list.php");
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

	$r_client="";
	if($_POST['r_client']==""){
		$r_client = $_POST['r_client'];
	}else{
		$r_client = $_POST['client'];
	}
	
	$r_phone="";
	if($_POST['r_phone']!=""){
		$r_phone = $_POST['r_phone'];
	}else{
		$r_phone = $_POST['phone'];
	}
	
	$r_client="";
	if($_POST['r_client']!=""){
		$r_client = $_POST['r_client'];
	}else{
		$r_client = $_POST['client'];
	}
	
	$r_cellphone="";
	if($_POST['r_cellphone']!=""){
		$r_cellphone = $_POST['r_cellphone'];
	}else{
		$r_cellphone = $_POST['cellphone'];
	}
	
	$r_email="";
	if($_POST['r_email']!=""){
		$r_email = $_POST['r_email'];
	}else{
		$r_email = $_POST['email'];
	}
	
	$r_address="";
	if($_POST['r_address']!=""){
		$r_address = $_POST['r_address'];
	}else{
		$r_address = $_POST['address'];
	}
	
	$bread_add="";
	if($_POST['bread_add']!=""){
		$bread_add = $_POST['bread_add'];
	}else{
		$bread_add = 0;
	}
	
	$cake_add="";
	if($_POST['cake_add']!=""){
		$cake_add = $_POST['cake_add'];
	}else{
		$cake_add = 0;
	}

  $insertSQL = sprintf("INSERT INTO order_set (client, phone, cellphone, email, address, r_client, r_phone, r_cellphone, r_email, r_address, invoice, insn, inname, inadd, method, status, m_id, bread_add, cake_add, tfee, SubTotalAll, GrandTotal, appointed_date, appointed_time, remitter, remitter_AC, remitter_money, remitter_time, remitter_active, `datetime`, notation, account) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['client'], "text"),
                       GetSQLValueString($_POST['phone'], "text"),
                       GetSQLValueString($_POST['cellphone'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($r_client, "text"),
                       GetSQLValueString($r_phone, "text"),
                       GetSQLValueString($r_cellphone, "text"),
                       GetSQLValueString($r_email, "text"),
                       GetSQLValueString($r_address, "text"),
                       GetSQLValueString($_POST['invoice'], "int"),
                       GetSQLValueString($_POST['insn'], "text"),
                       GetSQLValueString($_POST['inname'], "text"),
                       GetSQLValueString($_POST['inadd'], "text"),
                       GetSQLValueString($_POST['method'], "text"),
                       GetSQLValueString($_POST['status'], "text"),
                       GetSQLValueString($_POST['m_id'], "int"),
                       GetSQLValueString($bread_add, "int"),
                       GetSQLValueString($cake_add, "int"),
                       GetSQLValueString($_POST['tfee'], "int"),
                       GetSQLValueString($_POST['SubTotalAll'], "int"),
                       GetSQLValueString($_POST['GrandTotal'], "int"),
                       GetSQLValueString($_POST['appointed_date'], "text"),
                       GetSQLValueString($_POST['appointed_time'], "text"),
                       GetSQLValueString($_POST['remitter'], "text"),
                       GetSQLValueString($_POST['remitter_AC'], "text"),
                       GetSQLValueString($_POST['remitter_money'], "text"),
                       GetSQLValueString($_POST['remitter_time'], "text"),
                       GetSQLValueString($_POST['remitter_active'], "int"),
                       GetSQLValueString($_POST['datetime'], "date"),
                       GetSQLValueString($_POST['notation'], "text"),
                       GetSQLValueString($_POST['account'], "text"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());

 // 取得最新的id值
  mysql_select_db($database_connect2data, $connect2data);
  $query_RecGetMaxId = "SELECT Max(o_id) as max_id FROM order_set";
  $RecGetMaxId = mysql_query($query_RecGetMaxId,$connect2data) or die(mysql_error());
  $row_RecGetMaxId = mysql_fetch_assoc($RecGetMaxId);
  $totalRows_RecGetMaxId = mysql_num_rows($RecGetMaxId);
  
  //將詳細內容一筆筆寫入資料表
  if(count($_POST['d_id']) > 0) {
    //echo "count = ".count($_POST['d_id'])."<br>";
	for($j=0;$j<count($_POST['d_id']);$j++){
	//echo "id = ".$_POST['d_id'][$j]."<br>";
	//echo "j = ".$j."<br>";
	 // 取得的product值
 	 mysql_select_db($database_connect2data, $connect2data);
	 $query_RecProductGet = "SELECT * FROM data_set WHERE d_id = '".$_POST['d_id'][$j]."'";
 	 $RecProductGet = mysql_query($query_RecProductGet,$connect2data) or die(mysql_error());
  	 $row_RecProductGet = mysql_fetch_assoc($RecProductGet);
  	 $totalRows_RecProductGet = mysql_num_rows($RecProductGet);
	
	  	$insertSQL = sprintf("INSERT INTO order_item (o_id, d_id, d_name, price, amount, trans_temp, trans_bread, trans_space, trans_times) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
    	                   GetSQLValueString($row_RecGetMaxId['max_id'], "int"),
        	               GetSQLValueString($row_RecProductGet['d_id'], "int"),
						   GetSQLValueString($row_RecProductGet['d_title'], "text"),
						   GetSQLValueString($_POST['price'][$j], "int"),
                	       GetSQLValueString($_POST['amount'][$j], "int"),
						   GetSQLValueString($row_RecProductGet['trans_temp'], "int"),
                	       GetSQLValueString($row_RecProductGet['trans_bread'], "int"),
						   GetSQLValueString($row_RecProductGet['trans_space'], "int"),
                	       GetSQLValueString($row_RecProductGet['trans_times'], "int")); 
		mysql_select_db($database_connect2data, $connect2data);
		$Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error()); 
		
		//mysql_free_result($RecProductGet);
		}
  }

  $insertGoTo = "orders_list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
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
var newRow = 1;
function addField() {
		var pTable=document.getElementById('pTable');
		var lastRow = pTable.rows.length;
		//alert(pTable.rows.length);
		var myField=document.getElementById('product'+lastRow);
		//alert('image'+lastRow);
		if(myField.value){
			var aTr=pTable.insertRow(lastRow);
			newRow = lastRow+1;
			//var newImg='img'+(newRow);
			var aTd1=aTr.insertCell(0);
			var aTd2=aTr.insertCell(1);
			var aTd3=aTr.insertCell(2);
			var aTd4=aTr.insertCell(3);
			var aTd5=aTr.insertCell(4);
			
			aTd1.innerHTML = '<div align="center"><a href="#" onclick="rmRow(this);"><img src="image/cross.png" width="16" height="16" border="0" /></a></div>';
			aTd2.innerHTML = '<div align="center"><select name="product[]" id="product'+newRow+'" onchange="changeProduct(this, \'product\')"></select><input name="tmpName[]" type="hidden" id="tmpName'+newRow+'" /><input type="hidden" name="d_id[]" id="d_id'+newRow+'" /></div>';
			aTd3.innerHTML = '<div align="center"><input name="price[]" type="text" id="price'+newRow+'" value="" size="10"   onblur="updateTotal(this, \'price\')"/></div>';
			aTd4.innerHTML = '<div align="center"><input name="amount[]" type="text" id="amount'+newRow+'" value="1" size="10"   onblur="updateTotal(this, \'amount\')"/></div>';
			aTd5.innerHTML = '<div align="center"><span class="table_data"><input name="subTotal[]" type="text" id="subTotal'+newRow+'" size="10" onblur="updateTotal(this, \'subTotal\')"/></span></div>';
			initProduct(document.getElementById('product'+newRow), document.getElementById('price'+newRow), document.getElementById('tmpName'+newRow), document.getElementById('amount'+newRow), document.getElementById('subTotal'+newRow), document.getElementById('d_id'+newRow));
			
		}else{
			alert("尚有未選取之圖片欄位!!");
		}
	    }
function delField() {
	var pTable=document.getElementById('pTable');
	newRow = pTable.rows.length;
	newRow = newRow - 1;
	pTable.rows(newRow).removeNode();
}
	
function reNew(index){
	document.form1.price.value = select_value[index][0];
}

function changeText(cBox){
	var strs = cBox.id+"_show";
	var strs2 = cBox.id+"_add";
	//alert(cBox.checked);
	//alert(strs);
	if(cBox.value==1){
		document.getElementById(strs).style.display = "block";
		document.getElementById(strs2).value = 1;
	}else{
		document.getElementById(strs).style.display = "none";
		document.getElementById(strs2).value = 0;
	}
	//document.getElementById(strs).style.display = cBox.value?"block":"none";
	//document.getElementById(strs2).value = cBox.checked?1:0;	
	//alert(document.getElementById(strs2).value);
}

function changeValue(cRad){
	if(cRad.value==1){
		document.getElementById("r_active").style.display = "block";
		document.getElementById("remitter").value = "帳戶名";
		document.getElementById("remitter_AC").value = "帳號後五碼";
		document.getElementById("remitter_money").value = "金額";
		document.getElementById("remitter_time").value = "0000-00-00 00:00";
	}else{
		document.getElementById("r_active").style.display = "none";
		document.getElementById("remitter").value = "";
		document.getElementById("remitter_AC").value = 0;
		document.getElementById("remitter_money").value = 0;
		document.getElementById("remitter_time").value = "";
	}
	//document.getElementById(strs).style.display = cBox.value?"block":"none";
	//document.getElementById(strs2).value = cBox.checked?1:0;	
	//alert(document.getElementById(strs2).value);
}


function rmRow(obj) {
	var a = traceUp(obj, "TR");
	var b = a.previousSibling;
	var c = 0;
	while (null != b) {
		c++;
		b = b.previousSibling;
	}
	d = traceUp(obj, "TABLE");
	d.deleteRow(c);
	var pTable=document.getElementById('pTable');
	newRow = pTable.rows.length;
	updateGrandTotal();
	//newRow = newRow - 1;
	//alert(newRow);
}
function traceUp(obj, tag) {
	if (obj.tagName.toUpperCase() == tag.toUpperCase()) {
		return obj;
	} else {
		return traceUp(obj.parentNode, tag);
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
<form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1" id="form1">
  <table border="0" align="center" cellpadding="5" cellspacing="1">
  <td width="100%" align="left" class="table_data" >訂單資訊：</td>
  </table>
  <table width="100%" border="0" cellpadding="5" cellspacing="1">
    <tr align="center">
      <td width="4%" class="table_title">刪除</td>
      <td width="30%" class="table_title">商品名稱</td>
      <td width="30%" class="table_title">單價</td>
      <td width="18%" class="table_title">數量</td>
      <td width="18%" class="table_title">金額</td>
    </tr>
    <tr align="center">
      <td colspan="5"><table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" id="pTable">
        <tr align="center">
          <td width="4%" align="left">&nbsp;</td>
          <td width="30%"><div align="center"><select name="product[]" id="product1" onchange="changeProduct(this, 'product')"></select><input name="tmpName[]" type="hidden" id="tmpName1" /><input type="hidden" name="d_id[]" id="d_id1" />
          </div></td>
          <td width="30%" align="center"><div align="center"><input name="price[]" type="text" id="price1" size="10"  onblur="updateTotal(this, 'price')"/></div></td>
          <td width="18%" align="center"><div align="center"><input name="amount[]" type="text" id="amount1" value="1" size="10" onblur="updateTotal(this, 'amount')"/>
          </div></td>
          <td width="18%" align="center"><div align="center"><span class="table_data"><input name="subTotal[]" type="text" id="subTotal1" size="10"  onblur="updateTotal(this, 'subTotal')"/></span></div></td>
        </tr>        
      </table>      </td>
      </tr>
    <tr align="center">
      <td colspan="2" align="left"><table border="0" cellspacing="1" cellpadding="1">
        <tr>
          <td><a href="javascript:addField()"><img src="image/add.png" width="16" height="16" border="0" /></a></td>
          <td><a href="javascript:addField()" class="table_data">增加購買商品欄位</a></td>
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
  	<td width="174" align="center" class="table_title" >小計</td>
    <td width="640" align="center" bgcolor="#EAEAEA" class="table_data" >&nbsp;</td>
    <td colspan="-1" bgcolor="#EAEAEA" class="table_data"><label>
      <input name="SubTotalAll" type="text" class="input_data2" id="SubTotalAll" onblur="updateGrandTotal()" value="0"/>
      元
    </label></td>
  </tr>
  <tr>
  	<td align="center" class="table_title" >運費</td>
    <td align="center" class="table_data" ></td>
    <td colspan="-1" align="left" class="table_data">
      <label>
      <input name="tfee" type="text" class="input_data2" id="tfee" onblur="updateGrandTotal()" value="0"/>
      元      </label></td>
  </tr>
  <tr>
  	<td align="center" class="table_title" >總計</td>
    <td align="center" bgcolor="#EAEAEA" class="table_data" >&nbsp;</td>
    <td colspan="-1" bgcolor="#EAEAEA" class="table_data"><input name="GrandTotal" type="text" class="input_data2" id="GrandTotal" onblur="updateGrandTotal()" value="0"/>
      元</td>
  </tr>
  <tr>
    <td align="center" class="table_title" >是否贈送餐包</td>
    <td colspan="2" class="table_data" ><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="85" align="left"><label>
            <input type="radio" name="bread" value="1" id="bread"  onclick="changeText(this)"/>
            是</label>
              <label>
              <input name="bread" type="radio" id="bread"  onclick="changeText(this)" value="0" checked="checked"/>
                否</label></td>
          <td><div id="bread_show" style="display:none">贈送
            <input name="bread_add" type="text" class="input_data2" id="bread_add" size="5" />
            包</div></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center" class="table_title" >是否贈送北海道濃奶蛋</td>
    <td colspan="2" bgcolor="#EAEAEA" class="table_data" ><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="85" align="left"><label>
            <input type="radio" name="cake" value="1" id="cake"  onclick="changeText(this)"/>
            是</label>
              <label>
              <input name="cake" type="radio" id="cake"  onclick="changeText(this)" value="0" checked="checked"/>
                否</label></td>
          <td><div id="cake_show" style="display:none">贈送
            <input name="cake_add" type="text" class="input_data2" id="cake_add" size="5" />
            盒</div></td>
        </tr>
    </table></td>
  </tr>
  
  <tr>
    <td align="center" class="table_title" >是否回報匯款</td>
    <td colspan="2" class="table_data" ><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="85"><label>
            <input type="radio" name="remitter_active" value="1" id="cake2"  onclick="changeValue(this)"/>
            是</label>
              <label>
              <input name="remitter_active" type="radio" id="cake2"  onclick="changeValue(this)" value="0" checked="checked"/>
                否</label></td>
          <td><div id="r_active" style="display:none">匯款帳戶名<input name="remitter" type="text" class="input_data2" id="remitter" size="15" />　
            匯款帳號後五碼
            <input name="remitter_AC" type="text" class="input_data2" id="remitter_AC" size="15" />　
            匯款金額
            <input name="remitter_money" type="text" class="input_data2" id="remitter_money" size="15" />　
            匯款時間
            <input name="remitter_time" type="text" class="input_data2" id="remitter_time" size="18" />
            </div></td>
        </tr>
        </table></td>
    </tr>
  <tr>
    <td align="center" class="table_title" >發票開立方式</td>
    <td colspan="2" bgcolor="#EAEAEA" class="table_data" ><table border="0" cellpadding="0" cellspacing="0" class="table_data">
      <tr>
        <td><label>
          <input type="radio" name="invoice" value="0" checked="checked"/>
          二聯式 　</label></td>
        <td><label>
          <input type="radio" name="invoice" value="1"/>
          三聯式(如選擇三聯式發票,請填寫以下資料)</label></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center" class="table_title" >買受人統一編號</td>
    <td colspan="2" class="table_data" ><span class="f13">
      <input name="insn" type="text" class="input_data2" id="insn" size="60" />
    </span></td>
  </tr>
  <tr>
    <td align="center" class="table_title" >買受人名稱</td>
    <td colspan="2" bgcolor="#EAEAEA" class="table_data" ><span class="f13">
      <input name="inname" type="text" class="input_data2" id="inname" size="60" />
    </span></td>
  </tr>
  <tr>
    <td align="center" class="table_title" >買受人地址</td>
    <td colspan="2" class="table_data" ><span class="f13">
      <input name="inadd" type="text" class="input_data2" id="inadd" size="60" />
    </span></td>
  </tr>
  <tr>
    <td align="center" class="table_title" >收貨日</td>
    <td align="center" bgcolor="#EAEAEA" class="table_data" >&nbsp;</td>
    <td colspan="-1" align="center" bgcolor="#EAEAEA"  class="table_data"><span class="table_data2">
      <select name="appointed_date" class="input_data2" id="appointed_date">
        <option value="1">平日</option>
        <option value="2">假日</option>
        <option value="3">不指定</option>
      </select>
    </span></td>
  </tr>
  <tr>
    <td align="center" class="table_title" >收貨時間</td>
    <td align="center" class="table_data" >&nbsp;</td>
    <td colspan="-1" align="center"  class="table_data"><span class="table_data2">
      <select name="appointed_time" class="input_data2" id="appointed_time">
        <option value="1">08時 ─ 12時</option>
        <option value="2">12時 ─ 17時</option>
        <option value="3">17時 ─ 20時</option>
      </select>
    </span></td>
  </tr>
  <tr>
  	<td align="center" class="table_title" >交易方式</td>
    <td align="center" bgcolor="#EAEAEA" class="table_data" >&nbsp;</td>
    <td colspan="-1" align="center" bgcolor="#EAEAEA"  class="table_data"><label>
      <select name="method" class="input_data2" id="method">
        <option value="1" >ATM 轉帳</option>
        <option value="2" >貨到付款</option>
      </select>
    </label></td>
  </tr>
  <tr>
  	<td align="center" class="table_title" >進度</td>
    <td colspan="2" align="right" class="table_data" ><select name="status" class="input_data2" id="status">
      <option value="0">1.新近未處理</option>
      <option value="1">2.待匯款，未寄出</option>
      <option value="2">2.貨到付款:訂單確認，未收款</option>
      <option value="3">3.匯款:已匯款，未寄出</option>
      <option value="4">3.店取:確認有貨，待取</option>
      <option value="5">3.貨到付:貨物已寄出，未收款</option>
      <option value="6">4.匯款:寄出商品</option>
      <option value="7">4.店取:客戶已結帳，交易結束</option>
      <option value="8">4.貨到付:客戶已收到，未確認收款</option>
      <option value="9">5.匯款:客戶已收到，交易結束</option>
      <option value="10">5.貨到付:已收款，交易結束</option>
    </select>
      <label></label></td>
    </tr>  
    <!--主分類更動要呼叫javascript//-->
<script type="text/javascript">
<!--//儲存次分類資料的陣列
var totalP = <?php echo $totalRows_RecProduct ?>;
var Product_id=new Array(totalP);
var Product_title=new Array(totalP);
var Product_price=new Array(totalP);
//for(var i=0;i<totalP;i++){
<?php  
$row_num=0;
do { 
?>
	var i = <?php echo $row_num; ?>;
	Product_id[i] = "<?php echo $row_RecProduct['d_id']; ?>";
	Product_title[i] = "<?php echo $row_RecProduct['d_title']; ?>";
	Product_price[i] = "<?php echo $row_RecProduct['price_L']; ?>";
<?php
$row_num++;
} while ($row_RecProduct = mysql_fetch_assoc($RecProduct));  
?>
//alert(Product_price);
function initProduct(selectedP, priceP, tmpName, amountP, subTotalP, idP){
	selectedP.length = Product_id.length;
	for (var j = 0; j < Product_id.length; j++) {		
		selectedP.options[j].value = Product_id[j];
		selectedP.options[j].text = Product_title[j];
		//alert(selectedP.options[j].value);		
	}
	priceP.value = Product_price[0];
	tmpName.value = Product_title[0];
	idP.value = Product_id[0];
	updateTotal(selectedP, 'product');
	//subTotalP.value = priceP.value*amountP.value;
	//alert(priceP.value);
}

function changeProduct(objectP, nameP){	
	var str = objectP.id;
	//alert(str.length);	
	str = str.replace(nameP, "");
	//str = str.charAt(7);s	
	var index = objectP.selectedIndex;
	document.getElementById('price'+str).value = Product_price[index];
	document.getElementById('tmpName'+str).value = Product_title[index];
	document.getElementById('d_id'+str).value = Product_id[index];
	//document.getElementById('subTotal'+str).value = document.getElementById('price'+str).value*document.getElementById('amount'+str).value;
	updateTotal(objectP, nameP);
}

function updateTotal(objectP, nameP){
	//subTotalP.value = priceP.value*amountP.value;
	var myErr="";
	var str = objectP.id;	
	str = str.replace(nameP, "");
	if(!IsNumeric(document.getElementById('subTotal'+str).value)){
		myErr+='* 您所輸入的金額不是阿拉伯數字，請您再次確認！'+'\n';
	}
	if(!IsNumeric(document.getElementById('price'+str).value)){
		myErr+='* 您所輸入的單價不是阿拉伯數字，請您再次確認！'+'\n';
	}
	if(!IsNumeric(document.getElementById('amount'+str).value)){
		myErr+='* 您所輸入的數量不是阿拉伯數字，請您再次確認！'+'\n';
	}
	if (myErr!=''){
	alert('請確認您所輸入的資料是否填寫正確：\t\t\t\t\t\n\n'+myErr);
	}else{
    //document.MM_returnValue = (myErr=='');
	document.getElementById('subTotal'+str).value = document.getElementById('price'+str).value*document.getElementById('amount'+str).value;
	updateGrandTotal();
	}
}

function updateGrandTotal(){
	var addNum = 0;
	for(var k=1; k<=newRow; k++){
		addNum = Number(addNum) + Number(document.getElementById('subTotal'+k).value);
		//alert(document.getElementById('subTotal'+k).value);
	}
	document.getElementById('SubTotalAll').value = addNum;
	document.getElementById('GrandTotal').value = Number(document.getElementById('tfee').value) + Number(document.getElementById('SubTotalAll').value);
}

function IsNumeric(sText)
{	//判斷是否為數值
   var ValidChars = "0123456789.";
   var IsNumber=true;
   var Char;
 
   for (i = 0; i < sText.length && IsNumber == true; i++) 
      { 
      Char = sText.charAt(i); 
      if (ValidChars.indexOf(Char) == -1) 
         {
         IsNumber = false;
         }
      }
   return IsNumber;   
 }

initProduct(document.form1.product1, document.form1.price1, document.form1.tmpName1, document.form1.amount1, document.form1.subTotal1, document.form1.d_id1);
//-->
</script>
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
    <td align="left" class="table_data" ><input name="client" type="text" class="input_data" id="client" value="<?php echo $row_RecMember['m_name']; ?>" size="60" />
      <input name="m_id" type="hidden" id="m_id" value="<?php echo $row_RecMember['m_id']; ?>" /></td>
    </tr>
    <tr>
  	<td align="center" class="table_title" >會員帳號</td>
    <td align="left" bgcolor="#EAEAEA" class="table_data" ><input name="account" type="text" class="input_data" id="account" value="<?php echo $row_RecMember['m_account']; ?>" size="60" /></td>
    </tr>
    <tr>
  	<td align="center" class="table_title" >連絡室內電話</td>
    <td align="left" class="table_data" ><input name="phone" type="text" class="input_data" id="phone" value="<?php echo $row_RecMember['m_phone']; ?>" size="60" /></td>
    </tr>
    <tr>
      <td align="center" class="table_title" >連絡手機</td>
      <td align="left" bgcolor="#EAEAEA" class="table_data" ><input name="cellphone" type="text" class="input_data" id="cellphone" value="<?php echo $row_RecMember['m_cellphone']; ?>" size="60" /></td>
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
    <td align="left" class="table_data" ><input name="r_client" type="text" class="input_data" id="r_client" size="60" /></td>
    </tr>
    <tr>
  	<td align="center" class="table_title" >收件者連絡室內電話</td>
    <td align="left" bgcolor="#EAEAEA" class="table_data" ><input name="r_phone" type="text" class="input_data" id="r_phone" size="60" /></td>
    </tr>
    <tr>
      <td align="center" class="table_title" >收件者連絡手機</td>
      <td align="left" class="table_data" ><input name="r_cellphone" type="text" class="input_data" id="r_cellphone" size="60" /></td>
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
      <textarea name="notation" id="notation" cols="50" rows="5"></textarea>
      <br />
    </label></td>
    </tr>
    <tr>    
    <td colspan="2" align="center" ><input name="submitBtn" type="submit" class="btnType" id="submitBtn" value="送出" /></td>
    </tr>
  </table>
  <span class="f13">
  <input name="datetime" type="hidden" id="datetime" value="<?php echo date("Y-m-d H:i:s") ?>" />
  </span>
  <input type="hidden" name="MM_insert" value="form1" />
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
mysql_free_result($RecMember);

mysql_free_result($RecProduct);
?>
