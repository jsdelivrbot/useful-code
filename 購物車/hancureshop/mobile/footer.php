<?php
mysql_select_db($database_connect2data, $connect2data);
$query_RecCcontactFooter = "SELECT d_content, d_class3 FROM data_set WHERE d_class1 = 'contact' AND d_active='1' ORDER BY d_sort ASC, d_date DESC";
$RecCcontactFooter = mysql_query($query_RecCcontactFooter, $connect2data) or die(mysql_error());
$row_RecCcontactFooter = mysql_fetch_assoc($RecCcontactFooter);
$totalRows_RecCcontactFooter = mysql_num_rows($RecCcontactFooter);
?>
<div class="footer">
	<ul class="footer-list">
		<li><a href="how.php">如何訂購</a></li>
		<li>|</li>
		<li><a href="how.php">付款方式</a></li>
		<li>|</li>
		<li><a href="how.php">退貨須知</a></li>
	</ul>

	<ul class="footer-list">
		<li>地址</li>
		<li>|</li>
		<li><?php echo $row_RecCcontactFooter['d_content']; ?></li>
	</ul>

	<ul class="footer-list">
		<li>訂購專線</li>
		<li>|</li>
		<li><a href="tel:<?php echo $row_RecCcontactFooter['d_class3']; ?>"><?php echo $row_RecCcontactFooter['d_class3']; ?></a></li>
	</ul>

	<ul class="footer-list">
		<li>關注我們</li>
		<li>|</li>
		<li><a href="https://www.facebook.com/petitpot8" target="new">漢速敷</a></li>
		<li><a href="https://www.facebook.com/petitpot8" target="new"><img src="images/facebook.png" width="19"></a></li>
		<!-- <li><a href="https://www.facebook.com/pages/%E9%80%99%E4%B8%80%E8%9A%B5/1638971896390042" target="new">這一蚵</a></li>
		<li><a href="https://www.facebook.com/pages/%E9%80%99%E4%B8%80%E8%9A%B5/1638971896390042" target="new"><img src="images/facebook.png" width="19"></a></li> -->
	</ul>

	<ul class="footer-list" id="footer-cus">
		<li><a href="index.php"><img src="images/footer-logo.png" width="124"></a></li>
	</ul>

	<ul class="footer-list">
		<li>©HanCure 漢速敷版權所有</li>
	</ul>
</div><!-- footer end -->