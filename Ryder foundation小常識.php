<!-- media query -->
<style>
	@media screen and (max-height: 860px), screen and #{breakpoint(xlarge down)}{
		height: 346px;
		padding: 33px 0;
	};
</style>

<!-- flex 水平垂直置中的include用法 -->
<style>
	@include flex;
	@include flex-align(center, middle);
	@include flex-direction(column);
</style>

<!-- equalizer 使column等高 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.3.1/js/foundation.min.js"></script>

<ul class="menuList" data-equalizer data-equalizer-mq="large-up">
	<li data-equalizer-watch></li>
	<li data-equalizer-watch></li>
	<li data-equalizer-watch></li>
	<li data-equalizer-watch></li>
	<li data-equalizer-watch></li>
</ul>

<script>
	$(document).foundation();
</script>