http://fancyapps.com/fancybox/3/docs/#options

<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.25/jquery.fancybox.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.25/jquery.fancybox.min.css">

<!-- ajax setting -->
<a data-id="1" href="javascript:;">AJAX content</a>
<a data-id="2" href="javascript:;">AJAX content</a>
<a data-id="3" href="javascript:;">AJAX content</a>
<a data-id="4" href="javascript:;">AJAX content</a>

<script>
    $("a").on("click", function () {
        $.fancybox.open({
            src: 'overlay.php',
            type: 'ajax',
            opts: {
                ajax: {
                    settings: {
                        type: 'POST',
                        data: {
                            test: this.dataset.id
                        }
                    }
                }
            }
        }, {
            afterLoad(instance, current) {
                lazyload.update();
                $('.fancy__shop-slick').slick('resize');
            }
        });
    })
</script>

<!-- image setting -->
<ul class="ryder-selectList">
    <li>
        <a href="images/select-01.jpg" data-fancybox="images">
            <div class="pic" style="background-image: url(images/select-01.jpg);"></div>
        </a>
    </li>
    <li>
        <a href="images/select-02.jpg" data-fancybox="images">
            <div class="pic" style="background-image: url(images/select-02.jpg);"></div>
        </a>
    </li>
</ul>

<script>
    $("[data-fancybox]").fancybox({
        loop : true,
        infobar : true,
        animationEffect : "zoom",
        animationDuration : 400,
        transitionEffect : "slide",
        transitionDuration : 400,
        protect : true,
    });
</script>

<!-- inline -->
<script>
    $(".about-anime").on("click", function () {
        $.fancybox.open({
            src  : '.fancyWrap',
            type : 'inline',
            opts : {
                smallBtn : false,
                animationDuration : 1200,
            }
        });
    })
</script>