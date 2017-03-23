<!-- invisible recaptcha -->
<div id='recaptcha' class="g-recaptcha" style="display: none;"></div>

<!-- invisible recaptcha -->
<div id='footer-recaptcha' class="g-recaptcha" style="display: none;"></div>


<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>

<script>
	window.contactRecaptcha;
	window.footerRecaptcha;

	onloadCallback = function() {
		contactRecaptcha = grecaptcha.render('recaptcha', {
			'sitekey' : '6Lc-OBkUAAAAAMCeet8dB6h81_63l01prRKOb9sV',
			'size' : 'invisible',
			'callback' : function () {
				$("#contactForm").submit();
			}
		});

		footerRecaptcha = grecaptcha.render('footer-recaptcha', {
			'sitekey' : '6Lc-OBkUAAAAAMCeet8dB6h81_63l01prRKOb9sV',
			'size' : 'invisible',
			'callback' : function () {
				$("#footerForm").submit();
			}
		});
	};

	$("#submit").click(function () {
		if($("#contactForm").valid()==true){
			var answer = confirm("您確認要送出您所填寫的資訊嗎？");
			if (answer){
				grecaptcha.execute(contactRecaptcha);
			}
		}
	})

	$("#footerSubsSubmit").click(function () {
		if($("#footerForm").valid()==true){
			var answer = confirm("您確認要送出您所填寫的資訊嗎？");
			if (answer){
				grecaptcha.execute(footerRecaptcha);
			}
		}
	})
</script>