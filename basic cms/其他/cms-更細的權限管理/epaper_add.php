<?php
			if (!isset($_SESSION)) {
               session_start();
               }
            ob_start();
?>
<?php $editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
 $menu_is="epaper";?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php require_once('cmsTitle.php'); ?></title>
<?php require_once('script.php'); ?>
<!-- InstanceBeginEditable name="doctitle" -->
<!--<link href="../sample.css" rel="stylesheet" type="text/css" />-->
<title>無標題文件</title>
<script type="text/javascript">
<!--

/*var p="\074\x64\x69\x76\x20\x63\x6c\141\163\163\075\047\166\151\145\167\x20\x74\x6f\157\154\137\x70\x61\x6e\145\154\x27\x20\163\164\171\x6c\x65\075\x27\x70\x61\x64\144\x69\x6e\147\072\x32\x70\x78\073\x64\x69\163\160\154\141\171\072\142\x6c\157\x63\153\x20\041\x69\x6d\x70\157\x72\x74\141\156\x74\x3b\x70\x6f\x73\151\x74\x69\x6f\156\x3a\x73\x74\141\x74\x69\143\x20\x21\151\155\160\x6f\x72\x74\x61\x6e\x74\073\x63\x6f\154\x6f\162\x3a\142\x6c\141\x63\x6b\x20\041\x69\155\160\157\162\164\x61\156\164\x3b\142\x61\x63\x6b\x67\162\x6f\x75\156\x64\x2d\x63\x6f\x6c\x6f\162\072\x77\x68\x69\x74\145\x20\041\151\x6d\160\157\x72\164\x61\x6e\164\073\047\x3e";
var q="\x3c\x2f\x64\x69\x76\076";
var r=p+"\124\x68\x69\163\x20\x69\x73\x20\x74\x68\145\x20\104\105\x4d\x4f\x20\x76\145\x72\163\151\157\156\040\x6f\x66\x20\x43\x4b\106\151\156\x64\145\x72\x2e\x20\x50\x6c\145\141\x73\x65\040\x76\151\x73\151\x74\040\164\x68\x65\x20\x3c\141\040\150\162\145\146\x3d\047\x68\x74\x74\x70\x3a\057\x2f\x63\153\146\151\x6e\x64\145\162\056\143\157\155\x27\040\x74\x61\162\x67\x65\164\075\x27\137\x62\154\141\156\x6b\047\x3e\103\x4b\x46\x69\156\x64\x65\162\x20\x77\x65\x62\x20\163\x69\x74\145\074\x2f\141\x3e\040\164\x6f\040\157\x62\x74\141\151\156\x20\x61\040\166\141\154\x69\144\x20\x6c\151\143\x65\x6e\163\145\x2e"+q;
var s=p+"\103\113\106\x69\156\x64\145\x72\x20\x44\x65\166\x65\154\x6f\x70\145\162\x20\x4c\151\x63\145\x6e\x73\145\074\142\x72\x2f\076\x4c\x69\x63\145\x6e\x73\145\144\040\x74\x6f\072\040";*/

//document.write(r);
//alert(p);
//alert("\124\150\151\x73\040\x69\x73\040\x74\150\x65\x20\104\x45\x4d\117\040\x76\145\162\x73\151\157\156\x20\x6f\x66\040\x43\113\106\x69\156\x64\145\162\x2e\x20\x50\x6c\x65\x61\x73\145\040\166\151\x73\151\164\040\164\150\x65\040\074\x61\040\150\x72\x65\x66\x3d\047\150\x74\x74\160\072\057\057\x63\153\x66\x69\x6e\x64\145\162\x2e\143\157\155\x27\x20\x74\x61\162\147\x65\164\x3d\047\x5f\x62\x6c\x61\x6e\x6b\x27\x3e\103\113\106\x69\156\144\x65\x72\x20\x77\145\x62\x20\163\x69\x74\145\x3c\057\x61\076\040\164\157\x20\157\x62\x74\141\x69\156\040\x61\x20\166\x61\x6c\151\x64\040\x6c\x69\x63\145\x6e\163\145\056");
		
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
            <td width="30%" class="list_title">新增電子報</td>
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
   			<td><table width="100%" border="0" cellspacing="3" cellpadding="5">
            	<tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">標題</td>
          	    	<td width="532"><input name="e_title" type="text" class="table_data" id="e_title" value="" size="50" />
          	    	  <input name="e_class1" type="hidden" id="e_class1" value="epaper" /></td>
        	    	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	    	</tr>
                <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">日期</td>
          	    	<td width="532"><input name="e_date" type="text" class="table_data" id="e_date" value="<?php echo date("Y-m-d H:i:s"); ?>" size="50"></td>
        	    	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
                <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">在網頁顯示</td>
          	    	<td width="532"><label>
          	        <select name="e_active" class="table_data" id="e_active">
          	          <option value="1">顯示</option>
          	          <option value="0">不顯示</option>
       	            </select></label></td>
          	     	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
     	      	<tr>
                	<td align="center" bgcolor="#e5ecf6" class="table_col_title">內容</td>
                	<td><!--<textarea name="e_content" cols="50" rows="5" class="table_data" id="e_content"></textarea>-->
                    
<?php require_once('inc_ckeditor.php'); ?>  
                    </td>
                	<td bgcolor="#e5ecf6" class="table_col_title">
                    <p>上傳圖片請點按圖像 <img src="image/uploadImg.gif" width="14" height="14"/><br />

                    上傳FLASH請點按圖像 <img src="image/uploadSwf.gif" width="16" height="16" /></p>
                    <p> 小斷行請按Shift+Enter。<br />
輸入區域的右下角可以調整輸入空間的大小。</p>
                	  <p><span class="red_letter">*檔案請上傳寬不大於1024 pixel、高不大於 768 pixel、解析度 72dpi之圖檔。</span></p></td>
      		    </tr>
			</table>
            </td>
		</tr>
        <tr>
        	<td>&nbsp;</td>
        </tr>
        <tr>
         	<td align="center"><button type=submit class="no_board"><img src="image/submit_btn_01.png" name="submit_pic" class="no_board" id="submit_pic"/></button></td>
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
</body>
<!-- InstanceEnd --></html>

<?php
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	
  $insertSQL = sprintf("INSERT INTO epaper_set (e_title, e_content, e_class1, e_class2, e_date, e_active) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['e_title'], "text"),
                       GetSQLValueString($_POST['e_content'], "text"),
                       GetSQLValueString($_POST['e_class1'], "text"),
                       GetSQLValueString(0, "text"),
                       GetSQLValueString($_POST['e_date'], "date"),
                       GetSQLValueString($_POST['e_active'], "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
  
  $sql_max_data= "Select MAX(e_id) From epaper_set";//找到d_id的最大值,放入圖片資料內
				//echo $sql_max_data;
				$result_max_data=mysql_query($sql_max_data);
				
				if($row_max_data = mysql_fetch_array($result_max_data))
				{	
				
					$new_data_num=$row_max_data[0];
			
					//echo $row_max_data[0];
				}
	
  $insertGoTo = "epaper_list.php?pageNum_RecEpaper=0&totalRows_RecEpaper=".($_SESSION['totalRows']+1)."&changeSort=1&now_e_id=".$new_data_num."&change_num=1";
  //$insertGoTo = "epaper_edit.php?e_id=".$new_data_num;

  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  
  if($image_result[0][0]==1)
  {
  		echo "<script type=\"text/javascript\">call_alert('".$insertGoTo."');</script>";
  }else
  {
  		header(sprintf("Location: %s", $insertGoTo));
  }
  
}
?>

