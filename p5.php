https://p5js.org/reference/

<script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.6.1/p5.min.js"></script>


<!--================================
=            自製 gooey            =
=================================-->
<style>
	#rydercanvas{
		position: fixed;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
		-webkit-filter: url("#goo");
		filter: url("#goo");
	}
</style>

<svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="0" height="0">
	<defs>
		<filter id="goo">
			<feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
			<feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 60 -9"/>
		</filter>
	</defs>
</svg>

<script>
	class Ball{
		constructor(x, y, r, dx, dy){
			this.x = random(windowWidth);
			this.y = random(windowHeight);
			this.r = random(50, 60);
			this.dx = random(-1, 1);
			this.dy = random(-2, 2);
		}

		update() {
			this.x += this.dx
			this.y += this.dy

			if (this.x > windowWidth || this.x < 0) {
				this.dx *= -1;
			}

			if (this.y > windowHeight || this.y < 0) {
				this.dy *= -1;
			}

			fill(0);
			ellipse(this.x, this.y, this.r);
		}
	}

	var balls = [];
	var total = 50;

	function setup() {
		var canvas = createCanvas(windowWidth, windowHeight);

		canvas.id('rydercanvas');

		for(var i = 0; i <= total; i++){
			balls.push(new Ball)
		}
	}

	function draw() {
		clear();
		balls.forEach( function(element, index) {
			element.update();
		});
	}

	function windowResized() {
		resizeCanvas(windowWidth, windowHeight);
	}
</script>