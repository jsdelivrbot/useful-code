<?php
require_once('inc/EDcart.php');
if (!isset($_SESSION)) {
  session_start();
}

$cart =& $_SESSION['edCart']; 
if(!is_object($cart)) $cart = new edCart(); 

//unset($_SESSION['edCart']);
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
	header("Location: products.php");
}

mysql_select_db($database_connect2data, $connect2data);
$query_RecProductsT = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='post_tag' AND T.term_active='1' ORDER BY term_sort ASC, term_id DESC";
$RecProductsT = mysql_query($query_RecProductsT, $connect2data) or die(mysql_error());
$row_RecProductsT = mysql_fetch_assoc($RecProductsT);
$totalRowsT = mysql_num_rows($RecProductsT);
?>
<?php require_once('Connections/session.initialize.php'); ?>
<?php require_once('js/fun_moneyFormat.php'); ?>
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

<script src="js/jquery.scrollTo.js"></script>
<script src="js/TweenMax.min.js"></script>

<script src="js/jquery.bxslider/jquery.bxslider.js"></script>
<link rel="stylesheet" href="js/jquery.bxslider/jquery.bxslider.css">

<!--<script type="text/javascript" src="inc/js/custom.js?<?php echo rand(1, 1000)/1000;?>"></script>-->

<link rel="stylesheet/less" type="text/css" href="style_ryder.less">
<script src="js/less-1.3.0.min.js" type="text/javascript"></script>

<?php require_once('ga.php'); ?>

</head>
<body>
	<?php $now="products"; ?>
	<?php include('topmenu.php'); ?>

	<div class="products-detail-wrap">
		<?php include 'logo.php'; ?>

		<div class="area1">
			<?php include 'menu.php'; ?>
		</div><!-- area1 end -->

		<div class="area2">
			<ul class="col1 left_catbar">
				<!-- 搜尋 -->
				<!-- <li class="left"><input type="text" placeholder="" id="text"><img src="images/textbg.png" height="27" width="20"></li> -->
				<li class="right margin0">
					<div class="title">產品分類</div>
					<?php if ($totalRowsT > 0) { // Show if recordset not empty ?>
<div class="content">
<?php do { ?>
<?php
mysql_select_db($database_connect2data, $connect2data);
$query_RecPTTotal = "SELECT COUNT(d_id) AS TT FROM data_set AS D WHERE D.d_class1='products' AND D.d_active='1' AND D.d_class2='".$row_RecProductsT['term_id']."' ORDER BY d_date DESC";
$RecPTTotal = mysql_query($query_RecPTTotal, $connect2data) or die(mysql_error());
$row_RecPTTotal = mysql_fetch_assoc($RecPTTotal);
$totalRows_RecPTTotal = mysql_num_rows($RecPTTotal);
//echo $query_RecPTTotal;
?>
<p><a href="products.php?t=<?php echo $row_RecProductsT['term_id'];?>"><?php echo $row_RecProductsT['name']; ?><span><?php echo $row_RecPTTotal['TT']; ?></span></a></p>
<?php } while ($row_RecProductsT = mysql_fetch_assoc($RecProductsT)); ?>
    <!--<p>冷凍食品<span>5</span></p>
    <p>空運來台<span>10</span></p>
    <p>現撈海鮮<span>6</span></p>-->
</div>
<?php } // Show if recordset not empty ?>
				</li>
			</ul><!-- col1 end -->

			<div class="col2">

				<div id="secondDiv"></div>
<?php if ($totalRows_RecImage > 0) { // Show if recordset not empty ?>
				<ul class="bxslider">

<?php do{ ?>
<li><img src="<?php echo $row_RecImage['file_link1'].'?'.(mt_rand(1,100000)/100000); ?>"></li>
<?php } while ($row_RecImage = mysql_fetch_assoc($RecImage)); ?> 
<?php
$rows = mysql_num_rows($RecImage);
if($rows > 0) {
	mysql_data_seek($RecImage, 0);
	$row_RecImage = mysql_fetch_assoc($RecImage);
}
?>                  
                  
				</ul>
				<div id="bx-pager">
<?php $i=0;?>
<?php do{ ?>
<a data-slide-index="<?php echo $i;?>" href=""><img src="<?php echo $row_RecImage['file_link2'].'?'.(mt_rand(1,100000)/100000); ?>"/></a>
                  
<?php $i++;?>				
<?php } while ($row_RecImage = mysql_fetch_assoc($RecImage)); ?>
				</div>
<?php } // Show if recordset not empty ?>
			</div><!-- col2 end -->

			<div class="col3">
				<div class="title"><?php echo (isset($row_RecProducts['d_class5'])) ? nl2br($row_RecProducts['d_class5']) : $row_RecProducts['d_title']; ?></div>
				<div class="price">價格：<span>$ <?php echo moneyFormat($row_RecProducts['d_price1']); ?></span></div>
				<div class="num">數量：
<select name="pNum" id="pNum">				
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
					<span id="addToCart"><a href="javascript:;" id="id_<?php echo $row_RecProducts['d_id']; ?>">加入購物車</a></span>
				</div>
				<div class="content">
					<?php echo $row_RecProducts['d_class3']; ?>
				</div>
				<div class="note">商品備註</div>
			</div><!-- col3 end -->

		</div><!-- area2 end -->

		<div class="area3">
        <?php echo str_replace('<img src="../source', '<img src="source', $row_RecProducts['d_content']); ?>
			<!--<ul>
				<li><img src="images/detail-img1.png"></li>
				<li><img src="images/detail-img2.png"></li>
				<li><img src="images/detail-img3.png"></li>
			</ul>-->
		</div><!-- area3 end -->

		<div class="area4">
			<div class="item1">商品資訊</div>
			<div class="item2">
				<?php echo $row_RecProducts['d_class4']; ?>
			</div>
		</div><!-- area4 end -->


	</div><!-- products-detail-wrap -->
	<div id="secondDiv"></div>

	<?php include ('backtotop.php'); ?>
	<?php include ('footer.php'); ?>

</body>
</html>
<?php
mysql_free_result($RecProducts);
?>
<script type="text/javascript">
	$(window).load(function  () {

		var slider=$(".bxslider").bxSlider({
			mode: 'fade',
			pagerCustom: '#bx-pager',
			controls:false
		})

		$(".note").mousedown(function() {
				$.scrollTo( $('.area4'), {duration:1000,offset:-100} );
		});
		
		

		$("#addToCart").mousedown(function  () {
			
			var productIDValSplitter 	= $(this).find('a').attr('id').split("_");
			var productIDVal 			= productIDValSplitter[1];
			var qty						= $("#pNum").val();
			
			var m_id					= $('#m_id').val();
			//alert(productIDVal);
			//$("#notificationsLoader").html('<div><img src="inc/loading.gif"></div>');
		
			$.ajax({  
			type: "POST",  
			url: "inc/functions.php",  
			data: { productID: productIDVal, qty: qty, action: "addToBasket", m_id: m_id},  
			dataType : 'json',
			success: function(theResponse) {
				
			}  
		});  
			
			
			
			jQuery("html,body").animate({
			    scrollTop:0
			},500);
			$(".car-area").fadeIn(500);
			
			var current = slider.getCurrentSlide()+1;
			var copy=$(".bxslider li:nth-child("+current+") img").clone();
			$("#secondDiv").append(copy);
			// var img=$("#secondDiv img");
			var tween=TweenMax.to("#secondDiv", 1.5, {
				delay:0.5,
				"margin-top":"-400px",
				"margin-left":"205px",
				"scale":0.2,
				"opacity":0,
				onComplete: function  () {
					$("#secondDiv").empty();
					tween.reverse();
					
					$(".itemQty").load("itemQty.php", function(responseTxt, statusTxt, xhr){
						if(statusTxt == "success"){
							//alert("External content loaded successfully!");	
						}            
						if(statusTxt == "error"){
							 //alert("Error: " + xhr.status + ": " + xhr.statusText);
						}           
					});
					
					$(".cartArea").load("topCart.php", function(responseTxt, statusTxt, xhr){
						if(statusTxt == "success"){
							//alert("External content loaded successfully!");	
							//$(".car-area").fadeIn(500);
						}            
						if(statusTxt == "error"){
							 //alert("Error: " + xhr.status + ": " + xhr.statusText);
						}
						//$(this).delay(700).fadeOut(700);        
					});
				}
			});
		});
	});
</script>