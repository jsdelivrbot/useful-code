<!-- 附加動畫 (利用亂數的classname)-->
<script>
	// ajax
	var $init_count=3;
	var $check_cat="<?= $_GET['cat'] ?>";
	var _class_random;
	$('.watchMore').on('click', function() {
		var _cat= ($check_cat=='') ? -1: $check_cat;
		$.ajax({
			data: {init_count: $init_count, cat: _cat},
			url: "investors_data.php",
			type:"GET",
			success: function(msg){
				_class_random = 1 + Math.floor(Math.random() * 99999);

				// url那頁須外包一層
				$(msg).find('li').each(function(){
					var $html=$(this).html();
					$("<li class='ryder-"+_class_random+"'></li>").html($html).appendTo(".m-newsList");
				});
				if (msg=='') {
					alert("已經沒有更多資訊了");
				}
			},
			complete: function () {
				$init_count+=3;
				$(".ryder-"+_class_random+"").stop(true).hide().fadeIn(800);
			}
		});
	});
</script>


<script>
	$('.watchMore').on('click', function() {
		var $init_count=3;
		var $check_cat="<?= $_GET['cat'] ?>";
		$('.watchMore').on('click', function() {
			var _cat= ($check_cat=='') ? -1: $check_cat;
			$.ajax({
				data: {init_count: $init_count, cat: _cat},
				url: "news_data.php",
				type:"GET",
				success: function(msg){
					$(".m-newsList").append(msg);

					//url那頁不能有空行才可用
					if (msg=='') {
						alert("已經沒有更多資訊了");
					}
				},
				complete: function () {
					$init_count+=3;
				}
			});
		});
	});
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