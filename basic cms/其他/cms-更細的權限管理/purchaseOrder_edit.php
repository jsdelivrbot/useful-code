<?php require_once('../sstart.php'); ?>
<?php require_once('../Connections/connect2data.php'); ?>
<?php require_once('photo_process.php'); ?>
<?php require_once('file_process.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$colname_RecPurchaseOrder = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecPurchaseOrder = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecPurchaseOrder = sprintf("SELECT * FROM data_set WHERE d_id = %s", GetSQLValueString($colname_RecPurchaseOrder, "int"));
$RecPurchaseOrder = mysql_query($query_RecPurchaseOrder, $connect2data) or die(mysql_error());
$row_RecPurchaseOrder = mysql_fetch_assoc($RecPurchaseOrder);
$totalRows_RecPurchaseOrder = mysql_num_rows($RecPurchaseOrder);

$colname_RecFile = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecFile = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecFile = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'file'", GetSQLValueString($colname_RecFile, "int"));
$RecFile = mysql_query($query_RecFile, $connect2data) or die(mysql_error());
$row_RecFile = mysql_fetch_assoc($RecFile);
$totalRows_RecFile = mysql_num_rows($RecFile);

$menu_is="products";

//記錄帶資料去別地方的資訊
$_SESSION['nowPage']=$selfPage;
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
<title>無標題文件</title>
<script type="text/javascript" src="jquery/fancyapps-fancyBox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="jquery/fancyapps-fancyBox/source/jquery.fancybox.pack.js"></script>
<link rel="stylesheet" type="text/css" href="jquery/fancyapps-fancyBox/source/jquery.fancybox.css" media="screen" />

<script type="text/javascript">
<!--
function updateData(){
		//var content = $("#content").val().replace(/&/g, escape("&"));
		var d_id = $('#d_id').val();
		$.ajax({
		   	type: "POST",
			url: "data_save.php",
			data: $('#form1').serializeArray(),
		   	success: function(data){
						//nothing
						//alert(data);
					}
		 });
}
$(document).ready(function() {
	
	$("a[rel=group]").fancybox({
			autoSize	: true,
			openEffect	: 'elastic',
    		closeEffect	: 'elastic',
			 helpers : {
				overlay : {
					css : {
						'background' : 'rgba(0, 0, 0, 0.7)'
					}
				}
			}
	});
	$("a.fancyboxEdit").fancybox({
		type: 'ajax',		
		openEffect	: 'fade',
		closeEffect	: 'fade',
		autoSize	: true,
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
if( isset($_SESSION["change_image"]) && ($_SESSION["change_image"]==1) )
{
	$_SESSION["change_image"]=0;
	echo "window.location.reload();";
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
            <td width="30%" class="list_title">修改訂購單下載</td>
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
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">標題</td>
          	    	<td width="532" class="table_data"><?php echo $row_RecPurchaseOrder['d_title']; ?><input name="d_title" type="hidden" class="table_data" id="d_title" value="<?php echo $row_RecPurchaseOrder['d_title']; ?>" size="70" />
          	    	  <input name="d_id" type="hidden" id="d_id" value="<?php echo $row_RecPurchaseOrder['d_id']; ?>" />
                      <input name="file_id" type="hidden" id="file_id" value="<?php echo $row_RecFile['file_id']; ?>" />
                      </td>
        	    	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	    	</tr>
                <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">日期</td>
          	    	<td width="532"><input name="d_date" type="text" class="table_data" id="d_date" value="<?php echo ( ($row_RecPurchaseOrder['d_date']=='') || (!(strcmp("0000-00-00 00:00:00", $row_RecPurchaseOrder['d_date']))) ) ? date("Y-m-d H:i:s") : $row_RecPurchaseOrder['d_date']; ?>" size="50"></td>
        	    	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
                
                 <?php if ($totalRows_RecFile > 0) { // Show if recordset not empty ?>
                  <tr>
                    <td align="center" bgcolor="#e5ecf6" class="table_col_title">目前檔案</td>
                    <td><table border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td><table >
                                  <tr>
                                    <?php

$RecFile_endRow = 0;
$RecFile_columns = 1; // 
$RecFile_hloopRow1 = 0; // Ĥ@
do {
	//$numI++;
	//echo $numI;
    if($RecFile_endRow == 0  && $RecFile_hloopRow1++ != 0) echo "<tr>";
   ?>
                                    <td><table width="320" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" class="table_frame_style">
                                        <tr>
                                          <td align="left" class="table_no_border"><span class="table_data">&nbsp;檔案名稱: <a href="../<?php echo $row_RecFile['file_link1']; ?>" title='<?php echo $row_RecFile['file_title']; ?>' target="_blank"><?php echo $row_RecFile['file_name']; ?></a></span></td>
                                        </tr>
                                        <tr>
                                          <td align="left" class="table_no_border">
                                          <span class="table_data">&nbsp;檔案</span><span class="table_data">說明:</span>
                                          <span class="table_data"><a href="../<?php echo $row_RecFile['file_link1']; ?>" title='<?php echo $row_RecFile['file_title']; ?>' target="_blank"><?php echo $row_RecFile['file_title']; ?></a></span></td>
                                        </tr>
                                    </table></td>
                                    <?php  $RecFile_endRow++;
if($RecFile_endRow >= $RecFile_columns) {
  ?>
                                  </tr>
                                  <?php
 $RecFile_endRow = 0;
  }
} while ($row_RecFile = mysql_fetch_assoc($RecFile));
if($RecFile_endRow != 0) {
while ($RecFile_endRow < $RecFile_columns) {
    echo("<td>&nbsp;</td>");
    $RecFile_endRow++;
}
echo("</tr>");
}?></table></td>
                              </tr>
                                            </table></td>
                    <td bgcolor="#e5ecf6" class="table_col_title"><p>&nbsp;</p></td>
                  </tr>
                  <?php } // Show if recordset not empty ?>
                  
      		    <tr>
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳檔案</p></td>
      		      <td><table border="0" cellpadding="2" cellspacing="2" bordercolor="#CCCCCC" class="data" id="pTable2">
                      <tr>
                        <td><span class="table_data">選擇檔案：</span>
                            <input name="upfile[]" type="file" class="table_data" id="upfile1" />
                            <br />
                            <span class="table_data">檔案說明：</span>
                            <input name="upfile_title[]" type="text" class="table_data" id="upfile_title1" /></td>
                      </tr>
                    </table>
      		          </td>
      		      <td bgcolor="#e5ecf6" class="table_col_title">
                    <ul class="red_letter">
                    <li>若要更新訂購單，請直接於左方選擇要上傳之檔案，並填寫檔案說明，完成後點按下方【送出】即可。</li>
                    <li>每次上傳之檔案大小總計請勿超過<?php echo ini_get("upload_max_filesize"); ?>。</li>
                    </ul> </td>
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
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	
  $updateSQL = sprintf("UPDATE data_set SET d_title=%s, d_content=%s, d_class2=%s,d_date=%s, d_active=%s WHERE d_id=%s",
                       GetSQLValueString($_POST['d_title'], "text"),
                       GetSQLValueString($_POST['d_content'], "text"),
                       GetSQLValueString($_POST['d_class2'], "text"),
                       GetSQLValueString($_POST['d_date'], "date"),
                       GetSQLValueString($_POST['d_active'], "int"),
                       GetSQLValueString($_POST['d_id'], "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
	    //----------插入檔案資料到資料庫begin(須放入插入主資料後)----------
   			//echo file_process();
				
		
			$file_result=file_process("purchaseOrder","edit");
	
		//刪除真實檔案begin----
		if(count($file_result)==1)
		{
					$sql="SELECT file_link1 FROM file_set WHERE file_id='".$_POST['file_id']."'";
					$result = mysql_query($sql)or die("無法送出".mysql_error( ));
					while ( $row = mysql_fetch_array($result))
					{
						//echo $file_result[0][1]."<br>";
						//echo $row[0]."<BR>";
						if($file_result[0][1]==$row[0])
						{}
						else
						{
							if (file_exists("../".$row[0])) {
								unlink("../".$row[0]);//刪除檔案
							}
						}	
					}
					
		} 
		//刪除真實檔案end----
		
		for($j=0;$j<count($file_result);$j++)
		{
			  $insertSQL = sprintf("UPDATE file_set SET file_name=%s, file_link1=%s WHERE file_id=%s" ,
                       GetSQLValueString($file_result[$j][0], "text"),
                       GetSQLValueString($file_result[$j][1], "text"),
					   GetSQLValueString($_POST['file_id'], "int"));

  			  mysql_select_db($database_connect2data, $connect2data);
  			  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
		}
		
	
	
	//----------插入檔案資料到資料庫end----------

  $updateGoTo = "purchaseOrder_list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING']."&pageNum_RecPurchaseOrder=".$_SESSION["ToPage"];
  }
  
  
  if($image_result[0][0]==1)
  {
		echo "<script type=\"text/javascript\">call_alert('".$updateGoTo."');</script>";
  }else
  {
  		header(sprintf("Location: %s", $updateGoTo));
  }
}
?>
<?php
mysql_free_result($RecPurchaseOrder);
mysql_free_result($RecFile);
?>
