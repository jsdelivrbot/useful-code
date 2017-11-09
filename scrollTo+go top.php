<!-- scroll to -->
https://github.com/flesler/jquery.scrollTo

<script src="js/jquery.scrollTo.js"></script>

<script>
	$(".knowmore").mousedown(function() {
		$.scrollTo( $('.index-area3'), {duration: 1000} );
	});

	// offset 用法
	$("#goroom").mousedown(function() {
		$.scrollTo( $('#room'), {duration: 1000 , offset: -40} );
	});
</script>


<!-- window內建 -->
<!-- go top -->
<script>
	$(".backtotop").click(function(){
		$("html,body").animate({scrollTop: 0 },1000);
	});
	$(window).scroll(function() {
		if ( $(this).scrollTop() > 300){
			$(".backtotop").fadeIn("fast");
		} else {
			$(".backtotop").stop().fadeOut("fast");
		}
	});
</script>


<!-- 很多個gotop -->
<script>
	$("body").find('div').find('#backtotop').mousedown(function(){
		$("html,body").animate({
			scrollTop: 0
		},1000);
	});
</script>


<!-- go bottom -->
<script>
	$("#scrollToBottom").click(function  () {
		$("html, body").animate({ scrollTop: $(document).height() }, 1500);
	})
</script>