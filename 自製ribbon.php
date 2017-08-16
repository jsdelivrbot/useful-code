<style>
	#ribbon{
		z-index: -1;
		position: fixed;
		width: 100%;
		height: 100%;
		top: 0;
		left: 0;
		pointer-events: none;
		span{
			display: block;
			position: absolute;
			top: 0;
			left: 200px;
			width: 7px;
			height: 7px;
			background-color: red;
			transform: rotateZ(43deg);
		}
	}
</style>

<div id="ribbon"></div>

<script>
	// 飄落的彩帶

	var $ribbon = $("#ribbon");
	var _color = ['#faa712', '#ffa8b2', '#b4b435'];
	var _ribbonTime = 0;

	_ribbon();

	function _ribbon() {
		if (_ribbonTime % 30 == 0) {
			_ribbon_add(Math.random() * 2 + 10);
		}

		if (_ribbonTime >= 99999) {
			_ribbonTime = 0;
		}

		_ribbonTime += 1;

		requestAnimationFrame(_ribbon);
	}

	function _ribbon_add(time) {
		var _l = parseInt(Math.random() * _w);
		var _z = parseInt(Math.random() * 360);
		var _c = parseInt(Math.random() * 3);

		var _id = "ribbon--" + Math.random() * 99999;

		$("<span id='" + _id + "' style='left: " + _l + "px; transform: rotateZ(" + _z + "deg); background-color: " + _color[_c] + ";'>").appendTo($ribbon);

		_rain(document.getElementById(_id), time);
	}

	function _rain(e, time) {
		TweenMax.to(e, Math.random(), {
			rotationX: 360,
			repeat: -1,
			ease: Power0.easeNone,
			onComplete: function() {}
		});
		TweenMax.to(e, time, {
			top: '100%',
			ease: Power0.easeNone,
			onComplete: function() {
				e.remove();
			}
		});
		TweenMax.to(e, Math.random() * 2 + 0.3, {
			x: Math.random() * 20 + 20,
			repeat: -1,
			yoyo: true,
			ease: Sine.easeInOut,
			onComplete: function() {}
		});
	}
</script>