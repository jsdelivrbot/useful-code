<?php require_once('../sstart.php'); ?>
<?php require_once('../Connections/connect2data.php'); ?>
<?php require_once('imagesSize.php'); ?>
<?php 
	
switch($_SESSION['nowMenu']){
  case "banners":
  case "indexEnvironment":
  case "branch":
  case "about":
  case "aboutBanner":
  case "founderBanner":
  case "newsBanner":
  case "characteristicBanner":
  case "noticeBanner":
  case "shuttleBanner":
  case "healthBanner":
  case "refundBanner":
  case "shareBanner":
  case "storyBanner":
  case "schoolideaBanner":
  case "schoolawardBanner":
  case "schoolhistoryBanner":
  case "schooleventBanner":
  case "schooleducationBanner":
  case "environment1":
  case "environment2":
  case "environment3":
  case "environment4":
  case "environmentBanner1":
  case "environmentBanner2":
  case "environmentBanner3":
  case "environmentBanner4":
  case "gallery":
  case "galleryBanner":
  		require_once('photo_process_banners.php');
		$fileType 	= "file_type='image' AND";
		$not		= $imagesSize[$_SESSION['nowMenu']]['note'];
		$IWidth		= $imagesSize[$_SESSION['nowMenu']]['IW'];
		$IHeight	= $imagesSize[$_SESSION['nowMenu']]['IH'];
		break;

  case "origin":
  case "nomination":
  case "design":
  case "publications":
  case "founder";
  case "news";
  case "share";
  		require_once('photo_process_about.php');
		$fileType 	= "file_type='image' AND";
		$not		= $imagesSize[$_SESSION['nowMenu']]['note'];
		$IWidth		= $imagesSize[$_SESSION['nowMenu']]['IW'];
		$IHeight	= $imagesSize[$_SESSION['nowMenu']]['IH'];
		break;

  case "award":	
  		require_once('photo_process_about.php');
		$fileType 	= "file_type='imageT' AND";
		$not		= $imagesSize[$_SESSION['nowMenu']]['note'];
		$IWidth		= $imagesSize[$_SESSION['nowMenu']]['IW'];
		$IHeight	= $imagesSize[$_SESSION['nowMenu']]['IH'];
		break;

  case "owner":	
  		require_once('photo_process_owner.php');
		$fileType 	= "file_type='image' AND";
		$not		= $imagesSize[$_SESSION['nowMenu']]['note'];
		$IWidth		= $imagesSize[$_SESSION['nowMenu']]['IW'];
		$IHeight	= $imagesSize[$_SESSION['nowMenu']]['IH'];
		break;

  case "week":	
  		require_once('photo_process_week.php');
		$fileType 	= "file_type='image' AND";
		$not		= $imagesSize[$_SESSION['nowMenu']]['note'];
		$IWidth		= $imagesSize[$_SESSION['nowMenu']]['IW'];
		$IHeight	= $imagesSize[$_SESSION['nowMenu']]['IH'];
		break;

 case "event":
 		require_once('photo_process_event.php');
		$fileType 	= "file_type='image' AND";
		$not		 = $imagesSize[$_SESSION['nowMenu']]['note'];
		$IWidth		= $imagesSize[$_SESSION['nowMenu']]['IW'];
		$IHeight	= $imagesSize[$_SESSION['nowMenu']]['IH'];
		break;

 case "media":
 		require_once('photo_process_media.php');
		$fileType 	= "file_type='image' AND";
		$not		 = $imagesSize[$_SESSION['nowMenu']]['note'];
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

if($_SESSION['nowMenu']=="banners" || $_SESSION['nowMenu']=="aboutBanner" || $_SESSION['nowMenu']=="founderBanner" || $_SESSION['nowMenu']=="newsBanner"){

  if(isset($_GET["type"]) && $_GET["type"]=="imageTxt"){
    $fileType   = "file_type='imageTxt' AND";
    $not    = $imagesSize[$_SESSION['nowMenu'].'Txt']['note'];
    $IWidth   = $imagesSize[$_SESSION['nowMenu'].'Txt']['IW'];
    $IHeight  = $imagesSize[$_SESSION['nowMenu'].'Txt']['IH'];
  }

}

//可選圖片樣式
if($_SESSION['nowMenu']=="environment1" || $_SESSION['nowMenu']=="environment2" || $_SESSION['nowMenu']=="environment3" || $_SESSION['nowMenu']=="environment4"){

  if(isset($_GET["type"]) && $_GET["type"]=="imageCoverFormat"){
    $fileType   = "file_type='imageCover' AND";
    /*$not    = $imagesSize[$_SESSION['nowMenu'].'Txt']['note'];
    $IWidth   = $imagesSize[$_SESSION['nowMenu'].'Txt']['IW'];
    $IHeight  = $imagesSize[$_SESSION['nowMenu'].'Txt']['IH'];*/
  }

}
//可選圖片樣式
if($_SESSION['nowMenu']=="gallery"){

  if(isset($_GET["type"]) && $_GET["type"]=="imageCoverFormat"){
    $fileType   = "file_type='imageCover' AND";
    /*$not    = $imagesSize[$_SESSION['nowMenu'].'Txt']['note'];
    $IWidth   = $imagesSize[$_SESSION['nowMenu'].'Txt']['IW'];
    $IHeight  = $imagesSize[$_SESSION['nowMenu'].'Txt']['IH'];*/
  }

}


if($_SESSION['nowMenu']=="founder"){

  if(isset($_GET["type"]) && $_GET["type"]=="imageSlider"){
    $fileType   = "file_type='imageSlider' AND";
    $not    = $imagesSize[$_SESSION['nowMenu'].'Slider']['note'];
    $IWidth   = $imagesSize[$_SESSION['nowMenu'].'Slider']['IW'];
    $IHeight  = $imagesSize[$_SESSION['nowMenu'].'Slider']['IH'];
  }

}

if(($_SESSION['nowMenu']=="founder") || ($_SESSION['nowMenu']=="news") || ($_SESSION['nowMenu']=="share")){

  if(isset($_GET["type"]) && $_GET["type"]=="imageCover"){
    $fileType   = "file_type='imageCover' AND";
    $not    = $imagesSize[$_SESSION['nowMenu'].'Cover']['note'];
    $IWidth   = $imagesSize[$_SESSION['nowMenu'].'Cover']['IW'];
    $IHeight  = $imagesSize[$_SESSION['nowMenu'].'Cover']['IH'];
  }

}/*elseif($_SESSION['nowMenu']=="share"){

  if(isset($_GET["type"]) && $_GET["type"]=="imageCover"){
    $fileType   = "file_type='imageCover' AND";
    $not    = $imagesSize[$_SESSION['nowMenu'].'Cover']['note'];
    $IWidth   = $imagesSize[$_SESSION['nowMenu'].'Cover']['IW'];
    $IHeight  = $imagesSize[$_SESSION['nowMenu'].'Cover']['IH'];
  }

}*/

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
  $updateSQL = sprintf("UPDATE file_set SET file_title=%s, file_content=%s WHERE $fileType file_id=%s",
                       GetSQLValueString($_POST['file_title'], "text"),
                       GetSQLValueString($_POST['file_content'], "text"),
                       GetSQLValueString($_POST['file_id'], "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
  
      //----------插入圖片資料到資料庫begin(須放入插入主資料後)----------
   			//echo image_process();
		
		
	//$image_result=image_process("news","edit", "0", "0");
	
  	if(isset($_GET["type"]) && $_GET["type"]=="mediaPhoto"){

  		$image_result=photo_process($_FILES['image'], $_REQUEST['file_title'], $_REQUEST['file_content'], "mediaPhoto","edit", $IWidth, $IHeight);

  	}elseif(isset($_GET["type"]) && $_GET["type"]=="mediaVideo"){ 

      $image_result=image_process($_FILES['image'], $_REQUEST['file_title'], "mediaVideo", "edit", $IWidth, $IHeight);

    }elseif(isset($_GET["type"]) && $_GET["type"]=="imageTxt"){ 

      $image_result=image_process($_FILES['image'], $_REQUEST['file_title'], $_SESSION['nowMenu']."Txt", "edit", $IWidth, $IHeight);

    }elseif(isset($_GET["type"]) && $_GET["type"]=="imageCover"){ 

      $image_result=bannerImage_process($_FILES['image'], $_REQUEST['file_title'], $_SESSION['nowMenu']."Cover", "edit", $IWidth, $IHeight);

    }elseif(isset($_GET["type"]) && $_GET["type"]=="imageCoverFormat"){ 

      $d_price1   = checkV('d_price1');

      $IWidth   = $imagesSize[$_SESSION['nowMenu'].'Cover_'.$d_price1]['IW'];
      $IHeight  = $imagesSize[$_SESSION['nowMenu'].'Cover_'.$d_price1]['IH'];

      $image_result=image_process($_FILES['image'], $_REQUEST['file_title'], $_SESSION['nowMenu']."Cover", "edit", $IWidth, $IHeight);

    }elseif(isset($_GET["type"]) && $_GET["type"]=="imageSlider"){ 

      $image_result=bannerImage_process($_FILES['image'], $_REQUEST['file_title'], $_SESSION['nowMenu']."Slider", "edit", $IWidth, $IHeight);

    }else{

  		$image_result=image_process($_FILES['image'], $_REQUEST['file_title'], $_SESSION['nowMenu'], "edit", $IWidth, $IHeight);

  	}

	
	//echo 'IWidth = '.$IWidth.'<br>';
	//echo 'IHeight = '.$IHeight.'<br>';
	
		//echo count($image_result);
		//echo $image_result[0][0];
		
		//刪除圖片真實檔案begin----
		if(count($image_result)==2)
		{

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

      if(isset($_GET["type"]) && $_GET["type"]=="imageCoverFormat"){

          $insertSQL = sprintf("UPDATE file_set SET file_name=%s, file_link1=%s, file_link2=%s, file_link3=%s, file_link4=%s, file_link5=%s, file_link6=%s, file_show_type=%s WHERE $fileType file_id=%s" ,
                       GetSQLValueString($image_result[$j][0], "text"),
                       GetSQLValueString($image_result[$j][1], "text"),
                       GetSQLValueString($image_result[$j][2], "text"),
                       GetSQLValueString($image_result[$j][3], "text"),
                       GetSQLValueString($image_result[$j][6], "text"),
                       GetSQLValueString($image_result[$j][7], "text"),
                       GetSQLValueString($image_result[$j][8], "text"),
                       GetSQLValueString($d_price1, "int"),
             GetSQLValueString($_POST['file_id'], "int"));

      }else{

        $insertSQL = sprintf("UPDATE file_set SET file_name=%s, file_link1=%s, file_link2=%s, file_link3=%s, file_link4=%s, file_link5=%s, file_link6=%s, file_show_type=%s WHERE $fileType file_id=%s" ,
                       GetSQLValueString($image_result[$j][0], "text"),
                       GetSQLValueString($image_result[$j][1], "text"),
                       GetSQLValueString($image_result[$j][2], "text"),
                       GetSQLValueString($image_result[$j][3], "text"),
                       GetSQLValueString($image_result[$j][6], "text"),
                       GetSQLValueString($image_result[$j][7], "text"),
                       GetSQLValueString($image_result[$j][8], "text"),
                       GetSQLValueString($image_result[$j][5], "text"),
             GetSQLValueString($_POST['file_id'], "int"));
      }
				
				
					   
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
	if($_SESSION['nowMenu']=="award"){
		$updateGoTo = $_SESSION['nowPage']."?term_id=" . $_POST['file_d_id'] . "";
	}else{
		$updateGoTo = $_SESSION['nowPage']."?d_id=" . $_POST['file_d_id'] . "#img".$_POST['file_id'];
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

$file_show_type = $row_RecImage['file_show_type'];

//可選圖片樣式
if($_SESSION['nowMenu']=="environment1" || $_SESSION['nowMenu']=="environment2" || $_SESSION['nowMenu']=="environment3" || $_SESSION['nowMenu']=="environment4"){

  if(isset($_GET["type"]) && $_GET["type"]=="imageCoverFormat"){
    //$fileType   = "file_type='imageCover' AND";
    $not    = $imagesSize[$_SESSION['nowMenu'].'Cover_'.$file_show_type]['note'];
    $IWidth   = $imagesSize[$_SESSION['nowMenu'].'Cover_'.$file_show_type]['IW'];
    $IHeight  = $imagesSize[$_SESSION['nowMenu'].'Cover_'.$file_show_type]['IH'];
  }

}

//可選圖片樣式
if($_SESSION['nowMenu']=="gallery"){

  if(isset($_GET["type"]) && $_GET["type"]=="imageCoverFormat"){
    //$fileType   = "file_type='imageCover' AND";
    $not    = $imagesSize[$_SESSION['nowMenu'].'Cover_'.$file_show_type]['note'];
    $IWidth   = $imagesSize[$_SESSION['nowMenu'].'Cover_'.$file_show_type]['IW'];
    $IHeight  = $imagesSize[$_SESSION['nowMenu'].'Cover_'.$file_show_type]['IH'];
  }

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改圖片</title>
<!--<script type="text/javascript" src="jquery/jquery-1.6.4.min.js"></script>-->

<style type="text/css">
  .ml {
    display: inline-block;
    vertical-align: top;
  }
</style>
<script type="text/javascript">

function checkType(val){
  console.log(val);
  var index = parseInt(val) - 1;
  console.log(index);
  $(".coverNote").eq(index).fadeIn(100).siblings().hide();
}

$(document).ready(function() {
	
	$(".btnType").hover(function(){
		$(this).addClass('btnTypeClass');
		$(this).css('cursor', 'pointer');
	}, function(){
		$(this).removeClass('btnTypeClass');
	});

  checkType($("input[name='d_price1']:checked").val());

  $("input[name='d_price1']").change(function(){
    checkType($("input[name='d_price1']:checked").val());
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
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">
                	<?php echo (isset($_GET["type"]) && $_GET["type"]=="mediaPhoto")?"圖片標題":"圖片說明";?>
                	</td>
          	    	<td width="532"><input name="file_title" type="text" class="table_data" id="file_title" value="<?php echo $row_RecImage['file_title']; ?>" size="50">
          	    	  <input name="file_id" type="hidden" id="file_id" value="<?php echo $row_RecImage['file_id']; ?>" />
          	    	  <input name="file_d_id" type="hidden" id="file_d_id" value="<?php echo $row_RecImage['file_d_id']; ?>" /></td>
        	    	<td width="250" bgcolor="#e5ecf6"></td>
      	    	</tr>

              <?php if(isset($_GET["type"]) && $_GET["type"]=="imageCoverFormat"){ ?>

              <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">封面樣式</td>
                  <td width="532">

                  <?php if($_SESSION['nowMenu']=="environment1" || $_SESSION['nowMenu']=="environment2" || $_SESSION['nowMenu']=="environment3" || $_SESSION['nowMenu']=="environment4"){ ?>
                  <div class="radioGroupImg">
                    <label for="d_price1_1">
                      <input name="d_price1" type="radio" id="d_price1_1" value="1" checked="CHECKED">
                      <div class="iconGroup table_data">
                        <div class="icon_select icon_select1"></div>
                        <div class="icon_title">1Wx1H</div>
                      </div>
                    </label>
                  </div>

                  <div class="radioGroupImg">
                    <label for="d_price1_2">
                      <input name="d_price1" type="radio" id="d_price1_2" value="2">
                      <div class="iconGroup table_data">
                        <div class="icon_select icon_select2"></div>
                        <div class="icon_title">2Wx1H</div>
                      </div>
                    </label>
                  </div>

                  <div class="radioGroupImg">
                    <label for="d_price1_3">
                      <input name="d_price1" type="radio" id="d_price1_3" value="3">
                      <div class="iconGroup table_data">
                        <div class="icon_select icon_select3"></div>
                        <div class="icon_title">3Wx1H</div>
                      </div>
                    </label>
                  </div>

                  <div class="radioGroupImg">
                    <label for="d_price1_4">
                      <input name="d_price1" type="radio" id="d_price1_4" value="4">
                      <div class="iconGroup table_data">
                        <div class="icon_select icon_select4"></div>
                        <div class="icon_title">1Wx2H</div>
                      </div>
                    </label>
                  </div>

                  <div class="radioGroupImg">
                    <label for="d_price1_5">
                      <input name="d_price1" type="radio" id="d_price1_5" value="5">
                      <div class="iconGroup table_data">
                        <div class="icon_select icon_select5"></div>
                        <div class="icon_title">2Wx2H</div>
                      </div>
                    </label>
                  </div>

                  <div class="radioGroupImg">
                    <label for="d_price1_6">
                      <input name="d_price1" type="radio" id="d_price1_6" value="6">
                      <div class="iconGroup table_data">
                        <div class="icon_select icon_select6"></div>
                        <div class="icon_title">3Wx2H</div>
                      </div>
                    </label>
                  </div>
                  <?php } ?>

                  <?php if($_SESSION['nowMenu']=="gallery"){ ?>
                  <div class="radioGroupImg">
                    <label for="d_price1_1">
                      <input name="d_price1" type="radio" id="d_price1_1" value="1" checked="CHECKED">
                      <div class="iconGroup table_data">
                        <div class="icon_select icon_select4x2 icon_select1"></div>
                        <div class="icon_title">1Wx1H</div>
                      </div>
                    </label>
                  </div>

                  <div class="radioGroupImg">
                    <label for="d_price1_2">
                      <input name="d_price1" type="radio" id="d_price1_2" value="2">
                      <div class="iconGroup table_data">
                        <div class="icon_select icon_select4x2 icon_select2"></div>
                        <div class="icon_title">2Wx1H</div>
                      </div>
                    </label>
                  </div>

                  <div class="radioGroupImg">
                    <label for="d_price1_3">
                      <input name="d_price1" type="radio" id="d_price1_3" value="3">
                      <div class="iconGroup table_data">
                        <div class="icon_select icon_select4x2 icon_select3"></div>
                        <div class="icon_title">3Wx1H</div>
                      </div>
                    </label>
                  </div>

                  <div class="radioGroupImg">
                    <label for="d_price1_4">
                      <input name="d_price1" type="radio" id="d_price1_4" value="4">
                      <div class="iconGroup table_data">
                        <div class="icon_select icon_select4x2 icon_select4"></div>
                        <div class="icon_title">4Wx1H</div>
                      </div>
                    </label>
                  </div>

                  <div class="radioGroupImg">
                    <label for="d_price1_5">
                      <input name="d_price1" type="radio" id="d_price1_5" value="5">
                      <div class="iconGroup table_data">
                        <div class="icon_select icon_select4x2 icon_select5"></div>
                        <div class="icon_title">1Wx2H</div>
                      </div>
                    </label>
                  </div>

                  <div class="radioGroupImg">
                    <label for="d_price1_6">
                      <input name="d_price1" type="radio" id="d_price1_6" value="6">
                      <div class="iconGroup table_data">
                        <div class="icon_select icon_select4x2 icon_select6"></div>
                        <div class="icon_title">2Wx2H</div>
                      </div>
                    </label>
                  </div>

                  <div class="radioGroupImg">
                    <label for="d_price1_7">
                      <input name="d_price1" type="radio" id="d_price1_7" value="7">
                      <div class="iconGroup table_data">
                        <div class="icon_select icon_select4x2 icon_select7"></div>
                        <div class="icon_title">3Wx2H</div>
                      </div>
                    </label>
                  </div>

                  <div class="radioGroupImg">
                    <label for="d_price1_8">
                      <input name="d_price1" type="radio" id="d_price1_8" value="8">
                      <div class="iconGroup table_data">
                        <div class="icon_select icon_select4x2 icon_select8"></div>
                        <div class="icon_title">4Wx2H</div>
                      </div>
                    </label>
                  </div>
                  <?php } ?>

                   </td>
                <td width="250" bgcolor="#e5ecf6">
                  
                </td>
              </tr>

              <?php } ?>

				<?php if(isset($_GET["type"]) && $_GET["type"]=="mediaPhoto"){ ?>

				<tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">圖片說明</td>
          	    	<td width="532">

          	    	<textarea name="file_content" cols="100" rows="5" class="table_data" id="file_content"><?php echo $row_RecImage['file_content']; ?></textarea>

          	    	 </td>
        	    	<td width="250" bgcolor="#e5ecf6"></td>
      	    	</tr>

      	    	<?php } ?>

     	      	<tr>
                	<td align="center" bgcolor="#e5ecf6" class="table_col_title">目前圖片</td>
                	<td  class="table_data">
                  <img src="../<?php echo $row_RecImage['file_link2'].'?'.(mt_rand(1,100000)/100000); ?>" alt="" class="image_frame" width="100" />
                  
                  <?php if(isset($_GET["type"]) && $_GET["type"]=="imageCoverFormat"){ ?>
                  <div class="ml">

                     <?php if($_SESSION['nowMenu']=="environment1" || $_SESSION['nowMenu']=="environment2" || $_SESSION['nowMenu']=="environment3" || $_SESSION['nowMenu']=="environment4"){ ?>
                     <div>
                       <span class="coverFormat">&nbsp;封面樣式：</span><?php 
                        if($row_RecImage['file_show_type']==1){
                          echo '<div class="iconGroup table_data"><div class="icon_select icon_select1"></div><div class="icon_title">1Wx1H</div></div>';
                        }elseif($row_RecImage['file_show_type']==2){
                          echo '<div class="iconGroup table_data"><div class="icon_select icon_select2"></div><div class="icon_title">2Wx1H</div></div>';
                        }elseif($row_RecImage['file_show_type']==3){
                          echo '<div class="iconGroup table_data"><div class="icon_select icon_select3"></div><div class="icon_title">3Wx1H</div></div>';
                        }elseif($row_RecImage['file_show_type']==4){
                          echo '<div class="iconGroup table_data"><div class="icon_select icon_select4"></div><div class="icon_title">1Wx2H</div></div>';
                        }elseif($row_RecImage['file_show_type']==5){
                          echo '<div class="iconGroup table_data"><div class="icon_select icon_select5"></div><div class="icon_title">2Wx2H</div></div>';
                        }elseif($row_RecImage['file_show_type']==6){
                          echo '<div class="iconGroup table_data"><div class="icon_select icon_select6"></div><div class="icon_title">3Wx2H</div></div>';
                        }
                        ?>
                     </div>
                     <?php } ?>

                     <?php if($_SESSION['nowMenu']=="gallery"){ ?>
                     <div>
                       <span class="coverFormat">&nbsp;封面樣式：</span><?php 
                        if($row_RecImage['file_show_type']==1){
                          echo '<div class="iconGroup table_data"><div class="icon_select icon_select1"></div><div class="icon_title">1Wx1H</div></div>';
                        }elseif($row_RecImage['file_show_type']==2){
                          echo '<div class="iconGroup table_data"><div class="icon_select icon_select2"></div><div class="icon_title">2Wx1H</div></div>';
                        }elseif($row_RecImage['file_show_type']==3){
                          echo '<div class="iconGroup table_data"><div class="icon_select icon_select3"></div><div class="icon_title">3Wx1H</div></div>';
                        }elseif($row_RecImage['file_show_type']==4){
                          echo '<div class="iconGroup table_data"><div class="icon_select icon_select4"></div><div class="icon_title">4Wx1H</div></div>';
                        }elseif($row_RecImage['file_show_type']==5){
                          echo '<div class="iconGroup table_data"><div class="icon_select icon_select5"></div><div class="icon_title">1Wx2H</div></div>';
                        }elseif($row_RecImage['file_show_type']==6){
                          echo '<div class="iconGroup table_data"><div class="icon_select icon_select6"></div><div class="icon_title">2Wx2H</div></div>';
                        }elseif($row_RecImage['file_show_type']==7){
                          echo '<div class="iconGroup table_data"><div class="icon_select icon_select7"></div><div class="icon_title">3Wx2H</div></div>';
                        }elseif($row_RecImage['file_show_type']==8){
                          echo '<div class="iconGroup table_data"><div class="icon_select icon_select8"></div><div class="icon_title">4Wx2H</div></div>';
                        }
                        ?>
                     </div>
                     <?php } ?>

                   </div>
                   <?php } ?>
                  </td>
                	<td bgcolor="#e5ecf6" class="table_col_title"><p>&nbsp;</p></td>
      		    </tr>
                <tr>
              		<td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>更改圖片</p>
              	    </td>
              	    <td><input name="image[]" type="file" class="table_data" id="image[]" size="50" ></td>
              	    <td bgcolor="#e5ecf6" class="table_col_title">

                   

                    <?php if(isset($_GET["type"]) && $_GET["type"]=="imageCoverFormat"){ ?>
                    <div class="red_letter">

                        <div id="cover1" class="coverNote">*<?php echo $imagesSize[$_SESSION['nowMenu']."Cover_1"]['note'];?>。</div>
                        <div id="cover2" class="coverNote">*<?php echo $imagesSize[$_SESSION['nowMenu']."Cover_2"]['note'];?>。</div>
                        <div id="cover3" class="coverNote">*<?php echo $imagesSize[$_SESSION['nowMenu']."Cover_3"]['note'];?>。</div>
                        <div id="cover4" class="coverNote">*<?php echo $imagesSize[$_SESSION['nowMenu']."Cover_4"]['note'];?>。</div>
                        <div id="cover5" class="coverNote">*<?php echo $imagesSize[$_SESSION['nowMenu']."Cover_5"]['note'];?>。</div>
                        <div id="cover6" class="coverNote">*<?php echo $imagesSize[$_SESSION['nowMenu']."Cover_6"]['note'];?>。</div>
                        <div id="cover7" class="coverNote">*<?php echo $imagesSize[$_SESSION['nowMenu']."Cover_7"]['note'];?>。</div>
                        <div id="cover8" class="coverNote">*<?php echo $imagesSize[$_SESSION['nowMenu']."Cover_8"]['note'];?>。</div>
                      
                      </div>
                    <?php }else{ ?>
                       <p><span class="red_letter">*<?php echo $not; ?></span></p>
                    <?php } ?>

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
	