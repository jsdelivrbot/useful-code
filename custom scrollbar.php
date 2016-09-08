<!-- theme list -->
http://manos.malihu.gr/repository/custom-scrollbar/demo/examples/scrollbar_themes_demo.html

<!-- 官網 -->
http://manos.malihu.gr/jquery-custom-content-scroller/


<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.mCustomScrollbar.min.css">

<script type="text/javascript">

	$(window).load(function  () {

		$("#image0").mCustomScrollbar({
			theme: "dark-thick"
		});

	})

</script>


<!--==============================================
=            MY THEME  (height %數也可)          =
===============================================-->

<style type="text/css">
	.mCS-my-theme.mCSB_scrollTools .mCSB_dragger{
		height: 84px;
	}
	.mCS-my-theme.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar {
		background-color: #888889;
		width: 11px;
		height: 84px;
	}
	.mCS-my-theme.mCSB_scrollTools .mCSB_draggerRail {
		background-color: transparent;
	}
</style>

<script type="text/javascript">

	$(".detailIntro").mCustomScrollbar({
		theme: "my-theme",
		autoDraggerLength: false,
		mouseWheel:{ scrollAmount: 130 },
		scrollbarPosition: "outside"
	});

</script>

