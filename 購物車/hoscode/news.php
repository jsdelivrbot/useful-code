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

$maxRows_RecNews = 20;
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
<?php require_once('Connections/session.initialize.php'); ?>
<?php require_once('display_page.php'); ?>
<?php require_once('js/fun_changeStr.php'); ?>
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
	<?php $now="news"; ?>
	<?php include('topmenu.php'); ?>

	<div class="news-wrap">
		<?php include 'logo.php'; ?>

		<div class="area1">
			<?php include 'menu.php'; ?>
		</div><!-- area1 end -->

		<div class="area2">
			<div class="area2-left">
				<ul class="left_catbar">
					<!-- 搜尋 -->
					<!-- <li class="left"><input type="text" placeholder="" id="text"><img src="images/textbg.png" height="27" width="20"></li> -->
					<li class="right">
						<div class="title">最新文章</div>
                        
                        

  
<ul class="content">

<?php

mysql_select_db($database_connect2data, $connect2data);
$sqlY = "SELECT MIN( d_class3 ) AS minY FROM data_set WHERE d_class1='news' AND d_active='1'";
$result = mysql_query($sqlY, $connect2data) or die(mysql_error());
$row = mysql_fetch_array( $result );
//echo 'y = '.$row['minY'];
for($i=date('Y'); $i>=$row['minY']; $i--){
?>
	
<?php
mysql_select_db($database_connect2data, $connect2data);
$query_RecAllNews = "SELECT data_set.*, class_set.c_title as c_title FROM data_set LEFT JOIN class_set ON data_set.d_class2 =class_set.c_id WHERE d_class1 = 'news' AND d_class3='".$i."' AND d_active='1' ORDER BY d_date DESC, d_sort ASC";

//echo $query_RecAllNews.'<br>';
$RecAllNews = mysql_query($query_RecAllNews, $connect2data) or die(mysql_error());
$row_RecAllNews = mysql_fetch_assoc($RecAllNews);
$totalRows_RecAllNews = mysql_num_rows($RecAllNews);

if($totalRows_RecAllNews>0){
?>
<li>


    <div class="heading"><?php echo $row_RecAllNews['d_class3']; ?>年 <img alt="" src="images/heading-arrow.png" height="9" width="10"></div>
    <div class="article">
      <?php do{ ?>
        <p><a href="news_detail.php?id=<?php echo $row_RecAllNews['d_id']; ?>"><?php echo sortDate($row_RecAllNews['d_date'],''); ?> <?php echo $row_RecAllNews['d_title']; ?></a></p>
        
   <?php
} while ($row_RecAllNews = mysql_fetch_assoc($RecAllNews));
$rows = mysql_num_rows($RecAllNews);
if($rows > 0) {
  mysql_data_seek($RecAllNews, 0);
  $row_RecAllNews = mysql_fetch_assoc($RecAllNews);
}

?>
    </div>
</li>
<?php }//totalRows_RecAllNews ?>

	
<?php
}
?>
    <!--<li>
        <div class="heading">5月 <img alt="" src="images/heading-arrow.png" height="9" width="10"></div>
        <div class="article">
            <p><a href="javascript:;">20150811 番仔挖烏魚子介紹</a></p>
            <p><a href="javascript:;">20150511 鮪魚檢驗報告</a></p>
            <p><a href="javascript:;">20150511 明蝦檢驗報告</a></p>
        </div>
    </li>
    <li>
        <div class="heading">4月 <img alt="" src="images/heading-arrow.png" height="9" width="10"></div>
        <div class="article">
            <p><a href="javascript:;">20150811 番仔挖烏魚子介紹</a></p>
            <p><a href="javascript:;">20150511 鮪魚檢驗報告</a></p>
            <p><a href="javascript:;">20150511 明蝦檢驗報告</a></p>
        </div>
    </li>
    <li>
        <div class="heading">3月 <img alt="" src="images/heading-arrow.png" height="9" width="10"></div>
        <div class="article">
            <p><a href="javascript:;">20150811 番仔挖烏魚子介紹</a></p>
            <p><a href="javascript:;">20150511 鮪魚檢驗報告</a></p>
            <p><a href="javascript:;">20150511 明蝦檢驗報告</a></p>
        </div>
    </li>-->
</ul><!-- ul.content end -->

                        
					  <div class="title">文章分類</div>
                    
 <?php if ($totalRows_RecNewsC > 0) { // Show if recordset not empty ?>                     
<ul class="content">
<?php do { ?>
<?php
mysql_select_db($database_connect2data, $connect2data);
$query_RecAllNews = "SELECT data_set.*, class_set.c_title as c_title FROM data_set LEFT JOIN class_set ON data_set.d_class2 =class_set.c_id WHERE d_class1 = 'news' AND d_class2='".$row_RecNewsC['c_id']."' AND d_active='1' ORDER BY d_sort ASC, d_date DESC";
$RecAllNews = mysql_query($query_RecAllNews, $connect2data) or die(mysql_error());
$row_RecAllNews = mysql_fetch_assoc($RecAllNews);
$totalRows_RecAllNews = mysql_num_rows($RecAllNews);
?>
<li>
    <div class="heading"><?php echo $row_RecNewsC['c_title']; ?> <img alt="" src="images/heading-arrow.png" height="9" width="10"></div>
<?php if($totalRows_RecAllNews>0){ ?>   
 
    <div class="article">
    <?php do { ?>
    <p><a href="news_detail.php?id=<?php echo $row_RecAllNews['d_id']; ?>"><?php echo sortDate($row_RecAllNews['d_date'],''); ?> <?php echo $row_RecAllNews['d_title']; ?></a></p>
    <?php } while ($row_RecAllNews = mysql_fetch_assoc($RecAllNews)); ?>
        <!--<p><a href="javascript:;">20150811 番仔挖烏魚子介紹</a></p>
        <p><a href="javascript:;">20150511 鮪魚檢驗報告</a></p>
        <p><a href="javascript:;">20150511 明蝦檢驗報告</a></p>-->
    </div>
    
<?php } ?>
    
</li>
<?php } while ($row_RecNewsC = mysql_fetch_assoc($RecNewsC)); ?>
<!--<li>
    <div class="heading">海鮮 <img alt="" src="images/heading-arrow.png" height="9" width="10"></div>
    <div class="article">
        <p><a href="javascript:;">20150811 番仔挖烏魚子介紹</a></p>
        <p><a href="javascript:;">20150511 鮪魚檢驗報告</a></p>
        <p><a href="javascript:;">20150511 明蝦檢驗報告</a></p>
    </div>
</li>
<li>
    <div class="heading">美食 <img alt="" src="images/heading-arrow.png" height="9" width="10"></div>
    <div class="article">
        <p><a href="javascript:;">20150811 番仔挖烏魚子介紹</a></p>
        <p><a href="javascript:;">20150511 鮪魚檢驗報告</a></p>
        <p><a href="javascript:;">20150511 明蝦檢驗報告</a></p>
    </div>
</li>-->
                            
                            
</ul><!-- ul.content end -->
<?php } // Show if recordset not empty ?>                       
                        

					</li><!-- right end -->
				</ul>
			</div><!-- area2-left end -->

			<div class="area2-right">
            
            
<?php if ($totalRows > 0) { // Show if recordset not empty ?>

<ul class="news_area">

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
				  <div class="title"><span><?php echo dateTW($row_RecNews['d_date']); ?></span><?php echo $row_RecNews['d_title']; ?></div>
				  <div><a href="news_detail.php?id=<?php echo $row_RecNews['d_id']; ?>"><img src="<?php echo $row_RecNewsImage['file_link1'].'?'.(mt_rand(1,100000)/100000); ?>"></a></div>
				  <div class="more"><a href="news_detail.php?id=<?php echo $row_RecNews['d_id']; ?>"><span>more</span>．．．</a></div>
			  </li>
              
<?php } while ($row_RecNews = mysql_fetch_assoc($RecNews)); ?>
                    
			  <!--<li>
						<div class="title"><span>2015年8月11日</span>番仔挖烏魚子介紹</div>
						<div><a href="news_detail.php"><img src="images/news-list.png"></a></div>
						<div class="more"><a href="news_detail.php"><span>more</span>．．．</a></div>
					</li>-->
		  </ul>
<?php } // Show if recordset not empty ?>          
          
			</div><!-- area2-right end -->
		</div><!-- area2 end -->

	</div><!-- news-wrap end -->

	<?php include 'backtotop.php'; ?>
	<?php include 'footer.php'; ?>

</body>
</html>
<?php
mysql_free_result($RecNewsC);
?>
<script type="text/javascript">
	$(window).load(function  () {
		$(".heading").click(function  () {
			$(this).parent().find(".article").slideToggle();
			$(this).find("img").toggleClass("rotate");
		})
	})
</script>