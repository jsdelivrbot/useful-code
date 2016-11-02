<!-- 需設定div大小 -->
<script src="js/jquery.dotdotdot.min.js"></script>

<script>
	$(".hover-content").dotdotdot();
</script>


<!-- 純css (只支援chrome safari的樣子)-->
<style>
	.el{
		display:-webkit-box;
		-webkit-line-clamp: 1;
		-webkit-box-orient: vertical;
		overflow: hidden;
	}
</style>
