<!-- jquery cookie -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>

<!-- 自製回上一頁 -->
<script>
	// index.php
	$(window).unload(function() {
		$.cookie('scrollTop', $(window).scrollTop())
	})

	var _now = document.location.pathname;

	var t = $.cookie('scrollTop')

	if (t != 'undefined' && _now.indexOf('detail') == -1) {
		$(window).scrollTop(t)
	}
</script>