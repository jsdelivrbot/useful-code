<script src="js/jquery.mousewheel.min.js"></script>

<script>
	var _delta=0;
	var _delta_old=0;

	$('body').bind('mousewheel', function(event, delta, deltaX, deltaY) {
		_delta+=deltaY;
		_delta = (_delta > 0) ? 0 : _delta;

		if (_delta_old>_delta) {
			// 往下滾
			if (_delta<-15 && _delta>-30) {
				is2_open();
				more_hide();
				_key_check=1;
			}else if (_delta<-30 && _delta>-45) {
				is2_close();
				is3_open();
				_key_check=2;
			}else if (_delta<-45) {
				is456_open();
				_key_check=3;
			}

			if (_delta<-53) {
				if (progress_check) {
					$(".is4-svg-progress").each(function(index, e) {
						TweenMax.to($(this), 2, {
							"stroke-dashoffset": progress[index],
						});

						$(this).prev().prev().countTo({
							from: 0,
							to: progress_num[index],
							speed: 2000
						});
					})

					progress_check = 0;
				}
			}

			_delta_old=_delta;
		}else{
			// 往上滾
			if (_delta>-15) {
				is2_close();
				is3_close();
				more_show();
				_key_check=0;
			}else if (_delta<-15 && _delta>-30) {
				is2_open();
				_key_check=1;
			}else if (_delta<-30 && _delta>-45) {
				is456_close();
				_key_check=2;
			}

			_delta_old=_delta;
		}
	});
</script>


<!-- 應用篇 -->
1. 只有第一頁強制滾一整頁

<style>
	.index-section-1{
		z-index: 1;
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
	}
	.is1-space{
		position: relative;
		width: 100%;
		height: 100%;
	}
</style>

<div class="is1-space"></div>
<div class="index-section-1"></div>

<script>
	var _delta = 0;
	var _delta_old = 0;
	var _nowSection = 1;
	var _lockScroll = 1;

	function _is1_scroll_reset () {
		_delta = 0;
		_delta_old = 0;
		_lockScroll = 1;
	}

	$('body').bind('mousewheel', function(event, delta, deltaX, deltaY) {
		if (_lockScroll) {
			event.preventDefault();
		}

		_delta += deltaY;
		// _delta = (_delta > 0) ? 0 : _delta;

		if (_delta_old > _delta && _nowSection == 1) {
			// 往下滾
			_nowSection = 2;
			_is2_show();

			$(".hamburger").addClass("is-dark");
			$(".memberLogin").addClass("is-dark");
			$(".is1-logo").addClass("is-dark");

			TweenMax.to($(".index-section-1"), 1, {
				top: '-100%',
				onComplete: function  () {
					_lockScroll = 0;
				}
			});

			TweenMax.to($(".is1-space"), 1, {
				height: 0,
				onComplete: function  () {}
			});

			_delta_old = _delta;
		}
		if(_delta > 2 && _nowSection == 2) {
			// 往上滾
			_nowSection = 1;

			$(".hamburger").removeClass("is-dark");
			$(".memberLogin").removeClass("is-dark");
			$(".is1-logo").removeClass("is-dark");

			TweenMax.to($(".index-section-1"), 1, {
				top: 0,
				onComplete: function  () {
					_is1_scroll_reset();
				}
			});

			TweenMax.to($(".is1-space"), 1, {
				height: '100%',
				onComplete: function  () {}
			});

			_delta_old = _delta;
		}
	});
</script>