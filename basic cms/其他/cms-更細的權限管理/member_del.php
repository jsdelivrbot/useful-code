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

if(!in_array(7,$_SESSION['MM_Limit']['a5'])){
	header("Location: member_list.php");
}

if ((isset($_REQUEST['m_id'])) && ($_REQUEST['m_id'] != "") && (isset($_REQUEST['delsure']))) {
	$m_id = $_REQUEST['m_id'];
	mysql_select_db($database_connect2data, $connect2data);
	//----------刪除圖片資料到資料庫begin(在主資料前)-----	   
	    $sql="SELECT file_link1 FROM file_set WHERE file_type='image' AND file_d_id='".$m_id."'";
		$result = mysql_query($sql)or die("無法送出".mysql_error( ));
		while ( $row = mysql_fetch_array($result))
		{
			//echo "../".$row[0]."<BR>";
			unlink("../".$row[0]);//刪除檔案
		}
		
		$sql="SELECT file_link2 FROM file_set WHERE file_type='image' AND file_d_id='".$m_id."'";
		$result = mysql_query($sql)or die("無法送出".mysql_error( ));
		while ( $row = mysql_fetch_array($result))
		{
			//echo "../".$row[0]."<BR>";
			unlink("../".$row[0]);//刪除檔案
		}
		
		/*$sql="SELECT file_link3 FROM file_set WHERE file_type='image' AND file_d_id='".$m_id."'";
		$result = mysql_query($sql)or die("無法送出".mysql_error( ));
		while ( $row = mysql_fetch_array($result))
		{
			echo "../".$row[0]."<BR>";
			//unlink("../".$row[0]);//刪除檔案
		}*/
				
	  $deleteSQL = sprintf("DELETE FROM file_set WHERE file_type='image' AND file_d_id=%s",
						   GetSQLValueString($_REQUEST['m_id'], "int"));
	
	  mysql_select_db($database_connect2data, $connect2data);
	  $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());
	  
	  //----------刪除圖片資料到資料庫end(在主資料前)----

  $deleteSQL = sprintf("DELETE FROM member_set WHERE m_id=%s",
                       GetSQLValueString($_REQUEST['m_id'], "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());

  $deleteGoTo = "member_list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
	$deleteGoTo .= $_SERVER['QUERY_STRING']."&pageNum_RecMember=".$_SESSION["ToPage"];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_RecMember = "-1";
if (isset($_REQUEST['m_id'])) {
  $colname_RecMember = $_REQUEST['m_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecMember = sprintf("SELECT * FROM member_set WHERE m_id = %s", GetSQLValueString($colname_RecMember, "int"));
$RecMember = mysql_query($query_RecMember, $connect2data) or die(mysql_error());
$row_RecMember = mysql_fetch_assoc($RecMember);
$totalRows_RecMember = mysql_num_rows($RecMember);

 $menu_is="member";?>
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
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="30%" class="list_title">刪除會員資料</td>
          <td width="70%"><span class="no_data">確定刪除以下會員資料?</span></td>
        </tr>
      </table>
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="image/spacer.gif" width="1" height="1"></td>
        </tr>
      </table>
      
      <form action="" method="POST" enctype="multipart/form-data" name="form1" id="form1">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
  		<tr>
   		 	<td>
            <table width="100%" border="0" cellpadding="5" cellspacing="3">
              <tr>
                <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">會員姓名</td>
                <td width="532" class="table_data"><?php echo $row_RecMember['m_name']; ?></td>
                <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
              </tr>
              <tr>
                 <td align="center" bgcolor="#e5ecf6" class="table_col_title">會員登入帳號</td>
          	     <td class="table_data"><?php echo $row_RecMember['m_account']; ?></td>
          	     <td bgcolor="#e5ecf6">&nbsp;</td>
      	      </tr>
              <?php if($row_RecMember['m_class2']==1){ ?>
              <?php } ?>
              <tr>
                 <td align="center" bgcolor="#e5ecf6" class="table_col_title">性別</td>
          	     <td class="table_data"><?php if (!(strcmp(0, $row_RecMember['m_gender']))) {echo "女士";} ?><?php if (!(strcmp(1, $row_RecMember['m_gender']))) {echo "先生";} ?></td>
          	     <td bgcolor="#e5ecf6">&nbsp;</td>
      	      </tr>
              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">電子信箱</td>
                <td class="table_data"><?php echo $row_RecMember['m_email']; ?></td>
                <td bgcolor="#e5ecf6">&nbsp;</td>
              </tr>
              <tr>
                 <td align="center" bgcolor="#e5ecf6" class="table_col_title">連絡電話</td>
          	     <td class="table_data"><?php echo $row_RecMember['m_phone']; ?></td>
          	     <td bgcolor="#e5ecf6">&nbsp;</td>
      	      </tr>
              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">地址</td>
                <td class="table_data"><?php echo $row_RecMember['m_zip']; ?> <?php echo $row_RecMember['m_city']; ?> <?php echo $row_RecMember['m_canton']; ?><?php echo $row_RecMember['m_address']; ?></td>
                <td bgcolor="#e5ecf6">&nbsp;</td>
              </tr>
              <tr>
                 <td align="center" bgcolor="#e5ecf6" class="table_col_title">加入時間</td>
          	     <td class="table_data"><?php echo $row_RecMember['m_date']; ?></td>
          	     <td bgcolor="#e5ecf6">&nbsp;</td>
      	      </tr>
             </table>
            </td>
         </tr>
         <tr>
           <td>&nbsp;</td>
         </tr>
         <tr>
         <td align="center">
    	 <input name="delsure" type="hidden" id="delsure" value="1" />
    	 <input name="submitBtn" type="submit" class="btnType" id="submitBtn" value="送出" /></td>
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
mysql_free_result($RecMember);
?>
