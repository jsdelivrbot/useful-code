https://github.com/garand/sticky

<script src="js/jquery.sticky.js"></script>

<script>
	$(".topmenuWrap").sticky({
		className: 'topmenu-sticky'
	})
</script>


<!-- home made -->
<div id="infoAnchor">
	<div class="applyNow"><a href="apply.php"><img src="images/mountain/applynow.png"><img src="images/mountain/applynow@2x.png" width="37"></a></div>
</div>

<script>
	var	_scrollTop,
		$w=$(window),
		$sec=$("#infoAnchor"),
		$stick=$(".applyNow"),
		_st=$w.height()/2;
		_sl=$sec.width()+$sec.offset().left+25;
		_trigger=$sec.offset().top - _st;
		_trigger_end=$sec.offset().top + $sec.height()-_st-139;

	$w.on("scroll", function () {
		_scrollTop=	$(this).scrollTop();

		if(_trigger>_scrollTop){
			$stick.css({
				position: 'absolute',
				top: 0,
				bottom: 'auto',
				left: 'calc(100% + 25px)'
			})
		}else if(_scrollTop>_trigger_end){
			$stick.css({
				position: 'absolute',
				top: 'auto',
				bottom: 0,
				left: 'calc(100% + 25px)'
			})
		}else{
			$stick.css({
				position: 'fixed',
				top: _st,
				bottom: 'auto',
				left: _sl
			})
		}
	}).trigger("scroll");
</script>