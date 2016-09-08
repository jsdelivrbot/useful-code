function is_IPhoneOrIPad2(){   
    return ( (navigator.platform.indexOf("iPhone") != -1) || (navigator.platform.indexOf("iPad") != -1) );    
}

(function() {

	$('.current').find("img:eq(0)").stop().css({display:'none'});
	$('.current').find("img:eq(1)").stop().css({display:''});

	var isiPad2=is_IPhoneOrIPad2();

	if(isiPad2==false){        
	  //menu 通用動作
		$(".m_over").mouseenter(function(e) {

			var c = $(this).attr('class');
			
			if(c.match('current')==null){
				$(this).find("img:eq(1)").stop().css({display:''});
				$(this).find("img:eq(0)").stop().css({display:'none'});
			}

		}).mouseleave(function() {
			var c = $(this).attr('class');
			
			if(c.match('current')==null){
				$(this).find("img:eq(0)").stop().css({display:''});
				$(this).find("img:eq(1)").stop().css({display:'none'});
			}
	 	});
	}else{
		$(".m_over").bind( "touchstart ", function(e){

			var c = $(this).attr('class');
			
			if(c.match('current')==null){
				$(this).find("img:eq(1)").stop().css({display:''});
        		$(this).find("img:eq(0)").stop().css({display:'none'});
        	}

		  });
		  $(".m_over").bind( "touchend", function(e){
		    $(this).find("img:eq(0)").stop().css({display:''});
			$(this).find("img:eq(1)").stop().css({display:'none'});
		  });
	}

}());