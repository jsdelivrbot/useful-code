http://spritely.net/documentation/

<script src="js/jquery.spritely.js"></script>

<script>
	$('#fancy-gif-one').sprite({fps: 3, no_of_frames: 8});
</script>



<!--=================================
=            use compass            =
==================================-->

<!-- retina -->
<style>
	@import "compass/utilities/sprites";
	@import "compass/css3/background-size";

	/*檔名要一樣*/
	$temporary-sprite-dimensions: true;
	$temporary-spacing: 20px;
	@import "temporary/*.png";
	@include all-temporary-sprites;

	$temporary-sprite-dimensions: true;
	$temporary-spacing: 20px;
	@import "temporary2x/*.png";
	@include all-temporary2x-sprites;

	@include all-retina-sprites($temporary-sprites, $temporary2x-sprites);
</style>

<!-- basic -->
<style>
	@import "compass/utilities/sprites";

	$welcome-sprite-dimensions: true;
	$welcome-spacing: 20px;
	@import "welcome/*.png";
	@include all-welcome-sprites;

	#welcome{
		@include welcome-sprite(welcome0001);
		&.start{
			animation: welcome 1s steps(31) both;
		}
	}

	@keyframes welcome{
		100%{
			background-position: 0 -3100px;
		}
	}
</style>