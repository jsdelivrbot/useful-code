http://fancyapps.com/fancybox/3/docs/#options

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.1/dist/jquery.fancybox.min.css" />
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.1/dist/jquery.fancybox.min.js"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.25/jquery.fancybox.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.25/jquery.fancybox.min.css"> -->


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
<a href="https://fakeimg.pl/2000x1000/" data-fancybox="images" data-width="2000" data-height="1000">
    <img class="lazy" src="images/blank.gif" data-src="https://fakeimg.pl/1100x600/" width="1100" height="600">
</a>

<script>
    // basic
    $('[data-fancybox="images"]').fancybox({
        loop: true,
        protect: true,
        buttons: [
            "zoom",
            // "share",
            "slideShow",
            // "fullScreen",
            //"download",
            // "thumbs",
            "close"
          ],
    });


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
<style>
    body{
        /* reset fancybox css */
        .fancybox-bg{
            background-color: rgba(#231815, .75);
        }
        .fancybox-is-open .fancybox-bg{
            background-color: rgba(#000, .9);
            opacity: 1;
        }
        .fancybox-slide>div{
            background-color: transparent;
            padding: 0;
            margin: 70px 0;
        }
    }
</style>

<script>
    $(".about-anime").on("click", function () {
        $.fancybox.open({
            src  : '.fancyWrap',
            type : 'inline',
            opts : {
                smallBtn: false,  //裡面的小x
                trapFocus: false,
                toolbar: false,  //右上角那些按鈕
                touch: false,  //往下拖曳關掉
                animationDuration: 1200,
            }
        });
    })

    $(".index-fancyClose").on("click", function () {
        $.fancybox.close();
    })
</script>