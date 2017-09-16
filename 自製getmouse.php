<script>
	$.fn.ryderGetMouse = function(option) {
		return this.each(function() {
			var $this = $(this);

			var width = $this.width();
			var halfWidth = $this.width() / 2;

			var height = $this.height();
			var halfHeight = $this.height() / 2;

			var deFault = {
				move: function() {}
			};

			var setting = $.extend(deFault, option);

			function mouseMoving(e) {
				var x = e.pageX;
				var y = e.pageY - $this.offset().top;

				// 讓數值是 -1 ~ 1
				var cx = (x - halfWidth) / halfWidth;
				var cy = (y - halfHeight) / halfHeight;

				setting.move($this, cx, cy);
			}

			$this.on("mousemove", mouseMoving);
		});
	};

	$(".youtube-current-List li").ryderGetMouse({
		move: function (el, x, y) {
			if ($(".pic", el).hasClass("is-hover")) {
				$(".pic img", el).css({
					top: y * -10 +'px',
					left: x * -20 +'px',
				})
			}
		}
	}).on("mouseout", function (){
		if (!$(".pic", this).hasClass("is-hover")) {
			$(".pic img", this).css({
				top: 0,
				left: 0,
			})
		}
	})
</script>