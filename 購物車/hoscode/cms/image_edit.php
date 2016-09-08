<?php require_once('../sstart.php'); ?>
<?php require_once('../Connections/connect2data.php'); ?>
<?php require_once('imagesSize.php'); ?>
<?php 
	
switch($_SESSION['nowMenu']){
  case "banners":		
  case "about":		
  case "contact":
  		require_once('photo_process_banners.php');
		$fileType 	= "file_type='image' AND";
		$not		= $imagesSize[$_SESSION['nowMenu']]['note'];
		$IWidth		= $imagesSize[$_SESSION['nowMenu']]['IW'];
		$IHeight	= $imagesSize[$_SESSION['nowMenu']]['IH'];
		break;

 case "news":
 		require_once('photo_process_banners.php');
		$fileType 	= "file_type='image' AND";
		$not		 = $imagesSize[$_SESSION['nowMenu']]['note'];
		$IWidth		= $imagesSize[$_SESSION['nowMenu']]['IW'];
		$IHeight	= $imagesSize[$_SESSION['nowMenu']]['IH'];
		break;

 case "report":
 		require_once('photo_process_report.php');
		$fileType 	= "file_type='image' AND";
		$not		 = $imagesSize[$_SESSION['nowMenu']]['note'];
		$IWidth		= $imagesSize[$_SESSION['nowMenu']]['IW'];
		$IHeight	= $imagesSize[$_SESSION['nowMenu']]['IH'];
		break;
		
 case "activity":
 		require_once('photo_process_activity.php');
		$fileType 	= "file_type='image' AND";
		$not		 = $imagesSize[$_SESSION['nowMenu']]['note'];
		$IWidth		= $imagesSize[$_SESSION['nowMenu']]['IW'];
		$IHeight	= $imagesSize[$_SESSION['nowMenu']]['IH'];
		break;

 case "products":
		require_once('photo_process_products.php');
		$fileType 	= "file_type='image' AND";
		$not		= $imagesSize[$_SESSION['nowMenu']]['note'];
		$IWidth		= $imagesSize[$_SESSION['nowMenu']]['IW'];
		$IHeight	= $imagesSize[$_SESSION['nowMenu']]['IH'];
		break;
		
 case "farmer":
		require_once('photo_process_products.php');
		$fileType 	= "file_type='image' AND";
		$not		= $imagesSize[$_SESSION['nowMenu']]['note'];
		$IWidth		= $imagesSize[$_SESSION['nowMenu']]['IW'];
		$IHeight	= $imagesSize[$_SESSION['nowMenu']]['IH'];
		break;

 default:
  		require_once('photo_process.php');
		$fileType 	= "file_type='image' AND";
		$not		= $imagesSize["other"]['note'];
		$IWidth		= $imagesSize["other"]['IW'];
		$IHeight	= $imagesSize["other"]['IH'];
}

if($_SESSION['nowMenu']=="farmer"){
	if (isset($_REQUEST['type']) && ($_REQUEST['type']=="personal")){
		$fileType = "file_type='imageP' AND";
	}
}
//echo $_SESSION['nowMenu'].'<br>';

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

//echo $_SESSION['nowMenu'].'<br>';
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE file_set SET file_title=%s WHERE $fileType file_id=%s",
                       GetSQLValueString($_POST['file_title'], "text"),
                       GetSQLValueString($_POST['file_id'], "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
  
      //----------插入圖片資料到資料庫begin(須放入插入主資料後)----------
   			//echo image_process();
		
		
	//$image_result=image_process("news","edit", "0", "0");
	
	$image_result=image_process($_FILES['image'], $_REQUEST['file_title'], $_SESSION['nowMenu'], "edit", $IWidth, $IHeight);
	//echo 'IWidth = '.$IWidth.'<br>';
	//echo 'IHeight = '.$IHeight.'<br>';
	
		//echo count($image_result);
		//echo $image_result[0][0];
		
		//刪除圖片真實檔案begin----
		if(count($image_result)==2)
		{
			//$sql="SELECT file_link1 FROM file_set WHERE file_id='".$_POST['file_id']."'";			
			$sql="SELECT file_link1 FROM file_set WHERE ".$fileType." file_id='".$_POST['file_id']."'";
			
			$result = mysql_query($sql)or die("無法送出".mysql_error( ));
			while ( $row = mysql_fetch_array($result))
			{
				//echo $image_result[1][1]."<br>";
				//echo $row[0]."<BR>";
				if($image_result[1][1]==$row[0])
				{}
				else
				{
					if ( (isset($row[0])) && file_exists("../".$row[0]) ) {
						unlink("../".$row[0]);//刪除檔案
					}
				}					
			}
					
			//$sql="SELECT file_link2 FROM file_set WHERE file_id='".$_POST['file_id']."'";
			$sql="SELECT file_link2 FROM file_set WHERE ".$fileType." file_id='".$_POST['file_id']."'";
			
			$result = mysql_query($sql)or die("無法送出".mysql_error( ));
			while ( $row = mysql_fetch_array($result))
			{
				//echo $image_result[1][2]."<br>";
				//echo $row[0]."<BR>";
				if($image_result[1][2]==$row[0])
				{}
				else
				{
					if ( (isset($row[0])) && file_exists("../".$row[0]) ) {
						unlink("../".$row[0]);//刪除檔案
					}
				}
			}
					
			//$sql="SELECT file_link2 FROM file_set WHERE file_id='".$_POST['file_id']."'";
			$sql="SELECT file_link3 FROM file_set WHERE ".$fileType." file_id='".$_POST['file_id']."'";
			
			$result = mysql_query($sql)or die("無法送出".mysql_error( ));
			while ( $row = mysql_fetch_array($result))
			{
				//echo $image_result[1][2]."<br>";
				//echo $row[0]."<BR>";
				if($image_result[1][3]==$row[0])
				{}
				else
				{
					if ( (isset($row[0])) && file_exists("../".$row[0]) ) {
						unlink("../".$row[0]);//刪除檔案
					}
				}
			}
		} 
		//刪除圖片真實檔案end----
		
		for($j=1;$j<count($image_result);$j++)
		{
			/*if($_SESSION['nowMenu']=='brands'){
				$fileType = "file_type='brandImage' AND";
			}else{
				$fileType = "file_type='image' AND";
			}*/
			//if($_SESSION['nowMenu']=='products'){
				
				$insertSQL = sprintf("UPDATE file_set SET file_name=%s, file_link1=%s, file_link2=%s, file_link3=%s, file_show_type=%s WHERE $fileType file_id=%s" ,
                       GetSQLValueString($image_result[$j][0], "text"),
                       GetSQLValueString($image_result[$j][1], "text"),
                       GetSQLValueString($image_result[$j][2], "text"),
                       GetSQLValueString($image_result[$j][3], "text"),
                       GetSQLValueString($image_result[$j][5], "text"),
					   GetSQLValueString($_POST['file_id'], "int"));
					   
			/*}else{
				
				$insertSQL = sprintf("UPDATE file_set SET file_name=%s, file_link1=%s, file_link2=%s WHERE $fileType file_id=%s" ,
                       GetSQLValueString($image_result[$j][0], "text"),
                       GetSQLValueString($image_result[$j][1], "text"),
                       GetSQLValueString($image_result[$j][2], "text"),
					   GetSQLValueString($_POST['file_id'], "int"));
					   
			}*/

  			  //echo $insertSQL;
			  mysql_select_db($database_connect2data, $connect2data);
  			  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
			  
			  $_SESSION["change_image"]=1;
		}
	
	//----------插入圖片資料到資料庫end----------

  /*if($_SESSION['nowMenu']=='brands'){
	  
		$updateGoTo = $_SESSION['nowPage']."?c_id=" . $_POST['file_d_id'] . "";
		
	}elseif($_SESSION['nowMenu']=='brandSeries'){
		
		$updateGoTo = $_SESSION['nowPage']."?c_id=" . $_POST['file_d_id'] . "";
		
	}else{
		
		$updateGoTo = $_SESSION['nowPage']."?d_id=" . $_POST['file_d_id'] . "";
		
	}*/
	//$updateGoTo = $_SESSION['nowPage']."?d_id=" . $_POST['file_d_id'] . "";
	if($_SESSION['nowMenu']=="farmer"){
		$updateGoTo = $_SESSION['nowPage']."?m_id=" . $_POST['file_d_id'] . "";
	}else{
		$updateGoTo = $_SESSION['nowPage']."?d_id=" . $_POST['file_d_id'] . "";
	}
  
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  /*echo 'nowMenu = '.$_SESSION['nowMenu'].'<br>';
  echo 'file_d_id = '.$_POST['file_d_id'].'<br>';
  echo 'updateGoTo = '.$updateGoTo.'<br>';
  echo "<script type=\"text/javascript\">call_alert('".$updateGoTo."');</script>";*/
  if($image_result[0][0]==1)
  {
		echo "<script type=\"text/javascript\">call_alert('".$updateGoTo."');</script>";
  }else
  {
  		header(sprintf("Location: %s", $updateGoTo));
  }
  
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$colname_RecImage = "-1";
if (isset($_GET['file_id'])) {
  $colname_RecImage = $_GET['file_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecImage = sprintf("SELECT * FROM file_set WHERE $fileType file_id = %s",
					GetSQLValueString($colname_RecImage, "int"));
$RecImage = mysql_query($query_RecImage, $connect2data) or die(mysql_error());
$row_RecImage = mysql_fetch_assoc($RecImage);
$totalRows_RecImage = mysql_num_rows($RecImage);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改圖片</title>
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
            <td width="30%" class="list_title">修改圖片</td>
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
            <table width="100%" border="0" cellspacing="3" cellpadding="5">
            	<tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">圖片說明</td>
          	    	<td width="532"><input name="file_title" type="text" class="table_data" id="file_title" value="<?php echo $row_RecImage['file_title']; ?>" size="50">
          	    	  <input name="file_id" type="hidden" id="file_id" value="<?php echo $row_RecImage['file_id']; ?>" />
          	    	  <input name="file_d_id" type="hidden" id="file_d_id" value="<?php echo $row_RecImage['file_d_id']; ?>" /></td>
        	    	<td width="250" bgcolor="#e5ecf6"></td>
      	    	</tr>
     	      	<tr>
                	<td align="center" bgcolor="#e5ecf6" class="table_col_title">目前圖片</td>
                	<td><img src="../<?php echo $row_RecImage['file_link2'].'?'.(mt_rand(1,100000)/100000); ?>" alt="" class="image_frame" /></td>
                	<td bgcolor="#e5ecf6" class="table_col_title"><p>&nbsp;</p></td>
      		    </tr>
                <tr>
              		<td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>更改圖片</p>
              	    </td>
              	    <td><input name="image[]" type="file" class="table_data" id="image[]" size="50" ></td>
              	    <td bgcolor="#e5ecf6" class="table_col_title"><p><span class="red_letter">*<?php echo $not; ?>                    
                    </span></p>
           	        </td>
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
    <input type="hidden" name="MM_update" value="form1" />
    </form>
    <table width="100%" height="1" border="0" align="center" cellpadding="0" cellspacing="0" class="buttom_dot_line">
        <tr>
            <td>&nbsp;</td>
        </tr>
    </table>
</body>
</html>
<?php
mysql_free_result($RecImage);
?>
	