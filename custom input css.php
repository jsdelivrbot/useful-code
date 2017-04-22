<!--=============================
=            radio            =
=============================-->

<style type="text/css">
	/*偽元素式*/
	input[type='radio']{
		display: none;
	}
	input[type='radio'] + label{
		position: relative;
		padding-left: 24px;
		&:before{
			content: '';
			display: block;
			width: 12px;
			height: 12px;
			border: 1px solid $orange;
			border-radius: 50%;
			margin-right: 10px;
			position: absolute;
			top: 50%;
			transform: translateY(-50%);
			left: 0;
		}
	}
	input[type='radio']:checked + label{
		&:after{
			content: '';
			display: block;
			width: 8px;
			height: 8px;
			background-color: $orange;
			border-radius: 50%;
			position: absolute;
			top: 50%;
			transform: translateY(-50%);
			left: 3px;
		}
	}

	/*圖片式*/
	input[type="radio"]{
		display: none;
	}
	input[type="radio"] + label{
		display:inline-block;
		cursor: pointer;
		text-align: right;
		width: 42px;
		margin-right: 15px;
		background:url(images/radiobg.png) no-repeat left;
		background-size: 11px 11px;
	}
	input[type="radio"]:checked + label{
		background:url(images/radiobg2.png) no-repeat left;
		background-size: 11px 11px;
	}
</style>

<input type="radio" class="radio" name="radio" id="r1">
<label for="r1">男</label>
<input type="radio" class="radio" name="radio" id="r2">
<label for="r2">女</label>

<!-- same name for RADIO selected ONLY -->

<!--================================
=            checkbox            =
================================-->
<style type="text/css">
	.label{
		display:inline-block;
		cursor: pointer;
		text-align: center;
		line-height: 25px;
		padding-left: 30px;
		background:url(images/messageradiobg.png) no-repeat left;
		background-size: 20px 20px;
		position: relative;
		z-index: 11;
		.fontstyle;
		font-size: 17px;
		color: #3E3A39;
	}
	.labelChecked{
		background:url(images/messageradiobg2.png) no-repeat left;
		background-size: 20px 22px;
	}
</style>

<script type="text/javascript">
	$(".label").mousedown(function  () {
		var _check=$(this).hasClass('labelChecked');
		if (_check == true) {
			$(this).removeClass("labelChecked");
			var input = $(this).find("input");
			input.prop("checked" , false);
		}else{
			$(this).addClass("labelChecked");
			var input = $(this).find("input");
			input.prop("checked" , true);
		}
	})
</script>

<!--============================
=            textarea            =
============================-->

<style type="text/css">
	.messageTextarea{
		border: 1px solid #9F9FA0;
		background-color: #FEFEFE;
		margin-left: 9px;
		margin-right: 25px;
		font-family: @content-family;
		letter-spacing: 1px;
		font-size: 20px;
		color: @grey;
		vertical-align: top;
		width: 535px;
		height: 278px;
		resize:none;
	}
</style>


<!--==============================
=            select            =
==============================-->

<!-- 55+ jquery selectBox plugin -->
http://www.jqueryrain.com/demo/jquery-selectbox-plugin/page/2/
<!-- 呃…fancy感 -->
http://code.octopuscreative.com/fancyselect/?utm_source=jquer.in&utm_medium=website&utm_campaign=content-curation
<!-- nice select -->
http://www.jqueryrain.com/?1FAAtZGJ

<script src="js/jquery.nice-select.min.js"></script>
<link rel="stylesheet" href="css/nice-select.css">

<style>
	.element{
		.select{
			font-family: @content-family;
			font-size: 12px;
			color: #fff;

			float: none;       /* 重點 */
			width: 100%;
			height: 25px;
			line-height: 25px;
			background-color: #8b189b;
			text-align: center;
			border: 0;
			border-radius: 0;
		}
		/* 點開的選單 */
		.list{
			width: 100%;
			border: 2px solid #997d2a;
			background-color: #130506;
		}
		/* 三角形 */
		.nice-select:after{
			border-color: #fff;
		}
		.nice-select.open:after{}
		/* select */
		.option.focus{background-color: #000;}
	}
</style>

<div class="element">
	<select name="" id="" class="select">
		<option>105</option>
		<option>104</option>
		<option>103</option>
	</select>
</div>

<script>
	$('.select').niceSelect();
</script>


<!-- 菜逼巴用的 -->
<style type="text/css">
	#select{
		cursor: pointer;
		padding-left: 3px;
		width: 140px;
		height: 35px;
		border: 1px solid #afa184;
		border-radius: 4px;
		font-family: @content-family;
		background-color: transparent;
		background: url(images/select-bg-big.png) no-repeat 99px;
		-webkit-appearance: none;
		-moz-appearance: none;
		color: #727171;
		font-size: 15px;
	}
</style>

<select name="" id="select">
	<option>真新鎮</option>
</select>
