<script>
	var idle_time = 0;
	var idleTimer = null;

	clearInterval(idleTimer);  //使用前清一次  不然容易出錯
	idleTimer = setInterval(idleFunc, 1000);

	function idleFunc() {
		idle_time+=1;

		if (idle_time>2) {
			clearInterval(idleTimer);
			idle_time=0;

			// code here
		}

		// console.log(idle_time);
	}

	$('*').bind('mousemove keydown scroll', function() {
		idle_time=0;
	});
</script>