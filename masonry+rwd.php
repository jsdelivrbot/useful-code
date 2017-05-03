<!-- vgrid -->
<script src="js/jquery.vgrid.js"></script>
<script src="js/jquery.easing.1.3.js"></script>

<style>
	#artMasonry{
		width: 70% !important;
		margin: 0 auto;
		.grid-sizer, .grid-item{
			width: calc(33.3333% - 10px);
			margin: 0 5px 10px;
			overflow: hidden;
		}
	}
</style>

<div id="artMasonry">
	<div class="grid-item"><img src="images/1.jpg"></div>
	<div class="grid-item"><img src="images/2.jpg"></div>
	<div class="grid-item"><img src="images/3.jpg"></div>
	<div class="grid-item"><img src="images/1.jpg"></div>
	<div class="grid-item"><img src="images/4.jpg"></div>
	<div class="grid-item"><img src="images/5.jpg"></div>
	<div class="grid-item"><img src="images/1.jpg"></div>
	<div class="grid-item"><img src="images/4.jpg"></div>
	<div class="grid-item"><img src="images/3.jpg"></div>
</div>

<script>
	var vg = $("#artMasonry").vgrid({
		useLoadImageEvent: true,
		useFontSizeListener: true,
		easing: "easeOutQuint",
		time: 500,
		delay: 100,
		wait: 0,
		fadeIn: {
			time: 300,
			delay: 50
		},
		onStart: function(){},
		onFinish: function(){}
	});

	$(window).on("load", function (){
		vg.vgrefresh();
	})
</script>


<!-- masonry -->
<script src="js/masonry.pkgd.min.js"></script>

<!-- 3col一定要這樣? width: 33.3333%; -->
<style>
	#artMasonry{
		.grid-sizer, .grid-item{
			width: 24%;
			height: 338px;
			overflow: hidden;
			margin-bottom: 10px;
		}
		.grid-item-width2{width: 50%;}
		.grid-item-width3{width: 74%;}
		.grid-item-width4{width: 99%;}
	}
</style>

<div id="artMasonry">
	<div class="grid-sizer"></div>

	<div class="grid-item"><img src="images/art-item-width1.png"></div>
	<div class="grid-item grid-item-width3"><img src="images/art-item-width2.png"></div>
	<div class="grid-item grid-item-width4"><img src="images/art-item-width3.png"></div>
	<div class="grid-item grid-item-width2"><img src="images/art-item-width2.5.png"></div>
	<div class="grid-item grid-item-width2"><img src="images/art-item-width2.5.png"></div>
</div>

<script>
	$('#artMasonry').masonry({
		// options
		columnWidth: '.grid-sizer',
		itemSelector: '.grid-item',
		percentPosition: true,
		gutter: 10
	});
</script>