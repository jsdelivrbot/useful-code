<?php
			if (!isset($_SESSION)) {
               session_start();
               }
            ob_start();
?>
<?php require_once('../Connections/connect2data.php'); ?>
<?php //require_once('photo_process_member.php'); ?>
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

if(!in_array(5,$_SESSION['MM_Limit']['a5'])){
	header("Location: member_list.php");
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE member_set SET m_name=%s, m_class2=%s, m_class3=%s,  m_gender=%s, m_birthyear=%s, m_birthmonth=%s, m_birthday=%s, m_email=%s, m_phone=%s, m_cellphone=%s, m_zip=%s, m_city=%s, m_canton=%s, m_address=%s, m_epaper=%s, m_level=%s, m_active=%s, m_date=%s WHERE m_id=%s",
                       GetSQLValueString($_POST['m_name'], "text"),
                       GetSQLValueString($_POST['m_class2'], "text"),
                       GetSQLValueString($_POST['m_class3'], "text"),
                       GetSQLValueString($_POST['m_gender'], "text"),
					   GetSQLValueString($_POST['m_birthyear'], "text"),
					   GetSQLValueString($_POST['m_birthmonth'], "text"),
                       GetSQLValueString($_POST['m_birthday'], "text"),
                       GetSQLValueString($_POST['m_email'], "text"),
                       GetSQLValueString($_POST['m_phone'], "text"),
                       GetSQLValueString($_POST['m_cellphone'], "text"),
					   GetSQLValueString($_POST['m_zip'], "int"),
					   GetSQLValueString($_POST['m_city'], "text"),
					   GetSQLValueString($_POST['m_canton'], "text"),
                       GetSQLValueString($_POST['m_address'], "text"),
                       GetSQLValueString($_POST['m_epaper'], "int"),
                       GetSQLValueString($_POST['m_level'], "text"),
                       GetSQLValueString($_POST['m_active'], "text"),
                       GetSQLValueString($_POST['m_date'], "date"),
                       GetSQLValueString($_POST['m_id'], "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
	
	/*//----------插入圖片資料到資料庫begin(須放入插入主資料後)----------
   			//echo image_process();
				
	$image_result=image_process("member","add", "0", "0");
	
		//echo count($image_result);
		//echo $image_result[0][0];
		
		
		
		for($j=1;$j<count($image_result);$j++)
		{
			  $insertSQL = sprintf("INSERT INTO file_set (file_name, file_link1, file_link2, file_title, file_type, file_d_id) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($image_result[$j][0], "text"),
                       GetSQLValueString($image_result[$j][1], "text"),
                       GetSQLValueString($image_result[$j][2], "text"),
                       GetSQLValueString($image_result[$j][3], "text"),
                       GetSQLValueString("image", "text"),
                       GetSQLValueString($_POST['m_id'], "int"));

  			  mysql_select_db($database_connect2data, $connect2data);
  			  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
			  
			  $_SESSION["change_image"]=1;
		}
		
	//----------插入圖片資料到資料庫end----------*/
	
  $updateGoTo = "member_list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
	 $updateGoTo .= $_SERVER['QUERY_STRING']."&pageNum_RecMember=".$_SESSION["ToPage"];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_RecMember = "-1";
if (isset($_GET['m_id'])) {
  $colname_RecMember = $_GET['m_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecMember = sprintf("SELECT * FROM member_set WHERE m_id = %s", GetSQLValueString($colname_RecMember, "int"));
$RecMember = mysql_query($query_RecMember, $connect2data) or die(mysql_error());
$row_RecMember = mysql_fetch_assoc($RecMember);
$totalRows_RecMember = mysql_num_rows($RecMember);

$colname_RecImage = "-1";
if (isset($_GET['m_id'])) {
  $colname_RecImage = $_GET['m_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecImage = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'image'", GetSQLValueString($colname_RecImage, "int"));
$RecImage = mysql_query($query_RecImage, $connect2data) or die(mysql_error());
$row_RecImage = mysql_fetch_assoc($RecImage);
$totalRows_RecImage = mysql_num_rows($RecImage);

mysql_select_db($database_connect2data, $connect2data);
$query_RecClass2 = "SELECT * FROM class_set WHERE c_parent = 'careersC' AND c_active='1' ORDER BY c_sort ASC, c_id DESC";
$RecClass2 = mysql_query($query_RecClass2, $connect2data) or die(mysql_error());
$row_RecClass2 = mysql_fetch_assoc($RecClass2);
$totalRows_RecClass2 = mysql_num_rows($RecClass2);

mysql_select_db($database_connect2data, $connect2data);
$query_RecClass3 = "SELECT * FROM class_set WHERE c_parent = 'jobTitleC' AND c_active='1' ORDER BY c_sort ASC, c_id DESC";
$RecClass3 = mysql_query($query_RecClass3, $connect2data) or die(mysql_error());
$row_RecClass3 = mysql_fetch_assoc($RecClass3);
$totalRows_RecClass3 = mysql_num_rows($RecClass3);

 $menu_is="member";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php require_once('cmsTitle.php'); ?></title>
<?php require_once('script.php'); ?>
<!-- InstanceBeginEditable name="doctitle" -->
<!--<script type="text/javascript" src="jquery/jquery-1.4.3.min.js"></script>-->
<!--<script type="text/javascript" src="jquery/twzipcode-1.3.1.js"></script>
--><script type="text/javascript" src="../js/jQuery-TWzipcode/jquery.twzipcode.min.js"></script>
<script type="text/javascript" src="jquery/fancyapps-fancyBox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="jquery/fancyapps-fancyBox/source/jquery.fancybox.pack.js"></script>
<link rel="stylesheet" type="text/css" href="jquery/fancyapps-fancyBox/source/jquery.fancybox.css" media="screen" />
<title>無標題文件</title>
<script type="text/javascript">
<!--
$(function(){
 /* $('#zip_container').twzipcode({
		countyName	:	'm_city',
		areaName	:	'm_canton',
		zipName		:	'm_zip',
		zipSel		:	'<?php echo $row_RecMember['m_zip']; ?>',
		css			:	['input_data_county', 'input_data_county', 'input_data_zip']
  });*/
  
  $('#twzipcode').twzipcode({
		readonly: true,
		'countyName' :'m_city',
		'districtName' : 'm_canton',
		'zipcodeName' : 'm_zip'
	});
  		/*countyName: 指定縣市下拉清單名稱 (String) //若不指定則預設名稱為 zip_county[] 
		areaName: 指定鄉鎮市區下拉清單名稱 (String) // 若不指定則預設名稱為 zip_area[]
		zipName: 指定郵遞區號輸入框名稱 (String) // 若不指定則預設名稱為 zip_code[]
		countySel: 縣市預設值 (String)
		areaSel: 鄉鎮市區預設值 (String)
		zipSel: 郵遞區號預設值 (String)
		zipReadonly: 郵遞區號輸入框是否唯讀？ (Bool)
		css: ['County ClassName', 'Area ClassName', 'Zip ClassName'] (Array)*/
	
			
	$("#imgB").fancybox({
		type: 'ajax',		
		openEffect	: 'fade',
		closeEffect	: 'fade',
		autoSize	: false,
		 helpers : {
			overlay : {
				css : {
					'background' : 'rgba(0, 0, 0, 0.7)'
				}
			}
		},
		beforeShow	: function() {
			updateData();
		}
	});
});



		<?php
		if(isset($_SESSION["change_image"])){
			if($_SESSION["change_image"]==1)
			{
				$_SESSION["change_image"]=0;
				echo "window.location.reload();";
			}
		}
		?>
		
		function call_alert(link_url) {
			
			alert("上傳得檔案中，有的不是圖片!");
			window.location=link_url;
			
		}
		
		function addField() {
			var pTable=document.getElementById('pTable');
			var lastRow = pTable.rows.length;
			//alert(pTable.rows.length);
			var myField=document.getElementById('image'+lastRow);
			//alert('image'+lastRow);
			if(myField.value){
				var aTr=pTable.insertRow(lastRow);
				var newRow = lastRow+1;
				var newImg='img'+(newRow);
				var aTd1=aTr.insertCell(0);
				aTd1.innerHTML = '<span class="table_data">選擇圖片： </span><input name="image[]" type="file" class="table_data" id="image'+newRow+'"><br><span class="table_data">圖片說明： </span><input name="image_title[]" type="text" class="table_data" id="image_title'+newRow+'">';
			}else{
				alert("尚有未選取之圖片欄位!!");
			}
		}
		
		function addField2() {
		var pTable2=document.getElementById('pTable2');
		var lastRow = pTable2.rows.length;
		//alert(pTable2.rows.length);
		var myField=document.getElementById('upfile'+lastRow);
		//alert('upfile'+lastRow);
		if(myField.value){
			var aTr=pTable2.insertRow(lastRow);
			var newRow = lastRow+1;
			var newFile='file'+(newRow);
			var aTd1=aTr.insertCell(0);
			aTd1.innerHTML = '<span class="table_data">選擇檔案： </span><input name="upfile[]" type="file" class="table_data" id="upfile'+newRow+'"><br><span class="table_data">檔案說明： </span><input name="upfile_title[]" type="text" class="table_data" id="upfile_title'+newRow+'">';
		}else{
			alert("尚有未選取之檔案欄位!!");
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
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="30%" class="list_title">修改會員資料</td>
          <td width="70%">&nbsp;</td>
        </tr>
      </table>
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="image/spacer.gif" width="1" height="1"></td>
        </tr>
      </table>
      
      <form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1" id="form1">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
  		<tr>
   		 	<td>
            <table width="100%" border="0" cellpadding="5" cellspacing="3">
                  <tr>
                 <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">會員姓名</td>
          	     <td width="532"><input name="m_name" type="text" class="table_data" id="m_name" value="<?php echo $row_RecMember['m_name']; ?>" size="50">
          	       <input name="m_id" type="hidden" class="table_data" id="m_id" value="<?php echo $row_RecMember['m_id']; ?>" /></td>
        	     <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      </tr>
              <?php if($row_RecMember['m_class2']=='1'){ ?>
              <?php } ?>
              <tr>
                 <td align="center" bgcolor="#e5ecf6" class="table_col_title">會員登入帳號</td>
          	     <td class="table_data"><?php echo $row_RecMember['m_account']; ?></td>
        	     <td bgcolor="#e5ecf6">&nbsp;</td>
      	      </tr>
              <!--<tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">會員登入密碼</td>
                <td><input name="m_password" type="text" class="table_data" id="m_password" value="<?php echo $row_RecMember['m_password']; ?>" size="50" /></td>
                <td bgcolor="#e5ecf6">&nbsp;</td>
              </tr>-->
              <tr>
                 <td align="center" bgcolor="#e5ecf6" class="table_col_title">性別</td>
          	     <td><select name="m_gender" class="table_data" id="m_gender">
<option value="1" <?php if (!(strcmp(1, $row_RecMember['m_gender']))) {echo "selected=\"selected\"";} ?>>先生</option><option value="0" <?php if (!(strcmp(0, $row_RecMember['m_gender']))) {echo "selected=\"selected\"";} ?>>女士</option>
                                  </select></td>
        	     <td bgcolor="#e5ecf6">&nbsp;</td>
      	      </tr>
              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">電子信箱</td>
                <td><input name="m_email" type="text" class="table_data" id="m_email" value="<?php echo $row_RecMember['m_email']; ?>" size="50"></td>
                <td bgcolor="#e5ecf6">&nbsp;</td>
              </tr>
              <tr>
                 <td align="center" bgcolor="#e5ecf6" class="table_col_title">連絡電話</td>
          	     <td><input name="m_phone" type="text" class="table_data" id="m_phone" value="<?php echo $row_RecMember['m_phone']; ?>" size="50"></td>
        	     <td bgcolor="#e5ecf6">&nbsp;</td>
      	      </tr>
              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">地址</td>
                <td>
                
                <div id="twzipcode">
                  <div data-role="zipcode" data-style="textcss" data-value="<?php if (isset($row_RecMember['m_zip'])){ echo $row_RecMember['m_zip'];}else{echo '110';} ?>"></div>
                  <div data-role="county" data-style="county" data-value=""></div>
                  <div data-role="district" data-style="" data-value=""></div>
                </div>

</td>
                <td bgcolor="#e5ecf6">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">&nbsp;</td>
                <td><input name="m_address" type="text" class="table_data" id="m_address" value="<?php echo $row_RecMember['m_address']; ?>" size="50" /></td>
                <td bgcolor="#e5ecf6">&nbsp;</td>
              </tr>
              <tr>
                 <td align="center" bgcolor="#e5ecf6" class="table_col_title">加入時間</td>
          	     <td><input name="m_date" type="text" class="table_data" id="m_date" value="<?php echo $row_RecMember['m_date']; ?>" size="50"></td>
        	     <td bgcolor="#e5ecf6">&nbsp;</td>
      	      </tr>
              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">狀態</td>
                <td><label>
                  <select name="m_active" class="table_data" id="m_active">
                    <?php  if($row_RecMember['m_active']!="0" && $row_RecMember['m_active']!="1"){ ?>
                    <option value="<?php echo $row_RecMember['active']; ?>" selected="selected">未驗證</option>
                    <?php }else{ ?>
                    <option value="0" <?php if (!(strcmp(0, $row_RecMember['m_active']))) {echo "selected=\"selected\"";} ?>>不可使用</option>
                    <option value="1" <?php if (!(strcmp(1, $row_RecMember['m_active']))) {echo "selected=\"selected\"";} ?>>可使用</option>
                    <?php } ?>
                    </select>
                  </label></td>
                <td bgcolor="#e5ecf6">&nbsp;</td>
              </tr>
              
				<?php 
				//if($totalRows_RecImage==0){
					if(0){
					?>
                 <?php } ?>
             </table>
            </td>
         </tr>
         <tr>
           <td>&nbsp;</td>
         </tr>
         <tr>
         <td align="center">
    	 <input name="submitBtn" type="submit" class="btnType" id="submitBtn" value="送出" /></td>
         </tr>
        </table>
      <input type="hidden" name="MM_update" value="form1" />
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
