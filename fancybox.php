http://fancyapps.com/fancybox/3/docs/#options

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

<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.25/jquery.fancybox.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.25/jquery.fancybox.min.css">

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