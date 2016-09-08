if (!window.console)
{
    window.console = {
        log: function(){}
    };
}



$(function()
{
	var $loading = $("#loading");
	var $nowloading = $("#nowloading");
	
	var list = 
	[
		"/index-assets/images/top.jpg",
		"/index-assets/images/logo.png",
		"/index-assets/images/logo_en.png",
		"/index-assets/images/balloon1.png",
		"/index-assets/images/balloon2.png",
		"/index-assets/images/balloon3.png",
		"/index-assets/images/superman_left.png",
		"/index-assets/images/superman_right.png"
	];
	
	
	
	var preloader = new Preloader(list, function()
	{
		console.log("ok");
		$("#wrapper").show();
		$("#dummy").height(21000);
		$loading.fadeTo(1000, 0).hide();
		
		var observer = new ScrollObserver();
	});
	
	
	
	var resizeHandler = function()
	{
		$nowloading.css("left", $(window).width() / 2 - $nowloading.width() / 2);
		$nowloading.css("top", $(window).height() / 2 - $nowloading.height() / 2);
	}
	
	
	resizeHandler();
	$(window).resize(resizeHandler);
	
	preloader.load();
});



function back()
{
	$("html, body").animate({scrollTop: 0}, 3000, 'easeInOutCubic');
}



function bottom()
{
	$("html, body").animate({scrollTop: $("body").height()}, 12000, 'easeInOutCubic');
}
