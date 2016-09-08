<div class="backtotop"><img src="img/backtotop.png" width="71"></div>

<script type="text/javascript">
	 $(function(){
		$(".backtotop").click(function(){
	        jQuery("html,body").animate({
	            scrollTop:0
	        },1000);
	    });
	});
	$(window).scroll(function() {
        if ( $(this).scrollTop() > 800){
            $('.backtotop').fadeIn("fast");
        } else {
            $('.backtotop').stop().fadeOut("fast");
        }
    });
</script>