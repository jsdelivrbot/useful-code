<script src="js/jquery.countTo.js"></script>

<script>
	$(".timer").countTo({
		from:0,
		to:100,
		speed:1000
	});
</script>



<!--============================================
=            Ryder超神假preload            =
============================================-->
<script>
	var _count;
	$(".timer").countTo({
		from:0,
		to:78,
		speed:3000,
		onUpdate:function (value) {
			_count = value;
			$(".loadingbar span").css("width" ,_count+"%");
		}
	});
	$(window).load(function  () {
		$(".timer").countTo({
			from:_count,
			to:100,
			speed:1000,
			onUpdate:function (value) {
				_count = value;
				$(".loadingbar span").css("width" ,_count+"%");
			},
			onComplete:function  () {
				$(".preload").delay(600).fadeOut(700);
			}
		});
	})
</script>

