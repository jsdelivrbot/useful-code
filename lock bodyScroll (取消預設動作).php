<script type="text/javascript">

// 取消預設動作
$("body").on("touchmove , mousewheel",function  (e) {
	e.preventDefault();
});

// 還原
$("body").unbind("touchmove , mousewheel");

</script>


<!-- 好像很專業 -->
<script>
	function descroll() {
	    $(window).on({
	        mousewheel: function(e) {
	            "el" != e.target.id && (e.preventDefault(),
	                e.stopPropagation())
	        },
	        touchmove: function(e) {
	            "el" != e.target.id && (e.preventDefault(),
	                e.stopPropagation())
	        }
	    })
	}

	function rescroll() {
	    $(window).unbind("mousewheel").unbind("touchmove")
	}
</script>