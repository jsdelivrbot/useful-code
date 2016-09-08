<input type="text" maxlength="4" onKeyUp="next(this)">
<input type="text" maxlength="4" onKeyUp="next(this)">
<input type="text" maxlength="4" onKeyUp="next(this)">
<input type="text" maxlength="4" onKeyUp="next(this)">

<script type="text/javascript">
	function next(obj) {
		if (obj.value.length == obj.maxLength) {
			do {
				obj = obj.nextSibling;
			} while (obj.nodeName != "INPUT");
			obj.focus();
		}
	}
</script>
