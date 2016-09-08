<div id="Helpline">諮詢專線:0800-333388‧886-7-7919889</div>
<?php require_once('login_query.php'); ?>
<div id="login">
<?php if ($totalRows_RecMember == 0) { // Show if recordset empty ?>
		<span><a href="member_add.php">加入會員</a></span>
        <span>|</span>
        <span><a href="member_login.php">會員登入</a></span>
        <span>|</span>
        <span><a href="myCart.php">購物車<?php if($cart->itemCount>0){ echo '共<span class="focus_data">'.$cart->itemCount.'</span>種商品';}?></a></span>
<?php } // Show if recordset empty ?>
        <?php //require_once('login_data.php'); ?>
        
<?php if ($totalRows_RecMember > 0) { // Show if recordset not empty ?>
		<span><strong> <?php echo $row_RecMember['m_name']; ?> </strong> <?php if($row_RecMember['m_gender']==1){echo "先生";}else{echo "小姐";}?>，您好!</span>
        
        <!--<span><a href="member_premium.php">會員優惠下載</a></span>
        <span>|</span>-->
        <span><a href="myCart.php">購物車<?php if($cart->itemCount>0){ echo '共<span class="focus_data">'.$cart->itemCount.'</span>種商品';}?></a></span>
        <span>|</span>
        <span><a href="member.php">會員專區</a></span>
        <span>|</span>
        <span><a href="member_modify.php">會員資料修改</a></span>
        <span>|</span>
        <span><a href="<?php echo $logOutAction ?>">登出</a></span>
<?php } // Show if recordset not empty ?>
        <span>|</span>
        <span><a href="cn/">簡體版</a></span>
        <span>|</span>
        <span id="spanImg"><a href="http://www.facebook.com/RUYI.INCENSE" title="如意Facebook" target="_new"><img src="images/FB_icon_3.png" alt="如意Facebook" longdesc="http://www.facebook.com/RUYI.INCENSE" /> 如意Facebook</a></span>

<?php //echo 'MM_UserAccount = '.$_SESSION['MM_UserAccount']; ?>
</div>