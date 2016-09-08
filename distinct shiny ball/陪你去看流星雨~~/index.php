<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

	<style>
		.shooting-star {
			position: absolute;
			width: 100%;
			height: 100%;
			top: 0;
			left: 0
		}
		.shooting-star .ss {
			position: absolute
		}
		.shooting-star .ss:after {
			position: absolute;
			display: block;
			content: " ";
			width: 100%;
			height: 100%;
			background: url(shootingstar.png);
			background-size: 100% 100%;
			-webkit-animation: ssAnime 1s 3s both;
			animation: ssAnime 1s 3s both
		}
		@-webkit-keyframes ssAnime {
			0% {
				-webkit-transform-origin: center top;
				transform-origin: center top;
				-webkit-transform: scale(0);
				transform: scale(0)
			}
			50% {
				-webkit-transform-origin: center top;
				transform-origin: center top;
				-webkit-transform: scale(1);
				transform: scale(1)
			}
			51% {
				-webkit-transform-origin: center bottom;
				transform-origin: center bottom;
				-webkit-transform: scale(1);
				transform: scale(1)
			}
			100% {
				-webkit-transform-origin: center bottom;
				transform-origin: center bottom;
				-webkit-transform: scale(0);
				transform: scale(0)
			}
		}
		@keyframes ssAnime {
			0% {
				-webkit-transform-origin: center top;
				transform-origin: center top;
				-webkit-transform: scale(0);
				transform: scale(0)
			}
			50% {
				-webkit-transform-origin: center top;
				transform-origin: center top;
				-webkit-transform: scale(1);
				transform: scale(1)
			}
			51% {
				-webkit-transform-origin: center bottom;
				transform-origin: center bottom;
				-webkit-transform: scale(1);
				transform: scale(1)
			}
			100% {
				-webkit-transform-origin: center bottom;
				transform-origin: center bottom;
				-webkit-transform: scale(0);
				transform: scale(0)
			}
		}
		body{
			background-color: #000;
		}
	</style>
</head>
<body>
	<div class="shooting-star"><div class="ss" style="width: 5.7024px; height: 554.706px; top: 650.067px; left: 1448.04px; transform: rotate(171.977deg);"></div></div>
</body>
</html>

<script>
	var $ss=$('<div class="ss"></div>');
	$ss.css({
		width:Math.random()*5+5,
		height:Math.random()*300+300,
		top:Math.random()*stageH-100,
		left:Math.random()*stageW-100,
		transform:"rotate("+deg+"deg)"
	})
</script>