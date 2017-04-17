<!-- document -->
https://github.com/alvarotrigo/fullPage.js#fullpagejs

<!-- examples -->
http://alvarotrigo.com/fullPage/examples/autoHeight.html#3rdPage


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.4/jquery.fullpage.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.4/jquery.fullpage.js"></script>

<div id="fullpage">
	<div class="section index-banner ib-bg-1">
		<div class="ib-articleWrap">
			<div class="en">HAVE NICE DAY</div>
			<div class="ch">- 原味奶油餅乾 -</div>
		</div>
	</div>

	<div class="section index-banner ib-bg-2">
		<div class="ib-articleWrap">
			<div class="en">SUCH GOOD DAY</div>
			<div class="ch">- 重現門市現場體驗 -</div>
		</div>
	</div>

	<div class="section index-banner ib-bg-3">
		<div class="ib-articleWrap">
			<div class="en">WE FOUND LOVE</div>
			<div class="ch">- 我的婚禮 我的時尚配件 -</div>
		</div>
	</div>

	<!-- auto height 只要加 fp-auto-height -->
	<div class="section fp-auto-height row footerWrap">
		<div class="columns large-8">
			<div class="item">│台北市大安區富錦街102號│04-23754848│butshop@but.com .tw│</div>
			<div class="item">│open_  AM10:00 - PM6:30│</div>
		</div>

		<div class="columns large-4 copyrightWrap">
			<ul class="footer-linkList"></ul>

			<div class="item">Copyright © but All Rights Reserved​​</div>
		</div>
	</div>
</div>

<script>
	$('#fullpage').fullpage({
		scrollingSpeed: 1200
	});
</script>