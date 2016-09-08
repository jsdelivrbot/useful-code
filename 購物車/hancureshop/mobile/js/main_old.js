// JavaScript Document
$(document).ready(function() {
	 $("#wrapper").smoothWheel();





	
	$(".prev").mousedown(function(e) {
		changeColor_whit();		
	});
	$(".next").mousedown(function(e) {
		changeColor_balck();		
	});
	
	var contactClose=true;
	
	$("#menu_contact").mousedown(function(e) {
		if(contactClose==true){
			TweenLite.to($("#contact"), 0.5, {css:{left:0}, ease:Power2.easeOut});
			$(this).css({textTransform:'uppercase'});
			contactClose=false;	
		}else{
			TweenLite.to($("#contact"), 0.5, {css:{left:-203}, ease:Power2.easeOut});
			$("#menu_contact").css({textTransform:'lowercase'});	
			contactClose=true;	
		}
	});
	
	$("#close_contact").mousedown(function(e) {
		TweenLite.to($("#contact"), 0.5, {css:{left:-203}, ease:Power2.easeOut});
		$("#menu_contact").css({textTransform:'lowercase'});
		contactClose=true;			
	});
	
	function changeColor_whit(){		
		$("#control2").fadeIn(1000);		
		$("#control").fadeOut(1000);
		$(".flogo2").fadeIn(1000);
		$(".flogo").fadeOut(1000);
		
		TweenLite.to($("#bg"), 1, {css:{top:0}, ease:Power2.easeOut});
		TweenLite.to($("#container"), 1, {css:{color:'#000000'}, ease:Power2.easeOut});
		TweenLite.to($("#top_bg"), 0, {css:{top:0}});
		
		TweenLite.to($("#menu_area"), 1, {css:{color:'#000000'}, ease:Power2.easeOut});
		TweenLite.to($(".pic"), 1, {css:{borderColor:'#cccccc'},delay:0.5, ease:Power2.easeOut});
		
	}
	function changeColor_balck(){
		$("#control").fadeIn(1000);		
		$("#control2").fadeOut(1000);
		$(".flogo").fadeIn(1000);
		$(".flogo2").fadeOut(1000);
		
		TweenLite.to($("#bg"), 1, {css:{top:'-100%'}});
		TweenLite.to($("#container"), 1, {css:{color:'#fff'}, ease:Power2.easeOut});
		TweenLite.to($("#top_bg"), 0.1, {css:{top:-40},delay:0.8});
		TweenLite.to($("#menu_area"), 1, {css:{color:'#fff'},delay:0.5, ease:Power2.easeOut});
		TweenLite.to($(".pic"), 1, {css:{borderColor:'#000000'}, ease:Power2.easeOut});
		
	}
	
	//menu 通用動作
	$(".m_over").mouseenter(function(e) {				
		
		$(this).find("img:eq(1)").stop().css({display:''});
		$(this).find("img:eq(0)").stop().css({display:'none'});
		
		
	}).mouseleave(function() {
		
		$(this).find("img:eq(0)").stop().css({display:''});
		$(this).find("img:eq(1)").stop().css({display:'none'});
		
 	});
	
	
	
	
	
	
	
	
	
		
	//resizeImg END=========================================	
	
});
$("#control2").fadeOut(0);
$(".flogo2").fadeOut(0);
resizeImg();
$(window).resize(function() {
		resizeImg();
    });
	
	function resizeImg(){
		
		var myWidth = $(window).width();
		var myHeight = $(window).height();
		
		var mainHeight;
		var mainwidth;
		
		var controlRight=(myWidth-960)/2+10;
		
		$('#control').css({right:controlRight})
		$('#control2').css({right:controlRight})

	}//resizeImg==============================================
	

         
        
