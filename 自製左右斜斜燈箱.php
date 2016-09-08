<!-- 專業 -->
<style>
	.el{
		-webkit-clip-path: polygon(0 0, 100% 0, 80% 100%, 0 100%);
	}
</style>


<!-- 綀功 -->
<style>
	.ryderSlider-leftWrap{
		animation: ryderSliderAnimate-left 0.7s;
		#svg-left{
			width: 100%;
			height: 100%;
		}
	}
	.ryderSlider-rightWrap{
		animation: ryderSliderAnimate-right 0.7s;
		#svg-right{
			width: 100%;
			height: 100%;
		}
	}

	@keyframes ryderSliderAnimate-left {
		from {
			top: 260px;
			// left: -90px;
			opacity: 0;
		}
		to {
			top: 0;
			left: 0;
			opacity: 1;
		}
	}
	@keyframes ryderSliderAnimate-right {
		from {
			top: -260px;
			// right: -90px;
			opacity: 0;
		}
		to {
			top: 0;
			right: 0;
			opacity: 1;
		}
	}
</style>

<div class="teamFancyWrap" id="teamFancy">
	<div class="skewBlock">
		<div class="words-left">
			<div class="title-ch">劉哲揚</div>
			<div class="title-en">Jhe Yang Liou</div>
		</div>
	</div>
	<div class="fullBlock">
		<div class="words-right">
			<div class="job-en">Design Driector</div>
			<div class="job-ch">設計總監</div>
			<div class="education">
				國立維也納應用藝術大學<br>
				繪畫藝術碩士
			</div>
			<div class="content">
				地平線為視覺水平最遠端距離<br>
				自然與人為構成地表富饒萬千樣貌<br>
				而設計能將人所觸及領悟之智慧作為<br>
				這生存範疇推昇文明的重要方式<br>
				經常眺望地平線  當思索時<br>
				經常冥想地平線  當迷惘時<br>
				經常崇敬地平線  當奮進時<br>
				只要聆聽  會從地平線獲  得訊息<br>
				只要理解  會清楚地平線中自處角色<br>
				只要振作  會穿越地平線的鴻溝另展時空<br>
				憑藉天賦努力成就設計價值<br>
				觀察、思考或認知後若能從地平線領略改變或創造<br>
				也許我們真的會發出些聲響並帶來美好
			</div>
		</div>
	</div>

	<div id="fancyClose"><img src="images/team/fancy-close.png"><img src="images/team/fancy-close@2x.png" width="35"></div>
</div>

<script src="js/snap.svg-min.js"></script>
<script>
	// $("#teamFancy").hide();

	$.fn.ryderCustomFancy = function(option) {
		var deFault={
			angle: 200
		};

		var setting=$.extend(deFault, option);

		var el= $(this);
		var left=el.children().eq(0);
		var right=el.children().eq(1);

		left.addClass("ryderSlider-leftWrap");
		right.addClass("ryderSlider-rightWrap");

		var mask_w=$(".ryderSlider-leftWrap").width();
		var mask_h=$(".ryderSlider-leftWrap").height();
		var mask_angle=setting.angle;

		$("<svg id='svg-left'></svg>").appendTo(left);
		$("<svg id='svg-right'></svg>").appendTo(right);

		// left
		var l = Snap("#svg-left");
		var man_left = l.image("images/team/fancy-1.png", 0, 0, "100%", "100%");
		var point_left = [0 , 0 , mask_w , 0 , mask_w-mask_angle , mask_h , 0 , mask_h];
		var mask_left = l.polygon(point_left);
		mask_left.attr({
		    fill:"#fff",
		});
		man_left.attr({
		    mask: mask_left,
		});

		// right
		var r = Snap("#svg-right");
		var man_right = r.image("images/team/fancy-2.png", 0, 0, "100%", "100%");
		var point_right = [mask_angle , 0 , mask_w , 0 , mask_w , mask_h , 0 , mask_h];
		var mask_right = r.polygon(point_right);
		mask_right.attr({
		    fill:"#fff",
		});
		man_right.attr({
		    mask: mask_right,
		});

		// resize
		$(window).on("resize",function () {
			mask_w=$(".ryderSlider-leftWrap").width();
			mask_h=$(".ryderSlider-leftWrap").height();
			point_right = [mask_angle , 0 , mask_w , 0 , mask_w , mask_h , 0 , mask_h];
			point_left = [0 , 0 , mask_w , 0 , mask_w-mask_angle , mask_h , 0 , mask_h];
			mask_left.animate({
				"points": point_left.toString()
			}, 400);
			mask_right.animate({
				"points": point_right.toString()
			}, 400);
		});
	};

	$("#teamFancy").ryderCustomFancy();
</script>