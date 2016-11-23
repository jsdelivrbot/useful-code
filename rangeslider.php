<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>


<style>
	#rangeSlider{
		margin-bottom: 30px;
		.value {
			position: absolute;
			top: 30px;
			left: 50%;
			margin: 0 0 0 -20px;
			width: 40px;
			text-align: center;
			display: block;

			/* optional */

			font-weight: normal;
			font-family: Verdana,Arial,sans-serif;
			font-size: 14px;
			color: #333;
		}
		.price-range-both.value {
			width: 100px;
			margin: 0 0 0 -50px;
			top: 26px;
		}
		.price-range-both {
			display: none;
		}
		.value i {
			font-style: normal;
		}
	}
	/*custom*/
	.ui-widget-content{
		border: none;
		height: 6px;
	}
	.ui-slider .ui-slider-handle{
		width: 16px;
		height: 16px;
		border: none;
		border-radius: 50%;
		background: $black;
		&:focus{outline: none;}
	}
	.ui-widget-header{
		background: $black;
	}
</style>


<div id="rangeSlider"></div>


<script>
	function collision($div1, $div2) {
		var x1 = $div1.offset().left;
		var w1 = 40;
		var r1 = x1 + w1;
		var x2 = $div2.offset().left;
		var w2 = 40;
		var r2 = x2 + w2;
		if (r1 < x2 || x1 > r2) return false;
		return true;
	}
	// // slider call
	$('#rangeSlider').slider({
		range: true,
		min: 300,
		max: 5000,
		values: [1000, 3000],
		slide: function(event, ui) {
			$('.ui-slider-handle:eq(0) .price-range-min').html('$' + ui.values[0]);
			$('.ui-slider-handle:eq(1) .price-range-max').html('$' + ui.values[1]);
			$('.price-range-both').html('<i>$' + ui.values[0] + ' - </i>$' + ui.values[1]);
			//
			if (ui.values[0] == ui.values[1]) {
				$('.price-range-both i').css('display', 'none');
			} else {
				$('.price-range-both i').css('display', 'inline');
			}
			//
			if (collision($('.price-range-min'), $('.price-range-max')) == true) {
				$('.price-range-min, .price-range-max').css('opacity', '0');
				$('.price-range-both').css('display', 'block');
			} else {
				$('.price-range-min, .price-range-max').css('opacity', '1');
				$('.price-range-both').css('display', 'none');
			}
		}
	});
	$('.ui-slider-range').append('<span class="price-range-both value"><i>$' + $('#rangeSlider').slider('values', 0) + ' - </i>' + $('#rangeSlider').slider('values', 1) + '</span>');
	$('.ui-slider-handle:eq(0)').append('<span class="price-range-min value">$' + $('#rangeSlider').slider('values', 0) + '</span>');
	$('.ui-slider-handle:eq(1)').append('<span class="price-range-max value">$' + $('#rangeSlider').slider('values', 1) + '</span>');
</script>