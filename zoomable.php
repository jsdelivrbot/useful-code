https://github.com/francoischalifour/medium-zoom

<script src="https://unpkg.com/medium-zoom@0/dist/medium-zoom.min.js"></script>

<style>
	.medium-zoom--open .medium-zoom-overlay{z-index: 99;}
</style>

<!-- 似乎只能操作img tag -->
<img src="images/1.jpg" data-action="zoom">

<!-- 0.3s 是配合這個套件 -->
<script>
	var zoom = mediumZoom('[data-action="zoom"]', {
		margin: 50,
		scrollOffset: 0
	})

	zoom.addEventListeners('show', (event) => {
		TweenMax.to(".fixed-topmenuWrap", 0.3, {
			y: '-100%',
			onComplete: function() {}
		});
	})

	zoom.addEventListeners('hide', (event) => {
		TweenMax.to(".fixed-topmenuWrap", 0.3, {
			y: '0%',
			onComplete: function() {}
		});
	})
</script>