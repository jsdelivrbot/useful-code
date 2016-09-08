var lastClass='';
$(document).ready(function() {


  function is_IPhoneOrIPad2(){   
    return ( (navigator.platform.indexOf("iPhone") != -1) || (navigator.platform.indexOf("iPad") != -1) );    
	}
	var isiPad2=is_IPhoneOrIPad2();

	// if(isiPad2==false){        
	//   //menu 通用動作
	// 	$(".m_over").mouseenter(function(e) {				
			
	// 		$(this).find("img:eq(1)").stop().css({display:''});
	// 		$(this).find("img:eq(0)").stop().css({display:'none'});
			
			
	// 	}).mouseleave(function() {
			
	// 		$(this).find("img:eq(0)").stop().css({display:''});
	// 		$(this).find("img:eq(1)").stop().css({display:'none'});
			
	//  	});
	// }else{
	// 	$(".m_over").bind( "touchstart ", function(e){
	// 		$(this).find("img:eq(1)").stop().css({display:''});
 //        	$(this).find("img:eq(0)").stop().css({display:'none'});
	// 	  });
	// 	  $(".m_over").bind( "touchend", function(e){
	// 	    $(this).find("img:eq(0)").stop().css({display:''});
	// 		$(this).find("img:eq(1)").stop().css({display:'none'});
	// 	  });
	// }


	if(isiPad2==false){        
	  //menu 通用動作

		$("#menu_area .menu").mouseenter(function(e) {	
			//alert(11);
			$("#menu_area #leaf").removeClass(lastClass);
			 lastClass='leaf_'+$(this).index();
			$("#menu_area #leaf").addClass(lastClass);			
			
		}).mouseleave(function() {
			
			$("#menu_area #leaf").removeClass(lastClass);
	 	});
	}else{
		// $(".m_rao").bind( "touchstart ", function(e){
		// 	if($(this).hasClass( "current" )==false){	
		// 		$(this).find(".circle img").stop().css({visibility:''});
		// 	}
		//   });
		//   $(".m_rao").bind( "touchend", function(e){

		//   	if($(this).hasClass( "current" )==false){	
		//    		$(this).find(".circle img").stop().css({visibility:'hidden'});
		// 	}
		//   });
	}

	//$(".current").find(".circle img").stop().css({visibility:''});
});