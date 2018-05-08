<!-- 模糊到清楚式 好像很厲害 -->
https://github.com/zafree/pilpil

<link rel="stylesheet" href="css/pilpil.css"/>
<script src="src/js/pilpil.js"></script>

<!-- 原生 z-index: 100 -->
<figure class="graf-figure">
	<div class="aspectRatioPlaceholder">
		<div class="aspectRatioPlaceholder-fill"></div>
		<div class="progressiveMedia" data-width="1120" data-height="667">
			<img class="progressiveMedia-thumbnail" src="images/1-thumbnail.jpg">
			<canvas class="progressiveMedia-canvas"></canvas>
			<img class="progressiveMedia-image" data-src="images/1.jpg">
		</div>
	</div>
</figure>

<!-- 普通的 -->
https://github.com/eisbehr-/jquery.lazy/tree/master/plugins

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.4/jquery.lazy.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.4/jquery.lazy.plugins.min.js"></script>

<script>
	// 有 chainable: false 這個lazyload才有實例(才可以用update)
	var lazyload = $('.lazy').lazy({
		chainable: false,
		effect: "fadeIn",
		effectTime: 1000,
		defaultImage: 'images/lazy-default.svg',
	});

	// 開燈箱load不到時用
	lazyload.update();
</script>