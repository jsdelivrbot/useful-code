<?php require_once('../sstart.php'); ?>
<?php require_once('photo_process_about.php'); ?>
<?php require_once('file_process.php'); ?>
<?php


if(!in_array(2,$_SESSION['MM_Limit']['a2'])){
	header("Location: indexSet_list.php");
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
$menu_is="indexSet";
$_SESSION['nowMenu']= "indexSet";
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
            <td width="30%" class="list_title">新增首頁設定</td>
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
   			<td><table width="100%" border="0" cellspacing="3" cellpadding="5">

            	

              <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">英文標題1</td>
                  <td>
                  <input name="d_title_en" type="text" class="table_data" id="d_title_en" value="" size="70" />
                  </td>
                <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
              </tr>

              <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">標題1</td>
          	    	<td><input name="d_title" type="text" class="table_data" id="d_title" value="" size="70" />
          	    	  <input name="d_class1" type="hidden" id="d_class1" value="indexSet" /></td>
        	    	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	    	</tr>

              <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">英文標題2</td>
                  <td>
                  <input name="d_data1" type="text" class="table_data" id="d_data1" value="" size="70" />
                  </td>
                <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
              </tr>

              <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">標題2</td>
                  <td>
                  <input name="d_data2" type="text" class="table_data" id="d_data2" value="" size="70" />
                  </td>
                <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
              </tr>

            	<tr>
            	  <td align="center" bgcolor="#e5ecf6" class="table_col_title">youtube code</td>
            	  <td>
                <input name="d_content" type="text" class="table_data" id="d_content" value="" size="70" />
                </td>
            	  <td bgcolor="#e5ecf6"><span class="note_letter">*請先自行將影片上傳至 youtube後，<br>再將影片碼輸入於左方文字欄位。<br>
例如，影片網址為：<br>https://www.youtube.com/watch?v=_jJNocrL_as&feature=youtu.be，<br>網址watch?v=後面則為影片碼( <b>_jJNocrL_as</b> )。</span></td>
          	  </tr>
                <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">日期</td>
          	    	<td><input name="d_date" type="text" class="table_data" id="d_date" value="<?php echo date("Y-m-d H:i:s"); ?>" size="50"></td>
        	    	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>

                <?php if(0){ ?>
                <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">在網頁顯示</td>
          	    	<td><label>
          	        <select name="d_active" class="table_data" id="d_active">
          	          <option value="1">顯示</option>
          	          <option value="0">不顯示</option>
       	            </select></label></td>
          	     	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>

                
                <tr>
              		<td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳圖片</p>              	    </td>
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
                  </table></td>  
              	    <td bgcolor="#e5ecf6" class="table_col_title"><p class="red_letter">*<?php echo $imagesSize[$_SESSION['nowMenu']]['note'];?>若超過可分批上傳。</p>
                   	    
              	    </p>           	        </td>
                </tr>
                <?php } ?>
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
	
  $insertSQL = sprintf("INSERT INTO data_set (d_title, d_title_en, d_content, d_data1, d_data2, d_class1, d_class2, d_date, d_active) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, 1)",
                       GetSQLValueString($_POST['d_title'], "text"),
                       GetSQLValueString($_POST['d_title_en'], "text"),
                       GetSQLValueString($_POST['d_content'], "text"),
                       GetSQLValueString($_POST['d_data1'], "text"),
                       GetSQLValueString($_POST['d_data2'], "text"),
                       GetSQLValueString($_POST['d_class1'], "text"),
                       GetSQLValueString($_POST['d_class2'], "text"),
                       GetSQLValueString($_POST['d_date'], "date"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());

  $new_data_num = mysql_insert_id();//找到d_id的最大值
  
		//----------插入圖片資料到資料庫begin(須放入插入主資料後)----------
				//echo image_process();
				
		//$image_result=image_process("indexSet","add", "0", "0");
		$image_result=image_process($_FILES['image'], $_REQUEST['image_title'], "indexSet","add", $imagesSize[$_SESSION['nowMenu']]['IW'], $imagesSize[$_SESSION['nowMenu']]['IH']);
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
	
	    //----------插入檔案資料到資料庫begin(須放入插入主資料後)----------
   			//echo file_process();
			
		$file_result=file_process("indexSet","add");
	
		//echo count($file_result);
		
		
		for($j=0;$j<count($file_result);$j++)
		{
			  $insertSQL = sprintf("INSERT INTO file_set (file_name, file_link1, file_type, file_d_id, file_title) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($file_result[$j][0], "text"),
                       GetSQLValueString($file_result[$j][1], "text"),
                       GetSQLValueString("file", "text"),
                       GetSQLValueString($new_data_num, "int"),
                       GetSQLValueString($file_result[$j][2], "text"));

  			  mysql_select_db($database_connect2data, $connect2data);
  			  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
		}
		
	
	
	//----------插入檔案資料到資料庫end----------


  mysql_select_db($database_connect2data, $connect2data);
  $query_RecIndexSet = "SELECT * FROM data_set WHERE d_class1 = 'indexSet' ORDER BY d_sort ASC, d_date DESC";
  $RecIndexSet = mysql_query($query_RecIndexSet, $connect2data) or die(mysql_error());
  $totalRows = mysql_num_rows($RecIndexSet);

  $_SESSION['totalRows'] = $totalRows;
	
  $insertGoTo = "indexSet_list.php?pageNum_RecIndexSet=0&totalRows_RecIndexSet=".$_SESSION['totalRows']."&changeSort=1&now_d_id=".$new_data_num."&change_num=1";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  
  if($image_result[0][0]==1)
  {
  		echo "<script type=\"text/javascript\">call_alert('".$insertGoTo."');</script>";
  }else
  {
  		header(sprintf("Location: %s", $insertGoTo));
  }
  
}
?>

