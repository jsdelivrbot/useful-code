<script src="js/slick.min.js"></script>
<link rel="stylesheet" href="css/slick.css">
<link rel="stylesheet" href="css/slick-theme.css">
<!-- option -->
<script src="js/jquery.easing.1.3.js"></script>

<!-- reset outline -->
<style>
	.slick-slide, .slick-slide *{ outline: none !important; }
</style>

<!-- basic -->
<style>
	.eventsSliderWrap{
		position: relative;
		/*more space for overflow*/
		.slick-slide{
			margin-top: 10px;
			margin-bottom: 10px;
		}
	}
</style>

<script>
	$('.authorSliderList').slick({
		dots: false,
		infinite: true,
		speed: 500,
		prevArrow: ".authorPrev",
		nextArrow: ".authorNext",
		focusOnSelect: false,
		easing: 'easeInOutCubic'
	});
</script>

<!-- pager dot -->
<style>
	.ryder-dots{
		text-align: center;
		position: absolute;
		bottom: 20px;
		left: 50%;
		transform: translateX(-50%);
		-webkit-transform: translateX(-50%);
		li{
			display: inline-block;
			vertical-align: top;
			width: 9px;
			height: 9px;
			background-color: #fff;
			border-radius: 50%;
			.mr(20px);
			button{display: none;}
			cursor: pointer;
		}
		.slick-active{background-color: #d82154;}
	}
</style>

<div class="banner-slick">
	<div class="banner">
		<img src="images/banner-cover.png" class="cover">
		<img src="images/banner-1.jpg" class="banner-img">
		<img src="images/banner-words-1.png" class="words" width="431">
	</div>
	<div class="banner">
		<img src="images/banner-cover.png" class="cover">
		<img src="images/banner-2.jpg" class="banner-img">
		<img src="images/banner-words-2.png" class="words" width="438">
	</div>
</div>

<script>
	$('.banner-slick').slick({
		autoplay: true,
		fade: true,
		speed: 800,
		arrows: false,
		dots: true,
		dotsClass: 'ryder-dots'
	});
</script>


<!-- 兩個連動 -->
<style>
	/*需要reset outline*/
	.slick-slider{margin-bottom: 0; *:focus{outline: 0;}}
	/*active css這樣用*/
	.slick-current{opacity: 1;}
</style>

<ul class="for-slider-show">
	<li><img src="images/new-rooms-detail-slider-1.png"></li>
	<li><img src="images/new-rooms-detail-slider-1.png"></li>
	<li><img src="images/new-rooms-detail-slider-1.png"></li>
</ul> <!-- for-slider-show end -->

<div class="new-rooms-detail-slider-wrap">
	<ul class="new-rooms-detail-slider">
		<li><img src="images/detail-pager-1.png"></li>
		<li><img src="images/detail-pager-2.png"></li>
		<li><img src="images/detail-pager-3.png"></li>
	</ul><!-- new-rooms-detail-slider end -->
	<div id="detail-prev"><img src="images/new-rooms-detail-prev.png" width="43"></div>
	<div id="detail-next"><img src="images/new-rooms-detail-next.png" width="43"></div>
</div><!-- new-rooms-detail-slider-wrap end -->


<script>
	$('.for-slider-show').slick({
		asNavFor: '.new-rooms-detail-slider',
		speed: 500,
		arrows: false,
		dots: false,
	});
	$('.new-rooms-detail-slider').slick({
		dots: false,
		infinite: true,
		speed: 500,
		slidesToShow: 1,
		centerMode: true,
		variableWidth: true,
		prevArrow: "#detail-prev",
		nextArrow: "#detail-next",
		asNavFor: '.for-slider-show',
		focusOnSelect: true
	});
</script>