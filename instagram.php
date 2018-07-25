http://instansive.com/

<!-- hover show like and comment -->
http://www.uptsi.com/tools/widgets


<!-- oembed api -->
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