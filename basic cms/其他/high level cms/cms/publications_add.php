<?php require_once('../sstart.php'); ?>
<?php require_once('../Connections/connect2data.php'); ?>
<?php require_once('photo_process_about.php'); ?>
<?php require_once('file_process.php'); ?>
<?php require_once('../Connections/ini_set.php'); ?>
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

if(!in_array(2,$_SESSION['MM_Limit']['a9'])){
	header("Location: publications_list.php");
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$G_sel = '';
if (isset($_SESSION['selected_publicationsT'])){
	$G_sel = $_SESSION['selected_publicationsT'];
}

mysql_select_db($database_connect2data, $connect2data);
$query_RecPublicationsT = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='publicationsT' AND T.term_active='1' ORDER BY term_sort ASC, term_id DESC";
$RecPublicationsT = mysql_query($query_RecPublicationsT, $connect2data) or die(mysql_error());
$row_RecPublicationsT = mysql_fetch_assoc($RecPublicationsT);
$totalRows_RecPublicationsT = mysql_num_rows($RecPublicationsT);

$menu_is="publications";
$_SESSION['nowMenu']= "publications";
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
<!-- <link rel="stylesheet" href="jquery/chosen_v1.5.1/chosen.css"> -->
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
            <td width="30%" class="list_title">新增出版品</td>
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
      if( (isset($_GET['sel'])&&$_GET['sel']!='') && (isset($_GET['y'])&&$_GET['y']!='') ){

          if( (isset($_GET['sel'])&&$_GET['sel']!='') ){
            $reviewLink = "http://".$_SERVER['HTTP_HOST'].$nowFile."/"."publications.php?cat=".$_GET['sel']."&y=".$_GET['y'];
          }else{
            $reviewLink = "http://".$_SERVER['HTTP_HOST'].$nowFile."/"."publications.php";
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
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">分類</td>
                  <td>
  <label>
  <select data-placeholder="請選擇分類..." class="chosen-select table_data" tabindex="4" name="d_class2[]" id="d_class2">
  <?php
do {  
?>
  <option value="<?php echo $row_RecPublicationsT['term_id']?>"<?php if (!(strcmp($row_RecPublicationsT['term_id'], $G_sel))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecPublicationsT['name']?><?php //echo $row_RecPublicationsT['term_id']?></option>
  <?php
} while ($row_RecPublicationsT = mysql_fetch_assoc($RecPublicationsT));
  $rows = mysql_num_rows($RecPublicationsT);
  if($rows > 0) {
      mysql_data_seek($RecPublicationsT, 0);
	  $row_RecPublicationsT = mysql_fetch_assoc($RecPublicationsT);
  }
?>
  </select>
  </label>
                    </td>
                  <td width="250" bgcolor="#e5ecf6">
                    <input name="d_class1" type="hidden" id="d_class1" value="publications" />
                    <!--<input id="fullIdPath" type="hidden" value="1,8,24" />-->
                    </td>
                </tr>
            	<tr>
            	  <td align="center" bgcolor="#e5ecf6" class="table_col_title">標題</td>
            	  <td><input name="d_title" type="text" class="table_data" id="d_title" size="50" /></td>
            	  <td bgcolor="#e5ecf6">&nbsp;</td>
          	  </tr>
            	
              <tr>
            	  <td align="center" bgcolor="#e5ecf6" class="table_col_title">內容</td>
            	  <td><textarea name="d_content" cols="100" rows="20" class="table_data tiny" id="d_content"></textarea></td>
            	  <td bgcolor="#e5ecf6"><p class="red_letter">*小斷行請按Shift+Enter。<br />
            	    輸入區域的右下角可以調整輸入空間的大小。</p>
            	    <!-- <p class="red_letter">*圖片請上傳寬不大於900 pixel 72dpi之圖檔。</p> --></td>
          	  </tr>
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
                    
                    <!-- <table width="100%" border="0" cellspacing="5" cellpadding="2" id="addF">
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
                  </table>   -->
                    
                              </td>  
              	    <td bgcolor="#e5ecf6" class="table_col_title">
                    <p class="red_letter">*<?php echo $imagesSize[$_SESSION['nowMenu']]['note'];?></p>
                    </td>
                </tr>

                <tr>
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳檔案</p>                    </td>
                    <td>
                    <table border="0" cellpadding="2" cellspacing="2" bordercolor="#CCCCCC" class="data" id="pTable2">
                      <tr>
                        <td> <span class="table_data">選擇檔案：</span>
                          <input name="upfile[]" type="file" class="table_data" id="upfile1" />
                          <br>
                          <span class="table_data">檔案說明：</span>
                          <input name="upfile_title[]" type="text" class="table_data" id="upfile_title1">                         </td>
                      </tr>
                    </table>
                    <?php if(0){?>
                    <table width="100%" border="0" cellspacing="5" cellpadding="2">
                      <tr>
                          <td>
                          <table border="0" cellspacing="2" cellpadding="2">
                            <tr>
                                <td width="16"><a href="javascript:addField2()"><img src="image/add.png" width="16" height="16" border="0"></a></td>
                                  <td width="48"><a href="javascript:addField2()" class="table_data">新增檔案</a></td>
                                  <td width="390" class="red_letter">&nbsp;</td>
                              </tr>
                          </table>                          </td>
                        </tr>
                    </table>                    
                    <?php } ?>
                    </td>  
                    <td bgcolor="#e5ecf6" class="table_col_title"><p class="red_letter">
                      *每次上傳之檔案大小總計請勿超過<?php echo ini_get("upload_max_filesize"); ?>。
                      </p>
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
<script src="../js/datetimepicker-master/build/jquery.datetimepicker.full.js"></script>

<script type="text/javascript">
    /*var config = {
      '.chosen-select'           : {}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }*/
$(document).ready(function(){
  //$(".chosen-select").chosen({no_results_text: "沒有找到符合的字！"});

  $.datetimepicker.setLocale('zh-TW');
  $('#d_date').datetimepicker({
    timepicker:false,
    format:'Y-m-d',
    dayOfWeekStart : 1
  });
});
</script>

</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($RecPublicationsT);

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
 
  $d_price1 =($_POST['d_price1']=='') ? 0 : $_POST['d_price1'] ;
  $d_price2 =($_POST['d_price2']=='') ? 0 : $_POST['d_price2'] ;
  //$d_price3 =($_POST['d_price3']=='') ? 0 : $_POST['d_price3'] ;
  /*if($_POST['d_sale']==1){
	$d_price4 =($_POST['d_price4']=='') ? 0 : $_POST['d_price4'] ;
  }else{
	 $d_price4 = 0; 
  }*/


 $d_tag = '';
 $class3 = '';
 /*if(isset($_POST['d_class2'])){
 	$d_tag = $_POST['d_class2'];
 }*/
 $d_tag = is_null(checkV('d_class2')) ? NULL : implode (",", checkV('d_class2'));
 
 //echo 'd_tag = '.$d_tag.'<br>';
 
 $tagA = $_POST['d_class2'];
 $tagTMP = '';
 $d_tagTXT = "";
 //echo 'tagA = '.$tagA.'<br>';
 
 $d_title	= checkV('d_title');
 $d_title_en = checkV('d_title_en');
 $d_content	= checkV('d_content');
 $d_class1	= checkV('d_class1');
 $d_class2 = $d_tag;
 $d_class3	= checkV('d_class3');
 $d_class4	= checkV('d_class4');
 $d_class5	= checkV('d_class5');
 $d_class6	= checkV('d_class6');
 $d_date	= checkV('d_date');
 $d_active	= checkV('d_active'); 
 $d_pub  = checkV('d_pub');
  
 $d_data1	= checkV('d_data1');
 $d_data2	= checkV('d_data2');
 $d_data3	= checkV('d_data3');
  
  $insertSQL = sprintf("INSERT INTO data_set (d_title, d_title_en, d_content, d_class1, d_class2, d_tag, d_class3, d_class4, d_class5, d_class6, d_data1, d_data2, d_data3, d_price1, d_price2, d_date, d_active, d_pub) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
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
                       GetSQLValueString($d_active, "int"),
                       GetSQLValueString($d_pub, "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
  
    //----------插入圖片資料到資料庫begin(須放入插入主資料後)----------
   			//echo image_process();
	
			/*$sql_max_data= "Select MAX(d_id) From data_set";//找到d_id的最大值,放入圖片資料內
			//echo $sql_max_data;
			$result_max_data=mysql_query($sql_max_data);
			
			if($row_max_data = mysql_fetch_array($result_max_data))
			{	
			
				$new_data_num=$row_max_data[0];
		
				//echo $row_max_data[0];
			}*/
	$new_data_num = mysql_insert_id();

  $i=1;
			
	foreach ($tagA as $tagO){
		$insertSQL = sprintf("INSERT INTO term_relationships (object_id, term_taxonomy_id) VALUES (%s, %s)",
                       GetSQLValueString($new_data_num, "int"),
                       GetSQLValueString($tagO, "int"));

		  mysql_select_db($database_connect2data, $connect2data);
		  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());

      mysql_select_db($database_connect2data, $connect2data);
      $query_RecPublicationsT = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='publicationsT' AND T.term_active='1' ORDER BY term_sort ASC, term_id DESC";
      $RecPublicationsT = mysql_query($query_RecPublicationsT, $connect2data) or die(mysql_error());
      $row_RecPublicationsT = mysql_fetch_assoc($RecPublicationsT);
      $totalRows_RecPublicationsT = mysql_num_rows($RecPublicationsT);

      if($i==1){
        $tagTMP = $tagO;  
      }
		  $i++;

    mysql_select_db($database_connect2data, $connect2data);
    $query_RecPublicationsT = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='publicationsT' AND T.term_active='1' AND term_id='$tagO'";
    $RecPublicationsT = mysql_query($query_RecPublicationsT, $connect2data) or die(mysql_error());
    $row_RecPublicationsT = mysql_fetch_assoc($RecPublicationsT);
    $totalRows_RecPublicationsT = mysql_num_rows($RecPublicationsT);
   
    //$d_tagTXT = $d_tagTXT.$row_RecPublicationsT['name'].",".$row_RecPublicationsT['name_en'].",";

    if($row_RecPublicationsT['name']!=''){
      $d_tagTXT = $d_tagTXT.$row_RecPublicationsT['name'].",";
    }
    if($row_RecPublicationsT['name_en']!=''){
      $d_tagTXT = $d_tagTXT.$row_RecPublicationsT['name_en'].",";
    }
	}


  $updateSQL = sprintf("UPDATE data_set SET d_tag_txt=%s WHERE d_id=%s",
                       GetSQLValueString($d_tagTXT, "text"),
                       GetSQLValueString($d_id, "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
			
	$image_result=image_process($_FILES['image'], $_REQUEST['image_title'], "publications","add", $imagesSize[$_SESSION['nowMenu']]['IW'], $imagesSize[$_SESSION['nowMenu']]['IH']);
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
			
		$file_result=file_process("publications","add");
	
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
    $query_RecPublications = "SELECT * FROM term_relationships AS TR, data_set AS D, terms AS T
    WHERE TR.term_taxonomy_id = T.term_id AND D.d_id = TR.object_id AND T.term_id='$tagTMP' ORDER BY term_order ASC, d_date DESC";
    $RecPublications = mysql_query($query_RecPublications, $connect2data) or die(mysql_error());
    $row_RecPublications = mysql_fetch_assoc($RecPublications);
    $totalRows_RecPublications = mysql_num_rows($RecPublications);

    $_SESSION['totalRows'] = $totalRows_RecPublications;
	
	
  $_SESSION['original_selected'] = $_SESSION['selected_publicationsT'] = $tagTMP;


  $stringLink = "?sel=".$tagTMP."&pageNum=0&totalRows_RecPublications=".$_SESSION['totalRows']."&changeSort=1&now_d_id=".$new_data_num."&change_num=1&y=".date("Y", strtotime($d_date));
  
  $insertGoTo = "publications_list.php".$stringLink;

  //$insertGoTo = "publications_list.php?sel=".$tagTMP."&pageNum=0&totalRows_RecPublications=".$_SESSION['totalRows']."&changeSort=1&now_d_id=".$new_data_num."&change_num=1";
  
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }

  $_SESSION['listLinks'] = $insertGoTo;

  $selfLink = "publications_add.php".$stringLink;
  
  if($image_result[0][0]==1)
  {
  		echo "<script type=\"text/javascript\">call_alert('".$stringLink."');</script>";
  }else
  {
  		header(sprintf("Location: %s", $stringLink));
  }
  
}
?>

