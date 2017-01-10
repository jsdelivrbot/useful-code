<li data-src="images/video/video-5.mp4"></li>

<style>
	/*video tag 滿版*/
	#video{
		position: absolute;
		top: 0;
		left: 0;
		min-width: 100%;
		min-height: 100%;
	}
</style>

<!-- fancy -->
<div class="videoFancy m-fancyWrap">
	<video id="video">
	  <source src="" type="video/mp4">
	</video>

	<div class="logo"><a href="index.php"><img src="images/logo.png" width="127"><img src="images/logo@2x.png" width="127"></a></div>

	<div id="videoClose"><img src="images/video/close.png"><img src="images/video/close@2x.png" width="49"></div>
</div>

<script>
	$(".videoList li").on("click", function () {
		var _src=$(this).data("src");
		video.src=_src;
		video.load();    //update
		$(".videoFancy").fadeIn(600, function () {
			video.currentTime = 0;    //restart
			video.play();

			$(video).on("ended", function () {
				$("#videoClose").trigger("click");
			})
		});
	})
	$("#videoClose").on("click", function () {
		$(".videoFancy").fadeOut(600);
		video.pause();
	})
</script>