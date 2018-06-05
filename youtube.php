<!-- loop 要加 playlist=VIDEO_ID  autoplay 要加 mute -->
<iframe src="https://www.youtube.com/embed/_14E8OtvGTE?autoplay=1&loop=1&controls=0&rel=0&playsinline=1&showinfo=0&mute=1&playlist=_14E8OtvGTE" frameborder="0"></iframe>

<!-- youtube iframe api (?) -->
<div id="test">
	<iframe id="ytplayer" src="https://www.youtube.com/embed/qf09H2xFq2s?playsinline=1&enablejsapi=1" frameborder="0" allowfullscreen></iframe>
</div>

<script>
	var tag = document.createElement('script');

	tag.src = "//www.youtube.com/iframe_api";
	var firstScriptTag = document.getElementsByTagName('script')[0];
	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

	var player;

	function onYouTubeIframeAPIReady() {
	   player = new YT.Player('ytplayer', {
	       events: {
				onReady() {
					// autoplay
					player.playVideo();
					// mute
					player.mute();
				}
	       }
	   });
	}
</script>

<!-- 燈箱 -->
<script>
	$(".videoWrap section").on("click", function (){
		$("#youtube-container").html('<iframe src="http://www.youtube.com/embed/'+ $(this).data("id") +'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
		$(".videoFancy").fadeIn(500)
	})

	$(".fancyCloseBlock").on("click", function (){
		$("#youtube-container").html("");
		$(".videoFancy").fadeOut(500)
	})
</script>

<!-- youtube api -->
https://developers.google.com/youtube/player_parameters#start
<script src="https://www.youtube.com/player_api"></script>

<!-- basic -->
<div id="ytplayer"></div>

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


<!-- multiple -->
<style>
	.youtubeOutWrap{
		width: 70%;
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%,-50%);
	}
	.youtubeWrap{
		position: relative;
	    height: 0;
	    padding-bottom: 56.25%;  /*16:9*/
	    overflow: hidden;
	    iframe{
	    	position: absolute;
	    	top: 0;
	    	left: 0;
	    	width: 100%;
	    	height: 100%;
	    }
	}
	.ytplayer{
		display: none;
	}
</style>

<div class="youtubeOutWrap">
	<div class="youtubeWrap">
		<div id="player1" class="ytplayer"></div>
		<div id="player2" class="ytplayer"></div>
		<div id="player3" class="ytplayer"></div>
		<div id="player4" class="ytplayer"></div>
		<div id="player5" class="ytplayer"></div>
	</div>
</div>

<script>
	var playerInfoList = [{
	    id: 'player1',
	    height: '100%',
	    width: '100%',
	    videoId: 'Mzeb4DREZlE'
	}, {
	    id: 'player2',
	    height: '100%',
	    width: '100%',
	    videoId: '3zox5uYk9vU'
	}, {
	    id: 'player3',
	    height: '100%',
	    width: '100%',
	    videoId: '3OwbqUNAGhc'
	}, {
	    id: 'player4',
	    height: '100%',
	    width: '100%',
	    videoId: 'BkQXpt6nxXk'
	}, {
	    id: 'player5',
	    height: '100%',
	    width: '100%',
	    videoId: 'omw8CkfclPQ'
	}];

	var players = new Array();
	var _nowPlayer;

	function onYouTubePlayerAPIReady () {
		if (typeof playerInfoList === 'undefined') return;

		for (var i = 0; i < playerInfoList.length; i++) {
			var curplayer = createPlayer(playerInfoList[i]);
			players[i] = curplayer;
		}
	};

	function createPlayer(playerInfo) {
		return new YT.Player(playerInfo.id, {
			height: playerInfo.height,
			width: playerInfo.width,
			videoId: playerInfo.videoId,
		});
	}

	$(".videoList li").on("click", function() {
		_nowPlayer = $(this).index();
		players[_nowPlayer].playVideo();
		$(".ytplayer").eq(_nowPlayer).show()

		$(".videoFancy").fadeIn(600);

		$("body").css({
			position: 'fixed',
			top: _scrollTop*-1,
			'overflow-y': 'scroll'
		});
	})

	$("#videoClose, .fancyCloseBlock").on("click", function () {
		$("body").css('position','static').scrollTop(parseInt($("body").css("top"), 10)*-1);

		$(".videoFancy").fadeOut(600, function () {
			players[_nowPlayer].stopVideo();
			$(".ytplayer").eq(_nowPlayer).hide()
		});
	})
</script>