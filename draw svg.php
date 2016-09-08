<script src="js/TweenMax.min.js"></script>
<!-- 轉頁特效 -->
<div class="page-transition">
	<svg xmlns="http://www.w3.org/2000/svg" version="1.1" id="svg-1">
		<path d="" style="fill:none;stroke:#006d37;stroke-width:1;" />
	</svg>
	<svg xmlns="http://www.w3.org/2000/svg" version="1.1" id="svg-2">
		<path d="" style="fill:none;stroke:#006d37;stroke-width:1;" />
	</svg>
</div>

<script>
	// draw svg
	var window_w=$(window).width();
	var window_h=$(window).height();
	var x1=window_w*0.45;
	var y1=window_h*0.6;
	var svg_1="M "+window_w+" "+window_h+" L "+x1+" "+y1;
	var svg_2="M "+x1+" "+y1+" L 0 0";
	$("#svg-1 path").attr("d",svg_1);
	$("#svg-2 path").attr("d",svg_2);

	// get stroke-dasharray
	var path_1 = document.getElementById("svg-1").querySelector('path');
	var length_1 = path_1.getTotalLength();
	var path_2 = document.getElementById("svg-2").querySelector('path');
	var length_2 = path_2.getTotalLength();
	$("#svg-1").css({
		"stroke-dasharray": length_1+"px",
		"stroke-dashoffset": length_1+"px",
	})
	$("#svg-2").css({
		"stroke-dasharray": length_2+"px",
		"stroke-dashoffset": length_2+"px",
	})

	// preload animate
	var preload_check="<?= $_SESSION['preload'] ?>"
	var now_check="<?= $_SESSION['menu'] ?>"
	// alert(preload_check);
	// alert(now_check);
	if (preload_check==1 && now_check==1) {
		preload_2();
	}
	if (preload_check==0 && now_check==1) {
		preload_1();
	}
	if (preload_check==0 && now_check==0) {
		preload_2();
	}
	function preload_1() {
		TweenMax.to($("#svg-1"), 3.5, {
			"stroke-dashoffset": "300px",
		});
		$(window).load(function () {
			var dash_1=$("#svg-1").css("stroke-dashoffset");
			TweenMax.fromTo($("#svg-1"), 1, {
				"stroke-dashoffset": dash_1,
			}, {
				"stroke-dashoffset": 0,
				onComplete: function  () {
					svg_finish();
				}
			});

		})
	}
	function preload_2() {
		$(window).load(function () {
			$(".page-transition").delay(500).fadeOut(1000);
		})
	}
	function svg_finish() {
		TweenMax.to($("#svg-2"), 1.5, {
			"stroke-dashoffset": 0,
			onComplete: function  () {
				$(".page-transition").delay(500).fadeOut(1000);
			}
		});
	}
</script>