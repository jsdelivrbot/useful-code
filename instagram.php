http://instansive.com/

<!-- hover show like and comment -->
http://www.uptsi.com/tools/widgets



<!-- oembed api -->
<section class="about-instagram">
	<div class="item" data-ig="BmSDmhplPZE"></div>
	<div class="item" data-ig="BjwdFbkFH98"></div>
	<div class="item" data-ig="BmuzEqaF1UZ"></div>
	<div class="item" data-ig="BnMCkM0FpHv"></div>
	<div class="item" data-ig="BkJm9qplQuL"></div>
	<div class="item" data-ig="Blt51NLlZNP"></div>
</section>

<script>
	$('.about-instagram .item').each(function (i, el) {

		var _url = "https://api.instagram.com/oembed?url=http://instagr.am/p/" + el.dataset.ig;

		$.get(_url, function(result){
			$(el).html(result.html);
		});

	});
</script>



<!-- 之前用的  會有"跨來源資源共用（CORS）"的問題....似乎 -->
<p>https://www.instagram.com/p/BSveX4gguaq/</p>
<p>https://www.instagram.com/p/BSveX4gguaq/</p>
<p>https://www.instagram.com/p/BSveX4gguaq/</p>
<p>https://www.instagram.com/p/BSveX4gguaq/</p>
<p>https://www.instagram.com/p/BSveX4gguaq/</p>

<script>
	$('p').each(function () {
	    var searchText = $(this).text();
	    var matches = searchText.match(/(?:(?:http|https):\/\/)?(?:www.)?(?:instagram.com|instagr.am)\/[p]\/([A-Za-z0-9-_]*)\//g);
	    if ( matches != null && searchText === matches[0] ) {
	        $.ajax({
	            context: this,
	            url: "https://api.instagram.com/oembed/?url="+matches[0],
	            dataType: 'jsonp',
	            async: false,
	            success: function(data) {
	            	$(this).html(data.html);
	            },
	        });
	    }
	});
</script>