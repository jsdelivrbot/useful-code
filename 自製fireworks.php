<!-- p5js -->
<script>
	// firework
	var firework = (p) => {

		var w = $("#firework").width();
		var h = $("#firework").height();
		var fireworks = [];
		var gravity;

		p.windowResized = () => {
			w = $("#firework").width();
			h = $("#firework").height();
			p.resizeCanvas(w, h);
		}

		p.setup = () => {
			var cnv = p.createCanvas(w, h);
			p.colorMode(p.RGB);
			gravity = p.createVector(0, 0.2);
			p.background(182, 56, 48);
		};

		p.draw = () => {
			p.background(182, 56, 48, 150);

			if (p.random() < 0.01) {
				fireworks.push(new Firework());
			}

			for (var i = fireworks.length - 1; i >= 0; i--) {
				fireworks[i].update();
				fireworks[i].show();
				if (fireworks[i].done()) {
					fireworks.splice(i, 1);
				}
			}
		};

		function Particle(x, y, r, g, b, firework, lifespan, velX, velY) {

		    this.firework = firework;
		    this.lifespan = lifespan;

		    if (this.firework) {
		        this.vel = p.createVector(p.random(1, 2), p.random(-15, -20));
		    } else {
		        this.vel = p.createVector(velX, velY);

		    }

		    this.pos = p.createVector(x, y);
		    this.acc = p.createVector(0, 0);

		    this.applyForce = function(force) {
		        this.acc.add(force);
		    }

		    this.done = function() {
		        return this.lifespan <= 0;
		    }

		    this.update = function() {
		        if (!this.firework) {
		            this.vel.mult(p.random(0.95, 0.97));
		            this.lifespan -= 4;
		        }
		        this.vel.add(this.acc);
		        this.pos.add(this.vel);
		        this.acc.mult(0);
		    }

		    this.show = function() {

		        if (!this.firework) {
		            p.strokeWeight(3);
		            p.stroke(r, g, b, this.lifespan);
		        } else {
		            p.strokeWeight(5);
		            p.stroke(r, g, b);
		        }

		        p.point(this.pos.x, this.pos.y);
		    }
		}

		function Shapes() {

		    this.getRandomShape = function() {
		        var index = p.random(0, 2);
		        if (index < 1) {
		            return this.circle();
		        } else if (index < 2) {
		            return this.completelyRandom();
		        }
		    }

		    this.circle = function() {
		        var vectors = [];
		        for (var i = 0; i < 50; i++) {
		            var vec = p5.Vector.random2D();
		            vec = vec.mult(10);
		            vectors.push(vec);
		        }
		        return vectors;
		    }

		    this.completelyRandom = function() {
		        var vectors = [];
		        for (var i = 0; i < 50; i++) {
		            var vec = p5.Vector.random2D();
		            vec = vec.mult(p.random(1, 10));
		            vectors.push(vec);
		        }
		        return vectors;
		    }
		}

		function Firework() {

		    this.r = 193;
		    this.g = 153;
		    this.b = 107;

		    this.firework = new Particle(p.random(p.width), p.height, this.r, this.g, this.b, true);
		    this.exploded = false;
		    this.particles = [];

		    this.done = function() {
		        return this.exploded && this.particles.length == 0;
		    }

		    this.update = function() {
		        if (!this.exploded) {
		            this.firework.applyForce(gravity);
		            this.firework.update();
		            if (this.firework.vel.y >= 0) {
		                this.exploded = true;
		                this.explode();
		            }
		        }
		        for (var i = this.particles.length - 1; i >= 0; i--) {
		            this.particles[i].applyForce(gravity);
		            this.particles[i].update();
		            this.particles[i].show();
		            if (this.particles[i].done()) {
		                this.particles.splice(i, 1);
		            }
		        }

		    }

		    this.explode = function() {
		        var shapes = new Shapes().getRandomShape();
		        for (var i = 0; i < shapes.length; i++) {
		            var dot = new Particle(this.firework.pos.x, this.firework.pos.y, 193, 153, 107, false, p.random(350, 550), shapes[i].x, shapes[i].y);
		            this.particles.push(dot);
		        }
		    }

		    this.show = function() {
		        if (!this.exploded) {
		            this.firework.show();
		        }
		    }
		}
	};

	new p5(firework, 'firework');
</script>






<!-- 只會在 #fireworkWrap 這個div範圍放 -->

<style>
	div[id^='fireworkWrap']{
		z-index: -1;
		position: absolute;
	    width: 188px;
	    height: 80px;
	    top: 14px;
	    left: 50%;
	    margin-left: -94px;
		.firework{
			display: none;
			position: absolute;
			bottom: 0;
			left: -9999px;
		}
		div[class^='fw']{
			position: absolute;
			top: -9999px;
			left: -9999px;
		}
	}
</style>

<div id="fireworkWrap">
	<div class="firework">
		<svg xmlns="http://www.w3.org/2000/svg" width="5.13" height="4.81" viewBox="0 0 5.13 4.81">
		    <defs>
		        <style>
			        .svgStyle-firework {
			            fill: #faa712;
			            fill-rule: evenodd;
			        }
		        </style>
		    </defs>
		    <polygon class="svgStyle-firework" points="5.13 2.41 3.35 2.62 3.87 3.66 2.82 3.04 2.51 4.81 2.19 3.04 1.15 3.66 1.78 2.72 0 2.41 1.78 2.09 1.15 1.15 2.19 1.78 2.51 0 2.93 1.68 3.87 1.05 3.35 2.09 5.13 2.41" />
		</svg>
	</div>

	<div class="fw-star1">
		<svg xmlns="http://www.w3.org/2000/svg" width="2.41" viewBox="0 0 2.41 2.3">
		    <path class="svgStyle-firework" d="M2.41.94c-.11.1-.31.21-.52.42a1.58,1.58,0,0,0,.21.84L2,2.3a4.69,4.69,0,0,0-.73-.42,4.59,4.59,0,0,1-.73.42V2.2a.52.52,0,0,1,.1-.31.79.79,0,0,0,.11-.42,1.33,1.33,0,0,0-.31-.21C.21,1,.1.94,0,.94A3.87,3.87,0,0,0,.94.73,1.83,1.83,0,0,1,1.26,0h0a5.83,5.83,0,0,0,.42.84h.73Z" />
		</svg>
	</div>

	<div class="fw-star2">
		<svg xmlns="http://www.w3.org/2000/svg" width="3.242" viewBox="0 0 2.41 2.3">
		    <path class="svgStyle-firework" d="M2.41.94c-.11.1-.31.21-.52.42a1.58,1.58,0,0,0,.21.84L2,2.3a4.69,4.69,0,0,0-.73-.42,4.59,4.59,0,0,1-.73.42V2.2a.52.52,0,0,1,.1-.31.79.79,0,0,0,.11-.42,1.33,1.33,0,0,0-.31-.21C.21,1,.1.94,0,.94A3.87,3.87,0,0,0,.94.73,1.83,1.83,0,0,1,1.26,0h0a5.83,5.83,0,0,0,.42.84h.73Z" />
		</svg>
	</div>

	<div class="fw-star3">
		<svg xmlns="http://www.w3.org/2000/svg" width="2.51" viewBox="0 0 2.41 2.3">
		    <path class="svgStyle-firework" d="M2.41.94c-.11.1-.31.21-.52.42a1.58,1.58,0,0,0,.21.84L2,2.3a4.69,4.69,0,0,0-.73-.42,4.59,4.59,0,0,1-.73.42V2.2a.52.52,0,0,1,.1-.31.79.79,0,0,0,.11-.42,1.33,1.33,0,0,0-.31-.21C.21,1,.1.94,0,.94A3.87,3.87,0,0,0,.94.73,1.83,1.83,0,0,1,1.26,0h0a5.83,5.83,0,0,0,.42.84h.73Z" />
		</svg>
	</div>

	<div class="fw-circle1">
		<svg xmlns="http://www.w3.org/2000/svg" width="0.961" viewBox="0 0 1.36 1.36">
		    <path class="svgStyle-firework" d="M.63,0a.7.7,0,0,1,.73.63.7.7,0,0,1-.63.73A.7.7,0,0,1,0,.73.7.7,0,0,1,.63,0Z" />
		</svg>
	</div>

	<div class="fw-circle2">
		<svg xmlns="http://www.w3.org/2000/svg" width="1.359" viewBox="0 0 1.36 1.36">
		    <path class="svgStyle-firework" d="M.63,0a.7.7,0,0,1,.73.63.7.7,0,0,1-.63.73A.7.7,0,0,1,0,.73.7.7,0,0,1,.63,0Z" />
		</svg>
	</div>

	<div class="fw-circle3">
		<svg xmlns="http://www.w3.org/2000/svg" width="1.045" viewBox="0 0 1.36 1.36">
		    <path class="svgStyle-firework" d="M.63,0a.7.7,0,0,1,.73.63.7.7,0,0,1-.63.73A.7.7,0,0,1,0,.73.7.7,0,0,1,.63,0Z" />
		</svg>
	</div>

	<div class="fw-circle4">
		<svg xmlns="http://www.w3.org/2000/svg" width="1.463" viewBox="0 0 1.36 1.36">
		    <path class="svgStyle-firework" d="M.63,0a.7.7,0,0,1,.73.63.7.7,0,0,1-.63.73A.7.7,0,0,1,0,.73.7.7,0,0,1,.63,0Z" />
		</svg>
	</div>

	<div class="fw-circle5">
		<svg xmlns="http://www.w3.org/2000/svg" width="0.941" viewBox="0 0 1.36 1.36">
		    <path class="svgStyle-firework" d="M.63,0a.7.7,0,0,1,.73.63.7.7,0,0,1-.63.73A.7.7,0,0,1,0,.73.7.7,0,0,1,.63,0Z" />
		</svg>
	</div>

	<div class="fw-shine">
		<svg xmlns="http://www.w3.org/2000/svg" width="2.2" viewBox="0 0 2.2 2.09">
		    <polygon class="svgStyle-firework" points="2.2 1.05 1.26 1.15 1.15 2.09 0.94 1.26 0 1.05 0.94 0.84 1.05 0 1.26 0.84 2.2 1.05" />
		</svg>
	</div>
</div>

<script>
	// fireworks

	var $fireworkWrap=$("#fireworkWrap");
	var $fireworkWrap_w=$("#fireworkWrap").width();
	var $fireworkWrap_h=$("#fireworkWrap").height();
	var _fireworkTime = 0;

	// _firework();

	function _firework() {
		if (_fireworkTime % 33 == 0 && Math.random() > 0.1) {
			_firework_add();
		}

		if (_fireworkTime >= 99999) {
			_fireworkTime = 0;
		}

		_fireworkTime += 1;

		requestAnimationFrame(_firework);
	}

	function _firework_add() {
		var $shadow=$fireworkWrap.clone().attr("id", "fireworkWrap-" + parseInt(Math.random() * 99999));
		$shadow.appendTo($fireworkWrap.parent());
		var $firework=$shadow.find(".firework");
		var $booms=[
			$shadow.find(".fw-star1"),
			$shadow.find(".fw-star2"),
			$shadow.find(".fw-star3"),
			$shadow.find(".fw-circle1"),
			$shadow.find(".fw-circle2"),
			$shadow.find(".fw-circle3"),
			$shadow.find(".fw-circle4"),
			$shadow.find(".fw-circle5"),
			$shadow.find(".fw-shine"),
		];

		$firework.show();

		$firework.css({
			left: parseInt(Math.random() * $fireworkWrap_w) + 'px'
		})

		TweenMax.to($firework, 0.8, {
			x: '+=' + (Math.random() * 60 - 30),
			y: '-='  + (Math.random() * $fireworkWrap_h),
			ease: Power1.easeOut,
			onComplete: function () {
				$firework.fadeOut(500);

				var _x=$firework.position().left;
				var _y=$firework.position().top;

				for (var i in $booms) {
					$booms[i].css({
						top: _y,
						left: _x
					})

					TweenMax.to($booms[i], 1.2, {
						x: '+=' + (Math.random() * 60 - 30),
						y: '-=' + (Math.random() * 60 - 30),
						opacity: 0,
						onComplete: function () {
							$shadow.remove();
						}
					});
				}
			}
		});
	}
</script>