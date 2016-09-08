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

$colname_RecNews = "-1";
if (isset($_GET['id'])) {
  $colname_RecNews = $_GET['id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecNews = sprintf("SELECT * FROM data_set WHERE d_id = %s AND d_active='1'", GetSQLValueString($colname_RecNews, "int"));
$RecNews = mysql_query($query_RecNews, $connect2data) or die(mysql_error());
$row_RecNews = mysql_fetch_assoc($RecNews);
$totalRows_RecNews = mysql_num_rows($RecNews);


if($totalRows_RecNews==0){
	header("Location: news.php");
}

$colname_RecImage = "-1";
if (isset($row_RecNews['d_id'])) {
  $colname_RecImage = $row_RecNews['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecImage = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'image'", GetSQLValueString($colname_RecImage, "int"));
$RecImage = mysql_query($query_RecImage, $connect2data) or die(mysql_error());
$row_RecImage = mysql_fetch_assoc($RecImage);
$totalRows_RecImage = mysql_num_rows($RecImage);

mysql_select_db($database_connect2data, $connect2data);
$query_RecNewsC = "SELECT * FROM class_set WHERE c_parent = 'newsC' AND c_active='1' ORDER BY c_sort ASC, c_id DESC";
$RecNewsC = mysql_query($query_RecNewsC, $connect2data) or die(mysql_error());
$row_RecNewsC = mysql_fetch_assoc($RecNewsC);
$totalRows_RecNewsC = mysql_num_rows($RecNewsC);
?>
<?php require_once('../Connections/session.initialize.php'); ?>
<?php require_once('../js/fun_changeStr.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>C+H</title>

	<?php include('meta.php') ?>

	<script src="js/jquery/1.11.1/jquery.min.js"></script>

	<link rel="stylesheet/less" type="text/css" href="style_ryder.less?0.1">
	<script src="js/less-1.3.0.min.js" type="text/javascript"></script>


</head>
<body>

	<?php include 'topmenu-fixed.php'; ?>

	<div class="fortopmenupush"></div>

	<div class="bigtitle">最新消息</div>

	<div class="news-container">
  <div class="areatitle news-detail">
		<?php echo $row_RecNews['d_title']; ?>
	</div>

	<div class="news-detail-article">
    
    	<?php if ($totalRows_RecImage > 0) { // Show if recordset not empty ?>
<img src="<?php echo '../'.$row_RecImage['file_link1'].'?'.(mt_rand(1,100000)/100000); ?>">
<?php } // Show if recordset not empty ?>
                    
                    
                    <?php echo $row_RecNews['d_class4']; ?>
    
		<!--<img src="images/news1.png">

		【超鮮味 這一蚵 全新上市】
		Topdry在大家的期待下，經過不斷的研發以及修正，終於又推出了一個萬眾矚目的新產品：這一蚵，同樣透過真空低溫慢炸的技術，保留蚵仔的風味以及尺寸，帶著鮮美海味的自然甘甜，讓大家不管是在清晨七點鐘或是凌晨三點鐘，隨時都可以吃到的海味新食感，冰友啊～喜歡海味的你，一定不能錯過，享用大海小菜超easy！用來點心、下酒都適合！！

		<img src="images/news3.png">-->
	</div>
  </div>

	<div class="gotoback">回上一頁</div>

	<?php include 'footer.php'; ?>

</body>
</html>


<script type="text/javascript">
	$(".gotoback").click(function  () {
		history.go(-1);
	})
</script>

