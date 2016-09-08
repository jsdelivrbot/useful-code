<!--======================================
=            find plugin here            =
=======================================-->
http://jquer.in/
http://www.unheap.com/
http://www.jqueryrain.com/
http://www.jqueryscript.net/

<!--=====================================================
=            利用devTool尋找javascript event            =
======================================================-->
$._data(($0), 'events');

<!--========================================
=            delete final string            =
=========================================-->
<script>
	var str=_el.text();
	str = str.substring(0,str.length - 1);
	_el.text(str);
</script>
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
			contents: '';
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

<!--==========================================================
=            css fixed overflow: hidden 子元素顯示bug             =
===========================================================-->
<style>
	overflow: hidden;
	-webkit-backface-visibility: hidden;
	-moz-backface-visibility: hidden;
	backface-visibility: hidden;
</style>

<!--====================================
=            css @font face            =
=====================================-->
http://blog.gtwang.org/web-development/css-font-face/

<!--=====================================
=            mobile 鎖定滑動            =
======================================-->
<script>
	document.addEventListener("touchmove", function(event){
		event.preventDefault();
	}, false);
</script>

<!--=================================
=            偵測 iphone            =
==================================-->
<script>
	function isiPhone(){
		return (
			(navigator.platform.indexOf("iPhone") != -1) ||
			(navigator.platform.indexOf("iPod") != -1)
			);
	}
	if(isiPhone()){
		alert(1);
	}
</script>

<!--================================
=            神奇小教室            =
=================================-->

左邊用 float: left;
右邊用 display: inline-block;


<!--================================================
=            make yourself color scheme            =
==================================================-->

http://tmtheme-editor.herokuapp.com/#!/editor/local/3024%20(Night)

<!--==================================
=            jquery取網址            =
===================================-->
<!-- 內有plugin -->
http://blog.webgolds.com/view/198
<script>
	var _now= document.location.pathname.match(/[^\/]+$/)[0];    //index.php
</script>

<!--=======================================
=            tweenMax ease凸出去唷            =
========================================-->
<script>
	var tween = TweenMax.to($(".cupid"), 1, {
		ease: Back.easeOut.config(1.7)
	});
</script>

<!--===========================================
=            jquery after animated            =
============================================-->
<script>
	var effect=showid.fadeOut(500);

	$.when(effect).done(function() {
		// code here
	});
</script>

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
	var_go=$(this).attr("class").slice(3);
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
	var openIndex = openingId.replace(/[^0-9]/ig,"");

	//取tag內容要先轉數字才可運算
	var t=parseInt(shadow.text()) + 1;
</script>

<!--=====================================================
=            解決fransform造成的模糊  (height的一半)            =
=====================================================-->

<style type="text/css">
	.class{
		transform:translateZ(51px);
		-webkit-transform:translateZ(51px);
	}
</style>

