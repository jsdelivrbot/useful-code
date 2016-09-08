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
$query_RecDownload = "SELECT * FROM data_set WHERE d_class1 = 'download' AND d_active='1' ORDER BY d_sort ASC, d_date DESC";
$RecDownload = mysql_query($query_RecDownload, $connect2data) or die(mysql_error());
$row_RecDownload = mysql_fetch_assoc($RecDownload);
$totalRows_RecDownload = mysql_num_rows($RecDownload);

$colname_RecFile = "-1";
if (isset($row_RecDownload['d_id'])) {
  $colname_RecFile = $row_RecDownload['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecFile = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'file'", GetSQLValueString($colname_RecFile, "int"));
$RecFile = mysql_query($query_RecFile, $connect2data) or die(mysql_error());
$row_RecFile = mysql_fetch_assoc($RecFile);
$totalRows_RecFile = mysql_num_rows($RecFile);
?>
<?php require_once('Connections/session.initialize.php'); ?>
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

<link rel="stylesheet/less" type="text/css" href="style_ryder.less">
<script src="js/less-1.3.0.min.js" type="text/javascript"></script>

<?php require_once('ga.php'); ?>
</head>
<body>
	<?php $now="buy"; ?>
	<?php include('topmenu.php'); ?>

	<div class="buy-wrap">
		<?php include 'logo.php'; ?>

		<div class="area1">
			<?php include 'menu.php'; ?>
		</div><!-- area1 end -->

		<div class="area2">
			<div class="item1 how">
				<ul class="left">
					<li class="mode">購買方式</li>
                    
					<!--<li class="article" style="vertical-align:middle">網路訂購：<br></li>-->
				</ul><!-- left end -->
                
                <ul class="right-1">
                
					<li class="circle">1</li>
                    
                    <li class="article">
                    	<h3>網路訂購：</h3>
						<div class="note">
							<h4>(1) 會員訂購：</h4>
                            <p class="lm2">會員訂購需先註冊會員，並登入會員。<br>
                            會員可不定期享有本站優惠。</p>
                            <br>
                            <h4>(2) 訪客訂購(非會員)</h4>
						</div>
                        
						<div class="note" style="border:0">
							
						</div>
                    </li>
                </ul>
                
				
				<?php if(0){ ?>
				<ul class="right">
					<li class="circle">2</li>
					<li class="article">
						<h3>電話預購，需填寫預購單。</h3>
						<div class="note">
							<p>服務專線：+886 7 3106766</p>
							<!-- <p>Line ID：0925266198</p>
							                            <p><img src="images/line_qrcode.jpg"></p> -->
						  <p>服務時間：09:00-17:00，週一~週五</p>
						</div>
						<div class="download"><a href="<?php echo $row_RecFile['file_link1']; ?>" target="new" title="<?php echo $row_RecFile['file_title']; ?>" id="downloadFile">表單下載</a></div>
					</li>
				</ul><!-- right end -->
				<?php } ?>

			</div><!-- item1 end -->

			<div class="item1 how">
				<ul class="left">
					<li class="mode vtop">付款方式</li>
					<li class="article">
						<h3 class="first">(1) ATM 轉帳：</h3>
				<span class="lm">
當您的訂單資料成立後，您需於 3 內完成匯款，以利如期出貨。</span><br><br>

                   <span class="lm"> 1.會員完成匯款後<strong>可進會員系統回報匯款資訊</strong></span><br>
                    <span class="lm">2.非會員完成匯款後<strong>請來信或來電告知匯款帳號後五碼</strong></span>
				
				<h3>(2) 貨到付款</h3>
                <span class="lm">貨到付款金額超過 2 萬元者，請改用ATM匯款，謝謝您。</span>
					</li>
					
				</ul><!-- left end -->
				
			</div><!-- item1 end -->

			<div class="item1 how">
				<ul class="left">
					<li class="mode vtop">配送方式
                    </li>
                    <li class="article">
                    
                    		<h3 class="first">(1) 送貨方式：</h3>
                    		<span class="lm">全程常溫宅配運送，請註明收件時段</span>
                    		
                            <h3>(2) 送貨範圍：</h3>
                            <span class="lm">限台灣本島地區，若有台灣本島以外地區，運費需額外計算。</span>
                            <h3>(3) 寄送時間：</h3>
                            <span class="lm">付款後 7 天內出貨或視顧客情況而排定日期出貨。</span>
						
					</li>
					
				</ul><!-- left end -->
				
			</div><!-- item1 end -->

			<div class="item1 how">
				<ul class="left">
					<li class="mode vtop">退換貨說明</li>
					<li class="article" style="margin-left: -22px;">
						(1) 請在收到產品後拆箱確認，若有問題請當場拍照以及向宅配司機反應，<br>
						<span class="lm2">並於到貨日 3 日內與我們聯繫進行退換貨處理。</span><br><br>
						(2) 服務電話：+886 7 3106766<br>
                        <!-- <span class="lm2">Line ID：0925266198</span>
                        <p class="lm2"><img src="images/line_qrcode.jpg"></p> -->
					</li>
					
				</ul><!-- left end -->
				
			</div><!-- item1 end -->


		</div><!-- area2 end -->

	</div><!-- news-detail-wrap end -->

	<?php include 'backtotop.php'; ?>
	<?php include 'footer.php'; ?>

</body>
</html>
<?php
mysql_free_result($RecDownload);
?>
<script type="text/javascript">
	$(window).load(function  () {
		$(".heading").click(function  () {
			$(this).parent().find(".article").slideToggle();
			$(this).find("img").toggleClass("rotate");
		})
	})
	
function SaveToDisk(fileURL, fileName) {
    // for non-IE
    if (!window.ActiveXObject) {
        var save = document.createElement('a');
        save.href = fileURL;
        save.target = '_blank';
        save.download = fileName || 'unknown';

        var event = document.createEvent('Event');
        event.initEvent('click', true, true);
        save.dispatchEvent(event);
        (window.URL || window.webkitURL).revokeObjectURL(save.href);
    }

    // for IE
    else if ( !! window.ActiveXObject && document.execCommand)     {
        var _window = window.open(fileURL, '_blank');
        _window.document.close();
        _window.document.execCommand('SaveAs', true, fileName || fileURL)
        _window.close();
    }
}
	
</script>