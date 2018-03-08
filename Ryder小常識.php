<!--===========================================
=            delay mouseover enevt            =
============================================-->
<script>
	var delay = 500;
	var timer;

	$(".regist-nav li").on("mouseover", function () {
		clearTimeout(timer)
		$(this).addClass("current").siblings().removeClass("current")
		timer = setTimeout(() => {
			$('.registSlider').slick('slickGoTo', $(this).index())
		}, delay);
	})
</script>

<!--====================================================
=           jquery 的 Deferred 就類似 promise            =
=====================================================-->
<script>
	function runAsync() {
		let def = $.Deferred();

		setTimeout(function() {
			def.resolve('111');
		}, 2000);

		return def;
	}

	function runAsync2() {
		let def = $.Deferred();

		setTimeout(function() {
			def.resolve('222');
		}, 1000);

		return def;
	}

	runAsync().then(function(val){
	    console.log(val)
	    return runAsync2();
	}).then(function(val){
	    console.log(val)
	    console.log('done')
	})
</script>

<!--========================================
=            firefox use filter            =
=========================================-->
<style>
	.element{
		-webkit-filter: url("#filter");
		filter: url("/#filter");
		/*這個斜線在firefox很重要*/
	}
</style>

<!--===========================================
=            es6新招宣告 0~n array            =
============================================-->
<script>
	let exposure_random = Array.from(new Array(10), (x,i) => i + 1);

	// 牛逼
	let exposure_random = [...Array(10).keys()];
</script>

<!--===============================================
=            sublime 使用regex各種匹配            =
================================================-->
1、在javascript下正確的\x4e00-\x9fa5並不完全適合php中文正則表達式；
2、匹配中文全角字符的正則:   ^[\x80-\xff]*^/  ；
3、GB2312、漢字、字母、數字、下劃線正則表達式：[".chr(0xa1)."-".chr(0xff)."A-Za-z0-9_]+；
4、UTF-8漢字、字母、數字、下劃線、正則表達式：[\x{4e00}-\x{9fa5}A-Za-z0-9_]+/u，注意x4e00與x9fa5需要用{}把x後面的字符包括起來！
5、使用鍵盤上的特殊符號（包括空格）、字母、數字： /[a-z0-9\x00-\x2F\x3A-\x40\x5B-\x60\x7B-\xFF]{6,15}/iu，注意u。在javascript上也可以，在頁面上charset=utf-8。 /[a-z0-9\x00-\x2F\x3A-\x40\x5B-\x60\x7B-\xFF]{6,15}/ig
實在記不起這些特殊符號的八進制\x表示：/[a-z0-9~`!@#$%^&*()_\\+=\/\.,<>?;\'\-\"|\[\]{}\s\:]{6,15}/iu

<!-- lock scrollbar -->
<script>
	function fancy_open() {
		$("body").css({
		    'overflow': 'hidden',
		    'margin-right': '17px',
		});
	}

	function fancy_close() {
		$("body").css({
		    'overflow': 'initial',
		    'margin-right': '0',
		});
	}
</script>

<!-- 開發專用 - 快速生成圖片 -->
https://dummyimage.com/
https://fakeimg.pl/
http://lorempixel.com/

<!--================================
=            robots.txt            =
=================================-->
https://seo.palada.com.tw/15.html

<!--=======================================
=            楚止選取 + 鎖右鍵            =
========================================-->
<style>
	body{
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
	}
</style>

<script>
	$(document).bind("contextmenu", function(event) {
		return false;
	});
</script>

<!--===================================================
=            find & replace exclude folder            =
====================================================-->
-*/sass/*,-*/stylesheets/*

<!--============================================================
=            解決手機版 font-size 小於16px會自動放大           =
=============================================================-->
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />


<!--====================================================
=            find找不到第一層，用filter即可            =
=====================================================-->
<script>
	$.ajax({
		url: "topmenu.php",
		type: "GET",
		success: function(res){
			$(res).filter(".mobile-topmenuWrap").addClass("is-index").appendTo($("body"))
		},
		complete: function () {}
	})
</script>

<!--=================================
=            sftp ignore            =
==================================-->
,"\\.cache","/sass/","/jade/","/pug/","/vue/","/react/","\\.css.map","/.sass-cache/","/node_modules/","\\.zip","\\.rar","/public/","\\.rb","\\.config"

,"/Connections/","/upload_image/","/upload_file/","/thumbs/","/source/"

<!-- linode -->
,"\\.cache","\\.css.map","/.sass-cache/","/node_modules/","\\.zip","\\.rar","/public/","\\.rb","\\.config"

<!--=============================================
=            iphone 選單滿版需要空間            =
==============================================-->
<div class="forspace" style="height: 69px;"></div>

<!--==============================
=            fb清快取            =
===============================-->
<!-- Facebook建議網頁的圖片至要有 600×315 的大小, 最佳尺寸是1200×628 -->
https://developers.facebook.com/tools/debug/sharing/

<!--======================================
=            弧度与角度的转换            =
=======================================-->
弧度：radians = degreens * Math.PI / 180
角度：degrees = radians * 180 / Math.PI

<!--=========================================
=            改變this or $.proxy()          =
==========================================-->
http://andyyou.logdown.com/posts/233010-understanding-javascript-functionprototypebind

<script>
	function Ryder3dParticle(option) {
		var requestanimation = null;

		this.UpdateParticles = function () {
		    canvas_ctx.clearRect(0, 0, canvas.width, canvas.height);
		    for (var index in particles) {
		        particles[index].Move(_m_angleX, _m_angleY);
		        DrawParticle(particles[index]);
		    }

		    requestanimation = window.requestAnimationFrame(this.UpdateParticles.bind(this));
		}
	}
</script>

<!--==================================
=            圓形角度計算            =
===================================-->
http://www.zhangxinxu.com/wordpress/2012/09/css3-3d-transform-perspective-animate-transition/

<!--================================
=            找顏色好用            =
=================================-->
color.hailpixel.com

<!--===================================
=            regex線上測試            =
====================================-->
https://regex101.com/

<!--====================================
=            世上牛人那麼多            =
=====================================-->
http://supperjet.github.io/
http://www.dengzhr.com/category/js/page/2

<!--===================================
=            mysql顯示中文            =
====================================-->
http://j796160836.pixnet.net/blog/post/27937262-%5Bmysql%5D-%E8%A7%A3%E6%B1%BA%E4%B8%AD%E6%96%87%E4%BA%82%E7%A2%BC%EF%BC%8C%E9%A0%90%E8%A8%AD%E7%B7%A8%E7%A2%BC%E6%94%B9%E7%82%BAutf-8%E8%A8%AD%E5%AE%9A

<!--============================================
=            酷酷的效果(那個橫躺的)            =
=============================================-->
http://www.w3cschool.cn/jquerygroup/qty419wl.html

<!--============================================================
=            bg image and color both (要用gradient)            =
=============================================================-->
<style>
	/*逗號很重要*/
	.element{
		background: linear-gradient(rgba(170,154,123,.6), rgba(170,154,123,.6)), url(images/newindex/regist-slider-1.jpg) center center / cover no-repeat;
	}
</style>

<!--==============================================
=            mobile input text shadow            =
===============================================-->
<style>
	input[type='text'], textarea{
		-webkit-appearance: none;
		-moz-appearance: none;
		appearance: none;
	}
</style>

<!--================================================
=            html5教學 包括canvas svg等            =
=================================================-->
http://techbrood.com/h5b2a?p=html-canvas-drawimage
<!-- 各種公式 -->
https://segmentfault.com/a/1190000006192477

<!--===========================================================
=            jquery some way instead of javascript            =
============================================================-->
http://youmightnotneedjquery.com/

<!--===============================================================================
=            git一些設定 (桌面右鍵 → setting → edit global .gitconfig)            =
================================================================================-->
[user]
	name = qwe123qa
	email = ts01173166@gmail.com
[core]
	quotepath = false
[gui]
	encoding = utf-8
[i18n "commit"]
	encoding = utf-8
[i18n]
	logoutputencoding = utf-8

<!--=============================================
=            find jquery plugin here            =
==============================================-->
http://123.w3cschool.cn/freejquery
https://codyhouse.co/
http://jquer.in/
http://www.unheap.com/
http://www.htmleaf.com/
http://www.jqueryrain.com/
http://www.jqueryscript.net/

<!--=====================================================
=            利用devTool尋找javascript event            =
======================================================-->
$._data(($0), 'events');

<!--==========================================
=            css animate callback            =
===========================================-->
<script>
	$(".element").on('transitionend webkitTransitionEnd mozTransitionEnd webkitTransitionEnd oTransitionEnd', function() {
		console.log("fin");
	});

	$(".element").on('animationend webkitAnimationEnd MSAnimationEnd oAnimationEnd', function() {
		console.log("fin");
	});
</script>

<!--====================================
=            jquery 強delay            =
=====================================-->
<script>
	var $rains=[
			$(".enter-rain-1"),
			$(".enter-rain-3"),
			$(".enter-rain-4"),
			$(".enter-rain-2"),
			$(".enter-rain-6"),
			$(".enter-rain-7"),
			$(".enter-rain-5"),
		];

	for (i = 0; i < $rains.length; i++) {
    	$rains[i].delay(delay*i).queue(function(next){
    	    if (Math.random()>0.6) {
    	    	$(this).addClass("rain-animate-left");
    	    }else{
    	    	$(this).addClass("rain-animate-top");
    	    }
    	    next();
    	});
	}
</script>

<!--=========================================
=            delete final string            =
==========================================-->
<script>
	var str=_el.text();
	str = str.substring(0,str.length - 1);
	_el.text(str);
</script>

<!--=================================================
=            tranform時border radius失效            =
==================================================-->
要設z-index: 1;

<!--============================================
=            css - 判斷是不是chrome            =
=============================================-->
<style>
	.ryderCustomLeft{
		height: 100%;
		position: absolute;
		top: 0;
		left: 0;
		background: url(../images/team/fancy-1.png) no-repeat;
		background-size: cover;

		// ie firefox
		width: 50%;
		animation: ryderSliderAnimate-left-not-chrome 0.7s;

		// chrome
		@supports (-webkit-appearance:none){
			width: 60%;
			-webkit-clip-path: polygon(0 0, 100% 0, 80% 100%, 0 100%);
			animation: ryderSliderAnimate-left 0.7s;
		}
	}
</style>

<!--==================================
=            防止氣泡事件            =
===================================-->
e.stopPropagation();

<!--======================================
=            行內元素左右對齊            =
=======================================-->
<style>
	ul{
		text-align: justify;
		&:after{
			content: '';
			width: 100%;
			height: 0;
			display: inline-block;
		}
		li{
			display: inline-block;
			vertical-align: middle;
		}
	}
</style>

<!--===============================================================
=            css fixed overflow: hidden 子元素顯示bug             =
================================================================-->
<style>
	overflow: hidden;
	backface-visibility: hidden;
</style>

<!--====================================
=            css @font face            =
=====================================-->
http://blog.gtwang.org/web-development/css-font-face/

<!--================================================
=            make yourself color scheme            =
==================================================-->
http://tmtheme-editor.herokuapp.com/#!/editor/local/3024%20(Night)


<!--=================================
=            less % - px            =
==================================-->

<style>
	width: calc(~'25% - 1px');
	width: calc(100% ~"-" @padding);
</style>

<!--============================================
=            解決inline-block space            =
=============================================-->

<script type="text/javascript">

	$('.shoppingNav').contents().filter(function() {
		return this.nodeType === 3;
	}).remove();

</script>

<!--=====================================
=            取得n以後的字串            =
======================================-->
<script>
	var _go = $(this).attr("class").slice(3);
</script>

<!--==========================================
=            jquery字串中用雙引號            =
===========================================-->
<script>
	var span="<span class=&carBlock&></span>";
	string = span.replace(/&/g, '"');
</script>

<!--====================================
=            用空格取代<br>            =
=====================================-->
<script>
	$(".section-head .en br").replaceWith(" ");
</script>


<!--========================================
=            js 字串 / 取代成 -            =
=========================================-->
<script>
	var mydate = new Date();
	var _date=mydate.toLocaleDateString();
	var re = /\//g;
	var result = _date.replace(re, "-");
	alert(result);
</script>

<!--==================================
=            js字串取數字            =
===================================-->

<script type="text/javascript">
	var openIndex = openingId.replace(/[^0-9]/ig, "");

	//取tag內容要先轉數字才可運算
	var t = parseInt(shadow.text()) + 1;
</script>

<!--=============================================================
=            解決fransform造成的模糊  (height的一半)            =
=============================================================-->

<style type="text/css">
	.parent{
		-webkit-font-smoothing: subpixel-antialiased;
		transform: translateZ(0) scale(1.0, 1.0);
	}
</style>

