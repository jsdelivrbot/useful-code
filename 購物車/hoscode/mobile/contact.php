<?php
require_once('inc/EDcart.php');
if (!isset($_SESSION)) {
  session_start();
}

$cart =& $_SESSION['edCart']; 
if(!is_object($cart)) $cart = new edCart(); 
?>
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

mysql_select_db($database_connect2data, $connect2data);
$query_ReCcontact = "SELECT * FROM data_set AS D LEFT JOIN file_set AS F ON D.d_id=F.file_d_id WHERE d_class1 = 'contact' AND d_active='1' ORDER BY d_sort ASC, d_date DESC";
$ReCcontact = mysql_query($query_ReCcontact, $connect2data) or die(mysql_error());
$row_ReCcontact = mysql_fetch_assoc($ReCcontact);
$totalRows_ReCcontact = mysql_num_rows($ReCcontact);
?>
<?php require_once('../Connections/session.initialize.php'); ?>
<?php require_once('../js/fun_moneyFormat.php'); ?>
<?php require_once('../login_query.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>C+H</title>

	<?php include('meta.php') ?>

	<script src="js/jquery/1.11.1/jquery.min.js"></script>

	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

	<link rel="stylesheet/less" type="text/css" href="style_ryder.less">
	<script src="js/less-1.3.0.min.js" type="text/javascript"></script>

	<script>
		function initialize()
		{
			var myLatLng = new google.maps.LatLng(<?php echo isset($row_ReCcontact['d_class2'])?$row_ReCcontact['d_class2']:'25.031625, 121.529090'; ?>);
			var mapProp = {
				center:new google.maps.LatLng(<?php echo isset($row_ReCcontact['d_class2'])?$row_ReCcontact['d_class2']:'25.031625, 121.529090'; ?>),
				zoom:16,
				scrollwheel: false,
				draggable: false,
				styles: [ { stylers: [ { saturation: -100 } ] } ],
				mapTypeId:google.maps.MapTypeId.ROADMAP
			}


			var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
	   //googleMap 是div id

	   // for scale icon
	   var image = {
	   	url: '../img/maplogo.png',
	       // This marker is 20 pixels wide by 32 pixels high.
	       scaledSize : new google.maps.Size(125,52),
		   	// The origin for this image is (0, 0).
		   	origin: new google.maps.Point(0, 0),
		   	// The anchor for this image is the base of the flagpole at (0, 32).
		   	anchor: new google.maps.Point(-20, 0)
	   };
	   // var image = 'images/maplogo.png';
	   var beachMarker = new google.maps.Marker({
	   	position: myLatLng,
	   	map: map,
	   	icon: image
	   });
	}

	google.maps.event.addDomListener(window, 'load', initialize);
</script>

<style type="text/css">

</style>

</head>
<body>

	<?php include 'topmenu-fixed.php'; ?>

	<div class="fortopmenupush"></div>

	<div class="bigtitle">聯絡我們</div>

	<div class="areatitle">
    
    <!--<img src="<?php //echo '../'.$row_ReCcontact['file_link1']; ?>" width="203" height="25">-->
		<!--【新品上市】這一蚵，超好吃的啦！<BR>
		鮮美海味 自然甘甜-->
	</div>

	<div id="googleMap"></div>

	<div class="mapcontent">
		<p>Studio / <?php echo $row_ReCcontact['d_content']; ?></p>
		<!-- <p class="h-phone"><a href="tel:<?php echo $row_ReCcontact['d_class3']; ?>">服務專線 / <?php echo $row_ReCcontact['d_class3']; ?></a></p> -->
		<p class="email"><a href="mailto:<?php echo $row_ReCcontact['d_class4']; ?>">E-mail / <?php echo $row_ReCcontact['d_class4']; ?></a></p>
		<!-- <img src="images/qrcode.png" width="166"> -->
        
	</div>

	<?php include 'footer.php'; ?>

</body>
</html>