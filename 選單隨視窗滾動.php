


<script>
	var offset = $(elem).offset();
	var topPadding = 0;
	$(window).scroll(function() {
		if ($(window).scrollTop() > offset.top - 20) {
			$(elem).stop().animate({
				marginTop: $(window).scrollTop() - offset.top + topPadding
			}, 300);
		} else {
			$(elem).stop().animate({
				marginTop: 0
			}, 300);
		}
	});
</script>


<!--
elem 的部份代換為選單的元素即可

而 offset.top – 20 的那個 20 的值可能要視狀況微調一下 -->