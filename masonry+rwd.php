<!-- 3col一定要這樣? width: 33.3333%; -->

<script src="js/masonry.pkgd.min.js"></script>


<!-- percetage -->
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
		"gutter": 10
	});
</script>


<!-- px -->
<style type="text/css">
	#container{
		.w1{width: 244px;}
		.w2{width: 493px;}
		.h1{height: 244px;}
		.h2{height: 493px;}
		.sizer{width: 244px;}
		.gutter-sizer{width: 5px;}
	}

	@media screen and (max-width: 970px) {
		#container{
			.w1{width: 160px; img{width: 160px;}}
			.w2{width: 320px; img{width: 320px;}}
			.h1{height: 160px; img{height: 160px;}}
			.h2{height: 320px; img{height: 320px;}}
			.sizer{width: 160px;}
			.gutter-sizer{width: 0;}
		}
	}
</style>

<div id="container" class="not320">
	<div class="sizer"></div>
	<div class="gutter-sizer"></div>

	<div class="item w1"><img src="images/art-item-width1.png"></div>
	<div class="item w2"><img src="images/art-item-width2.png"></div>
</div>

<script>
	$(function(){
		$('#container').masonry({
		    // options
		    itemSelector : '.item',
		    columnWidth : '.sizer',
		    // isFitWidth: true,
		    "gutter": '.gutter-sizer',
		});
	});
</script>