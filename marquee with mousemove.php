<style>
	.marqueeWrap{
		position: fixed;
		top: 200px;
		left: 0;
		width: 100%;
		overflow: hidden;
	}
	.marqueeList{
		&:after{
			content: "";
		    display: block;
		    clear: both;
		}
		li{
			float: left;
			padding: 0 100px;
		}
	}
</style>

<div class="marqueeWrap">
    <ul class="marqueeList">
        <li><img src="http://commmons10.com/people/assets/images/Kazuya%20Matsumoto_thumbnail_top.jpg" alt="春風亭一之輔" style="width: 541px; height: 541px;"></li>
        <li><img src="http://commmons10.com/people/assets/images/asa_chang_and_junray_top.jpg" alt="後藤しおり" style="width: 541px; height: 541px;"></li>
        <li><img src="http://commmons10.com/people/assets/images/aoba_ichiko_top.jpg" alt="春風亭一之輔" style="width: 541px; height: 541px;"></li>
        <li><img src="http://commmons10.com/people/assets/images/MinTanaka_top.jpg" alt="春風亭一之輔" style="width: 541px; height: 541px;"></li>
        <li><img src="http://commmons10.com/people/assets/images/SakiIkeda_thumbnail_top.jpg" alt="春風亭一之輔" style="width: 541px; height: 541px;"></li>
        <li><img src="http://commmons10.com/people/assets/images/takada_ren_top.jpg" alt="春風亭一之輔" style="width: 541px; height: 541px;"></li>
        <li><img src="http://commmons10.com/people/assets/images/onuki_taeko_top.jpg" alt="春風亭一之輔" style="width: 541px; height: 541px;"></li>
        <li><img src="http://commmons10.com/people/assets/images/charisma_com_top.jpg" alt="春風亭一之輔" style="width: 541px; height: 541px;"></li>
        <li><img src="http://commmons10.com/people/assets/images/ChillSpace_thumbnail_top.jpg" alt="春風亭一之輔" style="width: 541px; height: 541px;"></li>
        <li><img src="http://commmons10.com/people/assets/images/suzuki_thumbnail_top.jpg" alt="春風亭一之輔" style="width: 541px; height: 541px;"></li>
        <li><img src="http://commmons10.com/people/assets/images/YouReina_thumbnail_top.jpg" alt="春風亭一之輔" style="width: 541px; height: 541px;"></li>
        <li><img src="http://commmons10.com/people/assets/images/hasunuma_top.jpg" alt="春風亭一之輔" style="width: 541px; height: 541px;"></li>
        <li><img src="http://commmons10.com/people/assets/images/yoshida_top.jpg" alt="春風亭一之輔" style="width: 541px; height: 541px;"></li>
    </ul>
</div>

<script>
	var $wrap = $(".marqueeWrap");
	var $ul = $(".marqueeList");
	var $li = $(".marqueeList li");

	window.requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;

	var $firstItem, margin, windowWidth, $container, containerWidth, containerWidthHalf, mouseX, vector, dstMargin, nowMargin;
	var _defaultMargin = 0;
	var _half = Math.floor($li.length / 2) - 1;
	var _isBrakeScroll = false;
	var _scrollAccelerator = 0;
	var _scrollRatio = 0.88;
	var _scrollSpeed = 4;
	var _scrollDst = 0;
	var _enterFrameID = 0;

	var _adjustSlideMargin = function() {
	    $firstItem = $li.first();
	    $wrap.height($firstItem.height());
	    _itemWidth = $firstItem.outerWidth();
	    $ul.width(_itemWidth * $li.length);
	    windowWidth = $(window).width();
	    margin = (windowWidth - _itemWidth) / 2;
	    _defaultMargin = parseInt(margin - (_itemWidth * _half));
	    $ul.css('margin-left', _defaultMargin);
	}

	var _scroll = function() {
	    nowMargin = parseInt($ul.css('margin-left'));
	    dstMargin = nowMargin + _scrollDst;
	    $ul.css('margin-left', dstMargin);
	    if (dstMargin < _defaultMargin - _itemWidth) {
	        $ul.append($ul.find("li").first());
	        $ul.css('margin-left', _defaultMargin);
	    } else if (dstMargin > _defaultMargin + _itemWidth) {
	        $ul.prepend($ul.find("li").last());
	        $ul.css('margin-left', _defaultMargin);
	    }
	    _enterFrameID = requestAnimationFrame(_scroll);
	};

	var _brakeScroll = function() {
	    clearInterval(_brakeScroll.timerID);
	    _brakeScroll.timerID = setInterval(function() {
	        if (!_isBrakeScroll) {
	            clearInterval(_brakeScroll.timerID);
	            return;
	        }
	        _scrollDst = parseFloat(_scrollDst * 0.98);
	        _scrollAccelerator = _scrollDst;
	        if (-1 < _scrollDst && _scrollDst < 1) {
	            _scrollDst = 0;
	            _scrollAccelerator = _scrollDst;
	            clearInterval(_brakeScroll.timerID);
	        }
	    }, 5);
	};

	var _mouseMoveHandler = function(event) {
	    $container = $(event.currentTarget);
	    if (!_isBrakeScroll) {
	        mouseX = event.pageX - $wrap.offset().left;
	        containerWidth = $container.width();
	        containerWidthHalf = containerWidth / 2;
	        vector = parseFloat((mouseX - containerWidthHalf) / containerWidthHalf);
	        _scrollDst = -(vector * _scrollSpeed) + (_scrollAccelerator * _scrollRatio);
	        _scrollAccelerator = _scrollDst;
	    }
	};

	var _mouseLeaveHandler = function(event) {
	    _isBrakeScroll = true;
	    _brakeScroll();
	};

	var _mouseEnterHander = function(event) {
	    _isBrakeScroll = false;
	};

	$wrap.on('mousemove', _mouseMoveHandler);
	$wrap.on('mouseleave', _mouseLeaveHandler);
	$wrap.on('mouseenter', _mouseEnterHander);
	_adjustSlideMargin();
	_scroll();
</script>