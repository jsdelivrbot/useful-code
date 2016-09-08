<script src="js/jquery.shuffleLetters.js"></script>

<script>
	$(".ryder-deco-title").mouseenter(function () {
		$(".randomText").shuffleLetters({
			"step": 14,
			"fps": 19,
			"text" : ""
		});
	})
</script>