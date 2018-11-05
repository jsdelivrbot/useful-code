<script src="js/crossfade.jquery.js"></script>

<script>
	$(".ryder-blur").crossfade({
		start: 'images/for-company/3d@blur.png',
		end: 'images/for-company/3d.png',
		threshold: 0.4,
		offset: 550
	})
</script>



<!-- canvas -->
<canvas id="canvas-sock" width="300" height="247"></canvas>

<script>
	var scale = {
		value: 25
	};

	var canvas = document.getElementById("canvas-sock");
	var ctx = canvas.getContext("2d");
	ctx.imageSmoothingEnabled = false;

	var cw = canvas.width;
	var ch = canvas.height;

	var img = new Image();
	img.src = "images/sockforcanvas.jpg";

	function sock_pixel() {
		TweenMax.to(scale, 2, {
			value: 1,
			ease: Linear.easeNone,
			onUpdate: sock_update
		});
	}

	function sock_update() {
		var sw = cw / scale.value;
		var sh = ch / scale.value;
		ctx.drawImage(img, 0, 0, sw, sh);
		ctx.drawImage(canvas, 0, 0, sw, sh, 0, 0, cw, ch);
	}
</script>