// JavaScript Document
var first_in=false;
$(window).load(function() {	

	var myHeight = $(window).height();	
});
$(document).ready(function() {
   // $("#index_menu").css({bottom:-210}); //bottom:86px;
  //$("#index_menu").css({top:-110}); //bottom:86px;
	//$("#slogan").css({bottom: -210}); //bottom:237px;
	//alert(is_IPhoneOrIPad());

	
	
	function is_IPhoneOrIPad(){		
		return ( (navigator.platform.indexOf("iPhone") != -1) || (navigator.platform.indexOf("iPad") != -1) );		
	}
	
	
	resizeImg();	
		
	$(window).resize(function() {
		$('body').stop().animate({
				scrollTop:0
			}, 800);
		resizeImg();
    });
	
	
	
	function resizeImg(){
		var myWidth = $(window).width();
		var myHeight = $(window).height();
		
		

		
		$('#lookbook').css({left:(myWidth-$('#lookbook').width())/2,top:((myHeight-82-$('#lookbook').height())/2)+82}); 
		$('#supersized').css({left:(myWidth-580)/2,top:((myHeight-82-533)/2)+82}); 
		$('#lookbook_bg').css({left:(myWidth-612)/2+7,top:((myHeight-82-562)/2)+82+7}); 
		
		//$('#scene4').css({top:myHeight}); 
		if(myHeight>787){
			
		}else{
			
		}
		//$('#scene3').css({height:myHeight*2});
		
	
		
		if(myWidth > 960){
			//置中區====
			
		}else{
			
		}		
		
		
		
	}//resizeImg
	
	//resizeImg END=========================================	
	
	//menu 通用動作
	$(".m_over").mouseenter(function(e) {				
	 
		$(this).find("img:eq(1)").stop().css({display:''});
		$(this).find("img:eq(0)").stop().css({display:'none'});
		
		
	}).mouseleave(function() {
		
		$(this).find("img:eq(0)").stop().css({display:''});
		$(this).find("img:eq(1)").stop().css({display:'none'});
		
 	});
	//menu 通用動作
	$("#lookbook").mouseover(function(e) {				
	 	$(this).find("img:eq(0)").stop().animate({
				opacity:0
			}, 800);
		
		
	}).mouseout(function() {
	
		$(this).find("img:eq(0)").stop().animate({
				opacity:1
			}, 800);
		
 	});
		
	
	

})