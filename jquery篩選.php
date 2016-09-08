<!-- mixItUp -->
https://mixitup.kunkalabs.com/learn/tutorial/get-started/

<script src="js/jquery.mixitup.js"></script>

<style>
	/*必加  一定要吃到*/
	.mix{display: none;}
</style>

<div class="branch-detail-cat">
	<span class="item1 filter current" data-filter="all">全部老師</span>
	<span class="item2 filter" data-filter=".category-1">總策劃老師</span>
	<span class="item3 filter" data-filter=".category-2">班主任老師</span>
	<span class="item4 filter" data-filter=".category-3">團隊老師</span>
</div>

<div class="teacher-list-wrap">
	<div class="mix category-1 teacher-box"><a href="teacher_detail.php">
		<div class="head">課程總策劃</div>
		<div class="photo"><img src="images/teacher-1.png"></div>
		<div class="name">李薇薇老師</div>
		<div class="education"><span>學</span><span>歷</span></div>
		<div class="education-content">台大 中文糸 學士<br>台大 中文所 碩士</div>
		<div class="more"><img src="images/teacher-more.png" width="156"></div>
	</a></div>
	<div class="mix category-2 teacher-box"><a href="teacher_detail.php">
		<div class="head">班主任老師</div>
		<div class="photo"><img src="images/teacher-1.png"></div>
		<div class="name">李薇薇老師</div>
		<div class="education"><span>學</span><span>歷</span></div>
		<div class="education-content">台大 中文糸 學士<br>台大 中文所 碩士</div>
		<div class="more"><img src="images/teacher-more.png" width="156"></div>
	</a></div>
	<div class="mix category-3 teacher-box"><a href="teacher_detail.php">
		<div class="head">團隊老師</div>
		<div class="photo"><img src="images/teacher-1.png"></div>
		<div class="name">李薇薇老師</div>
		<div class="education"><span>學</span><span>歷</span></div>
		<div class="education-content">台大 中文糸 學士<br>台大 中文所 碩士</div>
		<div class="more"><img src="images/teacher-more.png" width="156"></div>
	</a></div>
</div><!-- teacher-list-wrap end -->

<script>
	$('.teacher-list-wrap').mixItUp();
</script>