<script src="js/slick.js"></script>
<link rel="stylesheet" href="css/slick.css">
<link rel="stylesheet" href="css/slick-theme.css">
<!-- option -->
<script src="js/jquery.easing.1.3.js"></script>

<!-- reset outline -->
<style>
	.slick-slide, .slick-slide *{ outline: none !important; }
</style>

<style>
	/*active css這樣用*/
	.slick-current{
		opacity: 1;
	}

	/* center mode 的 active css 用這個*/
	.slick-center{
		.pic img{
			-webkit-transform: scale(1);
	        transform: scale(1);
		}
		.en, .ch{
			opacity: 1;
		}
	}

	/*more space for overflow*/
	.slick-slide{
		margin-top: 10px;
		margin-bottom: 10px;
	}

	/*align-center-middle*/
	.slick-slide {
	    text-align: center;
	}
	.slick-slide::after {
	    content: '';
	    display: inline-block;
	    height: calc(100vh - 240px);
	    vertical-align: middle;
	}
	.slick-slide img {
	    vertical-align: middle;
	    display: inline-block;
	    max-width: 100%;
	    max-height: calc(100vh - 240px);
	}
</style>


<!-- basic -->
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

<!-- beforeChange -->
<script>
	$('.member-sliderList').on('beforeChange', function(event, slick, currentSlide, nextSlide){

		var $current = $(slick.$slides.get(nextSlide));
		var $el = $(".name-ch span, .name-en span", $current);

		TweenMax.set($el, {
			opacity: 1,
			rotationY: 0,
			x: 0,
			transformOrigin:'center',
		});

		TweenMax.staggerFrom($el, 1.5, {
			opacity: 0,
			rotationY: -180,
			x: 20,
			transformOrigin:'center',
			onUpdate: function () {
				if (this.progress() == 1) {}
			}
		}, 0.1);
	});
</script>


<!-- custom dots -->
<style>
	.mb-dotWrap{
		position: absolute;
		left: 50%;
		transform: translateX(-50%);
		bottom: 20px;
	}
	.mb-dots{
		li{
			display: inline-block;
			vertical-align: top;
			width: 10px;
			height: 10px;
			background-color: #fff;
			border-radius: 50%;
			position: relative;
			cursor: pointer;
			@include mr(14px);
			&:after{
				content: '';
				position: absolute;
				top: 50%;
				left: 50%;
				transform: translate(-50%,-50%);
				width: 5px;
				height: 5px;
				border-radius: 50%;
				background-color: #8c6239;
				opacity: 0;
				transition: all 0.3s;
			}
			button{display: none;}
		}
		.slick-active{
			&:after{
				opacity: 1;
			}
		}
	}
</style>

<div class="mb-sliderWrap">
	<ul class="mb-sliderList">
		<li><img src="images/index/banner-1.jpg"></li>
		<li><img src="images/index/banner-2.jpg"></li>
	</ul>

	<div class="mb-dotWrap"></div>
</div>

<script>
	$('.mb-sliderList').slick({
		autoplay: true,
		autoplaySpeed: 4000,
		arrows: false,
		dots: true,
		dotsClass: 'mb-dots',
		appendDots: '.mb-dotWrap',
		infinite: true,
		speed: 500,
		easing: 'easeInOutCubic'
	});
</script>


<!-- responsive -->
<script>
	$('.moreEventsSliderList').slick({
		autoplay: true,
		autoplaySpeed: 4000,
		dots: false,
		infinite: true,
		speed: 500,
		prevArrow: ".moreEventsPrev",
		nextArrow: ".moreEventsNext",
		focusOnSelect: false,
		easing: 'easeInOutCubic',
		slidesToShow: 3,
		responsive: [{
			breakpoint: 1024,
			settings: {
				slidesToShow: 2
			}
		},{
			breakpoint: 640,
			settings: {
				slidesToShow: 1
			}
		},{
			breakpoint: 640,
			settings: "unslick"
		}]
	});

	$(window).on("resize", function (){
		if ($(this).width() > 1024) {
			$('.moreEventsSliderList').slick('resize');
		}
	})
</script>


<!-- center mode -->
<script>
	$('.mobile-packageList').slick({
		autoplay: true,
		autoplaySpeed: 4000,
		dots: false,
		infinite: true,
		speed: 666,
		arrows: true,
		centerMode: true,
		centerPadding: '78px',
		focusOnSelect: true,
		easing: 'easeInOutCubic',
		slidesToShow: 3,
		responsive: [{
			breakpoint: 640,
			settings: "unslick"
		}]
	});
</script>


<!-- 兩個連動 -->
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