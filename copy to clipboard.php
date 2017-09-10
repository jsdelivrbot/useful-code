<script>
	$("#click").on("click", function (){
		var _text = $("#copy").text()
		copy(_text)
	})

	function copy(s) {
		var clip_area = document.createElement('textarea');
		clip_area.textContent = s;

		document.body.appendChild(clip_area);
		clip_area.select();

		document.execCommand('copy');
		clip_area.remove();
	}
</script>

<!-- jquery -->
<script>
	function copy(s) {
		$('body').append('<textarea id="clip_area"></textarea>');

		var clip_area = $('#clip_area');

		clip_area.text(s).select();

		document.execCommand('copy');

		clip_area.remove();
	}
</script>