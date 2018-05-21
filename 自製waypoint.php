<!-- 用新的api -->
<script>
	var callback = (entries) => {
		entries.forEach((entry) => {
			if (entry.isIntersecting){
				// enter
				var $el = entry.target

				// if not repeat
				io.unobserve($el)
			}else{
				// leave
			}
		})
	}

	var io = new IntersectionObserver(callback, {
	    root: null,
	    // rootMargin: '0px',
	    threshold: 0.1
	})

	$("img").each((i, el) => {
	    io.observe(el);
	})
</script>

<!-- 整合一下下面那兩個傻逼 -->
<script>
	$.fn.ryderCool = function(option) {
		return this.each(function() {
			var $this = $(this);

			var deFault = {
				hook: 0.9,
				repeat: false,
				check: true,
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
					setting.check && setting.leave($this);
				}else if (distance < breakPoint) {
					setting.check && setting.enter($this);
					setting.check = setting.repeat;
				}
			}

			$(window).on("scroll", ryderScrolling).trigger("scroll");
		});
	};
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

<!-- 重覆觸發 -->
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