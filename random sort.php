<script>
	$.fn.randomOrder = function() {
		function randOrd() {
			return (Math.round(Math.random()) - 0.5);
		}

		return ($(this).each(function() {
			var $this = $(this);
			var $children = $this.children();
			var childCount = $children.length;

			if (childCount > 1) {
				$children.remove();

				var indices = new Array();

				for (i = 0; i < childCount; i++) {
					indices[indices.length] = i;
				}

				indices = indices.sort(randOrd);

				$.each(indices, function(j, k) {
					$this.append($children.eq(k));
				});
			}
		}));
	}
</script>