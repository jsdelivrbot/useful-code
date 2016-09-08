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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RecNews = 10;
$pageNum = 0;
if (isset($_GET['pageNum'])) {
  $pageNum = $_GET['pageNum'];
}
$startRow_RecNews = $pageNum * $maxRows_RecNews;


mysql_select_db($database_connect2data, $connect2data);
$query_RecNewsC = "SELECT * FROM class_set WHERE c_parent = 'newsC' AND c_active='1' ORDER BY c_sort ASC, c_id DESC";
$RecNewsC = mysql_query($query_RecNewsC, $connect2data) or die(mysql_error());
$row_RecNewsC = mysql_fetch_assoc($RecNewsC);
$totalRows_RecNewsC = mysql_num_rows($RecNewsC);

$G_selected1 = '';
if(isset($_GET['selected1']))
{
	$_SESSION['selected_newsC'] = $G_selected1 = $_GET['selected1'];
}else 
{
	$G_selected1 = $_SESSION['selected_newsC'] = $row_RecNewsC['c_id'];
}

mysql_select_db($database_connect2data, $connect2data);
$query_RecNews = "SELECT data_set.*, class_set.c_title as c_title FROM data_set LEFT JOIN class_set ON data_set.d_class2 =class_set.c_id WHERE d_class1 = 'news' AND d_active='1' ORDER BY d_sort ASC, d_date DESC";
$query_limit_RecNews = sprintf("%s LIMIT %d, %d", $query_RecNews, $startRow_RecNews, $maxRows_RecNews);
$RecNews = mysql_query($query_limit_RecNews, $connect2data) or die(mysql_error());
$row_RecNews = mysql_fetch_assoc($RecNews);

$all_RecNews = mysql_query($query_RecNews);
$totalRows = mysql_num_rows($all_RecNews);
$totalPages = ceil($totalRows/$maxRows_RecNews)-1;

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

$R_pageNum = 0;
if (isset($_REQUEST["pageNum"])) 
{
$R_pageNum = $_REQUEST["pageNum"];
}
if (! isset($R_pageNum)) 
{
$_SESSION["ToPage"]=0;
}
//若指定分頁數小於1則預設顯示第一頁
else if ($R_pageNum<0) 
{
$_SESSION["ToPage"]=0;
}
//若指定指定的分頁超過總分頁數則顯示最後一頁
else if ($R_pageNum>$totalPages)
{
$_SESSION["ToPage"]=$totalPages;
}
else
{
$_SESSION["ToPage"]=$R_pageNum;
}
//如果指定的頁面大於資料所擁有的頁面,轉到最大的頁面
if($R_pageNum>$totalPages && $R_pageNum!=0)
{
	header("Location:news.php");
}
?>
<?php require_once('../Connections/session.initialize.php'); ?>
<?php require_once('../js/fun_changeStr.php'); ?>
<?php require_once('display_page.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>C+H</title>

	<?php include('meta.php') ?>

	<script src="js/jquery/1.11.1/jquery.min.js"></script>

	<link rel="stylesheet/less" type="text/css" href="style_ryder.less">
	<script src="js/less-1.3.0.min.js" type="text/javascript"></script>

	<style type="text/css">
		.h-mb0{
			margin-bottom: 0;
		}
		ul.pager{
			margin-top: 20px;
			margin-bottom: 43px;
		}
	</style>

</head>
<body>

	<?php include 'topmenu-fixed.php'; ?>

	<div class="fortopmenupush"></div>

	<div class="bigtitle h-mb0">最新消息</div>

<?php if ($totalRows > 0) { // Show if recordset not empty ?>

	<ul class="news-list">
    
<?php
do{
?>
<?php
$colname_RecNewsImage = "-1";
if (isset($row_RecNews['d_id'])) {
  $colname_RecNewsImage = $row_RecNews['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecNewsImage = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'image'", GetSQLValueString($colname_RecNewsImage, "int"));
$RecNewsImage = mysql_query($query_RecNewsImage, $connect2data) or die(mysql_error());
$row_RecNewsImage = mysql_fetch_assoc($RecNewsImage);
$totalRows_RecNewsImage = mysql_num_rows($RecNewsImage);
?>
<li>
    <a href="news_detail.php?id=<?php echo $row_RecNews['d_id']; ?>">
        <div><img src="<?php echo '../'.$row_RecNewsImage['file_link1'].'?'.(mt_rand(1,100000)/100000); ?>"></div>
        <div class="blackarea">
            <?php echo $row_RecNews['d_title']; ?>
        </div>
    </a>
</li>   
<?php } while ($row_RecNews = mysql_fetch_assoc($RecNews)); ?> 
		<!--<li>
			<a href="news_detail.php">
				<div><img src="images/news1.png"></div>
				<div class="blackarea">
					【新品上市】這一蚵，超好吃的啦！<BR>
					鮮美海味 自然甘甜
				</div>
			</a>
		</li>
		<li>
			<a href="news_detail.php">
				<div><img src="images/news2.png"></div>
				<div class="blackarea">
					【新品上市】這一蚵，超好吃的啦！<BR>
					鮮美海味 自然甘甜
				</div>
			</a>
		</li>
		<li>
			<a href="news_detail.php">
				<div><img src="images/news3.png"></div>
				<div class="blackarea">
					【新品上市】這一蚵，超好吃的啦！<BR>
					鮮美海味 自然甘甜
				</div>
			</a>
		</li>
		<li>
			<a href="news_detail.php">
				<div><img src="images/news4.png"></div>
				<div class="blackarea">
					【新品上市】這一蚵，超好吃的啦！<BR>
					鮮美海味 自然甘甜
				</div>
			</a>
		</li>-->        
	</ul>

<?php
//顯示頁選擇與分頁設定開始
displayPages($pageNum, $queryString, $totalPages, $totalRows, $currentPage);
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