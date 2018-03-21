<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

	<style>
		body{
			margin: 0;
			padding: 0;
		}
		#app{
			width: 1024px;
			height: 768px;
		}
	</style>
</head>
<body>
	<div id="app"></div>

	<button id="replay">replay</button>
	<button id="play" disabled>play</button>
	<button id="stop">stop</button>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/4.13.0/bodymovin.js"></script>
<script>
	var anim = bodymovin.loadAnimation({
		container: document.getElementById('app'),
		renderer: 'html',
		loop: true,
		autoplay: false,
		path: 'data.json'
	});

	var replay = document.getElementById('replay')
	var play = document.getElementById('play')
	var stop = document.getElementById('stop')

	anim.addEventListener('DOMLoaded', function () {
		anim.playSegments([[0, 120], [121, 180]], true)

		$("#green").on("click", function () {
			console.log('green')
		})

		$("#blue").on("click", function () {
			console.log('blue')
		})
	})

	replay.addEventListener('click', function () {
		anim.goToAndPlay(0)
	})

	play.addEventListener('click', function () {
		anim.play()
		play.disabled = true
		stop.disabled = false
	})

	stop.addEventListener('click', function () {
		anim.pause()
		play.disabled = false
		stop.disabled = true
	})
</script>