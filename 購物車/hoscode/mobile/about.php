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
$query_RecAbout = "SELECT * FROM data_set WHERE d_class1 = 'about' AND d_active='1' ORDER BY d_sort ASC, d_date DESC";
$RecAbout = mysql_query($query_RecAbout, $connect2data) or die(mysql_error());
$row_RecAbout = mysql_fetch_assoc($RecAbout);
$totalRows_RecAbout = mysql_num_rows($RecAbout);
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

	<script src="js/jquery.bxslider/jquery.bxslider.js"></script>
	<link rel="stylesheet" type="text/css" href="js/jquery.bxslider/jquery.bxslider.css">

	<link rel="stylesheet/less" type="text/css" href="style_ryder.less">
	<script src="js/less-1.3.0.min.js" type="text/javascript"></script>

	<style type="text/css">
		.bx-wrapper{
			margin-bottom: 20px;
		}
	</style>

</head>
<body>

	<?php include 'topmenu-fixed.php'; ?>

	<div class="fortopmenupush"></div>

	
	<div class="bigtitle">關於我們</div>

	<!-- <div class="areatitle">
		【新品上市】這一蚵，超好吃的啦！<BR>
		鮮美海味 自然甘甜
	</div> -->
    <div class="news-container">
<?php
$colname_RecAboutImage = "-1";
if (isset($row_RecAbout['d_id'])) {
  $colname_RecAboutImage = $row_RecAbout['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecAboutImage = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'image'", GetSQLValueString($colname_RecAboutImage, "int"));
$RecAboutImage = mysql_query($query_RecAboutImage, $connect2data) or die(mysql_error());
$row_RecAboutImage = mysql_fetch_assoc($RecAboutImage);
$totalRows_RecAboutImage = mysql_num_rows($RecAboutImage);
?>

<?php if ($totalRows_RecAboutImage > 0) { // Show if recordset not empty ?>

	<div class="about-banner">
		<ul class="about-bxslider">
			<?php do { ?>
  			 <li><img src="<?php echo '../'.$row_RecAboutImage['file_link1'].'?'.(mt_rand(1,100000)/100000); ?>"></li> 
    <?php } while ($row_RecAboutImage = mysql_fetch_assoc($RecAboutImage)); ?>
		</ul>
	</div><!-- banner end -->
<?php } // Show if recordset not empty ?>

	<div class="news-detail-article">

		<?php echo nl2br($row_RecAbout['d_content']); ?>
	</div>

	</div>

	<div class="gotoback">回上一頁</div>

	<?php include 'footer.php'; ?>

</body>
</html>


<script type="text/javascript">
$(".gotoback").click(function  () {
		history.go(-1);
	});
	$('.about-bxslider').bxSlider({
		mode: 'fade',
		pager:false,
		auto: true,
		controls:false
		// onSlideBefore: function  () {
		// 	var current = slider.getCurrentSlide();
		// 	$(".banner").vegas('jump' , current);
		// }
	});
</script>

