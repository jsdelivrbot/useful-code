<script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>

<script>
	if ($.browser.msie) {
	    alert("this is msie");
	} else if ($.browser.safari) {
	    alert("this is safari!");
	} else if ($.browser.mozilla) {
	    alert("this is firefox!");
	} else if ($.browser.opera) {
	    alert("this is opera");
	} else if ($.browser.webkit) {
	    alert("苹果的Safari、谷歌的Chrome浏览器");
	} else {
	    alert("i don't konw!");
	}
</script>

<!-- 用寬度版 -->
<script>
	$(window).on("resize", function (){
		if ($(this).width() > 1024) {
			window.device = 'desktop';
		}else{
			window.device = 'mobile';
		}
	}).trigger("resize")
</script>

<!-- 不需include -->
<!-- 改良版 -->
<script>
	function check_device() {
		var url = window.location.pathname;
		var filename = url.substring(url.lastIndexOf('/')+1);

		if (/ipad/i.test(navigator.userAgent.toLowerCase())) {
			window.location = 'mobile/' + filename;
		} else if (/iphone|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase())) {
			window.location = 'mobile/' + filename;
		} else {
			return false;
		}
	}
</script>

<!-- 原版 -->
<script>
	function checkDevice() {
	    if (/ipad/i.test(navigator.userAgent.toLowerCase())) {
	        return "ipad";    // 目前是用ipad瀏覽
	    }
	    else if (/iphone|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase())) {
	        return "mobile";  // 目前是用手機瀏覽
	    }
	    else {
	        return "pc";      // 目前是用電腦瀏覽
	    }
	}

	alert(checkDevice());
</script>