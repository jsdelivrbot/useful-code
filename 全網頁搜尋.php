<script>
	function SearchScript() {
		if (document.getElementById("Top1_TxtKeyword").value == '') {
			alert('請輸入關鍵字');
			document.getElementById("Top1_TxtKeyword").focus();
			return false;
		}
		window.open('https://www.google.com.tw/search?q=site:http://www.tang-prize.org/ ' + encodeURIComponent(document.getElementById("Top1_TxtKeyword").value));
	}
</script>