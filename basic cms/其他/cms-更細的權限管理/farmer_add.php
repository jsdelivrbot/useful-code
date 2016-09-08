<?php require_once('../sstart.php'); ?>
<?php require_once('../Connections/connect2data.php'); ?>
<?php require_once('photo_process_products.php'); ?>
<?php //require_once('photo_process_farmer.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

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

$selected_careers = '';
if(isset($_SESSION['selected_careers'])){
	$selected_careers = $_SESSION['selected_careers'];
}

$menu_is="farmer";
$_SESSION['nowMenu']= $menu_is;
?>
<?php require_once('imagesSize.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php require_once('cmsTitle.php'); ?></title>
<?php require_once('script.php'); ?>
<!-- InstanceBeginEditable name="doctitle" -->
<link rel="stylesheet" href="jquery/formValidator/css/validationEngine.jquery.css" type="text/css" media="screen" title="no title" charset="utf-8" />
<!--<link rel="stylesheet" href="jquery/formValidator/css/template.css" type="text/css" media="screen" title="no title" charset="utf-8" />-->
<!--<script type="text/javascript" src="jquery/jquery-1.4.4.min.js"></script>-->
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js" type="text/javascript"></script>-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.js" type="text/javascript"></script>-->
<script type="text/javascript" src="jquery/twzipcode-1.3.1.js"></script>
<script src="jquery/formValidator/js/jquery.validationEngine-zh.js" type="text/javascript"></script>
<script src="jquery/formValidator/js/jquery.validationEngine.js" type="text/javascript"></script>
<title>無標題文件</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<script type="text/javascript">
<!--
$(function(){
	
	
	$("#form1").validationEngine();
	
  $('#zip_container').twzipcode({
		countyName	:	'm_city',
		areaName	:	'm_canton',
		zipName		:	'm_zip',
		zipSel		:	'546',
		css			:	['input_data_county', 'input_data_county', 'input_data_zip']
  });
  
  $('#fzip_container').twzipcode({
		countyName	:	'm_fcity',
		areaName	:	'm_fcanton',
		zipName		:	'm_fzip',
		zipSel		:	'546',
		css			:	['input_data_county', 'input_data_county', 'input_data_zip']
  });
  		/*countyName: 指定縣市下拉清單名稱 (String) //若不指定則預設名稱為 zip_county[] 
		areaName: 指定鄉鎮市區下拉清單名稱 (String) // 若不指定則預設名稱為 zip_area[]
		zipName: 指定郵遞區號輸入框名稱 (String) // 若不指定則預設名稱為 zip_code[]
		countySel: 縣市預設值 (String)
		areaSel: 鄉鎮市區預設值 (String)
		zipSel: 郵遞區號預設值 (String)
		zipReadonly: 郵遞區號輸入框是否唯讀？ (Bool)
		css: ['County ClassName', 'Area ClassName', 'Zip ClassName'] (Array)*/
		
});

function validate2fields(){
			if($("#firstname").val() =="" ||  $("#lastname").val() == ""){
				return false;
			}else{
				return true;
			}
		}
		
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
          <td width="30%" class="list_title">新增農友資料</td>
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
                <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title" id="CompanyName">農友姓名</td>
                <td width="532"><input name="m_name" type="text" class="table_data" id="m_name" size="50"></td>
                <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
              </tr>
              
              <div class="inputData" >              </div>
              
              <tr>
                 <td align="center" bgcolor="#e5ecf6" class="table_col_title">農友登入帳號</td>
          	     <td>
                 <input name="m_account" type="text" class="validate[required,custom[noSpecialCaracters],length[6,20],ajax[ajaxUser]] text-input table_data"id="m_account" size="50"></td>
          	     <td bgcolor="#e5ecf6">&nbsp;</td>
      	      </tr>
              <tr>
                 <td align="center" bgcolor="#e5ecf6" class="table_col_title">農友登入密碼</td>
          	     <td><input name="m_password" type="text" class="table_data" id="m_password" size="50"></td>
        	     <td bgcolor="#e5ecf6">&nbsp;</td>
      	      </tr>
              <tr>
                 <td align="center" bgcolor="#e5ecf6" class="table_col_title">性別</td>
          	     <td><select name="m_gender" class="table_data" id="m_gender">
          	       <option value="1">先生</option>
          	       <option value="0">女士</option>
                                                   </select></td>
        	     <td bgcolor="#e5ecf6">&nbsp;</td>
      	      </tr>
              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">農友簡介</td>
                <td><textarea name="m_content" cols="50" rows="10" class="table_data tiny" id="m_content"></textarea></td>
                <td bgcolor="#e5ecf6">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">綠生生產履歷編號</td>
                <td><input name="m_sn" type="text" class="table_data" id="m_sn" size="50"></td>
                <td bgcolor="#e5ecf6">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">產銷班或農場名稱</td>
                <td><input name="m_fname" type="text" class="table_data" id="m_fname" size="50" /></td>
                <td bgcolor="#e5ecf6">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">聯絡電話</td>
                <td><input name="m_phone" type="text" class="table_data" id="m_phone" size="50" /></td>
                <td bgcolor="#e5ecf6">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">行動電話</td>
                <td><input name="m_cellphone" type="text" class="table_data" id="m_cellphone" size="50" /></td>
                <td bgcolor="#e5ecf6">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">電子信箱</td>
                <td><input name="m_email" type="text" class="table_data" id="m_email" size="50"></td>
                <td bgcolor="#e5ecf6">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">主要生產項目</td>
                <td><input name="m_item" type="text" class="table_data" id="m_item" size="50" /></td>
                <td bgcolor="#e5ecf6">&nbsp;</td>
              </tr>
              <tr>
                 <td align="center" bgcolor="#e5ecf6" class="table_col_title">農地位置</td>
          	     <td><div id="fzip_container"></div></td>
        	     <td bgcolor="#e5ecf6">&nbsp;</td>
      	      </tr>
              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">&nbsp;</td>
                <td><input name="m_faddress" type="text" class="table_data" id="m_faddress" size="50" /></td>
                <td bgcolor="#e5ecf6">&nbsp;</td>
              </tr>
              
              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">地址</td>
                <td class="table_data"><div id="zip_container"></div></td>
                <td bgcolor="#e5ecf6">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">&nbsp;</td>
                <td><input name="m_address" type="text" class="table_data" id="m_address" size="50" /></td>
                <td bgcolor="#e5ecf6">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">栽培總面積</td>
                <td><input name="m_area" type="text" class="table_data" id="m_area" size="50" /></td>
                <td bgcolor="#e5ecf6">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">google map cade</td>
                <td><textarea name="m_map" cols="80" rows="10" class="table_data" id="m_map"></textarea></td>
                <td bgcolor="#e5ecf6">&nbsp;</td>
              </tr>
              <tr>
              		<td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳個人照片</p></td>
              	    <td>
                    <table width="100%" border="0" cellpadding="2" cellspacing="2" bordercolor="#CCCCCC" class="data">
                    	<tr>
                     		<td> <span class="table_data">選擇圖片：</span>
                        	<input name="imageP[]" type="file" class="table_data" id="imageP1" />
                        	<br>
                        	<span class="table_data">圖片說明：</span>
                        	<input name="image_titleP[]" type="text" class="table_data" id="image_titleP1">                        	</td>
                  		</tr>
                    </table>
                    
                    </td>  
              	    <td bgcolor="#e5ecf6" class="table_col_title"><p class="red_letter">*<?php echo $imagesSize[$_SESSION['nowMenu']]['note'];?></p></td>
                </tr>
              <tr>
              		<td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳其它圖片</p></td>
              	    <td>
                    <table width="100%" border="0" cellpadding="2" cellspacing="2" bordercolor="#CCCCCC" class="data" id="pTable">
                    	<tr>
                     		<td> <span class="table_data">選擇圖片：</span>
                        	<input name="image[]" type="file" class="table_data" id="image1" />
                        	<br>
                        	<span class="table_data">圖片說明：</span>
                        	<input name="image_title[]" type="text" class="table_data" id="image_title1">                        	</td>
                  		</tr>
                    </table>
                    <table width="100%" border="0" cellspacing="5" cellpadding="2">
                    	<tr>
                        	<td height="28">
                        	<table border="0" cellspacing="2" cellpadding="2">
                        		<tr>
                            		<td><a href="javascript:addField()"><img src="image/add.png" width="16" height="16" border="0"></a></td>
                                	<td><a href="javascript:addField()" class="table_data">新增圖片</a></td>
                                	<td class="red_letter">&nbsp;</td>
                            	</tr>
                        	</table>                        	</td>
                        </tr>
                    </table>
                    
                    </td>  
              	    <td bgcolor="#e5ecf6" class="table_col_title"><p class="red_letter">*<?php echo $imagesSize[$_SESSION['nowMenu']]['note'];?>若超過可分批上傳。</p></td>
                </tr>
              <tr>
                 <td align="center" bgcolor="#e5ecf6" class="table_col_title">加入時間</td>
          	     <td><input name="m_date" type="text" class="table_data" id="m_date" value="<?php echo date("Y-m-d H:i:s"); ?>" size="50"></td>
        	     <td bgcolor="#e5ecf6">&nbsp;</td>
      	      </tr>
              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">狀態</td>
                <td><label>
                  <select name="m_active" class="table_data" id="m_active">
                    <option value="1">可使用</option>
                    <option value="0">不可使用</option>
                    </select>
                  </label></td>
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
    	 <input name="submitBtn" type="submit" class="btnType" id="submitBtn" value="送出" /></td>
         </tr>
        </table>
      <input type="hidden" name="MM_insert" value="form1" />
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
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	
  $insertSQL = sprintf("INSERT INTO member_set (m_class2, m_name, m_account, m_password, m_gender, m_content, m_sn, m_fname, m_phone, m_cellphone, m_email, m_item, m_faddress, m_fzip, m_fcity, m_fcanton, m_address, m_zip, m_city, m_canton, m_area, m_map, m_level, m_active, m_date) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString('farmer', "text"),
                       GetSQLValueString($_POST['m_name'], "text"),
                       GetSQLValueString($_POST['m_account'], "text"),
                       GetSQLValueString($_POST['m_password'], "text"),
                       GetSQLValueString($_POST['m_gender'], "text"),
                       GetSQLValueString($_POST['m_content'], "text"),
                       GetSQLValueString($_POST['m_sn'], "text"),
                       GetSQLValueString($_POST['m_fname'], "text"),
                       GetSQLValueString($_POST['m_phone'], "text"),
                       GetSQLValueString($_POST['m_cellphone'], "text"),
                       GetSQLValueString($_POST['m_email'], "text"),
                       GetSQLValueString($_POST['m_item'], "text"),
                       GetSQLValueString($_POST['m_faddress'], "text"),
					   GetSQLValueString($_POST['m_fzip'], "int"),
					   GetSQLValueString($_POST['m_fcity'], "text"),
					   GetSQLValueString($_POST['m_fcanton'], "text"),
                       GetSQLValueString($_POST['m_address'], "text"),
					   GetSQLValueString($_POST['m_zip'], "int"),
					   GetSQLValueString($_POST['m_city'], "text"),
					   GetSQLValueString($_POST['m_canton'], "text"),
                       GetSQLValueString($_POST['m_area'], "text"),
                       GetSQLValueString($_POST['m_map'], "text"),
                       GetSQLValueString('1', "text"),
                       GetSQLValueString($_POST['m_active'], "text"),
                       GetSQLValueString($_POST['m_date'], "date"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
	
	//----------插入圖片資料到資料庫begin(須放入插入主資料後)----------
   			//echo image_process();
	
			$sql_max_data= "Select MAX(m_id) From member_set";//找到d_id的最大值,放入圖片資料內
			//echo $sql_max_data;
			$result_max_data=mysql_query($sql_max_data);
			
			if($row_max_data = mysql_fetch_array($result_max_data))
			{	
			
				$new_data_num=$row_max_data[0];
		
				//echo $row_max_data[0];
			}
			
	//個人附圖	
		$image_result=image_process($_FILES['imageP'], $_REQUEST['image_titleP'], $menu_is,"add", $imagesSize[$_SESSION['nowMenu']]['IW'], $imagesSize[$_SESSION['nowMenu']]['IH']);
			//echo count($image_result);
			//echo $image_result[0][0];
			
			
			for($j=1;$j<count($image_result);$j++)
			{						   
				$insertSQL = sprintf("INSERT INTO file_set (file_name, file_link1, file_link2, file_link3, file_type, file_d_id, file_title, file_show_type) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($image_result[$j][0], "text"),
                       GetSQLValueString($image_result[$j][1], "text"),
                       GetSQLValueString($image_result[$j][2], "text"),
                       GetSQLValueString($image_result[$j][3], "text"),
                       GetSQLValueString("imageP", "text"),
                       GetSQLValueString($new_data_num, "int"),
                       GetSQLValueString($image_result[$j][4], "text"),
                       GetSQLValueString($image_result[$j][5], "int"));
	
				  mysql_select_db($database_connect2data, $connect2data);
				  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
				  
				  $_SESSION["change_image"]=1;
			}
			
		//其它附圖	
		$image_result=image_process($_FILES['image'], $_REQUEST['image_title'], $menu_is,"add", $imagesSize[$_SESSION['nowMenu']]['IW'], $imagesSize[$_SESSION['nowMenu']]['IH']);
			//echo count($image_result);
			//echo $image_result[0][0];
			
			
			for($j=1;$j<count($image_result);$j++)
			{						   
				$insertSQL = sprintf("INSERT INTO file_set (file_name, file_link1, file_link2, file_link3, file_type, file_d_id, file_title, file_show_type) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($image_result[$j][0], "text"),
                       GetSQLValueString($image_result[$j][1], "text"),
                       GetSQLValueString($image_result[$j][2], "text"),
                       GetSQLValueString($image_result[$j][3], "text"),
                       GetSQLValueString("image", "text"),
                       GetSQLValueString($new_data_num, "int"),
                       GetSQLValueString($image_result[$j][4], "text"),
                       GetSQLValueString($image_result[$j][5], "int"));
	
				  mysql_select_db($database_connect2data, $connect2data);
				  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
				  
				  $_SESSION["change_image"]=1;
			}
		
	
	
	//----------插入圖片資料到資料庫end----------

  $insertGoTo = "farmer_list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>