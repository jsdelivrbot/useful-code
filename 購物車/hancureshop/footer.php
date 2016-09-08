<?php
mysql_select_db($database_connect2data, $connect2data);
$query_RecCcontactFooter = "SELECT d_content, d_class3 FROM data_set WHERE d_class1 = 'contact' AND d_active='1' ORDER BY d_sort ASC, d_date DESC";
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
			<li>地址 / <?php echo $row_RecCcontactFooter['d_content']; ?></li>
			<li>服務專線 / <?php echo $row_RecCcontactFooter['d_class3']; ?></li>
		</ul>
		<ul class="item3">
			<li class="mr">CopyRight © 2015 R&J MEDICAL CO,LTD </li>
			<li class="mr"><a href="https://www.facebook.com/HanCure-%E6%BC%A2%E9%80%9F%E6%95%B7-1618456558441358/" target="new"><img src="img/icon-fb-footer.png" ></a></li>	
		</ul>
	</div><!-- wrap end -->
</div>