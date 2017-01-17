<style>
	@import "compass/utilities/sprites";

	@import "welcome/*.png";
	@include all-welcome-sprites;
	$welcome-sprite-dimensions: true;

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