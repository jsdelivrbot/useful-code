<style>
	#canvas{
		position: absolute;
		-webkit-filter: url("#goo");
		filter: url("#goo");
	}
</style>

<svg xmlns="http://www.w3.org/2000/svg" version="1.1">
	<defs>
		<filter id="goo">
			<feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
			<feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 60 -9"/>
		</filter>
	</defs>
</svg>




<!-- use math -->
http://paulbourke.net/geometry/blobbie/

<script>
	var bubble = (p) => {

		var w = $("#bubble").width();
		var h = $("#bubble").height();
		var bubbles = [];
		var total = 5;

		p.windowResized = () => {
			w = $("#bubble").width();
			h = $("#bubble").height();
			p.resizeCanvas(w, h);
		}

		p.setup = () => {
			var cnv = p.createCanvas(w, h);
			while (total--) {
				bubbles.push(new Bubble());
			}
		};

		p.draw = () => {
			p.clear();

			for (let bubble of bubbles) {
				bubble.update();
				bubble.show();
			}
		};

		function Bubble() {
			this.a = 0;
			this.b = 0;
			this.radius = p.random(100, 200);
			this.x = p.random(p.width);
			this.y = p.random(p.height);
			this.offsetA = p.random(0.3, 0.4);
			this.offsetB = p.random(0.1, 0.2);
			this.rotate = p.random(-0.02, 0.02);
			this.offsetFps = p.random(0.001, 0.01);
			this.vx = p.random(-1, 1);
			this.vy = p.random(-1, 1);

			this.update = function() {
				var fps = p.frameCount * this.offsetFps;
				this.a = p.map(p.sin(fps), -1, 1, -0.2, this.offsetA);
				this.b = p.map(p.sin(fps), -1, 1, -0.2, this.offsetB);

				if (this.x > p.width || this.x < 0) {
					this.vx = -this.vx;
				}

				if (this.y > p.height || this.y < 0) {
					this.vy = -this.vy;
				}

				this.x += this.vx;
				this.y += this.vy;
			}

			this.show = function() {
				p.push();
				p.translate(this.x, this.y);
				p.fill('rgba(203,223,225,0.2)');
				p.stroke(255, 100);

				p.beginShape();
				for (var angle = 0; angle < p.TWO_PI; angle += 0.01) {
					var r = superShape(angle, this.a, this.b, 1, this.rotate);
					var x = r * p.cos(angle) * this.radius;
					var y = r * p.sin(angle) * this.radius;
					p.vertex(x, y);
				}
				p.endShape(p.CLOSE);
				p.pop();
			}
		}

		function superShape(angle, a, b, R, rotate) {
			return R * (1 + a * p.cos(2 * angle + p.frameCount * rotate) + b * p.cos(3 * angle));
		}
	};

	new p5(bubble, 'bubble');
</script>