<!-- tilt plugin -->
https://github.com/gijsroge/tilt.js

<!-- 有改過 多了從移入點開始計算 -->
<script src="js/tilt.jquery.js"></script>
<script>
    var tilt = $(".newsList li").tilt({
        maxTilt: 4,
        speed: 1000,
        easing: 'cubic-bezier(0, 0, 0.2, 1)',
    });

    tilt.on('change', function(e, transforms){
        var mx = transforms.relativeFirstX * 0.02;
        var my = transforms.relativeFirstY * 0.02;

        $(".pic", e.target).css({
            'transform':'translate3d('+ mx +'px,'+ my +'px,0px)',
            '-webkit-transform':'translate3d('+ mx +'px,'+ my +'px,0px)',
            'transition': 'all 0s',
            '-webkit-transition': 'all 0s',
        });

        $(".article", e.target).css({
            'transform':'translate3d('+ -mx +'px,'+ -my +'px,0px)',
            '-webkit-transform':'translate3d('+ -mx +'px,'+ -my +'px,0px)',
            'transition': 'all 0s',
            '-webkit-transition': 'all 0s',
        });
    });

    tilt.on('tilt.mouseLeave', function(e){
        $(".pic", e.target).css({
            'transform':'translate3d(0px,0px,0px)',
            '-webkit-transform':'translate3d(0px,0px,0px)',
            'transition': 'all 0.8s',
            '-webkit-transition': 'all 0.8s',
        });
    });
</script>

<script>
    var my = 0;
    var mx = 0;

    $(".index-area2 .left").mousemove(function(e) {
        var x = e.pageX;
        var y = e.pageY;

        var ml;
        var mt;

        if (mx == 0) mx = x;
        if (my == 0) my = y;

        ml = x - mx;
        ml = Math.ceil(ml / 150); //無條件進位。如：Math.ceil(10.0) 返回10 / Math.ceil(10.1) 返回11
        mt = y - my;
        mt = Math.ceil(mt / 100);

        $(".bgmove").css({
            'transform': 'translate3d(' + ml + 'px,' + mt + 'px,0px)'
                // left: ml+'px',
                // top:mt+'px'
        });
    })
</script>