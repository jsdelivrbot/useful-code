<?php
require_once('EDcart.php');
if (!isset($_SESSION)) {
	session_start();
}
$cart =& $_SESSION['edCart'];
if(!is_object($cart)) $cart = new edCart(); 

//執行購物車動作
/*if(isset($_GET['prono'])){
	$id = $_GET['prono'];
}*/
$sessionID = $_COOKIE['PHPSESSID'];
//$id = (isset($_POST['productID']) ? $_POST['productID'] : "");
$id = (isset($_GET['productID']) ? $_GET['productID'] : "");
$s1 = (isset($_GET['s1']) ? $_GET['s1'] : "");
$s2 = (isset($_GET['s2']) ? $_GET['s2'] : "");
$s3 = (isset($_GET['s3']) ? $_GET['s3'] : "");
$s4 = (isset($_GET['s4']) ? $_GET['s4'] : "");

//echo 'id = '.$id."<br>";
//$DoSomeThing = (isset($_POST['action']) ? $_POST['action'] : "");
$DoSomeThing = (isset($_GET['A']) ? $_GET['A'] : "");
echo "DoSomeThing = ".$DoSomeThing."<br>";
switch($DoSomeThing){
//case "Add":
case "addToBasket":
	//$cart->add_item($_GET['prono'],1,$_GET['price'],$_GET['footnote'],$_GET['name'],$_GET['pic'],$_GET['temp'],$_GET['space'],$_GET['times'],$_GET['bread']);
	addItem($id, $cart);
	break;
case "deleteFromBasket":
	deleteItem($id, $cart, $sessionID);
	break;
case "Empty":
	$cart->empty_cart();
	break;
case "Update":
	updateItem($cart);
	break;		
}

function addItem($id, $cart){
	//echo "do addItem <br>";
	require_once('../../../Connections/connect2data.php');
	//echo "id = $id <br>";
	mysql_select_db($database_connect2data, $connect2data);
	$sql_p = "SELECT D.*, DE.* FROM data_set AS D LEFT JOIN data_exten_set AS DE ON D.d_id = DE.de_d_id WHERE D.d_id = $id";
	//echo "sql = ".$sql_p."<br>";
	$result_p = mysql_query($sql_p, $connect2data) or die(mysql_error());
	
	$row_p = mysql_fetch_assoc($result_p);
	//echo ("num_rows = ".mysql_num_rows($result_p)."<br>");
	
	if(mysql_num_rows($result_p)==0){
		//header('Location: products_list.php');		
	}else{
		//echo "d_id = ".$row_p['d_id']."<br>";
		mysql_select_db($database_connect2data, $connect2data);
		$sql_pImage = "SELECT file_link2 FROM file_set WHERE file_type='series_image' AND file_d_id = ".$row_p['d_id']." ORDER BY file_id DESC";
		$result_pImage = mysql_query($sql_pImage, $connect2data) or die(mysql_error());
		$row_pImage = mysql_fetch_assoc($result_pImage);
	
		$cart->add_item($row_p['d_id'], 1, $row_p['d_title'], $row_p['d_sn'], $row_p['de_price_status'], $row_p['de_dir_price'], $row_p['de_coll_price_1'], $row_p['de_discount'], $row_p['de_discount_num'], $row_p['de_freight'], $row_pImage['file_link2'], $row_p['d_weight']);
		//echo $subAllTotal = $cart->total;
		//$arr( 'subAllTotal' => $cart->total);
		$arr['subAllTotal'] = $cart->total;
	}	
	
}

function updateItem($cart){
	for($startNO=0;$startNO < $_GET['itemcount'];$startNO++){
		$cart->edit_item($_GET['itemid'][$startNO],$_GET['qty'][$startNO]);
	}
}

function deleteItem($id, $cart, $sessionID){

	$cart->del_item($id);
	
	$userIP = $cart->item_userIP;
	
	$query = "DELETE FROM m_baskets WHERE productID = '$id' AND basketSession = '$sessionID' AND mb_ip = '$userIP'";
	//mysql_query($query) or die('Error, delete query failed');
	echo $query;
	mysql_query($query) or die(mysql_error());
	
	//if ($noJavaScript == 1) {
		//header("Location: ../../../orders-add.php");
	//}else{
		$arr['res'] 		= '';
		$arr['subAllTotal'] = $cart->total;
		$arr['deliverfee'] 	= $cart->deliverfee;
		$arr['grandTotal'] 	= $cart->grandtotal;
		
		//echo (json_encode($arr));
	//}
}

//echo "prono = ".$_GET['prono']." price = ".$_GET['price']." name = ".$_GET['name']." pic = ".$_GET['pic']." code = ".$_GET['code']." size = ".$_GET['size']." preserve = ".$_GET['preserve'];
//echo "itemcount = ".$cart->itemcount;
//echo "session = ".$_SESSION['aaa'];
//echo $_SESSION['edCart']->itemcount;
//$_SESSION['itemcount']=$_SESSION['edCart']->itemcount;
//$_SESSION['edCart'] = &$cart;
//$_SESSION['kkman']=$_SESSION['edCart'];
//echo gettype($_SESSION['edCart']);
//if(is_object($_SESSION['edCart'])){echo "222222222";}

//header("Location:../../orders-add.php?s1=$s1&s2=$s2&s3=$s3&s4=$s4");
header("Location:../myCartBasket.php?s1=$s1&s2=$s2&s3=$s3&s4=$s4");
//ob_end_flush();
//exit();
?>
