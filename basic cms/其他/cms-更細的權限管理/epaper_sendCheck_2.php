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

$colname_RecEpaper = "-1";
if (isset($_GET['e_id'])) {
  $colname_RecEpaper = $_GET['e_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecEpaper = sprintf("SELECT * FROM epaper_set WHERE e_id = %s", GetSQLValueString($colname_RecEpaper, "int"));
$RecEpaper = mysql_query($query_RecEpaper, $connect2data) or die(mysql_error());
$row_RecEpaper = mysql_fetch_assoc($RecEpaper);
$totalRows_RecEpaper = mysql_num_rows($RecEpaper);

$colname_RecImage = "-1";
if (isset($_GET['e_id'])) {
  $colname_RecImage = $_GET['e_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecImage = sprintf("SELECT * FROM file_set WHERE file_e_id = %s AND file_type = 'image'" , GetSQLValueString($colname_RecImage, "int"));
$RecImage = mysql_query($query_RecImage, $connect2data) or die(mysql_error());
$row_RecImage = mysql_fetch_assoc($RecImage);
$totalRows_RecImage = mysql_num_rows($RecImage);

$colname_RecFile = "-1";
if (isset($_GET['e_id'])) {
  $colname_RecFile = $_GET['e_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecFile = sprintf("SELECT * FROM file_set WHERE file_e_id = %s AND file_type = 'file'", GetSQLValueString($colname_RecFile, "int"));
$RecFile = mysql_query($query_RecFile, $connect2data) or die(mysql_error());
$row_RecFile = mysql_fetch_assoc($RecFile);
$totalRows_RecFile = mysql_num_rows($RecFile);

 $menu_is="epaper";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php require_once('cmsTitle.php'); ?></title>
<?php require_once('script.php'); ?>
<!-- InstanceBeginEditable name="doctitle" -->
<title>無標題文件</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js" type="text/javascript"></script>
<script src="../js/checkformat.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("#hide2").hide();
	$("#hide3").hide();
	$("#targetSendTr input:radio").click(function() {
		//alert($(this).val());
 		 if($(this).val()==1){
		 	$("#hide1").toggle();
			$("#hide2").toggle();
			$("#hide3").hide();
			$("#email").val('');
			$("#targetSendTr input:radio").val(1);
			$("#m_birthmonth").attr("value",'');
		 }else{
		 	$("#hide1").toggle();
			$("#hide2").toggle();
			$("#hide3").hide();
			$("#email").val('');
			$("#m_birthmonth").attr("value",'');
			$("#targetSendTr input:radio").val(0);
			//$("#targetMemberTr input:radio").val(0);
			$('input[name=targetMember]:checked').attr("checked",'');
		 }
	});
	$("#targetMemberTr input:radio").click(function() {
		//alert($(this).val());
 		 if($(this).val()==1){
			$("#hide3").toggle();
			$("#targetMember input:radio").val(1);
		 }else{
			$("#hide3").toggle();
			$("#m_birthmonth").attr("value",'');
			$("#targetMember input:radio").val(0);
			//$("#targetMemberTr input:radio").val(0);
			//$('input[name=targetMember]:checked').attr("checked",'');
		 }
	});
})
</script>
<script type="text/javascript">
//要檢查EMAIL的格式
var check_email_value=false;//email
function getemailcheck(id){
check_email_value=checkemail(id);
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
</script>
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
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="30%" class="list_title">確認寄送電子報</td>
            <td width="70%">&nbsp;</td>
        </tr>
	</table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td><img src="image/spacer.gif" width="1" height="1"></td>
        </tr>
    </table>
    <form action="epaper_send.php" method="POST" enctype="multipart/form-data" name="form1" id="form1" onsubmit="YY_checkform('form1','email','S','2','請檢查EMAIL是否有誤!');return document.MM_returnValue">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  		<tr>
   			<td>
            <table width="100%" border="0" cellspacing="3" cellpadding="5">
            	<tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">標題</td>
          	    	<td width="532" class="table_data"><?php echo $row_RecEpaper['e_title']; ?>
          	    	  <input name="e_id" type="hidden" id="e_id" value="<?php echo $row_RecEpaper['e_id']; ?>" /></td>
          	    	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	    	</tr>
                <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">內容</td>
          	    	<td width="532" style="word-break:break-all">
          	    	  <span class="table_data"><?php echo $row_RecEpaper['e_content']; ?></span></td>
          	     	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
     	      	<tr id="targetSendTr">
     	      	  <td align="center" bgcolor="#e5ecf6" class="table_col_title">選擇寄送對象</td>
     	      	  <td><table border="0" cellpadding="0" cellspacing="0" class="table_data">
                      <tr>
                        <td><label>
                          <input type="radio" name="targetSend" value="0" checked="checked"/>
                          測試人員 　</label></td>
                        <td><label>
                          <input type="radio" name="targetSend" value="1"/>
                          會員 　</label></td>
                      </tr>
                    </table></td>
     	      	  <td bgcolor="#e5ecf6" class="table_col_title">&nbsp;</td>
   	      	  </tr>
              <tbody id="hide1">
     	      	<tr>
     	      	  <td align="center" bgcolor="#e5ecf6" class="table_col_title">謮輸入測試人員EMAIL</td>
     	      	  <td><input name="email" type="text" class="table_data" id="email" size="50" onBlur="getemailcheck(email)"/></td>
     	      	  <td bgcolor="#e5ecf6" class="table_col_title">&nbsp;</td>
   	      	  </tr>
              </tbody>
     	      	<tr id="hide2">
     	      	  <td align="center" bgcolor="#e5ecf6" class="table_col_title">請選擇收件會員</td>
     	      	  <td><table border="0" cellpadding="0" cellspacing="0" class="table_data">
                      <tr id="targetMemberTr">
                        <td><label>
                          <input type="radio" name="targetMember" value="0" checked="checked"/>
                          所有會員 　</label></td>
                        <td><label>
                          <input type="radio" name="targetMember" value="1"/>
                          月份 　</label></td>
                      </tr>
                    </table></td>
     	      	  <td bgcolor="#e5ecf6" class="table_col_title">&nbsp;</td>
   	      	  </tr>
     	      	<tr id="hide3">
     	      	  <td align="center" bgcolor="#e5ecf6" class="table_col_title">請選擇會員月份</td>
     	      	  <td>
                        <select name="m_birthmonth" class="input_data2" id="m_birthmonth">
                          <option selected="selected"  value=""> 請選擇月份 </option>
                          <option value="01"> 一月份 </option>
                          <option value="02"> 二月份 </option>
                          <option value="03"> 三月份 </option>
                          <option value="04"> 四月份 </option>
                          <option value="05"> 五月份 </option>
                          <option value="06"> 六月份 </option>
                          <option value="07"> 七月份 </option>
                          <option value="08"> 八月份 </option>
                          <option value="09"> 九月份 </option>
                          <option value="10"> 十月份 </option>
                          <option value="11"> 十一月份 </option>
                          <option value="12"> 十二月份 </option>
                        </select> </td>
     	      	  <td bgcolor="#e5ecf6" class="table_col_title">&nbsp;</td>
   	      	  </tr>
			</table>
            </td>
		</tr>
        <tr>
        	<td>&nbsp;</td>
        </tr>
         <tr>
         	<td align="center"><button class="no_board" type="submit">
         	  <img src="image/submit_btn_01.png" name="submit_pic" class="no_board" id="submit_pic" onmouseover="MM_swapImage('submit_pic','','image/submit_btn_over_01.png',1)" onmouseout="MM_swapImgRestore()"></button></td>
         </tr>
	</table>
    </form>
    <table width="100%" height="1" border="0" align="center" cellpadding="0" cellspacing="0" class="buttom_dot_line">
        <tr>
            <td>&nbsp;</td>
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
mysql_free_result($RecEpaper);

mysql_free_result($RecImage);
?>
