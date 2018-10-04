<!-- chrome 66版本電腦也不能自動播放除了靜音 然後手機停止 autoplay 因為 android 很廢 -->
<video id="video" autoplay muted playsinline loop src="images/index.mp4"></video>



<!-- 如果沒有自動播放  一開始會沒有畫面 (因為沒設poster) 所以用#t=1 讓他定在1秒那一幀 -->
<video playsinline muted loop src="images/about-2.mp4#t=1"></video>




<!-- 這是什麼忘記了  好像是全營幕之類的 -->
<script>
	$(".video-volume").on("click", function () {
		$(this).toggleClass("has-volume")
		$("#video").prop("muted", !$("#video").prop("muted"))
	})

	// for mobile 好像不能有 playsinline
	var _video = document.getElementById('video')
	_video.muted = false
	_video.fullscreen = true

	// for android
	$('#video').bind('webkitfullscreenchange mozfullscreenchange fullscreenchange', function(e) {
	    var state = document.fullScreen || document.mozFullScreen || document.webkitIsFullScreen;
	    var event = state ? 'FullscreenOn' : 'FullscreenOff';

	    if (event == 'FullscreenOff') {
	    	_video.pause()
	    }
	});

	$(".video-playBlock").show().on("click", function () {
		// for android
		if (_video.requestFullscreen) {
			_video.requestFullscreen();
		} else if (_video.msRequestFullscreen) {
			_video.msRequestFullscreen();
		} else if (_video.mozRequestFullScreen) {
			_video.mozRequestFullScreen();
		} else if (_video.webkitRequestFullscreen) {
			_video.webkitRequestFullscreen();
		}

		_video.play()
		// $("#video").trigger("play")
	})
</script>



<!-- 置中 -->
<style>
	.video-container{
		position: absolute;
		top: 25%;
		left: 25%;
		width: 50%;
		height: 50%;
	}
	#video{
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%,-50%);
	}
</style>

<video id="video" autoplay loop playsinline src="http://aqua.mounts-studio.com/images/index.mp4"></video>

<script>
	if (device == 'mobile') {
		$("#video").prop("muted", true)
	}

	$(window).on("resize", function () {
		if ($(this).width() > $(this).height()) {
			$("#video").css({
				width: '200%',
				height: 'auto'
			})
		}else{
			$("#video").css({
				height: '200%',
				width: 'auto'
			})
		}
	}).trigger("resize")
</script>



<!-- fancy -->
<li data-src="images/video/video-5.mp4"></li>

<div class="videoFancy m-fancyWrap">
	<video id="video">
		<source src="" type="video/mp4">
	</video>

	<div class="logo"><a href="index.php"><img src="images/logo.png" width="127"><img src="images/logo@2x.png" width="127"></a></div>

	<div id="videoClose"><img src="images/video/close.png"><img src="images/video/close@2x.png" width="49"></div>
</div>

<script>
	$(".videoList li").on("click", function() {
		var _src = $(this).data("src");
		video.src = _src;
		video.load(); //update
		$(".videoFancy").fadeIn(600, function() {
			video.currentTime = 0; //restart
			video.play();

			$(video).on("ended", function() {
				$("#videoClose").trigger("click");
			})
		});
	})

	$("#videoClose").on("click", function() {
		$(".videoFancy").fadeOut(600);
		video.pause();
	})
</script>