http://idangero.us/swiper/api/#.WdoAmVuCyUk

<!-- 中文 -->
http://www.swiper.com.cn/api/index.html

<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.5/js/swiper.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.5/css/swiper.min.css">

<!-- Slider main container -->
<div class="swiper-container">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->
        <div class="swiper-slide">Slide 1</div>
        <div class="swiper-slide">Slide 2</div>
        <div class="swiper-slide">Slide 3</div>
    </div>

    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>

    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>

    <!-- If we need scrollbar -->
    <div class="swiper-scrollbar"></div>
</div>

<script>
	var swiper = new Swiper('.swiper-container', {
        loop: true,
        slidesPerView: 3,
        slidesPerGroup: 3,
        spaceBetween: 0,
        grabCursor: true,
        keyboard: true,
        // centeredSlides:true,
        // slidesOffsetBefore: 25,
        // slidesOffsetAfter: 50,
        // init: false,     // for fancybox
        navigation: {
        	prevEl: '.diy-package-prev',
        	nextEl: '.diy-package-next',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            // dynamicBullets: true,
        },
        breakpoints: {
            1024: {
                slidesPerView: 1,
            },
        }
	});

    // fancybox trick
    $("#diyFancy").fadeIn(500, function () {
        // $swiper.initialized = false;     // multiple maybe need it
        $cat_swiper.init();
        $products_swiper.init();
    });
</script>