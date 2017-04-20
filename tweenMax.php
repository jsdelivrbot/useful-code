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
	onComplete: function() {
		// code
	}
});

// 彈跳more
TweenMax.to($(".brandDown"), 1.5, {
	y: '+=30',
	repeat: -1,
	yoyo: true,
	ease: Bounce.easeOut
})

// staggerTo
$(".ownerWrap").load(".ownerWrap li",function  () {
	TweenMax.staggerTo($(".ownerWrap li"), 0.5, {
		opacity:1
	}, 0.2);
})

// from to
TweenMax.fromTo($(".test"), 1.5, {
	"stroke-dashoffset": "200%",
}, {
	"stroke-dashoffset": 0,
	"stroke": color
});
</script>

