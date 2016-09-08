var ScrollObserver = function()
{
	var $dummy = $("#dummy");
	var $logo = $("#logo");
	var $logoEn = $("#logoEn");
	var $cover = $("#cover");
	var $intro = $("#intro");
	var $arrow = $("#arrow");
	
	
	var introStart =  + 50;
	

	var superman1 = new SupermanController($("#superman1"),  100, 1000);
	
	
	

	
	var totalHeight =700 + 600 + 1200;
	$("#dummy").height(totalHeight);
	
	
	
	$(window).scroll(function()
	{
		var scrollTop = $(this).scrollTop();
		
	
		
		superman1.translate(scrollTop);
		//alert(11);
	
	});
	
	
	
	$(window).resize(function()
	{
		totalHeight =  700 + 600 + 1000;		
		
		$(window).scroll();
	})
}
