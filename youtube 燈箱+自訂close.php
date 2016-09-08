<!-- youtube api -->
https://developers.google.com/youtube/player_parameters#start

<script>
	$("#index_video").on("click", function () {
	  player.playVideo();
	})
</script>

<!-- 使用iframe (自訂title與content)-->
<div class="fancyWrap">
	<div class="fancyContainer">
		<div class="cover">
			<iframe id="vedio" width="714" height="468" src="http://www.youtube.com/embed/P92oRX-LJac" allowfullscreen></iframe>
		</div>
		<div class="titleArea">
			<div class="date">2016 Jan. 12</div>
			<div class="title">20150501 奧比薩克思在建中演講</div>
			<div class="close"><img src="images/fancy-close.png" width="71"></div>
		</div>
		<div class="content">
			希望藉由這次和奧比．薩克思的跨世代對談，高中生們可以從唐獎得獎人的生涯歷程及理念­，找出他們的成功特質來激勵自己奮鬥向前，也寄望優秀年輕學子，能在不久的將來拿到唐­獎，為台灣及母校爭光，並為世界做出貢獻。
		</div>
	</div><!-- fancyContainer end -->
</div><!-- fancyWrap end -->

<script>
	var stopVideo = function(player) {
		var vidSrc = player.prop('src').replace('autoplay=1','autoplay=0');
		player.prop('src', vidSrc);
	};
	$(".ownerWrap li").click(function  () {
		$(".fancyWrap").fadeIn(700);
		$(".fancyWrap").css("z-index",50);
	})
	$(".close").click(function  () {
		$(".fancyWrap").fadeOut(700,function () {
			$(".fancyWrap").css("z-index","-1");
			stopVideo($(this).find("iframe"));
		});
	})
</script>


<!-- vedio only -->
http://www.jqueryscript.net/lightbox/jQuery-Lightbox-Plugin-For-Youtube-Videos-Video-Lightning.html

<script src="js/videoLightning.js"></script>

<style>
	#rrYoutubeClose{
		width: 36px;
		height: 36px;
		position: absolute;
		top: -110px;
		left: 50%;
		margin-left: -18px;
		background: url(images/close.png) no-repeat;
		background-size: 36px 36px;
	}
	#rrYoutubeClose:hover{opacity: 0.6;}
</style>

<span class="video-link" data-video-id="y-PKffm2uI4dk" data-video-width="625px" data-video-height="418px" data-video-autoplay="1" >
	<!-- code here -->
</span>

<script>
	$(".video-link").jqueryVideoLightning({
		autoplay: 1,
		backdrop_color: "#231815",
		backdrop_opacity: 0.7,
		glow: 0,
		glow_color: "#000"
	});
</script>