// Ryder 自製閒置
<script>
	var idle_time=0;
	var idleTimer = null;

	idleTimer = setInterval(idleFunc, 1000);

	function idleFunc() {
		idle_time+=1;
		console.log(idle_time);

		if (idle_time>2 && _scrollTop==0) {
			clearInterval(idleTimer);

			var _random = Math.ceil(Math.random()*4);
			var _src = $(".videoList li").eq(_random).data("src");
			video.src = _src;
			video.load(); //update

			$(".videoFancy").fadeIn(600, function() {
			    video.currentTime = 0; //restart
			    video.play();

				$(video).on("ended", function () {
					setTimeout(function () {
						_random = Math.ceil(Math.random()*4);
						_src = $(".videoList li").eq(_random).data("src");
						video.src = _src;
						video.load(); //update
						video.currentTime = 0; //restart
						video.play();
					}, 2000)
				})
			});

			$("body").css({
				position: 'fixed',
				top: _scrollTop*-1,
				'overflow-y': 'scroll'
			});

			$("#videoClose").on("click", function () {
				$("body").css('position','static').scrollTop(parseInt($("body").css("top"), 10)*-1);
				$(".videoFancy").fadeOut(600);
				video.pause();

				idleTimer = setInterval(idleFunc, 1000);
			})
		}
	}

	$('*').bind('mousemove keydown scroll', function() {
		idle_time=0;
	});
</script>


<script>
	var idleTimer = null;
	var idleState = false;
	var idleWait = 6000;

	(function($) {
		$('*').bind('mousemove keydown scroll', function() {
			clearTimeout(idleTimer);
			if (idleState == true) {
				// Reactivated event
				console.log("back");
			}
			idleState = false;
			idleTimer = setTimeout(function() {
				var _random = Math.ceil(Math.random()*4);
				$(".videoList li").eq(_random).trigger("click");

				idleState = true;
			}, idleWait);
		});
	})(jQuery)
</script>