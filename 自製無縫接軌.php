
<!-- 自己寫才可不用overflow:hidden -->
<script>
	// 復製ul
	$("#box-2").html($("#box-1").html());
	$("#box-3").html($("#box-1").html());

	// 計算width
	var _total_w=0;
	$(".index-slider li").each(function () {
		var w=$(this).outerWidth(true);
		_total_w=_total_w + w;
	})
	$(".slider-container").css("width", _total_w + "px");

	// 移動開始
	move();

	// prev+next
	$("#prev").click(function () {
		TweenMax.to($(".slider-container"), 0.1, {
			left: '+=200',
			onComplete: function  () {
				move();
			}
		})
	})
	$("#next").click(function () {
		TweenMax.to($(".slider-container"), 0.1, {
			left: '-=200',
			onComplete: function  () {
				move();
			}
		})
	})

	// infinite move
	function move() {
		var _left=parseInt($(".slider-container").css("left"))*-1;
		if (_left > ($("#box-1").width()*2)) {
			$(".slider-container").css("left",$("#box-1").width()*-1+"px");
		}
		if (_left < 0) {
			$(".slider-container").css("left",($("#box-1").width()*-1)+"px");
		}
		TweenMax.to($(".slider-container"), 0.1, {
			left: '-=3',
			onComplete: function  () {
				move();
			}
		})
	}
</script>


<!-- reference -->
<script>
	$(function () {
		$('#box02').html($('#box01').html());
		var roll=function(){
			if($('.container').scrollLeft()>$('#box01').width()){
				$('.container').scrollLeft(0)
			}else{
				$('.container').scrollLeft($('.container').scrollLeft()+5);
			}
		}
		var tip=setInterval(roll,10);
		$('.container').mouseenter(function(){
			clearInterval(tip);
		})
		$('.container').mouseleave(function(){
			tip=setInterval(roll,300);
		})
	});
</script>