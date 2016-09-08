<?php
require_once('inc/EDcart.php');
if (!isset($_SESSION)) {
  session_start();
}

$cart =& $_SESSION['edCart']; 
if(!is_object($cart)) $cart = new edCart(); 
?>
<?php require_once('mobileCheck.php'); ?>
<?php require_once('Connections/connect2data.php'); ?>
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

$maxRows_RecProducts = 9;
$pageNum = 0;
if (isset($_GET['pageNum'])) {
  $pageNum = $_GET['pageNum'];
}
$startRow_RecProducts = $pageNum * $maxRows_RecProducts;

mysql_select_db($database_connect2data, $connect2data);
$query_RecProductsT = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='post_tag' AND T.term_active='1' ORDER BY term_sort ASC, term_id DESC";
$RecProductsT = mysql_query($query_RecProductsT, $connect2data) or die(mysql_error());
$row_RecProductsT = mysql_fetch_assoc($RecProductsT);
$totalRowsT = mysql_num_rows($RecProductsT);

$tsql = "";
if (isset($_GET['t'])) {
  $tid = $_GET['t'];
  $tsql = "AND D.d_class2='$tid'";
}

mysql_select_db($database_connect2data, $connect2data);
$query_RecProducts = "SELECT * FROM term_relationships AS TR, data_set AS D, terms AS T
WHERE TR.term_taxonomy_id = T.term_id AND D.d_id = TR.object_id AND D.d_class1='products' $tsql AND D.d_active='1' ORDER BY term_order ASC, d_date DESC";
$query_limit_RecProducts = sprintf("%s LIMIT %d, %d", $query_RecProducts, $startRow_RecProducts, $maxRows_RecProducts);
$RecProducts = mysql_query($query_limit_RecProducts, $connect2data) or die(mysql_error());
$row_RecProducts = mysql_fetch_assoc($RecProducts);
$totalRows = mysql_num_rows($RecProducts);

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
	header("Location:products.php");
}
?>
<?php require_once('Connections/session.initialize.php'); ?>
<?php require_once('js/fun_moneyFormat.php'); ?>
<?php require_once('display_page.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>C+H</title>

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
	<?php $now="products"; ?>
	<?php include('topmenu.php'); ?>

	<div class="products-wrap">
		<?php include 'logo.php'; ?>

		<div class="area1">
			<?php include 'menu.php'; ?>
		</div><!-- area1 end -->

		<div class="area2">
			<ul>
				<!-- 搜尋 -->
				<!-- <li class="left"><input type="text" placeholder="" id="text"><img src="images/textbg.png" height="27" width="20"></li> -->
				<li class="right">
					<div class="title">產品分類</div>
                    
<?php if ($totalRowsT > 0) { // Show if recordset not empty ?>
<div class="content">
<?php do { ?>
<?php
mysql_select_db($database_connect2data, $connect2data);
$query_RecPTTotal = "SELECT COUNT(d_id) AS TT FROM data_set AS D WHERE D.d_class1='products' AND D.d_active='1' AND D.d_class2='".$row_RecProductsT['term_id']."' ORDER BY d_date DESC";
$RecPTTotal = mysql_query($query_RecPTTotal, $connect2data) or die(mysql_error());
$row_RecPTTotal = mysql_fetch_assoc($RecPTTotal);
$totalRows_RecPTTotal = mysql_num_rows($RecPTTotal);
//echo $query_RecPTTotal.'<BR>';
?>
<p><a href="products.php?t=<?php echo $row_RecProductsT['term_id'];?>"><?php echo $row_RecProductsT['name']; ?><span><?php echo $row_RecPTTotal['TT']; ?></span></a></p>
<?php } while ($row_RecProductsT = mysql_fetch_assoc($RecProductsT)); ?>
    <!--<p>冷凍食品<span>5</span></p>
    <p>空運來台<span>10</span></p>
    <p>現撈海鮮<span>6</span></p>-->
</div>
<?php } // Show if recordset not empty ?>

				</li>
			</ul>
		</div><!-- area2 end -->

		<div class="area1 area960">
			<div class="bigtitle">
				<div class="ch">全部商品</div>
				<div class="en">Products</div>
			</div>


<?php if ($totalRows > 0) { // Show if recordset not empty ?>
			<ul class="list">
<?php do{ ?>
<?php
$colname_RecImage = "-1";
if (isset($row_RecProducts['d_id'])) {
  $colname_RecImage = $row_RecProducts['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecImage = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'image' ORDER BY file_id DESC", GetSQLValueString($colname_RecImage, "int"));
$RecImage = mysql_query($query_RecImage, $connect2data) or die(mysql_error());
$row_RecImage = mysql_fetch_assoc($RecImage);
$totalRows_RecImage = mysql_num_rows($RecImage);
?>
<li>
    <a href="products_detail.php?id=<?php echo $row_RecProducts['d_id'];?>"><div class="cover"><img src="<?php echo $row_RecImage['file_link3'].'?'.(mt_rand(1,100000)/100000); ?>"><div class="block"></div></div></a>
    <a href="products_detail.php?id=<?php echo $row_RecProducts['d_id'];?>"><div class="title"><?php echo $row_RecProducts['d_title'];?></div></a>
    <a href="products_detail.php?id=<?php echo $row_RecProducts['d_id'];?>"><div class="price">$ <?php echo moneyFormat($row_RecProducts['d_price1']); ?></div></a>
</li>

<?php } while($row_RecProducts = mysql_fetch_assoc($RecProducts));?>
            
				<!--<li>
					<a href="products_detail.php"><div class="cover"><img src="images/index-list.png"><div class="block"></div></div></a>
					<a href="products_detail.php"><div class="title">番仔挖烏魚子 - 五兩一片</div></a>
					<a href="products_detail.php"><div class="price">$ 1,390</div></a>
				</li>
				<li>
					<a href="products_detail.php"><div class="cover"><img src="images/index-list.png"><div class="block"></div></div></a>
					<a href="products_detail.php"><div class="title">番仔挖烏魚子 - 五兩一片</div></a>
					<a href="products_detail.php"><div class="price">$ 1,390</div></a>
				</li>
				<li>
					<a href="products_detail.php"><div class="cover"><img src="images/index-list.png"><div class="block"></div></div></a>
					<a href="products_detail.php"><div class="title">番仔挖烏魚子 - 五兩一片</div></a>
					<a href="products_detail.php"><div class="price">$ 1,390</div></a>
				</li>
				<li>
					<a href="products_detail.php"><div class="cover"><img src="images/index-list.png"><div class="block"></div></div></a>
					<a href="products_detail.php"><div class="title">番仔挖烏魚子 - 五兩一片</div></a>
					<a href="products_detail.php"><div class="price">$ 1,390</div></a>
				</li>
				<li>
					<a href="products_detail.php"><div class="cover"><img src="images/index-list.png"><div class="block"></div></div></a>
					<a href="products_detail.php"><div class="title">番仔挖烏魚子 - 五兩一片</div></a>
					<a href="products_detail.php"><div class="price">$ 1,390</div></a>
				</li>
				<li>
					<a href="products_detail.php"><div class="cover"><img src="images/index-list.png"><div class="block"></div></div></a>
					<a href="products_detail.php"><div class="title">番仔挖烏魚子 - 五兩一片</div></a>
					<a href="products_detail.php"><div class="price">$ 1,390</div></a>
				</li>-->
			</ul>

<?php
//顯示頁選擇與分頁設定開始
displayPages($pageNum, $queryString, $totalPages, $totalRows, $currentPage);
//顯示頁選擇與分頁設定結束
?>  

<?php } // Show if recordset not empty ?>
            
		</div><!-- area3 end -->

	</div><!-- products-wrap end -->

	<?php include('backtotop.php'); ?>
	<?php include('footer.php'); ?>

</body>
</html>
<?php
mysql_free_result($RecProductsT);

mysql_free_result($RecProducts);
?>
