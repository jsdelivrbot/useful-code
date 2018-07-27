<div id="snow"></div>

<script>
	var snow = (p) => {

		var w = $("#snow").width();
		var h = $("#snow").height();
		var snowflakes = [];

		p.windowResized = () => {
			w = $("#snow").width();
			h = $("#snow").height();
			p.resizeCanvas(w, h);
		}

		p.setup = () => {
			var cnv = p.createCanvas(w, h);
			p.noStroke();
		};

		p.draw = () => {
			p.clear();
			let t = p.frameCount / 300; // update time

			// create a random number of snowflakes each frame
			if (p.random() < 0.1) {
				snowflakes.push(new snowflake());
			}

			// loop through snowflakes with a for..of loop
			for (let flake of snowflakes) {
				flake.update(t); // update snowflake position
				flake.display(); // draw snowflake
			}
		};

		function snowflake() {
			// initialize coordinates
			this.posX = 0;
			this.posY = p.random(-50, 0);
			this.initialangle = p.random(0, 2 * p.PI);
			this.size = p.random(10, 20);
			this.opacity = p.random(100, 255);

			// radius of snowflake spiral
			// chosen so the snowflakes are uniformly spread out in area
			this.radius = p.sqrt(p.random(p.pow(p.width / 2, 2)));

			this.update = function(time) {
				// x position follows a circle
				let w = 0.6; // angular speed
				let angle = w * time + this.initialangle;
				this.posX = p.width / 2 + this.radius * p.sin(angle);

				// different size snowflakes fall at slightly different y speeds
				this.posY += p.pow(this.size, 0.5);

				// delete snowflake if past end of screen
				if (this.posY > p.height) {
					let index = snowflakes.indexOf(this);
					snowflakes.splice(index, 1);
				}
			};

			this.display = function() {
				p.fill(255, this.opacity);
				p.ellipse(this.posX, this.posY, this.size);
			};
		}

	};

	new p5(snow, 'snow');
</script>