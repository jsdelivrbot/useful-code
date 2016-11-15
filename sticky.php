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
		_trigger=$sec.offset().top - $w.height()/2,
		_trigger_end=$sec.offset().top + $sec.height() - $w.height(),
		_st=$stick.offset().top - _trigger,
		_sl=$stick.offset().left;

	$w.on("scroll", function () {
		_scrollTop=	$(this).scrollTop();

		if (_scrollTop>_trigger && _trigger_end>_scrollTop) {
			$stick.css({
				position: 'fixed',
				top: _st,
				left: _sl
			})
		}else if(_scrollTop<_trigger){
			$stick.css({
				position: 'absolute',
				top: 0,
				left: 'calc(100% + 40px)'
			})
		}else if(_trigger_end<_scrollTop){
			$stick.css({
				position: 'absolute',
				top: _trigger_end - $sec.offset().top + _st,
				left: 'calc(100% + 40px)'
			})
		}
	}).trigger("scroll");
</script>