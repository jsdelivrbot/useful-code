<!--==============================================
=            jquery 記錄 query string            =
===============================================-->

<select name="" id="" class="news-select" data-type='cat'>
	<option value="0">All Message</option>
	<option value="1">News Bulletin</option>
	<option value="2">Product Information</option>
</select>

<select name="" id="" class="news-select" data-type='y'>
	<option value="2017">2017</option>
	<option value="2016">2016</option>
	<option value="2015">2015</option>
</select>

<script>
	var _url = '';
	var queries = {};

	$.each(document.location.search.substr(1).split('&'),function(c,q){
		var i = q.split('=');
		if (i != '') {
			queries[i[0].toString()] = i[1].toString();
		}
	});

	$(".news-select").on("change", function (){
		var $this = $(this);

		if ($this.val() != '0') {
			_url += 'news.php';
			_url += '?';
			_url += $this.data("type");
			_url += '=';
			_url += $this.val();

			$.each(queries, function (i, v) {
				if ($this.data("type") != i) {
					_url += '&';
					_url += i;
					_url += '=';
					_url += v;
				}
			})

			window.location = _url;
		}else{
			window.location='news.php#newsAnchor'
		}
	})
</script>

<!--==================================
=            jquery取網址            =
===================================-->
<!-- 內有plugin -->
http://blog.webgolds.com/view/198
<script>
	var _now = document.location.pathname.match(/[^\/]+$/)[0];    //index.php
</script>