<?php require_once('../sstart.php'); ?>
<?php require_once('photo_process_week.php'); ?>
<?php require_once('file_process.php'); ?>
<?php


if(!in_array(2,$_SESSION['MM_Limit']['a6'])){
	header("Location: week_list.php");
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
$menu_is="week";
$_SESSION['nowMenu']= "week";
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
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<link rel="stylesheet" href="../js/datetimepicker-master/jquery.datetimepicker.css">

<style type="text/css">
  .titleA{
    width: 210px;
    background-color: rgb(229, 236, 246);
  }
  .titleF{
    width: 260px;
    background-color: rgb(229, 236, 246);    
  }
  .titleI{
    width: 798px;
    background-color: rgb(229, 206, 246); 
  }
  .titleS{
    width: 3px;
    background-color: rgb(209, 206, 246); 
  }
  #addA {
      display:table;
      width: 100%;
      text-align: center;
      padding: 0px 3px;
  }
  .addAtr {
      display: table-row;
      border-bottom:3px solid rgba(255, 255, 255, 1);
      margin-bottom: 3px;
  }
  .addAd {
      display: table-cell;
      
  }
</style>

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
            <td width="30%" class="list_title">新增唐獎週</td>
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

          if( (isset($_GET['now_d_id'])&&$_GET['now_d_id']!='') && (isset($_GET['y'])&&$_GET['y']!='') ){
            $reviewLink = "http://".$_SERVER['HTTP_HOST'].$nowFile."/"."week.php?cat=".$_GET['now_d_id']."&y=".$_GET['y'];
          }else{
            $reviewLink = "http://".$_SERVER['HTTP_HOST'].$nowFile."/"."week.php";
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
   			<td><table width="100%" border="0" cellspacing="3" cellpadding="5">
            	<tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">名稱</td>
          	    	<td><input name="d_title" type="text" class="table_data" id="d_title" value="" size="70" />
          	    	  <input name="d_class1" type="hidden" id="d_class1" value="week" /></td>
        	    	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	    	</tr>

              <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">英文名稱</td>
                  <td><input name="d_title_en" type="text" class="table_data" id="d_title_en" value="" size="70" />
                    </td>
                <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
              </tr>
              </table>


              <table width="100%" border="0" cellspacing="3" cellpadding="5" id="addArea">
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">頁籤名稱</td>
                  <td><input name="tab_title[]" type="text" class="table_data" id="tab_title1" value="" size="70" />
                    </td>
                <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                </tr>
              	<tr>
              	  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">頁籤內容</td>
              	  <td><textarea name="tab_content[]" cols="100" rows="20" class="table_data tiny" id="tab_content1"></textarea></td>
              	  <td width="250" bgcolor="#e5ecf6"><span class="note_letter">*小斷行請按Shift+Enter。</span></td>
            	  </tr>
              </table>

              <table width="100%" border="0" cellspacing="3" cellpadding="5" >
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title"></td>
                  <td>
                    <table border="0" cellspacing="2" cellpadding="2">
                      <tr>
                          <td><a href="javascript:;" class="addTage"><img src="image/add.png" width="16" height="16" border="0"></a></td>
                            <td><a href="javascript:;" class="table_data addTage">新增頁籤</a></td>
                            <td class="red_letter">&nbsp;</td>
                        </tr>
                    </table>
                  </td>
                <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                </tr>
              </table>

              <!-- <div id="addA">

                <div class="addAtr">
                  <div class="addAd titleA table_col_title">頁籤名稱</div>
                  <div class="addAd titleS"></div>
                  <div class="addAd titleI table_data">頁籤內容</div>
                  <div class="addAd titleS"></div>
                  <div class="addAd titleF table_col_title"></div>
                </div>

                <div class="addAtr">
                  <div class="addAd titleA table_col_title">頁籤名稱</div>
                  <div class="addAd titleS"></div>
                  <div class="addAd titleI table_data">頁籤內容</div>    
                  <div class="addAd titleS"></div>            
                  <div class="addAd titleF table_col_title"></div>
                </div>

              </div> -->


              <table width="100%" border="0" cellspacing="3" cellpadding="5">

                <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">日期</td>
          	    	<td><input name="d_date" type="text" class="table_data" id="d_date" value="<?php echo date("Y-m-d"); ?>" size="50"></td>
        	    	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>

                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">是否顯示為進行中</td>
                  <td><label>
                    <select name="d_sale" class="table_data" id="d_sale">
                      <option value="0">非進行中</option>
                      <option value="1">進行中</option>
                    </select></label></td>
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
                        	<td height="28">
                        	<table border="0" cellspacing="2" cellpadding="2">
                        		<tr>
                            		<td><a href="javascript:addField()"><img src="image/add.png" width="16" height="16" border="0"></a></td>
                                	<td><a href="javascript:addField()" class="table_data">新增圖片</a></td>
                                	<td class="red_letter">&nbsp;</td>
                            	</tr>
                        	</table>
                          </td>
                      </tr>
                    </table>
                    </td>  
              	    <td bgcolor="#e5ecf6" class="table_col_title"><p class="red_letter">*<?php echo $imagesSize[$_SESSION['nowMenu']]['note'];?></p>
                   	    
              	    </p>           	        </td>
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

<script src="../js/datetimepicker-master/build/jquery.datetimepicker.full.js"></script>

<script src="tinyfy.js"></script>

<script type="text/javascript">

  $(window).load(function  () {
  })

$(document).ready(function() {

  //$('#remitter_time').datetimepicker();
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
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

 $d_title  = checkV('d_title');
 $d_title_en  = checkV('d_title_en');
 $d_content  = checkV('d_content');
 $d_class1  = checkV('d_class1');
 $d_class2  = checkV('d_class2');
 $d_date  = checkV('d_date');
 $d_active  = checkV('d_active');
 $d_pub  = checkV('d_pub');
 $d_sale  = checkV('d_sale');
	
  $insertSQL = sprintf("INSERT INTO data_set (d_title, d_title_en, d_content, d_class1, d_class2, d_date, d_active, d_pub, d_sale) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($d_title, "text"),
                       GetSQLValueString($d_title_en, "text"),
                       GetSQLValueString($d_content, "text"),
                       GetSQLValueString($d_class1, "text"),
                       GetSQLValueString($d_class2, "text"),
                       GetSQLValueString($d_date, "date"),
                       GetSQLValueString($d_active, "int"),
                       GetSQLValueString($d_pub, "int"),
                       GetSQLValueString($d_sale, "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());

  $new_data_num = mysql_insert_id();//找到d_id的最大值

  //----------插入動態頁籤資料到資料庫begin(須放入插入主資料後)----------

  if(isset($_POST['tab_title'])){

    $tab_title = $_POST['tab_title'];
    $tab_content = $_POST['tab_content'];

    for($j=0; $j<count($tab_title); $j++){

      if($tab_title[$j]!='' || $tab_content[$j]!=''){

        $insertSQL = sprintf("INSERT INTO tab_set (tab_d_id, tab_type, tab_title, tab_content, tab_sort) VALUES (%s, %s, %s, %s, %s)",
                           GetSQLValueString($new_data_num, "int"),
                           GetSQLValueString($_POST['d_class1'], "text"),
                           GetSQLValueString($tab_title[$j], "text"),
                           GetSQLValueString($tab_content[$j], "text"),
                           GetSQLValueString($j+1, "int"));
      
              mysql_select_db($database_connect2data, $connect2data);
              $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
      }
    }

  }
  //----------插入動態頁籤資料到資料庫end----------
  
		//----------插入圖片資料到資料庫begin(須放入插入主資料後)----------
				//echo image_process();
				
		//$image_result=image_process("week","add", "0", "0");
		$image_result=image_process($_FILES['image'], $_REQUEST['image_title'], "week","add", $imagesSize[$_SESSION['nowMenu']]['IW'], $imagesSize[$_SESSION['nowMenu']]['IH']);
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
			
		$file_result=file_process("week","add");
	
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
		
	
	
	//----------插入檔案資料到資料庫end----------


  mysql_select_db($database_connect2data, $connect2data);
  $query_RecWeek = "SELECT * FROM data_set WHERE d_class1 = 'week' ORDER BY d_sort ASC, d_date DESC";
  $RecWeek = mysql_query($query_RecWeek, $connect2data) or die(mysql_error());
  $totalRows = mysql_num_rows($RecWeek);

  $_SESSION['totalRows'] = $totalRows;




  $stringLink = "?pageNum_RecWeek=0&totalRows_RecWeek=".$_SESSION['totalRows']."&changeSort=1&now_d_id=".$new_data_num."&change_num=1&y=".date("Y", strtotime($d_date));
  
  $insertGoTo = "week_list.php".$stringLink;
	
  //$insertGoTo = "week_list.php?pageNum_RecWeek=0&totalRows_RecWeek=".$_SESSION['totalRows']."&changeSort=1&now_d_id=".$new_data_num."&change_num=1";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }

  $_SESSION['listLinks'] = $insertGoTo;

  $selfLink = "week_add.php".$stringLink;
  
  if($image_result[0][0]==1)
  {
  		echo "<script type=\"text/javascript\">call_alert('".$stringLink."');</script>";
  }else
  {
  		header(sprintf("Location: %s", $stringLink));
  }
  
}
?>

