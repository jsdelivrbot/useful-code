<?php
require_once('inc/EDcart.php');
if (!isset($_SESSION)) {
  session_start();
}
ob_start();
$cart =& $_SESSION['edCart']; 
if(!is_object($cart)) $cart = new edCart(); 
//echo "item = ".$cart->itemCount;
?>
<?php require_once('member_limit.php'); ?>
<?php require_once('mobileCheck.php'); ?>
<?php require_once('Connections/connect2data.php'); ?>
<?php require_once('Connections/session.initialize.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>HanCure 漢速敷</title>

<!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->

<link rel="shortcut icon" href="img/fav.png" type="image/x-icon">
<!-- <link rel="apple-touch-icon" href="img/fav.png">
<link rel="apple-touch-icon" sizes="76x76" href="img/fav.png">
<link rel="apple-touch-icon" sizes="120x120" href="img/fav.png">
<link rel="apple-touch-icon" sizes="152x152" href="img/fav.png"> -->
<?php include('meta.php') ?>

<script src="js/jquery/1.11.1/jquery.min.js"></script>

<link rel="stylesheet/less" type="text/css" href="style_ryder.less">
<script src="js/less-1.3.0.min.js" type="text/javascript"></script>

<?php require_once('ga.php'); ?>

</head>
<body>
	<?php $now="member"; ?>
	<?php include('topmenu.php'); ?>

	<div class="list-wrap">
		<?php include 'logo.php'; ?>

		<div class="area1">
			<?php include 'menu.php'; ?>
		</div><!-- area1 end -->


		<?php 
		$m_now='';
		include('member_menu.php');
		?>

		<!-- <ul class="area2">
			<li>
				<a href="order_list.php">
				<span><img src="images/member_list_underline.png" height="4" width="82"></span>
				<img src="images/member_list1.png" height="21" width="118">
				</a>
			</li>
			<li>
				<a href="member_edit.php">
				<span><img src="images/member_list_underline.png" height="4" width="82"></span>
				<img src="images/member_list2.png" height="21" width="114">
				</a>
			</li>
			<li>
				<a href="order_look.php">
				<span><img src="images/member_list_underline.png" height="4" width="82"></span>
				<img src="images/member_list3.png" height="21" width="113">
				</a>
			</li>
		</ul> --><!-- area2 end -->

	</div><!-- list-wrap end -->

	<?php include 'backtotop.php'; ?>
	<?php include 'footer.php'; ?>

</body>
</html>

