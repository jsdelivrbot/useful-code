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

<!--============================
=            字體大小跑掉            =
=============================-->
<style>
	html,body{
		-webkit-text-size-adjust:100%;
	}
</style>

<!--==========================================
=            點擊一下=hover  兩下=click            =
===========================================-->
<li data-click="0"></li>

<script>
	$(".works-list li").click(function () {
		if ($(this).data("click")==0) {
			$(this).siblings().data("click",0);
			$(this).trigger("mouseover");
			$(this).data("click", $(this).data("click") + 1);
			return false;
		}
	})
</script>

