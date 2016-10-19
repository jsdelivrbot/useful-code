function RyderParticle (option) {
	var deFault={
		numDots : 10,
		maxRad : 100,
		minRad : 80,
		speed: 0.025
	};

	var setting=$.extend(deFault, option);

	var cvs = setting.el,
	    context = cvs.getContext("2d");

	var numDots = setting.numDots,
	    n = numDots,
	    currDot,
	    maxRad = setting.maxRad,
	    minRad = setting.minRad,
	    radDiff = maxRad-minRad,
	    dots = [],
	    PI = Math.PI,
	    centerPt = {x:0, y:0};

	var color=["#cccccc", "#0082cc", "#ffffff"];
	var colorpick;

	resizeHandler();
	window.onresize = resizeHandler;

	while(n--){
	  colorpick=Math.floor(Math.random()*3);
	  currDot = {};
	  currDot.radius = minRad+Math.random()*radDiff;
	  currDot.ang = (1-Math.random()*2)*PI;
	  currDot.speed = (1-Math.random()*2)*setting.speed;
	  currDot.fillColor = color[colorpick];
	  dots.push(currDot);
	}

	function drawPoints(){
	  n = numDots;
	  var _centerPt = centerPt,
	      _context = context,
	      dX = 0,
	      dY = 0;

	  _context.clearRect(0, 0, cvs.width, cvs.height);

	  //draw dots
	  while(n--){
	    currDot = dots[n];
	    dX = _centerPt.x+Math.sin(currDot.ang)*currDot.radius;
	    dY = _centerPt.y+Math.cos(currDot.ang)*currDot.radius;

	    currDot.ang += currDot.speed;

	    //console.log(currDot);
	    _context.beginPath();
	    _context.fillStyle= currDot.fillColor;
	    // _context.fillRect(dX, dY, 3, 3);
	    _context.arc(dX, dY, 2, 0, 2*Math.PI);
	    _context.fill();

	  } //draw dot
	  window.requestAnimationFrame(drawPoints);
	}

	function resizeHandler(){
	  var box = cvs.getBoundingClientRect();
	  var w = box.width;
	  var h = box.height;
	  cvs.width = w;
	  cvs.height = h;
	  centerPt.x = Math.round(w/2);
	  centerPt.y = Math.round(h/2);
	}

	drawPoints();
}