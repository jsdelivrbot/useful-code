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
TweenMax.staggerTo($(".ownerWrap li"), 0.5, {
	opacity: 1
}, 0.2);

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
// 用delay可控制播放時間
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


// 可在to後面控制播放時間
var app_home_1 = new TimelineMax({
	paused: true
}).to($("#index-app-home .one .st1"), 1.5, {
	"stroke-dashoffset": 0,
}).to($("#index-app-home-stripe"), .5, {
	opacity: 1
}, 0.5)


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


// clip-path: polygon(48% 36%, 52% 36%, 52% 40%, 48% 40%);
var arr1 = [50, 50, 50, 50, 50, 50, 50, 50];
var arr2 = [0, 0, 100, 0, 100, 100, 0, 100];

arr2.onUpdate = function() {
	TweenMax.set($(".products-banner-container"), {
		webkitClipPath: 'polygon(' + arr1[0] + '%' + arr1[1] + '%,' + arr1[2] + '%' + arr1[3] + '%,' + arr1[4] + '%' + arr1[5] + '%,' + arr1[6] + '%' + arr1[7] + '%)'
		clipPath: 'polygon(' + arr1[0] + '%' + arr1[1] + '%,' + arr1[2] + '%' + arr1[3] + '%,' + arr1[4] + '%' + arr1[5] + '%,' + arr1[6] + '%' + arr1[7] + '%)'
	});
};

arr2.ease = Expo.easeInOut;
arr2.repeat = -1;
arr2.repeatDelay = 1;

TweenMax.to(arr1, 3, arr2);

</script>


<!-- Draggable -->
https://greensock.com/docs/Utilities/Draggable
https://codepen.io/MAW/pen/aOzeNR

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.3/utils/Draggable.min.js"></script>


<!-- drag 換圖 -->
<script>
	var startScore_m = {score: 0}
	var imgs_m = []
	var imgsArray = ['01','02','03','04','05','06','07','08','09','10','11','12']

	for(let i = 0; i < imgsArray.length; i++){
		var temp = new Image()
		temp.src = 'images/rolling/rolling'+ imgsArray[i] +'.jpg'
		imgs_m.push(temp)
	}

	var t2 = new TimelineMax({
        paused: true
    })
    .to(startScore_m, 5, {
	    score: imgsArray.length - 1,
		roundProps: "score",
		ease: Power0.easeNone,
		onUpdate() {
			$(".mobile-rolling .container img").replaceWith(imgs_m[startScore_m.score])
		}
	})

	Draggable.create("#mobile-rolling-hand", {
		type: 'x',
		throwProps: true,
		bounds: {
		    minX: 0,
		    maxX: 230
		},
		onDrag() {
			t2.progress(Math.abs(this.x / 230))
		}
	});
</script>


<!-- 曲線 -->
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