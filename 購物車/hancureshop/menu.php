<ul class="list_menu_area">
	<li class="  css_mover">
		<!-- <a href="index.php#about">
		<img src="images/list1.png" width="75">
		<img src="images/list1-hover.png" width="75">
		</a> -->
		<a href="index.php#about">
			<div class="bigtitle">
				<div class="ch">關於我們</div>
				<div class="en">About</div>
			</div>
		</a>
	</li>
	<li class="css_mover <?php if($now=='news'){ ?>active<?php } ?>">
		<a href="news.php">
			<div class="bigtitle">
				<div class="ch">最新消息</div>
				<div class="en">News</div>
			</div>
		</a>
	</li>
	<li class="css_mover <?php if($now=='products'){ ?>active<?php } ?>">
		<a href="products.php">
			<div class="bigtitle">
				<div class="ch">全部商品</div>
				<div class="en">Products</div>
			</div>
		</a>
	</li>
	<li class="css_mover">
		<a href="index.php#contact">
			<div class="bigtitle">
				<div class="ch">聯絡我們</div>
				<div class="en">Contact</div>
			</div>
		</a>
	</li>
	<li class="css_mover <?php if($now=='buy'){ ?>active<?php } ?>">
		<a href="howtobuy.php">
			<div class="bigtitle">
				<div class="ch">如何訂購</div>
				<div class="en">How to buy</div>
			</div>
		</a>
	</li>
</ul>