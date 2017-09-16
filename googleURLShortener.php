<script src="js/googleURLShortener.min.js"></script>

<script>
	$.GoogleURLShortener({
		key: "AIzaSyB94ValZoE1lUg6JlsRpb-6TsOzFI0MZDY",
		url: window.location.href,
		success: function (url, response) {
			$("#shorturl").val(url)
		},
		error: function (message, response) {
			$("#shorturl").val(message)
		}
	});
</script>