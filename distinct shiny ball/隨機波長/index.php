<canvas id="waves"></canvas>

<script src="sine-waves.js"></script>
<script>
	var waves = new SineWaves({
	  el: document.getElementById('waves'),

	  speed: 4,

	  width: function() {
	    return $(window).width();
	  },

	  height: function() {
	    return $(window).height();
	  },

	  ease: 'SineInOut',

	  wavesWidth: '105%',

	  waves: [
	    {
	      timeModifier: 1,
	      lineWidth: 1,
	      amplitude: 110,
	      wavelength: 100,
	    },
	    {
	      timeModifier: 1,
	      lineWidth: 2,
	      amplitude: 130,
	      wavelength: 120,
	    },
	    {
	      timeModifier: 1.5,
	      lineWidth: 1,
	      amplitude: 90,
	      wavelength: 120,
	    },
	    {
	      timeModifier: 1.5,
	      lineWidth: 2,
	      amplitude: 130,
	      wavelength: 120,
	    },
	    {
	      timeModifier: 1.5,
	      lineWidth: 1,
	      amplitude: 110,
	      wavelength: 100,
	    },
	  ],

	  // Resize
	  resizeEvent: function() {
	    var gradient1 = this.ctx.createLinearGradient(0, 0, this.width, 0);
	    gradient1.addColorStop(0,"#0082cc");
	    gradient1.addColorStop(0.2,"#ffffff");
	    gradient1.addColorStop(0.4,"#0082cc");
	    gradient1.addColorStop(0.5,"#ffffff");
	    gradient1.addColorStop(0.7,"#0082cc");
	    gradient1.addColorStop(0.9,"#ffffff");
	    gradient1.addColorStop(1,"#0082cc");

	    var gradient2 = this.ctx.createLinearGradient(0, 0, this.width, 0);
	    gradient2.addColorStop(0,"#0082cc");
	    gradient2.addColorStop(0.4,"#ffffff");
	    gradient2.addColorStop(0.7,"#0082cc");
	    gradient2.addColorStop(0.9,"#ffffff");
	    gradient2.addColorStop(1,"#0082cc");

	    var gradient3 = this.ctx.createLinearGradient(0, 0, this.width, 0);
	    gradient3.addColorStop(0,"#0082cc");
	    gradient3.addColorStop(0.2,"#ffffff");
	    gradient3.addColorStop(0.6,"#0082cc");
	    gradient3.addColorStop(0.8,"#ffffff");
	    gradient3.addColorStop(1,"#0082cc");

	    var gradient4 = this.ctx.createLinearGradient(0, 0, this.width, 0);
	    gradient4.addColorStop(0,"#0082cc");
	    gradient4.addColorStop(0.1,"#ffffff");
	    gradient4.addColorStop(0.4,"#0082cc");
	    gradient4.addColorStop(0.6,"#ffffff");
	    gradient4.addColorStop(1,"#0082cc");

	    var gradient5 = this.ctx.createLinearGradient(0, 0, this.width, 0);
	    gradient5.addColorStop(0,"#0082cc");
	    gradient5.addColorStop(0.3,"#ffffff");
	    gradient5.addColorStop(0.6,"#0082cc");
	    gradient5.addColorStop(0.9,"#ffffff");
	    gradient5.addColorStop(1,"#0082cc");

	    var color=[gradient1, gradient2, gradient3, gradient4, gradient5];

	    var index = -1;
	    var length = this.waves.length;
		  while(++index < length){
	      this.waves[index].strokeStyle = color[index];
	    }

	    // Clean Up
	    index = void 0;
	    length = void 0;
	    gradient1 = void 0;
	    gradient2 = void 0;
	    gradient3 = void 0;
	    gradient4 = void 0;
	    gradient5 = void 0;
	  }
	});
</script>