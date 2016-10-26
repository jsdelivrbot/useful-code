<!-- wrap 4 elements -->
<script type="text/javascript">
	$('div.test div').each(function(i) {
		if( i % 4 == 0 ) {
			$(this).nextAll().andSelf().slice(0,4).wrapAll('<div class="slide"></div>');
		}
	});
</script>


<!-- 字串各別wrap -->
<script>
	var wrap_el=$(".ib-innerWrap .banner-en");
 	wrap_el.html(wrap_el.text().replace(/(\S)/g, '<div class="o"><span>$1</span></div>'));
</script>

<script>
	$(".teacher-list li .name").each(function () {
		var $str=$(this).text();
		var $len=$str.length;
		var $new_text='';
		for (var i = 0; i < $len; i++) {
			var $repalce="<span>"+$str.charAt(i)+"</span>"
			$new_text=$new_text+$repalce;
		}
		$(this).html($new_text);
	})
</script>


<!-- 利用<br>分割後各別wrap -->
<script>
	$(".name").each(function () {
		var _text=$(this).html().split("<br>");
		var _html="";
		for (var i = 0; i < _text.length; i++) {
			_html+="<span>"+_text[i]+"</span>";
		}
		$(this).html(_html);
	})
</script>