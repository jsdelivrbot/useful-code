<div class="parallex">
	<div class="p-index1" para-dis="2.8"><img src="parallax/1.png"></div>
	<div class="p-index2" para-dis="3.2"><img src="parallax/2.png"></div>
	<div class="p-index3" para-dis="4"><img src="parallax/3.png"></div>
	<div class="p-index4" para-dis="2.2"><img src="parallax/4.png"></div>
	<div class="p-index5" para-dis="2"><img src="parallax/5.png"></div>

	<div class="f-index1" para-dis="6"><img src="parallax/f1.png"></div>
	<div class="f-index2" para-dis="4"><img src="parallax/f2.png"></div>
	<div class="f-index3" para-dis="3"><img src="parallax/f4.png"></div>
	<div class="f-index4" para-dis="2"><img src="parallax/f3.png"></div>
	<!-- <div class="f-index5" para-dis="1.6"><img src="parallax/f5.png"></div> -->
</div>


<script type="text/javascript">
	//專做視差效果
	var _myWidth= $(window).width(),
	_myHeight= $(window).height();
	$(window).resize(function() {
		_myWidth = $(window).width();
		_myHeight = $(window).height();
	});

	var scrollPos;

	init();

	function init(){

		var $window = $(window), $inner = $('.products-area2'), $parallex = $('.parallex');
		var buffer = 1440;

		$(window).scroll(function() {
			scrollPos = $(this).scrollTop();   //目前滾了多少高
			// $inner.css('top', - scrollPos);  //父div是否也要parallax一下

			stNow($('.p-icon'),$('.products-area2'),scrollPos);//右下角指示牌
			// stNow($('.st4_now'),$('#section4'),scrollPos);//右下角指示牌

			$parallex.each(function() {

				var $section = $(this).parents('.products-area2');
				var start = $section.position().top;   //window頂點到element的高
				var sectionHeight = $section.height();

				//不同速度移動
				if ((start - buffer <= scrollPos && scrollPos <= start + sectionHeight)) {

					$(this).children().each(function(i) {
						var $this = $(this);
						var initialTop, delta = scrollPos - start, distance = this.getAttribute('para-dis');
						if(distance == null){
							return;
						}

						if ($.data(this, 'initialTop') === undefined) {
							$.data(this, 'initialTop', $this.position().top);
							if (i > 0) {
								$this.css('top', $this.position().top - (distance === '0' ? 0 : buffer * (1 - 1 / distance)));
							}
						}
						initialTop = $this.data('initialTop');
						$this.stop().animate({'top': initialTop + (delta - (distance === '0' ? 0 : delta / distance))}, 0);
					});
				}
			});
		});
}

function stNow(_now,_section,scrollPos) {
	_now.css({
		top:scrollPos-_section.position().top+(_myHeight-155)
	});
}
</script>