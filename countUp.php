https://inorganik.github.io/countUp.js/

<div id="tiny_per"></div>

<script src="js/countUp.js"></script>

<script>
	var _from=10;
	var _to=100.15;
	var _decimal=2;
	var _time=3;
	var options = {
		useEasing: true,
		easingFn: function(t, b, c, d) {
			t /= d/2;
			if (t < 1) return -c/2 * (Math.sqrt(1 - t*t) - 1) + b;
			t -= 2;
			return c/2 * (Math.sqrt(1 - t*t) + 1) + b;
		},
		suffix : '%'
	};

	_tiny_per = new CountUp("tiny_per", _from, _to, _decimal, _time, options);

	_tiny_per.start();
</script>