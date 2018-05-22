<!--===================================
=            綜合可擴充自訂            =
====================================-->
https://github.com/markdalgleish/stellar.js

<script src="https://cdn.jsdelivr.net/npm/jquery.stellar@0.6.2/jquery.stellar.js"></script>

<script>
	$.stellar({
		responsive: true,
		positionProperty: 'transform',
		showElement(el) {},
		hideElement(el) {}
	})
</script>

<!--===============================================
=            background image parallax            =
================================================-->
https://github.com/pixelcog/parallax.js/

<script src="https://cdn.jsdelivr.net/parallax.js/1.4.2/parallax.min.js"></script>

<section class="contact-banner" data-parallax="scroll" data-image-src="images/index-banner.jpg"></section>

<!--===============================================
=            use requestAnimationFrame            =
================================================-->
https://github.com/alumbo/jquery.parallax-scroll

<script src="js/jquery.parallax-scroll.js"></script>

<div class="deco" data-parallax='{"y" : 230}'><img src="images/tortelloni-pic.png"></div>


<!--===================================
=            scss parallax            =
====================================-->
http://codepen.io/scottkellum/pen/bHEcA


<!--==============================
=            scrollit            =
===============================-->
https://github.com/rorymurphy/scrollit?utm_source=jquer.in&utm_medium=website&utm_campaign=content-curation
<script src="js/scrollit.js"></script>

<div class="news-detail-leaf-1">
	<img src="images/news-detail-leaf-1.png" width="201" data-parallax="0.4" style="position: relative;">
</div>

or

<script>
	$('.ia-article').parallax({
		axis: 'y',
		attr: 'top',
		speed: -0.1
	});

	$('.ia-article').tween({
		start: 0,
		end: $(window).height() * 0.4,
		easing: 'easeInCubic',
		styles: {
			'opacity': {
				startValue: '0',
				endValue: '1'
			}
		}
	});
</script>

<!-- with waypoint -->
<!--
	有改js
	1. 回傳值 (line 730, 734)
	2. load完先觸發現在的狀態 (line 748)
-->
<script>
	$(".ia-article").waypoint({
		position: $(window).height() * -0.9,
		down: function(el){
			$(el).stop(true).animate({
				opacity: 1
			}, 600)
		},
		up: function(el){
			$(el).stop(true).animate({
				opacity: 0
			}, 600)
		}
	});
</script>