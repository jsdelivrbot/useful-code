<?php if ($totalRows_RecMember > 0) { // Show if recordset not empty ?>
		<div id="div_member_data">
        	<div id="div_member_data_txt">
			<span><?php echo $row_RecMember['m_name']; ?></span> <?php if($row_RecMember['m_gender']==1){echo "先生";}else{echo "小姐";}?>，您好!&nbsp;&nbsp;&nbsp;<a href="fwukeh_member_premium.php">會員優惠下載</a> | <a href="fwukeh_member_modify.php">會員資料修改</a> | <a href="<?php echo $logOutAction ?>">登出</a>
            </div>
        </div>
<?php } // Show if recordset not empty ?>