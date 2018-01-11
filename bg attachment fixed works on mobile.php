<style>
	.m-fix-bg{
		height: 487px;
		position: relative;
		.container{
			position: absolute;
			top: 0;
			right: 0;
			bottom: 0;
			left: 0;
			clip: rect(0, auto, auto, 0);
		}
		.bg{
			position: fixed;
			top: 0;
			right: 0;
			bottom: 0;
			left: 0;
			background-repeat: no-repeat;
			background-position: center center;
			background-size: cover;
		}
	}
</style>

<div class="m-fix-bg">
	<div class="container">
		<div class="bg" style="background-image: url(images/newindex/fix-bg-1.jpg);"></div>
	</div>
</div>