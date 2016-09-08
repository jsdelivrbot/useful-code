
<script type="text/javascript">
	$('.topmenu ul.works').mouseenter(function(event) {
			TweenLite.to( $('#time'), 0, {opacity:0, onComplete: function(){
				$('.topmenu ul.works').addClass('works-show');
			} });
	});
	$('.topmenu ul.works').mouseleave(function(event) {
			TweenLite.to( $('#time'), 1.0, {opacity:0, onComplete: function(){
				$('.topmenu ul.works').removeClass('works-show');
			} });
	});
</script>