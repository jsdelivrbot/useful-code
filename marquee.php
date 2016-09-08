<!-- plugin 1 -->
https://github.com/aamirafridi/jQuery.Marquee


<!-- plugin 2 -->
<!-- js 700行可做一些控制 -->
http://www.dowebok.com/188.html

<script src="js/jquery.liMarquee.js"></script>
<link rel="stylesheet" href="css/liMarquee.css">

<style>
	.about-marquee-list{
		span{
			display: inline-block;
			margin-right: 83px;
			position: relative;
			&:after{
				content: '';
				position: absolute;
				width: 100%;
				height: 100%;
				top: 0;
				left: 0;
				background-color: rgba(185,178,216,0.3);
			}
		}
	}
</style>

<!-- span是為了遮色片 -->
<div class="about-marquee-list">
	<span><img src="images/index-about-1.png"></span>
	<span><img src="images/index-about-1.png"></span>
	<span><img src="images/index-about-1.png"></span>
</div>

<script>
	$('.about-marquee-list').liMarquee({
		hoverstop: false,
		scrollamount: 35
	});
</script>