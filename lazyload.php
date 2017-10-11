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