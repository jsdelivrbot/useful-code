<!-- waypoint -->
https://github.com/imakewebthings/waypoints

<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js"></script>

<script>
	$("article[data-month]").waypoint(function(dir) {
		var _eq = this.element.dataset.month - 1
		if (dir == 'down') {
			$(".giftmonthlink a").eq(_eq).addClass("current")
		}else{
			$(".giftmonthlink a").eq(_eq).removeClass("current")
		}
	}, {
		offset: $(window).height() * 0.6
	})
</script>

<!-- in-viewport (只會觸發一次) -->
https://github.com/vvo/in-viewport

<script src="src/js/in-viewport.min.js"></script>

<script>
	$(".giftWrap section").each((i, el) => {
		inViewport(el, (el) => {
			$(".ani-flypath", el)[0].beginElement()
			$(".ani-bee", el)[0].beginElement()
			$(".ani-flybee", el)[0].beginElement()
		})
	})
</script>

<!-- in-viewport (重覆觸發) -->
<script src="src/js/jquery.inViewport.js"></script>

<script>
	$("article[data-month]").inViewport(function(){
		var _eq = this.dataset.month - 1
		$(".giftmonthlink a").eq(_eq).addClass("current")
	}, function(){
		var _eq = this.dataset.month - 1
		$(".giftmonthlink a").eq(_eq).removeClass("current")
	})
</script>

<!-- 只觸發一次 -->
<script>
	$.fn.ryderWaypoint = function(option) {
		return this.each(function() {
			var $this = $(this);

			var deFault = {
				hook: 0.8,
				check: 1,
				enter() {}
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
				enter() {},
				leave() {}
			};

			var setting = $.extend(deFault, option);

			function ryderScrolling() {
				var scrollTop = $(window).scrollTop(),
					elementOffset = $this.offset().top,
					distance = (elementOffset - scrollTop),
					windowHeight = $(window).height(),
					breakPoint = windowHeight * setting.hook,
					leavePoint = $this.height() - windowHeight * (1 - setting.hook);

				if (distance > breakPoint || distance < -leavePoint) {
					setting.leave($this);
				}else if (distance < breakPoint) {
					setting.enter($this);
				}
			}

			$(window).on("scroll", ryderScrolling).trigger("scroll");
		});
	};

	$(".detailInfo").ryderCool({
		enter(el) {},
		leave(el) {}
	})
</script>

<!-- onscreen -->
https://github.com/silvestreh/onScreen

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