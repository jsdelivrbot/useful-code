if ( !window.requestAnimationFrame ) {
	window.requestAnimationFrame = ( function() {
		return window.webkitRequestAnimationFrame ||
		window.mozRequestAnimationFrame ||
		window.oRequestAnimationFrame ||
		window.msRequestAnimationFrame ||
		function( /* function FrameRequestCallback */ callback, /* DOMElement Element */ element ) {
			window.setTimeout( callback, 1000 / 60 );
		};
	} )();
}


$(document).ready(function(){
	container = document.createElement('div');
	container.id = 'intrologo';
	container.innerHTML = " \n";

	var wrapper = document.getElementById('intro');
	wrapper.appendChild(container);

	logoF();
});


var particles = [];
var perlin = new ImprovedNoise();
var mouseX,mouseY;
var targetX = 0;
var targetY = 0;
var targetRadius = 0;
var ctx,ctxRef;
var canvas,canvasRef,canvasContainer;

var initTime = (new Date()).getTime();
var isDelayPassed = false;


function initParticles(){
	$(window).on('mousemove.splash', onWindowMouseMove);
	animate();
}
//Function: on mouse move
function onWindowMouseMove(e)
{
	e.preventDefault();

	mouseX = e.clientX-$(canvasContainer).offset().left;
	mouseY = e.clientY-$(canvasContainer).offset().top;
	targetX += (mouseX-targetX)*0.2;
	targetY += (mouseY-targetY)*0.2;


}

function animate() {
	requestAnimationFrame( animate );

	//stats.update();
	update();

	if(isDelayPassed || (new Date()).getTime() - initTime > 1){ // delay before flowers
		isDelayPassed = true;
		draw();
	}
}
//Function : Update the particles position, scale and rotation
function update(){
	for(var i=0;i<particles.length;i++){
		var p = particles[i];

		//Get distance between mouse and particle to calculate repulsion force
		var distancex = mouseX-p.posX;
		var distancey = mouseY-p.posY;
		var distance = Math.sqrt((distancex * distancex) + (distancey * distancey));

		if(p.isAffected){
			var powerx = -(distancex/distance)*p.charge;
			var powery = -(distancey/distance)*p.charge;

			//add repulsion force from the mouse
			p.posX += powerx;
			p.posY += powery;
		}

		//Get distance between mouse and particle origin to see if particles should be affected by the mouse
		var distanceorx = mouseX-p.orX;
		var distanceory = mouseY-p.orY;
		var distanceor = Math.sqrt((distanceorx * distanceorx) + (distanceory * distanceory));

		//If the distance is less than 60 the particle gets affected
		if(distanceor<30){ //數量
			p.isAffected = true;
		}
		//If the distance is more than 100 the particle gets desaffected
		else if(distanceor>50){ //數量
			//this is there to give some delay between the particle being desaffected and the particle animating back
			if(!p.isOut){
				p.isOut = true;
			}
			else{
				p.outCount++;
				if(p.outCount>p.outDest){
					//Particle gets desaffected
					p.isAffected = false;
					p.isOut = false;
					p.outCount = 0;
				}
			}
		}

		//add force that brings the particle back to it's origin
		p.posX += (p.orX-p.posX)*0.2;//數字越小範圍越大
		p.posY += (p.orY-p.posY)*0.2;//數字越小範圍越大

		//add noise force
		if(p.isAffected){
			//Update scale
			var chargePerc = 1-((p.charge-23)/15);
			var noise = (perlin.noise(p.scaleNoise,0,0))*10;
			p.scale += ((chargePerc*30+noise)-p.scale)*0.2;

			//Add noise to position
			var noisex = perlin.noise(p.offX,0,0);
			var noisey = perlin.noise(p.offY,0,0);
			p.posX += noisex*p.scale*p.noiseAmount;
			p.posY += noisey*p.scale*p.noiseAmount;
			p.offX += p.randSpeed;
			p.offY += p.randSpeed;
		}
		else{
			//Update scale back to 0
			p.scale += -p.scale*0.2;
		}

		//Update scale noise offset
		p.scaleNoise+=p.scaleNoiseSpeed;

		//Update distance to origin
		distanceorx = p.posX-p.orX;
		distanceory = p.posY-p.orY;
		distanceor = Math.sqrt((distanceorx * distanceorx) + (distanceory * distanceory));
		p.dist = distanceor;

		//Update angle
		p.angle = calcAngle(p.orX,p.posX,p.orY,p.posY);
	}
}
//Function : Calculate angle between 2 points
function calcAngle(x1, x2, y1, y2){
	var calcAngle = Math.atan2(x1-x2,y1-y2);
	return calcAngle;
}
function draw(){
	//Clear canvas
	ctx.clearRect(0,0,canvas.width,canvas.height);
	ctxRef.clearRect(0,0,canvasRef.width,canvasRef.height);

	//Draw the filled text to the ref canvas
	ctxRef.globalCompositeOperation = 'source-over';
	ctxRef.drawImage(ref_image,(canvas.width-ref_image.width)/2,(canvas.height-ref_image.height)/2);

	var maskRadius = 0;
	var posY = 0;
	var pLength = 0;

	for(var i=0;i<particles.length;i++){
		var p = particles[i];

		//If the distance of the particle from it's origin is higher than 10px, draw the particle
		if(p.dist>10){
			ctx.save();
			ctx.translate(p.posX,p.posY);
			ctx.scale(p.scale*0.03,p.scale*0.03);
			ctx.rotate(p.angle);
			ctx.drawImage(p.sprite,-70,-70);
			ctx.restore();

			//Get the highest distance to define the mask radius
			if(p.dist>maskRadius){
				maskRadius = p.dist;
			}
			//Get the average position of particles on the Y axis to define the mask y position
			posY += p.orY;
			pLength++;
		}
	}

	//Calculate average Y position of particles
	if(pLength != 0){
		posY /= pLength;
	}

	//Add smoothing to the mask radius
	targetRadius += (maskRadius-targetRadius)*0.5;
	//Make sure final radius is not negative
	var radius = targetRadius;
	var radius2 = targetRadius-30;
	if(radius<0){
		radius = 0;
	}
	if(radius2<0){
		radius2 = 0;
	}

	//Draw the first mask cirlce, opacity 50%
	ctxRef.globalCompositeOperation = 'destination-out';
	ctxRef.fillStyle = "rgba(0,0,0,0.5)";
	ctxRef.beginPath();
	ctxRef.arc(targetX,posY,radius,0,Math.PI*2,true);
	ctxRef.fill();
	ctxRef.closePath();

	//Draw the second mask radius
	ctxRef.fillStyle = "rgba(0,0,0,1)";
	ctxRef.beginPath();

	ctxRef.arc(targetX,posY,radius2,0,Math.PI*2,true);
	ctxRef.fill();
	ctxRef.closePath();
}

var ref_image = new Image();
ref_image.src = 'images/logo.png';

ref_image.onload = function(){
	//On image load, create canvas
	canvasContainer = document.createElement('div');
	canvasContainer.style.position = 'absolute';
	canvasContainer.style.width = (ref_image.width+350)+'px';
	canvasContainer.style.height = (ref_image.height+180)+'px';
	canvasContainer.style.top = '50%';
	canvasContainer.style.left = '50%';
	canvasContainer.style.marginTop = (-(ref_image.height+180)/2)+'px';
	canvasContainer.style.marginLeft = (-(ref_image.width+350)/2)+'px';
	//canvasContainer.style.backgroundColor="#FF0000";
	//container.appendChild(canvasContainer);


	canvasRef = document.createElement("canvas");
	canvasRef.width = ref_image.width+350;
	canvasRef.height = ref_image.height+180;
	canvasContainer.appendChild(canvasRef);

	canvas = document.createElement("canvas");
	canvas.width = ref_image.width+350;
	canvas.height = ref_image.height+180;
	canvas.style.position = 'absolute';
	canvas.style.top = '0px';
	canvas.style.left = '0px';
	canvasContainer.appendChild(canvas);

	if(!canvasRef.getContext){
		noScript();
	}else{
		ctxRef = canvasRef.getContext('2d');
		ctx = canvas.getContext('2d');

		container.appendChild(canvasContainer);

	//Draw ref image on ref canvas
	ctxRef.drawImage(ref_image,(canvasRef.width-ref_image.width)/2,(canvasRef.height-ref_image.height)/2);
	//Get the pixels of the image
	var pixels = ctxRef.getImageData(0 ,0 ,canvasRef.width ,canvasRef.height);
	//Run through all the pixel to create particles where there is text
	for(var i=0;i<canvasRef.width;i++){
		for(var j=0;j<canvasRef.height;j++){
			//Get the alpha of that pixel
			var a = pixels.data[(i+(canvasRef.width*j))*4+3];
			//If alpha is more than 0, create a particle at that position
			if(a>50 && Math.random()>0.97){
				particles.push({
					dist:0,
					posX:i,posY:j,
					orX:i,orY:j,
					isAffected:false,
					isOut:false,
					outDest:Math.random()*15,
					outCount:0,
					charge:Math.random()*15+25,
					scale:0,
					scaleNoise:Math.random(),
					scaleNoiseSpeed:Math.random()*0.005,
					offX:Math.random(),offY:Math.random(),
					noiseAmount:Math.random()*0.1,
					randSpeed:Math.random()*0.001,
					angle : 0,
					sprite:flowers[Math.floor(Math.random()*flowers.length)]
				});
			}
		}
	}


	initParticles();
}
}
function noScript(){
	var $container2 = $( parent.document.createElement("div")  );
	$container2.attr("id","intrologo2");
	$('#intro').append($container2);
}
function logoF(){
	var $container3 = $( parent.document.createElement("div")  );
	$container3.attr("id","intrologo3");
	$('#intro').append($container3);
}

//Init flowers sprites
var flower1 = new Image();
flower1.src = 'images/test-1.png';
var flower2 = new Image();
flower2.src = 'images/test-2.png';
var flower3 = new Image();
flower3.src = 'images/test-3.png';
var flower4 = new Image();
flower4.src = 'images/test-4.png';
var flower5 = new Image();
flower5.src = 'images/flower5.png';
var flower6 = new Image();
flower6.src = 'images/flower6.png';

var flowers = [flower1,flower2,flower3,flower4,flower5,flower6];