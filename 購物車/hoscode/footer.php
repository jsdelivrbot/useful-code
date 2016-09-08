<?php
mysql_select_db($database_connect2data, $connect2data);
$query_RecCcontactFooter = "SELECT d_content, d_class4 FROM data_set WHERE d_class1 = 'contact' AND d_active='1' ORDER BY d_sort ASC, d_date DESC";
$RecCcontactFooter = mysql_query($query_RecCcontactFooter, $connect2data) or die(mysql_error());
$row_RecCcontactFooter = mysql_fetch_assoc($RecCcontactFooter);
$totalRows_RecCcontactFooter = mysql_num_rows($RecCcontactFooter);
?>
<div class="footer">
	<div class="wrap">
		<ul class="item1">
			<li><a href="products.php">全部商品</a></li>
			<li class="line"></li>
			<li><a href="howtobuy.php">如何訂購</a></li>
			<li class="line"></li>
			<li><a href="howtobuy.php">付款方式</a></li>
			<li class="line"></li>
			<li><a href="howtobuy.php">退貨通知</a></li>
		</ul>
		<ul class="item2">
			<li>Studio / <?php echo $row_RecCcontactFooter['d_content']; ?></li>
			<li>E-mail / <a href="mailto:<?php echo $row_ReCcontact['d_class4']; ?>"><?php echo $row_RecCcontactFooter['d_class4']; ?></a></li>
		</ul>
		<ul class="item3">
			<!-- <li class="mr">CopyRight © 2015 R&J MEDICAL CO,LTD </li> -->
			<li class="mr2">
				<a href="https://www.facebook.com/chstudio2010" target="new"><img src="img/community_fb.png" width="107" ></a>
			</li>
			<li class="mr">
				<a href="https://www.instagram.com/chstudio2010/" target="new"><img src="img/community_ig.png" width="107" ></a>
			</li>
		</ul>

		<div class="designBy">Site by <a href="http://www.goods-design.com.tw/" target="_blank" class="siteby">goods-design</a><!--  / <a href="http://www.weichunglee.com/" target="_blank" class="siteby">weichunglee graphics</a> --></div>

	</div><!-- wrap end -->
</div>