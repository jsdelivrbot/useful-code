<svg class="blur" width="100%" height="100%">
    <image filter="url(#filter-1479471131228)" xlink:href="home-1_mini.jpg" width="100%" height="100%"></image>
    <filter id="filter-1479471131228" class="">
        <feGaussianBlur stdDeviation="10" color-interpolation-filters="sRGB"></feGaussianBlur>
    </filter>
    <mask class="mask" id="mask-1479471131228">
        <circle cx="1062px" cy="338px" r="150" fill="white" filter="url(#filter-1479471131228)"></circle>
    </mask>
    <image xlink:href="home-1_mini.jpg" width="100%" height="100%" mask="url(#mask-1479471131228)" class=""></image>
</svg>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script>
    $('body').on('mousemove', function(event) {
        var posX = event.clientX;
        var posY = event.clientY;

        $('svg').find('.mask circle').each(function () {
            this.setAttribute('cy', ((posY) + 'px'));
            this.setAttribute('cx', ((posX) + 'px'));
        });
    });
</script>