// JavaScript Document
function adminSiteLink(x){ 
switch(x){
	case 0:
		location.href="../index.php";
	break;
	case 1:
		location.href="authority_list.php";
	break;
	case 2:
		location.href="bannersHome_list.php";
		//location.href="indexSet_list.php";
	break;
	case 3:
		location.href="articleT_list.php";
	break;
	case 4:
		location.href="article_list.php";
	break;
	case 5:
		location.href="author_list.php";
	break;
	case 6:
		location.href="events_list.php";
	break;
	case 7:
		location.href="partner_list.php";
	break;
	
	case 8:
		location.href="about_list.php";
	break;
	case 9:
		location.href="clause_list.php";
	break;
	case 10:
		location.href="weneedu_list.php";
	break;
	case 11:
		location.href="articleTag_list.php";
	break;
	case 12:
		location.href="epaper_list.php";
	break;
	case 13:
		location.href="download_list.php";
	break;
	case 14:
		location.href="farmer_list.php";
	break;
	case 15:
		location.href="shopProcess_list.php";
	break;
	case 16:
		location.href="message_list.php";
	break;
}
	
}


$(menu_now).addClass("main_menu_now"); //同时新增二个样式类别  


//回上一頁======================================
if( $(".menu_back").length){
	$('.menu_back').click(function() {
			window.history.back();
		})
}

$(document).ready(function(){
	
	$("#cmsMenu li").hover(function(){
		$(this).addClass('main_menu_hover');
		$(this).css({'cursor': 'pointer'});
	}, function(){
		$(this).removeClass('main_menu_hover');
	});
	
	$("#cmsMenu li").click(function() {
		window.location = $(this).find('a').attr('href');
	});
		
});
