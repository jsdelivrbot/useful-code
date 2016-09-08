function goBack() {
    window.history.back();
}
$(window).scroll(function() {
    var _scrollPos = $(this).scrollTop();
    //console.log(scrollPos);
    if(_scrollPos>400){
      $('.backtotop').css('opacity','1');
      
    }else{
       $('.backtotop').css('opacity','0');
    }
});
$('.backtotop').mousedown(function(){  
   $(window).stop().scrollTo( 0 , 800 ,{offset:0});     
});
