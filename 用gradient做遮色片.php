<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

	<style>
		body{
			background-color: #eee;
		}
		#test{
			position: relative;
			width: 1000px;
			height: 1000px;
			background: radial-gradient(circle 49px at 50% 67%, transparent 100%, rgba(254,0,0,0.9) 50px);
			transition: all 0.5s;
		}
		#circle{
			position: absolute;
			top: 67%;
			left: 50%;
			cursor: pointer;
			width: 100px;
			height: 100px;
			border: 1px solid red;
			border-radius: 50%;
			transform: translate(-50%,-50%);
		}
	</style>
</head>
<body>
	<div id="test">
		<div id="circle"></div>
	</div>
</body>
</html>

<script>
	var $test=document.getElementById("test");
	var $circle=document.getElementById("circle");
	$circle.onmouseover=function () {
		$test.style.opacity=0.5;
	}
	$circle.onmouseout=function () {
		$test.style.opacity=1;
	}
</script>