<?php
require_once 'Connections/connect2data.php';
mysql_select_db($database_connect2data, $connect2data);

$query_RecKeywords = sprintf("SELECT * FROM data_set
  WHERE d_class1='keywords' AND d_active='1'
  ORDER BY d_sort ASC");
$RecKeywords = mysql_query($query_RecKeywords, $connect2data) or die(mysql_error());
$row_RecKeywords = mysql_fetch_assoc($RecKeywords);
$totalRows_RecKeywords = mysql_num_rows($RecKeywords);
?>

<?php if ($totalRows_RecKeywords): ?>
	<meta name="Kyewords" Content="<?= $row_RecKeywords['d_class2'] ?>">
	<meta name="Description" content="<?= $row_RecKeywords['d_class3'] ?>">
<?php else: ?>
	<meta name="Kyewords" Content="Intelligent酵素牙膏 Toothpaste, 口腔環保系列Oral Care, 牙周病,酵素,矯正牙齒,蛀牙,嘴破,口腔癌初期症狀,牙齒美白,牙齒痛,口腔癌,口臭,口腔潰瘍,漱口水,固齒器,乳鐵蛋白,生物類黃酮,膠原蛋白,珍珠,素葡萄胺,葉黃素,山桑子,檸檬">
	<meta name="Description" content="牙周病,酵素,矯正牙齒,蛀牙,嘴破,口腔癌初期症狀,牙齒美白,牙齒痛,口腔癌,口臭,口腔潰瘍,漱口水,固齒器,乳鐵蛋白,生物類黃酮,膠原蛋白,珍珠,素葡萄胺,葉黃素,山桑子,檸檬">
<?php endif ?>


<!-- 參考 (og tag + itemprop...etc.)-->
http://www.oxxostudio.tw/articles/201406/social-meta.html


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta charset="utf-8">
<title>title</title>

<meta name="viewport" content="width=device-width; initial-scale=1.0" />

<link rel="shortcut icon" href="images/fav.png" type="image/x-icon">
<link rel="apple-touch-icon" href="img/fav.png">
<link rel="apple-touch-icon" sizes="76x76" href="img/fav.png">
<link rel="apple-touch-icon" sizes="120x120" href="img/fav.png">
<link rel="apple-touch-icon" sizes="152x152" href="img/fav.png">

<link rel="author" href="mailto:ts01173166@gmail.com">
<link rel="author" href="tel:+886987710168">

<meta name="robots" content="all">
<meta name="Author" content="作者姓名">
<meta name="company" content="公司名稱">
<meta name="copyright" content="本網頁著作權屬XXX, All Rights Reserved">
<meta name="date" content="15-06-2015">
<meta name="Keywords" Content="關鍵詞1, 關鍵詞2, 關鍵詞3,">
<meta name="Description" content="網站簡述">
<meta name="Distribution" content="網站發佈地">
<meta name="URL" content="http://injerry.pixnet.net">

<meta name="og:title" content="網頁工程師與設計師的溝通">
<meta name="og:site_name" content="網頁工程師與設計師的溝通">
<meta name="og:url" content="http://likmeetup.goods-design.com.tw/">
<meta name="og:image" content="http://likmeetup.goods-design.com.tw/fbshare.jpg">
<meta name="og:description" content="很好設計於LIKMEETUP2016.5.15講述網頁工程師與設計師的溝通以及設計師注重的細節">
<meta name="og:type" content="website">

<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@artem_tabalin">
<meta name="twitter:title" content="Demos - jsSocials">
<meta name="twitter:description" content="Simple Social Network Sharing Plugin">
<meta name="twitter:image" content="">

<!-- <link rel="stylesheet/less" type="text/css" href="style_ryder.less"> -->
<!-- <script src="js/less-1.3.0.min.js" type="text/javascript"></script> -->

<!-- 關閉滑鼠移到圖片上方，出現儲存圖片的相關控制選單。 -->
<meta http-equiv="imagetoolbar" content="no" />

<!-- 自動更新 -->
<meta HTTP-EQUIV="refresh" CONTENT="15">

<!-- 轉址服務 -->
<meta HTTP-EQUIV="refresh" CONTENT="3;URL=http://blog.huayuworld.org/hcc928">

<!-- 也就是網頁沒有記憶功能。是用於設定禁止流覽器從本地機的緩存中調閱頁面內容，設定後一旦離開網頁就無法從Cache中再調出。 -->
<meta HTTP-EQUIV="Pragma" CONTENT="no_cache">

<!-- 強制頁面在當前視窗中以獨立頁面顯示，可以防止自己的網頁被別人當作一個frame頁調用。 -->
<meta HTTP-EQUIV="windows-Target" CONTENT="_top">


<!-- 設為0代表不暫存該網頁  說明：當瀏覽器cache中的網頁過期，才會到伺服器上重新下載，否則會顯示暫存的網頁，Expired==>網頁終止期限 -->
<meta NAME="expired" content="Mon, 01 jan 2010 00:00:00 GMT">
<meta http-equiv="expires" content="0" />

<!-- 重訪時間： -->
<meta name="revisit-after" CONTENT="1 days" >
指示搜索引擎一天來一次,不過搜索引擎可未必聽你的哦。

<!-- meta換頁特效 -->
<!-- X-UA-Compatible設置IE兼容模式 -->
自己google啦耖
