<?php require_once('../sstart.php'); ?>
<?php require_once('../Connections/connect2data.php'); ?>
<?php require_once('photo_process_author.php'); ?>
<?php //require_once('file_process.php'); ?>
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

if(!in_array(5,$_SESSION['MM_Limit']['a5'])){
	header("Location: author_list.php");
}


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$colname_RecAuthor = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecAuthor = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecAuthor = sprintf("SELECT * FROM `admin` WHERE user_type=0 AND `user_id`= %s", GetSQLValueString($colname_RecAuthor, "int"));
$RecAuthor = mysql_query($query_RecAuthor, $connect2data) or die(mysql_error());
$row_RecAuthor = mysql_fetch_assoc($RecAuthor);
$totalRows_RecAuthor = mysql_num_rows($RecAuthor);

if($totalRows_RecAuthor==0){
  header("Location: author_list.php");
}

$colname_RecImage = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecImage = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecImage = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'imageAuthor' ORDER BY file_id DESC", GetSQLValueString($colname_RecImage, "int"));
$RecImage = mysql_query($query_RecImage, $connect2data) or die(mysql_error());
$row_RecImage = mysql_fetch_assoc($RecImage);
$totalRows_RecImage = mysql_num_rows($RecImage);

$colname_RecFile = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecFile = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecFile = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'file' ORDER BY file_id DESC", GetSQLValueString($colname_RecFile, "int"));
$RecFile = mysql_query($query_RecFile, $connect2data) or die(mysql_error());
$row_RecFile = mysql_fetch_assoc($RecFile);
$totalRows_RecFile = mysql_num_rows($RecFile);

//echo 'selected_authorT = '.$_SESSION['selected_authorT'];
$G_sel = '';
if (isset($_SESSION['selected_authorT'])){
	$G_sel = $_SESSION['selected_authorT'] = $row_RecAuthor['user_class'];
	//echo 'G_sel = '.$G_sel;
}

mysql_select_db($database_connect2data, $connect2data);
$query_RecAuthorT = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='authorT' AND T.term_active='1' ORDER BY term_sort ASC, term_id DESC";
$RecAuthorT = mysql_query($query_RecAuthorT, $connect2data) or die(mysql_error());
$row_RecAuthorT = mysql_fetch_assoc($RecAuthorT);
$totalRows_RecAuthorT = mysql_num_rows($RecAuthorT);

mysql_select_db($database_connect2data, $connect2data);
$query_RecLevel = "SELECT * FROM a_set WHERE a_type=0 ORDER BY a_id ASC";
$RecLevel = mysql_query($query_RecLevel, $connect2data) or die(mysql_error());
$row_RecLevel = mysql_fetch_assoc($RecLevel);
$totalRows_RecLevel = mysql_num_rows($RecLevel);

mysql_select_db($database_connect2data, $connect2data);
$query_RecArticleT = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='articleT' AND T.term_active='1' ORDER BY term_sort ASC, term_id DESC";
$RecArticleT = mysql_query($query_RecArticleT, $connect2data) or die(mysql_error());
$row_RecArticleT = mysql_fetch_assoc($RecArticleT);
$totalRows_RecArticleT = mysql_num_rows($RecArticleT);

$menu_is="author";

//記錄帶資料去別地方的資訊
$_SESSION['nowPage']=$selfPage;
$_SESSION['nowMenu']= "author";
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
	
	var lastRow = <?php echo $totalRows_RecImage;?>;
	
	console.log(lastRow);
	if(lastRow>=3){
		$('#addF').hide();
	}
	
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
			console.log('image'+lastRow);
			
			if(lastRow<4){
				if(myField.value){
					var aTr=pTable.insertRow(lastRow);
					var newRow = lastRow+1;
					var newImg='img'+(newRow);
					var aTd1=aTr.insertCell(0);
					aTd1.innerHTML = '<span class="table_data">選擇圖片： </span><input name="image[]" type="file" class="table_data" id="image'+newRow+'"><br><span class="table_data">圖片說明： </span><input name="image_title[]" type="text" class="table_data" id="image_title'+newRow+'">';
				}else{
					alert("尚有未選取之圖片欄位!!");
				}
				if(lastRow==( 3 - <?php echo $totalRows_RecImage;?>)){
					$('#addF').hide();
				}
			}else{
				alert("最多上傳五張圖片哦!!");
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
<link rel="stylesheet" href="jquery/chosen_v1.7.0/chosen.css">
<!-- <link rel="stylesheet" href="../js/datetimepicker-master/jquery.datetimepicker.css"> -->
<?php require_once('head.php');?>
<?php require_once('web_count.php');?>
<style type="text/css">
  meter {
  /* Reset the default appearance */
  /*-webkit-appearance: none;
     -moz-appearance: none;
          appearance: none;*/
  display: block;
  /*margin: 0 auto 1em;*/
  width: 367px;
  height: 0.5em;

  /* Applicable only to Firefox */
  background: none;
  background-color: rgba(100, 100, 100, 0.1);
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
}

meter::-webkit-meter-bar {
  background: none;
  background-color: rgba(100, 100, 100, 0.1);
}

/* Webkit based browsers */
meter[value="1"]::-webkit-meter-optimum-value { background: red; }
meter[value="2"]::-webkit-meter-optimum-value { background: yellow; }
meter[value="3"]::-webkit-meter-optimum-value { background: orange; }
meter[value="4"]::-webkit-meter-optimum-value { background: green; }

/* Gecko based browsers */
meter[value="1"]::-moz-meter-bar { background: red; }
meter[value="2"]::-moz-meter-bar { background: yellow; }
meter[value="3"]::-moz-meter-bar { background: orange; }
meter[value="4"]::-moz-meter-bar { background: green; }

input#user_account, input#user_password{
  width: auto;
}
#password-strength-text{
  display: block;
  margin-top: 0;
  margin-bottom: 0;
}
  label.error{
    /*position: absolute;
    left: 102%;
    top: 0;*/
    width: 160px;
    display: inline-block;
    text-align: left;
    font-size: 12px;
    color: #BF1733;
    font-family: Arial,Helvetica,Sans-Serif;
  }
  input.error{
    border-color: #BF1733 !important;
  }

  .chosen-choices {
  position: relative;
  /*overflow: hidden;*/
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  width: 100%;
  height: auto !important;
  height: 1%; 
  cursor: text;
}
.chosen-choices li.search-choice {
  position: relative;
  margin: 3px 5px 3px 0px;
  padding: 3px 5px;
  border: 1px solid #aaa;
  border-radius: 3px;
  background-color: #e4e4e4;
  background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(20%, #f4f4f4), color-stop(50%, #f0f0f0), color-stop(52%, #e8e8e8), color-stop(100%, #eeeeee));
  background-image: -webkit-linear-gradient(#f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eeeeee 100%);
  background-image: -moz-linear-gradient(#f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eeeeee 100%);
  background-image: -o-linear-gradient(#f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eeeeee 100%);
  background-image: linear-gradient(#f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eeeeee 100%);
  background-clip: padding-box;
  box-shadow: 0 0 2px white inset, 0 1px 0 rgba(0, 0, 0, 0.05);
  color: #333;
  line-height: 13px;
  cursor: default;
}
.chosen-choices li {
  float: left;
  list-style: none;
}
</style>
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
            <td width="30%" class="list_title">修改作者</td>
            <td width="70%">&nbsp;</td>
        </tr>
	</table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td><img src="image/spacer.gif" width="1" height="1"></td>
        </tr>
    </table>
    <form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1" id="form1">

    <?php if(0){ ?>
    <div class="groupBtn">
      <?php 

      if( (isset($row_RecAuthor['user_id'])&&$row_RecAuthor['user_id']!='') && (isset($G_sel)&&$G_sel!='') ){

        $reviewLink = "http://".$_SERVER['HTTP_HOST'].$nowFile."/"."author_detail.php?cat=".$G_sel."&id=".$_GET['d_id'];

      }else{
        $reviewLink = "http://".$_SERVER['HTTP_HOST'].$nowFile."/"."author.php";
      }

      if(isset($_SESSION['listLinks']) && $_SESSION['listLinks']!=''){ 
      ?>
        <a href="<?php echo $_SESSION['listLinks'];?>" class="btnType finishBtn">完成</a>
        <a href="<?php echo $reviewLink; ?>" class="btnType pubBtn" target="_blank">預覽</a>
      <?php } ?>

      <p><a href="<?php echo $reviewLink; ?>" class="pubBtn red_letter" target="_blank">預覽網址:<?php echo $reviewLink; ?></a></p>
    </div>
    <?php } ?>

    <table width="100%" border="0" cellpadding="0" cellspacing="0">
  		<tr>
   			<td>
            <table width="100%" border="0" cellpadding="5" cellspacing="3">
            	<tr>
            	  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">分類</td>
            	  <td class="table_data">
            	    <ul class="chosen-choices">
                    
                    
                    <?php
                    do {
                      $selA = explode(',',$row_RecAuthor['user_class']);
                      if (in_array($row_RecAuthorT['term_id'], $selA)){
                        echo '<li class="search-choice"><span>'.$row_RecAuthorT['name'].'</span></li>';
                      }

                    } while ($row_RecAuthorT = mysql_fetch_assoc($RecAuthorT));
                      $rows = mysql_num_rows($RecAuthorT);
                      if($rows > 0) {
                          mysql_data_seek($RecAuthorT, 0);
                        $row_RecAuthorT = mysql_fetch_assoc($RecAuthorT);
                      }
                    ?>
                    </ul>
            	    </td>
            	  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
          	  </tr>

              <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">權限種類</td>
                  <td class="table_data">
                  
                  <ul class="chosen-choices">
                    <?php
                    do {
                      $selA = explode(',',$row_RecAuthor['user_level']);
                      if (in_array($row_RecLevel['a_id'], $selA)){
                        echo '<li class="search-choice"><span>'.$row_RecLevel['a_title'].'</span></li>';
                      }

                    } while ($row_RecLevel = mysql_fetch_assoc($RecLevel));
                      $rows = mysql_num_rows($RecLevel);
                      if($rows > 0) {
                          mysql_data_seek($RecLevel, 0);
                        $row_RecLevel = mysql_fetch_assoc($RecLevel);
                      }
                    ?>
                    </ul></td>
                    <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                </tr>
            	
            	<tr>
            	  <td align="center" bgcolor="#e5ecf6" class="table_col_title">作者名</td>
                <td class="table_data"><?php echo $row_RecAuthor['user_name']; ?></td>
            	  <td bgcolor="#e5ecf6">                  
            	    <input name="d_id" type="hidden" id="d_id" value="<?php echo $row_RecAuthor['user_id']; ?>" />
                  </td>
          	  </tr>


              <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">作者登入帳號</td>
                  <td class="table_data"><?php echo $row_RecAuthor['user_account']; ?></td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
              </tr>

              <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">作者登入密碼</td>
                  <td>

                    <input name="user_password" type="password" class="table_data" id="user_password" value="" size="50" />
                  
                  <meter max="4" id="password-strength-meter"></meter>
                  <p id="password-strength-text" class="red_letter"></p>

                    <input name="password" type="hidden" id="password" value="<?php echo $row_RecAuthor['user_password']; ?>" />

                    </td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
              </tr>

              <?php if(0){ ?>
            	<tr>
            	  <td align="center" bgcolor="#e5ecf6" class="table_col_title">簡介</td>
            	  <td><textarea name="user_content" cols="100" rows="20" class="table_data" id="user_content"><?php echo $row_RecAuthor['user_content']; ?></textarea></td>
            	  <td bgcolor="#e5ecf6"><p class="red_letter">*小斷行請按Shift+Enter。<br />
            	    輸入區域的右下角可以調整輸入空間的大小。</p>
            	    <!-- <p class="red_letter">*圖片請上傳寬不大於900 pixel 72dpi之圖檔。</p> --></td>
            	  </tr>

                <tr>
                <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">主要專欄</td>
                <td>
                  <label>
                    <select data-placeholder="請選擇主要專欄..." class="chosen-select table_data" multiple tabindex="4" name="user_column[]" id="user_column" style="width:80%;">
                      <?php
do {
  $selA = explode(',',$row_RecAuthor['user_column']);
  if (in_array($row_RecArticleT['term_id'], $selA)){
    $sel = "selected=\"selected\"";
  }else{
    $sel = "";
  }
?>
                      <option value="<?php echo $row_RecArticleT['term_id']?>"<?php echo $sel; ?>><?php echo $row_RecArticleT['name'].' '.$row_RecArticleT['name_en']?><?php //echo $row_RecArticleT['term_id']?></option>
                      <?php
} while ($row_RecArticleT = mysql_fetch_assoc($RecArticleT));
  $rows = mysql_num_rows($RecArticleT);
  if($rows > 0) {
      mysql_data_seek($RecArticleT, 0);
    $row_RecArticleT = mysql_fetch_assoc($RecArticleT);
  }
?>
                      </select></label>
                  </td>
                <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
              </tr>
            	

                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">時間</td>
                  <td class="table_data"><?php echo date("Y-m-d H:i:s", strtotime($row_RecAuthor['user_date'])); ?></td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                </tr>

               
                <tr>
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title">帳號是否有效</td>
                  <td><label>
                    <select name="user_active" class="table_data" id="user_active">
                      <option value="0" <?php if (!(strcmp(0, $row_RecAuthor['user_active']))) {echo "selected=\"selected\"";} ?>>不公佈</option>
                      <option value="1" <?php if (!(strcmp(1, $row_RecAuthor['user_active']))) {echo "selected=\"selected\"";} ?>>公佈</option>
                    </select>
                  </label></td>
                  <td bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>


                <?php if ($totalRows_RecImage > 0) { // Show if recordset not empty ?>
                  <tr>
                    <td align="center" bgcolor="#e5ecf6" class="table_col_title">目前作者圖片<a name="imageEdit" id="imageEdit"></a></td>
                    <td><?php do { ?>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="100" rowspan="2" align="center"><a href="../<?php echo $row_RecImage['file_link1'].'?'.(mt_rand(1,100000)/100000); ?>" class="fancyboxImg" rel="group" title="<?php echo $row_RecImage['file_title']; ?>"><img src="../<?php echo $row_RecImage['file_link2'].'?'.(mt_rand(1,100000)/100000); ?>" alt="" class="image_frame"  width="100" /></a></td>
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
                    <td bgcolor="#e5ecf6" class="table_col_title"><p class="red_letter">*<?php echo $imagesSize[$_SESSION['nowMenu']]['note'];?></p>
                      </td>
                  </tr>
                  <?php } // Show if recordset not empty ?>
                  
                  <?php if ($totalRows_RecImage == 0) { // Show if recordset empty ?>
                  <tr>
              		<td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳作者圖片</p></td>
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
                  <?php } ?>
                              </td>  
              	    <td bgcolor="#e5ecf6" class="table_col_title">
                    <p class="red_letter">*<?php echo $imagesSize[$_SESSION['nowMenu']]['note'];?></p></td>
                </tr>
                  <?php } // Show if recordset empty ?>
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
            if(0){
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
            <?php } } ?>
            <input name="submitBtn" type="submit" class="btnType" id="submitBtn" value="送出" />
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

<script src="jquery/zxcvbnJs/data/zxcvbn.js"></script>
<script src="jquery/chosen_v1.7.0/chosen.jquery.js" type="text/javascript"></script>
<script src="../js/datetimepicker-master/build/jquery.datetimepicker.full.js"></script>

<script src="../js/jquery.form.js"></script>
<script src="jquery/jquery-validation-1.15.1/dist/jquery.validate.js"></script>

<script type="text/javascript">
var config = {
  '.chosen-select' : {}
}
for (var selector in config) {
  $(selector).chosen(config[selector]);
}

var strength = {
    0: "最差",
    1: "壞",
    2: "弱",
    3: "好",
    4: "強"
  }
  var password = document.getElementById('user_password');
  var meter = document.getElementById('password-strength-meter');
  var text = document.getElementById('password-strength-text');

  password.addEventListener('input', function() {
    var val = password.value;
    var result = zxcvbn(val);

    // Update the password strength meter
    meter.value = result.score;

    //console.log(meter.value);

    // Update the text indicator
    if (val !== "") {
      text.innerHTML = "密碼強度： " + strength[result.score]; 
    } else {
      text.innerHTML = "";
    }
  });

$(document).ready(function(){
  $(".chosen-select").chosen({no_results_text: "沒有找到符合的字！"});

 /* $("#password-strength-meter").width( $("#user_password").width() );*/

  /*$.datetimepicker.setLocale('zh-TW');
  $('#user_date').datetimepicker({
    timepicker:false,
    format:'Y-m-d',
    dayOfWeekStart : 1
  });*/

  $("#form1").validate({
    //debug: true,
    ignore:[],
    /*errorElement: "div",
    errorClass: 'error_validate',*/
    errorPlacement: function (label, element) {
      // default
      console.log(element);
      if (element.is(':radio')) {
        label.insertAfter(element.next('label'));
      }
      else {
        label.insertAfter(element);
      }
    },
    rules: {
          
      user_password  : {
        required: true,
        minlength: 6
        }
      },
    messages: {
        
        user_password: {
          required: "必填欄位",
          minlength: "至少輸入六個字元"
        }
      }
    });
});
</script>

</body>
<!-- InstanceEnd --></html>
<?php
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {

  $d_id = checkV('d_id');

  $colname_RecAuthor = "-1";
  if (isset($d_id )) {
    $colname_RecAuthor = $d_id ;
  }
  mysql_select_db($database_connect2data, $connect2data);
  $query_RecAuthor = sprintf("SELECT * FROM `admin` WHERE user_type=0 AND `user_id`= %s", GetSQLValueString($colname_RecAuthor, "int"));
  $RecAuthor = mysql_query($query_RecAuthor, $connect2data) or die(mysql_error());
  $row_RecAuthor = mysql_fetch_assoc($RecAuthor);
  $totalRows_RecAuthor = mysql_num_rows($RecAuthor);

  $user_class = $row_RecAuthor['user_class'];
  $user_sort = $row_RecAuthor['user_sort'];

  $user_password = $row_RecAuthor['user_password'];
  if($_POST['user_password']!=''){
    $user_password = md5($_POST['user_password']);
  }
  
  $updateSQL = sprintf("UPDATE admin SET user_password=%s WHERE user_id=%s",
                       GetSQLValueString($user_password, "text"),
                       GetSQLValueString($d_id, "int"));


  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
  

  
  $G_sel = $_SESSION['original_selected'] = $_SESSION['selected_authorT'] = $user_class;


  $stringLink = "?sel=".$G_sel."&changeSort=1&change_num=".$user_sort."&now_d_id=".$d_id."&totalRows_RecAuthor=".$_SESSION['totalRows']."&pageNum=".$_SESSION["ToPage"];
  
  $updateGoTo = "author_list.php".$stringLink;


  //$updateGoTo = "author_list.php?sel=".$class2."&selected2=".$class3."&changeSort=1&change_num=".$_POST['term_order']."&now_d_id=".$_POST['d_id']."&totalRows_RecAuthor=".$_SESSION['totalRows']."&pageNum=".$_SESSION["ToPage"];
  //$updateGoTo = "author_list.php?sel=".$G_sel."&changeSort=1&change_num=".$_POST['term_order']."&now_d_id=".$d_id."&totalRows_RecAuthor=".$_SESSION['totalRows']."&pageNum=".$_SESSION["ToPage"];
  
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING']."&pageNum=".$_SESSION["ToPage"];
  }

  $_SESSION['listLinks'] = $updateGoTo;

  $selfLink = $editFormAction."&edit=finish";
  
  
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
mysql_free_result($RecAuthor);
mysql_free_result($RecImage);

mysql_free_result($RecAuthorT);
?>
