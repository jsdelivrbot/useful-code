<?php require_once('../sstart.php'); ?>
<?php require_once('../Connections/connect2data.php'); ?>
<?php

if(!in_array(2,$_SESSION['MM_Limit']['a1'])){
	header("Location: authorityC_list.php");
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
$menu_is="authority";?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php require_once('cmsTitle.php'); ?></title>
<?php require_once('script.php'); ?>
<!-- InstanceBeginEditable name="doctitle" -->
<title>無標題文件</title>

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
            <td width="224" class="list_title">新增權限種類</td>
            <td><span class="note_letter_2">*選擇允許後，才可以勾選[新增]、[編輯]、[刪除]</span></td>
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
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">種類名稱</td>
          	    	<td><input name="a_title" type="text" class="table_data" id="a_title" value="" size="50" /></td>
          	    	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	    	</tr>
                <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">權限管理</td>
          	    	<td class="table_data"><label>
          	        <select name="a_1" class="table_data permSel" id="a_1" data-num='1'>
          	          <option value="3">允許</option>
          	          <option value="0" selected="selected">不允許</option>
       	            </select></label>
                    
                    <div class="perm" id="perm_1">                    
                    	<label for="add_1">
                    		<input name="add_1" type="checkbox" id="add_1" value="2" disabled="disabled" />
                            新增
                        </label>
                    	<label for="edit_1">
                    		<input name="edit_1" type="checkbox" id="edit_1" value="5" disabled="disabled" />
                            編輯
                        </label>
                    	<label for="del_1">
                    		<input name="del_1" type="checkbox" id="del_1" value="7" disabled="disabled" />
                            刪除
                        </label>
                    </div>
                    
                    </td>
          	     	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
                <tr>
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title">首頁Banner</td>
                  <td class="table_data"><select name="a_2" class="table_data permSel" id="a_2" data-num='2'>
                    <option value="3">允許</option>
                    <option value="0" selected="selected">不允許</option>
                  </select>
                    
                    <div class="perm" id="perm_2">                   
                    	<label for="add_2">
                    		<input name="add_2" type="checkbox" id="add_2" value="2" disabled="disabled" />
                            新增
                        </label>
                    	<label for="edit_2">
                    		<input name="edit_2" type="checkbox" id="edit_2" value="5" disabled="disabled" />
                            編輯
                        </label>
                    	<label for="del_2">
                    		<input name="del_2" type="checkbox" id="del_2" value="7" disabled="disabled" />
                            刪除
                        </label>
                    </div>
                    </td>
                  <td bgcolor="#e5ecf6">&nbsp;</td>
                </tr>
                <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">最新消息</td>
          	    	<td class="table_data"><label>
          	        <select name="a_3" class="table_data permSel" id="a_3" data-num='3'>
          	          <option value="3">允許</option>
          	          <option value="0" selected="selected">不允許</option>
       	            </select></label>
                    
                    <div class="perm" id="perm_3">                   
                    	<label for="add_3">
                    		<input name="add_3" type="checkbox" id="add_3" value="2" disabled="disabled" />
                            新增
                        </label>
                    	<label for="edit_3">
                    		<input name="edit_3" type="checkbox" id="edit_3" value="5" disabled="disabled" />
                            編輯
                        </label>
                    	<label for="del_3">
                    		<input name="del_3" type="checkbox" id="del_3" value="7" disabled="disabled" />
                            刪除
                        </label>
                    </div>
                    </td>
          	     	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">產品介紹</td>
                  <td class="table_data"><label>
                    <select name="a_4" class="table_data permSel" id="a_4" data-num='4'>
                      <option value="3">允許</option>
                      <option value="0" selected="selected">不允許</option>
                      </select></label>
                    
                    <div class="perm" id="perm_4">                   
                    	<label for="add_4">
                    		<input name="add_4" type="checkbox" id="add_4" value="2" disabled="disabled" />
                            新增
                        </label>
                    	<label for="edit_4">
                    		<input name="edit_4" type="checkbox" id="edit_4" value="5" disabled="disabled" />
                            編輯
                        </label>
                    	<label for="del_4">
                    		<input name="del_4" type="checkbox" id="del_4" value="7" disabled="disabled" />
                            刪除
                        </label>
                    </div>
                    </td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                </tr>
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">會員專區</td>
                  <td class="table_data"><label>
                    <select name="a_5" class="table_data permSel" id="a_5" data-num='5'>
                      <option value="3">允許</option>
                      <option value="0" selected="selected">不允許</option>
                      </select></label>
                    
                    <div class="perm" id="perm_5">                   
                    	<!--<label for="add_5">
                    		<input name="add_5" type="checkbox" id="add_5" value="2" disabled="disabled" />
                            新增
                        </label>-->
                    	<label for="edit_5">
                    		<input name="edit_5" type="checkbox" id="edit_5" value="5" disabled="disabled" />
                            編輯
                        </label>
                    	<label for="del_5">
                    		<input name="del_5" type="checkbox" id="del_5" value="7" disabled="disabled" />
                            刪除
                        </label>
                    </div>
                    </td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                </tr>
                <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">訂單管理</td>
          	    	<td class="table_data"><label>
          	        <select name="a_6" class="table_data permSel" id="a_6" data-num='6'>
          	          <option value="3">允許</option>
          	          <option value="0" selected="selected">不允許</option>
       	            </select></label>
                    
                    <div class="perm" id="perm_6">                   
                    	<!--<label for="add_6">
                    		<input name="add_6" type="checkbox" id="add_6" value="2" disabled="disabled" />
                            新增
                        </label>-->
                    	<label for="edit_6">
                    		<input name="edit_6" type="checkbox" id="edit_6" value="5" disabled="disabled" />
                            編輯
                        </label>
                    	<label for="del_6">
                    		<input name="del_6" type="checkbox" id="del_6" value="7" disabled="disabled" />
                            刪除
                        </label>
                    </div>
                    </td>
          	     	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">關於我們</td>
                  <td class="table_data"><label>
                    <select name="a_7" class="table_data permSel" id="a_7" data-num='7'>
                      <option value="3">允許</option>
                      <option value="0" selected="selected">不允許</option>
                      </select></label>
                    
                    <div class="perm" id="perm_7">                   
                    	<!--<label for="add_7">
                    		<input name="add_7" type="checkbox" id="add_7" value="2" disabled="disabled" />
                            新增
                        </label>-->
                    	<label for="edit_7">
                    		<input name="edit_7" type="checkbox" id="edit_7" value="5" disabled="disabled" />
                            編輯
                        </label>
                    	<!--<label for="del_7">
                    		<input name="del_7" type="checkbox" id="del_7" value="7" disabled="disabled" />
                            刪除
                        </label>-->
                    </div>
                    </td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                </tr>
                <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">聯絡我們</td>
          	    	<td class="table_data"><label>
          	        <select name="a_8" class="table_data permSel" id="a_8" data-num='8'>
          	          <option value="3">允許</option>
          	          <option value="0" selected="selected">不允許</option>
       	            </select></label>
                    
                    <div class="perm" id="perm_8">                   
                    	<!--<label for="add_8">
                    		<input name="add_8" type="checkbox" id="add_8" value="2" disabled="disabled" />
                            新增
                        </label>-->
                    	<label for="edit_8">
                    		<input name="edit_8" type="checkbox" id="edit_8" value="5" disabled="disabled" />
                            編輯
                        </label>
                    	<!--<label for="del_8">
                    		<input name="del_8" type="checkbox" id="del_8" value="7" disabled="disabled" />
                            刪除
                        </label>-->
                    </div>
                    </td>
          	     	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
                <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">表單下載</td>
          	    	<td class="table_data"><label>
          	        <select name="a_9" class="table_data permSel" id="a_9" data-num='9'>
          	          <option value="3">允許</option>
          	          <option value="0" selected="selected">不允許</option>
       	            </select></label>
                    
                    <div class="perm" id="perm_9">                   
                    	<!--<label for="add_9">
                    		<input name="add_9" type="checkbox" id="add_9" value="2" disabled="disabled" />
                            新增
                        </label>-->
                    	<label for="edit_9">
                    		<input name="edit_9" type="checkbox" id="edit_9" value="5" disabled="disabled" />
                            編輯
                        </label>
                    	<!--<label for="del_9">
                    		<input name="del_9" type="checkbox" id="del_9" value="7" disabled="disabled" />
                            刪除
                        </label>-->
                    </div>
                    </td>
          	     	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
                <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">免運費設定</td>
          	    	<td class="table_data"><label>
          	        <select name="a_10" class="table_data permSel" id="a_10" data-num='10'>
          	          <option value="3">允許</option>
          	          <option value="0" selected="selected">不允許</option>
       	            </select></label>
                    
                    <div class="perm" id="perm_10">                   
                    	<!--<label for="add_10">
                    		<input name="add_10" type="checkbox" id="add_10" value="2" disabled="disabled" />
                            新增
                        </label>-->
                    	<label for="edit_10">
                    		<input name="edit_10" type="checkbox" id="edit_10" value="5" disabled="disabled" />
                            修改
                        </label>
                    	<!--<label for="del_10">
                    		<input name="del_10" type="checkbox" id="del_10" value="7" disabled="disabled" />
                            刪除
                        </label>-->
                    </div>
                    </td>
          	     	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
                
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
<script type="text/javascript">
$(document).ready(function() {
	$( ".permSel" ).each(function() {
		checkBoxV($(this).data('num'),$(this).val() );
	});
  $( ".permSel" ).change(function() {
	 // alert( $(this).attr('id').replace('a_', '') );
	// alert( $(this).data('num') );
	 //alert( $(this).val() );
	 checkBoxV($(this).data('num'),$(this).val() );
	});
});
function checkBoxV(n, v){
	if(v==0){
		$('#add_'+n).prop("checked",'').attr("disabled", true);
		$('#edit_'+n).prop("checked",'').attr("disabled", true);
		$('#del_'+n).prop("checked",'').attr("disabled", true);
	}else{
		$('#add_'+n).attr("disabled", false);
		$('#edit_'+n).attr("disabled", false);
		$('#del_'+n).attr("disabled", false);
	}
}
</script>
<?php
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

require_once('permissionSum.php');

/*echo 'a_1 = '.$_POST['a_1'].'<br>';
echo 'add_1 = '.$_POST['add_1'].'<br>';
echo 'edit_1 = '.$_POST['edit_1'].'<br>';
echo 'del_1 = '.$_POST['del_1'].'<br>';*/
	
	$a_1 = numSum(checkN('a_1'), checkN('add_1'), checkN('edit_1'), checkN('del_1'));
	$a_2 = numSum(checkN('a_2'), checkN('add_2'), checkN('edit_2'), checkN('del_2'));
	$a_3 = numSum(checkN('a_3'), checkN('add_3'), checkN('edit_3'), checkN('del_3'));
	$a_4 = numSum(checkN('a_4'), checkN('add_4'), checkN('edit_4'), checkN('del_4'));
	$a_5 = numSum(checkN('a_5'), checkN('add_5'), checkN('edit_5'), checkN('del_5'));
	$a_6 = numSum(checkN('a_6'), checkN('add_6'), checkN('edit_6'), checkN('del_6'));
	$a_7 = numSum(checkN('a_7'), checkN('add_7'), checkN('edit_7'), checkN('del_7'));
	$a_8 = numSum(checkN('a_8'), checkN('add_8'), checkN('edit_8'), checkN('del_8'));
	$a_9 = numSum(checkN('a_9'), checkN('add_9'), checkN('edit_9'), checkN('del_9'));
	$a_10 = numSum(checkN('a_10'), checkN('add_10'), checkN('edit_10'), checkN('del_10'));
	$a_11 = NULL;
	$a_12 = NULL;
	$a_13 = NULL;
	$a_14 = NULL;
	$a_15 = NULL;
	$a_16 = NULL;
 
  $insertSQL = sprintf("INSERT INTO a_set (a_title, a_1, a_2, a_3, a_4, a_5, a_6, a_7, a_8, a_9, a_10, a_11, a_12, a_13, a_14, a_15, a_16) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['a_title'], "text"),
                       GetSQLValueString($a_1, "int"),
                       GetSQLValueString($a_2, "int"),
                       GetSQLValueString($a_3, "int"),
                       GetSQLValueString($a_4, "int"),
                       GetSQLValueString($a_5, "int"),
                       GetSQLValueString($a_6, "int"),
                       GetSQLValueString($a_7, "int"),
                       GetSQLValueString($a_8, "int"),
                       GetSQLValueString($a_9, "int"),
                       GetSQLValueString($a_10, "int"),
                       GetSQLValueString($a_11, "int"),
                       GetSQLValueString($a_12, "int"),
                       GetSQLValueString($a_13, "int"),
                       GetSQLValueString($a_14, "int"),
                       GetSQLValueString($a_15, "int"),
                       GetSQLValueString($a_16, "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
	
  $insertGoTo = "authorityC_list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  
  if($image_result[0][0]==1 || $file_type_wrong==1)
  {	
  		echo "<script type=\"text/javascript\">call_alert('".$insertGoTo."');</script>";
  }else
  {
  		header(sprintf("Location: %s", $insertGoTo));
  }
  
}
?>

