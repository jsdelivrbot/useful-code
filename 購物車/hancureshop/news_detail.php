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
<?php require_once('Connections/session.initialize.php'); ?>
<?php require_once('js/fun_changeStr.php'); ?>
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
	<?php $now="news"; ?>
	<?php include('topmenu.php'); ?>

	<div class="news-detail-wrap">
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
				<div class="title"><span><?php echo dateTW($row_RecNews['d_date']); ?></span><?php echo $row_RecNews['d_title']; ?></div>
				<div class="content">
                
<?php if ($totalRows_RecImage > 0) { // Show if recordset not empty ?>
<img src="<?php echo $row_RecImage['file_link1'].'?'.(mt_rand(1,100000)/100000); ?>">
<br><br>
<?php } // Show if recordset not empty ?>
					<!--<img src="images/news-list.png">
					<BR><BR>
					<img src="images/news-list2.png">
					<BR><BR>-->
                    
                    
                    <?php echo str_replace('<img src="../source', '<img src="source', $row_RecNews['d_content']); ?>
                    
					<!--『合發』之後的每艘船，川爸都取名叫『新合發』。這三個字也是身為川爸子女的我們童年最期望看到的。小時候的我們都瘦的像猴子，因為我們有小朋友的通病：挑食。在資源匱乏的小漁村，除了雜貨店的『乖乖』和『科學麵』，能吃的東西就只有魚。魚要好吃，就要新鮮。川爸為了讓我們不挑食，只好絞盡腦汁提供最『青』的魚。先換艘馬力大一點的船吧！『合發』雖然輕薄短小又具有歷史意義，但它的速度實在有點慢。再『青』的魚透過引擎冒黑煙的『合發 』長時間運送，到我們餐桌時也『青』不起來了。-->
				</div>
			</div><!-- area2-right end -->
		</div><!-- area2 end -->

	</div><!-- news-detail-wrap end -->

	<?php include 'backtotop.php'; ?>
	<?php include 'footer.php'; ?>

</body>
</html>
<?php
mysql_free_result($RecNews);
?>
<script type="text/javascript">
	$(window).load(function  () {
		$(".heading").click(function  () {
			$(this).parent().find(".article").slideToggle();
			$(this).find("img").toggleClass("rotate");
		})
	})
</script>