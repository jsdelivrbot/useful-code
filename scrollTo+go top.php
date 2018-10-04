<!-- vue scroll to -->
https://www.npmjs.com/package/vue-scrollto#easing-detailed


<!-- scroll to -->
https://github.com/flesler/jquery.scrollTo

<script src="js/jquery.scrollTo.js"></script>
--------------------------------------------------------
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/2.1.2/jquery.scrollTo.min.js"></script>

<script>
	$(".knowmore").mousedown(function() {
		$.scrollTo( $('.index-area3'), {
			duration: 1000,
			offset: -40,
			interrupt: true,
		});
	});
</script>


<!-- scroll to + anchor -->
<li><a href="./#cooperativeAnchor" data-go="#cooperativeAnchor"></a></li>
<li><a href="./#contactAnchor" data-go="#contactAnchor"></a></li>

<script>
	$(".topmenuList li a[data-go]").on("click", function (e) {

		e.preventDefault();

		if ($("body").data("now") == 'index') {
			$.scrollTo( $(this).data("go"), {
				duration: 1000,
			});

			$(".menu").trigger("click");
		}else{
			location.href = $(this).attr("href");
		}
	})
</script>



<!-- window內建 -->
<!-- go top -->
<script>
	$(".backtotop").on("click", function () {
		$("html,body").animate({scrollTop: 0 },1000);
	})

	$(window).on("scroll", function () {
		if ($(this).scrollTop() > 300){
			$(".backtotop").fadeIn("fast");
		} else {
			$(".backtotop").fadeOut("fast");
		}
	})
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