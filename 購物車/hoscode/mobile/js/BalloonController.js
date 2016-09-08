var BalloonController = function($target, start, step)
{
	var $view = $target;
	var percentage = 0;
	
	
	
	this.translate = function(scrollTop)
	{
		$view.show();
		
		percentage = Math.round((scrollTop - start) / step * 100) * 0.01;
		
		move();
	}
	
	
	
	var move = function()
	{
		var distance = $(window).height() - ($(window).height() + $view.height()) * percentage - $view.height();
		
		$view.css("top", distance);
	}
	
	
	
	var resizeHandler = function()
	{
		$view.css("left", $(window).width() / 2 - $view.width() / 2);
		move();
	}
	
	
	
	$(window).resize(resizeHandler);
	resizeHandler();
}