<?php
			if (!isset($_SESSION)) {
               session_start();
               }
            ob_start();
?>
<?php require_once('../Connections/connect2data.php'); ?>
<?php require_once('photo_process_epaper.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

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
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
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

if(!in_array(2,$_SESSION['MM_Limit']['a12'])){
	header("Location: epaper_list.php");
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$menu_is="epaper";
$_SESSION['nowMenu']= "epaper";
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
   		 	<td>
            <table width="100%" border="0" cellpadding="5" cellspacing="3">

              <tr>
                <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">標題</td>
                <td><input name="d_title" type="text" class="table_data" id="d_title" size="50" value="第7期 2016年9月" /></td>
                <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
              </tr>

              <tr>
                <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">UID</td>
                <td><input name="d_data1" type="text" class="table_data" id="d_data1" size="50" value="" /></td>
                <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
              </tr>
              
              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">版型選擇</td>
                <td class="table_data">
                
                  <div class="radioGroup">
                    <label for="d_price1_1">
                      <input name="d_price1" type="radio" id="d_price1_1" value="1" checked="CHECKED">
                      窄圖片版型
                    </label>
                  </div>

                  <div class="radioGroup">
                    <label for="d_price1_2">
                      <input name="d_price1" type="radio" id="d_price1_2" value="2">
                      寬圖片版型
                    </label>
                  </div>

                  <div class="radioGroup">
                    <label for="d_price1_3">
                      <input name="d_price1" type="radio" id="d_price1_3" value="3">
                      綜合圖片版型
                    </label>
                  </div>

                </td>
                <td bgcolor="#e5ecf6"><span class="note_letter">*不同版型有各版型之圖片尺寸，請依各圖片尺寸上傳。</span></td>
              </tr>


              </table>

              <table width="100%" border="0" cellspacing="3" cellpadding="5" id="addOtherReportArea">
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">索引-標題1</td>
                  <td><input name="tabReport_title[]" type="text" class="table_data" id="tabReport_title1" value="" size="70" /></td>
                <td width="250" bgcolor="#e5ecf6"><p class="red_letter">*請直接填寫索引標題。</p></td>
                </tr>
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">索引-連結1</td>
                  <td><input name="tabReport_content[]" type="text" class="table_data" id="tabReport_content1" value="" size="70" /></td>
                <td width="250" bgcolor="#e5ecf6"><p class="red_letter">*請直接填寫索引連結。</p></td>
                </tr>
              </table>

              <table width="100%" border="0" cellspacing="3" cellpadding="5" >
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title"></td>
                  <td>
                    <table border="0" cellspacing="2" cellpadding="2">
                      <tr>
                          <td><a href="javascript:;" class="addReportTage"><img src="image/add.png" width="16" height="16" border="0"></a></td>
                            <td><a href="javascript:;" class="table_data addReportTage">新增索引</a></td>
                            <td class="red_letter">&nbsp;</td>
                        </tr>
                    </table>
                  </td>
                <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                </tr>
              </table>

              <!-- 版型－窄圖片版 -->
              <div id="temp1">
                <table width="100%" border="0" cellspacing="3" cellpadding="5" id="addAreaOther1">
                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">窄圖片版型區塊-標題1</td>
                    <td><input name="tabOther1_title[]" type="text" class="table_data" id="tabOther1_title1" value="" size="70" />
                      </td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">窄圖片版型區塊-內容1</td>
                    <td><textarea name="tabOther1_content[]" cols="100" rows="20" class="table_data tiny" id="tabOther1_content1"></textarea></td>
                    <td width="250" bgcolor="#e5ecf6"><span class="note_letter">*小斷行請按Shift+Enter。</span></td>
                  </tr>
                  <tr>
                    <td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳窄圖片1</p></td>
                      <td>
                        <span class="table_data">選擇圖片：</span>
                        <input name="imageShort[]" type="file" class="table_data" id="imageShort1" />
                        <br>
                        <span class="table_data">圖片說明：</span>
                        <input name="imageShort_title[]" type="text" class="table_data" id="imageShort_title1">
                      </td>  
                      <td bgcolor="#e5ecf6" class="table_col_title">
                      <p class="red_letter">*<?php echo $imagesSize["epaperShort1"]['note'];?></p>
                      </td>
                  </tr>
                </table>

                <table width="100%" border="0" cellspacing="3" cellpadding="5" >
                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title"></td>
                    <td>
                      <table border="0" cellspacing="2" cellpadding="2">
                        <tr>
                            <td><a href="javascript:;" class="addTageOther1"><img src="image/add.png" width="16" height="16" border="0"></a></td>
                              <td><a href="javascript:;" class="table_data addTageOther1">新增區塊</a></td>
                              <td class="red_letter">&nbsp;</td>
                          </tr>
                      </table>
                    </td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                  </tr>
                </table>
              </div>
              <!-- #temp1 版型－窄圖片版 -->

              <!-- 版型－寬圖片版型 -->
              <div id="temp2">
                <table width="100%" border="0" cellspacing="3" cellpadding="5" id="addAreaOther2">
                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">寬圖片版型區塊-標題1</td>
                    <td><input name="tabOther2_title[]" type="text" class="table_data" id="tabOther2_title1" value="" size="70" />
                      </td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">寬圖片版型區塊-內容1</td>
                    <td><textarea name="tabOther2_content[]" cols="100" rows="20" class="table_data tiny" id="tabOther2_content1"></textarea></td>
                    <td width="250" bgcolor="#e5ecf6"><span class="note_letter">*小斷行請按Shift+Enter。</span></td>
                  </tr>
                  <tr>
                    <td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳寬圖片1</p></td>
                      <td>
                        <span class="table_data">選擇圖片：</span>
                        <input name="imageLong[]" type="file" class="table_data" id="imageLong1" />
                        <br>
                        <span class="table_data">圖片說明：</span>
                        <input name="imageLong_title[]" type="text" class="table_data" id="imageLong_title1">
                      </td>  
                      <td bgcolor="#e5ecf6" class="table_col_title">
                      <p class="red_letter">*<?php echo $imagesSize["epaperLong1"]['note'];?></p>
                      </td>
                  </tr>
                </table>

                <table width="100%" border="0" cellspacing="3" cellpadding="5" >
                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title"></td>
                    <td>
                      <table border="0" cellspacing="2" cellpadding="2">
                        <tr>
                            <td><a href="javascript:;" class="addTageOther2"><img src="image/add.png" width="16" height="16" border="0"></a></td>
                              <td><a href="javascript:;" class="table_data addTageOther2">新增區塊</a></td>
                              <td class="red_letter">&nbsp;</td>
                          </tr>
                      </table>
                    </td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                  </tr>
                </table>
              </div>
              <!-- #temp2 版型－寬圖片版 -->

              <!-- 版型－綜合圖片版型 -->
              <div id="temp3">
                <table width="100%" border="0" cellspacing="3" cellpadding="5" id="addAreaOther3">
                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">綜合圖片版型-寬圖片區塊-標題1</td>
                    <td><input name="tabOther3_title[]" type="text" class="table_data" id="tabOther3_title1" value="" size="70" />
                      </td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">綜合圖片版型-寬圖片區塊-內容1</td>
                    <td><textarea name="tabOther3_content[]" cols="100" rows="20" class="table_data tiny" id="tabOther3_content1"></textarea></td>
                    <td width="250" bgcolor="#e5ecf6"><span class="note_letter">*小斷行請按Shift+Enter。</span></td>
                  </tr>
                  <tr>
                    <td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳寬圖片1</p></td>
                      <td>
                        <span class="table_data">選擇圖片：</span>
                        <input name="imageLong[]" type="file" class="table_data" id="imageLong1" />
                        <br>
                        <span class="table_data">圖片說明：</span>
                        <input name="imageLong_title[]" type="text" class="table_data" id="imageLong_title1">
                      </td>  
                      <td bgcolor="#e5ecf6" class="table_col_title">
                      <p class="red_letter">*<?php echo $imagesSize["epaperLong1"]['note'];?></p>
                      </td>
                  </tr>
                </table>

                <table width="100%" border="0" cellspacing="3" cellpadding="5" >
                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title"></td>
                    <td>
                      <table border="0" cellspacing="2" cellpadding="2">
                        <tr>
                            <td><a href="javascript:;" class="addTageOther3"><img src="image/add.png" width="16" height="16" border="0"></a></td>
                              <td><a href="javascript:;" class="table_data addTageOther3">新增寬圖片區塊</a></td>
                              <td class="red_letter">&nbsp;</td>
                          </tr>
                      </table>
                    </td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                  </tr>
                </table>

                <table width="100%" border="0" cellspacing="3" cellpadding="5" id="addAreaOther4">
                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">綜合圖片版型-窄圖片區塊-標題1</td>
                    <td><input name="tabOther4_title[]" type="text" class="table_data" id="tabOther4_title1" value="" size="70" />
                      </td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">綜合圖片版型-窄圖片區塊-內容1</td>
                    <td><textarea name="tabOther4_content[]" cols="100" rows="20" class="table_data tiny" id="tabOther4_content1"></textarea></td>
                    <td width="250" bgcolor="#e5ecf6"><span class="note_letter">*小斷行請按Shift+Enter。</span></td>
                  </tr>
                  <tr>
                    <td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳窄圖片1</p></td>
                      <td>
                        <span class="table_data">選擇圖片：</span>
                        <input name="imageShort[]" type="file" class="table_data" id="imageShort1" />
                        <br>
                        <span class="table_data">圖片說明：</span>
                        <input name="imageShort_title[]" type="text" class="table_data" id="imageShort_title1">
                      </td>  
                      <td bgcolor="#e5ecf6" class="table_col_title">
                      <p class="red_letter">*<?php echo $imagesSize["epaperShort1"]['note'];?></p>
                      </td>
                  </tr>
                </table>

                <table width="100%" border="0" cellspacing="3" cellpadding="5" >
                  <tr>
                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title"></td>
                    <td>
                      <table border="0" cellspacing="2" cellpadding="2">
                        <tr>
                            <td><a href="javascript:;" class="addTageOther4"><img src="image/add.png" width="16" height="16" border="0"></a></td>
                              <td><a href="javascript:;" class="table_data addTageOther4">新增窄圖片區塊</a></td>
                              <td class="red_letter">&nbsp;</td>
                          </tr>
                      </table>
                    </td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                  </tr>
                </table>

              </div>
              <!-- #temp3 版型－綜合圖片版 -->

              <table width="100%" border="0" cellspacing="3" cellpadding="5" id="addArea">
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

              <tr>
                 <td align="center" bgcolor="#e5ecf6" class="table_col_title">加入時間</td>
                 <td><input name="d_date" type="text" class="table_data" id="d_date" value="<?php echo date("Y-m-d H:i:s"); ?>" size="50"></td>
               <td bgcolor="#e5ecf6">&nbsp;</td>
              </tr>

             </table>
            </td>
         </tr>
         <tr>
           <td>&nbsp;</td>
         </tr>
         <tr>
         <td align="center">
          <input name="submitBtn" type="submit" class="btnType" id="submitBtn" value="送出" /></td>
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

<script src="tinyEpaper.js"></script>

<script type="text/javascript">

function checkSelectTemp(){
  var selV = $("input[name='d_price1']:checked").val();
  //console.log( selV );

  if(selV==1){
    $("#temp1").show();
    $("#temp2").hide();
    $("#temp3").hide();
  }else if(selV==2){
    $("#temp1").hide();
    $("#temp2").show();
    $("#temp3").hide();
  }else if(selV==3){
    $("#temp1").hide();
    $("#temp2").hide();
    $("#temp3").show();
  }
}

$(document).ready(function(){

  checkSelectTemp();

    $('input[name="d_price1"]').on('click', function(){
      checkSelectTemp();
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

  $('.addReportTage').on('click', function(){
    var rowindex = (($('#addOtherReportArea tr').length)/2)+1;
    //var rowindex = $("#addArea").closest('tr').index();
    // console.debug('rowindex', rowindex);
    // console.log('rowindex', rowindex);
    console.log("tabReport_title = "+ $("#tabReport_title"+(rowindex-1)).val());
    console.log("tabReport_content = "+ $("#tabReport_content"+(rowindex-1)).val());

    if( ($("#tabReport_title"+(rowindex-1)).val()=="") || ($("#tabReport_content"+(rowindex-1)).val()=="") ){
      alert("尚有索引標題或連結未填寫!!");
    }else{

      var addTxt = '<tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">索引-標題'+rowindex+'</td><td><input name="tabReport_title[]" type="text" class="table_data" id="tabReport_title'+rowindex+'" value="" size="70" /></td><td width="250" bgcolor="#e5ecf6"><p class="red_letter">*請直接填寫索引標題。</p></td></tr><tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">索引-連結'+rowindex+'</td><td><input name="tabReport_content[]" type="text" class="table_data" id="tabReport_content'+rowindex+'" value="" size="70" /></td><td width="250" bgcolor="#e5ecf6"><p class="red_letter">*請直接填寫索引連結。</p></td></tr>';

      $('#addOtherReportArea').append(addTxt);

    }
  });


  $('.addTageOther1').on('click', function(){
    var rowindex = (($('#addAreaOther1 tr').length)/3)+1;
    //var rowindex = $("#addAreaOther1").closest('tr').index();
    // console.debug('rowindex', rowindex);
    console.log('rowindex', rowindex);
    console.log("tabOther1_title = "+ $("#tabOther1_title"+(rowindex-1)).val());
    console.log("tabOther1_content = "+ $("#tabOther1_content"+(rowindex-1)).val());

    if(( $("#tabOther1_title"+(rowindex-1)).val()=="" ) || ( $("#tabOther1_content"+(rowindex-1)).val()=="" )){
      alert("尚有標題或內容未填寫!!");
    }else{
       var addTxt = '<tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">窄圖片版型區塊-標題'+rowindex+'</td><td><input name="tabOther1_title[]" type="text" class="table_data" id="tabOther1_title'+rowindex+'" value="" size="70" /></td><td width="250" bgcolor="#e5ecf6">&nbsp;</td></tr><tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">窄圖片版型區塊-內容'+rowindex+'</td><td><textarea name="tabOther1_content[]" cols="100" rows="20" class="table_data tiny" id="tabOther1_content'+rowindex+'"></textarea></td><td width="250" bgcolor="#e5ecf6"><span class="note_letter">*小斷行請按Shift+Enter。</span></td></tr><tr><td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳窄圖片'+rowindex+'</p></td><td><span class="table_data">選擇圖片：</span><input name="image[]" type="file" class="table_data" id="image'+rowindex+'" /><br><span class="table_data">圖片說明：</span><input name="image_title[]" type="text" class="table_data" id="image_title'+rowindex+'"></td><td bgcolor="#e5ecf6" class="table_col_title"><p class="red_letter">*'+'<?php echo $imagesSize["epaperShort1"]["note"];?>'+'</p></td></tr>';

      $('#addAreaOther1').append(addTxt);

      //console.log('tabOther1_content', rowindex);

      //tinyMCE.execCommand('mceFocus', false, 'tabOther1_content' + rowindex); // focus on the last editor
      tinyEpaper('#tabOther1_content' + rowindex);
    }

  });

  $('.addTageOther2').on('click', function(){
    var rowindex = (($('#addAreaOther2 tr').length)/3)+1;
    //var rowindex = $("#addAreaOther2").closest('tr').index();
    // console.debug('rowindex', rowindex);
    console.log('rowindex', rowindex);
    console.log("tabOther2_title = "+ $("#tabOther2_title"+(rowindex-1)).val());
    console.log("tabOther2_content = "+ $("#tabOther2_content"+(rowindex-1)).val());

    if(( $("#tabOther2_title"+(rowindex-1)).val()=="" ) || ( $("#tabOther2_content"+(rowindex-1)).val()=="" )){
      alert("尚有標題或內容未填寫!!");
    }else{
       var addTxt = '<tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">寬圖片版型區塊-標題'+rowindex+'</td><td><input name="tabOther2_title[]" type="text" class="table_data" id="tabOther2_title'+rowindex+'" value="" size="70" /></td><td width="250" bgcolor="#e5ecf6">&nbsp;</td></tr><tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">寬圖片版型區塊-內容'+rowindex+'</td><td><textarea name="tabOther2_content[]" cols="100" rows="20" class="table_data tiny" id="tabOther2_content'+rowindex+'"></textarea></td><td width="250" bgcolor="#e5ecf6"><span class="note_letter">*小斷行請按Shift+Enter。</span></td></tr><tr><td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳寬圖片'+rowindex+'</p></td><td><span class="table_data">選擇圖片：</span><input name="image[]" type="file" class="table_data" id="image'+rowindex+'" /><br><span class="table_data">圖片說明：</span><input name="image_title[]" type="text" class="table_data" id="image_title'+rowindex+'"></td><td bgcolor="#e5ecf6" class="table_col_title"><p class="red_letter">*'+'<?php echo $imagesSize["epaperLong1"]["note"];?>'+'</p></td></tr>';

      $('#addAreaOther2').append(addTxt);

      //console.log('tabOther2_content', rowindex);

      //tinyMCE.execCommand('mceFocus', false, 'tabOther2_content' + rowindex); // focus on the last editor
      tinyEpaper('#tabOther2_content' + rowindex);
    }

  });

  $('.addTageOther3').on('click', function(){
    var rowindex = (($('#addAreaOther3 tr').length)/3)+1;
    //var rowindex = $("#addAreaOther3").closest('tr').index();
    // console.debug('rowindex', rowindex);
    console.log('rowindex', rowindex);
    console.log("tabOther3_title = "+ $("#tabOther3_title"+(rowindex-1)).val());
    console.log("tabOther3_content = "+ $("#tabOther3_content"+(rowindex-1)).val());

    if(( $("#tabOther3_title"+(rowindex-1)).val()=="" ) || ( $("#tabOther3_content"+(rowindex-1)).val()=="" )){
      alert("尚有標題或內容未填寫!!");
    }else{
       var addTxt = '<tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">綜合圖片版型-寬圖片區塊-標題'+rowindex+'</td><td><input name="tabOther3_title[]" type="text" class="table_data" id="tabOther3_title'+rowindex+'" value="" size="70" /></td><td width="250" bgcolor="#e5ecf6">&nbsp;</td></tr><tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">綜合圖片版型-寬圖片區塊-內容'+rowindex+'</td><td><textarea name="tabOther3_content[]" cols="100" rows="20" class="table_data tiny" id="tabOther3_content'+rowindex+'"></textarea></td><td width="250" bgcolor="#e5ecf6"><span class="note_letter">*小斷行請按Shift+Enter。</span></td></tr><tr><td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳寬圖片'+rowindex+'</p></td><td><span class="table_data">選擇圖片：</span><input name="image[]" type="file" class="table_data" id="image'+rowindex+'" /><br><span class="table_data">圖片說明：</span><input name="image_title[]" type="text" class="table_data" id="image_title'+rowindex+'"></td><td bgcolor="#e5ecf6" class="table_col_title"><p class="red_letter">*'+'<?php echo $imagesSize["epaperLong1"]["note"];?>'+'</p></td></tr>';

      $('#addAreaOther3').append(addTxt);

      //console.log('tabOther3_content', rowindex);

      //tinyMCE.execCommand('mceFocus', false, 'tabOther3_content' + rowindex); // focus on the last editor
      tinyEpaper('#tabOther3_content' + rowindex);
    }

    /*$("#tabOther1_content"+rowindex).load(function(){
      initTinyMce();
    });*/
  });

  $('.addTageOther4').on('click', function(){
    var rowindex = (($('#addAreaOther4 tr').length)/3)+1;
    //var rowindex = $("#addAreaOther4").closest('tr').index();
    // console.debug('rowindex', rowindex);
    console.log('rowindex', rowindex);
    console.log("tabOther4_title = "+ $("#tabOther4_title"+(rowindex-1)).val());
    console.log("tabOther4_content = "+ $("#tabOther4_content"+(rowindex-1)).val());

    if(( $("#tabOther4_title"+(rowindex-1)).val()=="" ) || ( $("#tabOther4_content"+(rowindex-1)).val()=="" )){
      alert("尚有標題或內容未填寫!!");
    }else{
       var addTxt = '<tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">綜合圖片版型-窄圖片區塊-標題'+rowindex+'</td><td><input name="tabOther4_title[]" type="text" class="table_data" id="tabOther4_title'+rowindex+'" value="" size="70" /></td><td width="250" bgcolor="#e5ecf6">&nbsp;</td></tr><tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">綜合圖片版型-窄圖片區塊-內容'+rowindex+'</td><td><textarea name="tabOther4_content[]" cols="100" rows="20" class="table_data tiny" id="tabOther4_content'+rowindex+'"></textarea></td><td width="250" bgcolor="#e5ecf6"><span class="note_letter">*小斷行請按Shift+Enter。</span></td></tr><tr><td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳窄圖片'+rowindex+'</p></td><td><span class="table_data">選擇圖片：</span><input name="image[]" type="file" class="table_data" id="image'+rowindex+'" /><br><span class="table_data">圖片說明：</span><input name="image_title[]" type="text" class="table_data" id="image_title'+rowindex+'"></td><td bgcolor="#e5ecf6" class="table_col_title"><p class="red_letter">*'+'<?php echo $imagesSize["epaperShort1"]["note"];?>'+'</p></td></tr>';

      $('#addAreaOther4').append(addTxt);

      //console.log('tabOther4_content', rowindex);

      //tinyMCE.execCommand('mceFocus', false, 'tabOther4_content' + rowindex); // focus on the last editor
      tinyEpaper('#tabOther4_content' + rowindex);
    }

    /*$("#tabOther1_content"+rowindex).load(function(){
      initTinyMce();
    });*/
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

  $d_class1  = "epaper";
  
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
	
	/*//----------插入圖片資料到資料庫begin(須放入插入主資料後)----------
   			//echo image_process();
	
			$sql_max_data= "Select MAX(e_id) From epaper_set";//找到d_id的最大值,放入圖片資料內
			//echo $sql_max_data;
			$result_max_data=mysql_query($sql_max_data);
			
			if($row_max_data = mysql_fetch_array($result_max_data))
			{	
			
				$new_data_num=$row_max_data[0];
		
				//echo $row_max_data[0];
			}
			
	$image_result=image_process("epaper","add", "0", "0");
	
		//echo count($image_result);
		//echo $image_result[0][0];
		
		
		for($j=1;$j<count($image_result);$j++)
		{
			  $insertSQL = sprintf("INSERT INTO file_set (file_name, file_link1, file_link2, file_title, file_type, file_d_id) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($image_result[$j][0], "text"),
                       GetSQLValueString($image_result[$j][1], "text"),
                       GetSQLValueString($image_result[$j][2], "text"),
                       GetSQLValueString($image_result[$j][3], "text"),
                       GetSQLValueString("image", "text"),
                       GetSQLValueString($new_data_num, "int"));

  			  mysql_select_db($database_connect2data, $connect2data);
  			  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
			  $_SESSION["change_image"]=1;
		}*/
		
	
	
	//----------插入圖片資料到資料庫end----------


  mysql_select_db($database_connect2data, $connect2data);
  $query_RecEpaper = "SELECT * FROM epaper_set WHERE e_class1='epaper'";
  $RecEpaper = mysql_query($query_RecEpaper, $connect2data) or die(mysql_error());
  $totalRows = mysql_num_rows($RecEpaper);

  $_SESSION['totalRows'] = $totalRows;
  
  $insertGoTo = "epaper_list.php?pageNum_RecEpaper=0&totalRows_RecEpaper=".$_SESSION['totalRows']."&changeSort=1&now_d_id=".$new_data_num."&change_num=1";

  //$insertGoTo = "epaper_list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>