<!-- Ryder 自製版 -->
<div class="link">
    <a href="<?= $url ?>" data-share="facebook">
        <svg x="0px" y="0px" width="33.5px" height="33.5px" viewBox="0 0 33.5 33.5"></svg>
    </a>
    <a href="<?= $url ?>" data-share="line">
        <svg x="0px" y="0px" width="33.5px" height="33.5px" viewBox="0 0 33.5 33.5"></svg>
    </a>
</div>

<script>
	$("[data-share]").each((i, el) => {
		var type = el.dataset.share
	    $(el).click(function(e) {
	        e.preventDefault();

	        var winHeight = 200;
	        var winWidth = 450;
	        var winTop = (screen.height / 2) - (winHeight / 2);
	        var winLeft = (screen.width / 2) - (winWidth / 2);
	        var url = $(this).attr("href");

	        if(type == "facebook") {
	            window.open('https://www.facebook.com/sharer/sharer.php?u=' + url, 'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight);
	        } else if(type == "twitter") {
	            window.open('https://twitter.com/share?url=' + url, 'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight);
	        } else if(type == "pinterest") {
	            window.open('https://www.pinterest.com/pin/create/button/?url=' + url, 'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight);
	        } else if(type == "googleplus") {
	            window.open('https://plus.google.com/share?url=' + url, 'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight);
	        } else if(type == "linkedin") {
	            window.open('https://www.linkedin.com/cws/share?url=' + url, 'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight);
	        } else if(type == "weibo") {
	            window.open('https://service.weibo.com/share/share.php?url=' + url, 'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight);
	        } else if(type == "line") {
	            window.open('https://line.naver.jp/R/msg/text/?' + url);
	        }
	    });
	});
</script>

<!-- 人工改良版 popup小視窗 -->
<a href="<?= $url ?>" class="share-to-fb">
	<div class="fb"><img src="images/fb.png"></div>
</a>

<script src="js/sharing.jquery.js"></script>

<script>
	$(".share-to-fb").sharing("facebook");
</script>

<!-- shareaholic 比較完整 全部的都有 -->
https://shareaholic.com/

<!-- jsSocials (可自訂圖) -->
http://js-socials.com/start-using/

<!-- 要圖片需載入font-aweason -->
<!-- 必要 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jsSocials/1.5.0/jssocials.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsSocials/1.5.0/jssocials.min.css">

<!-- theme 擇一 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-flat.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-classic.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-minima.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-plain.css">

<!-- 先用 ul>li 排好  再把li刪除 ul改div -->
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
$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
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