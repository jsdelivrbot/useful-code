// JavaScript Document
$(document).ready(function() {
	
	//menu動作
	//防止拖曳圖片
	$("#indexBg img").mousedown(function(e) {				
		e.preventDefault();
	})
	
	/*//menu動作
	$(".m_current").find("img:eq(1)").stop().css({display:''});
	$(".m_current").find("img:eq(0)").stop().css({display:'none'});
	$(".m_current").parent().find(".ch_menu").slideDown(0);
	
	$(".m_overLay").mouseenter(function(e) {				
		if($(this).attr('class')!='m_overLay m_current'){
			//$(this).find("img").stop().animate({marginTop:-9});
			$(this).find("img:eq(1)").stop().css({display:''});
			$(this).find("img:eq(0)").stop().css({display:'none'});
			$(this).parent().find(".ch_menu").slideDown(300);
			//alert($(this).attr('class'));
		}
	}).mouseleave(function() {
		if($(this).attr('class')!='m_overLay m_current'){
			//$(this).find("img").stop().animate({marginTop:0});
			$(this).find("img:eq(0)").stop().css({display:''});
			$(this).find("img:eq(1)").stop().css({display:'none'});
			$(this).parent().find(".ch_menu").slideUp(300);
		}
 	});
	*/
	
	$(".m_over").find("img:eq(1)").stop().css({display:'none'});
	
	//menu 通用動作
	$(".m_over").mouseenter(function(e) {				
		
		$(this).find("img:eq(1)").stop().css({display:''});
		$(this).find("img:eq(0)").stop().css({display:'none'});
		
		
	}).mouseleave(function() {
		
		$(this).find("img:eq(0)").stop().css({display:''});
		$(this).find("img:eq(1)").stop().css({display:'none'});
		
 	});
	
});