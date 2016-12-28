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