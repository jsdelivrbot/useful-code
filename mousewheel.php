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