http://leafo.net/sticky-kit/

<script src="https://cdn.rawgit.com/leafo/sticky-kit/v1.1.2/jquery.sticky-kit.min.js"></script>

<script>
	$(".head-area").each((i, e) => {
		$(e).stick_in_parent({
			offset_top: 100
		}).on("sticky_kit:stick sticky_kit:unbottom", (e) => {
			e.target.style.right = ($(window).width() - 1120) / 2 + 'px'
		}).on("sticky_kit:unstick sticky_kit:bottom", (e) => {
			e.target.style.right = 0
		})
	})
</script>