<?php
require_once('inc/EDcart.php');
if (!isset($_SESSION)) {
	session_start();
}

$cart =& $_SESSION['edCart'];
if(!is_object($cart)) $cart = new edCart();

//unset($_SESSION['edCart']);
?>
<?php require_once('../Connections/connect2data.php'); ?>
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

$colname_RecProducts = "-1";
if (isset($_GET['id'])) {
	$colname_RecProducts = $_GET['id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecProducts = sprintf("SELECT * FROM data_set WHERE d_id = %s", GetSQLValueString($colname_RecProducts, "int"));
$RecProducts = mysql_query($query_RecProducts, $connect2data) or die(mysql_error());
$row_RecProducts = mysql_fetch_assoc($RecProducts);
$totalRows_RecProducts = mysql_num_rows($RecProducts);

$colname_RecImage = "-1";
if (isset($row_RecProducts['d_id'])) {
	$colname_RecImage = $row_RecProducts['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecImage = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'image' ORDER BY file_id DESC", GetSQLValueString($colname_RecImage, "int"));
$RecImage = mysql_query($query_RecImage, $connect2data) or die(mysql_error());
$row_RecImage = mysql_fetch_assoc($RecImage);
$totalRows_RecImage = mysql_num_rows($RecImage);

if($totalRows_RecProducts==0){
	header("Location: goods.php");
}

mysql_select_db($database_connect2data, $connect2data);
$query_RecProductsT = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='post_tag' AND T.term_active='1' ORDER BY term_sort ASC, term_id DESC";
$RecProductsT = mysql_query($query_RecProductsT, $connect2data) or die(mysql_error());
$row_RecProductsT = mysql_fetch_assoc($RecProductsT);
$totalRowsT = mysql_num_rows($RecProductsT);
?>
<?php require_once('../Connections/session.initialize.php'); ?>
<?php require_once('../js/fun_moneyFormat.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>C+H</title>

	<?php include('meta.php') ?>

	<script src="js/jquery/1.11.1/jquery.min.js"></script>

	<script src="js/jquery.bxslider/jquery.bxslider.js"></script>
	<link rel="stylesheet" type="text/css" href="js/jquery.bxslider/jquery.bxslider.css">

	<script src="js/TweenMax.min.js"></script>

	<link rel="stylesheet/less" type="text/css" href="style_ryder.less">
	<script src="js/less-1.3.0.min.js" type="text/javascript"></script>

	<style type="text/css">
		.h-mt{
			margin-top: 20px;
		}
	</style>

</head>
<body>

	<?php include 'topmenu-fixed.php'; ?>

	<div class="fortopmenupush"></div>

	<div class="bigtitle">商品介紹 
			<?php 
			do{
				if($row_RecProducts['d_class2']==$row_RecProductsT['term_id']){
					echo " | ".$row_RecProductsT['name'];
				}
				} while ($row_RecProductsT = mysql_fetch_assoc($RecProductsT));				
			$rows = mysql_num_rows($RecProductsT);
			if($rows > 0) {
				mysql_data_seek($RecProductsT, 0);
				$row_RecProductsT = mysql_fetch_assoc($RecProductsT);
			}
			?>
	</div>

	<!-- <div class="areatitle">商品名稱</div> -->
	<div class="areacontent"><?php echo $row_RecProducts['d_title']; ?></div>

	<?php if ($totalRows_RecImage > 0) { // Show if recordset not empty ?>
	<div class="detail-bxwrap">
		<ul class="detail-bxslider">

			<?php do{ ?>
			<li><img src="<?php echo '../'.$row_RecImage['file_link1'].'?'.(mt_rand(1,100000)/100000); ?>"></li>
			<?php } while ($row_RecImage = mysql_fetch_assoc($RecImage)); ?>
			<?php
			$rows = mysql_num_rows($RecImage);
			if($rows > 0) {
				mysql_data_seek($RecImage, 0);
				$row_RecImage = mysql_fetch_assoc($RecImage);
			}
			?>


			<!--<li><img src="images/detail-bxslider.png"></li>
			<li><img src="images/detail-bxslider.png"></li>
			<li><img src="images/detail-bxslider.png"></li>-->
		</ul>
	</div>

	<div id="bx-pager">
		<?php $i=0;?>
		<?php do{ ?>
		<a data-slide-index="<?php echo $i;?>" href=""></a>

		<?php $i++;?>
		<?php } while ($row_RecImage = mysql_fetch_assoc($RecImage)); ?>
	</div>

	<?php } // Show if recordset not empty ?>

	<div class="detail-add">
		<span class="moneybox">$ <?php echo moneyFormat($row_RecProducts['d_price1']); ?></span>
		<span>數量：
			<select name="pNum" id="pNum" class="c-select">
				<?php
				if(intval($row_RecProducts['d_price2'])>0){
					for($i=1; $i<=intval($row_RecProducts['d_price2']); $i++){
						echo "<option value='$i'>$i</option>";
					}
				}else{
					echo "<option value='0'>0</option>";
				}
				?>
			</select>
		</span>
		<span class="addtocar" id="addToCart"><a href="javascript:;" id="id_<?php echo $row_RecProducts['d_id']; ?>">加入購物車</a></span>
	</div>

	<div class="areacontent">
		<?php echo $row_RecProducts['d_data1']; ?>
		<!--<p>成分：地瓜、糖、鹽、油</p>
		<p>產地：台灣口湖鄉</p>
		<p>重量：25g±5%(每包)</p>
		<p>保存方式：避免陽光直射及高溫潮濕處，建議放置乾冷之場所，開封後，請放置冰箱冷藏</p>
		<p>最佳賞味期限：6個月</p>
		<p>保存期限：一年</p>-->
	</div>

	<div class="areatitle h-mt">商品資訊</div>

	<div class="news-detail-article">
		<?php echo $row_RecProducts['d_data2']; ?>
		<!--<p>C+H歡慶官網全新上線!!!</p>
		<p>★ 全館不限品項滿十盒免運費</p>
		<p>★本優惠活動即日起至10/5日止</p>
		<p>★只購買金薯C單一品項滿十盒可搶先出貨</p>
		<p>【純素保證】嚴選台農57號地瓜,純素食,葷素者皆宜,吃的輕鬆又健康。</p>
		<p>【絕不添加】用天然⾷材,不添加化學成分、香精、合成調味。</p>
		<p>【滋味濃郁】雲林優良的氣候環境,種植出的作物碩大飽滿味道好。</p>


		<img src="images/detail-img.png">
		<img src="images/detail-img2.png">
		<img src="images/detail-img3.png">-->
	</div>

	<div class="areatitle h-mt">商品備註</div>

	<div class="areacontent">
		<?php echo $row_RecProducts['d_data3']; ?>
		<!--<p>【純素保證】嚴選台農57號地瓜,純素食,葷素者皆宜,吃的輕鬆又健康。</p>
		<p>【絕不添加】用天然⾷材,不添加化學成分、香精、合成調味。</p>
		<p>【滋味濃郁】雲林優良的氣候環境,種植出的作物碩大飽滿味道好。</p>-->
	</div>

	<ul class="twochoice">
		<li class="goback"><a href="javascript:;">回上一頁</a></li>
		<li class="gocar"><a href="javascript:;" id="id_<?php echo $row_RecProducts['d_id']; ?>">加入購物車</a></li>
	</ul>

	<div class="evedance">加入成功</div>

	<?php include 'footer.php'; ?>

</body>
</html>

<script type="text/javascript">
	var addCart = 0;

	$(".gocar , .addtocar").click(function  (event) {

		if(addCart==0){
			var productIDValSplitter 	= $(this).find('a').attr('id').split("_");
			var productIDVal 			= productIDValSplitter[1];
			var qty						= $("#pNum").val();

			var m_id					= $('#m_id').val();
			var obj = $(this);
			//alert(productIDVal);
			//$("#notificationsLoader").html('<div><img src="inc/loading.gif"></div>');

			$.ajax({
				type: "POST",
				url: "inc/functions.php",
				data: { productID: productIDVal, qty: qty, action: "addToBasket", m_id: m_id},
				dataType : 'json',
				success: function(theResponse) {
					/*var MouseX = event.pageX;
					var MouseY = event.pageY;
					var WindowTop=$(window).scrollTop();
					var top=MouseY - WindowTop;

					$(".evedance").css({
						left: MouseX + "px",
						top: top + "px",
						"transform": "translate(-50%,-50%)"
					})

					var dance=TweenMax.to($(".evedance"), 1.5, {
						width: "100px",
						height: "60px",
						"line-height": "60px",
						onComplete: function  () {
							dance.reverse();
						}
					})*/

			addCart = 1;

			$(".car-num").load("itemQty.php", function(responseTxt, statusTxt, xhr){
				if(statusTxt == "success"){
				}
				if(statusTxt == "error"){
							 //alert("Error: " + xhr.status + ": " + xhr.statusText);
							}
						});
			$(".gocar , .addtocar").css({
				"background-color":"#C40D23",
			});
			$(".gocar a, .addtocar a").text("結 帳");

			$('.goback a').text("繼續購物");

		}
	});
}else{
	window.location = 'order_list.php';
}




})

$(".goback").click(function  () {
	history.go(-1);
})

$('.detail-bxslider').bxSlider({
		//mode: 'fade',
		pagerCustom: '#bx-pager',
		auto: true,
		// onSlideBefore: function  () {
		// 	var current = slider.getCurrentSlide();
		// 	$(".banner").vegas('jump' , current);
		// }
	});
</script>

