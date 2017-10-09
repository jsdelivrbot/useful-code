http://idangero.us/swiper/api/#.WdoAmVuCyUk

<link rel="stylesheet" href="css/swiper.css">
<script src="js/swiper.js"></script>

<div class="swiper-container">
	<div class="swiper-wrapper">
		<div class="swiper-slide mobile-shopSlider">
			<div class="pic"><img src="images/shopfancy-molino-pic.jpg"></div>

			<div class="flag"><img src="images/shopfancy-molinoflag.png"></div>

			<div class="title">台北總店</div>

			<div class="content-ch">
				10696台北市大安區復興南路一段42號1樓<br>
				(微風廣場對面)板南線忠孝復興站1號出口<br>
				(02) 2772-1577<br><br>
				週一 - 週五 11:30 AM - 3:00 PM；5:00 PM - 12:30 AM<br>
				週六 - 週日 11:30 AM - 12:30 AM
			</div>

			<div class="btn"><a href="https://www.google.com.tw/maps/place/Mo-Mo-Paradise+%E5%BE%A9%E8%88%88%E7%89%A7%E5%A0%B4/@25.0453209,121.5414569,17z/data=!3m1!4b1!4m5!3m4!1s0x3442abdbc5ad8749:0xcaa626819ccd2747!8m2!3d25.0453209!4d121.5436456?hl=en" target="_blank">Map</a></div>
		</div>

		<div class="swiper-slide mobile-shopSlider">
			<div class="pic"><img src="images/shopfancy-molino-pic.jpg"></div>

			<div class="flag"><img src="images/shopfancy-molinoflag.png"></div>

			<div class="title">台北總店</div>

			<div class="content-ch">
				10696台北市大安區復興南路一段42號1樓<br>
				(微風廣場對面)板南線忠孝復興站1號出口<br>
				(02) 2772-1577<br><br>
				週一 - 週五 11:30 AM - 3:00 PM；5:00 PM - 12:30 AM<br>
				週六 - 週日 11:30 AM - 12:30 AM
			</div>

			<div class="btn"><a href="https://www.google.com.tw/maps/place/Mo-Mo-Paradise+%E5%BE%A9%E8%88%88%E7%89%A7%E5%A0%B4/@25.0453209,121.5414569,17z/data=!3m1!4b1!4m5!3m4!1s0x3442abdbc5ad8749:0xcaa626819ccd2747!8m2!3d25.0453209!4d121.5436456?hl=en" target="_blank">Map</a></div>
		</div>
	</div>

    <div class="shop-prev">
    	<svg class="svg-shop-prev-dims">
    		<use xlink:href="#shop-prev" />
    	</svg>
    </div>

    <div class="shop-next">
    	<svg class="svg-shop-next-dims">
    		<use xlink:href="#shop-next" />
    	</svg>
    </div>
</div>

<script>
	var swiper = new Swiper('.swiper-container', {
        nextButton: '.shop-next',
        prevButton: '.shop-prev',
        spaceBetween: 30,
        loop: true,
	});
</script>