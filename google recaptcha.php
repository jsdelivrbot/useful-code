<!--===========================
=            basic            =
============================-->

<div class="g-recaptcha"
	data-sitekey="6Lf2eTUUAAAAAA2C6bGhcsp6tTt96UunVj-BeUy_"
	data-callback="onSubmit"
	data-size="invisible">
</div>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script>
	window.onSubmit = () => {
		$(".contact-form").submit();
	}

	$("#send").click(function () {
		if($(".contact-form").valid() == true){
			var answer = confirm("您確認要送出您所填寫的資訊嗎？");
			if (answer){
				grecaptcha.execute();
			}
		}
	})
</script>


<!--========================================
=            multiple recaptcha            =
=========================================-->

<!-- invisible recaptcha -->
<div id='recaptcha' class="g-recaptcha" style="display: none;"></div>

<!-- invisible recaptcha -->
<div id='footer-recaptcha' class="g-recaptcha" style="display: none;"></div>


<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>

<script>
	window.contactRecaptcha;
	window.footerRecaptcha;

	var url = window.location.pathname;
	var filename = url.substring(url.lastIndexOf('/')+1);

	onloadCallback = function() {
		if (filename == 'contact') {
			contactRecaptcha = grecaptcha.render('recaptcha', {
				'sitekey' : '6Lc-OBkUAAAAAMCeet8dB6h81_63l01prRKOb9sV',
				'size' : 'invisible',
				'callback' : function () {
					$("#contactForm").submit();
				}
			});
		}

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



<!--=============================
=           use ajax            =
==============================-->

<!-- if u need loading -->
<div class="ajax-loading"><img src="images/ajax-loader.gif"></div>

<script>
	window.onSubmit = () => {
		$.ajax({
			type: "POST",
			url: "./contactMail.php",
			data: $(".index-contactForm").serialize(),
			beforeSend: function () {
				$(".ajax-loading").show();
			},
			success: function(data) {
				$(".index-contactWrap").html( $("<div>").addClass("contactFinish").text(data) );
			}
		});
	}

	$("#send").click(function () {
		if($(".index-contactForm").valid() == true){
			var answer = confirm("您確認要送出您所填寫的資訊嗎？");
			if (answer){
				grecaptcha.execute();
			}
		}
	})
</script>