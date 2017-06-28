<?php require_once('../sstart.php'); ?>
<?php require_once('../Connections/connect2data.php'); ?>
<?php require_once('photo_process_banners.php'); ?>
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

if(!in_array(5,$_SESSION['MM_Limit']['a3'])){
	header("Location: main_list.php");
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$colname_RecMain = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecMain = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecMain = sprintf("SELECT * FROM data_set WHERE d_id = %s", GetSQLValueString($colname_RecMain, "int"));
$RecMain = mysql_query($query_RecMain, $connect2data) or die(mysql_error());
$row_RecMain = mysql_fetch_assoc($RecMain);
$totalRows = mysql_num_rows($RecMain);

if($totalRows==0){
  header("Location: main_list.php");
}

$colname_RecImage = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecImage = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecImage = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'image'", GetSQLValueString($colname_RecImage, "int"));
$RecImage = mysql_query($query_RecImage, $connect2data) or die(mysql_error());
$row_RecImage = mysql_fetch_assoc($RecImage);
$totalRows_RecImage = mysql_num_rows($RecImage);

$colname_RecImageMobile = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecImageMobile = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecImageMobile = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'imageMobile'", GetSQLValueString($colname_RecImageMobile, "int"));
$RecImageMobile = mysql_query($query_RecImageMobile, $connect2data) or die(mysql_error());
$row_RecImageMobile = mysql_fetch_assoc($RecImageMobile);
$totalRows_RecImageMobile = mysql_num_rows($RecImageMobile);

$colname_RecFile = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecFile = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecFile = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'file'", GetSQLValueString($colname_RecFile, "int"));
$RecFile = mysql_query($query_RecFile, $connect2data) or die(mysql_error());
$row_RecFile = mysql_fetch_assoc($RecFile);
$totalRows_RecFile = mysql_num_rows($RecFile);

$menu_is="main";

//記錄帶資料去別地方的資訊
$_SESSION['nowPage']= $selfPage;
$_SESSION['nowMenu']= $menu_is;

$ifFile = 0;
?>
<?php require_once('imagesSize.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php require_once('cmsTitle.php'); ?></title>
<?php require_once('script.php'); ?>
<!-- InstanceBeginEditable name="doctitle" -->
<script type="text/javascript" src="jquery/fancyapps-fancyBox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="jquery/fancyapps-fancyBox/source/jquery.fancybox.pack.js"></script>
<link rel="stylesheet" type="text/css" href="jquery/fancyapps-fancyBox/source/jquery.fancybox.css" media="screen" />

<title>無標題文件</title>
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
	
	//$("a.fancyboxEdit").click(updateData);
	
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
            <td width="30%" class="list_title">修改主頁Banner</td>
            <td width="70%">&nbsp;</td>
        </tr>
	</table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td><img src="image/spacer.gif" width="1" height="1"></td>
        </tr>
    </table>
    <form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1" id="form1">

    <div class="groupBtn">
      <?php 

      $reviewLink = "http://".$_SERVER['HTTP_HOST'].$nowFile."/first.php";

      if(isset($_SESSION['listLinks']) && $_SESSION['listLinks']!=''){ 
      ?>
        <a href="<?php echo $_SESSION['listLinks'];?>" class="btnType finishBtn">完成</a>
        <a href="<?php echo $reviewLink; ?>" class="btnType pubBtn" target="_blank">預覽</a>
      <?php } ?>

      <p><a href="<?php echo $reviewLink; ?>" class="pubBtn red_letter" target="_blank">預覽網址:<?php echo $reviewLink; ?></a></p>
    </div>

    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  		<tr>
   			<td>
            <table width="100%" border="0" cellspacing="3" cellpadding="5">

            <tr>
                <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">小標題</td>
                <td><input name="d_data1" type="text" class="table_data" id="d_data1" value="<?php echo $row_RecMain['d_data1']; ?>" size="50" />
                </td>
              <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
            </tr>

            <tr>
                <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">英文小標題</td>
                <td><input name="d_data2" type="text" class="table_data" id="d_data2" value="<?php echo $row_RecMain['d_data2']; ?>" size="50" />
                </td>
              <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
            </tr>

            	<tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">標題</td>
          	    	<td><input name="d_title" type="text" class="table_data" id="d_title" value="<?php echo $row_RecMain['d_title']; ?>" size="50" />
          	    	  <input name="d_id" type="hidden" id="d_id" value="<?php echo $row_RecMain['d_id']; ?>" /></td>
        	    	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	    	</tr>

            <tr>
                <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">副標題</td>
                <td><input name="d_data3" type="text" class="table_data" id="d_data3" value="<?php echo $row_RecMain['d_data3']; ?>" size="50" />
                </td>
              <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
            </tr>

            	<tr>
            	  <td align="center" bgcolor="#e5ecf6" class="table_col_title">簡介</td>
            	  <td>
                  <textarea name="d_content" cols="100" rows="10" class="table_data " id="d_content"><?php echo $row_RecMain['d_content']; ?></textarea>
                </td>
            	  <td bgcolor="#e5ecf6"><span class="note_letter">*小斷行請按Shift+Enter。</span></td>
          	  </tr>

            <tr>
                <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">連結</td>
                <td><input name="d_data4" type="text" class="table_data" id="d_data4" value="<?php echo $row_RecMain['d_data4']; ?>" size="50" />
                </td>
              <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
            </tr>


                <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">日期</td>
          	    	<td><input name="d_date" type="text" class="table_data" id="d_date" value="<?php echo ( ($row_RecMain['d_date']=='') || (!(strcmp("0000-00-00 00:00:00", $row_RecMain['d_date']))) ) ? date("Y-m-d H:i:s") : $row_RecMain['d_date']; ?>" size="50"></td>
        	    	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
                <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">在網頁顯示</td>
          	    	<td><label>
          	        <select name="d_active" class="table_data" id="d_active">
          	          <option value="1" <?php if (!(strcmp(1, $row_RecMain['d_active']))) {echo "selected=\"selected\"";} ?>>顯示</option><option value="0" <?php if (!(strcmp(0, $row_RecMain['d_active']))) {echo "selected=\"selected\"";} ?>>不顯示</option>
       	            </select></label></td>
          	     	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>

                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">發佈狀態</td>
                  <td><label>
                    <select name="d_pub" class="table_data" id="d_pub">
                      <option value="1" <?php if (!(strcmp(1, $row_RecMain['d_pub']))) {echo "selected=\"selected\"";} ?>>發佈</option><option value="0" <?php if (!(strcmp(0, $row_RecMain['d_pub']))) {echo "selected=\"selected\"";} ?>>草稿</option>
                    </select></label></td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                </tr>

                <?php if ($totalRows_RecImage > 0) { // Show if recordset not empty ?>
                  <tr>
                    <td align="center" bgcolor="#e5ecf6" class="table_col_title">目前圖片</td>
                    <td><?php do { ?>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="100" rowspan="2" align="center"><a href="../<?php echo $row_RecImage['file_link1']; ?>" class="fancyboxImg" rel="group" title="<?php echo $row_RecImage['file_title']; ?>"><img src="../<?php echo $row_RecImage['file_link2']; ?>" alt="" class="image_frame"/></a></td>
                                    <td align="left" class="table_data">&nbsp;圖片說明：<?php echo $row_RecImage['file_title']; ?></td>
                              </tr>
                          <tr>
                            <td align="left" class="table_data">&nbsp;</td>
                              </tr>
                          <tr>
                            <td align="center"><a href="image_edit.php?file_id=<?php echo $row_RecImage['file_id']; ?>" class="fancyboxEdit" title="修改圖片"><img src="image/media_edit.gif" width="16" height="16" title="修改圖片"/></a><a href="image_del.php?file_id=<?php echo $row_RecImage['file_id']; ?>" class="fancyboxEdit" title="刪除圖片"><img src="image/media_delete.gif" width="16" height="16" title="刪除圖片"/></a></td>
                                            <td align="center">&nbsp;</td>
                                </tr>
                        </table>
                        <?php } while ($row_RecImage = mysql_fetch_assoc($RecImage)); ?></td>
                    <td bgcolor="#e5ecf6" class="table_col_title">
                      <p class="red_letter">*<?php echo $imagesSize[$_SESSION['nowMenu']]['note'];?></p></td>
                  </tr>
                  <?php } // Show if recordset not empty ?>
                  				  
				  <?php if ($totalRows_RecImage == 0) { // Show if recordset empty ?>
      		    <tr>
              		<td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳圖片</p></td>
              	    <td><table width="100%" border="0" cellpadding="2" cellspacing="2" bordercolor="#CCCCCC" class="data" id="pTable">
                    	<tr>
                     		<td> <span class="table_data">選擇圖片：</span>
                        	<input name="image[]" type="file" class="table_data" id="image1" />
                        	<br>
                        	<span class="table_data">圖片說明：</span>
                        	<input name="image_title[]" type="text" class="table_data" id="image_title1">                        	</td>
                  		</tr>
                    </table>
                    
                    <?php if(0){ ?>                    
                    <table width="100%" border="0" cellspacing="5" cellpadding="2">
                    	<tr>
                        	<td>
                        	<table border="0" cellspacing="2" cellpadding="2">
                        		<tr>
                            		<td><a href="javascript:addField()"><img src="image/add.png" width="16" height="16" border="0"></a></td>
                                	<td><a href="javascript:addField()" class="table_data">新增圖片</a></td>
                                	<td class="red_letter">&nbsp;</td>
                            	</tr>
                        	</table>                        	</td>
                        </tr>
                    </table>
                    <?php } ?>
                    
                    </td>
              	    <td bgcolor="#e5ecf6" class="table_col_title"><p class="red_letter">*<?php echo $imagesSize[$_SESSION['nowMenu']]['note'];?></p>           	        </td>
                </tr>
                <?php } // Show if recordset empty ?>

                 <?php if ($totalRows_RecImageMobile > 0) { // Show if recordset not empty ?>
                  <tr>
                    <td align="center" bgcolor="#e5ecf6" class="table_col_title">目前手機版圖片</td>
                    <td><?php do { ?>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="100" rowspan="2" align="center"><a href="../<?php echo $row_RecImageMobile['file_link1']; ?>" class="fancyboxImg" rel="group" title="<?php echo $row_RecImageMobile['file_title']; ?>"><img src="../<?php echo $row_RecImageMobile['file_link2']; ?>" alt="" class="image_frame"/></a></td>
                                    <td align="left" class="table_data">&nbsp;圖片說明：<?php echo $row_RecImageMobile['file_title']; ?></td>
                              </tr>
                          <tr>
                            <td align="left" class="table_data">&nbsp;</td>
                              </tr>
                          <tr>
                            <td align="center"><a href="image_edit.php?type=Mobile&file_id=<?php echo $row_RecImageMobile['file_id']; ?>" class="fancyboxEdit" title="修改圖片"><img src="image/media_edit.gif" width="16" height="16" title="修改圖片"/></a><a href="image_del.php?type=Mobile&file_id=<?php echo $row_RecImageMobile['file_id']; ?>" class="fancyboxEdit" title="刪除圖片"><img src="image/media_delete.gif" width="16" height="16" title="刪除圖片"/></a></td>
                                            <td align="center">&nbsp;</td>
                                </tr>
                        </table>
                        <?php } while ($row_RecImageMobile = mysql_fetch_assoc($RecImageMobile)); ?></td>
                    <td bgcolor="#e5ecf6" class="table_col_title">
                      <p class="red_letter">*<?php echo $imagesSize[$_SESSION['nowMenu'].'Mobile']['note'];?></p></td>
                  </tr>
                  <?php } // Show if recordset not empty ?>
                            
              <?php if ($totalRows_RecImageMobile == 0) { // Show if recordset empty ?>
                <tr>
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳手機版圖片</p></td>
                    <td><table width="100%" border="0" cellpadding="2" cellspacing="2" bordercolor="#CCCCCC" class="data" id="pTable">
                      <tr>
                        <td> <span class="table_data">選擇圖片：</span>
                          <input name="imageMobile[]" type="file" class="table_data" id="imageMobile1" />
                          <br>
                          <span class="table_data">圖片說明：</span>
                          <input name="imageMobile_title[]" type="text" class="table_data" id="imageMobile_title1">                         </td>
                      </tr>
                    </table>
                    
                    </td>
                    <td bgcolor="#e5ecf6" class="table_col_title"><p class="red_letter">*<?php echo $imagesSize[$_SESSION['nowMenu'].'Mobile']['note'];?></p>                    </td>
                </tr>
                <?php } // Show if recordset empty ?>
                
                <?php if($ifFile){ ?>
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
                                          <td align="left" class="table_no_border"><span class="table_data">&nbsp;</span><span class="table_data">檔案名稱:</span><span class="table_data"><?php echo $row_RecFile['file_name']; ?></span></td>
                                        </tr>
                                        <tr>
                                          <td align="left" class="table_no_border"><span class="table_data">&nbsp;檔案</span><span class="table_data">說明:</span><span class="table_data"><?php echo $row_RecFile['file_title']; ?></span></td>
                                        </tr>
                                        <tr>
                                          <td align="left" class="table_no_border"><a href="main_file_edit.php?file_id=<?php echo $row_RecFile['file_id']; ?>"><img src="image/media_edit.gif" width="16" height="16" title="修改檔案" /></a><a href="main_file_del.php?file_id=<?php echo $row_RecFile['file_id']; ?>"><img src="image/media_delete.gif" width="16" height="16" title="刪除檔案"/></a></td>
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
      		          <table border="0" cellspacing="5" cellpadding="2">
                        <tr>
                          <td><table border="0" cellspacing="2" cellpadding="2">
                              <tr>
                                <td><a href="javascript:addField2()"><img src="image/add.png" width="16" height="16" border="0" /></a></td>
                                <td><a href="javascript:addField2()" class="table_data">新增檔案</a></td>
                                <td class="red_letter">&nbsp;</td>
                              </tr>
                          </table></td>
                        </tr>
                    </table></td>
      		      <td bgcolor="#e5ecf6" class="table_col_title"><span class="red_letter">*上傳之檔案請勿超過2M。</span></td>
    		      </tr>
                <?php } ?>
			</table>
            </td>
		</tr>
        <tr>
        	<td>&nbsp;</td>
        </tr>
         <tr>
         	<td align="center">

          <?php 
              //echo "listLinst = ".$_SESSION['listLinks'];

            if(isset($_SESSION['listLinks']) && $_SESSION['listLinks']!=''){ 
                //$reviewLink = "../";
            ?>
              <a href="<?php echo $_SESSION['listLinks'];?>" class="btnType finishBtn">完成</a>
              <a href="<?php echo $reviewLink; ?>" class="btnType pubBtn" target="_blank">預覽</a>
            <?php 
              if( (isset($_GET['d_id']) && $_GET['d_id']!='') && ( isset($_GET['edit']) && $_GET['edit']=="finish") ){
                $_SESSION['listLinks'] = NULL;
              }              
            }else{ ?>
              <input name="submitBtn" type="submit" class="btnType" id="submitBtn" value="送出" />
            <?php } ?>

              <!--<input name="saveBtn" type="submit" class="btnType" id="saveBtn" value="儲存" />--></td>
         </tr>
	</table>
    <input type="hidden" name="MM_update" value="form1" />
    <input name="MM_updateType" type="hidden" id="MM_updateType" value="" />
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


  $d_title = checkV('d_title');
  $d_content = checkV('d_content');
  $d_data1 = checkV('d_data1');
  $d_data2 = checkV('d_data2');
  $d_data3 = checkV('d_data3');
  $d_data4 = checkV('d_data4');
  $d_date = checkV('d_date');
  $d_active  = checkV('d_active');
  $d_pub  = checkV('d_pub');
  $d_id  = checkV('d_id');


  $updateSQL = sprintf("UPDATE data_set SET d_title=%s, d_content=%s, d_data1=%s, d_data2=%s, d_data3=%s, d_data4=%s, d_date=%s, d_active=%s, d_pub=%s WHERE d_id=%s",
                       GetSQLValueString($d_title, "text"),
                       GetSQLValueString($d_content, "text"),
                       GetSQLValueString($d_data1, "text"),
                       GetSQLValueString($d_data2, "text"),
                       GetSQLValueString($d_data3, "text"),
                       GetSQLValueString($d_data4, "text"),
                       GetSQLValueString($d_date, "date"),
                       GetSQLValueString($d_active, "int"),
                       GetSQLValueString($d_pub, "int"),
                       GetSQLValueString($d_id, "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());

		//----------插入圖片資料到資料庫begin(須放入插入主資料後)----------
				//echo image_process();
					
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
                       GetSQLValueString($_POST['d_id'], "int"),
                       GetSQLValueString($image_result[$j][4], "text"),
                       GetSQLValueString($image_result[$j][5], "int"));
	
				  mysql_select_db($database_connect2data, $connect2data);
				  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
				  
				  $_SESSION["change_image"]=1;
			}
			
		
		
		//----------插入圖片資料到資料庫end----------

      

    //----------插入Mobile圖片資料到資料庫begin(須放入插入主資料後)----------
          
    $image_result=image_process($_FILES['imageMobile'], $_REQUEST['imageMobile_title'], $menu_is.'Mobile',"add", $imagesSize[$_SESSION['nowMenu'].'Mobile']['IW'], $imagesSize[$_SESSION['nowMenu'].'Mobile']['IH']);      
      
      
      for($j=1;$j<count($image_result);$j++)
      {              
        $insertSQL = sprintf("INSERT INTO file_set (file_name, file_link1, file_link2, file_link3, file_type, file_d_id, file_title, file_show_type) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($image_result[$j][0], "text"),
                       GetSQLValueString($image_result[$j][1], "text"),
                       GetSQLValueString($image_result[$j][2], "text"),
                       GetSQLValueString($image_result[$j][3], "text"),
                       GetSQLValueString("imageMobile", "text"),
                       GetSQLValueString($_POST['d_id'], "int"),
                       GetSQLValueString($image_result[$j][4], "text"),
                       GetSQLValueString($image_result[$j][5], "int"));
  
          mysql_select_db($database_connect2data, $connect2data);
          $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
          
          $_SESSION["change_image"]=1;
      }   
    
    //----------插入Mobile圖片資料到資料庫end----------
		if($ifFile){
	    //----------插入檔案資料到資料庫begin(須放入插入主資料後)----------
   			//echo file_process();
				
		
			$file_result=file_process("main","add");
	
			//echo count($file_result);
		
		
		
		for($j=0;$j<count($file_result);$j++)
		{
			  $insertSQL = sprintf("INSERT INTO file_set (file_name, file_link1, file_type, file_d_id, file_title) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($file_result[$j][0], "text"),
                       GetSQLValueString($file_result[$j][1], "text"),
                       GetSQLValueString("file", "text"),
                       GetSQLValueString($_POST['d_id'], "int"),
                       GetSQLValueString($file_result[$j][2], "text"));

  			  mysql_select_db($database_connect2data, $connect2data);
  			  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
		}
		
	
	
	//----------插入檔案資料到資料庫end----------
	}

  $updateGoTo = "main_list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING']."&pageNum=".$_SESSION["ToPage"];
  }

  $_SESSION['listLinks'] = $updateGoTo;

  $selfLink = $editFormAction."&edit=finish";
  
  
  if($image_result[0][0]==1)
  {
		echo "<script type=\"text/javascript\">call_alert('".$selfLink."');</script>";
  }else
  {
  		header(sprintf("Location: %s", $selfLink));
  }
}
?>
<?php
mysql_free_result($RecMain);
mysql_free_result($RecImage);
mysql_free_result($RecFile);
?>
