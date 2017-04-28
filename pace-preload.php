add down below at line 296:
Pace.trigger('update', this.progress);

<script src="js/pace.js"></script>

<script>
	Pace.on("update", function(percent){
		$(".preloadWrap").stop(true).animate({
			width: percent + '%'
		}, 500)
	});

	Pace.on("done", function(percent){
		setTimeout(function () {
			$(".preloadWhiteBlock").hide()
			$(".preloadWrap .logo").animate({
				opacity: 1
			}, 800, preloadend)
		}, 500)
	});
</script>