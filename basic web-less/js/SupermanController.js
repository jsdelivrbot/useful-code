var SupermanController = function($target, start, step)
{
	var $view = $target;
	var direction = $view.attr("dir");
	var percentage = 0;
	
	
	
	this.translate = function(scrollTop)
	{
		$view.show();
		
		percentage = Math.round((scrollTop - start) / step * 100) * 0.01;
		
		move();
	}
	
	
	
	var move = function()
	{
		var distance = ($(window).width() + $view.width()) * percentage - $view.width();
		
		if(direction == "left")
		{
			$view.css("right", distance);
		}
		else
		{
			$view.css("left", distance);
		}
	}
	
	
	
	var resizeHandler = function()
	{
		$view.css("top", $(window).height() / 2 - $view.height() / 2);
		move();
	}
	
	
	
	$(window).resize(resizeHandler);
	resizeHandler();
}
