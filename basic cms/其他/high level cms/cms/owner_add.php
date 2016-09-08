<?php require_once('../sstart.php'); ?>
<?php require_once('../Connections/connect2data.php'); ?>
<?php require_once('photo_process_owner.php'); ?>
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

if(!in_array(2,$_SESSION['MM_Limit']['a5'])){
	header("Location: owner_list.php");
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$G_sel = '';
if (isset($_SESSION['selected_awardT'])){
	$G_sel = $_SESSION['selected_awardT'];
}

mysql_select_db($database_connect2data, $connect2data);
$query_RecAwardT = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='awardT' AND T.term_active='1' ORDER BY term_sort ASC, term_id DESC";
$RecAwardT = mysql_query($query_RecAwardT, $connect2data) or die(mysql_error());
$row_RecAwardT = mysql_fetch_assoc($RecAwardT);
$totalRows_RecAwardT = mysql_num_rows($RecAwardT);

mysql_select_db($database_connect2data, $connect2data);
$query_RecYears = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='years' AND T.term_active='1'  ORDER BY term_sort ASC, term_id DESC";
$RecYears = mysql_query($query_RecYears, $connect2data) or die(mysql_error());
$row_RecYears = mysql_fetch_assoc($RecYears);
$totalRows_RecYears = mysql_num_rows($RecYears);

mysql_select_db($database_connect2data, $connect2data);
$query_RecMedia = "SELECT * FROM term_relationships AS TR, data_set AS D, terms AS T
WHERE TR.term_taxonomy_id = T.term_id AND D.d_id = TR.object_id AND D.d_class1='media' AND D.d_class3='1' AND D.d_active='1' ORDER BY term_order ASC, d_date DESC";
$RecMedia = mysql_query($query_RecMedia, $connect2data) or die(mysql_error());
$row_RecMedia = mysql_fetch_assoc($RecMedia);
$totalRows_RecMedia = mysql_num_rows($RecMedia);

mysql_select_db($database_connect2data, $connect2data);
$query_RecMediaVideo = "SELECT * FROM term_relationships AS TR, data_set AS D, terms AS T
WHERE TR.term_taxonomy_id = T.term_id AND D.d_id = TR.object_id AND D.d_class1='media' AND D.d_class3='2' AND D.d_active='1' ORDER BY term_order ASC, d_date DESC";
$RecMediaVideo = mysql_query($query_RecMediaVideo, $connect2data) or die(mysql_error());
$row_RecMediaVideo = mysql_fetch_assoc($RecMediaVideo);
$totalRows_RecMediaVideo = mysql_num_rows($RecMediaVideo);

$menu_is="owner";;
$_SESSION['nowMenu']= "owner";
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
<link rel="stylesheet" href="jquery/chosen_v1.5.1/chosen.css">
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
			console.log('image'+lastRow);
			
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


<link rel="stylesheet" href="../js/datetimepicker-master/jquery.datetimepicker.css">

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
            <td width="30%" class="list_title">新增唐獎得主</td>
            <td width="70%">&nbsp;              
                </td>
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
      if(isset($_SESSION['listLinks']) && $_SESSION['listLinks']!=''){ 
          //$reviewLink = "http://".$_SERVER['HTTP_HOST'].$nowFile."/"."owner_detail.php?sel=10&id=63";

          if( (isset($_GET['now_d_id'])&&$_GET['now_d_id']!='') && (isset($_GET['sel'])&&$_GET['sel']!='') ){
            $reviewLink = "http://".$_SERVER['HTTP_HOST'].$nowFile."/"."owner_detail.php?sel=".$_GET['sel']."&id=".$_GET['now_d_id'];
          }else{
            $reviewLink = "http://".$_SERVER['HTTP_HOST'].$nowFile."/"."owner.php";
          }
      ?>
        <a href="<?php echo $_SESSION['listLinks'];?>" class="btnType finishBtn">完成</a>
        <a href="<?php echo $reviewLink; ?>" class="btnType pubBtn" target="_blank">預覽</a>

        <p>
        <a href="<?php echo $reviewLink; ?>" class="pubBtn red_letter" target="_blank">預覽網址:<?php echo $reviewLink; ?></a>
        </p>
      <?php } ?>
    </div>

    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  		<tr>
   			<td>
            <table width="100%" border="0" cellpadding="5" cellspacing="3">
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">獎項分類</td>
                  <td>
  <label>
  <select data-placeholder="請選擇分類..." class="chosen-select table_data"  style="width:400px;" tabindex="4" name="d_class2[]" id="d_class2">
  <?php
do {  
?>
  <option value="<?php echo $row_RecAwardT['term_id']?>"<?php if (!(strcmp($row_RecAwardT['term_id'], $G_sel))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecAwardT['name']?><?php //echo $row_RecAwardT['term_id']?></option>
  <?php
} while ($row_RecAwardT = mysql_fetch_assoc($RecAwardT));
  $rows = mysql_num_rows($RecAwardT);
  if($rows > 0) {
      mysql_data_seek($RecAwardT, 0);
	  $row_RecAwardT = mysql_fetch_assoc($RecAwardT);
  }
?>
  </select>
  </label>
                    </td>
                  <td width="250" bgcolor="#e5ecf6">
                    <input name="d_class1" type="hidden" id="d_class1" value="owner" />
                    <!--<input id="fullIdPath" type="hidden" value="1,8,24" />-->
                    </td>
                </tr>
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">得獎年份</td>
                  <td>
    <label>
  <select data-placeholder="請選擇分類..." class="chosen-select table_data" style="width:400px;" multiple tabindex="4" name="d_class3[]" id="d_class3">
<?php
$i=1;
do {  
?>
  <option value="<?php echo $row_RecYears['term_id']?>" <?php echo ($i==1) ? "selected='selected'" : ""; ?>><?php echo $row_RecYears['name']?><?php //echo $row_RecYears['term_id']?></option>
  <?php
  $i++;
} while ($row_RecYears = mysql_fetch_assoc($RecYears));
  $rows = mysql_num_rows($RecYears);
  if($rows > 0) {
      mysql_data_seek($RecYears, 0);
    $row_RecYears = mysql_fetch_assoc($RecYears);
  }
?>
  </select>
  </label>
                    </td>
                  <td width="250" bgcolor="#e5ecf6">
                    <input name="d_class1" type="hidden" id="d_class1" value="owner" />
                    <!--<input id="fullIdPath" type="hidden" value="1,8,24" />-->
                    </td>
                </tr>



            	<tr>
            	  <td align="center" bgcolor="#e5ecf6" class="table_col_title">姓名</td>
            	  <td><input name="d_title" type="text" class="table_data" id="d_title" size="50" /></td>
            	  <td bgcolor="#e5ecf6">&nbsp;</td>
          	  </tr>

              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">英文姓名</td>
                <td><input name="d_title_en" type="text" class="table_data" id="d_title_en" size="50" /></td>
                <td bgcolor="#e5ecf6">&nbsp;</td>
              </tr>
              
              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">列表簡介</td>
                <td><textarea name="d_content" cols="100" rows="10" class="table_data " id="d_content"></textarea></td>
                <td bgcolor="#e5ecf6"><p class="red_letter">*小斷行請按Shift+Enter。<br />
                  輸入區域的右下角可以調整輸入空間的大小。</p></td>
              </tr>
            	
              <tr>
            	  <td align="center" bgcolor="#e5ecf6" class="table_col_title">貢獻概要</td>
            	  <td><textarea name="d_data1" cols="100" rows="20" class="table_data tiny" id="d_data1"></textarea></td>
            	  <td bgcolor="#e5ecf6"><p class="red_letter">*小斷行請按Shift+Enter。<br />
            	    輸入區域的右下角可以調整輸入空間的大小。</p>
            	    <!-- <p class="red_letter">*圖片請上傳寬不大於900 pixel 72dpi之圖檔。</p> --></td>
          	  </tr>
              
              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">簡歷</td>
                <td><textarea name="d_data2" cols="100" rows="20" class="table_data tiny" id="d_data2">
                </textarea></td>
                <td bgcolor="#e5ecf6"><p class="red_letter">*小斷行請按Shift+Enter。<br />
                  輸入區域的右下角可以調整輸入空間的大小。</p>
                  <!-- <p class="red_letter">*圖片請上傳寬不大於900 pixel 72dpi之圖檔。</p> --></td>
              </tr>

              <tr>
                <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">內部相關報導</td>
                <td class="table_data">
                  <?php if($totalRows_RecMedia>0){ ?>
                  <label>
                  <select data-placeholder="請選擇分類..." class="chosen-select table_data" multiple  style="width:786px;" tabindex="4" name="d_data3[]" id="d_data3">
                  <?php
                  do {  
                  ?>
                    <option value="<?php echo $row_RecMedia['d_id']?>"><?php echo $row_RecMedia['d_title']?></option>
                    <?php
                  } while ($row_RecMedia = mysql_fetch_assoc($RecMedia));
                    $rows = mysql_num_rows($RecMedia);
                    if($rows > 0) {
                        mysql_data_seek($RecMedia, 0);
                      $row_RecMedia = mysql_fetch_assoc($RecMedia);
                    }
                  ?>
                  </select>
                  </label>
                  <?php }else{ echo "目前無內部相關報導可以選擇。"; } ?>
                  </td>
                <td width="250" bgcolor="#e5ecf6">
                  <p class="red_letter">*請直接選擇相關報導。</p>
                  </td>
              </tr>

              <tr>
                <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">內部相關影音</td>
                <td class="table_data">
                  <?php if($totalRows_RecMediaVideo>0){ ?>
                  <label>
                  <select data-placeholder="請選擇分類..." class="chosen-select table_data" multiple  style="width:786px;" tabindex="4" name="d_data4[]" id="d_data4">
                  <?php
                  do {  
                  ?>
                    <option value="<?php echo $row_RecMediaVideo['d_id']?>"><?php echo $row_RecMediaVideo['d_title']?></option>
                    <?php
                  } while ($row_RecMediaVideo = mysql_fetch_assoc($RecMediaVideo));
                    $rows = mysql_num_rows($RecMediaVideo);
                    if($rows > 0) {
                        mysql_data_seek($RecMediaVideo, 0);
                      $row_RecMediaVideo = mysql_fetch_assoc($RecMediaVideo);
                    }
                  ?>
                  </select>
                  </label>
                  <?php }else{ echo "目前無內部相關影音可以選擇。"; } ?>
                  </td>
                <td width="250" bgcolor="#e5ecf6">
                  <p class="red_letter">*請直接選擇相關影音。</p>
                  </td>
              </tr>
              </table>

              <table width="100%" border="0" cellspacing="3" cellpadding="5" id="addArea">
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">外部相關影音連結-標題1</td>
                  <td><input name="tab_title[]" type="text" class="table_data" id="tab_title1" value="" size="70" /></td>
                <td width="250" bgcolor="#e5ecf6"><p class="red_letter">*請直接填寫外部影音標題。</p></td>
                </tr>
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">外部相關影音-連結1</td>
                  <td><input name="tab_content[]" type="text" class="table_data" id="tab_content1" value="" size="70" /></td>
                <td width="250" bgcolor="#e5ecf6"><p class="red_letter">*請直接填寫外部影音連結。</p></td>
                </tr>
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">外部連結-網站名稱1</td>
                  <td><input name="tab_data1[]" type="text" class="table_data" id="tab_data1_1" value="" size="20" /></td>
                <td width="250" bgcolor="#e5ecf6"><p class="red_letter">*請直接填寫連結網站名稱。</p></td>
                </tr>
              </table>

              <table width="100%" border="0" cellspacing="3" cellpadding="5" >
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title"></td>
                  <td>
                    <table border="0" cellspacing="2" cellpadding="2">
                      <tr>
                          <td><a href="javascript:;" class="addTage"><img src="image/add.png" width="16" height="16" border="0"></a></td>
                            <td><a href="javascript:;" class="table_data addTage">新增外部相關影音連結</a></td>
                            <td class="red_letter">&nbsp;</td>
                        </tr>
                    </table>
                  </td>
                <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                </tr>
              </table>

              <table width="100%" border="0" cellspacing="3" cellpadding="5" id="addAreaOther">
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">頁籤名稱</td>
                  <td><input name="tabOther_title[]" type="text" class="table_data" id="tabOther_title1" value="" size="70" />
                    </td>
                <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                </tr>
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">頁籤內容</td>
                  <td><textarea name="tabOther_content[]" cols="100" rows="20" class="table_data tiny" id="tabOther_content1"></textarea></td>
                  <td width="250" bgcolor="#e5ecf6"><span class="note_letter">*小斷行請按Shift+Enter。</span></td>
                </tr>
              </table>

              <table width="100%" border="0" cellspacing="3" cellpadding="5" >
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title"></td>
                  <td>
                    <table border="0" cellspacing="2" cellpadding="2">
                      <tr>
                          <td><a href="javascript:;" class="addTageOther"><img src="image/add.png" width="16" height="16" border="0"></a></td>
                            <td><a href="javascript:;" class="table_data addTageOther">新增頁籤</a></td>
                            <td class="red_letter">&nbsp;</td>
                        </tr>
                    </table>
                  </td>
                <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                </tr>
              </table>


              <table width="100%" border="0" cellspacing="3" cellpadding="5">
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">時間</td>
                  <td><input name="d_date" type="text" class="table_data" id="d_date" value="<?php echo date("Y-m-d"); ?>" size="50" /></td>
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
                    
                    <table width="100%" border="0" cellspacing="5" cellpadding="2" id="addF">
                      <tr>
                        	<td height="28">
                        	<table border="0" cellspacing="2" cellpadding="2">
                        		<tr>
                            		<td><a href="javascript:addField()"><img src="image/add.png" width="16" height="16" border="0"></a></td>
                                	<td><a href="javascript:addField()" class="table_data">新增圖片</a></td>
                                	<td class="note_letter">&nbsp;</td>
                            	</tr>
                        	</table>                        	</td>
                        </tr>
                  </table>  
                    
                              </td>  
              	    <td bgcolor="#e5ecf6" class="table_col_title">
                    <p class="red_letter">*<?php echo $imagesSize[$_SESSION['nowMenu']]['note'];?></p>
                    </td>
                </tr>
                <tr>
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title">在網頁顯示</td>
                  <td><label>
                    <select name="d_active" class="table_data" id="d_active">
                      <option value="1">公佈</option>
                      <option value="0">不公佈</option>
                    </select>
                  </label></td>
                  <td bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>

                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">發佈狀態</td>
                  <td><label>
                    <select name="d_pub" class="table_data" id="d_pub">
                      <option value="0">草稿</option>
                      <option value="1">發佈</option>
                    </select></label></td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                </tr>
                <!--<tr>
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
                        	<td>
                        	<table border="0" cellspacing="2" cellpadding="2">
                        		<tr>
                            		<td><a href="javascript:addField()"><img src="image/add.png" width="16" height="16" border="0"></a></td>
                                	<td><a href="javascript:addField()" class="table_data">增加圖片</a></td>
                                	<td class="red_letter">*圖片請上傳高於 640x480 pixel 72dpi 之圖檔。</td>
                            	</tr>
                        	</table>                        	</td>
                        </tr>
                    </table>                    </td>  
              	    <td bgcolor="#e5ecf6" class="table_col_title"><p>&nbsp;</p>           	        </td>
                </tr>-->
			</table>
            </td>
		</tr>
        <tr>
        	<td>&nbsp;</td>
        </tr>
        <tr>
         	<td align="center">
            <?php 

            if(isset($_SESSION['listLinks']) && $_SESSION['listLinks']!=''){ 
                //$reviewLink = "../";
            ?>
              <a href="<?php echo $_SESSION['listLinks'];?>" class="btnType finishBtn">完成</a>
              <a href="<?php echo $reviewLink; ?>" class="btnType pubBtn" target="_blank">預覽</a>
            <?php 
              if(isset($_GET['now_d_id']) && $_GET['now_d_id']!=''){
                $_SESSION['listLinks'] = NULL;
              }              
            }else{ ?>
              <input name="submitBtn" type="submit" class="btnType" id="submitBtn" value="送出" />
            <?php } ?>

          </td>
        </tr>
	</table>
    <input type="hidden" name="MM_insert" value="form1" />

    <input name="d_class2_id" type="hidden" id="d_class2_id" value="" />
    <input name="d_class2_tag" type="hidden" id="d_class2_tag" value="" />
    <input name="d_class3_id" type="hidden" id="d_class3_id" value="" />
    <input name="d_class3_tag" type="hidden" id="d_class3_tag" value="" />
    <input name="d_data3_id" type="hidden" id="d_data3_id" value="" />
    <input name="d_data3_tag" type="hidden" id="d_data3_tag" value="" />
    <input name="d_data4_id" type="hidden" id="d_data4_id" value="" />
    <input name="d_data4_tag" type="hidden" id="d_data4_tag" value="" />
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


<script src="jquery/chosen_v1.5.1/chosen.jquery.js" type="text/javascript"></script>
<script src="../js/datetimepicker-master/build/jquery.datetimepicker.full.js"></script>

<script src="tinyfyOther.js"></script>

<script type="text/javascript">
    /*var config = {
      '.chosen-select'           : {}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }*/
function checkSelect(id){
  var idA = "";
  var tagA = "";
  var leg = $("#"+id).find(":selected").length;
  $("#"+id).find(":selected").each(function(i) {
      // console.log(this.text);    //  文字
      // console.log(this.value);   //  值

      if(this.value!=""){
        if(i==(leg-1)){
          idA = idA + this.value;  
          tagA = tagA + this.text;
        }else if(i==0){
          idA = this.value + ',';
          tagA = this.text + ',';
        }else{
          idA = idA + this.value + ',';  
          tagA = tagA + this.text + ',';
        }
      }

      $("#"+id+"_id").val(idA);
      $("#"+id+"_tag").val(tagA);
      
  });
}

$(document).ready(function(){

  checkSelect("d_class2");
  checkSelect("d_class3");
  checkSelect("d_data3");
  checkSelect("d_data4");

  $(".chosen-select")
  .chosen({no_results_text: "沒有找到符合的關鍵字！"})
  .on('change', function(){
    //console.log( $(this).find(":selected").text() );
    var id = $(this).attr('id');
    checkSelect($(this).attr('id'));
  });

  $.datetimepicker.setLocale('zh-TW');
  $('#d_date').datetimepicker({
    timepicker:false,
    format:'Y-m-d',
    dayOfWeekStart : 1
  });


  $('.addTage').on('click', function(){
    var rowindex = (($('#addArea tr').length)/3)+1;
    //var rowindex = $("#addArea").closest('tr').index();
    // console.debug('rowindex', rowindex);
    // console.log('rowindex', rowindex);
    console.log("tab_title = "+ $("#tab_title"+(rowindex-1)).val());
    console.log("tab_content = "+ $("#tab_content"+(rowindex-1)).val());

    if( ($("#tab_title"+(rowindex-1)).val()=="") || ($("#tab_content"+(rowindex-1)).val()=="") ){
      alert("尚有外部相關影音標題或連結未填寫!!");
    }else{
      //var addTxt = '<tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">外部相關影音連結'+rowindex+'</td><td><input name="tab_title[]" type="text" class="table_data" id="tab_title'+rowindex+'" value="" size="70" /></td><td width="250" bgcolor="#e5ecf6">&nbsp;</td></tr>';

      //var addTxt = '<tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">外部相關影音連結'+rowindex+'</td><td><input name="tab_content[]" type="text" class="table_data" id="tab_content'+rowindex+'" value="" size="70" /></td><td width="250" bgcolor="#e5ecf6"><p class="red_letter">*請直接填寫外部影音連結。</p></td></tr><tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">外部連結網站名稱'+rowindex+'</td><td><input name="tab_title[]" type="text" class="table_data" id="tab_title'+rowindex+'" value="" size="70" /></td><td width="250" bgcolor="#e5ecf6"><p class="red_letter">*請直接填寫連結網站名稱。</p></td></tr>';

      var addTxt = '<tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">外部相關影音連結-標題'+rowindex+'</td><td><input name="tab_title[]" type="text" class="table_data" id="tab_title'+rowindex+'" value="" size="70" /></td><td width="250" bgcolor="#e5ecf6"><p class="red_letter">*請直接填寫外部影音標題。</p></td></tr><tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">外部相關影音-連結'+rowindex+'</td><td><input name="tab_content[]" type="text" class="table_data" id="tab_content'+rowindex+'" value="" size="70" /></td><td width="250" bgcolor="#e5ecf6"><p class="red_letter">*請直接填寫外部影音連結。</p></td></tr><tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">外部連結-網站名稱'+rowindex+'</td><td><input name="tab_data1[]" type="text" class="table_data" id="tab_data1_'+rowindex+'" value="" size="20" /></td><td width="250" bgcolor="#e5ecf6"><p class="red_letter">*請直接填寫連結網站名稱。</p></td></tr>';

      $('#addArea').append(addTxt);

    }
  });

});
</script>

</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($RecAwardT);

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {


 $d_tag = '';
 $class3 = '';
 /*if(isset($_POST['d_class2'])){
 	$d_tag = $_POST['d_class2'];
 }*/
 $d_tag = is_null(checkV('d_class2')) ? NULL : implode (",", checkV('d_class2'));
 
 //echo 'd_tag = '.$d_tag.'<br>';
 
 $tagA = $_POST['d_class2'];
 $tagTMP =  "";
 $d_tagTXT = $_POST['d_class2_tag'].",".$_POST['d_class3_tag'].",".$_POST['d_data3_tag'].",".$_POST['d_data4_tag'];
 //echo 'tagA = '.$tagA.'<br>';
 
 $d_title	= checkV('d_title');
 $d_title_en = checkV('d_title_en');
 $d_content	= checkV('d_content');
 $d_class1	= checkV('d_class1');

 //年份
 $d_class2 = $d_tag;

 //獎項
 $d_class3	= is_null(checkV('d_class3')) ? NULL : implode (",", checkV('d_class3'));
 $tagB = $_POST['d_class3'];


 $d_class4	= checkV('d_class4');
 $d_class5	= checkV('d_class5');
 $d_class6	= checkV('d_class6');
 $d_date	= checkV('d_date');
 $d_active  = checkV('d_active');
 $d_pub  = checkV('d_pub'); 
 
 $d_data1 = checkV('d_data1');
 $d_data2 = checkV('d_data2');

 //相關報導
 $d_data3	= is_null(checkV('d_data3')) ? NULL : implode (",", checkV('d_data3'));
 //相關連結
 $d_data4	= is_null(checkV('d_data4')) ? NULL : implode (",", checkV('d_data4'));

  
  $insertSQL = sprintf("INSERT INTO data_set (d_title, d_title_en, d_content, d_class1, d_class2, d_tag, d_tag_txt, d_class3, d_class4, d_class5, d_class6, d_data1, d_data2, d_data3, d_data4, d_date, d_active, d_pub) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($d_title, "text"),
                       GetSQLValueString($d_title_en, "text"),
                       GetSQLValueString($d_content, "text"),
                       GetSQLValueString($d_class1, "text"),
                       GetSQLValueString($d_class2, "text"),
                       GetSQLValueString($d_tag, "text"),
                       GetSQLValueString($d_tagTXT, "text"),
                       GetSQLValueString($d_class3, "text"),
                       GetSQLValueString($d_class4, "text"),
                       GetSQLValueString($d_class5, "text"),
                       GetSQLValueString($d_class6, "text"),
                       GetSQLValueString($d_data1, "text"),
                       GetSQLValueString($d_data2, "text"),
                       GetSQLValueString($d_data3, "text"),
                       GetSQLValueString($d_data4, "text"),
                       GetSQLValueString($d_date, "date"),
                       GetSQLValueString($d_active, "int"),
                       GetSQLValueString($d_pub, "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());

  $new_data_num = mysql_insert_id();

  //紀錄獎項關係
  $i=1;      
  foreach ($tagA as $tagO){
    $insertSQL = sprintf("INSERT INTO term_relationships (object_id, term_taxonomy_id) VALUES (%s, %s)",
                       GetSQLValueString($new_data_num, "int"),
                       GetSQLValueString($tagO, "int"));

      mysql_select_db($database_connect2data, $connect2data);
      $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());

      if($i==1){
        $tagTMP = $tagO;  
      }
      $i++;
  }

  //紀錄年份關係
   $i=1;    
   foreach ($tagB as $tagO){ 
      
    $insertSQL = sprintf("INSERT INTO term_relationships (object_id, term_taxonomy_id) VALUES (%s, %s)",
                       GetSQLValueString($new_data_num, "int"),
                       GetSQLValueString($tagO, "int"));

      mysql_select_db($database_connect2data, $connect2data);
        $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());

    /*if($i==1){
      $tagTMP = $tagO;
    }*/
    $i++;
   
    
  }

  //紀錄年份標籤
  /*$i=1;      
  foreach ($tagA as $tagO){
    $insertSQL = sprintf("INSERT INTO term_relationships (object_id, term_taxonomy_id) VALUES (%s, %s)",
                       GetSQLValueString($new_data_num, "int"),
                       GetSQLValueString($tagO, "int"));

      mysql_select_db($database_connect2data, $connect2data);
      $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());

      if($i==1){
        $tagTMP = $tagO;  
      }
      $i++;

      mysql_select_db($database_connect2data, $connect2data);
      $query_RecYears = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='years' AND T.term_active='1' AND term_id='$tagO'";
      $RecYears = mysql_query($query_RecYears, $connect2data) or die(mysql_error());
      $row_RecYears = mysql_fetch_assoc($RecYears);
      $totalRows_RecYears = mysql_num_rows($RecYears);

      if($row_RecYears['name']!=''){
        $d_tagTXT = $d_tagTXT.$row_RecYears['name'].",";
      }
      if($row_RecYears['name_en']!=''){
        $d_tagTXT = $d_tagTXT.$row_RecYears['name_en'].",";
      }
  }  

  $updateSQL = sprintf("UPDATE data_set SET d_tag_txt=%s WHERE d_id=%s",
                       GetSQLValueString($d_tagTXT, "text"),
                       GetSQLValueString($d_id, "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());*/

  //----------插入動態相關外部連結到資料庫begin(須放入插入主資料後)----------

  if(isset($_POST['tab_title'])){

    $tab_title    = $_POST['tab_title'];
    $tab_content  = $_POST['tab_content'];
    $tab_data1    = $_POST['tab_data1'];

    for($j=0; $j<count($tab_title); $j++){

      if($tab_title[$j]!='' && $tab_content[$j]!=''){

        $insertSQL = sprintf("INSERT INTO tab_set (tab_d_id, tab_type, tab_title, tab_content, tab_data1, tab_sort) VALUES (%s, %s, %s, %s, %s, %s)",
                           GetSQLValueString($new_data_num, "int"),
                           GetSQLValueString($d_class1, "text"),
                           GetSQLValueString($tab_title[$j], "text"),
                           GetSQLValueString($tab_content[$j], "text"),
                           GetSQLValueString($tab_data1[$j], "text"),
                           GetSQLValueString($j+1, "int"));
      
              mysql_select_db($database_connect2data, $connect2data);
              $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
      }
    }

  }
  //----------插入動態相關外部連結到資料庫end----------



  //----------插入動態頁籤資料到資料庫begin(須放入插入主資料後)----------

  if(isset($_POST['tabOther_title'])){

    $tabOther_title = $_POST['tabOther_title'];
    $tabOther_content = $_POST['tabOther_content'];

    for($j=0; $j<count($tabOther_title); $j++){

      if($tabOther_title[$j]!='' || $tabOther_content[$j]!=''){

        $insertSQL = sprintf("INSERT INTO tab_set (tab_d_id, tab_type, tab_title, tab_content, tab_sort) VALUES (%s, %s, %s, %s, %s)",
                           GetSQLValueString($new_data_num, "int"),
                           GetSQLValueString('ownerOther', "text"),
                           GetSQLValueString($tabOther_title[$j], "text"),
                           GetSQLValueString($tabOther_content[$j], "text"),
                           GetSQLValueString($j+1, "int"));
      
              mysql_select_db($database_connect2data, $connect2data);
              $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
      }
    }

  }
  //----------插入動態頁籤資料到資料庫end----------
  
    //----------插入圖片資料到資料庫begin(須放入插入主資料後)----------
			
	$image_result=image_process($_FILES['image'], $_REQUEST['image_title'], "owner","add", $imagesSize[$_SESSION['nowMenu']]['IW'], $imagesSize[$_SESSION['nowMenu']]['IH']);
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
			
		$file_result=file_process("owner","add");
	
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


    mysql_select_db($database_connect2data, $connect2data);
    $query_RecOwner = "SELECT * FROM term_relationships AS TR, data_set AS D, terms AS T
    WHERE TR.term_taxonomy_id = T.term_id AND D.d_id = TR.object_id AND T.term_id='$tagTMP' ORDER BY term_order ASC, d_date DESC";
    $RecOwner = mysql_query($query_RecOwner, $connect2data) or die(mysql_error());
    $row_RecOwner = mysql_fetch_assoc($RecOwner);
    $totalRows_RecOwner = mysql_num_rows($RecOwner);

    $_SESSION['totalRows'] = $totalRows_RecOwner;
	
	
  $_SESSION['original_selected'] = $_SESSION['selected_awardT'] = $tagTMP;


  $stringLink = "?sel=".$tagTMP."&pageNum=0&totalRows_RecOwner=".$_SESSION['totalRows']."&changeSort=1&now_d_id=".$new_data_num."&change_num=1";
  
  $insertGoTo = "owner_list.php".$stringLink;


  //$insertGoTo = "owner_list.php?sel=".$tagTMP."&pageNum=0&totalRows_RecOwner=".$_SESSION['totalRows']."&changeSort=1&now_d_id=".$new_data_num."&change_num=1";
  
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }

  $_SESSION['listLinks'] = $insertGoTo;

  $selfLink = "owner_add.php".$stringLink;
  
  if($image_result[0][0]==1)
  {
  		echo "<script type=\"text/javascript\">call_alert('".$selfLink."');</script>";
  }else
  {
  		header(sprintf("Location: %s", $selfLink));
  }
  
}
?>

