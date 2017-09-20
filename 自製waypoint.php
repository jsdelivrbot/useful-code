<!-- 只觸發一次 -->
<script>
	$.fn.ryderWaypoint = function(option) {
		return this.each(function() {
			var $this = $(this);

			var deFault = {
				hook: 0.8,
				check: 1,
				enter: function() {}
			};

			var setting = $.extend(deFault, option);

			function ryderScrolling() {
				var scrollTop = $(window).scrollTop(),
					elementOffset = $this.offset().top,
					distance = (elementOffset - scrollTop),
					windowHeight = $(window).height(),
					breakPoint = windowHeight * setting.hook;

				if (distance < breakPoint && setting.check) {
					setting.check = 0;
					setting.enter($this);
				}
			}

			$(window).on("scroll", ryderScrolling).trigger("scroll");
		});
	};
</script>

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

				if (distance > breakPoint || distance < -$this.height()) {
					setting.leave($this);
				}else if (distance < breakPoint) {
					setting.enter($this);
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

<script>
	$.fn.inScreen = function(option) {
		var deFault = {
			offset: 150
		};

		var setting = $.extend(deFault, option);

		var $t = $(this),
			$w = $(window),
			viewTop = $w.scrollTop(),
			viewBottom = viewTop + $w.height(),
			_top = $t.offset().top + setting.offset,
			_bottom = _top + $t.height() + setting.offset

		return ((_top <= viewBottom) && (_bottom >= viewTop));
	};
</script>