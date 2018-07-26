<!--========================================
=            skrollr (手機版超廢)           =
=========================================-->
https://github.com/Prinzhorn/skrollr

<!-- cheatsheet -->
https://ihatetomatoes.net/skrollr-cheatsheet/

<script src="https://cdnjs.cloudflare.com/ajax/libs/skrollr/0.6.30/skrollr.min.js"></script>

<div class="head-area"
data-anchor-target=".pic-container"
data-top="top: 3%; opacity: 1;"
data-center-bottom="top: 92%; opacity: 0;"
data-smooth-scrolling="off"></div>

<script>
	skrollr.init({
		forceHeight: false  //不然body會有一個高
	})
</script>


<!--=================================
=            ScrollMagic            =
==================================-->
http://scrollmagic.io/examples/index.html

<!-- cheatsheet -->
https://ihatetomatoes.net/wp-content/uploads/2016/07/ScrollMagic-CheatsheetV1.pdf


<!-- 基本引用(順序很講究低) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.3/ScrollMagic.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/animation.gsap.min.js"></script>

<!-- dubug用 (加在後面) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/debug.addIndicators.min.js"></script>

<!-- for preload  延時觸發  重點要加 controller.update(true); -->
<script>
	var controller = new ScrollMagic.Controller();
	controller.enabled(false);

	Pace.on("update", function(percent){
		$(".preloadWrap").css({
			width: percent + '%'
		})
	});

	Pace.on("done", function(percent){
		$("body").removeClass("invisible")
		$(".preloadWrap .logo").animate({
			opacity: 1
		}, 800, preloadend)
	});

	function preloadend () {
		TweenMax.to($(".preloadWrap"), 1, {
			left: "100%",
			onComplete: function() {
				$(".preloadWrap .logo").hide()
				controller.enabled(true);
				controller.update(true);
			}
		});
	}
</script>

<!-- 滾動換圖 -->
<script>
	var rolling = {p: 0}

	var tween = TweenMax.to(rolling, 3, {
		p: 11,
		roundProps: "p",
		ease: Power0.easeNone,
		onUpdate() {
			$("#rolling li").eq(rolling.p).show().siblings().hide();
		}
	})

	var oy = $(".products-info-area.is-wedding").offset().top - $(window).height();

	var controller = new ScrollMagic.Controller();
	var myScene = new ScrollMagic.Scene({
		duration: 1000,
		triggerElement: '.productsDetailWrap',
		offset: oy,
		triggerHook: 0.3,
	}).addTo(controller)
	.setPin('.productsDetailWrap')
	.setTween(tween)
	// .addIndicators({
	// 	name: 'wedding',
	// });
</script>

<!-- note -->
set pin 圖片壞掉可以試試改 z-index 或小位移一下