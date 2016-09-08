http://labs.rampinteractive.co.uk/touchSwipe/demos/index.html

<script src="js/jquery.touchSwipe.min.js"></script>

<script>
	$("#mobile-container").swipe( {
		swipeUp:function(event, direction, distance, duration, fingerCount) {
			TweenMax.pauseAll();
			TweenMax.to($("#mobile-container"), 0.2, {
				top: '-=200',
				ease: Power3.easeOut,
				onComplete: function  () {
					_mobile_move();
				}
			})
		},
	});
</script>