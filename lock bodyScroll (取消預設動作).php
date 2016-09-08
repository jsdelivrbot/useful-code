<script type="text/javascript">

// 取消預設動作
$("body").on("touchmove , mousewheel",function  (e) {
	e.preventDefault();
});

// 還原
$("body").unbind("touchmove , mousewheel");

</script>