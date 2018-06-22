https://flickity.metafizzy.co/

<!-- drag 超棒  -->
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

<!-- fade effect -->
https://codepen.io/eikeco/pen/MwGRKr

<style>
	/* Fade CSS */
	.flickity-slider {
		transform: none !important;
	}
	.gallery-cell {
		left: 0 !important;
		opacity: 0;
		transition: opacity 0.3s ease-in-out;
		z-index: -1;
	}
	.gallery-cell.is-selected {
		opacity: 1;
		z-index: 0
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
			background: transparent;
			&:hover{
				background: transparent;
			}
			&:focus{
				outline: none;
	  			box-shadow: none;
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
	}
</style>

<div class="other-sliderContainer" data-flickity='{
	"prevNextButtons": true,
	"pageDots": false,
	"cellSelector": ".slider",
	"wrapAround": true,
	"autoPlay": 4000,
	"imagesLoaded": true,
	"arrowShape": "M7.3,59.2c4,0,7.3,3.3,7.3,7.3c0,4-3.3,7.3-7.3,7.3c-4,0-7.3-3.3-7.3-7.3C0,62.5,3.3,59.2,7.3,59.2z M0,33.5 c0,4,3.3,7.3,7.3,7.3c4,0,7.3-3.3,7.3-7.3c0-4-3.3-7.3-7.3-7.3C3.3,26.2,0,29.4,0,33.5z M24.9,33.3L24.9,33.3 c0.7-1.9,8.3-24.7,25.4-31.7c2.5-1,5.2-1.6,7.9-1.6c8.6,0,16.2,5.1,19.4,13c2.1,5.2,2.1,10.9-0.1,16.1c-0.6,1.3-1.3,2.6-2,3.8l0,0 c1.4,2,2.5,4.2,3.3,6.5L99.1,50L78.9,60.7c-0.9,2.3-1.9,4.5-3.3,6.5l0,0c0.8,1.2,1.6,2.4,2.1,3.7c2.2,5.2,2.3,10.9,0.2,16.1 c-3.2,7.9-10.6,13-19.2,13c-2.7,0-4.9-0.5-7.4-1.6c-17.1-7-24.9-29.9-24.9-31.7v0c-2.4-4.8-6-10.5-6-16.7 C20.4,43.8,21.8,38.1,24.9,33.3z M24.3,50c0,10.2,4.5,19,14.1,23.5v-47C28.8,31,24.3,39.8,24.3,50z M69.6,29.4v41.3 c2.4-4.9,9.8-12.3,9.8-20.7C79.5,41.7,72,34.2,69.6,29.4z M57.6,24.3c-2.4-0.6-4.5-1-6.9-1c-0.9,0-2.7,0.1-2.7,0.1v53 c0,0.1,1.7,0.1,2.7,0.1c2.4,0,4.5-0.4,6.9-1V24.3z M28.2,71.4C28.2,71.4,28.2,71.4,28.2,71.4C28.2,71.4,28.2,71.4,28.2,71.4z M30.3,73.4C30.4,73.4,30.4,73.4,30.3,73.4C30.4,73.4,30.4,73.4,30.3,73.4z M73,70.5c-5.6,6.2-13.6,10.2-22.6,10.2 c-0.9,0-2.4-0.1-2.4-0.1v0.2l-1.9-0.3c-1.8-0.2-3.5-0.6-5-1.1c-0.1,0-0.2-0.1-0.3-0.1c-0.3-0.1-0.5-0.2-0.8-0.3 c-2.6-0.9-5-2.1-7.2-3.6c3.9,7,10.2,15.8,19,19.4c2.1,0.8,4.2,1.3,6.4,1.3c6.9,0,13.1-4.1,15.7-10.5c1.7-4.2,1.7-8.8-0.1-13 C73.6,71.8,73.4,71.2,73,70.5z M80.3,44.7c0.3,1.7,0.5,3.5,0.5,5.3c0,1.8-0.2,3.6-0.5,5.3L90.5,50L80.3,44.7z M32.9,24.7 c1.6-1.1,3.4-2.1,5.2-2.9l0.6-0.3c2.4-1,4.8-1.7,7.4-2l2-0.3v0.2c0-0.1,1.5-0.1,2.4-0.1c9,0,16.8,3.9,22.4,10.2 c0.4-0.6,0.7-1.2,1-1.9c1.8-4.2,1.8-8.8,0.1-13C71.3,8.2,65.2,4,58.3,4c-2.2,0-4.4,0.4-6.4,1.3C43,8.9,36.7,17.7,32.9,24.7z M30.4,26.6C30.4,26.6,30.4,26.5,30.4,26.6C30.4,26.5,30.4,26.6,30.4,26.6z M28.2,28.6C28.2,28.6,28.2,28.6,28.2,28.6 C28.2,28.6,28.2,28.6,28.2,28.6z"
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