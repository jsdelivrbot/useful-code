<!-- 以下就觸發 定位class好用 -->
<script>
	var $where = $("[data-where]").get().reverse()

	$(window).scroll(function() {

		var scrollTop = $(this).scrollTop()

		$($where).each((i, el) => {

			var _index = el.dataset.where
			var _b = scrollTop + $(window).height() * 0.7

			if (_b > $(el).offset().top) {
				$(".topmenuList li").eq(_index).addClass("current").siblings().removeClass("current")
				return false
			}
		})
	}).trigger("scroll")
</script>


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


<!-- ryder 持續進化 -->
<script>
	$.fn.ryderCool = function(option) {
		return this.each(function() {
			var $this = $(this);

			var deFault = {
				hook: 0.9,
				repeat: false,
				enter_check: true,
				leave_check: true,
				count: 0,
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

					if (setting.count < 1) {
						setting.enter_check = true;
					}else{
						setting.enter_check = setting.repeat;
					}

					setting.leave_check && setting.leave($this);
					setting.leave_check = false;

				}else if (distance < breakPoint) {

					if (setting.count < 1) {
						setting.leave_check = true;
					}else{
						setting.leave_check = setting.repeat;
					}

					setting.enter_check && setting.enter($this);
					setting.enter_check && setting.count++;
					setting.enter_check = false;
				}
			}

			$(window).on("scroll", ryderScrolling).trigger("scroll");
		});
	};
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