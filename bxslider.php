<script src="js/jquery.bxslider/jquery.bxslider.js"></script>
<link rel="stylesheet" type="text/css" href="js/jquery.bxslider/jquery.bxslider.css">

<!-- fullscreen -->
<style>
	.ryder-sliderWrap{
		width: 100%;
		height: 100%;

		.ryder-slider{
			width: 100%;
			height: 100%;
			li{
				width: 100%;
				height: 100%;
				background-repeat: no-repeat;
				background-size: cover;
				position: relative;
			}
		}

		.bx-wrapper{
			width: 100%;
			height: 100%;
			margin-bottom: 0;
			.bx-viewport{height: 100% !important;}
		}
	}
</style>

<div class="ryder-sliderWrap">
	<ul class="ryder-slider">
		<li style="background-image: url(images/slider-01.jpg);"></li>
	</ul>
</div>


<!-- 調整位置似乎要包個父元素然後訂width height...有點鳥 -->
<ul class="bxslider-banner">
	<li>
		<div class="bb-ch">都市旅行</div>
		<div class="bb-en">NEW STANDARD<BR>FOR<BR>CITY TRAVELLER</div>
		<div class="bb-ch">快捷便利</div>
	</li>
	<li>
		<div class="bb-ch">都市旅行</div>
		<div class="bb-en">NEW STANDARD<BR>FOR<BR>CITY TRAVELLER</div>
		<div class="bb-ch">快捷便利</div>
	</li>
	<li>
		<div class="bb-ch">都市旅行</div>
		<div class="bb-en">NEW STANDARD<BR>FOR<BR>CITY TRAVELLER</div>
		<div class="bb-ch">快捷便利</div>
	</li>
</ul>


<div id="sliderPrev"></div>
<div id="sliderNext"></div>

<div id="bxPager">
	<a data-slide-index="0" href=""></a>
	<a data-slide-index="1" href=""></a>
	<a data-slide-index="2" href=""></a>
</div>



<script>

	$('.bxslider-banner').bxSlider({
		auto: true,
		mode: 'fade',
		slideWidth: 324,
		slideMargin: 25,
		minSlides: 1,
		maxSlides: 3,
		moveSlides: 1,
		pagerCustom: '#bxPager',
		prevSelector: '#sliderPrev',
		nextSelector: '#sliderNext',
		prevText: '<img src="images/slider-prev.png" width="44">',
		nextText: '<img src="images/slider-next.png" width="44">',
		onSlideBefore: function () {
			var current = slider.getCurrentSlide();
			$(".banner").vegas('jump' , current);
		}
	});

	$(".banner").on("vegaswalk",function () {
		var t=$(".banner").vegas('current');
		slider.goToSlide(t);
	})

</script>