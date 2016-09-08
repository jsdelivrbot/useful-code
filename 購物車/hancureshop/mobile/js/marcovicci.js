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
		
		

		//imgWidth = $("#happy_slides").find("img").width();
		//imgHegiht = $("#happy_slides").find("img").height();		
		$('#s1title').css({left:(myWidth-$('#s1title').width())/2}); 
		$('#s2title').css({left:(myWidth-$('#s2title').width())/2}); 
		$('#s3title').css({left:(myWidth-$('#s3title').width())/2}); 
		
		$('#tostart').css({left:(myWidth-$('#tostart').width())/2}); 
		
		$('#scene2').css({top:myHeight-84}); 
		$('#scene3').css({top:parseInt($('#scene2').css('height'))});
		//$('#scene4').css({top:myHeight}); 
		if(myHeight>787){
			$('#copyright_area').css({marginTop:250});
		}else{
			$('#copyright_area').css({marginTop:0});
		}
		//$('#scene3').css({height:myHeight*2});
		
		
		$('#collection-pic img').css({width:(myWidth/2),hegiht:'auto'});
		$('#collection-pic').css({left:(parseInt($('#collection-pic img').css('width'))*(-1))});
		
		$('#lookbook-pic img').css({width:(myWidth/2),hegiht:'auto'});
		$('#lookbook-pic').css({right:(parseInt($('#lookbook-pic img').css('width'))*(-1))});
		
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
	
	//address===============================================================================================	
	var nowPath;
	$.address.change(function(event) {
		nowPath=$.address.path();
		 if(nowPath!=""){
			nowPath=nowPath.split("/");//切割掉"/news_news的 斜線/" 會返回空值(nowPath[1]) 以及 剩下的字串news_news(nowPath[2])
			nowPath=nowPath[1];
		}else{
			
			nowPath='index';
			//alert(nowPath);
		}	
		//alert(nowPath);	
		goMenu(nowPath);
			
		
    });
	//(更改處) 確認是否有這個URL的深度連結名稱
	function goMenu(nowPath){
		var navArrow=$('#arrow');
		var goto;
		switch(nowPath)
		{
			case 'index':
				//navArrow.stop().animate({top:-15});
				
			break;
			case 'concept':				
				goto='scene2';
				$('body').stop().scrollTo( $('#scene2'), 1000 ,{queue:true});
				
			break;
			case 'news':				
				navArrow.stop().animate({top:73});
				
			break;
			case 'project':
				navArrow.stop().animate({top:144});
				
			break;
			case 'works':
				navArrow.stop().animate({top:215});
				
			break;
			case 'contact':
				$('body').stop().scrollTo( $('#scene4'), 1000 ,{queue:true});
			
			break;
			
			break;
			case 'project_sub1':			
			//$('.long_content').scrollTo( $('#project_sub1'),{queue:true});	
			break;
			
			case 'project_sub2':			
			//$('.long_content').scrollTo( $('#project_sub1'),{queue:true});	
			break;
						
			default:
				
			break;
		}
		//alert('#'+nowPath);
		
	}
	

})