<?php require_once('../sstart.php'); ?>
<?php require_once('../Connections/connect2data.php'); ?>
<?php require_once('photo_process_media_multi.php'); ?>
<?php require_once('imagesSize.php'); ?>
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


if(isset($_POST["type"]) && $_POST["type"]=="mediaPhoto"){

    $fileType   = "file_type='photoImage' AND";
    $not     = $imagesSize[$_POST["type"]]['note'];
    $IWidth   = $imagesSize[$_POST["type"]]['IW'];
    $IHeight  = $imagesSize[$_POST["type"]]['IH'];

}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  /*echo "MM_update";

  if (!function_exists("photo_process")) {
    echo "沒有";
  }else{
    echo "有";
  }*/

  if(isset($_POST["dataId"]) && $_POST["dataId"]!=""){
    $image_result=photo_process($_FILES['file'], "", "", "mediaPhoto","add", $IWidth, $IHeight, $_POST["dataId"], $database_connect2data, $connect2data); 
  }
  

  

}
?>