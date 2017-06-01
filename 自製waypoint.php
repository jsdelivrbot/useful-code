<script>
	$.fn.ryderCool = function(option) {
		var deFault={
			offset: 0
		};

		var setting=$.extend(deFault, option);

		var $t        = $(this),
		$w            = $(window),
		viewTop       = $w.scrollTop(),
		viewBottom    = viewTop + $w.height(),
		_top          = $t.offset().top + setting.offset,
		_bottom       = _top + $t.height() + setting.offset

		return ((_top <= viewBottom) && (_bottom >= viewTop));
	};

	$(window).on("scroll", function () {
		$(".ryderWayPoint").each(function () {
			var t=$(this).attr("class").substr(14,1);
			t=parseInt(t)-1;

			if ($(this).ryderCool()) {
				$(".topmenu li").eq(t).addClass("current");
			}else{
				$(".topmenu li").eq(t).removeClass("current");
			}
		})
	})
</script>


<script>
	$(window).on("scroll", function () {
		$('.closed').each(function(){
			var scrollTop = $(window).scrollTop(),
			elementOffset = $(this).offset().top,
			distance      = (elementOffset - scrollTop),
			windowHeight  = $(window).height(),
			breakPoint    = windowHeight * 0.9;

			if(distance > breakPoint) {
				$(this).removeClass("open");

			}  if(distance < breakPoint) {
				$(this).delay(400).addClass("open");
			}  if(distance < 0) {
				$(this).removeClass("open");
			}
		});
	})
</script>