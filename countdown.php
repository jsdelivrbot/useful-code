<script src="js/jquery.countdown.js"></script>

<script>
	$(".ryder-cd-section-1 .item-5").countdown('2016/05/20 20:44:00', function(event) {
		$(this).html(event.strftime('%D : %H : %M : %S'));
	});
	$(".ryder-cd-section-1 .item-5").on('finish.countdown', function(event) {
		$(".cdWrap").fadeOut(500);
		$(".cdFinishWrap").fadeIn(600);
	});
</script>