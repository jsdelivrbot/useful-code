// JavaScript Document
var bigPic_min_hight;
var rate;
var imgHegiht;

$(document).ready(function() {

  resizeImg();	
		
	$(window).resize(function() {
		resizeImg();
    });
	
	

})

function resizeImg(){
		
		var myWidth = $(window).width();
		var myHeight = $(window).height();
		//imgHegiht = 168+22;		
		
		//rate=930/569;
		var mainHeight;
		var mainwidth;
		var Pic_hight=800;
		var Pic_width=1920;
		var _top;


				// var _width=$('.centerObj').width()+12;	
				// $(".centerObj").css({
				// 	left: (myWidth-centerObj)/2		
				// });				
		
						
}//resizeImg=============
//resizeImg END=========================================

function centerObj(myWidth,obj){
	var _p_left=parseInt($(obj).css('padding-left'));
	var _p_right=parseInt($(obj).css('padding-right'));
	var _width=$(obj).width();	
	$(obj).css({
		left: (myWidth-_width-_p_left-_p_right)/2		
	});	
	//alert( (myWidth-_width-_p_left-_p_right)/2);	
}