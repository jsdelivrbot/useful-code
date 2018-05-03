<!-- cheet sheet -->
https://ihatetomatoes.net/wp-content/uploads/2015/08/GreenSock-Cheatsheet-2.pdf
<!-- detail -->
https://greensock.com/docs/#/HTML5/Animation/TweenMax/staggerTo/


<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js"></script>

<script>
// stop looping
TweenMax.killTweensOf($(".element"));
TweenMax.killAll();
// pauseAll
TweenMax.pauseAll();
// resumeAll
TweenMax.resumeAll();


// set
TweenMax.set(e, {
	rotationZ: 0,
	x: 0
});

// 凸出去
TweenMax.to(animated, 2, {
	right: "-80",
	ease: Back.easeOut.config(1.7),
	clearProps: 'all',
	onComplete: function() {}
});

// 彈跳more
TweenMax.to($(".brandDown"), 1.5, {
	y: '+=30',
	repeat: -1,
	yoyo: true,
	ease: Bounce.easeOut
})

// stagger
$(".ownerWrap").load(".ownerWrap li", function() {
	TweenMax.staggerTo($(".ownerWrap li"), 0.5, {
		opacity:1
	}, 0.2);
})

var c1 = TweenMax.staggerFrom($("#iaw-p2-circle li"), 2, {
	opacity: 0,
	scale: 0,
	transformOrigin:'center',
	repeat: -1,
	repeatDelay: 4,
	onUpdate: function() {
		if (this.progress() == 1) {
			$(this.target).animate({
				opacity: 0
			}, 300)
		}
	}
}, 0.2);

var green_phone_circle = new TimelineMax({
	paused: true
}).add([
	c1
])

// from to
TweenMax.fromTo($(".test"), 1.5, {
	"stroke-dashoffset": "200%",
}, {
	"stroke-dashoffset": 0,
	"stroke": color
});

// multiple tween
var phone_5 = new TimelineMax().add([
	TweenMax.to($(".fixphone .item").eq(4), 2, {
		width: 500,
		height: 500,
		onStart: function() {
			$(".fixphone .loading").show()
		},
		onComplete: function() {}
	}),
	TweenMax.to($(".fixphone .loading span"), 2, {
		width: '100%',
		delay: 2,
		onStart: function() {},
		onComplete: function() {}
	})
])

// addcallback
phone_5.addCallback(function () {
	TweenMax.to( $("#transformWrap .logo"), 0.5, {
		opacity: 1,
		onComplete() {}
	});
}, "end")

// counter
var pos = {p: 212}

TweenMax.to(pos, 3, {
	p: 0,
	roundProps: "p",
	repeat: 3,
	ease: Power0.easeNone,
	onUpdate() {
		console.log(pos.p)
	}
})
</script>


<!-- Draggable -->
https://greensock.com/docs/Utilities/Draggable
https://codepen.io/MAW/pen/aOzeNR

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.3/utils/Draggable.min.js"></script>

<svg width="320px" height="150px" version="1.1" xmlns="http://www.w3.org/2000/svg">
    <path id="path1" d="M10 80 Q 150 0 300 80" stroke="gray" stroke-dasharray="5,5" fill="transparent"/>
    <path id="path2" d="M10 80 Q 150 0 300 80" stroke-width="7" stroke="#7CFC00" fill="transparent" stroke-linecap="round"/>
    <circle class="knob" r="25" fill="#88CE02" stroke-width="4" stroke="#111"/>
</svg>

<script>
	TweenMax.set('svg', {
	    overflow: "visible"
	})
	TweenMax.set('.knob', {
	    x: 10,
	    y: 80
	})

	// drawSVG要錢
	var tl = new TimelineMax({
        paused: true
    })
    .to("#path2", 1, {
        drawSVG: "0%",
        stroke: 'orange',
        ease: Linear.easeNone
    })
    .to('.knob', 1, {
        bezier: {
            type: "quadratic",
            values: [{
                x: 10,
                y: 80
            }, {
                x: 150,
                y: 0
            }, {
                x: 300,
                y: 80
            }]
        },
        ease: Linear.easeNone
    }, 0);

    var D = document.createElement('div');

	Draggable.create(D, {
	    trigger: ".knob",
	    type: 'x',
	    throwProps: true,
	    bounds: {
	        minX: 0,
	        maxX: 300
	    },
	    onDrag: Update,
	    onThrowUpdate: Update
	});

	function Update() {
	    tl.progress(Math.abs(this.x / 300))
	};

	TweenMax.to('#path1', 0.5, {
	    strokeDashoffset: -10,
	    repeat: -1,
	    ease: Linear.easeNone
	})
</script>

<!-- Draggable rotation -->
<script>
	var t2 = new TimelineMax({
        paused: true
    })
    .to($(".waterbot .bottle"), 5, {
	    rotation: 180,
	    ease: Power0.easeNone,
	})
	.to($(".waterbot .bottle .lid"), 1, {
	    rotation: 70,
	    x: 15,
	    y: -30,
	    opacity: 0,
	    transformOrigin:'bottom right',
	    ease: Power1.easeOut
	})
	.to($(".watersplash"), 2, {
	    height: 255,
	    opacity: 0.8,
	    ease: Power1.easeOut
	})

	Draggable.create("#mobileCircle", {
		type:"rotation",
		throwProps:true,
		bounds: {
		    minX: 0,
		    maxX: 180
		},
		onDrag() {
			t2.progress(Math.abs(this.rotation / 180))
		}
	});
</script>