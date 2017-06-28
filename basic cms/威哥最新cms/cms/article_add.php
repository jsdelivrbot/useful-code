<?php require_once('../sstart.php'); ?>
<?php require_once('../Connections/connect2data.php'); ?>
<?php require_once('photo_process_article.php'); ?>
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

if(!in_array(2,$_SESSION['MM_Limit']['a4'])){
	header("Location: article_list.php");
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$G_sel1 = '';
if (isset($_SESSION['selected_articleT'])){
	$G_sel1 = $_SESSION['selected_articleT'];
}


mysql_select_db($database_connect2data, $connect2data);
$query_RecArticleT = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='articleT' AND T.term_active='1' ORDER BY term_sort ASC, term_id DESC";
$RecArticleT = mysql_query($query_RecArticleT, $connect2data) or die(mysql_error());
$row_RecArticleT = mysql_fetch_assoc($RecArticleT);
$totalRows_RecArticleT = mysql_num_rows($RecArticleT);

mysql_select_db($database_connect2data, $connect2data);
$query_RecArticleSubT = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='articleSubT' AND TT.parent=$G_sel1 AND T.term_active='1' ORDER BY term_sort ASC, term_id DESC";
$RecArticleSubT = mysql_query($query_RecArticleSubT, $connect2data) or die(mysql_error());
$row_RecArticleSubT = mysql_fetch_assoc($RecArticleSubT);
$totalRows_RecArticleSubT = mysql_num_rows($RecArticleSubT);

$G_sel2 = '';
if(isset($_GET['sel2']))
{
  $_SESSION['selected_articleSubT'] = $G_sel2 = $_GET['sel2'];
}else if(isset($_SESSION['selected_articleSubT'])){
  $G_sel2 = $_SESSION['selected_articleSubT'];
}else{
  $G_sel2 = $_SESSION['selected_articleSubT'] = $row_RecArticleSubT['term_id'];
}

mysql_select_db($database_connect2data, $connect2data);
$query_RecAuthor = "SELECT * FROM `admin` WHERE user_type=0 AND user_active=1 ORDER BY user_sort ASC, user_date DESC";
$RecAuthor = mysql_query($query_RecAuthor, $connect2data) or die(mysql_error());
$row_RecAuthor = mysql_fetch_assoc($RecAuthor);
$totalRows_RecAuthor = mysql_num_rows($RecAuthor);

mysql_select_db($database_connect2data, $connect2data);
$query_RecArticleTag = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='articleTag' AND T.term_active='1' ORDER BY term_sort ASC, term_id DESC";
$RecArticleTag = mysql_query($query_RecArticleTag, $connect2data) or die(mysql_error());
$row_RecArticleTag = mysql_fetch_assoc($RecArticleTag);
$totalRows_RecArticleTag = mysql_num_rows($RecArticleTag);

$menu_is="article";
$_SESSION['nowMenu']= "article";
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
				if(lastRow==3){
					$('#addF').hide();
				}
			}else{
				alert("最多上傳四張圖片哦!!");
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
<link rel="stylesheet" href="jquery/chosen_v1.7.0/chosen.css">
<!-- <link rel="stylesheet" href="../js/datetimepicker-master/jquery.datetimepicker.css"> -->
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
            <td width="30%" class="list_title">新增文章</td>
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
      if(isset($_SESSION['listLinks']) && $_SESSION['listLinks']!=''){ 

          if( (isset($_GET['sel'])&&$_GET['sel']!='') && (isset($_GET['now_d_id'])&&$_GET['now_d_id']!='') ){
            $reviewLink = "http://".$_SERVER['HTTP_HOST'].$nowFile."/"."article_detail.php?cat=".$_GET['sel']."&id=".$_GET['now_d_id'];
          }else{
            $reviewLink = "http://".$_SERVER['HTTP_HOST'].$nowFile."/"."article.php";
          }
      ?>
        <a href="<?php echo $_SESSION['listLinks'];?>" class="btnType finishBtn">完成</a>
        <a href="<?php echo $reviewLink; ?>" class="btnType pubBtn" target="_blank">預覽</a>

        <p>
        <a href="<?php echo $reviewLink; ?>" class="pubBtn red_letter" target="_blank">預覽網址:<?php echo $reviewLink; ?></a>
        </p>
      <?php } ?>
    </div>
    <?php } ?>

    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  		<tr>
   			<td>
            <table width="100%" border="0" cellpadding="5" cellspacing="3">
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">分類</td>
                  <td>
                    <label>
                    <select data-placeholder="請選擇文章分類..." class="table_data" tabindex="4" name="d_class2" id="d_class2">
                    <?php
                  do {  
                  ?>
                    <option value="<?php echo $row_RecArticleT['term_id']?>" <?php if (!(strcmp($row_RecArticleT['term_id'], $G_sel1))) {echo "selected='selected'";} ?>><?php echo $row_RecArticleT['name'].' '.$row_RecArticleT['name_en'];?><?php //echo $row_RecArticleT['term_id']?></option>
                    <?php
                  } while ($row_RecArticleT = mysql_fetch_assoc($RecArticleT));
                    $rows = mysql_num_rows($RecArticleT);
                    if($rows > 0) {
                        mysql_data_seek($RecArticleT, 0);
                  	  $row_RecArticleT = mysql_fetch_assoc($RecArticleT);
                    }
                  ?>
                    </select>
                    </label>
                  </td>
                  <td width="250" bgcolor="#e5ecf6">
                    <!--<input id="fullIdPath" type="hidden" value="1,8,24" />-->
                    </td>
                </tr>


                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">子分類</td>
                  <td>
                    <label>
                    <select data-placeholder="請選擇文章分類..." class="table_data" tabindex="4" name="d_class3" id="d_class3">
                    <?php
                  do {  
                  ?>
                    <option value="<?php echo $row_RecArticleSubT['term_id']?>" <?php if (!(strcmp($row_RecArticleSubT['term_id'], $G_sel2))) {echo "selected='selected'";} ?>><?php echo $row_RecArticleSubT['name'].' '.$row_RecArticleSubT['name_en'];?><?php //echo $row_RecArticleSubT['term_id']?></option>
                    <?php
                  } while ($row_RecArticleSubT = mysql_fetch_assoc($RecArticleSubT));
                    $rows = mysql_num_rows($RecArticleSubT);
                    if($rows > 0) {
                        mysql_data_seek($RecArticleSubT, 0);
                      $row_RecArticleSubT = mysql_fetch_assoc($RecArticleSubT);
                    }
                  ?>
                    </select>
                    </label>
                  </td>
                  <td width="250" bgcolor="#e5ecf6">
                    </td>
                </tr>

              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">作者</td>
                <td class="table_data">
                <?php 
                if (((isset($_SESSION['MM_AccountUsername'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_AccountUsername'], $_SESSION['MM_AccountUserGroup'])))) {

                  mysql_select_db($database_connect2data, $connect2data);
                  $query_RecCheckAuthor = "SELECT * FROM `admin` WHERE user_type=0 AND user_account='".$_SESSION['MM_AccountUsername']."' AND user_active=1";
                  $RecCheckAuthor = mysql_query($query_RecCheckAuthor, $connect2data) or die(mysql_error());
                  $row_RecCheckAuthor = mysql_fetch_assoc($RecCheckAuthor);
                  $totalRows_RecCheckAuthor = mysql_num_rows($RecCheckAuthor);

                  if($totalRows_RecCheckAuthor==0){
                    //代表是管理著登入
                ?>
                  <label>
                    <select data-placeholder="請選擇作者..." class="table_data" tabindex="4" name="d_class6" id="d_class6">
                    <?php
                  do {  
                  ?>
                    <option value="<?php echo $row_RecAuthor['user_id']?>" ><?php echo $row_RecAuthor['user_name'];?></option>
                    <?php
                  } while ($row_RecAuthor = mysql_fetch_assoc($RecAuthor));
                    $rows = mysql_num_rows($RecAuthor);
                    if($rows > 0) {
                        mysql_data_seek($RecAuthor, 0);
                      $row_RecAuthor = mysql_fetch_assoc($RecAuthor);
                    }
                  ?>
                    </select>
                  </label>
                <?php  
                  }else{
                    //作者登入
                ?>
                <?php echo $row_RecCheckAuthor['user_name']; ?>
                  <input name="d_class6" type="hidden" class="table_data" id="d_class6" size="50" value="<?php echo $row_RecCheckAuthor['user_id']; ?>" />
                <?php
                  }
                  //echo "query_RecCheckAuthor = $query_RecCheckAuthor<br>";
                  //echo "totalRows_RecCheckAuthor = $totalRows_RecCheckAuthor<br>";
                   
                }/*else{
                  echo $_SESSION['MM_AccountUsername'];
                }*/
                ?>
                
                </td>
                <td bgcolor="#e5ecf6">&nbsp;</td>
              </tr>

            	<tr>
            	  <td align="center" bgcolor="#e5ecf6" class="table_col_title">標題</td>
            	  <td><input name="d_title" type="text" class="table_data" id="d_title" size="50" /></td>
            	  <td bgcolor="#e5ecf6">&nbsp;</td>
          	  </tr>

              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">簡介</td>
                <td><textarea name="d_data1" cols="100" rows="20" class="table_data" id="d_data1"></textarea></td>
                <td bgcolor="#e5ecf6"><p class="red_letter">*小斷行請按Shift+Enter。<br />
                  輸入區域的右下角可以調整輸入空間的大小。</p></td>
              </tr>
            	
              <tr>
            	  <td align="center" bgcolor="#e5ecf6" class="table_col_title">內文</td>
            	  <td><textarea name="d_content" cols="100" rows="50" class="table_data tiny" id="d_content"></textarea></td>
            	  <td bgcolor="#e5ecf6"><p class="red_letter">*小斷行請按Shift+Enter。<br />
            	    輸入區域的右下角可以調整輸入空間的大小。</p>
            	    <!-- <p class="red_letter">*圖片請上傳寬不大於900 pixel 72dpi之圖檔。</p> --></td>
          	  </tr>

              <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">標籤</td>
                  <td>
                    <label>
                    <select data-placeholder="請選擇文章分類..." class="chosen-select table_data" multiple tabindex="4" name="d_tag[]" id="d_tag" style="width: 80%;">
                    <?php
                  do {  
                  ?>
                    <option value="<?php echo $row_RecArticleTag['term_id']?>" ><?php echo $row_RecArticleTag['name'].' '.$row_RecArticleTag['name_en'];?><?php //echo $row_RecArticleTag['term_id']?></option>
                    <?php
                  } while ($row_RecArticleTag = mysql_fetch_assoc($RecArticleTag));
                    $rows = mysql_num_rows($RecArticleTag);
                    if($rows > 0) {
                        mysql_data_seek($RecArticleTag, 0);
                      $row_RecArticleTag = mysql_fetch_assoc($RecArticleTag);
                    }
                  ?>
                    </select>
                    </label>
                  </td>
                  <td width="250" bgcolor="#e5ecf6">
                    <input name="d_class1" type="hidden" id="d_class1" value="article" />
                    <!--<input id="fullIdPath" type="hidden" value="1,8,24" />-->
                    </td>
                </tr>
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">時間</td>
                  <td><input name="d_date" type="text" class="table_data" id="d_date" value="<?php echo date("Y-m-d"); ?>" size="50" /></td>
                	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
                <tr>
              		<td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳列表封面</p></td>
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
                    <p class="red_letter">*<?php echo $imagesSize[$_SESSION['nowMenu'].'ListCover']['note'];?></p>
                    </td>
                </tr>

                <tr>
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳最新故事封面</p></td>
                    <td>
                    <table width="100%" border="0" cellpadding="2" cellspacing="2" bordercolor="#CCCCCC" class="data" id="pTable">
                      <tr>
                        <td> <span class="table_data">選擇圖片：</span>
                          <input name="imageCover[]" type="file" class="table_data" id="imageCover1" />
                          <br>
                          <span class="table_data">圖片說明：</span>
                          <input name="imageCover_title[]" type="text" class="table_data" id="imageCover_title1"></td>
                      </tr>
                    </table> 
                    </td>  
                    <td bgcolor="#e5ecf6" class="table_col_title">
                    <p class="red_letter">*<?php echo $imagesSize[$_SESSION['nowMenu'].'Cover']['note'];?></p>
                    </td>
                </tr>

                <?php if(0){?>
                <tr>
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳手機版封面</p></td>
                    <td>
                    <table width="100%" border="0" cellpadding="2" cellspacing="2" bordercolor="#CCCCCC" class="data" id="pTable">
                      <tr>
                        <td> <span class="table_data">選擇圖片：</span>
                          <input name="imageCoverMobile[]" type="file" class="table_data" id="imageCoverMobile1" />
                          <br>
                          <span class="table_data">圖片說明：</span>
                          <input name="imageCoverMobile_title[]" type="text" class="table_data" id="imageCoverMobile_title1"></td>
                      </tr>
                    </table> 
                    </td>  
                    <td bgcolor="#e5ecf6" class="table_col_title">
                    <p class="red_letter">*<?php echo $imagesSize[$_SESSION['nowMenu'].'CoverMobile']['note'];?></p>
                    </td>
                </tr>
                <?php } ?>

                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">是否推薦</td>
                  <td width="532"><label>
                    <select name="d_recommend" class="table_data" id="d_recommend">
                      <option value="0">否</option>
                      <option value="1">推薦</option>
                    </select></label></td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
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

                <?php if(isset($_SESSION['MM_AccountUserType']) && $_SESSION['MM_AccountUserType'] == 1){ ?>
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">發佈狀態</td>
                  <td><label>
                    <select name="d_pub" class="table_data" id="d_pub">
                      <option value="0">草稿</option>
                      <option value="1">發佈</option>
                    </select></label></td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
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
            if(0){
            if(isset($_SESSION['listLinks']) && $_SESSION['listLinks']!=''){ 
            ?>
              <a href="<?php echo $_SESSION['listLinks'];?>" class="btnType finishBtn">完成</a>
              <a href="<?php echo $reviewLink; ?>" class="btnType pubBtn" target="_blank">預覽</a>
            <?php 
              if(isset($_GET['now_d_id']) && $_GET['now_d_id']!=''){
                $_SESSION['listLinks'] = NULL;
              }              
            }else{ ?>
              <input name="submitBtn" type="submit" class="btnType" id="submitBtn" value="送出" />
            <?php } } ?>
            <input name="submitBtn" type="submit" class="btnType" id="submitBtn" value="送出" />
            </td>
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


<!-- <script src="jquery/chosen_v1.5.1/chosen.jquery.js" type="text/javascript"></script> -->
<script src="jquery/chosen_v1.7.0/chosen.jquery.js" type="text/javascript"></script>
<!-- <script src="../js/datetimepicker-master/build/jquery.datetimepicker.full.js"></script> -->

<script type="text/javascript">
    var config = {
      '.chosen-select'           : {}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
$(document).ready(function(){
  $(".chosen-select").chosen({no_results_text: "沒有找到符合的字！"});

  /*$.datetimepicker.setLocale('zh-TW');
  $('#d_date').datetimepicker({
    timepicker:false,
    format:'Y-m-d',
    dayOfWeekStart : 1
  });*/

  $('#d_class2').change(function() {
    if($(this).val() != ''){
      var action = $(this).attr("id");
        var query = $(this).val();
        var result = 'd_class3';
        $.ajax({
          url:"fetch.php",
          method:"POST",
          data:{action:action, query:query},
          success:function(data){
           $('#'+result).html(data);
          }
      })
    }
    //alert($(this).val());
    //window.location.href = "article_list.php?sel1="+$(this).val();
  });
});
</script>

</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($RecArticleT);

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

 $d_tag = '';
 $class3 = '';
 /*if(isset($_POST['d_class2'])){
 	$d_tag = $_POST['d_class2'];
 }*/
 $d_tag = is_null(checkV('d_tag')) ? NULL : implode (",", checkV('d_tag'));
 
 //echo 'd_tag = '.$d_tag.'<br>';
 
 $tagA = $_POST['d_tag'];
 $tagTMP = '';
 $d_tagTXT = "";
 //echo 'tagA = '.$tagA.'<br>';
 
 $d_title	= checkV('d_title');
 $d_title_en = checkV('d_title_en');
 $d_content	= checkV('d_content');
 $d_class1	= checkV('d_class1');
 $d_class2 = checkV('d_class2');
 $d_class3	= checkV('d_class3');
 $d_class4	= checkV('d_class4');
 $d_class5	= checkV('d_class5');
 $d_class6	= checkV('d_class6');
 $d_date	= checkV('d_date');
 $d_active	= checkV('d_active'); 
 $d_recommend = checkV('d_recommend');
  
 $d_data1	= checkV('d_data1');
 $d_data2	= checkV('d_data2');
 $d_data3	= checkV('d_data3');

 if(isset($_SESSION['MM_AccountUserType']) && $_SESSION['MM_AccountUserType'] == 1){
  $d_pub  = checkV('d_pub');
 }else{
  $d_pub = 0;
 }

 mysql_select_db($database_connect2data, $connect2data);
  $query_RecCheckAuthor = "SELECT * FROM `admin` WHERE user_type=0 AND user_id='$d_class6' AND user_active=1";
  $RecCheckAuthor = mysql_query($query_RecCheckAuthor, $connect2data) or die(mysql_error());
  $row_RecCheckAuthor = mysql_fetch_assoc($RecCheckAuthor);
  $totalRows_RecCheckAuthor = mysql_num_rows($RecCheckAuthor);

  if($totalRows_RecCheckAuthor>0){
    $d_class5 = $row_RecCheckAuthor['user_name'];
  }
  
  $insertSQL = sprintf("INSERT INTO data_set (d_title, d_title_en, d_content, d_class1, d_class2, d_tag, d_class3, d_class4, d_class5, d_class6, d_data1, d_data2, d_data3, d_price1, d_price2, d_date, d_recommend, d_active, d_pub) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($d_title, "text"),
                       GetSQLValueString($d_title_en, "text"),
                       GetSQLValueString($d_content, "text"),
                       GetSQLValueString($d_class1, "text"),
                       GetSQLValueString($d_class2, "text"),
                       GetSQLValueString($d_tag, "text"),
                       GetSQLValueString($d_class3, "text"),
                       GetSQLValueString($d_class4, "text"),
                       GetSQLValueString($d_class5, "text"),
                       GetSQLValueString($d_class6, "text"),
                       GetSQLValueString($d_data1, "text"),
                       GetSQLValueString($d_data2, "text"),
                       GetSQLValueString($d_data3, "text"),
                       GetSQLValueString($d_price1, "int"),
                       GetSQLValueString($d_price2, "int"),
                       GetSQLValueString($d_date, "date"),
                       GetSQLValueString($d_recommend, "int"),
                       GetSQLValueString($d_active, "int"),
                       GetSQLValueString($d_pub, "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
  
    //----------插入圖片資料到資料庫begin(須放入插入主資料後)----------

	$new_data_num = mysql_insert_id();

  $i=1;
			
	foreach ($tagA as $tagO){
		$insertSQL = sprintf("INSERT INTO term_relationships (object_id, term_taxonomy_id) VALUES (%s, %s)",
                       GetSQLValueString($new_data_num, "int"),
                       GetSQLValueString($tagO, "int"));

		  mysql_select_db($database_connect2data, $connect2data);
		  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());

      mysql_select_db($database_connect2data, $connect2data);
      $query_RecArticleTag = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='articleTag' AND T.term_active='1' ORDER BY term_sort ASC, term_id DESC";
      $RecArticleTag = mysql_query($query_RecArticleTag, $connect2data) or die(mysql_error());
      $row_RecArticleTag = mysql_fetch_assoc($RecArticleTag);
      $totalRows_RecArticleTag = mysql_num_rows($RecArticleTag);

      if($i==1){
        $tagTMP = $tagO;  
      }
		  $i++;

    mysql_select_db($database_connect2data, $connect2data);
    $query_RecArticleTag = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='articleTag' AND T.term_active='1' AND term_id='$tagO'";
    $RecArticleTag = mysql_query($query_RecArticleTag, $connect2data) or die(mysql_error());
    $row_RecArticleTag = mysql_fetch_assoc($RecArticleTag);
    $totalRows_RecArticleTag = mysql_num_rows($RecArticleTag);
   
    //$d_tagTXT = $d_tagTXT.$row_RecArticleTag['name'].",".$row_RecArticleTag['name_en'].",";

    if($row_RecArticleTag['name']!=''){
      $d_tagTXT = $d_tagTXT.$row_RecArticleTag['name'].",";
    }
    if($row_RecArticleTag['name_en']!=''){
      $d_tagTXT = $d_tagTXT.$row_RecArticleTag['name_en'].",";
    }
	}


  $updateSQL = sprintf("UPDATE data_set SET d_tag_txt=%s WHERE d_id=%s",
                       GetSQLValueString($d_tagTXT, "text"),
                       GetSQLValueString($new_data_num, "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
			
	
  if(isset($_FILES['image'])){
    $image_result=image_process($_FILES['image'], $_REQUEST['image_title'], "article".'ListCover',"add", $imagesSize[$_SESSION['nowMenu'].'ListCover']['IW'], $imagesSize[$_SESSION['nowMenu'].'ListCover']['IH']);
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
  }
	//----------插入ListCover圖片資料到資料庫end----------
  //----------插入imageCover圖片資料到資料庫begin(須放入插入主資料後)----------
  if(isset($_FILES['imageCover'])){
    $image_result=image_process($_FILES['imageCover'], $_REQUEST['imageCover_title'], "article".'Cover',"add", $imagesSize[$_SESSION['nowMenu'].'Cover']['IW'], $imagesSize[$_SESSION['nowMenu'].'Cover']['IH']);
    //echo count($image_result);
    //echo $image_result[0][0];
    
    for($j=1;$j<count($image_result);$j++)
    {
        $insertSQL = sprintf("INSERT INTO file_set (file_name, file_link1, file_link2, file_link3, file_type, file_d_id, file_title, file_show_type) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($image_result[$j][0], "text"),
                       GetSQLValueString($image_result[$j][1], "text"),
                       GetSQLValueString($image_result[$j][2], "text"),
                       GetSQLValueString($image_result[$j][3], "text"),
                       GetSQLValueString("imageCover", "text"),
                       GetSQLValueString($new_data_num, "int"),
                       GetSQLValueString($image_result[$j][4], "text"),
                       GetSQLValueString($image_result[$j][5], "int"));

          mysql_select_db($database_connect2data, $connect2data);
          $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
        $_SESSION["change_image"]=1;
    }
  }
  //----------插入imageCover圖片資料到資料庫end----------
  //----------插入圖片資料到資料庫begin(須放入插入主資料後)----------
  if(isset($_FILES['imageCoverMobile'])){
    $image_result=image_process($_FILES['imageCoverMobile'], $_REQUEST['imageCoverMobile_title'], "article".'CoverMobile',"add", $imagesSize[$_SESSION['nowMenu'].'CoverMobile']['IW'], $imagesSize[$_SESSION['nowMenu'].'CoverMobile']['IH']);
    //echo count($image_result);
    //echo $image_result[0][0];
    
    for($j=1;$j<count($image_result);$j++)
    {
        $insertSQL = sprintf("INSERT INTO file_set (file_name, file_link1, file_link2, file_link3, file_type, file_d_id, file_title, file_show_type) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($image_result[$j][0], "text"),
                       GetSQLValueString($image_result[$j][1], "text"),
                       GetSQLValueString($image_result[$j][2], "text"),
                       GetSQLValueString($image_result[$j][3], "text"),
                       GetSQLValueString("imageCoverMobile", "text"),
                       GetSQLValueString($new_data_num, "int"),
                       GetSQLValueString($image_result[$j][4], "text"),
                       GetSQLValueString($image_result[$j][5], "int"));

          mysql_select_db($database_connect2data, $connect2data);
          $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
        $_SESSION["change_image"]=1;
    }
  }
  //----------插入圖片資料到資料庫end----------
	 //----------插入檔案資料到資料庫begin(須放入插入主資料後)----------
   			//echo file_process();
	if(0){
    $file_result=file_process("article","add");
  
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
  }
		


    /*mysql_select_db($database_connect2data, $connect2data);
    $query_RecArticle = "SELECT * FROM term_relationships AS TR, data_set AS D, terms AS T
    WHERE TR.term_taxonomy_id = T.term_id AND D.d_id = TR.object_id AND T.term_id='$tagTMP' ORDER BY term_order ASC, d_date DESC";
    $RecArticle = mysql_query($query_RecArticle, $connect2data) or die(mysql_error());
    $row_RecArticle = mysql_fetch_assoc($RecArticle);
    $totalRows_RecArticle = mysql_num_rows($RecArticle);*/

    $query_RecArticle = "SELECT * FROM data_set AS D WHERE D.d_class2='$d_class2' AND D.d_class3='$d_class3' AND D.d_class1='article' ORDER BY d_sort ASC, d_date DESC";
    $RecArticle = mysql_query($query_RecArticle, $connect2data) or die(mysql_error());
    $row_RecArticle = mysql_fetch_assoc($RecArticle);
    $totalRows_RecArticle = mysql_num_rows($RecArticle);

    $_SESSION['totalRows'] = $totalRows_RecArticle;
	
	
  $_SESSION['original_selected1'] = $_SESSION['selected_articleT'] = $d_class2;
  $_SESSION['original_selected2'] = $_SESSION['selected_articleSubT'] = $d_class3;


  $stringLink = "?sel1=".$d_class2."&sel2=".$d_class3."&pageNum=0&totalRows_RecArticle=".$_SESSION['totalRows']."&changeSort=1&now_d_id=".$new_data_num."&change_num=1";
  
  $insertGoTo = "article_list.php".$stringLink;

  //$insertGoTo = "article_list.php?sel=".$tagTMP."&pageNum=0&totalRows_RecArticle=".$_SESSION['totalRows']."&changeSort=1&now_d_id=".$new_data_num."&change_num=1";
  
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }

  $_SESSION['listLinks'] = $insertGoTo;

  $selfLink = "article_add.php".$stringLink;
  
  if($image_result[0][0]==1)
  {
  		echo "<script type=\"text/javascript\">call_alert('".$insertGoTo."');</script>";
  }else
  {
  		header(sprintf("Location: %s", $insertGoTo));
  }
  
}
?>

