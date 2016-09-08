<?php require_once('../sstart.php'); ?>
<?php require_once('../Connections/connect2data.php'); ?>
<?php require_once('photo_process_about.php'); ?>
<?php require_once('photo_process_reportImage.php'); ?>
<?php

if(!in_array(2,$_SESSION['MM_Limit']['a6'])){
	header("Location: share_list.php");
}

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

$G_selected1 = '';
if (isset($_SESSION['selected_year'])){
	$G_selected1 = $_SESSION['selected_year'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecYears = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='years' AND T.term_active='1' ORDER BY term_sort ASC, term_id DESC";
$RecYears = mysql_query($query_RecYears, $connect2data) or die(mysql_error());
$row_RecYears = mysql_fetch_assoc($RecYears);
$totalRows_RecYears = mysql_num_rows($RecYears);

$menu_is="share";
$_SESSION['nowMenu']= "share";
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
<script type="text/javascript">
<!--
function call_alert(link_url) {
			
			alert("上傳得檔案中，有的不是圖片!");
			window.location=link_url;
			
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
		
//}

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
            <td width="30%" class="list_title">新增課程分享</td>
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
      if(isset($_SESSION['listLinks']) && $_SESSION['listLinks']!=''){ 
          $reviewPage = "share_detail.php?id=".$_GET['now_d_id'];
          $reviewLink = "http://".$_SERVER['HTTP_HOST'].$nowFile."/".$reviewPage;
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
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">年份</td>
                  <td><label>
                    <select name="d_class2" id="d_class2" class="table_data">
                      <?php
do {  
?>
                      <option value="<?php echo $row_RecYears['term_id']?>"<?php if (!(strcmp($row_RecYears['term_id'], $G_selected1))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecYears['name']?></option>
                      <?php
} while ($row_RecYears = mysql_fetch_assoc($RecYears));
  $rows = mysql_num_rows($RecYears);
  if($rows > 0) {
      mysql_data_seek($RecYears, 0);
	  $row_RecYears = mysql_fetch_assoc($RecYears);
  }
?>
                    </select>
                  </label></td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                </tr>

                <tr>
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title">月份</td>
                  <td><label>
                    <select name="d_class3" id="d_class3" class="table_data">

                      <?php 
                      for($i=1; $i<=12; $i++){
                        echo "<option value='$i'>$i 月</option>";
                      }
                      ?>

                    </select>
                  </label></td>
                  <td bgcolor="#e5ecf6">&nbsp;</td>
                </tr>

              <tr>
            	  <td align="center" bgcolor="#e5ecf6" class="table_col_title">標題</td>
            	  <td><input name="d_title" type="text" class="table_data" id="d_title" size="80" /></td>
            	  <td bgcolor="#e5ecf6">&nbsp;</td>
          	  </tr>
              
              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">版型選擇</td>
                <td class="table_data">
                
                  <div class="radioGroup">
                    <label for="d_price1_1">
                      <input name="d_price1" type="radio" id="d_price1_1" value="1" checked="CHECKED">
                      一般內文
                    </label>
                  </div>

                  <div class="radioGroup">
                    <label for="d_price1_2">
                      <input name="d_price1" type="radio" id="d_price1_2" value="2">
                      Youtube 影片
                    </label>
                  </div>

                </td>
                <td bgcolor="#e5ecf6"><span class="note_letter"></span></td>
              </tr>
            </table>

            <table width="100%" border="0" cellpadding="5" cellspacing="3" id="contentEdit">
            	<tr>
            	  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">內容</td>
            	  <td><textarea name="d_content" cols="100" rows="20" class="table_data tiny" id="d_content"></textarea></td>
            	  <td width="250" bgcolor="#e5ecf6"><p class="red_letter">*小斷行請按Shift+Enter。<br />
            	    輸入區域的右下角可以調整輸入空間的大小。</p></td>
          	  </tr>
            </table>

            <table width="100%" border="0" cellpadding="5" cellspacing="3" id="youtubeCode">
              <tr>
                <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">youtube影片碼</td>
                <td><input name="d_data1" type="text" class="table_data" id="d_data1" value="" size="70" /></td>
                <td width="250" bgcolor="#e5ecf6"><p class="red_letter_2">請先自行將影片上傳至 youtube後，再將影片碼輸入於左方文字欄位。<br />
                例如，影片網址為：https://www.youtube.com/watch?v=cTOyFes4tX4，網址watch?v=後面則為影片碼( cTOyFes4tX4 )。
                

                </p></td>
              </tr>
            </table>

            <table width="100%" border="0" cellpadding="5" cellspacing="3">
              <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">日期</td>
                  <td><input name="d_date" type="text" class="table_data" id="d_date" value="<?php echo date("Y-m-d H:i:s"); ?>" size="50" />

                  </td>
                	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      </tr>

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
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">發佈狀態</td>
                  <td><label>
                    <select name="d_pub" class="table_data" id="d_pub">
                      <option value="0">草稿</option>
                      <option value="1">發佈</option>
                    </select></label></td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                </tr>
                </table>

                <table width="100%" border="0" cellpadding="5" cellspacing="3" id="coverImg">
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳封面圖片</p></td>
                    <td>
                    <table width="100%" border="0" cellpadding="2" cellspacing="2" bordercolor="#CCCCCC" class="data" id="pTableCover">
                      <tr>
                        <td> <span class="table_data">選擇圖片：</span>
                          <input name="imageCover[]" type="file" class="table_data" id="imageCover1" />
                          <br>
                          <span class="table_data">圖片說明：</span>
                          <input name="imageCover_title[]" type="text" class="table_data" id="imageCover_title1">                         </td>
                      </tr>
                    </table>
                   </td>  
                    <td width="250" bgcolor="#e5ecf6" class="table_col_title"><p class="red_letter">*<?php echo $imagesSize[$_SESSION['nowMenu']."Cover"]['note'];?>。</p></td>
                </tr>
                </table>
                
                <table width="100%" border="0" cellpadding="5" cellspacing="3" id="contentImg">
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳內容圖片</p>                    </td>
                    <td>
                    <table width="100%" border="0" cellpadding="2" cellspacing="2" bordercolor="#CCCCCC" class="data" id="pTable">
                      <tr>
                        <td> <span class="table_data">選擇圖片：</span>
                          <input name="image[]" type="file" class="table_data" id="image1" />
                          <br>
                          <span class="table_data">圖片說明：</span>
                          <input name="image_title[]" type="text" class="table_data" id="image_title1">                         </td>
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
                          </table>                          </td>
                        </tr>
                  </table>
                  <?php } ?>
                  </td>  
                    <td width="250" bgcolor="#e5ecf6" class="table_col_title"><p class="red_letter">*<?php echo $imagesSize[$_SESSION['nowMenu']]['note'];?>。
                    <br /><br />
                    若選擇youtube影片，且無上傳封面圖片時，則系統會自動抓取youtube封面。
                    </p></td>
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
              //echo "listLinst = ".$_SESSION['listLinks'];

            if(isset($_SESSION['listLinks']) && $_SESSION['listLinks']!=''){ 
                //$reviewLink = "../".$reviewPage;
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
    <input type="hidden" name="d_class4" id="d_class4" value="" />
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
function addField() {
  var rowindex = $('#pTable tr').length;
  //console.log(rowindex);
  var myField = $('#image'+rowindex);
  //console.log(myField.val());

  if(myField.val()!=""){
    var newRow = rowindex + 1;
    var addTxt = '<tr><td><span class="table_data">選擇圖片： </span><input name="image[]" type="file" class="table_data" id="image'+newRow+'"><br><span class="table_data">圖片說明： </span><input name="image_title[]" type="text" class="table_data" id="image_title'+newRow+'"></td></tr>';

    $('#pTable').append(addTxt);

  }else{
    alert("尚有未選取之圖片欄位!!");
  }

}

function checkType(val){
  //console.log(val);
  if(val==1){ //一般
    $("#contentEdit").show();
    $("#youtubeCode").hide();
    $("#contentImg").show();
  }else if(val==2){ //影片
    $("#contentEdit").hide();
    $("#youtubeCode").show();
    $("#contentImg").hide();
  }
}

$(function() {

    checkType($("input[name='d_price1']:checked").val());

    $("#d_class4").val( $("#d_class2 option:selected").text() );

    $("input[name='d_price1']").change(function(){
      checkType($("input[name='d_price1']:checked").val());
    });

    $("#d_class2").change(function(){
      $("#d_class4").val( $("#d_class2 option:selected").text() );
      //console.log($("#d_class4").val());
    });

  });
</script>

</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($RecYears);

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  
 $d_title	= checkV('d_title');
 $d_content	= checkV('d_content');
 $d_class2	= checkV('d_class2');
 $d_class3  = checkV('d_class3');
 $d_class4  = checkV('d_class4');
 $d_price1  = checkV('d_price1');

 $d_pub  = checkV('d_pub');
 $d_data1  = checkV('d_data1');
  

 if($d_price1=="1"){  //一般內文
  $d_data1 = NULL;
 }elseif($d_price1=="2"){
  $d_content = NULL;  //Youtube 影片
 }
/*
 //確認是否有關聯
 $d_class4	= checkV('relationship');

if( is_null($d_class4) ){
  $d_class4 = 0;
}

 $d_class3 = NULL;
 if($d_class4==1){
  //如有關聯則寫入藝人
  $d_class3 = checkV('d_class3'); 
 }
 */
 
 $d_date	= checkV('d_date');
 $d_active	= checkV('d_active');  
 
 /*$mydate=getdate(date("Y-m-d H:i:s"));
echo "y = ".$mydate['year'];

//$date = DateTime::createFromFormat("Y-m-d H:i:s", "2015-09-04 08:00:14");
$date = new DateTime("Y-m-d H:i:s", "2015-09-04 08:00:14");
echo $date->format("Y");*/

	//$y = substr($d_date, 0, 4);

  
  $insertSQL = sprintf("INSERT INTO data_set (d_title, d_content, d_class1, d_class2, d_class3, d_class4, d_data1, d_price1, d_date, d_active, d_pub) VALUES (%s, %s, 'share', %s, %s, %s, %s, %s, %s, %s, %s)",
					   GetSQLValueString($d_title, "text"),
             GetSQLValueString($d_content, "text"),
             GetSQLValueString($d_class2, "text"),
             GetSQLValueString($d_class3, "text"),
             GetSQLValueString($d_class4, "text"),
             GetSQLValueString($d_data1, "text"),
             GetSQLValueString($d_price1, "int"),
             GetSQLValueString($d_date, "date"),
             GetSQLValueString($d_active, "int"),
             GetSQLValueString($d_pub, "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
  
  $new_data_num = mysql_insert_id();//找到d_id的最大值
	
	//----------插入圖片資料到資料庫begin(須放入插入主資料後)----------  
  if($d_price1=="1"){ 			
			
	$image_result=bannerImage_process($_FILES['image'], $_REQUEST['image_title'], "share","add", $imagesSize[$_SESSION['nowMenu']]['IW'], $imagesSize[$_SESSION['nowMenu']]['IH']);
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
                       GetSQLValueString($new_data_num, "int"),
                       GetSQLValueString($image_result[$j][4], "text"),
                       GetSQLValueString($image_result[$j][5], "int"));

  			  mysql_select_db($database_connect2data, $connect2data);
  			  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
			  $_SESSION["change_image"]=1;
		}
  }
	
	//----------插入圖片資料到資料庫end----------

    //----------插入封面圖片資料到資料庫begin(須放入插入主資料後)----------
        //echo image_process();
        
    //$image_result=image_process("founder","add", "0", "0");
    $image_result = bannerImage_process($_FILES['imageCover'], $_REQUEST['imageCover_title'], "shareCover","add", $imagesSize[$_SESSION['nowMenu'].'Cover']['IW'], $imagesSize[$_SESSION['nowMenu'].'Cover']['IH']);
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
    //----------插入封面圖片資料到資料庫end----------

      //----------插入youtube圖片資料到資料庫begin(須放入插入主資料後)----------   
  if(isset($d_data1) && $d_data1!='' && $d_price1=="2"){
    //$imageLink = "http://img.youtube.com/vi/".$d_data1."/0.jpg";
    $youtubeId = $d_data1;



      /* //連接youtube api，並取得該ID的資訊
      $data = file_get_contents("https://www.googleapis.com/youtube/v3/videos?key=AIzaSyBXnABa4hiaHFK5m_Vm3Amb-Gen0syJ4Yw&part=snippet&id=$youtubeId");

      //將回傳資訊轉為array
      $json = json_decode($data, true);
      //只取description資訊
      $title = $json['items'][0]['snippet']['title'];
      $description = $json['items'][0]['snippet']['description'];

      if(isset($description)&&$description!=''){ 
      }else{
        $description = NULL;
      }
  
      $updateSQL = sprintf("UPDATE data_set SET d_data4=%s, d_data3=%s WHERE d_id=%s",
                             GetSQLValueString($title, "text"),
                           GetSQLValueString($description, "text"),
                           GetSQLValueString($new_data_num, "int"));

      mysql_select_db($database_connect2data, $connect2data);
      $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());*/

        
    $image_result=reportImageProcess("share","add", $imagesSize["shareCover"]['IW'], $imagesSize["shareCover"]['IH'], $youtubeId);
    
      //echo count($image_result);
      //echo $image_result[0][0];
      
      
      for($j=1;$j<count($image_result);$j++)
      {
          $insertSQL = sprintf("INSERT INTO file_set (file_name, file_link1, file_link2, file_link3, file_link4, file_link5, file_type, file_d_id, file_title) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
               GetSQLValueString($image_result[$j][0], "text"),
               GetSQLValueString($image_result[$j][1], "text"),
               GetSQLValueString($image_result[$j][2], "text"),
               GetSQLValueString($image_result[$j][3], "text"),
               GetSQLValueString($image_result[$j][4], "text"),
               GetSQLValueString($image_result[$j][5], "text"),
               GetSQLValueString("youtubeThumbnail", "text"),
               GetSQLValueString($new_data_num, "int"),
               GetSQLValueString($d_title, "text"));
  
          mysql_select_db($database_connect2data, $connect2data);
          $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
          
          $_SESSION["change_image"]=1;
      }
    
    }
  //----------插入youtube圖片資料到資料庫end----------

  mysql_select_db($database_connect2data, $connect2data);
  $query_RecShare = "SELECT * FROM data_set WHERE d_class1 = 'share' ORDER BY d_sort ASC, d_date DESC";
  $RecShare = mysql_query($query_RecShare, $connect2data) or die(mysql_error());
  $totalRows = mysql_num_rows($RecShare);

  $_SESSION['totalRows'] = $totalRows;

  $_SESSION['original_selected']=$_SESSION['selected_year'] = $d_class2;
  
  $stringLink = "?selected1=".$d_class2."&pageNum=0&totalRows=".$_SESSION['totalRows']."&changeSort=1&now_d_id=".$new_data_num."&change_num=1";
  
  $insertGoTo = "share_list.php".$stringLink;
	
	
	
  /*$_SESSION['original_selected']=$_SESSION['selected_year'] = $d_class2;
  $insertGoTo = "share_list.php?selected1=".$d_class2."&pageNum=0&totalRows=".($_SESSION['totalRows']+1)."&changeSort=1&now_d_id=".$new_data_num."&change_num=1";*/
  
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }

  $_SESSION['listLinks'] = $insertGoTo;

  $selfLink = $_SERVER['PHP_SELF'].$stringLink;
  
  if($image_result[0][0]==1)
  {
  		echo "<script type=\"text/javascript\">call_alert('".$selfLink."');</script>";
  }else
  {
  		header(sprintf("Location: %s", $selfLink));
  }
  
}
?>

