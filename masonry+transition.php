<style>
	.masonryWrap{
		text-align: right;
		width: @width;
		margin: 0 auto 120px;
	}

	/*====================================
	=            masonry test            =
	====================================*/

	.grid {
		width: 1200px;
	}

	.grid-item {
		float: left;
	}

	/* item is invisible, but used for layout */
	.grid-item{
		width: 400px;
		height: 400px;
	}
	.grid-item1{
		width: 400px;
		height: 400px;
	}
	.grid-item2{
		width: 800px;
		height: 400px;
	}
	.grid-item3{
		width: 1200px;
		height: 400px;
	}

	/* grid-item-content is visible, and transitions size */
	.grid-item .grid-item-content {
		width: 400px;
		height: 400px;
		-webkit-transition: width 0.4s, height 0.4s;
		transition: width 0.4s, height 0.4s;
		img{width: 100%;}
		overflow: hidden;
	}
	.grid-item1 .grid-item-content {
		width: 400px;
		height: 400px;
		-webkit-transition: width 0.4s, height 0.4s;
		transition: width 0.4s, height 0.4s;
		img{width: 100%;}
		overflow: hidden;
	}
	.grid-item2 .grid-item-content {
		width: 800px;
		height: 400px;
		-webkit-transition: width 0.4s, height 0.4s;
		transition: width 0.4s, height 0.4s;
		img{width: 100%;}
		overflow: hidden;
	}
	.grid-item3 .grid-item-content {
		width: 1200px;
		height: 400px;
		-webkit-transition: width 0.4s, height 0.4s;
		transition: width 0.4s, height 0.4s;
		img{width: 100%;}
		overflow: hidden;
	}

	/*for mouseover*/
	.grid-item .grid-item-content {
		position: relative;
		cursor: pointer;
		&:after{
			content: '';
			width: 100%;
			height: 100%;
			position: absolute;
			top: 0;
			left: 0;
			background-color: rgba(35,24,21,0.3);
			opacity: 0;
			transition: all 0.6s;
			-webkit-transition: all 0.6s;
			background-image: url(images/masonry-bg.png);
			background-repeat: no-repeat;
			background-position: center;
			background-size: 77px 77px;
		}
		&:hover{
			&:after{opacity: 1;}
		}
	}

	/* both item and item content change size */
	.grid-item.is-expanded,
	.grid-item.is-expanded .grid-item-content {
		width: 1200px;
		height: 800px;
	}

	.grid-item.is-expanded {
		z-index: 2;
	}

	/*=====  End of masonry test  ======*/
</style>

<div class="masonryWrap">
	<div class="grid">
		<?php while($row_Recwork = mysql_fetch_assoc($Recwork)){ ?>
		<div class="grid-item grid-item<?= $row_Recwork['file_width'] ?>">
			<div class="grid-item-content"><img src="<?= $row_Recwork['file_link1'] ?>"></div>
		</div>
		<?php } ?>
	</div>
</div><!-- masonryWrap end -->

<script>
	var $grid = $('.grid').masonry({
		columnWidth: 400,
		itemSelector: '.grid-item',
	});

	$grid.on( 'click', '.grid-item-content', function( event ) {
		$( event.currentTarget ).parent('').toggleClass('is-expanded');
		$grid.masonry();
	});
</script>