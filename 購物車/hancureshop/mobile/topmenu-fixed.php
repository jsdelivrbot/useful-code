<?php require_once('../login_query.php'); ?>
<div class="topmenu-fixed">
	<div class="hamburger"><span></span></div>

	<div class="logo"><a href="index.php"><img src="images/footer-logo.png" width="90"></a></div>

	<div class="car"><a href="order_list.php"><span class="car-num"><?php echo $cart->itemCount;?></span><img src="images/topmenu-car.png" width="28"></a></div>
</div><!-- topmenu end -->

<ul class="topmenu-on-fixed">
	<li>
		<div class="topmenu-on-ch"><a href="about.php"><img src="images/topmenu-on-liststyle.png" width="11">關於我們</a></div>
		<div class="topmenu-on-en"><a href="about.php">About</a></div>
	</li>
	<li>
		<div class="topmenu-on-ch"><a href="news.php"><img src="images/topmenu-on-liststyle.png" width="11">最新消息</a></div>
		<div class="topmenu-on-en"><a href="news.php">News</a></div>
	</li>
	<li>
		<div class="topmenu-on-ch"><a href="goods.php"><img src="images/topmenu-on-liststyle.png" width="11">全部商品</a></div>
		<div class="topmenu-on-en"><a href="goods.php">Products</a></div>
	</li>
	<li>
		<div class="topmenu-on-ch"><a href="contact.php"><img src="images/topmenu-on-liststyle.png" width="11">聯絡我們</a></div>
		<div class="topmenu-on-en"><a href="contact.php">Contact</a></div>
	</li>
	<li>
		<div class="topmenu-on-ch"><a href="how.php"><img src="images/topmenu-on-liststyle.png" width="11">如何訂購</a></div>
		<div class="topmenu-on-en"><a href="how.php">How to buy</a></div>
	</li>

	<li class="separatedline"></li>

	<?php if ($totalRows_RecMember == 0) { // Show if recordset empty ?>
	<li>
		<div class="topmenu-on-ch"><a href="member_login.php"><img src="images/topmenu-on-liststyle.png" width="11">會員登入</a></div>
		<div class="topmenu-on-en"><a href="member_login.php">Member</a></div>
	</li>
	<li>
		<div class="topmenu-on-ch"><a href="register.php"><img src="images/topmenu-on-liststyle.png" width="11">會員註冊</a></div>
		<div class="topmenu-on-en"><a href="register.php">Register</a></div>
	</li>

	<?php } // Show if recordset empty ?>

	<?php if ($totalRows_RecMember > 0) { // Show if recordset not empty ?>

	<li>
		<div class="topmenu-on-ch"><a href="edit.php"><img src="images/topmenu-on-liststyle.png" width="11">Hi <?php echo $row_RecMember['m_name']; ?></a></div>
		<div class="topmenu-on-en"><a href="edit.php">Member</a></div>
	</li>
	<li>
		<div class="topmenu-on-ch"><a href="record.php"><img src="images/topmenu-on-liststyle.png" width="11">訂單記錄</a></div>
		<div class="topmenu-on-en"><a href="record.php">Order Record</a></div>
	</li>
	<li>
		<div class="topmenu-on-ch"><a href="edit.php"><img src="images/topmenu-on-liststyle.png" width="11">資料修改</a></div>
		<div class="topmenu-on-en"><a href="edit.php">Data Edit</a></div>
	</li>
	<li>
		<div class="topmenu-on-ch"><a href="<?php echo $logOutAction ?>"><img src="images/topmenu-on-liststyle.png" width="11">登出</a></div>
		<div class="topmenu-on-en"><a href="<?php echo $logOutAction ?>">LogOut</a></div>
	</li>
	<?php } // Show if recordset not empty ?>


</ul><!-- topmenu-on end -->

<script type="text/javascript">

	$(".hamburger").click(function  () {
		$("ul.topmenu-on-fixed").toggleClass("topmenu-on-toggle");

		$(this).toggleClass("hamburgerAnimated");

		if ($("ul.topmenu-on-fixed").hasClass("topmenu-on-toggle")) {
			$("body").css("overflow","hidden");
		}else{
			$("body").css("overflow","initial");
		}

	})


</script>