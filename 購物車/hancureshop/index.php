<?php
require_once('inc/EDcart.php');
if (!isset($_SESSION)) {
  session_start();
}

$cart =& $_SESSION['edCart']; 
if(!is_object($cart)) $cart = new edCart(); 
?>
<?php require_once('mobileCheck.php'); ?>
<?php require_once('Connections/connect2data.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_connect2data, $connect2data);
$query_RecBanners = "SELECT * FROM data_set WHERE d_class1 = 'banners' AND d_active='1' ORDER BY d_sort ASC, d_date DESC";
$RecBanners = mysql_query($query_RecBanners, $connect2data) or die(mysql_error());
$row_RecBanners = mysql_fetch_assoc($RecBanners);
$totalRows_RecBanners = mysql_num_rows($RecBanners);

mysql_select_db($database_connect2data, $connect2data);
$query_RecAbout = "SELECT * FROM data_set WHERE d_class1 = 'about' AND d_active='1' ORDER BY d_sort ASC, d_date DESC";
$RecAbout = mysql_query($query_RecAbout, $connect2data) or die(mysql_error());
$row_RecAbout = mysql_fetch_assoc($RecAbout);
$totalRows_RecAbout = mysql_num_rows($RecAbout);

mysql_select_db($database_connect2data, $connect2data);
$query_ReCcontact = "SELECT * FROM data_set AS D LEFT JOIN file_set AS F ON D.d_id=F.file_d_id WHERE d_class1 = 'contact' AND d_active='1' ORDER BY d_sort ASC, d_date DESC";
$ReCcontact = mysql_query($query_ReCcontact, $connect2data) or die(mysql_error());
$row_ReCcontact = mysql_fetch_assoc($ReCcontact);
$totalRows_ReCcontact = mysql_num_rows($ReCcontact);

$maxRows_RecProducts = 6;
$pageNum = 0;
if (isset($_GET['pageNum'])) {
  $pageNum = $_GET['pageNum'];
}
$startRow_RecProducts = $pageNum * $maxRows_RecProducts;

mysql_select_db($database_connect2data, $connect2data);
$query_RecProducts = "SELECT * FROM term_relationships AS TR, data_set AS D, terms AS T
WHERE TR.term_taxonomy_id = T.term_id AND D.d_id = TR.object_id AND D.d_class1='products' AND D.d_active='1' ORDER BY term_order ASC, d_date DESC";
$query_limit_RecProducts = sprintf("%s LIMIT %d, %d", $query_RecProducts, $startRow_RecProducts, $maxRows_RecProducts);
$RecProducts = mysql_query($query_limit_RecProducts, $connect2data) or die(mysql_error());
$row_RecProducts = mysql_fetch_assoc($RecProducts);

/*if (isset($_GET['totalRows'])) {
  $totalRows = $_GET['totalRows'];
} else {
  $all_RecProducts = mysql_query($query_RecProducts);
  $totalRows = mysql_num_rows($all_RecProducts);
}*/
$all_RecProducts = mysql_query($query_RecProducts);
$totalRows = mysql_num_rows($all_RecProducts);
$totalPages = ceil($totalRows/$maxRows_RecProducts)-1;

$queryString = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum") == false && 
        stristr($param, "totalRows") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString = sprintf("&totalRows=%d%s", $totalRows, $queryString);
?>
<?php require_once('Connections/session.initialize.php'); ?>
<?php require_once('js/fun_moneyFormat.php'); ?>
<?php require_once('display_page_index.php'); ?>
<?php require_once('login_query.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>HanCure 漢速敷</title>

<!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->

<link rel="shortcut icon" href="img/fav.png" type="image/x-icon">
<!-- <link rel="apple-touch-icon" href="img/fav.png">
<link rel="apple-touch-icon" sizes="76x76" href="img/fav.png">
<link rel="apple-touch-icon" sizes="120x120" href="img/fav.png">
<link rel="apple-touch-icon" sizes="152x152" href="img/fav.png"> -->
<?php include('meta.php') ?>

<script src="js/jquery/1.11.1/jquery.min.js"></script>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

<script src="js/jquery.bxslider/jquery.bxslider.js"></script>
<link rel="stylesheet" href="js/jquery.bxslider/jquery.bxslider.css">

<script src="js/vegas.min.js"></script>
<link rel="stylesheet" href="css/vegas.min.css">

<script src="js/TweenMax.min.js"></script>
<script src="js/jquery.scrollTo.js"></script>

<link rel="stylesheet/less" type="text/css" href="style_ryder.less">
<script src="js/less-1.3.0.min.js" type="text/javascript"></script>

<script>
function initialize()
{
  var myLatLng = new google.maps.LatLng(<?php echo isset($row_ReCcontact['d_class2'])?$row_ReCcontact['d_class2']:'22.663720, 120.319145'; ?>);
  var mapProp = {
  center:new google.maps.LatLng(<?php echo isset($row_ReCcontact['d_class2'])?$row_ReCcontact['d_class2']:'22.663720, 120.319145'; ?>),
  zoom:16,
  scrollwheel: false,
  styles: [ { stylers: [ { saturation: -100 } ] } ],
  mapTypeId:google.maps.MapTypeId.ROADMAP
  }


var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
 //googleMap 是div id

var image = 'img/maplogo.png';
      var beachMarker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          icon: image
      });
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>

<script type="text/javascript">
	$(window).load(function  () {
		var bannerh=$(window).height()-120;
		$(".banner").css("height",bannerh+"px");
		$(".banner").vegas({
			timer:false,
		    slides: [

<?php if ($totalRows_RecBanners > 0) { // Show if recordset not empty ?>
<?php 
$i=1;
do {
$colname_RecBannerImage = "-1";
if (isset($row_RecBanners['d_id'])) {
  $colname_RecBannerImage = $row_RecBanners['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecBannerImage = sprintf("SELECT * FROM file_set WHERE file_type='image' AND file_d_id = %s", GetSQLValueString($colname_RecBannerImage, "int"));
$RecBannerImage = mysql_query($query_RecBannerImage, $connect2data) or die(mysql_error());
$row_RecBannerImage = mysql_fetch_assoc($RecBannerImage);
$totalRows_RecBannerImage = mysql_num_rows($RecBannerImage);

if($totalRows_RecBannerImage>0){
	echo '{ src: "'.$row_RecBannerImage['file_link1'].'" }';
	if($i<$totalRows_RecBanners){
		echo ',';
	}
}

$i++;
} while ($row_RecBanners = mysql_fetch_assoc($RecBanners));
$rows = mysql_num_rows($RecBanners);
  if($rows > 0) {
      mysql_data_seek($RecBanners, 0);
	  $row_RecBanners = mysql_fetch_assoc($RecBanners);
  }
?>
<?php } // Show if recordset not empty ?>
<?php if ($totalRows_RecBanners == 0) { // Show if recordset empty ?>
{ src: "images/banner1.jpg" }/*,
{ src: "images/banner2.jpg" },
{ src: "images/banner3.jpg" },
{ src: "images/banner4.jpg" },
{ src: "images/banner5.jpg" }*/
<?php } // Show if recordset empty ?>

		    ],
  complete:function() {
      $(this).wrap('<a href="http://www.w3schools.com" target="_blank">');
  }
		});
	})
</script>

<?php require_once('ga.php'); ?>

</head>
<body>

<?php $now="index"; ?>
	<div class="banner">
    
   		<!-- <div id="bannerMask"></div> -->
		<!-- <div id="slider-block"></div> -->
		<div class="menu-block">
			
			<div class="forblock"></div>
			<ul>
				<li class="" id="gotoabout">
					<a href="javascript:;">
						<div class="chtitle jp-serif"><img src="img/micon.png" class="wicon">關於我們</div>
						<div class="entitle jp-serif">HanCure</div>
					</a>
				</li>
				<li class="">
					<a href="news.php">
						<div class="chtitle jp-serif"><img src="img/micon.png" class="wicon">最新消息</div>
						<div class="entitle jp-serif">News & Events</div>
					</a>
				</li>
				<li class="">
					<a href="products.php">
						<div class="chtitle jp-serif"><img src="img/micon.png" class="wicon">全部商品</div>
						<div class="entitle jp-serif">Products</div>
					</a>
				</li>
				<li class="" id="gotocontact">
					<a href="javascript:;">
						<div class="chtitle jp-serif"><img src="img/micon.png" class="wicon">聯絡我們</div>
						<div class="entitle jp-serif">Contact us</div>
					</a>
				</li>
				<li class="">
					<a href="howtobuy.php">
						<div class="chtitle jp-serif"><img src="img/micon.png" class="wicon">如何訂購</div>
						<div class="entitle jp-serif">How to buy</div>
					</a>
				</li>
				<li class="">
					<a href="http://www.hancure.com/" target="_blank">
						<div class="chtitle jp-serif"><img src="img/micon.png" class="wicon">形象官網</div>
						<div class="entitle jp-serif"></div>
					</a>
				</li>
				<!-- <li id="gotoabout"><a href="javascript:;"><img src="images/index-topmenu1.png" width="40" height="101"></a></li>
				<li><a href="news.php"><img src="images/index-topmenu2.png" width="40" height="102"></a></li>
				<li><a href="products.php"><img src="images/index-topmenu3.png" width="40" height="101"></a></li>
				<li id="gotocontact"><a href="javascript:;"><img src="images/index-topmenu4.png" width="40" height="101"></a></li>
				<li><a href="howtobuy.php"><img src="images/index-topmenu5.png" width="40" height="101" alt=""></a></li> -->
			</ul>
		</div><!-- menu-block end -->
		<div class="menu"><span></span></div>

		

		<div class="toplogo"><a href="index.php"><img src="img/logo.png" width="130"></a></div>

		<ul class="topnav topnav-right">
			<li><a href="javascript:;"><img src="images/car.png" height="21" width="23"><span class="itemQty"><?php echo $cart->itemCount;?>件商品</span></a></li>
			<!--<li ><a href="member_login.php"><img src="images/man.png" height="22" width="18">會員登入</a></li>-->
            
            <?php if ($totalRows_RecMember == 0) { // Show if recordset empty ?>
		<li class=""><a href="member_login.php"><img src="images/man.png" height="22" width="18">會員登入 / 註冊</a></li>
        <!-- <li class=""><a href="member_login.php"><img src="images/man.png" width="15">註冊會員</a></li> -->
		<?php } // Show if recordset empty ?>
        <?php if ($totalRows_RecMember > 0) { // Show if recordset not empty ?>
		<li><a href="member_list.php"><img src="images/man.png" height="22" width="18">Hi <?php echo $row_RecMember['m_name']; ?> 歡迎登入</a></li>
        <li><a href="<?php echo $logOutAction ?>">登出</a></li>
		<?php } // Show if recordset not empty ?>
            
		</ul>

		<div class="index-car-area cartArea">
			
		</div><!-- car-area end -->

		<div class="more"><img src="img/more.png" width="60"></div>

<?php if ($totalRows_RecBanners > 0) { // Show if recordset not empty ?>

		<ul class="fish">

<?php
/*for($i=1; $i<=$totalRows_RecBanners; $i++){
	
	echo '<li class="css_mover"><img src="images/fish.png" width="11"><img src="images/fish-active.png" width="11"></li>';
}*/
?>
<?php
if($totalRows_RecBannerImage>0){
$i=0;
do{
	if($row_RecBanners['d_content']!=''){
	
		echo '<li class="css_mover" data-i="'.$i.'" data-link="'.$row_RecBanners['d_content'].'"><img src="img/fish.png" width="12"><img src="img/fish-active.png" width="12"></li>';		
		
	}else{
		echo '<li class="css_mover"><img src="img/fish.png" width="12"><img src="img/fish-active.png" width="12"></li>';
	}
	
$i++;
} while ($row_RecBanners = mysql_fetch_assoc($RecBanners));
$rows = mysql_num_rows($RecBanners);
  if($rows > 0) {
      mysql_data_seek($RecBanners, 0);
	  $row_RecBanners = mysql_fetch_assoc($RecBanners);
  }
}
?>
        
			<!--<li class="css_mover"><img src="images/fish.png" width="11"><img src="images/fish-active.png" width="11"></li>
			<li class="css_mover"><img src="images/fish.png" width="11"><img src="images/fish-active.png" width="11"></li>
			<li class="css_mover"><img src="images/fish.png" width="11"><img src="images/fish-active.png" width="11"></li>
			<li class="css_mover"><img src="images/fish.png" width="11"><img src="images/fish-active.png" width="11"></li>
			<li class="css_mover"><img src="images/fish.png" width="11"><img src="images/fish-active.png" width="11"></li>-->
		</ul>
        
<?php } // Show if recordset not empty ?>        
        
	</div><!-- banner end -->

	<div class="index-wrap">
		<div class="area1">
			<?php include('topmenu.php'); ?>

			<div class="bigtitle">
				<div class="ch">精選商品</div>
				<div class="en">Products</div>
			</div>
            
<?php if ($totalRows > 0) { // Show if recordset not empty ?>              
            <ul class="list">
            
<?php do { ?>
<?php
mysql_select_db($database_connect2data, $connect2data);
$query_RecProductImage = "SELECT * FROM file_set  WHERE file_type='image' AND file_d_id = ".$row_RecProducts['d_id']." ORDER BY file_id DESC";
$RecProductImage = mysql_query($query_RecProductImage, $connect2data) or die(mysql_error());
$row_RecProductImage = mysql_fetch_assoc($RecProductImage);
$totalRows_RecProductImage = mysql_num_rows($RecProductImage);
?>
<li>
    <a href="products_detail.php?id=<?php echo $row_RecProducts['d_id']; ?>"><div class="cover"><img src="<?php echo $row_RecProductImage['file_link3'].'?'.(mt_rand(1,100000)/100000); ?>"><div class="block"></div></div></a>
    <a href="products_detail.php?id=<?php echo $row_RecProducts['d_id']; ?>"><div class="title"><?php echo $row_RecProducts['d_title']; ?></div></a>
    <a href="products_detail.php?id=<?php echo $row_RecProducts['d_id']; ?>"><div class="price">$ <?php echo moneyFormat($row_RecProducts['d_price1']); ?></div></a>
</li>
<?php } while ($row_RecProducts = mysql_fetch_assoc($RecProducts)); ?>
				<!--<li>
					<a href="products_detail.php"><div class="cover"><img src="images/index-list.png"><div class="block"></div></div></a>
					<a href="products_detail.php"><div class="title">金薯c - 10入盒</div></a>
					<a href="products_detail.php"><div class="price">$ 1,390</div></a>
				</li>
				<li>
					<a href="products_detail.php"><div class="cover"><img src="images/index-list.png"><div class="block"></div></div></a>
					<a href="products_detail.php"><div class="title">金薯c - 10入盒</div></a>
					<a href="products_detail.php"><div class="price">$ 1,390</div></a>
				</li>
				<li>
					<a href="products_detail.php"><div class="cover"><img src="images/index-list.png"><div class="block"></div></div></a>
					<a href="products_detail.php"><div class="title">金薯c - 10入盒</div></a>
					<a href="products_detail.php"><div class="price">$ 1,390</div></a>
				</li>
				<li>
					<a href="products_detail.php"><div class="cover"><img src="images/index-list.png"><div class="block"></div></div></a>
					<a href="products_detail.php"><div class="title">金薯c - 10入盒</div></a>
					<a href="products_detail.php"><div class="price">$ 1,390</div></a>
				</li>
				<li>
					<a href="products_detail.php"><div class="cover"><img src="images/index-list.png"><div class="block"></div></div></a>
					<a href="products_detail.php"><div class="title">金薯c - 10入盒</div></a>
					<a href="products_detail.php"><div class="price">$ 1,390</div></a>
				</li>
				<li>
					<a href="products_detail.php"><div class="cover"><img src="images/index-list.png"><div class="block"></div></div></a>
					<a href="products_detail.php"><div class="title">金薯c - 10入盒</div></a>
					<a href="products_detail.php"><div class="price">$ 1,390</div></a>
				</li>-->
			</ul><!-- list end -->
<?php
//顯示頁選擇與分頁設定開始
displayPages($pageNum, $queryString, $totalPages, $totalRows, "products.php");
//顯示頁選擇與分頁設定結束
?>     
			<!--<ul class="pager">
				<li>1</li>
				<li>2</li>
				<li>3</li>
				<li>></li>
			</ul>-->
            
            <?php } // Show if recordset not empty ?>
		</div><!-- area1 end -->

		<div class="area2" id="about">
			<div class="bigtitle">
				<div class="ch">關於我們</div>
				<div class="en">About</div>
			</div>
            
            
<?php if ($totalRows_RecAbout > 0) { // Show if recordset not empty ?>
			<div class="slider">
<?php
$colname_RecAboutImage = "-1";
if (isset($row_RecAbout['d_id'])) {
  $colname_RecAboutImage = $row_RecAbout['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecAboutImage = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'image'", GetSQLValueString($colname_RecAboutImage, "int"));
$RecAboutImage = mysql_query($query_RecAboutImage, $connect2data) or die(mysql_error());
$row_RecAboutImage = mysql_fetch_assoc($RecAboutImage);
$totalRows_RecAboutImage = mysql_num_rows($RecAboutImage);
?>

<?php if ($totalRows_RecAboutImage > 0) { // Show if recordset not empty ?>
  
  
<ul class="bxslider">
<?php do { ?>
   <li><img src="<?php echo $row_RecAboutImage['file_link1'].'?'.(mt_rand(1,100000)/100000); ?>"></li> 
    <?php } while ($row_RecAboutImage = mysql_fetch_assoc($RecAboutImage)); ?>

			  <!--<li><img src="images/index-list2.png"></li>
			  <li><img src="images/index-list2.png"></li>-->
</ul>
				<div id="slider-next"></div>
				<div id="slider-prev"></div>
                
<?php } // Show if recordset not empty ?>
			</div>



			<div class="content"><?php echo nl2br($row_RecAbout['d_content']); ?></div>
            
<?php } // Show if recordset not empty ?>
            
		</div><!-- area2 end -->

		<div class="area3" id="contact">
			<div class="bigtitle">
				<div class="ch">聯絡我們</div>
				<div class="en">Contact</div>
			</div>

			<div class="contact">
				<div class="contact-img-container"><img src="img/index-contact-title.png" width="130"></div>
				<div class="contact-info-container">
					<p>地址 / <?php echo $row_ReCcontact['d_content']; ?></p>
					<p>服務專線 / <?php echo $row_ReCcontact['d_class3']; ?></p>
					<p>EMAIL / <a href="mailto:<?php echo $row_ReCcontact['d_class4']; ?>"><?php echo $row_ReCcontact['d_class4']; ?></a></p>
				</div>
				<!-- <p class="qrcode"><img src="images/line_qrcode.jpg"></p> -->
			</div>
			<div id="googleMap"></div>
		</div><!-- area3 end -->

	</div><!-- indexwrap end -->

	<?php include('backtotop.php'); ?>
	<?php include('footer.php'); ?>
</body>
</html>
<?php
mysql_free_result($RecBanners);

mysql_free_result($RecAbout);

mysql_free_result($RecAboutImage);

mysql_free_result($ReCcontact);

mysql_free_result($RecProducts);
?>
<script type="text/javascript">

var JData = {};

$.ajax({
  dataType: "json",
  url: 'bannerLinks.php',
  error: function(xhr) {
	  alert('Ajax request 發生錯誤');
  },
  success: function(response) {
	  //console.log(response);	  
	  for (var i = 0; i < response.length; i++) {
		  JData[i] = response[i]['d_content'];
		  //alert(response[i]['d_content']);   //i=0→Wing; i=1→Wind; i=2→Edge
		  //alert(JData[i]);    //i=0→20;   i=1→18;   i=2→25
		  //alert(JData[i]["height"]); //i=0→182;  i=1→165;  i=2→171
		}
		//console.log(JData);
	  /*$('#msg_user_name').html(response);
	  $('#msg_user_name').fadeIn();*/
  }
  
});

$(window).load(function  () {
	$(".topmenu").hide();
	var h=$(".banner").height();
	$(window).scroll(function() {
        if ( $(this).scrollTop() > h){
            $('.topmenu').fadeIn("fast");
        } else {
            $('.topmenu').stop().fadeOut("fast");
        }
    });
    $(".more").click(function(){
        jQuery("html,body").animate({
            scrollTop: h
        },1000);
    });

    $("#gotoabout").mousedown(function() {
    	$.scrollTo( $('#about'), {duration:1000} );
    });
    $("#gotocontact").mousedown(function() {
    	$.scrollTo( $('#contact'), {duration:1000} );
    });

    $(".bxslider").bxSlider({
    	adaptiveHeight: true,
    	auto:true,
    	pager:false,
    	slideWidth: 750,
    	nextSelector: '#slider-next',
		prevSelector: '#slider-prev',
		nextText: '<img src="images/slider-next.png" height="44" width="27">',
		prevText: '<img src="images/slider-prev.png" height="44" width="27">'

    });
	
	$("#bannerMask").click(function  () {
		var num=$(".banner").vegas('current');
		
	   //alert(1);
	   
	   //$('ul.fish li')
	   
	   if(JData[num]!=null){
		   window.open( JData[num] );
	   }
	   
	   /*if(num == 0){
		   window.open("http://tw.yahoo.com");
	   }else if(num == 1){
		   window.open("http://www.google.com");
	   }*/
	})

    $(".banner .menu").mouseover(function  () {
    	$(".banner .menu-block").fadeIn(700);
    })
    $(".banner .menu-block").mouseleave(function  () {
    	$(".banner .menu-block").delay(500).fadeOut(700);
    })

    $(".topnav li:first-child").click(function  () {
    	$(".index-car-area").fadeToggle();
    })

    vegaspager();
    $(".fish li").click(function  () {
    	var index=$(this).index();
    	$(".banner").vegas('jump', index);
    	vegaspager();
    })
    $(".banner").on("vegaswalk",function  () {
    	vegaspager();
    })

    function vegaspager () {
    	var t=$(".banner").vegas('current')+1;
    	$(".fish li:nth-child("+ t +")").addClass("active");
    	$(".fish li").not(":nth-child("+ t +")").removeClass("active");
    }
	
	$(".index-car-area").load("topCart.php", function(responseTxt, statusTxt, xhr){
        if(statusTxt == "success"){
			//alert("External content loaded successfully!");	
		}            
        if(statusTxt == "error"){
			 //alert("Error: " + xhr.status + ": " + xhr.statusText);
		}           
    });
})
</script>