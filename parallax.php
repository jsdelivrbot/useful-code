<!--===================================
=            scss parallax            =
====================================-->
http://codepen.io/scottkellum/pen/bHEcA


<!--==============================
=            scrollit            =
===============================-->
https://github.com/rorymurphy/scrollit?utm_source=jquer.in&utm_medium=website&utm_campaign=content-curation
<script src="js/scrollit.js"></script>

<div class="news-detail-leaf-1">
	<img src="images/news-detail-leaf-1.png" width="201" data-parallax="0.4" style="position: relative;">
</div>

or

<script>
	$('.ia-article').parallax({
		axis: 'y',
		attr: 'top',
		speed: -0.1
	});

	$('.ia-article').tween({
		start: 0,
		end: $(window).height() * 0.4,
		easing: 'easeInCubic',
		styles: {
			'opacity': {
				startValue: '0',
				endValue: '1'
			}
		}
	});
</script>

<!-- with waypoint -->
<script>
	$(".m-athletesList").waypoint({
		position: -$(window).height()*0.8,
		down: function(e){
			_step1(e);
		},
		// up: function(e){
		// 	_re_step1(e);
		// }
	});
</script>