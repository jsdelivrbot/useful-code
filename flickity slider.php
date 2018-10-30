https://flickity.metafizzy.co/

<!-- drag 超棒  -->
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

<!-- fade effect -->
https://codepen.io/eikeco/pen/MwGRKr


<!-- if asNavFor not work -->
https://github.com/metafizzy/flickity-sync
<script src="https://unpkg.com/flickity-sync@2.0.0/flickity-sync.js"></script>

<!-- (寫一個就可) -->
<div data-flickity='{
	"sync": ".carouselB"
}'></div>


<style>
	/* fade css */
	.flickity-slider {
		transform: none !important;
	}
	.gallery-cell {
		left: 0 !important;
		opacity: 0;
		transition: opacity 0.3s ease-in-out;
		z-index: -1;
		&.is-selected {
			opacity: 1;
			z-index: 0
		}
	}
</style>

<!-- basic -->
<style>
	.arrival-sliderContainer{
		section{
			width: 100%;
			margin: 0 50px;
			&.is-selected{
				.title, .content{
					opacity: 1;
				}
			}
		}
		/* reset */
		.flickity-button {
			background-color: #fff;
			&:hover {
			    background: #fff;
			}
			&:focus {
			    outline: none;
	  			box-shadow: none;
			}
			&:active {
			    opacity: 1;
			}
			&:disabled {
			    opacity: .3;
			    cursor: auto;
			    pointer-events: none
			}
		}
		/* previous & next buttons */
		.flickity-prev-next-button {
			width: 40px;
			height: 40px;
			top: auto;
			bottom: -14px;
			transform: translateY(0);
			&.previous{
				left: 204px;
			}
			&.next{
				left: 829px;
			}
			/* svg */
			.flickity-button-icon {
				fill: #11f291;
				width: 17px;
				height: auto;
				top: 50%;
				left: 50%;
				transform: translate(-50%,-50%);
			}
		}

		/* pager dot -----------------------------------------------------------------------------------------*/
		/* position dots in carousel */
		.flickity-page-dots {
			bottom: -70px;
		}
		/* white circles */
		.flickity-page-dots .dot {
			display: inline-block;
			vertical-align: middle;
			width: 15px;
			height: 15px;
			background-color: #fff;
			border-radius: 50%;
			opacity: .4;
			transition: all .5s;
			@include mr(14px);
		}
		/* fill-in selected dot */
		.flickity-page-dots .dot.is-selected {
			opacity: .8;
		}
	}
</style>

<div class="other-sliderContainer" data-flickity='{
	"prevNextButtons": true,
	"pageDots": false,
	"cellSelector": ".slider",
	"wrapAround": true,
	"autoPlay": 4000,
	"imagesLoaded": true,
	"arrowShape": ""
}'>
	<div class="slider"><a href="products_detail.php">
		<div class="pic"><img src="images/other-1.png"></div>
		<div class="title">經典原蜜瓶</div>
		<div class="note">
			<span>350ml</span>
			<span><i style="background-color: #e9cd81"></i>龍眼<i style="background-color: #db5310"></i>荔枝</span>
		</div>
		<div class="price">NT $600</div>
	</a></div>
</div>

<script>
	$('.about-gift-sliderList').on( 'change.flickity', function( event, index ) {
		console.log( 'Slide changed to ' + index )
	});
</script>


<!-- parallax -->
<style>
	.pic-area{
		width: 780px;
		margin-left: auto;
		.carousel-cell{
			width: 100%;
			overflow: hidden;  /* 一定要加 */
		}
	}
</style>

<div class="pic-area">
	<div class="carousel-cell">
		<img src="images/temp-pic-1.jpg">
	</div>
	<div class="carousel-cell">
		<img src="images/temp-pic-2.jpg">
	</div>
</div>

<script>
	var data_flickity = {
		"prevNextButtons": false,
		"pageDots": false,
		"wrapAround": false,
		"autoPlay": 4000,
		"imagesLoaded": true,
		"arrowShape": ""
	};

	$carousel = $(".tempWrap .pic-area").flickity(data_flickity);

	var flkty = $carousel.data('flickity');
	var $imgs = $('.carousel-cell img');

	$carousel.on( 'scroll.flickity', function( event, progress ) {
		flkty.slides.forEach( function( slide, i ) {
			var img = $imgs[i];
			var x = ( slide.target + flkty.x ) * -0.8;
			img.style.transform = 'translateX( ' + x  + 'px)';
		});
	});
</script>


<!-- click -->
<script>
	var _option = {
		"prevNextButtons": false,
		"pageDots": false,
		"wrapAround": true,
		"autoPlay": 4000,
		"imagesLoaded": true,
		"arrowShape": ""
	};


	var $carousel = $('#my-slider').flickity(_option);

	$carousel.on( 'staticClick.flickity', function( event, pointer, cellElement, cellIndex ) {
		$carousel.flickity( 'select', cellIndex );
	});
</script>