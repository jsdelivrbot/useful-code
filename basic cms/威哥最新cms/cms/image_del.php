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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$fileType = "file_type='image' AND";

/*if (isset($_REQUEST['type']) && ($_REQUEST['type']=="personal")){
	$fileType = "file_type='imageP' AND";
}*/
if($_SESSION['nowMenu']=='award'){
  
	$fileType = "file_type='imageT' AND";

}elseif($_SESSION['nowMenu']=='author'){ 
  
  $fileType = "file_type='imageAuthor' AND";

}elseif($_SESSION['nowMenu']=='events'){
  
  if(isset($_GET["type"]) && $_GET["type"]=="Poster"){

    $fileType = "file_type='imagePoster' AND";

  }elseif(isset($_GET["type"]) && $_GET["type"]=="PosterMobile"){

    $fileType = "file_type='imagePosterMobile' AND";

  }
  
}elseif($_SESSION['nowMenu']=='media'){
  if(isset($_GET["type"]) && $_GET["type"]=="mediaVideo"){

    $fileType = "file_type='videoImage' AND";

  }elseif(isset($_GET["type"]) && $_GET["type"]=="mediaPhoto"){

    $fileType = "file_type='photoImage' AND";

  }
	
}elseif(isset($_GET["type"]) && $_GET["type"]=="Cover"){ 
  
  $fileType = "file_type='imageCover' AND";

}elseif(isset($_GET["type"]) && $_GET["type"]=="Mobile"){ 
  
  $fileType = "file_type='imageMobile' AND";

}elseif(isset($_GET["type"]) && $_GET["type"]=="imageShort"){ 

  $fileType = "file_type='imageShort' AND";

}elseif(isset($_GET["type"]) && $_GET["type"]=="imageLong"){ 

  $fileType = "file_type='imageLong' AND";

}else{
	$fileType = "file_type='image' AND";
}
//$fileType = "file_type='image' AND";

$colname_RecImage = "-1";
if (isset($_GET['file_id'])) {
  $colname_RecImage = $_GET['file_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecImage = sprintf("SELECT * FROM file_set WHERE ".$fileType." file_id = %s", GetSQLValueString($colname_RecImage, "int"));
$RecImage = mysql_query($query_RecImage, $connect2data) or die(mysql_error());
$row_RecImage = mysql_fetch_assoc($RecImage);
$totalRows_RecImage = mysql_num_rows($RecImage);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>刪除圖片</title>
<!--<script type="text/javascript" src="jquery/jquery-1.6.4.min.js"></script>-->
<script type="text/javascript">

$(document).ready(function() {
	
	$(".btnType").hover(function(){
		$(this).addClass('btnTypeClass');
		$(this).css('cursor', 'pointer');
	}, function(){
		$(this).removeClass('btnTypeClass');
	});
	
});

</script>
</head>

<body>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="18%" class="list_title">刪除圖片</td>
            <td width="82%"><span class="no_data">您確定要刪除此筆圖片?</span></td>
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
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">
                    <?php echo (isset($_GET["type"]) && $_GET["type"]=="mediaPhoto")?"圖片標題":"圖片說明";?>
                  </td>
          	    	<td width="532" class="table_data"><?php echo $row_RecImage['file_title']; ?></td>
          	    	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	    	</tr>

              

              <?php if(isset($_GET["type"]) && $_GET["type"]=="mediaPhoto"){ ?>

              <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">圖片說明</td>
                  <td width="532">

                  <?php echo nl2br($row_RecImage['file_content']); ?>

                   </td>
                <td width="250" bgcolor="#e5ecf6"></td>
              </tr>

              <?php } ?>

     	      	<tr>
                	<td align="center" bgcolor="#e5ecf6" class="table_col_title">目前圖片</td>
                	<td><img src="../<?php echo $row_RecImage['file_link2'].'?'.(mt_rand(1,100000)/100000); ?>" alt="" class="image_frame" width="100" /></td>
                	<td bgcolor="#e5ecf6" class="table_col_title"><p>&nbsp;</p></td>
      		    </tr>
			</table>
            </td>
		</tr>
        <tr>
        	<td>&nbsp;</td>
        </tr>
         <tr>
         	<td align="center"><input name="file_id" type="hidden" id="file_id" value="<?php echo $row_RecImage['file_id']; ?>" />
         	<input name="delsure" type="hidden" id="delsure" value="1" />
         	<input name="submitBtn" type="submit" class="btnType" id="submitBtn" value="送出" /></td>
         </tr>
	</table>
    </form>
    <table width="100%" height="1" border="0" align="center" cellpadding="0" cellspacing="0" class="buttom_dot_line">
        <tr>
            <td>&nbsp;</td>
        </tr>
    </table>
	
</body>
</html>
<?php

if ((isset($_POST['file_id'])) && ($_POST['file_id'] != "") && (isset($_POST['delsure']))) {

		//刪除圖片真實檔案begin----

  $sql="SELECT file_link1, file_link2, file_link3, file_link4, file_link5, file_link6 FROM file_set WHERE ".$fileType." file_id='".$_POST['file_id']."'";

    $result = mysql_query($sql)or die("無法送出".mysql_error( ));
    while ( $row = mysql_fetch_assoc($result))
    {
      foreach ($row as $key => $value) {
        if ( (isset($value)) && file_exists("../".$value) ) {
          //echo "$value<br />\n";
          unlink("../".$value);//刪除檔案
        }
      }
    }
		
	/*$sql="SELECT file_link1 FROM file_set WHERE ".$fileType	." file_id='".$_POST['file_id']."'";
	//echo $sql.'<br>';
	$result = mysql_query($sql)or die("無法送出".mysql_error( ));
	while ( $row = mysql_fetch_array($result))
	{
		//echo $row[0]."<BR>";
		if ( (isset($row[0])) && file_exists("../".$row[0]) ) {
			unlink("../".$row[0]);//刪除檔案
		}
	}
	
	$sql="SELECT file_link2 FROM file_set WHERE ".$fileType." file_id='".$_POST['file_id']."'";
	//echo $sql.'<br>';
	$result = mysql_query($sql)or die("無法送出".mysql_error( ));
	while ( $row = mysql_fetch_array($result))
	{
		//echo $row[0]."<BR>";
		if ( (isset($row[0])) && file_exists("../".$row[0]) ) {
			unlink("../".$row[0]);//刪除檔案
		}
	}
	
	$sql="SELECT file_link3 FROM file_set WHERE ".$fileType." file_id='".$_POST['file_id']."'";
	//echo $sql.'<br>';
	$result = mysql_query($sql)or die("無法送出".mysql_error( ));
	while ( $row = mysql_fetch_array($result))
	{
		//echo $row[0]."<BR>";
		if ( (isset($row[0])) && file_exists("../".$row[0]) ) {
			unlink("../".$row[0]);//刪除檔案
		}
	}*/
		 
		//刪除圖片真實檔案end----

  
  $deleteSQL = sprintf("DELETE FROM file_set WHERE ".$fileType." file_id=%s",
                       GetSQLValueString($_POST['file_id'], "int"));					   
  

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());

  /*if($_SESSION['nowMenu']=='brands'){
		$deleteGoTo = $_SESSION['nowPage']."?c_id=" . $row_RecImage['file_d_id'] . "";
	}elseif($_SESSION['nowMenu']=='brandSeries'){
		$deleteGoTo = $_SESSION['nowPage']."?c_id=" . $row_RecImage['file_d_id'] . "";
	}else{
		$deleteGoTo = $_SESSION['nowPage']."?d_id=" . $row_RecImage['file_d_id'] . "";
	}*/
	
	if($_SESSION['nowMenu']=="award"){
		$deleteGoTo = $_SESSION['nowPage']."?term_id=" . $row_RecImage['file_d_id'] . "";
	}else{
		$deleteGoTo = $_SESSION['nowPage']."?d_id=" . $row_RecImage['file_d_id'] . "";
	}
	
  
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }*/
 header(sprintf("Location: %s", $deleteGoTo));
}
?>
<?php
mysql_free_result($RecImage);
?>
