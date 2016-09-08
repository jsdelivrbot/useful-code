<?php require_once('login_query.php'); ?>
<?php 
//echo 'totalRows_RecMember = '.$totalRows_RecMember;
?>
<div class="topmenu">
	<div class="menu"><span></span></div>
	<ul class="topmenu-nav topmenu-nav-left">
    	
        <li class="main-nav"><a href="javascript:;" class="aboutLink">
        	<div class="chtitle"><img src="img/micon2.png" class="wicon">關於 <span class="en">C+H</span></div>
				<!--<div class="entitle jp-serif">About</div>-->
        </a></li>
        <li class="main-nav"><a href="news.php">
        	<div class="chtitle"><img src="img/micon2.png" class="wicon">最新消息</div>
						<!--<div class="entitle">News</div>-->
        </a></li>
        <li class="main-nav"><a href="products.php">
        	<div class="chtitle"><img src="img/micon2.png" class="wicon">全部商品</div>
						<!--<div class="entitle">Products</div>-->
        </a></li>
        <li class="main-nav"><a href="javascript:;" class="contactLink">
        	<div class="chtitle"><img src="img/micon2.png" class="wicon">聯絡我們</div>
						<!--<div class="entitle">Contact</div>-->
        </a></li>
        <li class="main-nav mr"><a href="howtobuy.php">
        	<div class="chtitle"><img src="img/micon2.png" class="wicon">如何訂購</div>
						<!--<div class="entitle">How to buy</div>-->
        </a></li>
        <!-- <li class="main-nav mr"><a href="http://www.chstudio2010.com/" target="_blank">
        	<div class="chtitle"><img src="img/micon2.png" class="wicon">形象官網</div>
        </a></li> -->
	</ul>
    
    
    <ul class="topmenu-nav topmenu-nav-right">
    
          <li class="showCart"><a href="javascript:;"><img src="images/car2.png" height="21" width="23"><span class="itemQty"><?php echo $cart->itemCount;?>件商品</span></a></li>
            <?php if ($totalRows_RecMember == 0) { // Show if recordset empty ?>
            <li class=""><a href="member_login.php"><img src="images/man2.png" width="15">會員登入 / 註冊</a></li>
            <!-- <li class=""><a href="member_login.php"><img src="images/man2.png" width="15">註冊會員</a></li> -->
            <?php } // Show if recordset empty ?>
            <?php if ($totalRows_RecMember > 0) { // Show if recordset not empty ?>
            <li><a href="member_list.php"><img src="images/man2.png" width="15">Hi <span class="memberName"><?php echo $row_RecMember['m_name']; ?></span> 歡迎登入</a></li>
            <li><a href="<?php echo $logOutAction ?>">登出</a></li>
            <?php } // Show if recordset not empty ?>
	</ul>
    
    </div><!-- topmenu end -->
    
    

<!-- <div class="leftmenu-block">

	<div class="forblock"></div>

	<ul class="leftmenu">
		<li class="" id="topmenu-goabout">
			<a href="javascript:;">
				<div class="chtitle jp-serif"><img src="img/micon2.png" class="wicon">關於 C+H</div>
				<div class="entitle jp-serif">About</div>
			</a>
		</li>
		<li class="">
					<a href="news.php">
						<div class="chtitle jp-serif"><img src="img/micon2.png" class="wicon">最新消息</div>
						<div class="entitle jp-serif" style=" padding-left: 23px; text-align: left;">News</div>
					</a>
		</li>
				<li class="">
					<a href="products.php">
						<div class="chtitle jp-serif"><img src="img/micon2.png" class="wicon">全部商品</div>
						<div class="entitle jp-serif" style=" padding-left: 20px;">Products</div>
					</a>
				</li>
				<li class="" id="topmenu-gocontact">
					<a href="javascript:;">
						<div class="chtitle jp-serif"><img src="img/micon2.png" class="wicon">聯絡我們</div>
						<div class="entitle jp-serif" style=" padding-left: 15px;">Contact</div>
					</a>
				</li>
				<li class="">
					<a href="howtobuy.php">
						<div class="chtitle jp-serif"><img src="img/micon2.png" class="wicon">如何訂購</div>
						<div class="entitle jp-serif">How to buy</div>
					</a>
				</li>
	</ul>
</div>  -->

<div class="car-area cartArea" id="topCart">
<?php
//require_once('topCart.php');
?>
</div><!-- car-area end -->

<script type="text/javascript">


	$(".cartArea").load("topCart.php", function(responseTxt, statusTxt, xhr){
        if(statusTxt == "success"){
			//alert("External content loaded successfully!");	
		}            
        if(statusTxt == "error"){
			 //alert("Error: " + xhr.status + ": " + xhr.statusText);
		}           
    });
	$(".itemQty").load("itemQty.php", function(responseTxt, statusTxt, xhr){
        if(statusTxt == "success"){
			//alert("External content loaded successfully!");	
		}            
        if(statusTxt == "error"){
			 //alert("Error: " + xhr.status + ": " + xhr.statusText);
		}           
    });

	$(".topmenu .menu").mouseover(function  () {
		$(".leftmenu").fadeIn( 700 );
	})
	/*$(".leftmenu-block").mouseleave(function  () {
		$(".leftmenu").delay(500).fadeOut(700);
	})*/

	$(".topmenu-nav li.showCart").click(function  () {
		$(".car-area").fadeToggle();
	})

	var now="<?php echo $now; ?>";
	
	$("#topmenu-goabout, .aboutLink").click(function  () {
		if (now != 'index') {
			window.location.href='index.php#about';
		}else{
			$.scrollTo( $('#about'), {duration:1000} );
		}
	})
	$("#topmenu-gocontact, .contactLink").click(function  () {
		if (now != 'index') {
			window.location.href='index.php#contact';
		}else{
			$.scrollTo( $('#contact'), {duration:1000} );
		}
	})
	
	$( window ).scroll(function() {
	  $(".cartArea").fadeOut(700);
	});

</script>