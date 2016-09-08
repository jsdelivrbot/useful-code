// JavaScript Document
$(document).ready(function() {
	var control=true;
	var ch_time=1000;
	
	$(window)._scrollable();
		
	$(".prev").mousedown(function(e) {
		//changeColor_whit();
		if(control==true){
			control=false;
			$(window).scrollTo( $('#w1'), 1000, {easing:'easeOutCubic',offset:{top:-240} , onAfter:function(){changeColor_whit(); changeTitle($('#w1'));	 }} );	
		}
	});
	$(".next").mousedown(function(e) {
		//
		if(control==true){
			control=false;
			$(window).scrollTo( $('#w2'), 1000, {easing:'easeOutCubic',offset:{top:-240}, onAfter:function(){changeColor_balck(); changeTitle($('#w2'));	 }  } );
		}
		//$("body").scrollTo( {top:'100px'}, 500 );
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
		$("#control2").fadeIn(ch_time);		
		$("#control").fadeOut(ch_time);
		$(".flogo2").fadeIn(ch_time);
		$(".flogo").fadeOut(ch_time);
		
		TweenLite.to($("#bg"), ch_time/1000, {css:{top:0}, ease:Power2.easeOut,onComplete:controlOpen});
		TweenLite.to($("#container"),  ch_time/1000, {css:{color:'#000000'}, ease:Power2.easeOut});
		TweenLite.to($("#top_bg"), 0, {css:{top:0}});
		
		TweenLite.to($("#menu_area"),  ch_time/1000, {css:{color:'#000000'}, ease:Power2.easeOut});
		TweenLite.to($(".pic"),  ch_time/1000, {css:{borderColor:'#cccccc'},delay:0.5, ease:Power2.easeOut});
		
	}
	function changeColor_balck(){
		$("#control").fadeIn( ch_time/1000);		
		$("#control2").fadeOut( ch_time/1000);
		$(".flogo").fadeIn( ch_time/1000);
		$(".flogo2").fadeOut( ch_time/1000);
		
		TweenLite.to($("#bg"),  ch_time/1000, {css:{top:'-100%'},onComplete:controlOpen});
		TweenLite.to($("#container"),  ch_time/1000, {css:{color:'#fff'}, ease:Power2.easeOut});
		TweenLite.to($("#top_bg"), 0.1, {css:{top:-40},delay:0.8});
		TweenLite.to($("#menu_area"),  ch_time/1000, {css:{color:'#fff'},delay:0.5, ease:Power2.easeOut});
		TweenLite.to($(".pic"),  ch_time/1000, {css:{borderColor:'#000000'}, ease:Power2.easeOut});
		
	}
	
	
	function controlOpen(){
		control=true;
	}
	
	function changeTitle(obj){
		var _text=obj.find('.hideTitle').html();
		$('.now-name').html(_text);
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
	
