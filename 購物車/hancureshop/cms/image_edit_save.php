<?php require_once('../sstart.php'); ?>
<?php require_once('../Connections/connect2data.php'); ?>
<?php 
	
switch($_SESSION['nowMenu']){
  case "bannersHome":
  		require_once('photo_process_banners.php');
		$fileType 	= "file_type='image' AND";
  		$not		 = "圖片請上傳寬 946pixel、高 223pixel、解析度 72dpi 之圖檔。";
		$IWidth		= 946;
		$IHeight	= 223;
		break;

 case "news":
 		require_once('photo_process.php');
		$fileType 	= "file_type='image' AND";
  		$not		 = "圖片請上傳寬不大於615 pixel 72dpi之圖檔。圖片最佳寬度為615 pixel 。";
		$IWidth		= 615;
		$IHeight	= 800;
		break;

 case "brands":
 		require_once('photo_process.php');
		$fileType 	= "file_type='brandImage' AND";
  		$not 		= "圖片請上傳寬與高等於125 pixel 72dpi之正方形圖檔。";
		$IWidth		= 125;
		$IHeight	= 125;
		break;
		
 case "brandSeries":
 		require_once('photo_process.php');
		$fileType 	= "file_type='brandSeries' AND";
  		$not 		= "圖片請上傳寬與高等於125 pixel 72dpi之正方形圖檔。";
		$IWidth		= 63;
		$IHeight	= 63;
		break;

 case "products":
		require_once('photo_process_products.php');
		$fileType 	= "file_type='image' AND";
  		$not 		= "圖片請上傳寬不大於615 pixel 72dpi 之圖檔。圖片最佳寬度為603 pixel 。";
		$IWidth		= 615;
		$IHeight	= 800;
		break;
		
 case "newProducts":
		require_once('photo_process_newProducts.php');
		$fileType 	= "file_type='image' AND";
  		$not 		= "圖片請上傳寬等於212 pixel、高等於285 pixel、解析度 72dpi 之圖檔。";
		$IWidth		= 212;
		$IHeight	= 285;
		break;
		
 case "cabinets":
		require_once('photo_process_newProducts.php');
		$fileType 	= "file_type='image' AND";
  		$not 		= "圖片請上傳寬等於212 pixel、高等於285 pixel、解析度 72dpi 之圖檔。";
		$IWidth		= 212;
		$IHeight	= 285;
		break;
		
 case "dm":
 		require_once('photo_process_dm.php');
		$fileType 	= "file_type='image' AND";
  		$not 		= "圖片請上傳寬不大於2000 pixel、高不大於2600 pixel、解析度 72dpi 之圖檔。<br />
                   	    每次上傳之檔案大小總計請勿超過".ini_get("upload_max_filesize")."。";
		$IWidth		= 2000;
		$IHeight	= 2600;
		break;

 default:
  		require_once('photo_process.php');
		$fileType 	= "file_type='image' AND";
  		$not 		= "圖片請上傳寬不大於615 pixel 72dpi之圖檔。圖片最佳寬度為615 pixel 。";
		$IWidth		= 615;
		$IHeight	= 800;
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

//echo $_SESSION['nowMenu'].'<br>';
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "formImg")) {
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

  if($_SESSION['nowMenu']=='brands'){
	  
		$updateGoTo = $_SESSION['nowPage']."?c_id=" . $_POST['file_d_id'] . "";
		
	}elseif($_SESSION['nowMenu']=='brandSeries'){
		
		$updateGoTo = $_SESSION['nowPage']."?c_id=" . $_POST['file_d_id'] . "";
		
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
  		//header(sprintf("Location: %s", $updateGoTo));
  }
  
}


?>