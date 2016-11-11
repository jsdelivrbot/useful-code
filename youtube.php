<!-- youtube api -->
https://developers.google.com/youtube/player_parameters#start


<li onclick="youtube_play(this);" data-youtube="<?= $row_Recvideoimage['d_class4'] ?>"><img src="<?php echo $row_Recvideoimage['file_link1'] ; ?>"><img src="img/videoplay.png" width="80" class="videoplay"></li>

<script>
	function youtube_play (e) {
	  var $this=$(e);
	  var _src=$this.data("youtube");
	  var _w=$this.width() + "px";
	  var _h=$this.height() + "px";
	  $this.html('<iframe src="http://www.youtube.com/embed/'+_src+'?autoplay=1" frameborder="0" allowfullscreen width="'+_w+'" height="'+_h+'"></iframe>');
	}
</script>


<!-- ============================================== -->
<div id="ytplayer"></div>

<script src="https://www.youtube.com/player_api"></script>
<script>
	var player;
	function onYouTubePlayerAPIReady() {
		player = new YT.Player('ytplayer', {
			height: '360',
			width: '640',
			videoId: 'M7lc1UVf-VE'
		});
	}

	$("#index_video").on("click", function () {
		player.playVideo();
	})
</script>