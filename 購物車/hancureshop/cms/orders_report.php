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

if(!in_array(5,$_SESSION['MM_Limit']['a6'])){
	header("Location: orders_list.php");
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	
	echo 'MM_update = '.$_POST["MM_update"];
	
  $updateSQL = sprintf("UPDATE order_set SET remitter=%s, remitter_AC=%s, remitter_money=%s, remitter_time=%s, remitter_active=%s, bank_status=%s WHERE o_id=%s",
                       GetSQLValueString($_POST['remitter'], "text"),
                       GetSQLValueString($_POST['remitter_AC'], "text"),
                       GetSQLValueString($_POST['remitter_money'], "text"),
					   GetSQLValueString($_POST['remitter_time'], "text"),
                       GetSQLValueString('1', "int"),
                       GetSQLValueString('1', "int"),
                       GetSQLValueString($_POST['o_id'], "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());

  $updateGoTo = "orders_list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $_SESSION['REFERER']));
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

$menu_is="orders";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php require_once('cmsTitle.php'); ?></title>
<?php require_once('script.php'); ?>
<!-- InstanceBeginEditable name="doctitle" -->
<title>無標題文件</title>

<!--edit.php回報資料的javascript  begin-->
<script type="text/javascript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
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
 function altr(){
 	alert('jjjjjjjjj');
 }
function YY_checkform() { //v4.65
//copyright (c)1998,2002 Yaromat.com
  var args = YY_checkform.arguments; var myDot=true; var myV=''; var myErr='';var addErr=false;var myReq;
  for (var i=1; i<args.length;i=i+4){
    if (args[i+1].charAt(0)=='#'){myReq=true; args[i+1]=args[i+1].substring(1);}else{myReq=false}
    var myObj = MM_findObj(args[i].replace(/\[\d+\]/ig,""));
    myV=myObj.value;
    if (myObj.type=='text'||myObj.type=='password'||myObj.type=='hidden'){
      if (myReq&&myObj.value.length==0){addErr=true}
      if ((myV.length>0)&&(args[i+2]==1)){ //fromto
        var myMa=args[i+1].split('_');if(isNaN(parseInt(myV))||myV<myMa[0]/1||myV > myMa[1]/1){addErr=true}
      } else if ((myV.length>0)&&(args[i+2]==2)){
          var rx=new RegExp("^[\\w\.=-]+@[\\w\\.-]+\\.[a-z]{2,4}$");if(!rx.test(myV))addErr=true;
      } else if ((myV.length>0)&&(args[i+2]==3)){ // date
        var myMa=args[i+1].split("#"); var myAt=myV.match(myMa[0]);
        if(myAt){
          var myD=(myAt[myMa[1]])?myAt[myMa[1]]:1; var myM=myAt[myMa[2]]-1; var myY=myAt[myMa[3]];
          var myDate=new Date(myY,myM,myD);
          if(myDate.getFullYear()!=myY||myDate.getDate()!=myD||myDate.getMonth()!=myM){addErr=true};
        }else{addErr=true}
      } else if ((myV.length>0)&&(args[i+2]==4)){ // time
        var myMa=args[i+1].split("#"); var myAt=myV.match(myMa[0]);if(!myAt){addErr=true}
      } else if (myV.length>0&&args[i+2]==5){ // check this 2
            var myObj1 = MM_findObj(args[i+1].replace(/\[\d+\]/ig,""));
            if(myObj1.length)myObj1=myObj1[args[i+1].replace(/(.*\[)|(\].*)/ig,"")];
            if(!myObj1.checked){addErr=true}
      } else if (myV.length>0&&args[i+2]==6){ // the same
            var myObj1 = MM_findObj(args[i+1]);
            if(myV!=myObj1.value){addErr=true}
      }
    } else
    if (!myObj.type&&myObj.length>0&&myObj[0].type=='radio'){
          var myTest = args[i].match(/(.*)\[(\d+)\].*/i);
          var myObj1=(myObj.length>1)?myObj[myTest[2]]:myObj;
      if (args[i+2]==1&&myObj1&&myObj1.checked&&MM_findObj(args[i+1]).value.length/1==0){addErr=true}
      if (args[i+2]==2){
        var myDot=false;
        for(var j=0;j<myObj.length;j++){myDot=myDot||myObj[j].checked}
        if(!myDot){myErr+='* ' +args[i+3]+'\n'}
      }
    } else if (myObj.type=='checkbox'){
      if(args[i+2]==1&&myObj.checked==false){addErr=true}
      if(args[i+2]==2&&myObj.checked&&MM_findObj(args[i+1]).value.length/1==0){addErr=true}
    } else if (myObj.type=='select-one'||myObj.type=='select-multiple'){
      if(args[i+2]==1&&myObj.selectedIndex/1==0){addErr=true}
    }else if (myObj.type=='textarea'){
      if(myV.length<args[i+1]){addErr=true}
    }
    if (addErr){myErr+='* '+args[i+3]+'\n'; addErr=false}
  }
  if (myErr!=''){alert('The required information is incomplete or contains errors:\t\t\t\t\t\n\n'+myErr)}
  document.MM_returnValue = (myErr=='');
}
//-->
</script>
<!-- //edit.php回報資料的javascript   end-->
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<style type="text/css">
<!--
.ff02 {font-size: 13px;
	font-family: "ө";
	font-style: normal;
	line-height: 23px;
	font-weight: normal;
	font-variant: normal;
	text-transform: none;
	color: #333333;
}
-->
</style>
<style type="text/css">
<!--
.f0111 {font-size: 13px;
	line-height: normal;
	color: #990000;
	margin-right:7px;
}
-->
</style>
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
          <td width="183" class="list_title" border="0" cellpadding="5" cellspacing="1">匯款回報</td>
          <td width="617">&nbsp;</td>
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
<form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1" id="form1" onsubmit="YY_checkform('form1','remitter','#q','0','請填寫您的匯款帳戶名','remitter_AC','#00000_99999','1','請填寫您的匯款帳號後五碼','remitter_money','#q','0','請填寫您的匯款金額','remitter_time','#q','0','請填寫您的匯款時間');return document.MM_returnValue">
  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
    <tr>
      <td width="22%" align="center" class="table_title">匯款帳戶名</td>
      <td width="78%"><input name="remitter" type="text" class="input_data" id="remitter" value="<?php echo ($row_RecOrder['remitter']!='')?$row_RecOrder['remitter']:''; ?>" size="50" /></td>
    </tr>
    <tr>
      <td align="center" class="table_title">匯款帳號後五碼</td>
      <td bgcolor="#EAEAEA"><span class="f13">
        <input name="remitter_AC" type="text" class="input_data" id="remitter_AC" value="<?php echo ($row_RecOrder['remitter_AC']!='')?$row_RecOrder['remitter_AC']:''; ?>" size="50" maxlength="5" />
        <span class="f0111">*請使用阿拉伯數字填寫</span></span></td>
    </tr>
    <tr>
      <td align="center" class="table_title">匯款金額</td>
      <td><span class="ff02">
        <input name="remitter_money" type="text" class="input_data" id="remitter_money" value="<?php echo ($row_RecOrder['remitter_money']!='')?$row_RecOrder['remitter_money']:''; ?>" size="50" />
        <span class="f0111">*請使用阿拉伯數字填寫</span></span></td>
    </tr>
    <tr>
      <td align="center" class="table_title">匯款時間</td>
      <td bgcolor="#EAEAEA"><span class="ff02">
        <input name="remitter_time" type="text" class="input_data" id="remitter_time" value="<?php echo date('Y-m-d H:i')?>" size="50" />
        <span class="f0111">*請使用西元格式(2012-03-01 10:30)</span></span></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><span class="f13">
        <input name="o_id" type="hidden" id="o_id" value="<?php echo $row_RecOrder['o_id']; ?>" />
        <input name="remitter_active" type="hidden" id="remitter_active" value="<?php echo $row_RecOrder['remitter_active']; ?>" />
        <input name="Submit" type="reset" class="button_set" value="重新填寫" />
        <input name="Submit" type="submit" class="button_set" value="確定送出"/>
      </span></td>
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
mysql_free_result($RecOrder);
?>
