<!-- tilt plugin -->
https://github.com/gijsroge/tilt.js
<script>
    var tilt = $(".newsList li").tilt({
        maxTilt: 4,
    });

    tilt.on('change', function(e, transforms){
        var mx = transforms.tiltX;
        var my = transforms.tiltY;

        $(".pic", e.target).css({
            'transform':'translate3d('+ (mx * 10) +'px,'+ (my * 10) +'px,0px)',
            '-webkit-transform':'translate3d('+ (mx * 10) +'px,'+ (my * 10) +'px,0px)',
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