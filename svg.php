<!-- How SVG Line Animation Works -->
https://css-tricks.com/svg-line-animation-works/

<!-- CSS + SVG stroke 動態描繪 -->
http://wcc723.github.io/svg/2014/06/15/svg-css-stroke-animation/

<!-- SVG Animation 動態描繪 -->
http://www.chming.tw/blog/2014/09/21/svg-animate-paint/

<!-- 不錯用plugin -->
https://github.com/maxwellito/vivus

<script src="js/vivus.min.js"></script>

<script>
	// obturateur3 是svg id
	var test=new Vivus('obturateur3', {
		duration: 200,
		start: "manual"
	});
	$("#obturateur3").mouseenter(function  () {
		test.play();
	})
	$("#obturateur3").mouseleave(function  () {
		test.reset();
	})
</script>


<!-- tweenMax -->
<script src="js/TweenMax.min.js"></script>

<style>
	.test{
		/*stroke: black;*/
		stroke-dasharray: 200%;
		stroke-dashoffset: 200%;
	}
</style>

<svg class="test" width="50" viewBox="0 0 14 25" xmlns="http://www.w3.org/2000/svg"><path d="M1 15.6s5.8 7.7 6.2 8.1c.5.6-.2-3.6 0-6.7v-16m6.1 14.8s-5.1 7.3-6.1 7.9" stroke-width="1.8" fill="none"</path></svg>

<script>
	// 取得準確長度
	var path = document.getElementById("svg-1").querySelector('path');
	var length = path.getTotalLength();

	TweenMax.to($(".svgAnimated4"), 3.5, {
		"stroke-dashoffset": 0,
		delay: 3,
		ease: Power1.easeOut,
		onComplete: function  () {
			$(".firstPage ul.words li").eq("3").css("opacity",1);
			$(".firstPage").css("-webkit-filter","grayscale(0%)");
		}
	});

	$(".test").mouseenter(function  () {
		_svg("red");
	})
	$(".test").mouseout(function  () {
		_svg("black");
	})

	function _svg (color) {
		TweenMax.fromTo($(".test"), 1.5, {
			"stroke-dashoffset": "200%",
		}, {
			"stroke-dashoffset": 0,
			"stroke": color
		});
	}
</script>