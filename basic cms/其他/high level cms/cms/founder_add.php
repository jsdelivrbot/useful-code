<?php require_once('../sstart.php'); ?>
<?php require_once('photo_process_about.php'); ?>
<?php


if(!in_array(2,$_SESSION['MM_Limit']['a3'])){
	header("Location: founder_list.php");
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
$menu_is="about";
$_SESSION['nowMenu']= "founder";
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
            <td width="30%" class="list_title">新增創辦人的話</td>
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
          $reviewPage = "founder_detail.php?id=".$_GET['now_d_id'];
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
   			<td><table width="100%" border="0" cellspacing="3" cellpadding="5">
            	<tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">標題</td>
          	    	<td><input name="d_title" type="text" class="table_data" id="d_title" value="" size="70" />
          	    	  </td>
        	    	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	    	</tr>
              <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">列表文字</td>
                  <td>
                  <textarea name="d_title_en" cols="100" rows="20" class="table_data" id="d_title_en"></textarea>
                   </td>
                <td width="250" bgcolor="#e5ecf6"><span class="note_letter">*小斷行請按Shift+Enter。</span></td>
              </tr>

            	<tr>
            	  <td align="center" bgcolor="#e5ecf6" class="table_col_title">內容</td>
            	  <td><textarea name="d_content" cols="100" rows="20" class="table_data tiny" id="d_content"></textarea></td>
            	  <td bgcolor="#e5ecf6"><span class="note_letter">*小斷行請按Shift+Enter。</span></td>
          	  </tr>
              
              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">版型選擇</td>
                <td class="table_data">
                
                  <div class="radioGroup">
                    <label for="d_price1_1">
                      <input name="d_price1" type="radio" id="d_price1_1" value="1" checked="CHECKED">
                      版型1
                    </label>
                  </div>

                  <div class="radioGroup">
                    <label for="d_price1_2">
                      <input name="d_price1" type="radio" id="d_price1_2" value="2">
                      版型2
                    </label>
                  </div>

                  <div class="radioGroup">
                    <label for="d_price1_3">
                      <input name="d_price1" type="radio" id="d_price1_3" value="3">
                      版型3
                    </label>
                  </div>

                </td>
                <td bgcolor="#e5ecf6"><span class="note_letter">*不同版型有各版型之圖片尺寸，請依各圖片尺寸上傳。</span></td>
              </tr>

                <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">日期</td>
          	    	<td><input name="d_date" type="text" class="table_data" id="d_date" value="<?php echo date("Y-m-d H:i:s"); ?>" size="50"></td>
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

                <tr>
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳封面圖片</p></td>
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
                    <td bgcolor="#e5ecf6" class="table_col_title"><p class="red_letter">*<?php echo $imagesSize[$_SESSION['nowMenu']."Cover"]['note'];?>。</p></td>
                </tr>

                <tr>
              		<td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳內容圖片</p>              	    </td>
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
                        	<td height="28">
                        	<table border="0" cellspacing="2" cellpadding="2">
                        		<tr>
                            		<td><a href="javascript:addField()"><img src="image/add.png" width="16" height="16" border="0"></a></td>
                                	<td><a href="javascript:addField()" class="table_data">新增圖片</a></td>
                                	<td class="red_letter">&nbsp;</td>
                            	</tr>
                        	</table>                        	</td>
                        </tr>
                  </table></td>  
              	    <td bgcolor="#e5ecf6" class="table_col_title"><p class="red_letter">*<?php echo $imagesSize[$_SESSION['nowMenu']]['note'];?>。</p></td>
                </tr>

                </table>

              <table width="100%" border="0" cellspacing="3" cellpadding="5" id="slider-container" style="display: none;">
                <tr>
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title" width="200"><p>上傳版型1 slider圖片</p>                    </td>
                    <td>
                    <table width="100%" border="0" cellpadding="2" cellspacing="2" bordercolor="#CCCCCC" class="data" id="pTableSlider">
                      <tr>
                        <td> <span class="table_data">選擇圖片：</span>
                          <input name="imageSlider[]" type="file" class="table_data" id="imageSlider1" />
                          <br>
                          <span class="table_data">圖片說明：</span>
                          <input name="imageSlider_title[]" type="text" class="table_data" id="imageSlider_title1">                         </td>
                      </tr>
                    </table>
                    <table width="100%" border="0" cellspacing="5" cellpadding="2">
                      <tr>
                          <td height="28">
                          <table border="0" cellspacing="2" cellpadding="2">
                            <tr>
                                <td><a href="javascript:addFieldSlider()"><img src="image/add.png" width="16" height="16" border="0"></a></td>
                                  <td><a href="javascript:addFieldSlider()" class="table_data">新增圖片</a></td>
                                  <td class="red_letter">&nbsp;</td>
                              </tr>
                          </table>                          </td>
                        </tr>
                  </table></td>  
                    <td bgcolor="#e5ecf6" class="table_col_title" width="250"><p class="red_letter">*<?php echo $imagesSize[$_SESSION['nowMenu']."Slider"]['note'];?>若超過可分批上傳。</p></td>
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

function addFieldSlider() {
  var rowindex = $('#pTableSlider tr').length;
  //console.log(rowindex);
  var myField = $('#imageSlider'+rowindex);
  //console.log(myField.val());

  if(myField.val()!=""){
    var newRow = rowindex + 1;
    var addTxt = '<tr><td><span class="table_data">選擇圖片： </span><input name="imageSlider[]" type="file" class="table_data" id="imageSlider'+newRow+'"><br><span class="table_data">圖片說明： </span><input name="imageSlider_title[]" type="text" class="table_data" id="imageSlider_title'+newRow+'"></td></tr>';

    $('#pTableSlider').append(addTxt);

  }else{
    alert("尚有未選取之圖片欄位!!");
  }
}

function checkSelect(){
  var selV = $("input[name='d_price1']:checked").val();
  console.log( selV );

  if(selV==1){
    $("#slider-container").show();
  }else{
    $("#slider-container").hide();
  }
}

  $(document).ready(function(){

    checkSelect();

    $('input[name="d_price1"]').on('click', function(){
      checkSelect();
    });

  });
</script>
</body>
<!-- InstanceEnd --></html>

<?php
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {  

  $d_title  = checkV('d_title');
  $d_title_en = checkV('d_title_en');
  $d_content = checkV('d_content');

  $d_date  = checkV('d_date');
  $d_active  = checkV('d_active');
  $d_pub  = checkV('d_pub');

  $d_price1 = checkV('d_price1');

  $d_class1  = "founder";
	
  $insertSQL = sprintf("INSERT INTO data_set (d_title, d_title_en, d_content, d_price1, d_class1, d_date, d_active, d_pub) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($d_title, "text"),
                       GetSQLValueString($d_title_en, "text"),
                       GetSQLValueString($d_content, "text"),
                       GetSQLValueString($d_price1, "int"),
                       GetSQLValueString($d_class1, "text"),
                       GetSQLValueString($d_date, "date"),
                       GetSQLValueString($d_active, "int"),
                       GetSQLValueString($d_pub, "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());

  $new_data_num = mysql_insert_id();//找到d_id的最大值
  
		//----------插入圖片資料到資料庫begin(須放入插入主資料後)----------
				//echo image_process();
				
		//$image_result=image_process("founder","add", "0", "0");
		$image_result = image_process($_FILES['image'], $_REQUEST['image_title'], "founder","add", $imagesSize[$_SESSION['nowMenu']]['IW'], $imagesSize[$_SESSION['nowMenu']]['IH']);
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
  
    //----------插入封面圖片資料到資料庫begin(須放入插入主資料後)----------
        //echo image_process();
        
    //$image_result=image_process("founder","add", "0", "0");
    $image_result = bannerImage_process($_FILES['imageCover'], $_REQUEST['imageCover_title'], "founderCover","add", $imagesSize[$_SESSION['nowMenu'].'Cover']['IW'], $imagesSize[$_SESSION['nowMenu'].'Cover']['IH']);
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
  
    //----------插入 版型1 slider 圖片資料到資料庫begin(須放入插入主資料後)----------
        //echo image_process();
    
    if($d_price1==1){
    //$image_result=image_process("founder","add", "0", "0");
      $image_result = bannerImage_process($_FILES['imageSlider'], $_REQUEST['imageSlider_title'], "founderSlider","add", $imagesSize[$_SESSION['nowMenu']."Slider"]['IW'], $imagesSize[$_SESSION['nowMenu']."Slider"]['IH']);
      //echo count($image_result);
      //echo $image_result[0][0];
      
      
      for($j=1;$j<count($image_result);$j++)
      {
        $insertSQL = sprintf("INSERT INTO file_set (file_name, file_link1, file_link2, file_link3, file_type, file_d_id, file_title, file_show_type) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($image_result[$j][0], "text"),
                       GetSQLValueString($image_result[$j][1], "text"),
                       GetSQLValueString($image_result[$j][2], "text"),
                       GetSQLValueString($image_result[$j][3], "text"),
                       GetSQLValueString("imageSlider", "text"),
                       GetSQLValueString($new_data_num, "int"),
                       GetSQLValueString($image_result[$j][4], "text"),
                       GetSQLValueString($image_result[$j][5], "int"));
  
          mysql_select_db($database_connect2data, $connect2data);
          $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
          
          $_SESSION["change_image"]=1;
      }
    }
    //----------插入 版型1 slider 圖片資料到資料庫end----------


  mysql_select_db($database_connect2data, $connect2data);
  $query_RecFounder = "SELECT * FROM data_set WHERE d_class1 = 'founder' ORDER BY d_sort ASC, d_date DESC";
  $RecFounder = mysql_query($query_RecFounder, $connect2data) or die(mysql_error());
  $totalRows = mysql_num_rows($RecFounder);

  $_SESSION['totalRows'] = $totalRows;
	
  $stringLink = "?pageNum_RecFounder=0&totalRows_RecFounder=".$_SESSION['totalRows']."&changeSort=1&now_d_id=".$new_data_num."&change_num=1";
  
  $insertGoTo = "founder_list.php".$stringLink;

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

