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
$query_RecBanners = "SELECT * FROM data_set WHERE d_class1 = 'banners' AND d_active='1' ORDER BY d_sort ASC, d_date DESC";
$RecBanners = mysql_query($query_RecBanners, $connect2data) or die(mysql_error());
$row_RecBanners = mysql_fetch_assoc($RecBanners);
$totalRows_RecBanners = mysql_num_rows($RecBanners);

mysql_select_db($database_connect2data, $connect2data);
$query_RecAbout = "SELECT * FROM data_set WHERE d_class1 = 'about' AND d_active='1' ORDER BY d_sort ASC, d_date DESC";
$RecAbout = mysql_query($query_RecAbout, $connect2data) or die(mysql_error());
$row_RecAbout = mysql_fetch_assoc($RecAbout);
$totalRows_RecAbout = mysql_num_rows($RecAbout);

mysql_select_db($database_connect2data, $connect2data);
$query_ReCcontact = "SELECT * FROM data_set AS D LEFT JOIN file_set AS F ON D.d_id=F.file_d_id WHERE d_class1 = 'contact' AND d_active='1' ORDER BY d_sort ASC, d_date DESC";
$ReCcontact = mysql_query($query_ReCcontact, $connect2data) or die(mysql_error());
$row_ReCcontact = mysql_fetch_assoc($ReCcontact);
$totalRows_ReCcontact = mysql_num_rows($ReCcontact);

$maxRows_RecProducts = 10;
$pageNum = 0;
if (isset($_GET['pageNum'])) {
  $pageNum = $_GET['pageNum'];
}
$startRow_RecProducts = $pageNum * $maxRows_RecProducts;

mysql_select_db($database_connect2data, $connect2data);
$query_RecProducts = "SELECT * FROM term_relationships AS TR, data_set AS D, terms AS T
WHERE TR.term_taxonomy_id = T.term_id AND D.d_id = TR.object_id AND D.d_class1='products' AND D.d_active='1' ORDER BY term_order ASC, d_date DESC";
$query_limit_RecProducts = sprintf("%s LIMIT %d, %d", $query_RecProducts, $startRow_RecProducts, $maxRows_RecProducts);
$RecProducts = mysql_query($query_limit_RecProducts, $connect2data) or die(mysql_error());
$row_RecProducts = mysql_fetch_assoc($RecProducts);

/*if (isset($_GET['totalRows'])) {
  $totalRows = $_GET['totalRows'];
} else {
  $all_RecProducts = mysql_query($query_RecProducts);
  $totalRows = mysql_num_rows($all_RecProducts);
}*/
$all_RecProducts = mysql_query($query_RecProducts);
$totalRows = mysql_num_rows($all_RecProducts);
$totalPages = ceil($totalRows/$maxRows_RecProducts)-1;

$queryString = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum") == false &&
        stristr($param, "totalRows") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString = sprintf("&totalRows=%d%s", $totalRows, $queryString);
?>
<?php require_once('../Connections/session.initialize.php'); ?>
<?php require_once('../js/fun_moneyFormat.php'); ?>
<?php require_once('display_page_index.php'); ?>
<?php require_once('../login_query.php'); ?>
<!DOCTYPE html>
<html lang="zh-tw">
<head>
	<meta charset="UTF-8">
	<title>C+H</title>

	<?php include('meta.php') ?>

	<script src="js/jquery/1.11.1/jquery.min.js"></script>

	<script src="js/jquery.bxslider/jquery.bxslider.js"></script>
	<link rel="stylesheet" type="text/css" href="js/jquery.bxslider/jquery.bxslider.css">

	<link rel="stylesheet/less" type="text/css" href="style_ryder.less">
	<script src="js/less-1.3.0.min.js" type="text/javascript"></script>

<?php //require_once('../ga.php'); ?>
</head>
<body>

	<?php include 'topmenu.php'; ?>

	<div class="banner">

<?php if ($totalRows_RecBanners > 0) { // Show if recordset not empty ?>
<ul class="banner-bxslider">
<?php
$i=1;
do {
$colname_RecBannerImage = "-1";
if (isset($row_RecBanners['d_id'])) {
  $colname_RecBannerImage = $row_RecBanners['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecBannerImage = sprintf("SELECT * FROM file_set WHERE file_type='image' AND file_d_id = %s", GetSQLValueString($colname_RecBannerImage, "int"));
$RecBannerImage = mysql_query($query_RecBannerImage, $connect2data) or die(mysql_error());
$row_RecBannerImage = mysql_fetch_assoc($RecBannerImage);
$totalRows_RecBannerImage = mysql_num_rows($RecBannerImage);

if($totalRows_RecBannerImage>0){
	
	if($row_RecBanners['d_content']!=''){
		
		echo '<li><a href="'.$row_RecBanners['d_content'].'" target="_blank"><img src="../'.$row_RecBannerImage['file_link1'].'" ></a></li>';
	}else{
		echo '<li><img src="../'.$row_RecBannerImage['file_link1'].'" ></li>';
	}
	
}

$i++;
} while ($row_RecBanners = mysql_fetch_assoc($RecBanners)); ?>
</ul>
<?php } // Show if recordset not empty ?>

	</div><!-- banner end -->

	<div class="bigtitle">精選商品</div>

<?php if ($totalRows > 0) { // Show if recordset not empty ?>
	<ul class="index-list">

<?php do { ?>
<?php
mysql_select_db($database_connect2data, $connect2data);
$query_RecProductImage = "SELECT * FROM file_set  WHERE file_type='image' AND file_d_id = ".$row_RecProducts['d_id']." ORDER BY file_id DESC";
$RecProductImage = mysql_query($query_RecProductImage, $connect2data) or die(mysql_error());
$row_RecProductImage = mysql_fetch_assoc($RecProductImage);
$totalRows_RecProductImage = mysql_num_rows($RecProductImage);
?>
<li>
    <div class="il-item1"><a href="goods_detail.php?id=<?php echo $row_RecProducts['d_id']; ?>"><img src="<?php echo '../'.$row_RecProductImage['file_link3'].'?'.(mt_rand(1,100000)/100000); ?>" width="300"></a></div>
    <div class="il-item2 index-li-item"><a href="goods_detail.php?id=<?php echo $row_RecProducts['d_id']; ?>"><?php echo $row_RecProducts['d_title']; ?></a></div>
    <div class="moneybox"><a href="goods_detail.php?id=<?php echo $row_RecProducts['d_id']; ?>"><span>$ <?php echo moneyFormat($row_RecProducts['d_price1']); ?></span></a></div>
</li>

<?php } while ($row_RecProducts = mysql_fetch_assoc($RecProducts)); ?>

		<!--<li>
			<div class="il-item1"><a href="goods.php"><img src="images/index-list.png" width="300"></a></div>
			<div class="il-item2"><a href="goods.php">金薯C - 10入盒</a></div>
			<div class="moneybox"><a href="goods.php"><span>$ &nbsp; 399</span></a></div>
		</li>
		<li>
			<div class="il-item1"><a href="goods.php"><img src="images/index-list.png" width="300"></a></div>
			<div class="il-item2"><a href="goods.php">金薯C - 10入盒</a></div>
			<div class="moneybox"><a href="goods.php"><span>$ &nbsp; 399999</span></a></div>
		</li>
		<li>
			<div class="il-item1"><a href="goods.php"><img src="images/index-list.png" width="300"></a></div>
			<div class="il-item2"><a href="goods.php">金薯C - 10入盒</a></div>
			<div class="moneybox"><a href="goods.php"><span>$ &nbsp; 399</span></a></div>
		</li>-->
	</ul>


<?php
//顯示頁選擇與分頁設定開始
displayPages($pageNum, $queryString, $totalPages, $totalRows, "goods.php");
//顯示頁選擇與分頁設定結束
?>
	<!--<ul class="pager">
		<li>1</li>
		<li class="current">2</li>
		<li>3</li>
	</ul>-->
<?php } // Show if recordset not empty ?>

	<?php include 'footer.php'; ?>

</body>
</html>

<script type="text/javascript">

$( window ).load(function() {
  var webh=$(document).height() - 405;
	// var toph=$(".topmenu-on").height();
	// var h= webh - toph;
	// alert(toph);
	$(".topmenu-on").css("height",webh+"px");
});



	$('.banner-bxslider').bxSlider({
		mode: 'fade',
		pager:false,
		auto: true,
		// onSlideBefore: function  () {
		// 	var current = slider.getCurrentSlide();
		// 	$(".banner").vegas('jump' , current);
		// }
	});

</script>
