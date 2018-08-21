<!-- tilt -->
https://github.com/gijsroge/tilt.js

<script src="https://unpkg.com/tilt.js@1.2.1/dest/tilt.jquery.min.js"></script>

<div class="cell large-3 pic-container"><a href="products_detail.php">
	<div class="rotate-area"
		data-tilt
		data-tilt-perspective="500"
		data-tilt-speed="2000"
		data-tilt-scale="0.9"
		data-tilt-glare="true"
		data-tilt-maxGlare="0.3">
		<div class="pic" style="background: url(images/series-2.jpg) center center / cover no-repeat"></div>
		<div class="title">CS3303</div>
	</div>
</a></div>


<!-- 這個也不錯 -->
<script src="js/jquery.plate.js"></script>

<style>
	.pic-container{
		overflow: hidden;
		position: relative;
		&:hover{
			.rotate-area .pic{
			    transform: translateZ(-70px);
			}
		}
		.rotate-area{
			position: absolute;
			top: 0;
			right: 0;
			bottom: 0;
			left: 0;
		    transform-style: preserve-3d;
			.pic{
				position: absolute;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				transition: all .5s;
			}
			.title{
				font-family: $en-family;
				font-weight: 700;
				font-size: 21px;
				letter-spacing: 1px;
				color: #fff;
				position: absolute;
				top: 50%;
				left: 50%;
				transform: translate(-50%,-50%);
			}
		}
	}
</style>

<div class="cell large-3 pic-container"><a href="products_detail.php">
	<div class="rotate-area">
		<div class="pic" style="background: url(images/series-1.jpg) center center / cover no-repeat"></div>
		<div class="title">CS3303</div>
	</div>
</a></div>

<script>
	$(function () {
		$('.productseriesWrap .rotate-area').plate({
		  // inverse animation
		  inverse: false,
		  // transformation perspective in pixels
		  perspective: 500,
		  // maximum rotation in degrees
		  maxRotation: 10,
		  // duration in milliseconds
		  animationDuration: 200
		});
	})
</script>