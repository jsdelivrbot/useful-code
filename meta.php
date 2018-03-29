<?php
require_once 'Connections/connect2data.php';
mysql_select_db($database_connect2data, $connect2data);

$query_RecKeywords = sprintf("SELECT * FROM data_set
	WHERE d_class1='keywords' AND d_active='1'
	ORDER BY d_sort ASC");
$RecKeywords = mysql_query($query_RecKeywords, $connect2data) or die(mysql_error());
$row_RecKeywords = mysql_fetch_assoc($RecKeywords);
$totalrows_RecKeywords = mysql_num_rows($RecKeywords);
?>

<?php if ($totalrows_RecKeywords): ?>
	<meta name="keywords" content="<?= $row_RecKeywords['d_class2'] ?>">
	<meta name="description" content="<?= $row_RecKeywords['d_class3'] ?>">
<?php else: ?>
	<meta name="keywords" content="intelligent酵素牙膏 toothpaste, 口腔環保系列oral care, 牙周病,酵素,矯正牙齒,蛀牙,嘴破,口腔癌初期症狀,牙齒美白,牙齒痛,口腔癌,口臭,口腔潰瘍,漱口水,固齒器,乳鐵蛋白,生物類黃酮,膠原蛋白,珍珠,素葡萄胺,葉黃素,山桑子,檸檬">
	<meta name="description" content="牙周病,酵素,矯正牙齒,蛀牙,嘴破,口腔癌初期症狀,牙齒美白,牙齒痛,口腔癌,口臭,口腔潰瘍,漱口水,固齒器,乳鐵蛋白,生物類黃酮,膠原蛋白,珍珠,素葡萄胺,葉黃素,山桑子,檸檬">
<?php endif ?>


<!-- 參考 (og tag + itemprop...etc.)-->
http://www.oxxostudio.tw/articles/201406/social-meta.html


<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<meta charset="utf-8">
<title>title</title>

<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<link rel="shortcut icon" href="images/fav.png" type="image/x-icon">
<link rel="apple-touch-icon" href="img/fav.png">
<link rel="apple-touch-icon" sizes="76x76" href="img/fav.png">
<link rel="apple-touch-icon" sizes="120x120" href="img/fav.png">
<link rel="apple-touch-icon" sizes="152x152" href="img/fav.png">

<link rel="author" href="mailto:ts01173166@gmail.com">
<link rel="author" href="tel:+886987710168">

<meta name="robots" content="all">
<meta name="author" content="作者姓名">
<meta name="company" content="公司名稱">
<meta name="copyright" content="本網頁著作權屬xxx, all rights reserved">
<meta name="date" content="15-06-2015">
<meta name="keywords" content="關鍵詞1, 關鍵詞2, 關鍵詞3,">
<meta name="description" content="網站簡述">
<meta name="distribution" content="網站發佈地">
<meta name="url" content="http://injerry.pixnet.net">

<meta property="og:title" content="::: PIPILOLO ::::"></meta>
<meta property="og:type" content="website"></meta>
<meta property="og:description" content="::: PIPILOLO ::::"></meta>
<meta property="og:image" content="http://paul.ryderisgood.com/images/fav.png"></meta>
<meta property="og:url" content="http://paul.ryderisgood.com/"></meta>

<meta name="twitter:card" content="summary">
<meta name="twitter:url" content="<?= 'http://'.$_SERVER['http_host'].$_SERVER['request_uri'] ?>">
<meta name="twitter:title" content="demos - jssocials">
<meta name="twitter:description" content="simple social network sharing plugin">
<meta name="twitter:image" content="<?= 'http://'.$_SERVER['http_host'].$_SERVER['request_uri'] ?>images/share-image.png">

<!-- <link rel="stylesheet/less" type="text/css" href="style_ryder.less"> -->
<!-- <script src="js/less-1.3.0.min.js" type="text/javascript"></script> -->

<!-- 手機禁縮放 -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<!-- ie可能不見得有效 -->
<meta http-equiv="pragma" content="no-cache">
<!-- 設定成馬上就過期 -->
<meta http-equiv="expires" content="0">
<!-- 與第一行是同樣的作用 -->
<meta http-equiv="cache-control" content="no-cache">
# 其參數可以用這些方式設定：
#http 1.1. allowed values = public | private | no-cache | no-store.
#public - may be cached in public shared caches
#private - may only be cached in private cache
#no-cache - may not be cached
#no-store - may be cached but not archived
<!-- 常見此寫法 -->
<meta http-equiv="expires" content="mon, 22 jul 2002 11:12:01 gmt">

<!-- 關閉滑鼠移到圖片上方，出現儲存圖片的相關控制選單。 -->
<meta http-equiv="imagetoolbar" content="no" />

<!-- 自動更新 -->
<meta http-equiv="refresh" content="15">

<!-- 轉址服務 -->
<meta http-equiv="refresh" content="3;url=http://blog.huayuworld.org/hcc928">

<!-- 強制頁面在當前視窗中以獨立頁面顯示，可以防止自己的網頁被別人當作一個frame頁調用。 -->
<meta http-equiv="windows-target" content="_top">

<!-- 重訪時間： -->
<meta name="revisit-after" content="1 days" >
指示搜索引擎一天來一次,不過搜索引擎可未必聽你的哦。

<!-- meta換頁特效 -->
<!-- x-ua-compatible設置ie兼容模式 -->
自己google啦耖
