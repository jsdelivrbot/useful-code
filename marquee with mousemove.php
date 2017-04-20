<style>
	.package-marqueeWrap{
		overflow: hidden;
	}
	.package-marqueeList{
		text-align: center;
		white-space: nowrap;
		display: inline-block;
		position: relative;
		left: 50%;
		transform: translateX(-50%);
		li{
			display: inline-block;
			vertical-align: top;
			margin: 0 37px;
			&:hover{
				.pic{
					img:nth-child(1){opacity: 0;}
					img:nth-child(2){opacity: 1;}
				}
			}
		}
		.pic{
			margin-bottom: 48px;
			position: relative;
			img:nth-child(2){
				position: absolute;
				top: 50%;
				left: 50%;
				transform: translate(-50%,-50%);
				opacity: 0;
			}
		}
		.en{
			font: 24px/1.5 $en-family;
			color: #272525;
			margin-bottom: 10px;
		}
		.ch{
			font: 16px/1.8 $content-family;
			letter-spacing: 1px;
			color: #272525;
		}
	}
</style>

<div class="row package-marqueeWrap">
	<ul class="package-marqueeList">
		<li><a href="package_detail.php">
			<div class="pic">
				<img src="images/wedding/marquee-1.png">
				<img src="images/wedding/marquee-1-hover.png">
			</div>
			<div class="en">ROMANTIK</div>
			<div class="ch">-浪漫主義-</div>
		</a></li>
		<li><a href="package_detail.php">
			<div class="pic">
				<img src="images/wedding/marquee-2.png">
				<img src="images/wedding/marquee-1-hover.png">
			</div>
			<div class="en">Elvis</div>
			<div class="ch">-艾維斯-</div>
		</a></li>
		<li><a href="package_detail.php">
			<div class="pic">
				<img src="images/wedding/marquee-3.png">
				<img src="images/wedding/marquee-1-hover.png">
			</div>
			<div class="en">STAR</div>
			<div class="ch">-恆星-</div>
		</a></li>
		<li><a href="package_detail.php">
			<div class="pic">
				<img src="images/wedding/marquee-4.png">
				<img src="images/wedding/marquee-1-hover.png">
			</div>
			<div class="en">MOSS</div>
			<div class="ch">-墨思-</div>
		</a></li>
		<li><a href="package_detail.php">
			<div class="pic">
				<img src="images/wedding/marquee-5.png">
				<img src="images/wedding/marquee-1-hover.png">
			</div>
			<div class="en">TIPSY</div>
			<div class="ch">-微醺-</div>
		</a></li>
	</ul>
</div>

<script>
	var $ul = $(".package-marqueeList");
	var $li = $(".package-marqueeList li");
	var _moveCheck = 1;
	var _mouseCheck;
	var _dst;
	var _n = 0;
	var _total = $li.length;

	$(".package-marqueeWrap").on("mousemove", function (e){
		var _mx = e.pageX;
		var _cx = $(window).width() / 2;
		_dst = Math.round(_mx - _cx) * 0.5;
		_mouseCheck = 1;
		move(_dst);
	}).on("mouseout", function (){
		_mouseCheck = 0;
	})

	function move(_dst) {
		if (_moveCheck) {
			TweenMax.to($ul, 0.2, {
				left: "-=" + _dst,
				ease: Power0.easeNone,
				onStart: function() {
					_moveCheck = 0;
				},
				onComplete: function() {
					_moveCheck = 1;

					if (_dst > 200) {
						$li.eq(_n % _total).clone().appendTo($ul)

						$ul.css({
							marginLeft: "+=260"
						})

						_n += 1;
					}else if (_dst < -200) {
						$li.eq((_total - 1) - Math.abs(_n % _total)).clone().prependTo($ul)

						$ul.css({
							marginLeft: "-=260"
						})

						_n -= 1;
					}

					if (_mouseCheck) {
						move(_dst);
					}else{
						TweenMax.to($ul, 0.6, {
							left: "-=" + _dst * 0.8,
						});
					}
				},
			});
		}
	}
</script>