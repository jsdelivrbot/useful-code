<?php require_once('../sstart.php'); ?>
<?php require_once('../Connections/connect2data.php'); ?>
<?php require_once('photo_process_about.php'); ?>
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

if(!in_array(2,$_SESSION['MM_Limit']['a4'])){
	header("Location: awardT_list.php");
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$menu_is="about";
$_SESSION['nowMenu']= "award";
?>
<?php require_once('imagesSize.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php require_once('cmsTitle.php'); ?></title>
<?php require_once('script.php'); ?>
<!-- InstanceBeginEditable name="doctitle" -->
<title>無標題文件</title>

<script type="text/javascript">
<!--
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
//}

//-->
</script>

<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->

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
            <td width="30%" class="list_title">新增四大獎項</td>
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
            <table width="100%" border="0" cellspacing="3" cellpadding="5">

            	<tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">名稱</td>
          	    	<td ><input name="name" type="text" class="table_data" id="name" size="50">
          	    	  <input name="c_parent" type="hidden" id="c_parent" value="awardT" /></td>
        	    	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	    	</tr>

              <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">英文名稱</td>
                  <td ><input name="name_en" type="text" class="table_data" id="name_en" size="50">
                  </td>
                <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
              </tr>

              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">內容</td>
                <td><textarea name="description" cols="100" rows="20" class="table_data tiny" id="description"></textarea></td>
                <td bgcolor="#e5ecf6"><p class="red_letter">*小斷行請按Shift+Enter。<br />
                  輸入區域的右下角可以調整輸入空間的大小。</p>
                  <!-- <p class="red_letter">*圖片請上傳寬不大於900 pixel 72dpi之圖檔。</p> --></td>
              </tr>

              <tr>
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳圖片</p>                    </td>
                    <td>
                    <table width="100%" border="0" cellpadding="2" cellspacing="2" bordercolor="#CCCCCC" class="data" id="pTable">
                      <tr>
                        <td> <span class="table_data">選擇圖片：</span>
                          <input name="image[]" type="file" class="table_data" id="image1" />
                          <br>
                          <span class="table_data">圖片說明：</span>
                          <input name="image_title[]" type="text" class="table_data" id="image_title1">                         </td>
                      </tr>
                    </table>
                    
                    <table width="100%" border="0" cellspacing="5" cellpadding="2" id="addF">
                      <tr>
                          <td height="28">
                          <table border="0" cellspacing="2" cellpadding="2">
                            <tr>
                                <td><a href="javascript:addField()"><img src="image/add.png" width="16" height="16" border="0"></a></td>
                                  <td><a href="javascript:addField()" class="table_data">新增圖片</a></td>
                                  <td class="note_letter">&nbsp;</td>
                              </tr>
                          </table>                          </td>
                        </tr>
                  </table>  
                    
                              </td>  
                    <td bgcolor="#e5ecf6" class="table_col_title">
                    <p class="red_letter">*<?php echo $imagesSize[$_SESSION['nowMenu']]['note'];?></p>
                    </td>
              </tr>

                <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">狀態</td>
          	    	<td ><label>
          	        <select name="term_active" class="table_data" id="term_active">
          	        	<option value="1">公佈</option>
          	        	<option value="0">不公佈</option>
       	            </select></label></td>
          	     	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
                
			</table>
            </td>
		</tr>
        <tr>
        	<td>&nbsp;</td>
        </tr>
        <tr>
         	<td align="center"><input name="submitBtn" type="submit" class="btnType" id="submitBtn" value="送出" /></td>
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

  $name = checkV('name');
  $slug = ($name!=NULL) ? urlencode($name) : NULL;
  $name_en = checkV('name_en');
  $term_active = checkV('term_active');
  $description = checkV('description');
  
  $insertSQL = sprintf("INSERT INTO terms (name, name_en, slug, term_active) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($name, "text"),
                       GetSQLValueString($name_en, "text"),
                       GetSQLValueString($slug, "text"),
                       GetSQLValueString($term_active, "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
	
	//找到term_id的最大值
	$new_data_num = mysql_insert_id();
	
	$insertSQL = sprintf("INSERT INTO term_taxonomy (term_id, description, taxonomy) VALUES (%s, %s, %s)",
                       GetSQLValueString($new_data_num, "int"),
                       GetSQLValueString($description, "text"),
                       GetSQLValueString('awardT', "text"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());


//----------插入圖片資料到資料庫begin(須放入插入主資料後)----------
  $image_result=image_process($_FILES['image'], $_REQUEST['image_title'], "award","add", $imagesSize[$_SESSION['nowMenu']]['IW'], $imagesSize[$_SESSION['nowMenu']]['IH']);
    //echo count($image_result);
    //echo $image_result[0][0];
    
    
    for($j=1;$j<count($image_result);$j++)
    {
        $insertSQL = sprintf("INSERT INTO file_set (file_name, file_link1, file_link2, file_link3, file_type, file_d_id, file_title, file_show_type) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($image_result[$j][0], "text"),
                       GetSQLValueString($image_result[$j][1], "text"),
                       GetSQLValueString($image_result[$j][2], "text"),
                       GetSQLValueString($image_result[$j][3], "text"),
                       GetSQLValueString("imageT", "text"),
                       GetSQLValueString($new_data_num, "int"),
                       GetSQLValueString($image_result[$j][4], "text"),
                       GetSQLValueString($image_result[$j][5], "int"));

          mysql_select_db($database_connect2data, $connect2data);
          $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
        $_SESSION["change_image"]=1;
    }
    
  
  
  //----------插入圖片資料到資料庫end----------

  mysql_select_db($database_connect2data, $connect2data);
  $query_RecAwardT = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='awardT' ORDER BY term_sort ASC, term_id DESC";
  $RecAwardT = mysql_query($query_RecAwardT, $connect2data) or die(mysql_error());
  $totalRows_RecAwardT = mysql_num_rows($RecAwardT);

  $_SESSION['totalRows'] = $totalRows_RecAwardT;
	
   
  $insertGoTo = "awardT_list.php?pageNum=0&totalRows_RecAwardT=".$_SESSION['totalRows']."&changeSort=1&now_term_id=".$new_data_num."&change_num=1";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  
  
  header(sprintf("Location: %s", $insertGoTo));
  
  
}
?>

