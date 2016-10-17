
<script type="text/javascript">
    var my=0,mx=0;
    $(".index-area2 .left").mousemove(function  (e) {
        var x=e.pageX,
        y=e.pageY;
        if(mx==0) mx=x;
        if(my==0) my=y;
        ml = x-mx;
        ml = Math.ceil(ml/150); //無條件進位。如：Math.ceil(10.0) 返回10 / Math.ceil(10.1) 返回11
        mt = y-my;
        mt = Math.ceil(mt/100);
        $(".bgmove").css({
            'transform':'translate3d('+ml+'px,'+mt+'px,0px)'
            // left: ml+'px',
            // top:mt+'px'
        });
    })
</script>