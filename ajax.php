<!-- 電腦一次LOAD全部，手機先LOAD 20個，按MORE一次LOAD 8個 -->
<script>
	var _counts = 20;
	var _total = <?= $totalRows_RecEvents ?>;
	var $el;

	if (/ipad/i.test(navigator.userAgent.toLowerCase())) {
	    get_events(0, 20);    // 目前是用ipad瀏覽
	}
	else if (/iphone|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase())) {
	    get_events(0, 20);   // 目前是用手機瀏覽
	}
	else {
	    get_events(0, _total);      // 目前是用電腦瀏覽
	}

	$(".eventsPicWrap .more").on("click", function () {
		if (_counts >= _total) {
			alert("已經是最後一筆資料了。");
		}else{
			get_events(_counts, 8);
		}
	})

	function get_events (counts, total) {
		$.ajax({
			data: {
				counts: counts,
				total: total
			},
			url: "events_data.php",
			type: "GET",
			success: function(res){
				$el = $(res).find("li")
				$el.appendTo($(".eventsPicList"));
			},
			complete: function () {
				_counts = counts + 8;

				TweenMax.staggerTo($el, 0.5, {
					opacity: 1,
					top: 0,
					left: 0
				}, 0.01);
			}
		});
	}
</script>


<!-- 菜逼巴用的 load-->
<ul class="mountainList">
	<div id='loadingDiv'><img src='images/ajax-loader.gif' /></div>
	<div id="links-list">
		<li data-link="mountain_data.php">
			<img src="images/mountain-list-1.png">
			<div class="morearea">你看見她就騎上她</div>
		</li>
		<li data-link="mountain_data_1.php">
			<img src="images/mountain-list-2.png">
			<div class="morearea">環山樹林夕陽下</div>
		</li>
		<li data-link="mountain_data_2.php">
			<img src="images/mountain-list-3.png">
			<div class="morearea">環顧台灣四季改了五百遍</div>
		</li>
		<li data-link="mountain_data_3.php">
			<img src="images/mountain-list-4.png">
			<div class="morearea">看烏鴉在岩石上安逸</div>
		</li>
	</div>
</ul>

<script>
	// ajax
	$('.mountainList li').on('click', function () {
		var link = $(this).data("link");
		$("#links-content").load(link);
	});
	$('.leftmenu li').on('click', function () {
		var link = $(this).data("link");
		//需重寫一次js
		$("#links-list").load(link,function () {
			$('.mountainList li').on('click', function () {
				var link = $(this).data("link");
				$("#links-content").load(link);
			});
		});
	});

	// ajax loading
	$('#loadingDiv').hide().ajaxStart( function() {
		$(this).show();
	} ).ajaxStop ( function(){
		$(this).hide();
	});
</script>