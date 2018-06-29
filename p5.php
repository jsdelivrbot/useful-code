https://p5js.org/reference/

<script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.6.1/p5.min.js"></script>

<!-- if you use preload -->
<div id="p5_loading" class="loadingclass"></div>

<!--========================================
=            play images as gif            =
=========================================-->
<script>
	var maze = (p) => {

		var count = 1;
		var total = 20;
		var imgs = [];
		var w = $("#maze").width();
		var h = $("#maze").height();

		p.windowResized = () => {
			w = $("#maze").width();
			h = $("#maze").height();
			p.resizeCanvas(w, h);
		}

		p.preload = () => {
			for(let i=1; i<=total; i++){
				imgs[i] = p.loadImage('./images/maze/maze-'+ i +'.jpg');
			}
		};

		p.setup = () => {
			var cnv = p.createCanvas(w, h);
			cnv.class("m-gif");

			p.frameRate(3);
		};

		p.draw = () => {
			imgs[count].resize(p.width, 0);
			p.image(imgs[count], 0, 0);

			if (count == total) {
				count = 1;
			}else{
				count++;
			}
		};
	};

	new p5(maze, 'maze');
</script>

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


<!--===============================
=            用角度畫圓            =
================================-->
<script>
	function setup() {
		createCanvas(710, 400);
		frameRate(2);
	}

	function draw() {
		background(100);
		beginShape();
		noStroke();
		translate(width/2, height/2);
		for(var a=0; a<TWO_PI; a+=PI/5){
			var r = 150;
			var x = r*cos(a+random(1));
			var y = r*sin(a);
			curveVertex(x,y);
			ellipse(x,y,4,4);
		}
		endShape(CLOSE);
	}
</script>