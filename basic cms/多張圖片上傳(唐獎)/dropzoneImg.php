<?php require_once('../sstart.php'); ?>
<?php require_once('../Connections/connect2data.php'); ?>
<?php require_once('imagesSize.php'); ?>
<?php 

if($_SESSION['nowMenu']=="media"){

	if(isset($_GET["type"]) && $_GET["type"]=="mediaVideo"){

		$fileType 	= "file_type='videoImage' AND";
		$not		 = $imagesSize[$_GET["type"]]['note'];
		$IWidth		= $imagesSize[$_GET["type"]]['IW'];
		$IHeight	= $imagesSize[$_GET["type"]]['IH'];

	}elseif(isset($_GET["type"]) && $_GET["type"]=="mediaPhoto"){

		$fileType 	= "file_type='photoImage' AND";
		$not		 = $imagesSize[$_GET["type"]]['note'];
		$IWidth		= $imagesSize[$_GET["type"]]['IW'];
		$IHeight	= $imagesSize[$_GET["type"]]['IH'];

	}

}

?>
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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改圖片</title>
<script type="text/javascript" src="../js/jquery-1.11.1.min.js"></script>

<link rel="stylesheet" href="../filemanager/css/dropzone.min.css">
<script type="text/javascript" src="../filemanager/js/dropzone.min.js"></script>


<style type="text/css">
  .dropzone .dz-default.dz-message, .dropzone .dz-preview .dz-error-mark, .dropzone-previews .dz-preview .dz-error-mark, .dropzone .dz-preview .dz-success-mark, .dropzone-previews .dz-preview .dz-success-mark, .dropzone .dz-preview .dz-progress .dz-upload, .dropzone-previews .dz-preview .dz-progress .dz-upload{
        background-image: url('../filemanager/img/spritemap_en_EN.png');
  }

  .dropzone{
    min-height: 510px;
  }
  .btnType {
    width: 76px;
    height: 28px;
    border: 1px solid #cdcdcd;
    background-color: #FFFFFF;
    margin: 0 10px 0 0;
    padding: 0;
    font-size: 12px;
    color: #444;
    display: inline-block;
    line-height: 28px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}

a.btnType{
  color: #000000;
  text-decoration: none;
}
.btnTypeClass{
  border:1px solid #bfbfbf;
  background-color:#bfbfbf;
}

</style>
<script type="text/javascript">

$(document).ready(function() {

  var dataId = window.parent.$('#d_id').val();

  console.log( dataId );

  $("#dataId").val(dataId);

  console.log($("#dataId").val());
  
  $(".btnType").hover(function(){
    $(this).addClass('btnTypeClass');
    $(this).css('cursor', 'pointer');
  }, function(){
    $(this).removeClass('btnTypeClass');
  });


  /*$("#cancelBtn").on("click", function(){
    window.parent.$.fancybox.close();
  });*/

  $("#closeBtn").on("click", function(){
    window.parent.$.fancybox.close();
  });


  
});

</script>
</head>
<body>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="30%" class="list_title"></td>
            <td width="70%">&nbsp;</td>
        </tr>
	</table>
    <table width="960" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td><img src="image/spacer.gif" width="1" height="1"></td>
        </tr>
    </table>


  <form action="upload.php" class="dropzone">
    
    <div class="dz-default dz-message"><span>Drop files here to upload</span></div>

    <input type="hidden" name="dataId" id="dataId" value="" />
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="type" value="mediaPhoto" />
  </form>

    
    <table width="100%" height="1" border="0" align="center" cellpadding="0" cellspacing="0" class="buttom_dot_line">
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="center">
            <!-- <input name="cancelBtn" type="button" class="btnType" id="cancelBtn" value="取消" /> -->
            <input name="closeBtn" type="button" class="btnType" id="closeBtn" value="完成" />
            </td>
        </tr>
    </table>
</body>
</html>
	