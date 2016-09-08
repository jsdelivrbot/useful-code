<?php
mysql_select_db($database_connect2data, $connect2data);
$query_RecCcontactFooter = "SELECT d_content, d_class4 FROM data_set WHERE d_class1 = 'contact' AND d_active='1' ORDER BY d_sort ASC, d_date DESC";
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

	<ul class="footer-list list-left">
		<li>Studio</li>
		<li>|</li>
		<li><?php echo $row_RecCcontactFooter['d_content']; ?></li>
	</ul>

	<ul class="footer-list list-left">
		<li>E-mail</li>
		<li>|</li>
		<li><a href="mailto:<?php echo $row_RecCcontactFooter['d_class4']; ?>"><?php echo $row_RecCcontactFooter['d_class4']; ?></a></li>
	</ul>

	<ul class="footer-list list-left">
		<li>關注我們</li>
		<li>|</li>
		<li><a href="https://www.facebook.com/chstudio2010" target="new">chstudio2010</a></li>
		<li><a href="https://www.facebook.com/chstudio2010" target="new"><img src="images/facebook2.png" width="22"></a></li>
	</ul>

	<ul class="footer-list" id="footer-cus">
		<li><a href="index.php"><img src="images/footer-logo.png" width="105"></a></li>
	</ul>

	<ul class="footer-list">
		<li>Copyright © 2015</li>
	</ul>

	<ul class="footer-list">
		<li><div class="designBy">Site by <a href="http://www.goods-design.com.tw/" target="_blank" class="siteby">goods-design</a><!--  / <a href="http://www.weichunglee.com/" target="_blank" class="siteby">weichunglee graphics</a> --></div></li>
	</ul>

</div><!-- footer end -->