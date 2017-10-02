<!--======================================================
=            canvas在高倍屏下變模糊的處理辦法            =
=======================================================-->
http://www.dengzhr.com/frontend/html/1050

<script>
	// 屏幕的設備像素比
	var devicePixelRatio = window.devicePixelRatio || 1;

	// 瀏覽器在渲染canvas之前存儲畫布信息的像素比
	var backingStoreRatio = context.webkitBackingStorePixelRatio || context.mozBackingStorePixelRatio || context.msBackingStorePixelRatio || context.oBackingStorePixelRatio || context.backingStorePixelRatio || 1;

	// canvas的實際渲染倍率
	var ratio = devicePixelRatio / backingStoreRatio;

	canvas.style.width = canvas.width;
	canvas.style.height = canvas.height;

	canvas.width = canvas.width * ratio;
	canvas.height = canvas.height * ratio;
</script>