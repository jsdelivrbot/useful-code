<?php require_once('../sstart.php'); ?>
<?php require_once('../Connections/connect2data.php'); ?>
<?php require_once('photo_process_releases.php'); ?>
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
	header("Location: releases_list.php");
}


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


$colname_RecReleases = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecReleases = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecReleases = sprintf("SELECT data_set.*, class_set.c_title as c_title FROM data_set LEFT JOIN class_set ON data_set.d_class2 =class_set.c_id WHERE d_id = %s", GetSQLValueString($colname_RecReleases, "int"));
$RecReleases = mysql_query($query_RecReleases, $connect2data) or die(mysql_error());
$row_RecReleases = mysql_fetch_assoc($RecReleases);
$totalRows_RecReleases = mysql_num_rows($RecReleases);

$colname_RecImage = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecImage = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecImage = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'image'", GetSQLValueString($colname_RecImage, "int"));
$RecImage = mysql_query($query_RecImage, $connect2data) or die(mysql_error());
$row_RecImage = mysql_fetch_assoc($RecImage);
$totalRows_RecImage = mysql_num_rows($RecImage);

mysql_select_db($database_connect2data, $connect2data);
$query_RecYears = "SELECT * FROM class_set WHERE c_parent = 'Years' AND c_active='1' ORDER BY c_sort ASC, c_id DESC";
$RecYears = mysql_query($query_RecYears, $connect2data) or die(mysql_error());
$row_RecYears = mysql_fetch_assoc($RecYears);
$totalRows_RecYears = mysql_num_rows($RecYears);

mysql_select_db($database_connect2data, $connect2data);
$query_RecReleasesC = "SELECT * FROM class_set WHERE c_parent = 'releasesC' AND c_active='1' ORDER BY c_sort ASC, c_id DESC";
$RecReleasesC = mysql_query($query_RecReleasesC, $connect2data) or die(mysql_error());
$row_RecReleasesC = mysql_fetch_assoc($RecReleasesC);
$totalRows_RecReleasesC = mysql_num_rows($RecReleasesC);

mysql_select_db($database_connect2data, $connect2data);
$query_RecArtistsT = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='post_tag' AND T.term_active='1' ORDER BY term_sort ASC, term_id DESC";
$RecArtistsT = mysql_query($query_RecArtistsT, $connect2data) or die(mysql_error());
$row_RecArtistsT = mysql_fetch_assoc($RecArtistsT);

//echo 'selected_Years = '.$_SESSION['selected_Years'];
/*$G_selected1 = '';
if (isset($_SESSION['selected_Years'])){
	$G_selected1 = $_SESSION['selected_Years'] = $row_RecReleases['d_class2'];
	//echo 'G_selected1 = '.$G_selected1;
}*/

$G_selected1 = $_SESSION['selected_Years'] = $row_RecReleases['d_class2'];

$menu_is="releases";

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
<link rel="stylesheet" href="jquery/chosen_v1.0.0/chosen.css">
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
		
		function addFieldIndex() {
		var pTable=document.getElementById('pTableIndex');
		var lastRow = pTable.rows.length;
		//alert(pTable.rows.length);
		var myField=document.getElementById('indexImage'+lastRow);
		//alert('image'+lastRow);
		if(myField.value){
			var aTr=pTable.insertRow(lastRow);
			var newRow = lastRow+1;
			var newImg='img'+(newRow);
			var aTd1=aTr.insertCell(0);
			aTd1.innerHTML = '<span class="table_data">選擇圖片： </span><input name="indexImage[]" type="file" class="table_data" id="indexImage'+newRow+'"><br><span class="table_data">圖片說明： </span><input name="indexImage_title[]" type="text" class="table_data" id="indexImage_title'+newRow+'">';
		}else{
			alert("尚有未選取之圖片欄位!!");
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
            <td width="30%" class="list_title">修改最新發行</td>
            <td width="70%">&nbsp;</td>
        </tr>
	</table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td><img src="image/spacer.gif" width="1" height="1"></td>
        </tr>
    </table>
    <form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1" id="form1">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
  		<tr>
   			<td>
            <table width="100%" border="0" cellpadding="5" cellspacing="3">
            	<tr>
            	  <td align="center" bgcolor="#e5ecf6" class="table_col_title">年份</td>
            	  <td>
            	    <select name="d_class2" id="d_class2">
            	      <?php
do {  
?>
            	      <option value="<?php echo $row_RecYears['c_id']?>" <?php if (!(strcmp($row_RecYears['c_id'], $row_RecReleases['d_class2']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecYears['c_title']?></option>
            	      <?php
} while ($row_RecYears = mysql_fetch_assoc($RecYears));
  $rows = mysql_num_rows($RecYears);
  if($rows > 0) {
      mysql_data_seek($RecYears, 0);
	  $row_RecYears = mysql_fetch_assoc($RecYears);
  }
?>
          	      </select></td>
            	  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
          	  </tr>

                <tr>
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title">專輯分類</td>
                  <td><label>
                    <select name="d_class5" id="d_class5" class="table_data">
                      <?php
                      do {  
                      ?>
                      <option value="<?php echo $row_RecReleasesC['c_id']?>" <?php if (!(strcmp($row_RecReleasesC['c_id'], $row_RecReleases['d_class5']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecReleasesC['c_title']?></option>
                      <?php
                      } while ($row_RecReleasesC = mysql_fetch_assoc($RecReleasesC));
                        $rows = mysql_num_rows($RecReleasesC);
                        if($rows > 0) {
                            mysql_data_seek($RecReleasesC, 0);
                          $row_RecReleasesC = mysql_fetch_assoc($RecReleasesC);
                        }
                      ?>
                    </select>
                  </label></td>
                  <td bgcolor="#e5ecf6">&nbsp;</td>
                </tr>


                
            	<tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">是否關聯藝人</td>
                <td class="table_data">

                  <div class="relationshipRadio">
                    <label for="relationship_1">
                      <input name="relationship" type="radio" id="relationship_1" value="0" <?php if (!(strcmp(0, $row_RecReleases['d_class4'])) || is_null($row_RecReleases['d_class4'])) {echo ' checked="checked"';} ?> />
                          無
                      </label>
                    <label for="relationship_2">
                      <input name="relationship" type="radio" id="relationship_2" value="1" <?php if (!(strcmp(1, $row_RecReleases['d_class4']))) {echo ' checked="checked"';} ?>/>
                          關聯
                      </label>
                  </div>
                  <div class="relationshipSelectGroup hide">
                    <label>
                    <select name="d_class3" id="d_class3">
                      <?php
                      do {  
                      ?>
                          <option value="<?php echo $row_RecArtistsT['term_id']?>"<?php if (!(strcmp($row_RecArtistsT['term_id'], $row_RecReleases['d_class3']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecArtistsT['name'].' '.$row_RecArtistsT['name_en']?></option>
                          <?php
                      } while ($row_RecArtistsT = mysql_fetch_assoc($RecArtistsT));
                        $rows = mysql_num_rows($RecArtistsT);
                        if($rows > 0) {
                            mysql_data_seek($RecArtistsT, 0);
                          $row_RecArtistsT = mysql_fetch_assoc($RecArtistsT);
                        }
                      ?>
                    </select>
                  </label>
                  </div>


                </td>
                <td bgcolor="#e5ecf6">&nbsp;</td>
              </tr>
            	
            	<tr>
            	  <td align="center" bgcolor="#e5ecf6" class="table_col_title">專輯名稱</td>
            	  <td><input name="d_title" type="text" class="table_data" id="d_title" value="<?php echo $row_RecReleases['d_title']; ?>" size="80" />
            	    </td>
            	  <td bgcolor="#e5ecf6">                  
            	    
            	    </td>
          	  </tr>
              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">列表簡介</td>
                <td><textarea name="d_data1" cols="100" rows="20" class="table_data" id="d_data1"><?php echo $row_RecReleases['d_data1']; ?></textarea></td>
                <td bgcolor="#e5ecf6"><p class="red_letter">*小斷行請按Shift+Enter。<br />
                  輸入區域的右下角可以調整輸入空間的大小。</p></td>
              </tr>
            	<tr>
            	  <td align="center" bgcolor="#e5ecf6" class="table_col_title">專輯內容</td>
            	  <td class="table_data"><textarea name="d_content" cols="100" rows="20" class="table_data tiny" id="d_content"><?php echo $row_RecReleases['d_content']; ?></textarea></td>
            	  <td bgcolor="#e5ecf6"><p class="red_letter">*小斷行請按Shift+Enter。<br />
            	    輸入區域的右下角可以調整輸入空間的大小。</p></td>
          	  </tr>
              <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">ONLINE SHOP 連結</td>
                  <td><input name="d_data2" type="text" class="table_data" id="d_data2" value="<?php echo $row_RecReleases['d_data2']; ?>" size="80" />

                  </td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                </tr>
            	
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">時間</td>
                  <td><input name="d_date" type="text" class="table_data" id="d_date" value="<?php echo $row_RecReleases['d_date']; ?>" size="50" /></td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                </tr>
            	<tr>
            	  <td align="center" bgcolor="#e5ecf6" class="table_col_title">狀態</td>
            	  <td><label>
            	    <select name="d_active" class="table_data" id="d_active">
            	      <option value="0" <?php if (!(strcmp(0, $row_RecReleases['d_active']))) {echo "selected=\"selected\"";} ?>>不公佈</option>
            	      <option value="1" <?php if (!(strcmp(1, $row_RecReleases['d_active']))) {echo "selected=\"selected\"";} ?>>公佈</option>
            	      </select>
            	    </label></td>
            	  <td bgcolor="#e5ecf6">&nbsp;</td>
          	  </tr>
            	
                <?php if ($totalRows_RecImage > 0) { // Show if recordset not empty ?>
                  <tr>
                    <td align="center" bgcolor="#e5ecf6" class="table_col_title">目前圖片<a name="imageEdit" id="imageEdit"></a></td>
                    <td><?php do { ?>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="100" rowspan="2" align="center"><a href="../<?php echo $row_RecImage['file_link1'].'?'.(mt_rand(1,100000)/100000); ?>" class="fancyboxImg" rel="group" title="<?php echo $row_RecImage['file_title']; ?>"><img src="../<?php echo $row_RecImage['file_link2'].'?'.(mt_rand(1,100000)/100000); ?>" alt="" class="image_frame"/></a></td>
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
                    <td bgcolor="#e5ecf6" class="table_col_title"><p class="red_letter">&nbsp;</p></td>
                  </tr>
                  <?php } // Show if recordset not empty ?>
                  
                  <?php if ($totalRows_RecImage == 0) { // Show if recordset empty ?>
                  <tr>
              		<td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳圖片</p></td>
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
                    <?php if(0){ ?>
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
                    <?php } ?>  
                              </td>  
              	    <td bgcolor="#e5ecf6" class="table_col_title">
                    <p class="red_letter">*<?php echo $imagesSize[$_SESSION['nowMenu']]['note'];?></p></td>
                </tr>
                  <?php } // Show if recordset empty ?>
                
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
    <input name="d_id" type="hidden" id="d_id" value="<?php echo $row_RecReleases['d_id']; ?>" />
    <input name="d_sort" type="hidden" id="d_sort" value="<?php echo $row_RecReleases['d_sort']; ?>" />
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


<script type="text/javascript">
function checkRelationship(val){
  //console.log(val);
  if(val==1){
    $(".relationshipSelectGroup").removeClass('hide');
  }else{
    $(".relationshipSelectGroup").addClass('hide');
  }
}
  $(function() {

    checkRelationship($("input[name='relationship']:checked").val());

    $("input[name='relationship']").change(function(){
      checkRelationship($("input[name='relationship']:checked").val());
    });

  });
</script>
</body>
<!-- InstanceEnd --></html>
<?php
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	
 
 /*$d_tag = '';
 $class3 = '';
 
 $d_tag = is_null(checkV('select1')) ? NULL : implode (",", checkV('select1'));
 $tagA = $_POST['select1'];*/
 
 $d_title	= checkV('d_title');
 $d_content	= checkV('d_content');
 $d_data1 = checkV('d_data1');
 $d_data2 = checkV('d_data2');
 
 $d_class2	= checkV('d_class2');
 $d_class5  = checkV('d_class5');
 $d_date	= checkV('d_date');
 $d_active	= checkV('d_active');
 $d_id		= checkV('d_id');


 //確認是否有關聯
 $d_class4  = checkV('relationship');

if( is_null($d_class4) ){
  $d_class4 = 0;
}

 $d_class3 = NULL;
 if($d_class4==1){
  //如有關聯則寫入藝人
  $d_class3 = checkV('d_class3'); 
 }
 
 $d_date  = checkV('d_date');
 $d_active  = checkV('d_active');  
 
 //$y = substr($d_date, 0, 4);
    
  $updateSQL = sprintf("UPDATE data_set SET d_title=%s, d_content=%s, d_data1=%s, d_data2=%s, d_class2=%s, d_class3=%s, d_class4=%s, d_class5=%s, d_date=%s, d_active=%s WHERE d_id=%s",
                       GetSQLValueString($d_title, "text"),
                       GetSQLValueString($d_content, "text"),
                       GetSQLValueString($d_data1, "text"),
                       GetSQLValueString($d_data2, "text"),
                       GetSQLValueString($d_class2, "text"),
                       GetSQLValueString($d_class3, "text"),
                       GetSQLValueString($d_class4, "text"),
                       GetSQLValueString($d_class5, "text"),
                       GetSQLValueString($d_date, "date"),
                       GetSQLValueString($d_active, "int"),
                       GetSQLValueString($d_id, "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
  
    //----------插入圖片資料到資料庫begin(須放入插入主資料後)----------
   			//echo image_process();
				
	$image_result=image_process($_FILES['image'], $_REQUEST['image_title'], "releases","add", $imagesSize[$_SESSION['nowMenu']]['IW'], $imagesSize[$_SESSION['nowMenu']]['IH']);
	
		//echo count($image_result);
		//echo $image_result[0][0];
		
		for($j=1;$j<count($image_result);$j++)
		{
			  $insertSQL = sprintf("INSERT INTO file_set (file_name, file_link1, file_link2, file_link3, file_link4, file_link5, file_link6, file_type, file_d_id, file_title, file_show_type) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($image_result[$j][0], "text"),
                       GetSQLValueString($image_result[$j][1], "text"),
                       GetSQLValueString($image_result[$j][2], "text"),
                       GetSQLValueString($image_result[$j][3], "text"),
                       GetSQLValueString($image_result[$j][6], "text"),
                       GetSQLValueString($image_result[$j][7], "text"),
                       GetSQLValueString($image_result[$j][8], "text"),
                       GetSQLValueString("image", "text"),
                       GetSQLValueString($d_id, "int"),
                       GetSQLValueString($image_result[$j][4], "text"),
                       GetSQLValueString($image_result[$j][5], "int"));

  			  mysql_select_db($database_connect2data, $connect2data);
  			  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
			  $_SESSION["change_image"]=1;
		}
		
	//----------插入圖片資料到資料庫end----------
	
  $_SESSION['original_selected']=$_SESSION['selected_Years'];
  
  //$updateGoTo = "releases_list.php?selected1=".$class2."&selected2=".$class3."&changeSort=1&change_num=".$_POST['d_sort']."&now_d_id=".$_POST['d_id']."&totalRows_RecReleases=".$_SESSION['totalRows']."&pageNum=".$_SESSION["ToPage"];
  $updateGoTo = "releases_list.php?selected1=".$d_class2."&changeSort=1&change_num=".$_POST['d_sort']."&now_d_id=".$d_id."&totalRows=".$_SESSION['totalRows']."&pageNum=".$_SESSION["ToPage"];
  
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING']."&pageNum=".$_SESSION["ToPage"];
  }
  
  
  if($image_result[0][0]==1)
  {
		echo "<script type=\"text/javascript\">call_alert('".$updateGoTo."');</script>";
  }else
  {
  		//echo $updateGoTo;
		header(sprintf("Location: %s", $updateGoTo));
  }
}
?>
<?php
mysql_free_result($RecReleases);
mysql_free_result($RecImage);
mysql_free_result($RecReleasesC);
?>
