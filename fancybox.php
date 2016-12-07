<!-- 自製 -->
<style>
  .m-fancyWrap{
    width: calc(100% + 19px);
    height: 100%;
    overflow-y: auto;
    overflow-x: hidden;
    padding: 50px 19px 50px 0;
  }
</style>

<script>
  $(".videoList li").on("click", function() {
    $("body").css({
      position: 'fixed',
      top: _scrollTop*-1,
      'overflow-y': 'scroll'
    });
  })
  $("#videoClose").on("click", function () {
    $("body").scrollTop(parseInt($("body").css("top"), 10)*-1).css({
      position: 'static'
    });
  })
</script>


<!-- ================================================================== -->

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

<!-- 全畫面 -->
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