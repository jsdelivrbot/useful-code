<!-- shareaholic 比較完整 全部的都有 -->
https://shareaholic.com/



<!-- jsSocials (可自訂圖) -->
http://js-socials.com/start-using/

<!-- 要圖片需載入font-aweason -->
<!-- 必要 -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.min.js"></script>
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.css" />

<!-- theme 擇一 -->
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-flat.css" />
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-classic.css" />
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-minima.css" />
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-plain.css" />

<script>
	$(".socialList").jsSocials({
		shareIn: "popup",
		showLabel: false,
	    showCount: false,
		shares: [{
			share: "googleplus",
			css: "social-custom",
			logo: "images/google@2x.png"
		}, {
			share: "twitter",
			css: "social-custom",
			logo: "images/twiter@2x.png"
		}, {
			share: "facebook",
			css: "social-custom",
			logo: "images/fb@2x.png"
		}]
	});
</script>



<!-- 人工 old school -->
<?php
$url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
?>

<meta property="og:title" content="<?php echo $row_Recwork['d_title']; ?>" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?= $url ?>" />
<meta property="og:image" content="http://hancure.goods-design.com.tw/images/toplogo-index.png" />
<meta property="og:description" content="<?php echo $row_Recwork['content']; ?>" />

<!-- fb -->
<a target="blank" href="http://www.facebook.com/sharer/sharer.php?u=<?= $url ?>"><img src="images/detaionicon-04.png" width="26"></a>

<!-- twitter -->
<a target="blank" href="http://twitter.com/share?url=<?= $url ?>"><img src="images/detaionicon-03.png" width="26"></a>

<!-- pin it -->
<a target="blank" href="https://www.pinterest.com/pin/create/button/?url=<?= $url ?>"><img src="images/detaionicon-05.png" width="26"></a>

<!-- line (手機按才有用)-->
<a target="blank" href="http://line.naver.jp/R/msg/text/?<?= $url ?>"><img src="images/detaionicon-02.png" width="26"></a>