<!-- Ryder 自製 -->
<script>
	var fetchImage = (url) => {
	    return new Promise((resolve, reject) => {
	        var image = new Image();
	        image.src = url;
	        image.onload = resolve;
	        image.onerror = reject;
	    });
	}

	var callback = (entries) => {
		entries.forEach((entry) => {
			if (entry.isIntersecting){
				var $el = entry.target
				var src = $el.dataset.src;
				fetchImage(src).then(() => {
				    $el.src = src;
				    $el.classList.add('is-load');
				})
				io.unobserve($el)
			}
		})
	}

	var io = new IntersectionObserver(callback, {
	    root: null,
	    // rootMargin: '0px',
	    threshold: 0.1
	})

	var images = document.querySelectorAll('img[data-src]');

	images.forEach((img) => {
	    io.observe(img);
	})
</script>



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




<!-- 普通的 jquery lazyload -->
https://github.com/eisbehr-/jquery.lazy/tree/master/plugins

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.4/jquery.lazy.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.4/jquery.lazy.plugins.min.js"></script>

<script>
	// 有 chainable: false 這個lazyload才有實例(才可以用update)
	var lazyload = $('.lazy').lazy({
		chainable: false,
		effect: "fadeIn",
		effectTime: 1000,
		defaultImage: 'images/blank.gif',
	});

	// 開燈箱load不到時用
	lazyload.update();
</script>


<!-- 加上stagger的類似效果 -->
<script>
	var lazyload = $('.lazy').lazy({
		afterLoad: function (e) {
			var _delay = $(e).parents("li").index() * 0.078;

			TweenMax.fromTo($(e), .5, {
				opacity: 0
			}, {
				opacity: 1,
				delay: _delay
			});
		}
	});
</script>


<!--
jquery lazyload 應用
還沒讀時有個背景色
神奇的點在img設width height
style設width 100% height auto竟然可以定大小 (有點像用img定maxwidth)

ps.父原素可以用flex-container  子元素一樣用width 100% 可以均分
-->

<style>
	.lazywrap{
		margin: 5px 0;
		background: rgba(#000, .1);
		@include breakpoint(medium down){
			img{
				width: 100%;
				height: auto;
			}
		};
	}
</style>

<div class="detail-content">
	<div class="lazywrap">
		<img class="lazy" data-src="images/1.jpg" width="1120" height="665">
	</div>

	<p>
		<div class="custom">影像紀實</div>
		從電腦平面到印刷成型，用基本的形狀、線條、兩個特色組合，在最後我們以影像紀錄製作日曆的每個日子。雖然話不<br>多，但轉個向、歪個邊，都會是新的想像。
	</p>

	<div class="lazywrap">
		<img class="lazy" data-src="images/3.jpg" width="1120" height="665">
	</div>
</div>

<script>
	$(window).on("load", function () {
		$("body").addClass("is-load");
	})

	var lazyload = $('.lazy').lazy({
		chainable: false,
		effect: "fadeIn",
		effectTime: 1000,
		defaultImage: 'images/blank.gif',
		threshold: 0,
	});
</script>