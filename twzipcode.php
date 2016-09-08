<script src="js/jquery.twzipcode.js"></script>


<style>
	#twzipcode{
		display: inline-block;
		div{
			display: inline-block;
		}
		input[name=zipcode]{
			position: absolute;
			opacity: 0;
		}
	}
</style>

<div id="twzipcode">
	<div data-role="county" data-style="registerSelect"></div>
	<div data-role="district" data-style="registerSelect"></div>
	<span class="myZipcode">100</span>
</div>

<script>
	$('#twzipcode').twzipcode({
		'countySel'   : '台北市',
		readonly: true
	});
	$("#twzipcode").change(function  () {
		var zip=$("input[name=zipcode]").val();
		$(".myZipcode").text(zip);
	})
</script>