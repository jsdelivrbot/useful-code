<?php require_once('../sstart.php'); ?>
<?php require_once('../Connections/connect2data.php'); ?>
<?php require_once('photo_process_media.php'); ?>
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

if(!in_array(5,$_SESSION['MM_Limit']['a7'])){
	header("Location: media_list.php");
}


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$colname_RecMedia = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecMedia = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecMedia = sprintf("SELECT * FROM term_relationships AS TR, data_set AS D, terms AS T WHERE TR.term_taxonomy_id = T.term_id AND D.d_id = TR.object_id AND D.d_class1='media' AND D.d_id = %s", GetSQLValueString($colname_RecMedia, "int"));
$RecMedia = mysql_query($query_RecMedia, $connect2data) or die(mysql_error());
$row_RecMedia = mysql_fetch_assoc($RecMedia);
$totalRows_RecMedia = mysql_num_rows($RecMedia);

if($totalRows_RecMedia==0){
  header("Location: media_list.php");
}

if (!(strcmp(1, $row_RecMedia['d_class3']))) {
  $typ = 'image';
}elseif (!(strcmp(2, $row_RecMedia['d_class3']))) {
  $typ = 'videoImage';
}elseif (!(strcmp(3, $row_RecMedia['d_class3']))) {
  $typ = 'photoImage';
}

$colname_RecImage = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecImage = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecImage = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'image' ORDER BY file_id ASC", GetSQLValueString($colname_RecImage, "int"));
$RecImage = mysql_query($query_RecImage, $connect2data) or die(mysql_error());
$row_RecImage = mysql_fetch_assoc($RecImage);
$totalRows_RecImage = mysql_num_rows($RecImage);

$colname_RecPhotoImage = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecPhotoImage = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecPhotoImage = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'photoImage' ORDER BY file_id ASC", GetSQLValueString($colname_RecPhotoImage, "int"));
$RecPhotoImage = mysql_query($query_RecPhotoImage, $connect2data) or die(mysql_error());
$row_RecPhotoImage = mysql_fetch_assoc($RecPhotoImage);
$totalRows_RecPhotoImage = mysql_num_rows($RecPhotoImage);

$colname_RecVideoImage = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecVideoImage = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecVideoImage = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'videoImage' ORDER BY file_id ASC", GetSQLValueString($colname_RecVideoImage, "int"));
$RecVideoImage = mysql_query($query_RecVideoImage, $connect2data) or die(mysql_error());
$row_RecVideoImage = mysql_fetch_assoc($RecVideoImage);
$totalRows_RecVideoImage = mysql_num_rows($RecVideoImage);

$colname_RecThumbnail = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecThumbnail = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecThumbnail = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'youtubeThumbnail'", GetSQLValueString($colname_RecThumbnail, "int"));
$RecThumbnail = mysql_query($query_RecThumbnail, $connect2data) or die(mysql_error());
$row_RecThumbnail = mysql_fetch_assoc($RecThumbnail);
$totalRows_RecThumbnail = mysql_num_rows($RecThumbnail);

$colname_RecFile = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecFile = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecFile = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'file' ORDER BY file_id ASC", GetSQLValueString($colname_RecFile, "int"));
$RecFile = mysql_query($query_RecFile, $connect2data) or die(mysql_error());
$row_RecFile = mysql_fetch_assoc($RecFile);
$totalRows_RecFile = mysql_num_rows($RecFile);

//echo 'selected_mediaT = '.$_SESSION['selected_mediaT'];
$G_sel = '';
if (isset($_SESSION['selected_mediaT'])){
	$G_sel = $_SESSION['selected_mediaT'] = $row_RecMedia['term_id'];
	//echo 'G_sel = '.$G_sel;
}

mysql_select_db($database_connect2data, $connect2data);
$query_RecMediaT = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='mediaT' AND T.term_active='1' ORDER BY term_sort ASC, term_id DESC";
$RecMediaT = mysql_query($query_RecMediaT, $connect2data) or die(mysql_error());
$row_RecMediaT = mysql_fetch_assoc($RecMediaT);
$totalRows_RecMediaT = mysql_num_rows($RecMediaT);

$menu_is="media";

//記錄帶資料去別地方的資訊
$_SESSION['nowPage']=$selfPage;
$_SESSION['nowMenu']= "media";
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
			//updateData();
		}
	});


  var fancyApp = $("a.fancyboxUpload").fancybox({
    type: 'iframe',   
    openEffect  : 'fade',
    closeEffect : 'fade',
    autoSize    : false,
    width       : '1000',
    closeBtn    : false,
     helpers : {
      overlay : {
        closeClick : false,
        css : {
          'background' : 'rgba(0, 0, 0, 0.7)'
        }
      }
    },
    beforeShow  : function() {
      //updateData();
    },
    afterClose  : function() {
      window.location.reload();
    }
  });
	
	
	
});
<?php
			/*if( isset($_SESSION["change_image"]) && ($_SESSION["change_image"]==1) )
			{
				$_SESSION["change_image"]=0;
				echo "window.location.reload();";
			}*/
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
			console.log('image'+lastRow);
			
			if(myField.value){
          var aTr=pTable.insertRow(lastRow);
          var newRow = lastRow+1;
          var newImg='img'+(newRow);
          var aTd1=aTr.insertCell(0);
          aTd1.innerHTML = '<span class="table_data">選擇圖片： </span><input name="image[]" type="file" class="table_data" id="image'+newRow+'"><br><span class="table_data">圖片標題： </span><input name="image_title[]" type="text" class="table_data" id="image_title'+newRow+'">';
        }else{
          alert("尚有未選取之圖片欄位!!");
        }
		}
    
    function addField3() {
      var pTable=document.getElementById('pTable3');
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
          aTd1.innerHTML = '<span class="table_data">選擇圖片： </span><input name="image[]" type="file" class="table_data" id="image'+newRow+'"><br><span class="table_data">圖片標題： </span><input name="image_title[]" type="text" class="table_data" id="image_title'+newRow+'">';
        }else{
          alert("尚有未選取之圖片欄位!!");
        }
    }
    
    function addField4() {
      var pTable=document.getElementById('pTable4');
      var lastRow = pTable.rows.length;
      //alert(pTable.rows.length);
      var myField=document.getElementById('imagePhoto'+lastRow);
      //alert('imagePhoto'+lastRow);
      console.log('imagePhoto'+lastRow);
      
      if(myField.value){
          var aTr=pTable.insertRow(lastRow);
          var newRow = lastRow+1;
          var newImg='img'+(newRow);
          var aTd1=aTr.insertCell(0);
          aTd1.innerHTML = '<span class="table_data">選擇圖片： </span><input name="imagePhoto[]" type="file" class="table_data" id="imagePhoto'+newRow+'"><br><span class="table_data">圖片說明： </span><input name="imagePhoto_title[]" type="text" class="table_data" id="imagePhoto_title'+newRow+'"><div class="imageContent"><span class="table_data">圖片說明：</span><textarea name="imagePhoto_content[]" cols="100" rows="5" class="table_data" id="imagePhoto_content'+newRow+'"></textarea></div>';
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
<link rel="stylesheet" href="jquery/chosen_v1.5.1/chosen.css">
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
            <td width="30%" class="list_title">修改媒體專區</td>
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

      if( (isset($row_RecMedia['d_class3'])&&$row_RecMedia['d_class3']!="") ){

        if( (isset($row_RecMedia['d_id'])&&$row_RecMedia['d_id']!='') && (isset($row_RecMedia['d_class2'])&&$row_RecMedia['d_class2']!='') ){

          if($row_RecMedia['d_class3']=="1"){//一般

            $reviewLink = "http://".$_SERVER['HTTP_HOST'].$nowFile."/"."media_detail.php?cat=".$row_RecMedia['d_class2']."&id=".$row_RecMedia['d_id'];

          }elseif($row_RecMedia['d_class3']=="2"){//影片

            $reviewLink = "http://".$_SERVER['HTTP_HOST'].$nowFile."/"."media.php?cat=".$row_RecMedia['d_class2']."&y=".(date("Y", strtotime($row_RecMedia['d_date'])));
            
          }elseif($row_RecMedia['d_class3']=="3"){//照片\

            $reviewLink = "http://".$_SERVER['HTTP_HOST'].$nowFile."/"."photo_detail.php?cat=".$row_RecMedia['d_class2']."&id=".$row_RecMedia['d_id'];
            
          }else{
            $reviewLink = "http://".$_SERVER['HTTP_HOST'].$nowFile."/"."media.php";
          }

        }else{
          $reviewLink = "http://".$_SERVER['HTTP_HOST'].$nowFile."/"."media.php";
        }

      }else{
        $reviewLink = "http://".$_SERVER['HTTP_HOST'].$nowFile."/"."media.php";
      }

      if(isset($_SESSION['listLinks']) && $_SESSION['listLinks']!=''){ 
      ?>
        <a href="<?php echo $_SESSION['listLinks'];?>" class="btnType finishBtn">完成</a>
        <a href="<?php echo $reviewLink; ?>" class="btnType pubBtn" target="_blank">預覽</a>
      <?php } ?>

      <p><a href="<?php echo $reviewLink; ?>" class="pubBtn red_letter" target="_blank">預覽網址:<?php echo $reviewLink; ?></a></p>
    </div>

    <table width="100%" border="0" cellpadding="0" cellspacing="0">
  		<tr>
   			<td>
            <table width="100%" border="0" cellpadding="5" cellspacing="3">
            	<tr>
            	  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">分類</td>
            	  <td>
            	    <label>
            	      <select data-placeholder="請選擇分類..." class="chosen-select table_data" style="width:400px;" tabindex="4" name="d_class2[]" id="d_class2">
            	        <?php
do {
	$selA = explode(',',$row_RecMedia['d_tag']);
  //echo "selA = ".$selA;
  //var_dump($selA);
	if (in_array($row_RecMediaT['term_id'], $selA)){
		$sel = "selected=\"selected\"";
	}else{
		$sel = "";
	}
?>
            	        <option value="<?php echo $row_RecMediaT['term_id']?>"<?php echo $sel; ?> data-group="<?php echo $row_RecMediaT['term_group']?>"><?php echo $row_RecMediaT['name']?><?php //echo $row_RecMediaT['term_id']?></option>
            	        <?php
} while ($row_RecMediaT = mysql_fetch_assoc($RecMediaT));
  $rows = mysql_num_rows($RecMediaT);
  if($rows > 0) {
      mysql_data_seek($RecMediaT, 0);
	  $row_RecMediaT = mysql_fetch_assoc($RecMediaT);
  }
?>
            	        </select></label>
            	    </td>
            	  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
          	  </tr>
            	
            	<tr>
            	  <td align="center" bgcolor="#e5ecf6" class="table_col_title">標題</td>
            	  <td><input name="d_title" type="text" class="table_data" id="d_title" value="<?php echo $row_RecMedia['d_title']; ?>" size="50" />
          	    </td>

            	  <td bgcolor="#e5ecf6">                  
            	    <input name="d_id" type="hidden" id="d_id" value="<?php echo $row_RecMedia['d_id']; ?>" />
                    <input name="term_order" type="hidden" id="term_order" value="<?php echo $row_RecMedia['term_order']; ?>" />
                    <input name="term_group" type="hidden" id="term_group" value="<?php echo $row_RecMedia['d_class3']; ?>" />
                    <?php //echo $row_RecUnitary['term_order']; ?>
                  </td>
          	  </tr>

            	<tr id="content1">
            	  <td align="center" bgcolor="#e5ecf6" class="table_col_title">內容</td>
            	  <td><textarea name="d_content" cols="100" rows="20" class="table_data tiny" id="d_content"><?php if (!(strcmp(1, $row_RecMedia['d_class3']))) { echo $row_RecMedia['d_content'];} ?></textarea></td>
            	  <td bgcolor="#e5ecf6"><p class="red_letter">*小斷行請按Shift+Enter。<br />
            	    輸入區域的右下角可以調整輸入空間的大小。</p>
            	    <!-- <p class="red_letter">*圖片請上傳寬不大於900 pixel 72dpi之圖檔。</p> --></td>
            	  </tr>

              <tr id="content2">
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">內容</td>
                <td><textarea name="d_content2" cols="100" rows="20" class="table_data" id="d_content2"><?php if ((!(strcmp(2, $row_RecMedia['d_class3']))) || (!(strcmp(3, $row_RecMedia['d_class3'])))) { echo $row_RecMedia['d_content'];} ?></textarea></td>
                <td bgcolor="#e5ecf6"><p class="red_letter">*小斷行請按Shift+Enter。<br />
                  輸入區域的右下角可以調整輸入空間的大小。</p>
                  <!-- <p class="red_letter">*圖片請上傳寬不大於900 pixel 72dpi之圖檔。</p> --></td>
                </tr>

                <tr id="youtubeCode">
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title">youtube影片碼</td>
                  <td>
                  <input name="d_data1" type="text" class="table_data" id="d_data1" value="<?php echo $row_RecMedia['d_data1']; ?>" size="70" />
                  <input name="re_data1" type="hidden" id="re_data1" value="<?php echo $row_RecMedia['d_data1']; ?>" />
                  </td>
                  <td bgcolor="#e5ecf6"><p class="red_letter_2">請先自行將影片上傳至 youtube後，再將影片碼輸入於左方文字欄位。<br />
                  例如，影片網址為：https://www.youtube.com/watch?v=P92oRX-LJac，網址watch?v=後面則為影片碼( P92oRX-LJac )。</p></td>
                </tr>

                <?php if ($totalRows_RecThumbnail > 0) { // Show if recordset not empty ?>
                <tr>
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title">目前 Youtube 圖片<a name="imageEdit" id="imageEdit"></a></td>
                  <td><?php do { ?>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="100" rowspan="2" align="center"><a href="../<?php echo $row_RecThumbnail['file_link1'].'?'.(mt_rand(1,100000)/100000); ?>" class="fancyboxImg" rel="group" title="<?php echo $row_RecThumbnail['file_title']; ?>"><img src="../<?php echo $row_RecThumbnail['file_link2'].'?'.(mt_rand(1,100000)/100000); ?>" alt="" class="image_frame"  width="100"/></a></td>
                                  <td align="left" class="table_data">&nbsp;圖片說明：<?php echo $row_RecThumbnail['file_title']; ?></td>
                            </tr>
                        <tr>
                          <td align="left" class="table_data">&nbsp;<input name="Thumbnail_id" type="hidden" id="Thumbnail_id" value="<?php echo $row_RecThumbnail['file_id']; ?>" /></td>
                            </tr>                          
                      </table>
                      <?php } while ($row_RecThumbnail = mysql_fetch_assoc($RecThumbnail)); ?></td>
                  <td bgcolor="#e5ecf6" class="table_col_title"><p class="red_letter">*若無上傳封面，則會自動使用youtube圖片</p></td>
                </tr>
              <?php } // Show if recordset not empty ?>
            	

                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">時間</td>
                  <td><input name="d_date" type="text" class="table_data" id="d_date" value="<?php echo ( (date("Y-m-d", strtotime($row_RecMedia['d_date']))=='') || (!(strcmp("0000-00-00 ", date("Y-m-d", strtotime($row_RecMedia['d_date']))))) ) ? date("Y-m-d") : date("Y-m-d", strtotime($row_RecMedia['d_date'])); ?>" size="50" /></td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                </tr>

                <tr>
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title">在網頁顯示</td>
                  <td><label>
                    <select name="d_active" class="table_data" id="d_active">
                      <option value="0" <?php if (!(strcmp(0, $row_RecMedia['d_active']))) {echo "selected=\"selected\"";} ?>>不公佈</option>
                      <option value="1" <?php if (!(strcmp(1, $row_RecMedia['d_active']))) {echo "selected=\"selected\"";} ?>>公佈</option>
                    </select>
                  </label></td>
                  <td bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>

                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">發佈狀態</td>
                  <td><label>
                    <select name="d_pub" class="table_data" id="d_pub">
                      <option value="1" <?php if (!(strcmp(1, $row_RecMedia['d_pub']))) {echo "selected=\"selected\"";} ?>>發佈</option><option value="0" <?php if (!(strcmp(0, $row_RecMedia['d_pub']))) {echo "selected=\"selected\"";} ?>>草稿</option>
                    </select></label></td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                </tr>

                <?php if ($totalRows_RecImage > 0) { // Show if recordset not empty ?>
                  <tr class="media">
                    <td align="center" bgcolor="#e5ecf6" class="table_col_title">目前圖片<a name="imageEdit" id="imageEdit"></a></td>
                    <td><?php do { ?>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="100" rowspan="2" align="center"><a href="../<?php echo $row_RecImage['file_link1'].'?'.(mt_rand(1,100000)/100000); ?>" class="fancyboxImg" rel="group" title="<?php echo $row_RecImage['file_title']; ?>" name="img<?php echo $row_RecImage['file_id']; ?>"><img src="../<?php echo $row_RecImage['file_link2'].'?'.(mt_rand(1,100000)/100000); ?>" alt="" class="image_frame" width="100" /></a></td>
                                    <td align="left" class="table_data">&nbsp;圖片說明：<?php echo $row_RecImage['file_title']; ?></td>
                              </tr>
                          <tr>
                            <td align="left" class="table_data">&nbsp;</td>
                              </tr>
                          <tr>
                            <td align="center">
                            <a href="image_edit.php?file_id=<?php echo $row_RecImage['file_id']; ?>&type=media" class="fancyboxEdit" title="修改圖片"><img src="image/media_edit.gif" width="16" height="16" title="修改圖片"/></a>
                            <a href="image_del.php?file_id=<?php echo $row_RecImage['file_id']; ?>&type=media" class="fancyboxEdit" title="刪除圖片"><img src="image/media_delete.gif" width="16" height="16" title="刪除圖片"/></a>
                            </td>
                                            <td align="center">&nbsp;</td>
                                </tr>
                        </table>
                        <?php } while ($row_RecImage = mysql_fetch_assoc($RecImage)); ?></td>
                    <td bgcolor="#e5ecf6" class="table_col_title"><p class="red_letter">*<?php echo $imagesSize[$_SESSION['nowMenu']]['note'];?></p>
                      </td>
                  </tr>
                <?php } // Show if recordset not empty ?>

                
                  <tr class="media">
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
                    <p class="red_letter">*<?php echo $imagesSize[$_SESSION['nowMenu']]['note'];?></p></td>
                </tr>



                <?php if ($totalRows_RecVideoImage > 0) { // Show if recordset not empty ?>
                  <tr class="mediaVideo">
                    <td align="center" bgcolor="#e5ecf6" class="table_col_title">目前圖片<a name="imageEdit" id="imageEdit"></a></td>
                    <td><?php do { ?>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="100" rowspan="2" align="center"><a href="../<?php echo $row_RecVideoImage['file_link1'].'?'.(mt_rand(1,100000)/100000); ?>" class="fancyboxImg" rel="group" title="<?php echo $row_RecVideoImage['file_title']; ?>" name="img<?php echo $row_RecVideoImage['file_id']; ?>"><img src="../<?php echo $row_RecVideoImage['file_link2'].'?'.(mt_rand(1,100000)/100000); ?>" alt="" class="image_frame" width="100" /></a></td>
                                    <td align="left" class="table_data">&nbsp;圖片說明：<?php echo $row_RecVideoImage['file_title']; ?></td>
                              </tr>
                          <tr>
                            <td align="left" class="table_data">&nbsp;</td>
                              </tr>
                          <tr>
                            <td align="center">
                            <a href="image_edit.php?file_id=<?php echo $row_RecVideoImage['file_id']; ?>&type=mediaVideo" class="fancyboxEdit" title="修改圖片"><img src="image/media_edit.gif" width="16" height="16" title="修改圖片"/></a>
                            <a href="image_del.php?file_id=<?php echo $row_RecVideoImage['file_id']; ?>&type=mediaVideo" class="fancyboxEdit" title="刪除圖片"><img src="image/media_delete.gif" width="16" height="16" title="刪除圖片"/></a>
                            </td>
                                            <td align="center">&nbsp;</td>
                                </tr>
                        </table>
                        <?php } while ($row_RecVideoImage = mysql_fetch_assoc($RecVideoImage)); ?></td>
                    <td bgcolor="#e5ecf6" class="table_col_title"><p class="red_letter">*<?php echo $imagesSize['mediaVideo']['note'];?></p>
                      </td>
                  </tr>
                <?php } // Show if recordset not empty ?>

                <?php if ($totalRows_RecVideoImage == 0) { // Show if recordset empty ?>  
                  <tr class="mediaVideo">
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳圖片</p></td>
                    <td>
                    <table width="100%" border="0" cellpadding="2" cellspacing="2" bordercolor="#CCCCCC" class="data" id="pTable3">
                      <tr>
                        <td> <span class="table_data">選擇圖片：</span>
                          <input name="imageVideo[]" type="file" class="table_data" id="imageVideo1" />
                          <br>
                          <span class="table_data">圖片說明：</span>
                          <input name="imageVideo_title[]" type="text" class="table_data" id="imageVideo_title1">                         </td>
                      </tr>
                    </table> 
                              </td>  
                    <td bgcolor="#e5ecf6" class="table_col_title">
                    <p class="red_letter">*<?php echo $imagesSize['mediaVideo']['note'];?></p></td>
                </tr>
                <?php } // Show if recordset not empty ?>



                <?php if ($totalRows_RecPhotoImage > 0) { // Show if recordset not empty ?>
                  <tr class="mediaPhoto">
                    <td align="center" bgcolor="#e5ecf6" class="table_col_title">目前圖片<a name="imageEdit" id="imageEdit"></a></td>
                    <td>
                    <?php $i=1;?><?php do { ?>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="100" align="center" valign="top"><a href="../<?php echo $row_RecPhotoImage['file_link1'].'?'.(mt_rand(1,100000)/100000); ?>" class="fancyboxImg" rel="group" title="<?php echo $row_RecPhotoImage['file_title']; ?>"  name="img<?php echo $row_RecPhotoImage['file_id']; ?>" ><img src="../<?php echo $row_RecPhotoImage['file_link2'].'?'.(mt_rand(1,100000)/100000); ?>" alt="" class="image_frame" width="100" /></a>
                            
                            <a href="image_edit.php?file_id=<?php echo $row_RecPhotoImage['file_id']; ?>&type=mediaPhoto" class="fancyboxEdit" title="修改圖片"><img src="image/media_edit.gif" width="16" height="16" title="修改圖片"/></a>
                              <a href="image_del.php?file_id=<?php echo $row_RecPhotoImage['file_id']; ?>&type=mediaPhoto" class="fancyboxEdit" title="刪除圖片"><img src="image/media_delete.gif" width="16" height="16" title="刪除圖片"/></a>
                            </td>
                            
                            <td align="left" class="table_data">&nbsp;圖片標題：<input name="imagePhotoNow_title[]" type="text" class="table_data" id="imagePhotoNow_title<?php echo $row_RecPhotoImage['file_id']; ?>" value="<?php echo $row_RecPhotoImage['file_title']; ?>">
                              <br>
                              &nbsp;圖片說明：<div style="padding-left: 4px;">
                                <textarea name="imagePhotoNow_content[]" cols="70" rows="5" class="table_data" id="imagePhotoNow_content<?php echo $row_RecPhotoImage['file_id']; ?>"><?php echo $row_RecPhotoImage['file_content']; ?></textarea>
                                </div>

                                <input type="hidden" name="imagePhotoNow_id[]" value="<?php echo $row_RecPhotoImage['file_id']; ?>" />
                              </td>
                          </tr>

                          <tr>
                            <td align="center">
                              
                              </td>
                            <td align="center">&nbsp;</td>
                          </tr>
                        </table>
                        <?php $i++; ?>
                        <?php } while ($row_RecPhotoImage = mysql_fetch_assoc($RecPhotoImage)); ?></td>
                    <td bgcolor="#e5ecf6" class="table_col_title"><p class="red_letter">*<?php echo $imagesSize['mediaPhoto']['note'];?></p>
                      </td>
                  </tr>
                <?php } // Show if recordset not empty ?>

                 
                <?php if(0){ ?>
                <tr class="mediaPhoto">
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳圖片</p></td>
                    <td>
                    <table width="100%" border="0" cellpadding="2" cellspacing="2" bordercolor="#CCCCCC" class="data" id="pTable4">
                      <tr>
                        <td> <span class="table_data">選擇圖片：</span>
                          <input name="imagePhoto[]" type="file" class="table_data" id="imagePhoto1" />
                          <br>
                          <span class="table_data">圖片標題：</span>
                          <input name="imagePhoto_title[]" type="text" class="table_data" id="imagePhoto_title1">
                          <div class="imageContent">
                            <span class="table_data">圖片說明：</span>
                            <textarea name="imagePhoto_content[]" cols="100" rows="5" class="table_data" id="imagePhoto_content1"></textarea>
                          </div>
                        </td>
                      </tr>
                    </table>
                    <table width="100%" border="0" cellspacing="5" cellpadding="2" id="addF">
                      <tr>
                          <td height="28">
                          <table border="0" cellspacing="2" cellpadding="2">
                            <tr>
                                <td><a href="javascript:addField4()"><img src="image/add.png" width="16" height="16" border="0"></a></td>
                                  <td><a href="javascript:addField4()" class="table_data">新增圖片</a></td>
                                  <td class="note_letter">&nbsp;</td>
                              </tr>
                          </table>                          </td>
                        </tr>
                  </table>  
                              </td>  
                    <td bgcolor="#e5ecf6" class="table_col_title">
                    <p class="red_letter">*<?php echo $imagesSize['mediaPhoto']['note'];?></p>
                    <p class="red_letter mediaPhoto">*若圖片沒有填寫標題或說明，則統一會顯示該筆資料標題或內容。</p>
                    </td>
                </tr>
                <?php } ?>


                <tr class="mediaPhoto">
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳圖片</p></td>
                    <td>
                      <table width="100%" border="0" cellspacing="5" cellpadding="2" id="addF">
                        <tr>
                            <td height="28">
                              <table border="0" cellspacing="2" cellpadding="2">
                                <tr>
                                    <td><a href="dropzoneImg.php?d_id=<?php echo $row_RecMedia['d_id']; ?>" class="fancyboxUpload" title="上傳多張圖片"><img src="image/add.png" width="16" height="16" border="0"></a></td>
                                      <td><a href="dropzoneImg.php?d_id=<?php echo $row_RecMedia['d_id']; ?>" class="fancyboxUpload table_data">上傳多張圖片</a></td>
                                      <td class="note_letter">&nbsp;</td>
                                  </tr>
                              </table>
                            </td>
                          </tr>
                      </table>  
                    </td>  
                    <td bgcolor="#e5ecf6" class="table_col_title">
                      <p class="red_letter">*<?php echo $imagesSize['mediaPhoto']['note'];?></p>
                      <p class="red_letter mediaPhoto">*若圖片沒有填寫標題或說明，則統一會顯示該筆資料標題或內容。</p>
                    </td>
                </tr>
                
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

<script src="jquery/chosen_v1.5.1/chosen.jquery.js" type="text/javascript"></script>
<script src="../js/datetimepicker-master/build/jquery.datetimepicker.full.js"></script>

<script type="text/javascript">
    /*var config = {
      '.chosen-select'           : {}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }*/
$(document).ready(function(){

  var group = $(".chosen-select option:selected").data('group');
  console.log("group = ", $(".chosen-select option:selected").data('group'));
  showGroup(group);
  
  $.datetimepicker.setLocale('zh-TW');
  $('#d_date').datetimepicker({
    timepicker:false,
    format:'Y-m-d',
    dayOfWeekStart : 1
  });

  $(".chosen-select")
  .chosen({no_results_text: "沒有找到符合的字！"})
  .change(function(){
    
    group = $(".chosen-select option:selected").data('group');
    //console.log("group", group);
    
    //console.log($("#term_group").val());
    showGroup(group);
  });

});

function showGroup(g){
  //alert($(".chosen-select option:selected").data('group'));

  $("#term_group").val(g);

  if(g=="1"){

    $('.media').show();
    $('.mediaVideo').hide();
    $('.mediaPhoto').hide();

    $("#content1").show();
    //tinymce.EditorManager.execCommand('mceRemoveEditor',true, "d_content");
    //tinyfy("#d_content");
    $("#content2").hide();

    $("#youtubeCode").hide();
    $(".imageContent").hide();
    $("#addF").show();

  }else if(g=="2"){

    $('.media').hide();
    $('.mediaVideo').show();
    $('.mediaPhoto').hide();

    //$("#d_content").hide();
    //tinymce.execCommand('mceRemoveControl', true, 'd_content');
    //tinymce.EditorManager.execCommand('mceRemoveControl',true, "d_content");
    //tinymce.EditorManager.execCommand('mceRemoveEditor',true, "d_content");
    $("#content1").hide();
    $("#content2").show();

    $("#youtubeCode").show();
    $(".imageContent").hide();
    $("#addF").hide();

  }else if(g=="3"){

    $('.media').hide();
    $('.mediaVideo').hide();
    $('.mediaPhoto').show();

    //$("#d_content").hide();
    //tinymce.EditorManager.execCommand('mceRemoveEditor',true, "d_content");
    $("#content1").hide();
    $("#content2").show();

    $("#youtubeCode").hide();
    $(".imageContent").show();
    $("#addF").show();

  }
}
</script>

</body>
<!-- InstanceEnd --></html>
<?php
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {

 
 $d_tag = '';
 $class3 = '';
 
 $d_tag = is_null(checkV('d_class2')) ? NULL : implode (",", checkV('d_class2'));
 $tagA = $_POST['d_class2'];

 $d_tagTXT = "";
 
 $d_title	= checkV('d_title');
 $d_title_en = checkV('d_title_en');
 $d_content	= checkV('d_content');
 $d_class1	= checkV('d_class1');
 $d_class2 = $d_tag;

 $d_class3  = checkV('term_group');

 if($d_class3==1){

  $d_content = checkV('d_content');
  $d_data1  = NULL;

 }elseif($d_class3==2){

  $d_content = checkV('d_content2');
  $d_data1  = checkV('d_data1');

 }elseif($d_class3==3){

  $d_content = checkV('d_content2');
  $d_data1  = NULL;

 }

 $re_data1  = checkV('re_data1');
 $d_date	= checkV('d_date');
 $d_active	= checkV('d_active');
 $d_pub  = checkV('d_pub');
 $d_id		= checkV('d_id');
  

 $d_data2	= checkV('d_data2');
 $d_data3	= checkV('d_data3');
  
  $updateSQL = sprintf("UPDATE data_set SET d_title=%s, d_title_en=%s, d_content=%s, d_tag=%s, d_class2=%s, d_class3=%s, d_data1=%s, d_data2=%s, d_data3=%s, d_date=%s, d_active=%s, d_pub=%s WHERE d_id=%s",
                       GetSQLValueString($d_title, "text"),
                       GetSQLValueString($d_title_en, "text"),
                       GetSQLValueString($d_content, "text"),
                       GetSQLValueString($d_tag, "text"),
                       GetSQLValueString($d_class2, "text"),
                       GetSQLValueString($d_class3, "text"),
                       GetSQLValueString($d_data1, "text"),
                       GetSQLValueString($d_data2, "text"),
                       GetSQLValueString($d_data3, "text"),
                       GetSQLValueString($d_date, "date"),
                       GetSQLValueString($d_active, "int"),
                       GetSQLValueString($d_pub, "int"),
                       GetSQLValueString($d_id, "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
  
  
	  
	  mysql_select_db($database_connect2data, $connect2data);
	  $querySQL = "SELECT term_taxonomy_id AS ID FROM term_relationships WHERE object_id='$d_id'";
	  $res = mysql_query($querySQL, $connect2data) or die(mysql_error());
	  $row = mysql_fetch_assoc($res);
	  $total = mysql_num_rows($res);
	  
	  do{
		  if (in_array($row['ID'], $tagA)){ //ID原本的tag是不是有在新的tagA裡
		  		
		  }else{
			  $deleteSQL = sprintf("DELETE FROM term_relationships WHERE term_taxonomy_id=%s AND object_id=%s",
						   GetSQLValueString($row['ID'], "int"),
						   GetSQLValueString($d_id, "int"));
	
			  mysql_select_db($database_connect2data, $connect2data);
			  $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());
		  }
		  
	  } while ($row = mysql_fetch_assoc($res));


    $i=1;
	  
	 foreach ($tagA as $tagO){ 
	 
	 	mysql_select_db($database_connect2data, $connect2data);
		$querySQL = "SELECT term_taxonomy_id AS ID FROM term_relationships WHERE object_id='$d_id' AND term_taxonomy_id='$tagO'";
		$res = mysql_query($querySQL, $connect2data) or die(mysql_error());
		$total = mysql_num_rows($res);
		
		if($total==0){
					   
			$insertSQL = sprintf("INSERT INTO term_relationships (object_id, term_taxonomy_id) VALUES (%s, %s)",
                       GetSQLValueString($d_id, "int"),
                       GetSQLValueString($tagO, "int"));

		 	mysql_select_db($database_connect2data, $connect2data);
		  	$Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
		}

    if($i==1){
      $tagTMP = $tagO;
    }
    $i++;



    mysql_select_db($database_connect2data, $connect2data);
    $query_RecMediaT = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='mediaT' AND T.term_active='1' AND term_id='$tagO'";
    $RecMediaT = mysql_query($query_RecMediaT, $connect2data) or die(mysql_error());
    $row_RecMediaT = mysql_fetch_assoc($RecMediaT);
    $totalRows_RecMediaT = mysql_num_rows($RecMediaT);
	 
		//$d_tagTXT = $d_tagTXT.$row_RecMediaT['name'].",".$row_RecMediaT['name_en'].",";

    if($row_RecMediaT['name']!=''){
      $d_tagTXT = $d_tagTXT.$row_RecMediaT['name'].",";
    }
    if($row_RecMediaT['name_en']!=''){
      $d_tagTXT = $d_tagTXT.$row_RecMediaT['name_en'].",";
    }
	}

  $updateSQL = sprintf("UPDATE data_set SET d_tag_txt=%s WHERE d_id=%s",
                       GetSQLValueString($d_tagTXT, "text"),
                       GetSQLValueString($d_id, "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());

    //----------插入圖片資料到資料庫begin(須放入插入主資料後)----------
        //echo image_process();

  if($d_class3==1){     //一般

    $image_result=image_process($_FILES['image'], $_REQUEST['image_title'], "media","add", $imagesSize[$_SESSION['nowMenu']]['IW'], $imagesSize[$_SESSION['nowMenu']]['IH']);   
    
    for($j=1;$j<count($image_result);$j++)
    {
        $insertSQL = sprintf("INSERT INTO file_set (file_name, file_link1, file_link2, file_link3, file_type, file_d_id, file_title, file_show_type) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($image_result[$j][0], "text"),
                       GetSQLValueString($image_result[$j][1], "text"),
                       GetSQLValueString($image_result[$j][2], "text"),
                       GetSQLValueString($image_result[$j][3], "text"),
                       GetSQLValueString("image", "text"),
                       GetSQLValueString($d_id, "int"),
                       GetSQLValueString($image_result[$j][4], "text"),
                       GetSQLValueString($image_result[$j][5], "int"));

          mysql_select_db($database_connect2data, $connect2data);
          $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
        $_SESSION["change_image"]=1;
    }

  }elseif($d_class3==2){//影片

    //----------插入youtube圖片資料到資料庫begin(須放入插入主資料後)----------   
    if(isset($d_data1)&&$d_data1!=''){
      //$imageLink = "http://img.youtube.com/vi/".$d_data1."/0.jpg";

      //確認是否有修改youtube，如果有就修改圖片
      if($d_data1!=$re_data1){

        $youtubeId = $d_data1;
        
        if(isset($_POST['Thumbnail_id'])&&$_POST['Thumbnail_id']!=''){  
        
          //----------刪除圖片資料到資料庫begin(在主資料前)-----    
          $sql="SELECT file_link1, file_link2, file_link3, file_link4, file_link5 FROM file_set WHERE file_type='youtubeThumbnail' AND file_d_id='".$d_id."'";
          $result = mysql_query($sql)or die("無法送出".mysql_error( ));
          while ( $row = mysql_fetch_assoc($result))
          {
            foreach ($row as $key => $value) {
              if ( (isset($value)) && file_exists("../".$value) ) {
                //echo "$value<br />\n";
                unlink("../".$value);//刪除檔案
              }
            }
          }
          
          $image_result=reportImageProcess("mediaVideo","edit", $imagesSize['mediaVideo']['IW'], $imagesSize['mediaVideo']['IH'], $youtubeId);
        
          $updateSQL = sprintf("UPDATE file_set SET file_name=%s, file_link1=%s, file_link2=%s, file_link3=%s, file_title=%s WHERE file_type='youtubeThumbnail' AND file_d_id=%s",
               GetSQLValueString($image_result[1][0], "text"),
               GetSQLValueString($image_result[1][1], "text"),
               GetSQLValueString($image_result[1][2], "text"),
               GetSQLValueString($image_result[1][3], "text"),
               GetSQLValueString($d_title, "text"),
               GetSQLValueString($d_id, "int"));

          mysql_select_db($database_connect2data, $connect2data);
          $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
        }else{
          
          $image_result=reportImageProcess("mediaVideo","add", $imagesSize['mediaVideo']['IW'], $imagesSize['mediaVideo']['IH'], $youtubeId);
          
          $insertSQL = sprintf("INSERT INTO file_set (file_name, file_link1, file_link2, file_link3, file_type, file_d_id, file_title) VALUES (%s, %s, %s, %s, %s, %s, %s)",
               GetSQLValueString($image_result[1][0], "text"),
               GetSQLValueString($image_result[1][1], "text"),
               GetSQLValueString($image_result[1][2], "text"),
               GetSQLValueString($image_result[1][3], "text"),
               GetSQLValueString("youtubeThumbnail", "text"),
               GetSQLValueString($d_id, "int"),
               GetSQLValueString($d_title, "text"));
  
          mysql_select_db($database_connect2data, $connect2data);
          $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
              
        }
        $_SESSION["change_image"]=1;
      }
      
    }else{
      //----------刪除圖片資料與資料庫begin-----
     
      $sql="SELECT file_link1, file_link2, file_link3, file_link4, file_link5 FROM file_set WHERE file_type='youtubeThumbnail' AND file_d_id='".$d_id."'";
        $result = mysql_query($sql)or die("無法送出".mysql_error( ));
        while ( $row = mysql_fetch_assoc($result))
        {
          foreach ($row as $key => $value) {
            if ( (isset($value)) && file_exists("../".$value) ) {
              //echo "$value<br />\n";
              unlink("../".$value);//刪除檔案
            }
          }
        }
      
      $deleteSQL = sprintf("DELETE FROM file_set WHERE file_type='youtubeThumbnail' AND file_d_id=%s",
                 GetSQLValueString($d_id, "int"));
    
      mysql_select_db($database_connect2data, $connect2data);
      $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());
      
      //----------刪除圖片資料與資料庫end-----
    }
    //----------插入youtube圖片資料到資料庫end----------

    $image_result=image_process($_FILES['imageVideo'], $_REQUEST['imageVideo_title'], "mediaVideo","add", $imagesSize['mediaVideo']['IW'], $imagesSize['mediaVideo']['IH']);   
    
    for($j=1;$j<count($image_result);$j++)
    {
        $insertSQL = sprintf("INSERT INTO file_set (file_name, file_link1, file_link2, file_link3, file_type, file_d_id, file_title, file_show_type) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($image_result[$j][0], "text"),
                       GetSQLValueString($image_result[$j][1], "text"),
                       GetSQLValueString($image_result[$j][2], "text"),
                       GetSQLValueString($image_result[$j][3], "text"),
                       GetSQLValueString("videoImage", "text"),
                       GetSQLValueString($d_id, "int"),
                       GetSQLValueString($image_result[$j][4], "text"),
                       GetSQLValueString($image_result[$j][5], "int"));

          mysql_select_db($database_connect2data, $connect2data);
          $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
        $_SESSION["change_image"]=1;
    }

  }elseif($d_class3==3){//照片

    //先更新各照片的標題與說明
    for($j=0;$j<count($_POST['imagePhotoNow_id']);$j++){

      if(isset($_POST['imagePhotoNow_id'][$j]) && $_POST['imagePhotoNow_id'][$j]!=''){          

          $updateSQL = sprintf("UPDATE file_set SET file_title=%s, file_content=%s WHERE file_type='photoImage' AND file_id=%s",
                       GetSQLValueString($_POST['imagePhotoNow_title'][$j], "text"),
                       GetSQLValueString($_POST['imagePhotoNow_content'][$j], "text"),
                       GetSQLValueString($_POST['imagePhotoNow_id'][$j], "int"));

        mysql_select_db($database_connect2data, $connect2data);
        $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
      }
    }


    $image_result=photo_process($_FILES['imagePhoto'], $_REQUEST['imagePhoto_title'], $_REQUEST['imagePhoto_content'], "mediaPhoto","add", $imagesSize['mediaPhoto']['IW'], $imagesSize['mediaPhoto']['IH']);   
    
    for($j=1;$j<count($image_result);$j++)
    {
        $insertSQL = sprintf("INSERT INTO file_set (file_name, file_link1, file_link2, file_link3, file_link4, file_type, file_d_id, file_title,  file_content, file_show_type) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($image_result[$j][0], "text"),
                       GetSQLValueString($image_result[$j][1], "text"),
                       GetSQLValueString($image_result[$j][2], "text"),
                       GetSQLValueString($image_result[$j][3], "text"),
                       GetSQLValueString($image_result[$j][6], "text"),
                       GetSQLValueString("photoImage", "text"),
                       GetSQLValueString($d_id, "int"),
                       GetSQLValueString($image_result[$j][4], "text"),
                       GetSQLValueString($image_result[$j][9], "text"),
                       GetSQLValueString($image_result[$j][5], "int"));

          mysql_select_db($database_connect2data, $connect2data);
          $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
        $_SESSION["change_image"]=1;
    }

  }
    
  
  
  //----------插入圖片資料到資料庫end----------
  
  $_SESSION['original_selected'] = $_SESSION['selected_mediaT'] = $tagTMP;
  $G_sel = $tagTMP;
  //$updateGoTo = "media_list.php?sel=".$class2."&selected2=".$class3."&changeSort=1&change_num=".$_POST['term_order']."&now_d_id=".$_POST['d_id']."&totalRows_RecMedia=".$_SESSION['totalRows']."&pageNum=".$_SESSION["ToPage"];
  //$updateGoTo = "media_list.php?sel=".$G_sel."&changeSort=1&change_num=".$_POST['term_order']."&now_d_id=".$d_id."&totalRows_RecMedia=".$_SESSION['totalRows']."&pageNum=".$_SESSION["ToPage"];

  $stringLink = "?sel=".$G_sel."&changeSort=1&change_num=".$_POST['term_order']."&now_d_id=".$d_id."&totalRows_RecMedia=".$_SESSION['totalRows']."&pageNum=".$_SESSION["ToPage"];
  
  $updateGoTo = "media_list.php".$stringLink;
  
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
mysql_free_result($RecMedia);

mysql_free_result($RecMediaT);
?>
