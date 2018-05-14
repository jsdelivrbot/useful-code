<!-- library -->
http://svgjs.com/elements/

有一些plugin好像不錯 ex: svg.topath.js
http://svgjs.com/plugins/


<!-- How SVG Line Animation Works -->
https://css-tricks.com/svg-line-animation-works/

<!-- CSS + SVG stroke 動態描繪 -->
http://wcc723.github.io/svg/2014/06/15/svg-css-stroke-animation/

<!-- SVG Animation 動態描繪 -->
http://www.chming.tw/blog/2014/09/21/svg-animate-paint/

<!-- 不錯用plugin -->
https://github.com/maxwellito/vivus

<script src="js/vivus.min.js"></script>

<script>
	// obturateur3 是svg id
	var test=new Vivus('obturateur3', {
		duration: 200,
		start: "manual"
	});
	$("#obturateur3").mouseenter(function  () {
		test.play();
	})
	$("#obturateur3").mouseleave(function  () {
		test.reset();
	})
</script>


<!-- tweenMax -->
<!-- 其實gsap有專門svg的 只是要錢 (drawSVG) -->
<script src="js/TweenMax.min.js"></script>

<style>
	.test{
		/*stroke: black;*/
		stroke-dasharray: 200%;
		stroke-dashoffset: 200%;
	}
</style>

<svg class="test" width="50" viewBox="0 0 14 25" xmlns="http://www.w3.org/2000/svg"><path d="M1 15.6s5.8 7.7 6.2 8.1c.5.6-.2-3.6 0-6.7v-16m6.1 14.8s-5.1 7.3-6.1 7.9" stroke-width="1.8" fill="none"</path></svg>

<script>
	// 取得準確長度
	var path = document.getElementById("svg-1").querySelector('path');
	var length = path.getTotalLength();

	TweenMax.to($(".svgAnimated4"), 3.5, {
		"stroke-dashoffset": 0,
		delay: 3,
		ease: Power1.easeOut,
		onComplete: function  () {
			$(".firstPage ul.words li").eq("3").css("opacity",1);
			$(".firstPage").css("-webkit-filter","grayscale(0%)");
		}
	});

	$(".test").mouseenter(function  () {
		_svg("red");
	})
	$(".test").mouseout(function  () {
		_svg("black");
	})

	function _svg (color) {
		TweenMax.fromTo($(".test"), 1.5, {
			"stroke-dashoffset": "200%",
		}, {
			"stroke-dashoffset": 0,
			"stroke": color
		});
	}
</script>

<!-- animate 用法 -->
<!-- patternTransform -->
<svg width="0" height="0" style="position: absolute;">
	<defs>
		<pattern id="pt_white" patternUnits="userSpaceOnUse" x="0" y="0" width="15" height="56" patternTransform="rotate(16) scale(1)">
		    <animateTransform additive="sum" attributeName="patternTransform" type="translate" begin="0s" dur="1s" fill="freeze" from="15, 0" to="0, 0" repeatCount="indefinite"></animateTransform>
		    <rect fill="#fff" x="0" y="0" height="56" width="4"></rect>
		</pattern>
		<pattern id="pt_orange" patternUnits="userSpaceOnUse" x="0" y="0" width="15" height="56" patternTransform="rotate(16) scale(1)">
		    <animateTransform additive="sum" attributeName="patternTransform" type="translate" begin="0s" dur="1s" fill="freeze" from="15, 0" to="0, 0" repeatCount="indefinite"></animateTransform>
		    <rect fill="#ffc54a" x="0" y="0" height="56" width="4"></rect>
		</pattern>
	</defs>
</svg>

<svg viewBox="0 0 1280 216">
    <polygon fill="url(#pt_white)" points="0 55 137 19 0 192.09 0 55" />
    <polygon points="901 64 852 194 1038.33 98.33 901 64" fill="#003d50" />
    <polygon points="1280 0 1280 149 997 74.5 1280 0" fill="url(#pt_orange)" />
    <polygon points="0 199 404 89 149 11 0 199" fill="#ffd217" />
    <polygon points="1055 106.2 1280 162.87 1280 216 0 216 0 215.8 410.14 99.24 620.13 179.29 859 208.2 1055 106.2" fill="#ffc54a" />
</svg>

<!-- animate stroke-dashoffset animateMotion -->
<svg xmlns="http://www.w3.org/2000/svg" width="908.18" height="426" viewBox="0 0 908.18 426">
	<defs>
		<path id="flypath" d="M485.39,182.36C500.28,79.93,588.69,1,695.18,1c116.9,0,212,95.1,212,212s-95.1,212-212,212c-104,0-188.9-78-208.64-174.28-9-44.06-67.69-74.05-190.72,34.77-81.23,71.85-182,28.33-247.42-11.91" />
	</defs>
    <g>
    	<use xlink:href="#flypath" fill="none" stroke="#ffb416" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke-dasharray="1 5" />
    </g>
    <g>
    	<use xlink:href="#flypath" fill="none" stroke="#f7f7f7" stroke-width="3" stroke-dasharray="1762" />
        <animate id="ani-flypath" attributeName="stroke-dashoffset" from="0" to="-1762" dur="8s" begin="indefinite" fill="freeze" />
    </g>
    <g transform="translate(20, 0) rotate(180, 18, 16)" opacity="0">
        <path d="M10.5,27.5l0,0l0.3,0.3c0,0,0,0,0.1,0.1c0.9,1.1,1.9,2,3.2,2.7c1.8,1,3.8,1.6,5.9,1.6c2.7,0,5.4,-1,7.4,-2.7l8.9,0.3l-4.7,-7.5c0.1,-0.5,0.1,-1,0.2,-1.6c2.9,-1,5.1,-3.5,5.5,-6.6c0.5,-4,-1.9,-7.7,-5.7,-8.9c-0.3,-0.8,-0.7,-1.6,-1.3,-2.3c-1.6,-1.9,-3.9,-3,-6.3,-3c-1.9,0,-3.7,0.7,-5.2,1.8c-2.3,1.9,-4,4.8,-5,8.7c-1.6,1,-2.9,2.4,-3.9,4c-2.6,4.4,-2.1,9.5,0.6,13.1zm10.9,2.7l7.6,-13.2c0.4,1,0.6,2,0.6,3.1l0,1.2l0,0c0,0.1,0,0.2,0,0.3l-0.1,0.8c0,0,-0.6,3,-3,5.3c-1.3,1.3,-3.1,2.2,-5.1,2.5zm6.9,-18c-0.3,-0.3,-0.6,-0.6,-1,-0.9c-0.1,-0.1,-0.2,-0.1,-0.3,-0.2c-0.4,-0.3,-0.8,-0.6,-1.3,-0.9c-0.3,-0.2,-0.7,-0.4,-1.1,-0.5c-0.1,0,-0.1,-0.1,-0.2,-0.1c-0.3,-0.1,-0.6,-0.3,-1,-0.4c0,0,-0.1,0,-0.1,0c-0.5,-0.2,-1.1,-0.3,-1.7,-0.4c2,-1,4.4,-1.9,6.8,-1.9c0.4,0,0.8,0,1.2,0.1c0.4,1.9,-0.1,3.8,-1.4,5.3c0.2,-0.1,0.1,-0.1,0.1,-0.1zm0.3,-7.9c0.2,0.2,0.3,0.4,0.4,0.7c-0.1,0,-0.3,0,-0.4,0c-4.2,0,-8.2,2.1,-10.9,4c-0.5,0.1,-1.1,0.2,-1.6,0.4c0.7,-2.1,1.9,-4.3,3.8,-5.9c1.1,-1,2.5,-1.5,3.9,-1.5c1.8,0,3.6,0.8,4.8,2.3zm3,14.4c-0.3,-1.8,-0.9,-3.4,-1.9,-4.9c1.6,-1.7,2.4,-3.9,2.2,-6.2c2.2,1.2,3.6,3.6,3.2,6.3c-0.3,2.2,-1.6,3.9,-3.5,4.8zm1.2,9.2l-3.8,-0.1c0.4,-0.5,0.7,-0.9,1,-1.5c0.3,-0.5,0.5,-1.1,0.8,-1.6l2,3.2zm-17.9,1.1c-0.2,-0.1,-0.5,-0.3,-0.7,-0.5l9.8,-17c0.3,0.1,0.5,0.2,0.8,0.4c0.3,0.2,0.6,0.4,0.9,0.6c0.1,0.1,0.2,0.2,0.3,0.3c0.2,0.1,0.3,0.3,0.5,0.4c0.1,0.1,0.2,0.2,0.3,0.2l-9.6,16.6c-0.8,-0.2,-1.5,-0.5,-2.3,-1zm-3.6,-13.5c0.6,-1.1,1.5,-2.1,2.5,-2.9l1.2,-0.7c1.6,-0.9,3.4,-1.3,5.3,-1.3l-8.7,15.1c-2,-2.9,-2.2,-6.9,-0.3,-10.2zm-0.9,-10.9c1.3,0.8,1.8,2.4,1,3.8c-0.8,1.3,-2.4,1.8,-3.8,1c-1.3,-0.8,-1.8,-2.4,-1,-3.8c0.8,-1.3,2.5,-1.8,3.8,-1zm-9,15.5c1.3,0.8,3,0.3,3.8,-1c0.8,-1.3,0.3,-3,-1,-3.8c-1.3,-0.8,-3,-0.3,-3.8,1c-0.8,1.4,-0.3,3.1,1,3.8z" fill="#ffb416" />
        <animate id="ani-bee" attributeName="opacity" from="0" to="1" dur="0.5s" begin="indefinite" fill="freeze" />
        <animateMotion id="ani-flybee" dur="8s" begin="indefinite" fill="freeze" rotate="auto">
			<mpath xlink:href="#flypath" />
        </animateMotion>
    </g>
</svg>

<!-- begin="indefinite" 用js啟動 -->
<script>
	document.getElementById("ani-flypath").beginElement()
	document.getElementById("ani-bee").beginElement()
	document.getElementById("ani-flybee").beginElement()
</script>