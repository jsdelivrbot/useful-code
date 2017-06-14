<script>
	$.fn.ryderCool = function(option) {
		return this.each(function() {
			var $this = $(this);

			var deFault = {
				hook: 0.9,
				enter: function() {},
				leave: function() {}
			};

			var setting = $.extend(deFault, option);

			function ryderScrolling() {
				var scrollTop = $(window).scrollTop(),
					elementOffset = $this.offset().top,
					distance = (elementOffset - scrollTop),
					windowHeight = $(window).height(),
					breakPoint = windowHeight * setting.hook;

				if (distance < breakPoint) {
					setting.enter($this);
				}

				if (distance > breakPoint) {
					setting.leave($this);
				}
			}

			$(window).on("scroll", ryderScrolling).trigger("scroll");
		});
	};

	$(".detailInfo").ryderCool({
		enter: function(el) {},
		leave: function(el) {}
	})
</script>