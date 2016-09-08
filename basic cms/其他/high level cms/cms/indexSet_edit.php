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

if(!in_array(5,$_SESSION['MM_Limit']['a2'])){
	header("Location: indexSet_list.php");
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$colname_RecIndexSet = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecIndexSet = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecIndexSet = sprintf("SELECT * FROM data_set WHERE d_id = %s", GetSQLValueString($colname_RecIndexSet, "int"));
$RecIndexSet = mysql_query($query_RecIndexSet, $connect2data) or die(mysql_error());
$row_RecIndexSet = mysql_fetch_assoc($RecIndexSet);
$totalRows_RecIndexSet = mysql_num_rows($RecIndexSet);

if($totalRows_RecIndexSet==0){
  header("Location: indexSet_list.php");
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

$colname_RecFile = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecFile = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecFile = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'file'", GetSQLValueString($colname_RecFile, "int"));
$RecFile = mysql_query($query_RecFile, $connect2data) or die(mysql_error());
$row_RecFile = mysql_fetch_assoc($RecFile);
$totalRows_RecFile = mysql_num_rows($RecFile);

$menu_is="indexSet";

//記錄帶資料去別地方的資訊
$_SESSION['nowPage']=$selfPage;
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
	//echo "window.location.reload();";
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
            <td width="30%" class="list_title">修改首頁設定</td>
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
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">英文標題1</td>
                  <td>
                  <input name="d_title_en" type="text" class="table_data" id="d_title_en" value="<?php echo $row_RecIndexSet['d_title_en']; ?>" size="70" />
                  </td>
                <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
              </tr>

              <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">標題1</td>
          	    	<td><input name="d_title" type="text" class="table_data" id="d_title" value="<?php echo $row_RecIndexSet['d_title']; ?>" size="70" />
          	    	  <input name="d_id" type="hidden" id="d_id" value="<?php echo $row_RecIndexSet['d_id']; ?>" /></td>
        	    	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	    	</tr>
              <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">英文標題2</td>
                  <td>
                  <input name="d_data1" type="text" class="table_data" id="d_data1" value="<?php echo $row_RecIndexSet['d_data1']; ?>" size="70" />
                  </td>
                <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
              </tr>
              <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">標題2</td>
                  <td>
                  <input name="d_data2" type="text" class="table_data" id="d_data2" value="<?php echo $row_RecIndexSet['d_data2']; ?>" size="70" />
                  </td>
                <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
              </tr>

              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">youtube code</td>
                <td>
                <input name="d_content" type="text" class="table_data" id="d_content" value="<?php echo $row_RecIndexSet['d_content']; ?>" size="70" />
                </td>
                <td bgcolor="#e5ecf6"><span class="note_letter">*請先自行將影片上傳至 youtube後，<br>再將影片碼輸入於左方文字欄位。<br>
例如，影片網址為：<br>https://www.youtube.com/watch?v=_jJNocrL_as&feature=youtu.be，<br>網址watch?v=後面則為影片碼( <b>_jJNocrL_as</b> )。</span></td>
              </tr>

                <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">日期</td>
          	    	<td><input name="d_date" type="text" class="table_data" id="d_date" value="<?php echo ( ($row_RecIndexSet['d_date']=='') || (!(strcmp("0000-00-00 00:00:00", $row_RecIndexSet['d_date']))) ) ? date("Y-m-d H:i:s") : $row_RecIndexSet['d_date']; ?>" size="50"></td>
        	    	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>

                <?php if(0){?>
                <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">在網頁顯示</td>
          	    	<td><label>
          	        <select name="d_active" class="table_data" id="d_active">
          	          <option value="1" <?php if (!(strcmp(1, $row_RecIndexSet['d_active']))) {echo "selected=\"selected\"";} ?>>顯示</option><option value="0" <?php if (!(strcmp(0, $row_RecIndexSet['d_active']))) {echo "selected=\"selected\"";} ?>>不顯示</option>
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
                            <td align="left" class="table_data"><!--&nbsp;圖片連結：<?php echo $row_RecImage['file_link1']; ?>--></td>
                              </tr>
                          <tr>
                            <td align="center"><a href="image_edit.php?file_id=<?php echo $row_RecImage['file_id']; ?>" class="fancyboxEdit" title="修改圖片"><img src="image/media_edit.gif" width="16" height="16" title="修改圖片"/></a><a href="image_del.php?file_id=<?php echo $row_RecImage['file_id']; ?>" class="fancyboxEdit" title="刪除圖片"><img src="image/media_delete.gif" width="16" height="16" title="刪除圖片"/></a></td>
                                            <td align="center">&nbsp;</td>
                                </tr>
                        </table>
                        <?php } while ($row_RecImage = mysql_fetch_assoc($RecImage)); ?></td>
                    <td bgcolor="#e5ecf6" class="table_col_title"><p>&nbsp;</p></td>
                  </tr>
                  <?php } // Show if recordset not empty ?>
      		    <tr>
              		<td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳圖片</p>              	    </td>
              	    <td><table width="100%" border="0" cellpadding="2" cellspacing="2" bordercolor="#CCCCCC" class="data" id="pTable">
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
                        	<td>
                        	<table border="0" cellspacing="2" cellpadding="2">
                        		<tr>
                            		<td><a href="javascript:addField()"><img src="image/add.png" width="16" height="16" border="0"></a></td>
                                	<td><a href="javascript:addField()" class="table_data">新增圖片</a></td>
                                	<td class="red_letter">&nbsp;</td>
                            	</tr>
                        	</table>                        	</td>
                        </tr>
                  </table></td>
              	    <td bgcolor="#e5ecf6" class="table_col_title"><p class="red_letter">*<?php echo $imagesSize[$_SESSION['nowMenu']]['note'];?>若超過可分批上傳。</p>           	        </td>
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
            <input name="submitBtn" type="submit" class="btnType" id="submitBtn" value="送出" />
            <a href="#" class="btnType finishBtn" style="display: none;">完成</a>
            <a href="#" class="btnType pubBtn" style="display: none;" target="_blank">預覽</a>
          </td>
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

<?php
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {

  $d_title  = checkV('d_title');
  $d_content = checkV('d_content');
  $d_class2  = checkV('d_class2');
  $d_date  = checkV('d_date');
  //$d_active  = checkV('d_active');
  $d_id  = checkV('d_id');

  $d_title_en  = checkV('d_title_en');
  $d_data1  = checkV('d_data1');
  $d_data2  = checkV('d_data2');
  
  $updateSQL = sprintf("UPDATE data_set SET d_title=%s, d_title_en=%s, d_content=%s, d_data1=%s, d_data2=%s, d_class2=%s, d_date=%s WHERE d_id=%s",
                       GetSQLValueString($d_title, "text"),
                       GetSQLValueString($d_title_en, "text"),
                       GetSQLValueString($d_content, "text"),
                       GetSQLValueString($d_data1, "text"),
                       GetSQLValueString($d_data2, "text"),
                       GetSQLValueString($d_class2, "text"),
                       GetSQLValueString($d_date, "date"),
                       GetSQLValueString($d_id, "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());

    //----------插入圖片資料到資料庫begin(須放入插入主資料後)----------
        //echo image_process();
          
    //$image_result=image_process("indexSet","add", "0", "0");
    $image_result=image_process($_FILES['image'], $_REQUEST['image_title'], "indexSet","add", $imagesSize[$_SESSION['nowMenu']]['IW'], $imagesSize[$_SESSION['nowMenu']]['IH']);
      //echo count($image_result);
      //echo $image_result[0][0];
      
      
      
      for($j=1;$j<count($image_result);$j++)
      {
        $file_name = (isset($image_result[$j][0])) ? $image_result[$j][0] : NULL;
        $file_link1 = (isset($image_result[$j][1])) ? $image_result[$j][1] : NULL;
        $file_link2 = (isset($image_result[$j][2])) ? $image_result[$j][2] : NULL;
        $file_link3 = (isset($image_result[$j][3])) ? $image_result[$j][3] : NULL;
        $file_title = (isset($image_result[$j][4])) ? $image_result[$j][4] : NULL;
        $file_show_type = (isset($image_result[$j][5])) ? $image_result[$j][5] : NULL;


        $insertSQL = sprintf("INSERT INTO file_set (file_name, file_link1, file_link2, file_link3, file_type, file_d_id, file_title, file_show_type) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($file_name, "text"),
                       GetSQLValueString($file_link1, "text"),
                       GetSQLValueString($file_link2, "text"),
                       GetSQLValueString($file_link3, "text"),
                       GetSQLValueString("image", "text"),
                       GetSQLValueString($d_id, "int"),
                       GetSQLValueString($file_title, "text"),
                       GetSQLValueString($file_show_type, "int"));
  
          mysql_select_db($database_connect2data, $connect2data);
          $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
          
          $_SESSION["change_image"]=1;
      }
      
    
    
    //----------插入圖片資料到資料庫end----------      

  $updateGoTo = "indexSet_list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING']."&pageNum_RecIndexSet=".$_SESSION["ToPage"];
  }
  
  
  if($image_result[0][0]==1)
  {
    echo "<script type='text/javascript'>call_alert('".$updateGoTo."');</script>";
  }else
  {
    /*echo "<script type='text/javascript'>";
    echo "$(document).ready(function() {";
    echo "alert('您已儲存完成！');";
    //echo "window.location.href='".$editFormAction."&f=finish';";
    echo "$('#submitBtn').hide();";
    echo "$('.finishBtn').attr('href', '".$updateGoTo."' );";
    echo "$('.pubBtn').attr('href', '../indexSet.php');";
    echo "$('.finishBtn').show();";
    echo "$('.pubBtn').show();";
    echo "});";
    echo "</script>";*/
      header(sprintf("Location: %s", $updateGoTo));
  }
}
?>

</body>
<!-- InstanceEnd --></html>

<?php
mysql_free_result($RecIndexSet);
mysql_free_result($RecImage);
mysql_free_result($RecFile);
?>
