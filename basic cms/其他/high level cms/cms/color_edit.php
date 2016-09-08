<?php require_once('../sstart.php'); ?>
<?php require_once('../Connections/connect2data.php'); ?>
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

if(!in_array(5,$_SESSION['MM_Limit']['a2'])){
	header("Location: color_list.php");
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$colname_RecColor = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecColor = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecColor = sprintf("SELECT * FROM data_set WHERE d_id = %s", GetSQLValueString($colname_RecColor, "int"));
$RecColor = mysql_query($query_RecColor, $connect2data) or die(mysql_error());
$row_RecColor = mysql_fetch_assoc($RecColor);
$totalRows = mysql_num_rows($RecColor);

if($totalRows==0){
  header("Location: color_list.php");
}

$menu_is="banners";

//記錄帶資料去別地方的資訊
$_SESSION['nowPage']= $selfPage;
$_SESSION['nowMenu']= 'color';

$ifFile = 0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php require_once('cmsTitle.php'); ?></title>
<?php require_once('script.php'); ?>
<!-- InstanceBeginEditable name="doctitle" -->


<!-- <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
<link href="../js/colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">

<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/colorpicker/dist/js/bootstrap-colorpicker.js"></script> -->

<script src="../js/spectrum/spectrum.js"></script>
<link href="../js/spectrum/spectrum.css" rel="stylesheet">
<!-- <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
<script src="../js/Iris/dist/iris.min.js"></script> -->


<title>無標題文件</title>

<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
<?php require_once('head.php');?>
<?php require_once('web_count.php');?>
<style type="text/css">
  .iris-picker{
    position: absolute;
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
            <td width="30%" class="list_title">修改文字顏色</td>
            <td width="70%">&nbsp;
            </td>
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
            <table width="100%" border="0" cellspacing="3" cellpadding="5">
            

            	<tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">標題</td>
          	    	<td><input name="d_title" type="text" class="table_data" id="d_title" value="<?php echo $row_RecColor['d_title']; ?>" size="50" />
          	    	  <input name="d_id" type="hidden" id="d_id" value="<?php echo $row_RecColor['d_id']; ?>" /></td>
        	    	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	    	</tr>

            	<tr>
            	  <td align="center" bgcolor="#e5ecf6" class="table_col_title">獎項說明</td>
            	  <td>


                  <input name="d_content" type="text" class="table_data" id="d_content" value="<?php echo $row_RecColor['d_content']; ?>" size="50" />
                </td>
            	  <td bgcolor="#e5ecf6"><span class="note_letter"></span></td>
          	  </tr>

              
			</table>
            </td>
		</tr>
        <tr>
        	<td>&nbsp;</td>
        </tr>
         <tr>
         	<td align="center">


          


          <input name="submitBtn" type="submit" class="btnType" id="submitBtn" value="送出" />
              <!--<input name="saveBtn" type="submit" class="btnType" id="saveBtn" value="儲存" />--></td>
         </tr>
	</table>
    <input type="hidden" name="MM_update" value="form1" />
    <input name="MM_updateType" type="hidden" id="MM_updateType" value="" />
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
  $(function() {
        /*$('#d_content').colorpicker();
        $('#cp2').colorpicker();*/


       /* $('#d_content').iris({
          hide: false

        });*/

        $("#d_content").spectrum({
          color: "<?php echo $row_RecColor['d_content']; ?>",
          showInput: true,
          className: "full-spectrum",
          showInitial: true,
          showPalette: true,
          showSelectionPalette: true,
          maxSelectionSize: 10,
          preferredFormat: "hex",
          localStorageKey: "spectrum.demo",
          move: function (color) {
              
          },
          show: function () {
          
          },
          beforeShow: function () {
          
          },
          hide: function () {
          
          },
          change: function() {
              
          },
          palette: [
              ["rgb(0, 0, 0)", "rgb(67, 67, 67)", "rgb(102, 102, 102)",
              "rgb(204, 204, 204)", "rgb(217, 217, 217)","rgb(255, 255, 255)"],
              ["rgb(152, 0, 0)", "rgb(255, 0, 0)", "rgb(255, 153, 0)", "rgb(255, 255, 0)", "rgb(0, 255, 0)",
              "rgb(0, 255, 255)", "rgb(74, 134, 232)", "rgb(0, 0, 255)", "rgb(153, 0, 255)", "rgb(255, 0, 255)"], 
              ["rgb(230, 184, 175)", "rgb(244, 204, 204)", "rgb(252, 229, 205)", "rgb(255, 242, 204)", "rgb(217, 234, 211)", 
              "rgb(208, 224, 227)", "rgb(201, 218, 248)", "rgb(207, 226, 243)", "rgb(217, 210, 233)", "rgb(234, 209, 220)", 
              "rgb(221, 126, 107)", "rgb(234, 153, 153)", "rgb(249, 203, 156)", "rgb(255, 229, 153)", "rgb(182, 215, 168)", 
              "rgb(162, 196, 201)", "rgb(164, 194, 244)", "rgb(159, 197, 232)", "rgb(180, 167, 214)", "rgb(213, 166, 189)", 
              "rgb(204, 65, 37)", "rgb(224, 102, 102)", "rgb(246, 178, 107)", "rgb(255, 217, 102)", "rgb(147, 196, 125)", 
              "rgb(118, 165, 175)", "rgb(109, 158, 235)", "rgb(111, 168, 220)", "rgb(142, 124, 195)", "rgb(194, 123, 160)",
              "rgb(166, 28, 0)", "rgb(204, 0, 0)", "rgb(230, 145, 56)", "rgb(241, 194, 50)", "rgb(106, 168, 79)",
              "rgb(69, 129, 142)", "rgb(60, 120, 216)", "rgb(61, 133, 198)", "rgb(103, 78, 167)", "rgb(166, 77, 121)",
              "rgb(91, 15, 0)", "rgb(102, 0, 0)", "rgb(120, 63, 4)", "rgb(127, 96, 0)", "rgb(39, 78, 19)", 
              "rgb(12, 52, 61)", "rgb(28, 69, 135)", "rgb(7, 55, 99)", "rgb(32, 18, 77)", "rgb(76, 17, 48)"]
          ]
      });
  });
</script>
</body>
<!-- InstanceEnd --></html>

<?php
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {


  $d_title = checkV('d_title');
  $d_content = checkV('d_content');
  $d_id  = checkV('d_id');


  $updateSQL = sprintf("UPDATE data_set SET d_title=%s, d_content=%s WHERE d_id=%s",
                       GetSQLValueString($d_title, "text"),
                       GetSQLValueString($d_content, "text"),
                       GetSQLValueString($d_id, "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());

   
  $updateGoTo = "color_list.php";
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING']."&pageNum=".$_SESSION["ToPage"];
  }*/

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