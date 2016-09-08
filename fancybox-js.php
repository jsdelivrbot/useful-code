<script type="text/javascript">
    $(document).ready(function() {
        $(".fancybox").click(function() {
            $.fancybox.open({
                href : '<?php echo $row_RecImage['file_link1'];?>',
                padding : 0
            });
        });
    });
</script>

<!-- ddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd -->
<!-- 全畫面 -->
<script type="text/javascript" src="js/jquery/1.11.1/jquery.min.js"></script>

<script src="js/fancyapps-fancyBox/source/jquery.fancybox.js"></script>
<link rel="stylesheet" href="js/fancyapps-fancyBox/source/jquery.fancybox.css">

<a class="various" data-fancybox-type="iframe" href="engineer2.php"><div class="btn">information</div></a>

<script>
    $(document).ready(function() {
       $(".various").fancybox({
          padding:0,
          margin:0,
          width:'100%',
          height:'100%',
        'closeBtn' : false ,   //hide close btn

        helpers:  {
        overlay : null,  //取消 overlay
        locked: false,   //鎖住bg
    }

});
   });
</script>